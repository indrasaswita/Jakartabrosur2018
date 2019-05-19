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
				<tr ng-repeat="item in notifications" class="content-header" ng-class="{'selected':!item.viewed&&item.ownerID!=null}" ng-click="view(item)">
					<td class="number">
						<i class="fa-2x [[item.icon]] fa-fw"></i>
					</td>
					<td class="line-12">
						<b>[[item.title.toTitleCase()]]</b>
						<small ng-if="item.ownerID==null" class="google uppercase tx-purple"><b><i>BROADCAST</i></b></small>
						<div ng-bind-html="item.content"></div>
						<span class="tx-lightgray">
							[[item.bedawaktu]]
						</span>
					</td>
					<td class="line-12 text-xs-center">
						<span data-html="true" data-placement="left" data-toggle="tooltip" data-title="<small class='text-bold tx-primary'><i>HAS NOT BEEN SEEN YET</i></small><br>Tap/Click this notif to view.." ng-if="item.ownerID!=null&&item.viewed==0">
							<i class="fas fa-eye fa-fw tx-lightgray"></i>
						</span>
						<span data-html="true" data-placement="left" data-toggle="tooltip" data-title="<i class='size-80p text-bold tx-purple'>BROADCAST</i><br>Can be view by <span class='tx-gray text-bold'>all {{Session::get('role')}}</span>" ng-if="item.ownerID==null">
							<i class="fas fa-bullhorn fa-fw tx-purple"></i>
						</span>
					</td>
					<td>
						<button class="btn btn-primary btn-sm">
							<i class="fas fa-external-link-alt fa-fw"></i>
						</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

@stop