<?php

use Illuminate\Support\Facades\Session;

function setActive($route){
    if(is_array($route)){
        foreach($route as $r){
            if(request()->routeIs($r)){
                return 'active';
            }
        }
    }
}

// Check Discount is available 

function checkDiscount($product){
    $currentDate = date('Y-m-d');

    if($product->offer_price > 0 && $currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date){
        return true;
    }

    return false;
}


// Check Discount Percentage

function calculateDiscountPercent($originalPrice, $discountPrice){
    $discountAmount = $originalPrice  -  $discountPrice;
    $discountPercent = ($discountAmount / $originalPrice ) * 100;

    return $discountPercent;
}

// Product Type

function productType(string $type){
    
   switch ($type) {
    case 'new_arrival';
    return "New";

    case 'best_product';
    return "Best";

    case 'top_product';
    return "Top";

    case 'featured';
    return "Featured";

    default:
    return "";
   }

}

function sidebarProductTotal(){
    $total = 0;
    foreach(\Cart::content() as $product){
        $total += ($product->price + $product->options->variants_total) * $product->qty;
    }

    return $total;
}

function getMainCartTotal(){

    if(Session::has('coupon')){
        $coupon = Session::get('coupon');
        $subtotal = sidebarProductTotal();

        if($coupon['discount_type'] === 'Amount'){
            $total = $subtotal - $coupon['discount'];
            return $total;
        }elseif($coupon['discount_type'] === 'Percent'){
            $discount = ($subtotal * $coupon['discount']) / 100; 
            $total = $subtotal - $discount;
            return $total;
        }

    }else{
        return sidebarProductTotal();
    }

}

function getCartDiscount(){

    if(Session::has('coupon')){
        $coupon = Session::get('coupon');
        $subtotal = sidebarProductTotal();

        if($coupon['discount_type'] === 'Amount'){            
            return  $coupon['discount'];
        }elseif($coupon['discount_type'] === 'Percent'){
            $discount = ($subtotal * $coupon['discount']) / 100; 
            return $discount;
        }

    }else{
        return 0;
    }

}

function shippingCharge(){
    if(Session::has('shipping_method')){
        return Session::get('shipping_method')['cost'];
    }else{
        return 0;
    }
}

function getPayableAmount(){
    return getMainCartTotal() + shippingCharge();
}

function textlimit($text, $limit = 20){
    return \Str::limit($text, $limit);
}
