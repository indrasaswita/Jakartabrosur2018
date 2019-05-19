module.exports = function(app){
	app.controller('OrderListCustomerController', ['$scope', '$http', 'API_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, BASE_URL, $window){
			$scope.getActiveJobSubType();
		}
	]);
};