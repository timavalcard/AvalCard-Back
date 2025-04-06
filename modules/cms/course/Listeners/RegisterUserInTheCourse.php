<?php

namespace CMS\Course\Listeners;

use CMS\Cart\Repository\CartRepository;
use CMS\Course\Models\Course;
use CMS\Course\Repositories\CourseRepo;
use CMS\Order\Models\Order;
use CMS\Shop\Service\ShopService;
use CMS\Transaction\Models\Transaction;
use CMS\Transaction\Repository\TransactionRepository;
use CMS\Wallet\Services\WalletService;

class RegisterUserInTheCourse
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        if($event->transaction->transactionAble instanceof Order && $event->transaction->transactionAble->is_course ){
            TransactionRepository::updateStatus($event->transaction,Transaction::$PROCESSING);
            TransactionRepository::update_transactionAble_Status($event->transaction->transactionable,Transaction::$PROCESSING);
            $this->order_codes($event);
        } elseif($event->transaction instanceof Order && $event->transaction->is_course){
            $this->order_codes($event);
        }
    }

    public function order_codes($event){
        $total_price=ShopService::get_order_total_price(false);
        $wallet_decreased=(integer) WalletService::decreasing_wallet_amount($total_price,false);
        $cart=CartRepository::course_get_cart();

        CourseRepo::add_courses_and_lessons_to_user($cart,$event->transaction->transactionable->user_id);

        session()->forget("course_cart");
        if($user_cart=auth()->user()->course_cart()){
            $user_cart->delete();
        }
        if($wallet_decreased){
            WalletService::clear_using_wallet($wallet_decreased);
        }

    }
}
