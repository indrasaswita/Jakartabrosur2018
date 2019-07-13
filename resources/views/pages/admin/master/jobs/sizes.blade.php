@extends('layouts.container')
@section('title', 'Job Size Manager')
@section('content')


<div ng-controller="AdmJobsizesController" class="jobsizes-wrapper">
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

	<div class="">
		<div class="page-title">
			<i class="fas fa-code"></i>
			JOB SIZE MANAGER 
			<i class="size-70p text-muted">ADMIN</i>
		</div>
		<ul class="list">
			<li ng-repeat="item in jobtypes" ng-if="$index==activejobtype">
				<div class="list-title">
					<div class="prev">
						<button class="btn btn-sm btn-secondary" ng-click="prevlist()">
							<i class="fas fa-angle-double-left tx-warning"></i>
						</button>
					</div>
					<div class="core">
						<b>#[[zeroFill(item.id, 2)]]</b>
						[[item.name]] (<i class="tx-danger uppercase size-80p text-bold"> [[item.indoname]] </i>)
						<b>
							INDEX: [[$index+1]]/[[jobtypes.length]]
						</b>
					</div>
					<div class="next">
						<button class="btn btn-sm btn-secondary" ng-click="nextlist()">
							<i class="fas fa-angle-double-right tx-warning"></i>
						</button>
					</div>
				</div>
				<table class="table-sm">
					<tbody ng-repeat="item2 in item.jobsubtype">
						<tr>
							<td class="width-min">
								<i class="fas fa-chevron-right tx-lightgray"></i>
							</td>
							<td class="width-min">
								<b>#[[zeroFill(item.id, 2)]].[[zeroFill(item2.id, 2)]]</b>
							</td>
							<td class="">
								[[item2.name]] 
									<small class='uppercase'>
										<b>(<span class="tx-danger">[[item2.subname]]</span>)</b>
									</small>
							</td>
							<td>
								<div>
									<span ng-class="{'tx-transparent':item2.totalOF==0, 'tx-primary':item2.totalOF>=1}">
										<i class="fal fa-print"></i> <b>OF</b>([[item2.totalOF]])
									</span>
									<span ng-class="{'tx-lightmagenta':item2.totalDG>=1, 'tx-transparent':item2.totalDG==0}">
										<i class="fal fa-print"></i> <b>DG</b>([[item2.totalDG]])
									</span>
								</div>
							</td>
							<td class="width-min">
								<div class="" ng-if="item2.active==0" data-toggle="tooltip" data-title="not activated" tooltip>
									<i class="fas fa-circle tx-red"></i>
								</div>
								<div class="" ng-if="item2.active==1" data-toggle="tooltip" data-title="activated" tooltip>
									<i class="fas fa-circle tx-success"></i>
								</div>
							</td>
							<td class="width-min">
								<div class="pull-xs-right">
									<button class="btn btn-xsm btn-secondary" href="" ng-click="toggleedit(item2)" ng-if="!item2.editmode">
										<span class="size-90p">
											[[item2.jobsubtypesize.length]]
											<i class="fas fa-chevron-down fa-fw size-80p"></i> 
										</span>
									</button>
									<button class="btn btn-xsm btn-secondary" href="" ng-click="toggleedit(item2)" ng-if="item2.editmode">
										<span class="size-90p">
											Hide 
											<i class="fas fa-chevron-up fa-fw tx-red"></i>
										</span>
									</button>
								</div>
							</td>	
						</tr>
						<tr class="sizes" ng-if="item2.editmode">
							<td colspan="10">
								<div class="edit">
									<table class="table table-sm">
										<tbody ng-repeat="item3 in item2.jobsubtypesize">
											<tr>
												<td>
													#[[zeroFill(item.id, 2)]].[[zeroFill(item2.id, 2)]].[[zeroFill(item3.size.id, 3)]], id:[[item3.id]] 

													<a href="" ng-click="changeOfDg(item3)" class="size-80p uppercase tx-primary" ng-if="item3.ofdg==1">
														<i class="fas fa-print"></i>
														<b>OF</b>
													</a>
													<a href="" ng-click="changeOfDg(item3)" class="size-80p uppercase tx-lightmagenta" ng-if="item3.ofdg==2">
														<i class="fas fa-print"></i>
														<b>DG</b>
													</a>

													[[item3.size.name]] 
													<span class="uppercase tx-danger size-70p">
														<i><b>( [[item3.size.width|number:0]]x[[item3.size.length|number:0]] cm )</b></i>
													</span>
												</td>
												<td class="width-min">
													<div ng-if="item3.size.status" data-toggle="tooltip" data-title="activated" tooltip>
														<i class="fas fa-circle tx-success">
														</i>
													</div>
													<div ng-if="!item3.size.status" data-toggle="tooltip" data-title="not activated" tooltip>
														<i class="fas fa-circle tx-danger">
														</i>
													</div>
												</td>
												<!-- <td>
													<button class="btn btn-xsm btn-secondary" ng-click="showoptions_clicked(item3)">
														<span class="size-90p">
															[[item3.size.sizeoption.length]]
															<i class="fas fa-chevron-down size-80p"></i>
														</span>
													</button>
												</td> -->
												<td>
													<div class="pull-xs-right">
														<a href="" class="delete-link">
															<i class="fas fa-trash tx-danger size-80p"></i> 
															delete
														</a>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
									<div class="actions">
										<button class="btn btn-sm btn-secondary" ng-click="addnewjobsize(item2.id)">
											<i class="fas fa-plus size-80p"></i>&nbsp;
											Tambah <b class="size-90p">size</b> (pada <b>[[item2.name]]</b>)
										</button>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</li>
		</ul>
	</div>

	@include('modal', 
		[
			'modalid' => 'addnewjobsize',
			'modaltitle' => 'JobsubtypeSize Baru',
			'modalbody' => '
				<table class="table table-sm">
					<thead>
						<tr class="text-center">
							<th class="width-min">#</th>
							<th class="width-min">
								<i class="far fa-check fa-fw"></i>
							</th>
							<th>Name</th>
							<th>Lebar</th>
							<th class="width-min"></th>
							<th>Panjang</th>
							<th class="width-min"></th>
						</tr>
					</thead>
					<tbody>
						<tr class="text-center" ng-repeat="item in newjobsizes">
							<td class="text-xs-right">
								[[zeroFill($index + 1, 2)]].
							</td>
							<td class="text-xs-center">
								<label class="custom-checkbox">
							  <input type="checkbox" ng-model="item.custominput" ng-checked="selectedchanged(item)">
							  <span class="checkmark"></span>
								</label>
							</td>
							<td>
								<div class="" ng-if="item.custominput">
									<input type="text" placeholder="Custom: Size Name" ng-model="item.name">
								</div>
								<div class="" ng-if="!item.custominput">
									<select class="width-100" ng-options="size as size.name for size in sizes" ng-model="item.size"></select>
								</div>
							</td>
							<!-- KALO GA CUSTOM -->
							<td ng-if="item.size!=null">
								<input class="text-xs-right small-number" type="number" step="0.1" ng-model="item.size.width" disabled>
							</td>
							<td ng-if="item.size!=null">
								<i class="far fa-times tx-purple"></i>
							</td>
							<td ng-if="item.size!=null">
								<input class="text-xs-right small-number" type="number" step="0.1" ng-model="item.size.length" disabled>
							</td>
							<td ng-if="item.size!=null">
								cm
							</td>
							<!-- SIZE CUSTOM -->
							<td ng-if="item.size==null">
								<input class="text-xs-right small-number" type="number" step="0.1" ng-model="item.width">
							</td>
							<td ng-if="item.size==null">
								<i class="far fa-times tx-purple"></i>
							</td>
							<td ng-if="item.size==null">
								<input class="text-xs-right small-number" type="number" step="0.1" ng-model="item.length">
							</td>
							<td ng-if="item.size==null">
								cm
							</td>
						</tr>
					</tbody>
				</table>
			',
			'modalfooter' => '
				<button class="btn btn-success" ng-click="savenewjobsizes()">
					<i class="fas fa-save fa-fw"></i>
					Save
				</button>
				<button class="btn btn-primary pull-xs-left" ng-click="addnewjobsizerow()">
					<i class="fal fa-plus-hexagon fa-fw"></i>
					Plus New Row
				</button>
				<button class="btn btn-secondary" data-dismiss="modal">
					<i class="fal fa-times-octagon fa-fw"></i>
					Cancel
				</button>
			'
		]
	)

	@stop
</div>

