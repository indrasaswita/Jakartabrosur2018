module.exports = function(app){
	app.controller('LoginController', ['$scope', '$http', 'API_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, BASE_URL, $window){
			$scope.nextUrl = '';
			$scope.alertshow = false;
			//$scope.clearAllData.call();
			$scope.setNews = function(value){
				if (value) $scope.customerData.news = 1;
				else $scope.customerData.news = 0;
			}

			$scope.loginButtonClicked = function($link){
				$scope.alertmessage = 'Loading...';
				$scope.alerttype = "alert-info";
				$scope.alertshow = true;

				// LOGIN
				$http(
					{
						method : 'POST',
						url : API_URL + 'login',
						data : 
						{
							'email' : $scope.customerData.email,
							'password' : $scope.customerData.password
						}
					}
				).then(function(response) {
					if(response.data.message != null){
						$scope.error = null;
						$scope.alertmessage = response.data.message;
						$scope.alerttype = response.data.type;
						$scope.alertshow = true;
						if (response.data.type == "alert-success"){
							$userid = response.data.userid!=null?response.data.userid:"NULL";
							$scope.gtag('set', {'user_id': $userid}); 
							// Set the user ID using signed-in user_id.
							if($link == null)
								location.reload();
							else if($scope.nextUrl != '')
								$window.location.href=BASE_URL+$scope.nextUrl;
							else
								$window.location.href=BASE_URL+$link;
						} else if (response.data.type=="verification"){
							$window.location.href = BASE_URL + "verification";	
						}
					}
				});
			}

			$scope.setNextUrl = function($url)
			{
				$scope.nextUrl = $url;
			}

			$scope.resendemail = function($email){
				$http(
				{
					method : 'POST',
					url : API_URL + 'resend'
				}).then(function(response){
					if(response.data != null){
						$window.location.href=BASE_URL+'login';
					}
				});
			}
		}
	]);
}