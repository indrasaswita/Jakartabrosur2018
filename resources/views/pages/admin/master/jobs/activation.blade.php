@extends('layouts.container')
@section('title', 'Job Activation')
@section('content')


<div ng-controller="AdmJobactivationController">
@if(isset($jobtypes))
	@if($jobtypes != null)

		<?php
			$temp = str_replace(array('\r', '\"', '\n', '\''), '?', $jobtypes);
		?>

		@if(count($jobtypes) != 0)
	<div ng-init="initData('{{$temp}}')"></div>
		@endif
	@endif
@endif

	<div class="jobactivation-wrapper">
		<div class="page-title">
			<i class="fas fa-code"></i>
			JOB EDITOR 
			<i class="size-70p text-muted">ADMIN</i>
		</div>
		<table class="table table-sm">
			<tbody ng-repeat="item in jobtypes">
				<tr class="header">
					<td class="width-min">
						<b>#[[zeroFill(item.id, 4)]]</b>
					</td>
					<td>
						<div class="pull-xs-left">
							[[item.name]] (<i class="tx-danger uppercase size-80p text-bold"> [[item.indoname]] </i>)
						</div>
						<div class="pull-xs-right">
							<a class="a-purple" href="" ng-click="toggleedit(item)" ng-if="!item.editmode">
								<i class="fas fa-edit fa-fw"></i> Edit
							</a>
							<a class="a-purple" href="" ng-click="toggleedit(item)" ng-if="item.editmode">
								<i class="fas fa-times fa-fw tx-red"></i> Cancel
							</a>
						</div>
					</td>
				</tr>
				<tr class="" ng-if="item.editmode">
					<td colspan="10">
						<div class="edit">
							<table class="table-sm">
								<tr ng-repeat="item2 in item.jobsubtype">
									<td class="width-min">
										<i class="fas fa-chevron-right tx-lightgray"></i>
									</td>
									<td class="width-min">
										<b>#[[zeroFill(item2.id, 4)]]</b>
									</td>
									<td class="">
										[[item2.name]] (<small class='uppercase'>[[item2.subname]]</small>)
										<span ng-if="item2.errormessage!=null">
											[ <span ng-bind-html="item2.errormessage"></span> ]
										</span>
									</td>
									<td class="width-min">
										<a href="" ng-click="togglesubtype(item2, $index, $parent.$index)">
											<i class="fas fa-toggle-on tx-success" ng-if="item2.active==1"></i> 
											<i class="fas fa-toggle-off tx-danger" ng-if="item2.active==0"></i>
										</a>
									</td>	
								</tr>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>

</div>

@stop