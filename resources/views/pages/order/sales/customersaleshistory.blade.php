@extends('layouts.container')
@section('title', 'Sales History')
@section('content')

<div ng-controller = "HistoryController" ng-init="initHeader('{{json_encode($headers)}}')">
	<div class="page-title">
		<small class="fas fa-history tx-lightgray"></small> Riwayat Penjualan
	</div>
	<div>
		<table>
		<thead>
			<tr>
				<td>
					<button data-toggle="tooltip" data-placement="top" data-title="Check File" data-html="true">
						<span class="fas fa-copy"></span>
					</button>
				</td>
				<td>
					<button data-toggle="tooltip" data-placement="top" data-title="Cetak Plat" data-html="true">
						<span class="fab fa-usb"></span>
					</button>
				</td>
				<td>
					<button data-toggle="tooltip" data-placement="top" data-title="Cetak File" data-html="true">
						<span class="fas fa-print"></span>
					</button>
				</td>
				<td>
					<button data-toggle="tooltip" data-placement="top" data-title="Pengemasan" data-html="true">
						<span class="fas fa-boxes"></span>
					</button>
				</td>
				<td>
					<button data-toggle="tooltip" data-placement="top" data-title="Pengiriman" data-html="true">
						<span class="fas fa-truck fa-flip-horizontal"></span>
					</button>
				</td>
				<td>
					<button data-toggle="tooltip" data-placement="top" data-title="Selesai" data-html="true">
						<span class="fa fa-check"></span>
					</button>
				</td>
			</tr>
		</thead>
	</table>
	</div>
	<div style="margin-top:15px;">
		<table class="table table-sm table-custom-allsales">
		<thead class="text-center">
			<tr>
				<th class="width-min">#Inv.</th>
				<th>Tgl. Pesanan</th>
				<th>Preview</th>
				<th>Total Harga</th>
				<th>Detail</th>
			</tr>
		</thead>
		<tbody style="text-align: center">
			<tr class="content-header" ng-repeat="item in headers">
				<td>
					#[[zeroFill(item.id, 5)]]
				</td>
				<td>
					[[item.created_at|date:'d MMM H:m']]    
				</td>
				<td>
					<div class="line-11">
						<div ng-repeat="preview in item.salesdetail">
							<span class="number">
								[[$index+1]].
							</span>
							[[preview.cartheader.quantity]] [[preview.cartheader.quantitytypename]] <b> [[preview.cartheader.jobsubtype.name]] <b> [[preview.cartheader.jobtitle]]
						</div>
					</div>
				</td>
				<td>[[item.price|number:0]]</td>
				<td>
					<button class="btn btn-sm" data-tooltip="tooltip"data-title="Lihat Detail" data-placement="top">
						<span class="fas-fa-info-square"></span>
					</button>
				</td>
			</tr>
			<tr class="content-detail detail-item" ng-show="item.showdetail">
				<td colspan="10">
					<div class="detail">
						<div class="subheader">
							DETAIL TRANSAKSI
						</div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	</div>
</div>

@stop
