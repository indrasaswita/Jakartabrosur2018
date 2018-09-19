<head>
	<style>
		.purple{color:#509;}
		.helvetica{font-family:'Helvetica';}
		.courier{font-family:'Courier';}
		.text-bold{font-weight:bold;}
		.width-min{width:1%;}
		.table{background-color:#fff; width:100%;float:left;border-collapse: collapse;}
		.size-10{font-size:10px}
		.size-12{font-size:12px}
		.size-14{font-size:14px}
		.size-16{font-size:16px}
		.text-xs-left{text-align:left}
		.text-xs-right{text-align:right}
		.text-xs-center{text-align:center}
		.clear{clear:both;}
		.salesno{padding:10px 0; margin:0 10px;}
		.red{color:red;}
		.green{color:green;}
		.width-80{width:80%;}
		.width-33{width:33%;}
		.width-67{width:67%;}
		.italic{font-style:italic;}
		.margin-0{margin:0;}
		.margin-10-0{margin:10px 0;}
		.margin-20-0{margin:20px 0;}
		.margin-80-0{margin:80px 0;}
		.v-top{vertical-align: top !important;}
		.v-top td{vertical-align: top !important;}
		.v-top th{vertical-align: top !important;}
		.v-bot{vertical-align: bottom;}
		.hhead{font-weight: bold; color:#999; font-size:16px; text-align: left;}
		.dhead{background-color: #ccc;}
		.dhead th{padding:10px 5px;}
		.detail tr td{border-top:1px #777 solid;padding:5px 3px;}
		.border-clear td{border:0 !important;}
		.grandtotal td{border-bottom: 1px #777 solid;}
		.gray{color:#777;}
		.height-12{line-height: 0.3;}
		@page{
			margin-top: 1.5em;
			margin-bottom: 1.5em;
		}
	</style>
</head>
<body>
	@if(isset($sales))
	<?php 
		$salesCreatedAt = date_create($sales['created_at']); 
		$grandtotal = 0;
	?>
	<table class="table width-80 size-14">
		<tr>
			<td><img src="image/logo-new.jpg" height="20px" class="margin-10-0"></td>
		</tr>
		<tr>
			<td>{{date_format($salesCreatedAt, 'd M Y G:i:s')}}</td>	
		</tr>
		<tr>
			<td>email  : sales@jakartabrosur.com</td>	
		</tr>
		<tr>
			<td>telpon : (021) 649 1101</td>	
		</tr>
	</table>
	<div class="salesno helvetica height-12">
		<h5 class="text-xs-center gray italic">Kode Nota</h5>
		<h2 class="text-xs-center margin-0 italic"><span class="gray">#</span>{{sprintf('%05d', $sales['id'])}}</h2>
	</div>
	<div class="clear"></div>
	<hr>
	<div class="clear"></div>
	<div class=" helvetica italic margin-10-0 text-bold" style="font-size:18px;">
		NOTA CETAK OTOMATIS
	</div>
	<div class="clear"></div>
	<table class="table">
		<tr class="hhead">
			<td>Kepada Yth.,</td>
			<td>Pembayaran</td>
		</tr>
		<tr class="v-top size-14">
			<td class="width-67">
				{{$sales['customer']['title']}} {{$sales['customer']['name']}}
				@if($sales['customer']['companyID']!=1)
				<br>{{$sales['customer']['company']['name']}}
				<br>{{$sales['customer']['company']['address']}}
				<br>{{$sales['customer']['company']['city']['name']}}
				@else
				<br>{{$sales['customer']['address']}}
				<br>{{$sales['customer']['city']['name']}} {{$sales['customer']['postcode']}}
				@endif
			</td>
			<td class="width-33">
				Metode : 
				@if(count($sales['salespayment'])==0)
					<span>-</span>
				@else
					<span>{{$sales['salespayment'][0]['type']}}</span>
				@endif
				<br>
				Status : 

				<?php
					$totalbelanja = 0;
					foreach($sales['salesdetail'] as $salesdetail){
						$totalbelanja += $salesdetail['cartheader']['printprice'] + $salesdetail['cartheader']['deliveryprice'] - $salesdetail['cartheader']['discount'];
					}
				?>

				@if(count($sales['salespayment'])==0)
					<span class="red">BELUM BAYAR</span>
					<?php $lunas = false; ?>
						<br>
						[total tagihan Rp {{number_format($totalbelanja, 0, '.', ',')}}]
				@else
					<!-- SUDAH BAYAR -->
					<!-- Catatan: -->
					<!-- 1. Cek dulu sudah lunas blom -->
				<?php
					$totalbayar = 0;
					$allverified = true;
					foreach($sales['salespayment'] as $salespayment){
						$totalbayar += $salespayment['ammount'];
						if(isset($salespayment['salespaymentverif']))
							$allverified = false;
					}
				?>

					@if($totalbelanja > $totalbayar)
						<span class="red">BELUM LUNAS</span>
						<?php $lunas = false; ?>
						<br>
						[kurang bayar Rp {{number_format($totalbelanja - $totalbayar, 0, '.', ',')}}]
					@else
						@if($allverified == true)
							<span class="green">LUNAS</span>
							<?php $lunas = true; ?>
						@else
							<span class="red">BELUM DIVERIFIKASI</span>
							<?php $lunas = false; ?>
						@endif
					@endif
				@endif
			</td>
		</tr>
	</table>
	<div class="clear"></div>
	<table class="table detail helvetica margin-10-0 size-12">
		<tr class="dhead size-16">
			<th style="width:35%">Deskripsi</th>
			<th style="width:25%">Spesifikasi</th>
			<th style="width:25%">Finishing</th>
			<th>Harga</th>
		</tr>
		<?php $grandtotal = 0; ?>
		@foreach($sales['salesdetail'] as $detail)

		<!-- HITUNG HARGA -->
		<?php $detail['cartheader']['totalprice'] = $detail['cartheader']['printprice'] + $detail['cartheader']['deliveryprice'] - $detail['cartheader']['discount']; ?>

		<!-- KALO DETAILNYA CUMA 1 (SELAIN BUKU CALENDAR) -->

		@if(count($detail['cartheader']['cartdetail'])==1)
		<tr class="v-top">
			<td>
				[{{$detail['cartheader']['jobsubtype']['name']}}]
				<span class="text-bold">{{$detail['cartheader']['jobtitle']}}</span>
				@if($detail['cartheader']['itemdescription']!=null)
					@if($detail['cartheader']['itemdescription']!='')
				<br><b>Tambahan:</b> {{$detail['cartheader']['itemdescription']}}
					@endif
				@endif
				@if($detail['cartheader']['customernote']!=null)
					@if($detail['cartheader']['customernote']!='')
				<br><b>Catatan:</b> {{$detail['cartheader']['customernote']}}
					@endif
				@endif
			</td>


			<td>
				Qty: <b>{{number_format($detail['cartheader']['quantity'], 0, '.', ',')}}</b> {{$detail['cartheader']['quantitytypename']}}
				<br>Material: <b>{{$detail['cartheader']['cartdetail'][0]['paper']['papername']}} {{$detail['cartheader']['cartdetail'][0]['paper']['gramature']}}</b>gsm
				<br>Cetak: <b>{{$detail['cartheader']['cartdetail'][0]['side2']==0?"1":"2"}}</b> sisi
				<br>Ukuran: <b>{{$detail['cartheader']['cartdetail'][0]['imagewidth']}} x {{$detail['cartheader']['cartdetail'][0]['imagelength']}}</b> cm
				<br>
				<br>Berat: &plusmn;<b>{{$detail['cartheader']['totalweight']}}</b> kg
				<br>Slesai Cetak: <b>{{$detail['cartheader']['afterprint']}}</b>
				<br>Jadwal Kirim: <b>{{$detail['cartheader']['deadline']}}</b>
				<br>Pengiriman: <b>{{$detail['cartheader']['delivery']['deliveryname']}}</b>
				<!-- INI YANG DI INPUT PAS SUBMIT (sbg Permintaan Customer pas pesan), BUKAN ACTUAL KIRIMNYA -->
			</td>
			<td>
				@foreach($detail['cartheader']['cartdetail'][0]['cartdetailfinishing'] as $finishing)
					<b>{{$finishing['finishing']['name']}}</b> {{$finishing['finishingoption']['optionname']}}<br>
				@endforeach
			</td>

			<td class="text-xs-right">
				<i class="purple">cetak</i><br>
				{{number_format($detail['cartheader']['printprice'], 0, '.', ',')}}<br>
				<i class="purple">ongkir</i><br>
				{{number_format($detail['cartheader']['deliveryprice'], 0, '.', ',')}}<br>
				<i class="purple">diskon</i><br>
				{{number_format($detail['cartheader']['discount'], 0, '.', ',')}}<br>
				<br>
			
				<i class="purple">subtotal</i><br>
				<i class="purple">Rp</i> <b>{{number_format($detail['cartheader']['totalprice'], 0, '.', ',')}}</b>
			</td>
		</tr>

			@else
				<?php $indexx = 0; ?>
				@foreach($detail['cartheader']['cartdetail'] as $cartdetail)

			<!-- MULAI LOOPING UNTUKU KALO LEBIH DARI 1 CARTDETAIL cthnya buku  -->
			<!-- CATATAN: -->
			<!-- 1. cartheadernya cuma muncul kalo index 0 -->
			<!-- 2. buat perulangan index++ -->
			<!-- 3. total harga kuar di index = total cartdetail - 1 -->
		<tr class="v-top">
			@if($indexx==0)
			<td rowspan="{{count($detail['cartheader']['cartdetail'])}}">
				[{{$detail['cartheader']['jobsubtype']['name']}}]
				<span class="text-bold">{{$detail['cartheader']['jobtitle']}}</span>
				<br>
				Qty: <b>{{number_format($detail['cartheader']['quantity'], 0, '.', ',')}}</b> {{$detail['cartheader']['quantitytypename']}}
				@if($detail['cartheader']['itemdescription']!=null)
					@if($detail['cartheader']['itemdescription']!='')
				<br><b>Tambahan:</b> {{$detail['cartheader']['itemdescription']}}
					@endif
				@endif
				@if($detail['cartheader']['customernote']!=null)
					@if($detail['cartheader']['customernote']!='')
				<br><b>Catatan:</b> {{$detail['cartheader']['customernote']}}
					@endif
				@endif
				<br>Berat: &plusmn;<b>{{$detail['cartheader']['totalweight']}}</b> kg
				<br>Slesai Cetak: <b>{{$detail['cartheader']['afterprint']}}</b>
				<br>Jadwal Kirim: <b>{{$detail['cartheader']['deadline']}}</b>
				<br>Pengiriman: <b>{{$detail['cartheader']['delivery']['deliveryname']}}</b>
				<!-- INI YANG DI INPUT PAS SUBMIT (sbg Permintaan Customer pas pesan), BUKAN ACTUAL KIRIMNYA -->
			</td>
			@endif

			<td>
				{{$indexx+1}}. <b>{{$cartdetail['cartname']}}</b>
				<br>Material: <b>{{$cartdetail['paper']['papername']}} {{$cartdetail['paper']['gramature']}}</b>gsm
				<br>Cetak: <b>{{$cartdetail['side2']==0?"1":"2"}}</b> sisi
				<br>Ukuran: <b>{{$cartdetail['imagewidth']}} x {{$cartdetail['imagelength']}}</b> cm
			</td>
			<td>
				@foreach($cartdetail['cartdetailfinishing'] as $finishing)
					<b>{{$finishing['finishing']['name']}}</b> {{$finishing['finishingoption']['optionname']}}<br>
				@endforeach
			</td>

		@if($indexx==0)
			<td class="text-xs-right" rowspan="{{count($detail['cartheader']['cartdetail'])}}">
				<i class="purple">cetak</i><br>
				{{number_format($detail['cartheader']['printprice'], 0, '.', ',')}}<br>
				<i class="purple">diskon</i><br>
				{{number_format($detail['cartheader']['discount'], 0, '.', ',')}}<br>
				<br>
				<i class="purple">ongkir</i><br>
				{{number_format($detail['cartheader']['deliveryprice'], 0, '.', ',')}}<br>
			
				<i class="purple">subtotal</i><br>
				<i class="purple">Rp</i> <b>{{number_format($detail['cartheader']['totalprice'], 0, '.', ',')}}</b>
			</td>
		@endif
		</tr>

			<!-- END LOOP -->
					<?php $indexx++; ?>
				@endforeach
			@endif


			<?php $grandtotal += $detail['cartheader']['totalprice']; ?>
		@endforeach
		<tr class="">
			<td colspan="2">
				<!-- Catatan: <span class="text-bold">Harga sudah termasuk PPN 10%</span> -->
			</td>
			<td class="text-xs-right">
				Total Keseluruhan<br>
				<i class="purple">Grand Total</i>
			</td>
			<td class="text-xs-right">
				<i class="purple">Rp</i> 
				<b>{{number_format($grandtotal, 0, '.', ',')}}</b>
			</td>
		</tr>
		<tr class="text-bold text-xs-center">
			<td colspan="4">Terima kasih, Anda telah berbelanja di JakartaBrosur.com</td>
		</tr>
	</table>
	<div class="clear"></div>

	@if(!$lunas)
	<table class="table text-xs-center v-top margin-10-0 size-14">
		<tr>
			<td width="25%">
				<img src="image/BCA.jpg" height="25px">
				<p><span class="text-bold">Bank BCA</span><br>1-949-969-868<br>an. Indra Saswita<br>Cab. Pangeran Jayakarta</p>
			</td>
			<td width="25%">
				<img src="image/MANDIRI.jpg" height="25px">
				<p><span class="text-bold">Bank Mandiri</span><br>9-000-014-120-381<br>an. Indra Saswita<br>Cab. Pangeran Jayakarta</p>
			</td>
			<td width="25%">
				<img src="image/BRI.jpg" height="25px">
				<p><span class="text-bold">Bank BRI</span><br>210-201-004-093-506<br>an. Indra Saswita<br>Cab. Pangeran Jayakarta</p>
			</td>
			<td width="25%">
				<img src="image/BNI.jpg" height="25px">
				<p><span class="text-bold">Bank BNI</span><br>0-480-767-560<br>an. Indra Saswita<br>Cab. Pangeran Jayakarta</p>
			</td>
		</tr>
	</table>
	@endif

	<div class="clear"></div>
	<div class="size-12 helvetica">Surat Invoice ini dicetak secara otomatis, sehingga tidak membutuhkan tanda tangan.</div>
	<div class="clear"></div>
	<hr>
	<div class="size-10 helvetica text-xs-right">tgl. cetak : {{date('d M Y')}}</div>
	<div class="size-10 helvetica text-xs-right">di cetak dalam uk. kertas A4</div>
	@else
	<div class="text-xs-center size-16 margin-80-0">
		File tidak diketemukan. -ERROR-
	</div>
	@endif
</body>