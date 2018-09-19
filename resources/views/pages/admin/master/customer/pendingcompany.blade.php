@extends('layouts.container')
@section('title', 'Pending Company | Adm')
@section('content')

<div ng-controller="AdmCompanyPendingController">
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

	<div class="">
		<table class="table table-sm table-custom-allsales">
			<thead class="">
				<tr>
					<th class="width-min"></th>
					<th class="width-min">#</th>
					<th class="">Name</th>
					<th class="text-center">Phone</th>
					<th>Customer</th>
				</tr>
			</thead>
			<tbody ng-repeat="item in companies">
				<tr>
					<td>
						<input type="checkbox" />
					</td>
					<td class="line-11">
						#[[zeroFill(item.id, 4)]]
						<span ng-if="item.type.length>3">
							<br>
							[[item.type]]
						</span>
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