<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

				<meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
				<h2>Sala {{ $id }}</h2>

        <div id="app">
            <add-task-component room="{{ $id }}"></add-task-component>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
        <script>
        window.Echo.channel('canal')
					.listen('EventSocket', function(e){
						console.log(e);
					});

				{{--
				window.Echo.channel('notification.' + {{Auth::user()->id}})
					.listen('EventSocket', function(e){
						alert(e.message);
					});
				--}}
        </script>
    </body>
</html>
