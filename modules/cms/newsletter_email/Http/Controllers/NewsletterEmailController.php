<?php


namespace CMS\NewsletterEmail\Http\Controllers;




use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CMS\NewsletterEmail\Http\Requests\AddEmailRequest;
use CMS\NewsletterEmail\Repository\NewsletterEmailRepository;
use CMS\NewsletterEmail\Models\Newsletter_mail;

class NewsletterEmailController extends Controller
{

    //front routes
    public function add (AddEmailRequest $request){
        auth()->check() ? $request->request->add(["user_id"=>auth()->id()]) : $request->request->add(["user_id"=>0]) ;
        $email=NewsletterEmailRepository::create($request->all());

        if($email){
        toastMessage("ایمیل شما با موفقیت به خبرنامه اضافه شد");

        } else{
            toastMessage("خطایی رخ داد لطفا دوباره امتحان کنید","خطایی رخ داد","error");
        }
        return back();
    }

    //admin routes
    public function newsletter_list(Request $request)
    {
        $this->authorize("index",Newsletter_mail::class);
        $emails=NewsletterEmailRepository::order_newsletter($request->orderBy);
        return view("NewsletterEmail::Admin.list_newsletter",compact("emails"));
    }





    public function delete_newsletter($id)
    {
        $this->authorize("delete",Newsletter_mail::class);
        NewsletterEmailRepository::destroy($id);
        return back();
    }


}
