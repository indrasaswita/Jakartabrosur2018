@extends('layouts.default')
@section('content')

<div class="margin-0" ng-controller="TrackingController">
	<br/><br /><br />
	<?php
		$temp = str_replace(array('\r', '\"', '\n', '\''), '?', $headers);
	?>
	@if (isset($headers))
		<div ng-init="initHeader('{{$temp}}')"></div>
	@endif
	<div class="row margin-0">
		<div class="col-xs-12">
			<h3 class="tx-gray">TRACK by ADMIN</h3>
		</div>
		<div class="col-lg-12">
			<table class="table table-sm table-custom-allsales">
				<thead class="text-center">
					<tr>
						<th class="width-min">#Inv.</th>
						<th>Customer</th>
						<th class="hidden-xs-down">Create</th>
						<th class="hidden-sm-down">Update</th>
						<th><span class="fa fa-cog"></span> Action</th>
					</tr>
				</thead>
				<tbody dir-paginate="item in headers|itemsPerPage:20">
					<tr class="content-header text-center">
						<td>
							#[[zeroFill(item.salesID, 5)]]
						</td>
						<td>
							[[singkatText(item.customeremail, 15, '.')]]
							([[item.customername]])
						</td>
						<td class="hidden-xs-down">
							[[item.salesTime|date:'d/M H:m']]
						</td>
						<td class="hidden-sm-down">
							[[item.lastUpdate|date:'d/M H:m']]
						</td>
						<td class="th-action act-4">
							<div class="btn-group btn-header">
								<button class="btn btn-sm" ng-class="{'btn-outline-purple':!item.showdelivery, 'btn-purple':item.showdelivery}" data-toggle="tooltip" data-title="Pengiriman" data-placement="top" data-html="true" ng-click="showdelivery(item)">
									<span class="glyphicon glyphicon-send"></span>
								</button>
								<button class="btn btn-sm" ng-class="{'btn-outline-purple':!item.showpayment, 'btn-purple':item.showpayment}" data-toggle="tooltip" data-title="Pembayaran" data-placement="top" data-html="true" ng-click="showpayment(item)">
									<span class="glyphicon glyphicon-credit-card"></span>
								</button>
								<button class="btn btn-sm" ng-class="{'btn-outline-purple':!item.showdetail, 'btn-purple':item.showdetail}" data-toggle="tooltip" data-title="Lihat detail" data-placement="top" data-html="true" ng-click="showdetail(item)">
									<span class="glyphicon glyphicon-menu-hamburger"></span>
								</button>
								<button class="btn btn-sm" ng-class="{'btn-outline-purple':!item.showdetail, 'btn-purple':item.showdetail}" data-toggle="tooltip" data-title="Lihat proses cetak" data-placement="top" data-html="true" ng-click="showtracking(item)">
									<span class="glyphicon glyphicon-tasks"></span>
								</button>
							</div>
						</td>
					</tr>
					<tr class="content-detail detail-item" ng-show="item.showdetail">
						<td class="" colspan="10">
							<div class="detail">
								<div class="subheader">
									DETAIL BARANG dan FILE - [[item.totalpayment]] - [[item.totalprice]]
									<a href="{{URL::asset('sales/workorder/pdf')}}/[[item.salesID]]" class="a-purple float-right text-regular" target="_blank" data-toggle="tooltip" data-title="print WO" data-placement="left">
										<i class="fa fa-print"></i> Print WO!
									</a>
								</div>
								<table class="table table-cartdetail">
									<thead>
										<tr>
											<th class="text-xs-center">#</th>
											<th class="text-xs-center">Jumlah</th>
											<th class="text-left">Judul Job</th>
											<th class="text-xs-center">ACC.</th>
										</tr>
									</thead>
									<tbody ng-repeat="item2 in item.details">
										<tr>
											<td class="width-min nomor" rowspan="2">[[$index+1]]. </td>
											<td>[[item2.cartdetail.quantity|number:0]] [[item2.cartdetail.quantitytypename]]</td>
											<td class="text-xs-left"><strong>[[item2.cartdetail.jobtitle]]</strong> [[item2.cartdetail.jobtype]]</td>
											<td>
												<div ng-show="item2.commited==1" class="tx-success">
													<i class="fa fa-check"></i> 
													Sudah OK!
												</div>
												<div ng-show="item2.commited==0" class="tx-danger">
													<i class="fa fa-remove"></i> 
													Belom ACC...
												</div>
											</td>
										</tr>
										<tr>
											<td colspan="3">
												<div class="detail-description" hidden>
													File status : [[item2.cartdetail.filestatus]]<br>
													Commited : [[item2.commited]]<br>
													File checked : [[item2.statusfile]]<br>
													CTP : [[item2.statusctp]]<br>
													Print : [[item2.statusprint]]<br>
													Packaging : [[item2.statuspacking]]<br>
													Delivery : [[item2.statusdelivery]]<br>
													Received : [[item2.statusdone]]<br>
												</div>
												<div class="tracking-status">
													<div class="tracking-ball">
														<span class="fa fa-shopping-bag"></span>
													</div>

													<div class="line" ng-class="{'state-invisible':item.totalpayment<item.totalprice}"></div>
													<div class="tracking-ball" ng-class="{'state-invisible':item.totalpayment<item.totalprice}">
														<span class="fa fa-dollar"></span>
													</div>

													<div class="line" ng-class="{'state-invisible':item2.statusfile==0}"></div>
													<div class="tracking-ball" ng-class="{'state-invisible':item2.statusfile==0}">
														<span class="fa fa-files-o"></span>
													</div>

													<div class="line" ng-class="{'state-invisible':item2.statusctp==0}"></div>
													<div class="tracking-ball" ng-class="{'state-invisible':item2.statusctp==0}">
														<span class="fa fa-usb"></span>
													</div>

													<div class="line" ng-class="{'state-invisible':item2.statusprint==0}"></div>
													<div class="tracking-ball" ng-class="{'state-invisible':item2.statusprint==0}">
														<span class="fa fa-print"></span>
													</div>

													<div class="line" ng-class="{'state-invisible':item2.statuspacking==0}"></div>
													<div class="tracking-ball" ng-class="{'state-invisible':item2.statuspacking==0}">
														<span class="fa fa-dropbox"></span>
													</div>

													<div class="line" ng-class="{'state-invisible':item2.statusdelivery==0}"></div>
													<div class="tracking-ball" ng-class="{'state-invisible':item2.statusdelivery==0}">
														<span class="fa fa-truck fa-flip-horizontal"></span>
													</div>

													<div class="line" ng-class="{'state-invisible':item2.statusdone==0}"></div>
													<div class="tracking-ball" ng-class="{'state-invisible':item2.statusdone==0}">
														<span class="fa fa-check"></span>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</td>
					</tr>
				<tr class="content-detail detail-delivery" ng-show="item.showdelivery">
					<td class="" colspan="10">
						<div class="detail text-xs-center padding">
							<div class="subheader">
								DETAIL PENGIRIMAN
							</div>
							<table class="table">
								<tbody>
									<tr ng-repeat="item2 in item.detail">
										<td class="width-min">[[$index+1]]. </td>
										<td class="text-xs-left">
											<strong>[[item2.jobtitle]]</strong>
											<span class="badge badge-purple text-regular">[[item2.jobtype]]</span>
										</td>
										<td class="text-xs-left" data-toggle="tooltip" data-title="Waktu <b>PROSES</b> + <b>KIRIM</b>.<br><br>Bila ada perubahan akan diberitahukan." data-html="true" data-placement='bottom'>
											[[item2.processtime|number:0]] + [[item2.deliverytime|number:0]] hari
										</td>
										<td data-toggle="tooltip" data-title="Alamat Pengiriman Lengkap<br><br><b>Beserta patokan yang memudahkan<b>" data-placement='bottom' class="width-50 tx-primary" data-html="true" ng-class="{'text-xs-center':item2.deliveryaddress.length<10}">
											[[item2.deliveryname]] : 
											<span ng-show="item2.deliveryaddress.length>=10">[[item2.deliveryaddress]]</span>
											<span class="tx-danger" ng-hide="item2.deliveryaddress.length>=10">Tidak ada alamat!</span>
										</td>
										<td class="width-min">
											<a class="a-purple" href="" data-toggle="tooltip" data-placement="top" data-title="edit delivery">
												<i class="fa fa-edit text-bold"></i>
											</a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
				<tr class="content-detail detail-payment" ng-show="item.showpayment">
					<td class="" colspan="10">
						<div class="detail padding">
							<div class="subheader">
								TOTAL TAGIHAN
							</div>
							<table class="table table-center">
								<tbody>
									<tr ng-repeat="item2 in item.cartdetail">
										<td class="width-min">[[$index+1]]. </td>
										<td class="text-xs-left">
											<strong>[[item2.jobtitle]]</strong>
											<span class="badge badge-purple text-regular">[[item2.jobtype]]</span>
										</td>
										<td class="text-xs-left" data-toggle="tooltip" data-title="Harga Cetak<br><br>Harga Kertas + Ongkos Cetak + Ongkos Finishing" data-placement='bottom' data-html='true'>
											<i class="fa fa-print tx-purple"></i> [[item2.printprice|number:0]]<br class="hidden-lg-up"><span class="hidden-md-down padding-0-10"> <i class="fa fa-plus-circle"></i> </span>
											<i class="fa fa-truck tx-purple"></i> +[[item2.deliveryprice|number:0]]
										</td>
										<!-- <td><b>-</b></td>
										<td data-toggle="tooltip" data-title="Total Diskon" data-placement='bottom' class="tx-danger">[[item2.discount|number:0]]</td> -->
										<td class="width-min"><b>=</b></td>
										<td data-toggle="tooltip" data-title="Total Harga" data-placement='bottom' class="text-xs-right width-min">[[item2.printprice+item2.deliveryprice-item2.discount|number:0]]</td>
									</tr>
									<tr>
										<td colspan="3" class="text-xs-right">
											Total Per Nota
										</td>
										<td><b>=</b></td>
										<td class="text-bold text-xs-right tx-purple">
											[[item.totalprice|number:0]]
										</td>
									</tr>
									<tr ng-repeat='item2 in item.payments'>
										<td class="text-xs-right" colspan="3">
											Pembayaran <span ng-show="item.payments.length>1">[[$index+1]] </span>([[item2.paydate]])
											<span class="badge badge-danger signika size-80p" ng-show="item2.verif.veriftime==null" data-toggle="tooltip" data-placement="top" data-html="true" data-title="hubungi <b>0813-1551-9889</b>,<br>untuk mempercepat proses">
												&nbsp;
												<i class="fa fa-hourglass-half fa-spin"></i> &nbsp;&nbsp;
												MENUNGGU VERIFIKASI
											</span>
											<span class="badge badge-success signika size-80p" ng-show="item2.verif.veriftime!=null">
												<i class="fa fa-check"></i> 
												[[item2.verif.veriftime]]
											</span>
										</td>
										<td><b>=</b></td>
										<td class="text-xs-right">
											[[item2.ammount|number:0]]
										</td>
									</tr>
									<tr ng-show="item.payments.length==0">
										<td colspan="10">
											Belum Ada Pembayaran
										</td>
									</tr>
									<tr>
										<td class="text-xs-right" colspan="3">
											Sisa Bayar
										</td>
										<td><b>=</b></td>
										<td class="text-xs-right tx-purple text-bold">
											[[item.totalprice-item.totalpayment|number:0]]
										</td>
									</tr>
								</tbody>
							</table>


							<div class="margin-10 text-bold">
								<i class="fa fa-info tx-purple icon" data-toggle='tooltip' data-placement="top" data-title="info pembayaran"></i> 
								[[item.paymentdetail]]
							</div>

						</div>
					</td>
				</tr>
				</tbody>
			</table>
			<div class="panel-sales-wrapper">
				<dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="{{URL::asset('bower_components/angularUtils-pagination/dirPagination.tpl.html')}}"></dir-pagination-controls>
				<div class="divider"></div>
			</div>
			<div class="text-xs-center panel-sales-wrapper">
				<div class="text-bold">
					<i class="fa fa-external-link"></i> Links
				</div>
				<div class="">
					<div class="btn-group margin-5">
						<a class="btn btn-sm btn-outline-purple" target="_blank" href="{{URL::asset('sales/printlist/pdf')}}">
							<i class="fa fa-print"></i> List Jadwal<br>Cetak Harian
						</a>
						<a class="btn btn-sm btn-outline-purple" target="_blank" href="{{URL::asset('sales/paperlist/pdf')}}">
							<i class="fa fa-print"></i> List Beli<br>Kertas Harian
						</a>
					</div>
					<div class="btn-group margin-5">
						<button class="btn btn-sm btn-outline-purple" disabled>
							<i class="fa fa-print"></i> List Jadwal<br>Kirim Harian
						</button>
						<button class="btn btn-sm btn-outline-purple" disabled>
							<i class="fa fa-list"></i> Lihat Detail<br>Data Lengkap
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Modal -->
	@include ('pages.admin.sales.modals.verif')

</div>
@stop