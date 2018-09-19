@extends('layouts.container')
@section('content')
		<!-- <form> -->
<div ng-controller = "PaymentConfirmController" class="margin-top-80">
	@if(isset($salesheader))      
		@if ($salesheader != null)

		<?php
			$temp = str_replace(array('\r', '\"', '\n', '\''), '?', $salesheader);
		?>

		<div ng-init="initData('{{$temp}}')"></div>
	
		@endif
	@endif
<!-- NANTI MESTI BUAT VALIDASI KALO ORANG LANGSUNG MASUK KE UPLOAD HARUS DI CEK DULU UDA ADA SESSION DARI PAGE ORDER BLOM.. -->
	@include('includes.nav.subnav')
	@include('includes.nav.salenav')

	<div class="err-confpayment" ng-show="salesheader == null">
		<div class="item-block">
				<span class="title">Transaksi ERROR.</span><br>
				<span class="content">Hubungi kami untuk lebih lanjut,<br> atau kembali ke <a href="{{URL::asset('sales/all')}}" class=""><i class="fa fa-shopping-bag"></i> Daftar Pembelian</a>.<br></span>
		</div>
	</div>

	<div class="err-confpayment" ng-show="salesheader!=null && salesheader.totalprice<salesheader.totalpayment">
		<div class="item-block">
				<span class="title">Transaksi ini sudah lunas.</span><br>
				<span class="content">Anda telah melakukan pelunasan sebelumnya, silahkan cek pada bagian pembayaran <a href="{{URL::asset('sales/all')}}" class=""><i class="fa fa-shopping-bag"></i> Daftar Pembelian</a>.<br></span>
		</div>
	</div>

	<div class="row margin-0" ng-show="salesheader.totalprice>salesheader.totalpayment && salesheader!=null">
		<div class="col-md-offset-1 col-md-12">

				@if(count($errors)>0)
			<div class="alert alert-warning">
				<h5>Error : </h5>
				<ol>
					@foreach($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ol>
			</div>
				@endif

			<input type="hidden" value="[[sales.id]]" name="salesID">
			<div class="cus-confpayment">
				<div class="nav-back text-xs-left">
					<a href="{{URL::asset('sales/all')}}" class="btn btn-outline-purple">
						<i class="fa fa-chevron-left"></i> &nbsp; <i class="fa fa-shopping-bag"></i> Detail Pembelian
					</a>
					<br>
				</div>

				<div class="title-wrapper">
					<div class="tx-title">KONFIRMASI PEMBAYARAN</div>
					<div class="tx-subtitle">
						<ol>
							<li>Lakukan konfirmasi setelah melakuka transfer.</li>
							<li>Daftar transfer dapat dicek pada <a href="" ng-click="showNoRek()">list no. rek</a>.</li>
							<li>Kami tidak memberikan nomor unik, mohon transfer sesuai dengan total tagihan.</li>
						</ol>
					</div>
				</div>
				<hr>

				<div class="form-row">
						<label for="ammount" class="label">Nomor Invoice</label>
						<div class="input">
							<div class="form-control text-bold">JB-[[zeroFill(salesheader.id, 5)]]</div>
						</div>
				</div>
				<div class="form-row">
						<label for="ammount" class="label">Total Tagihan</label>
						<div class="input">
							<div class="form-control">Rp <b>[[(salesheader.totalprice-salesheader.totalpayment)|number:0]]</b>.-</div>
							<small class="form-text text-muted">
								Harap transfer sesuai tagihan (<i>tanpa kode unik</i>)
							</small>
						</div>
				</div>
				<div class="form-row">
						<label class="label" for="form-custAcc">Rekening Anda</label>
						<div class="input">
							<div class="input-group">
								<select class="form-control" id="form-custAcc" name="customeraccID" ng-options="item.id as (item.alias==''?item.bankname:item.alias)+': '+item.accno+' (an. '+item.accname+')' for item in custaccs" ng-model="selected.custacc">
								</select>
								<div class="asdf">&nbsp;</div>
								<a href="" class="btn btn-outline-none padding-0"  data-toggle="modal" data-target="#addAccModal">
									<span class="fa fa-plus-circle fa-2x"></span>
								</a>
							</div>
							<small class="form-text text-muted">
								Jika belum ada, silahkan daftarkan dahulu (klik tombol "<strong>+</strong>" di kanan).
							</small>
					</div>
				</div>
				<div class="transfer-divider">
					<hr class="top"/>
					<div class="text-xs-center gray">
						<span class="glyphicon glyphicon-chevron-down size-12"></span>
						<span class="glyphicon glyphicon-chevron-down size-12"></span>
						<span class="size-14">TRANSFER Ke-</span>
						<span class="glyphicon glyphicon-chevron-down size-12"></span>
						<span class="glyphicon glyphicon-chevron-down size-12"></span>
					</div>
					<hr class="bottom"/> 
				</div>
				<div class="form-row">
						<label class="label" for="rekTujuan">Rekening Tujuan</label>
						<div class="input">
							<select class="form-control" id="form-compAcc" name="companyaccID" ng-options="item.id as (item.alias==''?item.bankname:item.alias)+': '+item.accno+' (an. '+item.accname+')' for item in compaccs" ng-model="selected.compacc">
							</select>
					</div>
				</div>
				<div class="form-row">
						<label for="date" class="label">Tanggal Bayar</label>
						<div class="input">
							<input class="form-control" type="date" ng-model="selected.paydate" id="date" name="paydate">
						</div>
				</div>
				<div class="form-row">
						<label for="ammount" class="label">Total Transfer</label>
						<div class="input">
							<input class="form-control" type="number" ng-model="selected.totaltransfer" name="ammount" id="ammount">
							<small class="form-text text-muted">Masukkan angka <b>sesuai yang di-transfer</b> tanpa koma atau titik</small>
						</div>
				</div>
				<div class="form-row">
						<label for="note" class="label">Catatan Tambahan</label>
						<div class="input">
							<textarea class="form-control" id="note" ng-model="selected.confirmnote"></textarea>
							<small class="form-text text-muted">Masukkan nomor berikut <u class="tx-purple"><b>JB[[zeroFill(salesheader.id, 5)]]</b></u> dalam berita transfer, agar mempercepat kami dalam proses</small>
						</div>
				</div>
				<div class="form-row">
					<div class="col-xs-12 text-center">
						<div class="btn-group">
							<button class="btn btn-purple" ng-click="confirmPayment()">Confirm</button>
							<button class="btn btn-outline-purple" ng-click="showNoRek()">List No. Rek</a>
						</div>

						<div class="size-70p margin-top-40">
							<i class="fa fa-warning tx-red"></i>
							Dengan menekan tombol Confirm, Anda sudah menyetujui dengan <a href="{{URL::asset('terms')}}">Syarat & Ketentuan</a> yang berlaku.
							<i class="fa fa-warning tx-red"></i>
						</div>
					</div>
				</div>
			</div>
	</div>

	@include('includes.modals.compaccno')
	@include('pages.order.sales.modals.addbankacc')
	<!-- Modal -->
	
	
</div>


@stop