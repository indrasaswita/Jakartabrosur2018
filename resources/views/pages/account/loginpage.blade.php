@extends('layouts.container')
@section('title', 'Log In')
@section('description', 'Masuk sebagai Pengguna ke account Jakartabrosur agar dapat memesan.')
@section('robots', 'index')
@section('content')

<div ng-controller="LoginController">
<?php
	if(isset($url)){
		if($url != ''){
?>
	<div ng-init="setNextUrl('{{$url}}')"></div>
<?php
		}
	}
?>
	<form>
		<div class="login-wrapper">
			<div class="login-title">
				<a href="" class="a-purple back-button" ng-if="state>0" ng-click="backButtonClicked()">
					<i class="fas fa-arrow-alt-left fa-fw"></i>
				</a>
				<div class="logo">
					JakartaBrosur
				</div>
				<div class="text">
					Log-In
				</div>
			</div>
			<div ng-if="state==0">
				<div class="login-block">
					<div class="input-wrapper">
						<input type="text" placeholder="Email Anda (example@mail.com)" id="login-email" ng-model="customerData.email">
						<div class="error">
							[[error.email]]
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
					<button class="btn btn-purple" ng-click="nextButtonClicked()" >
						Next
					</button>
				</div>
			</div>

			<div ng-if="state==1">
				<div class="login-block">
					<div class="input-wrapper">
						<input type="password" id="login-password" placeholder="Password" ng-model="customerData.password">
						<div class="error">
							[[error.password]]
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
					<button class="btn btn-purple" ng-click="loginButtonClicked('home')" >
						Login
					</button>
				</div>
			</div>

			<div ng-if="state==2">
				<div class="login-block">
					<div class="input-wrapper">
						<input type="password" id="login-password2" placeholder="Buat Password" ng-model="customerData.password">
						<div class="error">
							[[error.password]]
						</div>
					</div>
					<div class="input-wrapper">
						<input type="password" id="login-confirm" placeholder="Ulangi Password" ng-model="customerData.confirmpassword">
						<div class="error">
							[[error.confirmpassword]]
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
					<button class="btn btn-purple" ng-click="makePasswordClicked('home')" >
						Buat Password & Login
					</button>
				</div>
			</div>

			<div class="state-notfound" ng-if="state==3">
				<div class="login-block">
					<i class="fal fa-smile-wink fa-fw fa-4x"></i><br><br>
					<b>
						[[customerData.email]]
					</b><br>
					Email belum terdaftar.
					<div class="keterangan">
						Anda belum membuat Akun dengan email ini, silahkan periksa kembali email Anda, atau lakukan <a href="{{URL::asset('signup')}}" class="a-purple">registrasi</a>.
					</div>
				</div>	
				<div class="login-footer">
					<button class="btn btn-outline-purple" ng-click="setState0()" >
						<i class="fal fa-history fa-fw"></i>
						Coba lagi
					</button>
				</div>
			</div>

			<div class="login-redirector">
				Belum punya Akun?
				<div class="redirect">
					<a href="{{URL::asset('signup')}}" class="btn btn-purple">
						<i class="fal fa-user-plus fa-fw"></i>
						Buat Akun sekarang
					</a>
				</div>
			</div>
		</div>
	</form>
</div>

@stop