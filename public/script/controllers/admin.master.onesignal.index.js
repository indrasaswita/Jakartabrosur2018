module.exports = function(app) {
	app.controller('AdmOnesignalController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window) {

			$scope.onesignals = [];
			$scope.employees = [];
			$scope.customers = [];

			$scope.initData = function($onesignals, $employees, $customers){
				$scope.onesignals = JSON.parse($onesignals);
				$scope.employees = JSON.parse($employees);
				$scope.customers = JSON.parse($customers);
			}


		}
	]);
};