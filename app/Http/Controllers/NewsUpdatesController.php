<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\NewsUpdates;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class NewsUpdatesController extends Controller
{
    public function index()
    {
        $data = NewsUpdates::orderBy('id','desc')->get();
        $admins = User::where(['roles' => '1'])->get();
        return view('admin.news', ['data' => $data, 'admins' => $admins])->with('title', 'News and Updates Management - Gone By Celestial');
    }
    public function add_news()
    {
        return view('admin.add_news')->with('title', 'Add News | Updates - Gone By Celestial');
    }
    public function addNews(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'editor' => 'required',
            'preview' => 'required|mimes:jpeg|max:50000',
        ]);
        $photo = $request->file('preview');
        $data = file_get_contents($photo);
        $base64 = base64_encode($data);
        NewsUpdates::create([
            'n_id' => $this->generateID(),
            'title' => $request->title,
            'category' => $request->category,
            'editor' => $request->editor,
            'user_id' => Auth::user()->user_id,
            'preview' => $base64,
        ]);
        $category = ($request->category == 1) ? 'a News' : 'an Update';
        return redirect()->action([NewsUpdatesController::class,'index'])
            ->with('status', 'Successfully created <b>'.$category.'</b> Post entitled <b>'
                .$request->title.'</b>');
    }

    protected function generateID()
    {
        $id ="";
        $id = 'GBCNU-'.rand(0,9999999);
        while(count(NewsUpdates::where(['n_id' => $id])->get()) > 0)
        {
            if(count(NewsUpdates::where(['n_id' => $id])->get()) < 1)
                break;
            $id = 'GBCNU-'.rand(0,9999999);
        }
        return $id;
    }
    public function preview_news($n_id)
    {
        $data = NewsUpdates::where(['n_id' => $n_id, 'category' => '1'])->get();
        $admins = User::where(['roles' => '1'])->get();
        $title = "";
        if(count($data) < 1)
        {
            return abort(404);
        }
        foreach ($data as $news) {
            $title = $news->title;
        }
        return view('pages.news', ['data' => $data, 'admins' => $admins])->with('title',$title.'- Gone By Celestial');
    }
    public function preview_updates($n_id)
    {
        $data = NewsUpdates::where(['n_id' => $n_id, 'category' => '2'])->get();
        $admins = User::where(['roles' => '1'])->get();
        $title = "";
        if(count($data) < 1)
        {
            return abort(404);
        }
        foreach ($data as $news) {
            $title = $news->title;
        }
        return view('pages.news', ['data' => $data, 'admins' => $admins])->with('title',$title.'- Gone By Celestial');
    }

    public function edit_news(Request $request)
    {
        if(!$request->has('id'))
        {
            return abort(403,'Invalid Request. Are you lost baby girl?');
        }
        $id = $request->id;
        if($id == "")
        {
            return abort(403,'Invalid Request. Are you lost baby girl?');
        }
        $data = NewsUpdates::where(['n_id' => $id])->get();
        if(count($data) < 1)
        {
            return abort(403,'Invalid Request. Are you lost baby girl?');
        }
        $title = "";
        foreach ($data as $news)
            $title = $news->title;

        return view('admin.edit_news', ['data' => $data])->with('title','Edit '.$title.' - Gone By Celestial');
    }

    public function editNews(Request $request)
    {

        if($request->has('preview'))
        {
            $request->validate([
                'title' => 'required',
                'editor' => 'required',
                'preview' => 'required|mimes:jpeg|max:50000',
            ]);
            $data = NewsUpdates::where(['n_id' => $request->n_id])->first();
            $data->title = $request->title;
            $data->editor = $request->editor;
            $data->category = $request->category;
            $photo = $request->file('preview');
            $dat = file_get_contents($photo);
            $base64 = base64_encode($dat);
            $data->preview = $base64;
            $data->save();
        }
        else
        {
            $request->validate([
                'title' => 'required',
                'editor' => 'required',
            ]);
            $data = NewsUpdates::where(['n_id' => $request->n_id])->first();
            $data->title = $request->title;
            $data->editor = $request->editor;
            $data->category = $request->category;
            $data->save();
        }
        $category = ($request->category == 1) ? 'a News' : 'an Update';

        return redirect()->action([NewsUpdatesController::class,'index'])
            ->with('status', 'Successfully updated <b>'.$category.'</b> Post entitled <b>'
                .$request->title.'</b>');
    }

}
