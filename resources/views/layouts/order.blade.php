<!doctype html>
<html>
<head>
	<title>@yield('title') | jakartabrosur.com</title>
	<meta name="csrf_token" content="{ csrf_token() }" />
	<meta name="title" content="Pesan @yield('title')">
	<meta name="description" content="@yield('description')">
	<meta name="robots" content="@yield('robots')">
	@include('includes.head')
</head>
<body ng-app="jakartabrosur" class="bg-faded">

  @include('layouts.preloader-wrapper')

  <div ng-controller="HandOfGod as god" id="content-wrapper" class='none'>

	@if(Session::has('role'))
		<div ng-init="role('{{Session::get('role')}}','{{Session::get('userid')}}')" hidden></div>  <!-- buat set role customer apa admin -->
	@endif

		@include('includes.preheader')
		@include('includes.header')
		<!-- include('layouts.loginmodal') -->
		@include('layouts.statictooltip')

		<div id="content" class="content">

			<!-- <div class="flyer-content" ng-controller = "OffsetPricing"> -->
				<div ng-controller="OrderShopCalculationController">

					<div ng-init="setUserLogin('{{Session::get('role')}}', '{{Session::get('userid')}}')">
						
					</div>

					<div class="margin-0-15">
						@include('includes.nav.subnav')
					</div>


					<div class="order-wrapper" ng-init="setData({{json_encode($datas)}})" ng-hide="underconstruction==true">
						
						<!-- <div class="col-lg-3 sidebar sidebar-offcanvas"> -->
						<div class="order-description-wrapper hidden-xs-down">
							@include('pages.order.shop.sidebar-left')
						</div>
						<div class="order-content-wrapper">
							@yield('content')
						</div>
						
					</div>
					<div ng-show="underconstruction==true" class="order-wrapper">
						<div class="underconstruction-wrapper">
							@include('pages.order.shop.underconstruction')
						</div>
					</div>


				</div>
			<!-- </div> -->
		</div>

		<footer class="footer">
			@include('includes.footer')
		</footer>

	</div>
</body>
</html>