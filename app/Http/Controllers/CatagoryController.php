<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catagory;
use Auth;
use Illuminate\Support\Carbon;

class CatagoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


   public function AllCat(){
        $catagories = Catagory::latest()->paginate(5);

        $trashCat = Catagory::onlyTrashed()->latest()->paginate(3);

        return view('admin.catagory.index',compact('catagories','trashCat'));
    }

    public function AddCat(Request $request)
    {
        $validated = $request->validate([
            'catagory_name' => 'required|unique:catagories|max:255',
            
        ],
        [
            'catagory_name.required' => 'please input catagory name',
            
            
        ]);
        Catagory::insert([
            'catagory_name' => $request -> catagory_name,
            'user_name' => Auth::user()->id,
                'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success','Catagory Inserted successfull');
    }

    public function Edit($id)
    {
        $catagories = Catagory::find($id);
        return view('admin.catagory.edit',compact('catagories'));
    }


    public function Update(Request $request,$id)
    {
        $update = Catagory::find($id)->update([
            'catagory_name' => $request->catagory_name,
            'user_name' => Auth::user()->id
        ]);
        
        return Redirect()->route('all.catagory')->with('success','Catagory Upadted successfull');

    }

    public function SoftDelete($id)
    {
        $delete = Catagory::find($id)->delete();

        return Redirect()->back()->with('success','Catagory Soft Delete Successfull');
    }

   public function Restore($id)
   {

    $delete = Catagory::withTrashed()->find($id)->restore();

    return Redirect()->back()->with('success','Catagory Restore Successfull');

   }

   public function pdelete($id)
   {
    
    $delete = Catagory::onlyTrashed()->find($id)->forceDelete();

    return Redirect()->back()->with('success','Catagory Peremanent Delete Successfull');
   }

}
