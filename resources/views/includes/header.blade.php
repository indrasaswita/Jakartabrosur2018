<nav class="navbar navbar-purple">
	<button class="navbar-toggler hidden-md-up" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation" ng-click="togglerClicked()">
		<span class="fas fa-chevron-down transition"></span>
	</button>
	<a class="navbar-brand hidden-md-up sm" href="{{Request::path()=='/'?'#':(URL::asset('home'))}}">
  	<!-- <img src="{{URL::asset('image/logo-new.png')}}" alt="logo" height="20px"> -->
  	<span class="tx-purple">JKT</span><span class="tx-gray">BROSUR</span>
  </a>
	<div class="collapse navbar-toggleable-sm" id="navbar-collapse">
    <a class="navbar-brand hidden-sm-down lg" href="{{Request::path()=='/'?'#':(URL::asset('home'))}}">
    	<!-- <img src="{{URL::asset('image/logo-new.png')}}" alt="logo" height="20px"> -->
    	<span class="tx-purple">JAKARTA</span><span class="tx-gray">BROSUR</span><span class="size-50p">.com</span>
    </a>
    
    <ul class="nav navbar-nav">

	    <li class="nav-item" ng-class="{'active':'{{Request::path()}}'=='home'||'{{Request::path()}}'=='/'}">
	        <a class="nav-link" href="{{URL::asset('home')}}">
	        	<div class="ico">
	        		<i class="fa fa-home"></i> 
	        	</div>
	        	<div class="txt">HOME</div>
        	</a>
	    </li>
	    <li class="nav-item" ng-class="{'active':'{{Request::path()}}'=='orderlistcustomer'||'{{Request::path()}}'.startsWith('shop/')}">
	        <a class="nav-link" href="{{URL::asset('orderlistcustomer')}}">
	        	<div class="ico">
	        		<i class="fa fa-briefcase"></i> 
	        	</div>
	        	<div class="txt">ORDER</div>
        	</a>
	    </li>
		@if(Session::has('role'))
			@if(Session::get('role') == 'customer')

    	<li class="nav-item dropdown" ng-class="{'active':'{{Request::path()}}'.startsWith('cart')||'{{Request::path()}}'.startsWith('sales/all')}">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" href="{{URL::asset('orderlistcustomer')}}">
        	<div class="ico dropdown-toggle">
        		<i class="fa fa-book"></i> 
        	</div>
        	<div class="txt">TRANSAKSI</div>
      	</a>
      	<div class="dropdown-menu-center">
      		<div class="wrapper">
						<div class="dropdown-menu">
							<a class="dropdown-item" href="{{URL::asset('cart')}}"><span class="fas fa-shopping-basket icon"></span>Cart</a>
							<a class="dropdown-item" href="{{URL::asset('sales/all')}}"><span class="fas fa-shopping-bag icon"></span>Pembelian</a>
						</div>
					</div>
				</div>
			</li>
			@elseif(Session::get('role') != 'customer')
			<li class="nav-item dropdown" ng-class="{'active':'{{Request::path()}}'=='admin/master/paper'||'{{Request::path()}}'=='admin/master/customer'||'{{Request::path()}}'=='admin/allsales'||'{{Request::path()}}'=='admin/cart'}">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" href="{{URL::asset('orderlistcustomer')}}">
        	<div class="ico dropdown-toggle">
        		<i class="fas fa-key"></i> 
        	</div>
        	<div class="txt">MASTER</div>
      	</a>
      	<div class="dropdown-menu-center">
      		<div class="wrapper">
						<div class="dropdown-menu">
							<a class="dropdown-item" href="{{URL::asset('admin/allsales')}}">
								<span class="fa fa-shopping-bag icon"></span>
								Semua Penjualan
							</a>
							<a class="dropdown-item" href="{{URL::asset('admin/cart')}}">
								<span class="fas fa-shopping-basket icon"></span>
								Keranjang Belanja
							</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="{{URL::asset('admin/master/paper')}}">
								<span class="fa fa-sticky-note icon"></span>
								Detail Kertas
							</a>
							<a class="dropdown-item" href="{{URL::asset('admin/master/customer')}}">
								<span class="fa fa-user icon"></span>
								Detail Pelanggan
							</a>
							<a class="dropdown-item" href="{{URL::asset('admin/master/pendingcompany')}}">
								<span class="fa fa-user icon"></span>
								Pending Company
							</a>
						</div>
					</div>
				</div>
	    </li>
			@endif
		@endif
		@if(Session::has('role'))
			<li class="nav-item dropdown" ng-class="{'active':'{{Request::path()}}'=='profile'||'{{Request::path()}}'=='chpass'}">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" href="{{URL::asset('orderlistcustomer')}}">
        	<div class="ico dropdown-toggle">
        		<i class="fa fa-user"></i> 
        	</div>
        	<div class="txt">
        		{{ strtoupper( explode(' ',trim( Session::get( 'name' )) )[0] ) }}
      		</div>
      	</a>
      	<div class="dropdown-menu-center">
      		<div class="wrapper">
						<div class="dropdown-menu">
							<a class="dropdown-item" href="{{URL::asset('profile')}}">
								<span class="fas fa-male icon"></span> 
								Profil Saya
							</a>
							<a class="dropdown-item" href="{{URL::asset('chpass')}}">
								<span class="fas fa-key icon"></span> 
								Change Password
							</a>
							<!-- <a class="dropdown-item" href="{{URL::asset('ussetting')}}"><span class="glyphicon glyphicon-cog icon"></span>Setting</a> -->
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="{{URL::asset('logout')}}">
								<span class="fas fa-lock icon"></span> 
								Keluar
							</a>
						</div>
					</div>
				</div>
	    </li>
		@else
			<li class="nav-item dropdown" ng-class="{'active':'{{Request::path()}}'=='login'||'{{Request::path()}}'=='signup'}">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" href="{{URL::asset('orderlistcustomer')}}">
        	<div class="ico dropdown-toggle">
        		<i class="fa fa-power-off"></i> 
        	</div>
        	<div class="txt">ACCOUNT</div>
      	</a>
      	<div class="dropdown-menu-center">
      		<div class="wrapper">
						<div class="dropdown-menu">
							<a class="dropdown-item" href="{{URL::asset('login?url=').(substr(Request::getPathInfo(),1).(Request::getQueryString()?('?'.Request::getQueryString()):''))}}">
								<span class="fas fa-lock-open"></span> LOGIN
							</a>
							<a class="dropdown-item" href="{{URL::asset('signup')}}">
								<span class="fas fa-key"></span> DAFTAR BARU
							</a>
						</div>
					</div>
				</div>
	    </li>
		@endif
  	</ul>
	</div>
</nav>