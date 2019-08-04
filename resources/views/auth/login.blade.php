@extends('include.master')

@section('content')
      <div class="row">
         <div class="col-md-6 mr-auto ml-auto">
           <!-- Material form login -->
<div class="card hoverable">

  <h5 class="card-header pink darken-4 white-text text-center py-4">
    <strong>Sign in</strong>
  </h5>

  <!--Card content-->
  <div class="card-body  px-lg-5 pt-0">


<form class="text-center" style="color: #757575;" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
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

      <div class="d-flex justify-content-around">
        <div>
          <!-- Remember me -->
          <div class="form-check">
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="form-check-input" id="materialLoginFormRemember">
            <label class="form-check-label" for="materialLoginFormRemember">Remember me</label>
          </div>
        </div>
        <div>
          <!-- Forgot password -->
          <a href="{{ route('password.request') }}">Forgot password?</a>
        </div>
      </div>

      <!-- Sign in button -->
      <button class="btn btn-outline-pink btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Sign in</button>

      <!-- Register -->
      <p>Not a member?
        <a href="{{ url('register') }}">Register</a>
      </p>

      <!-- Social login -->
      <p>or sign in with:</p>
      <a href="{{ url('auth/facebook') }}"  class="btn-floating btn-fb btn-sm">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a type="button" class="btn-floating btn-tw btn-sm">
        <i class="fab fa-twitter"></i>
      </a>
      <a type="button" class="btn-floating btn-li btn-sm">
        <i class="fab fa-linkedin-in"></i>
      </a>
      <a type="button" class="btn-floating btn-git btn-sm">
        <i class="fab fa-github"></i>
      </a>

    </form>
    <!-- Form -->

  </div>

</div>
<!-- Material form login -->
         </div>
       </div> 
@endsection
