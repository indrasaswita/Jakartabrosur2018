<table class="table" cellpadding="0" cellspacing="0" border="0" align="center" width="100%" style="
	border-collapse: collapse;
	width: 100%;
	margin: 0;
">
	<tbody>
		<tr>
			<td colspan="3" style="
				text-align: center;
				background-color: #509;
			color: white;
			padding: 10px 20px;
			text-decoration: none;
			font-size: 16px;
			border-radius: 6px 6px 0 0;
			">
				<!-- <img src="http://jakartabrosur.com/image/logo-new.png" style="width: 40%"> -->
				<small>www.</small>jakartabrosur<small>.com</small>
			</td>
		</tr>
		<tr>
			<td style="width: 15%"></td>
			<td style="
				color: black;
				margin: 10px 0;
				width: 70%;
			">
				<br>
				<br>
				Dear, <strong style="color:#509;">{{$customer->title}} <span style="text-transform: capitalize;">{{$customer->name}}</span></strong>.
				<br>
				Terima kasih sudah bergabung dengan Jakarta Brosur. 
				<br>
				Silahkan klik link verifikasi untuk langkah terakhir pendaftaran.
				<br>
				<div style="
					width: 100%;
					text-align: center;
				">
					<br>
					<a href="{{URL::asset('customer/verify')}}/{{$customer->verify_token}}" style="
						background-color: #509;
						color: white;
						text-decoration: none;
						border: 1px solid #307;
						border-radius: 6px;
						padding: 10px 20px;
					">
						Verify Mail
					</a>
					<br>
					<br>
					<br>
				</div>
			</td>
			<td style="width: 15%"></td>
		</tr>
		<tr>
			<td colspan="3" style="
				text-align: center;
				background-color: #509;
			color: white;
			padding: 2px 20px;
			text-decoration: none;
			font-size: 11px;
			border-radius: 0 0 6px 6px;
			">
				Untuk layanan customer silahkan hubungi <b>(+62) 813-1551-9889</b>.
				<br>
				Mohon untuk tidak membalas email ini.
			</td>
		</tr>
	</tbody>
</table>

