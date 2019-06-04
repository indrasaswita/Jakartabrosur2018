@extends('layouts.nofooter')
@section('title', 'Harga Kertas')
@section('content')

<div class="newpaper-wrapper" ng-controller="AdmNewPaperController">
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

	<div class="newpaper-detail">

		<div class="page-title margin-10-0">
			Ganti Harga Kertas menurut Kg, Pcs, Meteran
		</div>
		<table class="table">
			<thead class="text-center">
				<tr class="hidden-sm-down">
					<th class="width-min">No.</th>
					<th class="text-left">Nama Kertas</th>
					<th class="text-left">Texture</th>
					<th class="text-left">Num.</th>
					<th class="text-left">Varn.</th>
					<th class="text-left">Spot.</th>
					<th class="text-left">Lamn.</th>
					<th class="text-left">Fold.</th>
					<th class="text-left">Cacah</th>
					<th class="text-left">DieCut</th>
					<th class="text-left">Type</th>
					<th class="width-min">
						<i class="fa fa-cog"></i>
					</th>
				</tr>
				<tr class="hidden-md-up">
					<th class="width-min">
						<i class="fal fa-fw fa-hashtag"></i>
					</th>
					<th class="text-left">
						Nama
					</th>
					<th class="text-left">
						<i class="fal fa-fw fa-stroopwafel"></i>
					</th>
					<th class="text-left">
						<i class="fal fa-fw fa-sort-numeric-up"></i>
					</th>
					<th class="text-left">
						<i class="fal fa-fw fa-star"></i>
					</th>
					<th class="text-left">
						<i class="fas fa-fw fa-star-half-alt"></i>
					</th>
					<th class="text-left">
						<i class="fal fa-fw fa-shield-alt"></i>
					</th>
					<th class="text-left">
						<i class="fal fa-fw fa-star-half"></i>
					</th>
					<th class="text-left">
						<i class="fal fa-fw fa-star-half-alt"></i>
					</th>
					<th class="text-left">
						<i class="fal fa-fw fa-cut"></i>
					</th>
					<th class="text-left">Type</th>
					<th class="width-min">
						<i class="fa fa-cog"></i>
					</th>
				</tr>
			</thead>
			<tbody ng-repeat="item in papers">
				<tr class="content-header" ng-class="{'souvenir':item.papertype.id == 11, 'paper':item.papertype.id>=1&&item.papertype.id<=6, 'sticker':item.papertype.id==10, 'spanduk':item.papertype.id==7||item.papertype.id==9, 'pvc':item.papertype.id==8}">
					<td class="nomor">#[[zeroFill(item.id, 3)]]</td>
					<td class="text-xs-left hidden-sm-down">
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
					<td class="text-xs-left size-70p line-1 hidden-md-up">
						<span class="text-bold">
							[[item.name]]
						</span>
						<br>
						<span class="uppercase text-bold tx-lightmagenta size-85p">
							[[item.color]]
						</span>
						<span ng-show="item.gramature!=0">
							<span class="tx-purple">[[item.gramature]]</span><span class="tx-lightgray">g</span>
						</span>
					</td>
					<td class="width-min stat">
						<div class="tx-red" ng-if="item.texture==0" data-title="belom ada" data-toggle="tooltip" data-html="true" data-placement="top">
							<a href="" ng-click="changepaperdetail(item.id, 'texture', item)">
								<i class="fal fa-fw fa-empty-set"></i>
							</a>
						</div>
						<div class="tx-orange" ng-if="item.texture==1" data-title="HALUS + KILAP" data-toggle="tooltip" data-html="true">
							<a href="" ng-click="changepaperdetail(item.id, 'texture', item)">
								<i class="fas fa-fw fa-lightbulb-on"></i>
							</a>
						</div>
						<div class="tx-darkgray" ng-if="item.texture==2" data-title="GA HALUS + KILAP" data-toggle="tooltip" data-html="true">
							<a href="" ng-click="changepaperdetail(item.id, 'texture', item)">
								<i class="fal fa-fw fa-lightbulb"></i>
							</a>
						</div>
						<div class="tx-brown" ng-if="item.texture==3" data-title="GA HALUS + GA KILAP" data-toggle="tooltip" data-html="true">
							<a href="" ng-click="changepaperdetail(item.id, 'texture', item)">
								<i class="fal fa-fw fa-stroopwafel"></i>
							</a>
						</div>
					</td>
					<td class="width-min stat">
						<span class="tx-darkgreen" ng-if="item.numerator==1">
							<a href="" ng-click="changepaperdetail(item.id, 'numerator', item)">
								<i class="fal fa-fw fa-sort-numeric-up"></i>
							</a>
						</span>
						<span class="tx-red" ng-if="item.numerator==0">
							<a href="" ng-click="changepaperdetail(item.id, 'numerator', item)">
								<i class="fal fa-fw fa-empty-set"></i>
							</a>
						</span>
					</td>
					<td class="width-min stat">
						<span class="tx-orange" ng-if="item.varnish==1">
							<a href="" ng-click="changepaperdetail(item.id, 'varnish', item)">
								<i class="fas fa-fw fa-star"></i>
							</a>
						</span>
						<span class="tx-red" ng-if="item.varnish==0">
							<a href="" ng-click="changepaperdetail(item.id, 'varnish', item)">
								<i class="fal fa-fw fa-empty-set"></i>
							</a>
						</span>
					</td>
					<td class="width-min stat">
						<span class="tx-orange" ng-if="item.spotuv==1">
							<a href="" ng-click="changepaperdetail(item.id, 'spotuv', item)">
								<i class="fas fa-fw fa-star-half-alt"></i>
							</a>
						</span>
						<span class="tx-red" ng-if="item.spotuv==0">
							<a href="" ng-click="changepaperdetail(item.id, 'spotuv', item)">
								<i class="fal fa-fw fa-empty-set"></i>
							</a>
						</span>
					</td>
					<td class="width-min stat">
						<span class="tx-orange" ng-if="item.laminating==1">
							<a href="" ng-click="changepaperdetail(item.id, 'laminating', item)">
								<i class="fal fa-fw fa-shield-alt"></i>
							</a>
						</span>
						<span class="tx-red" ng-if="item.laminating==0">
							<a href="" ng-click="changepaperdetail(item.id, 'laminating', item)">
								<i class="fal fa-fw fa-empty-set"></i>
							</a>
						</span>
					</td>
					<td class="width-min stat">
						<span class="tx-darkgreen" ng-if="item.folding==1">
							<a href="" ng-click="changepaperdetail(item.id, 'folding', item)">
								<i class="fas fa-fw fa-star-half"></i>
							</a>
						</span>
						<span class="tx-red" ng-if="item.folding==0">
							<a href="" ng-click="changepaperdetail(item.id, 'folding', item)">
								<i class="fal fa-fw fa-empty-set"></i>
							</a>
						</span>
					</td>
					<td class="width-min stat">
						<span class="tx-darkgreen" ng-if="item.perforation==1">
							<a href="" ng-click="changepaperdetail(item.id, 'perforation', item)">
								<i class="fal fa-fw fa-star-half-alt"></i>
							</a>
						</span>
						<span class="tx-red" ng-if="item.perforation==0">
							<a href="" ng-click="changepaperdetail(item.id, 'perforation', item)">
								<i class="fal fa-fw fa-empty-set"></i>
							</a>
						</span>
					</td>
					<td class="width-min stat">
						<span class="tx-darkgreen" ng-if="item.diecut==1">
							<a href="" ng-click="changepaperdetail(item.id, 'diecut', item)">
								<i class="fal fa-fw fa-cut"></i>
							</a>
						</span>
						<span class="tx-red" ng-if="item.diecut==0">
							<a href="" ng-click="changepaperdetail(item.id, 'diecut', item)">
								<i class="fal fa-fw fa-empty-set"></i>
							</a>
						</span>
					</td>
					<td class="width-min stat">
						<select ng-options="item.id as item.name for item in papertypes" ng-model="item.papertype.id" ng-change="changepapertype(item.id, item)"></select>
					</td>
					<!-- <td class="th-action act-3"> -->
					<td class="th-action">
						<div class="btn-group btn-header" ng-if="item.id!=null">
							<button class="btn btn-sm" ng-class="{'btn-outline-purple':!item.showdetail, 'btn-purple':item.showdetail}" data-toggle="tooltip" data-title="Lihat detail" data-placement="top" data-html="true" ng-click="showdetail(item)">
								<span class="fas fa-arrow-alt-circle-down"></span>
							</button>
						</div>
						<div class="btn-group btn-header" ng-if="item.id==null">
							<button class="btn btn-sm btn-outline-purple" ng-click="savenewpaper(item)">
								<span class="fas fa-save">
								</span>
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
			<tbody>
				<tr>
					<td class="text-xs-center" colspan="12">
						<input type="text" ng-model="newname" placeholder="PAPER NAME">
						<input type="text" ng-model="newcolor" placeholder="COLOR">
						<input type="number" ng-model="newgramature" placeholder="GRAMATURE (GSM)">
						<button class="btn btn-sm btn-primary" ng-click="addfieldnewpaper()">
							<i class="fal fa-layer-plus fa-fw"></i>
							Add 1 New Line of Paper
						</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>


	@include('pages.admin.master.paper.modals.submit-confirm')

</div>

@stop