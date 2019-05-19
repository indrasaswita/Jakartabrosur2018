@extends('layouts.container')
@section('title', 'Sign-up')
@section('description', 'Daftar sebagai Pengguna untuk memesan.')
@section('robots', 'index')
@section('content')

<div ng-controller="SignupController">
	<form>
		<div class="login-wrapper margin-top-20">
			<div class="login-header">
				Register
			</div>
			<div class="login-block">
				<div class="form-group has-danger has-success">
					<input type="text" id="signup-username" class="login-text-input" ng-class="{'form-control-danger':error.email != null, 'form-control-success':error.email==null&&alertshow}" ng-model="customerData.email" data-toggle="tooltip" data-placement="right" title="email@example.com" placeholder="Email Anda">
					<div class="login-text-error">
						[[error.email]]
					</div>
				</div>
				<div class="form-group has-danger has-success">
					<input type="password" id="signup-password" class="login-text-input" ng-class="{'form-control-danger':error.password != null, 'form-control-success':error.password==null&&alertshow}" ng-model="customerData.password" placeholder="Buat Password" />
					<div class="login-text-error">
						[[error.password]]
					</div>
				</div>
				<div class="form-group has-danger has-success">
					<input type="password" id="confirm-password" class="login-text-input" ng-class="{'form-control-danger':error.cpassword != null, 'form-control-success':error.cpassword==null&&alertshow}" ng-model="customerData.cpassword" placeholder="Konfirmasi Password" />
					<div class="login-text-error">
						[[error.cpassword]]
					</div>
				</div>
				<div class="form-group has-danger has-success">
					<input type="text" class="login-text-input" ng-class="{'form-control-danger':error.name != null, 'form-control-success':error.name==null&&alertshow}" ng-model="customerData.name" placeholder="Nama Lengkap">
					<div class="login-text-error">
						[[error.name]] 
					</div>
				</div>
				<div class="input-group form-group has-danger has-success">
					<input type="text" class="login-text-input" ng-class="{'form-control-danger':error.phone1 != null, 'form-control-success':error.phone1==null&&alertshow}" ng-model="customerData.phone1" placeholder="No. Telp / No. WhatsApp">
					<div class="login-text-error">
						[[error.phone1]]
					</div>
				</div>
				<div class="input-group form-group has-danger has-success">
					<input type="text" class="login-text-input" ng-class="{'form-control-danger':error.phone2 != null, 'form-control-success':error.phone3==null&&alertshow}" ng-model="customerData.phone2" placeholder="No. Telp 2">
					<div class="login-text-error">
						[[error.phone2]]
					</div>
				</div>
				<div class="input-group form-group has-danger has-success">
					<input type="text" class="login-text-input" ng-class="{'form-control-danger':error.phone3 != null, 'form-control-success':error.phone3==null&&alertshow}" ng-model="customerData.phone3" placeholder="No. Telp 3">
					<div class="login-text-error">
						[[error.phone3]]
					</div>
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
						<span class="custom-control-description">Organisasi</span>
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
						<input type='checkbox' class="form-check-input" ng-change="setNews(customerData.news)" ng-model="customerData.news" id="promo"> 
						<span>Dengan ini Anda ingin menerima berita baru & promosi mengenai website kami. <div class="tag tag-danger text-regular">not yet</div></span>
					</div>
				</label>
			</div>
			<div class="login-error" ng-hide="error.terms==null||error.terms==''">
				[[error.terms]]
			</div>
			<div class="login-footer">
				<input type="submit" class="btn login-submit" value="Sign-up" ng-click="signupClicked()" >
				<!-- <button ng-click="anjing()" class="button btn btn-warning">konfirmasi</button> -->
			</div>
			<div class="login-redirector">
				Jika Anda sudah mempunyai account?<br />Silahkan <a href="{{URL::asset('login')}}">log-in</a> disini!
			</div>
		</div>
	</form>
</div>

@stop