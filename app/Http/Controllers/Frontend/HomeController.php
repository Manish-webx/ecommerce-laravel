<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\HomepageSetting;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
   public function index(){
      $sliders = Slider::where('status', '1')->orderBy('serial', 'asc')->get();
      $flashSale = FlashSale::first();
      $flashSaleItems = FlashSaleItem::where('show_at_home', 1)->where('status', 1)->get();
      $popularCategory = HomepageSetting::where('key', 'popular_category_section')->first();
      $popularCategorySectionOne = HomepageSetting::where('key', 'popular_slider_one')->first();
      $popularCategorySectionTwo = HomepageSetting::where('key', 'popular_slider_two')->first();
      $popularCategorySectionThree = HomepageSetting::where('key', 'popular_slider_three')->first();
      $brands = Brand::where('status', 1)->where('is_featured', 1)->get();
      $typeBaseProduct = $this->getTypeBaseProduct();
      return view('frontend.home.home', compact('sliders', 'flashSale', 'flashSaleItems', 'popularCategory','brands', 'typeBaseProduct', 'popularCategorySectionOne', 'popularCategorySectionTwo', 'popularCategorySectionThree'));
   }


   public function getTypeBaseProduct(){

     $typeBaseProduct = [];

     $typeBaseProduct['new_arrival'] = Product::where(['product_type' => 'new_arrival', 'is_approved' => 1, 'status' => 1])->get();
     $typeBaseProduct['featured'] = Product::where(['product_type' => 'featured', 'is_approved' => 1, 'status' => 1])->get();
     $typeBaseProduct['top_product'] = Product::where(['product_type' => 'top_product', 'is_approved' => 1, 'status' => 1])->get();
     $typeBaseProduct['best_product'] = Product::where(['product_type' => 'best_product', 'is_approved' => 1, 'status' => 1])->get();

     return $typeBaseProduct;

   }

}
