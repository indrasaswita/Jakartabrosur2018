@extends('layouts.error')
@section('title', 'Page Not Found')
@section('content')
<div ng-controller="" class="bg-snow">
	<div class="error-wrapper magra">
		<div class="icon">
			<span class="fa fa-8x fa-universal-access fa-spin"></span>
		</div>
		<div class="txt">
			<div class="header">
				PAGE NOT FOUND
			</div>
			<div class="detail">
				Halaman yang dituju error, dan tidak ditemukan. Silahkan kembali ke <a href="{{URL::asset('home')}}" class="a-purple">home</a>.
			</div>
			<div class="detail text-italic">
				The requested page is error, and not found. Please go back to <a href="{{URL::asset('home')}}" class="a-purple">home</a> page.
			</div>
		</div>
	</div>
</div>
@stop