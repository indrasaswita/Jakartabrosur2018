<div class="order-panel tab-pane fade in active" id="calculation">

	<div class="panel-block">
		<!-- <div class="block-divider"></div> -->
		<div class="block-list">
			<div class="input">
				<div class="btn-group print-type">
					<button class="btn" ng-class="{'active':selected.printtype=='OF'}" ng-click="setprinttype('OF')" ng-disabled="datas.digitaloffset==2">
						OFFSET
					</button>
					<button class="btn" ng-class="{'active':selected.printtype=='DG'}" ng-click="setprinttype('DG')" ng-disabled="datas.digitaloffset==1">
						DIGITAL
					</button>
				</div>
				<div class="info" data-toggle="tooltip" data-title="<b>Offset:</b><br>Unggul: murah, presisi<br>Lemah: proses memakan waktu, harus jumlah banyak<br><br><b>Digital:</b><br>Unggul: bisa ditunggu, bisa cetak 1 lembar<br>Lemah: kurang presisi, harga satuan lebih mahal" data-html="true" data-placement="left">
					<span class="far fa-question-circle"></span>
				</div>
			</div>
		</div>
		<div class="block-list hidden-sm-up" ng-show="datas.jobsubtypetemplate.length>0">
			<div class="input">
				<button class="btn btn-success line-11 size-14 text-xs-left width-100" ng-click="showeasyaccess()">
					<i class="fas fa-user-md fa-2x pull-xs-left margin-right-10"></i>
					Butuh Bantuan?<br>
					<small>Klik disini untuk pilih detail template.</small>
				</button>
				<div class="info">
					<i class="far fa-question-circle tx-white"></i>
				</div>
			</div>
		</div>
		<div class="block-subdetail">
			<div class="txt">DETAIL PENCETAKAN</div>
			<div class="line"></div>
		</div>
		<div class="block-list">
			<div class="txt">
				Jumlah
				<span class="hidden-xs-down"> 
					Print
				</span>
			</div>
			<div class="input">
				<div class="input-block">
					<div class="input-group">
						<span class="input-group-btn">
							<button class="btn btn-secondary" ng-click="decrement(datas.stepqty)">
								<span class="fas fa-minus"></span>
							</button>
						</span>
						<input type="text" class="form-control text-xs-center" value="[[selected.quantity|number:0]] [[datas.satuan]]" disabled>
						<span class="input-group-btn">
							<button class="btn btn-secondary" ng-click="increment(datas.stepqty)">
								<span class="fas fa-plus"></span>
							</button>
						</span>
						<span class="input-group-btn" ng-hide="datas.jobsubtypequantity.length==0">
							<button type="button" class="btn btn-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="fas fa-angle-double-down"></span>
							</button>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="" ng-click="setQty(item.quantity)" ng-repeat="item in datas.jobsubtypequantity">
									[[item.quantity|number:0]] [[datas.satuan]]
								</a>
							</div>
						</span>
					</div>
				</div>
				<div class="info" data-toggle="tooltip" data-title="[[datas.infoqty]]" data-html="true" data-placement="left">
					<span class="far fa-question-circle"></span>
				</div>
			</div>
		</div>

		
		<div class="block-list">
			<div class="txt">
				Uk. (cm)
			</div>
			<div class="input">
				<div class="select" ng-show="!customsize">
					<select class="form-control" data-width="100%" ng-options="item.size as showSize(item.size.id, item.size.name, item.size.width, item.size.length) for item in datas.jobsubtypesize" ng-model="selected.size" ng-change="sizeChanged(selected.size)">
					</select>
				</div>
				<div class="input-block" ng-class="{'border-red':selected.size.width==null||selected.size.width==0||selected.size.length==null||selected.size.length==0}" ng-show="customsize">
					<div class="input-group">
				<input type="number" class="form-control" ng-model="selected.size.width" ng-change="selected.size.width=num_validation(selected.size.width, 1, 10000, 0.01)" ng-blur="getPrice()">
						<span class="input-group-addon">
							<span class="fas fa-times"></span>
						</span>
						<input type="number" class="form-control" ng-model="selected.size.length"  ng-change="selected.size.length=num_validation(selected.size.length, 1, 10000, 0.01)" ng-blur="getPrice()">
						<div class="input-group-btn" ng-show="standardsize">
							<button type="button" class="btn btn-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="fas fa-chevron-down"></span>
							</button>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="" ng-click="changeToIntSize()">
									Uk. International
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="info" data-toggle="tooltip" data-title="[[datas.infosize]]" data-html="true" data-placement="left">
					<span class="far fa-question-circle"></span>
				</div>
			</div>
		</div>
		<div class="block-list" ng-show="datas.jobsubtypedetail==null||datas.jobsubtypedetail.length==0">
			<div class="txt">
				<span class="hidden-xs-down"> 
					Jenis
				</span>
				Material
			</div>
			<div class="input">
				<div class="select">
					<select class="form-control" data-width="100%" ng-options="item.paper as showMaterialName(item.paper.name, item.paper.gramature) for item in datas.jobsubtypepaper" ng-model="selected.paper" ng-change="matChanged(selected.paper, finishings)">
					</select>
				</div>
				<div class="info" data-toggle="tooltip" data-title="[[datas.infomaterial]]" data-html="true" data-placement="left">
					<span class="far fa-question-circle"></span>
				</div>
			</div>
		</div>
		<div class="block-list" ng-show="datas.jobsubtypedetail==null||datas.jobsubtypedetail.length==0">
			<div class="txt">
				Sisi
				<span class="hidden-xs-down">
					Cetak
				</span>
			</div>
			<div class="input">
				<div class="select">
					<select class="form-control" data-width="100%" ng-model="selected.sideprint" ng-change="getPrice()">
						<option ng-show="datas.sisicetak==1||datas.sisicetak==0" value="1">
							1 sisi cetak
						</option>
						<option ng-show="datas.sisicetak==2||datas.sisicetak==0" ng-disabled="selected.paper.papertypeID==10" value="2">
							2 sisi cetak
						</option>
					</select>
				</div>
				<div class="info" data-toggle="tooltip" data-title="[[datas.infosisicetak]]" data-html="true" data-placement="left">
					<span class="far fa-question-circle"></span>
				</div>
			</div>
		</div>

		<div ng-repeat="detail in datas.jobsubtypedetail track by $index" ng-show="datas.jobsubtypedetail.length>0">
			<div class="block-subdetail" >
				<div class="txt">
					<span class=" tx-lightgray">[[$index+1]].</span>&nbsp;
					<span class="tx-gray">DETAIL:</span>&nbsp;
					<span class="tx-lightmagenta signika size-120p" ng-bind-html="selected.jobsubtypedetail[$index].detailname">
					</span>
				</div>
				<div class="line"></div>
				<div class="right" ng-show="detail.temporary">
					<button class="btn btn-danger btn-xsm size-80p" ng-click="removeDetail($index)">
						Delete!
					</button>
				</div>
			</div>
			<div class="block-list">
				<div class="txt">
					Judul
					<span class="hidden-xs-down">
						Detail
					</span>
				</div>
				<div class="input">
					<div class="input-block">
						<div class="input-group">
							<input type="text" class="form-control text-xs-left" ng-model="selected.jobsubtypedetail[$index].detailname" placeholder="Judul Detail">
						</div>
					</div>
					<div class="info" data-toggle="tooltip" data-title="Judul Cetakan berupa nama yang unik untuk file pekerjaan Anda<br><br><b>buatlah berbeda dari pekerjaan yang lainnya</b>" data-html="true" data-placement="left">
						<span class="far fa-question-circle"></span>
					</div>
				</div>
			</div>
			<div class="block-list">
				<div class="txt">
					Jumlah
					<span class="hidden-xs-down">
						Model
					</span>
				</div>
				<div class="input">
					<div class="input-block">
						<div class="input-group">
							<span class="input-group-btn">
								<button class="btn btn-secondary" ng-click="decrementModel($index)">
									<span class="fas fa-minus"></span>
								</button>
							</span>
							<input type="text" class="form-control text-xs-center" value="[[selected.jobsubtypedetail[$index].multip|number:0]] model" disabled>
							<span class="input-group-btn">
								<button class="btn btn-secondary" ng-click="incrementModel($index)">
									<span class="fas fa-plus"></span>
								</button>
							</span>
						</div>
					</div>
					<div class="info" data-toggle="tooltip" data-title="[[datas.infoqty]]" data-html="true" data-placement="left">
						<span class="far fa-question-circle"></span>
					</div>
				</div>
			</div>

			<div class="block-list">
				<div class="txt">
					<span class="hidden-xs-down"> 
						Jenis
					</span>
					Material
				</div>
				<div class="input">
					<div class="select">
						<select class="form-control" data-width="100%" ng-options="item.paper as showMaterialName(item.paper.name, item.paper.gramature) for item in datas.jobsubtypedetail[$index].jobsubtypedetailpaper" ng-model="selected.jobsubtypedetail[$index].paper" ng-change="matChanged(selected.jobsubtypedetail[$index].paper, detail.jobsubtypedetailfinishing)">
						</select>
					</div>
					<div class="info" data-toggle="tooltip" data-title="[[datas.infomaterial]]" data-html="true" data-placement="left">
						<span class="far fa-question-circle"></span>
					</div>
				</div>
			</div>
			<div class="block-list">
				<div class="txt">
					Sisi
					<span class="hidden-xs-down">
						Cetak
					</span>
				</div>
				<div class="input">
					<div class="select">
						<select class="form-control" data-width="100%" ng-model="selected.jobsubtypedetail[$index].sideprint" ng-change="getPrice()">
							<option ng-show="datas.jobsubtypedetail[$index].sisicetak==1||datas.jobsubtypedetail[$index].sisicetak==0" value="1">
								1 sisi cetak
							</option>
							<option ng-show="datas.jobsubtypedetail[$index].sisicetak==2||datas.jobsubtypedetail[$index].sisicetak==0" value="2">
								2 sisi cetak
							</option>
						</select>
					</div>
					<div class="info" data-toggle="tooltip" data-title="[[datas.infosisicetak]]" data-html="true" data-placement="left">
						<span class="far fa-question-circle"></span>
					</div>
				</div>
			</div>
			<div class="" ng-repeat="detailfin in detail.jobsubtypedetailfinishing track by detailfin.id">
				<div class="block-list">
					<div class="txt">
						[[detailfin.finishing.name]]
					</div>
					<div class="input">
						<div class="select">
							<select class="form-control" data-width="100%" ng-options="option.optionname disable when option.disabled for option in detailfin.finishing.finishingoption track by option.id" ng-model="selected.jobsubtypedetail[$parent.$index].finishing[$index]" ng-change="finishingchanged(item.finishing.name, selected.finishings[$index], detail.jobsubtypedetailfinishing)">
							</select>
						</div>
						<div class="info" data-toggle="tooltip" data-title="[[item.finishing.info]]" data-html="true" data-placement="left" tooltip>
							<span class="far fa-question-circle"></span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="text-right" ng-show="datas.jobsubtypedetail.length>0">
			<!-- ADD NEW ITEM -->
			<button class="btn btn-sm btn-purple" ng-click="addNewDetail()">
				<i class="fa fa-plus"></i>
				Tambah
				<span class="hidden-xs-down"> Detail</span>
			</button>
		</div>

		<div class="block-subdetail" ng-hide="datas.jobsubtypefinishing.length==0">
			<div class="txt">FINISHING</div>
			<div class="line"></div>
		</div>
		<div class="block-list" ng-repeat="item in datas.jobsubtypefinishing">
			<div class="txt">[[item.finishing.name]]</div>
			<div class="input">
				<div class="select">
					<select class="form-control" data-width="100%" ng-options="option.optionname disable when option.disabled for option in item.finishing.finishingoption track by option.id" ng-model="selected.finishings[$index]" ng-change="finishingchanged(item.finishing.name, selected.finishings[$index], finishings)">
					</select>
				</div>
				<div class="info" data-toggle="tooltip" data-title="[[item.finishing.info]]" data-html="true" data-placement="left">
					<span class="far fa-question-circle"></span>
				</div>
			</div>
		</div>
		<div class="block-subdetail" hidden>
			<div class="txt">WAKTU PENYELESAIAN</div>
			<div class="line"></div>
		</div>
		<div class="block-list" hidden>
			<div class="txt">
				Proses
				<span class="hidden-xs-down">
					Kerja
				</span>
			</div>
			<div class="input">
				<div class="select">
					<select class="form-control" data-width="100%" ng-model="selected.processtime" ng-change="getPrice()">
						<option value="std">Standard (2 hari kerja)</option>
						<option value="exp" disabled="">Express (1 hari kerja)</option>
					</select>
				</div>
				<div class="info" data-toggle="tooltip" data-title="[[datas.infoproses]]" data-html="true" data-placement="left">
					<span class="far fa-question-circle"></span>
				</div>
			</div>
		</div>
		<div class="block-subdetail" hidden>
			<div class="txt">JENIS LAYANAN</div>
			<div class="line"></div>
		</div>
		<div class="block-list" hidden>
			<div class="txt">
				<span class="hidden-xs-down">
					Isi Perbungkus
				</span>
				<span class="hidden-sm-up">
					Per-bks
				</span>
			</div>
			<div class="input">
				<div class="select">
					<select class="form-control" data-width="100%" ng-model="selected.perbungkus" ng-change="getPrice()">
						<option>100</option>
						<option>200</option>
						<option>500</option>
						<option>1000</option>
						<option>2000</option>
					</select>
				</div>
				<div class="info" data-toggle="tooltip" data-title="[[datas.infoperbungkus]]" data-html="true" data-placement="left">
					<span class="far fa-question-circle"></span>
				</div>
			</div>
		</div>
		<div class="block-subdetail" hidden>
			<div class="txt">DROPSHIPPER</div>
			<div class="line"></div>
		</div>
		<div class="block-list" hidden>
			<div class="txt">
				Pengirim?
			</div>
			<div class="input">
				<div class="select">
					<select class="form-control" data-width="100%" ng-model="selected.reseller" ng-change="getPrice()">
						<option value="std">Jakarta Brosur</option>
						<option value="cst">Nama Pribadi</option>
					</select>
				</div>
				<div class="info" data-toggle="tooltip" data-title="[[datas.inforeseller]]" data-html="true" data-placement="left">
					<span class="far fa-question-circle"></span>
				</div>
			</div>
		</div>
		<div class="block-list" ng-show="selected.reseller=='cst'">
			<div class="txt">
				Nama
			</div>
			<div class="input">
				<div class="input-block">
					<div class="input-group">
						<input class="form-control text-xs-left" type="text" ng-model="selected.resellername" placeholder="Nama Pengirim">
					</div>
				</div>
				<div class="info" data-toggle="tooltip" data-title="[[datas.inforeseller]]" data-html="true" data-placement="left">
					<span class="far fa-question-circle"></span>
				</div>
			</div>
		</div>
		<div class="block-list" ng-show="selected.reseller=='cst'">
			<div class="txt">
				Telepon
			</div>
			<div class="input">
				<div class="input-block">
					<div class="input-group">
						<input class="form-control text-xs-left" type="number" ng-model="selected.resellerphone" placeholder="No. Telepon Pengirim">
					</div>
				</div>
				<div class="info" data-toggle="tooltip" data-title="[[datas.inforeseller]]" data-html="true" data-placement="left">
					<span class="far fa-question-circle"></span>
				</div>
			</div>
		</div>
	</div>
</div>
