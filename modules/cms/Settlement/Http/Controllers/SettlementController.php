<?php

namespace CMS\Settlement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CMS\Settlement\Http\Requests\settlement_edit_request;
use CMS\Settlement\Http\Requests\settlement_store_request;
use CMS\Settlement\Models\Settlement;
use CMS\Settlement\Repositories\SettlementRepo;
use CMS\Settlement\Services\SettlementService;


class SettlementController extends Controller
{
    private $settlementRepo;

    public function __construct(SettlementRepo $settlementRepo)
    {
        $this->settlementRepo = $settlementRepo;
    }

    public function index(Request $request)
    {
        $this->authorize('index', Settlement::class);
        $settlements = $this->settlementRepo->list($request,['user']);
        return view('Settlement::Admin.Settlement.list_settlement', compact('settlements'));
    }

    public function create()
    {
        $this->authorize('create', Settlement::class);
        if ($this->settlementRepo->getLatestPendingSettlement()) {
            return redirect()->route('settlement.index')->with('status', 'CanNotSetNewSettlementRequest');
        }
        return view('Settlement::Admin.Settlement.create_settlement');
    }

    public function store(settlement_store_request $request)
    {
        if ($this->settlementRepo->getLatestPendingSettlement()) {
            toastMessage("شما در حال حاظر یک درخواست تسویه فرستاده اید");
            return back();
        }
        SettlementService::store($request);
        toastMessage("درخواست تسویه شما ایجاد و ارسال شد.");
        return  back();
    }

    public function edit($settlementID)
    {
        $this->authorize('edit', Settlement::class);
        $settlement = $this->settlementRepo->find($settlementID);
        $lastSettlement = $this->settlementRepo->getLatestSettlement($settlement->user_id);
        if ($lastSettlement->id != $settlementID) {
            return redirect()->route('settlement.index')->with('status', 'CanNotEditSettlementRequest');
        }
        return view('Settlement::Admin.Settlement.edit_settlement', compact('settlement'));
    }

    public function update(settlement_edit_request $request, $settlementID)
    {
        $this->authorize('edit', Settlement::class);
        SettlementService::update($request, $settlementID);
        return redirect()->route('settlement.index')->with('status', 'updated');
    }

}
