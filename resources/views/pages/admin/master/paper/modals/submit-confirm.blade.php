
@include('modal', 
	[
		'modalid' => 'submitModal',
		'modaltitle'=> '
			Anda yakin dengan perubahan ini?
		',
		'modalbody' => '
			<div class="size-120p text-xs-right">
				<i class="fas fa-exclamation-circle tx-red size-80p"></i> 
				<small class="text-bold">Jika tidak, tekan <span class="tx-red">Cancel</span>.</small>
			</div>
		',
		'modalfooter' => '
			<div class="btn-group">
				<button type="button" class="btn btn-sm btn-purple" ng-click="submitChange()">
					Update
				</button>
				<button type="button" class="btn btn-sm btn-outline-purple" data-dismiss="modal">
					Cancel
				</button>
			</div>
		'
	]
)