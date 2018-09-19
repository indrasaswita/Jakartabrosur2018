module.exports = function(app){
	app.controller('CustomerController', ['$scope', '$http', 'API_URL', 
		function($scope, $http, API_URL){
			/*$scope.selected = {
				'name' : '',
				'email' : '',
				'phone' : '',
				'address' : '',
				'type' : '',
				'balance' : 0
			};*/
			$scope.URL = 'http://localhost:8000/';
			$scope.setFormValue = function($customers){
				$scope.selected = $customers;
				//entah napa idnya harus string
				$scope.selected.companyID = $scope.selected.companyID + "";
				$scope.selected.cityID = $scope.selected.cityID + "";

				$('#btn-update').removeAttr('disabled');
				$('#form-open').removeAttr('action').attr('action', $scope.URL+'customers/'+$scope.selected.id);
			}
			$scope.getCompanyItem = function($companyID){
				for($i = 0; $i < $scope.companies; $i++)
				{
					if ($scope.companies[$i].id == $companyID)
					{
						return $scope.companies[$i];
					}
				}
				return 0;
			}
			$scope.selected={
                'companyID' : '1',
                'email' : '',
                'password' : '',
                'name' : '',
                'type' : '',
                'title' : '', 
                'address' : '', 
                'postcode' : '',
                'cityID' : '1',
                'phone1' : '',
                'phone2' : '',
                'phone3' : '',
                'news' : 0,
                'balance' : 0
			};
			$scope.fillCompanies = function()
			{
				$http(
					{
						method : 'GET',
						url : API_URL + 'companies'
					}
				).then(function(response) {
					$scope.companies = response.data;
					$('#form-companyID').children().remove();
				});
			};
			$scope.fillCompanies.call();

			$scope.fillCities = function()
			{
				$http(
					{
						method : 'GET',
						url : API_URL + 'cities'
					}
				).then(function(response) {
					$scope.cities = response.data;
					$('#form-cityID').children().remove();
				});
			};
			$scope.fillCities.call();
		}
	]);
};