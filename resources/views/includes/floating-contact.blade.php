
<div ng-controller="FloatingcontactController">
	<div class="rightcontact" ng-mouseover="hoverfloatingcontact()" ng-mouseleave="leavefloatingcontact()">
		<a href="" id="floating-link" class="hide" ng-click="openfloatingcontact()">
			<span class="fas fa-comments-alt fa-fw"></span>
			Pusat Bantuan
		</a>
	</div>

	<div class="modal fade black" id="floating-panel" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header" hidden>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					
					<span class="">
						<i class="fal fa-comments-alt fa-fw"></i>
						Pertanyaan yang sering diajukan
					</span>
				</div>
				<div class="modal-body">
					<div class="text-xs-center margin-40-0">
						<i class="fab fa-whatsapp fa-fw fa-8x"></i><br>
						Untuk sementara, silahkan hubungi <a href="https://api.whatsapp.com/send?phone=6281315519889" class="a-white" target="_blank"><b>0813 1551 9889</b></a>.<br>Karena fitur ini sedang dikembangkan.
					</div>

					<ul hidden>
						<li>
							<div>Yang biasa ditanyakan...</div>
						</li>
						<li ng-repeat="item in faquestions">
							<a href="">
								<div>[[item]]</div>
							</a>
						</li>
					</ul>
				</div>
				<div class="modal-footer">
					<button class="btn btn-sm btn-danger" data-dismiss="modal">
						Close
					</button>
				</div>
			</div>
		</div>
	</div>
</div>