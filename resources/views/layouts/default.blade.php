<!doctype html>
<html>
<head>
    <title>JB | @yield('title')</title>
    <meta name="csrf_token" content="{ csrf_token() }" />
    <meta name="title" content="@yield('title')">
    <meta name="description" content="@yield('description')">
    <meta name="robots" content="@yield('robots')">
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

            @yield('content')

        </div>

        <footer class="footer">
            @include('includes.footer')
        </footer>

    </div>
</body>
</html>