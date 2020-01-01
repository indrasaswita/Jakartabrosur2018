<div class="modal fade" id="paymentVerifModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content bg-purple">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					Verifikasi Bayar #[[zeroFill(selectedverif.salesID, 5)]]
				</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="paymentverif-wrapper">
					<div class="left">
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
								<i class="fas fa-play tx-purple size-80p icon"></i>
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
								<i class="fas fa-play tx-purple size-80p icon"></i>
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
								<i class="far fa-calendar-alt tx-purple icon"></i>
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
								<i class="fas fa-check" ng-show="selectedverif.veriftime!=null"></i> 
								Verif!
							</button>
						</div>
					</div>
					<div class="right">
						<div class="" ng-if="typeoff(klikbca)=='string'">
							ERROR : [[klikbca]]
						</div>
						<table class="table table-sm table-custom-allsales line-11" ng-if="typeoff(klikbca)!='string'">
							<thead>
								<tr>
									<td>TGL</td>
									<td>KET</td>
									<td class="text-xs-right">NOM</td>
								</tr>
							</thead>
							<tbody ng-repeat="item in klikbca">
								<tr ng-class="{'highlight':selectedverif.ammount==item.mutationAmmount}">
									<td>[[item.mutationDate|date:'dd MMM']]</td>
									<td class="size-80p">[[item.mutationNote]]</td>
									<td class="text-xs-right">[[item.mutationAmmount|number:0]]</td>
								</tr>
							</tbody>
						</table>
					</div>
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