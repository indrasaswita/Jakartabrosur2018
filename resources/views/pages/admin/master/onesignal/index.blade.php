
@extends('layouts.container')
@section('title', 'Setting up Onesignals to JB Accounts')
@section('description', 'Description.')
@section('robots', 'noindex,nofollow')
@section('content')


<div class="admin-onesignal-wrapper" ng-controller="AdmOnesignalController">

@if(isset($onesignals))
	@if($onesignals != null)

		<?php
			$temp = str_replace(array('\r', '\"', '\n', '\''), '?', $onesignals);
		?>
		<?php
			$temp1 = str_replace(array('\r', '\"', '\n', '\''), '?', $employees);
		?>
		<?php
			$temp2 = str_replace(array('\r', '\"', '\n', '\''), '?', $customers);
		?>

		@if(count($onesignals) != 0)
	<div ng-init="initData('{{$temp}}', '{{$temp1}}', '{{$temp2}}')"></div>
		@endif
	@endif
@endif

@if(isset($onesignals))
	@if($onesignals != null)
		@if(count($onesignals) != 0)
	<div class="page-title margin-10-0">
		<i class="fas fa-satellite-dish fa-fw"></i>
		One Signals Mapper
	</div>

	<div class="admin-onesignal">
		<table class="table table-sm">
			<thead>
				<tr>
					<td></td>
					<td class="text-xs-center">
						<i class="fas fa-users fa-fw tx-orange"></i>
						Customer
					</td>
					<td class="text-xs-center">
						<i class="fas fa-mobile-android fa-fw tx-orange"></i>
						Device
					</td>
					<td class="text-xs-center">
						<i class="fas fa-user-secret fa-fw tx-orange"></i>
						Employee
					</td>
					<td></td>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="item in onesignals">
					<td class="width-min">
						<div ng-if="item.customeronesignal == null && item.employeeonesignal == null">
							<a href="" class="">
								<i class="fal fa-plus-square fa-fw"></i>
							</a>
						</div>
					</td>
					<td class="text-xs-center">
						<div ng-if="item.customeronesignal != null">
							[[item.customeronesignal.customer.name]]
						</div>
						<div ng-if="item.customeronesignal == null">
							-
						</div>
					</td>
					<td class="text-xs-center line-11">
						<b class="tx-lightgray size-90p">#[[zeroFill(item.id, 3)]]</b>
						<b>[[item.devicename]]</b>
						<br>
						<small>[[singkatText(item.player_id, 20, '-')]]</small>
					</td>
					<td class="text-xs-center">
						<div ng-if="item.employeeonesignal != null">
							[[item.employeeonesignal.employee.name]]
						</div>
						<div ng-if="item.employeeonesignal == null">
							-
						</div>
					</td>
					<td class="width-min">
						<div ng-if="item.customeronesignal == null && item.employeeonesignal == null">
							<a href="" class="">
								<i class="fal fa-plus-square fa-fw"></i>
							</a>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>

		@endif
	@endif
@endif
</div>


@stop

