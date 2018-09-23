@extends('layouts.container')
@section('title', 'Ulas Detail Cetakan')
@section('content')


<div ng-controller="SalesCommitController">

@if(isset($salesdetail))
	@if($salesdetail != null)

		<?php
			$temp = str_replace(array('\r', '\"', '\n', '\''), '?', $salesdetail);
		?>

	<div ng-init="initData('{{$temp}}')"></div>
	@endif
@endif

	<div ng-if="salesdetail!=null">
		<div class="size-16 margin-10-0">
			<small class="fas fa-search tx-lightgray"></small> Review Cetakan (sebelum naik cetak)
		</div>

		<div class="frame frame-right frame-text-left">
			<div class="title">
				[[salesdetail.cartheader.jobsubtype.name]]
			</div>
			<div class="detail">
				<div class="title">
					[[salesdetail.cartheader.jobtitle]]
				</div>
				<div class="content">
					<div class="header-wrapper">
						<div class="image">
							<div class="list">
								<a href="">
									<img ng-src="{{URL::asset('images/original/img20170619101804622.jpg')}}" />
								</a>
							</div>
						</div>
						<div class="header">
							<div class="list">
								<i>total</i> [[salesdetail.cartheader.quantity]] [[salesdetail.cartheader.quantitytypename]] 
							</div>
							<div class="list">
								<i>harga</i> [[salesdetail.cartheader.printprice|number:0]]<span class="tx-red" ng-if="salesdetail.cartheader.discount>0"> - [[salesdetail.cartheader.discount|number:0]]</span><span class="tx-gray" ng-if="salesdetail.cartheader.deliveryprice>0"> + [[salesdetail.cartheader.deliveryprice|number:0]]</span> 
							</div>
							<div class="list">
								<i>belanja</i> [[(salesdetail.cartheader.printprice-salesdetail.cartheader.discount+salesdetail.cartheader.deliveryprice)|number:0]]
							</div>
							<div class="list" ng-if="salesdetail.cartheader.itemdescription.length>3">
								<i>keterangan</i> [[salesdetail.cartheader.itemdescription]]
							</div>
							<div class="list" ng-if="salesdetail.cartheader.customernote.length>3">
								<i>catatan</i> [[salesdetail.cartheader.customernote]]
							</div>
						</div>
					</div>
					<div class="detail">
						<table class="table table-sm">
							<thead>
								<tr>
									<th class="text-center" colspan="2">Detail Cetakan</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="item in salesdetail.cartheader.cartdetail">
									<td>
										<div class="line-12">
											[[item.jobtype]]-[[item.cartname]]
											<br>
											[[item.paper.name]] <i>[[item.paper.color]]</i> [[item.paper.gramature]]g
											<br>
											[[item.imagewidth|number:1]] x [[item.imagelength|number:1]] cm
											<br>
											<span ng-if="item.side2!=0">
												2 sisi ([[item.side1]] warna / [[item.side2]] warna)
											</span>
											<span ng-if="item.side2==0">
												1 sisi ([[item.side1]] warna)
											</span>
										</div>
									</td>
									<td>
										<div class="line-12">
											<div ng-repeat="detailfinishing in item.cartdetailfinishing">
												[[detailfinishing.finishing.name]]
												<span class="tx-lightgray" data-toggle="tooltip" data-html="true" data-title="[[detailfinishing.finishing.info]]"><i class="fas fa-info-circle"></i></span>:
												[[detailfinishing.finishingoption.optionname]] 
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>

						<table class="table table-sm">
							<thead>
								<tr>
									<th class="text-center" colspan="10">Detail File (yg d upload)</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="cartfile in salesdetail.cartheader.cartfile">
									<td class="width-min">
										<img ng-src="{{URL::asset('[[cartfile.file.icon]]')}}" />
									</td>
									<td class="line-12">
										[[cartfile.file.filename]]<br>
										<small class="fas fa-compact-disc tx-gray"></small>
										[[(cartfile.file.size/1024)|number:0]]KB<br>
										Ext.: [[cartfile.file.path.split('.').pop().toUpperCase()]]<br>
										cr. [[cartfile.created_at|date:'MMM d, yyyy HH:mm']]
									</td>
								</tr>
							</tbody>
						</table>
						<table class="table table-sm">
							<thead>
								<tr>
									<th class="text-center" colspan="10">Proof File</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="cartpreview in salesdetail.cartheader.cartpreview">
									<td class="width-min">
										<img ng-src="{{URL::asset('[[cartpreview.file.icon]]')}}" />
									</td>
									<td class="line-12">
										[[cartpreview.file.filename]]<br>
										<small class="fas fa-compact-disc tx-gray"></small>
										[[(cartpreview.file.size/1024)|number:0]]KB<br>
										Ext.: <b>[[cartpreview.file.path.split('.').pop().toUpperCase()]]</b><br>
										<a class="a-purple a-noline" href="" ng-click="preview(cartpreview.file.filename, cartpreview.file.path)">
											<i class="fas fa-search"></i> Preview
										</a>
									</td>
									<td class="width-min text-xs-center">
										<div ng-if="cartpreview.waiting">
											<i class="fas fa-spinner fa-pulse tx-primary fa-3x"></i>
										</div>
										<div class="btn-group-vertical" ng-if="cartpreview.commit==0&&!cartpreview.waiting">
											<button class="btn btn-secondary btn-sm btn-outline-success" ng-click="acceptFile(cartpreview)" ng-if="salesdetail.commited==0">Accept</button>
											<button class="btn btn-secondary btn-sm btn-outline-danger" ng-click="rejectFile(cartpreview)" ng-if="salesdetail.commited==0">Reject</button>
										</div>
										<div class="btn-group-vertical" ng-if="(cartpreview.commit==1||cartpreview.commit==-1)&&!cartpreview.waiting">
											<div class="tx-gray size-90p" ng-if="cartpreview.commit==-1">
												<i class="fas fa-ban tx-danger fa-2x"></i>
												REJECTED
											</div>
											<div class="tx-gray size-90p" ng-if="cartpreview.commit==1">
												<i class="fas fa-2x fa-check-circle tx-success"></i>
												ACCEPTED
											</div>
											<button class="btn btn-secondary btn-sm btn-outline-danger size-70p" ng-click="undoFile(cartpreview)" ng-if="salesdetail.commited==0">
												<small class="fas fa-history"></small>
												<b>UNDO</b>
											</button>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="alert alert-sm alert-warning margin-10-0 text-xs-center">
			<div class="margin-5-0" ng-class="{'tx-success':canbecommit()}" ng-if="salesdetail.commited==0">
				<i class="far fa-check-circle tx-lightgray"></i>
				<span ng-if="!canbecommit()">
					Anda harus menyetujui semua file preview (PROOF FILE) yang tertera di atas.
				</span>
				<span ng-if="canbecommit()">
					Klik 'Commit!' untuk menyetujui hasil proof, dan siap dicetak sesuai file.<br>Dengan menyetujui hasil proof, maka tidak dapat merubah file lagi.
				</span>
			</div>
			<div class="" ng-if="salesdetail.commited==0">
				<button class="btn" ng-class="{'btn-outline-primary':canbecommit(), 'btn-secondary':!canbecommit()}" ng-disabled="!canbecommit()" ng-if="!commitloading && salesdetail.commited==0" ng-click="commit()">
					Commit!
				</button>
				<i class="fas fa-pulse fa-spinner fa-3x tx-primary" ng-if="commitloading"></i>
			</div>
			<div class="" ng-if="salesdetail.commited==1">
				<div class="size-120p">
					<i class="fas fa-check-circle"></i>
					File Proved!
				</div>
				<div class="size-90p">
					Telah disetujui sebelumnya, tidak bisa diubah lagi.<br>Info lebih lanjut dapat menghubungi kami di 0859-5971-7175.
				</div>
				<div class="margin-5-0">
					<a class="btn btn-outline-warning" href="{{URL::asset('sales/all')}}">
						Kembali ke data Pembelian
					</a>
					<!-- <button class="btn btn-outline-warning" href="{{URL::asset('sales/all')}}" ng-click="undocommit()" ng-disabled="commitloading">
						<i class="fas fa-undo" ng-if="!commitloading"></i>
						<i class="fas fa-pulse fa-spinner" ng-if="commitloading"></i>
					</button> -->
				</div>
			</div>
		</div>
	</div>

	@include('pages.order.sales.modals.previewfile')

</div>


@stop