module.exports = function(app){
	app.controller('ProfileController', ['$scope', '$http', 'API_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, BASE_URL, $window){
			$scope.customer = [];
			$scope.initCustomer = function($customer)
			{
				$scope.customer = JSON.parse($customer);
				$scope.customer.news = $scope.customer.news==1?true:false;
			}
			$scope.apiInitCustomer = function($customer)
			{
				$scope.customer = $customer;
				$scope.customer.news = $scope.customer.news==1?true:false;
			}

			$scope.changeProfile = function()
			{
				$scope.customer.news = $scope.customer.news==true?1:0;
				$http
					(
						{
							method: 	"POST",
							url: 		API_URL+"profile/update/"+$scope.customer.id,
							data: 		$scope.customer 
						}
					)
				.then(
					function(response){
						if(response.status=="success")
							$scope.apiInitCustomer(response.data);
						else if(response.status=="error")
							$scope.errors = [response.data];
					}
					,function(error){
						$scope.errors = error.data;
					}
				)
			}
			$scope.changePassword = function()
			{
				if($scope.customer.cnewpass == $scope.customer.newpass)
				{
					$http
						(
							{
								method: 	"POST",
								url: 		API_URL+"chpass/update/"+$scope.customer.id,
								data: 		$scope.customer
							}
						)
					.then(
						function(response){
							if(response.status=="success")
							{
								console.log(response);
								//$window.location.href=BASE_URL;
							}
							else if(response.status=="error")
								$scope.errors = [response.data];
						}
						,function(error){
							$scope.errors = error.data;
						}
					)
				}
			}
		}
	]);
};