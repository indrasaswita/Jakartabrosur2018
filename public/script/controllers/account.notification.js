module.exports = function(app){
	app.controller('NotificationController', ['$scope', '$http', 'API_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, BASE_URL, $cookies, $window){
			//$scope.notifications = null;

			$scope.initData = function($datas){
				$scope.notifications = JSON.parse($datas);
			}

			/*$scope.loadnotif = function($role, $custID){
				$scope.notifications = null;
				$http({
					method: "POST",
					url: API_URL+'notifications/'+$role+'/'+$custID
				}).then(function(response){
					if(response.data != null){
						if(response.data.constructor === String){
							console.log('error bro');
						}else{
							$scope.notifications = response.data;
						}
					}
				});
			}*/
		}
	]);
};