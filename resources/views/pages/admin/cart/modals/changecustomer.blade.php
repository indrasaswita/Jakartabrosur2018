<div class="joincart-changecustomer">

	<div class="modal fade" id="modal-changecustomer" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Join Cart - Change Customer</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table">
						<tbody ng-repeat="cart in selectedcarts" ng-class="{'selected':selectedcarts.selected}">
							<tr>
								<td class="width-min">
									<label class="custom-checkbox">
										<input type="checkbox" ng-model="cart.selected" ng-click="checkAll()">
										<span class="checkmark"></span>
									</label>
								</td>
								<td>
									#[[zeroFill(cart.customerID, 3)]]
									[[cart.customer.name]]
								</td>
								<td>
									[[cart.quantity|number:0]] [[cart.quantitytypename]] 
									<span class="tx-gray">
										[[cart.jobsubtype.name]]
									</span>
									<b>[[cart.jobtitle]]</b>
								</td>
							</tr>
						</tbody>
					</table>

					Ubah yang dipilih (<b>[[selectedcarts.length]]</b>) diatas, menjadi customer dibawah:


					<div class="customer-error" ng-if="changecustomererror.length>0">
						[[changecustomererror]]
					</div>

					<div class="customer-list">
						<select class="selectpicker" data-live-search="true" ng-options="customer as customer.name for customer in customers track by customer.id" ng-model="selectedcustomer" data-width="100%"></select>

						<div class="btn-change">
							<button class="btn btn-sm btn-outline-purple" ng-click="dochange(selectedcustomer)">
								Change Customer in DB
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>