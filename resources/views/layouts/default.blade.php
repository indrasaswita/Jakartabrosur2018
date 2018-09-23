<!doctype html>
<html>
<head>
    <title>JB | @yield('title')</title>
    <meta name="csrf_token" content="{ csrf_token() }" />
    <meta name="title" content="@yield('title')">
    <meta name="description" content="@yield('description')">
    @include('includes.head')
</head>
<body ng-app="jakartabrosur">
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