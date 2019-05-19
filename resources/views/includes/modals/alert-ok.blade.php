@include('modal', 
	[
		'modalid' => 'alert-ok',
		'modaltitle'=> '',
		'modalbody' => '
			<div class="size-150p text-xs-center padding-40-20">
				<div class="text-bold">[[alertmessage.title]]</div>
				<div class="size-80p tx-gray">[[alertmessage.detail]]</div>
			</div>
		',
		'modalfooter' => '
			<a class="btn btn-secondary" ng-if="alertmessage.login" href="'.URL::asset('login').'">
				LOG-IN
			</a>
			<button class="btn btn-purple" data-dismiss="modal">
				OK
			</button>
		'
	]
)