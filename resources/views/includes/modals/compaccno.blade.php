	<!-- Modal -->
	<div class="modal fade" id="compaccnoModal" tabindex="-1" role="dialog" ng-controller="CompaccShowController">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="myModalLabel">Daftar No Rekening</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="bank-list">
						<ul class="list-header">
							<li ng-repeat="item in compaccs">
								<a href="" class="a-purple" ng-class="{'active':item.alias==showncompacc.alias}" ng-click="showcompacc(item)">
									<div>
										<img ng-src="{{URL::asset('image/banks/[[item.logo]].png')}}">
										<div class="txt">[[item.alias]]</div>
									</div>
								</a>
							</li>
						</ul>
						<div class="no-choosen" ng-show="showncompacc==null">
							Silahkan pilih Bank Tujuan
						</div>
						<div class="list-detail-wrapper" ng-show="showncompacc!=null">
							<div class="list-detail">
								<div class="size-70p trp">
									No. Rekening
								</div>
								<div class="size-140p" id="accno">
									[[showncompacc.accno]]
								</div>
								<button class="btn btn-sm btn-outline-purple" ng-click="copyToClipboard('accno')">
									copy
								</button>
								<div class="">
									<small class="trp">a/n. </small>[[showncompacc.accname]]
								</div>
								<div class="trp size-70p">
									Cabang [[showncompacc.acclocation]]
								</div>
								<div class="size-80p">
									<span class="trp">Nama: </span>[[showncompacc.bankname]]
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>