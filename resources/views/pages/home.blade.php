@extends('layouts.blank')
@section('title', 'Beranda')
@section('description', 'Jakarta Brosur mencetak segala Kebutuhan Kantor dan Promosi. Sedia mesin Offset & Digital, juga terima jasa cetak. Dijamin murah! Percetakan Paling Murah di Jakarta.')
@section('keywords', 'Cetak murah, Cetak cepat, Cetak Flyer, Brosur Murah, Brosur Cepat, Cetak Brosur Cepat')
@section('robots', 'index,follow')
@section('content')
<div ng-controller="HomePageController">

	@if(!Session::has('role'))
		@if(Cookie::get('landing') != 'waiting')
			<?php //Cookie::queue('landing', '', 1) ?>
	<div class="hm-landingpage-wrapper modal fade" tabindex="-1" role="dialog" id="landingpage">
		<div class="hm-landingpage modal-dialog" role="document">
			<div class="btn-close">
				<button class="btn btn-secondary btn-sm" data-dismiss="modal">
					<i class="fal fa-times tx-red"></i>
					Close
				</button>
			</div>
			<div class="logo disable-select">
				<div class="img">
					<img src="{{URL::asset('image/logo-transp/logo-contrast-200px.png')}}" alt="logo" height="50px">
				</div>
				<div class="text">
					<div class="top">
						<span class="tx-darkpurple">Jakarta</span><span class="tx-gray">brosur</span>
					</div>
					<div class="bottom">
						Cetak Brosur, Besok Jadi
					</div>
				</div>
			</div>
			<div class="products">
				<div class="item left">
					<div>
						Brosur Offset
					</div>
					<div>
						<img src="{{URL::asset('image/jobsubtypeicons/flyer-simple.png')}}" alt="logo" height="100px">
					</div>
					<div>
						<a href="{{URL::asset('shop')}}/flyer#!#OF" class='btn btn-secondary'>
							Besok Jadi
						</a>
					</div>
				</div>
				<div class="item right">
					<div>
						Brosur Digital
					</div>
					<div>
						<img src="{{URL::asset('image/jobsubtypeicons/flyer-simple.png')}}" alt="logo" height="100px">
					</div>
					<div>
						<a href="{{URL::asset('shop')}}/flyer#!#DG" class='btn btn-secondary'>
							Langsung Jadi
						</a>
					</div>
				</div>
			</div>
			<div class="contactus">
				<a href="tel:+6281315519889" class="btn btn-secondary">
					<div class="logo">
						<i class="fal fa-mobile-android-alt fa-fw fa-2x tx-success"></i>
					</div>
					<div class="text">
						<div class="ket">
							Call us by Phone Number
						</div>
						<div class="phone">
							+62 813 1551 9889
						</div>
					</div>
				</a>
				<a href="https://api.whatsapp.com/send?phone=6281315519889" class="btn btn-secondary" target="_blank">
					<div class="logo">
						<i class="fab fa-whatsapp fa-fw fa-2x tx-success"></i>
					</div>
					<div class="text">
						<div class="ket">
							Chat us via. Whatsapp
						</div>
						<div class="phone">
							+62 813 1551 9889
						</div>
					</div>
				</a>
				<div class="location">
					<div class="logo">
						<i class="fal fa-compass fa-fw tx-primary"></i>
					</div>
					<div class="text">
						Jl. Pangeran Jayakarta 113, JakPus
					</div>
				</div>
			</div>
		</div>
	</div>
		@else
			<!-- COOKIE SET (LANDING PAGE NOT SHOWN) -->
		@endif
	@endif


	@if(Session::has('role') && Session::get('role') == "Administrator")

	<?php
		$customers_t = str_replace(array('\r', '\"', '\n', '\''), '?', $customers);
	?>

	<div class="" ng-init="initData('{{$customers_t}}')">
	</div>

	<div class="hm-admin">
		<div class="title">
			<span class="welcome">Welcome,</span> 
			<br>
			<b class="name">{{ explode(' ',trim( Session::get( 'name' )) )[0] }}</b> 
			<span class="subwelcome">
				as Admininstrator.
			</span>
				<br>
				<br>
			<span class="content-text">
				Anda bisa ubah semua data penjualan dari panel ini. <br>Hati2 dalam perubahan, bila ada yang tidak dimengerti segera tanyakan terlebih dahulu. Tidak untuk coba-coba, sekali salah, tidak bisa di ulang. <br><br>Happy editing! <i class="fas fa-fw fa-wand-magic tx-lightmagenta"></i>
			</span>
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


			<div class="hm-action-title">
				- Job Editor -
			</div>
			<div class="hm-action-link">
				<ul>
					<li>
						<a href="">
							<span>
								<i class="far fa-fw fa-2x fa-percentage"></i>
								<div>Job Price Editor</div>
							</span>
						</a>
					</li>
					<li>
						<a href="">
							<span>
								<i class="far fa-fw fa-2x fa-power-off"></i>
								<div>Job Activation Editor</div>
							</span>
						</a>
					</li>
					<li>
						<a href="">
							<span>
								<i class="far fa-fw fa-2x fa-paperclip"></i>
								<div>Job Detail Editor</div>
							</span>
						</a>
					</li>
					<li>
						<a href="">
							<span>
								<i class="far fa-fw fa-2x fa-magic"></i>
								<div>Job Finishings Manager</div>
							</span>
						</a>
					</li>
					<li>
						<a href="">
							<span>
								<i class="far fa-fw fa-2x fa-expand-arrows-alt"></i>
								<div>Job Sizes Manager</div>
							</span>
						</a>
					</li>
					<li>
						<a href="">
							<span>
								<i class="far fa-fw fa-2x fa-copy"></i>
								<div>Job Papers Manager</div>
							</span>
						</a>
					</li>
					<li>
						<a href="">
							<span>
								<i class="far fa-fw fa-2x fa-abacus"></i>
								<div>Job Quantities Manager</div>
							</span>
						</a>
					</li>
				</ul>
			</div>
			
		</div>
	</div>
	@endif


	<!-- BUKAN ADMIN --><!-- BUKAN ADMIN --><!-- BUKAN ADMIN --><!-- BUKAN ADMIN -->
	<!-- BUKAN ADMIN --><!-- BUKAN ADMIN --><!-- BUKAN ADMIN --><!-- BUKAN ADMIN -->
	<!-- BUKAN ADMIN --><!-- BUKAN ADMIN --><!-- BUKAN ADMIN --><!-- BUKAN ADMIN -->
	<!-- BUKAN ADMIN --><!-- BUKAN ADMIN --><!-- BUKAN ADMIN --><!-- BUKAN ADMIN -->
	<!-- BUKAN ADMIN --><!-- BUKAN ADMIN --><!-- BUKAN ADMIN --><!-- BUKAN ADMIN -->
	<!-- BUKAN ADMIN --><!-- BUKAN ADMIN --><!-- BUKAN ADMIN --><!-- BUKAN ADMIN -->

	@if(!Session::has('role') || (Session::has('role') && Session::get('role') != "Administrator"))



	<div class="hm-navigator" ng-if="'{{Session::get('userid')}}'==''">
		<div class="logo-wrapper">
			<div class="logo disable-select">
				<div class="img">
					<img class="hidden-xs-down" src="{{URL::asset('image/logo-transp/logo-white-shadow-contrast-200px.png')}}" alt="logo" height="70px">
				</div>
				<div class="text">
					<div class="top">
						<span class="front">Jakarta</span><span class="back">brosur</span>
					</div>
					<div class="bottom">
						<span class="front">ONLINE</span>
						<span class="back">PRINTING</span>
					</div>
				</div>
			</div>
		</div>
		<div class="header-img">
			<!-- GAMBAR DEPAN KALO BLOM LOGIN -->
		</div>
		<div class="nav-button">
			<a class="nav-link" href="{{URL::asset('orderlistcustomer')}}">
				<div class="ico">
					<i class="fal fa-fw fa-calculator-alt"></i> 
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


		<div class="hm-navigator-footer"></div>
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


	<div class="hm-offvsdigi">
		<div class="title">
			Apa yang kami kerjakan?
		</div>
		<!-- <div class="margin-top-20">
			<img src="{{URL::asset('image/digitaloffset-header-sm.png')}}" alt="banner" width="100%"/>
		</div> -->
		<div class="content-wrapper">
			<div class="content-list">
				<div class="list-item hidden-xs-down">
					<div class="txt">
						Flyer / Brosur
					</div>
					<a href="{{URL::asset('shop/flyer')}}">
						<img ng-src="{{URL::asset('image/jobsubtypeicons/flyer-simple.png')}}">
					</a>
				</div>
				<div class="list-item">
					<div class="txt">
						Kartu Nama
					</div>
					<a href="{{URL::asset('shop/businesscard')}}">
						<img ng-src="{{URL::asset('image/jobsubtypeicons/businesscard.png')}}">
					</a>
				</div>
				<div class="list-item">
					<div class="txt">
						Brosur Lipat
					</div>
					<a href="{{URL::asset('shop/flyerlipat')}}">
						<img ng-src="{{URL::asset('image/jobsubtypeicons/flyer-z-fold.png')}}">
					</a>
				</div>
				<div class="list-item">
					<div class="txt">
						X-Banner
					</div>
					<a href="{{URL::asset('shop/rollupbanner')}}">
						<img ng-src="{{URL::asset('image/jobsubtypeicons/xbanner.png')}}">
					</a>
				</div>
				<div class="list-item hidden-sm-down">
					<div class="txt">
						Kop Surat
					</div>
					<a href="{{URL::asset('shop/letterhead')}}">
						<img ng-src="{{URL::asset('image/jobsubtypeicons/letterhead-simple.png')}}">
					</a>
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


	<div>
		<div class="hm-question-header pink">
			<div class="question-header">
				<div class="atas"></div>
				<div class="tengah">Kenapa memilih kami?</div>
				<div class="bawah"></div>
			</div>
		</div>
	</div>


	<div class="hm-container">
		<div class="hm-desc hm-benefit">
			<div class="benefit-list">
				<div class="image">
					<img ng-src="{{URL::asset('image/home/hm-benefit-speed.png')}}">
				</div>
				<div class="header">
					CEPAT
				</div>
				<div class="content">
					Cetak hitungan menit
				</div>
			</div>
			<div class="benefit-list">
				<div class="image">
					<img ng-src="{{URL::asset('image/home/hm-benefit-easyaccess.png')}}">
				</div>
				<div class="header">
					GA RIBET
				</div>
				<div class="content">
					Pilih, bayar, langsung kirim
				</div>
			</div>
			<div class="benefit-list">
				<div class="image">
					<img ng-src="{{URL::asset('image/home/hm-benefit-cheap.png')}}">
				</div>
				<div class="header">
					MURAH
				</div>
				<div class="content">
					Harga berani diadu
				</div>
			</div>
		</div>
	</div>
	<div>
		<div class="hm-question-header yellow">
			<div class="question-header">
				<div class="atas"></div>
				<div class="tengah">Cepat Murah Bagus</div>
				<div class="bawah"></div>
			</div>
		</div>
	</div>
	<div class="hm-container">
		<div class="hm-desc left">
			<div class="desc-item">
				<div class="desc-item-header">
					<i class="fas fa-user-friends tx-orange"></i>
					Printing partners
				</div>
				<div class="desc-item-block">
					Kami melayani bidang percetakan sejak 1976 secara offline. Tahun 2016, kami ada untuk Anda di jakartabrosur.com untuk memenuhi kebutuhan cetak yang lebih cepat dan kompetitif.<br><br>

					Adapun beberapa Customer besar kami, diantaranya:
					<div class="display-flex">
						<ol class="margin-right-30">
							<li>
								First Media
							</li>
							<li>
								Citibank
							</li>
							<li>
								Bank Kalbar
							</li>
							<li>
								Tje Fuk Cosmetic
							</li>
							<li>
								Baso Aci Juara
							</li>
							<li> 
								Hoghock
							</li>
							<li> 
								Maharaja Cofee
							</li>
						</ol>
						<ol start="8">
							<li>
								Maybank
							</li>
							<li>
								Honda Imora Motor
							</li>
							<li>
								Honda Auto2000
							</li>
							<li>
								Weddingku
							</li>
							<li>
								Vara Wedding
							</li>
							<li> 
								MAS Software
							</li>
							<li> 
								BSI Finance
							</li>
						</ol>
					</div>
					<br>
					Sebagai supplier tetap, kami berusaha menjaga kualitas hasil cetak, dan akan selalu memperbaiki kekurangan kami setiap harinya. Hasil cetak kami, dapat langsung dilihat pada katalog dan contoh cetakan di <a href="">sini</a>. Atau bisa langsung datang ke workshop kami.
				</div>
				<div class="desc-item-footer">
				</div>
			</div>
			<div class="desc-img">
				<img src="{{URL::asset('image/home/hm-customers.png')}}" alt="none" class="img" width="100%">
			</div>
		</div>
	</div>
	<div>
		<div class="hm-question-header blue">
			<div class="question-header">
				<div class="atas"></div>
				<div class="tengah">Sekilas Tentang Cetak</div>
				<div class="bawah"></div>
			</div>
		</div>
	</div>
	<div class="hm-container">
		<div class="hm-desc right">
			<div class="desc-img">
				<img src="{{URL::asset('image/hm-cmyk-circle.png')}}" alt="none" class="img" width="100%">
			</div>
			<div class="desc-item">
				<div class="desc-item-header">
					<i class="fas fa-fill-drip tx-primary"></i>
					Beda CMYK dan RGB?
				</div>
				<div class="desc-item-block">
					Cyan, Magenta, Yellow, dan Black(K) adalah warna dasar standard untuk cetak. Warna dasar setiap cetakan, berbeda dengan RGB (Red, Green, Blue) yang biasa dipakai untuk warna dasar pada monitor ataupun smartphone.<br><br>
					Perbedaan hasil warna bentukan CMYK dan RGB akan sangat terlihat berbeda pada warna yang gelap. Sehingga warna yang terlihat pada layar komputer ataupun smartphone (RGB) akan lebih terang jika dibandingkan hasil cetak (CMYK). Solusinya: Agar mendekati, dibutuhkan test print dalam beberapa lembar.<br><br>
					Bila ada pertanyaan, segera hubungi kami.
				</div>
				<div class="desc-item-footer">
				</div>
			</div>
		</div>
	</div>
	<div class="hm-divider"></div>
	<div class="hm-container">
		<div class="hm-desc right">
			<div class="desc-img">
				<img src="{{URL::asset('image/cemani toka.png')}}" alt="none" class="img" width="100%">
			</div>
			<div class="desc-item">
				<div class="desc-item-header">
					<i class="fal fa-swatchbook fa-fw tx-primary"></i>
					Butuh warna yang sesuai?
				</div>
				<div class="desc-item-block">
					Kualitas menjadi yang utama dalam cetak. Kami tidak takut untuk membantu Anda lebih mengenai warna hasil cetakan, karena kepuasan Anda menjadi prioritas kami. Silahkan hubungi kami atau konsultasi ke workshop kami untuk mendapatkan warna yang sesuai dengan keinginan Anda.<br><br>
					Bila Anda masih ragu dan mempunyai kebutuhan untuk menyesuaikan warna pada hasil cetak, mohon lakukan konfirmasi dahulu sebelum mencetak. Kami dengan senang hati akan melayani Anda.<br><br>
					Pada cetak Offset, kami juga menyediakan warna khusus diluar C-M-Y-K. Bila kebutuhan Anda membutuhkan warna khusus, silahkan hubungi kami langsung lewat Whatsapp atau telepon.
				</div>
			</div>
		</div>
	</div>
	 
	<div class="hm-divider"></div>

	<div class="hm-container last-container">
		<a href="https://api.whatsapp.com/send?phone=6281315519889" class="link" target="_blank">
			<div class="contact-us">
				<div class="text">
					<i class="fab fa-whatsapp fa-fw"></i>
					Whatsapp <small>or</small> 
					Call
				</div>
				<div class="number">
					0813 1551 9889
				</div>
			</div>
		</a>
	</div> 


	<div class="hm-stickyorder">
		<a href="{{URL::asset('orderlistcustomer')}}">
			<div class="content">
				<i class="fas fa-fw fa-2x fa-calculator-alt"></i>
				<div class="text">cek harga</div>
			</div>
		</a>
	</div>

	@endif
</div>
@stop