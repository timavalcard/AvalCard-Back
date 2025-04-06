<?php


namespace CMS\Settlement\Repositories;

use CMS\Settlement\Models\Settlement;
use CMS\RolePermissions\Models\Permission;

class SettlementRepo
{
    public $query;

    public function __construct()
    {
        $this->query = Settlement::query();
    }

    public function list($request,$with = []){

        $user = auth()->user();
        $query = $this->query->with($with);

        return $query->orderBy('created_at','desc')->paginate();
    }

    public function store($request){
        $amount=(integer) str_replace(",","",$request->amount);
        return Settlement::create([
            "user_id"=>auth()->id(),
            "national_code"=>$request->national_code,
            "cart_number"=>$request->cart_number,
            "amount"=>$amount,
        ]);
    }

    public function update($request,$settlement)
    {
//        $report = $settlement->report;
        if ($request->report){
            $report[time()] = $request->report;
        }
        return $settlement->update([
            "national_code"=>$request->national_code,
            "cart_number"=>$request->cart_number,

            'status' => $request->status,
        ]);

    }

    public function find($settlementID)
    {
        return $this->query->findOrFail($settlementID);
    }

    public function getLatestPendingSettlement(){
        return Settlement::query()
            ->where('user_id',auth()->id())
            ->where('status',Settlement::STATUS_PENDING)
            ->latest()
            ->first();
    }

    public function getLatestSettlement($userID){
        return Settlement::query()
            ->where('user_id',$userID)
            ->latest()
            ->first();
    }
}
