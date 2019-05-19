@extends('layouts.container')
@section('title', 'Verification')
@section('description', 'Verifikasi Email dan No Handphone.')
@section('norobots', 'noindex')
@section('content')

	@if(!isset($email))
		<div class="text-xs-center"> ERROR</div>
	@else
		@if($email=="")
			<div class="text-xs-center"> ERROR</div>
		@else

			<div class="page-title">
				<i class="fas fa-code"></i>
				CODE VERIFICATION
			</div>

			<div class="verifpage" ng-controller="ResendemailController">
				<div class="verif-step">
					<div class="number">1</div>
					Lakukan verifikasi akun melalui email Anda, silahkan klik tombol Resend, lalu cek email Anda. <br>(Jika email tidak masuk, silahkan hubungi petugas Customer Service kami)
				</div>

				<div class="verif-block">
					<div class="email">
						{{$email}}
					</div>
					<div>
						<a href="" class="btn btn-purple" ng-click="resendemail('{{$email}}')">Kirim Email Verifikasi</a>
					</div>
				</div>
				<div class="verif-step">
					<div class="number">2</div>
					Masukkan 4 digit kode verifikasi, bila Anda telah diberikan kode oleh petugas kami. <br>(Jika dalam kasus tidak dapat menerima email, maka petugas kami akan mengirimkan kode verifikasi)
				</div>

				<form>
					<div class="verif-block">
						<div class="form-group">
							<input class="text-xs-center verifcode" type="text" id="code" onkeydown="return check(event);" placeholder="- - - -">
						</div>
					</div>
					<div class="verif-report line-12" ng-show="resenderror.length>0">
						[[resenderror]]
					</div>
					<div class="verif-footer">
						[[verificationcode]]
						<input class="btn btn-purple" ng-click="verifycode()" type="submit" id="verifybtn" value="Submit Kode">
						<br>
					</div>
				</form>
			</div>

			<script>

				function check(event){
					if(event.which == 8){
						return true;
					} else if (event.which == 13){
						return true;
					}else if (
						event.which >= 48 
						&& event.which <= 57
						){

						$code = $('#code').val();
					
						if($code.length < 4)
						{
							$('#code').val($code+event.key);		
						}

						return false;
					} 
					else return false;
				}

				function lengthcheck(){
					
				}
			</script>
		@endif
	@endif
@stop