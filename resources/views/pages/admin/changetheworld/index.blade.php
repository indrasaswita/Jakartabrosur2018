
@extends('layouts.container')
@section('title', 'Title')
@section('description', 'Description.')
@section('robots', 'noindex,nofollow')
@section('content')


<div class="admin-changetheworld-wrapper" ng-controller="AdmChangetheworldController">

@if(isset($datas))
	@if($datas != null)

		<?php
			$temp = str_replace(array('\r', '\"', '\n', '\''), '?', $datas);
		?>

	<div ng-init="initData('{{$temp}}')"></div>
	@endif
@endif

@if(isset($datas))
	@if($datas != null)
	<div class="page-title margin-10-0">
		<i class="fas fa-shopping-basket fa-fw"></i>
		DB Schema
	</div>
	<div class="admin-changetheworld">
		<div class="btn-filter-scroll-x">
			<a class="btn" ng-repeat="item in datas" ng-click="requestTable(item)">
				[[item]]
			</a>
		</div>
		<table class="table" ng-if="values.length>0">
			<thead>
				<tr>
					<th ng-repeat="item in keys" ng-class="{'tx-purple':$index%2==0}">
						[[item]]
					</th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="item in values track by $index">
					<td ng-repeat="item2 in item track by $index" ng-class="{'tx-purple':$index%2==0}">
						[[(item2)]]
					</td>
				</tr>
			</tbody>
		</table>
		<div class="result">
			<div class="message">
				[[messages]]
			</div>
			<button class="line-11 btn btn-outline-purple" ng-click="upload()" ng-disabled="values.length==0">
				<span ng-if="!uploadloading">
					<i class="fal fa-cloud-upload fa-fw fa-2x"></i><br>
					Upload
				</span>
				<span ng-if="uploadloading">
					<i class="fal fa-spinner fa-spin fa-fw fa-2x"></i><br>
					Uploading...
				</span>
			</button>
		</div>
	</div>
	@endif
@endif
</div>


@stop

