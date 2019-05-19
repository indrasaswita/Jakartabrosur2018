@extends('layouts.nofooter')
@section('title', 'Ganti Harga Jual')
@section('content')

<div ng-controller="AdmShoppricingController">
<?php
	$constants_t = str_replace(array('\r', '\"', '\n', '\''), '?', $constants);
	$finishings_t = str_replace(array('\r', '\"', '\n', '\''), '?', $finishings);
?>

@if(isset($constants) && isset($finishings))
	@if($constants != null && $finishings != null)
		@if(count($constants) != 0 && count($finishings) != 0)
	<div ng-init="initData('{{$constants_t}}', '{{$finishings_t}}')"></div>
		@endif
	@endif
@endif

	<div class="page-title">
		GANTI HARGA JOB DISINI [ADMIN]
	</div>

	<div ng-if="finishings!=null&&finishings.length>0">
		<ul class="nav nav-tabs shoppricing-tab">
		  <li class="nav-item">
		    <a class="nav-link active" data-toggle="tab" href="#finishing">Finishings</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" data-toggle="tab" href="#constant">Constants</a>
		  </li>
		</ul>

		<div class="tab-content">
			<div class="shoppricing-wrapper tab-pane fade in active" id="finishing">

				<div class="finishings-header">
					<button class="btn prev" ng-click="prevjob()">
						<i class="fas fa-angle-double-left fa-fw"></i>
					</button>
					<div class="content">
						<div class="list" ng-repeat="item in finishings" ng-class="{'selected':$index==finishingindex}">
							[[item.name]]
							( <b>[[finishingindex+1]]</b> / [[finishings.length]] )
						</div>
					</div>
					<button class="btn next" ng-click="nextjob()">
						<i class="fas fa-angle-double-right fa-fw"></i>
					</button>
				</div>	

				<div class="finishings-detail display-flex">
					<div class="detail-input">
						<div class="pretext">
							Nama beken, yang muncul di nota dan web
						</div>
						<input class="input" ng-model="finishings[finishingindex].shortname">
					</div>

					<div class="detail-input">
						<div class="pretext">
							Nama yang keluar di rahayu
						</div>
						<input class="input" ng-model="finishings[finishingindex].name">
					</div>
				</div>
				<div class="finishings-detail">
					<div class="detail-input">
						<div class="pretext">
							Sisi Cetak
						</div>
						<select ng-options="item.value as item.label for item in finishingside" ng-model="finishings[finishingindex].side">
						</select>
					</div>
				</div>
				<div class="finishings-detail display-flex">
					<div class="detail-input">
						<div class="pretext">
							Status (Boleh dishow, atau enggak)
						</div>
						<div class="detail-status">
							Status: &nbsp;
							<div data-toggle="tooltip" data-title="Klik untuk non-active">
								<a href="" ng-if="finishings[finishingindex].status==1"ng-click="togglestatus()">
									<i class="fas fa-toggle-on tx-success fa-fw"></i> 
									ACTIVE
								</a>
							</div>
							<div data-toggle="tooltip" data-title="Klik untuk active">
								<a href="" ng-if="finishings[finishingindex].status==0" ng-click="togglestatus()">
									<i class="fas fa-toggle-off tx-red fa-fw"></i> 
									Non-ACTIVE
								</a>
							</div>
						</div>
					</div>
					<div class="detail-input">
						<div class="pretext">
							INFO yg di show di customer shop <br>
							<i class="fas fa-exclamation-circle tx-info"></i> <i>Bisa taro tag HTML disini</i>
						</div>
						<textarea class="input size-80p" ng-model="finishings[finishingindex].info" rows="4">
						</textarea>
					</div>
				</div>
				<div class="finishings-detail">
					<table class="table table-sm">
						<thead>
							<tr class="text-center">
								<th class="width-min">#</th>
								<th>Name</th>
								<th>Satuan</th>
								<th>Per-</th>
								<th>Min.</th>
								<th>Base</th>
								<th>Wkt</th>
							</tr>
						</thead>
						<tbody ng-repeat="item in finishings[finishingindex].finishingoption">
							<tr class="text-xs-center">
								<td class="text-xs-center">[[$index+1]].</td>
								<td>
									<input class="input" type="text" ng-model="item.optionname">
								</td>
								<td>
										Rp 
										<input class="input input-sm" type="number" step=".001" ng-step=".001" min="0" ng-min="0" ng-model="item.price">
								</td>
								<td>
									<select ng-options="item.value as item.value for item in priceper" ng-model="item.priceper"></select>
								</td>
								<td>
									Rp 	
									<input class="input input-sm" type="number" ng-model="item.priceminim">
								</td>
								<td>
									Rp
									<input class="input input-sm" type="number" ng-model="item.pricebase">
								</td>
								<td>
									<input class="input input-xs" type="number" step="1" ng-step="1" ng-model="item.processdays"> days
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="finishings-detail margin-20-0">
					<button class="btn btn-purple" ng-click="showdialog()">
						<i class="fas fa-save fa-fw"></i>
						Save untuk perubahan di <span class="uppercase"><u>[[finishings[finishingindex].name]]</u></span>
					</button>
				</div>
			</div>

			<div class="shoppricing-wrapper tab-pane fade in" id="constant">

				<div class="finishings-header">
					<button class="btn prev tx-transparent" ng-click="prevjob()">
						<i class="fas fa-angle-double-left fa-fw"></i>
					</button>
					<div class="content">
						<div class="list selected">
							Anda dapat mengganti data konstanta untuk perhitungan
						</div>
					</div>
					<button class="btn next tx-transparent" ng-click="nextjob()">
						<i class="fas fa-angle-double-right fa-fw"></i>
					</button>
				</div>	


				<div class="finishings-detail margin-20-0">
					<button class="btn btn-sm btn-purple" ng-click="showdialogaddconstant()"disabled>
						<i class="fas fa-plus fa-fw"></i> Tambah baru konstanta
					</button>
				</div>

				
				<div class="finishings-detail">
					<table class="table table-sm">
						<thead>
							<tr class="text-center">
								<th class="width-min">#</th>
								<th>Type</th>
								<th>Constants</th>
								<th>Desc.</th>
								<th>Price</th>
							</tr>
						</thead>
						<tbody ng-repeat="item in constants">
							<tr class="text-xs-center">
								<td class="width-min">[[$index+1]].</td>
								<td>
									<select></select>
								</td>
								<td>
									<input class="input" type="text" ng-model="item.name">
								</td>
								<td>
									<!-- <input class="input" type="text" ng-model="item.description"> -->
								</td>
								<td>
									Rp 
									<input class="input input-sm" type="number" step=".001" ng-step=".001" min="0" ng-min="0" ng-model="item.price">
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="finishings-detail margin-20-0">
					<button class="btn btn-purple" ng-click="showdialogconstant()">
						<i class="fas fa-save fa-fw"></i>
						Save untuk perubahan di KONSTANT
					</button>
				</div>
			</div>
		</div>
	</div>


	@include('modal', [
		'modalid'=>'savefinishingconfirm',
		'modaltitle'=>'Yakin mau Update?',
		'modalbody'=>'
			Yang anda update adalah <b>[[(finishings[finishingindex].name)]]</b>.<br>
			<div class="line-11 size-80p">
				Segala perubahan pada tab [[(finishings[finishingindex].name)]] akan seluruhnya diupdate pada server.<br>Pastikan datanya diubah dengan benar.
			</div>
		',
		'modalfooter'=>'
			<button class="btn btn-purple" ng-click="save()">
				Save
			</button>
			<button class="btn btn-secondary" data-dismiss="modal">
				Cancel
			</button>
		'
	])

	@include('modal', [
		'modalid'=>'saveconstantconfirm',
		'modaltitle'=>'Update constants',
		'modalbody'=>'
			Ganti Constant = Ganti seluruh hitungan<br>
			<div class="line-11 size-80p">
				Segala perubahan pada tab Constant akan seluruhnya diupdate pada server.<br>Pastikan datanya diubah dengan benar.
			</div>
		',
		'modalfooter'=>'
			<button class="btn btn-purple" ng-click="saveconstant()">
				Save
			</button>
			<button class="btn btn-secondary" data-dismiss="modal">
				Cancel
			</button>
		'
	])

	@include('modal', [
		'modalid'=>'addnewconstant',
		'modaltitle'=>'Update constants',
		'modalbody'=>'
			<div class="">
				<input class="form-control" type="text" ng-model="newconstant.name" placeholder="Nama Constant">
				<input class="form-control" type="number" ng-model="newconstant.price" placeholder="Harga [ Rp ]">
			</div>
		',
		'modalfooter'=>'
			<button class="btn btn-purple" ng-click="insertconstant()">
				Save
			</button>
			<button class="btn btn-secondary" data-dismiss="modal">
				Cancel
			</button>
		'
	])


</div>

@stop