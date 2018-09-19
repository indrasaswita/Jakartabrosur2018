<div class="order-description">
	<div class="description-panel" ng-show="datas.icon!=''">
		<div class="panel-block">
			<img ng-src="{{URL::asset('image/jobsubtypeicons/[[datas.icon]]')}}" width="100%">
		</div>
	</div>

	<div class="description-panel" ng-show="datas.jobsubtypetemplate.length>0">
		<div class="panel-subheader">
			<div class="txt">
				Easy Access
			</div>
			<div class="line"></div>
		</div>
		<div class="panel-block">
			<div class="block-list">
				<div class="input">
					<div class="btn-group">
						<button class="btn" ng-class="{'active':selected.printtype=='OF'}" ng-click="setprinttype('OF')" ng-disabled="datas.digitaloffset==2">
							OF
						</button>
						<button class="btn" ng-class="{'active':selected.printtype=='DG'}" ng-click="setprinttype('DG')" ng-disabled="datas.digitaloffset==1">
							DG
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-block margin-top-20">
			<div class="btn-group-vertical">
				<button class="btn btn-outline-secondary" ng-repeat="item in datas.jobsubtypetemplate" ng-click="selecttemplate(item)" data-title="<b>[[item.fullname]]</b><br>[[item.description]]" data-toggle="tooltip" data-placement="right" data-html="true" tooltip>
					<span class="name">
						[[item.name]]
					</span>
					<span class="info pull-xs-right">
						<i class="fas fa-exclamation-circle"></i>
					</span>
				</button>
			</div>
		</div>
	</div>


	<div class="description-panel" hidden>
		<div class="panel-subheader">
			<div class="txt">
				MENERIMA FILE
			</div>
			<div class="line"></div>
		</div>
		<div class="panel-3">
			<img src="{{URL::asset('image/smallicons/file-ai.png')}}" class="icon" data-toggle="tooltip" data-title="Adobe Illustrator File" data-placement="bottom">
			<img src="{{URL::asset('image/smallicons/file-id.png')}}" class="icon" data-toggle="tooltip" data-title="Adobe Indesign File" data-placement="bottom">
			<img src="{{URL::asset('image/smallicons/file-pdf.png')}}" class="icon" data-toggle="tooltip" data-title="Adobe PDF File" data-placement="bottom">
			<img src="{{URL::asset('image/smallicons/file-cdr.png')}}" class="icon" data-toggle="tooltip" data-title="CorelDRAW<br>(up to X8 version)" data-html="true" data-placement="bottom">
			<img src="{{URL::asset('image/smallicons/file-tiff.png')}}" class="icon" data-toggle="tooltip" data-title="Image File (.TIFF)" data-placement="bottom">
		</div>
	</div>
	<div class="description-panel" hidden>
		<div class="panel-subheader">
			<div class="txt">
				BANK TRANSFER
			</div>
			<div class="line"></div>
		</div>
		<div class="panel-2-spacing">
			<img src="{{URL::asset('image/MANDIRI.png')}}" class="icon">
			<img src="{{URL::asset('image/BCA.png')}}" class="icon">
			<img src="{{URL::asset('image/BNI.png')}}" class="icon">
			<img src="{{URL::asset('image/BRI.png')}}" class="icon">
		</div>
	</div>
	<div class="description-panel">
		<div class="panel-subheader">
			<div class="txt">
				KETENTUAN FILE:
			</div>
			<div class="line"></div>
		</div>
		<div class="panel-list">
			<ul>
				<li>Ukuran gambar diberi lebihan 2mm setiap sisi.</li>
				<li>File tidak dengan komposisi RGB.</li>
				<li>File <i>vector</i> dengan text, harus di <i>convert</i> terlebih dahulu.</li>
			</ul>
		</div>

		<div class="divider" hidden></div>

		<div class="link" hidden>
			<a href="">Info selanjutnya disini!</a>
		</div>
	</div>
</div>