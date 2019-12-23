<div class="order-panel tab-pane" id="file" ng-class="{'active':selectedTab=='file'}">

	<div class="panel-block" ng-show="error.message==''">
		<div class="block-subdetail">
			<div class="txt">FILE</div>
			<div class="line"></div>
		</div>

		<div class="upload-button-wrapper">
			<div class="upload-button btn-group">
				<button class="btn btn-outline-purple" ng-click="showuploadfile()" ng-disabled="error.files!=''">
					<div>
						<span class="fal fa-cloud-upload-alt fa-3x"> </span>
						<br>
						<small class="text-bold">UPLOAD</small>
					</div>
				</button>
				<div class="btn" data-toggle="tooltip" data-title="1. Upload FILE pada tombol disamping.<hr class='margin-5-0'>2. Setelah sukses, silahkan pilih FILE pada table dibawah untuk disertakan. (dapat pilih lebih dari 1 file)<hr class='margin-5-0'>3. Pastikan file sesuai dengan cetakan yang Anda pesan." data-html="true" data-placement="top">
					<div class="total-upload-wrapper" ng-class="{'empty':selected.files.length==0}">
						file terpilih:
						<div class="num">
							[[zeroFill(selected.files.length, 2)]]
						</div>
					</div>
				</div>
				<button class="btn btn-outline-purple" ng-click="showuploadurl()" ng-disabled="error.files!=''">
					<div>
						<span class="fal fa-paperclip fa-3x"> </span>
						<br>
						<small class="text-bold">INSERT URL</small>
					</div>
				</button>
			</div>
		</div>

		<div class="upload-list-wrapper empty" ng-if="uploadedfiles.length==0">
			<i class="fal fa-3x fa-fw fa-empty-set margin-bottom-10"></i>
			<br>
			YOU HAVE NO UPLOADED FILES YET
			<br>
			<small>please upload some files or save some links</small>
		</div>

		<div class="upload-list-wrapper" ng-if="uploadedfiles.length>0">
			<table class="table table-sm">
				<thead>
					<tr ng-class="{'tx-red':selected.files.length==0, 'tx-lightergray':selected.files.length>0}">
						<td></td>
						<td class="text-xs-center">
							<i class="fas fa-arrow-alt-down fa-fw"></i>
						</td>
						<td class="googleft" coslpan="3">pilih file dibawah ini</td>
					</tr>
					<tr>
						<td class="text-xs-center">#</td>
						<td class="text-xs-center">
							<i class="far fa-check fa-fw tx-purple"></i>
						</td>
						<td>File</td>
						<td class="text-xs-center">.ext</td>
						<td class="width-min">
							<i class="fal fa-check fa-fw"></i>
						</td>
						<td class="text-xs-center">
							<i class="fal fa-trash tx-red fa-fw"></i>
						</td>
					</tr>
				</thead>
				<tbody>
					<tr ng-class="{'selected':item.checked}" ng-repeat="item in uploadedfiles">
						<td class="width-min text-xs-right">
							<b>#[[zeroFill($index+1, 2)]]</b>
						</td>
						<td class="width-min text-center">
							<label class="custom-checkbox">
								<input type="checkbox" ng-model="item.checked" ng-change="checkSelectedFiles(item)" class="file-11">
								<span class="checkmark"></span>
							</label>
						</td>
						<td class="upload-list">
							<div class="title hidden-md-up">
								[[singkatText(item.filename, 20, '/')]]
							</div>
							<div class="title hidden-sm-down">
								[[singkatText(item.filename, 35, '/')]]
							</div>
							<div class="detail">
								<span ng-if="item.size!=0">
									[[ceil(item.size/1024)|number:1]] KB
								</span>
								<span ng-if="item.size==0">
									<a class="a-purple" href="[[item.filename]]">
										<i class="fas fa-external-link-square-alt fa-fw"></i> link
									</a>
								</span> 
								&middot;
								<span class="tx-lightmagenta" ng-if="item.detail.length==0">[[item.created_at]]</span>
								<span class="tx-lightmagenta hidden-sm-down" ng-if="item.detail.length>0">[[singkatText(item.detail, 55, '')]]</span>
								<span class="tx-lightmagenta hidden-md-up" ng-if="item.detail.length>0">[[singkatText(item.detail, 25, '')]]</span>
							</div>
						</td>
						<td class="text-xs-center uppercase">
							<small class="googleft text-bold" ng-show="item.size>0">
								[[item.path.substring(item.path.lastIndexOf('.')+1)]]
							</small>
							<small ng-show="item.size==0">
								<i class="fab fa-google-drive tx-lightgray"></i>
							</small>
						</td>
						<td class="tx-success width-min">
							<span ng-class="{'tx-transparent':!item.checked}">
								<i class="fal fa-check fa-fw"></i>
							</span>
						</td>
						<td class="text-xs-center">
							<button class="btn btn-sm btn-outline-red" ng-click="removeSelectedFiles(item)" ng-disabled="item.checked">
								<i class="fas fa-trash"></i>
							</button>
						</td>
					</tr>
				</tbody>
			</table>
			
		</div>

		<div class="block-text-left" ng-hide="error.files==''" hidden>
			<span class="txt">
				<span class="far fa-exclamation tx-warning"></span> 
				[[error.files]]
			</span>
		</div>
	</div>



</div>