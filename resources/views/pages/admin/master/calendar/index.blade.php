@extends('layouts.container')
@section('title', 'Calendar Viewer')
@section('description', 'Edit Working Calendar.')
@section('robots', 'noindex,nofollow')
@section('content')

<div class="admin-calendar-wrapper" ng-controller="AdmCalendarController">

@if(isset($offdays))
	@if($offdays != null)

		<?php
			$temp = str_replace(array('\r', '\"', '\n', '\''), '?', $offdays);
		?>

		@if(count($offdays) != 0)
	<div ng-init="initData('{{$temp}}', '{{$today}}')"></div>
		@endif

	@endif
@endif

@if(isset($after) != 0)
	<div ng-init="initSetAfter('{{$after}}')"></div>
@endif


	<div class="admin-calendar">
		<table class="table">
			<tbody>
				<tr>
					<td class="text-xs-center text-v-center" colspan="7">
						<button class="btn btn-sm btn-outline-purple pull-xs-left" ng-click="decrement_month()">
							<i class="fas fa-chevron-left fa-fw"></i>
						</button>

						[[(month_enum[selectedmonth])]]
						[[selectedyear]]

						<button class="btn btn-sm btn-outline-purple pull-xs-right" ng-click="increment_month()">
							<i class="fas fa-chevron-right fa-fw"></i>
						</button>
					</td>
				</tr>
				<tr>
					<td>
						Sen
					</td>
					<td>
						Sel
					</td>
					<td>
						Rab
					</td>
					<td>
						Kam
					</td>
					<td>
						Jum
					</td>
					<td>
						Sab
					</td>
					<td class="tx-danger">
						Ming
					</td>
				</tr>
				<tr ng-repeat="date in dates">
					<td ng-repeat="i in date track by $index" ng-class="{'today':isToday(i), 'weekend':$index>=6&&today.getDate()!=i, 'offday':isOffday(i)}">
						[[i]]
						<div class="size-70p" ng-if="isDate(after, i)&&{{$day}}!=0">
							(est. {{$day}}d)
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

@stop
