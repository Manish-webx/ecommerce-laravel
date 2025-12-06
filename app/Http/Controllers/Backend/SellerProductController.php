<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SellerPendingProductsDataTable;
use App\DataTables\SellerProductsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SellerProductController extends Controller
{
    
    public function index(SellerProductsDataTable $datatables){
        return $datatables->render('admin.product.seller-product.index');
    }

    public function pending(SellerPendingProductsDataTable $datatables){
        return $datatables->render('admin.product.seller-pending-product.index');
    }

    public function changeApprovedStatus(Request $request){

        $product = Product::findOrFail($request->id);
        $product->is_approved = $request->value;

        $product->save();

        return response(['message' => 'Approved Status Updated']); 


    }

}
