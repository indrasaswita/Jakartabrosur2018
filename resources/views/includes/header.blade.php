<nav class="navbar navbar-purple disable-select" ng-controller="NavHeaderController">
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
	    <li class="nav-item" ng-class="{'active':isOrder('{{Request::path()}}')}">
	        <a class="nav-link" href="{{URL::asset('orderlistcustomer')}}">
	        	<div class="ico">
	        		<i class="fal fa-fw fa-abacus"></i> 
	        	</div>
	        	<div class="txt">ORDER</div>
        	</a>
	    </li>
		@if(Session::has('role'))
			@if(Session::get('role') == 'customer')

    	<li class="nav-item dropdown" ng-class="{'active':isCustTransaksi('{{Request::path()}}')}">
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
							<a class="dropdown-item" href="{{URL::asset('cart')}}"><span class="far fa-fw fa-shopping-basket icon"></span>Keranjang</a>
							<a class="dropdown-item" href="{{URL::asset('sales/all')}}"><span class="far fa-fw fa-shopping-bag icon"></span>Pembelian</a>
						</div>
					</div>
				</div>
			</li>
			@elseif(Session::get('role') != 'customer')
			<li class="nav-item dropdown" ng-class="{'active':isEmpTransaksi('{{Request::path()}}')}">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" href="{{URL::asset('orderlistcustomer')}}">
        	<div class="ico dropdown-toggle">
        		<i class="fal fa-fw fa-shredder"></i> 
        	</div>
        	<div class="txt">TRANSAKSI</div>
      	</a>
      	<div class="dropdown-menu-center">
      		<div class="wrapper">
						<div class="dropdown-menu">
							<div class="dropdown-title">
								Add New User
								<i class="fas fa-eye fa-fw tx-purple"></i>
							</div>
							<a class="dropdown-item" href="{{URL::asset('admin/addusernopass')}}">
								<span class="far fa-fw fa-user-plus icon"></span>
								Add User No-Pass
							</a>
							<a class="dropdown-item" href="{{URL::asset('admin/setcartperuser')}}">
								<span class="far fa-fw fa-bezier-curve icon"></span>
								Set Cart Per-User
							</a>
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
								<i class="fal fa-hourglass-start fa-fw"></i>
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
	    <li class="nav-item dropdown" ng-class="{'active':isEmpMaster('{{Request::path()}}')}">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" href="{{URL::asset('orderlistcustomer')}}">
        	<div class="ico dropdown-toggle">
        		<i class="fal fa-fw fa-key"></i> 
        	</div>
        	<div class="txt">MASTER</div>
      	</a>
      	<div class="dropdown-menu-center">
      		<div class="wrapper">
						<div class="dropdown-menu">
							<div class="dropdown-title">
								KERTAS
								<span class="fas fa-paper-plane fa-fw tx-purple"></span>
							</div>
							<a class="dropdown-item" href="{{URL::asset('admin/master/pricepaper')}}">
								<span class="far fa-fw fa-tags icon"></span>
								Harga Kertas
							</a>
							<a class="dropdown-item" href="{{URL::asset('admin/master/newpaper')}}">
								<span class="far fa-fw fa-layer-plus icon"></span>
								Tambah Kertas
							</a>
							<a class="dropdown-item" href="{{URL::asset('admin/master/paperdetailstore')}}">
								<span class="far fa-fw fa-store icon"></span>
								Tambah Kertas Vendor & Details
							</a>
							<a class="dropdown-item" href="{{URL::asset('admin/master/vendor')}}">
								<span class="far fa-fw fa-store icon"></span>
								Tambah Vendor + Detail
							</a>
							<div class="dropdown-divider"></div>
							<div class="dropdown-title">
								FINISHING 
								<i class="fas fa-eye fa-fw tx-purple"></i>
							</div>
							<a class="dropdown-item" href="{{URL::asset('admin/master/finishings')}}">
								<span class="far fa-fw fa-layer-plus icon"></span>
								Tambah Finishing + Harga
							</a>
							<div class="dropdown-divider"></div>
							<div class="dropdown-title">
								CUSTOMER REVIEW 
								<i class="fas fa-eye fa-fw tx-purple"></i>
							</div>
							<a class="dropdown-item" href="{{URL::asset('admin/master/customer')}}">
								<span class="far fa-fw fa-users-cog icon"></span>
								Detail Pelanggan
							</a>
							<a class="dropdown-item" href="{{URL::asset('admin/master/onesignal')}}">
								<span class="far fa-fw fa-signal icon"></span>
								Onesignal Emp + Cust
							</a>
						</div>
					</div>
				</div>
	    </li>
	    <li class="nav-item dropdown" ng-class="{'active':isEmpJobsubtype('{{Request::path()}}')}">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" href="{{URL::asset('orderlistcustomer')}}">
        	<div class="ico dropdown-toggle">
        		<i class="fal fa-fw fa-bullseye-pointer"></i> 
        	</div>
        	<div class="txt">JOBSTYPE</div>
      	</a>
      	<div class="dropdown-menu-center">
      		<div class="wrapper">
						<div class="dropdown-menu">
							<div class="dropdown-title">
								Status 
								<i class="fas fa-mandolin fa-fw tx-purple"></i>
							</div>
							<a class="dropdown-item" href="{{URL::asset('admin/master/jobactivation')}}">
								<span class="far fa-fw fa-power-off icon"></span>
								JOB Activation
							</a>
							<div class="dropdown-divider"></div>
							<div class="dropdown-title">
								Detil 
								<i class="fas fa-mandolin fa-fw tx-purple"></i>
							</div>
							<a class="dropdown-item" href="{{URL::asset('admin/master/shoppricing')}}">
								<span class="far fa-fw fa-layer-plus icon"></span>
								Finishing + Constant Price
							</a>
							<a class="dropdown-item" href="{{URL::asset('admin/master/jobeditor')}}">
								<span class="far fa-fw fa-paperclip icon"></span>
								JOB Detail Editor
							</a>
							<div class="dropdown-divider"></div>
							<div class="dropdown-title">
								Sub JOB 
								<i class="fas fa-mandolin fa-fw tx-purple"></i>
							</div>
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
	    <li class="nav-item dropdown" ng-class="{'active':'{{Request::path()}}'.startsWith('admin/master/ctw')}">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" href="{{URL::asset('orderlistcustomer')}}">
        	<div class="ico dropdown-toggle">
        		<i class="fal fa-fw fa-crown"></i> 
        	</div>
        	<div class="txt">GOD ROLE</div>
      	</a>
      	<div class="dropdown-menu-center">
      		<div class="wrapper">
						<div class="dropdown-menu">
							<div class="dropdown-title">
								Warning!
								<i class="fas fa-exclamation-triangle fa-fw tx-red"></i>
							</div>
							<a class="dropdown-item" href="{{URL::asset('admin/master/ctw/database')}}">
								<span class="far fa-fw fa-globe-europe icon"></span>
								Upload to Live!
							</a>
						</div>
					</div>
				</div>
	    </li>
			@endif
		@endif
		@if(Session::has('role'))
			<li class="nav-item dropdown" ng-class="{'active':isAccount('{{Request::path()}}')}">
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
								Notifikasi
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
								Ubah Password
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
			<li class="nav-item dropdown" ng-class="{'active':isAccount('{{Request::path()}}')}">
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