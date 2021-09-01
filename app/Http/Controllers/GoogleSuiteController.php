<?php

namespace App\Http\Controllers;

use Exception;
use App\GoogleSuite;
use App\Imports\AccountImport;
use Illuminate\Http\Request;
use App\Imports\GoogleSuiteImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class GoogleSuiteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index()
    {
        $student_id = request()->get('student_id');
        $first_name = strtoupper(request()->get('first_name'));
        $last_name = strtoupper(request()->get('last_name'));

        $result = GoogleSuite::where('student_id', $student_id)
            ->where('first_name', $first_name)
            ->where('last_name', $last_name)
            ->first();


        return view('search.index', compact('result'));
    }

    public function uploadExcel(Request $request)
    {
        $request->validate([
            'file' => [
                'required',
                'mimes:xlsx,csv,xls',
            ],
            ], $messages = [
                'file.required' => 'Please upload file.',
                'file.mimes' => 'Extension not supported',
            ],
        );

        try{
            DB::transaction(function() use ($request){
                try{

                    Excel::import(new AccountImport, $request->file('file'));

                }catch (\Maatwebsite\Excel\Validators\ValidationException $e){
                    $errors = $e->failures();
                    dd($errors);
                    return redirect('/home')->withErrors($errors);

                    // foreach ($failures as $failure) {
                        //     $failure->row(); // row that went wrong
                        //     $failure->attribute(); // either heading key (if using heading row concern) or column index
                        //     $failure->errors(); // Actual error messages from Laravel validator
                        //     $failure->values(); // The values of the row that has failed.
                        // }
                    }
            });
        } catch(Exception $e) {
            dd($e->getMessage());
        }
        return redirect('/home')->with('status', 'File Uploaded successfully');

    }
}
