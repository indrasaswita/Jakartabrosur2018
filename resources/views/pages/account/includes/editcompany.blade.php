<div class="order-panel tab-pane fade in" id="company">
	<div class="editprofilecompany">
		<div class="data-row">
			<div class="company-name">
				<div class="large-icon">
					<i class="fal fa-building" ng-if="customer.companyID>1"></i>
					<i class="far fa-ban tx-red" ng-if="customer.companyID==1"></i>
				</div>
				<div class="data-cell">
					<span class="size-140p">
						[[customer.company.nickname]]
					</span>
					<br>
					<span class="size-80p">
						[[customer.company.name]]
					</span>
				</div>
			</div>
			<div ng-if="customer.companyID>1">
				<div class="company-phone">
					<div class="small-icon">
						<i class="fal fa-fw fa-phone fa-flip-horizontal"></i>
					</div>
					<div class="data-cell">
						[[customer.company.phone1]]
						<br>
						<span ng-if="customer.company.phone2.length>3">
							[[customer.company.phone2]]
						</span>
						<br>
						<span ng-if="customer.company.phone3.length>3">
							[[customer.company.phone3]]
						</span>
					</div>
				</div>
				<div class="company-address">
					<div class="small-icon">
						<i class="fal fa-fw fa-thumbtack"></i>
					</div>
					<div class="data-cell">
						<div class="text-xs-left" ng-repeat="item in customer.company.companyaddress">
							[[item.address.address]], [[item.address.city.name]], [[item.address.city.island]]
							<a href="" ng-click="deleteAddrCompany(item, $index)" class="a-danger">
								<i class="far fa-trash-alt"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div ng-if="customer.companyID==1" class="company-action">
			<div class="alert alert-sm size-80p alert-warning margin-10-0 googleft line-12">
				<i class="fal fa-engine-warning"></i>
				Belum ada <b>Data Kantor Anda</b>,<br>silahkan menambahkan pada tombol di bawah ini.<br>(Jika Anda bukan perorangan)
			</div>
			<div class="action-buttons">
				<button class="btn btn-sm btn-outline-gray" ng-click="createNewCompany()">
					<i class="fal fa-plus-octagon margin-right-5 tx-purple"></i> Buat baru Kantor
				</button>
				<span class="divider">atau</span>
				<button class="btn btn-sm btn-outline-gray" ng-click="selectCompany()">
					<i class="fal fa-mouse-pointer fa-fw"></i> Pilih Kantor yg sudah ada
				</button>
			</div>
		</div>
		<div ng-if="customer.companyID>1" class="company-action">
			<button class="btn btn-sm btn-outline-gray margin-top-5" ng-click="createAddressCompany()">
				<i class="fal fa-map-marker-plus fa-fw"></i> Tambah Alamat Kantor
			</button>
		</div>
	</div>
</div>

@include('pages.account.modals.confcompanyaddress')
@include('pages.account.modals.createnewaddrcompany')
@include('pages.account.modals.createnewcompany')
@include('pages.account.modals.selectcompany')
