<!DOCTYPE HTML>
<html>
    <head>
        <title>Friend Finder - @yield('title')</title>
        <link rel="stylesheet" href="/css/app.css">
    </head>

    <body>
        <div id="body-container" class="container">
            <div id="header-container">
                @include('layouts.header')
            </div>

            <div id="main-content-container">
                @yield('content')
            </div>

            <div id="footer-container">
                @include('layouts.footer')
            </div>
        </div>
    </body>

</html>
