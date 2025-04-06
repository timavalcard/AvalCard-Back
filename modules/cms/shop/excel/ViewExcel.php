<?php


namespace CMS\Shop\excel;


use Illuminate\Contracts\View\View;
use CMS\Transaction\Repository\TransactionRepository;
use Maatwebsite\Excel\Concerns\FromView;

class ViewExcel implements FromView
{

    public function view(): View
    {
        $transactions=TransactionRepository::get_transactions_by_type("order",false);

        return view('Shop::Admin.transactions_excel', [
            'transactions' => $transactions
        ]);
    }
}
