@include('modal',
['modalid'=>'editcustaddress',
'modaltitle'=>'UBAH ALAMAT',
'modalbody'=>'
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
			<input type="text" class="form-control" ng-model="newaddress.address" placeholder="Silahkan isi alamat beserta nomor rumah/kantor">
		</div>
		<div>
			<b>Catatan Tambahan</b>
		</div>
		<div>
			<input type="text" class="form-control" ng-model="newaddress.addressnotes" placeholder="Silahkan isi dengan ciri2 alamat">
		</div>
		<div>
			<b>Kota</b>
		</div>
		<div class="">
			<select class="form-control" ng-model="newaddress.city" ng-options="item as item.name for item in cities track by item.id"></select>
		</div>
	</div>
', 'modalfooter'=>'
	<button class="btn btn-primary" ng-click="saveEditAddress()">Save</button>
	<button class="btn btn-danger" data-dismiss="modal">Close</button>
	'])