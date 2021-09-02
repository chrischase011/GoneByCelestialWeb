<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Auth;
use Hash;

define('COST', 4096);

class AuthController extends Controller
{
    // Auth controller
    public function index()
    {
        $title = 'Login - Gone By Celestial';
        return view('auth.login')->with('title', $title);
    }
    public function register()
    {
        $title = 'Register - Gone By Celestial';
        return view('auth.register')->with('title', $title);
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
            //return Auth::user();
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
            'game_password' => 'required|min:8',
        ]);

        User::create([
            'user_id' => $this->generateID(),
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'fname' => $request->fname,
            'lname' => $request->lname,
            'game_password' => $this->hash256($request->game_password),
            'roles' => '0',
        ]);

        return redirect()->intended('login')->with('regSuccess', 'You can now login your account.');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->intended('/');
    }

    protected function hash256($pass)
    {
        $salt = 'CxY245sDpI';
        $hash = hash('sha256', $pass).$salt;

        return $hash;
    }
    protected function checkHash256($pass,$aPass)
    {

        $salt = 'xY245sDpI';
        $hash = hash('sha256', $pass).$salt;

        for($i = 0; $i <= COST; $i++)
        {
            if($hash == $aPass)
            {
                return true;
            }
        }
        return false;
    }
    protected function generateID()
    {
        $id ="";
        $id = Str::random(100);
        while(count(User::where(['user_id' => $id])->get()) > 0)
        {
            if(count(User::where(['user_id' => $id])->get()) < 1)
                break;
            $id = Str::random(100);
        }
        return $id;
    }


}
