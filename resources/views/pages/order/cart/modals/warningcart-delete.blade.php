<div class="cart-warningcart-delete">
	@include('modal-sm', 
		[
			'modalid' => 'warningcartdelete',
			'modaltitle' => 'Warning',
			'modalbody' => '
				<div class="text-xs-center">
					Action: <br>
					Delete untuk "[[selectedCartDelete.jobtitle]]" (#[[zeroFill(selectedCartDelete.id, 4)]])
					<br>
					[[selectedCartDelete.quantity]] [[selectedCartDelete.quantitytypename]] [[selectedCartDelete.jobsubtype.name]]
					<br><br>
					<i class="fas fa-exclamation-triangle fa-fw tx-warning fa-3x"></i><br><br>
					Anda tidak dapat mengembalikan data yang telah dihapus.<br>
					<i>
						You cannot undone this action.
					</i><br>
					Yakin mau <b class="tx-danger">delete</b>?
				</div>
				<div class="modal-flat-button">
					<button class="btn btn-sm btn-danger" ng-click="cartdelete()">
						DELETE
					</button>
					<button class="btn btn-sm btn-secondary" data-dismiss="modal">
						CANCEL
					</button>
				</div>
			',
			'modalfooter' => ''
		]
	)
</div>