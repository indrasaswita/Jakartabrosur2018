@extends('layouts.container')
@section('title', 'View Price in Text')
@section('content')

<div ng-controller="AdmPricetextController">

@if(isset($pricetexts))
	@if($pricetexts != null)

		<?php
			$temp = str_replace(array('\r', '\"', '\n', '\''), '?', $pricetexts);
		?>

		@if(count($pricetexts) != 0)
	<div ng-init="initData('{{$temp}}')"></div>
		@endif
	@endif
@endif

	<div class="page-title">
		<i class="fas fa-percentage"></i>
		View Price in Text
	</div>
	<div class="pricetext-wrapper">
		<div ng-if="pricetexts==null">
			Error: No data read from server.
		</div>
		<div class="pricetext-show" ng-if="pricetexts!=null">
			<div class="act-btn prev">
				<button class="btn btn-transparent" ng-click="prevbtnclicked()">
					<i class="fas fa-angle-double-left"></i>
				</button>
			</div>
			<div class="pricetext-item" ng-repeat="item in pricetexts" ng-class="{'active':selectedidx==$index}">
				<div class="text-xs-center size-150p">
					[[$index+1|number:0]] / [[pricetexts.length|number:0]] (ID: <b>[[zeroFill(item.id, 4)]]</b>)
				</div>
				<hr class="margin-5-0 bd-danger">
				<div class="align-flex-center display-flex">
					<div class="" ng-if="item.employeeID!=null">
						EM - <span class="capitalize">[[item.employee.name]]</span>
					</div>
					<div class="" ng-if="item.customerID!=null">
						CU - <span class="capitalize">[[item.customer.name]]</span>
					</div>
				</div>
				<hr class="margin-5-0 bd-danger">
				<span class="" ng-bind-html="item.pricetext">
				</span>
				<br>
				<div class="text-xs-center">
					<button class="btn btn-sm btn-danger"  data-toggle="tooltip" data-title="not developed yet">
						<i class="fas fa-print"></i> Print
					</button>
					<a href="https://api.whatsapp.com/send?phone=&text=id.[[zeroFill(item.id, 4)]]--[[item.pricetextwa]]" class="btn btn-sm btn-secondary" target="_blank">
						<i class="fab fa-whatsapp"></i> Whatsapp
					</a>
				</div>
			</div>
			<div class="act-btn next">
				<button class="btn btn-transparent" ng-click="nextbtnclicked()">
					<i class="fas fa-angle-double-right"></i>
				</button>
			</div>
		</div>
	</div>

@stop