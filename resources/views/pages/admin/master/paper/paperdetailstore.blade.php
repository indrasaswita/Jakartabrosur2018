@extends('layouts.nofooter')
@section('title', 'Harga Kertas')
@section('content')

<div class="paperdetailstore-wrapper" ng-controller="AdmPaperdetailController">
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

	<div class="paperdetailstore-detail">

		<div class="page-title margin-10-0">
			Atur Vendor, toko dan detail kertas
		</div>

		<div class="paper-list">
			<ul class="paper-selector">
				<li ng-repeat="paper in papers track by $index">
					<a href="" ng-click="selectpaper($index)">
						#[[zeroFill(paper.id, 3)]] <b>[[paper.name]]</b> <span ng-if="paper.color!='Custom'">[[paper.color]]</span> <span ng-if="paper.gramature>0">[[paper.gramature]]g</span>
					</a>
				</li>
			</ul>
			<ul class="paper-show">
				<li ng-repeat="paper in papers track by $index" ng-show="selectedpaper==$index">
					<div class="paper-wrapper">
						<div class="paper-title">
							<div class="title">
								[[paper.name]]
							</div>
							<div class="subtitle">
								[[paper.color]]
								[[paper.gramature]]g
								<br>
								[[paper.papertype.name]]
							</div>
						</div>
						<ul class="paper-behavior width-100">
							<li>
								<i class="fas fa-fw fa-2x fa-check"></i>
								<div>Texture</div>
							</li>
							<li>
								<i class="fas fa-fw fa-2x fa-check"></i>
								<div>Texture</div>
							</li>
							<li>
								<i class="fas fa-fw fa-2x fa-check"></i>
								<div>Texture</div>
							</li>
							<li>
								<i class="fas fa-fw fa-2x fa-check"></i>
								<div>Texture</div>
							</li>
							<li>
								<i class="fas fa-fw fa-2x fa-check"></i>
								<div>Texture</div>
							</li>
							<li>
								<i class="fas fa-fw fa-2x fa-check"></i>
								<div>Texture</div>
							</li>
							<li>
								<i class="fas fa-fw fa-2x fa-check"></i>
								<div>Texture</div>
							</li>
						</ul>
						<div class="">
							<button class="btn btn-sm btn-outline-purple size-80p height-100" ng-click="showaddtoko()">
								<i class="fas fa-plus fa-fw"></i>
								<b>ADD TOKO</b>
								<br>
								to <b class="uppercase">
									[[paper.name]]
									<br>
									[[paper.color]]
									[[paper.gramature]]
								</b>
							</button>
						</div>
					</div>
					<table class="table table-sm">
						<tbody ng-repeat="item in paper.paperdetail">
							<tr ng-if="savestat(item.vendor.name, item.paper.id)" class="vendor">
								<td colspan="10">
									<div class="display-flex">
										<div class="vendor-logo">
											<i class="fas fa-2x fa-fw fa-store tx-lightgray"></i>
											<br>[[item.vendor.salestype]]
										</div>
										<div class="vendor-title width-100">
											<div class="name">
												[[item.vendor.name]]<span ng-if="item.vendor.salesname.length>2"> ([[item.vendor.salesname]])</span>
											</div>
											<div class="phone">
												Phone: [[item.vendor.phone1]]
												<span ng-if="item.vendor.phone2.length>0">
													/
													[[item.vendor.phone2]]
												</span>
											</div>
										</div>
										<div class="action pull-xs-right">
											<button class="btn btn-sm btn-outline-primary size-80p height-100" ng-click="showaddplanosize(item.vendor)">
												<i class="fas fa-plus fa-fw"></i>
												<b>ADD uk. PLANO</b>
												<br>
												to <b class="uppercase">[[item.vendor.name]]</b>
											</button>
										</div>
									</div>
									<div class="vendor-address" ng-if="item.vendor.addressID!=null">
										<b>[[item.vendor.address.name]]</b>: 
										<i class="fal fa-map-marker-alt fa-fw tx-purple"></i>
										[[item.vendor.address.address]]
										<span ng-if="item.vendor.address.addressnotes.length>0">
											( [[item.vendor.address.addressnotes]] )
										</span>
									</div>
								</td>
							</tr>
							<tr class="plano">
								<td class='width-min text-xs-center'>
									<a href="" class="a-purple">
										<div class="line-11" ng-if="item.available">
											<i class="fal fa-toggle-on fa-fw fa-2x tx-success"></i>
											ON
										</div>
										<div ng-if="!item.available">
											<i class="fal fa-toggle-on fa-fw fa-2x tx-danger"></i>
											OFF
										</div>
									</a>
								</td>
								<td class="text-xs-center">
									#[[zeroFill(item.plano.id, 3)]]<br>
									<b class="size-120p tx-purple">[[item.plano.width|number:1]]</b> x <b class="size-120p tx-purple">[[item.plano.length|number:1]]</b>
								</td>
								<td class="size-90p">
									/Ream: 
									<b>	
										[[item.buyprice|number:0]]
									</b>
									<br>
									/Kgb: 
									<b class="tx-purple">
										[[(round(item.buyprice*20000/item.paper.gramature/item.plano.width/item.plano.length/100)*100)|number:0]]
									</b>
									<br>
									/[[item.unittype]]: 
									<b>
										[[(item.buyprice/500)|number:1]]
									</b>
								</td>
								<td class="size-90p">
									/Ream: 
									<b>
										[[item.sellprice|number:0]]
									</b>
									<br>
									/Kgs: 
									<b class="tx-purple">
										[[(round(item.sellprice*20000/item.paper.gramature/item.plano.width/item.plano.length/100)*100)|number:0]]
									</b>
									<br>
									/[[item.unittype]]: 
									<b>
										[[item.unitprice|number:0]]
									</b>
								</td>
								<td class="width-min">
									<button class="btn btn-sm btn-outline-red">
										<i class="fal fa-trash fa-fw"></i>
									</button>
								</td>
							</tr>
						</tbody>
					</table>
				</li>
			</ul>
		</div>
		
	</div>


