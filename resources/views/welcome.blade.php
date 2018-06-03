<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
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

            .subtitle {
                font-size: 36px;
            }

            .body {
              font-size: 18px;
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

            .btn {
              padding: 6px 12px;
              border: solid 1px #6a6a6a;
              border-radius: 8px;
              text-decoration: none;
            }

            .btn-lg {
              font-size: 160%;
              padding: 8px 16px;
            }

            .btn-primary {
              background-color: #636b6f;
              color: #fff;
              font-weight: 700;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{ env('APP_NAME') }}
                </div>

                <div class="subtitle m-b-md">
                  This is the API server for <strong>TxtMsgLan</strong>
                </div>

                <div class="body m-b-md">
                  <p>
                    <a href="https://bitbucket.org/revnoah/txtmsglanapi" class="btn btn-primary btn-large" title="Visit Main Client Interface">Project Page</a>
                    <a href="https://bitbucket.org/revnoah/txtmsglanapi/src/master/README.md" class="btn btn-primary btn-large" title="Project Read Me">Read Me</a>
                  </p>
                </div>

            </div>
        </div>
    </body>
</html>
