<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\PaypalSetting;
use App\Http\Controllers\Controller;
use App\Models\RazorpaySetting;
use App\Models\StripeSetting;

class PaymentSettingController extends Controller
{
    
  public function index(){
    $paypal = PaypalSetting::first();
    $stripe = StripeSetting::first();
    $razorpay = RazorpaySetting::first();
     return view('admin.payment-setting.index', compact('paypal', 'stripe', 'razorpay'));
  }

 
}
