@extends('layouts.container')
@section('title', 'Job Finishing Manager')
@section('content')


<div ng-controller="AdmJobfinishingsController">
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

	<div class="jobfinishings-wrapper">
		<div class="page-title">
			<i class="fas fa-code"></i>
			JOB FINISHING MANAGER 
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
								<div class="" ng-if="item2.digitaloffset==0">
									<span class="tx-primary">
										<i class="fas fa-print"></i> <b>OF</b>([[item2.totalOF]])
									</span>
									<span class="tx-lightmagenta">
										<i class="fas fa-print"></i> <b>DG</b>([[item2.totalDG]])
									</span>
								</div>
								<div class="" ng-if="item2.digitaloffset==1">
									<span class="tx-primary">
										<i class="fas fa-print"></i> <b>OF</b>([[item2.totalOF]])
									</span>
									<span class="tx-transparent">
										<i class="fas fa-print"></i> <b>DG</b>([[item2.totalDG]])
									</span>
								</div>
								<div class="" ng-if="item2.digitaloffset==2">
									<span class="tx-transparent">
										<i class="fas fa-print"></i> <b>OF</b>([[item2.totalOF]])
									</span>
									<span class="tx-lightmagenta">
										<i class="fas fa-print"></i> <b>DG</b>([[item2.totalDG]])
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
											[[item2.jobsubtypefinishing.length]]
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
						<tr class="finishings" ng-if="item2.editmode">
							<td colspan="10">
								<div class="edit">
									<table class="table table-sm">
										<tbody ng-repeat="item3 in item2.jobsubtypefinishing">
											<tr>
												<td>
													#[[zeroFill(item.id, 2)]].[[zeroFill(item2.id, 2)]].[[zeroFill(item3.finishing.id, 3)]] 

													<span class="size-80p uppercase tx-primary" ng-if="item3.ofdg==1">
														<i class="fas fa-print"></i>
														<b>OF</b>
													</span>
													<span class="size-80p uppercase tx-lightmagenta" ng-if="item3.ofdg==2">
														<i class="fas fa-print"></i>
														<b>DG</b>
													</span>

													[[item3.finishing.name]] 
													<span class="uppercase tx-danger size-70p">
														<i><b>( [[item3.finishing.shortname]] )</b></i>
													</span>
												</td>
												<td class="width-min">
													<div ng-if="item3.finishing.status" data-toggle="tooltip" data-title="activated" tooltip>
														<i class="fas fa-circle tx-success">
														</i>
													</div>
													<div ng-if="!item3.finishing.status" data-toggle="tooltip" data-title="not activated" tooltip>
														<i class="fas fa-circle tx-danger">
														</i>
													</div>
												</td>
												<td class="width-min">
													<a href="" ng-click="changemustdo(item3.id, item3)">
														<div ng-if="item3.mustdo" data-toggle="tooltip" data-title="wajib dilakukan" tooltip>
															<i class="fas fa-scroll-old tx-success">
															</i>
														</div>
														<div ng-if="!item3.mustdo" data-toggle="tooltip" data-title="tidak wajib dilakukan" tooltip>
															<i class="fas fa-scroll-old tx-danger">
															</i>
														</div>
													</a>
												</td>
												<td>
													<button class="btn btn-xsm btn-secondary" ng-click="showoptions_clicked(item3)">
														<span class="size-90p">
															[[item3.finishing.finishingoption.length]]
															<i class="fas fa-chevron-down size-80p"></i>
														</span>
													</button>
												</td>
												<td>
													<div class="pull-xs-right">
														<a href="" class="delete-link">
															<i class="fas fa-trash tx-danger size-80p"></i> 
															delete
														</a>
													</div>
												</td>
											</tr>
											<tr class="options" ng-if="item3.showoptions">
												<td colspan="10">
													<ul>
														<li ng-repeat="item4 in item3.finishing.finishingoption">
															[[item4.optionname]] <i class="fas fa-quote-left tx-yellow fa-fw"></i>
																(
																<b>
																	<a href="" ng-click="changepricebase(item4)" ng-if="!item4.pricebaseinput">
																		Rp [[item4.pricebase|number:0]]
																	</a>
																	<span ng-if="item4.pricebaseinput">
																		<input type="number" ng-model="item4.newpricebase">
																		<button class="btn btn-xsm btn-success" ng-click="savepricebase(item4)">
																			<i class="fas fa-check size-80p"></i>
																		</button>
																	</span>
																</b>
																+ 
																<b>
																	<a href="" ng-click="changeprice(item4)" ng-if="!item4.priceinput">
																		@[[item4.price|number:2]]
																	</a>
																	<span ng-if="item4.priceinput">
																		<input type="number" ng-model="item4.newprice">
																		<button class="btn btn-xsm btn-success" ng-click="saveprice(item4)">
																			<i class="fas fa-check size-80p"></i>
																		</button>
																	</span>
																</b> 
																) or
																<span class="tx-primary">
																min. 
																<b>
																	<a href="" ng-click="changepriceminim(item4)" ng-if="!item4.priceminiminput">
																		Rp [[item4.priceminim|number:0]]
																	</a>
																	<span ng-if="item4.priceminiminput">
																		<input type="number" ng-model="item4.newpriceminim">
																		<button class="btn btn-xsm btn-success" ng-click="savepriceminim(item4)">
																			<i class="fas fa-check size-80p"></i>
																		</button>
																	</span>
																</b> 
															</span>
														</li>
													</ul>
													<div class="actions">
														<button class="btn btn-sm btn-secondary">
															<i class="fas fa-plus size-80p"></i>
															Tambah <b class="size-90p">PILIHAN FINISHING (pada [[item3.finishing.name]])</b>
														</button>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
									<div class="actions">
										<button class="btn btn-sm btn-secondary" ng-click="tambahfinishing(item2.id)">
											<i class="fas fa-plus size-80p"></i>&nbsp;
											Tambah <b class="size-90p">FINISHING</b> (pada <b>[[item2.name]]</b>)
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

