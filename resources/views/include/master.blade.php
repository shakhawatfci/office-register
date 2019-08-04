<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title','Amir Group Documents Register')</title>
  <!-- Font Awesome -->
  <link rel="icon" href="http://amirgroup.com.bd/img/fav.png" type="image/gif" sizes="16x16"> 
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="{{ url('css/mdb.min.css') }}" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="{{ url('css/compiled.css') }}" rel="stylesheet">
  <link href="{{ url('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!--Navbar -->
    <nav class="mb-1 navbar navbar-expand-lg navbar-dark pink darken-4 sticky-top">
      <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('img/logo.png') }}"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-3" aria-controls="navbarSupportedContent-3" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent-3">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link waves-effect waves-light" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link waves-effect waves-light" href="{{ route('document.index') }}">Documents</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Setting
            </a>
            <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-3">
              <a class="dropdown-item waves-effect waves-light" href="{{ route('box.index') }}">Box</a>
              <a class="dropdown-item waves-effect waves-light" href="{{ route('folder.index') }}">Folder</a>
              <a class="dropdown-item waves-effect waves-light" href="{{ route('file.index') }}">File</a>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto nav-flex-icons">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-secondary" aria-labelledby="navbarDropdownMenuLink">
              @if(Auth::check())
              <a class="dropdown-item waves-effect waves-light" href="{{ url('logout') }}">Logout</a>
              <a class="dropdown-item waves-effect waves-light" href="#">Password</a>
              @else
              <a class="dropdown-item waves-effect waves-light" href="{{ url('login') }}">Login</a>  
              <a class="dropdown-item waves-effect waves-light" href="{{ url('register') }}">Register</a>
              @endif
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container" id="app">
      @yield('content')
 
    </div>







  <script type="text/javascript" src="{{ url('js/jquery-3.4.1.min.js') }}"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="{{ url('js/popper.min.js') }}"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="{{ url('js/bootstrap.min.js') }}"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="{{ url('js/mdb.min.js') }}"></script>

  <script type="text/javascript">
    var base_url = "{{ url('/') }}"+'/';
  </script>

  @stack('script')

</body>

</html>
