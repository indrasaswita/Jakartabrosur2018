module.exports = function(app){
	app.controller('AdmCompaccsController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $window){
			
			$scope.password = $scope.do_encrypt('029029', $scope.keyRequired);
			$scope.userId = "indrasas0290";

			$scope.go = function(){
				$http({
					method: "POST",
					url: API_URL+"admin/compaccs/mandiri/refresh",
					data: {
						"userId": $scope.userId,
						"userPass": '',
						"userPassCrypto": $scope.password,
						"key1": $scope.key1,
						"key2": $scope.key2
					}
				}).then(function(response){
					if(response.data!=null)
					{
						console.log(response.data);
						if(response.data.constructor === String)
						{
							
						}
					}
				});
			}
		}
	]);
}