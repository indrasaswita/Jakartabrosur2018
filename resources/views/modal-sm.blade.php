<div class="modal fade" id="{{$modalid}}" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header" ng-show="'{{$modaltitle}}'.length>0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">{{$modaltitle}}</h4>
			</div>
			<div class="modal-body" ng-show="'{{$modalbody}}'.length>0">
				{!! $modalbody !!}
			</div>
			<div class="modal-footer" ng-show="'{{$modalfooter}}'.length>0">
				{!! $modalfooter !!}
			</div>
		</div>
	</div>
</div>