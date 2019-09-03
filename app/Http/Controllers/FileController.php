<?php

namespace App\Http\Controllers;

use App\File;
use App\Folder;
use App\Box;
use App\Document;
use Exception;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $box = Box::orderBy('box_name','asc')->get();
        return view('pages.file',['box'=>$box]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
         'box' => 'required',
         'folder' => 'required',
         'file_name' => 'required',
        ]);

        try{
          $file = new File;
          $file->folder_id = $request->folder;
          $file->file_name = $request->file_name;
          $file->description = $request->description;
          $file->save();

          return response()->json(['status'=>'success','message'=>'file saved']);
        }
        catch(Exception $e){
            
          return response()->json(['status'=>'error','message'=>'something went wrong!']);  

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_data = File::find($id)->with('folder.box');

        return $edit_data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
         $request->validate([
         'box' => 'required',
         'folder' => 'required',
         'file_name' => 'required',
        ]);

        try{
         
          $file->folder_id = $request->folder;
          $file->file_name = $request->file_name;
          $file->description = $request->description;
          $file->update();

          return response()->json(['status'=>'success','message'=>'file Updated']);
        }
        catch(Exception $e){
            
          return response()->json(['status'=>'error','message'=>'something went wrong!']);  

        }
    }

    public function findFile($folder_id){
          
        $file = File::where('folder_id','=',$folder_id)->get();

        return $file;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        $doc = Document::where('file_id',$file->id)->get();

        if(count($doc)>0){

            return response()->json(['status'=>'error','message'=>'this file have some document !']);
        }

        $doc->delete();

        return response()->json(['status'=>'success','message'=>'Deleted !']);
    }
}
