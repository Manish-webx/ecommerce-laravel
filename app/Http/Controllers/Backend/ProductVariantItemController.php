<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantItemController extends Controller
{
    
    public function index(ProductVariantItemDataTable $dataTables, $productId, $variantId)
    {
        $variant = ProductVariant::findOrFail($variantId);
        $product = Product::findOrFail($productId);
        return $dataTables->render('admin.product.product-variant-item.index', compact('variant', 'product'));
    }

    public function create(string $productId, string $variantId){
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);
        return view('admin.product.product-variant-item.create', compact('variant', 'product'));
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

        return redirect()->route('admin.products-variant-items.index', ['productId' => $request->product_id, 'variantId' => $request->variant_id]);

    }

    public function edit(string $variantItemId){       

        $variantItem = ProductVariantItem::findOrFail($variantItemId);
        return view('admin.product.product-variant-item.edit', compact('variantItem'));

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

        return redirect()->route('admin.products-variant-items.index', ['productId' => $variant_item->ProductVariant->product_id, 'variantId' => $variant_item->product_variant_id]);

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
