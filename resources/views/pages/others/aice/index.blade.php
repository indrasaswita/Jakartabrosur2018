@extends('layouts.default')
@section('content')

<div class="aice-index" ng-controller="AiceIndexController">

@if(isset($aice))
	@if($aice != null)

	<?php
		$temp = str_replace(array('\r', '\"', '\n', '\''), '?', $aice);
		$temp2 = str_replace(array('\r', '\"', '\n', '\''), '?', $aicesales);
		$temp3 = str_replace(array('\r', '\"', '\n', '\''), '?', $aicesalesgroup);
	?>

		@if(count($aice) != 0)
	<div ng-init="initData('{{$temp}}', '{{$temp2}}', '{{$temp3}}', '{{Session::get('role')}}')"></div>
		@endif
	@endif
@endif

	<div class="aice-wrapper">
		<div class="aice-left">

			<div class="aice-title">AICE</div>
			<div class="aice-barcode">
				<input type="number" class="form-control" id="barcode" ng-model="barcode" ng-keypress="barcodeSearch($event)">
			</div>
			<div class="aice-buttons">
				<button class="btn btn-outline-primary" ng-repeat="item in datas" ng-click="addSelected(item)" tab-index="-1">
					[[item.name]]
				</button>
			</div>
			<div class="aice-info">
			</div>
		</div>

		<div class="aice-right">

			<div class="aice-title">
				TOTAL
			</div>

			<div class="aice-receipt">
				<table class="table table-sm">
					<tbody>
						<tr ng-repeat="item in selected">
							<td>[[$index+1]]</td>
							<td>[[item.name]]</td>
							<td class="qty"><input type="number" class="form-control form-control-sm" ng-model="item.qty" ng-change="calcPrice()"></td>
							<td>[[(item.qty * item.sellprice)|number:0]]</td>
							<td class="width-min">
								<button class="btn btn-xsm btn-outline-danger" ng-click="removeSelected(item)">
									<i class="fas fa-times"></i>
								</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>
	</div>
	<div class="aice-total">
		<span class="">TOTAL (<b>[[selected.length]]</b> <small>barang</small>)</span>
		<span class="pull-xs-right line-09">Rp <b class="totalharga">[[totalharga|number:0]]</b></span>
	</div>

	<div class="aice-command">
		<button class="btn btn-sm btn-primary pull-xs-left" ng-click="showSales()">
			<small class="fas fa-file-alt"></small>&nbsp;
			Jualan
		</button>
		<button class="btn btn-sm btn-primary pull-xs-left" ng-click="showGroup()">
			<small class="fas fa-file-alt"></small>&nbsp;
			Grouping
		</button>
		<button class="btn btn-primary" ng-click="saveData()" ng-hide="saving">
			<small class="fas fa-check"></small>
			BELANJA
		</button>
		<div class="" ng-show="saving">
			<i class="fas fa-spinner fa-spin fa-2x text-lightmagenta"></i>
		</div>
		<button class="btn btn-primary btn-sm pull-xs-right btn-outline-lightmagenta" ng-click="knight()" ng-hide="{{Session::get('role')}}!=Administator">
			<small class="fas fa-chess-knight"></small>
		</button>
	</div>

	@include('pages.others.aice.sales.showindex', ['modalid'=>'aicesales', 'modaltitle'=>'Penjualan AICE', 'tablename'=>'aicesales'])
	@include('pages.others.aice.sales.showindex', ['modalid'=>'aicesalesgroup', 'modaltitle'=>'Penjualan Grouping', 'tablename'=>'aicesalesgroup'])

	@if(Session::get('role') == 'Administrator')
		@include('pages.others.aice.sales.aicestock', ['modalid'=>'aicestock', 'modaltitle'=>'Stock AICE', 'tablename'=>'allaice'])
	@endif

</div>

@stop