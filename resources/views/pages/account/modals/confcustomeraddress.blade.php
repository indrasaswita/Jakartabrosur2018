@include('modal', ['modalid'=>'confirmationdelete', 'modaltitle'=>'DELETE CONFIRMATION', 'modalbody'=>'
	
	Apakah anda yakin akan menghapus data ([[selecteditem.name]]) anda?

', 'modalfooter'=>'
	
	<button class="btn btn-primary" data-dismiss="modal" ng-click="deleteConfirmation(selecteditem.id)">OK</button>

'])