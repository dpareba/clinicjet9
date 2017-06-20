<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name','ClinicJet') }} | Welcome</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                /*background-color: #fff;*/
                /* background-color: #FE5D26;*/ /* -- orange/red*/
                 background-color: #5DB7DE; /*--nice blue*/
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .link-doc:hover{
                color: #FFFFFF;
                /*color: #D3D3D3;*/
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a class="link-doc" href="{{ url('check') }}">Home</a>
                    @else
                        <a class="link-doc" href="{{ url('/login') }}">Login</a>
                        <a class="link-doc" href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                     {{config('app.name','ClinicJet')}}
                </div>

                <div class="links">
                    <a href="#" class="link-doc">Documentation</a>
                    <a href="#" class="link-doc">FAQ</a>
                    <a href="#" class="link-doc">Who We Are</a>
                    <a href="#" class="link-doc">What We Do</a>
                    <a href="#" class="link-doc">Contact Us</a>
                </div>
            </div>
        </div>
    </body>
</html>
