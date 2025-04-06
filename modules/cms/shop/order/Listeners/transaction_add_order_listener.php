<?php

namespace CMS\Order\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use CMS\Cart\Repository\CartRepository;
use CMS\Club\Services\ClubService;
use CMS\Marketing\Services\AffiliateService;
use CMS\Order\Models\Order;
use CMS\Product\Service\ProductService;
use CMS\Shop\Service\ShopService;
use CMS\Transaction\Models\Transaction;
use CMS\Transaction\Repository\TransactionRepository;
use CMS\Wallet\Services\WalletService;

class transaction_add_order_listener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        if($event->transaction->transactionAble instanceof Order && !$event->transaction->transactionAble->is_course ){
            TransactionRepository::updateStatus($event->transaction,Transaction::$PROCESSING);
            TransactionRepository::update_transactionAble_Status($event->transaction->transactionable,Transaction::$PROCESSING);
            //ClubService::increase($event->transaction->price,"product");
            $this->order_codes($event);
        } elseif($event->transaction instanceof Order){
            $this->order_codes($event);
        }
    }

    public function order_codes($event){
        $cart=CartRepository::get_cart();
        if($cart) {
            $cart_products = ProductService::get_cart_products($cart);
            $affiliate_price=AffiliateService::calculate_affiliate_percent($cart_products);
            AffiliateService::affiliate_update_amount($affiliate_price);
            ProductService::if_product_in_stock_decrease_stock_number($cart_products, $cart);
        }

        ShopService::clear_cart();
    }
}
