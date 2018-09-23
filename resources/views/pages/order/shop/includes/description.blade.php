<div class="order-panel tab-pane fade in" id="description">

	<div class="panel-block" ng-show="error.message==''">
		<div class="block-subdetail">
			<div class="txt">FILE</div>
			<div class="line"></div>
		</div>
		<div class="block-list" ng-show="error.files==''">
			<div class="txt">
				Status: 
			</div>
			<div class="input">
				<div class="text-block" ng-class="{'danger':selected.files.length==0, 'success':selected.files.length>0}">
					<div class="input-group">
						<div class="form-control">
							<span ng-hide="selected.files.length==0">
								[[selected.files.length]] File terpilih
							</span>
							<span ng-show="selected.files.length==0">
								Tidak ada File terpilih! 
							</span>
						</div>
					</div>
				</div>
				<div class="info" data-toggle="tooltip" data-title="Bila sudah upload file, wajib PILIH terlebih dahulu file yang ingin disertakan!" data-html="true" data-placement="left">
					<span class="far fa-question-circle"></span>
				</div>
			</div>
		</div>
		<div class="block-text-left" ng-hide="error.files==''">
			<span class="txt">
				<span class="far fa-exclamation tx-warning"></span> 
				[[error.files]]
			</span>
		</div>

		<div class="block-button mx-gray">
			<button class="btn" ng-click="showuploadfile()" ng-disabled="error.files!=''">
				<span class="fas fa-cloud-upload-alt"> </span>
				Upload File
			</button>
		</div>
	</div>


	<div class="panel-block" ng-show="error.message==''">
		<div class="block-subdetail">
			<div class="txt">DEKSRIPSI</div>
			<div class="line"></div>
		</div>
		<div class="block-list" ng-show="error.description!=''">
			<span class="txt">
				<span class="fas fa-exclamation tx-warning"></span> 
				[[error.description]]
			</span>
		</div>
		<div class="block-list" ng-hide="error.description!=''">
		<!-- HIDE START -->
			<div class="txt">
				Deskripsi 
			</div>
			<div class="input">
				<div class="text-block" ng-class="{'warning':selected.itemdescription.length<5, 'success':selected.itemdescription.length>=5}">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Deskripsi Cetakan Tambahan (Info Penting)" ng-model="selected.itemdescription">
					</div>
				</div>
				<div class="info" data-toggle="tooltip" data-title="Nomor Urut?<br>Cara cetak?<br>Perlakuan terhadap file?<br>Info seputar cetakan?<br>Tujuan cetak?" data-html="true" data-placement="left">
					<span class="far fa-question-circle"></span>
				</div>
			</div>
		</div>
		<div class="block-list">
			<div class="txt">
				Catatan
			</div>
			<div class="input">
				<div class="text-block" ng-class="{'warning':selected.customernote.length<5, 'success':selected.customernote.length>=5}">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Catatan Tambahan (Info diluar deskripsi)" ng-model="selected.customernote">
					</div>
				</div>
				<div class="info" data-toggle="tooltip" data-title="Deadline?<br>Cara bungkus?<br>Info pengiriman?<br>Detail kirim?" data-html="true" data-placement="left">
					<span class="far fa-question-circle"></span>
				</div>
			</div>
		</div>
		<!-- HIDE STOP -->

	</div>

	<div class="panel-block" ng-show="error.message!=''">
		<div class="block-list">
			<div class="input text-xs-center">
				<div class="input-block">
					<div class="alert alert-lightgray alert-sm margin-0">
						<i class="fa fa-exclamation tx-warning"></i>
						Hello, Anda belum login! <br> 
						Silahkan <a class="a-purple" href="{{URL::asset('login?url=').(substr(Request::getPathInfo(),1).(Request::getQueryString()?('?'.Request::getQueryString()):''))}}">login</a> terlebih dahulu untuk Pesan.
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="panel-block">

		<div class="block-subdetail">
			<div class="txt">PENGIRIMAN / DELIVERY</div>
			<div class="line"></div>
		</div>

		<div class="block-list">
			<div class="txt">
				Jenis
			</div>
			<div class="input">
				<div class="select">
					<select class="form-control" data-width="100%" ng-options="item as item.deliveryname for item in deliveries" ng-model="selected.delivery" ng-change="changedelivery(selected.delivery)"></select>
				</div>
				<div class="info" data-toggle="tooltip" data-title="Pilihan selain pick-up disertakan alamat yang jelas ya!" data-html="true" data-placement="left">
					<span class="far fa-question-circle"></span>
				</div>
			</div>
		</div>
		<div class="block-list" ng-hide="selected.deliverylocked">
			<div class="txt">
				Tujuan
			</div>
			<div class="input">
				<div class="input-block" ng-class="{'danger': selected.deliveryaddress.length == 0, 'warning': selected.deliveryaddress.length < 10,  'success': selected.deliveryaddress.length >= 10}">
					<div class="input-group">
						<input class="form-control" type="text" ng-model="selected.deliveryaddress" placeholder="Alamat pengiriman + Info Penerima + Patokan">
						<span class="input-group-btn" ng-show="defaultaddress!=null">
							<button class="btn brd-transp bg-danger" type="button" ng-click="selected.deliveryaddress=defaultaddress" ng-show="selected.deliveryaddress!=defaultaddress">
								<i class="fas fa-bookmark tx-white"></i>
							</button>
							<button class="btn brd-transp bg-danger" type="button" ng-click="selected.deliveryaddress=''" ng-show="selected.deliveryaddress==defaultaddress">
								<i class="fas fa-times tx-white"></i>
							</button>
						</span>
					</div>
				</div>
				<div class="info" data-toggle="tooltip" data-title="<b>Masukkan alamat lengkap beserta patokannya!</b>" data-html="true" data-placement="left">
					<span class="far fa-question-circle"></span>
				</div>
			</div>
		</div>

	</div>
	<div class="panel-footer">
		<div class="txt">
			<i class="far fa-images tx-purple"></i>  
			<u>File cetak</u> dalam bentuk <b>AI</b>, <b>Corel</b>, <b>Photoshop</b>, & <b>Tiff</b>. <u>File data</u> dalam bentuk <b>Excel</b>.
		</div>
		<div class="txt">
			<i class="fas fa-comments tx-purple"></i>  
			Isi deskripsi pekerjaan dengan tepat, agar membantu proses pengerjaan dan menghindari kesalahan.
		</div>
		<div class="txt">
			<i class="fas fa-truck tx-purple"></i>  
			Pick-up, adalah pengambilan barang di workshop kami di 
			<a class="a-purple" href="https://www.google.co.id/maps/place/Jakarta+Brosur/@-6.1410584,106.825155,17z/data=!3m1!4b1!4m5!3m4!1s0x2e69f5fa2f737f37:0x43667f0d0a3cbf7f!8m2!3d-6.1410637!4d106.8273437?hl=en" target="_blank">
				<b>Jl. Pangeran Jayakarta 113, Jakarta</b> 
				<i class="fa fa-map-marker"></i>
			</a>.
		</div>
		<div class="txt">
			<i class="fas fa-truck tx-purple"></i>  
			Harga delivery adalah <b>harga prediksi saja</b>, dapat berubah sewaktu-waktu (dengan pemberitahuan kami sebelumnya <b>melalui telepon</b> atau <b>perubahan harga pada Order Anda</b>).
		</div>
	</div>


</div>