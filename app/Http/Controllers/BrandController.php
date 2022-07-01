<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Support\Carbon;
use Image;

class BrandController extends Controller
{
    public function AllBrand()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index',compact('brands'));
    }

    public function StoreBrand(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|max:255',
            'brand_image' => 'required|mimes:jpg.jpeg,png',
        ],
        [
            'brand_name.required' => 'please input brand name',
            'brand_image.min' => 'Brand longer than 4 characters',    
        ]);

        $brand_image = $request->file('brand_image');

        // $name_gen = hexdec(uniqid());
        // $image_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name=$name_gen.'.'.$image_ext;
        // $up_location = 'image/brand/';
        // $last_img = $up_location.$img_name;
        // $brand_image->move($up_location,$img_name);

        // Using Laravel image intervention package :-

        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);

        $last_img = 'image/brand/'.$name_gen;

        Brand::insert([

            'brand_name' => $request->brand_name,
            'brand_image' => $last_img, 
            'created_at' => Carbon::now()


        ]);
              return Redirect()->back()->with('success','Brand Inserted successfully');
            

    }

    public function Edit($id)
    {
        $brands = Brand::find($id);
        return view('admin.brand.edit',compact('brands'));
    }

    public function update(Request $request,$id)
    {
        $validated = $request->validate([
            'brand_name' => 'required|max:255',
            
        ],
        [
            'brand_name.required' => 'please input brand name',
            'brand_image.min' => 'Brand longer than 4 characters',    
        ]);

        $old_image= $request->old_image;

        $brand_image = $request->file('brand_image');

        if($brand_image)
        {

            $name_gen = hexdec(uniqid());
        $image_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name=$name_gen.'.'.$image_ext;
        $up_location = 'image/brand/';
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location,$img_name);
        unlink($old_image);
        Brand::find($id)->update([

            'brand_name' => $request->brand_name,
            'brand_image' => $last_img, 
            'created_at' => Carbon::now()


        ]);
              return Redirect()->back()->with('success','Brand Updated successfully');

        }

        else
        {
            Brand::find($id)->update([

                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
    
    
            ]);
                  return Redirect()->back()->with('success','Brand Updated successfully');
    
        }

        
           
    }
    public function Delete($id)
    {
        $img = Brand::find($id);
        $oldimg = $img->brand_image;
        unlink($oldimg);
        Brand::find($id)->delete();

        return Redirect()->back()->with('success','Brand Deleted successfully');
    }

    // This below is for Multi Image  Methods

   public function MultiPic()
   {
    $images = Multipic::all();
    return view('admin.multipic.index',compact('images'));

   }

   public function StoreImage(Request $request)
   {

    $image = $request->file('image');

    foreach($image as $multi_img){

    $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
    Image::make($multi_img)->resize(300,300)->save('image/multi/'.$name_gen);

    $last_img = 'image/multi/'.$name_gen;

    Multipic::insert([

        
        'image' => $last_img, 
        'created_at' => Carbon::now()


    ]);

}// end of the foreach loop
          return Redirect()->back()->with('success','Brand Inserted successfully');
    

   }


}
