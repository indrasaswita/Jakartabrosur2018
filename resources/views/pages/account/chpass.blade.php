@extends('layouts.default')
@section('title', 'Change Password')
@section('content')

<div class="editprofile" ng-controller="EditProfileController">
	<?php
		$customer_t = str_replace(array('\r', '\"', '\n', '\''), '?', $customer);
	?>
	<div ng-init="initCustomer('{{$customer_t}}')"></div>

	<form>
		<div class="title">
			GANTI SANDI
		</div>
		<div class="chpass-wrapper">
			<div class="">
				<div class="form-check">
					<div class="purple padding-5">Password LAMA Anda:</div>
					<input type="password" class="form-control" name="password" ng-model="customer.password" placeholder="Old Password"> 
				</div>
			</div>
			<div class="">
				<div class="form-check">
					<div class="purple padding-5">Password <strong>BARU</strong>:</div>
					<input type="password" class="form-control" name="newpass" ng-model="customer.newpass" placeholder="New Password"> 
				</div>
			</div>
			<div class="">
				<div class="form-check">
					<div class="purple padding-5">Konfirmasi Password:</div>
					<input type="password" class="form-control" name="cnewpass" ng-model="customer.cnewpass" placeholder="Confirmation New Password"> 
				</div>
			</div>
			<div class="errormessage" ng-if="errormessage!=null && errormessage.length>0">
				[[errormessage]]
			</div>
			<div class="submit">
				<button type="submit" class="btn btn-purple" ng-click="changePassword()">Save</button>
			</div>
		</div>
	</form>
	
	
</div>

@stop