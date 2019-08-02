<div class="order-panel tab-pane fade in" id="description">

	<div class="panel-block" ng-show="error.message==''">
		<div class="block-subdetail">
			<div class="txt">DEKSRIPSI</div>
			<div class="line"></div>
		</div>
		<div class="block-list">
			<div class="txt">
				Judul
				<span class="hidden-xs-down"> 
					Cetakan
				</span>
			</div>
			<div class="input">
				<div class="main">
					<div class="input-block">
						<div class="input-group">
							<input type="text" class="form-control text-xs-left" ng-model="selected.jobtitle" placeholder="Spesifik dan Jelas (min: 10 huruf)" id="input-jobtitle">
						</div>
					</div>
					<div class="info" data-toggle="tooltip" data-title="Judul Cetakan berupa nama yang unik untuk file pekerjaan Anda<br><br><b>buatlah berbeda dari pekerjaan yang lainnya</b>" data-html="true" data-placement="left">
						<span class="far fa-question-circle"></span>
					</div>
				</div>
			</div>
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
				<div class="main">
					<div class="text-block" ng-class="{'warning':selected.itemdescription.length<5, 'success':selected.itemdescription.length>=5}">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Info Seputar Pekerjaan" ng-model="selected.itemdescription">
						</div>
					</div>
					<div class="info" data-toggle="tooltip" data-title="Nomor Urut?<br>Cara cetak?<br>Perlakuan terhadap file?<br>Info seputar cetakan?<br>Tujuan cetak?" data-html="true" data-placement="left">
						<span class="far fa-question-circle"></span>
					</div>
				</div>
			</div>
		</div>
		<div class="block-list">
			<div class="txt">
				Catatan
			</div>
			<div class="input">
				<div class="main">
					<div class="text-block" ng-class="{'warning':selected.customernote.length<5, 'success':selected.customernote.length>=5}">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Pengambilan? Bungkus? Pengiriman?" ng-model="selected.customernote">
						</div>
					</div>
					<div class="info" data-toggle="tooltip" data-title="Deadline?<br>Cara bungkus?<br>Info pengiriman?<br>Detail kirim?" data-html="true" data-placement="left">
						<span class="far fa-question-circle"></span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="panel-block" ng-show="error.message!=''">
		<div class="block-list">
			<div class="input text-xs-center">
				<div class="input-block">
					<div class="alert alert-lightgray alert-sm margin-0">
						<i class="fa fa-exclamation tx-warning"></i>
						Hello, Anda belum login! <br> 
						Silahkan <a class="a-purple" href="{{URL::asset('login?url=').(substr(Request::getPathInfo(),1).(Request::getQueryString()?('?'.Request::getQueryString()):''))}}">LOG-IN</a> terlebih dahulu untuk Pesan.
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
				<div class="main">
					<div class="select">
						<select class="form-control" data-width="100%" ng-options="item as item.deliveryname for item in deliveries" ng-model="selected.delivery" ng-change="changedelivery(selected.delivery)"></select>
					</div>
					<div class="info" data-toggle="tooltip" data-title="Pilihan selain pick-up disertakan alamat yang jelas ya!" data-html="true" data-placement="left">
						<span class="far fa-question-circle"></span>
					</div>
				</div>
			</div>
		</div>
		<div class="delivery-desc" ng-if="selected.delivery.id==1">
			Pick-up = Ambil barang di workshop kami:
			<ol>
				<li><b>Gratis</b>, tidak kena biaya kirim.</li>
				<li><b>Langsung</b>, tidak perlu tunggu pengiriman.</li>
				<li>Dapat langsung diambil di <a href="" ng-click="showpickup()">Jakartabrosur<i class="far fa-question-circle fa-fw"></i></a>.</li>
				<li>Silahkan tanyakan terlebih dahulu status pesanan Anda, sebelum melakukan pengambilan.</li>
			</ol>
		</div>
		<div class="block-list" ng-hide="selected.deliverylocked" ng-if="error.message==''">
			<div class="txt">
				Tujuan
			</div>
			<div class="input">
				<div class="main">
					<div class="select">
						<select class="form-control" type="text" ng-model="selected.deliveryaddress" ng-options="item as item.address.name+', '+item.address.address for item in customeraddresses" ng-change="addresschanged()"></select>
					</div>
					<div class="info" data-toggle="tooltip" data-title="Pilih alamat tujuan pengiriman." data-html="true" data-placement="left">
						<span class="far fa-question-circle"></span>
					</div>
				</div>
			</div>
		</div>
		<div class="delivery-desc" ng-if="selected.delivery.id!=1">
			Info pengiriman dan pengantaran hasil cetak:
			<ol>
				<li>
					Harga kirim akan disesuaikan setelah Anda melakukan pemesanan.
				</li>
				<li>
					Perubahan harga kirim, akan dikonfirmasi melalui telepon atau <i class="fab fa-whatsapp fa-fw"></i> Whatsapp.
				</li>
				<li>
					Pengiriman melalui instant courier yang dipesan oleh Customer, silahkan pilih Pick-up delivery.
				</li>
				<li>
					Penggantian alamat Anda, atau kesalahan pengisian data alamat dapat diinfokan langsung ke pihak Jakartabrosur melalui telepon.
				</li>
		</div>
	</div>
	<div class="panel-block" ng-if="error.message!=''">
		<div class="block-list">
			<div class="input text-xs-center">
				<div class="input-block">
					<div class="alert alert-lightgray alert-sm margin-0">
						<i class="fa fa-exclamation tx-warning"></i>
						Halo, Anda belum login! <br> 
						Silahkan <a class="a-purple" href="{{URL::asset('login?url=').(substr(Request::getPathInfo(),1).(Request::getQueryString()?('?'.Request::getQueryString()):''))}}">LOG-IN</a> terlebih dahulu untuk Pilih Alamat.
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-block highlight" ng-if="selected.deliveryaddress.id==0">
		<div class="block-subdetail">
			<div class="txt">TAMBAH ALAMAT BARU</div>
			<div class="line"></div>
		</div>
		<div class="block-list">
			<div class="txt">
				Nama
			</div>
			<div class="input">
				<div class="main">
					<div class="input-group">
						<input type="text" class="form-control" ng-model="newaddress.name" placeholder="Name Alamat Baru">
					</div>
				</div>
			</div>
		</div>
		<div class="block-list">
			<div class="txt">
				Alamat Baru
			</div>
			<div class="input">
				<div class="main">
					<div class="input-group">
						<input type="text" class="form-control" ng-model="newaddress.location" placeholder="Lokasi Alamat Baru">
					</div>
				</div>
			</div>
		</div>
		<div class="block-list">
			<div class="txt">
				Catatan
			</div>
			<div class="input">
				<div class="main">
					<div class="input-group">
						<input type="text" class="form-control" ng-model="newaddress.note" placeholder="Catatan u/ di Alamat Baru">
					</div>
				</div>
			</div>
		</div>
		<div class="block-list">
			<div class="txt">
				Kota
			</div>
			<div class="input">
				<div class="main">
					<div class="select">
						<select class="form-control" type="text" ng-model="newaddress.city" ng-options="item as item.name for item in cities" ng-change="newcitychanged()"></select>
					</div>
				</div>
			</div>
		</div>
		<div class="block-list">
			<div class="txt"></div>
			<div class="input">
				<div class="main">
					<button class="btn btn-sm btn-outline-purple" ng-click="addnewaddress('{{Session::get('userid')}}')">
						<span ng-if="!waitingaddnewadds && !errornewaddress">
							Tambah Data
						</span>
						<span ng-if="!waitingaddnewadds && errornewaddress">
							Error
						</span>
						<span ng-if="waitingaddnewadds">
							<i class="fas fa-spinner fa-spin"></i>
						</span>
					</button>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-footer">
		<div class="text-xs-center">
			Isi deskripsi sesuai pekerjaan, untuk menghindari kesalahan.
		</div>
	</div>

	<div class="showpickup-modal">
	@include('modal', 
		[
			'modalid' => 'showpickup',
			'modaltitle' => 'Info Pengambilan Pesanan',
			'modalbody' => '
				Pick-up digunakan untuk pengambilan pesanan oleh:
				<ol>
					<li>Pihak Customer.</li>
					<li>Instant Courier yang dipesan oleh Customer.</li>
				</ol>
				<div class="location">
					Lokasi workshop: <br>
					<span class="tx-purple">
						<i class="fas fa-map-signs fa-fw"></i>
						<b>Jl. Pangeran Jayakarta 113, Jakarta Pusat 10730</b>.
					</span>
					<div class="tx-lightgray line-12">
						<small>Hotline</small> 
						<span class="tx-gray">0813-1551-9889</span>.<br>
						<small>Office</small> 
						<span class="tx-gray">021-6491502 / 6491101</span>.
					</div><br>
					<div class="line-11 tx-lightgray">
						Patokan: 
						<ul>
							<li>Tepat sebelah SPBU, atau sebrang Panca Warna. </li>
							<li>Terdapat tulisan FotoCopy dan Percetakan Rahayu.</li>
						</ul>
					</div>
				</div>

				<div class="note" hidden>
					NOTE <br>
					<i class="fas fa-exclamation-circle fa-fw tx-lightgray"></i>
					Silahkan tanyakan terlebih dahulu status pesanan Anda, sebelum melakukan pengambilan.
				</div>
			',
			'modalfooter' => '
				<button class="btn btn-secondary" data-dismiss="modal">
					Hide
				</button>
			'
		]
	)
	</div>


</div>