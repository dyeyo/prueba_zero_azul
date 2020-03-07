<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
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
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
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
                        <a href="{{ url('/home') }}">Inicio</a>
                    @else
                        <a href="{{ route('login') }}">Entrar</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Registrarse</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <img src="data:image/jpeg;base64,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" alt="">
                </div>

                <div class="links">
                   <h1>Bienvendios</h1>
                </div>
            </div>
        </div>
    </body>
</html>
