<div ng-controller="SubnavigationController">

	<div ng-init="globalSubnav('{{Route::getCurrentRoute()->uri()}}', '{{Session::get('userid')}}')"></div>
	<div class="order-nav">
		<div class="prev-group btn-group" ng-if="subnavbefore.length>0">
			<!-- <div class="btn disabled step-prev hidden-sm-down" hidden></div> -->
			<a ng-repeat="item in subnavbefore" ng-href="[[item.link]]" class="btn" data-toggle='tooltip' data-placement='bottom' data-title="[[item.label]][[(item.login==true?'<br><i class=\'tx-red\'>req. <b class=\'size-80p\'>LOG-IN</b></i>':'')]]" data-html="true">
			<span class="far fa-fw" ng-class="item.glyphicon"></span>
			</a>
		</div>

		<div class="step-content">
			<div class="current" ng-if="subnavcurrent.label!='Selection'">
				<span class="fas fa-fw" ng-class="subnavcurrent.glyphicon"></span> &nbsp;
				<span class="hidden-sm-down text-lighter">
					[[subnavcurrent.label]]
				</span>
			</div>
		@if(isset($datas['name']))
			<div class="current" ng-if="subnavcurrent.label=='Selection'">
				<span class="fas fa-fw" ng-class="subnavcurrent.glyphicon"></span> &nbsp;
				<span class="hidden-sm-down text-lighter">
					{{$datas['name']}}
				</span>
			</div>
		@endif

			<div class="post-step-wrapper hidden-md-up">
				<div class="post-step-subwrapper" ng-if="subnavcurrent.label!='Selection'">
					<div class="post-step">
						<span class="far fa-fw" ng-class="subnavcurrent.glyphicon"></span>
						[[subnavcurrent.label]]
					</div>
				</div>
		@if(isset($datas['name']))
				<div class="post-step-subwrapper" ng-if="subnavcurrent.label=='Selection'">
					<a href="">
						<div class="post-step">
							<span class="far fa-fw" ng-class="subnavcurrent.glyphicon"></span>
							{{$datas['name']}}
						</div>
					</a>
				</div>
		@endif
			</div>
		</div>

		<div class="next-group btn-group" ng-if="subnavafter.length>0">
			<a ng-repeat="item in subnavafter" ng-href="[[item.link]]" class="btn" data-toggle='tooltip' data-placement='bottom' data-title="[[item.label]][[(item.login=='true'?'<br><i class=\'tx-red\'>req. <b class=\'size-80p\'>LOG-IN</b></i>':'')]]" data-html="true">
				<span class="far fa-fw" ng-class="item.glyphicon"></span>
				</a>
			<!-- <div class="btn disabled step-next hidden-sm-down" hidden></div> -->
		</div>


	
	</div>
</div>