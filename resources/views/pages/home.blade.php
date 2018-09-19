@extends('layouts.default')
@section('title', 'Beranda')
@section('description', 'Jakarta Brosur mencetak segala Kebutuhan Kantor dan Promosi. Sedia mesin Offset & Digital, juga terima jasa cetak. Dijamin murah! Percetakan Paling Murah di Jakarta.')
@section('content')
<div ng-controller="HomePageController">
  <div class="hm-header">
		<div class="image hidden-xs-down">
			&nbsp;
		</div>
		<div class="quotes hidden-xs-down">
			<i class="fas fa-quote-left tx-lightgray fa-2x hidden-sm-down"></i>
			<br class="hidden-sm-down">
			You only pay<br>what You print..
		</div>
		<div class="text">
			<img class="hello hidden-sm-down" src="{{URL::asset('image/home-hello.png')}}">
			<div class="content">
				<span class="hidden-sm-down">
					Anda butuh harga cetak?
				</span>
				<span class="hidden-md-up">
					Butuh harga?
				</span>
				<br>
				Cek aja sekarang.
			</div>
			<a href="{{URL::asset('orderlistcustomer')}}" class="btn btn-hm primary">Cek Harga</a><br class="hidden-md-up">
			<a href="https://api.whatsapp.com/send?phone=6285959717175" target="_blank" class="btn btn-hm">Chat via <i class="fab fa-whatsapp"></i></a>
		</div>
	</div>

	<div class="hm-divider hidden-xs-down">
		<img src="{{URL::asset('image/digitaloffset-footer.png')}}" alt="none" class="img">
	</div>

	<div class="hm-offvsdigi">
		<!-- <div class="margin-top-20">
			<img src="{{URL::asset('image/digitaloffset-header-sm.png')}}" alt="banner" width="100%"/>
		</div> -->
		<div class="content-wrapper">
			<div class="content-list">
				<div class="list-item">
					<a href="{{URL::asset('shop/businesscard')}}">
						<img ng-src="{{URL::asset('image/jobsubtypeicons/businesscard.png')}}">
					</a>
					<div class="txt">
						Kartu Nama
					</div>
				</div>
				<div class="list-item">
					<a href="{{URL::asset('shop/flyer')}}">
						<img ng-src="{{URL::asset('image/jobsubtypeicons/flyer-z-fold.png')}}">
					</a>
					<div class="txt">
						Brosur Lipat
					</div>
				</div>
				<div class="list-item hidden-xs-down">
					<a href="{{URL::asset('shop/deskcalendar')}}">
						<img ng-src="{{URL::asset('image/jobsubtypeicons/calendar-table-simple.png')}}">
					</a>
					<div class="txt">
						Kalender Meja
					</div>
				</div>
				<div class="list-item">
					<a href="{{URL::asset('shop/rollupbanner')}}">
						<img ng-src="{{URL::asset('image/jobsubtypeicons/rollup.png')}}">
					</a>
					<div class="txt">
						Standing Banner
					</div>
				</div>
				<div class="list-item hidden-sm-down">
					<a href="{{URL::asset('shop/letterhead')}}">
						<img ng-src="{{URL::asset('image/jobsubtypeicons/letterhead-simple.png')}}">
					</a>
					<div class="txt">
						Kop Surat
					</div>
				</div>
			</div>
		</div>
		<div class="offvsdigi-note">
			<div class="txt">
				<div class="content">
					<i class="fa fa-info-circle icon tx-purple"></i>
					Kami menyediakan jasa cetak OFFSET dan DIGITAL.<br>
					Untuk pencetakan yang tidak kami sediakan di web, dapat ditanyakan langsung ke Jakartabrosur.
				</div>
				<div class="footer">
					Beberapa jenis cetakan disediakan Ukuran Custom yang dapat diSitus.
				</div>
			</div>
		</div>
	</div>

	<div class="hm-divider">
		<img src="{{URL::asset('image/digitaloffset-footer.png')}}" alt="none" class="img">
	</div>

	<div class="hm-container">
		<div class="hm-desc right">
			<div class="desc-img">
				<img src="{{URL::asset('image/hm-cmyk-circle.png')}}" alt="none" class="img" width="100%">
			</div>
			<div class="desc-item">
				<div class="desc-item-header">
					Apa yang kami kerjakan?
				</div>
				<div class="desc-item-block">
					Kami mencetak berbagai jenis kertas dan spanduk. Tidak hanya ukuran kecil saja, namun kami juga mencetak ukuran besar dalam jumlah sedikit maupun banyak.
					<div class="row margin-0">
						<ol>
							<li>
								OFFSET
								<small class="text-muted">
									Cetak 1 FILE -> JUMLAH BANYAK
								</small>
							</li>
							<li>
								DIGITAL
								<small class="text-muted">
									Cetak banyak FILE -> JUMLAH SEDIKIT
								</small>
							</li>
							<li>
								LARGE FORMAT
								<small class="text-muted">
									Cetak dalam ukuran besar (up to 20 meter)
								</small>
							</li>
							<li>
								PVC ID Card
								<small class="text-muted">
									Cetak di atas bahan PVC (member, ATM, identity card)
								</small>
							</li>
							<li>
								STICKER VINYL
								<small class="text-muted">
									Cetak sticker putih dan transparent semi-plastik
								</small>
							</li>
							<li>
								SPANDUK
								<small class="text-muted">
									Spanduk Outdoor dan Indoor (up to 3.2 meter)
								</small>
							</li>
							<li>
								NCR (Non Carbon Required)
								<small class="text-muted">
									Untuk NOTA Manual dan sejenisnya
								</small>
							</li>
						</ol>
					</div>
				</div>
				<div class="desc-item-footer">
				</div>
			</div>
		</div>
	</div>
	<img src="{{URL::asset('image/whyusquestion-topborder.png')}}" alt="none" class="img" width="100%">
	<div class="hm-proses">
		<div class="hm-container">
			<div class="hm-desc full">
				<div class="desc-item">
					<div class="desc-item-header">
						6 Proses Cetak Kami
					</div>
					<div class="desc-item-block">
						Tercepat dan terdepan. Kami mengutamakan proses kerja yang sistematis, dan dapat dipantau langsung oleh Anda. Silahkan Log-in sebagai pengguna dan lihat tahapannya. Bila belum punya account, silahkan daftar <a href="{{URL::asset('signup')}}" class="a-home">di sini</a>, GRATIS!
						<div class="row margin-0">
							<ol class="col-lg-5">
								<li> <span class="glyphicon glyphicon-duplicate"></span> Cek File</li>
								<li> <span class="glyphicon glyphicon-picture"></span> Cetak Plat</li>
								<li> <span class="glyphicon glyphicon-print"></span> Proses Cetak</li>
							</ol>
							<ol class="col-lg-5" start="4">
								<li> <span class="glyphicon glyphicon-download-alt"></span> Pembungkusan</li>
								<li> <span class="glyphicon glyphicon-road"></span> Pengiriman</li>
								<li> <span class="glyphicon glyphicon-home"></span> Barang Diterima</li>
							</ol>
						</div>
					</div>
					<div class="desc-item-footer">
					</div>
				</div>
			</div>
		</div>
	</div>
	<img src="{{URL::asset('image/whyusquestion-botborder.png')}}" alt="none" class="img" width="100%">
	<div class="hm-container">
		<div class="hm-desc right">
			<div class="desc-img">
				<img src="{{URL::asset('image/cemani toka.png')}}" alt="none" class="img" width="100%">
			</div>
			<div class="desc-item">
				<div class="desc-item-header">
					Ragu akan kualitas?
				</div>
				<div class="desc-item-block">
					Kualitas kami, selalu menjadi andalan. Dan kami selalu melakukan <i>quality-control</i> pada setiap pesanan Anda, agar kualitas pun tetap terjaga dengan baik. Mengapa kami begitu yakin dengan kualitas cetakan kami?<br>
					<ol>
						<li>
							Karena kami gunakan tinta merk Cemani Toka<br>
							<strong>Kenapa harus CEMANI?</strong><br>
							<ol class="size-80p gray sub-ol">
								<li>
									Paling cepat kering mempercepat proses kerja
								</li>
								<li>
									Tidak menempel ke tangan
								</li>
								<li>
									Warna lebih tepat
								</li>
								<li>
									Menyediakan warna khusus yang harganya terjangkau
								</li>
							</ol>
						</li>
						<li>
							Serta mesin Heidelberg Speedmaster SM<br>
							<strong>Kenapa harus HEIDELBERG?</strong><br>
							<ol class="size-80p gray sub-ol">
								<li>
									Tanpa <i>misregistration</i>
								</li>
								<li>
									Tanpa <i>misalignment</i>
								</li>
								<li>
									Tanpa <i>color bleeding</i>
								</li>
								<li>
									Tanpa <i>hickeys</i> pada hasil cetakan
								</li>
								<li>
									Minimalisasi <i>dot gain</i>
								</li>
							</ol>
						</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
    <div class="margin-0">
    	<img src="{{URL::asset('image/whyusquestion.png')}}" alt="banner" width="100%"/>
	</div>
	<div class="hm-container">
	    <div class="hm-benefit">
			<div class="benefit-list">
				<div class="benefit-image-wrapper">
					<img src="image/speed.png" alt="" class="hm-benefit-image"">
				</div>
				<div class="benefit-title-wrapper">
					<h6 class="hm-benefit-title">Proses Cetak Sangat Cepat</h6>
					<p class="hm-benefit-desc">Pesanan Anda siap dalam waktu 1~2 hari saja.</p>
				</div>
			</div>
			<div class="benefit-list">
				<div class="benefit-image-wrapper">
					<img src="image/lowprice.png" alt="" class="hm-benefit-image"">
				</div>
				<div class="benefit-title-wrapper">
					<h6 class="hm-benefit-title">Harga Murah & Bersaing</h6>
					<p class="hm-benefit-desc">Harga cocok untuk reseller dan sangat terjangkau.</p>
				</div>
			</div>
			<div class="benefit-list">
				<div class="benefit-image-wrapper">
					<img src="image/noqueue.png" alt="" class="hm-benefit-image"">
				</div>
				<div class="benefit-title-wrapper">
					<h6 class="hm-benefit-title">Tidak Perlu Lagi Mengantri</h6>
					<p class="hm-benefit-desc">Hargai waktu Anda, sekarang tidak perlu mengantri lagi.</p>
				</div>
			</div>
			<div class="benefit-list">
				<div class="benefit-image-wrapper">
					<img src="image/transfer.png" alt="" class="hm-benefit-image"">
				</div>
				<div class="benefit-title-wrapper">
					<h6 class="hm-benefit-title">Bayar Via Transfer Bank</h6>
					<p class="hm-benefit-desc">Anda hanya perlu mentransfer via BCA, BRI, BNI, Mandiri.</p>
				</div>
			</div>
			<div class="benefit-list">
				<div class="benefit-image-wrapper">
					<img src="image/tracking.png" alt="" class="hm-benefit-image"">
				</div>
				<div class="benefit-title-wrapper">
					<h6 class="hm-benefit-title">Dapat Dipantau Secara Online</h6>
					<p class="hm-benefit-desc">Anda dapat melihat proses pesanan Anda via web.</p>
				</div>
			</div>
		</div>
	</div>
</div>
@stop