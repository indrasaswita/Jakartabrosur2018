<div class="order-panel tab-pane fade in" id="address">
	<div class="editprofileaddress">
		<div>
			<table class="table table-sm table-custom-editaddress">
				<tbody ng-repeat="item in customer.customeraddress">
					<tr class="content-header">
						<td class="text-xs-center">
							<i class="fal fa-map-marker-alt"></i> 
							<strong>[[item.address.name]]</strong>
							<br>
							[[item.address.addressnotes]]
							<br>
							[[item.address.address]]
							<br>
							[[item.address.city.name]]
						</td>
						<td class="th-action">
							<div class="btn-group">
								<button class="btn btn-sm" ng-click="editAddress(item, $index)"><i class="far fa-fw fa-pen"></i></button>
								<button class="btn btn-sm" ng-click="deleteAddress(item, $index)"><i class="far fa-fw fa-trash-alt"></i></button>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="divtambah">
			<button class="button btn-tambah btn-sm" ng-click="createAddress()"><i class="far fa-map-pin"></i> Tambah Alamat</button>
		</div>
	</div>
</div>

@include('pages.account.modals.confcustomeraddress')
@include('pages.account.modals.createnewaddress')
@include('pages.account.modals.editcustomeraddress')