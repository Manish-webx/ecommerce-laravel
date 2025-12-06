<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ChildCategory;
use App\Models\SubCategory;

class FrontendProductController extends Controller
{
    public function showProduct(string $slug){
        $product = Product::with(['brand', 'variants', 'productImageGalleries', 'category', 'vendor'])->where('slug', $slug)->where('status', 1)->first();
        return view('frontend.pages.product-detail', compact('product'));
    }

    public function productsIndex(Request $request){

        if($request->has('category')){
            $category = Category::where('slug', $request->category)->first();
            $products = Product::where([
                'category_id' => $category->id,
                'is_approved' => 1,
                'status' => 1])->paginate(12);
        }elseif($request->has('subcategory')){
            $category = SubCategory::where('slug', $request->subcategory)->first();
            $products = Product::where([
                'sub_category_id' => $category->id,
                'is_approved' => 1,
                'status' => 1])->paginate(1);
        }elseif($request->has('childcategory')){
            $category = ChildCategory::where('slug', $request->childcategory)->first();
            $products = Product::where([
                'child_category_id' => $category->id,
                'is_approved' => 1,
                'status' => 1])->paginate(1);
        }

        return view('frontend.pages.product', compact('products'));
    }

    public function viewListType(Request $request){
        $view_type = $request->view_type;
       session()->put('product_view_type', $view_type);
       
       

    }


}
