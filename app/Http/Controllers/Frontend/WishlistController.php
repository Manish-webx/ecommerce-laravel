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
        $wishlistProducts = Wishlist::with('product')->where('user_id', Auth::user()->id)->get();
        return view('frontend.pages.wishlist', compact('wishlistProducts'));
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

        $count = Wishlist::where('user_id', Auth::user()->id)->count();

        return response(['status' => 'success', 'message' => 'Product Added to Wishlist', 'count' => $count]);
    }

    public function removeWishlistProduct($id){
        $wishlist = Wishlist::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();

        if($wishlist->user_id != Auth::user()->id){
            toastr('Unauthorized Action', 'error', 'Error');
            return redirect()->back();
        }

        if($wishlist){
            $wishlist->delete();
            toastr('Product removed from wishlist', 'success', 'Success');
            return redirect()->back();
        }else{
            toastr('Wishlist item not found', 'error', 'Error');
            return redirect()->back();
        }
    }
}
