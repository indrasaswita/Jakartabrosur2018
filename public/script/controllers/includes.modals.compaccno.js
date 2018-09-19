module.exports = function(app){
	app.controller('CompaccShowController', ['$timeout', '$scope', '$http', 'API_URL', 'BASE_URL', '$window',
		function($timeout, $scope, $http, API_URL, BASE_URL, $window){
			
			$scope.showcompacc = function(item){
				$scope.showncompacc = item;
			}
		}
	]);
};