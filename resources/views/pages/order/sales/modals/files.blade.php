<div class="modal fade" id="filesModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">
					<span ng-show="onpreview">
						Preview File
					</span>
					<span ng-hide="onpreview">
						Files List
					</span>
				</h4>
			</div>
			<div class="modal-body" ng-show="onpreview">
				<img ng-src="{{URL::asset('[[previewfile]]')}}" width="100%">
			</div>
			<div class="modal-body" ng-hide="onpreview">
				<div class="alert alert-sm bg-lightmagenta text-xs-center margin-5-0" ng-show="selecteddetail!=null">
					Rincian Pekerjaan
				</div>
				<div class="size-14 alert alert-sm alert-outline-lightmagenta text-xs-center" ng-show="selecteddetail!=null">
					<div>
						Judul : 
						<span class="tx-primary">
							[[selecteddetail.cartheader.jobsubtype.name]]
						</span>
						<b>
							[[selecteddetail.cartheader.jobtitle]]
						</b> 
					</div>
					<div>
						Catatan : [[selecteddetail.cartheader.customernote]]
					</div>
					<hr class="margin-5-0">
					<div>
						Jumlah : [[(selecteddetail.cartheader.quantity)|number:0]] [[selecteddetail.cartheader.quantitytypename]]
					</div>
					<hr class="margin-5-0">
					<div>
						<b>Sub</b>Total : Rp [[(selecteddetail.cartheader.printprice+selecteddetail.cartheader.deliveryprice-selecteddetail.discount)|number:0]]
					</div>
					<div>
						Berat : [[(selecteddetail.cartheader.totalweight)|number:0]] kg
					</div>
				</div>
				<div class="alert alert-sm bg-lightmagenta text-xs-center margin-5-0">
					Rincian File dari pekerjaan di atas
				</div>
				<div class="alert alert-sm alert-outline-lightmagenta">
					<table class="table table-sm table-center margin-5-0 size-14" ng-show="files.length > 0">
						<thead>
							<tr>
								<th class="width-min">IcoN</th>
								<th>Nama</th>
								<th>Ukuran</th>
								<th>Last Mod.</th>
								<th class="width-min" colspan="2" ng-show="selecteddetail.commited==0">
									<span class="fas fa-cogs"></span>
								</th>
							</tr>
						</thead>
						<tbody ng-repeat="item in files">
							<tr ng-show="!item.ondelete&&!item.onupdate">
								<td rowspan="2">
									<img ng-src="{{URL::asset('[[item.file.icon]]')}}" height="48px" width="48px">
								</td>
								<td class="text-xs-left break-word">
									<span class="tx-primary">	
										[[$index+1]].
									</span> 
									[[singkatText(item.file.filename, 25, '.')]]
									<a class="a-success" href="" ng-click="showpreview(item.file.preview)" ng-hide="item.file.preview.length==0||item.file.preview==null">
										<i class="fas fa-search"></i>
									</a>
								</td>
								<td>
									[[item.file.size/1024/1024|number:2]]
									<i class="hidden-sm-up"><br></i>
									MB
								</td>
								<td>[[item.file.updated_at|date:'dd/MM hh:mm']]</td>
								<td class="hidden-xs-down" ng-show="selecteddetail.commited==0">
									<a href="" class="a-purple" ng-click="showupdatefile(item)">
										<span class="fas fa-edit"></span>
									</a>
								</td>
								<td ng-show="selecteddetail.commited==0">
									<a href="" class="a-purple hidden-sm-up" ng-click="showeditbox(item)"><span class="fas fa-edit"></span></a><i class="hidden-sm-up"><br></i>
									<a href="" class="a-purple" ng-click="item.ondelete=true">
										<span class="fas fa-trash"></span>
									</a>
								</td>
							</tr>
							<tr ng-show="!item.ondelete&&!item.onupdate">
								<td class="size-12 gray text-xs-left" colspan="10">
									Note : [[item.file.detail]]
								</td>
							</tr>
							<tr class="bg-info" ng-show="item.onupdate">
								<td colspan="10">
									EDIT DATA DISINI (<a href="" ng-click="item.onupdate=false" class="a-white">back</a>)
									<br>
									<i class="fas fa-exclamation-circle"></i>
									Under Construction, Hubungi 0813-1551-9889 untuk perubahan data..
									<i class="fas fa-exclamation-circle"></i>
								</td>
							</tr>
							<tr class="bg-danger" height="57px" ng-show="item.ondelete">
								<td colspan="10">
									Yakin Mau Delete? <a href="" ng-click="deletecartfile(item, $index)" class="a-white">Yes</a> <a href="" ng-click="item.ondelete=false" class="a-white">No</a>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="size-12 text-bold gray text-xs-center" ng-show="files.length > 0">
						Total : [[files.length]] file.
					</div>
					<div class="text-center margin-20-0" ng-hide="files.length > 0">
						<div>
							<span class="glyphicon glyphicon-alert red size-36"></span>
						</div>
						<div>
							Tidak ada file di system. <br>Untuk mencetak, silahkan upload file Anda.
						</div>
					</div>
				</div>
				<hr class="margin-5-0">
				<div class="text-xs-center size-14" ng-show="selecteddetail.commited==0">
						Anda ingin menambahkan file? 
						<br>
						<a href="" class="a-purple"><span class="glyphicon glyphicon-plus"></span> Upload File</a>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-purple" data-dismiss="modal" ng-hide="onpreview">Close</button>
				<button class="btn btn-danger" ng-show="onpreview" ng-click="onpreview=false">
					Back
				</button>
			</div>
		</div>
	</div>
</div>