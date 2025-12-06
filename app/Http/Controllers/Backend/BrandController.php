<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
 
    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $dataTables)
    {
        return $dataTables->render('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo' => ['required', 'image' , 'max:2048'],
            'name' => ['required'],
            'is_featured' => ['required'],
            'status' => ['required']
        ]);

        $logoPath = $this->imageUpload($request, 'logo', 'uploads');

        $brand = new Brand();
        $brand->logo = $logoPath;
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;
        $brand->save();

        toastr('Brand Created Successfully', 'success');

        return redirect()->route('admin.brand.index');


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
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            'logo' => ['image' , 'max:2048'],
            'name' => ['required'],
            'is_featured' => ['required'],
            'status' => ['required']
        ]);

        $brand = Brand::findOrFail($id);
        if($request->logo){
            $logoPath = $this->imageUpload($request, 'logo', 'uploads');
        }else{
            $logoPath = $brand->logo;
        }
        $brand->logo = $logoPath;
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;
        $brand->save();

        toastr('Brand Updated Successfully', 'success');

        return redirect()->route('admin.brand.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findorFail($id);
        if(File::exists($brand->banner)){
            File::delete($brand->banner);
        }
        $brand->delete();

        return response(['status' => 'success', 'message' => 'Brand Deleted Successfully']);
    }

    public function changeStatus (Request $request){


        $brand = Brand::findOrFail($request->id);
        $brand->status = $request->status == 'true' ? 1 : 0;
        $brand->save();

        return response(['message' => 'Brand Status Updated']); 
    }
}
