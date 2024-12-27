<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use App\Mail\ContactMail;
use App\Notifications\ContactNotifi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function upload(Request $request)
    {
        $image = $request->file('image');
        if ($request->hasFile('image')) {
            $path = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads'), $path);
            Db::table('images')->insert([
                'path'=>$path
            ]);
            return "photo uploaded";
        } else {
            return response()->json('image null');
        }
    }
    public function contact(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' =>  'required',
            'email'=> 'required|email|exists:users',
            'title' => 'required',
            'message' => 'required'
        ]);
        Contact::create($request->all());
        $data = $validator->validated();
        $email = $request->input('email');
        

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        else{
            Mail::to('connorapp7@gmail.com')->send(new ContactMail($data,$email));

            
            $user = User::where('email',$email )->first();
            if ($user) { 
                $user->notify(new ContactNotifi());
            }
            
                
            return response()->json(['message' => 'Contact information received and email sent!']);  
        }
    }
}
