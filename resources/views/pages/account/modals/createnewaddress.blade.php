<div ng-init="setCustomerID('{{Session::get('userid')}}')"></div>

@include('modal', ['modalid'=>'createnewaddress', 'modaltitle'=>'BUAT ALAMAT BARU', 'modalbody'=>'
	<div class="data-row">
		<div>
			<b>Type</b>
		</div>
		<div>
			<input type="text"class="form-control" ng-model="newaddress.name" placeholder="Jenis alamat">
		</div>
		<div>
			<b>Alamat</b>
		</div>
		<div>
			<input type="text" class="form-control" ng-model="newaddress.location" placeholder="Silahkan isi alamat beserta nomor rumah/kantor">
		</div>
		<div>
			<b>Catatan Tambahan</b>
		</div>
		<div>
			<input type="text" class="form-control" ng-model="newaddress.note" placeholder="Silahkan isi dengan ciri2 alamat">
		</div>
		<div>
			<b>Kota</b>
		</div>
		<div class="">
		<select class="form-control" ng-model="newaddress.city" ng-options="item as item.name for item in cities"></select>
		</div>
	</div>
	<div class="data-row">
		[[newaddresserror]]
	</div>
', 'modalfooter'=>'
	<button class="btn btn-primary" ng-click="saveNewAddress()">Save</button>
	<button class="btn btn-danger" data-dismiss="modal">Close</button>
'])