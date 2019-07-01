
@extends('layouts.container')
@section('title', 'Master Finishings')
@section('description', 'Change Finishing, options, and price.')
@section('robots', 'noindex,nofollow')
@section('content')


<div class="admin-finishing-wrapper" ng-controller="AdmFinishingController">

@if(isset($finishings))
	@if($finishings != null)

		<?php
			$temp = str_replace(array('\r', '\"', '\n', '\''), '?', $finishings);
		?>

		@if(count($finishings) != 0)
	<div ng-init="initData('{{$temp}}')"></div>
		@endif
	@endif
@endif

@if(isset($finishings))
	@if($finishings != null)
		@if(count($finishings) != 0)
	<div class="page-title margin-10-0">
		<i class="fal fa-hat-wizard fa-fw"></i>
		ALL FINISHINGS ARE HERE
	</div>

	<div class="admin-finishing">
		<table class="table table-sm">
			<tbody ng-repeat="item in finishings">
				<tr class="finishing-title">
					<td rowspan="2" class="num">
						#[[zeroFill(item.id, 2)]]
					</td>
					<td colspan="">
						<span class="name">
							[[item.name]]
						</span> /
						<span class="shortname">
							[[item.shortname]]
						</span>

						<i class="fal fa-arrow-alt-to-bottom fa-fw"></i>
						[[item.mingram]]g
						&nbsp;-&nbsp; 
						<i class="fal fa-arrow-alt-to-top fa-fw"></i>
						[[item.maxgram]]g
					</td>
					<td class="text-xs-right">
						<a href="">
							<i class="fal fa-fw" ng-class="{'fa-toggle-on tx-success':item.status, 'fa-toggle-off tx-danger':!item.status}"></i>
							<span class="tx-success googleft" ng-if="item.status">
								ACTIVE
							</span>
							<span class="tx-danger googleft" ng-if="!item.status">
								NON-ACTIVE
							</span>
						</a>
					</td>
				</tr>
				<tr class="finishing-detail">
					<td colspan="2">
						<textarea>[[item.info]]</textarea>
					</td>
				</tr>
				<tr class="option">
					<td class="num"></td>
					<td colspan="2">
						<table class="table">
							<tbody>
								<tr ng-repeat="item2 in item.finishingoption">
									<td class="width-min tx-lightgray">
										#[[zeroFill(item2.id, 3)]]
									</td>
									<td data-title="<span class='tx-purple text-bold'>#[[zeroFill(item2.id, 3)]] [[item2.optionname]]</span>" data-html="true" data-placement="bottom" data-toggle="tooltip">
										[[singkatText(item2.optionname, 25, '')]]
									</td>
									<td class="text-xs-right">
										<i class="fal fa-usd-square"></i>
										[[item2.price|number:2]]
									</td>
									<td class="text-xs-right">
										<i class="fal fa-times-square"></i>
										[[item2.priceper]]
									</td>
									<td class="text-xs-right">
										<i class="fal fa-arrow-alt-to-bottom"></i>
										[[item2.priceminim|number:0]]
									</td>
									<td class="text-xs-right">
										<i class="fal fa-plus-square"></i>
										[[item2.pricebase|number:0]]
									</td>
									<td class="text-xs-right">
										<i class="fal fa-calendar-check"></i>
										[[item2.processdays|number:0]]d
									</td>
									<td class='edit'>
										<a class="a-purple" href="">
											<small class="fal fa-money-check-edit-alt fa-fw"></small>
										</a>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td class="num"></td>
					<td class="text-xs-right" colspan="2">
						<button class="btn btn-sm btn-outline-purple">
							<i class="fal fa-edit"></i>
							Save Finishing #[[zeroFill(item.id, 2)]] [[item.name]]
						</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
		@endif
	@endif
@endif
</div>


@stop

