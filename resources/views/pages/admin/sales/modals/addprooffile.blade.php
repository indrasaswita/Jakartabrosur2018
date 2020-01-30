<div ng-controller="AdmSalesaddprooffileController">
	<div class="modal fade" id="addprooffileModal" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">
							Tambah File Proof
						</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table class="table table-sm table-custom-allsales">
							<tbody ng-repeat="item3 in selectedsalesdetail.cartheader.cartpreview" class="text-v-center">
								<tr>
									<td class="width-min" rowspan="3">
										<div class="break-word">
											<img ng-src="{{URL::asset('')}}image/ext/[[item3.file.path.substring(item3.file.path.lastIndexOf('.')+1)]].png" alt="No Preview" height="70px" width="70px" class="img-rounded margin-5">
											<br>
											<!-- <a class="a-purple" href="" ng-click="uploadpreviewClick(item3.file.id)">
												<span class="fas fa-cloud-upload"></span> Upload
											</a> -->
										</div>
									</td>
									<td class="text-xs-left break-word">
										<span>
											<b class="tx-gray">
												#CP[[item3.id]].
											</b>
											[[item3.file.filename]] ([[(item3.file.size/1024)|number:1]]KB)
										</span>
										<span class="tx-success" ng-if="item3.commit==1">
											<i class="fas fa-check-circle"></i> Commited
										</span>
										<span class="tx-danger" ng-if="item3.commit!=1">
											<i class="fas fa-ban"></i> No Commit
										</span>
									</td>
								</tr>
								<tr>
									<td class="text-xs-left break-word">
										File Asli : 
										<a href="{{URL::asset('')}}[[item3.file.path]]" target="_blank" class="a-purple"> <i class="fas fa-location-arrow tx-purple"></i> Link</a> 
										<a class="a-purple" ng-href="{{URL::asset('cartheaders/cartfiles/download')}}/[[item3.file.id]]">
											<span class="fas fa-cloud-download-alt tx-purple"></span> Download
										</a>
									</td>
								</tr>
								<tr>
									<td class="text-xs-left break-word">
										Icon : 
										<a href="{{URL::asset('')}}[[item3.file.path]]" target="_blank" class="a-purple"> <i class="fas fa-location-arrow tx-purple"></i> Link</a> 
										<a class="a-purple" href="">
											<span class="fas fa-cloud-upload-alt tx-purple"></span> Upload
										</a>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="alert alert-warning text-xs-center">
							<div class="tx-danger line-11 margin-5-0 size-110p" ng-if="uploaderror!=''">
								[[uploaderror]]
							</div>
							<button class="btn btn-outline-primary" ng-click="uploadpreviewClick(selectedsalesdetail.cartheader.id)" ng-if="!uploadwaiting">
								Tambah Gambar Proof
							</button>
							<div class="margin-5-0" ng-if="uploadwaiting">
								Processing...
							</div>
							<div class="tx-gray margin-5-0">
								File yg diperbolehkan: <b>JPEG (.jpg/.jpeg), TIFF (.tiff)</b>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>