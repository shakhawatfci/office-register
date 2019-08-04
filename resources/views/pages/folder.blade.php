@extends('include.master')
@section('title','Folder Management')
@section('content')

<div class="row">
  <div class="col-md-12">

    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-6"><p class="mt-1">Folder Management</p></div>
          <div class="col-md-6 text-right">
            <button type="button" class="btn btn-sm  pink darken-4 white-text" data-toggle="modal" data-target="#folderModal">
             + Create Folder
           </button></div>
         </div>

         <div class="row">
           <create-folder :boxes="{{ $box }}"></create-folder>
        </div>



        </div>

        <div class="card-body">
          <view-folder :boxes="{{ $box }}"></view-folder>
        </div>
      </div>

    </div>
  </div>
 


  @endsection

  @push('script')
  <script type="text/javascript" src="{{ url('public/js/folder.js') }}"></script>
  @endpush
