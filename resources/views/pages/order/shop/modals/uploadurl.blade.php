<div class="shop-uploadurl-wrapper">
	<div class="modal fade" id="uploadurlModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">
						Upload via URL
					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="shop-uploadurl">
						<div class="urlandlink" ng-show="!uploadsuccess">
							<input type="text" placeholder="http://drive.google.com/link-to-file..." ng-model="uploadinputurl" ng-class="{'urlfalse':!checkuploadurl()}">
							<button class="submit" ng-click="saveuploadurl()">
								<i class="far fa-external-link-alt"></i>
								Save
							</button>
						</div>
						<div class="upload-errorupload" ng-if="error.upload!=''">
							<div ng-if="error.upload!=''">
								[[error.upload]]
							</div>
						</div>

						<div class="upload-lastfile" ng-show="uploadsuccess">
							<div class="">
								You have save your link successfuly, let's take a look and make a description for your uploaded link.
							</div>
							<div class="full-link">
								<div class="icon">
									<i class="fas fa-link fa-fw fa-2x"></i> 
								</div>
								<div class="link">
									[[uploadedfiles[uploadedfiles.length-1].filename]]
								</div>
							</div>
							<div class="input-desc">
								Tell us about your file above:
								<span class="pull-xs-right" ng-if="newfiledetail!=null">
									[[zeroFill(newfiledetail.length,3)]]
								</span>
								<div class="input">
									<input class="form-control" type="text" ng-model="newfiledetail" placeholder="deskripsi file diatas (max. 500 chars)">
								</div>
							</div>
							<div class="input-submit">
								<button class="btn btn-outline-success" ng-click="savefiledetail(uploadedfiles[uploadedfiles.length-1].id)" ng-disabled="newfiledetail.length<3">
									Save Description
								</button>
							</div>
						</div>

						<div class="upload-warninginfo" ng-show="!uploadsuccess">
							<div class="padding-10-0 tx-warning">
								<i class="fas fa-link fa-fw"></i>
								<b><i>What do and don't?</i></b>
							</div>
							<ul>
								<li>
									<div class="list-wrapper">
										<img src="{{URL::asset('image/smallicons/googledrive.png')}}">
										<div class="list-detail">
											<div class="title">
												Shared File / Folder 
											</div>
											<ul>
												<li>
													<div class="svg">
														<i class="far fa-check tx-success fa-fw"></i>
													</div>
													<div class="text">
														Pastikan kualitas file siap cetak.
													</div>
												</li>
												<li>
													<div class="svg">
														<i class="far fa-check tx-success fa-fw"></i>
													</div>
													<div class="text">
														Pastikan akses dibuka secara public atau share ke <b class="tx-purple">rahayuprinting113@gmail.com</b>.
													</div>
												</li>
												<li>
													<div class="svg">
														<i class="far fa-check tx-success fa-fw"></i>
													</div>
													<div class="text">
														Beri keterangan lengkap bila ada.
													</div>
												</li>
												<li>
													<div class="svg">
														<i class="far fa-check tx-success fa-fw"></i>
													</div>
													<div class="text">
														<i class="fab fa-google-drive fa-fw tx-lightgray"></i>
														Google Drive, One Drive, Dropbox, atau online storage (public) lainnya diperbolehkan.
													</div>
												</li>
												<li>
													<div class="svg">
														<i class="far fa-check tx-success fa-fw"></i>
													</div>
													<div class="text">
														Pastikan web dapat diakses secara public tanpa proxy / provider internet khusus, dan berikan izin publik.
													</div>
												</li>
											</ul>
										</div>
									</div>
								</li>
							</ul>
						</div>
						<!-- <div class="">
							<iframe id="iframeshowurl" width="100%" height="315" frameborder="0" ng-src="[[uploadinputurl2]]"></iframe>
						</div> -->
					</div>
				</div>
				<div class="modal-footer text-center" ng-if="uploadsuccess">
					<button type="button" class="btn btn-secondary" ng-click="renewuploadmodal()">
						<i class='far fa-repeat fa-fw'></i>
						Again
					</button>
					<button type="button" class="btn btn-purple" data-dismiss="modal">Done</button>
				</div>
				<div class="modal-footer" ng-if="!uploadsuccess">
					<button type="button" class="btn btn-purple" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>