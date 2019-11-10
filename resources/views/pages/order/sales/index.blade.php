@extends('layouts.container') @section('title', 'Proses & Pembayaran') @section('robots', 'noindex,nofollow') @section('content')

<div ng-controller="AllSalesController" class="sales-employee-wrapper">

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


		@if(app('request')->input('f') != null)
		<div ng-init="setselectedfilter('{{app('request')->input('f')}}', false)"></div>
		@else
		<div ng-init="setselectedfilter('', false)"></div>
		@endif 

		@if(app('request')->input('s') != null)
		<div ng-init="setSelectedSalesID('{{app('request')->input('s')}}')"></div>
		@endif 

		@if(app('request')->input('a') != null)
		<div ng-init="setSelectedAction('{{app('request')->input('a')}}', '{{app('request')->input('aa')}}')"></div>
		@endif 
	@endif
		<!-- NANTI MESTI BUAT VALIDASI KALO ORANG LANGSUNG MASUK KE UPLOAD HARUS DI CEK DULU UDA ADA SESSION DARI PAGE ORDER BLOM.. -->

		@include('includes.nav.subnav')

		@if($allsales != null) 
			@include('includes.nav.salenav')

		<div ng-if="selectedfilter!=-1">
			<div class="page-title margin-10-0">
				<!--  ng-bind-html="allsalespagetitle"> -->
				<i class="far fa-bags-shopping fa-fw"></i> Transaction Overview
			</div>

			<form action="/" method="post" id="is-uploader" enctype="multipart/form-data" hidden>
				@method('patch')
				@csrf

				<input name="file" id="btn-choose-file2" type="file"  ng-disabled="uploadwaiting" ng-if="!uploadwaiting" >
			</form>

			<div class="margin-0">
				<div class="btn-filter-scroll-x">
					<a href="" ng-click="setselectedfilter(item.link, true)" ng-class="{'active':item.link==selectedfilter}" class="btn ease" ng-repeat="item in filters">
						<i class="fal hidden-xs-down" ng-class="item.icon"></i> [[item.name]]
					</a>
				</div>

				<div class="allsales-loading" ng-if="salesloading">
					<i class="fas fa-sync fa-fw fa-spin fa-3x"></i><br>
					Loading
				</div>

				<table class="table table-sm table-custom-allsales" ng-if="!salesloading">
					<thead class="">
						<tr>
							<th class="width-min hidden-xs-down text-xs-center">#Job</th>
							<th class="width-min text-xs-center">Waktu</th>
							<th class="text-xs-left"> Kerjaan</th>
							<th>
								<i class="fas fa-cog text-xs-center"></i> Action
							</th>
						</tr>
					</thead>
					<tbody ng-if="loadingfilter">
						<tr>
							<td coslpan="10" class="text-xs-center">
								<i class="fas fa-spin fa-spinner fa-3x"></i>
								<br> L O A D I N G ...
							</td>
						</tr>
					</tbody>
					<tbody ng-repeat="item in sales" ng-if="!loadingfilter">
						<tr class="content-header text-center">
							<td class="hidden-xs-down">#[[zeroFill(item.id, 5)]]</td>
							<td class="line-1 size-80p">
								<b>[[item.created_at|date:'dd/MM']]</b><span class="tx-lightgray">[[item.created_at|date:'/yy']]</span>
								<br> [[item.created_at|date:'HH:mm']]
							</td>
							<td class="">
								<div class="line-12 text-left">
									<div class="" ng-repeat="item2 in item.salesdetail">
										<span class="tx-lightgray">
											[[($index+1)|number:0]].
										</span>
										<span class="hidden-sm-down">
											[[item2.cartheader.quantity]] [[item2.cartheader.quantitytypename]]
										</span>
										<span class="tx-primary">
											<span class="hidden-xs-down">
												[[item2.cartheader.jobsubtype.name]]
											</span> 
											[[item2.cartheader.jobtitle]]
										</span>
										<span class="tx-success" ng-if="item2.commited">
											<i class="fas fa-check-circle"></i>
											<span class="hidden-xs-down">
												Sudah Commit
											</span>
										</span>
										<span class="tx-danger" ng-if="!item2.commited" data-toggle="tooltip" data-placement="top" data-html="true" data-title="<b>BELUM COMMIT</b><br><br>Agar dapat dicetak, harus ada <br><b class='tx-primary'>persetujuan cetak (commit)</b><br> untuk setiap hasil proof yang kami upload.<br><br>Jika belum dibuatkan file proof, silahkan hubungi <br><b>0859-5971-7175</b><br> untuk mempercepat pengerjaan.">
											<i class="fas fa-ban"></i>
											<span class="hidden-xs-down">
												Belum Commit
											</span>
										</span>
									</div>
								</div>
							</td>
							<td class="th-action width-min">
								<div class="btn-group btn-header">
									<button class="btn btn-sm expand btn-outline-purple" ng-class="{'selected':item.showdetail}" ng-click="showdetail(item)">
										EXPAND
									</button>
								</div>
							</td>
						</tr>
						<tr class="content-detail detail-item" ng-show="item.showdetail">
							<td class="" colspan="10">
								<div class="detail-tabs ease">
									<button class="tab-list" ng-class="{'selected':item.showpayment}" ng-click="showpayment(item)">
										Payment
									</button>
									<button class="tab-list ease selected" ng-class="{'selected':item.showinfo}" ng-click="showinfo(item)">
										Detail
									</button>
									<button class="tab-list ease" ng-class="{'selected':item.showdelivery}" ng-click="showdelivery(item)">
										Delivery
									</button>
								</div>
								<div class="detail" ng-show="item.showinfo">
									<div class="allacc-sales-cartheader" ng-repeat="salesdetail in item.salesdetail" ng-if="item.salesdetail!=null">
										<div class="cartheader-title">
											<div class="circular-progress" 
												ng-class="{
														'p10':salesdetail.salesheader.totalpayment>item.totalprice,
														'p25':salesdetail.statusfile==1,
														'p40':salesdetail.statusctp==1,
														'p55':salesdetail.statusprint==1,
														'p70':salesdetail.statuspacking==1,
														'p85':salesdetail.statusdelivery==1,
														'p100':salesdetail.statusdone==1
													}"
												ng-click="showprogress(salesdetail)"></div>
											<div class="title-text">
												<div class="big hidden-sm-up">
													[[singkatText(salesdetail.cartheader.jobtitle, 15, '')]]
												</div>
												<div class="big hidden-xs-down">
													[[singkatText(salesdetail.cartheader.jobtitle, 25, '')]]
												</div>
												<div class="small">
													[[salesdetail.cartheader.jobsubtype.name]] - [[salesdetail.cartheader.quantity]] [[salesdetail.cartheader.quantitytypename]]

													[[salesdetail.showdetail]]
												</div>
											</div>
											<div class="button-progress">
												<button class="btn btn-sm btn-outline-lightmagenta hidden-xs-down" ng-click="showprogress(salesdetail)">
													<span class="hidden-sm-down">SHOW </span>
													PROGRESS
												</button>
											</div>
										</div>
										<div class="cartheader-content" ng-show="salesdetail.showsubinfo">
											<div class="card-wrapper">
												<div class="detail-card">
													<div class="detail-card-title">
														JOB DETAIL
														<i class="fas fa-info-square fa-fw"></i>
													</div>
													<div class="detail-card-text">
														<div class="detail">
															<div class="qty">
																<i class="fal fa-boxes fa-fw"></i> [[salesdetail.cartheader.quantity|number:0]] [[salesdetail.cartheader.quantitytypename]].
															</div>
															<div class="package">
																<i class="fal fa-boxes fa-fw"></i> [[salesdetail.cartheader.totalpackage|number:0]] bungkus.
															</div>
															<div class="weight">
																<i class="fal fa-dumbbell fa-fw"></i> [[salesdetail.cartheader.totalweight|number:0]] kg.
															</div>

															<div class="desc" ng-if="salesdetail.cartheader.salesdetail.cartheaderdescription.length > 0">
																<i class="fal fa-comment-alt-lines fa-fw"></i> [[salesdetail.cartheader.salesdetail.cartheaderdescription]]
															</div>
															<div class="note" ng-if="salesdetail.cartheader.customernote.length > 0">
																<i class="fal fa-comment-alt-dots fa-fw"></i> [[salesdetail.cartheader.customernote]]
															</div>
															<div class="price">
																<i class="fal fa-tag fa-fw"></i> Rp [[(salesdetail.cartheader.printprice)|number:0]] [print]
															</div>
															<div class="price tx-danger" ng-if="salesdetail.cartheader.discount>0">
																<i class="fal fa-tag fa-fw"></i> Rp [[(salesdetail.cartheader.discount)|number:0]] (disc)
															</div>
															<div class="price" ng-if="salesdetail.cartheader.discount>0">
																<i class="fal fa-tag fa-fw"></i> Rp <b>[[(salesdetail.cartheader.printprice - salesdetail.cartheader.discount)|number:0]]</b> (end)
															</div>
														</div>
														<div class="proc">
															<i class="fas fa-bolt fa-fw"></i> Cetak :
															<span ng-if="salesdetail.cartheader.processtype=='std'">
															Standard
														</span>
															<span ng-if="salesdetail.cartheader.processtype=='exp'">
															Express
														</span>
														</div>
														<div class="detail" ng-repeat="cdetail in salesdetail.cartheader.cartdetail">
															<div class="title" ng-if="salesdetail.cartheader.cartdetail.length>1">
																[[cdetail.cartname]]
															</div>
															<div class="machine">
																<i class="fal fa-print fa-fw"></i> [[cdetail.jobtypelong]]&nbsp;
																<span class="tx-lightgray">(</span><span class="tx-purple">[[cdetail.printer.machinename]]</span><span class="tx-lightgray">)</span>.
															</div>
															<div class="size">
																<i class="fal fa-expand-arrows-alt fa-fw"></i> [[cdetail.imagewidth]] x [[cdetail.imagelength]] cm.
															</div>
															<div class="material">
																<i class="fal fa-copy fa-fw"></i> [[cdetail.paper.name]] ([[cdetail.paper.color]]) [[cdetail.paper.gramature]]gsm.
															</div>
															<div class="sideprint">
																<i class="fal fa-retweet fa-fw"></i> Print
																<span ng-show="cdetail.side2==0">single</span><span ng-show="cdetail.side2>0">both</span> side.
															</div>
															<div class="finishing" ng-repeat="detailfinishing in cdetail.cartdetailfinishing">
																<i class="fal fa-layer-plus fa-fw"></i> [[detailfinishing.finishing.name]] <b>[[detailfinishing.finishingoption.optionname]]</b>.
															</div>
														</div>
													</div>
												</div>
												<div class="detail-card file-list">
													<div class="detail-card-title">
														DATA GAMBAR & FILE
														<i class="fab fa-adobe fa-fw"></i>
													</div>
													<div class="detail-card-text" ng-if="salesdetail.cartheader.cartfile.length>0">
														<div class="detail ease" ng-repeat="cfile in salesdetail.cartheader.cartfile" ng-click="showselectedfile(cfile.file, salesdetail.cartheader, salesdetail)">
															<div class="icon">
																<i class="fal fa-copy fa-fw fa-2x"></i>
															</div>
															<div class="data">
																<div class="filename">
																	[[cfile.file.filename]]
																</div>
																<div class="data-list" ng-if="cfile.file.revision>1">
																	<i class="fal fa-history fa-fw"></i>
																	revisi ke-[[(cfile.file.revision-1)|number:0]]
																</div>
																<div class="data-list">
																	<i class="fal fa-compact-disc fa-fw"></i>
																	[[(cfile.file.size/1024/1024)|number:2]]MB
																</div>
																<div class="data-list">
																	<i class="fal fa-history fa-fw"></i>
																	<span ng-if="cfile.file.updated_at==null">
																		[[cfile.file.created_at]]
																	</span>
																	<span ng-if="cfile.file.updated_at!=null">
																		[[cfile.file.updated_at]]
																	</span>
																</div>
																<div class="data-list" ng-if="cfile.file.detail.length>0">
																	<i class="fal fa-info-circle fa-fw"></i> [[cfile.file.detail]]
																</div>
															</div>
														</div>
													</div>
													<div ng-if="salesdetail.cartheader.cartfile.length==0" class="line-12 text-xs-center">
														<br>

														<i class="fas fa-eye-slash fa-fw tx-warning fa-3x"></i><br><br>
														TIDAK ADA DATA YANG DIUPLOAD<br>
														<small>
															untuk kirim file, dapat menghubungi Call Center kami.
														</small>
													</div>
												</div>
											</div>
											<div class="card-wrapper">
												<div class="detail-card">
													<div class="detail-card-title">
														DATA PENGIRIMAN 
														<i class="fas fa-truck-container fa-fw"></i>
													</div>
													<div class="detail-card-text">
														<div class="detail">
															<div class="">
																<i class="fal fa-truck fa-fw"></i> [[salesdetail.cartheader.delivery.deliveryname]]
															</div>
															<div class="" ng-if="salesdetail.cartheader.deliveryID!=1">
																<i class="fal fa-house-flood fa-fw"></i> [[salesdetail.cartheader.deliveryaddress.address]]
															</div>
															<div class="" ng-if="salesdetail.cartheader.deliveryID==1">
																<i class="fal fa-house-flood fa-fw"></i> Diambil di 
																<a class="a-purple" href="https://www.google.co.id/maps/place/Jakarta+Brosur/@-6.1410584,106.825155,17z/data=!3m1!4b1!4m5!3m4!1s0x2e69f5fa2f737f37:0x43667f0d0a3cbf7f!8m2!3d-6.1410637!4d106.8273437?hl=en" target="_blank">
																	Workshop Jakartabrosur.com
																</a>
															</div>
															<div class="package">
																<i class="fal fa-boxes fa-fw"></i> [[salesdetail.cartheader.totalpackage|number:0]] bungkus.
															</div>
															<div class="weight">
																<i class="fal fa-dumbbell fa-fw"></i> [[salesdetail.cartheader.totalweight|number:0]] kg.
															</div>

															<div class="price">
																<i class="fal fa-tag fa-fw"></i>
																<span ng-if="salesdetail.cartheader.deliveryprice==0">
																FREE DELIVERY
															</span>
																<span ng-if="salesdetail.cartheader.deliveryprice>0">
																Rp <b>[[(salesdetail.cartheader.deliveryprice)|number:0]]</b> [ongkir]
															</span>
															</div>
														</div>
													</div>
												</div>
												<div class="detail-card file-list">
													<div class="detail-card-title">
														PREVIEW & SAMPEL PROOF DIGITAL
													</div>
													<div class="detail-card-text">
														<div class="detail ease" ng-repeat="preview in salesdetail.cartheader.cartpreview" ng-click="showcartpreview(preview.file, preview)">
															<div class="icon">
																<i class="fal fa-copy fa-fw"></i>
															</div>
															<div class="data">
																[[preview.file.filename]]
															</div>		
														</div>
														<div class="alert alert-sm margin-top-10">
															Adalah file yang kami upload sebagai dummy untuk pencetakan. File dapat berupa,
															<ol>
																<li>Gambar foto dari handphone,</li>
																<li>Hasil scan, atau</li>
																<li>Upload image dari hasil JPEG.</li>
															</ol>
															<br>
															Jika ada permintaan khusus silahkan diinfokan lebih lanjut kepada pihak kami. Dan pastikan Anda sudah memeriksa tulisan dan gambar pada file preview diatas.
														</div>
													</div>
												</div>
												<div class="detail-card">
													<div class="detail-card-title">
														KETERANGAN CETAK
													</div>
													<div class="detail-card-text">
														<div class="detail">
															<div class="payment-status">
																<span ng-if="item.totalprice<=item.totalpay">
																	<i class="fal fa-fw fa-check"></i>
																	Pembayaran: Selesai
																</span>
																<span ng-if="item.totalprice>item.totalpay">
																	<i class="fal fa-fw fa-alarm-clock vibrate tx-danger"></i>
																	Pembayaran: Belum Selesai
																</span>
															</div>
														</div>
														<div class="detail">
															<div class="commit-status">
																<span ng-if="!salesdetail.commited">
																	<i class="fal fa-fw fa-alarm-clock vibrate tx-danger"></i>
																	Status: Belum Commit
																</span>
																<span ng-if="salesdetail.commited">
																	<i class="fal fa-fw fa-vote-yea"></i>
																	Status: <span class="tx-primary">Sudah Commit</span>
																</span>
															</div>
														</div>
														<div class="detail text-xs-center" ng-if="item.totalprice<=item.totalpay&&salesdetail.commited==0">
															<button class="btn btn-sm btn-outline-purple" ng-click="commit(salesdetail)">
																Ya setuju, kerjakan dan proses cetak.
															</button>

															<div ng-if="salesdetail.commiterror!=null">
																<div class="line-12" ng-if="salesdetail.commiterror.length>0">
																	<br><br>
																	[[salesdetail.commiterror]]
																</div>
															</div>
														</div>
														<div class="detail text-xs-center" ng-if="item.totalprice>item.totalpay">
															<button class="btn btn-sm btn-outline-purple" ng-click="linkmakepayment(item)">
																Buat Pembayaran
															</button>
														</div>
														<div class="alert alert-sm margin-top-10" ng-if="item.totalprice<=item.totalpay">
															Setelah setuju (commit) dengan hasil dummy (preview),
															<ol>
																<li>Proses dijalankan.</li>
																<li>Tidak bisa ubah file lagi.</li>
																<li>Pastikan preview file sudah benar, baik tulisan maupun gambar dan susunan. Periksa sebaik mungkin untuk meminimalisasi kesalahan cetak.</li>
															</ol>
														</div>
														<div class="alert alert-sm text-xs-center" ng-if="item.totalprice>item.totalpay">
															Commit & Proses dapat dilakukan setelah pelunasan. Silahkan selesaikan pembayaran terlebih dahulu.
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="cartheader-content-toggle">
											<button class="btn btn-sm btn-lightmagenta" ng-click="showsubinfo(salesdetail)">
												<span ng-if="!salesdetail.showsubinfo">
													Lihat 
													<span class="hidden-xs-down">
														Keterangan
													</span>
												</span>
												<span ng-if="salesdetail.showsubinfo">
													Tutup
												</span>
												[[salesdetail.cartheader.jobtitle]]
												<span ng-show="!salesdetail.showsubinfo">
													<i class="fas fa-caret-down fa-fw pull-xs-right"></i>
												</span>
												<span ng-show="salesdetail.showsubinfo">
													<i class="fas fa-caret-up fa-fw pull-xs-right"></i>
												</span>
											</button>
										</div>
									</div>
								</div>

								<div class="detail" ng-show="item.showdelivery">
									<div class="allacc-sales-delivery">
										<table class="table">
											<thead>
												<tr>
													<th colspan="2">Pekerjaan</th>
													<th class="text-xs-center">Biaya Kirim</th>
													<th class="text-xs-center">Jumlah</th>
													<th class="text-xs-center">Status</th>
													<th></th>
												</tr>
											</thead>
											<tbody ng-repeat="item2 in item.salesdetail">
												<tr>
													<td class="width-min">[[zeroFill($index+1, 2)]]. </td>
													<td class="text-xs-left">
														<strong>
															[[item2.cartheader.jobsubtype.name]]
															[[item2.cartheader.jobtitle]]
														</strong>
													</td>
													<td>
														Rp [[item2.cartheader.deliveryprice|number:0]]<!--  (<span ng-class="{'tx-success':item2.cartheader.deliveryprice>=item2.totalhargakirim, 'tx-red':item2.cartheader.deliveryprice<item2.totalhargakirim}" data-toggle="tooltip"
															data-title="Biaya asli">[[item2.totalhargakirim|number:0]]</span>) -->
													</td>
													<td>
														[[item2.cartheader.quantity|number:0]] (<span ng-class="{'tx-success':item2.cartheader.quantity==item2.totalkirim, 'tx-red':item2.cartheader.quantity!=item2.totalkirim}" data-toggle="tooltip" data-title="Terkirim">[[item2.totalkirim|number:0]]</span>)
														[[item2.cartheader.quantitytypename]]
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
														<span ng-show="item2.totalkirim>item2.cartheader.quantity" class="tag tag-purple">
															ERROR
														</span>
													</td>
													<td class="width-min">
														<a class="a-purple" href="" data-toggle="tooltip" data-placement="top" data-title="edit delivery" hidden>
															<i class="fas fa-edit text-bold"></i>
														</a>
													</td>
												</tr>
												<tr ng-repeat="detaildeliv in item2.salesdeliverydetail" class="tx-gray">
													<td>
														<i class="fal fa-reply fa-fw fa-flip-vertical fa-flip-horizontal"></i>
													</td>
													<td class="text-xs-left line-11" colspan="4">
														Pengiriman oleh [[detaildeliv.salesdelivery.employee.name]]
														sebanyak 
														<b>[[detaildeliv.quantity]] [[item2.cartheader.quantitytypename]]</b> 
														[ [[detaildeliv.weight]]kg / 
														[[detaildeliv.totalpackage]]packs ] 
														<br class="hidden-sm-down">
														diterima oleh [[detaildeliv.salesdelivery.receiver]] pada [[detaildeliv.salesdelivery.arrivedtime|date:'dd MMMM yyyy']] sekitar pukul [[detaildeliv.salesdelivery.arrivedtime|date:'HH:mm']]
														<i class="fal fa-arrow-alt-right fa-fw"></i>
														<b>[[detaildeliv.salesdelivery.delivery.deliveryname]]</b>
													</td>
												</tr>
											</tbody>
										</table>
										<div class="btn-group" hidden>
											<button class="btn btn-sm btn-outline-purple" ng-click="showAddDelivery($index, item.id)">
											<i class="fas fa-plus"></i>
												Buat Pengiriman
											</button>
										</div>
									</div>
								</div>

								<div class="detail" ng-show="item.showpayment">
									<div class="allacc-sales-payment">
										<div class="payment-header">

											<span ng-if="item.totalprice - item.totalpay>0">
												Total yang harus dibayar
												<div class="totalprice">
													<b>
														[[(item.totalprice - item.totalpay)|number:0]]
													</b> IDR
												</div>
											</span>
											<div class="totalprice" ng-if="item.totalprice - item.totalpay<=0">
												SUDAH LUNAS
											</div>
											untuk total [[item.salesdetail.length|number:0]] cetakan.
											<br>
											<button class="btn btn-sm btn-outline-purple move-to-detail" ng-click="showinfo(item)">
												untuk cetakan apa saja?
											</button>
										</div>
										<div class="nopay-yet" ng-show="item.showpaymentconfirm" ng-if="item.totalprice>item.totalpay">
											<div class="subheader">
												<div class="txt">
													1. Daftar Bank JakartaBrosur.com
												</div>
											</div>
											<div class="norek-wrapper">
												<a href="" class="norek-list" ng-repeat="item in compaccs" ng-class="{'selected':konfirmasi.compacc.bankID==item.bankID}" ng-click="selectbanktrf(item)">
													<div class="image">
														<img ng-src="{{URL::asset('image')}}/[[item.bank.alias]].png">
													</div>
													Bank
													[[item.bank.alias]]
												</a>
											</div>
											<div class="nopay-info" ng-if="konfirmasi.compacc!=null">
												<div class="nopay-bankacc">
													No. Rekening Bank <br>
													<b class="bank-name">[[konfirmasi.compacc.bank.bankname]]</b>
													<div class="nopay-norek">
														<span id="nopay-norek">[[konfirmasi.compacc.accno]]</span>
														<br>
														<button class="btn btn-sm btn-outline-purple" ng-click="copyToClipboard('nopay-norek')">
															SALIN
														</button>
													</div>
													<div class="nopay-description">
														a/n. [[konfirmasi.compacc.accname]]
														<br>
														KCP [[konfirmasi.compacc.acclocation]]
													</div>
												</div>
												<div class="arrow-divider vibrate">
													<i class="fas fa-fw fa-caret-right fa-2x hidden-xs-down"></i>
													<i class="fas fa-fw fa-caret-down fa-2x hidden-sm-up"></i>
												</div>
												<div class="nopay-transfer">
													<b class="title">TAGIHAN</b><br>
													yang belum<br>dibayarkan sejumlah
													<div class="nopay-nominal">
														<span class="rp">
															Rp
														</span>
														[[(item.totalprice-item.totalpay)|number:0]]<br>
														<button class="btn btn-sm btn-outline-purple" ng-click="copyToClipboard(item.totalprice)">
															SALIN
														</button>
													</div>
												</div>
											</div>
											<div class="subheader">
												<div class="txt">
													2. Daftar Bank Anda (Pengirim)
												</div>
											</div>
											<div class="nopay-custrek">
												<div class="custrek-tab">
													<button class="btn ease" ng-class="{'selected':konfirmasi.inputnew}" ng-click="konfirmasi.inputnew=true">
														INPUT BARU
													</button>
													<button class="btn ease" ng-class="{'selected':!konfirmasi.inputnew}" ng-click="konfirmasi.inputnew=false">
														DAFTAR REKENING
													</button>
												</div>
												<div class="custrek-input newrek" ng-if="konfirmasi.inputnew">
													<button class="btn" ng-click="showselectbank()">
														<span ng-if="konfirmasi.newcustacc.bank == null">
															Pilih Bank Anda 
															<span class="hidden-sm-down">
																(sebagai Pengirim)
															</span>
														</span>
														<span ng-if="konfirmasi.newcustacc.bank != null">
															<b ng-if="konfirmasi.newcustacc.bank.alias.length>0">
																[[konfirmasi.newcustacc.bank.alias]]
															</b>
															<b ng-if="konfirmasi.newcustacc.bank.alias.length<=0">
																[[konfirmasi.newcustacc.bank.bankname.toTitleCase()]]
															</b>
														</span>
														<i class="fas fa-caret-down pull-xs-right"></i>
													</button>

													<input type="text" class="form-control" ng-class="{'uppercase':konfirmasi.newcustacc.accname}" ng-model="konfirmasi.newcustacc.accname" placeholder="Nama Pemilik Rekening">
													<input type="text" class="form-control" ng-model="konfirmasi.newcustacc.accno" placeholder="Nomor Rekening (optional)">
												</div>
												<div class="custrek-info" ng-if="konfirmasi.inputnew">
													<i class="fal fa-info-circle fa-fw"></i>
													Nomor Rekening tidak wajib diisi, akan diperlukan hanya untuk pengembalian dana karena kelebihan bayar atau pembatalan transaksi.
												</div>
												<div class="newrek-action" ng-if="konfirmasi.inputnew">
													<button class="btn btn-sm btn-outline-purple" ng-click="savecustbankacc()">
														<span ng-if="!loadingsavecustacc">
															SIMPAN REKENING SAYA
														</span>
														<span ng-if="loadingsavecustacc">
															<i class="fas fa-spin fa-spinner fa-fw"></i>
															Saving...
														</span>
													</button>
												</div>
												<div class="custrek-input" ng-if="!konfirmasi.inputnew">
													<button class="btn ease" ng-class="{'selected':custbankacc.id==konfirmasi.custacc.id}" ng-repeat="custbankacc in custaccs" ng-click="selectbanksender(custbankacc)">
														<div class="bankinfo">
															<div class="size-80p text-bold">
																<i class="far fa-sack-dollar tx-gray fa-fw"></i>
																<span ng-if="custbankacc.bank.alias.length==0">
																	[[custbankacc.bank.bankname]]
																</span>
																<span ng-if="custbankacc.bank.alias.length>0">
																	[[custbankacc.bank.alias]]
																</span>
															</div>
															<div>
																[[custbankacc.accname.toTitleCase()]] -
																[[custbankacc.accno]]
															</div>
														</div>
														<div class="bank-check" ng-class="{'show':custbankacc.id==konfirmasi.custacc.id}">
															<i class="fad fa-check-circle fa-fw pull-xs-right ease"></i>
														</div>
													</button>
												</div>
											</div>
											<div class="subheader">
												<div class="txt">
													3. Konfirmasi Pembayaran
												</div>
											</div>
											<div class="paydone">
												<div class="text-xs-center">
													<div class="text">
														Bila sudah transfer silahkan klik Tombol dibawah ini,<br>agar kami dapat melakukan pengecekan dan proses cetak.
													</div>
													<button class="btn btn-sm btn-outline-purple" ng-click="showconfirmmodal(item)">
														BENAR, SAYA SUDAH TRANSFER
													</button>
												</div>
											</div>
										</div>
										<div class="nopay-yet-toggle" ng-if="item.totalprice>item.totalpay">
											<button class="btn btn-sm btn-lightmagenta" ng-click="showpaymentconfirm(item)">
												<span ng-if="!item.showpaymentconfirm">
													LIHAT
												</span> 
												<span ng-if="item.showpaymentconfirm">
													TUTUP
												</span> 
												CARA BAYAR & KONFIRMASI
												<i class="fas fa-caret-down fa-fw pull-xs-right" ng-if="!item.showpaymentconfirm"></i>
												<i class="fas fa-caret-up fa-fw pull-xs-right" ng-if="item.showpaymentconfirm"></i>
											</button>
										</div>
										<div id="payment-detail-[[item.id]]" class="payment-detail" ng-show="item.showpaymentinfo">
											<table class="table table-sm">
												<tbody>
													<tr class="title">
														<td colspan="2">
															PEMBELIAN
														</td>
													</tr>
													<tr class="" ng-repeat="detail in item.salesdetail">
														<td>
															[[detail.cartheader.jobsubtype.name]] [[detail.cartheader.jobtitle]] [[detail.cartheader.jobtype]]
														</td>
														<td class="price">
															<span class="rp">
																Rp
															</span>
															[[(detail.cartheader.printprice-detail.cartheader.discount+detail.cartheader.deliveryprice)|number:0]]
														</td>
													</tr>

													<tr ng-if="item.salesdetail.length>1">
														<td>Total Harga</td>
														<td class="price">
															<span class="rp">
																Rp
															</span>
															[[item.totalprice|number:0]]
														</td>
													</tr>
													<tr class="title">
														<td colspan="2">
															PEMBAYARAN
														</td>
													</tr>
													<tr class="" ng-repeat="payment in item.salespayment">
														<td class="text-xs-left">
															Trf. [[payment.paydate]] &nbsp;
															<span class="tag tag-danger signika size-80p" ng-show="payment.salespaymentverif.veriftime==null" data-toggle="tooltip" data-placement="top" data-html="true" data-title="hubungi <b>0813-1551-9889</b>,<br>untuk mempercepat proses">
																&nbsp;
																<i class="fas fa-hourglass-half fa-spin"></i> &nbsp;&nbsp;
																MENUNGGU VERIFIKASI
															</span>
															<span class="tag tag-success signika size-80p" ng-show="payment.salespaymentverif.veriftime!=null">
																<i class="fas fa-check"></i>
																[[payment.salespaymentverif.veriftime]]
															</span>
															<br>
															<span ng-if="payment.customeracc.bank.alias.length==0">
																[[payment.customeracc.bank.bankname.toTitleCase()]]
															</span>
															<span ng-if="payment.customeracc.bank.alias.length>0">
																[[payment.customeracc.bank.alias]]
															</span>
															<span class="hidden-sm-down">
															 [[payment.customeracc.accno]]
														 </span> 
														 <span class="hidden-xs-down">
															<b>[[payment.customeracc.accname.toTitleCase()]]</b>
														 </span>
															<i class="fal fa-arrow-alt-right fa-fw"></i>
															<span ng-if="payment.companyacc.bank.alias.length==0">
																[[payment.companyacc.bank.bankname.toTitleCase()]]
															</span>
															<span ng-if="payment.companyacc.bank.alias.length>0">
																[[payment.companyacc.bank.alias]]
															</span>
														</td>
														<td class="price">
															<span class="rp">
																Rp
															</span>
															[[payment.ammount|number:0]]
														</td>
													<tr ng-if="item.salespayment.length>1">
														<td>Total Bayar</td>
														<td class="price">
															<span class="rp">
																Rp
															</span>
															[[item.totalpay|number:0]]
														</td>
													</tr>
													<tr>
														<td>
															<span ng-if="(item.totalprice-item.totalpay)>0">
																Sisa Bayar
															</span>
															<span ng-if="(item.totalprice-item.totalpay)<0">
																Kelebihan Bayar
															</span>
														</td>
														<td class="price">
															<span class="rp">
																Rp
															</span>
															<b ng-class="{'tx-purple':(item.totalprice-item.totalpay)>0, 'tx-danger':(item.totalprice-item.totalpay)<0}">
															[[(item.totalprice - item.totalpay)|number:0]]
														</td>
													</tr>
													</tr>
												</tbody>
											</table>
											<div class="payment-detail-info" ng-if="item.paymentdetail.length>0">
												[[item.paymentdetail]]
											</div>

										</div>
										<div class="payment-detail-toggle">
											<button class="btn btn-sm btn-lightmagenta" ng-click="showpaymentinfo(item)">
												<span ng-if="!item.showpaymentinfo">
													LIHAT
												</span> 
												<span ng-if="item.showpaymentinfo">
													SIMPAN
												</span> 
												STATUS BAYAR SAYA
												<i class="fas fa-caret-down fa-fw pull-xs-right" ng-if="!item.showpaymentinfo"></i>
												<i class="fas fa-caret-up fa-fw pull-xs-right" ng-if="item.showpaymentinfo"></i>
											</button>
										</div>

										<div class="payment-print-pdf">
											<a href="{{URL::asset('payment/offering/pdf')}}/[[item.id]]" target="_blank" class="btn btn-sm btn-outline-purple">
												CETAK PENAWARAN
											</a>
											<a href="{{URL::asset('payment/invoice/pdf')}}/[[item.id]]" target="_blank"
											class="btn btn-sm btn-outline-purple">
												CETAK INVOICE
											</a>
											<br>
											<div class="text">
												Pencetakan digital tidak memerlukan tanda tangan.<br>Jika dibutuhkan tanda tangan maupun cap,<br>silahkan hubungi Customer Service kami secara langsung.
											</div>
										</div>
									</div>
								</div>

							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="row margin-0 alert-outline-lightmagenta" hidden="">
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
		@include ('includes.modals.compaccno')
		@include ('pages.order.sales.modals.cartfile')
		@include ('pages.order.sales.modals.cartpreview')
		@include ('pages.order.sales.modals.cust-selectbank')
		@include ('pages.allaccess.sales.modals.printprogress')
		@include ('pages.order.sales.modals.confirm')
		<!-- END OF MODAL -->

		@else
		<div class="text-muted margin-40-0 text-xs-center">
			<span class="size-30">Tidak Ada Data Belanja</span><br>
			<span class="size-16">Silahkan buat pesanan Anda terlebih dahulu.<br></span>
			<span class="size-16">( <a href="{{URL::asset('flyer')}}"><span class="fas fa-edit size-14"></span> Flyer</a> | <a href="{{URL::asset('cart')}}"><span class="fas fa-shopping-basket size-14"></span> Cart</a> )</span>
		</div>
		@endif
</div>

@stop