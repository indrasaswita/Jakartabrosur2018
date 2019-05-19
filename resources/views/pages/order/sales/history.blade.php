@extends('layouts.container')
@section('content')
	<!-- <form> -->
<div ng-controller = "HistoryController" class="">
@if(isset($allsales))      
	<div ng-init="initAllSales('{{json_encode($allsales)}}')"></div>
	@if ($allsales != null)
		@if(count($allsales) != 0)
			<div ng-init="globalSalesID('{{$allsales[0]['id']}}')"></div>
		@endif
	@endif
@endif
<!-- NANTI MESTI BUAT VALIDASI KALO ORANG LANGSUNG MASUK KE UPLOAD HARUS DI CEK DULU UDA ADA SESSION DARI PAGE ORDER BLOM.. -->
	@include('includes.nav.subnav')

	@if($allsales != null)
		@if(count($allsales) > 0)
			@include('includes.nav.salenav')
	<div class="row margin-0">
		<div class="col-md-offset-1 col-md-12">
			<table class="table table-sm table-hover size-14">
				<thead class="text-center">
					<tr>
						<th>#Invoice</th>
						<th class="width-12">Waktu</th>
						<th class="width-20">Products</th>
						<th>Total Price</th>
						<!-- <th class="width-min padding-h-10">Alamat</th>
						<th class="width-min padding-h-0">Payment</th> -->
						<!-- <th>Action</th> -->
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="item in sales">
						<td class="text-center width-min">#[[zeroFill(item.id, 5)]]</td>
						<td class="text-center">
							<table class="table table-clear">
								<tbody>
									<tr>
										<td>[[item.created_at|date:'dd-MM-yyyy']]</td>
									</tr>
									<tr>
										<td>[[item.created_at|date:'HH:mm:ss']]</td>
									</tr>
								</tbody>
							</table>
						</td>
						<td class="">
							<table class="table table-clear">
								<tbody>
									<tr ng-repeat="item2 in item.detail">
										<td>[[$index+1]].</td>
										<td><strong>[[item2.jobtitle]]</strong> <div class="tag tag-purple text-regular">[[item2.jobtype]]</div> [[item2.quantity|number:0]] [[item2.quantitytypename]]</td>
									</tr>
								</tbody>
							</table>
						</td>
						<td class="">Rp <span class="pull-xs-right text-bold">[[item.totalprice|number:0]]</span></td>
						<!-- <td class="text-center padding-h-0">
							<a href="{{URL::asset('addresses/[[item.id]]')}}" class=""><img ng-src="{{URL::asset('image/location-[[item.deliverystatus]].png')}}" height="45px" data-toggle="tooltip" data-placement="bottom" data-title="[[item.address!=null?item.address:'Klik Untuk Atur Alamat Kirim']]"></td></a>
						</td>
						<td class="text-center padding-h-0">
							<a href="{{URL::asset('payment/[[item.id]]')}}" class=""><img ng-src="{{URL::asset('image/payment-[[item.paymentstatus]].png')}}" height="45px" data-toggle="tooltip" data-placement="bottom" data-title="[[item.paymentdetail]]"></a>
						</td> -->
						<!-- <td class="width-min">
							<div class="btn-group-vertical display-block">
								<a href="{{URL::asset('payment/confirm/[[item.id]]')}}" class="btn btn-sm btn-purple" ng-hide="isLunas(item)">Konf. <br>Bayar</a>
							</div>
						</td> -->
					</tr>
				</tbody>
			</table>
		</div>
	</div>
		@else
	<div class="text-muted margin-20-0 text-xs-center">
		<span class="size-30">Belum Ada Pekerjaan yang Selesai</span><br>
		<span class="size-16">( <a href="{{URL::asset('flyer')}}"><span class="glyphicon glyphicon-edit size-14"></span> Flyer</a> | <a href="{{URL::asset('sales/all')}}"><span class="glyphicon glyphicon-shopping-cart size-14"></span> Pembelian</a> )</span>
	</div>
		@endif
	@else
	<div class="text-muted margin-20-0 text-xs-center">
		<span class="size-30">Belum Ada Pekerjaan yang Selesai</span><br>
		<span class="size-16">( <a href="{{URL::asset('flyer')}}"><span class="glyphicon glyphicon-edit size-14"></span> Flyer</a> | <a href="{{URL::asset('sales/all')}}"><span class="glyphicon glyphicon-shopping-cart size-14"></span> Pembelian</a> )</span>
	</div>
	@endif

	<div class="row margin-20-0 text-xs-left">
		<div class="col-xs-2"></div>
		<div class="col-xs-8">
			<div class="alert alert-outline-lightmagenta lightmagenta padding-20">
				<span class="size-16">
					<h5>Data History terdiri dari:</h5>
					<ol class="padding-left-20 margin-bottom-0">
						<li>
							<span class="">Anda sudah menerima pesanan sesuai dengan apa yang telah dipesan.</span><br>
							<span class="size-14">(Hubungi kami di <span class="lightpurple size-16">0813-1551-9889</span>, bila ada kesalahan pesanan)</span>
						</li>
						<li>Bila pihak kami telah menyelesaikan seluruh pekerjaan.<br></li>
						<li>Dan Anda dapat memberi 'rating' atas pekerjaan kami. <span class="tag tag-purple text-regular">soon</span></li>
						<li>Dan Anda dapat melakukan repeat order. <span class="tag tag-purple text-regular">soon</span></li>
					</ol>
				</span>
			</div>
		</div>
	</div>
</div>
	<!-- </form> -->
@stop