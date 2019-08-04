@extends('include.master')

@section('content')
      <div class="row">
         <div class="col-md-6 mr-auto ml-auto">
           <!-- Material form login -->
<div class="card hoverable">

  <h5 class="card-header pink darken-4 white-text text-center py-4">
    <strong>Register</strong>
  </h5>

  <!--Card content-->
  <div class="card-body px-lg-5 pt-0">


<form class="text-center" style="color: #757575;" method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
      <!-- Email -->
      <div class="md-form">
        <input type="text" name="name" value="{{ old('name') }}" id="materialLoginFormName" class="form-control">
        <label for="materialLoginFormName">Name</label>
             @if ($errors->has('name'))
                <span class="text-danger help-block">
                   <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
      </div>     

      <!-- Email -->
      <div class="md-form">
        <input type="email" name="email" value="{{ old('email') }}" id="materialLoginFormEmail" class="form-control">
        <label for="materialLoginFormEmail">E-mail</label>
             @if ($errors->has('email'))
                <span class="text-danger help-block">
                   <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
      </div>

      <!-- Password -->
      <div class="md-form">
        <input type="password" name="password" id="materialLoginFormPassword" class="form-control">
        <label for="materialLoginFormPassword">Password</label>
           @if ($errors->has('password'))
          <span class="text-danger help-block">
              <strong>{{ $errors->first('password') }}</strong>
          </span>
            @endif
      </div>     


      <!-- Password -->
      <div class="md-form">
        <input type="password" name="password_confirmation" id="materialLoginFormPasswordConfirm" class="form-control">
        <label for="materialLoginFormPasswordConfirm">Confirm Password</label>
      </div>


      <!-- Sign in button -->
      <button class="btn btn-outline-pink darken-4 btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Register</button>

      <!-- Register -->
      <p>Already Registered?
        <a href="{{ url('login') }}">Login</a>
      </p>


   

    </form>
    <!-- Form -->

  </div>

</div>
<!-- Material form login -->
         </div>
       </div> 
@endsection

