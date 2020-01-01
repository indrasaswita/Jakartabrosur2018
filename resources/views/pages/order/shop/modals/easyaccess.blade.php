<div class="modal fade" id="easyaccess" tabindex="-1" role="dialog" ng-show="datas.jobsubtypetemplate.length>0">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					Easy Access
				</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="order-description">

					<div class="description-panel">
						<div class="panel-block">
							<div class="block-list">
								<div class="input">
									<div class="btn-group">
										<button class="btn" ng-class="{'active':selected.printtype=='OF'}" ng-click="setprinttype('OF')" ng-disabled="datas.digitaloffset==2">
											OF
										</button>
										<button class="btn" ng-class="{'active':selected.printtype=='DG'}" ng-click="setprinttype('DG')" ng-disabled="datas.digitaloffset==1">
											DG
										</button>
									</div>
								</div>
							</div>
						</div>
						<div class="panel-block margin-top-20">
							<div class="btn-group-vertical">
								<button class="btn btn-outline-secondary text-xs-left" ng-repeat="item in datas.jobsubtypetemplate" ng-click="selecttemplate(item)" data-dismiss="modal">
									<span class="name">
										[[item.fullname]]
									</span>
									<br>
									<div class="btn-break-word line-12 size-80p">
										[[item.description]]
									</div>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer" hidden>
			</div>
		</div>
	</div>
</div>