<?php

namespace App\Http\Controllers;

use App\Box;
use App\Folder;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.box');
    }

    public function boxList(Request $request){

        $box = Box::orderBy('id','asc');

        if($request->keyword != ''){
           $box->where('box_name','LIKE','%'.$request->keyword.'%');
         }

         $box = $box->paginate(10);

         return $box;
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
         'box_name' => 'required|unique:boxes,box_name'
       ]);

       try{
           
           $box = new Box;
           $box->box_name = $request->box_name;
           $box->description = $request->description;
           $box->save();
           return response()->json(['status'=>'success','message'=>'Box Added!']);
         }
         catch(\Exception $e){
            // return $e;
          return response()->json(['status'=>'error','message'=>'Something Went Wrong']);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function show(Box $box)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function edit(Box $box)
    {
        return $box;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Box $box)
    {
        $request->validate([
         'box_name' => 'required|unique:boxes,box_name,'.$box->id
       ]);

       try{
        
           $box->box_name = $request->box_name;
           $box->description = $request->description;
           $box->update();
           return response()->json(['status'=>'success','message'=>'Update Successful!']);
         }
         catch(\Exception $e){
            // return $e;
          return response()->json(['status'=>'error','message'=>'Something Went Wrong']);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function destroy(Box $box)
    {
        $check = Folder::where('box_id','=',$box->id)->get();

        if(count($check)>0){
          return response()->json(['status'=>'error','message'=>'Opps! box have some Folder !']);
         }
         else{
           $box->delete(); 
           return response()->json(['status'=>'success','message'=>'Box Deleted !']); 
         }

         
    }
}
