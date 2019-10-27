
<div class="sales-modal-cartpreview" ng-controller="SalesShowpreviewController">
	<div class="modal fade" id="viewcartpreview-modal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">
						Lihat hasil preview sebaik-baiknya
					</h4>
				</div>
				<div class="modal-body">
					<div class="preview">
						<img class="width-100" id="previewfile" ng-src="{{URL::asset('')}}[[selectedFile.path]]"  onContextMenu="return false;" />
						<!-- 
							TODO: 
							disable right click (oncontextmenu returnfalse) 
						-->
					</div>

					<div class="view">
						<a href="{{URL::asset('')}}[[selectedFile.path]]" class="btn btn-sm btn-outline-purple" target="_blank">
							<small class="fas fa-external-link-alt fa-fw"></small>
							Open in New Tab
						</a>
						<a href="{{URL::asset('')}}AJAX/file/preview/[[selectedFile.id]]/download" class="btn btn-sm btn-outline-purple">
							Download
						</a>
					</div>

					<div class="data">
						<div class="comment">
							<div class="input-group">
							  <input class="form-control" ng-model="selectedCartpreview.comment" type="text" placeholder="Komen & keterangan cetak disini">
							  <div class="input-group-btn" ng-if="!selectedCartpreview.commit">
								<button class="btn btn-outline-secondary" type="button">Save</button>
							  </div>
							</div>
							<div class="text">
								<i class="fal fa-info-circle fa-fw"></i>
								Kami dapat melihat komplain atau masukan Anda atas preview diatas.
							</div>
						</div>
						<div class="commit" ng-if="selectedCartpreview.commit">
							<i class="fas fa-check fa-fw"></i>
							COMMITED.
							<br><br>
							Kami akan kerjakan sesuai gambar diatas.
							<br>
							Bila ada perubahan mendadak, silahkan laporkan kepada Customer Service kami.
						</div>
						<div class="commit" ng-if="!selectedCartpreview.commit">
							Jika gambar diatas sudah OK dan tidak ada perubahan,<br>Anda dapat menekan tombol dibawah ini.
							<div class="button">
								<button class="btn btn-sm btn-outline-primary" ng-click="commitpreview()">
									Menurut saya sudah benar.
								</button>
							</div>
							<span class="warning">
								<i class="far fa-exclamation-triangle fa-fw"></i> Jangan tekan OK, jika belum benar.
							</span>
						</div>
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