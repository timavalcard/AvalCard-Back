<?php


namespace CMS\Wallet\excel;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use CMS\Transaction\Repository\TransactionRepository;
use CMS\Payment\Repositories\PaymentRepo;

class ViewExcel implements FromView
{

    public function view(): View
    {
        $transactions=TransactionRepository::get_transactions_by_type("wallet",false);

        return view('Wallet::Admin.transactions_excel', [
            'transactions' => $transactions
        ]);
    }
}
