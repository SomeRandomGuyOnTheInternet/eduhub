<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModuleContent;
use App\Models\Module;
use App\Models\News;

class ModuleContentController extends Controller
{
    public function index($moduleFolderId)
    {
        // Fetch all ModuleContent entries with the given module_folder_id and load the related module
        $moduleContents = ModuleContent::with('module')
                                       ->where('module_folder_id', $moduleFolderId)
                                       ->get();

        // Handle cases where there is no content available or the module is not defined
        if ($moduleContents->isEmpty()) {
            $moduleName = 'No Module Name';
        } else {
            // Fetch module name from the first content item's related module, if available
            $moduleName = optional($moduleContents->first()->module)->module_name ?? 'No Module Name';
        }


        /* Author Nelson */
        //fetch news for the module
        $newsItems = News::where('module_id', 1) // !!! module id to be dynamic in future
                        ->get();

        return view('content.content_dashboard', compact('moduleContents', 'moduleName','newsItems'));
    }
}
