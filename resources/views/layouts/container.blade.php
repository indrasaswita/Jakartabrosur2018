<!doctype html>
<html>
<head>
    <meta name="csrf_token" content="{ csrf_token() }" />
    <title>JB | @yield('title')</title>
    <meta name="title" content="@yield('title')">
    @include('includes.head')
</head>
<body ng-app="jakartabrosur" class="bg-faded">

    @include('layouts.preloader-wrapper')

    <div ng-controller="HandOfGod as god" id="content-wrapper" style='display:none'>
        @include('includes.preheader')
        @include('includes.header')
        @include('layouts.loginmodal')
        @include('layouts.statictooltip')

        <div id="content" class="content">
            <div class="container">
                @yield('content')
            </div>
        </div>

        <footer class="footer">
            @include('includes.footer')
        </footer>

    </div>
</body>
</html>