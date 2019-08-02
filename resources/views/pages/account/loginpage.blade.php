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
			<div class="login-header">
				Log-In
			</div>
			<div class="login-block">
				<div class="form-group">
					<input type="text" id="login-username" class="login-text-input" data-toggle="tooltip" data-placement="top" title="email@example.com" placeholder="Email Anda" ng-model="customerData.email" name="email">
					<div class="login-text-error">
						[[error.email]]
					</div>
				</div>
				<div class="form-group">
					<input type="password" id="login-password" class="login-text-input" data-toggle="tooltip" data-placement="bottom" title="min. 6 digits" placeholder="Password Anda" ng-model="customerData.password" name="password">
					<div class="login-text-error">
						[[error.password]]
					</div>
				</div>
			</div>
			<div class="login-error" ng-show="alertshow">
				[[alertmessage]]
			</div>
			<div class="login-footer">
				<input type="submit" class="btn login-submit" value="Login" ng-click="loginButtonClicked('home')" >
			</div>
			<div class="login-redirector">
				Jika belum punya account?<br />Silahkan <a href="{{URL::asset('signup')}}"><b>REGISTER</b></a> disini!
				<div class="redirect">
					<button class="btn">
						<i class="fal fa-user-plus fa-fw"></i>
						REGISTER
					</button>
				</div>
			</div>
		</div>
	</form>
</div>

@stop