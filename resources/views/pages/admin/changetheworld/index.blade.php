
@extends('layouts.container')
@section('title', 'Title')
@section('description', 'Description.')
@section('robots', 'noindex,nofollow')
@section('content')


<div ng-controller="AdmChangetheworldController">

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
	<div>
		<div class="btn-filter-scroll-x">
			<a class="btn" ng-repeat="item in datas" ng-click="requestTable(item)">
				[[item]]
			</a>
		</div>
		<<table class="table">
			<thead>
				<tr>
					<th ng-repeat="item in keys">
						[[item]]
					</th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="item in values track by $index">
					<td ng-repeat="item2 in item track by $index">
						[[(item2)]]
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	@endif
@endif
</div>


@stop

