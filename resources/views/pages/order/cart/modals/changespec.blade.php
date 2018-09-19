<div class="modal fade" id="changeSpecModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Ganti Spesifikasi Cetak</h4>
		  </div>
			<div class="modal-body">
				<div class="row margin-0">
					<div class="col-xs-12">
						<div class="form-group">
							<div class="form-control-title">Jumlah Cetak</div>
							<div class="input-group">
								<span class="input-group-btn">
									<button class="btn btn-quantity" ng-click="qtyDecr()"><span class="glyphicon glyphicon-minus"></span></button>
								</span>
								<div type="number" class="form-control text-xs-center" placeholder="Quantity (number)">[[edit.quantity|number:0]] RIM = [[edit.quantity*500|number:0]] lembar</div>
								<span class="input-group-btn">
									<button class="btn btn-quantity" ng-click="qtyIncr()"><span class="glyphicon glyphicon-plus"></span></button>
								</span>
							</div>
							<div class="width-100 text-xs-center margin-0">
								<small class="text-muted">Keterangan: 1 RIM = 500 lembar</small>
							</div>
						</div>
						<div class="form-group">
							<div class="form-control-title">Bahan / Material</div>
							<select class="form-control" ng-change="updatePrice()" ng-options="item.name as (item.name + ', type: ' + item.papertypename + '(' + item.category + '), weight: ' + item.gramature + ' gsm') group by item.papertypename for item in papers" ng-model="edit.name"></select>
						</div>
						<div class="form-group">
							<div class="form-control-title">Ukuran (Lebar x Panjang)</div>
							<div class="width-100 margin-10-0 text-xs-center">
								<div class="btn-group">
									<button class="btn btn-sm btn-outline-purple" ng-repeat="size in papersizes" ng-click="setPapersize(size.width, size.length); updatePrice()">
										<span class="size-18">[[size.name]]</span><br>
										<span class="text-muted size-10">[[size.width|number:1]]x[[size.length|number:1]]cm</span>
									</button>
								</div>
							</div>
							<div class="input-group">
								<input type="number" step="0.1" class="form-control text-xs-center" placeholder="Width" ng-model="edit.width" ng-change="updatePrice()">
								<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
								<input type="number" step="0.1" class="form-control text-xs-center" placeholder="Length" ng-model="edit.length" ng-change="updatePrice()">
								<span class="input-group-addon">cm</span>
							</div>
						</div>
						<div class="form-group">
							<div class="form-control-title">Sisi Cetak</div>
							<div class="btn-group width-100">
								<button class="btn btn-outline-purple width-50" ng-click="edit.sideprint=1; updatePrice()" ng-class="{'active':edit.sideprint==1}">1 Sisi (semuka)</button>
								<button class="btn btn-outline-purple width-50" ng-click="edit.sideprint=2; updatePrice()" ng-class="{'active':edit.sideprint==2}">2 Sisi (bolak balik)</button>
							</div>
						</div>

						<div class="form-group">
							<div class="card card-outline-purple">
								<!-- <div class="card-header bg-purple">Harga</div> -->
								<div class="card-block text-xs-center">
									<div class="row margin-0">
										<div class="col-xs-4" ng-click="edit.sideprint=1">
											<div class="gray">Harga Per-lembar</div>
											<div class="size-36 bebas margin-bottom-min15">[[edit.totalprice/edit.quantity/500|number:2]]</div>
											<div class="gray">rupiah</div>
										</div>
										<div class="col-xs-4" ng-click="edit.sideprint=2">
											<div class="gray">Harga Per-rim</div>
											<div class="size-36 bebas margin-bottom-min15">[[edit.totalprice/edit.quantity|number:0]]</div>
											<div class="gray">rupiah</div>
										</div>
										<div class="col-xs-4" ng-click="edit.sideprint=2">
											<div class="gray">Harga TOTAL</div>
											<div class="size-36 bebas margin-bottom-min15">[[edit.totalprice|number:0]]</div>
											<div class="gray">rupiah</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-purple" ng-click="updateSpec()">Update <span class="text-regular">(on progress)</span></button>
			</div>
		</div>
  </div>
</div>