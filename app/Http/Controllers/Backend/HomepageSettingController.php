<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomepageSetting;
use Illuminate\Http\Request;

class HomepageSettingController extends Controller
{
    public function index(){
        $categories = Category::where('status', 1)->get();
        $popularcategory = HomepageSetting::where('key','popular_category_section')->first();
        $popularCategorySectionOne = HomepageSetting::where('key', 'popular_slider_one')->first();
        $popularCategorySectionTwo = HomepageSetting::where('key', 'popular_slider_two')->first();
        $popularCategorySectionThree = HomepageSetting::where('key', 'popular_slider_three')->first();
        return view('admin.home-page-setting.index', compact('categories', 'popularcategory', 'popularCategorySectionOne', 'popularCategorySectionTwo', 'popularCategorySectionThree'));
    }

    public function updatePopularCategorySection(Request $request){
        
        $request->validate([
            'cat_one' => ['required'],
            'cat_two' => ['required'],
            'cat_three' => ['required'],
            'cat_four' => ['required'],
        ], [
            'cat_one.required' => 'Category one is required',
            'cat_two.required' => 'Category two is required',
            'cat_three.required' => 'Category three is required',
            'cat_four.required' => 'Category four is required',
        ]);

        $data = [
            [
                'category' => $request->cat_one,
                'sub_category' => $request->sub_cat_one,
                'child_category' => $request->child_cat_one
            ],
            [
                'category' => $request->cat_two,
                'sub_category' => $request->sub_cat_two,
                'child_category' => $request->child_cat_two
            ],
            [
                'category' => $request->cat_three,
                'sub_category' => $request->sub_cat_three,
                'child_category' => $request->child_cat_three
            ],
            [
                'category' => $request->cat_four,
                'sub_category' => $request->sub_cat_four,
                'child_category' => $request->child_cat_four
            ]
        ];

        HomepageSetting::updateOrCreate(
            ['key' => 'popular_category_section'], 
            ['value' => json_encode($data)]
        );

        toastr('Updated Successfully', 'success');

        return redirect()->back();

    }

    public function updatePopularSliderSectionOne(Request $request){
        
        $request->validate([
            'cat_one' => ['required']
        ], [
            'cat_one.required' => 'Category is required'
        ]);

         $data = [
            'category' => $request->cat_one,
            'sub_category' => $request->sub_cat_one,
            'child_category' => $request->child_cat_one            
        ];

        HomepageSetting::updateOrCreate(
            ['key' => 'popular_slider_one'], 
            ['value' => json_encode($data)]
        );

        toastr('Updated Successfully', 'success');

        return redirect()->back();

    }

    public function updatePopularSliderSectionTwo(Request $request){
        
        $request->validate([
            'cat_one' => ['required']
        ], [
            'cat_one.required' => 'Category is required'
        ]);

         $data = [
            'category' => $request->cat_one,
            'sub_category' => $request->sub_cat_one,
            'child_category' => $request->child_cat_one            
        ];

        HomepageSetting::updateOrCreate(
            ['key' => 'popular_slider_two'], 
            ['value' => json_encode($data)]
        );

        toastr('Updated Successfully', 'success');

        return redirect()->back();

    }


    public function updatePopularSliderSectionThree(Request $request){
        
        $request->validate([
            'cat_one' => ['required'],
            'cat_two' => ['required']
        ], [
            'cat_one.required' => 'Category one is required',
            'cat_two.required' => 'Category two is required'
        ]);

         $data = [
            [
                'category' => $request->cat_one,
                'sub_category' => $request->sub_cat_one,
                'child_category' => $request->child_cat_one        
            ],
            [
                'category' => $request->cat_two,
                'sub_category' => $request->sub_cat_two,
                'child_category' => $request->child_cat_two
            ]        
        ];

        HomepageSetting::updateOrCreate(
            ['key' => 'popular_slider_three'], 
            ['value' => json_encode($data)]
        );

        toastr('Updated Successfully', 'success');

        return redirect()->back();

    }
}
