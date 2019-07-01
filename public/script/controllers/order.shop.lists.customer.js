module.exports = function(app){
	app.controller('OrderListCustomerController', ['$scope', '$http', 'API_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, BASE_URL, $window){

			$scope.initData = function($input){
				$scope.jobtypes = JSON.parse($input);

				$.each($scope.jobtypes, function($index, $item){
					//HIDE YANG GA PUNYA ISI
					$totalsub = 0;
					$.each($item.jobsubtype, function($j, $jj){
						$totalsub++;
					});
					if($totalsub==0)
						$item.active = false;
					else{
						$item.active = true;
					}
				});
			}

			$scope.linkclicked = function($link, $active){
				if ($active) {
					if ($link != null) {
						$window.location.href = BASE_URL + "shop/" + $link;
					}
				}else{
					return false;
				}
			}
		}
	]);
};