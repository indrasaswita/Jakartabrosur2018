<!-- Modal -->
<div class="modal fade" id="reviewCartModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
				<h6 class="modal-title" id="myModalLabel">Data Yang Terpilih</h6>
		  </div>
			<div class="modal-body">
				<div class="cart-checkout">
					<div class="" ng-hide="selected.length > 0">
						Silahkan pilih pada keranjang belanja.
					</div>
					<table class="table table-sm cart-checkout-table" ng-show="selected.length > 0">
						<thead class="bg-purple">
						</thead>
						<tbody ng-repeat="item in selected">
							<tr class="row-head">
								<td class="data-title text-xs-center" colspan="3">
									[[zeroFill($index+1, 2)]].
									<b>[[item.jobsubtype.name]]</b>
									[[singkatText(item.jobtitle, 35, '')]]
								</td>
							</tr>
							<tr ng-repeat="item2 in item.cartdetail">
								<td class="data-detail">
									[[item2.cartname]]
								</td>
								<td class="data-detail">
									[[item2.printwidth]] x [[item2.printlength]] cm
								</td>
								<td class="data-detail text-xs-right">
									[[item2.paper.name]] "[[item2.paper.color]]" [[item2.paper.gramature]]gsm
								</td>
							</tr>
							<tr>
								<td class="data-detail">
									[[item.quantity|number:0]] lembar
								</td>
								<td class="data-detail">
									[[item.delivery.deliveryname]]
								</td>
								<td class="data-detail text-xs-right">
									[[(item.deliveryprice+item.printprice-item.discount)|number:0]]
								</td>
							</tr>
						</tbody>
						<tbody>
							<tr class="row-end">
								<td class="text-xs-right data-detail" colspan="2">Total Price : &nbsp;</td>
								<td class="text-xs-right data-detail tx-purple">[[selectedPrice|number:0]]</td>
							</tr>
						</tbody>
					</table>
					<div class="alert alert-sm alert-outline-purple size-80p tx-gray">
						Item yang dipilih <span class="size-12">(diatas)</span> akan diproses menjadi satu kesatuan, diantaranya:
						<ol class="margin-0">
							<li>Satu nota (bisa berisi banyak item)</li>
							<li>Satu kali pembayaran</li>
							<li>Satu alamat pengiriman</li>
						</ol>
					</div>
			  </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-purple" data-dismiss="modal" ng-click="checkout()">
					Checkout 
					<i class="fa fa-chevron-right"></i>
				</button>
			</div>
		</div>
	</div>
</div>