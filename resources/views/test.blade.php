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
		.italic{font-style:italic;}
		.margin-0{margin:0;}
		.margin-10-0{margin:10px 0;}
		.margin-20-0{margin:20px 0;}
		.margin-80-0{margin:80px 0;}
		.width-33{width:33%;}
		.v-top{vertical-align: top !important;}
		.v-bot{vertical-align: bottom;}
		.hhead{font-weight: bold; color:#509; font-size:16px; text-align: left;}
		.dhead{background-color: #ccc;}
		.dhead th{padding:10px 5px;}
		.detail tr td{border-top:1px #777 solid;padding:5px 3px;}
		.border-clear td{border:0 !important;}
		.grandtotal td{border-bottom: 1px #777 solid;}
		.gray{color:#777;}
		.height-12{line-height: 0.3;}
	</style>
</head>
<body>
	@if(isset($sales))
	<?php $salesCreatedAt = date_create($sales['created_at']); ?>
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
	<table class="table margin-20-0">
		<tr class="hhead">
			<td>Alamat Tujuan</td>
			<td>Info Pengiriman</td>
			<td>Pembayaran</td>
		</tr>
		<tr class="v-top size-14">
			<td class="width-33">
				{{$sales['delivery']['receiver']}}<br>{{$sales['delivery']['address']}}
			</td>
			<td class="width-33">
				@if($sales['delivery']!=null)
					Jenis Pengiriman : <strong>{{$sales['delivery']['deliverytype']}}</strong><br>
					Berat : 0 kg<br>
					Harga Kirim : Rp {{number_format($sales['delivery']['price'], 0, '.', ',')}}
				@else
					Jenis Pengiriman : <strong>Diambil</strong><br>
					Berat : 0 kg<br>
					Harga Kirim : GRATIS
				@endif
			</td>
			<td class="width-33">
				Metode : 
				@if($sales['payment']['id']==null)
					<span>CASH</span>
				@else
					<span>{{$sales['payment']['type']}}</span>
				@endif
				<br>
				Kode Unik : -<br>
				Status : 
				@if($sales['payment']['id']==null)
					<span class="red">BELUM LUNAS</span>
				@elseif($sales['payment']['paymentID']==null)
					<span class="red">BELUM DI VERIF</span>
				@else
					<span class="green">LUNAS</span>
				@endif
			</td>
		</tr>
	</table>
	<div class="clear"></div>
	<table class="table detail helvetica margin-10-0 size-12">
		<tr class="dhead size-16">
			<th>Judul Kerjaan</th>
			<th>Deskripsi</th>
			<th>Berat</th>
			<th>Harga</th>
		</tr>
		<?php $grandtotal = 0; ?>
		@foreach($sales['details'] as $detail)
		<tr class="v-top">
			<td>{{$detail['jobtype']}}<br><span class="text-bold">{{$detail['jobtitle']}}</span><br>{{$detail['customernote']}}</td>
			<td>Qty: {{number_format($detail['quantity'], 0, '.', ',')}} {{$detail['quantitytypename']}}<br>Material: {{$detail['papertype']}} {{$detail['gramature']}}gsm ({{$detail['papername']}})<br>Cetak {{$detail['sideprint']}} sisi<br>Ukuran: {{$detail['imagesize']}}</td>
			<td class="text-xs-center">{{$detail['totalweight']}}kg<br>total: {{$detail['totalpackages']}}koli</td>
			<td class="text-xs-right">{{number_format($detail['totalprice'], 0, '.', ',')}}</td>
			<?php $grandtotal += $detail['totalprice']; ?>
		</tr>
		@endforeach
		<tr class="">
			<td colspan="2"><span class="text-bold">Catatan</span> Harga sudah termasuk PPN 10%</td>
			<td>Total Harga</td>
			<td class="text-xs-right">{{$grandtotal}}</td>
		</tr>
		<tr class="border-clear">
			<td colspan="2"></td>
			<td>Biaya Kirim + ADM</td>
			<td class="text-xs-right">{{number_format($sales['delivery']['price'], 0, '.', ',')}}</td>
		</tr>
		<tr class="border-clear">
			<td colspan="2"></td>
			<td>Kode Unik</td>
			<td class="text-xs-right">0</td>
		</tr>
		<tr class="text-bold grandtotal">
			<td colspan="2">Terima kasih telah berbelanja di Jakartabrosur.com</td>
			<td>Grand Total</td>
			<td class="text-xs-right">{{number_format($grandtotal + $sales['delivery']['price'], 0, '.', ',')}}</td>
		</tr>
	</table>
	<div class="clear"></div>
	<table class="table text-xs-center v-top margin-20-0 size-14">
		<tr>
			<td width="25%">
				<img src="image/BCA.jpg" height="25px">
				<p><span class="text-bold">BCA</span><br>1-949-969-868<br>an. Indra Saswita<br>Cab. Pangeran Jayakarta</p>
			</td>
			<td width="25%">
				<img src="image/MANDIRI.jpg" height="25px">
				<p><span class="text-bold">Mandiri</span><br>9-000-014-120-381<br>an. Indra Saswita<br>Cab. Pangeran Jayakarta</p>
			</td>
			<td width="25%">
				<img src="image/BRI.jpg" height="25px">
				<p><span class="text-bold">BRI</span><br><br>an. Indra Saswita<br>Cab. Pangeran Jayakarta</p>
			</td>
			<td width="25%">
				<img src="image/BNI.jpg" height="25px">
				<p><span class="text-bold">BNI</span><br><br>an. Indra Saswita<br>Cab. Pangeran Jayakarta</p>
			</td>
		</tr>
	</table>
	<div class="clear"></div>
	<hr>
	<div class="size-10 helvetica text-xs-right">tg. cetak : {{date('d M Y')}}</div>
	<div class="size-10 helvetica text-xs-right">di cetak dalam uk. kertas A4</div>
	@else
	<div class="text-xs-center size-16 margin-80-0">
		File tidak diketemukan. -ERROR-
	</div>
	@endif
</body>