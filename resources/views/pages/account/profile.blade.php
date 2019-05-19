@extends('layouts.container')
@section('title','Edit Profile')
@section('description','Untuk mengedit data profile Anda.')
@section('robots','nofollow,noindex')
@section('content')


<?php
	$customer_t = str_replace(array('\r', '\"', '\n', '\''), '?', $customer);
?>

<div ng-controller="EditProfileController" ng-init="initProfile('{{$customer_t}}')">
	<div class="order-panel-tabs">
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#profile">
					<i class="fas fa-user-astronaut"></i>
					<span class="hidden-xs-down">Profile</span>
					<span class="hidden-sm-up">Profile</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#address">
					<i class="fab fa-fort-awesome"></i>
					<span class="hidden-xs-down">Address</span>
					<span class="hidden-sm-up">Addr</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#company">
					<i class="fas fa-building"></i>
					<span class="hidden-xs-down">Company</span>
					<span class="hidden-sm-up">Company</span>
				</a>
			</li>
		</ul>
	</div>

	<div class="tab-content">
		@include('pages.account.includes.editprofile')
		@include('pages.account.includes.editaddress')
		@include('pages.account.includes.editcompany')
	</div>
</div>

@stop