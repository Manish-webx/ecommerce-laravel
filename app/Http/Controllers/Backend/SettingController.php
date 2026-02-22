<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EmailConfiguration;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $setting = GeneralSetting::first();
        $emailConfig = EmailConfiguration::first(); 
        return view('admin.setting.index', compact('setting', 'emailConfig'));
    }

    public function generalSettingUpdate(Request $request) {
        $request->validate([
           'site_name' => ['required', 'max:200'],
           'layout' => ['required', 'max:200'],
           'contact_email' => ['required', 'max:200'],
           'currency_icon' => ['required', 'max:200'],
           'currency_name' => ['required', 'max:200'],
           'time_zone' => ['required', 'max:200'],
        ]);

        GeneralSetting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => $request->site_name,
                'layout' => $request->layout,
                'contact_email' => $request->contact_email,
                'currency_icon' => $request->currency_icon,
                'currency_name' => $request->currency_name,
                'time_zone' => $request->time_zone,
            ]
        );

        toastr('Setting Updated Successfully', 'success');

        return redirect()->back();
    }

    public function emailSettingUpdate(Request $request) {
        $request->validate([
           'email' => ['required', 'max:200'],
           'host' => ['required', 'max:200'],
           'smtp_username' => ['required', 'max:200', 'email'],
           'smtp_password' => ['required', 'max:200'],
           'mail_port' => ['required', 'max:200'],
           'mail_encryption' => ['required', 'max:200'],
        ]);

        EmailConfiguration::updateOrCreate(
            ['id' => 1],
            [
                'mail_mailer' => $request->email,
                'mail_host' => $request->host,
                'mail_username' => $request->smtp_username,
                'mail_password' => $request->smtp_password,
                'mail_port' => $request->mail_port,
                'mail_encryption' => $request->mail_encryption,
            ]
        );

        toastr('Email Configuration Updated Successfully', 'success');

        return redirect()->back();
    }
}
