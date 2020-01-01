@extends('layouts.container')
@section('title', 'All Cart | Admin')
@section('content')

<div ng-controller="AdminCartController" class="admin-cart-index-wrapper">


<?php
	$jobsubtypes_2 = str_replace(array('\r', '\"', '\n', '\''), '?', $jobsubtypes);
	$printers_2 = str_replace(array('\r', '\"', '\n', '\''), '?', $printers);
	$papers_2 = str_replace(array('\r', '\"', '\n', '\''), '?', $papers);
	$deliveries_2 = str_replace(array('\r', '\"', '\n', '\''), '?', $deliveries);
?>

<div ng-init="initData_2('{{$jobsubtypes_2}}', '{{$printers_2}}', '{{$papers_2}}', '{{$deliveries_2}}')"></div>

	<div class="page-title">
		<i class="fas fa-shopping-basket fa-fw"></i>
		Keranjang Belanja
		<i class="fas fa-fw fa-angle-double-right">
		</i>
		Admin
	</div>

@if(isset($carts))
	@if(count($carts) > 0)

<?php
	$temp = str_replace(array('\r', '\"', '\n', '\''), '?', $carts);
?>

	<div class="admin-cart-index">
		<div ng-init="initData('{{$temp}}')"></div>
		<table class="table table-sm">
			<thead class="text-center">
				<tr class="">
					<th>Customer</th>
					<th class="hidden-xs-down">Waktu Order</th>
					<th class="">
						<i class="fas fa-cog"></i> Action
					</th>
				</tr>
			</thead>
			<tbody dir-paginate="item in carts|itemsPerPage:30">
				<tr class="content-header text-center">
					<td>
						<span data-toggle="tooltip" data-title="[[item.customer.email]]<br>[[item.customer.phone1]]<br>[[item.customer.phone2]]" data-placement="right" data-html="true">
							<i class="fas fa-user tx-purple"></i>
							[[item.customer.name]]
						</span>
					</td>
					<td class="hidden-xs-down">
						<i class="fas fa-clock tx-purple"></i>
						[[item.created_at|date:'d/M H:m']]
					</td>
					<td class="th-action act-3">
						<div class="btn-group btn-header">
							<button class="btn btn-sm btn-noline-red" ng-class="{'selected':item.showdetail}" data-toggle="tooltip" data-title="Lihat detail" data-placement="top" data-html="true" ng-click="deletecart(item)">
								<span class="fas fa-trash"></span>
							</button>
							<button class="btn btn-sm btn-noline-purple" ng-click="setFileOK(item)" ng-show="item.filestatus==0">
								<span class="fas fa-check"></span>
							</button>
							<button class="btn btn-sm btn-noline-purple" ng-click="setFileNotOK(item)" ng-show="item.filestatus==1">
								<span class="fas fa-times"></span>
							</button>
							<button class="btn btn-sm btn-noline-purple" ng-class="{'selected':item.showdetail}" data-toggle="tooltip" data-title="Lihat detail" data-placement="top" data-html="true" ng-click="showdetail(item)">
								<span ng-if="!item.showdetail">show</span>
								<span ng-if="item.showdetail">hide</span>
							</button>
						</div>
					</td>
				</tr>
				<tr class="content-detail detail-item" ng-show="item.showdetail">
					<td colspan="10">
						<div class="detail">
							<div class="subheader">
								<i class="fas fa-tasks icon"></i> 
								DETAIL PESANAN
							</div>
							<table class="table table-cartdetail">
								<thead>
									<tr>
										<th colspan="4">
											Untuk detail pesanan pada Cart dapat dilihat dibawah
										</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="text-xs-left">
											#CRH[[zeroFill(item.id, 4)]]
											<b>[[item.jobsubtype.name]]</b>
										</td>
										<td>
											<i class="fas fa-print tx-purple"></i> [[item.processtime|number:0]]d <i class="fas fa-arrows-alt-h tx-lightgray"></i> 2/2/2017
										</td>
										<td>
											<i class="fas fa-truck tx-purple"></i> 
											[[item.delivery.deliveryname]] (<i class="tx-purple">[[item.delivery.deliverytype]]</i>)
										</td>
										<td class="text-xs-right">
											<i class="fas fa-print tx-lightgray"></i> <b>[[item.printprice|number:0]]</b>
										</td>
									</tr>
									<tr>
										<td class="text-xs-left">
											[[item.jobtitle]]
										</td>
										<td>
											<i class="fas fa-truck tx-purple"></i> [[item.deliverytime|number:0]]d <i class="fas fa-arrows-alt-h tx-lightgray"></i> 2/2/2017
										</td>
										<td>
											<i class="fas fa-archive tx-purple"></i> [[item.totalpackage|number:0]] bungkus
										</td>
										<td class="text-xs-right">
											<i class="fas fa-truck tx-lightgray"></i> <b>[[item.deliveryprice|number:0]]</b>
										</td>
									</tr>
									<tr>
										<td class="text-xs-left">
											<i class="fas fa-database tx-purple"></i> [[item.quantity|number:0]]<i class="tx-lightmagenta"></i> <span class="tx-lightgray">[[item.quantitytypename]]</span>
										</td>
										<td>
											<i class="fas fa-balance-scale tx-purple"></i> [[item.totalweight|number:0]] kg
										</td>
										<td class="tx-danger">
											<i class="tx-lightgray">disc</i> <b>[[item.discount|number:0]]</b>
										</td>
										<td class="text-xs-right tx-purple">
											<i class="tx-lightgray fas fa-credit-card"></i> <b>[[(item.printprice-item.discount+item.deliveryprice)|number:0]]</b>
										</td>
									</tr>
									<tr>
										<td colspan="3" class="text-xs-left">
											<span class="tx-purple margin-right-10" data-title="catatan pelanggan">
												<i class="far fa-quote-left"></i> 
												<i class="size-80p">catatan</i>
											</span>
											[[item.customernote]]
										</td>
										<td class="text-xs-right">
											<i class="tx-lightgray">buy</i> <b class="tx-info">[[item.buyprice|number:0]]</b>
										</td>
									</tr>
									<tr ng-if="item.itemdescription.length>0">
										<td colspan="4" class="text-xs-left">
											<span class="tx-purple  margin-right-10" data-title="catatan pelanggan">
												<i class="fas fa-sticky-note"></i> 
												<i class="size-80p">deskripsi</i>
											</span>
											[[item.itemdescription]]
										</td>
									</tr>
									<tr>
										<td colspan="4">
											<table class="table table-subdetail">
												<tbody ng-repeat="item2 in item.cartdetail">
													<tr>
														<td rowspan="3" class="nomor">
															#CRD
															<br>
															[[zeroFill(item2.id, 4)]]
															<br>
															<b class="tx-gray">[[item2.cartname]]</b>
														</td>
														<td class="text-xs-left">
															<i class="fas fa-adjust tx-purple"></i>
															<span ng-show="item2.side2==0">
																1
															</span>
															<span ng-show="item2.side2>0">
																2
															</span> 
															<span class="tx-lightmagenta">([[item2.side1]]/[[item2.side2]])</span> sisi cetak.
														</td>
														<td>
															<i class="fas fa-file tx-purple"></i>
															<b>[[item2.paper.name]] <span class="tx-purple" ng-show="item.paper.gramature!=0"> [[item2.paper.gramature]] gsm</span>  </b>
															[[item2.paper.color]]
															<i class="tx-lightmagenta size-80p text-bold" data-toggle="tooltip" data-placement="bottom" data-title="<b>[[item2.vendor.name]]</b><br>[[item2.vendor.address]]<br><b>Tlp.</b><br>[[item2.vendor.phone1]]<br>[[item2.vendor.phone2]]" data-html="true">[[item2.vendor.name|uppercase]]</i>
														</td>
														<td>
															<i class="fas fa-pause tx-purple"></i> [[item2.totalplano|number:0]] plano 

															<i class="far fa-hand-scissors tx-lightgray margin-0-5" data-fa-transform="flip-h"></i>

															<i class="fas fa-th-large tx-purple"></i> [[(item2.totaldruct-item2.inschiet)|number:0]]<i class="tx-lightmagenta" data-toggle="tooltip" data-title="<b class='tx-purple'>inschiet</b>" data-html="true" data-placement="bottom">+[[item2.inschiet|number:0]]</i> druct 

															<i class="far fa-hand-scissors tx-lightgray margin-0-5" data-fa-transform="flip-h"></i> 

															<i class="fas fa-th tx-purple"></i> [[item.quantity|number:0]] [[item.quantitytypename]]
														</td>
													</tr>
													<tr>
														<td class="text-xs-left">
															<b class="tx-purple">
																[[item2.jobtype]]: 
															</b>
															<i class="fas fa-print tx-lightgray"></i>
															[[item2.printer.machinename]]
														</td>
														<td>
															<i class="fas fa-pause tx-purple"></i> 1 plano 

															<i class="far fa-hand-scissors  tx-lightgray margin-0-5" data-fa-transform="flip-h"></i>

															<i class="fas fa-th-large tx-purple"></i> [[item2.totalinplano|number:0]] 

															<span ng-hide="item2.totalinplano==1">
																(<b>[[item2.totalinplanox]]</b>x<b>[[item2.totalinplanoy]]</b><span ng-hide="item2.totalinplanorest==0">+<b>[[item2.totalinplanorest]]</b></span>) 
															</span>

															pcs

															<i class="far fa-hand-scissors tx-lightgray margin-0-5" data-fa-transform="flip-h"></i>

															<i class="fas fa-th tx-purple"></i> [[(item2.totalinprint)|number:0]] 

															<span ng-hide="item2.totalinprint==1">
																(<b>[[item2.totalinprintx]]</b>x<b>[[item2.totalinprinty]]</b><span ng-hide="item2.totalinprintrest==0">+<b>[[item2.totalinprintrest]]</b></span>) 
															</span>

															pcs
														</td>
														<td>
															<i class="fas fa-pause tx-purple"></i> [[item2.plano.width|number:0]]x[[item2.plano.length|number]]cm 

															<i class="far fa-hand-scissors tx-lightgray margin-0-5" data-fa-transform="flip-h"></i>

															<i class="fas fa-th-large tx-purple"></i> [[item2.printwidth|number:0]]x[[item2.printlength|number:0]]cm 

															<i class="far fa-hand-scissors tx-lightgray" data-fa-transform="flip-h"></i> 

															<i class="fas fa-th tx-purple"></i> [[item2.imagewidth|number:0]]x[[item2.imagelength|number:0]]cm
														</td>
													</tr>
													<tr>
														<td colspan="3" class="input-wrapper">
															<div class="input-group">
																<div class="input-group-addon  tx-purple">
																	<i class="fas fa-lock"></i> 
																	<small><i>rahasia</i></small>
																</div>
																<input class="form-control" type="text" placeholder="Catatan internal di dalam rahayu untuk produksi" ng-model="item2.employeenote">
																<div class="input-group-btn">
																	<button class="btn btn-success" ng-disabled="item2.employeenote.length <= 3" ng-click="submitemployeenote($parent.$index, $index)">
																		<span class="fas fa-check size-120p" data-toggle="tooltip" data-placement="left" data-title="<b class='tx-success'>edit</b>" data-html="true"></span>
																	</button>
																</div>
															</div>
														</td>
													</tr>

													<tr ng-repeat="item3 in item2.cartdetailfinishing">
														<td class="line-12">
															#CDF [[zeroFill(item3.id, 4)]].
														</td>
														<td colspan="3" class="text-xs-left line-12">
															<b>
																[[item3.finishing.name]]
															</b>

															[[item3.quantity]]
															pcs

															(<i class="tx-lightmagenta">beli</i> [[item3.buyprice|number:0]] <i class="fas fa-angle-double-right tx-lightgray"></i> <i class="tx-lightmagenta">jual</i> [[item3.sellprice|number:0]])
															<br>
															<i class="fas fa-angle-double-right tx-lightmagenta"></i>

															[[item3.finishingoption.optionname]]
															<span ng-show="item3.side>0">
																([[item3.side]] <i>sisi</i>)
															</span>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
									<tr>
										<td class="text-xs-left">
											<span class="tx-gray">Sender: </span> 
											<b ng-show="item.resellername.length>0">[[item.resellername]] ([[item.resellerphone]]) <small class="fas fa-info-circle tx-lightgray" ng-show="item.reselleraddress.length>3" data-toggle="tooltip" data-html="true" data-placement="right" data-title="<i class='tx-lightmagenta'>[[item.reselleraddress]]</i>"></small></b>
											<b ng-hide="item.resellername.length>0" class="tx-purple">Jakarta Brosur</b>
										</td>
										<td>
											<i class="fas fa-print tx-purple"></i> [[item.processtime|number:0]]d <i class="fas fa-exchange tx-lightgray"></i> 2/2/2017
										</td>
										<td>
											<i class="fas fa-truck tx-purple"></i> 
											[[item.delivery.deliveryname]] (<i class="tx-purple">[[item.delivery.deliverytype]]</i>)
										</td>
										<td class="text-xs-right">
											<i class="fas fa-print tx-lightgray"></i> <b>[[item.printprice|number:0]]</b>
										</td>
									</tr>
								</tbody>
							</table>
							<br>
							<div class="subheader">
								<i class="far fa-file-image icon"></i> 
								DETAIL FILE
							</div>
							<table class="table table-cartdetail">
								<thead>
									<tr>
										<th class="width-min text-xs-center">Preview</th>
										<th class="">File</th>
										<th class="text-xs-right">
											<button class="btn btn-xsm btn-outline-purple pull-xs-right size-90p" ng-click="uploadoriginalClick(item.customerID, item.id, $index)">
												<i class="fas fa-plus-square"></i> 	
												TAMBAH BARU
											</button>
										</th>
									</tr>
								</thead>
								<tbody ng-repeat="item2 in item.cartfile">
									<tr>
										<td rowspan="2" class="break-word text-center">
											<img ng-src="{{URL::asset('[[item2.file.icon]]')}}" alt="No Preview" width="40px" height="40px" class="img-rounded margin-5">
										</td>
										<td class="text-xs-left break-word">
											<i class="fas fa-angle-double-right tx-purple"></i> 
											[[item2.file.filename]] ([[(item2.file.size/1024)|number:1]]KB)
										</td>
									</tr>
									<tr>
										<td class="text-xs-left break-word" colspan="2">
											File Asli : 
											<a href="{{URL::asset('')}}[[item2.file.path]]" target="_blank" class="a-purple"> <i class="fas fa-location-arrow tx-purple"></i> <!-- {{URL::asset('')}}[[item2.file.path]] --> Link</a> 
											<a class="a-purple" ng-href="{{URL::asset('cartdetails/cartfiles/download')}}/[[item2.file.id]]">
												<span class="far fa-arrow-alt-circle-down tx-purple"></span> Download
											</a>
										</td>
									</tr>
									<!-- <tr>
										<td class="text-xs-left break-word">
											Icon : 
											<a href="{{URL::asset('')}}[[item2.file.icon]]" target="_blank" class="a-purple"> <i class="fas fa-location-arrow tx-purple"></i>Link</a>
										</td>
									</tr> -->
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table>


		<!-- <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="{{URL::asset('bower_components/angularUtils-pagination/dirPagination.tpl.html')}}"></dir-pagination-controls> -->


	</div>
	

	<!-- HARUS DI DALAM IF, KARENA KALO GA ADA DATA - ERROR -->
	@include('pages.admin.cart.modals.cartreject')
	
	<input id="uploadoriginal" type="file" hidden>

	@else
	<div class="tx-gray size-16 text-xs-center margin-40-10 magra alert alert-outline-lightmagenta">
		<span class="fa-stack fa-lg fa-2x">
		  <i class="fas fa-shopping-cart fa-stack-1x tx-lightgray"></i>
		  <i class="fas fa-ban fa-stack-1x text-danger"></i>
		</span>
		<br>
		Tidak ada transaksi pada Keranjang Belanja Customer.
		<br>
		<br>
		<a href="{{URL::asset('admin/allsales')}}" class="btn btn-sm btn-outline-purple">
			<i class="fas fa-arrow-left tx-lightgray"></i>&nbsp;
			All Sales
		</a>
	</div>
	@endif
@endif

	<br>

	<div class="text-xs-center">
		<button class="btn btn-sm btn-outline-purple" data-title="<i class='tx-red far fa-user'></i> <b>Admin!</b>" data-toggle="tooltip" data-html="true" data-placement="bottom" ng-click="addbyadmin()">
			<i class="fas fa-plus tx-lightgray"></i>&nbsp;
			Add New <i class="fas fa-exclamation-triangle tx-red"></i>
		</button>
	</div>

	<!-- HARUS DI LUAR SEGALANYA, KARENA BISA TAMBAH DATA WALAUPUN KOSONG -->
	@include('pages.admin.cart.modals.addbyadmin')

</div>

@stop