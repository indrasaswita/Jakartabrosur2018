<nav class="navbar navbar-purple disable-select">
	<button class="navbar-toggler hidden-md-up" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation" ng-click="togglerClicked()">
		<span class="fas fa-fw fa-chevron-down transition"></span>
	</button>
	<a class="navbar-brand hidden-md-up sm" href="{{Request::path()=='/'?'#':(URL::asset('home'))}}">
  	<img class="hidden-xs-down" src="{{URL::asset('image/logo-transp/logo-contrast-200px.png')}}" alt="logo" height="50px">
  	<span class="tx-purple">Jakarta</span><span class="tx-gray">brosur</span>
  	<!-- <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="183px" height="31px">
			<g transform="scale(0.25)">
  	@include ("includes.subheader-logo")
 			</g>
 		</svg> -->
  </a>
	<div class="collapse navbar-toggleable-sm" id="navbar-collapse">
    <a class="navbar-brand hidden-sm-down lg" href="{{Request::path()=='/'?'#':(URL::asset('home'))}}">
    	<img src="{{URL::asset('image/logo-transp/logo-contrast-200px.png')}}" alt="logo" height="70px"><span class="tx-purple">Jakarta</span><span class="tx-gray">brosur</span><!-- <span class="size-50p">.com</span> -->
    	<!-- <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="278px" height="47px">
				<g transform="scale(0.38)">
	  	@include ("includes.subheader-logo")
	 			</g>
	 		</svg> -->
    </a>
    
    <ul class="nav navbar-nav">

	    <li class="nav-item" ng-class="{'active':'{{Request::path()}}'=='home'||'{{Request::path()}}'=='/'}">
	        <a class="nav-link" href="{{URL::asset('home')}}">
	        	<div class="ico">
	        		<i class="fal fa-fw fa-home"></i> 
	        	</div>
	        	<div class="txt">HOME</div>
        	</a>
	    </li>
	    <li class="nav-item" ng-class="{'active':'{{Request::path()}}'=='orderlistcustomer'||'{{Request::path()}}'.startsWith('shop/')}">
	        <a class="nav-link" href="{{URL::asset('orderlistcustomer')}}">
	        	<div class="ico">
	        		<i class="fal fa-fw fa-abacus"></i> 
	        	</div>
	        	<div class="txt">ORDER</div>
        	</a>
	    </li>
		@if(Session::has('role'))
			@if(Session::get('role') == 'customer')

    	<li class="nav-item dropdown" ng-class="{'active':'{{Request::path()}}'.startsWith('cart')||'{{Request::path()}}'.startsWith('sales/all')}">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" href="{{URL::asset('orderlistcustomer')}}">
        	<div class="ico dropdown-toggle">
        		<i class="fal fa-fw fa-ballot-check"></i> 
        	</div>
        	<div class="txt">TRANSAKSI</div>
      	</a>
      	<div class="dropdown-menu-center">
      		<div class="wrapper">
						<div class="dropdown-menu">
							<div class="dropdown-title">
								Transaksi Anda
								<!-- <i class="far fa-hammer fa-fw tx-lightgray"></i> -->
							</div>
							<a class="dropdown-item" href="{{URL::asset('cart')}}"><span class="far fa-fw fa-shopping-basket icon"></span>Cart</a>
							<a class="dropdown-item" href="{{URL::asset('sales/all')}}"><span class="far fa-fw fa-shopping-bag icon"></span>Pembelian</a>
						</div>
					</div>
				</div>
			</li>
			@elseif(Session::get('role') != 'customer')
			<li class="nav-item dropdown" ng-class="{'active':'{{Request::path()}}'=='admin/master/pricepaper'||'{{Request::path()}}'=='admin/master/customer'||'{{Request::path()}}'=='admin/allsales'||'{{Request::path()}}'=='admin/cart'}">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" href="{{URL::asset('orderlistcustomer')}}">
        	<div class="ico dropdown-toggle">
        		<i class="fal fa-fw fa-user-cog"></i> 
        	</div>
        	<div class="txt">MASTER</div>
      	</a>
      	<div class="dropdown-menu-center">
      		<div class="wrapper">
						<div class="dropdown-menu">
							<div class="dropdown-title">
								View 
								<i class="fas fa-eye fa-fw tx-purple"></i>
							</div>
							<a class="dropdown-item" href="{{URL::asset('admin/allsales')}}">
								<span class="far fa-fw fa-shopping-bag icon"></span>
								Semua Penjualan
							</a>
							<a class="dropdown-item" href="{{URL::asset('admin/pricetext')}}">
								<span class="far fa-fw fa-percentage icon"></span>
								Prices in Text
							</a>
							<a class="dropdown-item" href="{{URL::asset('admin/cart')}}">
								<span class="far fa-fw fa-shopping-basket icon"></span>
								Keranjang Belanja
							</a>
							<div class="dropdown-divider"></div>
							<div class="dropdown-title">
								Need to do
								<i class="fas fa-user-clock fa-fw tx-purple"></i>
							</div>
							<a class="dropdown-item" href="{{URL::asset('admin/master/pendingcompany')}}">
								<span class="far fa-fw fa-circle-notch fa-spin icon"></span>
								Pending Company
							</a>
							<a class="dropdown-item" href="{{URL::asset('admin/master/pendingcustomer')}}">
								<span class="far fa-fw fa-circle-notch fa-spin icon"></span>
								Pending Customer
							</a>
						</div>
					</div>
				</div>
	    </li>
	    <li class="nav-item dropdown" ng-class="{'active':'{{Request::path()}}'=='admin/master/pricepaper'||'{{Request::path()}}'=='admin/master/customer'||'{{Request::path()}}'=='admin/allsales'||'{{Request::path()}}'=='admin/cart'}">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" href="{{URL::asset('orderlistcustomer')}}">
        	<div class="ico dropdown-toggle">
        		<i class="fal fa-fw fa-key"></i> 
        	</div>
        	<div class="txt">EDITOR</div>
      	</a>
      	<div class="dropdown-menu-center">
      		<div class="wrapper">
						<div class="dropdown-menu">
							<div class="dropdown-title">
								View 
								<i class="fas fa-eye fa-fw tx-purple"></i>
							</div>
							<div class="dropdown-title">
								Master Editor  
								<span class="fas fa-pen-nib fa-fw tx-purple"></span>
							</div>
							<a class="dropdown-item" href="{{URL::asset('admin/master/pricepaper')}}">
								<span class="far fa-fw fa-tags icon"></span>
								Harga Kertas
							</a>
							<a class="dropdown-item" href="{{URL::asset('admin/master/newpaper')}}">
								<span class="far fa-fw fa-layer-plus icon"></span>
								Tambah Kertas
							</a>
							<a class="dropdown-item" href="{{URL::asset('admin/master/customer')}}">
								<span class="far fa-fw fa-users-cog icon"></span>
								Detail Pelanggan
							</a>
							<div class="dropdown-divider"></div>
							<div class="dropdown-title">
								JOB detail Editor  
								<span class="fas fa-pen-nib fa-fw tx-purple"></span>
							</div>
							<a class="dropdown-item" href="{{URL::asset('admin/master/shoppricing')}}">
								<span class="far fa-fw fa-percentage icon"></span>
								JOB Price Editor
							</a>
							<a class="dropdown-item" href="{{URL::asset('admin/master/jobactivation')}}">
								<span class="far fa-fw fa-power-off icon"></span>
								JOB Activation
							</a>
							<a class="dropdown-item" href="{{URL::asset('admin/master/jobeditor')}}">
								<span class="far fa-fw fa-paperclip icon"></span>
								JOB Detail Editor
							</a>
							<a class="dropdown-item" href="{{URL::asset('admin/master/jobfinishingeditor')}}">
								<span class="far fa-fw fa-magic icon"></span>
								JOB Finishings
							</a>
							<a class="dropdown-item" href="{{URL::asset('admin/master/jobsizeeditor')}}">
								<span class="far fa-fw fa-expand-arrows-alt icon"></span>
								JOB Sizes
							</a>
							<a class="dropdown-item" href="{{URL::asset('admin/master/jobpapereditor')}}">
								<span class="far fa-fw fa-copy icon"></span>
								JOB Papers
							</a>
							<a class="dropdown-item" href="{{URL::asset('admin/master/jobquantityeditor')}}">
								<span class="far fa-fw fa-abacus icon"></span>
								JOB Quantities
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
        		<span class="fal fa-fw fa-user"></span> 
        	</div>
        	<div class="txt">
        		{{ strtoupper( explode(' ',trim( Session::get( 'name' )) )[0] ) }}
      		</div>
      	</a>
      	<div class="dropdown-menu-center">
      		<div class="wrapper">
						<div class="dropdown-menu">
							<div class="dropdown-title">
								Hi, 
								{{ strtoupper( explode(' ',trim( Session::get( 'name' )) )[0] ) }}
								<span class="fas fa-mitten fa-fw tx-purple"></span>
							</div>
							<a class="dropdown-item" href="{{URL::asset('notification')}}" ng-if="notifcount>0">
								<span class="far fa-fw fa-bell icon"></span> 
								Notification
								<div class="badge-notif">
									[[notifcount]]
								</div>
							</a>
							<a class="dropdown-item" href="{{URL::asset('profile')}}">
								<span class="far fa-fw fa-address-card icon"></span> 
								Profil Saya
							</a>
							<a class="dropdown-item" href="{{URL::asset('chpass')}}">
								<span class="far fa-fw fa-key icon"></span> 
								Change Password
							</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="{{URL::asset('logout')}}">
								<span class="far fa-fw fa-sign-out-alt icon"></span> 
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
        		<i class="far fa-fw fa-power-off"></i> 
        	</div>
        	<div class="txt">ACCOUNT</div>
      	</a>
      	<div class="dropdown-menu-center">
      		<div class="wrapper">
						<div class="dropdown-menu">
							<a class="dropdown-item" href="{{URL::asset('login?url=').(substr(Request::getPathInfo(),1).(Request::getQueryString()?('?'.Request::getQueryString()):''))}}">
								<span class="far fa-fw fa-sign-in-alt icon"></span> LOGIN
							</a>
							<a class="dropdown-item" href="{{URL::asset('signup')}}">
								<span class="far fa-fw fa-user-plus icon"></span> DAFTAR BARU
							</a>
						</div>
					</div>
				</div>
	    </li>
		@endif
  	</ul>
	</div>
</nav>