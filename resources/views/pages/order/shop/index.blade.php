@extends('layouts.order')
@section('title', $datas['name'])
@section('content')

<div>
	
	<!-- <div class="order-panel-header">
		<div class="panel-title">{{$datas['name']}}</div>
		<div class="panel-subtitle">SEGERA HITUNG KEBUTUHAN ANDA DISINI</div>
	</div> -->
	<div class="order-panel-tabs">
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#calculation">
					<span class="fa fa-calculator"></span>	
					<span class="hidden-xs-down">Kalkulasi</span>
					<span class="hidden-sm-up">Calc</span>
				</a>
			</li>
	    <li class="nav-item">
	    	<a class="nav-link" data-toggle="tab" href="#description">
	    		<span class="fa fa-edit"></span>
	    		<span class="hidden-xs-down">Deskripsi</span>
	    		<span class="hidden-sm-up">Desc</span>
	    	</a>
    	</li>
		</ul>
	</div>
	
	<div class="tab-content">
		@include ('pages.order.shop.includes.calculation')
		@include ('pages.order.shop.includes.description')
		@include ('pages.order.shop.modals.easyaccess')
	</div>

	<div class="order-panel-summary">
		@include ('pages.order.shop.includes.summary')
	</div>
</div>
@stop