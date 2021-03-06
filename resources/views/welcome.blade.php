<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

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
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .component-header {
                padding-bottom: 34px;
                padding-top: 34px;
            }
            li .options{
                cursor: pointer;
            }
            li:hover .options{
                margin-right:20px;
                font-size: 15px;
            }
            .glyphicon {
                margin-right: 20px;
            }
            .header-nav > a {
                padding-right: 20px;
            }
            .header-nav {
                padding: 20px;
                text-align: left;
            }
            body {
                font-size: 16px;
                font-weight: 600;
            }
            .note-form {
                padding-top: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div id="app" class="flex-center position-ref full-height">
                
            </div>
        </div>
        <script scr="{{ asset('js/app.js') }}"></script>
    </body>
</html>
