<?php

namespace CMS\Transaction\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CMS\Cart\Repository\CartRepository;
use CMS\Product\Service\ProductService;
use CMS\Shop\Service\ShopService;
use CMS\Transaction\Events\TransactionSucceed;
use CMS\Transaction\Models\Transaction;
use CMS\Transaction\Repository\TransactionRepository;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Payment\Facade\Payment;


class TransactionController extends Controller
{
    public function verify(Request $request){
        if(isset($request->trans_id)){
            $transaction_id=$request->trans_id;
        }
        if(isset($request->Authority)){
            $transaction_id=$request->Authority;
        }
        $transaction=TransactionRepository::find_by_transaction_id($transaction_id);

        try {
            $receipt = Payment::via($transaction->gateway)->amount((integer) $transaction->price)->transactionId($transaction_id)->verify();

            TransactionRepository::updateErrorText($transaction," ");
            event(new TransactionSucceed($transaction));
            return ShopService::transaction_succeed_redirection($transaction->transactionable);
        } catch (InvalidPaymentException $exception) {
            TransactionRepository::updateStatus($transaction,Transaction::$FAILED);
            TransactionRepository::updateErrorText($transaction,$exception->getMessage());

            TransactionRepository::update_transactionAble_Status($transaction->transactionable,Transaction::$FAILED);


            return ShopService::transaction_error_redirection($transaction->transactionable,$exception->getMessage());

        }
    }

}
