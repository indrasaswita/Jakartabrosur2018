<div class="modal fade" id="uploadfileModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
		<h4 class="modal-title" id="myModalLabel">
			Upload File
		</h4>
	  </div>
		<div class="modal-body">
			<div class="form-group" ng-show="uploadwaiting==false">
				
				<form action="/" method="post" id="real-dropzonew" enctype="multipart/form-data">
					@method('patch')
					@csrf


					<input name="file" id="file" type="file">

				</form>
			</div>
			<div ng-show="uploadwaiting==true" class="text-xs-center amaranth tx-success">
				<span class="fas fa-spinner fa-pulse fa-fw fa-3x"></span><br>
				w a i t i n g . . . .
			</div>
			<div class="text-xs-center alert alert-danger" ng-show="uploaderror!=''">
				<i class="fa fa-filter"></i>[[uploaderror]]
			</div>
			<div class="subtitle margin-top-20">
				Urutan File yang sudah di Upload:
			</div>
			<div class="display-inlineblock width-100 tx-lightmagenta size-80p">
					<div class="pull-xs-left">
						<u>KIRI</u>: belum dipilih 
					</div>
					<div class="pull-xs-right">
						<u>KANAN</u>: terpilih
					</div>
			</div>
			<div class="display-flex margin-bottom-20">
				<div class="width-60 border-gray-1 padding-5">
					<table class="table table-sm">
						<thead class="bg-gray">
							<tr>
								<td class="text-xs-center" colspan="10">SUDAH DI UPLOAD</td>
							</tr>
						</thead>
						<tbody>
							<tr ng-show="loadingfiles">
								<td colspan="3" class="text-xs-center padding-20 tx-info">
									<i class="fas fa-spinner fa-pulse fa-fw fa-2x"></i>
									<br>
									w a i t i n g . . . .
								</td>
							</tr>
							<tr ng-hide="loadingfiles" ng-repeat="item in uploadedfiles">
								<td>
									<a href="" class="a-red" ng-click="removeSelectedFiles(item)">
										<span class="fas fa-trash"></span>
									</a>
								</td>
								<td class="width-min">
									<img ng-src="{{URL::asset('')}}[[item.icon]]" width="30px" height="30px">
								</td>
								<td>
									<div class="line-11" title="[[item.filename]]">
										[[singkatText(item.filename, 20, '.')]]
									</div>
									<div class="size-12">
										[[(item.size/1024)|number:1]] KB &middot; 
										<span class="tx-lightmagenta">[[item.created_at]]</span>
									</div>
								</td>
								<td class="width-min">
									<a href="" class="a-purple" ng-click="addSelectedFiles(item)">
										<span class="fas fa-link"></span>
									</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="width-40 padding-5 margin-left-5 border-purple-1 bg-softpurple">
					<table class="table table-sm">
						<thead class="bg-purple">
							<tr>
								<td class="text-xs-center" colspan="10">DIPILIH</td>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="item in selected.files">
								<td class="width-min">
									<a href="" class="a-purple" ng-click="remSelectedFiles(item)">
										<span class="fas fa-unlink"></span>
									</a>
								</td>
								<td class="width-min">
									<img ng-src="{{URL::asset('')}}[[item.icon]]" width="30px" height="30px">
								</td>
								<td>
									<div class="line-11 tx-purple">
										[[singkatText(item.filename, 15, '.')]]
									</div>
									<div class="size-12">
										[[(item.size/1024)|number:1]] KB
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="subtitle">
				Jumlah File yg Sudah diPilih: 
				<div class="subtitle-mini">
					(Note: File yang belum dipilih, dapat dipilih di job berikutnya)
				</div>
			</div>
			<div class="margin-10-0 width-100">
				<div class="border-gray-1 bg-danger text-xs-center" ng-hide="selected.files.length>0">
					Tidak ada File terpilih!
				</div> 
				<div class="border-gray-1 text-xs-center bg-success" ng-show="selected.files.length>0">
					[[selected.files.length]] File terpilih
					<span class="glyphicon glyphicon-ok tx-success pull-xs-right" style="margin: 3px 10px;"></span> 
				</div>
			</div>
			<div class="alert alert-warning size-14 line-12">
				<i class="fa fa-warning"></i> <u>Pastikan!</u><br>
				File yang Anda upload, <u>harus</u> file yang sudah fix (tanpa edit lagi).<br>
				DAN merupakan file siap cetak (CorelDRAW, Photoshop, Illustrator, Image highres >300, PDF), <span class="tx-red">bukan file EXCEL, WORD, ataupun OFFICE lainnya.</span><br><br>
				<i class="fa fa-commenting"></i> <u>Silahkan upload dalam bentuk office, untuk keterangan.</u><br>
				Tidak untuk file yang di cetak, HANYA untuk file numerator atau keterangan dan sebagainya.
				<br><br>
				<i class="fa fa-ban"></i> <u>Bagaimana bila file tidak sesuai!?</u><br>
				Tentu kami akan mengenakan biaya tambahan untuk edit, layout, ataupun setting. <b>Silahkan hubungi 0813-1551-9889</b> untuk info lebih detail.
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-purple" data-dismiss="modal">Close</button>
		</div>
	</div>
  </div>
</div>