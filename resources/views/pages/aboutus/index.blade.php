@extends('layouts.container')
@section('title', 'Tentang Kami')
@section('content')
  <div class="page-title">
  	TENTANG PERCETAKAN JAKARTABROSUR
  </div>
  <div class="aboutus-wrapper">

    <div class="aboutus-list">
      <div class="title-icon">
        <span class="far fa-question-circle tx-lightmagenta"></span>
      </div>
        
      <div class="text">
        <div class="title">
          Siapa Jakartabrosur dan bidang apa yang dikerjakan?
        </div>

        <div class="content">
        	Kami perusahaan percetakan yang berdiri sejak 2015, di bawah naungan dari PT. RAHAYU PRINTING JAYA. Workshop dan office kami berada di <b class="tx-lightmagenta">Jl. Pangeran Jayakarta 113, Jakarta Pusat, Indonesia</b>. 

          <br><br>
          Ditengah maraknya pencetakan online yang sekarang ini berkembang pesat, kami menyediakan kemudahan untuk Anda dengan menghadirkan website berbasis Custom Order (yang menyediakan kustom untuk ukuran, jumlah, dan bahan), sehingga Anda dapat mendapatkan harga sesuai kebutuhan Anda. Kami juga menyediakan waktu proses yang cepat, sehingga Anda dapat mengerjakan pekerjaan Anda sebaik mungkin. 

          <br><br>
          Kami bersedia membantu Anda untuk waktu express ataupun permintaan khusus untuk pameran, semoga usaha Anda terbantu dengan pelayanan kami. 
        </div>
      </div>
    </div>

    <div class="aboutus-list">
      <div class="title-icon">
        <span class="far fa-location-circle tx-lightmagenta"></span>
      </div>
        
      <div class="text">
        <div class="title">
          Dimana lokasi Jakartabrosur jika ingin melakukan pengambilan barang langsung?
        </div>

        <div class="content">
          Lokasi workshop kami <b class="tx-lightmagenta">tepat disebelah SPBU Pangeran Jayakarta</b>. Adapun palang Percetakan Rahayu tepat didepan percetakan kami, sehingga Anda lebih mudah untuk mencari lokasi kami. Silahkan lakukan panggilan ke Customer Service kami jika dirasakan ada yang kurang jelas untuk lokasi diatas.
          <div class="map">
            <div class="action">
              <a class="btn btn-sm btn-secondary" href="https://www.google.com/maps/place/Jakarta+Brosur/@-6.141357,106.8273115,17z">View on <i class="fal fa-search-location fa-fw tx-purple"></i> Google Maps</a>
            </div>
            <div class="">
              <img src="{{URL::asset('image/petajakartabrosur.png')}}">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="aboutus-list">
      <div class="title-icon">
        <span class="far fa-user-headset tx-lightmagenta"></span>
      </div>
        
      <div class="text">
        <div class="title">
          Bisakah saya melakukan pelaporan secara lisan maupun tulisan?
        </div>

        <div class="content">
          Segeralah melaporkan ke pihak Customer Service kami bila petugas kami melakukan kesalahan. 
          Anda dapat melakukan pelaporan melalui Whatsapp atau telepon langsung ke <b class="tx-lightmagenta">0816-889-889</b>. Juga kami sangat suka untuk menerima masukan baik berupa lisan maupun tulisan.
          <br><br>
          <b class="tx-lightmagenta">Terima kasih. </b>
          <br>
          Saran Anda membantu kami.
        </div>
      </div>
    </div>

  </div>



  
@stop