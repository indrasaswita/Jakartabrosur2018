<div class="modal fade" id="manualPaymentModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h6 class="modal-title" id="myModalLabel">
					Pembayaran Manual (Admin)
				</h6>
			</div>
			<div class="modal-body size-12">
				<table class="table table-sm text-center" ng-show="selectedheader.payments.length > 0">
					<thead>
						<tr>
							<td>Tgl Bayar</td>
							<td>Jumlah Bayar</td>
							<td>Verifikasi</td>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="item in selectedheader.payments">
							<td>
								[[item.paydate]]
							</td>
							<td>
								[[item.ammount|number:0]]
							</td>
							<td>
								<span class="tx-danger" ng-show="item.veriftime==null">
									Pending...
								</span>
								<span class="tx-success" ng-show="item.veriftime!=null">
									<i class="fa fa-check"></i>
									[[item.veriftime]]
								</span>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="alert alert-warning margin-0">
					Akun Bank Customer
					<div class="form-group">
						<select class="form-control size-12" ng-model="selectedcustacc" ng-options="item as item.accno+' ('+singkatText(item.accname,15, '')+')' for item in customerbankaccs track by item.id"></select>
					</div>
					Akun Bank Tujuan
					<div class="form-group">
						<select class="form-control size-12" ng-model="selectedcompacc" ng-options="item as item.accno+' ('+singkatText(item.accname,15, '')+')' for item in companybankaccs track by item.id"></select>
					</div>
					Tanggal Trf.
					<div class="form-group">
						<input type="date" class="form-control size-12" ng-model="selectedpaydate">
					</div>
					Jumlah Tagihan
					<div class="form-group">
						<div class="form-control size-14 text-xs-center">Rp <b>[[selectedheader.totalprice-selectedheader.totalpayment|number:0]]</b></div>
					</div>
					Jumlah Transfer
					<div class="form-group">
						<input type="number" class="form-control size-12" ng-model="selectedammount" min='10000' ng-min='10000'>
					</div>
					<div class="text-xs-center margin-10-0">
						<button class="btn btn-sm btn-outline-purple" ng-click='submitManualPayment()'>
							<i class="fa fa-plus-square"></i> 
							Tambah
						</button>
					</div>
					<div class="text-xs-center">
						<span>
							<i class="fa fa-warning tx-warning"></i>
							bayar + verifikasi!
							<i class="fa fa-warning tx-warning"></i>
						</span>
					</div>
				</div>
			</div>
			<!-- <div class="modal-footer">
				<button type="button" class="btn btn-sm btn-purple" data-dismiss="modal">
					Close
					</button>
			</div> -->
		</div>
	</div>
</div>