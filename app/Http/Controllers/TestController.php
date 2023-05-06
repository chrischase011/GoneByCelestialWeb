<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    // Test

    public function index()
    {
        return view('test.index', ['title' => 'Test']);
    }
}
