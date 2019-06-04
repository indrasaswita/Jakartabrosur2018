@extends('layouts.nofooter')
@section('title', 'Harga Kertas')
@section('content')

<div class="paper-admin" ng-controller="AdmPricePaperController">
<?php
	$temp = str_replace(array('\r', '\"', '\n', '\''), '?', $papers);
?>

@if(isset($papers))
	@if($papers != null)
		@if(count($papers) != 0)
	<div ng-init="initData('{{$temp}}')"></div>
		@endif
	@endif
@endif

	<div class="paper-detail-wrapper">

		<div class="page-title margin-10-0">
			Ganti Harga Kertas menurut Kg, Pcs, Meteran
		</div>
		<table class="table table-sm table-custom-allsales">
			<thead class="text-center">
				<tr>
					<th class="width-min">No.</th>
					<th class="text-left">Nama Kertas</th>
					<th class="width-min">
						<i class="fa fa-cog"></i>
					</th>
				</tr>
			</thead>
			<tbody ng-repeat="item in papers">
				<tr class="content-header">
					<td class="nomor">#[[zeroFill(item.id, 3)]]</td>
					<td class="text-xs-left googleft">
						<input type="checkbox" ng-model="item.paperID" ng-change="postcheckedByPaper(item, item.paperID)">
						&nbsp;
						<span class="text-bold">
							[[item.name]]
						</span>
						<span class="uppercase text-bold tx-lightmagenta size-85p">
							[[item.color]]
						</span>
						<span ng-show="item.gramature!=0">
							<span class="tx-purple">[[item.gramature]]</span><span class="tx-lightgray">g</span>
						</span>
					</td>
					<!-- <td class="th-action act-3"> -->
					<td class="th-action">
						<div class="btn-group btn-header">
							<button class="btn btn-sm" ng-class="{'btn-outline-purple':!item.showdetail, 'btn-purple':item.showdetail}" data-toggle="tooltip" data-title="Lihat detail" data-placement="top" data-html="true" ng-click="showdetail(item)">
								<span class="fas fa-arrow-alt-circle-down"></span>
							</button>
						</div>
					</td>
				</tr>
				<tr class="content-detail detail-item" ng-show="item.showdetail">
					<td colspan="10">
						<div class="detail">
							<div class="subheader">
								Harga Kertas
							</div>
							<table class="table table-cartdetail">
								<thead class="text-center">
									<tr>
										<th class="width-min">#</th>
										<th>Detail</th>
										<th class="width-min"></th>
										<th>Beli</th>
										<th>Jual</th>
										<th>Satuan</th>
									</tr>
								</thead>
								<tbody ng-repeat="item2 in item.paperdetail">
									<tr>
										<td class="line-09 signika text-bold size-85p" ng-click="changecheck(item, item2)">
											[[zeroFill(item2.paperID,3)]]
											<br>
											[[zeroFill(item2.planoID,3)]]
											<br>
											[[zeroFill(item2.vendorID,3)]]
										</td>
										<td class="line-12" ng-click="changecheck(item, item2)">
											[[item2.vendor.name]]
											<br>
											[[item2.plano.width|number:0]]x[[item2.plano.length|number:0]] cm
										</td>
										<td class="v-center">
											<input type="checkbox" ng-model="item2.selected" class="" ng-checked="item.paperID" ng-change="postchecked(item, item2)">
										</td>
										<td class="line-12" ng-click="changecheck(item, item2)">
											<div class="context-title">
												Harga Beli
											</div>
											<div class="context-input">[[item2.buyprice|number:0]]</div>
										</td>
										<td class="line-12" ng-click="changecheck(item, item2)">
											<div class="context-title">
												Harga Jual
											</div>
											<div class="context-input">[[item2.sellprice|number:0]]</div>
										</td>
										<td class="line-12" ng-click="changecheck(item, item2)">
											<div class="context-title">
												Per-[[item2.unittype]]
											</div>
											<div class="context-input">[[item2.unitprice|number:2]]</div>
										</td>
									</tr>
								</tbody>
							</table>
							<div class="size-90p margin-10-0">
								<i class="far fa-lightbulb tx-gray"></i>
								Data harga beli di set langsung, harga jual di hitung dari margin berdasarkan persentase keuntungan (std. 4% sudah termasuk ongkir dan jasa angkut)
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="paper-cart-wrapper">
		<div class="paper-cart-detail">
			<div class="error" ng-hide="selectedpapers.length>0">
				<i class="far fa-edit fa-4x tx-danger" data-toggle="tooltip" data-placement="bottom" data-title="Belum dipilih!"></i>
			</div>
			<table class="table table-sm" ng-show="selectedpapers.length>0">
				<tbody ng-repeat="item in selectedpapers">
					<tr>
						<td class="title width-min">
							[[zeroFill(item.paperID,3)]]
							<br>
							[[zeroFill(item.planoID,3)]]
							<br>
							[[zeroFill(item.vendorID,3)]]
						</td>
						<td class="content">
							<b>
								[[singkatText(item.papername, 10, '')]] 
								<span ng-show="item.papergramature!=0">
									[[item.papergramature|number:0]] 
								</span>
							</b> 
							<span ng-show="item.papercolor!='Putih'"> 
								<i class="fas fa-palette"></i>
								[[item.papercolor]]
							</span>
							<br>
							<span class="vendor">
								[[item.vendorname|uppercase]] 
							</span>
							<b>
								[[item.planowidth|number:0]]x[[item.planolength|number:0]]<span class="tx-lightgray">cm</span>
							</b>
							<span data-toggle="tooltip" data-title="<span class='tx-purple'><b>[[item.papername]]</b> [[item.papergramature]]gsm [[item.papercolor]]</span>" data-placement="left" data-html="true" class="pull-xs-right" tooltip>
								<i class="fa fa-info-circle tx-lightgray"></i>
							</span>
						</td>
						<td class="title width-min text-xs-right">
							Beli
							<br>
							Jual
							<br>
							/[[item.unittype]]
						</td>
						<td class="title text-xs-center">
							<b class='tx-gray'>[[item.pricebuy|number:0]]</b> <i class='fa fa-chevron-right size-80p tx-lightmagenta'></i> <b>[[item.newpricebuy|number:0]]</b>
							<br>
							<b class='tx-gray'>[[item.pricesell|number:0]]</b> <i class='fa fa-chevron-right size-80p tx-lightmagenta'></i> <b>[[item.newpricesell|number:0]]</b>
							<br>
							<b class='tx-gray'>[[item.priceunit|number:2]]</b> <i class='fa fa-chevron-right size-80p tx-lightmagenta'></i> <b>[[item.newpriceunit|number:2]]</b>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="paper-cart-action">
			<div class="total">
				<b>
					[[selectedpapers.length]] kertas
				</b>
				terpilih.
			</div>
			<div class="parameters">
				<div class="input-title">
					HARGA PER-UNIT
				</div>
				<div class='input-group'>
					<input type="number" class="form-control" step="1" ng-model="variable.priceper" ng-change="changePrice()">
					<div class="input-group-btn">
						<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							[[variable.selecteduom]]
						</button>
						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="#" ng-repeat="item in variable.priceperuom" ng-click="setSelectedUOM(item)">[[item]]</a>
						</div>
					</div>
				</div>
			</div>
			<div class="parameters">
				<div class="input-title">
					TOKO
				</div>
				<div class='input-group'>
					<select class="form-control" ng-options="item.name for item in papershops track by item.id" ng-model="variable.papershop"></select>
				</div>
			</div>
			<div class="parameters">
				<div class="input-title">
					MARGIN (std. 4-10%)
				</div>
				<div class="input-group">
					<input type="number" class="form-control" step="1" ng-model="variable.margin" ng-change="changePrice()">
					<span class="input-group-addon">%</span>
					<div class="input-group-btn">
						<button class="btn btn-outline-purple" ng-click="confirmSubmit()">
							Go <i class="fa fa-chevron-right"></i>
						</button>
					</div>
				</div>
				<div class="text-xs-center text-bold tx-red size-70p" ng-hide="errorsubmit==''">
					[[errorsubmit]]
				</div>
			</div>
		</div>
	</div>


	@include('pages.admin.master.paper.modals.submit-confirm')

</div>

@stop