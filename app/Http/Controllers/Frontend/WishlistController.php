<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function wishlistIndex()
    {
        return view('frontend.pages.wishlist');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addToWishlist(Request $request){

        if(!Auth::check()){
            return response(['status' => 'error', 'message' => 'You need to login first']);
        }

        $wishlistCount = Wishlist::where('product_id', $request->productId)
                            ->where('user_id', Auth::user()->id)
                            ->count();

        if($wishlistCount > 0){
            return response(['status' => 'error', 'message' => 'Product already in wishlist']);
        }

        $wishlist = new Wishlist();
        $wishlist->product_id = $request->productId;
        $wishlist->user_id = Auth::user()->id;
        $wishlist->save();

        return response(['status' => 'success', 'message' => 'Product Added to Wishlist']);
    }
}
