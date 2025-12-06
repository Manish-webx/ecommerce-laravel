<?php

namespace App\Http\Controllers\Frontend;

use App\Models\FlashSale;
use Illuminate\Http\Request;
use App\Models\FlashSaleItem;
use App\Http\Controllers\Controller;

class FlashSaleController extends Controller
{
    
    public function index(){
        $flashSale = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('status', 1)->orderBy('id', 'ASC')->paginate(10);
        return view('frontend.pages.flash-sale',compact('flashSale', 'flashSaleItems'));
    }

   

}
