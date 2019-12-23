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
		<?php
			$temp2 = str_replace(array('\r', '\"', '\n', '\''), '?', $deliveries);
		?>
		<?php
			$temp3 = str_replace(array('\r', '\"', '\n', '\''), '?', $custaddresses);
		?>

		@if(count($carts) != 0)
	<div ng-init="initData('{{$temp}}', '{{$temp2}}', '{{$temp3}}')"></div>
		@endif
	@endif
@endif

@if(app('request')->input('c') != null)
	<div ng-init="initSelectedID('{{app('request')->input('c')}}')"></div>
@endif

@if(app('request')->input('d') != null)
	<div ng-init="initSelectedDetail('{{app('request')->input('d')}}')"></div>
@endif
	
@include('includes.nav.subnav')

@if(isset($carts))
	@if($carts != null)
		@if(count($carts) != 0)

	<div class="tips">
		<i class="fas fa-arrow-alt-down fa-3x tx-yellow ease"></i>
		<div class="info">
			Anda harus memilih dahulu pesanan Anda.
			<button class="close" ng-click="hidetips()">
				<i class="fas fa-times fa-fw"></i>
			</button>
		</div>
	</div>

	<div class="order-cart-wrapper">
		<div class="cart-title">
			Review Order
		</div>
		<div class="selectall-wrapper" ng-class="{'selected':allchecked}">
			<div class="selectall">
				<div class="check">
					<label class="custom-checkbox">
						<input type="checkbox" ng-model="allchecked" ng-click="checkAll()">
						<span class="checkmark"></span>
					</label>
				</div>
				<div class="text">
					Select All
				</div>
			</div>
		</div>
		<form action="/" method="post" id="is-uploader" enctype="multipart/form-data" hidden>
			@method('patch')
			@csrf

			<input name="file" id="btn-choose-file" type="file"  ng-disabled="uploadwaiting" ng-if="!uploadwaiting">
		</form>
		<div class="cart-list-wrapper" ng-repeat="item in carts" ng-class="{'selected':item.checked}">
			<div class="title-wrapper ease">
				<div class="check">
					<label class="custom-checkbox">
						<input type="checkbox" ng-model="item.checked" ng-change="checkChanged(item)">
						<span class="checkmark"></span>
					</label>
				</div>
				<a href="" ng-click="showingdetail(item, $index)">
					<div class="header">
						<div class="image">
							<img src="{{URL::asset('image/jobsubtypeicons')}}/[[item.jobsubtype.icon]]" alt="" width="100%">
						</div>
						<div class="title">
							[[item.jobsubtype.name]] 
							<br>
							<span class="jobname">
								[[item.jobtitle]]
							</span>
						</div>
					</div>
					<div class="arrow">
						<span class="ease" ng-class="{'rotate':item.showdetail}">
							<i class="fas fa-chevron-down"></i>
						</span>
					</div>
				</a>
			</div>
			<div class="subdetail-wrapper" ng-show="item.showdetail">
				<div class="job-detail" ng-class="{'hide':!item.showinfo}">
					<a class="link hidden-md-up" href="" ng-show="!item.showinfo" ng-click="showinfo(item)">
						<i class="far fa-info fa-fw fa-2x"></i>
					</a>
					<div class="detail" ng-show="item.showinfo">
						<div class="qty">
							<i class="fal fa-boxes fa-fw"></i>
							[[item.quantity|number:0]]
							[[item.quantitytypename]].
						</div>
						<div class="package">
							<i class="fal fa-boxes fa-fw"></i>
							[[item.totalpackage|number:0]]
							bungkus.
						</div>
						<div class="weight">
							<i class="fal fa-dumbbell fa-fw"></i>
							[[item.totalweight|number:0]] kg.
						</div>

						<div class="desc" ng-if="item.itemdescription.length > 0">
							<i class="fal fa-comment-alt-lines fa-fw"></i>
							[[item.itemdescription]]
						</div>
						<div class="note" ng-if="item.customernote.length > 0">
							<i class="fal fa-comment-alt-dots fa-fw"></i>
							[[item.customernote]]
						</div>
						<div class="price">
							<i class="fal fa-tag fa-fw"></i>
							Rp [[(item.printprice)|number:0]]
						</div>
						<div class="price tx-danger" ng-if="item.discount>0">
							<i class="fal fa-tag fa-fw"></i>
							Rp [[(item.discount)|number:0]] (disc)
						</div>
						<div class="price" ng-if="item.discount>0">
							<i class="fal fa-tag fa-fw"></i>
							Rp <b>[[(item.printprice - item.discount)|number:0]]</b> (end)
						</div>
					</div>
					<div class="proc" ng-show="item.showinfo">
						<i class="fas fa-bolt fa-fw"></i>
						Cetak :
						<span ng-if="item.processtype=='std'">
							Standard
						</span>
						<span ng-if="item.processtype=='exp'">
							Express
						</span>
					</div>
					<div class="detail" ng-repeat="item2 in item.cartdetail" ng-show="item.showinfo">
						<div class="title" ng-if="item.cartdetail.length>1">
							[[item2.cartname]]
						</div>
						<div class="machine">
							<i class="fal fa-print fa-fw"></i>
							[[item2.jobtypelong]]&nbsp;<span class="tx-lightgray">(</span><span class="tx-purple">[[item2.printer.machinename]]</span><span class="tx-lightgray">)</span>.
						</div>
						<div class="size">
							<i class="fal fa-expand-arrows-alt fa-fw"></i>
							[[item2.imagewidth]] x [[item2.imagelength]] cm.
						</div>
						<div class="material">
							<i class="fal fa-copy fa-fw"></i>
							[[item2.paper.name]] ([[item2.paper.color]]) [[item2.paper.gramature]]gsm.
						</div>
						<div class="sideprint">
							<i class="fal fa-retweet fa-fw"></i>
							Print
							<span ng-show="item2.side2==0">single</span><span ng-show="item2.side2>0">both</span> side.
						</div>
						<div class="finishing" ng-repeat="detailfinishing in item2.cartdetailfinishing">
							<i class="fal fa-layer-plus fa-fw"></i>
							[[detailfinishing.finishing.name]] <b>[[detailfinishing.finishingoption.optionname]]</b>.
						</div>
					</div>
				</div>
				<div class="job-file" ng-class="{'hide':!item.showfile}">
					<a class="link" href="" ng-show="!item.showfile" ng-click="showfile(item)">
						<i class="far fa-folder-tree fa-fw fa-2x"></i>
					</a>
					<div class="file-wrapper" ng-show="item.showfile">
						<div class="empty" ng-if="item.cartfile.length==0">
							<a href="" ng-click="addnewfile()">
								<div class="a-wrapper">
									<i class="far fa-folder-tree fa-3x fa-fw"></i>
									<br>
									<div class="tx-header">
										No File
									</div>
									<br>
									<div class="tx-detail">
										<small class="fas fa-upload fa-fw"></small>
										Click to Upload
									</div>
								</div>
							</a>
						</div>
						<div ng-if="item.cartfile.length>0">
							<div class="title">
								<i class="far fa-folder-tree fa-fw"></i>
								File(s)
							</div>
							<div class="file" ng-repeat="cfile in item.cartfile" ng-click="showeditfile(item, cfile.file)">
								<div class="img">
									<img ng-src="{{URL::asset('image/ext')}}/[[cfile.file.path.substring(cfile.file.path.lastIndexOf('.')+1)]].png" width="33px">
								</div>
								<div class="text">
									[[cfile.file.filename]]&nbsp;
									<div class="tag tag-primary tag-sm" ng-if="cfile.file.revision>1">
										REVISED
									</div><br>
									[[cfile.file.created_at|date:'dd MMMM yyyy [HH:mm]']]
								</div>
								<div class="size">
									<span>
										[[size_minimize(cfile.file.size)]]
									</span>
								</div>
							</div>
							<div class="file add" ng-click="addnewfile()">
								<div class="text">
									<i class="fal fa-files-medical fa-fw"></i>
									Add New File
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="job-delivery" ng-class="{'hide':!item.showdelivery}">
					<a class="link" href="" ng-show="!item.showdelivery" ng-click="showdelivery(item)">
						<i class="far fa-truck-loading fa-fw fa-2x"></i>
					</a>
					<div class="delivery-wrapper" ng-show="item.showdelivery">
						<div class="title">
							<i class="far fa-truck-loading fa-fw"></i>
							Delivery
						</div>
						<div class="detail">
							<div class="qty">
								<i class="fal fa-boxes fa-fw"></i>
								[[item.totalpackage|number:0]]
								bungkus.
							</div>
							<div class="weight">
								<i class="fal fa-dumbbell fa-fw"></i>
								[[item.totalweight|number:0]] kg.
							</div>
						</div>
						<div class="select-delivery">
							<select ng-model="item.delivery" ng-options="item as item.deliveryname for item in deliveries"></select>
							<select ng-model="item.deliveryaddress" ng-options="item.address as item.address.address for item in custaddresses"
							 ng-if="item.delivery.id!=1"></select>
							<div class="rahayu-loc" ng-if="item.delivery.id==1">
								Lokasi Pengambilan:
								<br>
								Jl. Pangeran Jayakarta 113, Jakarta Pusat 10730. Tepat Sebelah SPBU (ada tulisan Percetakan Rahayu)
							</div>
						</div>
						<div class="delivery-price">
							approx. 
							<span class="number">
								[[item.deliveryprice|number:0]]
							</span>
							<button class="btn btn-sm" ng-click="infodeliveryshow()">
								<i class="fas fa-info"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="subtotal-wrapper ease">
				<div class="action">
					<button class="btn btn-sm btn-outline-purple" ng-click="showedittitle(item)">
						ubah judul
					</btn>
					<button class="btn btn-sm btn-outline-purple" ng-click="edititem(item)">
						edit item
					</btn>
					<button class="btn btn-sm btn-outline-purple hidden-xs-down" ng-click="cartduplicate(item.id)">
						duplicate product
					</btn>
					<button class="btn btn-sm btn-outline-purple" ng-click="warningdelete(item)">
						delete item
					</btn>
				</div>
				<div class="price"s>
					<div class="text">
						Price net
					</div>
					<div class="number">
						[[(item.printprice-item.discount+item.deliveryprice)|number:0]]
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="cart-list" hidden>
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
											[[item2.jobtypelong]]&nbsp;<span class="tx-lightgray">(</span><span class="tx-purple">[[item2.printer.machinename]]</span><span class="tx-lightgray">)</span>
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
	<div class="cart-checkout-label" ng-click="review()">
		<div class="cart-checkout-icon">
			<div class="icon-count">
				[[totalSelected|number:0]]
			</div>
			<div class="icon-background">
				<i class="fa fa-shopping-cart"></i>
			</div>
		</div>
		<div class="cart-checkout-tx">
			<small class="tx-lightgray">Rp </small>
			<strong>[[selectedPrice|number:0]]</strong>
		</div>
		<div class="cart-checkout-btn">
			<div class="btn btn-outline-none">
				<span class="hidden-xs-down">Re-view</span>
				<i class="fa fa-chevron-right"></i>
			</div>
		</div>
	</div>

	<!-- MODAL -->
	@include ('pages.order.cart.modals.cartreview')
	@include ('pages.order.cart.modals.warningcart-delete')
	@include ('pages.order.cart.modals.editcarttitle')
	@include ('pages.order.cart.modals.changefile')
	@include ('pages.order.cart.modals.addfile')
	@include ('pages.order.cart.modals.infodelivery')
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