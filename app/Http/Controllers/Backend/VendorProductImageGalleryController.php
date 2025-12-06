<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use App\Models\ProductImageGallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\DataTables\VendorProductImageGalleryDataTable;

class VendorProductImageGalleryController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, VendorProductImageGalleryDataTable $dataTable)
    {
        $product = Product::findOrFail($request->product);
        if($product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }
        return $dataTable->render('vendor.product.image-gallery.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image.*' => ['required', 'image', 'max:3000'],
            'product' => ['required'],
          ]);
   
          $imagePaths = $this->imageMultipleUpload($request, 'image', 'upload');
   
          foreach($imagePaths as $path){
             $productImage = new ProductImageGallery();
             $productImage->image = $path;
             $productImage->product_id = $request->product;
             $productImage->save();
          }
   
          toastr('Images Uploaded', 'success');
   
          return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $products = ProductImageGallery::findOrFail($id);

        if($products->product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }
        if(File::exists($products->banner)){
            File::delete($products->banner);
        }
        $products->delete();

        return response(['status' => 'success', 'message' => 'Image Deleted Successfully']);
    }
}
