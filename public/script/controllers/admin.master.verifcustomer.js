module.exports = function(app) {
	app.controller('VerifCustomerController', 
		[
			'$scope', 
			'$http', 
			'API_URL', 
			function(
				$scope, 
				$http, 
				API_URL
			)
			{

				$scope.initheader = function($customers){
					$scope.customers = JSON.parse($customers);
					$.each($scope.customers, function($index, $item){
						if($item['verify_token']!=null){
							if ($item['verify_token'].length == 16) {
								$scope.customers[$index]['verify_token'] = $item['verify_token'].substring(6, 10);
							}
						}

						if ($item['phone1'] != null) {
							if ($item['phone1'].charAt(0) == "0") {
								$scope.customers[$index]['phone1'] = "62" + $item['phone1'].substring(1);
							}
						}
						if ($item['phone2'] != null) {
							if ($item['phone2'].charAt(0) == "0") {
								$scope.customers[$index]['phone2'] = "62" + $item['phone2'].substring(1);
							}
						}

						if($item['created_at']!=null){
							$scope.customers[$index]['created_at'] = $scope.makeDateTime($item['created_at']);
						}
					});
				};
			}
		]
	);
}