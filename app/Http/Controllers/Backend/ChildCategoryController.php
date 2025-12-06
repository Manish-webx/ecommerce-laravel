<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Http\Controllers\Controller;
use App\DataTables\ChildCategoryDataTable;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.childcategory.index');    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.childcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => ['required'],
            'sub_category' => ['required'],
            'name' => ['required', 'unique:child_categories,name'],
            'status' => ['required']
          ]);

          $childcategory = new ChildCategory();
          $childcategory->category_id = $request->category;
          $childcategory->sub_category_id = $request->sub_category;
          $childcategory->name = $request->name;
          $childcategory->slug = Str::slug($request->name);
          $childcategory->status = $request->status;

          $childcategory->save();

          toastr('Child Category Created Successfully', 'success');

          return redirect()->route('admin.child-category.index');
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
        $childcategory = ChildCategory::findOrFail($id);
        $subcategories = SubCategory::where('category_id', $childcategory->category_id)->get();
        return view('admin.childcategory.edit', compact('categories', 'childcategory', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            'category' => ['required'],
            'sub_category' => ['required'],
            'name' => ['required', 'unique:child_categories,name,'.$id],
            'status' => ['required']
          ]);

          $childcategory = ChildCategory::findOrFail($id);
          $childcategory->category_id = $request->category;
          $childcategory->sub_category_id = $request->sub_category;
          $childcategory->name = $request->name;
          $childcategory->slug = Str::slug($request->name);
          $childcategory->status = $request->status;

          $childcategory->save();

          toastr('Child Category Updated Successfully', 'success');

          return redirect()->route('admin.child-category.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $childcategory = ChildCategory::findOrFail($id);
        $childcategory->delete();

        return response(['status' => 'success', 'message' => 'Child Category Deleted Successfully']); 


    }

    public function getSubCategories(Request $request){
       
          $subcategory = SubCategory::where('category_id', $request->id)->where('status', '1')->get();
          return $subcategory;

    }

    public function changeStatus(Request $request){

        $childcategory = ChildCategory::findOrFail($request->id);
        $childcategory->status = $request->status == 'true' ? '1' : '0';

        $childcategory->save();

        return response(['message' => 'Status Updated Successfully']);

    }
}
