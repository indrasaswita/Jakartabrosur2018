
<div class="shop-offerintext-wrapper">

@include('modal', 
	[
		'modalid' => 'offerintext',
		'modaltitle' => 'Detail of your Order',
		'modalbody' => '
			<div class="offerintext-body">
				<div class="left">
					<i class="fal fa-search fa-fw tx-lightgray"></i>
					Preview

					<br>
					<br>

					<div class="">
						[[selected.jobtitle]]<br>
						[[selected.itemdescription]]<br>
						[[selected.customernote]]<br>
					</div>
					<div class="size-200p">
						[[selected.quantity]] 
						<small class="tx-lightgray">	
							[[datas.satuan]]
						</small>
					</div>
					<div class="">
						[[selected.size.width]] x [[selected.size.length]] cm ([[selected.size.name]])
					</div>
					<div class="">
						[[selected.paper.name]]
						<span ng-show="selected.paper.gramature>0"> [[selected.paper.gramature]] gsm</span>, wrn:[[selected.paper.color]]
					</div>
					<div class="">
						[[selected.sideprint]] sisi
					</div>

					<div class="finishings" ng-repeat="item in selected.finishings">
						<span class="title">
							[[item.finishingname]]
						</span> 
						<span class="option">
							<i class="fal fa-angle-double-right fa-fw"></i>
							[[item.optionname]]
						</span>
					</div>
				</div>
				<div class="right">
					<i class="fal fa-search fa-fw tx-lightgray"></i>
					Action

					<br>
					<br>

					<button class="btn btn-sm btn-purple">
						HELLO WORLD!
					</button>
				</div>
			</div>
		',
		'modalfooter' => '
			<button class="btn btn-sm btn-secondary" data-dismiss="modal">
				Close
			</button>
		'
	]
)

</div>