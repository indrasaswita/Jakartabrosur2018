<!-- Modal -->
<div class="modal fade" id="cartRejectModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Tolak File, karena ...</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<button type="button" class="btn btn-outline-purple margin-10" ng-repeat="item in rejectbtns" ng-click="employeenote=item.message">[[item.label]]</button>
				<br>
				<input type="text" ng-model="employeenote" />
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-purple" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>