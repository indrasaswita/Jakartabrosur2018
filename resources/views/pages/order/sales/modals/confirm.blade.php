<div class="ordersales-payment-confirm" ng-controller="OrdersalesPaymentconfirmController">
	@include('modal', 
		[
			'modalid' => 'ordersales-payment-confirm',
			'modaltitle' => 'Confirmation Box',
			'modalbody' => '
				<div class="action">
					<div class="bank from">
						<div class="bank-name">
							<b class="alias" ng-if="konfirmasi.custacc.bank.alias.length>0">
								[[konfirmasi.custacc.bank.alias]]
								<br>
							</b>
							[[konfirmasi.custacc.bank.bankname]]
						</div>
						<div class="acc-no">
							[[konfirmasi.custacc.accno]]
						</div>
						<div class="acc-name">
							[[konfirmasi.custacc.accname.toTitleCase()]]
						</div>
					</div>
					<div class="nominal">
						<i class="far fa-arrow-alt-down fa-fw vibrate"></i>
						<br>
						<div class="text">
							Saya transfer sebesar 
						</div>
						<div class="num">
							<input class="" ng-model="konfirmasi.paymentammount" ng-min="0" min="0">
						</div>
						<i class="far fa-arrow-alt-down fa-fw vibrate"></i>
					</div>
					<div class="bank to">
						<div class="bank-name">
							<b class="alias" ng-if="konfirmasi.compacc.bank.alias.length>0">
								[[konfirmasi.compacc.bank.alias]]
								<br>
							</b>
							[[konfirmasi.compacc.bank.bankname]]
						</div>
						<div class="acc-no">
							[[konfirmasi.compacc.accno]]
						</div>
						<div class="acc-name">
							[[konfirmasi.compacc.accname.toTitleCase()]]
						</div>
					</div>
				</div>
				<div class="confirm-end">
					Segera lakukan pengecekan<br>
					untuk pembayaran saya diatas.
					<br><br>
					Saya telah membayar,<br>
					sesuai nominal diatas.
					<br><br>
					<button class="btn btn-sm btn-outline-purple" ng-click="doconfirm()">
						LAKUKAN PENGECEKAN
					</button>
				</div>
			',
			'modalfooter' => '
				<div class="modal-flat-button text-right">
					<button class="btn btn-sm btn-outline-danger" data-dismiss="modal">
						TUTUP, SAYA BELUM TRANSFER
					</button>
				</div>
			'
		]
	)
</div>