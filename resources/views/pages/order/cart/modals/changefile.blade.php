<!-- Modal -->
<div class="cart-modal-changefile" ng-controller="CartChangefileController">
	<div class="modal fade" id="changeFileModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">
						Edit File
					</h4>
				</div>
				<div class="modal-body">
					<div class="header">
						<div class="file-title">
							<i class="fal fa-file-archive"></i>
							[[selectedFile.filename]]
						</div>
						<br>
						<div class="cart-title">
							[[selectedCart.quantity|number:0]]
							[[selectedCart.quantitytypename]], 
							[[selectedCart.jobsubtype.name]]
							[[selectedCart.jobtitle]]
						</div>
					</div>

					<div class="content">
						<div class="">
							<i class="fas fa-compact-disc fa-fw"></i>
							[[(selectedFile.size/1024)|number:3]] KB
						</div>
						<div class="">
							<i class="fas fa-fire fa-fw"></i>
							<span ng-if="selectedFile.revision>1">
								revisi ke-[[(selectedFile.revision-1)|number:0]]
							</span>
							<span ng-if="selectedFile.revision==1">
								tidak ada revisi.
							</span>
						</div>
						<div class="">
							<i class="fas fa-pencil fa-fw"></i>
							<input type="text" ng-model="selectedFile.detail" placeholder="masukkan deskripsi file">
						</div>
						<div class="">
							<i class="fas fa-user-astronaut fa-fw"></i>
							uploaded by
							[[selectedFile.customer.name]]
						</div>
						<div class="">
							<i class="fas fa-history fa-fw"></i>
							uploaded on 
							[[selectedFile.created_at|date:'d MMM yy. (HH:mm)']]
						</div>
						<div class="" ng-if="selectedFile.updated_at!=null">
							<span ng-if="selectedFile.updated_at!=selectedFile.created_at">
								<i class="fas fa-pencil fa-fw"></i>last updated on 
								[[selectedFile.updated_at|date:'d MMM yy. (HH:mm)']]
							</span>
						</div>
					</div>

					<div class="progress" ng-if="uploadwaiting">
					  <div class="progress-bar progress-bar-striped bg-purple progress-bar-animated" role="progressbar" style="width: 100%"></div>
					</div>

					<div class="action-btn">
						<button class="btn btn-sm btn-outline-purple" ng-click="choosefileclicked()">
							<span ng-if="!savechangeloading">
								upload revisi
							</span>
							<span ng-if="savechangeloading">
								<i class="fas fa-spinner fa-pulse fa-fw"></i>
								Loading...
							</span>
						</button>
						
						<button class="btn btn-sm btn-outline-purple" ng-click="savechangefile()">
							<span ng-if="!savechangeloading">
								save detail
							</span>
							<span ng-if="savechangeloading">
								<i class="fas fa-spinner fa-pulse fa-fw"></i>
								Loading...
							</span>
						</button>
						<button class="btn btn-sm btn-danger" ng-click="removecartfile()">
							<span ng-if="!savechangeloading">
								delete file
							</span>
							<span ng-if="savechangeloading">
								<i class="fas fa-spinner fa-pulse fa-fw"></i>
								Loading...
							</span>
						</button>
					</div>

					<div class="error" ng-if="errormessage.length>0">
						<div class="message">
							[[errormessage]]
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-sm btn-success" ng-click="saveandclose()">
						<span ng-if="!savechangeloading">
							Save and Close
						</span>
						<span ng-if="savechangeloading">
							<i class="fas fa-spinner fa-pulse fa-fw"></i>
							Loading...
						</span>
					</button>
					<button class="btn btn-sm btn-outline-purple" data-dismiss="modal">
						Close
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
