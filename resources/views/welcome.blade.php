<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
				<h2>Sala {{ $id ?? '1' }}</h2>
        <h2>{{ Auth::user()->name }}</h2>

        <div id="app">
            <add-task-component room="{{ $id ?? '1' }}"></add-task-component>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
        <script>
        window.Echo.channel('canal')
            .listen('EventSocket', function(e){
                console.log(e);
            });

        window.Echo.private('notificacion.' + {{Auth::user()->id}})
            .listen('Notificacion', function(e){
                alert(e.message);
            });
        </script>
    </body>
</html>
