<div class="modal fade" id="itemdescriptionModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		<h4 class="modal-title" id="myModalLabel">
			Deskripsi Cetakan
		</h4>
	  </div>
		<div class="modal-body">

		<!-- ISI DESKRIPSI -->
			<div class="subtitle">
				Deskripsi:
				<div class="subtitle-mini">
					(untuk keterangan tambahan pada cetakan)
				</div>
			</div>
			<div class="display-flex">
				<input type="text" class="form-group width-100" ng-model="selected.itemdescription" placeholder="Keterangan TAMBAHAN pencetakan">
				<span class="glyphicon glyphicon-ok tx-success right-icon" ng-hide="selected.itemdescription.length<5||selected.itemdescription.length>254"></span> 
				<span class="glyphicon glyphicon-remove tx-danger right-icon" ng-show="selected.itemdescription.length<5||selected.itemdescription.length>254"></span> 
			</div>

			<div class="subtitle">
				Catatan dr Anda: 
				<div class="subtitle-mini">
					(untuk keterangan DILUAR cetakan, cth: packing dengan plastik, setiap pack dituliskan nomor, untuk pameran tgl tertentu)
				</div>
			</div>
			<div class="display-flex">
				<input type="text" class="form-group width-100" ng-model="selected.customernote" placeholder="Catatan yg mendukung">
				<span class="glyphicon glyphicon-ok tx-success right-icon" ng-hide="selected.customernote.length<5||selected.customernote.length>254"></span> 
				<span class="glyphicon glyphicon-remove tx-danger right-icon" ng-show="selected.customernote.length<5||selected.customernote.length>254"></span> 
			</div>
		<!-- SELESAI -->

		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-purple" data-dismiss="modal">Close</button>
		</div>
	</div>
  </div>
</div>