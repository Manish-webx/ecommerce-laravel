<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Traits\ImageUploadTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class VendorShopProfileController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Vendor::where('user_id', Auth::user()->id)->first();
        return view('vendor.shop-profile.index', compact('profile'));
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
            'banner' => ['nullable', 'image', 'max:3000'],
            'shop_name' => ['required'],
            'phone' => ['required'],
            'email' => ['required', 'email'],
            'address' => ['required'],
            'description' => ['required'],
            'fb_link' => ['nullable','url'],
            'tw_link' => ['nullable','url'],
            'insta_link' => ['nullable','url'],
           ]);
    
            $id = Auth::user()->id;
            $vendor = Vendor::where('user_id', $id)->first();
            if($request->banner){
                if(File::exists($vendor->banner)){
                    File::delete($vendor->banner);
                }
                $imgPath = $this->imageUpload($request, 'banner', 'uploads');
            }else{
                $imgPath = $vendor->banner;
            }
            
    
            $vendor->banner = $imgPath;
            $vendor->shop_name = $request->shop_name;
            $vendor->phone = $request->phone;
            $vendor->email = $request->email;
            $vendor->address = $request->address;
            $vendor->description = $request->description;
            $vendor->fb_link = $request->fb_link;
            $vendor->tw_link = $request->tw_link;
            $vendor->insta_link = $request->insta_link;
    
            $vendor->save();
    
            toastr('Vendor Profile Updated', 'success');
    
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
        //
    }
}
