module.exports = function(app) {
	app.controller('CartAddfileController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window) {



			$scope.createcartfile = function($file) {
				if (!$scope.loadingcartfiles) {
					$data = {
						'cartID': $scope.selectedCart.id,
						'fileID': $file.id
					};
					$scope.loadingcartfiles = true;
					$http({
						method: "POST",
						url: API_URL + "cartfiles/create",
						data: $data
					}).then(function(response) {
						if (response != null){
							//$scope.tempcart.cartfile = response.data;
							$scope.selectedCart.cartfile = response.data;
							$scope.addnewfile();
						}
						else
							console.log('error when send data - create cartfile');

						$scope.loadingcartfiles = false;
					});
				}

			}
			

		}
	]);
};