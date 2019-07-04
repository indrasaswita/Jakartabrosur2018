
@extends('layouts.container')
@section('title', 'Vendor Master')
@section('description', 'Toko kertas dan toko2 lainnya, serta vendor non permanent.')
@section('robots', 'noindex,nofollow')
@section('content')


<div ng-controller="AdmVendorController" class="admin-vendor-wrapper">

@if(isset($vendors))
	@if($vendors != null)

		<?php
			$temp = str_replace(array('\r', '\"', '\n', '\''), '?', $vendors);
		?>

		@if(count($vendors) != 0)
	<div ng-init="initData('{{$temp}}')"></div>
		@endif
	@endif
@endif

@if(isset($vendors))
	@if($vendors != null)
		@if(count($vendors) != 0)
	<div class="page-title margin-10-0">
		<i class="fas fa-shopping-basket fa-fw"></i>
		Vendor (Terutama Toko Kertas)
	</div>
	<div class="admin-vendor">
		<table class="table">
			<tbody ng-repeat="item in vendors">
				<tr>
					<td class="num" rowspan="2" ng-if="item.addressID==null">
						#[[zeroFill(item.id, 2)]]
					</td>
					<td class="num" rowspan="3" ng-if="item.addressID!=null">
						#[[zeroFill(item.id, 2)]]
					</td>
					<td class="width-min text-xs-right">
						<small class="text-bold googleft">[[item.salestype]]</small>
					</td>
					<td>
						<small class="fas fa-store fa-fw tx-lightgray"></small>
						<b class="tx-purple">[[item.name]]</b>
					</td>
				</tr>
				<tr class="size-90p">
					<td colspan="2">
						<small class="fas fa-id-badge fa-fw tx-lightgray"></small>
						<span ng-if="item.phone1.length>3">
							[[phonemask(item.phone1)]]
						</span>
						<span ng-if="item.phone2.length>3">
							/ [[phonemask(item.phone2)]]
						</span>
						<span ng-if="item.salesname.length>0">
							(<b>[[item.salesname]]</b>)
						</span>
					</td>
				</tr>
				<tr class="size-90p" ng-if="item.addressID!=null">
					<td colspan="2">
						<small class="fas fa-home-lg-alt fa-fw tx-lightgray"></small>
						#<b>[[zeroFill(item.addressID, 3)]]</b>: <b class="tx-purple">[[item.address.name]]</b> [[item.address.address]], [[item.address.addressnote]]
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

