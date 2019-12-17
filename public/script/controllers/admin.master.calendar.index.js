module.exports = function(app){
	app.controller('AdmCalendarController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $window){
			$scope.dates = [];

			$scope.initData = function($offdays, $today){
				$temp = $scope.makeDate($today);
				$scope.today = {};
				$scope.today.date = $temp.getDate();
				$scope.today.month = $temp.getMonth()+1;
				$scope.today.year = $temp.getFullYear();
				$scope.selectedmonth = $scope.today.month;
				$scope.selectedyear = $scope.today.year;

				$scope.offdays = JSON.parse($offdays);
				$.each($scope.offdays, function($index, $item){
					$item.created_at = $scope.makeDateTime($item.created_at);
					$item.updated_at = $scope.makeDateTime($item.updated_at);
				});


				$scope.refreshCalendar();
			}

			$scope.initSetAfter = function($after){
				//console.log($after);
				$scope.after = $scope.makeDate($after);
			}

			$scope.isDate = function($check, $date){
				if($check.getMonth()+1 == $scope.selectedmonth && $check.getFullYear() == $scope.selectedyear){
					if($check.getDate() == $date){
						return true;
					}
				}

				return false;
			}

			$scope.refreshCalendar = function(){
				$scope.dates = [];
				$totalpip = (new Date($scope.selectedyear, $scope.selectedmonth-1, 1).getDay())-1;
				$totalpip = $totalpip == -1 ? 7-1 : $totalpip;

				$count = 1-$totalpip;

				if($scope.selectedmonth==2){
					if($scope.selectedyear%4==0)
						$totalday = 29;
					else
						$totalday = 28;
				}else if($scope.selectedmonth<=6){
					if($scope.selectedmonth%2==1)
						$totalday = 31;
					else if($scope.selectedmonth%2==0)
						$totalday = 30;
				}else{
					if($scope.selectedmonth%2==0)
						$totalday = 31;
					else if($scope.selectedmonth%2==1)
						$totalday = 30;
				}
				for (var i = 0; $count <= $totalday; i++) {
					$temp = [];
					for(var j = 0; j < 7 && $count <= $totalday; j++){
						if($count>0)
							$temp.push($count);
						else
							$temp.push("");
						$count++;
					}
					$scope.dates.push($temp);
				}
			}

			$scope.isToday = function($dt){
				if($dt == $scope.today.date
						&& $scope.selectedmonth == $scope.today.month
						&& $scope.selectedyear == $scope.today.year){
					return true;
				}
			}

			$scope.isOffday = function($dt){
				$flag = false;
				$.each($scope.offdays, function($index, $item){
					if($item.offday == ""+$scope.selectedyear+"-"+$scope.zeroFill($scope.selectedmonth,2)+"-"+$scope.zeroFill($dt,2)){
						$flag = true;
						return;
					}
				});
				if($flag) return true;
			}

			$scope.decrement_month = function(){
				if($scope.selectedmonth == 1){
					$scope.selectedmonth = 12;
					$scope.selectedyear--;
				} else {
					$scope.selectedmonth--;
				}

				$scope.refreshCalendar();
			}

			$scope.increment_month = function(){
				if($scope.selectedmonth == 12){
					$scope.selectedmonth = 1;
					$scope.selectedyear++;
				} else {
					$scope.selectedmonth++;
				}

				$scope.refreshCalendar();
			}

		}
	]);
}