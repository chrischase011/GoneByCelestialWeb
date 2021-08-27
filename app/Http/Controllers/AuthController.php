<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Auth;
use Hash;
class AuthController extends Controller
{
    // Auth controller
    public function index()
    {
        return view('auth.login');
    }
    public function register()
    {
        return view('auth.register');
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if(Auth::attempt($credentials))
        {
            return Auth::user();
            return redirect()->intended('/');
        }
        else
        {
            return back()->with('loginError', 'Invalid Username or Password.');
        }
        /*
        $a = "";
        $data = User::where(['username' => $request->username])->get();
        if(count($data) < 1)
        {
            return back()->with('loginError', 'Invalid Username or Password.');
        }
        else
        {
            foreach ($data as $pass)
            {
                $a = $pass->password;
            }
        }


        if($this->checkHash256($request->password, $pass->password))
        {
            $credentials = [
                'username' => $request->username,
                'password' => $pass->password,
            ];
            Auth::attempt($credentials);
            return Auth::user();
            return redirect()->intended('/');
        }
        else{
            return back()->with('loginError', 'Invalid Username or Password.');
        }
    */

    }
    public function newUser(Request $request)
    {
        $request->validate([
            'username' => 'required|min:3|max:20|unique:users',
            'password' => 'required|confirmed|min:8|max:255',
            'fname' => 'required|max:25',
            'lname' => 'required|max:25',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'fname' => $request->fname,
            'lname' => $request->lname,
        ]);

        return redirect()->intended('login')->with('regSuccess', 'You can now login your account.');
    }
    protected function hash256($pass)
    {
        $salt = 'xY245sDpI';
        $hash = hash('sha256', $pass).$salt;

        return $hash;
    }
    protected function checkHash256($pass,$aPass)
    {
        $cost = 4096;
        $salt = 'xY245sDpI';
        $hash = hash('sha256', $pass).$salt;

        for($i = 0; $i <= $cost; $i++)
        {
            if($hash == $aPass)
            {
                return true;
            }
        }
        return false;
    }

}
