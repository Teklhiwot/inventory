<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
use App\Models\Multipic;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    //
    public function HomeAbout()
    {
        $homeabout = HomeAbout::latest()->get();
        return view('admin.about.index',compact('homeabout'));
    }

    public function AddAbout()
    {
        return view('admin.About.create');
    }

    public function StoreAbout(Request $request)
    {
        $about = HomeAbout::insert([

            'title'=>$request->title,
            'short_dis'=>$request->short_description,
            'long_dis'=>$request->long_description,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.about')->with('success','About Inserted successfully');
    }

    public function EditAbout($id)
    {
        $abouts = HomeAbout::find($id);
        return view('admin.About.edit',compact('abouts'));
    }

    public function Update(Request $request,$id)
    {
 
        $update = HomeAbout::find($id)->update([
            'title'=>$request->title,
            'short_dis'=>$request->short_description,
            'long_dis'=>$request->long_description
        ]);

        return Redirect()->route('home.about')->with('success','About Upadted successfull');

    }

    public function Delete($id)
    {
        $delete = HomeAbout::find($id)->delete();

        return Redirect()->back()->with('success','Deletion of Upadted successfull');
    }


    public function portfolio()
    {
        $images = Multipic::all();
        return view('pages.portfolio',compact('images'));
    }
}
