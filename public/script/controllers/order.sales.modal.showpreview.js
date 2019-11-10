module.exports = function(app) {
	app.controller('SalesShowpreviewController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window) {

			$scope.commitpreview = function(){
				$http({
					method: "POST",
					url: AJAX_URL+""
				}).then(function(response){
					if(response.data!=null)
					{
						if(response.data.constructor === String)
						{
							
						}
					}
				});
			}

		}
	]);
};