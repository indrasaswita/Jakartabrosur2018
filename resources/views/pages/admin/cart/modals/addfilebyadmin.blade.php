<!-- Modal -->
<div class="modal fade" id="addfilebyadminModal" tabindex="-1" role="dialog" ng-controller="AdminCartAddFilebyadminController">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title magra">TAMBAH FILE BARU!</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body magra">
				
			</div>
			<div class="modal-footer">
				<button class="btn btn-outline-purple" ng-click="addcartdetailsclicked()">
					Tambah Detail
				</button>
				<button class="btn btn-outline-purple" ng-click="resetmodal()">
					Reset
				</button>
				<button type="button" class="btn btn-purple" ng-click="submitaddbyadmin()">Submit Data</button>
			</div>
		</div>
	</div>
</div>