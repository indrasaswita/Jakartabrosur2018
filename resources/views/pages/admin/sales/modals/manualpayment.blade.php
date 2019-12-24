<div class="admin-salesmanualpayment" ng-controller="AdmSalesmanualpaymentController">	
	<div class="modal fade" id="manualPaymentModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">
						Pembayaran Manual (Admin)
					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
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
							<select class="selectpicker" ng-model="selectedcustacc" ng-options="item as item.accno+' ('+(item.bank.alias==''?item.bank.bankname:item.bank.alias)+') a/n. '+item.accname for item in customerbankaccs track by item.id" data-width="100%"></select>
						</div>
						<div class="custacc-addnew">
							TAMBAH AKUN CUSTOMER BARU<br><br>
							<div class="line">
								<button class="btn btn-sm btn-outline-purple" ng-click="setbank('BCA')">
									BCA
								</button>
								<button class="btn btn-sm btn-outline-purple" ng-click="setbank('BRI')">
									BRI
								</button>
								<button class="btn btn-sm btn-outline-purple" ng-click="setbank('BNI 46')">
									BNI 46
								</button>
								<button class="btn btn-sm btn-outline-purple" ng-click="setbank('Mandiri')">
									Mandiri
								</button>
								<button class="btn btn-sm btn-outline-purple" ng-click="setbank('BTPN')">
									BTPN
								</button>
							</div>
							<div class="line">
								<select class="selectpicker" ng-options="bank as bank.code+' - '+bank.bankname+(bank.alias==''?'':' ('+bank.alias+')') for bank in banks" ng-model="selectedbank" data-width="100%" data-live-search="true">
								</select>
							</div>
							<div class="line">
								<input class="form-control" ng-model="selectedaccname" placeholder="Acc Name">
							</div>
							<div class="line">
								<input class="form-control" ng-model="selectedaccno" placeholder="Acc No. (optional)">
							</div>
							<div class="line error ease" ng-if="errormessage.length>0">
								[[errormessage]]
							</div>
							<button class="btn btn-sm btn-outline-primary" ng-click="submitnewcustacc()">
								Tambah
							</button>
							<button class="btn btn-sm btn-outline-secondary">
								Batal
							</button>
						</div>
						Akun Bank Tujuan
						<div class="form-group">
							<select class="form-control size-12" ng-model="selectedcompacc" ng-options="item as item.accno+' ('+item.bank.alias+')' for item in companybankaccs track by item.id"></select>
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
</div>