<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FlashSaleItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    
    public function index(FlashSaleItemDataTable $datatables){

        $flashSale = FlashSale::first();
        $products = Product::where('is_approved', 1)->where('status', 1)->orderBy('id', 'DESC')->get();
        return $datatables->render('admin.product.flash-sale.index', compact('flashSale', 'products'));
    }

    public function update(Request $request){
       
        $request->validate([
            'end_date' => ['required']
        ]);

        FlashSale::updateOrCreate(
            ['id' => 2],
            ['end_date' => $request->end_date]
        );

        toastr('Updated Successfully', 'success');

        return redirect()->route('admin.flash-sale.index');

    }

    public function addProduct(Request $request){
        $request->validate([
            'product' => ['required', 'unique:flash_sale_items,product_id'],
            'show_at_home' => ['required'],
            'status' => ['required'],
        ],[
           'product.unique' => 'This Product is Already Added',
        ]);

        $flashSaleDate = FlashSale::first();

        $flashSaleItem = new FlashSaleItem();
        $flashSaleItem->product_id = $request->product;
        $flashSaleItem->flash_sale_id = $flashSaleDate->id;
        $flashSaleItem->show_at_home = $request->show_at_home;
        $flashSaleItem->status = $request->status;
        $flashSaleItem->save();

        toastr('Product Added Successfully', 'success');

        return redirect()->back();

    }

    public function showAtHomeStatus(Request $request){
        $flashSaleItem = FlashSaleItem::findOrFail($request->id);
        $flashSaleItem->show_at_home = $request->status == "true" ? 1 : 0;
        $flashSaleItem->save();

        return response(['message' => 'Status Updated Successfully']);
    }

    public function changeStatus(Request $request){
        $flashSaleItem = FlashSaleItem::findOrFail($request->id);
        $flashSaleItem->status = $request->status == "true" ? 1 : 0;
        $flashSaleItem->save();

        return response(['message' => 'Status Updated Successfully']);
    }

    public function destroy(string $id){

        $flashSaleItem = FlashSaleItem::findOrFail($id);
        $flashSaleItem->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully']);
        

    }


}
