<?php

namespace App\Http\Controllers;


use App\Models\Log;

class LogController extends Controller
{
    public function index()
    {

        $logs = Log::orderByDesc('created_at')->paginate(20);
        return view('admin.logs.index', compact('logs'));
    }

    public function destroy($id)
    {
        Log::destroy($id);
        return back()->with('success', 'با موفقیت حذف شد');
    }

}
