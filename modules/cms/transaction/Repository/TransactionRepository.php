<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 9/1/2020
 * Time: 2:37 PM
 */

namespace CMS\Transaction\Repository;


use CMS\Comment\Models\Comment;
use CMS\Transaction\Models\Transaction;

class TransactionRepository
{

    public static function create($data,$transactionable)
    {
        return $transactionable->transaction()->create([
            "user_id"=>$data["user_id"],
            "transaction_id"=>$data["transaction_id"],
            "price"=>$data["price"],
            "gateway"=>$data["gateway"],
        ]);
    }

    public static function find_by_transaction_id($transaction_id)
    {
       return Transaction::query()->where("transaction_id",$transaction_id)->firstOrFail();
    }

    public static function get_transactions_by_type($type,$paginate=true){
        $query=Transaction::query()->where("transactionable_type",$type)->with("transactionable");
        if($paginate){
            return $query->paginate(15);
        }
        return $query->get();
    }

    public static function updateStatus($transaction,$status)
    {
        $transaction->update([
            "status"=>$status,
        ]);
    }

    public static function updateErrorText($transaction,$text)
    {
        $transaction->update([
            "error_text"=>$text,
        ]);
    }

    public static function update_transactionAble_Status( $transactionable,$status)
    {
        $transactionable->update([
            "status"=>$status,
        ]);
    }
}
