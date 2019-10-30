
<div class="sales-modal-cartfile" ng-controller="SalesChangefileController">
	<div class="modal fade" id="changeFileModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">
						Update File (sebelom commit)
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

					<div class="action-btn" ng-if="!ondeleteprocess">
						<button class="btn btn-sm btn-outline-purple" ng-click="choosefileclicked()" ng-if="!selectedSalesdetail.commited">
							<span ng-if="!savechangeloading">
								upload revisi
							</span>
							<span ng-if="savechangeloading">
								<i class="fas fa-spinner fa-pulse fa-fw"></i>
								Loading...
							</span>
						</button>
						
						<button class="btn btn-sm btn-outline-purple" ng-click="savechangefile()" ng-if="!selectedSalesdetail.commited">
							<span ng-if="!savechangeloading">
								save detail
							</span>
							<span ng-if="savechangeloading">
								<i class="fas fa-spinner fa-pulse fa-fw"></i>
								Loading...
							</span>
						</button>
						<a href="{{URL::asset('')}}AJAX/file/[[selectedFile.id]]/download" class="btn btn-sm btn-outline-primary"">
							<span ng-if="!savechangeloading">
								download
							</span>
							<span ng-if="savechangeloading">
								<i class="fas fa-spinner fa-pulse fa-fw"></i>
								Loading...
							</span>
						</a>

						<button class="btn btn-sm btn-danger" ng-click="setdelete()" ng-if="!selectedSalesdetail.commited">
							<span ng-if="!savechangeloading">
								delete file
							</span>
							<span ng-if="savechangeloading">
								<i class="fas fa-spinner fa-pulse fa-fw"></i>
								Loading...
							</span>
						</button>
					</div>
					<div ng-if="ondeleteprocess" class="text-xs-center line-12">
						Yakin mau delete?<br>
						Tidak bisa di UNDO..<br>
						<small>(setelah delete, file bisa di pilih lagi untuk pemesanan lainnya.)</small><br><br>
						<button class="btn btn-sm btn-danger" ng-click="removecartfile()" ng-if="!selectedSalesdetail.commited">
							<span ng-if="!savechangeloading">
								delete file
							</span>
							<span ng-if="savechangeloading">
								<i class="fas fa-spinner fa-pulse fa-fw"></i>
								Loading...
							</span>
						</button>
						<button class="btn btn-sm btn-secondary" ng-click="unsetdelete()" ng-if="!selectedSalesdetail.commited">
							<span ng-if="!savechangeloading">
								cancel
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
				<div class="modal-footer" hidden>
					
				</div>
			</div>
		</div>
	</div>
</div>