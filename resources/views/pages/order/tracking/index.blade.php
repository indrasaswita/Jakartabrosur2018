@extends('layouts.container')
@section('content')

<div ng-controller="TrackingController" class="margin-top-80">
@if(isset($carts))
	@if($carts != null)
		@if(count($carts) != 0)
	<div ng-init="initData('{{json_encode($carts)}}')"></div>
		@endif
	@endif
@endif
    @include('includes.modals.viewfilemodal')
	@include('includes.nav.subnav')

@if(isset($carts))
	@if($carts != null)
		@if(count($carts) != 0)
	<table class='table table-sm table-bordered size-14'>
		<thead class="text-center thead-inverse">
			<th>Judul Kerjaan</th>
			<th>Detail</th>
			<th>Tipe Kertas</th>
			<th>Process</th>
			<th>Action</th>
		</thead>
		<tbody>
			<tr ng-repeat="item in carts">
				<td>
					<table class="table table-clear">
						<tbody>
							<tr>
								<td>
									[[item.jobtitle]]
									<div class="tag text-regular tag-purple">[[item.jobtype]]</div>
								</td>
							</tr>
							<tr>
								<td><span class="pull-xs-right">Rp <b>[[item.printprice+item.deliveryprice-item.discount|number:0]]</b></span></td>
							</tr>
						</tbody>
					</table>
				</td>
				<td>
					<table class="table table-clear text-xs-center">
						<tbody>
							<tr>
								<td><div class="tag text-regular tag-danger">Qty</div> [[item.quantity|number:0]] [[item.quantitytypename]]</td>
							</tr>
							<tr>
								<td><div class="tag tag-primary text-regular">Size</div> [[item.imagesize]]</td>
							</tr>
							<tr>
								<td>Cetak [[item.sideprint]] sisi</td>
							</tr>
						</tbody>
					</table>
				</td>
				<td class="text-center">
					<table class="table table-clear">
						<tbody>
							<tr>
								<td>[[item.name]]</td>
							</tr>
							<tr>
								<td>[[item.color]] ([[item.gramature]] gsm)</td>
							</tr>
						</tbody>
					</table>
				</td>
				<td class="text-center">
					<table class="table table-clear">
						<tbody>
							<tr>
								<td class="width-min"><img ng-src="[[getPcImage('file', item.statusfile)]]" width="40px" data-toggle="tooltip" data-title="Cek File" data-placement="top"></td>
								<td class="width-min"><img ng-src="[[getPcImage('ctp', item.statusctp)]]" width="40px" data-toggle="tooltip" data-title="Buat Plate" data-placement="top"></td>
								<td class="width-min"><img ng-src="[[getPcImage('print', item.statusprint)]]" width="40px" data-toggle="tooltip" data-title="Proses Cetak" data-placement="top"></td>
								<td class="width-min"><img ng-src="[[getPcImage('packing', item.statuspacking)]]" width="40px" data-toggle="tooltip" data-title="Packing" data-placement="top"></td>
								<td class="width-min"><img ng-src="[[getPcImage('delivery', item.statusdelivery)]]" width="40px" data-toggle="tooltip" data-title="Pengiriman" data-placement="top"></td>
								<td class="width-min"><img ng-src="[[getPcImage('done', item.statusdone)]]" width="40px" data-toggle="tooltip" data-title="Pekerjaan Selesai" data-placement="top"></td>
							</tr>
							<tr>
								<td colspan="7">[[item.process]]</td>
							</tr>
						</tbody>
					</table>
				</td>
				<td class="width-min">
					<div class="btn-group-vertical display-block">
						<!-- <button class="btn btn-secondary" data-toggle="modal" data-target="#viewfile-modal" ng-click="getFilesData(item.cartdetailID)">View File</button> -->
						<button class="btn btn-sm btn-secondary" ng-click="getFilesData(item.cartdetailID)">View File</button>
						<button class="btn btn-sm btn-secondary">View Detail</button>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-sm" ng-show="cartfileShow">
		<thead class="text-center thead-inverse">
			<th>Gambar</th>
			<th>Detail</th>
			<th>Deskripsi</th>
			<th>Action</th>
		</thead>
		<tbody>
			<tr ng-repeat="item in cartfiles">
				<td><img ng-src="[[item.icon]]" class="img-circle" width="130px" height="130px"></td>
				<td>
					<table class="table table-clear">
						<tbody>
							<tr>
								<th>Nama File</th>
								<td>[[item.filename]]</td>
							</tr>
							<tr>
								<th>Revisi ke-</th>
								<td>[[item.revision]]</td>
							</tr>
							<tr>
								<th>Ukuran</th>
								<td>
									<table class="table table-clear">
										<tbody>
											<tr>
												<td>[[(item.size/1024)|number:0]] KB</td>
											</tr>
											<tr>
												<td>[[(item.size/1024/1024)|number:0]] MB</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
				<td>[[item.detail]]</td>
				<td>
					<div class="btn-group-vertical display-block">
						<button class="btn btn-secondary">Revisi</button>
						<button class="btn btn-secondary">View</button>
						<button class="btn btn-danger">Delete</button>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
        @else
    <div class="text-muted margin-20-0 text-xs-center">
        <span class="size-30">Tidak Ada Data Yang Sedang Dikerjakan</span><br>
        <span class="size-16">( <a href="{{URL::asset('flyer')}}"><span class="glyphicon glyphicon-edit size-14"></span> Flyer</a> | <a href="{{URL::asset('cart')}}"><span class="glyphicon glyphicon-shopping-cart size-14"></span> Cart</a> | <a href="{{URL::asset('sales/all')}}"><span class="glyphicon glyphicon-stats size-14"></span> Pembelian</a> )</span>
    </div>
        @endif
    @else
    <div class="text-muted margin-20-0 text-xs-center">
        <span class="size-30">Tidak Ada Data Yang Sedang Dikerjakan</span><br>
        <span class="size-16">( <a href="{{URL::asset('flyer')}}"><span class="glyphicon glyphicon-edit size-14"></span> Flyer</a> | <a href="{{URL::asset('cart')}}"><span class="glyphicon glyphicon-shopping-cart size-14"></span> Cart</a> | <a href="{{URL::asset('sales/all')}}"><span class="glyphicon glyphicon-stats size-14"></span> Pembelian</a> )</span>
    </div>
    @endif
@endif
	<div class="row margin-20 text-xs-left">
		<div class="col-xs-2"></div>
		<div class="col-xs-8">
    		<div class="alert alert-outline-lightmagenta lightmagenta padding-20">
		        <span class="size-16">
		        	<h5>Data Tracking terdiri dari:</h5>
		        	<ol class="padding-left-20 margin-bottom-0">
			        	<li>
			        		<span class="">Anda sudah melakukan konfirmasi pembayaran.</span><br>
			        		<span class="size-14">(Hubungi kami di <span class="lightpurple size-16">0813-1551-9889</span>, untuk mempercepat pengecekan)</span>
			        	</li>
			        	<li>Bila sudah dilakukan pengecekan pembayaran dari pihak kami.<br></li>
			        	<li>Dan pekerjaan sedang dikerjakan.</li>
		        	</ol>
		    	</span>
		    </div>
    	</div>
	</div>
</div>
@stop