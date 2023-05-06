<?php

namespace App\Http\Controllers;

use App\Models\NewsUpdates;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        $total_user = count(User::where('roles', '!=', '1')->get());
        $total_news = count(NewsUpdates::where(['category' => '1'])->get());
        $total_updates = count(NewsUpdates::where(['category' => '2'])->get());
        return view('admin.index', ['total_user' => $total_user, 'total_news' => $total_news, 'total_updates' => $total_updates])->with('title','Admin Dashboard - Gone By Celestial');
    }

    ############################# Users Section #############################

    public function users()
    {
        $data = User::orderBy('roles', 'desc')->paginate(10);
        return view('admin.users',['data' => $data,])->with('title','Users Management - Gone By Celestial');
    }
    public function edit(Request $request)
    {
        if(!$request->has('id'))
        {
            return abort(403,'Invalid Request. Are you lost baby girl?');
        }
        $id = $request->get('id');
        if($id == "")
        {
            return abort(403,'Invalid Request. Are you lost baby girl?');
        }

        $data = User::where(['user_id' => $id])->get();
        if(count($data) < 1)
        {
            return abort(403,'Invalid Request. Are you lost baby girl?');
        }
        $getName = "";
        foreach ($data as $user)
        {
            $getName = $user->fname.' '.$user->lname;
        }
        return view('admin.edit', ['data' => $data])->with('title', 'Edit '.$getName.' - Gone By Celestial');
    }
    public function editUser(Request $request)
    {
        if(!Hash::check($request->confirm_password, Auth::user()->password))
        {
            return back()->with('invalidPassword', 'Invalid Password');
        }
        if($request->password != "")
        {
            $request->validate([
                'password' => 'required|min:8|confirmed',
                'fname' => 'required',
                'lname' => 'required',
            ]);
            $user = User::where(['user_id' => $request->user_id])->first();
            $user->password = Hash::make($request->password);
            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->save();
        }
        else
        {
            $request->validate([
                'fname' => 'required',
                'lname' => 'required',
            ]);
            $user = User::where(['user_id' => $request->user_id])->first();
            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->save();
        }

        return back()->with('editSuccess', 'Successfully edit <strong>'.$request->fname.' '.$request->lname.'</strong> account.');
    }



    public function set_admin(Request $request)
    {
        $user = User::where(['id' => $request->id])->first();
        if(!empty($user))
        {
            $user->roles = '1';
            $user->save();
            return 1;
        }
        return 0;
    }
    public function remove_admin(Request $request)
    {
        $user = User::where(['id' => $request->id])->first();
        if(!empty($user))
        {
            $user->roles = '0';
            $user->save();
            return 1;
        }
        return 0;
    }
    public function add_user()
    {
        return view('admin.add_user')->with('title', 'Add New User - Gone By Celestial');
    }
    public function addUser(Request $request)
    {
        $request->validate([
            'username' => 'required|min:3|max:20|unique:users',
            'password' => 'required|confirmed|min:8|max:255',
            'fname' => 'required|max:25',
            'lname' => 'required|max:25',
        ]);

        User::create([
            'user_id' => $this->generateID(),
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'fname' => $request->fname,
            'lname' => $request->lname,
            'roles' => '0',
        ]);

        return back()->with('success', 'New user successfully added.');
    }

    public function delete_user(Request $request)
    {
        $user = User::where(['id' => $request->id])->first();
        if(!empty($user))
        {
            $user->delete();
            return 1;
        }
        return 0;
    }

    ########################### End of News Section ######################################

    ############################ News Section ############################################










    ########################### End of News Section ######################################


    //Protected *Do not delete
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
    protected function hash256($pass)
    {
        $salt = 'CxY245sDpI';
        $hash = hash('sha256', $pass).$salt;

        return $hash;
    }
    public function check_password(Request $request)
    {
        $id = $request->id;

    

        if(!Hash::check($request->value, Auth::user()->password))
        {
            return "Password incorrect";
            return 0;
        }

        return 1;

        return "ID:". $id;
        $user = User::find($id);

        if(!$user== "")
        {   
            $user->role = 2;
            $user->save();
        }
        else
        {
            return "can't find user";
            return 0;
        }
        return 1;
    }
}
