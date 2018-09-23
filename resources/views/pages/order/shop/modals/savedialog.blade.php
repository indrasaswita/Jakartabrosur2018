<div class="modal fade" id="savedialogModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		<!-- <h4 class="modal-title" id="myModalLabel">
			Lihat sekali lagi, sebelum SIMPAN
		</h4> -->
		<div class="modal-title text-xs-center">
			[[datas.name]] ([[selected.printtype]])
		</div>
	  </div>
		<div class="modal-body">
			
			<div class="panel-block">
				<div class="header">
					<div class="txt tx-lightgray">
						DETAIL / SPESIFIKASI
					</div>
					<div class="line"></div>
				</div>
				<div class="list">
					<div class="txt">
						Judul Cetakan
					</div>
					<div class="input">
						[[selected.jobtitle]]
					</div>
				</div>

				<div class="list">
					<div class="txt">
						Jumlah Cetakan
					</div>
					<div class="input">
						[[selected.quantity]] [[datas.satuan]]
					</div>
				</div>

				<div class="list">
					<div class="txt">
						Ukuran
					</div>
					<div class="input">
						[[selected.size.width]] x [[selected.size.length]] cm <span ng-show="selected.size.shortname!='Custom'">(selected.size.name)</span>
					</div>
				</div>

				<div class="list">
					<div class="txt">
						Bahan
					</div>
					<div class="input">
						[[selected.paper.name]]
						<span ng-show="selected.paper.gramature>0"> [[selected.paper.gramature]] gsm</span>
						<span ng-show="selected.paper.color!=''">, wrn:[[selected.paper.color]]</span>
					</div>
				</div>

				<div class="list">
					<div class="txt">
						Sisi Cetak
					</div>
					<div class="input">
						[[selected.sideprint]] sisi
					</div>
				</div>
			</div>

			<div class="panel-block">
				<div class="header">
					<div class="txt tx-lightgray">
						DESKRIPSI TAMBAHAN
					</div>
					<div class="line"></div>
				</div>
				<div class="list">
					<div class="txt">
						Catatan Pekerjaan 
					</div>
					<div class="input">
						<span class="text-regular tx-lightgray" ng-show="result.itemdescription==''">
							Tidak ada catatan tambahan 
							<span class="glyphicon glyphicon-warning-sign tx-warning"></span>
						</span>
						[[selected.itemdescription]]
					</div>
				</div>
				<div class="list">
					<div class="txt">
						Pesan Tambahan
					</div>
					<div class="input">
						<span class="text-regular tx-lightgray" ng-show="result.customernote==''">
							Tidak ada pesan tambahan dari Anda
							<span class="glyphicon glyphicon-warning-sign tx-warning"></span>
						</span>
						[[selected.customernote]]
					</div>
				</div>
			</div>

			<div class="panel-block">
				<div class="header">
					<div class="txt tx-lightgray">
						FINISHING
					</div>
					<div class="line"></div>
				</div>
				<div class="list" ng-repeat="item in selected.finishings" ng-show="item.id!=0">
					<div class="txt">
						[[item.finishingname]]
					</div>
					<div class="input">
						[[item.optionname]]
					</div>
				</div>
			</div>

			<div class="panel-block">
				<div class="header">
					<div class="txt tx-lightgray">
						LAIN-LAIN
					</div>
					<div class="line"></div>
				</div>
				<div class="list">
					<div class="txt">
						Jlh. perBungkus
					</div>
					<div class="input">
						[[selected.perbungkus]] [[datas.satuan]]
					</div>
				</div>
				<div class="list">
					<div class="txt">
						Nama Pengirim
					</div>
					<div class="input">
						<span class="" ng-hide="selected.reseller=='std'">
							[[selected.resellername]]
							<span class="text-regular" ng-show="selected.resellerphone!=''">
								 [[selected.resellerphone]]
							</span>
							<span class="text-regular" ng-show="selected.resellerphone!=''">
								 [[selected.reselleraddress]]
							</span>
						</span>
						<span class="" ng-show="selected.reseller=='std'">
							<span class="tx-purple">jakartabrosur</span><span class="tx-lightgray">.com</span>
						</span>
					</div>
				</div>
				<div class="list">
					<div class="txt">
						Proses Cetak
					</div>
					<div class="input">
						<span class="" ng-show="selected.processtime=='std'">
							<i class="fa fa-road size-90p tx-primary"></i> 
							Standard
						</span>
						<span class="" ng-show="selected.processtime=='exp'">
							<i class="fa fa-rocket size-90p tx-danger"></i> 
							Express
						</span>
					</div>
				</div>
				<div class="list">
					<div class="txt">
						Lama Pengerjaan
					</div>
					<div class="input">
						[[total.processday]] hari
					</div>
				</div>
				<div class="list">
					<div class="txt">
						Estimasi Kirim
					</div>
					<div class="input">
						[[total.afterprintdom]], [[total.afterprint]]
					</div>
				</div>
				<div class="list">
					<div class="txt">
						Detail Kirim
					</div>
					<div class="input">
						[[selected.delivery.deliveryname]]  
						<small class="glyphicon glyphicon-chevron-right tx-lightgray"></small>
						 Rp [[total.deliv]],-
					</div>
				</div>
				<div class="list">
					<div class="txt">
						Lama Kirim
					</div>
					<div class="input">
						[[total.deliveryday]] hari 
						<span class="text-regular tx-lightgray" ng-show="total.deliveryday==0">(same day service)</span>
					</div>
				</div>
				<div class="list">
					<div class="txt">
						Estimasi Sampai
					</div>
					<div class="input">
						[[total.afterdeliverydom]], [[total.afterdelivery]]
					</div>
				</div>
			</div>

			<div class="panel-block">
				<div class="header">
					<div class="txt tx-lightgray">
						HARGA
					</div>
					<div class="line"></div>
				</div>
				<div class="list">
					<table class="table table-sm table-center">
						<thead class="tx-purple">
							<tr>
								<th>Cetak</th>
								<th></th>
								<th>Ongkir</th>
								<th></th>
								<th>(Disc.)</th>
								<th></th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>[[total.price|number:0]]</td>
								<td class="text-bold tx-lightmagenta">+</td>
								<td>[[total.deliv|number:0]]</td>
								<td class="text-bold tx-lightmagenta">-</td>
								<td>[[total.disc|number:0]]</td>
								<td class="text-bold tx-lightmagenta">=</td>
								<td class="text-bold">
									<span class="input">[[(total.price+total.deliv-total.disc)|number:0]]</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="panel-block">
				<div class="header">
					<div class="txt tx-lightgray">
						FILES
					</div>
					<div class="line"></div>
				</div>
				<div class="list">
					<table class="table table-sm table-center">
						<thead class="tx-purple">
							<tr>
								<th>#</th>
								<th>Icon</th>
								<th>Nama File</th>
								<th>Keterangan</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="item in selected.files">
								<td>
									[[zeroFill($index+1,2)]].
								</td>
								<td class="width-min">
									<img ng-src="{{URL::asset('')}}[[item.icon]]" width="30px" height="30px">
								</td>
								<td>
									<div class="line-11" title="[[item.filename]]">
										[[singkatText(item.filename, 20, '.')]]
									</div>
									<div class="size-12">
										[[(item.size/1024)|number:1]] KB &middot; 
										<span class="tx-lightmagenta">[[item.created_at]]</span>
									</div>
								</td>
								<td>
									-
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="alert alert-sm alert-danger" ng-show="error.savebtnval!=''">
				[[error.savebtnval]]
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-purple" data-dismiss="modal">BATAL</button>
			<button type="button" class="btn btn-purple" data-dismiss="modal" ng-click="saveData()">SIMPAN</button>
		</div>
	</div>
  </div>
</div>