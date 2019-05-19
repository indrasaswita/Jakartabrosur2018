@extends('layouts.container')
@section('title', 'Keranjang Belanja')
@section('description', 'Data belanja yang belum dipilih kedalam pembelian.')
@section('robots', 'noindex,nofollow')
@section('content')


<div ng-controller="OrderCartController">

@if(isset($carts))
	@if($carts != null)

		<?php
			$temp = str_replace(array('\r', '\"', '\n', '\''), '?', $carts);
		?>

		@if(count($carts) != 0)
	<div ng-init="initData('{{$temp}}')"></div>
		@endif
	@endif
@endif

@if(isset($id))
	@if($id != null)
	<div ng-init="initSelectedID({{$id}})"></div>
	@endif
@endif
	
@include('includes.nav.subnav')

@if(isset($carts))
	@if($carts != null)
		@if(count($carts) != 0)
	<div class="page-title">
		<i class="fas fa-shopping-basket fa-fw"></i>
		Keranjang Belanja
	</div>
	<div class="cart-list">
		<div class="tx-header">
			<a class="btn btn-sm btn-outline-primary pull-xs-right" href="{{URL::asset('orderlistcustomer')}}" data-toggle="tooltip" data-placement="left" data-title="Tambah Transaksi Baru">
				<span class="fas fa-plus-square"></span> Belanja Lagi
			</a>
			<div class="size-70p padding-5">
				<i class="fas fa-question-circle tx-info"></i> 
				<span class="tx-gray">
					Anda dapat memilih > 1 item untuk 1 transaksi yang sama.
				</span>
			</div>
		</div>
		<div class="panel-item-block">
			<div class="alert alert-warning alert-sm text-xs-center text-bold signika" ng-show="error!=''" id="errorfocus" data-toggle="tooltip" data-html="true" data-title="Silahkan hubungi kami untuk mempercepat proses!<br>(<b>Call Center: 0813-1551-9889</b>)" data-placement="bottom">
				<i class="far fa-bell"></i>
				[[error]]
				<i class="far fa-bell"></i>
			</div>
			<table class='table table-cartheader'>
				<thead>
					<tr>
						<th class="text-xs-center"><i class="far fa-check-square size-120p"></i></th>
						<th class="text-xs-left">Judul Job</th>
						<th class="width-min text-xs-center">File</th>
					</tr>
				</thead>
				<tbody ng-repeat="item in carts" ng-class="{'orange-soft-bg':item.checked}">
					<tr>

						<td class="nomor" ng-class="{'tx-danger':item.filestatus==0||item.filestatus==null, 'tx-success':item.filestatus!=0&&item.filestatus!=null}">
							<span ng-show="item.filestatus==0||item.filestatus==null" data-toggle="tooltip" data-title="<b>File belum di cek.. </b><br>Hubungi kami<br>untuk mempercepat." data-html="true" data-placement="right">
								<i class="fas fa-clipboard-list fa-2x"></i>
							</span>
							<span ng-show="item.filestatus!=0&&item.filestatus!=null" data-toggle="tooltip" data-html="true" data-title="<b>OK!</b><br><span class='tx-success'>File Sudah di Cek.</span>" data-placement="right">
								<i class="fas fa-clipboard-check fa-2x"></i>
							</span>
						</td>
						<td class="text-xs-left text-v-center">
							&nbsp;[[item.jobsubtype.name]] <strong>[[item.jobtitle]]</strong> 
							<br>
							&nbsp;
							<small class="fas fa-file-image tx-lightgray"></small>
							<span>
								[[item.cartfile.length]] files:
							</span>
							<span ng-repeat="item2 in item.cartfile" ng-if="item.cartfile.length>0">
								<span ng-if="$index>0">,&nbsp;</span>
								<span class="tx-gray">[[singkatText(item2.file.filename, 12, '')]]</span>
							</span>

						</td>
						<td class="text-v-center">
							<button href="" class="btn btn-xsm btn-outline-purple text-bold" ng-click="showfiles(item, item.id)">
								<i class="fas fa-search"></i> 
								<br>FILE
							</button>
						</td>
					</tr>
					<tr>
						<td class="nomor" rowspan="2">
							<input type="checkbox" name="selectjob" ng-model="item.checked" ng-change="checkChanged(item)" />
							<br>
							<span class="far fa-hand-point-up fa-2x" ng-class="{'tx-orange':second%2==0,'tx-purple':second%2==1}" ng-show="item.checked==false"></span>
						</td>
						<td colspan="6">
							<div class="detail-description">
								<div class="description-item">
									<div class="label">
										Qty
									</div>
									<div class="text">
										[[item.quantity]] [[item.quantitytypename]]
									</div>
								</div>
								<div class="description-item">
									<div class="label">
										Proc.
									</div>
									<div class="text">
										[[item.processtype]]
									</div>
								</div>
								<div class="description-item">
									<div class="label">
										Deliv.
									</div>
									<div class="text">
										[[item.delivery.deliveryname]] 
										<span class="tx-lightgray">&nbsp;[<span class="tx-lightmagenta">[[item.delivery.deliverytype]]</span>]</span> &nbsp;
									</div>
								</div>
								<div class="description-item">
									<div class="label">
										Tujuan
									</div>
									<div class="text">
										[[item.deliveryaddress]]
									</div>
								</div>
								<div class="description-item">
									<div class="label">
										Pengirim.&nbsp;<span class="tx-lightgray"  data-toggle="tooltip" data-title="<b>Dropship</b><br>dikirim oleh Jakartabrosur dengan label pengirim custom sesuai nama & kontak pemesan" data-placement="bottom" data-html="true" ng-show="item.resellername.length>0" tooltip>
											<i class="fa fa-question-circle"></i>
										</span>
									</div>
									<div class="text" ng-show="item.resellername.length>0">
										[[item.resellername]] 
										<span class="tx-lightgray">&nbsp;[<span class="tx-lightmagenta">[[item.resellerphone]]</span>]</span> &nbsp;
									</div>
									<div class="text" ng-show="item.resellername.length==0">
										Jakartabrosur.com
									</div>
								</div>
								<div class="description-item" ng-show="item.reselleraddress.length>0">
									<div class="label">
										Alm. Pengirim
									</div>
									<div class="text">
										[[item.reselleraddress]]
									</div>
								</div>
								<div class="description-item">
									<div class="label">
										Pack(s)
									</div>
									<div class="text">
										[[item.totalpackage]] bks.
									</div>
								</div>
								<div class="description-item">
									<div class="label">
										Berat
									</div>
									<div class="text">
										[[item.totalweight]] kg
									</div>
								</div>
								<div class="description-item">
									<div class="label">
										Ket.
									</div>
									<div class="text">
										[[item.itemdescription]]
									</div>
								</div>
								<div class="description-item">
									<div class="label">
										Cat.
									</div>
									<div class="text">
										[[item.customernote]]
									</div>
								</div>
								<!-- BARANG DETAIL -->
								<!-- kalo 1, munculny tanpa cartname -->
								<div class="multi-detail" ng-repeat="item2 in item.cartdetail">
									<div class="description-title" ng-show="item.cartdetail.length>1">[[$index+1]]. [[item2.cartname]] <i class="fa fa-arrow-down tx-lightgray"></i>
									</div>
									<div class="description-item">
										<div class="label">
											Tipe
										</div>
										<div class="text">
											[[item2.jobtype]]&nbsp;<span class="tx-lightgray">(</span><span class="tx-purple">[[item2.printer.machinename]]</span><span class="tx-lightgray">)</span>
										</div>
									</div>
									<div class="description-item">
										<div class="label">
											Uk.
										</div>
										<div class="text">
											[[item2.imagewidth]] x [[item2.imagelength]] cm
										</div>
									</div>
									<div class="description-item">
										<div class="label">
											Mat.
										</div>
										<div class="text">
											[[item2.paper.name]] ([[item2.paper.color]]) [[item2.paper.gramature]]gsm
										</div>
									</div>
									<div class="description-item">
										<div class="label">
											Sisi Cetak.
										</div>
										<div class="text">
											[[item2.side1]]<span class="tx-lightgray">/</span>[[item2.side2]] <span class="tx-lightgray">&nbsp;[<span class="tx-lightmagenta"><span ng-show="item2.side2==0">1</span><span ng-show="item2.side2>0">2</span> sisi</span><span class="tx-lightgray">]</span></span>
										</div>
									</div>
									<div class="description-item" ng-repeat="detailfinishing in item2.cartdetailfinishing">
										<div class="label">
											[[detailfinishing.finishing.name]]

											<span data-title="[[detailfinishing.finishing.info]]" data-toggle="tooltip" data-placement="top" data-html="true" tooltip>
												<i class="far fa-question-circle"></i>
											</span>
										</div>
										<div class="text">
											[[detailfinishing.finishingoption.optionname]]
										</div>
									</div>
								</div>
								<div class="description-item">
									<div class="label">
										Deliv Rp.
									</div>
									<div class="text">
										[[item.deliveryprice|number:0]]
									</div>
								</div>
								<div class="description-item">
									<div class="label">
										Print Rp.
									</div>
									<div class="text">
										[[(item.printprice-item.discount)|number:0]]
									</div>
								</div>
								<div class="description-item">
									<div class="label">
										Total Rp.
									</div>
									<div class="text text-bold">
										[[(item.printprice-item.discount+item.deliveryprice)|number:0]]
									</div>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td class="" colspan="6" ng-show="item.filestatus==0||item.filestatus==null">
							<i class="fas fa-ban tx-red"></i> File belum di cek! <!-- Butuh pengecekan dari Jakartabrosur untuk lanjut. Hub. 0813-1551-9889 --> <i class="fas fa-ban tx-red"></i>
						</td>
						<td class="" colspan="6" ng-hide="item.filestatus==0||item.filestatus==null">
							<i class="fas fa-user-lock tx-success"></i> Selamat! File sudah dicek oleh pihak Jakarta Brosur.<!-- Pesanan sudah bisa dipilih, silahkan pilih pada kotak disebelah kiri. --> <i class="fa fa-user-lock tx-success"></i>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="cart-checkout-label">
		<div class="cart-checkout-icon">
			<div class="icon-count">
				[[selected.length|number:0]]
			</div>
			<div class="icon-background">
				<i class="fa fa-shopping-cart"></i>
			</div>
		</div>
		<div class="cart-checkout-tx">
			Rp [[selectedPrice|number:0]]
		</div>
		<div class="cart-checkout-btn">
			<button class="btn btn-outline-none" data-toggle="modal" data-target="#reviewCartModal">
				<span class="hidden-xs-down">Re-view</span>
				<i class="fa fa-chevron-right"></i>
			</button>
		</div>
	</div>

	<!-- MODAL -->
	@include ('pages.order.cart.modals.cartreview')
	@include ('pages.order.cart.modals.changefile')
	@include ('pages.order.cart.modals.changespec')
	@include ('pages.order.cart.modals.changetitle')
	
</div>

		@else
	<div class="text-muted margin-40-0 text-xs-center">
		<span class="size-30">Keranjang Belanja Kosong</span><br>
		<span class="size-16">Silahkan buat pesanan Anda terlebih dahulu.<br></span>
		<span class="size-16">( <a href="{{URL::asset('orderlistcustomer')}}"><span class="fas fa-edit size-14"></span> Order</a> )</span>
	</div>
		@endif
	@else
	<div class="text-muted margin-40-0 text-xs-center">
		<span class="size-30">Keranjang Belanja Kosong</span><br>
		<span class="size-16">Silahkan buat pesanan Anda terlebih dahulu.<br></span>
		<span class="size-16">( <a href="{{URL::asset('orderlistcustomer')}}"><span class="fas fa-edit size-14"></span> Order</a> )</span>
	</div>
	@endif
@endif
</div>


@stop