<?php

namespace App\Traits;

use Illuminate\Http\Request;


trait ImageUploadTrait{

    public function imageUpload(Request $request, $inputName, $path){

        if($request->hasFile($inputName)){
            $img = $request->$inputName;
            $ext = $img->getClientOriginalExtension();
            $imgName = rand().time().'.'.$ext;
            $img->move($path,$imgName);

            $imgPath = $path.'/'.$imgName;

            return $imgPath;

        }
    
    }

    public function imageMultipleUpload(Request $request, $inputName, $path){

        $imgPaths = [];
        if($request->hasFile($inputName)){

            $images = $request->$inputName;

            foreach($images as $img){
                $ext = $img->getClientOriginalExtension();
                $imgName = rand().time().'.'.$ext;
                $img->move($path,$imgName);    
                $imgPaths[] = $path.'/'.$imgName;
            }            

            return $imgPaths;

        }
    
    }

}












