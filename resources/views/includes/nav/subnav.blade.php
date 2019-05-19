<div ng-controller="SubnavigationController">

	<div ng-init="globalSubnav('{{Route::getCurrentRoute()->uri()}}', '{{Session::get('userid')}}')"></div>

	<div class="row margin-0">
		<div class="col-lg-12 padding-0">
			<div class="order-nav">
				<div class="pull-xs-left btn-group">
					<div class="btn disabled step-prev hidden-sm-down"></div>
					<a ng-repeat="item in subnavbefore" ng-href="[[item.link]]" class="btn" data-toggle='tooltip' data-placement='bottom' data-title="[[item.label]][[(item.login==true?'<br><i class=\'tx-red\'>req. <b class=\'size-80p\'>LOG-IN</b></i>':'')]]" data-html="true">
					<span class="fas fa-fw" ng-class="item.glyphicon"></span>
					</a>
				</div>
				<div class="step-content" data-toggle='tooltip' data-placement='bottom' data-title="[[subnavcurrent.label]]" data-html="true" ng-if="subnavcurrent.label!='Selection'">
					<span class="fas fa-fw" ng-class="subnavcurrent.glyphicon"></span>
					<span class="hidden-sm-down text-lighter">
						[[subnavcurrent.label]]
					</span>
				</div>
			@if(isset($datas['name']))
				<div class="step-content" data-toggle='tooltip' data-placement='bottom' data-title="{{$datas['name']}}" data-html="true" ng-if="subnavcurrent.label=='Selection'">
					<span class="fas fa-fw" ng-class="subnavcurrent.glyphicon"></span>
					<span class="hidden-sm-down text-lighter">
						{{$datas['name']}}
					</span>
				</div>
			@endif
				<div class="pull-xs-right btn-group">
					<a ng-repeat="item in subnavafter" ng-href="[[item.link]]" class="btn" data-toggle='tooltip' data-placement='bottom' data-title="[[item.label]][[(item.login=='true'?'<br><i class=\'tx-red\'>req. <b class=\'size-80p\'>LOG-IN</b></i>':'')]]" data-html="true">
						<span class="fas fa-fw" ng-class="item.glyphicon"></span>
						</a>
					<div class="btn disabled step-next hidden-sm-down"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="post-step-wrapper hidden-md-up">
		<div class="post-step-subwrapper" ng-if="subnavcurrent.label!='Selection'">
			<div class="post-step">
				<span class="fas" ng-class="subnavcurrent.glyphicon"></span>
				[[subnavcurrent.label]]
			</div>
		</div>
	@if(isset($datas['name']))
		<div class="post-step-subwrapper" ng-if="subnavcurrent.label=='Selection'">
			<a href="">
				<div class="post-step">
					<span class="fas" ng-class="subnavcurrent.glyphicon"></span>
					{{$datas['name']}}
				</div>
			</a>
		</div>
	@endif
	</div>
</div>