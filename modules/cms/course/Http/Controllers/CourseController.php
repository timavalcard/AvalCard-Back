<?php

namespace CMS\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use CMS\Cart\Repository\CartRepository;
use CMS\Category\Repositories\CategoryRepository;
use CMS\Comment\Repository\CommentRepository;
use CMS\Common\Responses\AjaxResponses;
use CMS\Course\Http\Requests\CourseRequest;
use CMS\Course\Models\Course;
use CMS\Course\Repositories\CourseRepo;
use CMS\Course\Repositories\LessonRepo;
use CMS\Course\Repositories\SeasonRepo;
use CMS\Course\Services\CourseService;
use CMS\Media\Services\MediaFileService;
use CMS\Order\Models\Order;
use CMS\Order\Repository\OrderRepository;
use CMS\RolePermissions\Models\Permission;
use CMS\Transaction\Repository\TransactionRepository;
use CMS\User\Repositories\UserRepository;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class CourseController extends Controller
{
    public function single($slug){

        $course=CourseRepo::find_by_slug($slug);
        $seasons=SeasonRepo::accepted_seasons_with_accepted_lessons($course);
        $comments=CommentRepository::get_approve_comment($course);
        return view("Theme::hidi.course",compact("course","comments","seasons"));

    }

    public function demo_link($id,CourseRepo $courseRepo){
        $course=$courseRepo->findByid($id);
        $course_demo=CourseRepo::get_course_demo_lesson($course);
        $link=Storage::disk("ftp")->download($course_demo->media->files["file"]);
        return $link;
    }
    public function pay(CourseRepo $courseRepo){
        $cart=CartRepository::course_get_cart();
        CourseService::get_cart_courses($cart);
        $amount=(integer)CourseService::get_cart_courses_total_price(false);
        if($amount<=0){
            CourseRepo::add_courses_and_lessons_to_user($cart,auth()->user());
            toastMessage("شما با موفقیت در این دوره ثبت نام کردید");
            return back();
        }
        $gateway_name="zarinpal";
        $data=["user_id"=>auth()->id(),"products_id"=>$cart,"price"=>$amount,"payment_type"=>$gateway_name];
            $status=Order::$PENDING;
        $order=OrderRepository::add_order($data,$status,true);
        $invoice=(new Invoice)->amount($amount);
        $invoice->via($gateway_name);
        return Payment::purchase(
            $invoice,
            function($driver, $transactionId) use($order,$amount,$gateway_name) {
                $data=[];
                $data["price"]=$amount;
                $data["transaction_id"]=$transactionId;
                $data["user_id"]=auth()->id();
                $data["gateway"]=$gateway_name;
                TransactionRepository::create($data,$order);
            }
        )->pay()->render();


    }


    // admin functions
    public function index(CourseRepo $courseRepo)
    {
        $this->authorize('index', Course::class);
        if (auth()->user()->hasAnyPermission([Permission::PERMISSION_MANAGE_COURSES, Permission::PERMISSION_SUPER_ADMIN])) {
            $courses = $courseRepo->paginate(request()->type??"video");
        } else {
            $courses = $courseRepo->getCoursesByTeacherId(auth()->id(),request()->type??"video");
        }
        return view('Courses::index', compact('courses'));
    }

    public function create()
    {
        $this->authorize('create', Course::class);
        $teachers = UserRepository::getTeachers();
        $categories = CategoryRepository::get_by_type("course");
        return view('Courses::create', compact('teachers', 'categories'));
    }

    public function store(CourseRequest $request, CourseRepo $courseRepo)
    {
        $request->request->add(['media_id' => MediaFileService::publicUpload($request->file('image'))->id]);
        $course=$courseRepo->store($request);
        if($request->category_id){
            $courseRepo->add_category($course,$request->category_id);
        }
        return redirect()->route('courses.index');
    }

    public function edit($id, CourseRepo $courseRepo)
    {
        $course = $courseRepo->findByid($id);
        $this->authorize('edit', $course);
        $teachers = UserRepository::getTeachers();
        $categories = CategoryRepository::get_by_type("course");

        return view('Courses::edit', compact('course', 'teachers', 'categories'));
    }

    public function update($id, CourseRequest $request, CourseRepo $courseRepo)
    {
        $course = $courseRepo->findByid($id);
        $this->authorize('edit', $course);
        if ($request->hasFile('image')) {
            $request->request->add(['media_id' => MediaFileService::publicUpload($request->file('image'))->id]);
            if ($course->banner)
                $course->banner->delete();
        } else {
            $request->request->add(['media_id' => $course->media_id]);
        }
        $courseRepo->update($id, $request);
        return redirect(route('courses.index'));
    }

    public function details($id, CourseRepo $courseRepo, LessonRepo $lessonRepo)
    {
        $course = $courseRepo->findByid($id);
        $lessons = $lessonRepo->paginate($id);
        $this->authorize('details', $course);
        return view('Courses::details', compact('course', 'lessons'));
    }

    public function downloadLinks($id, CourseRepo $courseRepo)
    {
        $course = $courseRepo->findByid($id);
        $this->authorize("download", $course);

        return implode("<br>", $course->downloadLinks());
    }
    public function destroy($id, CourseRepo $courseRepo)
    {
        $course = $courseRepo->findByid($id);
        $this->authorize('delete', $course);
        if ($course->banner) {
            $course->banner->delete();
        }
        $course->delete();
        return AjaxResponses::SuccessResponse();
    }

    public function accept($id, CourseRepo $courseRepo)
    {
        $this->authorize('change_confirmation_status', Course::class);
        if ($courseRepo->updateConfirmationStatus($id, Course::CONFIRMATION_STATUS_ACCEPTED)) {
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailedResponse();
    }

    public function reject($id, CourseRepo $courseRepo)
    {
        $this->authorize('change_confirmation_status', Course::class);
        if ($courseRepo->updateConfirmationStatus($id, Course::CONFIRMATION_STATUS_REJECTED)) {
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailedResponse();
    }

    public function lock($id, CourseRepo $courseRepo)
    {
        $this->authorize('change_confirmation_status', Course::class);
        if ($courseRepo->updateStatus($id, Course::STATUS_LOCKED)) {
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailedResponse();
    }


    private function courseCanBePurchased(Course $course)
    {
        if ($course->type == Course::TYPE_FREE) {
            toastMessage("عملیات ناموفق", "دوره های رایگان قابل خریداری نیستند!", "error");
            return false;
        }

        if ($course->status == Course::STATUS_LOCKED) {
            toastMessage("عملیات ناموفق", "این دوره قفل شده است و قعلا قابل خریداری نیست!", "error");
            return false;
        }

        if ($course->confirmation_status != Course::CONFIRMATION_STATUS_ACCEPTED) {
            toastMessage("عملیات ناموفق", "دوره ی انتخابی شما هنوز تایید نشده است!", "error");
            return false;
        }

        return true;
    }

    private function authUserCanPurchaseCourse(Course $course)
    {
        if (auth()->id() == $course->teacher_id) {
            toastMessage("عملیات ناموفق", "شما مدرس این دوره هستید.", "error");
            return false;
        }

        if (auth()->user()->can("download", $course)) {
            toastMessage("عملیات ناموفق", "شما به دوره دسترسی دارید.", "error");
            return false;
        }


        return true;
    }
}
