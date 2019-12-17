<!-- Modal -->
<div class="modal fade" id="reviewCartModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
				</button>
				<h6 class="modal-title" id="myModalLabel">
					Data Yang Terpilih
				</h6>
			</div>
			<div class="modal-body">
				<div class="cart-checkout">
					<table class="table">
						<tbody ng-repeat="item in selected">
							<tr class="row-head">
								<td class="data-title" colspan="3">
									[[zeroFill($index+1, 2)]].
									<b>[[item.jobsubtype.name]]</b>
									[[singkatText(item.jobtitle, 35, '')]]
								</td>
							</tr>
							<tr class="row-head">
								<td class="data-detail" colspan="2">
									<div>
										<span>
											[[item.quantity|number:0]] lembar
										</span>
										<span class="pull-xs-right">
											Rp [[(item.printprice)|number:0]]
										</span>
									</div>
									<div>
										<span>
											deliv: [[item.delivery.deliveryname]]
										</span>
										<span class="pull-xs-right">
											Rp [[(item.deliveryprice)|number:0]]
										</span>
									</div>
									<div ng-if="item.discount>0">
										<span>
											discount
										</span>
										<span class="pull-xs-right tx-purple">
											<b>- Rp [[(item.discount)|number:0]]</b>
										</span>
									</div>
								</td>
							</tr>
							<tr ng-repeat="item2 in item.cartdetail">
								<td class="width-min" rowspan="[[(item.cartdetail.length+1)]]" ng-if="$index==0">
									<img src="{{URL::asset('')}}image/jobsubtypeicons/[[item.jobsubtype.icon]]" alt="" >
								</td>
								<td class="data-detail">
									[[item2.cartname]] -- 
									<span ng-if="item2.jobtype=='DG'">
										Digital Print
									</span>
									<span ng-if="item2.jobtype=='OF'">
										Offset Print
									</span>
									<br>
									[[item2.printwidth]] x [[item2.printlength]] cm -- [[item2.paper.name]] "[[item2.paper.color]]" [[item2.paper.gramature]]gsm
									<div ng-repeat="detailfin in item2.cartdetailfinishing">
										- [[detailfin.finishing.name]], [[detailfin.finishingoption.optionname]]
									</div>
								</td>
							</tr>
							<tr>
								<td class="data-detail subtotal">
									Subtotal:
									<span class="pull-xs-right">
										[[(item.deliveryprice+item.printprice-item.discount)|number:0]]
									</span>
								</td>
							</tr>
							<tr>
								<td class="data-spacing" colspan="3"></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="total-price">
					total belanja
					<div class="num">
						Rp [[selectedPrice|number:0]]
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