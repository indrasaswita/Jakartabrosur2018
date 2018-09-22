@extends('layouts.container')
@section('title', 'Sign-up')
@section('description', 'Daftar sebagai Pengguna untuk memesan.')
@section('robots', 'index')
@section('content')

<div ng-controller="LoginModal">
	<div ng-init="localselected.logintab='register'"></div>
	<form>
		<div class="login-wrapper">
			<div class="login-header">
				Register
			</div>
			<div class="login-block">
				<div class="form-group" ng-class="{'has-danger':error.email != null, 'has-success':error.email==null&&alertshow}">
					<input type="text" id="signup-username" class="login-text-input" ng-class="{'form-control-danger':error.email != null, 'form-control-success':error.email==null&&alertshow}" ng-model="customerData.email" data-toggle="tooltip" data-placement="right" title="email@example.com" placeholder="Email Anda">
					<small class="text-muted">[[getIndex0(error.email)]]</small>
				</div>
				<div class="form-group" ng-class="{'has-danger':error.password != null, 'has-success':error.password==null&&alertshow}">
					<input type="password" id="signup-password" class="login-text-input" ng-class="{'form-control-danger':error.password != null, 'form-control-success':error.password==null&&alertshow}" ng-model="customerData.password" data-toggle="tooltip" data-placement="right" title="min. 6 digits" placeholder="Buat Password" />
					<small class="text-muted">[[getIndex0(error.password)]]</small>
				</div>
				<div class="input-group form-group" ng-class="{'has-danger':error.cpassword != null, 'has-success':error.cpassword==null&&alertshow}">
			        <input type="password" id="confirm-password" class="login-text-input" ng-class="{'form-control-danger':error.cpassword != null, 'form-control-success':error.cpassword==null&&alertshow}" ng-model="customerData.cpassword" placeholder="Konfirmasi Password" />
			        <small class="text-muted">[[getIndex0(error.cpassword)]]</small>
			    </div>
			    <div class="form-group" ng-class="{'has-danger':error.name != null, 'has-success':error.name==null&&alertshow}" >
			        <input type="text" class="login-text-input" ng-class="{'form-control-danger':error.name != null, 'form-control-success':error.name==null&&alertshow}" ng-model="customerData.name" placeholder="Nama Lengkap">
			        <small class="text-muted">[[getIndex0(error.name)]]</small>
			    </div>
			    <div class="input-group form-group" ng-class="{'has-danger':error.address != null, 'has-success':error.address==null&&alertshow}">
			        <input type="text" class="login-text-input" ng-class="{'form-control-danger':error.address != null, 'form-control-success':error.address==null&&alertshow}" ng-model="customerData.address" placeholder="Address">
			        <small class="text-muted">[[getIndex0(error.address)]]</small>
			    </div>
		    	<div class="input-group form-group" ng-class="{'has-danger':error.postcode != null, 'has-success':error.postcode==null&&alertshow}">
			        <input type="text" class="login-text-input" ng-class="{'form-control-danger':error.postcode != null, 'form-control-success':error.postcode==null&&alertshow}" ng-model="customerData.postcode" placeholder="Kode Pos">
			        <small class="text-muted">[[getIndex0(error.postcode)]]</small>
				</div>
				<div class="form-group">
			        <div class="margin-5-0">Kota :</div>
			        <select class="login-text-input" ng-model="customerData.cityID" id="form-cityID" ng-options="x.id as x.name for x in cities"></select>
				</div>
				<div class="input-group form-group" ng-class="{'has-danger':error.phone1 != null, 'has-success':error.phone1==null&&alertshow}">
			        <input type="text" class="login-text-input" ng-class="{'form-control-danger':error.phone1 != null, 'form-control-success':error.phone1==null&&alertshow}" ng-model="customerData.phone1" placeholder="No. Telp 1">
			        <small class="text-muted">[[getIndex0(error.phone1)]]</small>
				</div>
				<div class="input-group form-group" ng-class="{'has-danger':error.phone2 != null, 'has-success':error.phone2==null&&alertshow}">
			        <input type="text" class="login-text-input" ng-class="{'form-control-danger':error.phone2 != null, 'form-control-success':error.phone3==null&&alertshow}" ng-model="customerData.phone2" placeholder="No. Telp 2">
			        <small class="text-muted">[[getIndex0(error.phone2)]]</small>
				</div>
				<div class="input-group form-group" ng-class="{'has-danger':error.phone3 != null, 'has-success':error.phone3==null&&alertshow}">
			        <input type="text" class="login-text-input" ng-class="{'form-control-danger':error.phone3 != null, 'form-control-success':error.phone3==null&&alertshow}" ng-model="customerData.phone3" placeholder="No. Telp 3">
			        <small class="text-muted">[[getIndex0(error.phone3)]]</small>
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
			<div class="login-checklist">
				<label class="form-group">
		      <div class="custom-control custom-checkbox">
		        <input type='checkbox' class="form-check-input" ng-model="customerData.terms" id="termcond"> 
		        <span for="termcond">Dengan ini Anda menyetujui <a href="#">Syarat & Ketentuan</a> yang berlaku.</span>
		      </div>
				</label>
		    <label class="form-group">
		      <div class="custom-control custom-checkbox">
		        <input type='checkbox' class="form-check-input" ng-change="setNews(customerData.newsvalue)" ng-model="customerData.newsvalue" id="promo"> 
		        <span>Dengan ini Anda ingin menerima berita baru & promosi mengenai website kami. <div class="tag tag-danger text-regular">not yet</div></span>
		      </div>
				</label>
	    </div>
			<div class="login-error" ng-show="alertshow">
				[[alertmessage]]
			</div>
			<div class="login-error" ng-show="error.terms!=null">
				[[(error.terms[0])]]
			</div>
			<div class="login-footer">
				<input type="submit" class="btn login-submit" value="Sign-up" ng-click="loginButtonClicked('login')" >
			</div>
			<div class="login-redirector">
			  Jika Anda sudah mempunyai account?<br />Silahkan <a href="{{URL::asset('login')}}">log-in</a> disini!
			</div>
		</div>
	</div>
</div>

@stop