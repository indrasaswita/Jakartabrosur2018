@include('modal', ['modalid'=>'confaddressdelete', 'modaltitle'=>'DELETE CONFIRMATION', 'modalbody'=>'
	
	Apakah anda yakin akan menghapus data ([[selecteditem.address.address]]) anda?

', 'modalfooter'=>'
	
	<button class="btn btn-primary" data-dismiss="modal" ng-click="deleteConfAddrCompany(selecteditem.id)">OK</button>

'])