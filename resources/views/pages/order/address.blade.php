@extends('layouts.container')
@section('content')


<div class="margin-top-80" ng-controller="AddressController">
@if(isset($id))
	@if(isset($addresses))
		@if($addresses != null)
			@if(count($addresses) > 0)
		<div ng-init="initAddress('{{json_encode($addresses)}}')"></div>
			@endif
		@endif
	@endif

	@if ($id != null)
		<div ng-init="globalSalesID('{{$id}}')"></div>
		<div ng-init="initSalesID('{{$id}}')"></div>
	@endif
@endif

	@include('includes.nav.subnav')
	@include('includes.nav.salenav')
@if($id != null)

@if(isset($addresses))
	@if($addresses != null)
		@if(count($addresses) > 0)
	<div class="row margin-0">
		<div class="col-xs-12">
			<div class="panel-title"><span class="glyphicon glyphicon-chevron-right size-18"></span> Alamat Anda</div>
			<table class="table table-sm table-center">
				<thead class="thead-inverse">
					<tr>
						<th class="width-min"><span class="glyphicon glyphicon-arrow-down"></span></th>
						<th>Nama Alamat</th>
						<th>Alamat Lengkap</th>
						<th>Penerima</th>
						<th>Kota</th>
						<th>Keterangan</th>
						<th class="width-min"><span class="glyphicon glyphicon-trash"></span></th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="item in addresses">
						<td><input type="radio" name="address" ng-value="item" ng-model="baksjhxakljxa" ng-change="setAddress(item)"></td>
						<td>[[item.name]]</td>
						<td class="text-xs-left">[[item.address]]</td>
						<td>[[item.receiver]]</td>
						<td>[[item.addresscityname]]</td>
						<td>[[item.addressnotes]]</td>
						<td><button class="btn btn-sm btn-danger" ng-click="delete(item)"><span class="glyphicon glyphicon-trash"></span></button></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
		@else
	<div class="text-muted margin-40-0 text-xs-center">
		<span class="size-30">Tidak ada alamat yang terdaftar</span><br>
	</div>
		@endif
	@endif
@endif
	<div class="row margin-0">
		<hr>
	</div>
	<div class="row margin-0">
		<div class="col-xs-12">
			<div class="panel-title">
				<span class="glyphicon glyphicon-chevron-right size-18"></span>
				 Detail 
				<span data-toggle="tooltip" data-placement="right" title="Stiap pesanan dengan alamat pengiriman yang berbeda akan tercatat secara otomatis.">
					<span class="glyphicon glyphicon-question-sign size-24 normal-clr"></span>
				</span>
				<button class="btn btn-outline-purple century pull-xs-right" ng-click="fillFromCust()">Alamat Default</button>
			</div>
		</div>
	</div>
	<div class="row margin-0">
		<div class="col-xs-6">
			<div class="row margin-0">
				<div class="col-xs-12 form-group">
					<div>Nama Alamat</div>
					<input type="text" ng-model="selected.name" class="form-control" placeholder="Nama Alamat">
					<small class="form-text text-muted">Berilah nama untuk alamat anda (ex. Home, Office, My Dearest Place, atau Rumah Ortu)</small>
				</div>
			</div>
			<div class="row margin-0">
				<div class="col-xs-12 form-group">
					<div>Alamat Lengkap</div>
					<input type="text" ng-model="selected.address" class="form-control" placeholder="Alamat Lengkap">
					<small class="form-text text-muted">Tulislah nama jalan alamat anda dengan lengkap (ex. Jl. Pangeran Jayakarta 113)</small>
				</div>
			</div>
			<div class="row margin-0">
				<div class="col-xs-12 form-group">
					<div>Nama Penerima</div>
					<input type="text" ng-model="selected.receiver" class="form-control" placeholder="Nama Penerima">
					<small class="form-text text-muted">Perkiraan nama orang yang akan menerima barang (boleh lebih dari 1)</small>
				</div>
			</div>
		</div>
		<div class="col-xs-6">
			<div class="row margin-0">
				<div class="col-xs-12 form-group">
					<div>Kota</div>
					<select class="form-control" ng-model="selected.cityID" id="form-cityID" ng-options="x.id as x.name for x in cities"></select>
				</div>
			</div>

			<div class="row margin-0">
				<div class="col-xs-12 form-group">
					<div>Alamat Lengkap</div>
					<textarea ng-model="selected.addressnotes" rows="5" class="form-control" placeholder="Deskripsi"></textarea>
					<small class="form-text text-muted">Deskripsikan alamat Anda untuk membantu pencarian (berikut blok, nomor, kodepos, maupun patokan-patokan) beserta contact person bila ada.</small>
				</div>
			</div>
		</div>
	</div>


	<div class="text-center">
		<!-- <input class="bg-info" id="scroll">
		<input class="bg-warning" id="document">
		<input class="bg-danger" id="window"> -->
		<div class="btn-group">
			<button class="btn btn-primary" ng-click="checkout()">Next ></button>
		</div>
	</div>
	
@else
	<div class="text-muted margin-40-0 text-xs-center">
		<span class="size-30">Halaman Ini Error</span><br>
		<span class="size-16">Silahkan hubungi customer service kami.<br></span>
	</div>
@endif

</div>
@stop