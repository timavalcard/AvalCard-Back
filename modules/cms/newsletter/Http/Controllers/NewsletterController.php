<?php


namespace CMS\Newsletter\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use CMS\Newsletter\Http\Requests\NewsletterRequest;
use CMS\Newsletter\Mail\NewsletterMail;
use CMS\Newsletter\Models\Newsletter;
use CMS\Newsletter\Repository\NewsletterRepository;
use CMS\Newsletter\Services\NewsletterServices;

class NewsletterController extends Controller
{
    //front routes
    public function user_add_newsletter(){

    }

    //admin routes
    public function newsletter_add_form (){
        $this->authorize("create",Newsletter::class);
        $emails=NewsletterRepository::get_mail();
        return view("Newsletter::Admin.newsletter_add",compact("emails"));
    }

    public function newsletter_add(NewsletterRequest $request)
    {
        $this->authorize("create",Newsletter::class);
        $sendTo=NewsletterServices::send_email_to($request->send_to[0]);

        $request->request->add(["sendTo"=>$sendTo]);
        NewsletterRepository::create($request);

        $sendTo=$sendTo=="all"?NewsletterRepository::get_mail()->pluck("email")->toArray():$sendTo;

        Mail::to($sendTo)->send(new NewsletterMail($request->title,$request->contents));


        return back();
    }

    public function newsletter_list_sent(Request $request)
    {
        $this->authorize("index",Newsletter::class);
        $emails=NewsletterRepository::order_newsletter($request->orderBy);
        return view("Newsletter::Admin.newsletter_sended_list",compact("emails"));
    }

    public function newsletter_send_again($id)
    {
        $this->authorize("sendAgain",Newsletter::class);
        $newsLetter=NewsletterRepository::find($id);
        $emailMostSend=unserialize($newsLetter->sendsTo);
        $sendTo=$emailMostSend=="all"?NewsletterRepository::get_mail()->pluck("email")->toArray():$emailMostSend;
        Mail::to($sendTo)->send(new NewsletterMail($newsLetter->title,$newsLetter->message));
        return back();
    }

    public function newsletter_send_edit_form(Request $request) {
        $this->authorize("edit",Newsletter::class);
        $emails=NewsletterRepository::get_mail();
        $newsletter=NewsletterRepository::find($request->id);
        return view("Newsletter::Admin.newsletter_edit",compact("emails","newsletter"));
    }

    public function newsletter_send_edit(NewsletterRequest $request,$id)
    {
        $this->authorize("update",Newsletter::class);
        $sendTo=NewsletterServices::send_email_to($request->send_to[0]);

        $request->request->add(["sendTo"=>$sendTo]);

        $newsletter=NewsletterRepository::find($id);

        NewsletterRepository::update($newsletter,$request);

        return back();
    }

    public function newsletter_search(Request $request)
    {
        $this->authorize("search",Newsletter::class);
        $emails=NewsletterRepository::mail_search($request->search);

        $output=NewsletterServices::search_outpout($emails);

        return $output;
    }

    public function delete_newsletter_send($id)
    {
        $this->authorize("delete",Newsletter::class);
        NewsletterRepository::destroy($id);
        return back();
    }
}
