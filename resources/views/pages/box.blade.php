@extends('include.master')
@section('title','Box Management')
@section('content')

<div class="row">
  <div class="col-md-12">

    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-6"><p class="mt-1">Box Management</p></div>
          <div class="col-md-6 text-right">
            <button type="button" class="btn btn-sm  pink darken-4 white-text" data-toggle="modal" data-target="#modalBox">
             + Create Box
           </button></div>
         </div>

         <div class="row">
           <create-box ></create-box>
        </div>



        </div>

        <div class="card-body">
          <view-box ></view-box>
        </div>
      </div>

    </div>
  </div>
 


  @endsection

  @push('script')
  <script type="text/javascript" src="{{ url('public/js/box.js') }}"></script>
  @endpush
