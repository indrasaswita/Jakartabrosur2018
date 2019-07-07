<div class="shop-uploadfile-wrapper">
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
				<div class="margin-bottom-10" ng-show="!uploadsuccess">
					<button class="btn btn-outline-purple btn-selectfile" ng-click="choosefileclicked()" ng-if="!uploadwaiting">
						<i class="fal fa-file-search"></i>
						Pilih File
					</button>

					<form action="/" method="post" id="real-dropzonew" enctype="multipart/form-data" hidden>
						@method('patch')
						@csrf

						<input name="file" id="btn-choose-file" type="file"  ng-disabled="uploadwaiting" ng-if="!uploadwaiting">
					</form>

					<div class="progress" ng-if="uploadwaiting">
					  <div class="progress-bar progress-bar-striped bg-purple progress-bar-animated" role="progressbar" style="width: 100%"></div>
					</div>
				</div>

				<div class="text-xs-center alert alert-danger size-100p" ng-show="uploaderror==''&&error.files!=''">
					<i class="fas fa-exclamation-circle"></i> [[error.files]]
				</div>
				
				<div class="upload-errorupload" ng-if="error.upload!=''">
					<div ng-if="error.upload!=''">
						[[error.upload]]
					</div>
				</div>
<!-- 
				<i ng-class="{'tx-red':!uploadsuccess, 'tx-success':uploadsuccess}" class="fas fa-circle fa-fw"></i> STATUS -->

				<div class="upload-lastfile" ng-show="uploadsuccess&&filesize!=null">
					<div class="">
						You have upload this file successfuly,
					</div>
					<br>
					<div class="image">
						<img src="{{URL::asset('image/smallicons/pdf.png')}}" ng-if="fileis()=='pdf'" hidden>
						<img ng-src="{{URL::asset('')}}/[[uploadedfiles[uploadedfiles.length-1].icon]]">
						<br>
						[[(uploadedfiles[uploadedfiles.length-1].path.substring(uploadedfiles[uploadedfiles.length-1].path.lastIndexOf('.')+1))]] file.
					</div>
					<hr>
					<div class="text-xs-left">
						<div ng-if="filesize<1024">
							<i class="fal fa-check fa-fw tx-success"></i>
							[[filesize|number:0]] byte uploaded.
						</div>
						<div ng-if="filesize>=1024&&filesize<(1024*1024)">
							<i class="fal fa-check fa-fw tx-success"></i>
							[[(filesize/1024)|number:1]] KB uploaded.
						</div>
						<div ng-if="filesize>=(1024*1024)">
							<i class="fal fa-check fa-fw tx-success"></i>
							[[(filesize/1024/1024)|number:2]] MB uploaded.
						</div>
						<div class="">
							Name of file: <u class="tx-primary">[[uploadedfiles[uploadedfiles.length-1].filename]]</u>
							<br>
							Belongs to <b>[[uploadedfiles[uploadedfiles.length-1].customer.name]]</b>
							<span ng-if="uploadedfiles[uploadedfiles.length-1].customer.company.id!=1">
								from <span class="tx-primary">
								[[uploadedfiles[uploadedfiles.length-1].customer.company.name]]</span>
							</span>
						</div>
					</div>
					<hr>
					<div class="input-desc">
						Tell us about your file / image above:
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
						<i class="fab fa-adobe fa-fw"></i>
						<b><i>What do and don't?</i></b>
					</div>
					<ul>
						<li>
							<div class="list-wrapper">
								<div class="img">
									<i class="far fa-photo-video fa-2x fa-fw tx-warning"></i>
								</div>
								<div class="list-detail">
									<div class="title">
										Maximum Filesize / Ukuran Gambar Maksimum
									</div>
									<ul>
										<li>
											<div class="svg">
												<i class="far fa-check tx-success fa-fw"></i>
											</div>
											<div class="text">
												Upload file direct, harus dibawah dari <span class="tx-purple"><b class="size-110p">[[(uploadmaxfilesize/1024/1024)|number:0]]</b>MB</span>
											</div>
										</li>
										<li>
											<div class="svg">
												<i class="far fa-paperclip tx-primary fa-fw"></i>
											</div>
											<div class="text">
												File lebih besar dari <span class="tx-purple"><b class="size-110p">[[(uploadmaxfilesize/1024/1024)|number:0]]</b>MB</span>, silahkan sertakan dengan link Google Drive / OneDrive
											</div>
										</li>
									</ul>
								</div>
							</div>
						</li>
						<li>
							<div class="list-wrapper">
								<div class="img">
									<i class="far fa-camera-retro fa-2x fa-fw tx-warning"></i>
								</div>
								<div class="list-detail">
									<div class="title">
										Ketentuan File Gambar / Image
									</div>
									<ul>
										<li>
											<div class="svg">
												<i class="far fa-check tx-success fa-fw"></i>
											</div>
											<div class="text">
												File yang diizinkan: .<b>JPG</b>, .<b>JPEG</b>, .<b>TIFF</b>.
											</div>
										</li>
										<li>
											<div class="svg">
												<i class="far fa-paperclip tx-primary fa-fw"></i>
											</div>
											<div class="text">
												Harus dengan komposisi C-M-Y-K, minimal 300dpi (upload dengan ukuran asli).
											</div>
										</li>
										<li>
											<div class="svg">
												<i class="far fa-times tx-red fa-fw"></i>
											</div>
											<div class="text">
												File tidak boleh: .<b>PNG</b>, .<b>GIF</b>, .<b>BMP</b>.
											</div>
										</li>
									</ul>
								</div>
							</div>
						</li>
						<li>
							<div class="list-wrapper">
								<img src="{{URL::asset('image/smallicons/pdf.png')}}">
								<div class="list-detail">
									<div class="title">
										File PDF
									</div>
									<ul>
										<li>
											<div class="svg">
												<i class="far fa-check tx-success fa-fw"></i>
											</div>
											<div class="text">
												Dibuat dari file vector. (Adobe Illustrator / Indesign / Coreldraw / AutoCAD)
											</div>
										</li>
										<li>
											<div class="svg">
												<i class="far fa-check tx-success fa-fw"></i>
											</div>
											<div class="text">
												Berisi file gambar <i class="text-bold">highres</i>. (min. 300dpi)
											</div>
										</li>
										<li>
											<div class="svg">
												<i class="far fa-times tx-red fa-fw"></i>
											</div>
											<div class="text">
												File resolusi rendah, mempengaruhi hasil yang buruk.
											</div>
										</li>
									</ul>
								</div>
							</div>
						</li>
						<li>
							<div class="list-wrapper">
								<img src="{{URL::asset('image/smallicons/word.png')}}">
								<div class="list-detail">
									<div class="title">
										File Microsoft Word / Word Document
									</div>
									<ul>
										<li>
											<div class="svg">
												<i class="far fa-check tx-success fa-fw"></i>
											</div>
											<div class="text">
												Hanya disertakan untuk keterangan cetak.
											</div>
										</li>
										<li>
											<div class="svg">
												<i class="far fa-times tx-red fa-fw"></i>
											</div>
											<div class="text">
												Kami tidak menerima file design hasil ketikan pada aplikasi Microsoft Word atau semacamnya.
											</div>
										</li>
									</ul>
								</div>
							</div>
						</li>
						<li>
							<div class="list-wrapper">
								<img src="{{URL::asset('image/smallicons/excel.png')}}">
								<div class="list-detail">
									<div class="title">
										File Microsoft Excel / Spreadsheet Document
									</div>
									<ul>
										<li>
											<div class="svg">
												<i class="far fa-check tx-success fa-fw"></i>
											</div>
											<div class="text">
												Hanya disertakan untuk keperluan nomor urut atau nomor seri yang akan disertakan pada design Coreldraw.
											</div>
										</li>
										<li>
											<div class="svg">
												<i class="far fa-times tx-red fa-fw"></i>
											</div>
											<div class="text">
												Kami tidak menerima file design hasil ketikan pada aplikasi Microsoft Excel atau semacamnya.
											</div>
										</li>
									</ul>
								</div>
							</div>
						</li>
						<li>
							<div class="list-wrapper">
								<img src="{{URL::asset('image/smallicons/ppt.png')}}">
								<div class="list-detail">
									<div class="title">
										File Power Point
									</div>
									<ul>
										<li>
											<div class="svg">
												<i class="far fa-check tx-success fa-fw"></i>
											</div>
											<div class="text">
												Hanya untuk print A4 <b>EPSON</b> dengan layout slide. (untuk presentasi)
											</div>
										</li>
										<li>
											<div class="svg">
												<i class="far fa-times tx-red fa-fw"></i>
											</div>
											<div class="text">
												Kami tidak menerima file Power Point untuk diprint sebagai file design
											</div>
										</li>
									</ul>
								</div>
							</div>
						</li>
						<li>
							<div class="list-wrapper">
								<img src="{{URL::asset('image/smallicons/file-cdr.png')}}">
								<div class="list-detail">
									<div class="title">
										File Coreldraw
									</div>
									<ul>
										<li>
											<div class="svg">
												<i class="far fa-check tx-success fa-fw"></i>
											</div>
											<div class="text">
												Terima semua bentuk.
											</div>
										</li>
										<li>
											<div class="svg">
												<i class="far fa-check tx-success fa-fw"></i>
											</div>
											<div class="text">
												Terima dengan maximum versi <b>Corel 2018</b>
											</div>
										</li>
										<li>
											<div class="svg">
												<i class="far fa-text tx-purple fa-fw"></i>
											</div>
											<div class="text">
												Jangan lupa convert font / sertakan font pendukung
											</div>
										</li>
									</ul>
								</div>
							</div>
						</li>
						<li>
							<div class="list-wrapper">
								<img src="{{URL::asset('image/smallicons/ai.png')}}">
								<div class="list-detail">
									<div class="title">
										File Adobe Illustrator
									</div>
									<ul>
										<li>
											<div class="svg">
												<i class="far fa-check tx-success fa-fw"></i>
											</div>
											<div class="text">
												Terima semua bentuk.
											</div>
										</li>
										<li>
											<div class="svg">
												<i class="far fa-text tx-purple fa-fw"></i>
											</div>
											<div class="text">
												Jangan lupa convert font / sertakan font pendukung.
											</div>
										</li>
										<li>
											<div class="svg">
												<i class="far fa-file-image tx-primary fa-fw"></i>
											</div>
											<div class="text">
												Jangan lupa sertakan link image.
											</div>
										</li>
									</ul>
								</div>
							</div>
						</li>
						<li>
							<div class="list-wrapper">
								<img src="{{URL::asset('image/smallicons/photoshop.jpg')}}">
								<div class="list-detail">
									<div class="title">
										File Adobe Photoshop
									</div>
									<ul>
										<li>
											<div class="svg">
												<i class="far fa-check tx-success fa-fw"></i>
											</div>
											<div class="text">
												Terima semua bentuk.
											</div>
										</li>
										<li>
											<div class="svg">
												<i class="far fa-text tx-purple fa-fw"></i>
											</div>
											<div class="text">
												Jangan lupa convert font / sertakan font pendukung.
											</div>
										</li>
									</ul>
								</div>
							</div>
						</li>
						<li>
							<div class="list-wrapper">
								<img src="{{URL::asset('image/smallicons/indesign.png')}}">
								<div class="list-detail">
									<div class="title">
										File Adobe Indesign
									</div>
									<ul>
										<li>
											<div class="svg">
												<i class="far fa-times tx-red fa-fw"></i>
											</div>
											<div class="text">
												Silahkan convert ke PDF jadi file siap cetak.
											</div>
										</li>
									</ul>
								</div>
							</div>
						</li>
						<li>
							<div class="list-wrapper">
								<div class="img">
									<i class="far fa-2x fa-fw fa-envelope-open-text tx-warning">
									</i>
								</div>
								<div class="list-detail">
									<div class="title">
										File Text (.txt)
									</div>
									<ul>
										<li>
											<div class="svg">
												<i class="far fa-check tx-success fa-fw"></i>
											</div>
											<div class="text">
												Silahkan tulis keterangan lanjut pada file text.
											</div>
										</li>
									</ul>
								</div>
							</div>
						</li>
						<li>
							<div class="list-wrapper">
								<div class="img">
									<i class="far fa-2x fa-fw fa-palette tx-warning">
									</i>
								</div>
								<div class="list-detail">
									<div class="title">
										Terima Design
									</div>
									<ul>
										<li>
											<div class="svg">
												<i class="far fa-check tx-success fa-fw"></i>
											</div>
											<div class="text">
												Terima design untuk customer yang datang ke Workshop kami.
											</div>
										</li>
										<li>
											<div class="svg">
												<i class="far fa-check tx-success fa-fw"></i>
											</div>
											<div class="text">
												Setelah bayar, File jadi milik Anda.
											</div>
										</li>
										<li>
											<div class="svg">
												<i class="far fa-check tx-success fa-fw"></i>
											</div>
											<div class="text">
												Harga design, setting, ketik, dan trace = Rp 50rb per &#xbd;jam.
											</div>
										</li>
									</ul>
								</div>
							</div>
						</li>
					</ul>
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