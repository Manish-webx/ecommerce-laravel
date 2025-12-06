<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\SubCategoryDataTable;
use App\Models\ChildCategory;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.subcategory.index');    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
          $request->validate([
            'category' => ['required'],
            'name' => ['required', 'unique:sub_categories,name'],
            'status' => ['required']
          ]);

          $subcategory = new SubCategory();
          $subcategory->category_id = $request->category;
          $subcategory->name = $request->name;
          $subcategory->slug = Str::slug($request->name);
          $subcategory->status = $request->status;

          $subcategory->save();

          toastr('Sub Category Created Successfully', 'success');

          return redirect()->route('admin.sub-category.index');

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
        
        $categories = Category::all();
        $subcategory = SubCategory::findOrFail($id);
        return view('admin.subcategory.edit', compact('categories', 'subcategory'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category' => ['required'],
            'name' => ['required', 'unique:categories,name,'.$id],
            'status' => ['required']
          ]);

          $subcategory = SubCategory::findOrFail($id);
          $subcategory->category_id = $request->category;
          $subcategory->name = $request->name;
          $subcategory->slug = Str::slug($request->name);
          $subcategory->status = $request->status;

          $subcategory->save();

          toastr('Sub Category Created Successfully', 'success');

          return redirect()->route('admin.sub-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = SubCategory::findOrFail($id);
       // $subcategory->delete();

        $childcategory = ChildCategory::where('sub_category_id', $subcategory->id)->count();
        if($childcategory > 0){
            return response(['status' => 'error', 'message' => 'This sub category contain sub category, Please delete the child category first']); 
        }
        $subcategory->delete();

        return response(['status' => 'success', 'message' => 'Category Deleted Successfully']); 
    }

    public function changeStatus(Request $request){

        $subcategory = SubCategory::findOrFail($request->id);
        $subcategory->status = $request->status == 'true' ? '1' : '0';

        $subcategory->save();
               
        return response(['message' => 'Sub Category Status Updated']); 

    }
}
