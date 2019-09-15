module.exports = function(app) {
	app.controller('AllaccCartheaderController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window) {
			$scope.salesdetail = null;

			$scope.initData = function($input){
				$scope.salesdetail = JSON.parse($input);

				$.each($scope.salesdetail.cartheader.cartdetail, function($i, $ii){
					$ii.jobtypelong = 
						$ii.jobtype == "OF" ? "Offset Print":
						$ii.jobtype == "DG" ? "Digital Print": "Not Set Yet";
				});
			}

			$scope.showprogress = function(){
				$("#print-progress-modal").modal('show');
			}

		}
	]);
};