@extends('layouts.nofooter')
@section('title', 'Detail Pelanggan | Admin')
@section('content')

<div ng-controller="AdmCustomerController">
@if(isset($customers))
	@if($customers != null)

		<?php
			$temp = str_replace(array('\r', '\"', '\n', '\''), '?', $customers);
		?>

		@if(count($customers) != 0)
	<div ng-init="initData('{{$temp}}')"></div>
		@endif
	@endif
@endif

	<div class="">
		<table class="table table-sm table-custom-allsales">
			<thead class="text-center">
				<tr>
					<th class="width-min">#</th>
					<th>Nama</th>
					<th>Data</th>
					<th></th>
				</tr>
			</thead>
			<tbody ng-repeat="item in customers">
				<tr class="content-header">
					<td class="line-11">
						#[[zeroFill(item.id, 5)]]
						[[item.created_at|date:'ddMMMyy HH:mm']]
					</td>
					<td class="line-11">
						<span ng-if="item.company.name!='No Company'" class="tx-gray">
							<span ng-if="item.company.nickname!='None'">[[item.company.nickname]]: </span>[[item.company.name]]
							<br>
						</span>
						<i class="fas fa-user" ng-class="{'tx-lightmagenta':item.title!='Mr.', 'tx-info':item.title=='Mr.'}"></i>
						[[item.name]]
					</td>
					<td class="line-11">
						[[item.salesheader.length]] x belanja
						<br>
						Belanja: Rp [[item.totalbelanja|number:0]]
					</td>
					<td class="th-action act-3">
						<div class="btn-group">
							<button class="btn btn-sm" ng-class="{'selected':item.showdetail}" ng-click="showdetailclicked(item)">
								<i class="far fa-address-book"></i>
							</button>
							<button class="btn btn-sm" ng-class="{'selected':item.showpurchase}" ng-click="showpurchaseclicked(item)">
								<i class="fas fa-dollar-sign"></i>
							</button>
							<button class="btn btn-sm" ng-class="{'selected':item.showeditpanel}" ng-click="showeditpanelclicked(item)">
								<i class="fas fa-pencil-alt"></i>
							</button>
						</div>
					</td>
				</tr>
				<tr class="content-detail detail-item" ng-show="item.showdetail">
					<td colspan="10">
						<div class="detail">
							<div class="subheader">
								DATA-DATA PELANGGAN KESELURUHAN
							</div>
							<table class="table table-cartheader margin-bottom-10">
								<thead>
									<tr>
										<th class="text-center width-min">#</th>
										<th class="">NAMA PERUSAHAAN</th>
										<th class="text-center">
											<small class="fas fa-phone tx-gray"></small>
										</th>
										<th class="text-center">
											<small class="fas fa-map-marked-alt tx-gray"></small>
										</th>
									</tr>
								</thead>
								<tbody class="text-v-center">
									<tr>
										<td class="line-11">
											#[[zeroFill(item.company.id, 4)]]
											<span ng-if="item.company.type.length>3">
												<br>
												[[item.company.type]]
											</span>
										</td>
										<td class="line-11 text-left">
											[[item.company.name]]
											<i ng-if="item.company.nickname!='None'">
												<br>
												<b>
													[[item.company.nickname]]
												</b>
											</i>
										</td>
										<td class="line-11">
											[[item.company.phone1]]
											<span ng-if="item.company.phone2.length>3">
												<br>
												[[item.company.phone2]]
											</span>
										</td>
										<td class="line-11">
											[[item.company.address]]
											<span ng-if="item.company.address!='--'">
												<br>
												[[item.company.city.name]]
											</span>
										</td>
									</tr>
								</tbody>
							</table>

							<table class="table table-cartheader margin-bottom-10">
								<thead>
									<tr>
										<th class="text-center width-min">#</th>
										<th class="text-center">NAMA</th>
										<th class="text-center">
											<small class="fas fa-phone tx-gray"></small>
										</th>
										<th class="text-center">
											<small class="fas fa-map-marked-alt tx-gray"></small>
										</th>
										<th class="text-center">
											<small class="fas fa-dollar-sign tx-gray"></small>
										</th>
									</tr>
								</thead>
								<tbody class="text-v-center">
									<tr>
										<td class="line-11">
											#[[zeroFill(item.id, 4)]]
											<span ng-if="item.type.length>3">
												<br>
												[[item.type]]
											</span>
										</td>
										<td class="line-11">
											<i class="fas fa-user" ng-class="{'tx-lightmagenta':item.title=='Mrs.'||item.title=='Ms.', 'tx-info':item.title=='Mr.'}"></i>
											[[item.name]]
											<span ng-if="item.email.length>3">
												<br>
												[[item.email]]
											</span>
										</td>
										<td class="line-11">
											[[item.phone1]]
											<span ng-if="item.phone2.length>3">
												<br>
												[[item.phone2]]
											</span>
										</td>
										<td class="line-11">
											[[item.address]]
											<span ng-if="item.address!='--'">
												<br>
												[[item.city.name]] [[item.postcode]]
											</span>
										</td>
										<td class="line-11">
											[[item.balance|number:0]]
										</td>
									</tr>
								</tbody>
							</table>

							<table class="table table-cartheader">
								<thead>
									<tr>
										<th class="">BANK</th>
										<th class="text-center">
											No. Rek
										</th>
										<th class="text-center">
											Name
										</th>
										<th class="text-center">
											<small class="fas fa-map-marked-alt tx-gray"></small>
										</th>
									</tr>
								</thead>
								<tbody class="text-v-center" ng-repeat="item2 in item.customerbankacc">
									<tr>
										<td class="line-11 text-left">
											[[item2.bank.bankname]] 
											<i><b>[[item2.bank.alias]]</b></i>
										</td>
										<td class="line-11">
											[[item2.accno]]
										</td>
										<td class="line-11">
											[[item2.accname]]
										</td>
										<td class="line-11">
											[[item2.acclocation]]
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
				<tr class="content-detail detail-item" ng-show="item.showpurchase">
					<td colspan="10">
						<div class="detail">
							<div class="subheader">
								DATA-DATA BELANJAAN PERORANGAN
							</div>
							<table class="table table-cartheader">
								<thead>
									<tr>
										<th class="width-min text-center">#JOB</th>
										<th class="text-left">Detail Cetak</th>
										<th class="width-min text-center">Progress...............</th>
										<th class="text-center">Cetak + Delivery - Discount</th>
									</tr>
								</thead>
								<tbody ng-repeat="item2 in item.salesheader">
									<tr class="text-v-center">
										<td class="line-11">
											#[[zeroFill(item2.id, 5)]]
											<br>
											[[item2.created_at|date:'ddMMMyy']]
										</td>
										<td class="text-left">
											<div class="line-11">
												<span ng-repeat="item3 in item2.salesdetail">
													<i class="tx-lightgray">#[[zeroFill($index+1,2)]].</i> <b>[[item3.cartheader.quantity]] [[item3.cartheader.quantitytypename]]</b> [[item3.cartheader.jobsubtype.name]] [[item3.cartheader.jobtitle]]
													<br>
												</span>
											</div>
										</td>
										<td class="text-center">
											<div class="line-11">
												<span ng-repeat="item3 in item2.salesdetail">

													<span data-toggle="tooltip" data-placement="top" data-html="true" data-title="<b>[[FILE]]</b>">
														<i class="fas fa-dot-circle" ng-class="{'tx-success':item3.statusfile==1, 'tx-lightgray':item3.statusfile==0}"></i>
													</span>
													<span data-toggle="tooltip" data-placement="top" data-html="true" data-title="<b>[[CTP]]</b>">
														<i class="fas fa-dot-circle" ng-class="{'tx-success':item3.statusctp==1, 'tx-lightgray':item3.statusctp==0}"></i>
													</span>
													<span data-toggle="tooltip" data-placement="top" data-html="true" data-title="<b>[[PRINT]]</b>">
														<i class="fas fa-dot-circle" ng-class="{'tx-success':item3.statusprint==1, 'tx-lightgray':item3.statusprint==0}"></i>
													</span>
													<span data-toggle="tooltip" data-placement="top" data-html="true" data-title="<b>[[PACKING]]</b>">
														<i class="fas fa-dot-circle" ng-class="{'tx-success':item3.statuspacking==1, 'tx-lightgray':item3.statuspacking==0}"></i>
													</span>
													<span data-toggle="tooltip" data-placement="top" data-html="true" data-title="<b>[[DELIVERY]]</b>">
														<i class="fas fa-dot-circle" ng-class="{'tx-success':item3.statusdelivery==1, 'tx-lightgray':item3.statusdelivery==0}"></i>
													</span>
													<span data-toggle="tooltip" data-placement="top" data-html="true" data-title="<b>[[SELESAI]]</b>">
														<i class="fas fa-dot-circle" ng-class="{'tx-success':item3.statusdone==1, 'tx-lightgray':item3.statusdone==0}"></i>
													</span>
													<br>
												</span>
											</div>
										</td>
										<td>
											<div class="line-11">
												<span ng-repeat="item3 in item2.salesdetail">
													[[item3.cartheader.printprice|number:0]] + [[item3.cartheader.deliveryprice|number:0]] - [[item3.cartheader.discount|number:0]]
													<br>
												</span>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
				<tr class="content-detail detail-item" ng-show="item.showeditpanel">
					<td colspan="10">
						<div class="detail">
							<div class="subheader">
								EDIT DATA dan BLOK CUSTOMER
							</div>
							<table class="table table-cartheader">
								<thead>
									<th></th>
									<th></th>
									<th></th>
								</thead>
								<tbody>
									<tr>
										<td>
											<i class="fas fa-info"></i>	
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>


</div>

@stop