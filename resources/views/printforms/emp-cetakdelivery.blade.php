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
		.height-15{line-height: 1.5;}
		.height-12{line-height: 1.2;}
		.height-03{line-height: 0.3;}
		.display-flex{ display: flex !important; }
		.display-block{ display: block !important; }
		.display-inline{ display: inline !important; }
		.divider{ margin: 5px 2px; border-bottom: 1px solid #aaa; }
		.text-left th{text-align:left !important; color: black;}
		.td-right td{text-align:right !important; padding:0 5px; color:#74a;}
		.border{border: 1px solid #000;}
		@page{
			margin-top: 0.1em;
			margin-bottom: 0.1em;
			margin-left: 0.8em;
			margin-right: 0.8em;
		}
	</style>
</head>
<body class="helvetica">
	@if(isset($header))
	<div style="height: 456px;margin: 1px;">
		<table class="width-100">
			<tr>
				<td class="italic width-80">
					<b class="size-24">Surat Jalan</b> 
					<br>
					<small class="gray size-14">
						No. Surat Jalan <b>#{{sprintf('%05d', $header['id'])}}</b>
					</small>
				</td>
				<td class="width-20">
					<h5 class="text-xs-center gray italic width-15">
						Tgl. Pembuatan : &nbsp;&nbsp;&nbsp;&nbsp;<br>
						<b>{{$header['created_at']}}</b>
					</h5>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="gray size-14">Pengirim: <b>{{$header['employee']['name']}}</b></td>
			</tr>
			@if(strlen($header['address'])>5)
			<tr>
				<td colspan="2" class="gray size-14">Alamat: <b>{{$header['address']}}</b></td>
			</tr>
			@endif
			@if(strlen($header['employeenote'])>5)
			<tr>
				<td colspan="2" class="gray size-14">Pesan: <b>{{$header['employeenote']}}</b></td>
			</tr>
			@endif
			<tr>
				<td colspan="2" class="gray size-14">
					Pemesan: 
					<b>
					@if ($header['salesheader']['customer']['company']['id']!=1)
						{{$header['salesheader']['customer']['company']['name']}}
					</b>
					, U/p.
					<b>
					@endif
						{{$header['salesheader']['customer']['name']}}
					</b>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="gray size-14">
					Telepon: 
					@if (strlen($header['salesheader']['customer']['phone1'])>5)
					<b>
						{{$header['salesheader']['customer']['phone1']}}
					</b>
					@endif
					@if (strlen($header['salesheader']['customer']['phone2'])>5)
					/
					<b>
						{{$header['salesheader']['customer']['phone2']}}
					</b>
					@endif
					@if (strlen($header['salesheader']['customer']['phone3'])>5)
					/
					<b>
						{{$header['salesheader']['customer']['phone3']}}
					@endif
					</b>
				</td>
			</tr>
			@if ($header['salesheader']['customer']['company']['id']!=1)
			<tr>
				<td colspan="2" class="gray size-14">
					Kantor: 
					(
					@if (strlen($header['salesheader']['customer']['company']['nickname'])>1)
					<b>
						{{$header['salesheader']['customer']['company']['nickname']}}
					</b>
					@endif
					)

					@if (strlen($header['salesheader']['customer']['company']['phone1'])>5)
					<b>
						{{$header['salesheader']['customer']['company']['phone1']}}
					</b>
					@endif
					@if (strlen($header['salesheader']['customer']['company']['phone2'])>5)
					/
					<b>
						{{$header['salesheader']['customer']['company']['phone2']}}
					</b>
					@endif
					@if (strlen($header['salesheader']['customer']['company']['phone3'])>5)
					/
					<b>
						{{$header['salesheader']['customer']['company']['phone3']}}
					@endif
					</b>
				</td>
			</tr>
			@endif
		</table>
		<div class="clear"></div>
		<hr>
		<div class="clear"></div>
		@foreach($header['salesdeliverydetail'] as $detail)
		<table class="width-100 size-16 v-top">
			<tr>
				<td colspan="3" class="text-xs-left" style="border-top: 1px solid #999;">
					<span class="gray">No. Job </span>
					<b>#{{sprintf('%05d', $header['salesheader']['id'])}}</b>
					-
					<b>
						{{substr($detail['salesdetail']['cartheader']['jobtitle'], 0, 36)}}
						@if(strlen($detail['salesdetail']['cartheader']['jobtitle'])>36)
							...
						@endif
					</b>
					<span class="gray">
						( Total: <b>{{number_format($detail['salesdetail']['cartheader']['quantity'], 0, '.', ',')}}</b> {{$detail['salesdetail']['cartheader']['quantitytypename']}} )
					</span>
				</td>
			</tr>
			<tr>
				<td>
					<b>{{number_format($detail['quantity'], 0, '.', ',')}}</b> 
					{{$detail['salesdetail']['cartheader']['quantitytypename']}}
				</td>
				<td>
					<b>{{number_format($detail['weight'], 1, '.', ',')}}</b> kg
				</td>
				<td>
					<b>{{number_format($detail['totalpackage'], 0, '.', ',')}}</b> koli
				</td>
			</tr>
			@if($detail['salesdetail']['cartheader']['customernote']!='')
			<tr class="size-14">
				<td colspan="3" style="border-top:1px solid #aaa">
					<span class="gray">Pesan Langganan: </span>
					<b>{{$detail['salesdetail']['cartheader']['customernote']}}</b>
				</td>
			</tr>
			@endif
		</table>
		@endforeach
		<div class="clear"></div>
		<hr>
		<div class="clear"></div>
	</div>
	<div style="height:73px; margin:0;">
		<table class="width-100 size-16 v-top">
			<tr>
				<td class="text-xs-center">
					Penerima,
				</td>
				<td class="text-xs-center">
					Hormat Kami,
				</td>
				<td>
					
				</td>
			</tr>
			<tr>
				<td colspan="3">
					&nbsp;
				</td>
			</tr>
			<tr>
				<td class="text-xs-center width-33">
					____________________
				</td>
				<td class="text-xs-center width-33">
					____________________
				</td>
				<td class="width-33">
					<div class="size-10 text-xs-right">
						tg. cetak : {{date('d M Y')}}
					</div>
					<div class="size-10 text-xs-right">
						di cetak dalam uk. kertas 1/2 Folio
					</div>
				</td>
			</tr>
		</table>

		<div class="clear"></div>
	</div>
	@else
	<div class="text-xs-center size-16 margin-80-0">
		File tidak diketemukan. -ERROR-
		}
	</div>
	@endif
</body>