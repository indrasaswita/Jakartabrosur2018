module.exports = function(app) {
	app.controller('CartChangefileController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window) {

			$scope.savechangeloading = false;

			$scope.savedetailclicked = function(){
				$scope.savechangefile(function($result){
					console.log($result);
					if ($result == null) {
						//error
						$scope.errormessage = "ERROR - check console";
					} else if ($result.code == 200) {
					} else {
						$scope.errormessage = $result.message;
						console.log($result.code + " - " + $result.message);
					}
				});
			}

			$scope.savechangefile = function(whendone){
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
								$result = response.data;
								if (response.data.constructor === Object) {

									$scope.errormessage = $result.message;
									$scope.savechangeloading = false;
								} 
							} 
						}
						$scope.savechangeloading = false;
						if(whendone instanceof Function){
							whendone(response.data);
						}
					}, function(error) {
						$scope.errormessage = "Error message cannot be displayed. See Console for further message.";
						console.log(error);
						$scope.savechangeloading = false;
						if(whendone instanceof Function){
							whendone(null);
						}
					});
				}
			}

			$scope.saveandclose = function(){
				$scope.savechangefile(function($result){
					if ($result == null) {
						//error
						$scope.errormessage = "ERROR - check console";
					} else if ($result.code == 200) {
						$("#changeFileModal").modal('hide');
					} else {
						$scope.errormessage = $result.message;
						console.log($result.code + " - " + $result.message);
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
					}, function(error){
						$scope.loadingcartfiles = false;
					});
				}
			}
		}
	]);
};