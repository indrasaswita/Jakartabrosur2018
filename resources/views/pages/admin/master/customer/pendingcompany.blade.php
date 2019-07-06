@extends('layouts.container')
@section('title', 'Pending Company | Adm')
@section('content')

<div ng-controller="AdmCompanyPendingController" class="admin-companypending-wrapper">
@if(isset($companies))
	@if($companies != null)

		<?php
			$temp = str_replace(array('\r', '\"', '\n', '\''), '?', $companies);
		?>

		@if(count($companies) != 0)
	<div ng-init="initData('{{$temp}}')"></div>
		@endif
	@endif
@endif

	<div class="admin-companypending">
		<table class="table">
			<tbody ng-repeat="item in companies">
				<tr class="header">
					<td class="num">
						#[[zeroFill(item.id, 2)]]
					</td>
					<td class="check">
						<label class="custom-checkbox">
							<input type="checkbox" ng-model="item.custominput" ng-checked="selectedchanged(item)">
							<span class="checkmark"></span>
						</label>
					</td>
					<td class="uppercase">
							[[item.type]]
					</td>
					<td>
						<span ng-if="item.nickname!='None'">[[item.nickname]]: </span>[[item.name]]
					</td>
					<td class="text-center">
						[[item.phone1]]
						<span ng-if="item.phone2.length>3">
							<br>
							[[item.phone2]]
						</span>
					</td>
					<td>
						<div ng-if="item.customer.length==0">
							Tidak ada Customer
						</div>
						<div class="line-11" ng-if="item.customer.length>0">
							<div class="" ng-repeat="item2 in item.customer">
								[[item2.name]] 
								<i class="tx-lightgray">
									[[singkatText(item2.email, 22, '@')]]
								</i>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

@stop