
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
			<span class="icon lowercase">
				<i class="fas fa-bell fa-fw"></i>
				<span class="hidden-xs-down">error</span>
			</span>
			<span>[[error.savecartval]]</span>
		</div>

		<div class="block-flex">
			<div class="block-list">
				<a href="" class="a-inherit a-noline" ng-click="calcheadtabclick()">
					<div class="list-title">
						Cetak
					</div>
					<div class="list-data" ng-if="total.price<=999">
						[[total.price|number:0]]
					</div>
					<div class="list-data" ng-if="total.price>999">
						[[floor(total.price/1000)|number:0]]<span class="size-70p">,[[zeroFill(total.price%1000, 3)]]</span>
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
				</a>
			</div>
			<div class="block-sign">
				+
			</div>
			<div class="block-list">
				<a href="" class="a-inherit a-noline" ng-click="descheadtabclick()">
					<div class="list-title">
						Ongkir
					</div>
					<div class="list-data" ng-if="total.deliv<=999">
						[[total.deliv|number:0]]
					</div>
					<div class="list-data" ng-if="total.deliv>999">
						[[floor(total.deliv/1000)|number:0]]<span class="size-70p">,[[zeroFill(total.deliv%1000, 3)]]</span>
					</div>
					<div class="list-data-small tx-primary">
						<span class="text-muted">
							<i class="fas fa-truck fa-flip-horizontal"></i>
						</span> 
						[[selected.delivery.deliveryname]]
					</div>
				</a>
			</div>
			<div class="block-sign">
				=
			</div>

			<div class="block-list bold">
				<div class="list-title">
					Total
				</div>
				<div class="list-data purple" ng-if="(total.price+total.deliv-total.disc)<=999">
					[[(total.price+total.deliv-total.disc)|number:0]]
				</div>
				<div class="list-data purple" ng-if="(total.price+total.deliv-total.disc)>999">
					[[(floor(total.price+total.deliv-total.disc)/1000)|number:0]]<b class="size-80p">,[[zeroFill(((total.price+total.deliv-total.disc)%1000), 3)]]</b>
				</div>
				<div class="list-data-small tx-primary">
					<span class="text-muted">
						@pcs
					</span> 
					[[((total.price+total.deliv-total.disc) / selected.quantity)|number:1]]
				</div>
				<div class="list-data-small notfixed tx-primary" ng-if="datas.satuan=='lembar'">
					<span class="text-muted">
						@ream
					</span> 
					[[((total.price+total.deliv-total.disc) / selected.quantity * 500)|number:0]]
				</div>
			</div>

			<div class="block-sign submit" ng-class="{'error':error.savecartval!=''}">
				<button ng-click="showsavedialog()" ng-disabled="error.savecart!=''">
					<div class="">
						<span class="fal fa-cart-plus fa-fw hidden-xs-down"> </span>
						<span class="fas fa-cart-plus fa-fw hidden-sm-up"> </span>
						<span class="size-50p hidden-xs-down">ORDER</span>
					</div>
				</button>
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

	<div class="panel-block" hidden>
		<div class="block-list submit">

			<div class="info" ng-show="error.message!=''">
				<small class="fas fa-exclamation"></small>
				Log-In Dulu!
			</div>

		</div>
	</div>

	<div class="panel-footer">
		<div class="txt">
			* ditulis dalam Rp (rupiah)
		</div>
	</div>

</div>

<div class="error-panel">
	<span class="icon lowercase">
		<i class="fas fa-bell fa-fw"></i>
		<span class="hidden-xs-down">error</span>
	</span>
	<span ng-if="error.savecartval!=''">[[error.savecartval]]</span>
</div>

<button class="btn btn-action-end" ng-click="showsavedialog()" ng-class="{'error':error.savecartval!=''}">
	<span class="icon">
		<i class="fal fa-cart-plus"></i>
	</span>
	Order
</button>