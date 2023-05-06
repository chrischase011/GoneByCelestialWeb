<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    // Player's Profile

    public function index()
    {
        $title = "My Account";
        
        return view('profile.index', ['title' => $title]);
    }

    public function fetchUser(Request $request)
    {
        $id = $request->id;

        $user = User::find($id);

        return json_encode($user);
    }

    public function updateUserInfo(Request $request)
    {
        $user = User::find($request->id);

        if($user)
        {
            $user->email = $request->email;
            $user->fname = $request->fname;
            $user->lname = $request->lname;

            $user->save();
            
            return back()->with('_message', "Successfully Updated Information.");
        }

        return back()->with('_message', "Unexpected error occurred.");
    }

    // Email verification

    public function sendVerification(Request $request)
    {
        $user = User::find(Auth::id());

        if($user):
            $token = Str::random(200);
            $email = Auth::user()->email;
            $name = Auth::user()->fname;
            $message = "To verify that this is your e-mail, click the button below.";
            $url = route('profile.verifyEmail', ['token' => $token]);

            $user->email_token = $token;
            $user->save();

            Mail::to($email)->send(new EmailVerification($email, $name, $message, $url));

            return 1;
        endif;

    }

    public function verifyEmail(Request $request)
    {
        $token = $request->token;
        $check = User::where(['email_token' => $token])->first();

        if($check){
            User::where(['email_token' => $token])->update(['email_token' => '', 'approvedEmail' => 1]);

            return view("profile.verify_email", ['title' => 'E-mail Verified']);
        }
        
        return view("profile.invalid_link", ['title' => 'Invalid Verification Link']);
    }

    // Password Update

    public function passwordUpdate(Request $request)
    {
        $id = Auth::id();
        $user = User::find($id);
        $currentPass = $request->currentPass;
        $newPass = $request->newPass;

        if(!Hash::check($currentPass, $user->password))
        {
            return "2";
        }

        $user->password = Hash::make($newPass);
        $user->save();

        return "1";
    }
}
