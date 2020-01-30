<head>
	<style>
		.purple{color:#509;}
		.helvetica{font-family:'Helvetica';}
		.courier{font-family:'Courier';}
		.magra{font-family:'Magra';}
		.amaranth{font-family:'Amaranth';}
		.signika{font-family:'Signika';}
		.text-bold{font-weight:bold;}
		.width-min{width:1%;}
		.table{background-color:#fff; width:100%;float:left;border-collapse: collapse;}
		.size-10{font-size:10px}
		.size-12{font-size:12px}
		.size-14{font-size:14px}
		.size-16{font-size:16px}
		.size-24{font-size:24px}
		.size-30{font-size:30px}
		.size-36{font-size:36px}
		.size-48{font-size:48px}
		.size-72{font-size:72px}
		.text-xs-left{text-align:left}
		.text-xs-right{text-align:right}
		.text-xs-center{text-align:center}
		.clear{clear:both;}
		.salesno{padding: 0 0 10px 0; margin:0 10px;}
		.red{color:red;}
		.green{color:green;}
		.width-10{width:10%;}
		.width-20{width:20%;}
		.width-30{width:30%;}
		.width-40{width:40%;}
		.width-50{width:50%;}
		.width-60{width:60%;}
		.width-70{width:70%;}
		.width-80{width:80%;}
		.width-90{width:90%;}
		.width-100{width:100%;}
		.width-33{width:33%;}
		.italic{font-style:italic;}
		.margin-0{margin:0;}
		.margin-10-0{margin:10px 0;}
		.margin-20-0{margin:20px 0;}
		.margin-80-0{margin:80px 0;}
		.v-top{vertical-align: top !important;}
		.v-top td{vertical-align: top !important;}
		.v-top th{vertical-align: top !important;}
		.v-bot{vertical-align: bottom;}
		.hhead{font-weight: bold; color:#509; font-size:16px; text-align: left;}
		.dhead{background-color: #ccc;}
		.dhead th{padding:10px 5px;}
		.detail tr td{border-top:1px #777 solid;padding:5px 3px;}
		.border-clear td{border:0 !important;}
		.grandtotal td{border-bottom: 1px #777 solid;}
		.gray{color:#777;}
		.height-12{line-height: 0.3;}
		.display-flex{ display: flex !important; }
		.display-block{ display: block !important; }
		.display-inline{ display: inline !important; }
		.divider{ margin: 5px 2px; border-bottom: 1px solid #aaa; }
		.text-left th{text-align:left !important; color: black;}
		.td-right td{text-align:right !important; padding:0 5px; color:#74a;}
		@page{
			margin-top: 0.1em;
			margin-bottom: 0.1em;
			margin-left: 0.8em;
			margin-right: 0.8em;
		}
	</style>
</head>
<body class="helvetica">
	@if(isset($sales))
	<?php $salesCreatedAt = date_create($sales['created_at']); ?>
		<?php $grandtotal = 0; ?>
		@foreach($sales['details'] as $detail)
	<div style="height: 536px; margin:0">
		<table class="width-100">
			<tr>
				<td class="size-48 italic width-40">
					<div class="width-80">WorkOrder</div>
				</td>
				<td class="height-12 width-20 salesno">
					<h5 class="text-xs-center gray italic">Mesin</h5>
					<h2 class="text-xs-center margin-0 italic">{{$detail['printername']}}</h2>
				</td>
				<td class="height-12 width-20 salesno">
					<h5 class="text-xs-center gray italic">No. NOTA</h5>
					<h2 class="text-xs-center margin-0 italic"><span class="gray">#</span>{{sprintf('%05d', $sales['id'])}}</h2>
				</td>
				<td class="height-12 width-20 salesno">
					<h5 class="text-xs-center gray italic">No. DETAIL</h5>
					<h2 class="text-xs-center margin-0 italic"><span class="gray">#</span>{{sprintf('%05d', $detail['id'])}}</h2>
				</td>
			</tr>
		</table>
		<div class="clear"></div>
		<hr>
		<div class="clear"></div>
		<table class="width-100 td-right text-left size-12 v-top">
			<tr>
				<td class="width-50">
					<table class="table margin-10-0 width-100">
						<tr>
							<td class="width-30">Tipe Kerjaan</td>
							<th class="width-70">{{$detail['jobtype']}}</th>
						</tr>
						<tr>
							<td>Judul Kerjaan</td>
							<th>{{$detail['jobtitle']}}</th>
						</tr>
						<tr>
							<td>Catatan Cust</td>
							<th>{{$detail['customernote']}}</th>
						</tr>
						<tr>
							<td>Deskripsi</td>
							<th>{{$detail['itemdescription']}}</th>
						</tr>
						<tr>
							<td>Catatan Rhy</td>
							<th>{{$detail['employeenote']}}</th>
						</tr>
						<tr>
							<td colspan="2" class="dhead"></td>
						</tr>
						<tr>
							<td>Jumlah Bersih</td>
							<th>{{number_format($detail['quantity'], 0, '.', ',')}} {{$detail['quantitytypename']}}</th>
						</tr>
						<tr>
							<td>Ukuran Bersih</td>
							<th>{{$detail['imagewidth']}} x {{$detail['imagelength']}} cm</th>
						</tr>
						<tr>
							<td>Cetak</td>
							<th>{{$detail['sideprint']}} sisi</th>
						</tr>
						<tr>
							<td colspan="2" class="dhead"></td>
						</tr>
						<tr>
							<td>Format Cetak</td>
							<th>{{$detail['totalinprintx']}} x {{$detail['totalinprinty']}} + {{$detail['totalinprintrest']}} = {{$detail['totalinprint']}} dalam 1 druct</th>
						</tr>
						<tr>
							<td>Format Plano</td>
							<th>{{$detail['totalinplanox']}} x {{$detail['totalinplanoy']}} + {{$detail['totalinplanorest']}} = {{$detail['totalinplano']}} dalam 1 plano</th>
						</tr>
						<tr>
							<td>Cetak</td>
							<th>{{$detail['sideprint']}} sisi</th>
						</tr>
						<tr>
							<td colspan="2" class="dhead"></td>
						</tr>
						@foreach($detail['finishings'] as $finishing)
						<tr>
							<td style="color:#a04;">{{$finishing['finishingname']}}</td>
							<th>{{$finishing['optionname']}}</th>
						</tr>
						@endforeach
						<tr>
							<td colspan="2" class="dhead"></td>
						</tr>
					</table>
				</td>
				<td class="width-50">
					<table class="table margin-10-0 width-100">
						<tr>
							<td class="width-30">Jumlah Inschiet</td>
							<th class="width-70">{{number_format($detail['inschiet'], 0, '.', ',')}} {{$detail['inschiettypename']}}</th>
						</tr>
						<tr>
							<td>Total Druct</td>
							<th>{{$detail['totaldruct']}} druct</th>
						</tr>
						<tr>
							<td>Ukuran Cetak</td>
							<th>{{$detail['printwidth']}} x {{$detail['printlength']}} cm</th>
						</tr>
						<tr>
							<td colspan="2" class="dhead"></td>
						</tr>
						<tr>
							<td>Berat Kira2</td>
							<th>{{$detail['totalweight']}} kg</th>
						</tr>
						<tr>
							<td>Isi 1 Bungkus</td>
							<th>{{$detail['perbungkus']}} lembar</th>
						</tr>
						<tr>
							<td>Jumlah Bungkus</td>
							<th>{{$detail['totalpackage']}} bungkus</th>
						</tr>
						<tr>
							<td colspan="2" class="dhead"></td>
						</tr>
						<tr>
							<td>Pengiriman</td>
							<th>{{$detail['delivery']['deliveryname']}}</th>
						</tr>
						<tr>
							<td>Alamat</td>
							<th>{{$detail['deliveryaddress']}}</th>
						</tr>
						<tr>
							<td>Harga</td>
							<th>Rp {{number_format($detail['deliveryprice'], 0, '.', ',')}}</th>
						</tr>
						<tr>
							<td colspan="2" class="dhead"></td>
						</tr>
						<tr>
							<td>Material</td>
							<th>{{$detail['papername']}} {{$detail['gramature']}}gsm</th>
						</tr>
						<tr>
							<td>Warna</td>
							<th>{{$detail['papercolor']}}</th>
						</tr>
						<tr>
							<td>Ukuran Plano</td>
							<th>{{$detail['planowidth']}} x {{$detail['planolength']}} cm</th>
						</tr>
						<tr>
							<td>Ukuran Cetak</td>
							<th>{{$detail['printwidth']}} x {{$detail['printlength']}} cm</th>
						</tr>
						<tr>
							<td>Toko Kertas</td>
							<th>{{$detail['papershop']}}</th>
						</tr>
						<tr>
							<td>Jml. Plano 1</td>
							<th>{{(($detail['quantity']/$detail['totalinprint'])+$detail['inschiet'])/$detail['totalinplano']}} lembar plano</th>
						</tr>
						<tr>
							<td>Jml. Plano 2</td>
							<th>{{$detail['totalplano']}} lembar plano</th>
						</tr>
						<tr>
							<td>Harga Kira2</td>
							<th>Rp {{number_format($detail['totalpaperprice'], 0, '.', ',')}}</th>
						</tr>
						<tr>
							<td colspan="2" class="dhead"></td>
						</tr>
						@if($detail['resellername']!='')
						<tr>
							<td style="color:#a04;">Pengirim</td>
							<th>{{$detail['resellername']}}</th>
						</tr>
						<tr>
							<td style="color:#a04;">Dari- </td>
							<th>{{$detail['resellername']}}</th>
						</tr>
						@else
						<tr>
							<td style="color:#a04;">Pengirim </td>
							<th>
								<span style="color:#74a;">JAKARTABROSUR</span><span style="color:#aaa;">.com</span>
							</th>
						</tr>
						@endif
						<tr>
							<td colspan="2" class="dhead"></td>
						</tr>
						<tr>
							<td>Waktu Cetak</td>
							<th>{{$detail['processtime']}} hari</th>
						</tr>
						<tr>
							<td>Selesai Cetak</td>
							<th>{{$detail['afterprint']}}</th>
						</tr>
						<tr>
							<td>Warktu Kirim</td>
							<th>{{$detail['deliverytime']}} hari</th>
						</tr>
						<tr>
							<td>Cetak + Kirim</td>
							<th>{{$detail['deadline']}}</th>
						</tr>
						<tr>
							<td colspan="2" class="dhead"></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<div class="clear"></div>
		<hr>
		<div class="size-10 text-xs-right">tg. cetak : {{date('d M Y')}}</div>
		<div class="size-10 text-xs-right">di cetak dalam uk. kertas A4</div>
	</div>
		@endforeach
	@else
	<div class="text-xs-center size-16 margin-80-0">
		File tidak diketemukan. -ERROR-
	</div>
	@endif
</body>