@include('modal', 
	[
		'modalid' => 'addplanosize',
		'modaltitle' => 'Tambah Plano Size',
		'modalbody' => '
			untuk <b class="uppercase">[[papers[selectedpaper].name]] [[papers[selectedpaper].color]] [[papers[selectedpaper].gramature]]g</b>
			<br>
			pada Vendor: <!-- <b class="uppercase">[[selectedvendor.name]]</b> -->
			<select ng-options="item as (item.name)+\' (\'+item.salestype+\'). \'+item.salesname for item in vendors track by item.id" ng-model="selectedvendor"></select>
			<br>
			<br>

			<div class="modal-addplanosize">
				<table class="table table-sm text-center">
					<thead class="text-v-center line-11">
						<tr>
							<th>#</th>
							<th>Size</th>
							<th>Beli</th>
							<th>Margin</th>
							<th>Satuan Bahan</th>
						</tr>
					</thead>
					<tbody ng-repeat="item in newplanosizes">
						<tr>
							<td class="width-min" rowspan="2">
								#[[zeroFill($index+1, 2)]].
							</td>
							<td class="text-xs-center" rowspan="2">
								<input class="medium tx-purple size-120p" type="number" ng-model="item.width" ng-change="checksize(item.width, item.length, item)">
								x
								<input class="medium tx-purple size-120p" type="number" ng-model="item.length" ng-change="checksize(item.width, item.length, item)"> <br>
								dalam cm
								<div class="line-11 size-80p tx-red" ng-if="item.error.size!=null">
									[[item.error.size]]
								</div>
							</td>
							<td class="">
								Harga [[item.inputstate]]
								<br>
								Rp <input class="long" type="number" ng-model="item.inputprice" placeholder="Beli /Rim">
								<button class="btn btn-sm btn-outline-purple" ng-click="changeinputstate(item)">
									<i class="fal fa-tags fa-fw"></i>
								</button>
							</td>
							<td class="">
								<input class="short" type="number" ng-model="item.margin" placeholder="Margin"> %
							</td>
							<td class="width-min">
								<input class="short" type="number" ng-model="item.totalpcs" placeholder="Jumlah perharga">
							</td>
						</tr>
						<tr>
							<td class="line-11 size-80p">
								Per-rim : Rp 
								<b>
									[[gettotalprice(item, papers[selectedpaper])|number:0]]
								</b> 
								<br>
								Per-kg : Rp 
								<b class="tx-purple">
									[[getkgprice(item, papers[selectedpaper])|number:0]]
								</b> 
								<br>
								Per-[[item.unittype.type]] : Rp <b>[[getunitprice(item, papers[selectedpaper])|number:0]]</b>
							</td>
							<td class="line-11 size-80p">
								Per-rim : Rp 
								<b>
									[[(gettotalprice(item, papers[selectedpaper])*(100+item.margin)/100)|number:0]]
								</b> 
								<br>
								Per-kg : Rp 
								<b class="tx-purple">
									[[(getkgprice(item, papers[selectedpaper])*(100+item.margin)/100)|number:0]]
								</b> 
								<br>
								Per-[[item.unittype.type]] : Rp <b>[[(getunitprice(item, papers[selectedpaper])*(100+item.margin)/100)|number:0]]</b>
							</td>
							<td class="width-min">
								<select ng-options="type.type for type in unittypes" ng-model="item.unittype"></select>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		',
		'modalfooter' => '
			<button class="btn btn-sm btn-outline-primary pull-xs-left" ng-click="addnewplanorow()">
				<i class="fal fa-plus-hexagon fa-fw"></i>
				Add New Size
			</button>
			<button class="btn btn-sm btn-outline-success " ng-click="savenewplano()">
				<i class="fas fa-save fa-fw"></i>
				Save
			</button>
		'
	]
)

</div>

@stop