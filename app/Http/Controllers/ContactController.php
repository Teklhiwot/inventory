<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class ContactController extends Controller
{
   public function AdminContact()
   {

    $contacts =Contact::all();
    return view('admin.contact.index',compact('contacts'));

   }

   public function AdminAddContact()
   {
    
    return view('admin.contact.create');

   }

   public function StoreContact (Request $request)
   {

    Contact::insert([
        'address'=>$request->address,
        'email'=>$request->email,
        'phone'=>$request->phone,
        'created_at'=>Carbon::now()
    ]);
    return Redirect()->route('admin.contact')->with('success','Contact Created successfully');

   }

   public function Contact()
   {
    // can also do it in this way using the quiery builder
    // $contacts2 = DB::table('contacts')->first();
    $contacts2 = Contact::all()->first();
     return view('pages.contact',compact('contacts2'));

   }

   public function ContactForm(Request $request)
   {

    ContactForm::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'message'=>$request->message,
            'created_at'=>Carbon::now()
        ]);
        return Redirect()->route('contact')->with('success','Message Sent successfully');

    

   }

   public function AdminMessage()
   {

        $messages = ContactForm::all();
        return view('admin.contact.message',compact('messages'));
   }


}
