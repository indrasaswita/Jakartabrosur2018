module.exports = function(app){
	/*app.controller('OffsetPricing', ['$scope', '$http', 'ProductService', "$routeParams", 'API_URL',
		function($scope, $http, ProductService, $routeParams, API_URL){*/

	app.controller('DescriptionController', ['$scope', '$http', 'API_URL', '$cookies', '$window',
		function($scope, $http, API_URL, $cookies, $window){
			
			$scope.selected = {
				jobtitle : "",
				customernote : ""
			};

			$scope.initData = function($input){
				$data = JSON.parse($input);
				$scope.selected.jobtitle = $data.jobtitle;
				$scope.selected.customernote = $data.customernote;
			}

			$scope.initPrice = function($input){
				$data = JSON.parse($input);
				$scope.selected.qty = $data.quantity;
				$scope.productPerRim = $data.perrim;
				$scope.productPerPcs = $data.perpcs;
				$scope.productPrice = $data.price;
			}

			$scope.checkout = function(){
				$http(
					{
						method : 'POST',
						url : API_URL + 'flyer/description',
						data : 
							{
								'data' : $scope.selected,
							}
					}
				).then(function(response) {
					$scope.productPrice = response.price;
					$scope.productPerRim = response.perrim;
					$scope.productPerPcs = response.perpcs;
				});
			}

			$scope.nextCalled = function(){
				$scope.checkout();
			}

			$scope.addThousandSeparator = function(x) {
			    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			}

			$scope.isTheSame = function(x, y) {
				if (x == y) return true;
			    return false;
			}
		}
	]);
}