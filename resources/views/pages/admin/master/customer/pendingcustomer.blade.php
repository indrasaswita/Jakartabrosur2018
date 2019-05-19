@extends('layouts.container')
@section('title', 'Sales & Payment | Admin')
@section('content')

	<div class="" ng-controller="VerifCustomerController" ng-init="initheader('{{json_encode($customers)}}')">
		
		<div class="page-title">
			<small class="fas fa-users tx-lightgray"></small> Verifikasi Customer

			<small class="fas fa-angle-double-right tx-lightmagenta fa-fw"></small>

			<span class="fas fa-universal-access tx-lightgray"></span> Hak Admin
		</div>

		
		<table class="table table-sm table-custom-allsales">
			<thead class="">
				<tr>
					<th class="width-min text-xs-center">#</th>
					<th class="text-xs-center">Customer</th>
					<th class="">
						<i class="fas fa-phone fa-flip-horizontal tx-lightgray fa-fw"></i>
						Phone
					</th>
					<th class="text-xs-center">Active</th>
					<th class="text-xs-center"><span class="fas fa-cogs tx-primary fa-fw"></span></th>
				</tr>
			</thead>
			<tbody>
				<tr class="content-header" ng-repeat="item in customers">
					<td class="width-min center">[[zeroFill($index+1, 2)]].</td>
					<td class="text-xs-center">	
						<div class="line-11">
							<b>[[item.name]]</b> <br>
							[[item.email]]
						</div>
					</td>
					<td class="text-xs-left">	
						<i class="fab fa-whatsapp tx-success fa-fw"></i>
						[[item.phone1]]
						<span ng-show="item.phone2!=null">
							<br>
							<i class="fas fa-phone fa-flip-horizontal tx-primary fa-fw"></i>
							[[item.phone2]]
						</span>
					</td>
					<td class="hidden-xs-down text-xs-center">
						<div class="line-11" ng-show="item.updated_at!=null">	
							<b>[[item.created_at|date:'dd MMM yyyy']]</b><br>
							<i class="far fa-clock fa-fw tx-lightgray"></i>
							<span class="tx-primary">
								[[item.created_at|date:'HH:mm:s']]
							</span>
						</div>
					</td>
					<td class="th-action width-min">
						<div class="btn-group" data-toggle="tooltip" data-title="<b>Kirim Verifikasi</b><br>via <span class='tx-success'><i class='fab fa-whatsapp fa-fw'></i>WA</span>" data-html="true" data-placement="left">
							<a class="btn btn-sm" href="https://api.whatsapp.com/send?phone=[[item.phone1]]&text=[*JAKARTABROSUR*]%20JANGAN%20MEMBERITAHU%20KODE%20RAHASIA%20INI%20KEPADA%20SIAPA%20PUN%20TERMASUK%20PIHAK%20JAKARTABROSUR.%0D%0A%0D%0AKode%20verifikasi%20Anda%20:%20*[[item.verify_token]]*" target="_blank">
								<span class="fab fa-fw fa-whatsapp"></span>
							</a>
							<!-- <button class="btn btn-sm" data-toggle="tooltip" data-title="SMS">
								<span class="fas fa-fw fa-sms"></span>
							</button> -->
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
@stop