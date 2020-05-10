<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @if (App::environment('local'))
            <script src="{{ asset('js/app.js') }}" defer></script>
        @endif

        @if (App::environment('production'))
            <script src="{{ asset('public/js/app.js') }}" defer></script>
        @endif

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        {{-- <script src="http://malsup.github.com/jquery.form.js"></script>--}}

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
        <!-- Styles -->
        @if (App::environment('local'))
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @endif

        @if (App::environment('production'))
            <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
        @endif

    </head>

    <x-nav/> {{-- Nav Component --}}
    
    <body>

        <div id="app">

            <div class="container mx-auto">

                <x-flashmessages /> {{-- Flash Messages component --}}

                <main class="flex mt-12">

                    @auth

                        <x-sidebar/> {{-- SidBar Component --}}

                    @endauth

                    <div class="primary flex-1">
                        
                        @yield('content')

                    </div>
                    
                </main>
                
            </div>
            
        </div>

        <script>
            function checkMedia(x) {
              if (x.matches) { // If media query matches
                if(document.getElementById('getWidth')){
                    var width = document.getElementById('getWidth').offsetWidth;
                    document.querySelector("div.dropdown-content").style.width = width+100+'px';
                    document.querySelector("div.dropdown-content").classList.add("-ml-20");
                    document.querySelector("img.mobile").classList.add("dropbtn");     
                }
              } 
              else {
                if(document.getElementById('getWidth')){
                    var width = document.getElementById('getWidth').offsetWidth;
                    document.querySelector("div.dropdown-content").style.width = width+'px';
                }
              }
            }

            var x = window.matchMedia("(max-width: 640px)")
            checkMedia(x)
            x.addListener(checkMedia)
        </script>
        
    </body>

</html>
