<?php

namespace App\Http\Controllers\Frontend;

use Cart;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductVariantItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
        
    public function addToCart(Request $request) {
        
        $product = Product::findOrFail($request->product_id);

        if($product->qty === 0){
            return response(['status' => 'error', 'message' => 'Stock Out']);
        }else if($product->qty < $request->qty){
            return response(['status' => 'error', 'message' => 'Product not available in this much quantity']);
        }

        $variants = [];
        $variantsTotalPrice = 0;
        
        if($request->has('variants_items')){
            foreach($request->variants_items as $item_id){
                $variantItem = ProductVariantItem::find($item_id);
                $variants[$variantItem->ProductVariant->name]['name'] = $variantItem->name;
                $variants[$variantItem->ProductVariant->name]['price'] = $variantItem->price;
                $variantsTotalPrice += $variantItem->price;
            }
        }        

        $productPrice = 0;

        if(checkDiscount($product)){
            $productPrice = $product->offer_price;
        }else{
            $productPrice = $product->price;
        }

        $cartData = [];
        $cartData['id'] = $product->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = $request->qty;
        $cartData['price'] = $productPrice;
        $cartData['weight'] = 10;
        $cartData['options']['variants'] = $variants;
        $cartData['options']['variants_total'] = $variantsTotalPrice;
        $cartData['options']['slug'] = $product->slug;
        $cartData['options']['image'] = $product->thumb_img;

        Cart::add($cartData);

        return response(['status' => 'success', 'message' => 'Product Added to Cart']);

    }


    public function cartDetails(){

        $cartItems = Cart::content();
        if(count($cartItems) == 0){
            Session::forget('coupon');
        }
        return view('frontend.pages.cart-detail', compact('cartItems'));

    }


    public function updateProductQty(Request $request){

        $productId = Cart::get($request->rowId)->id;
        $product = Product::findOrFail($productId);

        if($product->qty === 0){
            return response(['status' => 'error', 'message' => 'Stock Out']);
        }elseif($product->qty < $request->quantity){
            return response(['status' => 'error', 'message' => 'Product not available in this much quantity']);
        }

        Cart::update($request->rowId, $request->quantity);
        $productTotal = $this->getProductTotal($request->rowId);
        return response(['status' => 'success', 'message' => 'Quantity Updated Successfully', 'product_total' => $productTotal]);

    }

    public function getProductTotal($rowId){

       $product = Cart::get($rowId);
       $total = ($product->price + $product->options->variants_total) * $product->qty;
       return $total;

    }

    public function sidebarProductTotal(){

       $total = 0;
       foreach(Cart::content() as $product){
         $total += $this->getProductTotal($product->rowId);
       }

       return $total;

    }

    public function clearCart(){

        Cart::destroy();
        return response(['status' => 'success', 'message' => 'Cart is clear']);

    }

    public function removeProduct($rowId){

        Cart::remove($rowId); 
        toastr('Product remove successfully!', 'success','Success');       
        return redirect()->back();

    }

    public function cartCount(){

       return Cart::content()->count();

    }

    public function getCartProducts(){
        return Cart::content();
    }

    public function removeSidebarProduct(Request $request){

        Cart::remove($request->rowId);        
        return response(['status' => 'success', 'message' => 'Product deleted']);

    }

    // Apply Coupon

    public function applyCoupon(Request $request){
        if($request->coupon === null){
            return response(['status' => 'error', 'message' => 'Coupon filled cannot be null']);
        }

        $coupon = Coupon::where('code', $request->coupon)->where('status', 1)->first();

        if($coupon === null){
           return response(['status' => 'error', 'message' => 'Coupon does not exists']); 
        }elseif($coupon->start_date > date('Y-m-d')){
           return response(['status' => 'error', 'message' => 'Coupon does not exists']); 
        }elseif($coupon->end_date < date('Y-m-d')){
           return response(['status' => 'error', 'message' => 'Coupon does not exists']); 
        }elseif($coupon->total_used >= $coupon->quantity){
           return response(['status' => 'error', 'message' => 'You can apply this coupon now. Limit is over']); 
        }

        if($coupon->discount_type == 'Percent'){
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => $coupon->discount_type,
                'discount' => $coupon->discount,
            ]);
        }elseif($coupon->discount_type == 'Amount'){
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => $coupon->discount_type,
                'discount' => $coupon->discount,
            ]);
        }         
        
        return response(['status' => 'success', 'message' => 'Coupon applied successfully!']);

    }


    public function calculateCoupon(){

        if(Session::has('coupon')){
            $coupon = Session::get('coupon');
            $subtotal = sidebarProductTotal();

            if($coupon['discount_type'] === 'Amount'){
                $total = $subtotal - $coupon['discount'];
                return response(['status' => 'success', 'total' => $total, 'discount' => $coupon['discount']]);
            }elseif($coupon['discount_type'] === 'Percent'){
                $discount = ($subtotal * $coupon['discount']) / 100; 
                $total = $subtotal - $discount;
                return response(['status' => 'success', 'total' => $total, 'discount' => $discount]);
            }
        }else{
            $total = sidebarProductTotal();
            return response(['status' => 'success', 'total' => $total, 'discount' => 0]);
        }

    }

}
