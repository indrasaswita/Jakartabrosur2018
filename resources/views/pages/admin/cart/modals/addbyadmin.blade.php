<!-- Modal -->
<div class="modal fade" id="addbyadminModal" tabindex="-1" role="dialog" ng-controller="AdminCartAddbyadminController">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title magra">TAMBAH KERANJANG!</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body magra">
				<div class="cart-header">
					<div class="customer-wrapper">
						<div class="find-customer" id="find-customer">
							Pilih Pelanggan
							<input class="typeahead form-control" type="text" placeholder="Nama Cust.">
						</div>
						<div class="customer-detail" ng-show="newcart.customersales!=null&&!customerloading">
							<table class="table table-sm">
								<tbody>
									<tr>
										<td>Transaksi</td>
										<td class="text-xs-right">
											[[newcart.customersales.totaltransaction|number:0]]x
										</td>
									</tr>
									<tr>
										<td>Utang</td>
										<td class="text-xs-right" ng-class="{'tx-danger':newcart.customersales.totaldebt>0}">
											Rp [[newcart.customersales.totaldebt|number:0]]
										</td>
									</tr>
									<tr>
										<td>Belanja</td>
										<td class="text-xs-right">
											Rp [[newcart.customersales.totalsales|number:0]]
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="customer-detail text-xs-center padding-20" ng-show="customerloading">
							<i class="fas fa-spinner fa-pulse fa-3x tx-info"></i>
						</div>
					</div>
					<div class="cart-input-detail">
						<div class="detail-row">
							<div class="label">Pilih Tipe</div>
							<div class="input">
								<select class="form-control" ng-model="newcart.jobsubtype" ng-options="item as item.name+' ('+item.subname+')' for item in jobsubtypes" ng-change="jobsubtypechanged()"></select>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Judul Cetakan</div>
							<div class="input">
								<input type="text" class="form-control" ng-model="newcart.jobtitle">
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Jumlah Item</div>
							<div class="input">
								<input type="text" class="form-control" ng-model="newcart.quantity">
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Satuan</div>
							<div class="input">
								<input type="text" class="form-control" ng-model="newcart.quantitytypename" disabled>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Deskripsi</div>
							<div class="input">
								<input type="text" class="form-control" ng-model="newcart.itemdescription" placeholder="Ket. Tambahan">
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Pengirim</div>
							<div class="input">
								<input type="text" class="form-control" ng-model="newcart.reseller" placeholder="jakartabrosur.com">
							</div>
						</div>
						<div class="detail-row" ng-show="newcart.reseller.length>0">
							<div class="label">
								<small class="fas fa-phone-square tx-gray"></small>
								Reseller
							</div>
							<div class="input">
								<input type="text" class="form-control" ng-model="newcart.resellerphone" placeholder="Contact">
							</div>
						</div>
						<div class="detail-row" ng-show="newcart.reseller.length>0">
							<div class="label">
								<small class="fas fa-home tx-gray"></small>
								Reseller
							</div>
							<div class="input">
								<input type="text" class="form-control" ng-model="newcart.reselleraddress" placeholder="Alamat">
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Harga Beli</div>
							<div class="input">
								<div class="input-group">
									<span class="input-group-addon size-90p">Rp</span>
									<input type="number" min="0" ng-min="0" class="form-control text-xs-right" ng-model="newcart.buyprice">
									<span class="input-group-addon size-90p" data-title="<b class='tx-red'>Hanya dapat dilihat karyawan</b>" data-placement="left" data-html="true" data-toggle="tooltip">
										<i class="fas fa-user-secret tx-red"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Harga Cetak</div>
							<div class="input">
								<div class="input-group">
									<span class="input-group-addon size-90p">Rp</span>
									<input type="number" min="0" ng-min="0" class="form-control text-xs-right" ng-model="newcart.printprice">
								</div>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Harga Kirim</div>
							<div class="input">
								<div class="input-group">
									<span class="input-group-addon size-90p">Rp</span>
									<input type="number" min="0" ng-min="0" class="form-control text-xs-right" ng-model="newcart.deliveryprice">
								</div>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Diskon</div>
							<div class="input">
								<div class="input-group" data-title="<b class='tx-red'>Potongan</b>" data-placement="left" data-html="true" data-toggle="tooltip">
									<span class="input-group-addon size-90p">Rp</span>
									<input type="number" min="0" ng-min="0" class="form-control text-xs-right" ng-model="newcart.discount">
								</div>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Packing</div>
							<div class="input">
								<div class="input-group">
									<span class="input-group-addon size-90p" data-title="<b class='text-primary'>jumlah pack =</b>" data-placement="right" data-html="true" data-toggle="tooltip"><i class="fas fa-archive"></i></span>
									<input type="number" min="0" ng-min="0" class="form-control text-xs-right" ng-model="newcart.totalpackage" placeholder="pack">
									<span class="input-group-addon size-90p" data-title="<b class='text-primary'>berat total =</b>" data-placement="right" data-html="true" data-toggle="tooltip"><i class="fas fa-balance-scale"></i></span>
									<input type="number" min="0" ng-min="0" step="0.1" ng-step="0.1" class="form-control text-xs-right" ng-model="newcart.totalweight" placeholder="weight">
								</div>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">
								Process <i class="fas fa-cog tx-lightgray"></i>
							</div>
							<div class="input">
								<div class="input-group">
									<div class="input-group-btn">
										<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											[[newcart.processtype]]
										</button>
										<div class="dropdown-menu">
											<a class="dropdown-item" href="#" ng-click="newcart.processtype='std'">Standard</a>
											<a class="dropdown-item" href="#" ng-click="newcart.processtype='exp'">Express</a>
										</div>
									</div>
									
									<input type="date"class="form-control text-xs-right" ng-model="newcart.deadline" placeholder="weight" data-title="<span class='tx-red'><b>deadline</b><br>wkt. proses</span>" data-placement="left" data-toggle="tooltip" data-html='true'>
								</div>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Delivery</div>
							<div class="input">
								<div class="input-group">
									<select class="form-control" ng-model="newcart.delivery" ng-options="item as item.deliveryname for item in deliveries"></select>
								</div>
							</div>
						</div>
						<div class="detail-row" ng-show="newcart.delivery.locked==0">
							<div class="label">Almt. Kirim</div>
							<div class="input">
								<div class="input-group">
									<input type="text" class="form-control" ng-model="newcart.deliveryaddress">
								</div>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Wkt. Kirim</div>
							<div class="input">
								<div class="input-group">
									<input type="datetime-local text-xs-right" class="form-control" ng-model="newcart.deliverytime">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="cart-detail" ng-repeat="detail in newcart.cartdetails">
					<div class="cart-input-detail">
						<div class="detail-row">
							<div class="label">Job Type</div>
							<div class="input">
								<div class="btn-group">
									<button class="btn btn-sm" ng-class="{'btn-purple':item2==detail.jobtype,'btn-secondary':item2!=detail.jobtype}" ng-repeat="item2 in jobtypesymbols" ng-click="detail.jobtype = item2">
										[[item2]]
									</button>
								</div>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">
								Nama 
								<i class="fa fa-shopping-cart tx-lightgray"></i>
							</div>
							<div class="input">
								<div class="input-group">
									<span class="input-group-addon">#[[($index+1)|number:0]]</span>
									<input type="text" class="form-control" ng-model="detail.cartname" placeholder="Nama Unik">
								</div>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Kertas</div>
							<div class="input">
								<select class="form-control" ng-model="detail.paper" ng-options="item as item.name+(printgramature(item.gramature))+' ('+item.color+')' for item in papers" ng-change="getVendorPlanoByPaperID($index, detail.paper.id)"></select>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Uk Plano</div>
							<div class="input" ng-show="detail.planos!=null">
								<select class="form-control" ng-model="detail.planosize" ng-options="item as item.width+'x'+item.length for item in detail.planos" ng-change="planosizechanged($index)"></select>
							</div>
							<div class="input" ng-hide="detail.planos!=null">
								<div class="tx-danger form-control">No Data!</div>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">
								Toko 
								<i class="fa fa-sticky-note tx-lightgray"></i>
							</div>
							<div class="input" ng-show="detail.vendors!=null">
								<select class="form-control" ng-model="detail.vendor" ng-options="item as item.name for item in detail.vendors"></select>
							</div>
							<div class="input" ng-hide="detail.vendors!=null">
								<div class="tx-danger form-control">No Data!</div>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Jlh. Plano</div>
							<div class="input" data-placement="right" data-title="<b>lembar</b>" data-html="true" data-toggle="tooltip">
								<div class="input-group">
									<input type="number" min="0" ng-min="0" class="form-control" ng-model="detail.totalplano" ng-change="checktotaldruct($index)">
									<span class="input-group-btn size-90p">
										<button class="btn btn-sm btn-secondary" type="button" ng-click="calctotalplano($index)">
											<i class="fas fa-calculator text-primary"></i>
										</button>
									</span>
								</div>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Hrg. Kertas</div>
							<div class="input">
								<div class="input-group">
									<input type="number" min="0" ng-min="0" class="form-control text-xs-right" ng-model="detail.paperprice">
									<span class="input-group-addon size-90p" data-title="<b class='tx-red'>Hanya dapat dilihat karyawan</b>" data-placement="left" data-html="true" data-toggle="tooltip" tooltip>
										<i class="fas fa-user-secret tx-red"></i>
									</span>
									<div class="input-group-btn size-90p">
										<button class="btn btn-sm btn-secondary" ng-click="getHargaKertas($index)">
											<i class="fas fa-calculator text-primary"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Uk Cetak</div>
							<div class="input">
								<div class="input-group" data-title="<b>cm</b>" data-placement="right" data-html="true" data-toggle="tooltip">
									<input type="number" min="0" ng-min="0" class="form-control text-xs-center" ng-model="detail.printwidth">
									<span class="input-group-addon">x</span>
									<input type="number" min="0" ng-min="0" class="form-control text-xs-center" ng-model="detail.printlength">
								</div>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Uk Jadi</div>
							<div class="input">
								<div class="input-group" data-title="<b>cm</b>" data-placement="right" data-html="true" data-toggle="tooltip">
									<input type="number" min="0" ng-min="0" class="form-control text-xs-center" ng-model="detail.imagewidth">
									<span class="input-group-addon">x</span>
									<input type="number" min="0" ng-min="0" class="form-control text-xs-center" ng-model="detail.imagelength">
								</div>
							</div>
						</div>
					</div>
					<div class="cart-input-detail">
						<div class="detail-row">
							<div class="label">Printer</div>
							<div class="input">
								<select class="form-control" ng-model="detail.printerID" ng-options="item.id as item.machinename for item in printers"></select>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Druct</div>
							<div class="input">
								<div class="input-group">
									<input type="number" min="0" ng-min="0" class="form-control" ng-model="detail.totaldruct" ng-change="checktotaldruct($index)">
									<span class="input-group-addon size-90p" ng-show="!detail.planoqtyerror">
										<i class="fas fa-check tx-success"></i>
									</span>
									<span class="input-group-addon size-90p" ng-show="detail.planoqtyerror" data-toggle="tooltip" data-placement="left" data-title="jumlah plano salah" tooltip>
										<i class="fas fa-times tx-red"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Inschiet</div>
							<div class="input">
								<div class="input-group">
									<input type="number" min="0" ng-min="0" class="form-control" ng-model="detail.inschiet" ng-change="checktotaldruct($index)">
									<span class="input-group-addon size-90p" ng-show="!detail.planoqtyerror">
										<i class="fas fa-check tx-success"></i>
									</span>
									<span class="input-group-addon size-90p" ng-show="detail.planoqtyerror" data-toggle="tooltip" data-placement="left" data-title="jumlah plano salah" tooltip>
										<i class="fas fa-times tx-red"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Jlh. PerPlano</div>
							<div class="input">
								<div class="input-group" data-title="<b class='tx-purple'>X</b> x <b class='tx-purple'>Y</b> + <b class='tx-purple'>sisa</b>" data-placement="top" data-html="true" data-toggle="tooltip">
									<input type="number" min="0" ng-min="0" class="form-control text-xs-center" ng-model="detail.totalinplanox" ng-change="detail.totalinplano=detail.totalinplanox*detail.totalinplanoy+detail.totalinplanorest">
									<span class="input-group-addon">x</span>
									<input type="number" min="0" ng-min="0" class="form-control text-xs-center" ng-model="detail.totalinplanoy" ng-change="detail.totalinplano=detail.totalinplanox*detail.totalinplanoy+detail.totalinplanorest">
									<span class="input-group-addon">+</span>
									<input type="number" min="0" ng-min="0" class="form-control text-xs-center" ng-model="detail.totalinplanorest" ng-change="detail.totalinplano=detail.totalinplanox*detail.totalinplanoy+detail.totalinplanorest" ng-change="checktotaldruct($index)">
								</div>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Bagian Plano</div>
							<div class="input">
								<div class="input-group">
									<input type="text" min="0" ng-min="0" class="form-control text-xs-center" ng-model="detail.totalinplano" ng-change="checktotaldruct($index)" disabled>
									<span class="input-group-addon size-80p">per-plano</span>
								</div>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Jlh. PerCetak</div>
							<div class="input">
								<div class="input-group" data-title="<b class='tx-purple'>X</b> x <b class='tx-purple'>Y</b> + <b class='tx-purple'>sisa</b>" data-placement="top" data-html="true" data-toggle="tooltip">
									<input type="number" min="0" ng-min="0" class="form-control text-xs-center" ng-model="detail.totalinprintx" ng-change="detail.totalinprint=detail.totalinprintx*detail.totalinprinty+detail.totalinprintrest">
									<span class="input-group-addon">x</span>
									<input type="number" min="0" ng-min="0" class="form-control text-xs-center" ng-model="detail.totalinprinty" ng-change="detail.totalinprint=detail.totalinprintx*detail.totalinprinty+detail.totalinprintrest">
									<span class="input-group-addon">+</span>
									<input type="number" min="0" ng-min="0" class="form-control text-xs-center" ng-model="detail.totalinprintrest" ng-change="detail.totalinprint=detail.totalinprintx*detail.totalinprinty+detail.totalinprintrest">
								</div>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Bagian Cetak</div>
							<div class="input">
								<div class="input-group">
									<input type="text" min="0" ng-min="0" class="form-control text-xs-center" ng-model="detail.totalinprint" disabled>
									<span class="input-group-addon size-80p">per-kertas</span>
								</div>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Sisi Cetak</div>
							<div class="input">
								<div class="input-group">
									<input type="number" min="0" ng-min="0" class="form-control text-xs-center" ng-model="detail.side1">
									<span class="input-group-addon">/</span>
									<input type="number" min="0" ng-min="0" class="form-control text-xs-center" ng-model="detail.side2">
								</div>
							</div>
						</div>
						<div class="detail-row">
							<div class="label">Catatan</div>
							<div class="input">
								<div class="input-group">
									<input type="text" class="form-control" ng-model="detail.employeenote" placeholder="internal">
									<span class="input-group-addon size-90p" data-title="<b class='tx-red'>Hanya dapat dilihat karyawan</b>" data-placement="left" data-html="true" data-toggle="tooltip">
										<i class="fas fa-user-secret tx-red"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
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