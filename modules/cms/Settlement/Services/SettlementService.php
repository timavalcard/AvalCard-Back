<?php


namespace CMS\Settlement\Services;


use CMS\Settlement\Models\Settlement;
use CMS\Settlement\Repositories\SettlementRepo;
use CMS\Wallet\Repository\WalletRepository;

class SettlementService
{

    public static function store($request)
    {
        $repo = new SettlementRepo();
        $repo->store($request);
        $amount=(integer) str_replace(",","",$request->amount);
        WalletRepository::decrease($amount);
    }

    public static function update($request, $settlementID)
    {
        $repo = new SettlementRepo();
        $settlement = $repo->find($settlementID);

        $lastSettlement = $repo->getLatestSettlement($settlement->user_id);
        if ($lastSettlement->id != $settlementID){
            return redirect()->route('settlement.index')->with('status','CanNotEditSettlementRequest');
        }

        if (!in_array($settlement->status, [Settlement::STATUS_REJECTED, Settlement::STATUS_CANCELED]) &&
            in_array($request->status, [Settlement::STATUS_CANCELED, Settlement::STATUS_REJECTED])) {
            $settlement->user->amount += $settlement->amount;
            $settlement->user->save();
        }

        if (in_array($settlement->status, [Settlement::STATUS_REJECTED, Settlement::STATUS_CANCELED]) &&
            in_array($request->status, [Settlement::STATUS_SETTLED, Settlement::STATUS_PENDING])) {

            //todo set config low price expert account amount
            if (($settlement->user->amount - $settlement->amount) < -13000 ){
                return  redirect()->back()->with('status','NotAllowedToSettlementRequest')->send();
            }

            $settlement->user->amount -= $settlement->amount;
            $settlement->user->save();
        }

        $repo->update($request, $settlement);
    }
}
