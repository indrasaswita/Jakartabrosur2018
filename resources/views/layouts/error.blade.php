<!doctype html>
<html>
<head>
	<meta name="csrf_token" content="{ csrf_token() }" />
	<title>JB | Error @yield('title')</title>
	<meta name="title" content="Error @yield('title')">
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
		@include('layouts.loginmodal')

		<div id="content" class="content">

				@yield('content')

		</div>

		<footer class="footer margin-0">
			@include('includes.footer')
		</footer>

	</div>
</body>
</html>