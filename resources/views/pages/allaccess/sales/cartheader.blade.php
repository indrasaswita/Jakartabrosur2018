@extends('layouts.container')
@section('title', 'Proses & Pembayaran')
@section('robots', 'noindex,nofollow')
@section('content')
	<!-- <form> -->
<div ng-controller = "AllaccCartheaderController" class="allacc-sales-cartheader-wrapper">

@if(isset($salesdetail))      
<?php
	$temp = str_replace(array('\r', '\"', '\n', '\''), '?', $salesdetail);
?>
	<div ng-init="initData('{{$temp}}')"></div>

	<div ng-init="setselectedfilter('', false)"></div>
@endif
<!-- NANTI MESTI BUAT VALIDASI KALO ORANG LANGSUNG MASUK KE UPLOAD HARUS DI CEK DULU UDA ADA SESSION DARI PAGE ORDER BLOM.. -->

	@include('includes.nav.subnav')

	@if($salesdetail != null)
		@include('includes.nav.salenav')


	<div class="page-title margin-10-0"><!--  ng-bind-html="allsalespagetitle"> -->
		<i class="far fa-carrot fa-fw"></i>
		Detail Pesanan
	</div>
	<div class="allacc-sales-cartheader" ng-if="salesdetail!=null">

		<div class="cartheader-title">
			<div class="circular-progress" ng-click="showprogress()"></div>
			<div class="title-text">
				<div class="big">
					[[salesdetail.cartheader.jobtitle]]
				</div>
				<div class="small">
					[[salesdetail.cartheader.jobsubtype.name]] - [[salesdetail.cartheader.quantity]] [[salesdetail.cartheader.quantitytypename]]
				</div>
			</div>
			<div class="button-progress">
				<button class="btn btn-sm btn-outline-lightmagenta" ng-click="showprogress()">
					SHOW PROGRESS
				</button>
			</div>
		</div>
		<div class="cartheader-content">
			<div class="card-wrapper">
				<div class="detail-card">
					<div class="detail-card-title">
						JOB DETAIL
						<i class="fas fa-info-square fa-fw"></i>
					</div>
					<div class="detail-card-text">
						<div class="detail">
							<div class="qty">
								<i class="fal fa-boxes fa-fw"></i>
								[[salesdetail.cartheader.quantity|number:0]]
								[[salesdetail.cartheader.quantitytypename]].
							</div>
							<div class="package">
								<i class="fal fa-boxes fa-fw"></i>
								[[salesdetail.cartheader.totalpackage|number:0]]
								bungkus.
							</div>
							<div class="weight">
								<i class="fal fa-dumbbell fa-fw"></i>
								[[salesdetail.cartheader.totalweight|number:0]] kg.
							</div>

							<div class="desc" ng-if="salesdetail.cartheader.salesdetail.cartheaderdescription.length > 0">
								<i class="fal fa-comment-alt-lines fa-fw"></i>
								[[salesdetail.cartheader.salesdetail.cartheaderdescription]]
							</div>
							<div class="note" ng-if="salesdetail.cartheader.customernote.length > 0">
								<i class="fal fa-comment-alt-dots fa-fw"></i>
								[[salesdetail.cartheader.customernote]]
							</div>
							<div class="price">
								<i class="fal fa-tag fa-fw"></i>
								Rp [[(salesdetail.cartheader.printprice)|number:0]] [print]
							</div>
							<div class="price tx-danger" ng-if="salesdetail.cartheader.discount>0">
								<i class="fal fa-tag fa-fw"></i>
								Rp [[(salesdetail.cartheader.discount)|number:0]] (disc)
							</div>
							<div class="price" ng-if="salesdetail.cartheader.discount>0">
								<i class="fal fa-tag fa-fw"></i>
								Rp <b>[[(salesdetail.cartheader.printprice - salesdetail.cartheader.discount)|number:0]]</b> (end)
							</div>
						</div>
						<div class="proc">
							<i class="fas fa-bolt fa-fw"></i>
							Cetak :
							<span ng-if="salesdetail.cartheader.processtype=='std'">
								Standard
							</span>
							<span ng-if="salesdetail.cartheader.processtype=='exp'">
								Express
							</span>
						</div>
						<div class="detail" ng-repeat="item in salesdetail.cartheader.cartdetail">
							<div class="title" ng-if="salesdetail.cartheader.cartdetail.length>1">
								[[item.cartname]]
							</div>
							<div class="machine">
								<i class="fal fa-print fa-fw"></i>
								[[item.jobtypelong]]&nbsp;<span class="tx-lightgray">(</span><span class="tx-purple">[[item.printer.machinename]]</span><span class="tx-lightgray">)</span>.
							</div>
							<div class="size">
								<i class="fal fa-expand-arrows-alt fa-fw"></i>
								[[item.imagewidth]] x [[item.imagelength]] cm.
							</div>
							<div class="material">
								<i class="fal fa-copy fa-fw"></i>
								[[item.paper.name]] ([[item.paper.color]]) [[item.paper.gramature]]gsm.
							</div>
							<div class="sideprint">
								<i class="fal fa-retweet fa-fw"></i>
								Print
								<span ng-show="item.side2==0">single</span><span ng-show="item.side2>0">both</span> side.
							</div>
							<div class="finishing" ng-repeat="detailfinishing in item.cartdetailfinishing">
								<i class="fal fa-layer-plus fa-fw"></i>
								[[detailfinishing.finishing.name]] <b>[[detailfinishing.finishingoption.optionname]]</b>.
							</div>
						</div>
					</div>
				</div>
				<div class="detail-card">
					<div class="detail-card-title">
						DATA GAMBAR & FILE
						<i class="fab fa-adobe fa-fw"></i>
					</div>
					<div class="detail-card-text">
						<div class="detail">
							<div ng-repeat="cfile in salesdetail.cartheader.cartfile">
								<div class="">
									<i class="fal fa-copy fa-fw"></i>
									[[cfile.file.filename]]
									<span ng-if="cfile.file.revision>1">
										revisi ke-[[(cfile.file.revision-1)|number:0]]
									</span>
								</div>
								<div class="">
									<i class="fal fa-chevron-right fa-fw"></i>
									<i class="fal fa-compact-disc tx-purple"></i>
									<b>[[(cfile.file.size/1024/1024)|number:2]]MB</b> 
								</div>
								<div class="">
									<i class="fal fa-chevron-right fa-fw"></i>
									<i class="fal fa-history tx-purple"></i>

									<span ng-if="cfile.file.updated_at==null">
										[[cfile.file.created_at]]
									</span>
									<span ng-if="cfile.file.updated_at!=null">
										[[cfile.file.updated_at]]
									</span>
								</div>
								<div class="" ng-if="cfile.file.detail.length>0">
									<i class="fal fa-chevron-right fa-fw"></i>
									[[cfile.file.detail]]
								</div>
							</div>
						</div>
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
								<i class="fal fa-truck fa-fw"></i>
								[[salesdetail.cartheader.delivery.deliveryname]]
							</div>
							<div class="">
								<i class="fal fa-house-flood fa-fw"></i>
								[[salesdetail.cartheader.deliveryaddress.address]]
							</div>
							<div class="package">
								<i class="fal fa-boxes fa-fw"></i>
								[[salesdetail.cartheader.totalpackage|number:0]]
								bungkus.
							</div>
							<div class="weight">
								<i class="fal fa-dumbbell fa-fw"></i>
								[[salesdetail.cartheader.totalweight|number:0]] kg.
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
				<div class="detail-card">
					<div class="detail-card-title">
						JOB DETAIL
						<i class="fas fa-info-square fa-fw"></i>
					</div>
					<div class="detail-card-text">
						<div class="detail">
							<div class="qty">
								<i class="fal fa-boxes fa-fw"></i>
								[[salesdetail.cartheader.quantity|number:0]]
								[[salesdetail.cartheader.quantitytypename]].
							</div>
							<div class="package">
								<i class="fal fa-boxes fa-fw"></i>
								[[salesdetail.cartheader.totalpackage|number:0]]
								bungkus.
							</div>
							<div class="weight">
								<i class="fal fa-dumbbell fa-fw"></i>
								[[salesdetail.cartheader.totalweight|number:0]] kg.
							</div>

							<div class="desc" ng-if="salesdetail.cartheader.salesdetail.cartheaderdescription.length > 0">
								<i class="fal fa-comment-alt-lines fa-fw"></i>
								[[salesdetail.cartheader.salesdetail.cartheaderdescription]]
							</div>
							<div class="note" ng-if="salesdetail.cartheader.customernote.length > 0">
								<i class="fal fa-comment-alt-dots fa-fw"></i>
								[[salesdetail.cartheader.customernote]]
							</div>
							<div class="price">
								<i class="fal fa-tag fa-fw"></i>
								Rp [[(salesdetail.cartheader.printprice)|number:0]]
							</div>
							<div class="price tx-danger" ng-if="salesdetail.cartheader.discount>0">
								<i class="fal fa-tag fa-fw"></i>
								Rp [[(salesdetail.cartheader.discount)|number:0]] (disc)
							</div>
							<div class="price" ng-if="salesdetail.cartheader.discount>0">
								<i class="fal fa-tag fa-fw"></i>
								Rp <b>[[(salesdetail.cartheader.printprice - salesdetail.cartheader.discount)|number:0]]</b> (end)
							</div>
						</div>
						<div class="proc">
							<i class="fas fa-bolt fa-fw"></i>
							Cetak :
							<span ng-if="salesdetail.cartheader.processtype=='std'">
								Standard
							</span>
							<span ng-if="salesdetail.cartheader.processtype=='exp'">
								Express
							</span>
						</div>
						<div class="detail" ng-repeat="item in salesdetail.cartheader.cartdetail">
							<div class="title" ng-if="salesdetail.cartheader.cartdetail.length>1">
								[[item.cartname]]
							</div>
							<div class="machine">
								<i class="fal fa-print fa-fw"></i>
								[[item.jobtypelong]]&nbsp;<span class="tx-lightgray">(</span><span class="tx-purple">[[item.printer.machinename]]</span><span class="tx-lightgray">)</span>.
							</div>
							<div class="size">
								<i class="fal fa-expand-arrows-alt fa-fw"></i>
								[[item.imagewidth]] x [[item.imagelength]] cm.
							</div>
							<div class="material">
								<i class="fal fa-copy fa-fw"></i>
								[[item.paper.name]] ([[item.paper.color]]) [[item.paper.gramature]]gsm.
							</div>
							<div class="sideprint">
								<i class="fal fa-retweet fa-fw"></i>
								Print
								<span ng-show="item.side2==0">single</span><span ng-show="item.side2>0">both</span> side.
							</div>
							<div class="finishing" ng-repeat="detailfinishing in item.cartdetailfinishing">
								<i class="fal fa-layer-plus fa-fw"></i>
								[[detailfinishing.finishing.name]] <b>[[detailfinishing.finishingoption.optionname]]</b>.
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- MODAL -->
	@include ('pages.allaccess.sales.modals.printprogress')
	<!-- END OF MODAL -->

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