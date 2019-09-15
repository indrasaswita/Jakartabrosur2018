<div ng-controller="OrdersalesSelectbankController" class="ordersales-customer-selectbank">
	@include('modal-md', 
		[
			'modalid' => 'ordersales-customer-selectbank',
			'modaltitle' => 'Pilih Bank Anda',
			'modalbody' => '
				<div class="bank-search">
					<input class="form-control fontawesome" ng-model="searchbankinput" placeholder="&#xF002; Cari bank Anda" ng-change="searchbank()" id="input-banksearch">
				</div>
				<div class="bank-list-wrapper">
					<ul class="bank-list">
						<li ng-repeat="bank in banks" ng-if="bank.show" ng-click="setcustbankconf(bank)">
							<div class="bank-alias" ng-if="bank.alias.length>0">
								[[bank.alias]]
							</div>
							<div class="bank-name">
								[[bank.bankname]]
							</div>
						</li>
					</ul>
				</div>
				<div class="modal-flat-button">
					<button class="btn btn-sm btn-outline-danger" data-dismiss="modal">
						Close
					</button>
				</div>
			',
			'modalfooter' => ''
		]
	)
</div>