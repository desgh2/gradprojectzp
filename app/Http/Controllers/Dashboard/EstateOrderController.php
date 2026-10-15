<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EstateOrder;

class EstateOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.estate.order.index', [
            'rows' => EstateOrder::latest()->paginate(10),
            'statuses' => EstateOrder::$statuses,
        ]);
    }

    /**
     * Update status.
     *
     * @param  object  $order
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request, EstateOrder $order)
    {
        $order->update([
            'status' => $request->status,
        ]);
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Статус звернення успішно оновлено',
            'class'   => 'success'
        ]);
        return back();
    }

}
