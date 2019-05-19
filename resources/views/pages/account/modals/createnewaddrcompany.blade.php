<div ng-init="setCustomerID('{{Session::get('userid')}}')"></div>

@include('modal', ['modalid'=>'createnewaddrcompany', 'modaltitle'=>'BUAT ALAMAT COMPANY', 'modalbody'=>'
	<div class="data-row">
		<div>
			<b>Type</b>
		</div>
		<div>
			<input type="text"class="form-control" ng-model="newaddresscomp.name" placeholder="Jenis alamat">
		</div>
		<div>
			<b>Alamat</b>
		</div>
		<div>
			<input type="text" class="form-control" ng-model="newaddresscomp.address" placeholder="Silahkan isi alamat beserta nomor rumah/kantor">
		</div>
		<div>
			<b>Catatan Tambahan</b>
		</div>
		<div>
			<input type="text" class="form-control" ng-model="newaddresscomp.addressnotes" placeholder="Silahkan isi dengan ciri2 alamat">
		</div>
		<div>
			<b>Kota</b>
		</div>
		<div class="">
		<select class="form-control" ng-model="newaddresscomp.city" ng-options="item as item.name for item in cities"></select>
		</div>
	</div>
	<div class="data-row">
		[[newaddresserror]]
	</div>
', 'modalfooter'=>'
	<button class="btn btn-primary" ng-click="saveNewAddrCompany()">Save</button>
'])

