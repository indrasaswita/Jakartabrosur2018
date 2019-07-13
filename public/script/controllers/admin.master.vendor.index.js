module.exports = function(app) {
	app.controller('AdmVendorController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window) {

			$scope.vendors = [];

			$scope.initData = function($input){
				$scope.vendors = JSON.parse($input);
			}

		}
	]);
};