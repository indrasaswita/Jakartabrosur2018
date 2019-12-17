@extends('layouts.container')
@section('title', 'Join Cart Admin')
@section('description', 'Join cart admin page.')
@section('robots', 'noindex,nofollow')
@section('content')

<div ng-controller="AdmJoincartController" class="admin-joincart-wrapper">

@if(isset($carts))
	@if($carts != null)

		<?php
			$temp = str_replace(array('\r', '\"', '\n', '\''), '?', $carts);
		?>

		@if(count($carts) != 0)
	<div ng-init="initData('{{$temp}}')"></div>
		@endif
	@endif
@endif


	<div class="admin-joincart">
		<div class="page-title">
			JOB GANTUNG
		</div>
		<table class="table">
			<tbody ng-repeat="cart in carts" ng-class="{'selected':cart.selected}">
				<tr>
					<td class="width-min">
						<label class="custom-checkbox">
							<input type="checkbox" ng-model="cart.selected" ng-click="checkAll()" ng-change="setOtherDisabled(cart.customerID, cart)">
							<span class="checkmark"></span>
						</label>
					</td>
					<td>
						#[[zeroFill(cart.customerID, 3)]]
						[[cart.customer.name]]
					</td>
					<td>
						[[cart.quantity|number:0]] [[cart.quantitytypename]] 
						<span class="tx-gray">
							[[cart.jobsubtype.name]]
						</span>
						<b>[[cart.jobtitle]]</b>
					</td>
				</tr>
				<tr class="group" ng-if="splitcustomer($index, cart.customerID)">
					<td colspan="2">
						<button class="btn btn-sm btn-outline-success" ng-click="selectAllbyCust(cart.customerID)">
							Select All Cart from [[cart.customer.name]]
						</button>
					</td>
					<td class="text-xs-right">
						<button class="btn btn-sm btn-purple" ng-click="checkout(cart.customerID)">
							Checkout 
							<i class="far fa-chevron-right fa-fw"></i>
						</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

@stop
