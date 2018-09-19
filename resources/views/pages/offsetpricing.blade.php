@extends('layouts.default')
@section('content')
<div class="pageheader">
	<div class="container">
		<div class="content">
			<h1> Brochure and Flyers! </h1>
			<h4> Make your business bigger by smart promotion. :) </h4>
		</div>
	</div>
</div>

<div class="container">
    <div class="row row-offcanvas">
		<div class="col-lg-3 sidebar sidebar-offcanvas">
			<ul class="nav sidenav">
				<li class="active">
					<a href="#">
						<span class="glyphicon glyphicon-chevron-right pull-xs-right" aria-hidden="true"></span>
						Pricing
					</a>
				</li>
				<li class>
					<a href="#">
						<span class="glyphicon glyphicon-chevron-right pull-xs-right" aria-hidden="true"></span>
						Upload
					</a>
				</li>
				<li class>
					<a href="#">
						<span class="glyphicon glyphicon-chevron-right pull-xs-right" aria-hidden="true"></span>
						Payment
					</a>
				</li>
			</ul>
		</div>
		<div class="col-lg-9">
			<div ng-controller = "OffsetPricing">
				<div class="bg-panel blue">
					<div class="panel-title">Quantity</div>
					<div class="input-group">
						<div class="input-group-btn">
						    <button type="button" class="btn btn-active" ng-click="setQtyDecr()">Less</button>
					    </div>	
						    <input type="text" id="tb-qty" class="form-control text-center text-bold" value="[[selected.qty]] RIM = [[ addThousandSeparator(selected.qty * 500) ]] pcs" disabled />
					    <div class="input-group-btn">
						    <button type="button" class="btn btn-active" ng-click="setQtyIncr()">More</button>
						</div>
					</div>
				</div>
				<div class="bg-panel blue">
					<ul class="nav nav-tabs">
					  	<li class="nav-item" ng-repeat="item in sizetabs">
					  		<a class="nav-link" ng-class="{'active' : item.value == localselected.sizetab}" ng-click="setSelectedSizeTab(item.value)">[[item.label]]</a>
					  	</li>
					</ul>
					<div class="btn-group btn-group-justified" role="group" ng-show="isTheSame('inter', localselected.sizetab)">
					  <div class="btn-group" role="group" ng-repeat="item in sizes">
					    <button type="button" class="btn" ng-class="{'btn-default' : item.value != selected.size, 'btn-active' : item.value == selected.size}" ng-click="setSelectedSize(item.value)">[[item.label]]</button>
					  </div>
					</div>
					
					<table class="custom-size" ng-show="isTheSame('custom', localselected.sizetab)">
						<tr>
						    <td colspan="10">
						    	<input type="text" id="tb-panjang" class="text-center text-bold" value="" placeholder="length" />
						   	</td>
							<td>cm</td>
							<td><span class="glyphicon glyphicon-remove"></span></td>
						    <td colspan="10">
						    	<input type="text" id="tb-panjang" class="text-center text-bold" value="" placeholder="width" />
						   	</td>
							<td>cm</td>
						</tr>
					</table>
				</div>

				<div class="bg-panel blue">
					<div class="panel-title">Material</div>
					<div class="btn-group btn-group-justified" role="group">
					  <div class="btn-group" role="group" ng-repeat="item in materials">
					    <button type="button" class="btn" ng-class="{'btn-default' : selected.mat != item.value, 'btn-active' : selected.mat == item.value}" ng-click="setSelectedMaterial(item.value)">[[item.label]]</button>
					  </div>  
					</div>
					<div class="panel-title">Gramatur (Ketebalan)</div>
					<div class="btn-group btn-group-justified" role="group">
					  <div class="btn-group" role="group" ng-repeat="item in selectedGramatures">
					    <button type="button" class="btn" ng-class="{'btn-active' : item.value == selected.gram, 'btn-default' : item.value != selected.gram}" ng-click="setSelectedGramatur(item.value)">[[item.label]]</button>
					  </div>
					</div>
				</div>

				<div class="bg-panel blue">
					<div class="panel-title">Sisi Cetak</div>
					<div class="btn-group btn-group-justified" role="group">
					  <div class="btn-group" role="group" ng-repeat="item in sideprints">
					    <button type="button" class="btn" ng-class="{'btn-default' : selected.sdp != item.value, 'btn-active' : selected.sdp == item.value}" ng-click="setSelectedSidePrint(item.value)">[[item.label]]</button>
					  </div>
					</div>
				</div>  
				<div class="bg-panel blue">
					<div class="panel panel-default" >
					  <div class="panel-heading"><div class="panel-title">Harga Cetak</div></div>

					  <table class="table tbl">
					  	<tr>
					  		<th>Quantity</th>
					  		<th>Harga /lembar</th>
					  		<th>Harga /rim</th>
					  		<th>Harga Total</th>
					  	</tr>
					  	<tr>
					  		<td><span id="vw-qty">[[selected.qty]] rim ([[addThousandSeparator(selected.qty*500)]] lembar)</span></td>
					  		<td>Rp [[productPerPcs]]</td>
					  		<td>Rp [[productPerRim]]</td>
					  		<td>Rp [[productPrice]]</td>
					  	</tr>
					  </table>
					</div>
				</div>

				<div class="text-center">
					<button type="button" class="btn btn-success" ng-click="checkout()">Checkout!</button>
				</div>
			</div>
		</div>
	</div>
</div>
@stop