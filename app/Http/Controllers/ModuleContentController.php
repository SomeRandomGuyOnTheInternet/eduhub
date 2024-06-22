<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModuleContent;
use App\Models\Module;
use App\Models\ModuleFolder;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ModuleContentController extends Controller
{
    public function indexForProfessor($module_id)
    {
        $module = Module::findOrFail($module_id);
        $folders = ModuleFolder::where('module_id', $module_id)->with('contents')->get();
        return view('professor.content.index', compact('module', 'folders'));
    }

    // public function index($moduleFolderId)
    // {
    //     // Fetch all ModuleContent entries with the given module_folder_id and load the related module
    //     $moduleContents = ModuleContent::with('module')
    //                                    ->where('module_folder_id', $moduleFolderId)
    //                                    ->get();

    //     // Handle cases where there is no content available or the module is not defined
    //     if ($moduleContents->isEmpty()) {
    //         $moduleName = 'No Module Name';
    //     } else {
    //         // Fetch module name from the first content item's related module, if available
    //         $moduleName = optional($moduleContents->first()->module)->module_name ?? 'No Module Name';
    //     }

    //     if (Auth::user()->role === 'professor') {
    //         return view('content.create', compact('moduleFolderId'));
    //     }

    //     $userId = Auth::id();
    //     $userType = Auth::user()->user_type;

    //     if ($userType == 'professor') {
    //         // Fetch the module names and IDs for professors
    //         $modules = DB::table('modules')
    //             ->join('teaches', 'modules.module_id', '=', 'teaches.module_id')
    //             ->where('teaches.user_id', $userId)
    //             ->select('modules.module_name', 'modules.module_id') // Include module_id in the selection
    //             ->get();
    //     } elseif ($userType == 'student') {
    //         // Fetch the module names and IDs for students
    //         $modules = DB::table('modules')
    //             ->join('enrollments', 'modules.module_id', '=', 'enrollments.module_id')
    //             ->where('enrollments.user_id', $userId)
    //             ->select('modules.module_name', 'modules.module_id') // Include module_id in the selection
    //             ->get();
    //     } else {
    //         // If not professor or student, maybe redirect or handle differently
    //         $modules = collect(); // Return an empty collection or handle as needed
    //     }

    //     return view('content.content_dashboard', compact('moduleContents', 'modules','moduleName'));
    // }

    public function store(Request $request, $moduleFolderId)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'file' => 'required|file|max:10240', // Allows files up to 10MB
        ]);

        $filePath = $request->file('file')->store('module_contents');

        $content = new ModuleContent([
            'module_folder_id' => $moduleFolderId,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'file_path' => $filePath,
            'upload_date' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $content->save();

        return back()->with('success', 'Content uploaded successfully!');
    }
}