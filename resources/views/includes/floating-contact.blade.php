
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
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					
					<span class="">
						<i class="fal fa-comments-alt fa-fw"></i>
						Pertanyaan yang sering diajukan
					</span>
				</div>
				<div class="modal-body">
					<ul>
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