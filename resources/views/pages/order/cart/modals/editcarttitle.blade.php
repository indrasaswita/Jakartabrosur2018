<div class="editcarttitle">
	@include('modal-sm', 
		[
			'modalid' => 'editcarttitle',
			'modaltitle' => 'Edit Judul',
			'modalbody' => '
				<div class="before">
					Sebelumnya: <br>
					<b>
						[[selectedCartTitle.jobtitle]]
					</b>
				</div>
				<div class="after">
					<input type="text" class="form-control" ng-model="newtitle" id="editcart-newtitle">
				</div>
				<div class="modal-flat-button">
					<button class="btn btn-sm btn-purple" ng-click="edittitle()">
						CHANGE
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