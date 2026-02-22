<?php

namespace App\Http\Controllers\Frontend;


use App\Helper\MailHelper;
use App\Http\Controllers\Controller;
use App\Mail\SubscriptionMail;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    //

    public function subscribeNewsletter(Request $request) {
        $request->validate([
            'email' => ['required', 'email', 'max:200'],
        ]);

        $exitsSubscriber = NewsletterSubscriber::where('email', $request->email)->first();
        
        if (!empty($exitsSubscriber)) {
            if($exitsSubscriber->is_verified == 0){
                $exitsSubscriber->verified_token = Str::random(32);
                $exitsSubscriber->save();
                MailHelper::setMailConfig();
                Mail::to($exitsSubscriber->email)->send(new SubscriptionMail($exitsSubscriber));
                 return response(['status' => 'success', 'message' => 'Thanks for subscribing to our newsletter. Please check your email to verify your subscription.']);
            }else{
                return response(['status' => 'error', 'message' => 'You are already subscribed to our newsletter.']);
            }
            
        }else{
            $subscriber = new NewsletterSubscriber();
            $subscriber->email = $request->email;
            $subscriber->is_verified = 0;
            $subscriber->verified_token = Str::random(32);
            $subscriber->save();

            MailHelper::setMailConfig();

            Mail::to($subscriber->email)->send(new SubscriptionMail($subscriber));

            return response(['status' => 'success', 'message' => 'Thanks for subscribing to our newsletter. Please check your email to verify your subscription.']);
        }

    }


    public function verifyNewsletter($token) {
        $subscriber = NewsletterSubscriber::where('verified_token', $token)->first();

        if ($subscriber) {
            $subscriber->verified_token = 'verified';
            $subscriber->is_verified = 1;
            $subscriber->save();

            toastr('Your email has been verified successfully. Thanks for subscribing to our newsletter.', 'success');
            return redirect()->route('home');
        } else {
            toastr('Invalid verification token.', 'error');
            return redirect()->route('home');
        }
    }
}
