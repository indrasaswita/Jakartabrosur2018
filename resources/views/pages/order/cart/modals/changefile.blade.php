<!-- Modal -->
<div class="modal fade" id="changeFileModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Edit File</h4>
		  </div>
			<div class="modal-body">
				<div class="row margin-0">
					<div class="col-xs-8">
						<div class="text-xs-center margin-10-0">
							<button class="btn btn-sm btn-outline-lightmagenta" ng-click="addnewfile()" ng-show="!toggleupload&&!loadingcartfiles">
								<span class="fas fa-plus size-80p"></span>
								<span class="text-bold">New</span>
							 </button>
						</div>
						<div ng-show="toggleupload&&!loadingcartfiles" class="alert alert-outline-lightmagenta">
							<div ng-show="!loadingunbindfiile&&unbindedfiles!=null">
								<table class="table table-sm table-center size-14">
									<thead>
										<tr>
											<th class="width-min">#</th>
											<th class="text-xs-left">Nama File</th>
											<th>Ukuran</th>
										</tr>
									</thead>
									<tbody>
										<tr ng-repeat="item in unbindedfiles">
											<td>
												<img ng-src="[[item.icon]]" width="30px" height="30px">
											</td>
											<td class="line-12">
												[[item.filename]]
											</td>
											<td ng-click="setFilePreview(item.file)">
												[[item.size/1024/1024|number:2]] MB
											</td>
											<td>
												<button class="btn btn-sm btn-primary" ng-click="createcartfile(item)">
													<span class="fas fa-hand-pointer"></span>
												</button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div ng-show="loadingunbindfiile" class="tx-success text-xs-center padding-10">
								<i class="fas fa-spinner fa-pulse fa-fw fa-3x"></i>
								<br>
								L O A D I N G . . . .
							</div>

							<div class="size-14 text-bold margin-5 text-xs-center">
								<span class="text-muted">--</span> 
								Upload from local drive 
								<span class="text-muted">--</span>
							</div>

							<form action="/" method="post" id="real-dropzonew" enctype="multipart/form-data">
								@method('patch')
								@csrf


								<input class="size-14" name="file" id="file" type="file">

							</form>
						</div>
						<div ng-show="loadingcartfiles" class="tx-success text-xs-center padding-10">
							<i class="fas fa-spinner fa-pulse fa-fw fa-3x"></i>
							<br>
							w a i t i n g . . . .
						</div>
						<div class="row margin-0 alert alert-warning alert-sm size-14">
							<div class="col-xs-11">
								Klik salah satu baris, untuk lihat preview.
							</div>
							<div class="col-xs-1 padding-0">
								<span class="glyphicon glyphicon-info-sign size-20 pull-xs-right"></span>
							</div>
						</div>
						<table class="table table-sm table-center size-14">
							<thead>
								<tr>
									<th class="width-min">#</th>
									<th class="text-xs-left">Nama File</th>
									<th>Ukuran</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr ng-show="loadingcartfiles">
									<td colspan="4" class="text-xs-center padding-20 tx-info">
										<i class="fas fa-spinner fa-pulse fa-fw fa-2x"></i>
										<br>
										w a i t i n g . . . .
									</td>
								</tr>
								<tr ng-repeat="item in tempcart.cartfile" ng-class="{'bg-purple':item.file.id==selectedfile.id}"class="pointer" ng-hide="loadingcartfiles">
									<td ng-click="setFilePreview(item.file)">[[$index+1]]</td>
									<td ng-click="setFilePreview(item.file)" class="text-xs-left line-11 break-word">	
										[[item.file.filename]]
										<!-- <span class="tag tag-pill size-9" ng-class="{'tag-default':item.file.path==null||item.file.path=='', 'tag-primary':item.file.path.length>0}">ORI</span> -->
										<span class="tag tag-pill size-9" ng-class="{'tag-default':item.file.preview==null||item.file.preview=='', 'tag-primary':item.file.preview.length>0}">Preview</span>
										<!-- <span class="tag tag-pill size-9" ng-class="{'tag-default':item.file.icon==null||item.file.icon=='', 'tag-primary':item.file.icon.length>0}">ICO</span> -->
									</td>
									<td ng-click="setFilePreview(item.file)">[[item.file.size/1024/1024|number:2]] MB</td>
									<td>
										<button class="btn btn-sm btn-red" ng-click="removecartfile(item)">
											<span class="fas fa-trash"></span>
										</button>
									</td>
								</tr>
								<tr ng-show="loadingcartfiles==false && tempcart.cartfile.length==0">
									<td colspan="4" class="size-120p tx-danger">
										<i class="fas fa-battery-empty fa-3x"></i>
										<br>
										There is no data exists.<br>
										Upload ur data to manage it.
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-xs-4 margin-0 padding-0">
						
						<div class="card card-outline-purple margin-20-0" ng-hide="selectedfile==null">
							<div class="card-img-top">
								<img ng-src="{{URL::asset('[[selectedfile.preview]]')}}" alt="No Preview" width="100%" ng-hide="selectedfile.preview==null||selectedfile.preview==''">
								<img src="{{URL::asset('image/404.jpg')}}" width="100%" ng-show="selectedfile.preview==null||selectedfile.preview==''">
							</div>
							<div class="card-block padding-10 line-12">
								<h6 class="cart-title">
									Detail:
								</h6>
								<div class="size-14 padding-5-0 break-word">
									<i class="fas fa-comment tx-purple"></i>
									[[selectedfile.filename]]
								</div>
								<div class="size-14 padding-5-0" ng-hide="selectedfile.detail==null||selectedfile.detail.length==0">
									<i class="fas fa-comments tx-purple"></i>
									[[selectedfile.detail]]
								</div>
								<div class="size-14 padding-5-0">
									<i class="fas fa-calendar-alt tx-purple"></i>
									[[selectedfile.created_at]]
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-purple" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>