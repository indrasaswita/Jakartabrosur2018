@extends('layouts.container')
@section('title', 'Job Paper Manager')
@section('content')


<div ng-controller="AdmJobpapersController">
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

	<div class="jobpapers-wrapper">
		<div class="page-title">
			<i class="fas fa-code"></i>
			JOB PAPER MANAGER 
			<i class="size-70p text-muted">ADMIN</i>
		</div>
		<ul class="list">
			<li ng-repeat="item in jobtypes" ng-if="$index==activejobtype">
				<div class="list-title">
					<div class="prev">
						<button class="btn btn-sm btn-secondary height-100" ng-click="prevlist()">
							<i class="fas fa-angle-double-left tx-warning"></i>
						</button>
					</div>
					<div class="core line-1">
						<span class="text-bold tx-gray" data-toggle="tooltip" data-placement="top" data-title="#JobtypeID">
							<i class="fas fa-hashtag size-80p"></i>[[zeroFill(item.id, 2)]]
						</span>
						<b>
							[[item.name]]
						</b>
						<br>
						<i class="tx-danger uppercase size-80p text-bold"> 
							[[item.indoname]] 
						</i>
						<br>
						<b class="size-80p">
							<i class="far fa-chevron-double-left tx-lightgray"></i>
							<span class="googleft">
								<span class="tx-purple">
									[[$index+1]]
								</span>
								<span class="tx-gray">
									/ [[jobtypes.length]]
								</span>
							</span>
							<i class="far fa-chevron-double-right tx-lightgray"></i>
						</b>
					</div>
					<div class="next">
						<button class="btn btn-sm btn-secondary height-100" ng-click="nextlist()">
							<i class="fas fa-angle-double-right tx-warning"></i>
						</button>
					</div>
				</div>
				<table class="table-sm">
					<tbody ng-repeat="item2 in item.jobsubtype">
						<tr>
							<!-- <td class="width-min">
								<i class="fas fa-chevron-right tx-lightgray"></i>
							</td> -->
							<td class="width-min">
								<b class="tx-gray" data-toggle="tooltip" data-placement="top" data-title="#JobtypeID.JobsubtypeID">
									#[[zeroFill(item.id, 2)]].[[zeroFill(item2.id, 2)]]
								</b>
							</td>
							<td class="">
								[[item2.name]] 
									<small class='uppercase'>
										<b>(<span class="tx-danger">[[item2.subname]]</span>)</b>
									</small>
							</td>
							<td hidden>
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
								<div class="pull-xs-right">
									<button class="btn btn-xsm btn-secondary" href="" ng-click="toggleedit(item2)" ng-if="!item2.editmode">
										<span class="size-90p">
											<span class="tx-purple" ng-if="item2.totalOF>0">[[item2.totalOF]]<small class="tx-gray">OF</small></span><span ng-if="item2.totalDG>0"><small ng-if="item2.totalOF>0">+</small><span  class="tx-purple">[[item2.totalDG]]</span><small class="tx-gray">DG</small></span><small ng-if="item2.jobsubtypepaper.length>0">=</small><span class="tx-purple">[[item2.jobsubtypepaper.length]]</span>
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
							<td class="width-min">
								<div class="" ng-if="item2.active==0" data-toggle="tooltip" data-title="not activated" tooltip>
									<i class="fas fa-circle tx-red"></i>
								</div>
								<div class="" ng-if="item2.active==1" data-toggle="tooltip" data-title="activated" tooltip>
									<i class="fas fa-circle tx-success"></i>
								</div>
							</td>
						</tr>
						<tr class="papers" ng-if="item2.editmode">
							<td colspan="10">
								<div class="edit">
									<table class="table table-sm">
										<tbody ng-repeat="item3 in item2.jobsubtypepaper">
											<tr>
												<td class="width-min">
													<a href="" class="fav-link" ng-click="changefavourite(item3.id, item3)">
														<i class="fas fa-star tx-orange" ng-if="item3.favourite"></i>
													</a>
													<a href="" class="fav-link" ng-click="changefavourite(item3.id, item3)">
														<i class="fal fa-star tx-darkgray" ng-if="!item3.favourite"></i>
													</a>
												</td>
												<td>
													<span class="text-bold tx-gray" data-toggle="tooltip" data-placement="top" data-title="#JobtypeID.JobsubtypeID.PaperID">
														#[[zeroFill(item.id, 2)]].[[zeroFill(item2.id, 2)]].[[zeroFill(item3.paper.id, 3)]]
													</span>
													&nbsp;
													<span class="size-80p uppercase tx-primary" ng-if="item3.ofdg==1">
														<i class="fas fa-print"></i>
														<b>OF</b>
													</span>
													<span class="size-80p uppercase tx-lightmagenta" ng-if="item3.ofdg==2">
														<i class="fas fa-print"></i>
														<b>DG</b>
													</span>
													&nbsp;
													[[item3.paper.name]] <span class="text-bold size-80p uppercase tx-purple">[[item3.paper.color]]</span> 
													<span class="tx-danger size-80p">
														<b>[[item3.paper.gramature]]</b><span class="tx-lightgray">g</span>
													</span>
												</td>
												<td class="size-70p text-xs-center">
													<a href="" ng-click="changecoatclicked(item3.paper)">
														<span class="" ng-bind-html="item3.paper.coatingtype.info"></span>
														#[[zeroFill(item3.paper.coatingtypeID, 2)]]
													</a>
												</td>
												<td>
													<div class="pull-xs-right">
														<a href="" class="delete-link" ng-click="removejobpaper(item2, item3, $index)">
															<i class="fas fa-trash tx-danger size-80p"></i> 
															delete
														</a>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
									<div class="actions">
										<button class="btn btn-sm btn-secondary" ng-click="addnewpaper(item2)">
											<i class="fas fa-plus size-80p"></i>&nbsp;
											Tambah <b class="size-90p">KERTAS</b> (pada <b>[[item2.name]]</b>)
										</button>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</li>
		</ul>

	@include ('modal', [
		'modalid'=>'paperchangecoat',
		'modaltitle'=>'Ubah tipe dan sifat kertas..',
		'modalbody'=>'
			Ubah Tipe dan Sifat kertas untuk,<br>

			ID Kertas: #[[zeroFill(selectedpaper.id,3)]].<br>
			Kertas: [[selectedpaper.name]] [[selectedpaper.color]] <b>[[selectedpaper.gramature]]</b>g<br>
			Type: [[selectedpaper.papertype.name]]<br>

			<div class="text-xs-center width-100 margin-10-0">
				<select class="form-control" ng-options="item.id as item.name for item in coatingtypes" ng-model="selectedcoatid"></select>
			</div>
		',
		'modalfooter'=>'
			<button class="btn btn-sm btn-success" ng-click="changecoatsave()">
				Save
			</button>
		',
	])

	@include ('modal', [
		'modalid'=>'addpaper',
		'modaltitle'=>'Tambah kertas',
		'modalbody'=>'
			Tambah kertas untuk Job,<br>

			ID Kertas: #[[zeroFill(selectedjobsubtype.id,3)]].<br>
			Kertas: [[selectedjobsubtype.name]] / [[selectedjobsubtype.subname]] [<i>link: <b>[[selectedjobsubtype.link]]</b></i>]<br>
			Type: [[jobtypes[activejobtype].name]] / [[jobtypes[activejobtype].indoname]]<br>

			<br>
			<br>
			<button class="btn btn-sm btn-purple" ng-click="unselectall()">
				Unselect All
			</button>
			<br>
			<br>

			<div class="display-flex">
				<table class="table table-sm width-50 margin-0">
					<thead>
						<tr>
							<th class="text-xs-center" colspan="2">
								OFFSET
							</th>
						</tr>
					</thead>
					<tbody ng-repeat="item in newpapersOF">
						<tr>
							<td><b>[[item.name]]</b> [[item.color]] [[item.gramature]]g</td>
							<td class="text-xs-right">
								<button class="btn btn-xsm btn-secondary" ng-click="addjobpaperOF(item)" ng-if="!item.deleteflagOF">
									<i class="fas fa-spinner fa-spin" ng-if="item.addflagOF"></i>
									<span ng-if="!item.addflagOF">Add</span>
								</button>
								<span class="tx-red size-70p" ng-if="item.deleteflagOF">
									Added!
								</span>
							</td>
						</tr>
					</tbody>
				</table>
				<table class="table table-sm width-50 margin-0">
					<thead>
						<tr>
							<th class="text-xs-center" colspan="2">
								DIGITAL
							</th>
						</tr>
					</thead>
					<tbody ng-repeat="item in newpapersDG">
						<tr>
							<td><b>[[item.name]]</b> [[item.color]] [[item.gramature]]g</td>
							<td class="text-xs-right">
								<button class="btn btn-xsm btn-secondary" ng-click="addjobpaperDG(item)" ng-if="!item.deleteflagDG">
									<i class="fas fa-spinner fa-spin" ng-if="item.addflagDG"></i>
									<span ng-if="!item.addflagDG">Add</span>
								</button>
								<span class="tx-red size-70p" ng-if="item.deleteflagDG">
									Added!
								</span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		',
		'modalfooter'=>'
			<button class="btn btn-sm btn-success" ng-click="addjobpaperAll()">
				Save
			</button>
		',
	])
	</div>

</div>

@stop