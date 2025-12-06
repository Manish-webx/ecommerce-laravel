<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use App\Models\ProductImageGallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\DataTables\ProductImageGalleryDataTable;

class ProductImageGalleryController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductImageGalleryDataTable $dataTables)
    {
        $product = Product::findOrFail($request->product);
        return $dataTables->render('admin.product.image-gallery.index', compact('product'));
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
        
        $product = ProductImageGallery::findOrFail($id);
        if(File::exists($product->banner)){
            File::delete($product->banner);
        }
        $product->delete();

        return response(['status' => 'success', 'message' => 'Image Deleted Successfully']);

    }
}
