<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsUpdates;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class HomeController extends Controller
{

    public function index()
    {
        $title = 'Gone By Celestial';
        $news = NewsUpdates::where(['category' => '1'])->orderBy('id','desc')->get();
        $updates = NewsUpdates::where(['category' => '2'])->orderBy('id','desc')->get();

        $newsImage = "";
        foreach($news as $new)
        {

        }
        return view('pages.home',['news' => $news, 'updates' => $updates])->with('title', $title);
    }

}
