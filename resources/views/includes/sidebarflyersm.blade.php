<div class="panel-summary-sm-wrapper">
	<div class="panel-summary-sm">
		<div class="panel-summary-btn">
			<button class="btn disabled" disabled>
				<span class="glyphicon glyphicon-chevron-left"></span>
			</button>
		</div>
		<div class="panel-summary-block">
			<div class="panel-summary-block-title">Per-pcs</div>
			<div class="panel-summary-block-detail">
				<verysmall>Rp</verysmall> [[productPerPcs|number:2]]
			</div>
		</div>
		<div class="panel-summary-block">
			<div class="panel-summary-block-title">Per-rim</div>
			<div class="panel-summary-block-detail">
				<verysmall>Rp</verysmall> [[productPerRim|number:0]]
			</div>
		</div>
		<div class="panel-summary-block">
			<div class="panel-summary-block-title">Total</div>
			<div class="panel-summary-block-detail">
				<verysmall>Rp</verysmall> [[productPrice|number:0]]
			</div>
		</div>
		<div class="panel-summary-btn">
			<button class="btn" ng-click="nextCalled()">
				<span class="glyphicon glyphicon-chevron-right"></span>
			</button>
		</div>
	</div>

	<div class="btn-relative">
		<div class="btn-group">
			<button class="btn btn-outline-purple" ng-class="{'disabled':getPage()=='flyer'}" ng-disabled="getPage()=='flyer'" ng-click="prevCalled()">
				<span class="glyphicon glyphicon-chevron-left"></span> Prev
			</button>
			<button class="btn btn-outline-purple" ng-click="nextCalled()">
				Next <span class="glyphicon glyphicon-chevron-right"></span>
			</button>
		</div>
	</div>
</div>