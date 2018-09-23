
	<div ng-init="globalSubnav('{{Route::getCurrentRoute()->uri()}}')"></div>
	<div class="row margin-0">
		<div class="col-lg-12 padding-0">
			<div class="order-nav">
				<div class="pull-xs-left btn-group">
				 <div class="btn disabled step-prev hidden-xs-down"></div>
				 <a ng-repeat="item in subnavbefore" ng-href="[[item.link]]" class="btn" data-toggle='tooltip' data-placement='bottom' data-title="[[item.label]]">
					<span class="fas" ng-class="item.glyphicon"></span>
				 </a>
				</div>
				<div class="step-content" data-toggle='tooltip' data-placement='bottom' data-title="[[subnavcurrent.label]]">
					<span class="fas" ng-class="subnavcurrent.glyphicon"></span>
					<span class="hidden-sm-down text-lighter">


					@if(isset($datas))
						@if($datas!=null)
							@if(isset($datas['name']))
								@if($datas['name']!=null)
						
							{{$datas['name']}}

								@endif
							@endif
						@endif
					@endif

						[[subnavcurrent.label]]
					</span>
				</div>
				<div class="pull-xs-right btn-group">
				 <a ng-repeat="item in subnavafter" ng-href="[[item.link]]" class="btn" data-toggle='tooltip' data-placement='bottom' data-title="[[item.label]]">
					<span class="fas" ng-class="item.glyphicon"></span>
					</a>
				 <div class="btn disabled step-next hidden-xs-down"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="post-step hidden-md-up">
		<span class="fas" ng-class="subnavcurrent.glyphicon"></span>
	@if(isset($datas))
		@if($datas!=null)
			@if(isset($datas['name']))
				@if($datas['name']!=null)
		
			{{$datas['name']}}

				@endif
			@endif
		@endif
	@endif
		[[subnavcurrent.label]]
	</div>