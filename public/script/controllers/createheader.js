module.exports = function(app){
	app.controller('CreateHeaderController', ['$scope', '$http', 'API_URL', '$window',
		function($scope, $http, API_URL, $window){
			$scope.URL = 'http://localhost:8000/';

			

			$scope.checkout = function(){
				$window.location.href="order/createheader";
			}
		}
	]);
};