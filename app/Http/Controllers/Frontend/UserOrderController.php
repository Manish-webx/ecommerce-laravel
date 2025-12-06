<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\UserOrderDataTable;
use App\Models\Order;
use App\Http\Controllers\Controller;

class UserOrderController extends Controller
{
    public function index(UserOrderDataTable $dataTables){
        return $dataTables->render('frontend.dashboard.order.index');
    }

    public function show(int $id){
        $order = Order::findOrFail($id);
        return view('frontend.dashboard.order.show', compact('order'));
    }

}