@include('modal', [
'modalid' => 'addnewfinishing',
'modaltitle' => 'New Finishing',
'modalbody'=>'
 <table class="table table-sm">
 	<thead>
 		<tr class="text-center">
 			<th class="width-min">Tipe</th>
 			<th class="width-min">Wajib</th>
 			<th>Jenis Finishing</th>
 			<th>Jobsubtype</th>
 			<th>Finishingoption</th>
 		</tr>
 	</thead>
 	<tbody>
 		<tr class="text-center">
 			<td class="width-min">
 				<a ng-model="newfinishing.ofdg" ng-click="ofdgchange(newfinishing.ofdg)">
 					<span class="tx-primary" ng-if="newfinishing.ofdg" data-title="OF" data-toggle="tooltip" tooltip>
 						<i class="fas fa-print fa-fw"></i> <b>
 					</span>
 					<span class="tx-lightmagenta" ng-if="!newfinishing.ofdg" data-title="DG" data-toggle="tooltip" tooltip>
 						<i class="fas fa-print fa-fw"></i> <b>
 					</span>
 				</a>
 			</td>
 			<td class="width-min">
 				<a ng-click="mustdoclick(newfinishing.mustdo)" ng-model="newfinishing.mustdo">
						<span ng-if="newfinishing.mustdo" data-title="wajib" data-toggle="tooltip" tooltip>
								<i class="fas fa-scroll-old tx-success">
								</i>
							</span>
							<span ng-if="!newfinishing.mustdo" data-title="tidak wajib" data-toggle="tooltip" tooltip>
								<i class="fas fa-scroll-old tx-danger">
								</i>
							</span>
						</a>
 			</td>
 			<td>
 				<select ng-model="newfinishing.finishingID" ng-options="item as item.name for item in finishing" ng-change="changefinishing(newfinishing.finishingID.id)"></select>
 			</td>
 			<td>
 				<ul>
 					<li ng-repeat="item2 in jobsubtype.jobsubtypes">
 						[[item2.jobsubtype.name]]
 					</li>
 				</ul>
 			</td>
 			<td>
 				<ul>
 					<li ng-repeat="item3 in finishingoptions">
 						[[item3.optionname]]
 					</li>
 				</ul>
 			</td>
 		</tr>
 	</tbody>
 </table>
',
'modalfooter'=>'
	<button class="btn btn-success" ng-click="savenewfinishing()">
		<i class="far fa-save fa-fw"></i> Save
</button>
<button class="btn btn-secondary" ng-click="cancelnewfinishing()">
	<i class="fal fa-times-octagon fa-fw"></i> Cancel
</button>
'])
</div>

@stop