module.exports = function(app) {
	app.controller('AdmFinishingController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window) {
			$scope.finishings = [];

			$scope.initData = function($input){
				$scope.finishings = JSON.parse($input);
				$.each($scope.finishings, function($i, $ii){
					$ii.created_at = $scope.makeDateTime($ii.created_at);
				});
			}

		}
	]);
};