<div ng-controller="AdmSalesadddeliveryController" class="admsales-adddelivery-modal">
	<div class="modal fade" id="addDeliveryModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-xl" role="document">
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

					<div class="table-top" ng-repeat="detail in headers[selectedheaderindex].salesdetail" ng-click="setDeliverydetail(detail)">
						<div class="list" ng-class="{'selected':detail.deliveryselected}">
							<div class="list-header">
								[[detail.cartheader.quantity|number:0]] [[detail.cartheader.quantitytypename]]
								[[detail.cartheader.jobtitle]] ±[[detail.cartheader.totalweight|number:0]] kg
							</div>
							<div class="list-detail">
								dibungkus jadi [[detail.cartheader.totalpackage|number:0]] pack.<br>
								<b>[[detail.cartheader.delivery.deliveryname]]</b> -- Rp [[detail.cartheader.deliveryprice|number:0]]
								<br>Permintaan pengiriman ke [[detail.cartheader.deliveryaddress.address]], [[detail.cartheader.deliveryaddress.city.name]]
								<div class="tx-red" ng-show="detail.cartheader.customernote.length > 3">
									[[detail.cartheader.customernote]]
								</div>
							</div>
						</div>
					</div>

					<div class="table-bottom" ng-show="newdelivery.deliverydetail.length>0">
						<div class="header">
							Surat Jalan
						</div>

						<div class="list">
							<div class="list-header">
								<div class="header-date">
									<div>
										<select class="form-control form-control-sm" ng-model="newdelivery.deliveryID" ng-options="item.id as item.deliveryname for item in deliveries"></select>
										<select class="form-control form-control-sm" ng-model="newdelivery.employeeID" ng-options="item.id as item.name for item in couriers"></select>
									</div>
									<div>
										<input type="date" class="form-control-sm form-control text-xs-right" ng-model="newdelivery.arriveddate">
										<input type="time" class="form-control-sm form-control text-xs-right" ng-model="newdelivery.arrivedtime">
									</div>
								</div>
								<div class="header-to">
									Kepada Yth.,
									<input type="text" class="form-control-sm form-control" ng-model="newdelivery.receiver" placeholder="Nama Penerima">
									<select class="form-control-sm form-control" ng-model="newdelivery.deliveryaddressID" ng-options="item.addressID as item.address.address+', '+item.address.city.name+' ['+item.address.name+']' for item in headers[selectedheaderindex].customer.customeraddress"></select>
									<div class="action" ng-if="!addnewaddress">
										<button class="btn btn-sm btn-primary" ng-click="setadddeliverystatus(true)">
											<i class="fas fa-plus fa-fw"></i>
											Tambah Alamat Baru
										</button>
									</div>
								</div>
								<div class="header-to" ng-if="addnewaddress">
									Tambah New CustomerAddress
									<input class="form-control form-control-sm" ng-model="newaddress.name" placeholder="Nama Lokasi (Kantor, Gudang, etc.)">
									<input class="form-control form-control-sm" ng-model="newaddress.location" placeholder="Alamat">
									<input class="form-control form-control-sm" ng-model="newaddress.note" placeholder="Ketemu Siapa & No. WA / Ada Catatan Khusus">
									<div ng-if="!cityloading">
										<select class="form-control-sm form-control" ng-model="newaddress.city" ng-options="item as item.name for item in cities track by item.id"></select>
									</div>
									<div ng-if="cityloading">
										City data is Loading..
									</div>
									<div class="action">
										<button class="btn btn-sm btn-secondary" ng-click="setadddeliverystatus(false)">
											Batal
										</button>
										<button class="btn btn-sm btn-primary" ng-click="insertcustomeraddress()">
											Tambah
										</button>
									</div>
								</div>
								<div class="suratjalan" ng-hide="newdelivery.deliveryID==1">
										<div id="fileSJ" class="title">
											Foto Resi / Surat Jalan
										</div>
										<input type="file" class="form-control-file" ng-model="newdelivery.suratimage" aria-describedby="fileSJ">
										<input type="text" class="form-control-sm form-control" ng-model="newdelivery.suratno" placeholder="No. Resi / No. Pengiriman (no JNE, no TIKI, no POS, no J&T, dll)">
								</div>
							</div>
							<div class="list-body">
								<div class="list-repeat" ng-repeat="detail in newdelivery.deliverydetail">
									<div class="title">
										<div class="number">
											[[zeroFill($index+1, 2)]]
										</div>
										[[detail.totalquantity|number:0]] [[detail.quantitytypename]] <b>[[detail.jobsubtype.name]]</b> [[detail.jobtitle]]
									</div>	
									<div class="ammount-wrapper">
										<div class="ammount-list">
											<label class="text">Jumlah Kirim</label>
											<input class="form-control form-control-sm text-xs-center" type="number" ng-model="detail.ammount">
										</div>
										<div class="ammount-list">
											<label class="text">Total Pack</label>
											<input class="form-control form-control-sm text-xs-center" type="number" ng-model='detail.totalpackage'>
										</div>
										<div class="ammount-list">
											<label class="text">Kirim [Rp]</label>
											<input type="number" class="form-control-sm form-control" ng-model="detail.actualprice" placeholder="Harga Kirim + Parkir">
										</div>
										<div class="ammount-list">
											<label class="text">Timbang [kg]</label>
											<input class="form-control form-control-sm" type="number" ng-model="detail.totalweight" placeholder="Hasil timbangan (hanya yg dikirim)">
										</div>
									</div>
								</div>
							</div>
							<div class="list-footer">
								<input type="text" class="form-control-sm form-control" ng-model="newdelivery.employeenote" placeholder="Catatan dari kurir atau admin (jika ada)">
							</div>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" ng-click="saveDelivery()">Save</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>