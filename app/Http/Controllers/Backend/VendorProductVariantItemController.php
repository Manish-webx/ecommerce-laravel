<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\DataTables\VendorProductVariantItemDataTable;

class VendorProductVariantItemController extends Controller
{
    public function index(VendorProductVariantItemDataTable $dataTables, $productId, $variantId)
    {
        $variant = ProductVariant::findOrFail($variantId);
        $product = Product::findOrFail($productId);
        if($product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }
        return $dataTables->render('vendor.product.product-variant-item.index', compact('variant', 'product'));
    }

    public function create(string $productId, string $variantId){
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);
        if($product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }
        return view('vendor.product.product-variant-item.create', compact('variant', 'product'));
    }

    public function store(Request $request){

        $request->validate([
            'variant_id' => ['required', 'integer'],
            'name' => ['required'],
            'price' => ['integer', 'required'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);

        $variant_item = new ProductVariantItem();
        $variant_item->product_variant_id = $request->variant_id;
        $variant_item->name = $request->name;
        $variant_item->price = $request->price;
        $variant_item->is_default = $request->is_default;
        $variant_item->status = $request->status;
        $variant_item->save();

        toastr('Created Successfully', 'success');

        return redirect()->route('vendor.products-variant-items.index', ['productId' => $request->product_id, 'variantId' => $request->variant_id]);

    }

    public function edit(string $variantItemId){       

        $variantItem = ProductVariantItem::findOrFail($variantItemId);
        
        return view('vendor.product.product-variant-item.edit', compact('variantItem'));

    }

    public function update(Request $request, string $variantItemId){

        $request->validate([
            'name' => ['required'],
            'price' => ['integer', 'required'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);


        $variant_item = ProductVariantItem::findOrFail($variantItemId);
        $variant_item->name = $request->name;
        $variant_item->price = $request->price;
        $variant_item->is_default = $request->is_default;
        $variant_item->status = $request->status;
        $variant_item->save();

        toastr('Updated Successfully', 'success');

        return redirect()->route('vendor.products-variant-items.index', ['productId' => $variant_item->ProductVariant->product_id, 'variantId' => $variant_item->product_variant_id]);

    }

    public function changeStatus(Request $request){

        $variant = ProductVariantItem::findOrFail($request->id);
        $variant->status = $request->status == 'true' ? 1 : 0;
        $variant->save();
        return response(['status' => 'success',  'message' => 'Variant Status Updated']); 
        
    }

    public function destroy(string $id)
    {
        $variant = ProductVariantItem::findorFail($id);
        
        $variant->delete();

        return response(['status' => 'success', 'message' => 'Variant Deleted Successfully']);
    }
}
