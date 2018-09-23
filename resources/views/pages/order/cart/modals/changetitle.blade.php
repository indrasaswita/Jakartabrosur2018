<div class="modal fade" id="changeTitleModal" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
			<h4 class="modal-title" id="myModalLabel">Ganti Judul + Deskripsi</h4>
		  </div>
			<div class="modal-body">
				<div class="row margin-0">
					<div class="col-xs-12">
						<div class="form-group">
							<div class="form-control-title">Judul Kerjaan</div>
							<input type="text" class="form-control" placeholder="Job Title" ng-model="edit.jobtitle">
						</div>
						<div class="form-group">
							<div class="form-control-title">Tipe Kerjaan</div>
							<select class="form-control" ng-options="item for item in jobtypes" ng-model="edit.jobtype"></select>
						</div>
						<div class="form-group">
							<div class="form-control-title">Catatan Tambahan</div>
							<input type="text" class="form-control" placeholder="Customer Notes" ng-model="edit.customernote">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-purple" ng-click="updateTitle()">Update</button>
			</div>
		</div>
  </div>
</div>