
<div class="summary-panel fixed">
	<div class="panel-header">
		<div class="header-title">
			DETAIL HARGA
		</div>
	</div>
	<div class="text-xs-center margin-20-0" ng-show="waitingprice==true">
		<i class="fas fa-spinner fa-pulse fa-5x fa-fw tx-lightmagenta"></i>
	</div>
	<div class="panel-block" ng-hide="waitingprice==true">

		<div class="block-list-error" ng-hide="error.savecartval==''">
			<i class="fas fa-bell tx-danger"></i>&nbsp;
			<span class="tx-red">[[error.savecartval]]</span>
		</div>

		<div class="block-flex">
			<div class="block-list">
				<div class="list-title">
					Cetak
				</div>
				<div class="list-data">
					[[total.price|number:0]]
				</div>
				<div class="list-data-small tx-danger" ng-hide="total.disc==0">
					<span class="text-muted">
						disc
					</span> 
					- [[total.disc|number:0]]
				</div>
				<div class="list-data-small tx-danger" ng-show="total.disc==0">
					no discount
				</div>
			</div>
			<div class="block-sign">
				+
			</div>
			<div class="block-list">
				<div class="list-title">
					Ongkir
				</div>
				<div class="list-data">
					[[total.deliv|number:0]]
				</div>
				<div class="list-data-small tx-primary">
					<span class="text-muted">
						<i class="fas fa-truck fa-flip-horizontal"></i>
					</span> 
					[[selected.delivery.deliveryname]]
				</div>
			</div>
			<div class="block-sign">
				=
			</div>

			<div class="block-list bold">
				<div class="list-title">
					Total
				</div>
				<div class="list-data purple">
					[[(total.price+total.deliv-total.disc)|number:0]]
				</div>
				<div class="list-data-small tx-primary">
					<span class="text-muted">
						@pcs
					</span> 
					[[((total.price+total.deliv-total.disc) / selected.quantity)|number:1]]
				</div>
				<div class="list-data-small notfixed tx-primary">
					<span class="text-muted">
						@ream
					</span> 
					[[((total.price+total.deliv-total.disc) / selected.quantity * 500)|number:0]]
				</div>
			</div>

			<div class="block-sign submit" ng-show="error.message!=''">
				<a href="" class="" ng-click="showsavedialog()" ng-disabled="error.savecart!=''" ng-mouseover="tooltip('<b class=\'tx-danger\'><small class=\'far fa-bell\'></small>&nbsp;Log-In Required</b>')" ng-mouseleave="tooltip('')">
					<div class="">
						<span class="fas fa-print"> </span>
						<span class="size-40p">NEXT</span>
					</div>
				</a>
			</div>

			<div class="block-sign submit" ng-hide="error.message!=''">
				<a href="" class="" ng-click="showsavedialog()" ng-disabled="error.savecart!=''">
					<div class="">
						<span class="fas fa-print"> </span>
						<span class="size-40p">NEXT</span>
					</div>
				</a>
			</div>

		</div>


		<!-- <div class="block-button">
			<button class="btn btn-purple" ng-click="getPrice()">Cek Harga!</button>
		</div> -->

		<div class="divider"></div>

		<div class="link">
			<a href="" ng-click="cetakpenawaran()">Cetak Penawaran</a>
		</div>

		<div class="divider"></div>

		<div class="block-list notfixed">
			<div class="list-title">
				Total Proses
			</div>
			<div class="list-data">
				<i class="tx-lightgray far fa-clock"></i>
				[[(total.processday+total.deliveryday)]] hari kerja
			</div>
		</div>

		<div class="block-list notfixed">
			<div class="list-title">
				Estimasi <span data-toggle="tooltip" data-title="<b>Perkiraan waktu yang dibutuhkan</b>, untuk pastinya, silahkan tanyakan langsung<br><br>Terhitung mulai di hari tersebut (<b>SYARAT</b> sudah lunas dan file sudah OK <span class='tx-red'>sebelum jam 3 sore</span>).<br><br>Note: prediksi selesai, sudah beserta waktu pengiriman." data-html="true" data-placement="right"><small class="far fa-question-circle tx-lightmagenta"></small></span>
			</div>
			<div class="list-data">
				[[total.afterdeliverydom]], 
				[[total.afterdelivery]]
			</div>
		</div>

		<div class="block-list notfixed">
			<div class="list-title">
				
			</div>
			<div class="list-data tx-red">
				<i class="far fa-calendar-check tx-lightgray"></i>
				[[total.afterdeliverydiff]]
			</div>
		</div>

		<div class="block-list notfixed">
			<div class="list-title">
				Total Berat <span data-toggle="tooltip" data-title="<span class='tx-red'>Tidak termasuk berat tinta, jilid, dan pembungkus</span>.<br>Hanya terhitung <b>perkiraan</b> berat dari kertas dan laminating." data-html="true" data-placement="right"><small class="far fa-question-circle tx-lightmagenta"></small></span>
			</div>
			<div class="list-data">
				&#xb1 [[total.weight|number:2]]kg
			</div>
		</div>
	</div>

	<div class="panel-block">
		<div class="block-list submit">

			<button class="btn btn-purple btn-sm" ng-click="showsavedialog()">
				<i class="fas fa-print"></i>
				Add to Cart
			</button>

			<div class="info" ng-show="error.message!=''">
				<small class="fas fa-exclamation"></small>
				Log-In Required
			</div>

		</div>
	</div>

	<div class="panel-footer">
		<div class="txt">
			* ditulis dalam Rp (rupiah)
		</div>
	</div>
</div>