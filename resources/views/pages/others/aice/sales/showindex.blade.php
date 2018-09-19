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
				<td class="text-xs-right" ng-show="'.$tablename.'==aicesales">Jam</td>
				<td class="text-xs-center">Qty</td>
				<td>Nama</td>
			</tr>
		</thead>
		<tbody class="line-09">
			<tr ng-repeat="item in '.$tablename.'">
				<td class="text-xs-right" ng-show="'.$tablename.'==aicesales">[[item.created_at|date:\'d MMM H:m\']]</td>
				<td class="text-xs-center text-bold">[[item.qty]]</td>
				<td>[[item.icecream.name]]</td>
			</tr>
		</tbody>
	</table>
', 'modalfooter'=>''])