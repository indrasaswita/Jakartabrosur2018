<div class="modal fade" id="updateDeliveryModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					Buat Pengiriman
				</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-sm table-custom-allsales">
					<thead class="text-center">
						<tr>
							<th class="">Judul</th>
							<th class="">Qty</th>
							<th class="hidden-xs-down">Koli</th>
							<th class="width-min"></th>
						</tr>
					</thead>
					<tbody ng-repeat="detail in selecteddelivery.salesdeliverydetail">
						<tr class="content-header text-center">
							<td>[[detail.salesdetail.cartheader.jobtitle]]</td>
							<td class="">[[detail.salesdetail.cartheader.quantity|number:0]] [[detail.salesdetail.cartheader.quantitytypename]]</td>
							<td class="hidden-xs-down">[[detail.salesdetail.cartheader.totalpackage|number:0]] koli</td>
							<td class="th-action">
								<div class="btn-group">
									<button class="btn btn-sm" ng-click="detail.deliveryshow=reversestatus(detail.deliveryshow)">
										<i class="fa fa-chevron-down transition" ng-class="{'rotate':detail.deliveryshow}"></i>
									</button>
								</div>
							</td>
						</tr>
						<tr class="content-detail detail-item" ng-show="detail.deliveryshow">
							<td class="" colspan="10">
								<div class="detail">
									<table class="table table-sm">
										<tbody>
											<tr>
												<td class="text-xs-right">
													Harga (<b>Rp</b>)
												</td>
												<td>
													<input type="number" class="form-control-sm form-control" ng-model="detail.actualprice" placeholder="Harga Kirim + Parkir">
												</td>
											</tr>
											<tr>
												<td class="text-xs-right">
													Jumlah (<b>[[detail.salesdetail.cartheader.quantitytypename]]</b>)
												</td>
												<td>
													<input type="number" class="form-control-sm form-control" ng-model="detail.quantity" placeholder="Jumlah Kirim">
												</td>
											</tr>
											<tr>
												<td class="text-xs-right">
													Berat (<b>kg</b>)
												</td>
												<td>
													<input type="number" class="form-control-sm form-control" ng-model="detail.weight" placeholder="Total Berat">
												</td>
											</tr>
											<tr>
												<td class="text-xs-right">
													Jlh. Koli
												</td>
												<td>
													<input type="number" class="form-control-sm form-control" ng-model="detail.totalpackage" placeholder="Total Koli">
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</td>
						</tr>
					</tbody>
				</table>

				<table class="table table-sm table-custom-allsales">
					<tbody>
						<tr>
							<td class="text-xs-right">
								Waktu Sampai
							</td>
							<td>
								<input type="datetime-local" class="form-control-sm form-control" ng-model="selecteddelivery.arrivedtime" placeholder="Harga Kirim + Parkir">
							</td>
						</tr>
						<tr>
							<td class="text-xs-right">
								Penerima
							</td>
							<td>
								<input class="form-control form-control-sm" type="text" ng-model="selecteddelivery.receiver">
							</td>
						</tr>
						<tr>
							<td class="text-xs-right">
								No. Resi
							</td>
							<td>
								<input class="form-control form-control-sm" type="text" ng-model="selecteddelivery.suratno">
							</td>
						</tr>
						<tr>
							<td class="text-xs-right">
								Alamat
							</td>
							<td>
								<input class="form-control form-control-sm" type="text" ng-model="selecteddelivery.address">
							</td>
						</tr>
						<tr>
							<td class="text-xs-right">
								Catatan
							</td>
							<td>
								<input class="form-control form-control-sm" type="text" ng-model="selecteddelivery.employeenote">
							</td>
						</tr>
						<tr>
							<td class="text-xs-right">
								Tipe
							</td>
							<td>
								<select class="form-control form-control-sm" ng-model="selecteddelivery.deliveryID" ng-options="item.id as item.deliveryname for item in deliveries"></select>
							</td>
						</tr>
						<tr>
							<td class="text-xs-right">
								Kurir
							</td>
							<td>
								<select class="form-control form-control-sm" ng-model="selecteddelivery.employeeID" ng-options="item.id as item.name for item in couriers"></select>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<div class="btn-group">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-purple"ng-click="updateDelivery()">Ubah</button>
				</div>
			</div>
		</div>
	</div>
</div>