<div class="modal fade" id="addAccModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Konfirmasi Pembayaran</h4>
				</div>
				<div class="modal-body">
					<form>
						<div class="input-group">
							<input class="form-control width-70" type="text" placeholder="Search here!" ng-model="searchingkey">
							<input class="form-control btn btn-success width-30" type="submit" value="Search" ng-click="searchOnBanks()"> 
						</div>
					</form>
					<table class="table table-sm">
						<tbody>
							<tr dir-paginate="item in searchedbanks | itemsPerPage:8" ng-class="{'bg-success':item.id==modal.bankID}" ng-click="selectBank(item.id)">
								<td>[[item.alias]]</td>
								<td>[[item.bankname]]</td>
								<td class="text-right">[[item.code]]</td>
							</tr>
						</tbody>
					</table>
					<div class="row margin-0">
						<div class="col-xs-12">
							<div class="form-group row">
								<label for="ammount" class="label">Nama Pemilik</label>
								<div class="input">
									<input type="text" class="form-control" ng-model="modal.accname">
								</div>
							</div>
							<div class="form-group row">
								<label for="ammount" class="label">No. Rekening</label>
								<div class="input">
									<input type="number" class="form-control" ng-model="modal.accno">
									<small class="form-text text-muted">Masukkan angka tanpa atribut atau spasi</small>
								</div>
							</div>
							<div class="form-group row">
								<label for="ammount" class="label">Cabang</label>
								<div class="input">
									<input type="text" class="form-control" ng-model="modal.acclocation">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" ng-click="storeAccs()" data-dismiss="modal">Add Account</button>
				</div>
			</div>
		</div>
	</div>