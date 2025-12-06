<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CanceledOrderDataTable;
use App\DataTables\DeliveredOrderDataTable;
use App\DataTables\DroppedOffOrderDataTable;
use App\Models\Order;
use Illuminate\Http\Request;
use App\DataTables\OrderDataTable;
use App\DataTables\OutOfDeliveryOrderDataTable;
use App\DataTables\pendingOrderDataTable;
use App\DataTables\processedOrderDataTable;
use App\DataTables\ShippedOrderDataTable;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $datatables)
    {
       return $datatables->render('admin.order.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function pendingOrder(pendingOrderDataTable $datatables)
    {
        return $datatables->render('admin.order.pending-order');
    }

    public function processedOrder(processedOrderDataTable $datatables)
    {
        return $datatables->render('admin.order.processed-order');
    }

    public function droppedOffOrder(DroppedOffOrderDataTable $datatables)
    {
        return $datatables->render('admin.order.dropped-off-order');
    }

    public function shippedOrder(ShippedOrderDataTable $datatables)
    {
        return $datatables->render('admin.order.shipped-order');
    }

    public function outForDeliveryOrder(OutOfDeliveryOrderDataTable $datatables)
    {
        return $datatables->render('admin.order.out-for-delivery-order');
    }

    public function deliveredOrder(DeliveredOrderDataTable $datatables)
    {
        return $datatables->render('admin.order.delivered-order');
    }

    public function canceledOrder(CanceledOrderDataTable $datatables)
    {
        return $datatables->render('admin.order.canceled-order');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);

        //Delete OrderProducts
        $order->orderProduct()->delete();

        //Delete Transation
        $order->transaction()->delete();

        $order->delete();

        return response(['status' => 'success', 'message'=> 'Order Deleted Successfully']);
    }

    public function changeOrderStatus(Request $request){
        $order = Order::findOrFail($request->id);
        $order->order_status = $request->status;        
        $order->save();
        return response(['status' => 'success', 'message' => 'Order Status Updated']);
    }

    public function paymentOrderStatus(Request $request){
        $order = Order::findOrFail($request->id);
        $order->payment_status = $request->status;        
        $order->save();
        return response(['status' => 'success', 'message' => 'Payment Status Updated']);
    }
}
