<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DPAImport;
use App\Models\DPA;

class UploadDPAController extends Controller
{
    public function index()
    {
        return view('UploadDPA.index');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|file|mimes:xlsx,xls',
            ]);

            $file = $request->file('file');
            Excel::import(new DPAImport, $file);

            return redirect()->route('UploadDPA.index')->with('success', 'File imported successfully.');
        } catch (ValidationException $e) {
            return redirect()->route('UploadDPA.index')->with('error', $e->validator->errors()->first());
        } catch (\Exception $e) {
            return redirect()->route('UploadDPA.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
