<div class="row margin-0">
	<div class="col-xs-6">
		<div class="login-input">
			<div class="form-group" ng-class="{'has-danger':error.email != null, 'has-success':error.email==null&&alertshow}">
				<div class="input-group margin-0">
					<span class="input-group-addon" id="basic-addon1">@</span>
					<input type="text" id="signup-username" class="form-control form-control" ng-class="{'form-control-danger':error.email != null, 'form-control-success':error.email==null&&alertshow}" ng-model="customerData.email" data-toggle="tooltip" data-placement="right" title="email@example.com" placeholder="Email Anda">
				</div>
				<small class="text-muted">[[getIndex0(error.email)]]</small>
			</div>
			<div class="input-group form-group" ng-class="{'has-danger':error.password != null, 'has-success':error.password==null&&alertshow}">
				<input type="password" id="signup-password" class="form-control" ng-class="{'form-control-danger':error.password != null, 'form-control-success':error.password==null&&alertshow}" ng-model="customerData.password" data-toggle="tooltip" data-placement="right" title="min. 6 digits" placeholder="Buat Password" />
				<small class="text-muted">[[getIndex0(error.password)]]</small>
			</div>
			<div class="input-group form-group" ng-class="{'has-danger':error.cpassword != null, 'has-success':error.cpassword==null&&alertshow}">
				<input type="password" id="confirm-password" class="form-control" ng-class="{'form-control-danger':error.cpassword != null, 'form-control-success':error.cpassword==null&&alertshow}" ng-model="customerData.cpassword" placeholder="Konfirmasi Password" />
				<small class="text-muted">[[getIndex0(error.cpassword)]]</small>
			</div>
			<div class="form-group" ng-class="{'has-danger':error.name != null, 'has-success':error.name==null&&alertshow}" >
				<input type="text" class="form-control" ng-class="{'form-control-danger':error.name != null, 'form-control-success':error.name==null&&alertshow}" ng-model="customerData.name" placeholder="Nama Lengkap">
				<small class="text-muted">[[getIndex0(error.name)]]</small>
			</div>
			<div class="input-group radio form-group" >
				<label class="radio-title">Tipe Perusahaan :</label> <br/>
				<label class="custom-control custom-radio">
					<input ng-model="customerData.type" id="type-personal" name="type" type="radio" class="custom-control-input" value="personal">
					<span class="custom-control-indicator"></span>
					<span class="custom-control-description">Perorangan</span>
				</label>
				<label class="custom-control custom-radio">
					<input ng-model="customerData.type" id="type-corporate" name="type" type="radio" class="custom-control-input" value="corporate">
					<span class="custom-control-indicator"></span>
					<span class="custom-control-description">Perusahaan</span>
				</label>
				<label class="custom-control custom-radio">
					<input ng-model="customerData.type" id="type-female" name="type" type="radio" class="custom-control-input" value="organisation">
					<span class="custom-control-indicator"></span>
					<span class="custom-control-description">Ogranisasi</span>
				</label>
			</div>
			<div class="input-group radio form-group" >
				<label class="radio-title">Jenis Kelamin :</label> <br />
				<label class="custom-control custom-radio">
					<input ng-model="customerData.title" id="title-male" name="title" type="radio" class="custom-control-input" value="Mr.">
					<span class="custom-control-indicator"></span>
					<span class="custom-control-description">Pria</span>
				</label>
				<label class="custom-control custom-radio">
					<input ng-model="customerData.title" id="title-female" name="title" type="radio" class="custom-control-input" value="Mrs.">
					<span class="custom-control-indicator"></span>
					<span class="custom-control-description">Wanita</span>
				</label>
			</div>
		</div>
	</div>
	<div class="col-xs-6">
		<div class="login-input">
			<div class="input-group form-group" ng-class="{'has-danger':error.address != null, 'has-success':error.address==null&&alertshow}">
				<input type="text" class="form-control" ng-class="{'form-control-danger':error.address != null, 'form-control-success':error.address==null&&alertshow}" ng-model="customerData.address" placeholder="Address">
				<small class="text-muted">[[getIndex0(error.address)]]</small>
			</div>
			<div class="input-group form-group" ng-class="{'has-danger':error.postcode != null, 'has-success':error.postcode==null&&alertshow}">
				<input type="text" class="form-control" ng-class="{'form-control-danger':error.postcode != null, 'form-control-success':error.postcode==null&&alertshow}" ng-model="customerData.postcode" placeholder="Kode Pos">
				<small class="text-muted">[[getIndex0(error.postcode)]]</small>
			</div>
			<div class="form-group">
				<div>Kota</div>
				<select class="form-control" ng-model="customerData.cityID" id="form-cityID" ng-options="x.id as x.name for x in cities"></select>
			</div>
			<div class="input-group form-group" ng-class="{'has-danger':error.phone1 != null, 'has-success':error.phone1==null&&alertshow}">
				<input type="text" class="form-control" ng-class="{'form-control-danger':error.phone1 != null, 'form-control-success':error.phone1==null&&alertshow}" ng-model="customerData.phone1" placeholder="No. Telp 1">
				<small class="text-muted">[[getIndex0(error.phone1)]]</small>
			</div>
			<div class="input-group form-group" ng-class="{'has-danger':error.phone2 != null, 'has-success':error.phone2==null&&alertshow}">
				<input type="text" class="form-control" ng-class="{'form-control-danger':error.phone2 != null, 'form-control-success':error.phone3==null&&alertshow}" ng-model="customerData.phone2" placeholder="No. Telp 2">
				<small class="text-muted">[[getIndex0(error.phone2)]]</small>
			</div>
			<div class="input-group form-group" ng-class="{'has-danger':error.phone3 != null, 'has-success':error.phone3==null&&alertshow}">
				<input type="text" class="form-control" ng-class="{'form-control-danger':error.phone3 != null, 'form-control-success':error.phone3==null&&alertshow}" ng-model="customerData.phone3" placeholder="No. Telp 3">
				<small class="text-muted">[[getIndex0(error.phone3)]]</small>
			</div>
		</div>
	</div>
</div>

<div class="row margin-10-0">
	<div class="col-xs-12">
		<div class="form-group margin-0 padding-0">
			<div class="custom-control custom-checkbox">
				<input type='checkbox' class="form-check-input" ng-model="customerData.terms"> 
				<span>Dengan ini Anda menyetujui <a href="#">Syarat & Ketentuan</a> yang berlaku.</span>
			</div>
		</div>
		<small class="red">[[getIndex0(error.terms)]]</small>
		<div class="form-group margin-0 padding-0">
			<div class="custom-control custom-checkbox">
				<input type='checkbox' class="form-check-input" ng-change="setNews(customerData.newsvalue)" ng-model="customerData.newsvalue"> 
				<span>Dengan ini Anda ingin menerima berita baru & promosi mengenai website kami. <div class="badge badge-danger text-regular">not yet</div></span>
			</div>
		</div>
		<div class="login-redirector">
			Sudah Punya Akun?
			<div class="redirect">
				<a href="{{URL::asset('signup')}}" class="btn btn-purple">
					<i class="fal fa-user-plus fa-fw"></i>
					Log-In sekarang
				</a>
			</div>
		</div>
	</div>
</div>