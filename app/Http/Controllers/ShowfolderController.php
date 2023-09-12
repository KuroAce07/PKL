<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowfolderController extends Controller
{
    public function showFilesInFolder($folderName)
    {
        $folderPath = public_path('uploads/' . $folderName);
        $files = scandir($folderPath);
        $files = array_diff($files, array('.', '..'));

        return view('showfolder.index', compact('files', 'folderName'));
    }
    
    
}
