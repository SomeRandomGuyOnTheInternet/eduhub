<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\News;

class NewsController extends Controller
{
    /* 
    Author: Nelson
    controller for Module News CRUD
    */

    //calls the view form to create a news
    public function create()
    {
        /* 
        code to get module id when session is set up
        $moduleId = Session::get('module_id');
        return view('news.create', ['module_id' => $moduleId]); 
        */

        return view('news.create');
    }

    //POST request to store the news
    public function store(Request $request)
    {

        //dd($request->all());

        $request->validate([
            'module_id' => 'required',
            'news_title' => 'required|string|max:50',
            'news_description' => 'required|string|max:255',
            
        ]);

        News::create([
            'module_id' => $request->module_id, //have to pull from $request in future
            'news_title' => $request->news_title,
            'news_description' => $request->news_description,
            'created_at' => now(),
        ]);

        return redirect()->route('modules.content', ['moduleFolderId' => $request->module_id])->with('success', 'News created successfully');
    }
}
