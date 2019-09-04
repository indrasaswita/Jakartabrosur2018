@include('modal-sm', 
	[
		'modalid' => 'infodelivery',
		'modaltitle' => 'Info Pengiriman',
		'modalbody' => '
			<div class="text-xs-center">
				Harga yang tertera adalah harga perkiraan. Kalkulasi harga akan dilakukan MANUAL setelah order ditetapkan.
				<br><br>
				Dikarenakan sistem kami masih manual, ketika ada perubahan akan diberitahukan via Telepon ke nomor ponsel yang Anda simpan.
				<br>
				<hr>
				perkiraan harga untuk [[selectedCart.delivery.deliveryname]]:
				<h2 class="margin-0">
					[[selectedCart.deliveryprice|number:0]]
				</h2>
				<span class="tx-gray">
					untuk pengiriman ke 
				</span>
				<br>
				<i class="fal fa-home fa-fw"></i>
				[[selectedCart.deliveryaddress.address]]
				<br>
				<hr>
				Jika ada perubahan harga akan diberitahukan melalui [[selectedCart.customer.phone1]]<span ng-if="selectedCart.customer.phone2.length>0"> / [[selectedCart.customer.phone2]]</span>. Dimohon untuk selalu aktif.

			</div>
			<br>
			<div class="modal-flat-button">
				<button class="btn btn-sm btn-purple" data-dismiss="modal">
					OKAY
				</button>
			</div>
		',
		'modalfooter' => ''
	]
)