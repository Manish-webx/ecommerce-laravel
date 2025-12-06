<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    
    public function index(){
       return view('admin.profile.index');
    }

    public function update(Request $request){
    
        $request->validate([
            'name' =>['required','max:100'],
            'email' =>['required','email','unique:users,email,'.Auth::user()->id],
            'image' =>['image', 'max:2048']
        ]);

        $user = Auth::user();

        if($request->hasFile('image')){
            $img = $request->image;
            $imgName = rand().'-'.$img->getClientOriginalName();
            $img->move('uploads',$imgName);

            $path = 'uploads/'.$imgName;

            if(File::exists($user->image)){
                File::delete($user->image);
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $path;
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
       $user->password = $request->password;
       $user->save();

       return redirect()->back();
    }

}
