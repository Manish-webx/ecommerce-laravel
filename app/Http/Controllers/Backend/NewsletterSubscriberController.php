<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\NewsletterSubscriberDataTable;
use App\Http\Controllers\Controller;
use App\Mail\SendNewsletter;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterSubscriberController extends Controller
{
    
    public function index(NewsletterSubscriberDataTable $dataTable) {
        return $dataTable->render('admin.newsletter-subscribers.index');
    }

    public function destroy($id){
        $subscriber = NewsletterSubscriber::findOrFail($id);
        if($subscriber){
            $subscriber->delete();
            return response(['status' => 'success', 'message' => 'Subscriber deleted successfully']);
        }else{
            return response(['status' => 'error', 'message' => 'Subscriber not found']);
        }

    }

    public function sendNewsletter(Request $request) {
        $request->validate([
            'subject' => ['required'],
            'message' => ['required'],
        ]);

        $subscribers = NewsletterSubscriber::where('is_verified', 1)->pluck('email')->toArray();

        Mail::to($subscribers)->send(new SendNewsletter($request->subject, $request->message));

        toastr('Newsletter sent to all subscribers successfully.', 'success');
        return redirect()->route('admin.newsletter-subscribers.index');
    }

}
