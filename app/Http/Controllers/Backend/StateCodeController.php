<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PostalZip;
use App\Models\StateCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class StateCodeController extends Controller
{
    public function index(){
        $statecodes = StateCode::get();
        return view('backend.statecode.index', compact('statecodes'));
    }

    public function create(){
        return view('backend.statecode.create');
    }

    public function store(Request $request){
        $request->validate([
            'state_name' => 'required|unique:state_codes',
            'state_code' => 'required|unique:state_codes'
        ]);
        $statecode = new StateCode;
        $statecode->state_name = $request->state_name;
        $statecode->state_code = $request->state_code;
        $statecode->save();
        return redirect()->back()->with('success', 'Uploaded successfully');
    }

    public function update(Request $request){
        $upd = StateCode::where('id', $request->id)->update([
            'state_name' => $request->state_name,
            'state_code' => $request->state_code
        ]);
        return redirect()->back()->with('success', 'Uploaded successfully');
    }

    public function show($id){
        $statecode = StateCode::where('id', $id)->first();
        return view('backend.statecode.show', compact('statecode'));
    }

    public function delete($id){
        $delt = StateCode::where('id', $id)->delete();
        return redirect('admin/statecodes')->with('success', 'Deleted successfully');
    }

    //Postal ZIPS//
    public function postalzipindex(){
        $postalzips = PostalZip::get();
        return view('backend.postalzip.index', compact('postalzips'));
    }

    public function postalzipcreate(){
        return view('backend.postalzip.create');
    }

    public function postalzipstore(Request $request){
        $request->validate([
            'zip_code' => 'unique:postal_zips'
        ], [
            'zip_code.unique' => 'Zip code already registered'
        ]);
        $postalzip = new PostalZip;
        $postalzip->zip_code = $request->zip_code;
        $postalzip->is_delivery = $request->is_delivery;
        $postalzip->is_cod = $request->is_cod;
        $postalzip->save();
        return redirect()->back()->with('success', 'Created successfully');
    }

    public function postalzipshow($id){
        $postalzip = PostalZip::where('id', $id)->first();
        return view('backend.postalzip.show', compact('postalzip'));
    }

    public function postalzipupdate(Request $request){
        $postazip = PostalZip::where('id', $request->id)->update(['zip_code' => $request->zip_code, 'is_delivery' => $request->is_delivery, 'is_cod' => $request->is_cod]);
        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function postalzipdelete($id){
        $postalzip = PostalZip::where('id', $id)->delete();
        return redirect('admin/postalzips');
    }

    public function zipcsvPost(Request $request){

        if ($request->input('submit') != null ){

            $file = $request->file('file');

            // File Details
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");

            // 2MB in Bytes
            $maxFileSize = 2097152;

            // Check file extension
            if(in_array(strtolower($extension),$valid_extension)){

                // Check file size
                if($fileSize <= $maxFileSize){

                    // File upload location
                    $location = 'static/uploads';

                    // Upload file
                    $file->move($location,$filename);

                    // Import CSV to Database
                    $filepath = public_path($location."/".$filename);

                    // Reading file
                    $file = fopen($filepath,"r");

                    $importData_arr = array();
                    $i = 0;

                    while (($filedata = fgetcsv($file, 20000, ",")) !== FALSE) {
                        $num = count($filedata );

                        // Skip first row (Remove below comment if you want to skip the first row)
                        if($i == 0){
                            $i++;
                            continue;
                        }
                        for ($c=0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata [$c];
                        }
                        $i++;
                    }
                    fclose($file);

                    //return $importData_arr;

                    // Insert to MySQL database
                    foreach($importData_arr as $importData){
                        $data = [
                            'zip_code' => $importData[0],
                            'is_delivery' => $importData[1],
                            'is_cod' => $importData[2]
                        ];
                        PostalZip::updateOrCreate(
                            [
                                'zip_code' => $importData[0],
                            ],
                            [
                                'is_delivery' => $importData[1],
                                'is_cod' => $importData[2]
                            ]
                        );
                    }
                    Session::flash('message','Import Successful.');
                }else{
                    Session::flash('message','File too large. File must be less than 2MB.');
                }

            }else{
                Session::flash('message','Invalid File Extension.');
            }

        }

        //return $papai;
        // Redirect to index
        //return redirect()->action('PagesController@index');
        return redirect()->back();
    }
}
