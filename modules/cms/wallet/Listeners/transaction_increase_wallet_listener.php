<?php

namespace CMS\Wallet\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use CMS\Transaction\Models\Transaction;
use CMS\Transaction\Repository\TransactionRepository;
use CMS\Wallet\Models\Wallet;
use CMS\Wallet\Repository\WalletRepository;

class transaction_increase_wallet_listener
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

        $wallet=$event->transaction->transactionAble;
        if($wallet instanceof Wallet){
            TransactionRepository::updateStatus($event->transaction,Transaction::$COMPLETED);
            TransactionRepository::update_transactionAble_Status($event->transaction->transactionable,Transaction::$COMPLETED);
           WalletRepository::increase($event->transaction->price);

        }
    }
}
