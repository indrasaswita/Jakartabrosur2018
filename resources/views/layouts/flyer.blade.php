<!doctype html>
<html>
<head>
    <meta name="csrf_token" content="{ csrf_token() }" />
    @include('includes.head')
</head>
<body ng-app="jakartabrosur" class="bg-faded">

    @include('layouts.preloader-wrapper')

    <div ng-controller="HandOfGod as god" id="content-wrapper" style='display:none'>
        @include('includes.preheader')
        @include('includes.header')
        @include('layouts.loginmodal')

        <div id="content" class="content">
            @include('includes.postheaderflyer')

            <div class="container flyer-content" ng-controller = "OffsetPricing">
                @if(Session::has('role'))
                    <div ng-init="setUserLogin()"></div>
                @endif
                <div class="row row-offcanvas">
                    <!-- <div class="col-lg-3 sidebar sidebar-offcanvas"> -->
                    <div class="col-lg-3 hidden-md-down">
                        @include('includes.sidebarflyer')
                    </div>
                    <div class="col-lg-9 hidden-md-down">
                        @yield('content')
                    </div>
                    <div class="col-md-4 hidden-sm-down hidden-lg-up">
                        @include('includes.sidebarflyer')
                    </div>
                    <div class="col-md-8 hidden-lg-up">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            @include('includes.footer')
        </footer>

    </div>
</body>
</html>