@extends('layouts.order')
@section('title', $datas['name'])
@section('description', 'Cetak murah dan dapatkan '.$datas['name'].' dalam hitungan menit.')
@section('keywords', 'Cetak '.$datas['name'].', Nyetak '.$datas['name'].', Cetk '.$datas['name'].', '.$datas['name'].' print, Cetak '.$datas['name'].' cepat, Cetak '.$datas['name'].' murah')
@section('content')

<div>
	
	<!-- <div class="order-panel-header">
		<div class="panel-title">{{$datas['name']}}</div>
		<div class="panel-subtitle">SEGERA HITUNG KEBUTUHAN ANDA DISINI</div>
	</div> -->
	<div class="order-panel-tabs">
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link active" id="calc-headtab" data-toggle="tab" href="#calculation">
					<i class="fal fa-fw fa-calculator"></i>	
					<span class="hidden-xs-down">Kalkulasi</span>
					<span class="hidden-sm-up">Calc</span>
				</a>
			</li>
			<li class="nav-item" ng-show="role==null">
	    	<a class="nav-link" href="{{URL::asset('login')}}?url={{substr(url()->current(), strlen(url('/'))+1)}}?ss={{app('request')->input('ss')}}">
	    		<i class="fal fa-fw fa-user-lock"></i> Log-in dulu ...
	    	</a>
    	</li>
	    <li class="nav-item" ng-show="role!=null">
	    	<a class="nav-link" id="desc-headtab" data-toggle="tab" href="#description">
	    		<i class="fal fa-fw fa-edit"></i>
	    		<span class="hidden-xs-down">Deskripsi</span>
	    		<span class="hidden-sm-up">Desc</span>
	    	</a>
	    	<div class="warning" ng-show="selected.jobtitle.length<3">
		    	<i class="fas fa-exclamation-circle tx-red"></i>
		    </div>
    	</li>
			<li class="nav-item" ng-show="role!=null">
				<a class="nav-link" id="file-headtab" data-toggle="tab" href="#file">
					<i class="fal fa-fw fa-copy"></i>	
					<span class="hidden-xs-down">File</span>
					<span class="hidden-sm-up">File</span>
				</a>
	    	<div class="warning" ng-show="selected.files.length==0">
		    	<i class="fas fa-exclamation-circle tx-red"></i>
		    </div>
			</li>
		</ul>
	</div>
	
	<div class="tab-content">
		@include ('pages.order.shop.includes.calculation')
		@include ('pages.order.shop.includes.description')
		@include ('pages.order.shop.includes.file')
		@include ('pages.order.shop.modals.easyaccess')
	</div>

	<div class="order-panel-summary">
		@include ('pages.order.shop.includes.summary')
	</div>
</div>



<!-- MODAL -->
@include ('includes.floating-contact')
@include ('pages.order.shop.modals.delivery')
@include ('pages.order.shop.modals.uploadfile')
@include ('pages.order.shop.modals.savedialog')
@include ('pages.order.shop.modals.offerintext')
@include ('pages.order.shop.modals.uploadurl')


@stop