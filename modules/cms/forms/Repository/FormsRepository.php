<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 8/28/2020
 * Time: 10:19 PM
 */

namespace CMS\Forms\Repository;



use CMS\Forms\Models\Form;
use CMS\Forms\Models\FormsEntrance;

class FormsRepository
{
    public static function find($id)
    {
        return Form::findOrFail($id);
    }
    public static function findNotFail($id)
    {
        return Form::find($id);
    }
    public static function get(){
        return Form::get();
    }


    public static function create($data)
    {
        return Form::create([
            "name"=>$data->name,
            "fields"=>$data->form,
        ]);
    }

    public static function update(Form $form, $data)
    {
        $form->update([
            "name"=>$data->name,
            "fields"=>$data->form,
        ]);
    }

    public static function destroy($id)
    {
        Form::destroy($id);
    }
    public static function destroy_entrance($id)
    {
        FormsEntrance::destroy($id);
    }
    public static function add_entrance($form,$data){
        $form->entrance()->create([
            "values"=>$data
        ]);
    }
    public static function entrances($form){
        return $form->entrance;
    }
    public static function find_entrance($id){
        return FormsEntrance::find($id);
    }
    public static function change_status($entrance,$status){
        $entrance->update([
            "status"=>$status
        ]);
    }
    public static function accepted_entrances($form){
        return $form->entrance()->where("status","accepted")->get();
    }
}

