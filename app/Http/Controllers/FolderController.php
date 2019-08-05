<?php

namespace App\Http\Controllers;

use App\Folder;
use App\File;
use App\Box;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $box = Box::orderBy('box_name','ASC')->get();
        return view('pages.folder',['box'=>$box]);
    }


    public function folderList(Request $request){

           $keyword = $request->keyword;
           $box = $request->box;

           $folder = Folder::with('box:id,box_name')->orderBy('folder_name','asc');

           if($keyword != ''){

             $folder->where('folder_name','LIKE','%'.$keyword.'%');
           
           }

           if($box){
              
              $folder->where('box_id','=',$box);
           }

           $folder = $folder->paginate(10);

           return $folder;

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
         'folder_name' => 'required'
        ]);

        try{
          
          $folder = new Folder;
          $folder->folder_name = $request->folder_name;
          $folder->box_id = $request->box;
          $folder->description = $request->description;
          $folder->save();

          return response()->json(['status'=>'success','message'=>'Folder Created']);
               
        }
        catch(Exception $e){
          
          return response()->json(['status'=>'success','message'=>'Something Went Wrong !']);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder)
    {
        return $folder;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Folder $folder)
    {
       $request->validate([
         'box' => 'required',
         'folder_name' => 'required'
        ]);

        try{
          
          
          $folder->folder_name = $request->folder_name;
          $folder->box_id = $request->box;
          $folder->description = $request->description;
          $folder->update();

          return response()->json(['status'=>'success','message'=>'Folder Created']);
               
        }
        catch(Exception $e){
          
          return response()->json(['status'=>'success','message'=>'Something Went Wrong !']);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Folder $folder)
    {
        $check = File::where('folder_id','=',$folder->id)->get();

        if(count($check) > 0){

            return response()->json(['status'=>'error','message'=>'Opps The folder have some file in it']);
        }

        $folder->delete();
        return response()->json(['status'=>'success','message'=>'Folder Deleted']);

    }
}
