module.exports = function(app){
	app.controller('OrderListCustomerController', ['$scope', '$http', 'API_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, BASE_URL, $window){
			//$scope.getActiveJobSubType();
			$scope.getAllJobSubType();

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