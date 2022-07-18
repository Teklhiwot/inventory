<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Image;
use Auth;



class HomeController extends Controller
{
   public function HomeSlider()
   {


    $sliders = Slider::latest()->get();
    return view('admin.slider.index',compact('sliders'));

   }

   public function AddSlider()
   {
    return view('admin.slider.create');
   }

   public function StoreSlider(Request $request)
   {

    $slider_image = $request->file('image');

    // $name_gen = hexdec(uniqid());
    // $image_ext = strtolower($brand_image->getClientOriginalExtension());
    // $img_name=$name_gen.'.'.$image_ext;
    // $up_location = 'image/brand/';
    // $last_img = $up_location.$img_name;
    // $brand_image->move($up_location,$img_name);

    // Using Laravel image intervention package :-

    $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
    Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);

    $last_img = 'image/slider/'.$name_gen;

    Slider::insert([

        'title' => $request->title,
        'description' => $request->description,
        'image' => $last_img, 
        'created_at' => Carbon::now()


    ]);
          return Redirect()->route('home.slider')->with('success','Slider Inserted successfully');

   }

   public function EditSlider($id)
   {
    $sliders = Slider::find($id);

    return view('admin.slider.edit',compact('sliders'));
   }

}
