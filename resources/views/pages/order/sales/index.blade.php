@extends('layouts.container')
@section('title', 'Proses & Pembayaran')
@section('robots', 'noindex,nofollow')
@section('content')
	<!-- <form> -->
<div ng-controller = "AllSalesController" class="all-sales-customer">

@if(isset($allsales))      
	<?php
		$temp = str_replace(array('\r', '\"', '\n', '\''), '?', $allsales);
	?>
	<div ng-init="initAllSales('{{$temp}}')"></div>
	@if ($allsales != null)
		@if(count($allsales) != 0)
			<div ng-init="globalSalesID('{{$allsales[0]['id']}}')"></div>
		@endif
	@endif

	@if($link != null)
		<div ng-init="setselectedfilter('{{$link}}', false)"></div>
	@else
		<div ng-init="setselectedfilter('', false)"></div>
	@endif
@endif
<!-- NANTI MESTI BUAT VALIDASI KALO ORANG LANGSUNG MASUK KE UPLOAD HARUS DI CEK DULU UDA ADA SESSION DARI PAGE ORDER BLOM.. -->

	@include('includes.nav.subnav')

	@if($allsales != null)
		@if(count($allsales) > 0)
			@include('includes.nav.salenav')

	<div ng-if="selectedfilter!=-1">
		<div class="page-title margin-10-0"><!--  ng-bind-html="allsalespagetitle"> -->
			<i class="far fa-bags-shopping fa-fw"></i>
			Transaction Overview
		</div>
		<div class="margin-0">
			<div class="btn-filtercusttrans">
				<a href="" ng-click="setselectedfilter(item.link, true)" ng-class="{'active':item.link==selectedfilter}" class="btn" ng-repeat="item in filters">
					<i class="fal hidden-xs-down" ng-class="item.icon"></i>
					[[item.name]]
				</a>
			</div>


			<table class="table table-sm table-custom-allsales">
				<thead class="text-center">
					<tr>
						<th class="width-min">#Job</th>
						<th class="width-min">Waktu</th>
						<th></th>
						<th>
							<i class="fas fa-cog"></i> 
							Action
						</th>
					</tr>
				</thead>
				<tbody ng-if="loadingfilter">
					<tr>
						<td coslpan="10" class="text-xs-center">
							<i class="fas fa-spin fa-spinner fa-3x"></i>
							<br>
							L O A D I N G ...
						</td>
					</tr>
				</tbody>
				<tbody ng-repeat="item in sales" ng-if="!loadingfilter">
					<tr class="content-header text-center">
						<td class="">#[[zeroFill(item.id, 5)]]</td>
						<td class="line-1 size-80p">
							<b>[[item.created_at|date:'dd/MM']]</b><span class="tx-lightgray">[[item.created_at|date:'/yy']]</span>
							<br>
							[[item.created_at|date:'HH:mm']]
						</td>
						<td class="">
							<!-- <span class="tx-lightgray">
								Rp 
							</span>
							[[item.totalprice|number:0]] -->

							<div class="line-12 text-left">
								<div class="" ng-repeat="item2 in item.salesdetail">
									<span class="tx-lightgray">
										[[($index+1)|number:0]].
									</span>
									<span class="">
										[[item2.cartheader.quantity]] [[item2.cartheader.quantitytypename]]
									</span>
									<span class="tx-primary">
										[[item2.cartheader.jobsubtype.name]] [[item2.cartheader.jobtitle]]
									</span>
									<span class="tx-success" ng-if="item2.commited">
										<i class="fas fa-check-circle"></i>
										Sudah Commit
									</span>
									<span class="tx-danger" ng-if="!item2.commited" data-toggle="tooltip" data-placement="top" data-html="true" data-title="<b>BELUM COMMIT</b><br><br>Agar dapat dicetak, harus ada <br><b class='tx-primary'>persetujuan cetak (commit)</b><br> untuk setiap hasil proof yang kami upload.<br><br>Jika belum dibuatkan file proof, silahkan hubungi <br><b>0859-5971-7175</b><br> untuk mempercepat pengerjaan.">
										<i class="fas fa-ban"></i>
										Belum Commit
									</span>
								</div>
							</div>
						</td>
						<td class="th-action act-3">
							<div class="btn-group btn-header">
								<button class="btn btn-sm" ng-class="{'selected':item.showdelivery}" data-toggle="tooltip" data-title="Pengiriman" data-placement="top" data-html="true" ng-click="showdelivery(item)">
									<span class="fas fa-truck"></span>
								</button>
								<button class="btn btn-sm" ng-class="{'selected':item.showpayment}" data-toggle="tooltip" data-title="Pembayaran" data-placement="top" data-html="true" ng-click="showpayment(item)">
									<span class="far fa-credit-card"></span>
								</button>
								<button class="btn btn-sm" ng-class="{'selected':item.showdetail}" data-toggle="tooltip" data-title="Lihat detail" data-placement="top" data-html="true" ng-click="showdetail(item)">
									<span class="far fa-list-alt"></span>
								</button>
							</div>
						</td>
					</tr>
					<tr class="content-detail detail-item" ng-show="item.showdetail">
						<td class="" colspan="10">
							<div class="detail">
								<div class="subheader">
									DETAIL BARANG dan FILE
								</div>
								<table class="table table-cartheader">
									<thead>
										<tr>
											<th class="text-xs-center width-min">#</th>
											<th class="text-left">Judul Job</th>
											<th class="text-xs-center width-min">File</th>
										</tr>
									</thead>
									<tbody ng-repeat="item2 in item.salesdetail">
										<tr>
											<td class="nomor" rowspan="5">
												<b class="tx-purple">
													[[zeroFill($index+1, 2)]].
												</b>
											</td>
											<td class="text-xs-left">
												[[item2.cartheader.jobsubtype.name]]
												<strong>[[item2.cartheader.jobtitle]]</strong>
											</td>
											<td>
												<button href="" class="btn btn-xsm btn-outline-purple text-bold" ng-click="showfiles(item2)">
													<span class="fas fa-file-alt"></span> 
													FILEs
												</button>
											</td>
										</tr>
										<tr>
											<td colspan="2">
												<div class="detail-description">
													<div class="description-item">
														<div class="label">
															Qty
														</div>
														<div class="text text-bold">
															[[item2.cartheader.quantity]]&nbsp;
															<span class="tx-lightgray">
																[[item2.cartheader.quantitytypename]]
															</span>
														</div>
													</div>
													<div class="description-item">
														<div class="label">
															Proc.
														</div>
														<div class="text">
															[[item2.cartheader.processtype]]
														</div>
													</div>
													<div class="description-item">
														<div class="label">
															Deliv.
														</div>
														<div class="text">
															[[item2.cartheader.delivery.deliveryname]]
														</div>
													</div>
													<div class="description-item">
														<div class="label">
															Deliv Rp.
														</div>
														<div class="text">
															[[item2.cartheader.deliveryprice|number:0]]
														</div>
													</div>
													<div class="description-item">
														<div class="label">
															Print Rp.
														</div>
														<div class="text">
															[[(item2.cartheader.printprice-item2.cartheader.discount)|number:0]]
														</div>
													</div>
													<div class="description-item">
														<div class="label">
															Total Rp.
														</div>
														<div class="text text-bold">
															[[(item2.cartheader.printprice-item2.cartheader.discount+item2.cartheader.deliveryprice)|number:0]]
														</div>
													</div>
													<div class="description-item">
														<div class="label">
															Berat
														</div>
														<div class="text">
															[[item2.cartheader.totalweight]] kg
														</div>
													</div>
													<div class="description-item">
														<div class="label">
															Ket.
														</div>
														<div class="text">
															[[item2.cartheader.itemdescription]]
														</div>
													</div>
													<div class="description-item">
														<div class="label">
															Cat.
														</div>
														<div class="text">
															[[item2.cartheader.customernote]]
														</div>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td colspan="2">
												<table class="table table-subdetail">
													<tbody ng-repeat="item3 in item2.cartheader.cartdetail">
														<tr>
															<td class='nomor width-min'>
																#[[zeroFill($index+1, 2)]]<br>
																<b class="tx-gray">[[item3.cartname]]</b>
															</td>
															<td>
																<div class="detail-description">
																	<div class="description-item">
																		<div class="label">
																			<i class="fas fa-sticky-note"></i>
																		</div>
																		<div class="text">
																			<b>
																				[[item3.paper.name]] 
																			</b> &nbsp;
																			<span class="tx-purple">
																				[[item3.paper.gramature]]g 
																			</span> &nbsp;
																			[[item3.paper.color]]
																		</div>
																	</div>
																	<div class="description-item">
																		<div class="label">
																			<i class="fas fa-print"></i>
																		</div>
																		<div class="text">  
																			[[item3.printer.machinename]] 
																		</div>
																	</div>
																	<div class="description-item">
																		<div class="label">
																			<i class="fas fa-expand-arrows-alt"></i>
																		</div>
																		<div class="text">  
																			<b>[[item3.imagewidth|number:1]] </b>
																			&nbsp;x&nbsp; 
																			<b> [[item3.imagelength|number:1]]</b> cm
																		</div>
																	</div>
																	<div class="description-item">
																		<div class="label">
																			<i>
																				side
																			</i>
																		</div>
																		<div class="text">  
																			<b>
																				[[item3.side1]]
																			</b>
																			<span class="tx-lightgray">
																				/
																			</span>
																			<b>
																				[[item3.side2]]
																			</b>
																			&nbsp;( 
																			<b ng-show="item3.side2>0">
																				2
																			</b>
																			<b ng-show="item3.side2==0">
																				2
																			</b>
																			&nbsp;sisi cetak)
																		</div>
																	</div>
																	<div class="description-item" ng-repeat="item4 in item3.cartdetailfinishing">
																		<div class="label">
																			[[item4.finishing.name]]
																			<span class="far fa-question-circle" data-title="[[item4.finishing.info]]" data-toggle="tooltip" data-placement="top" data-html="true"></span>
																		</div>
																		<div class="text">  
																			[[item4.finishingoption.optionname]]
																		</div>
																	</div>
																</div>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
										<tr>
											<td class="padding-10-0" colspan="2">
												<div class="tracking-status">
													<div class="tracking-ball">
														<span class="fas fa-shopping-bag"></span>
													</div>

													<div class="line" ng-class="{'state-invisible':item.totalpayment<item.totalprice}"></div>
													<div class="tracking-ball" ng-class="{'state-invisible':item.totalpayment<item.totalprice}" data-toggle="tooltip" data-title="<b>LUNAS</b>" data-placement="top" data-html="true">
														<span class="fas fa-dollar-sign"></span>
													</div>

													<div class="line" ng-class="{'state-invisible':item2.statusfile==0}"></div>
													<div class="tracking-ball" ng-class="{'state-invisible':item2.statusfile==0}" data-toggle="tooltip" data-title="<b>Pembuatan Plat</b>" data-placement="top" data-html="true">
														<span class="far fa-copy"></span>
													</div>

													<div class="line" ng-class="{'state-invisible':item2.statusctp==0}"></div>
													<div class="tracking-ball" ng-class="{'state-invisible':item2.statusctp==0}" data-toggle="tooltip" data-title="<b>Siap Cetak</b>" data-placement="top" data-html="true">
														<span class="fab fa-usb"></span>
													</div>

													<div class="line" ng-class="{'state-invisible':item2.statusprint==0}"></div>
													<div class="tracking-ball" ng-class="{'state-invisible':item2.statusprint==0}" data-toggle="tooltip" data-title="<b>Selesai Cetak & Finishing</b>" data-placement="top" data-html="true">
														<span class="fas fa-print"></span>
													</div>

													<div class="line" ng-class="{'state-invisible':item2.statuspacking==0}"></div>
													<div class="tracking-ball" ng-class="{'state-invisible':item2.statuspacking==0}" data-toggle="tooltip" data-title="<b>Selesai bungkus</b>" data-placement="top" data-html="true">
														<span class="fas fa-boxes"></span>
													</div>

													<div class="line" ng-class="{'state-invisible':item2.statusdelivery==0}"></div>
													<div class="tracking-ball" ng-class="{'state-invisible':item2.statusdelivery==0}" data-toggle="tooltip" data-title="<b>Sudah Kirim</b>" data-placement="top" data-html="true">
														<span class="fas fa-truck fa-flip-horizontal"></span>
													</div>

													<div class="line" ng-class="{'state-invisible':item2.statusdone==0}"></div>
													<div class="tracking-ball" ng-class="{'state-invisible':item2.statusdone==0}" data-toggle="tooltip" data-title="<b>Sudah diterima</b>" data-placement="top" data-html="true">
														<span class="fas fa-check"></span>
													</div>
												</div>
												<div class="margin-10">
													<span class="tx-lightgray">
														Last edit: 
													</span>
													<span class="tx-lightmagenta">
														[[item2.updated_at|date:'medium']]
													</span>
													
													<br>

													<span class="tx-lightgray">
														<i class="fas fa-history"></i>
													</span>
													<span class="tx-lightmagenta"> 
														[[item2.pip]]
													</span>
												</div>
											</td>
										</tr>
										<tr>
											<td class="text-xs-left text-v-center" colspan="2">
												<span class="" ng-show="item2.statusdone==1">
													<button class="btn btn-sm btn-purple">
														<i class="fas fa-check"></i> Konfirmasi Terima Barang
													</button>
												</span>
												<span class="pull-xs-right size-120p">

													<span class="tx-success margin-5" ng-if="item2.commited"><i class="fas fa-check size-100p"></i> Sudah di Commit!</span>
													<span class="tx-danger margin-5" ng-if="!item2.commited"><i class="fas fa-ban tx-danger size-100p"></i> Belum Commit</span>

													<button class="btn btn-sm btn-outline-purple text-bold" ng-click="commit(item, item2)">
														<span class="fas fa-flag"></span> Commit
													</button>

													<button class="btn btn-sm btn-success text-bold" ng-click="sendcommit('{{URL::asset('/')}}', item, item2)" data-placement="left" data-toggle="tooltip" data-html="true" data-title="Kirim<br><b>link konfirmasi file</b><br>via Whatsapp">
														<span class="fab fa-whatsapp"></span> Send
													</button>
												</span>
											</td>
										</tr>
									</tbody>
								</table>
								<div class="size-90p margin-10-0">
									<i class="fas fa-exclamation-circle tx-red"></i>
									Jika sudah <b>COMMIT</b>, berarti sudah menyetujui dengan proses cetak sesuai <a href="{{URL::asset('terms')}}">Syarat & Ketentuan</a> yang berlaku.
									<i class="fas fa-exclamation-circle tx-red"></i>
									<br>
									<i class="fas fa-exclamation-circle tx-red"></i>
									Dan tidak dapat melakukan perubahan file, setelah <b>COMMIT</b>
									<i class="fas fa-exclamation-circle tx-red"></i>
								</div>
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
									<thead>
										<tr>
											<th>#</th>
											<th>Pekerjaan</th>
											<th class="text-xs-center">Biaya Kirim</th>
											<th class="text-xs-center">Jumlah</th>
											<th class="text-xs-center">Status</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr ng-repeat="item2 in item.salesdetail">
											<td class="width-min">[[$index+1]]. </td>
											<td class="text-xs-left">
												<strong>[[item2.cartheader.jobtitle]]</strong>
												<span class="tag tag-purple text-regular">[[item2.cartheader.jobtype]]</span>
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
											<td class="width-min">
												<a class="a-purple" href="" data-toggle="tooltip" data-placement="top" data-title="edit delivery" hidden>
													<i class="fas fa-edit text-bold"></i>
												</a>
											</td>
										</tr>
									</tbody>
								</table>
								<br>
								<div class="btn-group" hidden>
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
									TOTAL TAGIHAN -
									[[item.totalprice]]
								</div>
								<table class="table table-center">
									<tbody>
										<tr ng-repeat="item2 in item.salesdetail">
											<td class="width-min">[[$index+1]]. </td>
											<td class="text-xs-left">
												<strong>[[item2.cartheader.jobtitle]]</strong>
												<span class="tag tag-purple text-regular">[[item2.cartheader.jobtype]]</span>
											</td>
											<td class="text-xs-left" data-toggle="tooltip" data-title="" data-placement='bottom' data-html='true'>
												<span data-toggle="tooltip" data-placement="bottom" data-html="true" data-title="<b>Harga Cetak</b><br>Harga Kertas + Ongkos Cetak + Ongkos Finishing">
													<i class="fas fa-print tx-gray"></i> 
													[[item2.cartheader.printprice|number:0]]
												</span>
												<span class="hidden-md-down">
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												</span>
												<br class="hidden-lg-up">
												<span data-toggle="tooltip" data-placement="bottom" data-html="true" data-title="<b>- Discount</b>">
													<i class="fas fa-percentage tx-red"></i> 
													[[item2.cartheader.discount|number:0]]
												</span>
												<span class="hidden-md-down">
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												</span>
												<br class="hidden-lg-up">
												<span data-toggle="tooltip" data-placement="bottom" data-html="true" data-title="<b>Ongkos Kirim</b>">
													<i class="fas fa-truck tx-gray"></i> 
													[[item2.cartheader.deliveryprice|number:0]]
												</span>
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
												[[item.totalprice]]
											</td>
										</tr>
										<tr ng-repeat='item2 in item.salespayment'>
											<td class="text-xs-right" colspan="3">
												Pembayaran <span ng-show="item.payments.length>1">[[$index+1]] </span>([[item2.paydate]])
												<span class="tag tag-danger signika size-80p" ng-show="item2.salespaymentverif.veriftime==null" data-toggle="tooltip" data-placement="top" data-html="true" data-title="hubungi <b>0813-1551-9889</b>,<br>untuk mempercepat proses">
													&nbsp;
													<i class="fas fa-hourglass-half fa-spin"></i> &nbsp;&nbsp;
													MENUNGGU VERIFIKASI
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
											<td class="text-xs-right" colspan="3" ng-if="(item.totalprice-item.totalpay)>0">
												Sisa Bayar
											</td>
											<td class="text-xs-right" colspan="3" ng-if="(item.totalprice-item.totalpay)<0">
												Kelebihan Bayar
											</td>
											<td ng-if="(item.totalprice-item.totalpay)!=0"><b>=</b></td>
											<td class="text-xs-right text-bold" ng-class="{'tx-purple':(item.totalprice-item.totalpay)>0, 'tx-red':(item.totalprice-item.totalpay)<0, 'tx-success':(item.totalprice-item.totalpay)==0}">
												<span ng-if="(item.totalprice-item.totalpay)!=0">
													[[(item.totalprice-item.totalpay)|number:0]]
												</span>
												<span ng-if="(item.totalprice-item.totalpay)==0">
													LUNAS
												</span>
											</td>
										</tr>
									</tbody>
								</table>


								<div class="margin-10 text-bold">
									<i class="fas fa-info tx-purple icon" data-toggle='tooltip' data-placement="top" data-title="info pembayaran"></i> 
									[[item.paymentdetail]]
								</div>

								<div class="margin-0" ng-show="item.totalprice-item.totalpay>0">
									<hr class="margin-0">
									<div class="margin-5-10">
										<div class="trf-detail width-100 margin-right-10">
											<div class="left-side">
												No. Invoice : <br><span class="nominal">#[[zeroFill(item.id, 5)]]</span>
											</div>
											<div class="right-side">
												Total Tagihan : <br>Rp <span class="nominal">[[(item.totalprice-item.totalpay)|number:0]]</span>
											</div>
										</div>
										
										<div class="" data-toggle="tooltip" data-title="Otomatis, sehingga tidak perlu tanda tangan." data-placement="bottom" data-html="true">
											Konfirmasi Pembayaran <a href="{{URL::asset('payment/confirm/[[item.id]]')}}" class="a-purple">disini</a>. <span class="fas fa-exchange-alt tx-purple"></span><br>
											Daftar Nomor Rekening <a href="" class="a-purple" data-toggle="modal" data-target="#compaccnoModal">disini</a>.
										</div>
										<div class="divider"></div>
										<div class="margin-0 size-80p gray">
											Kami akan mengirim kembali segala kelebihan pembayaran, <br>paling lama 2x24 jam setelah pemberitahuan.
										</div>
									</div>
								</div>
								<div class="margin-0">
									<div class=""> 
										Cetak Penawaran <a href="{{URL::asset('payment/offering/pdf')}}/[[item.id]]" target="_blank" class="a-purple">disini</a>.<br>
										Cetak Invoice <a href="{{URL::asset('payment/invoice/pdf')}}/[[item.id]]" target="_blank" class="a-purple">disini</a>.
									</div>
								</div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="row margin-0 alert-outline-lightmagenta">
			<div class="icon-left">
				<span class="fas fa-exclamation-circle fa-spin"></span>
			</div>
			<div class="tx-alert">
				<ol>
					<li>Perubahan alamat kirim, silahkan hubungi kami.</li>
					<li>JANGAN tekan commit, bila belum yakin cetak.</li>
					<li>Kami hanya mengerjakan bila sudah COMMIT, dan sudah LUNAS.</li>
					<li><b>Konfirmasi Pembayaran</b>, terdapat pada bagian pembayaran di setiap transaksi di atas.</li>
				</ol>
			</div>
		</div>
	</div>
	<div ng-if="selectedfilter == -1">
		FILTER WASNT SET YET
	</div>

	<!-- MODAL -->
	@include ('pages.order.sales.modals.files')
	@include ('includes.modals.compaccno')
	<!-- END OF MODAL -->

		@else
	<div class="text-muted margin-40-0 text-xs-center">
		<span class="size-30">Tidak Ada Data Belanja</span><br>
		<span class="size-16">Silahkan buat pesanan Anda terlebih dahulu.<br></span>
		<span class="size-16">( <a href="{{URL::asset('flyer')}}"><span class="fas fa-edit size-14"></span> Flyer</a> | <a href="{{URL::asset('cart')}}"><span class="fas fa-shopping-basket size-14"></span> Cart</a> )</span>
	</div>
		@endif
	@else
	<div class="text-muted margin-40-0 text-xs-center">
		<span class="size-30">Tidak Ada Data Belanja</span><br>
		<span class="size-16">Silahkan buat pesanan Anda terlebih dahulu.<br></span>
		<span class="size-16">( <a href="{{URL::asset('flyer')}}"><span class="fas fa-edit size-14"></span> Flyer</a> | <a href="{{URL::asset('cart')}}"><span class="fas fa-shopping-basket size-14"></span> Cart</a> )</span>
	</div>
	@endif
</div>
	<!-- </form> -->
@stop