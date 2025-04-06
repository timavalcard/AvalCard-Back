<?php

namespace CMS\Services\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CMS\Services\Http\Requests\EditServicesRequest;
use CMS\Services\Http\Requests\ServicesRequest;
use CMS\Services\Repository\ServiceMetaRepository;
use CMS\Services\Repository\ServicesRepository;

class ServicesController extends Controller
{
    public function index()
    {
        $services = ServicesRepository::get_parent_services_with_paginate();
        return view("Services::Admin.index", ["services" => $services]);
    }

    public function create_form()
    {
        return view("Services::Admin.create");
    }

    public function create(ServicesRequest $request){
        $slug=make_slug_for_data($request->slug,$request->name);
        $request->request->add(["slug"=>$slug]);
        ServicesRepository::parent_create($request);
        return redirect()->route("admin_services");
    }


    public function edit_form(Request $request, $id){

        $service=ServicesRepository::find($id);
        return view("Services::Admin.edit",["service"=>$service]);
    }
    public function edit(EditServicesRequest $request){
        $slug=make_slug_for_data($request->slug,$request->name);
        $request->request->add(["slug"=>$slug]);
        $category=ServicesRepository::find($request->id);
        ServicesRepository::parent_update($category,$request);
        return back();
    }

    public static function delete($id)
    {
        ServicesRepository::delete($id);
        return back();
    }




    public function sub_index($parent)
    {
        $services = ServicesRepository::get_children_services_with_paginate($parent);
        $parent_obj=ServicesRepository::find($parent);
        return view("Services::Admin.Children.index", ["services" => $services,"parent"=>$parent_obj]);
    }

    public function sub_create_form($parent)
    {
        $parent_obj=ServicesRepository::find($parent);
        return view("Services::Admin.Children.create",["parent"=>$parent_obj]);
    }

    public function sub_create(ServicesRequest $request){
        $slug=make_slug_for_data($request->slug,$request->name);
        $request->request->add(["slug"=>$slug]);
        ServicesRepository::children_create($request);
        return redirect()->route("admin_sub_services",["parent"=>$request->parent]);
    }


    public function sub_edit_form(Request $request, $id){

        $service=ServicesRepository::find($id);
        return view("Services::Admin.Children.edit",["service"=>$service]);
    }
    public function sub_edit(EditServicesRequest $request){
        $slug=make_slug_for_data($request->slug,$request->name);
        $request->request->add(["slug"=>$slug]);
        $service=ServicesRepository::find($request->id);
        ServicesRepository::children_update($service,$request);
        return back();
    }

    public static function sub_delete($id)
    {
        ServicesRepository::delete($id);
        return back();
    }


    function sub_questions($id){
        $service=ServicesRepository::find($id);
        $service_questions=ServiceMetaRepository::find("questions",$id)->value;

        return view("Services::Admin.Children.questions",["service"=>$service,"questions"=>$service_questions]);
    }

    function add_sub_questions($id,Request $request){
        $service=ServicesRepository::find($id);
        ServiceMetaRepository::service_questions($service,$request->all());
        return back();
    }

}

