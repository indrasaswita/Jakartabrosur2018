<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body ng-app="jakartabrosur" class="bg-faded">

    <div id="preloader-wrapper" class="text-xs-center margin-top-80">
        <i class="fa fa-spinner fa-pulse fa-10x fa-fw tx-lightmagenta"></i>
    </div>

    <div ng-controller="HandOfGod as god" id="content-wrapper" style='display:none'>
        @include('includes.preheader')
        @include('includes.header')
        @include('includes.loginmodal')

        <div id="main" class="row">

            <!-- sidebar content -->
            <div id="sidebar" class="col-md-4">
                @include('includes.sidebar')
            </div>

            <!-- main content -->
            <div id="content" class="col-md-8">
                @yield('content')
            </div>

        </div>

        <footer class="row">
            @include('includes.footer')
        </footer>

    </div>
</body>
</html>