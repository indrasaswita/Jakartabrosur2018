@extends('layouts.container')
@section('title', 'Jenis Cetakan')
@section('title', 'Tanpa harus login, bisa cek harga dan buat penawaran Anda di sini.')
@section('robots', 'index,follow')
@section('content')

<div ng-controller="OrderListCustomerController">
	@include('includes.nav.subnav')
	<div class="waitingorderlist" ng-show="jobtypes.length == 0 || jobtypes == null">
		<i class="fas fa-spin fa-spinner fa-5x tx-lightgray"></i>
		<br><br>
		<small class="fas fa-clock tx-lightgray"></small> Loading all printing types...<br>
		Tunggu sebentar untuk memilih jenis cetakan...
	</div>
	<div class="orderlist" ng-repeat="jobtype in jobtypes" ng-show="jobtypes.length > 0">
		<div class="orderlist-header">[[jobtype.name]]</div>
		<div class="ordersublist-wrapper">
			<ul class="ordersublist">
				<li ng-repeat="item in jobtype.subtypes" ng-mouseover="tooltip('<b>'+item.name+'</b><br>'+item.description)" ng-mouseleave="tooltip('')">
					<a href="{{URL::asset('shop/[[item.link]]')}}">
						<img class="list-image" ng-src="{{URL::asset('image/jobsubtypeicons/[[item.icon]]')}}" ng-if="item.icon!=''">
						<div class="list-image-addon" hidden>
							<img class="addon1" ng-src="{{URL::asset('image/smallicons/[[item.sicon1]]')}}" ng-if="item.sicon1!=''">
							<img class="addon2" ng-src="{{URL::asset('image/smallicons/[[item.sicon2]]')}}" ng-if="item.sicon2!=''">
						</div>
						<div ng-if="item.icon==''" class="margin-10-0">
							<i class="far fa-question-circle fa-3x tx-lightgray"></i>
						</div>
						<span class="sublist-title">[[item.name]]</span>
						<span class="sublist-detail">min. [[item.mindigital]] [[item.satuan]]</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>

@stop