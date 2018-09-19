module.exports = function(app){
	app.controller('AdmCompanyPendingController', ['$scope', '$http', 'API_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, BASE_URL, $window){
			$scope.initData = function($datas){
				$scope.companies = JSON.parse($datas);
				$.each($scope.companies, function($index, $item){
					console.log($item);
					$item.created_at = $scope.makeDateTime($item.created_at);
					$.each($item.customer, function($index2, $item2){
						$item2.created_at = $scope.makeDateTime($item2.created_at);
					});
				});
			}

		}
	]);
}