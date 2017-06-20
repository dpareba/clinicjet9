<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ClinicJet') }} @yield('title')</title>

    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
     @yield('css')
       <style>
        /*Change Color of the Register Navbar*/
        .auth-navbar{
            background-color: #5DB7DE;
        }
        /*Parsleyjs css file*/
        input.parsley-success,
        select.parsley-success,
        textarea.parsley-success {
          color: #468847;
          background-color: #DFF0D8;
          border: 1px solid #D6E9C6;
      }

      input.parsley-error,
      select.parsley-error,
      textarea.parsley-error {
          color: #B94A48;
          background-color: #F2DEDE;
          border: 1px solid #EED3D7;
      }

      .parsley-errors-list {
          margin: 2px 0 3px;
          padding: 0;
          list-style-type: none;
          font-size: 0.9em;
          line-height: 0.9em;
          opacity: 0;

          transition: all .3s ease-in;
          -o-transition: all .3s ease-in;
          -moz-transition: all .3s ease-in;
          -webkit-transition: all .3s ease-in;
      }

      .parsley-errors-list.filled {
          opacity: 1;
      }
  </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top auth-navbar">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Clinicjet') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                           
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >
                                    
                                   {{Auth::user()->doctype!="RECEPTIONIST"?"DR.":''}} {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{asset('js/app.js')}}"></script>
    <script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
  {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.2/parsley.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    @if (Session::has('message'))
        <script>
            swal({
                    title:"{{Session::get('message')}}",
                    text:"{{Session::get('text')}}",
                    type:"{{Session::get('type')}}"
                    
                });
        </script>
    @endif
    @yield('js')
</body>
</html>
