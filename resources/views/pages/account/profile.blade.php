@extends('layouts.container')
@section('content')

<div ng-controller="ProfileController" class="margin-top-80">
	<div ng-init="initCustomer('{{json_encode($customer)}}')"></div>
	
	<div class="row margin-0">
		<div class="col-xs-6 padding-5">
			<div class="alert-outline-lightmagenta">
				<div class="row margin-0">
					<div class="form-check col-xs-12">
						<div class="purple padding-5">Panggilan</div>
						<label class="form-check-label">
							<input type="radio" class="form-check-input" value="Mr." name="gender" ng-model="customer.title"> 
							<span class="margin-right-10">Mr.</span>
						</span>
						<span class="form-check-label">
							<input type="radio" class="form-check-input" value="Mrs." name="gender" ng-model="customer.title"> 
							<span class="margin-right-10">Mrs.</span>
						</span>
					</div>
				</div>
				<div class="row margin-0">
					<div class="form-group col-xs-12">
						<div class="purple padding-5">Nama Lengkap</div>
						<input class="form-control" type="text" ng-model="customer.name" placeholder="Full Name">
					</div>
				</div>
				<div class="row margin-0">
					<div class="form-group col-xs-12">
						<div class="purple padding-5">Alamat Lengkap</div>
						<textarea class="form-control" type="text" ng-model="customer.address" rows="3" placeholder="Address"></textarea>
					</div>
				</div>
				<div class="row margin-0">
					<div class="form-group col-xs-12">
						<div class="purple padding-5">Kota</div>
						<select class="form-control" ng-model="customer.cityID" id="form-cityID" ng-options="x.id as x.name for x in cities"></select>
					</div>
				</div>
				<div class="row margin-0">
					<div class="form-group col-xs-12">
						<div class="purple padding-5">Kode Pos</div>
						<input class="form-control" rows="3" type="text" ng-model="customer.postcode" placeholder="Post Code">
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-6 padding-5">
			<div class="alert-outline-lightmagenta">
				<div class="row margin-0">
					<div class="form-group col-xs-12">
						<div class="purple padding-5">E-mail</div>
						<input class="form-control" type="email" ng-model="customer.email" placeholder="E-mail">
					</div>
				</div>
				<div class="row margin-0">
					<div class="form-group col-xs-12">
						<div class="purple padding-5">Telepon 1</div>
						<input class="form-control" type="text" ng-model="customer.phone1" placeholder="Phone 1">
					</div>
				</div>
				<div class="row margin-0">
					<div class="form-group col-xs-12">
						<div class="purple padding-5">Telepon 2</div>
						<input class="form-control" type="text" ng-model="customer.phone2" placeholder="Phone 2">
					</div>
				</div>
				<div class="row margin-0">
					<div class="form-group col-xs-12">
						<div class="purple padding-5">Telepon 3</div>
						<input class="form-control" type="text" ng-model="customer.phone3" placeholder="Phone 3">
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<div class="row margin-10-0">
		<div class="col-xs-12 text-xs-center">
			<input type='checkbox' class="form-check-input" ng-change="setNews(customerData.newsvalue)" ng-model="customer.news">
			<span>Dengan ini Anda ingin menerima berita baru lewat email. <div class="tag tag-danger text-regular">not yet</div></span>
		</div>
	</div>
	<div class="row margin-0">
		<div class="col-xs-12 text-xs-center">
			<button class="btn btn-purple" ng-click="changeProfile()">Change!</button>
		</div>
	</div>
	
</div>

@stop