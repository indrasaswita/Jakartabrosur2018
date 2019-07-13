@extends('layouts.nofooter')
@section('title', 'Job Editor')
@section('content')

<div ng-controller="AdmJobeditorController">
@if(isset($jobsubtypes))
	@if($jobsubtypes != null)

		<?php
			$temp = str_replace(array('\r', '\"', '\n', '\''), '?', $jobsubtypes);
		?>

		@if(count($jobsubtypes) != 0)
	<div ng-init="initData('{{$temp}}')"></div>
		@endif
	@endif
@endif

	<div class="jobeditor-wrapper">
		<div class="page-title">
			<i class="fas fa-code"></i>
			JOB EDITOR 
			<i class="size-70p text-muted">ADMIN</i>
		</div>
		<table class="table table-sm">
			<tbody ng-repeat="item in jobsubtypes">
				<tr class="header">
					<td class="">
						<div class="pull-xs-left">
							[[item.name]] (<i class="tx-danger uppercase size-80p text-bold"> [[item.subname]] </i>)
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
				<tr class="edit" ng-if="item.editmode">
					<td class="">
						<div class="input-wrapper w16">
							<div class="label">Name <br>(INDO)</div>
							<input class="" ng-model="item.name">
						</div>
						<div class="input-wrapper w16">
							<div class="label">Sub-Name <br>(Nama Beken)</div>
							<input class="" ng-model="item.subname">
						</div>
						<div class="input-wrapper w16">
							<div class="label">Print Type <br><span class="tx-gray lowercase">(PR = Print, PL = Plotter, LL = Others)</span></div>
							<input class="" ng-model="item.printtype">
						</div>
						<div class="input-wrapper w16">
							<div class="label">Link<br>(URL)</div>
							<input class="" ng-model="item.link">
						</div>
						<div class="input-wrapper w16">
							<div class="label">DIGI-OFF <br><span class="tx-gray lowercase">(1:off, 2:digi, 0:off+digi)</span></div>
							<input class="" ng-model="item.digitaloffset">
						</div>
						<div class="input-wrapper w16">
							<div class="label">Satuan <br><span class="tx-gray lowercase">(lembar, pcs, box, buku, kartu)</span></div>
							<input class="" ng-model="item.satuan">
						</div>
						<div class="input-wrapper w25">
							<div class="label">Min Qty for Offset</div>
							<input class="right" type="number" min="0" ng-min="0" ng-model="item.minoffset">
						</div>
						<div class="input-wrapper w25">
							<div class="label">Max Qty for Offset</div>
							<input class="right" type="number" min="0" ng-min="0" ng-model="item.maxoffset">
						</div>
						<div class="input-wrapper w25">
							<div class="label">Step Qty for Offset</div>
							<input class="right" type="number" min="0" ng-min="0" ng-model="item.stepoffset">
						</div>
						<div class="input-wrapper w25">
							<div class="label">Qty Default for Offset</div>
							<input class="right" type="number" min="0" ng-min="0" ng-model="item.defaultoffset">
						</div>
						<div class="input-wrapper w25">
							<div class="label">Min Qty for Digital</div>
							<input class="right" type="number" min="0" ng-min="0" ng-model="item.mindigital">
						</div>
						<div class="input-wrapper w25">
							<div class="label">Max Qty for Digital</div>
							<input class="right" type="number" min="0" ng-min="0" ng-model="item.maxdigital">
						</div>
						<div class="input-wrapper w25">
							<div class="label">Step Qty for Digital</div>
							<input class="right" type="number" min="0" ng-min="0" ng-model="item.stepdigital">
						</div>
						<div class="input-wrapper w25">
							<div class="label">Qty Default for Digital</div>
							<input class="right" type="number" min="0" ng-min="0" ng-model="item.defaultdigital">
						</div>

						<div class="input-wrapper w100">
							<div class="label">Deskripsi JOB</div>
							<textarea class="size-90p" ng-model="item.description" rows="1"></textarea>
						</div>
						<div class="input-wrapper w50">
							<div class="label">Quantity Information and Help</div>
							<textarea ng-model="item.infoqty" rows="2" class="ta-small"></textarea>
						</div>
						<div class="input-wrapper w50">
							<div class="label">Ukuran Information and Help</div>
							<textarea ng-model="item.infosize" rows="2" class="ta-small"></textarea>
						</div>
						<div class="input-wrapper w50">
							<div class="label">Material Information and Help</div>
							<textarea ng-model="item.infomaterial" rows="2" class="ta-small"></textarea>
						</div>
						<div class="input-wrapper w50">
							<div class="label">Sisi Cetak Information and Help</div>
							<textarea ng-model="item.infosisicetak" rows="2" class="ta-small"></textarea>
						</div>
						<div class="input-wrapper w50">
							<div class="label">Warna Cetak Information and Help</div>
							<textarea ng-model="item.infowarnacetak" rows="2" class="ta-small"></textarea>
						</div>
						<div class="input-wrapper w50">
							<div class="label">Proses Information and Help</div>
							<textarea ng-model="item.infoproses" rows="2" class="ta-small"></textarea>
						</div>

						<div class="input-wrapper w50">
							<div class="label">Delivery Information and Help</div>
							<textarea ng-model="item.infodelivery" rows="2" class="ta-small"></textarea>
						</div>
						<div class="input-wrapper w50">
							<div class="label">Bungkus Information and Help</div>
							<textarea ng-model="item.infoperbungkus" rows="2" class="ta-small"></textarea>
						</div>
						<div class="input-wrapper w50">
							<div class="label">Reseller Information and Help</div>
							<textarea ng-model="item.inforeseller" rows="2" class="ta-small"></textarea>
						</div>
						<div class="input-wrapper w50">
							<div class="label">Sponsor Information and Help</div>
							<textarea ng-model="item.infosponsor" rows="2" class="ta-small"></textarea>
						</div>


						<div class="input-wrapper w20">
							<div class="label">Kode Qty Offset</div>
							<input class="right" type="number" min="0" ng-min="0" ng-model="item.qtyoffsettype">
						</div>
						<div class="input-wrapper w20">
							<div class="label">Kode Qty Digital</div>
							<input class="right" type="number" min="0" ng-min="0" ng-model="item.qtydigitaltype">
						</div>
						<div class="input-wrapper w20">
							<div class="label">
								Kode Ukuran<br>
								<i class="tx-gray uppercase size-80p text-bold"> 
									0: pilih+custom, 1: pilih, 2: custom
								</i>
							</div>
							<input class="right" type="number" min="0" ng-min="0" ng-model="item.sizetype">
						</div>
						<div class="input-wrapper w20">
							<div class="label">
							Sisi Cetak<br>
								<i class="tx-gray uppercase size-80p text-bold"> 
									0: pilih 1/2, 1: 1sisi, 2: 2sisi
								</i>
							</div>
							<input class="right" type="number" min="0" ng-min="0" ng-model="item.sizetype">
						</div>
						<div class="input-wrapper w20">
							<div class="label">
								Warna Cetak
								<i class="tx-gray uppercase size-80p text-bold"> 
									KELUPAAN DULU BUAT APA
								</i>
							</div>
							<input class="right" type="number" min="0" ng-min="0" ng-model="item.sizetype">
						</div>
						<div class="input-wrapper w25">
							<div class="label">
								Waktu Standar Offset
								<i class="tx-gray uppercase size-80p text-bold"> 
									DALAM HARI
								</i>
							</div>
							<input class="right" type="number" min="0" ng-min="0" ng-model="item.stdoffset">
						</div>
						<div class="input-wrapper w25">
							<div class="label">
								Waktu Express Offset
								<i class="tx-gray uppercase size-80p text-bold"> 
									DALAM HARI
								</i>
							</div>
							<input class="right" type="number" min="0" ng-min="0" ng-model="item.expoffset">
						</div>
						<div class="input-wrapper w25">
							<div class="label">
								Waktu Standar Digital
								<i class="tx-gray uppercase size-80p text-bold"> 
									DALAM HARI
								</i>
							</div>
							<input class="right" type="number" min="0" ng-min="0" ng-model="item.stddigital">
						</div>
						<div class="input-wrapper w25">
							<div class="label">
								Waktu Express Digital
								<i class="tx-gray uppercase size-80p text-bold"> 
									DALAM HARI
								</i>
							</div>
							<input class="right" type="number" min="0" ng-min="0" ng-model="item.expdigital">
						</div>

						<div class="input-wrapper w25">
							<div class="label">
								Numerator
								<i class="tx-gray uppercase size-80p text-bold"> 
									1: YES, 0: NO
								</i>
							</div>
							<input class="right" type="number" min="0" ng-min="0" ng-model="item.numerator">
						</div>
						<div class="input-wrapper w25">
							<div class="label">
								ID Card
								<i class="tx-gray uppercase size-80p text-bold"> 
									1: YES, 0: NO
								</i>
							</div>
							<input class="right" type="number" min="0" ng-min="0" ng-model="item.idcard">
						</div>
						<div class="input-wrapper w25">
							<div class="label">
								Rangkap
								<i class="tx-gray uppercase size-80p text-bold"> 
									1: YES, 0: NO
								</i>
							</div>
							<input class="right" type="number" min="0" ng-min="0" ng-model="item.rangkap">
						</div>
						<div class="input-wrapper w25">
							<div class="label">
								Aktif (Untuk Disable Menu)
								<i class="tx-gray uppercase size-80p text-bold"> 
									1: YES, 0: NO
								</i>
							</div>
							<input class="right" type="number" min="0" ng-min="0" ng-model="item.active">
						</div>


						<div class="input-wrapper w20">
							<div class="label">
								lokasi ICON
							</div>
							<input class="right size-90p" type="text" ng-model="item.icon">
						</div>
						<div class="input-wrapper w20">
							<div class="label">
								Mini Icon 1
							</div>
							<input class="right size-90p" type="text" ng-model="item.sicon1">
						</div>
						<div class="input-wrapper w20">
							<div class="label">
								Mini Icon 2
							</div>
							<input class="right size-90p" type="text" ng-model="item.sicon2">
						</div>
						<div class="input-wrapper w20">
							<div class="label">
								Printer OFFSET ID
							</div>
							<input class="right" type="number" min="0" ng-min="0" ng-model="item.printerIDoffset">
						</div>
						<div class="input-wrapper w20">
							<div class="label">
								Printer DIGITAL ID
							</div>
							<input class="right" type="number" min="0" ng-min="0" ng-model="item.printerIDdigital">
						</div>


						<div class="input-wrapper w100 text-xs-center margin-top-10" ng-if="item.saveerror.length>0">
							<b class="tx-primary">
								Result: [[item.saveerror]]
							</b>
						</div>
						<div class="input-wrapper w100 text-xs-right padding-10">
							<button class="btn btn-success" ng-click="saveitem($index, item)" ng-if="item.editmode&&!saving">
								<i class="fas fa-save fa-fw"></i> Save
							</button>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>

</div>

@stop