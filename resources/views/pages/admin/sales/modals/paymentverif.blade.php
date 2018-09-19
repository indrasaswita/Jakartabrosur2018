<div class="modal fade" id="paymentVerifModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content bg-purple">
			<div class="modal-header">
				<h6 class="modal-title" id="myModalLabel">
					Verifikasi Bayar #[[zeroFill(selectedverif.salesID, 5)]]
				</h6>
			</div>
			<div class="modal-body size-12">
				Akun Bank Customer
				<div class="form-group">
					<div class="form-control size-14 text-xs-center">
						<span ng-show="selectedverif.customeracc.bank.alias==''">
							[[selectedverif.customeracc.bank.bankname]]
						</span>
						<span ng-show="selectedverif.customeracc.bank.alias!=''">
							[[selectedverif.customeracc.bank.alias]]
						</span>
						<br>
						<i class="fa fa-play tx-purple size-80p icon"></i>
						<b>
							[[selectedverif.customeracc.accno]] 
							<br>
							<span class="tx-purple">
								[[selectedverif.customeracc.accname]]
							</span>
						</b>
					</div>
				</div>
				Akun Bank Tujuan
				<div class="form-group">
					<div class="form-control size-14 text-xs-center">
						<span ng-show="selectedverif.companyacc.bank.alias==''">
							[[selectedverif.companyacc.bank.bankname]]
						</span>
						<span ng-show="selectedverif.companyacc.bank.alias!=''">
							[[selectedverif.companyacc.bank.alias]]
						</span>
						<br>
						<i class="fa fa-play tx-purple size-80p icon"></i>
						<b>
							[[selectedverif.companyacc.accno]] 
							<br>
							<span class="tx-purple">
								[[selectedverif.companyacc.accname]]
							</span>
						</b>
					</div>
				</div>
				Tanggal Trf.
				<div class="form-group">
					<div class="form-control size-14 text-xs-center">
						<i class="fa fa-calendar-check-o tx-purple icon"></i>
						[[selectedverif.paydate]]
					</div>
				</div>
				Jumlah Pembayaran
				<div class="form-group">
					<div class="form-control size-14 text-xs-center">
						Rp <b>[[selectedverif.ammount|number:0]]</b>
					</div>
				</div>
				Catatan
				<div class="form-group">
					<input type="text" class="form-control size-14 text-xs-center" ng-model="selectedverif.note">
					<div class="size-80p text-xs-center">Catatan <i class="fa fa-caret-up"></i> bisa di edit</div>
				</div>
				<div class="text-xs-center margin-10-0">
					<button class="btn btn-sm" ng-class="{'btn-outline-purple':selectedverif.veriftime==null, 'btn-purple tx-yellow':selectedverif.veriftime!=null}" ng-click='submitPaymentVerif()' ng-disabled="selectedverif.veriftime!=null">
						<i class="fa fa-check" ng-show="selectedverif.veriftime!=null"></i> 
						Verif!
					</button>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-outline-purple" data-dismiss="modal">
					Close
					</button>
			</div>
		</div>
	</div>
</div>