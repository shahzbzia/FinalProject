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
        
    </body>

</html>
