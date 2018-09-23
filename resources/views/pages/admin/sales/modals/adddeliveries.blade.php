<div class="modal fade" id="addDeliveryModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">
					Buat Pengiriman
				</h4>
			</div>
			<div class="modal-body">
				<table class="table table-sm table-custom-allsales">
					<thead class="text-center">
						<tr>
							<th class="width-min"></th>
							<th class="width-min">#Inv</th>
							<th class="">Judul</th>
							<th class="">Qty</th>
							<th class="">Harga</th>
							<th class="">Berat</th>
							<th class="">Koli</th>
						</tr>
					</thead>
					<tbody ng-repeat="detail in headers[selectedheaderindex].salesdetail">
						<tr class="content-header text-center">
							<td>
								<a class="size-140p" href="" ng-click="setDeliverydetail(detail)">
									<i class="fa" ng-class="{'fa-toggle-off tx-gray':!detail.deliveryselected, 'fa-toggle-on tx-success':detail.deliveryselected}"></i>
								</a>
							</td>
							<td>#[[zeroFill(headers[selectedheaderindex].id, 5)]]</td>
							<td>[[detail.cartheader.jobtitle]]</td>
							<td>[[detail.cartheader.quantity|number:0]] [[detail.cartheader.quantitytypename]]</td>
							<td>
								<span class="hidden-sm-down">Rp </span>[[detail.cartheader.deliveryprice|number:0]]
							</td>
							<td>
								±[[detail.cartheader.totalweight|number:0]] kg
							</td>
							<td>
								[[detail.cartheader.totalpackage|number:0]]<span class="hidden-sm-down"> koli</span>
							</td>
						</tr>
						<tr class="content-detail detail-item">
							<td class="" colspan="10">
								<div class="detail">
									<b>[[detail.cartheader.delivery.deliveryname]]</b><br>[[detail.cartheader.deliveryaddress]]
									<div class="tx-red" ng-show="detail.cartheader.customernote.length > 5">
										[[detail.cartheader.customernote]]
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>

				<div class="alert alert-sm alert-outline-lightmagenta text-xs-center size-80p tx-gray">
					<i class="fa fa-arrow-up"></i>
					pilih barang yang dikirim, diatas
					<i class="fa fa-arrow-up"></i>
					<hr class="margin-5">
					<i class="fa fa-hand-o-down"></i>
					<b>lengkapi pengiriman, dibawah</b>
					<i class="fa fa-hand-o-down"></i>
				</div>
				[[newdelivery.deliverydetail.length]]
				<table class="table table-sm table-custom-allsales">
					<thead class="text-center">
						<tr>
							<th class="width-min">#</th>
							<th class="">Judul</th>
							<th class="hidden-sm-down">Qty</th>
							<th class="">di Kirim</th>
							<th class="">Koli</th>
							<th class="width-min"></th>
						</tr>
					</thead>
					<tbody ng-repeat="detail in newdelivery.deliverydetail">
						<tr class="content-header text-center">
							<td class="text-bold">[[$index+1]].</td>
							<td>[[detail.jobtitle]]</td>
							<td class="hidden-sm-down">[[detail.totalquantity|number:0]] [[detail.quantitytypename]]</td>
							<td>
								<input class="form-control form-control-sm text-xs-center" type="number" ng-model="detail.ammount">
							</td>
							<td>
								<input class="form-control form-control-sm text-xs-center" type="number" ng-model='detail.totalpackage'>
							</td>
							<td>
								<button class="btn btn-outline-purple btn-sm" ng-click="detail.deliveryshow=reversestatus(detail.deliveryshow)">
									<i class="fa fa-chevron-down transition" ng-class="{'rotate':detail.deliveryshow}"></i>
								</button>
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
													Berat (<b>kg</b>)
												</td>
												<td>
													<input class="form-control form-control-sm" type="number" ng-model="detail.totalweight" placeholder="Hasil timbangan (hanya yg dikirim)">
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
							<td>
								Tipe
							</td>
							<td>
								<select class="form-control form-control-sm" ng-model="newdelivery.deliveryID" ng-options="item.id as item.deliveryname for item in deliveries"></select>
							</td>
						</tr>
						<tr class="">
							<td>
								Kurir
							</td>
							<td>
								<select class="form-control form-control-sm" ng-model="newdelivery.employeeID" ng-options="item.id as item.name for item in couriers"></select>
							</td>
						</tr>
						<tr class="" ng-hide="newdelivery.deliveryID==1">
							<td>
								Alamat
							</td>
							<td>
								<input type="text" class="form-control-sm form-control" ng-model="newdelivery.deliveryaddress" placeholder="Alamat Kirim">
							</td>
						</tr>
						<tr class="">
							<td>
								Penerima
							</td>
							<td>
								<input type="text" class="form-control-sm form-control" ng-model="newdelivery.receiver" placeholder="Nama Penerima">
							</td>
						</tr>
						<tr class="" ng-hide="newdelivery.deliveryID==1">
							<td>
								No. SJ
							</td>
							<td>
								<input type="text" class="form-control-sm form-control" ng-model="newdelivery.suratno" placeholder="No. Resi / No. Surat Jalan (LENGKAP)">
							</td>
						</tr>
						<tr class="" ng-hide="newdelivery.deliveryID==1">
							<td>
								Foto SJ
							</td>
							<td>
								<div class="form-group">
									<input type="file" class="form-control-file" ng-model="newdelivery.suratimage" aria-describedby="fileSJ">
									<small id="fileSJ" class="form-text text-muted">
										Foto Resi / Surat Jalan
									</small>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								Catatan
							</td>
							<td>
								<input type="text" class="form-control-sm form-control" ng-model="newdelivery.employeenote" placeholder="Catatan dari kurir atau admin">
							</td>
						</tr>
						<tr class="">
							<td>
								Tanggal
							</td>
							<td>
								<input type="date" class="form-control-sm form-control" ng-model="newdelivery.arriveddate">
								<span class="tx-lightgray size-80p">
									Format: 
								</span>
								<span class="tx-purple size-80p">
									<b>Bulan</b> / <b>Tanggal</b> / <b>Tahun</b>
								</span>
							</td>
						</tr>
						<tr class="">
							<td>
								Waktu Tiba
							</td>
							<td>
								<input type="time" class="form-control-sm form-control" ng-model="newdelivery.arrivedtime">
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<div class="btn-group">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-purple"ng-click="saveDelivery()">Save</button>
				</div>
			</div>
		</div>
	</div>
</div>