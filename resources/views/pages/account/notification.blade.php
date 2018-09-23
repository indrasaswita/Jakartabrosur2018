@extends('layouts.container')
@section('title', 'Notifications')
@section('description', 'Data-data update otomatis yang mendukung daftar cetakan Anda.')
@section('robots', 'noindex,nofollow')
@section('content')

<div ng-controller="NotificationController">

@if(isset($notifications))
	@if($notifications != null)

		<?php
			$temp = str_replace(array('\r', '\"', '\n', '\''), '?', $notifications);
		?>

		@if(count($notifications) != 0)
	<div ng-init="initData('{{$temp}}')"></div>
		@endif
	@endif
@endif

	<div class="">
		<div class="bebas size-200p tx-lightgray text-xs-center">
			NOTIFICATION
		</div>
		<table class="table table-sm table-custom-allsales">
			<thead hidden>
				<tr>
					<th>#</th>
					<th>Notification</th>
					<th class="width-min">
						<i class="far fa-eye tx-lightgray"></i>
					</th>
					<th class="width-min">
						<i class="fas fa-cogs tx-gray"></i>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="item in notifications" class="content-header" ng-class="{'selected':!item.viewed}">
					<td class="number">
						<i class="fa-2x [[item.icon]]"></i>
					</td>
					<td class="line-12">
						<b>[[item.title.toTitleCase()]]</b>
						<br>
						[[item.content]] 
						<span class="tx-lightgray">
							[[item.bedawaktu]]
						</span>
					</td>
					<td class="line-12 text-xs-center">
						<i class="fas fa-eye" ng-class="{'tx-lightgray':item.viewed==0, 'tx-transparent':item.viewed==1}"></i>
					</td>
					<td>
						<button class="btn btn-primary btn-sm">
							<i class="fas fa-search"></i>
						</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

@stop