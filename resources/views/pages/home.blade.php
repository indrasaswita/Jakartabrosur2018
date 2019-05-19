@extends('layouts.blank')
@section('title', 'Beranda')
@section('description', 'Jakarta Brosur mencetak segala Kebutuhan Kantor dan Promosi. Sedia mesin Offset & Digital, juga terima jasa cetak. Dijamin murah! Percetakan Paling Murah di Jakarta.')
@section('robots', 'index,follow')
@section('content')
<div ng-controller="HomePageController">
	@if(Session::has('role') && Session::get('role') == "Administrator")

	<?php
		$customers_t = str_replace(array('\r', '\"', '\n', '\''), '?', $customers);
	?>

	<div class="" ng-init="initData('{{$customers_t}}')">
	</div>

	<div class="hm-admin">
		<div class="title">
			<span class="size-200p">Welcome,</span> 
			<br><b>{{ explode(' ',trim( Session::get( 'name' )) )[0] }}</b> <span class="size-80p">as Admininstrator.</span>
		</div>
		<div class="hm hm-customer">
			<div class="hm-pretitle">
				<i class="fas fa-users fa-fw tx-lightgray"></i>
				Customers Overview
			</div>
			Congrats, <b>[[customers.length]]</b> were signed their account.<br>
			About <b class="tx-primary">[[totalsignedweek]]</b> customers were <b>signed up</b> this weekend.<br>
			About <b class="tx-primary">[[totalloggedweek]]</b> customers were <b>logged in</b> this weekend.<br>
			About XXX customers <b>made transaction</b> this weekend.
		</div>
		<div class="hm hm-transaction">
			<div class="hm-pretitle">
				<i class="fas fa-users fa-fw tx-lightgray"></i>
				Transaction Overview
			</div>
			
		</div>
	</div>
	@endif

	@if(!Session::has('role') || (Session::has('role') && Session::get('role') != "Administrator"))
	<div class="hm-navigator" ng-if="'{{Session::get('userid')}}'==''">
		<div class="logo">
			<div class="img">
				<img class="hidden-xs-down" src="{{URL::asset('image/logo-transp/logo-white-shadow-200px.png')}}" alt="logo" height="70px">
			</div>
			<div class="text">
				<div class="top">
					<span class="tx-white">Jakarta</span><span class="tx-white">brosur</span>
				</div>
				<div class="bottom">
					ONLINE PRINTING
				</div>
			</div>
		</div>
		<div class="header-img">
			<!-- GAMBAR DEPAN KALO BLOM LOGIN -->
		</div>
		<div class="nav-button">
			<a class="nav-link" href="{{URL::asset('orderlistcustomer')}}">
      	<div class="ico">
      		<i class="far fa-fw fa-calculator"></i> 
      	</div>
      	<div class="txt">cek harga</div>
    	</a>
    	<a class="nav-link" href="https://api.whatsapp.com/send?phone=6281315519889" target="_blank">
      	<div class="ico">
      		<i class="fab fa-fw fa-whatsapp"></i> 
      	</div>
      	<div class="txt">chat us</div>
    	</a>
    	<a class="nav-link" href="{{URL::asset('login')}}">
      	<div class="ico">
      		<i class="far fa-fw fa-user-lock"></i> 
      	</div>
      	<div class="txt">LOG-IN</div>
    	</a>
    	<a class="nav-link hidden-xs-down" href="{{URL::asset('aboutus')}}">
      	<div class="ico">
      		<i class="far fa-fw fa-compass"></i> 
      	</div>
      	<div class="txt">About us</div>
    	</a>
		</div>
	</div>

  <div class="hm-header" ng-if="'{{Session::get('userid')}}'!=''">
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
			<a href="{{URL::asset('orderlistcustomer')}}" class="btn btn-hm primary" target="_blank">Cek Harga</a><br class="hidden-md-up">
			<a href="https://api.whatsapp.com/send?phone=6281315519889" target="_blank" class="btn btn-hm">Chat via <i class="fab fa-whatsapp"></i></a>
		</div>
	</div>

	<div class="hm-divider hidden-xs-down" hidden></div>

	<div class="hm-offvsdigi">
		<div class="title">
			Apa yang kami kerjakan?
		</div>
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
					Untuk pencetakan yang tidak kami sediakan di web, dapat ditanyakan langsung ke Customer Service Jakartabrosur.
				</div>
				<div class="footer" hidden>
					Beberapa jenis cetakan disediakan Ukuran Custom yang dapat dipesan di.
				</div>
			</div>
		</div>
	</div>

	<div class="hm-divider"></div>

	<div class="hm-container">
		<div class="hm-desc right">
			<div class="desc-img">
				<img src="{{URL::asset('image/hm-cmyk-circle.png')}}" alt="none" class="img" width="100%">
			</div>
			<div class="desc-item">
				<div class="desc-item-header">
					C-M-Y-K?
				</div>
				<div class="desc-item-block">
					Apa itu CMYK, dasar warna cetak, terdiri dari Cyan, Magenta, Yellow, dan Black(K). Namun masih ada banyak warna dasar lainnya, yang dalam didunia percetakan disebut warna khusus. Warna khusus tidak dapat dibentuk dari warna CMYK, untuk pekerjaan yang butuh penanganan khusus silahkan hubungi langsung ke <a href="tel:+62816889889">Hotline</a> kami. Konsultasi? Gratis kok.
					<br><br>

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
						<i class="fas fa-user-friends"></i>
						Cerita antara Kami dan Kamu
					</div>
					<div class="desc-item-block">
						Kita? Iya, kami ikut-ikutan jaman now yang bisa dipantau gitu. Jadi kami kerja apa, ya kamu harus tau. Gitu aja, biar kita sama-sama nyaman antara kami dan kamu. Mau lebih kenal, ayok <a href="{{URL::asset('signup')}}" class="a-home">daftar akun</a> dulu, jamin deh GRATIS!
						<br><br>
						Sekarang nggak cuma pacar, mau cetak juga bisa di pantau... <br>
						<i class="fas fa-kiss-wink-heart tx-yellow"></i>
						Aw sooo sweeettt..
						<br><br>
						Apa aja sih yang bisa di pantau?
						<div>
							<ol>
								<li>
									Proses pertama, kamu bisa tau apakah kami sudah 'CEK FILE' yang kamu kirim. Dan kalo filenya kurang 'KECE' atau 'OKE', ya nanti kami kabarin supaya kamu kirim lagi file yang 'KECE'-nya itu.
								</li>
								<li>
									Abis itu, proses 'CETAK PLAT' dimulai untuk beberapa tipe pekerjaan. Tapi kalau pakai proses digital, langsung deh lanjut ke 'PROSES CETAK'.
								</li>
								<li>
									Nah bagian utamanya ada disini, 'PROSES CETAK' nggak sembarangan, warna jadi panduan kami dalam proses, bila kamu punya <b><u>acuan warna</u></b> harap disertakan sebelum proses cetak ini dimulai, karena Warna itu segalanya
								</li>
								<li>
									Setelah semua selesai dicetak, kami pun melakukan 'PENGEMASAN'. Pengemasan pun harus dan wajib rapih, bila ada petugas kami yang mengemas kurang rapih, silahkan hubungi kami.
								</li>
								<li>
									Tapi belum selesai, kami dan kamu harus sepakat untuk menentukan kurir dalam 'PENGIRIMAN'. Ada pick-up order, maupun pengiriman instan, seperti Go-Jek, Grab, atau pengantaran langsung dari Jakarta Brosur bila jarak memungkinkan.
								</li>
								<li> 
									Akhirnya selesai juga. Tapi, jangan lupa ya, kalo ada komplain ataupun kendala saat menerima barang, kamu berhak mengajukan 'KOMPLAIN' dalam 2x24jam setelah barang sampai ditujuan kamu. Bila sudah barang yang diterima sudah 'KECE' dan 'OKE', mohon ketersediannya untuk mengkonfirmasi penerimaan barang.
								</li>
							</ol>
							<br>
							Terima kasih, kamu.
							<br>
							Oh iya, ada salam dari kami, sahabat dekat Rangga.
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
					Ragu akan kualitas Offset kami?
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
					<p class="hm-benefit-desc">
						Pesanan dengan hitungan jam dapat menggunakan proses Digital, dapat ditunggu. Jika dibutuhkan sangat cepat, kami juga dapat membantu untuk proses prioritas, yang dapat selesai hitungan menit. 
						<b>Sekarang jamannya, NO RIBET.</b>
					</p>
				</div>
			</div>
			<div class="benefit-list">
				<div class="benefit-image-wrapper">
					<img src="image/lowprice.png" alt="" class="hm-benefit-image"">
				</div>
				<div class="benefit-title-wrapper">
					<h6 class="hm-benefit-title">Harga Murah & Bersaing</h6>
					<p class="hm-benefit-desc">
						Tersedia proses cetak offset dan sablon, dengan harga semurah-murahnya. Tentunya bersaing dengan toko sebelah. Tunggu apa lagi, langsung aja cek murahnya <a href="{{URL::asset('orderlistcustomer')}}"><b>disini</b></a> lho! <b>Sekarang jamannya, NO BOKEK.</b>
					</p>
				</div>
			</div>
			<div class="benefit-list">
				<div class="benefit-image-wrapper">
					<img src="image/noqueue.png" alt="" class="hm-benefit-image"">
				</div>
				<div class="benefit-title-wrapper">
					<h6 class="hm-benefit-title">Tidak Perlu Lagi Mengantri</h6>
					<p class="hm-benefit-desc">
						Jaman online-online gini, sekarang saatnya kita order lewat internet. Yakin? Tidak perlu ribet, cukup cek harga, pesan, bayar, pantau deh ordernya. <b>Masih mau RIBET? </b>
					</p>
				</div>
			</div>
			<div class="benefit-list">
				<div class="benefit-image-wrapper">
					<img src="image/transfer.png" alt="" class="hm-benefit-image"">
				</div>
				<div class="benefit-title-wrapper">
					<h6 class="hm-benefit-title">Bayar Via Transfer Bank</h6>
					<p class="hm-benefit-desc">
						Nggak sedaaap kalo online bayarnya masih kuno, cukup transfer, langsung deh pesanan Anda lunas. Kami sediakan transfer antar rekening via BCA, BRI, BNI, Mandiri, BTPN.
					</p>
				</div>
			</div>
			<div class="benefit-list">
				<div class="benefit-image-wrapper">
					<img src="image/tracking.png" alt="" class="hm-benefit-image"">
				</div>
				<div class="benefit-title-wrapper">
					<h6 class="hm-benefit-title">Dapat Dipantau Secara Online</h6>
					<p class="hm-benefit-desc">
						Takut barang tidak sampai? Tenang, pekerjaan kami dapat dipantau online, Anda dapat cek status pesanan Anda dari website kapan aja dimana aja. Wah, nggak perlu telpon lagi deh untuk tanya status kerjaan. <b>Pulsa irit, sahabat dompet.</b>
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="hm-stickyorder" data-toggle='tooltip' data-placement='left' data-title='<div class="text-xs-right"><b class="tx-gray">LIHAT<br>PERHITUNGAN<br>HARGA</b></div>' data-html='true'>
		<a href="{{URL::asset('orderlistcustomer')}}">
			<i class="fas fa-fw fa-3x fa-feather"></i>
		</a>
	</div>
	@endif
</div>
@stop