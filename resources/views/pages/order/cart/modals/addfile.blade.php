<div class="cart-modal-addfile" ng-controller="CartAddfileController">
	<div class="modal fade" id="addFileModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">
						Add File [[selectedCart.jobtitle]]
					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
	
					<div ng-if="loadingunbindfiles">
						<i class="fas fa-spin fa-pulse fa-fw"></i>
						Loading Uploaded Data..
					</div>
					<div ng-if="!loadingunbindfiles">
						<!-- ISI DATANYA -->
						<div class="unbindfile-wrapper" ng-if="unbindedfiles.length>0">
							Your files
							<div class="unbind-list" ng-repeat="file in unbindedfiles" ng-click="createcartfile(file)">
								<div class="img">
									<img ng-src="{{URL::asset('')}}image/ext/[[file.path.substring(file.path.lastIndexOf('.')+1)]].png" width="43px">
								</div>
								<div class="text">
									<div>
										[[file.filename]]
										<br>
										<span class="text-detail">
											by [[file.customer.name]] 
											<i class="fas fa-history fa-fw"></i>
											<span ng-if="file.revision==1">
												[[file.created_at]]
											</span>
											<span ng-if="file.revision>1">
												[[file.updated_at]]
											</span>
										</span>
									</div>
									<div class="tag tag-primary tag-sm" ng-if="file.revision>1">
										REVISED
									</div>
								</div>
								<div class="size">
									<span ng-if="file.size<=1024">
										small size
									</span>
									<span ng-if="file.size>1024 && file.size<=1024*1024/2">
										[[(file.size/1024)|number:1]]<br><small>KB</small>
									</span>
									<span ng-if="file.size>1024*1024/2 && file.size<=1024*1024*1024/2">
										[[(file.size/1024/1024)|number:1]]<br><small>MB</small>
									</span>
									<span ng-if="file.size>1024*1024*1024/2 && file.size<=1024*1024*1024*1024/2">
										[[(file.size/1024/1024/1024)|number:1]]<br><small>GB</small>
									</span>
								</div>
							</div>
						</div>

						<div class="progress" ng-if="uploadwaiting">
						  <div class="progress-bar progress-bar-striped bg-purple progress-bar-animated" role="progressbar" style="width: 100%"></div>
						</div>

						<div class="action-btn">
							<button class="btn btn-sm btn-outline-purple" ng-click="choosefileclicked()">
								<i class="fal fa-upload fa-fw"></i>
								Upload New File
							</button>
						</div>

						<div class="error" ng-if="errormessage.length>0">
							[[errormessage]]
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-sm btn-outline-purple" data-dismiss="modal">
						Close
					</button>
				</div>
			</div>
		</div>
	</div>
</div>