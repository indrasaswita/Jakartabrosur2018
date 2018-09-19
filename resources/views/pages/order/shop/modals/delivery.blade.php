<div class="modal fade" id="deliveryModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		<h4 class="modal-title" id="myModalLabel">
			Atur Pengiriman
		</h4>
	  </div>
		<div class="modal-body">
			<div class="subtitle">
				Pilih Tipe Pengiriman:
			</div>
			<select class="selectpicker margin-bottom-20" data-width="100%" ng-options="item as item.deliveryname for item in deliveries" ng-model="selected.delivery" ng-change="changedelivery(selected.delivery)"></select>
			<div class="subtitle">
				Masukkan Alamat Pengiriman: 
				<div class="subtitle-mini">
					(lengkap beserta patokan)
				</div>
			</div>
			<div class="display-flex">
				<input type="text" class="form-group width-100" ng-model="selected.deliveryaddress" ng-disabled="selected.deliverylocked">
				<span class="glyphicon glyphicon-ok tx-success right-icon" ng-hide="selected.deliveryaddress.length<10"></span> 
				<span class="glyphicon glyphicon-remove tx-danger right-icon" ng-show="selected.deliveryaddress.length<10"></span> 
			</div>
			<div class="subtitle">
				Perkiraan Harga Kirim: 
				<div class="subtitle-mini">
					(kami akan beritahukan bila ada perubahan)
				</div>
			</div>
			<div class="form-group width-100">
				Rp 
				<storng>
					[[result.total.deliv|number:0]]
				<strong>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-purple" data-dismiss="modal" ng-click="getPrice()">Close</button>
		</div>
	</div>
  </div>
</div>