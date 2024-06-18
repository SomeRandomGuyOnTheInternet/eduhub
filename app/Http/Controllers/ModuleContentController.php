<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ModuleContent;
use App\Models\Module;

class ModuleContentController extends Controller
{
    public function index($moduleFolderId)
    {
        // Fetch all ModuleContent entries with the given module_folder_id and load the related module
        $moduleContents = ModuleContent::with('module')
                                       ->where('module_folder_id', $moduleFolderId)
                                       ->get();

        // Assuming we need to display module name, we fetch it from the first content's related module
        $moduleName = $moduleContents->first()->module->module_name ?? 'No Module Name';

        return view('content.content_dashboard', compact('moduleContents', 'moduleName'));
    }
}
