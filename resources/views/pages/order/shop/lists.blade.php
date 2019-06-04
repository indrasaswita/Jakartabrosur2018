@extends('layouts.container')
@section('title', 'Jenis Cetakan')
@section('title', 'Tanpa harus login, bisa cek harga dan buat penawaran Anda di sini.')
@section('robots', 'index,follow')
@section('content')

<div ng-controller="OrderListCustomerController">

	@include('includes.nav.subnav')

	<br><div class="orderlist-pretitle">
		<i>Mau pesan apa?</i><br>
		<div class="subtitle">Cek harga maupun pesan, <br>silahkan pilih salah satu tipe cetakan dibawah ini.</div>
	</div><br>

	<!-- BAKAL DIPAKE INI, JANGAN DIHAPUS -->
	<div class="viewer" hidden>
		<div class="title">
			VIEW TYPE
		</div>
		<div class="btn-group">
			<button class="btn btn-secondary btn-sm">
				<i class="fas fa-bars fa-fw"></i>
			</button>
			<button class="btn btn-secondary btn-sm">
				<i class="fas fa-th fa-fw"></i>
			</button>
		</div>
	</div>

	<div class="waitingorderlist" ng-show="jobtypes.length == 0 || jobtypes == null">
		<i class="fas fa-spin fa-spinner fa-5x tx-lightgray"></i>
		<br><br>
		<small class="fas fa-clock tx-lightgray"></small> Loading all printing types...<br>
		Tunggu sebentar untuk memilih jenis cetakan...
	</div>
	<div class="orderlist" ng-repeat="jobtype in jobtypes" ng-show="jobtypes.length > 0">
		<div class="orderlist-header" style="background-color:[[jobtype.colorcode]];">
			[[jobtype.name]]
		</div>
		<div class="ordersublist-wrapper">
			<ul class="ordersublist">
				<li ng-class="{'inactive':item.active==0, 'active':item.active==1}" ng-repeat="item in jobtype.jobsubtype" ng-mouseover="tooltip('<b class=\'tx-purple\'>'+item.name+'</b><br>'+item.description)" ng-mouseleave="tooltip('')">
					<a ng-click="linkclicked(item.link, item.active)">
						<img class="list-image" ng-src="{{URL::asset('image/jobsubtypeicons/[[item.icon]]')}}" ng-if="item.icon!=''&&item.active" alt="no image found" onerror="this.onerror=null;this.src='{{URL::asset('image/nofiles.png')}}'">
						<div class="list-image-addon" hidden>
							<img class="addon1" ng-src="{{URL::asset('image/smallicons/[[item.sicon1]]')}}" ng-if="item.sicon1!=''">
							<img class="addon2" ng-src="{{URL::asset('image/smallicons/[[item.sicon2]]')}}" ng-if="item.sicon2!=''">
						</div>
						<div class="margin-10-0" ng-if="!item.active">
							<i class="fal fa-3x fa-tools tx-danger"></i>
						</div>
						<span class="sublist-title">[[item.name]]</span>
						<span class="sublist-detail" ng-if="item.active==1">
							<!-- ACTIVE -->
							min. [[item.mindigital]] [[item.satuan]]
						</span>
						<span class="sublist-detail" ng-if="item.active==0">
							<!-- NOT ACTIVE -->
							<span class="google tx-red width-100 hidden-sm-down">
								< <i class="fas fa-traffic-cone fa-fw"></i> dalam perbaikan >
							</span>
							<span class="google tx-red width-100 hidden-md-up">
								<i class="fas fa-traffic-cone fa-fw"></i> 
								<span class="hidden-xs-down">
									perbaikan
								</span>
							</span>
						</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>

@stop