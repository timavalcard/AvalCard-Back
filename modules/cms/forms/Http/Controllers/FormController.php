<?php

namespace CMS\Forms\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use CMS\Common\Services\CommonService;
use CMS\Forms\Models\Form;
use CMS\Forms\Repository\FormsRepository;


class FormController extends Controller
{
    //theme functions
    public function add_entrance(Request $request){
        $form=FormsRepository::find($request->data[0]["value"]);
        FormsRepository::add_entrance($form,$request->data);
        CommonService::tel_bot("form",$form->name);
    }
    //admin functions
    public function index(){
        $forms=FormsRepository::get();
        return view("Forms::Admin.index",compact("forms"));
    }
    public function create(){
        $id=DB::select("SHOW TABLE STATUS LIKE 'forms'");
        $form_id=$id[0]->Auto_increment;
        return view("Forms::Admin.create",compact("form_id"));
    }
    public function store(Request $request){
        FormsRepository::create($request);

    }
    public function edit($id){
        $form=FormsRepository::find($id);
        return view("Forms::Admin.edit",compact("form"));
    }
    public function update(Request $request,$id){
        $form=FormsRepository::find($id);
        FormsRepository::update($form,$request);

    }

    public function delete($id){
        FormsRepository::destroy($id);
        return back();
    }

    public function entrances($id){

        $form=FormsRepository::find($id);
        $entrances=FormsRepository::entrances($form);
        return view("Forms::Admin.entrances",compact("form","entrances"));
    }
    public function show_entrance($id){
        $entrance=FormsRepository::find_entrance($id);
        $form=$entrance->form;
        return view("Forms::Admin.entrance_detail",compact("form","entrance"));

    }

    public function destroy_entrance($id){
        FormsRepository::destroy_entrance($id);
        return back();
    }
    public function status_entrance($id,Request $request){
        $entrance=FormsRepository::find_entrance($id);
        FormsRepository::change_status($entrance,$request->status);
        return back();
    }

}
