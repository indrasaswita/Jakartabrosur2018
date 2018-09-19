@extends('layouts.error')
@section('title', '403')
@section('content')
<div ng-controller="" class="bg-snow">
	<div class="error-wrapper magra">
		<div class="icon">
			<span class="fas fa-8x fa-cog fa-spin"></span>
		</div>
		<div class="txt">
			<div class="header">
				FORBIDDEN ACCESS
			</div>
			<div class="detail">
				Anda tidak diperbolehkan memasuki halaman ini. Silahkan kembali ke <a href="{{URL::asset('home')}}" class="a-purple">home</a>.
			</div>
			<div class="detail text-italic">
				You're not allowed for this page. Please go back to <a href="{{URL::asset('home')}}" class="a-purple">home</a> page.
			</div>
		</div>
	</div>
</div>
@stop