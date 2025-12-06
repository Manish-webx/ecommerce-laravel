<?php

namespace App\Http\Controllers\Frontend;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Order;
use Razorpay\Api\Api;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\PaypalSetting;
use App\Models\StripeSetting;
use App\Models\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Models\RazorpaySetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    public function payment(){
        if(!Session::has('address')){
            return redirect('user.checkout');
        }
        return view('frontend.pages.payment');
    }

    public function paymentSuccess(){
        return view('frontend.pages.payment-success');
    }

    public function storeOrder($paymentMethod, $paymentStatus, $paidCurrencyName, $paidAmount, $transactionId){

       $settings = GeneralSetting::first();

       $order = new Order();
       $order->invoice_id = rand(1, 999999);
       $order->user_id = Auth::user()->id;
       $order->sub_total = sidebarProductTotal();
       $order->amount = getPayableAmount();
       $order->currency_name = $settings->currency_name;
       $order->currency_icon = $settings->currency_icon;
       $order->product_qty = \Cart::content()->count();
       $order->payment_method = $paymentMethod;
       $order->payment_status = $paymentStatus;
       $order->order_address = json_encode(Session::get('address'));
       $order->shipping_method = json_encode(Session::get('shipping_method'));
       $order->coupon = json_encode(Session::get('coupon'));
       $order->order_status = 'pending';
       $order->save();

       // Store ordered products

       foreach(\Cart::content() as $item){

           $product = Product::find($item->id);
           $orderProduct = new OrderProduct();
           $orderProduct->order_id = $order->id;
           $orderProduct->product_id = $product->id;
           $orderProduct->vendor_id = $product->vendor_id;
           $orderProduct->product_name = $product->name;
           $orderProduct->variants = json_encode($item->options->variants);
           $orderProduct->variant_total = json_encode($item->options->variants_total);
           $orderProduct->unit_price = $item->price;
           $orderProduct->qty = $item->qty;
           $orderProduct->save();

       }

       // store transcation details
       $transaction = new Transaction();
       $transaction->order_id = $order->id;
       $transaction->transaction_id = $transactionId;
       $transaction->payment_method = $paymentMethod;
       $transaction->amount = getPayableAmount();
       $transaction->amount_real_currency = $paidAmount;
       $transaction->amount_real_currency_name	= $paidCurrencyName;
       $transaction->save();
       

    }

    public function paypalConfig() {

        $paypal = PaypalSetting::first();
        $config =  [
            'mode'    => $paypal->mode === 1 ? 'live' : 'sandbox',
            'sandbox' => [
                'client_id'         => $paypal->client_id,
                'client_secret'     => $paypal->secret_key,
                'app_id'            => '',
            ],
            'live' => [
                'client_id'         => $paypal->client_id,
                'client_secret'     => $paypal->secret_key,
                'app_id'            => '',
            ],

            'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
            'currency'       => $paypal->currency_name,
            'notify_url'     => '', // Change this accordingly for your application.
            'locale'         => 'en_US', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
            'validate_ssl'   => true, // Validate SSL when creating api client.
        ];

        return $config;

    }

    public function clearSession(){
        \Cart::destroy();
        Session::forget('address');
        Session::forget('coupon');
        Session::forget('shipping_method');
    }

    public function payWithPaypal(){

        $config = $this->paypalConfig();    
        $paypal = PaypalSetting::first();
        $provider = new PayPalClient($config);
      //  $provider->setApiCredentials($config);

        $provider->getAccessToken();        
        
        $payableAmount = round(getPayableAmount() * $paypal->currency_rate, 2);

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('user.paypal.success'),
                "cancel_url" => route('user.paypal.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => $paypal->currency_name,
                        "value" => $payableAmount
                    ]
                ]
            ]
        ]);

        if(isset($response['id']) && $response['id'] != null ){
            foreach($response['links'] as $link){
                if($link['rel'] === 'approve'){
                   return redirect()->away($link['href']);
                }
            }
        }else{
            return redirect(route('user.paypal.cancel'));
        }

    }

    public function paypalSuccess(Request $request){
        
        $config = $this->paypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken(); 

        $response = $provider->capturePaymentOrder($request->token);

        if(isset($response['status']) && $response['status'] == 'COMPLETED'){
            //calculate payable amount
            $paypal = PaypalSetting::first();
            $payableAmount = round(getPayableAmount() * $paypal->currency_rate, 2);
            $this->storeOrder('paypal', 1, $paypal->currency_name, $payableAmount, $response['id']);
            $this->clearSession();
            return redirect()->route('user.payment-success');
        }

        return redirect()->route('user.paypal.cancel');

    }


    public function paypalCancel(){
        toastr('Something went wrong, try again later', 'error', 'Err');
        return redirect()->route('user.payment');
    }


    public function payWithStripe(Request $request){
        
        $stripeSetting = StripeSetting::first();
        $payableAmount = round(getPayableAmount() * $stripeSetting->currency_rate, 2);

        // Stripe::setApiKey($stripeSetting->secret_key);
        // $response = Charge::create ([
        //         "amount" => $payableAmount * 100,
        //         "currency" => $stripeSetting->currency_name,
        //         "source" => $request->stripe_token,
        //         "description" => "Test payment from done" 
        // ]);
                
        // dd($response);

    }

    public function payWithRazorpay(Request $request){

        $razorpaySetting = RazorpaySetting::first();
        $api = new Api($razorpaySetting->razorpay_key, $razorpaySetting->razorpay_secret_key); 
        $payableAmount = round(getPayableAmount() * $razorpaySetting->currency_rate, 2);
        $finalPayable = $payableAmount*100;
        if($request->has('razorpay_payment_id')  && $request->filled('razorpay_payment_id')){
            try{
                $response = $api->payment->fetch($request->razorpay_payment_id)->capture(['amount'=>$finalPayable]); 
            }catch (\Exception $e) {
                toastr($e->getMessage(),'error', 'Error');
                return redirect()->back();
            }

            if($response['status'] == 'captured'){  
            
                $this->storeOrder('razorpay', 1, $razorpaySetting->currency_name, $payableAmount, $response['id']);
                $this->clearSession();
                return redirect()->route('user.payment-success');
              
            }
  
        }

    }

}
