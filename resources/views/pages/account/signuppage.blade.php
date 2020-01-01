@extends('layouts.container')
@section('title', 'Sign-up')
@section('description', 'Daftar sebagai Pengguna untuk memesan.')
@section('robots', 'index')
@section('content')

<div ng-controller="SignupController">
	<form>
		<div class="login-wrapper margin-top-20">
			<div class="login-title">
				<div class="logo">
					JakartaBrosur
				</div>
				<div class="text">
					Buat Akun
				</div>
			</div>
			<div class="login-block">
				<div class="input-wrapper">
					<input type="text" ng-class="{'danger':error.email != null, 'success':error.email==null&&alertshow}" ng-model="customerData.email" placeholder="Email Anda">
					<div class="error">
						[[error.email]]
					</div>
				</div>
				<div class="input-wrapper">
					<input type="password" ng-class="{'danger':error.password != null, 'success':error.password==null&&alertshow}" ng-model="customerData.password" placeholder="Buat Password" />
					<div class="error">
						[[error.password]]
					</div>
				</div>
				<div class="input-wrapper">
					<input type="password" ng-class="{'danger':error.cpassword != null, 'success':error.cpassword==null&&alertshow}" ng-model="customerData.cpassword" placeholder="Konfirmasi Password" />
					<div class="error">
						[[error.cpassword]]
					</div>
				</div>
				<div class="input-wrapper">
					<input type="text" ng-class="{'danger':error.name != null, 'success':error.name==null&&alertshow}" ng-model="customerData.name" placeholder="Nama Lengkap">
					<div class="error">
						[[error.name]] 
					</div>
				</div>
				<div class="input-wrapper">
					<input type="text" ng-class="{'danger':error.phone1 != null, 'success':error.phone1==null&&alertshow}" ng-model="customerData.phone1" placeholder="No. Telp / No. WhatsApp">
					<div class="error">
						[[error.phone1]]
					</div>
				</div>
				<div class="input-wrapper">
					<input type="text" ng-class="{'danger':error.phone2 != null, 'success':error.phone3==null&&alertshow}" ng-model="customerData.phone2" placeholder="No. Telp 2">
					<div class="error">
						[[error.phone2]]
					</div>
				</div>
				<div class="input-wrapper">
					<input type="text" ng-class="{'danger':error.phone3 != null, 'success':error.phone3==null&&alertshow}" ng-model="customerData.phone3" placeholder="No. Telp 3">
					<div class="error">
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
				<div class="check">
					<label class="custom-checkbox">
						<input type="checkbox" ng-model="customerData.terms">
						<span class="checkmark"></span>
					</label>
					<div class="label">
						Dengan ini Anda menyetujui <a href="#">Syarat & Ketentuan</a> yang berlaku.
					</div>
				</div>
				<div class="error" ng-if="error.terms!=null">
					[[error.terms]]
				</div>
				<div class="check">
					<label class="custom-checkbox">
						<input type="checkbox" ng-model="allchecked" ng-click="setNews(customerData.news)">
						<span class="checkmark"></span>
					</label>
					<div class="label">
						Dengan ini Anda ingin menerima berita baru & promosi mengenai website kami. <div class="badge badge-danger text-regular">not yet</div>
					</div>
				</div>
			</div>
			<div class="login-error" ng-show="alertshow">
				<span ng-class="{'pulse':alertpulse}">
					<i class="fad fa-dice-d20 fa-fw"></i>
				</span>
				<div class="text">
					[[alertmessage]]
				</div>
			</div>
			<div class="login-footer">
				<button class="btn btn-purple" ng-click="signupClicked()">
					Sign-up
				</button>
			</div>
			<div class="login-redirector">
					Sudah Punya Akun?
					<div class="redirect">
					<a href="{{URL::asset('login')}}" class="btn btn-purple">
						<i class="fal fa-user-plus fa-fw"></i>
						Log-In sekarang
					</a>
				</div>
			</div>
		</div>
	</form>
</div>

@stop