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
        $news = NewsUpdates::where(['category' => '1'])->orderBy('id','desc')->take(3)->get();
        $updates = NewsUpdates::where(['category' => '2'])->orderBy('id','desc')->take(3)->get();

        $newsImage = "";
        return view('pages.home',['news' => $news, 'updates' => $updates])->with('title', $title);
    }

    public function game_info()
    {
        $title = "Game Info - Gone By Celestial";

        return view('pages.game_info', ['title' => $title]);
    }
}
