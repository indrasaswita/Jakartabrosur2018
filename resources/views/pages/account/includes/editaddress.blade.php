<div class="order-panel tab-pane fade in" id="address">
	<div class="editprofileaddress">
		<button class="button btn btn-info btn-sm" ng-click="createAddress()"><i class="fas fa-plus"></i>Tambah Alamat</button>
		<div class="data-row">
			<table class="table table-sm table-custom-editaddress">
				<thead>
					<tr>
						<th>#</th>
						<th class="text-xs-center">Tipe</th>
						<th class="text-xs-center">Alamat</th>
						<th></th>
					</tr>
				</thead>
				<tbody ng-repeat="item in customer.customeraddress">
					<tr class="content-header">
						<td class="width-min center">[[$index+1]].</td>
						<td class="text-xs-center">
							[[item.address.name]]
							<br>
							[[item.address.addressnotes]]
						</td>
						<td class="text-xs-center">
							[[item.address.address]], [[item.address.city.name]]
						</td>
						<td class="th-action">
							<div class="btn-group">
								<button ng-click="editAddress(item, $index)"><i class="fas fa-edit"></i></button>
								<button ng-click="deleteAddress(item, $index)"><i class="fas fa-trash"></i></button>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

@include('pages.account.modals.confcustomeraddress')
@include('pages.account.modals.createnewaddress')
@include('pages.account.modals.editcustomeraddress')