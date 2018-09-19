@include('modal', ['modalid' => $modalid, 'modaltitle' => $modaltitle, 'modalbody' => '
	<!-- 

	REQ:
	1. aicesales [] -> dari table aicesales -> tapi buat showsales.blade.php
	2. aicesalesgroup [] -> dari table aicesales -> tapi buat showsalesgroup.blade.php

 	-->

 	<div class="pull-xs-right">
 		<button class="btn btn-sm btn-purple" ng-click="getSales()" ng-show="'.$tablename.'==aicesales&&salesloading==false">
 			<i class="fas fa-sync"></i>&nbsp;
 			Refresh
 		</button>
 		<div ng-show="'.$tablename.'==aicesales&&salesloading==true">
 			<i class="fas fa-sync fa-spin fa-2x text-lightmagenta"></i>
 		</div>
 		<button class="btn btn-sm btn-purple" ng-click="getGroup()" ng-show="'.$tablename.'==aicesalesgroup&&grouploading==false">
 			<i class="fas fa-sync"></i>&nbsp;
	 		Refresh
	 	</button>
	 	<div ng-show="'.$tablename.'==aicesalesgroup&&grouploading==true">
 			<i class="fas fa-sync fa-spin fa-2x text-lightmagenta"></i>
 		</div>
 	</div>

	<table class="table table-sm signika">	
		<thead>
			<tr>
				<td class="text-xs-right">Nama</td>
				<td class="text-xs-center">Stok</td>
				<td class="text-xs-center">Stok2</td>
				<td class="text-xs-center">Min</td>
				<td class="text-xs-center">Min2</td>
				<td class="text-xs-center">Hrg2</td>
			</tr>
		</thead>
		<tbody class="line-09">
			<tr ng-repeat="item in '.$tablename.'">
				<td class="text-xs-right">[[item.name]]</td>
				<td class="text-xs-center">[[item.stock]]</td>
				<td class="text-xs-center"><input class="form-control form-control-sm text-bold text-xs-center" type="number" ng-model="item.stock2"></td>
				<td class="text-xs-center">[[item.minstock]]</td>
				<td class="text-xs-center"><input class="form-control form-control-sm text-bold text-xs-center" type="number" ng-model="item.minstock2"></td>
				<td class="text-xs-center"><input class="form-control form-control-sm text-bold text-xs-center" type="number" ng-model="item.sellprice2"></td>
			</tr>
		</tbody>
	</table>
', 'modalfooter'=>'
	<button class="btn btn-primary btn-sm" ng-click="submitStock()">Submit</button>
'])