<!doctype html>
<html>
<head>
  <title>@yield('title') | jakartabrosur.com</title>
  <meta name="csrf_token" content="{ csrf_token() }" />
  <meta name="title" content="@yield('title')">
  <meta name="description" content="@yield('description')">
  <meta name="keywords" content="@yield('keywords')">
  <meta name="robots" content="" nt="@yield('robots')">
  @include('includes.head')
</head>
<body ng-app="jakartabrosur" class="bg-faded">
@include('layouts.preloader-wrapper')
<div ng-controller="HandOfGod as god" id="content-wrapper" class="none">

  @if(Session::has('role'))
    <div ng-init="role('{{Session::get('role')}}','{{Session::get('userid')}}')" hidden></div>  <!-- buat set role customer apa admin -->
  @endif

  @include('includes.preheader')
  @include('includes.header')
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