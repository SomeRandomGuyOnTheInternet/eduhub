<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\News;

class NewsController extends Controller
{

    public function indexForProfessor($module_id)
    {
        $module = Module::findOrFail($module_id);
        $newsItems = News::where('module_id', $module_id)->get();
        return view('professor.news.index', compact('module', 'newsItems'));
    }

    public function createForProfessor($module_id)
    {
        $module = Module::findOrFail($module_id);
        return view('professor.news.create', compact('module'));
    }

    public function showForProfessor($module_id, $news_id)
    {
        $module = Module::findOrFail($module_id);
        $newsItem = News::findOrFail($news_id);
        return view('professor.news.show', compact('module', 'newsItem'));
    }

    public function storeForProfessor(Request $request)
    {
        $request->validate([
            'module_id' => 'required',
            'news_title' => 'required|string|max:50',
            'news_description' => 'required|string|max:255',
        ]);

        News::create([
            'module_id' => $request->module_id,
            'news_title' => $request->news_title,
            'news_description' => $request->news_description,
            'created_at' => now(),
        ]);

        return redirect()->route('modules.news.professor.index', ['module_id' => $request->module_id])->with('success', 'News created successfully');
    }

    public function editForProfessor($module_id, $news_id)
    {
        $module = Module::findOrFail($module_id);
        $newsItem = News::findOrFail($news_id);
        return view('professor.news.edit', compact('module', 'newsItem'));
    }

    public function updateForProfessor(Request $request, $module_id, $news_id)
    {
        $request->validate([
            'news_title' => 'required|string|max:50',
            'news_description' => 'required|string|max:255',
        ]);

        $newsItem = News::findOrFail($news_id);
        $newsItem->update([
            'news_title' => $request->news_title,
            'news_description' => $request->news_description,
            'updated_at' => now()
        ]);

        return redirect()->route('modules.news.professor.index', ['module_id' => $module_id])->with('success', 'News updated successfully');
    }

    public function destroyForProfessor($module_id, $news_id)
    {
        $newsItem = News::findOrFail($news_id);
        $newsItem->delete();

        return redirect()->route('modules.news.professor.index', ['module_id' => $module_id])->with('success', 'News deleted successfully');
    }

    public function indexForStudent($module_id)
    {
        $module = Module::findOrFail($module_id);
        $newsItems = News::where('module_id', $module_id)->get();
        return view('student.news.index', compact('module', 'newsItems'));
    }

    public function showForStudent($module_id, $news_id)
    {
        $module = Module::findOrFail($module_id);
        $newsItem = News::findOrFail($news_id);
        return view('student.news.show', compact('module', 'newsItem'));
    }
    
    // /* 
    // Author: Nelson
    // controller for Module News CRUD
    // */
    
    // public function show()
    // {
    //     //fetch news for the module
    //     $newsItems = News::where('module_id', 1) // !!! module id to be dynamic in future
    //                         ->get();

    //     return view('news.show',compact('newsItems'));
    // }


    // //calls the view form to create a news
    // public function create()
    // {
    //     /* 
    //     code to get module id when session is set up
    //     $moduleId = Session::get('module_id');
    //     return view('news.create', ['module_id' => $moduleId]); 
    //     */

    //     return view('news.create');
    // }

    // //POST request to store the news
    // public function store(Request $request)
    // {

    //     //dd($request->all());

    //     $request->validate([
    //         'module_id' => 'required',
    //         'news_title' => 'required|string|max:50',
    //         'news_description' => 'required|string|max:255',
            
    //     ]);

    //     News::create([
    //         'module_id' => $request->module_id, //have to pull from $request in future
    //         'news_title' => $request->news_title,
    //         'news_description' => $request->news_description,
    //         'created_at' => now(),
    //     ]);

    //     return redirect()->route('news.show', ['moduleId' => $request->module_id])->with('success', 'News created successfully');

    // }

    // //fetch the edit view
    // public function edit($news_id)
    // {
    //     $newsItem = News::findOrFail($news_id);
    //     return view('news.edit', compact('newsItem'));
    // }

    // //update the news
    // public function update(Request $request, $news_id)
    // {
    //     $request->validate([
    //         'news_title' => 'required|string|max:50',
    //         'news_description' => 'required|string|max:255',
    //     ]);

        
    //     $newsItem = News::findOrFail($news_id);
    //     $newsItem->update([
    //         'news_title' => $request->news_title,
    //         'news_description' => $request->news_description,
    //         'updated_at' => now()
    //     ]);

    //     return redirect()->route('news.show', ['moduleId' => $newsItem->module_id])->with('success', 'News updated successfully');
    // }

    // public function delete($news_id)
    // {
    //     $newsItem = News::findOrFail($news_id);
    //     $newsItem->delete();

    //     return redirect()->route('news.show', ['moduleId' => $newsItem->module_id])->with('success', 'News deleted successfully');
    // }
}