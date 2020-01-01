
<div class="modal fade" id="print-progress-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Printing Progress Result</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
				<div class="text-xs-center">
					<div class="tracking-status">
						<div class="tracking-ball">
							<span class="fas fa-shopping-bag"></span>
						</div>

						<div class="line" ng-class="{'state-invisible':salesdetail.salesheader.totalpayment<item.totalprice}"></div>
						<div class="tracking-ball" ng-class="{'state-invisible':salesdetail.salesheader.totalpayment<salesdetail.salesheader.totalprice}" data-toggle="tooltip" data-title="<b>LUNAS</b>" data-placement="top" data-html="true">
							<span class="fas fa-dollar-sign"></span>
						</div>

						<div class="line" ng-class="{'state-invisible':salesdetail.statusfile==0}"></div>
						<div class="tracking-ball" ng-class="{'state-invisible':salesdetail.statusfile==0}" data-toggle="tooltip" data-title="<b>Pembuatan Plat</b>" data-placement="top" data-html="true">
							<span class="far fa-copy"></span>
						</div>

						<div class="line" ng-class="{'state-invisible':salesdetail.statusctp==0}"></div>
						<div class="tracking-ball" ng-class="{'state-invisible':salesdetail.statusctp==0}" data-toggle="tooltip" data-title="<b>Siap Cetak</b>" data-placement="top" data-html="true">
							<span class="fab fa-usb"></span>
						</div>

						<div class="line" ng-class="{'state-invisible':salesdetail.statusprint==0}"></div>
						<div class="tracking-ball" ng-class="{'state-invisible':salesdetail.statusprint==0}" data-toggle="tooltip" data-title="<b>Selesai Cetak & Finishing</b>" data-placement="top" data-html="true">
							<span class="fas fa-print"></span>
						</div>

						<div class="line" ng-class="{'state-invisible':salesdetail.statuspacking==0}"></div>
						<div class="tracking-ball" ng-class="{'state-invisible':salesdetail.statuspacking==0}" data-toggle="tooltip" data-title="<b>Selesai bungkus</b>" data-placement="top" data-html="true">
							<span class="fas fa-boxes"></span>
						</div>

						<div class="line" ng-class="{'state-invisible':salesdetail.statusdelivery==0}"></div>
						<div class="tracking-ball" ng-class="{'state-invisible':salesdetail.statusdelivery==0}" data-toggle="tooltip" data-title="<b>Sudah Kirim</b>" data-placement="top" data-html="true">
							<span class="fas fa-truck fa-flip-horizontal"></span>
						</div>

						<div class="line" ng-class="{'state-invisible':salesdetail.statusdone==0}"></div>
						<div class="tracking-ball" ng-class="{'state-invisible':salesdetail.statusdone==0}" data-toggle="tooltip" data-title="<b>Sudah diterima</b>" data-placement="top" data-html="true">
							<span class="fas fa-check"></span>
						</div>
					</div>
					<div class="margin-10">
						<span class="tx-lightgray">
							Last edit: 
						</span>
						<span class="tx-lightmagenta">
							[[salesdetail.updated_at|date:'medium']]
						</span>
						
						<br>

						<span class="tx-lightgray">
							<i class="fas fa-history"></i>
						</span>
						<span class="tx-lightmagenta"> 
							[[salesdetail.pip]]
						</span>
					</div>
				</div>
				<div class="modal-flat-button">
					<button class="btn btn-sm btn-outline-purple" data-dismiss="modal">
						OKAY
					</button>
				</div>

			</div>
		</div>
	</div>
</div>