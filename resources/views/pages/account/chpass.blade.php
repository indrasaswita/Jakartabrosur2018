@extends('layouts.container')
@section('content')

<div ng-controller="ProfileController" class="margin-top-80">
	<div ng-init="initCustomer('{{json_encode($customer)}}')"></div>

	<div class="row margin-0">
		<div class="col-xs-3"></div>
		<div class="col-xs-6">
			<div class="alert-outline-lightmagenta">
				<div class="row margin-0">
					<div class="form-check col-xs-12">
						<div class="purple padding-5">Password LAMA Anda:</div>
						<input type="password" class="form-control" name="password" ng-model="customer.password" placeholder="Old Password"> 
					</div>
				</div>
				<div class="row margin-0">
					<div class="form-check col-xs-12">
						<div class="purple padding-5">Password <strong>BARU</strong>:</div>
						<input type="password" class="form-control" name="newpass" ng-model="customer.newpass" placeholder="New Password"> 
					</div>
				</div>
				<div class="row margin-0">
					<div class="form-check col-xs-12">
						<div class="purple padding-5">Konfirmasi Password:</div>
						<input type="password" class="form-control" name="cnewpass" ng-model="customer.cnewpass" placeholder="Confirmation New Password"> 
					</div>
				</div>
				<div class="row margin-0">
					<div class="col-xs-12 text-xs-center">
						<button class="btn btn-purple" ng-click="changePassword()">Change!</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
</div>

@stop