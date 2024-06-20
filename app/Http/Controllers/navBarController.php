<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModuleContent;
use App\Models\Module;
use App\Models\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class navBarController extends Controller
{
    // public function nav_bar()
    // {
    //     // Assuming the professor or student is the logged-in user
    //     $userId = Auth::id();
    //     $userType = Auth::user()->user_type; // Assuming 'user_type' can be 'professor' or 'student'

    //     if ($userType == 'professor') {
    //         // Fetch the module names for professors
    //         $modules = DB::table('modules')
    //             ->join('teaches', 'modules.module_id', '=', 'teaches.module_id')
    //             ->where('teaches.user_id', $userId)
    //             ->select('modules.module_name')
    //             ->get();
    //     } elseif ($userType == 'student') {
    //         // Fetch the module names for students
    //         $modules = DB::table('modules')
    //             ->join('enrollments', 'modules.module_id', '=', 'enrollments.module_id')
    //             ->where('enrollments.user_id', $userId)
    //             ->select('modules.module_name')
    //             ->get();
    //     } else {
    //         // If not professor or student, maybe redirect or handle differently
    //         $modules = collect(); // Return an empty collection or handle as needed
    //     }

    //     return view('layouts.left-nav-bar', compact('modules'));
    // }


    public function nav_bar()
{
    $userId = Auth::id();
    $userType = Auth::user()->user_type; // Assuming 'user_type' can be 'professor' or 'student'

    if ($userType == 'professor') {
        // Fetch the module names and IDs for professors
        $modules = DB::table('modules')
            ->join('teaches', 'modules.module_id', '=', 'teaches.module_id')
            ->where('teaches.user_id', $userId)
            ->select('modules.module_name', 'modules.module_id') // Include module_id in the selection
            ->get();
    } elseif ($userType == 'student') {
        // Fetch the module names and IDs for students
        $modules = DB::table('modules')
            ->join('enrollments', 'modules.module_id', '=', 'enrollments.module_id')
            ->where('enrollments.user_id', $userId)
            ->select('modules.module_name', 'modules.module_id') // Include module_id in the selection
            ->get();
    } else {
        // If not professor or student, maybe redirect or handle differently
        $modules = collect(); // Return an empty collection or handle as needed
    }

    return view('layouts.left-nav-bar', compact('modules')); // Note the view path should match the correct path if changed
}


        // public function showPage($module_id, $page)
        // {
        // // You might switch based on the page or directly pass it to a view
        //     return view('modules.' . $page, ['module_id' => $module_id]);
        // }

        public function showPage($module_id, $page)
{
    $userId = Auth::id();
    $userType = Auth::user()->user_type;

    // Fetch modules based on user type
    if ($userType == 'professor') {
        $modules = DB::table('modules')
            ->join('teaches', 'modules.module_id', '=', 'teaches.module_id')
            ->where('teaches.user_id', $userId)
            ->select('modules.module_name', 'modules.module_id')
            ->get();
    } elseif ($userType == 'student') {
        $modules = DB::table('modules')
            ->join('enrollments', 'modules.module_id', '=', 'enrollments.module_id')
            ->where('enrollments.user_id', $userId)
            ->select('modules.module_name', 'modules.module_id')
            ->get();
    } else {
        $modules = collect(); // Empty collection for users who are neither
    }

    // Pass modules along with module_id to the view
    return view('modules.' . $page, compact('modules', 'module_id'));
}

}
