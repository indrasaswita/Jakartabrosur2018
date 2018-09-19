<!doctype html>
<html>
<head>
	<meta name="csrf_token" content="{ csrf_token() }" />
  <meta name="title" content="Pesan @yield('title')">
	<title>JB | Pesan @yield('title')</title>
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

			<!-- <div class="flyer-content" ng-controller = "OffsetPricing"> -->
				<div ng-controller="OrderShopCalculationController">

				<div ng-init="setUserLogin('{{Session::get('role')}}')">
					
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
						
						<!-- MODAL -->
						@include ('pages.order.shop.modals.delivery')
						@include ('pages.order.shop.modals.itemdescription')
						@include ('pages.order.shop.modals.uploadfile')
						@include ('pages.order.shop.modals.savedialog')
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