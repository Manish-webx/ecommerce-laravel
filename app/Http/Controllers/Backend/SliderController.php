<?php

namespace App\Http\Controllers\Backend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use App\DataTables\SlidersDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
 
    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(SlidersDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'banner' => ['required', 'max:2048', 'image'],
            'type' => ['string', 'max:100'],
            'title' => ['required', 'max:200'],
            'starting_price' => ['max:200'],
            'btn_url' => ['url'],
            'serial' => ['required'],
            'status' => ['required'],
        ]);

        $slider = new Slider();

        $imageData = $this->imageUpload($request, 'banner', 'upload');
        $slider->banner = $imageData;
        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->starting_price = $request->starting_price;
        $slider->btn_url = $request->btn_url;
        $slider->serial = $request->serial;
        $slider->status = $request->status;

        $slider->save();

        toastr('Slider Created Successfully', 'success');

        return redirect()->route('admin.slider.index');

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
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
        $request->validate([
            'banner' => ['nullable', 'max:2048', 'image'],
            'type' => ['string', 'max:100'],
            'title' => ['required', 'max:200'],
            'starting_price' => ['max:200'],
            'btn_url' => ['url'],
            'serial' => ['required'],
            'status' => ['required'],
        ]);

        $slider = Slider::findorFail($id);

        if($request->banner){
            if(File::exists($slider->banner)){
                File::delete($slider->banner);
            }
            $imageData = $this->imageUpload($request, 'banner', 'upload');
        }else{
            $imageData = $slider->banner;
        }
       
        $slider->banner = $imageData;
        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->starting_price = $request->starting_price;
        $slider->btn_url = $request->btn_url;
        $slider->serial = $request->serial;
        $slider->status = $request->status;

        $slider->save();

        toastr('Slider Updated Successfully', 'success');

        return redirect()->route('admin.slider.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $slider = Slider::findorFail($id);
        if(File::exists($slider->banner)){
            File::delete($slider->banner);
        }
        $slider->delete();

        return response(['status' => 'success', 'message' => 'Slider Deleted Successfully']);

    }
}
