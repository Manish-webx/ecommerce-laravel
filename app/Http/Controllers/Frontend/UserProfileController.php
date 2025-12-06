<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserProfileController extends Controller
{
    
    public function index(){
        return view('frontend.dashboard.profile');
    }

    public function updateProfile(Request $request){

        $request->validate([
            'name' =>['required','max:100'],
            'email' =>['required','email','unique:users,email,'.Auth::user()->id],
            'image' =>['image', 'max:2048']
        ]);

        $user = Auth::user();

        if($request->hasFile('image')){
            if(File::exists($user->image)){
               File::delete($user->image);
            }

            $img = $request->image;

            $imgName = rand().'-'.$img->getClientOriginalName();

            $img->move('uploads', $imgName);

            $path = 'uploads/'.$imgName;

            $user->image = $path;
        }

        $user->name = $request->name;
        $user->email = $request->email;
       
        $user->save();
        

        toastr()->success('Profile Update Successfully.');

        return redirect()->back();

    }

    public function updatePassword(Request $request){

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        $user = Auth::user();
        $user->update([
            'password' => bcrypt($request->password)
        ]);

        $user->save();

        toastr()->success('Profile Password Update Successfully.');

        return redirect()->back();

    }

}
