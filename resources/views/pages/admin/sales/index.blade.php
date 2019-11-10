@extends('layouts.container')
@section('title', 'Sales & Payment | Admin')
@section('content')

<div class="" ng-controller="AdminSalesController">

	<?php
		$headers_2 = str_replace(array('\r', '\"', '\n', '\''), '?', $headers);
		$deliveries_2 = str_replace(array('\r', '\"', '\n', '\''), '?', $deliveries);
		$couriers_2 = str_replace(array('\r', '\"', '\n', '\''), '?', $couriers);
	?>
	@if (isset($headers))
		<div ng-init="initHeader('{{$headers_2}}', '{{$deliveries_2}}', '{{$couriers_2}}', '{{Session::get('userid')}}')"></div>
	@endif


	<div class="">
		<input id="uploadpreview" type="file" hidden>
		
		<div class="size-16 margin-10-0">
			<small class="fas fa-shopping-bag tx-lightgray"></small> Proses kerja & Alur penjualan
			<small class="fas fa-angle-right tx-lightmagenta"></small>
			<span class="fas fa-universal-access tx-lightgray"></span> Hak Admin
		</div>

		
		<table class="table table-sm table-allsales-employee">
			<thead class="text-center">
				<tr>
					<th class="width-min">#Inv.</th>
					<th>Customer</th>
					<th class="hidden-sm-down">Create</th>
					<th class="hidden-md-down">Update</th>
					<th class="hidden-xs-down">Preview</th>
					<th><span class="fas fa-cog"></span> Action</th>
				</tr>
			</thead>
			<tbody dir-paginate="item in headers|itemsPerPage:20">
				<tr class="content-header">
					<td>
						#[[zeroFill(item.id, 5)]]
					</td>
					<td class="text-xs-center">
						<span class="fas fa-user" ng-class="{'tx-lightmagenta':item.customer.title=='Mrs.'||item.customer.title=='Ms.', 'tx-primary':item.customer.title=='Mr.'}"></span>
						[[item.customer.name]]
						<span class="fas fa-info-circle tx-gray"  data-toggle="tooltip" data-placement="right" data-title="e: <b>[[item.customer.email]]</b><br>p: <b>[[item.customer.phone1]]</b> <b ng-show='item.customer.phone2.length>0'> - [[item.customer.phone2]]</b> " data-html="true"></span>
					</td>
					<td class="hidden-sm-down text-xs-center">
						[[item.created_at|date:'d MMM H:m']]
					</td>
					<td class="hidden-md-down text-xs-center">
						[[item.updated_at|date:'d MMM H:m']]
					</td>
					<td class="hidden-xs-down text-xs-left">
						<div class="line-11">
							<div ng-repeat="item2 in item.salesdetail">
								<span class="number">[[($index+1)]].</span> 
								[[item2.cartheader.quantity]] [[item2.cartheader.quantitytypename]] <b>[[item2.cartheader.jobsubtype.name]]</b> [[item2.cartheader.jobtitle]]
							</div>
						</div>
					</td>
					<td class="th-action act-4">
						<div class="btn-group btn-header">
							<button class="btn btn-sm" ng-class="{'selected':item.showdelivery}" data-toggle="tooltip" data-title="Pengiriman" data-placement="top" data-html="true" ng-click="showdelivery(item)">
								<span class="fas fa-truck"></span>
							</button>
							<button class="btn btn-sm" ng-class="{'selected':item.showpayment}" data-toggle="tooltip" data-title="Pembayaran" data-placement="top" data-html="true" ng-click="showpayment(item)">
								<span class="far fa-credit-card"></span>
							</button>
							<button class="btn btn-sm" ng-class="{'selected':item.showdetail}" data-toggle="tooltip" data-title="Lihat detail" data-placement="top" data-html="true" ng-click="showdetail(item)">
								<span class="fas fa-list-ol"></span>
							</button>
							<button class="btn btn-sm" ng-class="{'selected':item.showtracking}" data-toggle="tooltip" data-title="Lihat Progress Kerjaan" data-placement="top" data-html="true" ng-click="showtracking(item)">
								<span class="fas fa-tasks"></span>
							</button>
						</div>
					</td>
				</tr>
				<tr class="content-detail detail-item" ng-show="item.showdetail">
					<td class="" colspan="10">
						<div class="detail">
							<div class="subheader">
								<div class="txt">
									DETAIL BARANG dan FILE
								</div>
								<a href="{{URL::asset('sales/workorder/pdf')}}/[[item.id]]" class="a-purple float-right txt" target="_blank">
									<i class="fas fa-print"></i> Go to WO!
								</a>
								<a href="" class="a-purple float-right txt" ng-click="printworkorder(item)">
									<i class="fas fa-print"></i> Print WO!
								</a>
							</div>
							<table class="table table-cartheader">
								<tbody ng-repeat="item2 in item.salesdetail">
									<tr class="row-header">
										<td>
											[[item2.cartheader.jobsubtype.name]] 
											<b>
												[[item2.cartheader.jobtitle]]
											</b>
										</td>
										<td class="width-min">
											<div ng-show="item2.commited==1" data-toggle="tooltip" data-title="<b class='tx-success'>OK!</b>" data-placement="bottom" data-html='true'>
												<i class="fas fa-check"></i> ACC!
											</div>
											<div ng-show="item2.commited==0" data-toggle="tooltip" data-title="<b class='tx-danger'>Pending..</b>" data-placement="bottom" data-html="true">
												<i class="fas fa-times"></i> Belum OK!
											</div>
										</td>
									</tr>
									<tr>
										<td colspan="10" class="padding-0-10">
											<div class="subheader">
												<div class="txt">
													<i class="fas fa-tasks icon"></i> 
													DETAIL PESANAN
												</div>
											</div>
											<table class="table table-cartdetail">
												<tbody>
													<tr>
														<td class="text-xs-left">
															<b>[[item2.cartheader.jobsubtype.name]]</b>
														</td>
														<td>
															<i class="fas fa-print tx-purple"></i> [[item2.cartheader.processtime|number:0]]d <i class="fas fa-exchange tx-lightgray"></i> 2/2/2017
														</td>
														<td>
															<i class="fas fa-truck tx-purple"></i> 
															[[item2.cartheader.delivery.deliveryname]] (<i class="tx-purple">[[item2.cartheader.delivery.deliverytype]]</i>)
														</td>
														<td class="text-xs-right">
															<i class="fas fa-print tx-lightgray"></i> <b>[[item2.cartheader.printprice|number:0]]</b>
														</td>
													</tr>
													<tr>
														<td class="text-xs-left">
															[[item2.cartheader.jobtitle]]
														</td>
														<td>
															<i class="fas fa-truck tx-purple"></i> [[item2.cartheader.deliverytime|number:0]]d <i class="fas fa-exchange tx-lightgray"></i> 2/2/2017
														</td>
														<td>
															<i class="fas fa-archive tx-purple"></i> [[item2.cartheader.totalpackage|number:0]] bungkus
														</td>
														<td class="text-xs-right">
															<i class="fas fa-truck tx-lightgray"></i> <b>[[item2.cartheader.deliveryprice|number:0]]</b>
													</tr>
													<tr>
														<td class="text-xs-left">
															<i class="fas fa-calculator tx-purple"></i> [[item2.cartheader.quantity|number:0]]<i class="tx-lightmagenta"> <span class="tx-lightgray">[[item2.cartheader.quantitytypename]]</span>
														</td>
														<td>
															<i class="fas fa-weight tx-purple"></i> [[item2.cartheader.totalweight|number:0]] kg
														</td>
														<td class="tx-danger">
															<i class="tx-lightgray">disc</i> <b>[[item2.cartheader.discount|number:0]]</b>
														</td>
														<td class="text-xs-right tx-purple">
															<i class="tx-success fas fa-coins"></i> <b>[[(item2.cartheader.printprice-item2.cartheader.discount+item2.cartheader.deliveryprice)|number:0]]</b>
														</td>
													</tr>
													<tr>
														<td colspan="3" class="text-xs-left">
															<span class="tx-purple margin-right-10" data-title="catatan pelanggan">
																<i class="fas fa-sticky-note"></i> 
																<i class="size-80p">catatan</i>
															</span>
															[[item2.cartheader.customernote]]
														</td>
														<td class="text-xs-right">
															<i class="tx-lightgray">buy</i> <b class="tx-info">[[item2.cartheader.buyprice|number:0]]</b>
														</td>
													</tr>
													<tr ng-show="item2.cartheader.itemdescription.length>0">
														<td colspan="4" class="text-xs-left">
															<span class="tx-purple  margin-right-10" data-title="catatan pelanggan">
																<i class="fas fa-sticky-note"></i> 
																<i class="size-80p">deskripsi</i>
															</span>
															[[item2.cartheader.itemdescription]]
														</td>
													</tr>
													<tr>
														<td colspan="4">
															<table class="table table-subdetail">
																<tbody ng-repeat="item3 in item2.cartheader.cartheader">
																	<tr>
																		<td rowspan="3" class="nomor">
																			#[[zeroFill($index+1, 2)]]<br>
																			<b class="tx-gray">[[item3.cartname]]</b>
																		</td>
																		<td class="text-xs-left">
																			<i class="fas fa-file-text tx-purple"></i>
																			<span ng-show="item3.side2==0">
																				1
																			</span>
																			<span ng-show="item3.side2>0">
																				2
																			</span> 
																			<span class="tx-lightmagenta">([[item3.side1]]/[[item3.side2]])</span> sisi cetak.
																		</td>
																		<td>
																			<i class="fas fa-file tx-purple"></i>
																			<b>[[item3.paper.name]] <span class="tx-purple" ng-show="item3.cartheader.paper.gramature!=0"> [[item3.paper.gramature]]g</span>  </b>
																			[[item3.paper.color]]
																			<i class="tx-lightmagenta size-80p text-bold" data-toggle="tooltip" data-placement="bottom" data-title="<b>[[item3.vendor.name]]</b><br>[[item3.vendor.address]]<br><b>Tlp.</b><br>[[item3.vendor.phone1]]<br>[[item3.vendor.phone2]]" data-html="true">[[item3.vendor.name|uppercase]]</i>
																		</td>
																		<td>
																			<i class="fas fa-pause tx-purple"></i> [[item3.totalplano|number:0]] plano 

																			<i class="fas fa-scissors tx-lightgray margin-0-5"></i>

																			<i class="fas fa-th-large tx-purple"></i> [[(item3.totaldruct-item3.inschiet)|number:0]]<i class="tx-lightmagenta" data-toggle="tooltip" data-title="<b class='tx-purple'>inschiet</b>" data-html="true" data-placement="bottom">+[[item3.inschiet|number:0]]</i> druct 

																			<i class="fas fa-scissors tx-lightgray margin-0-5"></i> 

																			<i class="fas fa-th tx-purple"></i> [[item2.cartheader.quantity|number:0]] [[item2.cartheader.quantitytypename]]
																		</td>
																	</tr>
																	<tr>
																		<td class="text-xs-left">
																			<b class="tx-purple">
																				[[item3.jobtype]]: 
																			</b>
																			<i class="fas fa-print tx-lightgray"></i>
																			[[item3.printer.name]]
																		</td>
																		<td>
																			<i class="fas fa-pause tx-purple"></i> 1 plano 

																			<i class="fas fa-scissors tx-lightgray margin-0-5"></i>

																			<i class="fas fa-th-large tx-purple"></i> [[item3.totalinplano|number:0]] 

																			<span ng-hide="item3.totalinplano==1">
																				(<b>[[item3.totalinplanox]]</b>x<b>[[item3.totalinplanoy]]</b><span ng-hide="item3.totalinplanorest==0">+<b>[[item3.totalinplanorest]]</b></span>) 
																			</span>

																			pcs

																			<i class="fas fa-scissors tx-lightgray margin-0-5"></i>

																			<i class="fas fa-th tx-purple"></i> [[(item3.totalinprint)|number:0]] 

																			<span ng-hide="item3.totalinprint==1">
																				(<b>[[item3.totalinprintx]]</b>x<b>[[item3.totalinprinty]]</b><span ng-hide="item3.totalinprintrest==0">+<b>[[item3.totalinprintrest]]</b></span>) 
																			</span>

																			pcs
																		</td>
																		<td>
																			<i class="fas fa-pause tx-purple"></i> [[item3.plano.width|number:0]]x[[item3.plano.length|number]]cm 

																			<i class="fas fa-scissors tx-lightgray margin-0-5"></i>

																			<i class="fas fa-th-large tx-purple"></i> [[item3.printwidth|number:0]]x[[item3.printlength|number:0]]cm 

																			<i class="fas fa-scissors tx-lightgray"></i> 

																			<i class="fas fa-th tx-purple"></i> [[item3.imagewidth|number:0]]x[[item3.imagelength|number:0]]cm
																		</td>
																	</tr>
																	<tr>
																		<td colspan="3" class="input-wrapper">
																			<div class="input-group">
																				<div class="input-group-addon  tx-purple">
																					<i class="fas fa-lock"></i> 
																					<small><i>rahasia</i></small>
																				</div>
																				<input class="form-control" type="text" placeholder="Catatan internal di dalam rahayu untuk produksi" ng-model="item3.employeenote">
																				<div class="input-group-btn">
																					<button class="btn btn-success" ng-disabled="item3.employeenote.length <= 3" ng-click="submitemployeenote($parent.$index, $index)">
																						<span class="fas fa-check size-120p" data-toggle="tooltip" data-placement="left" data-title="<b class='tx-success'>edit</b>" data-html="true"></span>
																					</button>
																				</div>
																			</div>
																		</td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
													<tr>
														<td class="text-xs-left">
															<i class="tx-lightgray">sender</i> 
															<b data-toggle="tooltip" data-title="p: <b>[[item2.cartheader.resellerphone]]<b><br><span ng-show='item2.cartheader.reselleraddress.length>3'>[[item2.cartheader.reselleraddress]]</span>" data-html="true" data-placement="top" ng-show="item2.cartheader.resellername.length>0">
																[[item2.cartheader.resellername]]
															</b>
															<b ng-show="item2.cartheader.resellername.length==0" class="break-word">
																JakartaBrosur.com
															</b>
														</td>
														<td class="text-xs-left" colspan="3">
															<i class="tx-lightgray fas fa-location-arrow"></i> 
															<span ng-if="item2.cartheader.deliveryaddressID!=null">

																[[item2.cartheader.deliveryaddress.name]], [[item2.cartheader.deliveryaddress.address]], [[item2.cartheader.deliveryaddress.city.name]] 

																<span class="tx-gray">
																	[ [[item2.cartheader.deliveryaddress.addressnotes]] ]
																</span>
																
															</span>
															<span ng-if="item2.cartheader.deliveryaddressID==null">
																Tidak tercantum alamat!
															</span>
														</td>
													</tr>
												</tbody>
											</table>
											<div class="subheader">
												<div class="txt">
													<i class="far fa-file-archive icon"></i> 
													DETAIL FILE
												</div>
											</div>
											<table class="table table-cartdetail">
												<thead>
													<tr>
														<th class="width-85">File</th>
													</tr>
												</thead>
												<tbody ng-repeat="item3 in item2.cartheader.cartfile" class="text-v-center">
													<tr>
														</td>
														<td class="text-xs-left break-word">
															<span>
																<b class="tx-gray">	
																	#CF[[item3.id]].
																	[[item3.file.id]].
																</b>
																[[item3.file.filename]] ([[(item3.file.size/1024)|number:1]]KB)
															</span>
															<span class="tx-primary" ng-if="item3.file.revision>1">
																<i class="fab fa-rev"></i> Revisi #[[item3.file.revision]]
															</span>
														</td>
													</tr>
													<tr>
														<td class="text-xs-left break-word">
															File Asli : 
															<a href="{{URL::asset('')}}[[item3.file.path]]" target="_blank" class="a-purple"> <i class="fas fa-location-arrow tx-purple"></i> 

															Link</a> 
															<a class="a-purple" ng-href="{{URL::asset('AJAX/admin/file')}}/[[item3.file.id]]/download">
																<span class="fas fa-cloud-download-alt tx-purple"></span> Download
															</a>
														</td>
													</tr>
												</tbody>
											</table>
											<div class="subheader">
												<div class="txt">
													<i class="fas fa-search-dollar icon"></i> 
													PROOF FILE
												</div>
											</div>
											<table class="table table-cartdetail">
												<thead>
													<tr>
														<th class="">File</th>
														<th class="width-min text-xs-center">
															<i class="fas fa-cogs"
														</th>
													</tr>
												</thead>
												<tbody ng-repeat="item3 in item2.cartheader.cartpreview" class="text-v-center">
													<tr>
														<td class="text-xs-left break-word">
															<span>
																<b class="tx-gray">
																	#CP[[item3.id]].
																</b>
																[[item3.file.filename]] ([[(item3.file.size/1024)|number:1]]KB)
															</span>
															<span class="tx-success" ng-if="item3.commit==1">
																<i class="fas fa-check-circle"></i> Commited
															</span>
															<span class="tx-danger" ng-if="item3.commit!=1">
																<i class="fas fa-ban"></i> No Commit
															</span>
														</td>
														<td rowspan="3">
															<div class="btn-group-vertical">
																<button class="btn btn-sm btn-danger" ng-click="deletePreview(item3, item2, $index)">
																	<i class="far fa-trash-alt"></i> Delete
																</button>
																<button class="btn btn-sm btn-outline-danger" ng-if="item3.commit!=0" ng-click="resetCommitPreview(item3)">
																	<i class="fas fa-history"></i> Reset
																</button>
																<button class="btn btn-sm btn-success" ng-if="item3.commit==0" ng-click="sendwacommit('{{URL::asset('')}}', item3.id, item.id)">
																	<i class="fab fa-whatsapp fa-fw"></i> Send
																</button>
															</div>
														</td>
													</tr>
													<tr>
														<td class="text-xs-left break-word">
															File : 
															<a href="{{URL::asset('')}}[[item3.file.path]]" target="_blank" class="a-purple"> <i class="fas fa-location-arrow tx-purple"></i> 
															Link</a> 
															<a class="a-purple" ng-href="{{URL::asset('AJAX/admin/previewfile')}}/[[item3.file.id]]/download">
																<span class="fas fa-cloud-download-alt tx-purple"></span> Download
															</a>

														</td>
													</tr>
													<tr>
														<td class="text-xs-left break-word">
															<span ng-if="item3.comment.length>0 && item3.comment!=null">
																Pesan Pelanggan: <b class="tx-primary">[[item3.comment]]</b>
															</span>
															<span ng-if="item3.comment.length==0 || item3.comment==null" class="tx-lightgray">
																Tidak ada pesan-pesan dari Pelanggan
															</span>
														</td>
													</tr>
												</tbody>
											</table>
											<div class="width-100 text-xs-right padding-10-0">
												<div class="btn-group">
													<button class="btn btn-sm btn-outline-primary" ng-click="addprooffile(item2)">
														<i class="fas fa-search-plus"></i>
														Add Proof File
													</button>
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
								<div class="txt">
									DETAIL PENGIRIMAN
								</div>
							</div>
							<table class="table table-cartdetail">
								<thead>
									<tr>
										<th>#</th>
										<th>Pekerjaan</th>
										<th class="text-xs-center">Kirim</th>
										<th class="text-xs-center">Harga</th>
										<th class="text-xs-center">Jumlah</th>
										<th class="text-xs-center">Status</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="item2 in item.salesdetail">
										<td class="width-min">[[$index+1]]. </td>
										<td class="text-xs-left">
											[[item2.cartheader.jobsubtype.name]] <strong>[[item2.cartheader.jobtitle]]</strong>
										</td>
										<td>
											[[item2.cartheader.delivery.deliveryname]]
										</td>
										<td>
											Rp [[item2.cartheader.deliveryprice|number:0]] (<span ng-class="{'tx-success':item2.cartheader.deliveryprice>=item2.totalhargakirim, 'tx-red':item2.cartheader.deliveryprice<item2.totalhargakirim}" data-toggle="tooltip" data-title="Biaya asli">[[item2.totalhargakirim|number:0]]</span>)
										</td>
										<td>
											[[item2.cartheader.quantity|number:0]] (<span ng-class="{'tx-success':item2.cartheader.quantity==item2.totalkirim, 'tx-red':item2.cartheader.quantity!=item2.totalkirim}" data-toggle="tooltip" data-title="Terkirim">[[item2.totalkirim|number:0]]</span>) [[item2.cartheader.quantitytypename]]
										</td>
										<td class="width-min">
											<span ng-show="item2.totalkirim==0" class="tag tag-danger">
												BELOM DIKIRIM
											</span>
											<span ng-show="item2.cartheader.quantity==item2.totalkirim" class="tag tag-success">
												<i class="fas fa-check"></i>
												LENGKAP
											</span>
											<span ng-show="item2.totalkirim>0 && item2.cartheader.quantity>item2.totalkirim" class="tag tag-primary">
												PARSIAL
											</span>
										</td>
									</tr>
								</tbody>
							</table>
							<div class="subheader">
								<div class="txt">
									DETAIL SURAT JALAN
								</div>
							</div>
							<table class="table table table-cartdetail">
								<thead>
									<tr>
										<th>No. SJ</th>
										<th>Pekerjaan</th>
										<th class="text-xs-center">Harga</th>
										<th class="text-xs-center">Jumlah</th>
										<th class="text-xs-center hidden-sm-down">Total Berat</th>
										<th class="text-xs-center hidden-sm-down">Total Koli</th>
										<th class="text-xs-center hidden-xs-down">Status</th>
										<th class="width-min"></th>
										<th class="width-min"></th>
										<th class="width-min"></th>
										</tr>
								</thead>
								<tbody ng-repeat="delivery in item.salesdelivery">
									<tr ng-repeat="deliverydetail in delivery.salesdeliverydetail">
										<td class="width-min">#[[zeroFill(delivery.id, 5)]] </td>
										<td class="text-xs-left">
											<strong>[[deliverydetail.salesdetail.cartheader.jobtitle]]</strong>
											<span class="tag tag-purple text-regular">[[deliverydetail.salesdetail.cartheader.jobsubtype.name]]</span>
										</td>
										<td>
											[[deliverydetail.actualprice|number:0]]
										</td>
										<td>
											[[deliverydetail.quantity|number:0]] [[deliverydetail.salesdetail.cartheader.quantitytypename]]
										</td>
										<td class="hidden-sm-down">
											[[deliverydetail.weight|number:1]] kg
										</td>
										<td class="hidden-sm-down">
											[[deliverydetail.totalpackage|number:0]] koli
										</td>
										<td class="hidden-xs-down tx-lightgray">
											<i class="fas fa-truck fa-flip-horizontal" ng-class="{'tx-lightmagenta':(tick+$index)%3==0&&deliverydetail.status==1, 'tx-success':deliverydetail.status==2}"></i>
											<i class="fas fa-truck fa-flip-horizontal" ng-class="{'tx-lightmagenta':(tick+$index)%3==1&&deliverydetail.status==1, 'tx-success':deliverydetail.status==2}"></i>
											<i class="fas fa-truck fa-flip-horizontal" ng-class="{'tx-lightmagenta':(tick+$index)%3==2&&deliverydetail.status==1, 'tx-success':deliverydetail.status==2}"></i>
										</td>
										<td class="width-min">
											<a class="a-purple" href="" data-toggle="tooltip" data-placement="left" data-title="<b>Ubah</b> Surat Jalan<br><b>#[[zeroFill(delivery.id,5)]]</b>" data-html="true" ng-click="showUpdateDelivery(delivery)">
												<i class="fas fa-edit text-bold"></i>
											</a>
										</td>
										<td class="width-min">
											<a class="a-purple" href="{{URL::asset('admin/sales/delivery/[[delivery.id]]/pdf')}}" target="_blank" data-toggle="tooltip" data-placement="left" data-title="Surat Jalan<br><b>#[[zeroFill(delivery.id,5)]]</b>" data-html="true" ng-click="printDeliveryNote(delivery)">
												<i class="fas fa-print text-bold"></i>
											</a>
										</td>
										<td class="width-min">
											<a class="a-purple" href="" data-toggle="tooltip" data-placement="left" data-title="Konfirmasi Kirim<br><b>[[deliverydetail.quantity|number:0]] [[deliverydetail.salesdetail.cartheader.quantitytypename]]</b> <span class='tx-purple'>[[deliverydetail.salesdetail.cartheader.jobsubtype.name]]</span>" data-html="true" ng-click="showSentConfirm(delivery)">
												<i class="fas fa-truck fa-flip-horizontal text-bold"></i>
											</a>
										</td>
									</tr>
									<tr ng-show="delivery.employeenote.length > 3">
										<td></td>
										<td colspan="6" class="text-xs-left">
											<i class="fas fa-hand-o-up tx-primary"></i> 
											[[delivery.employeenote]]
										</td>

										<td class="hidden-sm-down">
										</td>
										<td class="hidden-sm-down">
										</td>
										<td class="hidden-xs-down">
										</td>
									</tr>
								</tbody>
							</table>
							<br>
							<div class="btn-group">
								<button class="btn btn-sm btn-outline-purple" ng-click="showAddDelivery($index, item.id)">
									<i class="fas fa-plus"></i>
									Buat Pengiriman
								</button>
							</div>
						</div>
					</td>
				</tr>
				<tr class="content-detail detail-payment" ng-show="item.showpayment">
					<td class="" colspan="10">
						<div class="detail padding">
							<div class="subheader">
								<div class="txt">
									TOTAL TAGIHAN
								</div>
							</div>
							<table class="table table-center">
								<tbody>
									<tr ng-repeat="item2 in item.salesdetail">
										<td class="width-min">[[$index+1]]. </td>
										<td class="text-xs-left">
											<strong>[[item2.cartheader.jobtitle]]</strong>
											<span class="tag tag-purple text-regular">[[item2.cartheader.jobtype]]</span>
										</td>
										<td class="" data-toggle="tooltip" data-title="Harga Cetak<br><br>Harga Kertas + Ongkos Cetak + Ongkos Finishing" data-placement='bottom' data-html='true'>
											<i class="fas fa-print tx-purple"></i> [[item2.cartheader.printprice|number:0]]<br class="hidden-lg-up"><span class="hidden-md-down padding-0-10"> <i class="fas fa-plus-circle"></i> </span>
											<i class="fas fa-truck tx-purple"></i> +[[item2.cartheader.deliveryprice|number:0]]
										</td>

										<td class="width-min"><b>=</b></td>
										<td data-toggle="tooltip" data-title="Total Harga" data-placement='bottom' class="text-xs-right width-min">[[(item2.cartheader.printprice+item2.cartheader.deliveryprice-item2.cartheader.discount)|number:0]]</td>
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
									<tr ng-repeat='item2 in item.salespayment'>
										<td class="text-xs-right" colspan="3">
											Pembayaran <span ng-show="item.salespayments.length>1">[[$index+1]] </span>([[item2.paydate]])
											<span class="tag tag-danger signika size-80p" ng-show="item2.salespaymentverif.veriftime==null" data-toggle="tooltip" data-placement="top" data-html="true" data-title="harap segera di-Verif,<br>klik disini!">
												&nbsp;
												<a href="" class="a-white" ng-click="makePaymentVerif(item2)">
													<i class="fas fa-hourglass-half fa-spin"></i> &nbsp;&nbsp;
													PENDING
												</a>
											</span>
											<span class="tag tag-success signika size-80p" ng-show="item2.salespaymentverif.veriftime!=null">
												<i class="fas fa-check"></i> 
												[[item2.salespaymentverif.veriftime]]
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
											[[item.totalprice-item.totalpay|number:0]]
										</td>
									</tr>
								</tbody>
							</table>


							<div class="margin-10 text-bold" ng-class="{'tx-success':item.paymentdetail=='LUNAS', 'tx-danger':item.paymentdetail!='LUNAS'}">
								<i class="fas fa-info tx-purple icon" data-toggle='tooltip' data-placement="top" data-title="info pembayaran" ng-show="item.paymentdetail!='LUNAS'"></i>
								<i class="fas fa-check tx-purple icon" ng-show="item.paymentdetail=='LUNAS'"></i>
								[[item.paymentdetail]]
							</div>

							<div class="margin-0" ng-show="item.totalprice-item.totalpayment>0">
								<hr class="margin-0">
								<div class="margin-5-10">
									<div class="trf-detail width-100 margin-right-10">
										<div class="left-side">
											No. Invoice : <br><span class="nominal">#[[zeroFill(item.id, 5)]]</span>
										</div>
										<div class="right-side">
											<span class="" ng-show="item.totalprice-item.totalpay>=0">
												Sisa yg Belom diBayar : 
											</span>
											<span class="" ng-show="item.totalprice-item.totalpay<0">
												Perlu Transfer balik : 
											</span>
											<br>
											Rp 
											<span class="nominal" ng-class="{'tx-red':item.totalprice-item.totalpay<0}">
												[[(item.totalprice-item.totalpay)|number:0]]
											</span>
										</div>
									</div>
									
									<div class="" data-toggle="tooltip" data-title="Otomatis, sehingga tidak perlu tanda tangan." data-placement="bottom" data-html="true">
										Buat Pembayaran Manual (admin) 
										<a href="" class="a-purple" ng-click="makeManualPayment(item, $index)">
											disini
										</a>.
										<br>
										Lihat Daftar Nomor Rekening <a href="" class="a-purple" data-toggle="modal" data-target="#compaccnoModal">disini</a>.<br>
										Cetak Penawaran <a href="" class="a-purple">disini</a>.<br>
										<a class="btn btn-sm btn-outline-primary" href="{{URL::asset('admin/payment/invoice')}}/[[item.id]]"  target="_blank">Print Invoice Pegawai</a>
									</div>
									<div class="divider"></div>
									<div class="margin-0 size-80p gray">
										Kami akan mengirim kembali segala kelebihan pembayaran, <br>paling lama 2x24 jam setelah pemberitahuan.
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
				<tr class="content-detail detail-tracking" ng-show="item.showtracking">
					<td class="" colspan="10">
						<div class="detail padding">
							<div class="subheader">
								<div class="txt">
									PROGRESS CETAK
								</div>
							</div>

							<table class="table table-cartdetail">
								<thead>
									<tr>
										<th class="width-min text-center">#</th>
										<th class="text-left">Details</th>
									</tr>
								</thead>
								<tbody ng-repeat="item2 in item.salesdetail">
									<tr>
										<td class="width-min nomor" rowspan="3">[[$index+1]]. </td>
										<td class="text-left">
											Judul: 
											<strong>[[item2.cartheader.jobtitle]]</strong>
											<span class="tag tag-purple text-regular">[[item2.cartheader.jobtype]]</span>
											<span class="pull-xs-right tx-gray" ng-show="item2.pip > -1" data-toggle="tooltip" data-html="true" data-placement="left" data-title="diedit [[item2.pip]] hari yg lalu">
												<i class="fas fa-history"></i> [[item2.pip]]d
											</span>
											<span class="pull-xs-right tx-gray" ng-show="item2.pip == -1" data-toggle="tooltip" data-html="true" data-placement="left" data-title="belum diedit sebelumnya">
												<i class="fas fa-history"></i> none
											</span>
										</td>
									</tr>
									<tr>
										<td class="text-xs-left">
											<div class="tracking-status">
												<div class="tracking-ball">
													<span class="fas fa-shopping-bag"></span>
												</div>

												<div class="line" ng-class="{'state-invisible':item.totalpayment<item.totalprice}"></div>
												<div class="tracking-ball" ng-class="{'state-invisible':item.totalpayment<item.totalprice}">
													<span class="fas fa-dollar-sign"></span>
												</div>

												<div class="line" ng-class="{'state-invisible':item2.statusfile==0}"></div>
												<div class="tracking-ball" ng-class="{'state-invisible':item2.statusfile==0}" data-toggle="tooltip" data-placement="top" data-title="Check File" data-html="true">
													<span class="far fa-copy"></span>
												</div>

												<div class="line" ng-class="{'state-invisible':item2.statusctp==0}"></div>
												<div class="tracking-ball" ng-class="{'state-invisible':item2.statusctp==0}" data-toggle="tooltip" data-placement="top" data-title="Cetak Plat" data-html="true">
													<span class="fab fa-usb"></span>
												</div>

												<div class="line" ng-class="{'state-invisible':item2.statusprint==0}"></div>
												<div class="tracking-ball" ng-class="{'state-invisible':item2.statusprint==0}" data-toggle="tooltip" data-placement="top" data-title="Cetak File" data-html="true">
													<span class="fas fa-print"></span>
												</div>

												<div class="line" ng-class="{'state-invisible':item2.statuspacking==0}"></div>
												<div class="tracking-ball" ng-class="{'state-invisible':item2.statuspacking==0}" data-toggle="tooltip" data-placement="top" data-title="Pengemasan" data-html="true">
													<span class="fas fa-boxes"></span>
												</div>

												<div class="line" ng-class="{'state-invisible':item2.statusdelivery==0}"></div>
												<div class="tracking-ball" ng-class="{'state-invisible':item2.statusdelivery==0}" data-toggle="tooltip" data-placement="top" data-title="Pengiriman" data-html="true">
													<span class="fas fa-truck fa-flip-horizontal"></span>
												</div>

												<div class="line" ng-class="{'state-invisible':item2.statusdone==0}"></div>
												<div class="tracking-ball" ng-class="{'state-invisible':item2.statusdone==0}" data-toggle="tooltip" data-placement="top" data-title="Selesai" data-html="true">
													<span class="fas fa-check"></span>
												</div>
											</div>
										</td>
									</tr>
									<tr ng-hide="item2.commited">
										<td>
											Belum ada commit status, belum bisa edit.
											<br>
											Hubungi <span class="tx-primary">[[item.customer.name]]</span> di 

											<a href="tel:[[item.customer.phone1]]" class="a-purple">[[item.customer.phone1]]</a>

											<a href="https://api.whatsapp.com/send?phone=[[item.customer.phone1.substr(1)]]&text=Anda%20telah%20melakukan%20pembelian%20[[item2.cartheader.jobtitle]]%20dengan%20nominal%20[[(item2.cartheader.printprice+item2.cartheader.deliveryprice-item2.cartheader.discount)|number:0]]%20akan%20segera%20diproses.%0A%0AMohon%20ketersediaan%20Anda%20untuk%20melakukan%20*commit*, agar dapat segera diproses.%0A(link:%20http://www.jakartabrosur.com/login?url=sales/all)">
												<i class="fab fa-whatsapp"></i>
											</a>

											<a href="tel:[[item.customer.phone2]]" class="a-purple" ng-show="item.customer.phone2!=null||item.customer.phone2.length>0">[[item.customer.phone2]]</a>

											<a href="https://api.whatsapp.com/send?phone=[[item.customer.phone2.substr(1)]]&text=Anda%20telah%20melakukan%20pembelian%20[[item2.cartheader.jobtitle]]%20dengan%20nominal%20[[(item2.cartheader.printprice+item2.cartheader.deliveryprice-item2.cartheader.discount)|number:0]]%20akan%20segera%20diproses.%0A%0AMohon%20ketersediaan%20Anda%20untuk%20melakukan%20*commit*, agar dapat segera diproses.%0A(link:%20http://www.jakartabrosur.com/login?url=sales/all)">
												<i class="fab fa-whatsapp"></i>
											</a>
										</td>
									</tr>
									<tr ng-show="item2.commited">
										<td>
											<div class="" ng-show="item.totalpayment<item.totalprice">
												<i class="fas fa-warning tx-red"></i> Belum ada pelunasan, tidak bisa proses! <i class="fas fa-warning tx-red"></i>
											</div>
											<div class="tracking-action" ng-hide="item.totalpayment<item.totalprice">
												<div class="tracking-ball state-hidden">
													<span class="fas fa-shopping-bag"></span>
												</div>

												<div class="line"></div>
												<div class="tracking-ball state-hidden">
													<span class="fas fa-dollar-sign"></span>
												</div>

												<div class="line"></div>
												<button class="tracking-ball" ng-class="{'state-active':item2.statusfile==1}" ng-click="changeStatusFile(item2)">
													<span class="far fa-copy" ng-hide="item2.statusfile==-1"></span>
													<span class="fas fa-spinner fa-spin tx-purple" ng-show="item2.statusfile==-1"></span>
												</button>

												<div class="line"></div>
												<button class="tracking-ball" ng-class="{'state-active':item2.statusctp==1}" ng-click="changeStatusCTP(item2)">
													<span class="fab fa-usb" ng-hide="item2.statusctp==-1"></span>
													<span class="fas fa-spinner fa-spin tx-purple" ng-show="item2.statusctp==-1"></span>
												</button>

												<div class="line"></div>
												<button class="tracking-ball" ng-class="{'state-active':item2.statusprint==1}" ng-click="changeStatusPrint(item2)">
													<span class="fas fa-print" ng-hide="item2.statusprint==-1"></span>
													<span class="fas fa-spinner fa-spin tx-purple" ng-show="item2.statusprint==-1"></span>
												</button>

												<div class="line"></div>
												<button class="tracking-ball" ng-class="{'state-active':item2.statuspacking==1}" ng-click="changeStatusPacking(item2)">
													<span class="fas fa-boxes" ng-hide="item2.statuspacking==-1"></span>
													<span class="fas fa-spinner fa-spin tx-purple" ng-show="item2.statuspacking==-1"></span>
												</button>

												<div class="line"></div>
												<button class="tracking-ball" ng-class="{'state-active':item2.statusdelivery==1}" ng-click="changeStatusDelivery(item2)">
													<span class="fas fa-truck fa-flip-horizontal" ng-hide="item2.statusdelivery==-1"></span>
													<span class="fas fa-spinner fa-spin tx-purple" ng-show="item2.statusdelivery==-1"></span>
												</button>

												<div class="line"></div>
												<button class="tracking-ball" ng-class="{'state-active':item2.statusdone==1}" ng-click="changeStatusDone(item2)">
													<span class="fas fa-check" ng-hide="item2.statusdone==-1"></span>
													<span class="fas fa-spinner fa-spin tx-purple" ng-show="item2.statusdone==-1"></span>
												</button>
											</div>
										</td>
									</tr>
								</tbody>
							</table>

						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="frame frame-action frame-right">
			<div class="title">
				<i class="fas fa-bolt"></i> Links
			</div>
			<div class="">
				<div class="btn-group margin-5">
					<a class="btn button" target="_blank" href="{{URL::asset('sales/printlist/pdf')}}">
						<i class="fas fa-print"></i> List Jadwal<br>Cetak Harian
					</a>
					<a class="btn button" target="_blank" href="{{URL::asset('sales/paperlist/pdf')}}">
						<i class="fas fa-print"></i> List Beli<br>Kertas Harian
					</a>
				</div>
				<div class="btn-group margin-5">
					<a href="" class="btn button" disabled>
						<i class="fas fa-print"></i> List Jadwal<br>Kirim Harian
					</a>
					<a href="" class="btn button" disabled>
						<i class="fas fa-list"></i> Lihat Detail<br>Data Lengkap
					</a>
				</div>
			</div>
		</div>
	</div>


	<!-- Modal -->
	@include ('pages.admin.sales.modals.verif')
	@include ('pages.admin.sales.modals.manualpayment')
	@include ('includes.modals.compaccno')

	<!-- NEW -->
	@include ('pages.admin.sales.modals.paymentverif') 
	@include ('pages.admin.sales.modals.sentconfirm') 
	@include ('pages.admin.sales.modals.adddeliveries')
	@include ('pages.admin.sales.modals.updatedelivery')

	@include('pages.admin.sales.modals.addprooffile')


	<!-- NEW -->

</div>
@stop