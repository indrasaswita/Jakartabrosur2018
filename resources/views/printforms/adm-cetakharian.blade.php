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
		b{color: #509;}
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
	@if(isset($details))
	<div style="height: 1097px;margin: 1px;">
		<table class="width-100">
			<tr>
				<td class="size-24 italic width-80">
					<div class="width-80"><b>Jadwal Cetak Harian</b> - Jakartabrosur.com</div>
				</td>
				<td class="height-12 width-20 salesno">
					<h5 class="text-xs-center gray italic">Mesin</h5>
					<h2 class="text-xs-center margin-0 italic">SM52</h2>
				</td>
			</tr>
		</table>
		<div class="clear"></div>
		<hr>
		<div class="clear"></div>
		@foreach($details as $detail)
		<table class="width-100 text-left size-14 v-top">
			<tr>
				<td colspan="2" style="border-top: 2px solid #cc9;">
					{{$detail['cartheader']['jobtitle']}}
				</td>
				<td colspan="2" style="border-top: 2px solid #cc9;">
					{{number_format($detail['cartheader']['quantity'], 0, '.', ',')}} {{$detail['cartheader']['quantitytypename']}}
				</td>
			</tr>
		@foreach($detail['cartheader']['cartdetail'] as $detail2)
			<tr>
				<td>
					Cetak {{$detail2['side2']>0?"2":"1"}} sisi ({{$detail2['side1']}}/{{$detail2['side2']}})
				</td>
				<td>
					Plano: {{number_format($detail2['plano']['width'], 0, '.', ',')}} x {{number_format($detail2['plano']['length'], 0, '.', ',')}} cm
				</td>
				<td>
					Kertas: {{number_format($detail2['printwidth'], 1, '.', ',')}} x {{number_format($detail2['printlength'], 1, '.', ',')}} cm
				</td>
				<td>
					Gambar: {{$detail2['imagewidth']}} x {{$detail2['imagelength']}} cm
				</td>
			</tr>
			<tr>
				<td>
					Total {{number_format($detail2['totaldruct'], 0, '.', ',')}} druct
				</td>
				<td>
					{{number_format($detail2['totaldruct']-$detail2['inschiet'], 0, '.', ',')}} druct +ins. {{number_format($detail2['inschiet'], 0, '.', ',')}}
				</td>
				<td colspan="2">
					{{$detail2['totalinprintx']}} x {{$detail2['totalinprinty']}}{{$detail2['totalinprintrest']==0?"":" + ".$detail2['totalinprintrest']}} = {{$detail2['totalinprint']}} dalam 1 druct
				</td>
			</tr>
		@endforeach
			<tr>
				<td colspan="2">
					<b>Customer:</b> 
					{{$detail['salesheader']['customer']['name']}}
					{{$detail['salesheader']['customer']['companyID']!=1?"[".$detail['salesheader']['customer']['company']['name']."]":""}}
				</td>
				<td colspan="2" class="text-xs-right">
					<b>Tgl. Pesan:</b> {{$detail['salesheader']['created_at']}}
				</td>
			</tr>
			@if($detail['customernote']!='')
				<tr>
					<td colspan="4">
						<b>Pesan Langganan:</b> {{$detail['customernote']}}
					</td>
				</tr>
			@endif
			@if($detail['employeenote']!='')
				<tr>
					<td colspan="4">
						<b>Pesan dr Kasir:</b> {{$detail['employeenote']}}
					</td>
				</tr>
			@endif
			@if($detail['itemdescription']!='')
				<tr>
					<td colspan="4">
						<b>Catatan Tambahan:</b> {{$detail['itemdescription']}}
					</td>
				</tr>
			@endif
		</table>
		@endforeach
		<div class="clear"></div>
		<hr>
		<div class="size-10 text-xs-right">tg. cetak : {{date('d M Y')}}</div>
		<div class="size-10 text-xs-right">di cetak dalam uk. kertas A4</div>
	</div>
	@else
	<div class="text-xs-center size-16 margin-80-0">
		File tidak diketemukan. -ERROR-
	</div>
	@endif
</body>