<div class="modal fade" id="{{$modalid}}" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">{{$modaltitle}}</h4>
			</div>
			<div class="modal-body">
				{!! $modalbody !!}
			</div>
			<div class="modal-footer">
				{!! $modalfooter !!}
			</div>
		</div>
	</div>
</div>