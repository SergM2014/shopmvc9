<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="container">

            @include('custom.partials.header')

            <div class="content">
                @yield('content')
            </div>



        </div>

        @include('custom.partials.footer')

        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
