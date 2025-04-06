<?php


namespace CMS\Course\Http\Controllers;


use App\Http\Controllers\Controller;
use CMS\Common\Responses\AjaxResponses;
use CMS\Course\Http\Requests\LessonRequest;
use CMS\Course\Models\Course;
use CMS\Course\Models\Lesson;
use CMS\Course\Repositories\CourseRepo;
use CMS\Course\Repositories\LessonRepo;
use CMS\Course\Repositories\SeasonRepo;
use CMS\Media\Services\MediaFileService;
use Illuminate\Http\Request;
use CMS\Transaction\Repository\TransactionRepository;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class LessonController extends Controller
{

    private $lessonRepo;

    public function __construct(LessonRepo $lessonRepo)
    {
        $this->lessonRepo = $lessonRepo;
    }
    // theme functions
    public function buy(Lesson $lesson){

        $amount=(integer) $lesson->price;
        $course=$lesson->course;
        if (resolve(LessonRepo::class)->getLessonStudentById($lesson, auth()->id()) || resolve(CourseRepo::class)->getCourseStudentById($course,auth()->id()) ) {
            toastMessage("شما قبلا این قسمت را خریداری کرده اید");
            return back();
        }
        if($amount<=0 || $lesson->free){

            resolve(LessonRepo::class)->addStudentToLesson($lesson, auth()->id(),$course);
            toastMessage("شما با موفقیت این قسمت را خریدید");
            return back();
        }
        $gateway_name="nextpay";
        $invoice=(new Invoice)->amount($amount);
        $invoice->via($gateway_name);
        return Payment::purchase(
            $invoice,
            function($driver, $transactionId) use($lesson,$amount,$gateway_name) {
                $data=[];
                $data["price"]=$amount;
                $data["transaction_id"]=$transactionId;
                $data["user_id"]=auth()->id();
                $data["gateway"]=$gateway_name;
                TransactionRepository::create($data,$lesson);
            }
        )->pay()->render();


    }

    // admin functions
    public function create($course, SeasonRepo $seasonRepo, CourseRepo $courseRepo)
    {
        $course = $courseRepo->findByid($course);
        $this->authorize('createLesson', $course);
        $seasons = $seasonRepo->getCourseSeasons($course->id);
        return view('Courses::lessons.create', compact('seasons', 'course'));
    }

    public function store($course, LessonRequest $request, CourseRepo $courseRepo)
    {
        $course = $courseRepo->findByid($course);
        $this->authorize('createLesson', $course);
        $request->request->add(["media_id" => MediaFileService::privateUpload($request->file('lesson_file'))->id ]);
        $this->lessonRepo->store($course->id, $request);
        toastMessage();
        return redirect(route('courses.details', $course->id));
    }

    public function edit($courseId, $lessonId, SeasonRepo $seasonRepo, CourseRepo $courseRepo)
    {
        $lesson = $this->lessonRepo->findByid($lessonId);
        $this->authorize('edit', $lesson);
        $seasons = $seasonRepo->getCourseSeasons($courseId);
        $course = $courseRepo->findByid($courseId);
        return view('Courses::lessons.edit', compact('lesson', 'seasons', 'course'));
    }

    public function update($courseId, $lessonId, LessonRequest $request)
    {
        $lesson = $this->lessonRepo->findByid($lessonId);
        $this->authorize('edit', $lesson);
        if ($request->hasFile('lesson_file')) {

            if ($lesson->media)
                $lesson->media->delete();

            $request->request->add(["media_id" => MediaFileService::privateUpload($request->file('lesson_file'))->id ]);
        }else{
            $request->request->add(['media_id'=> $lesson->media_id]);
        }
        $this->lessonRepo->update($lessonId, $courseId, $request);
        toastMessage();
        return redirect(route('courses.details', $courseId));
    }
    public function accept($id)
    {
        $this->authorize('manage', Course::class);
        $this->lessonRepo->updateConfirmationStatus($id, Lesson::CONFIRMATION_STATUS_ACCEPTED);
        return AjaxResponses::SuccessResponse();
    }

    public function acceptAll($courseId)
    {
        $this->authorize('manage', Course::class);
        $this->lessonRepo->acceptAll($courseId);
        toastMessage();
        return back();
    }

    public function acceptMultiple(Request $request)
    {
        $this->authorize('manage', Course::class);
        $ids = explode(',', $request->ids);
        $this->lessonRepo->updateConfirmationStatus($ids, Lesson::CONFIRMATION_STATUS_ACCEPTED);
        toastMessage();
        return back();
    }

    public function rejectMultiple(Request $request)
    {
        $this->authorize('manage', Course::class);
        $ids = explode(',', $request->ids);
        $this->lessonRepo->updateConfirmationStatus($ids, Lesson::CONFIRMATION_STATUS_REJECTED );
        toastMessage();
        return back();
    }

    public function reject($id)
    {
        $this->authorize('manage', Course::class);
        $this->lessonRepo->updateConfirmationStatus($id, Lesson::CONFIRMATION_STATUS_REJECTED);
        return AjaxResponses::SuccessResponse();
    }

    public function lock($id)
    {
        $this->authorize('manage', Course::class);
        if ($this->lessonRepo->updateStatus($id, Lesson::STATUS_LOCKED)){
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailedResponse();
    }
    public function unlock($id)
    {
        $this->authorize('manage', Course::class);
        if ($this->lessonRepo->updateStatus($id, Lesson::STATUS_OPENED)){
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailedResponse();
    }

    public function destroy($courseId, $lessonId)
    {
        $lesson = $this->lessonRepo->findByid($lessonId);
        $this->authorize('delete', $lesson);
        if ($lesson->media){
            $lesson->media->delete();
        }
        $lesson->delete();
        return AjaxResponses::SuccessResponse();
    }

    public function destroyMultiple(Request $request)
    {
        $ids = explode(',', $request->ids);
        foreach ($ids as $id) {
            $lesson = $this->lessonRepo->findByid($id);
            $this->authorize('delete', $lesson);
            if ($lesson->media){
                $lesson->media->delete();
            }
            $lesson->delete();
        }
        toastMessage();
        return back();
    }
}
