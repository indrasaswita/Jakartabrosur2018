module.exports = function(app) {
	app.controller('SalesChangefileController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window) {

			$scope.savechangeloading = false;

			$scope.savechangefile = function(whendone) {
				if ($scope.savechangeloading == false) {
					$scope.errormessage = "";
					$scope.savechangeloading = true;
					$http({
						method: "POST",
						url: AJAX_URL + "carts/changefile/save",
						data: $scope.selectedFile
					}).then(function(response) {
						if (response != null) {
							if (response.data != null) {
								if (response.data.constructor === Object) {
									$result = response.data;

									$scope.errormessage = $result.message;
									console.log($result.code + " - " + $result.message);
									$scope.savechangeloading = false;
								} else {
									$scope.errormessage = "Error message cannot be displayed.";
								}
								whendone(response.data);
							} else {
								$scope.errormessage = "Error message cannot be displayed.";
								whendone(null);
							}
						}
						$scope.savechangeloading = false;
						whendone(null);
					}, function(error) {
						$scope.errormessage = "Error message cannot be displayed. See Console for further message.";
						console.log(error);
						$scope.savechangeloading = false;
						whendone(null);
					});
				}
			}

			$scope.saveandclose = function() {
				$scope.savechangefile(function($result) {
					if ($result == null) {
						//error
						$scope.errormessage = "Error: NO RETURN RESULT";
					} else if ($result.code == 200) {
						console.log($("#changeFileModal"));
						$("#changeFileModal").modal('hide');
					}
				});
			}

			$scope.removecartfile = function() {
				if (!$scope.loadingcartfiles) {
					$scope.loadingcartfiles = true;

					$http({
						method: "GET",
						url: API_URL + "cartfiles/" + $scope.selectedFile.id + "/delete"
					}).then(function(response) {
						$scope.selectedCart.cartfile = response.data;
						$scope.loadingcartfiles = false;
						$("#changeFileModal").modal('hide');
					}, function(error) {
						$scope.loadingcartfiles = false;
					});
				}
			}

		}
	]);
};