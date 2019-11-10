module.exports = function(app){
	app.controller('LoginController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $window){
			$scope.nextUrl = '';




			$scope.setState0 = function(){
				$scope.state = 0;
				$scope.alertshow = false;
				$scope.alertmessage = "";
				$scope.loading = false;
				$scope.error = {
					"email": "",
					"password": "",
					"confirmpassword": ""
				};
				$scope.customerData = {
					'email': "",
					'password': "",
					'confirmpassword': ""
				};

				$(function() {
					$("#login-email").focus();
				});
			}
			$scope.setState0();

			
			//$scope.clearAllData.call();
			$scope.setNews = function(value){
				if (value) $scope.customerData.news = 1;
				else $scope.customerData.news = 0;
			}

			$scope.setMessage = function($text, $type, $loading=false){
					$scope.alertmessage = $text;
					$scope.alerttype = $type;
					$scope.alertshow = true;
					$scope.alertpulse = $loading;
			}

			$scope.nextButtonClicked = function(){
				if($scope.validateEmail($scope.customerData.email)){
					$scope.error.email = "";
					if($scope.state == 0){
						$http({
							method: 'POST',
							url   : AJAX_URL+'checkmail',
							data  : {
								'email': $scope.customerData.email
							},
						}).then(function(response){
							if(response.data != null){
								if(typeof response.data == "string"){
									$scope.state = response.data;
									if($scope.state == "1"){
										//kalo ada pass
										$scope.customerData.password = "";
										$(function() {
											$("#login-password").focus();
										});
									}else if($scope.state == "2"){
										$scope.customerData.password = "";
										$scope.customerData.confirmpassword = "";
										$(function() {
											$("#login-password2").focus();
										});
									}
								}
							}
						});
					}
				}else{
					$scope.error.email = "Email Anda salah, mohon periksa kembali.";
				}
			}

			$scope.backButtonClicked = function(){
				$scope.setState0();
			}


			$scope.makePasswordClicked = function($link){

				if($scope.customerData.password != $scope.customerData.confirmpassword){
					$scope.setMessage("Password Konfirmasi berbeda dengan Password", "alert-danger");
				}
				console.log("ANJING");
				console.log($scope.loading == false);
				console.log($scope.customerData.password == $scope.customerData.confirmpassword);
				if($scope.loading == false &&	$scope.customerData.password == $scope.customerData.confirmpassword){
					$scope.loading = true;
					$scope.setMessage("Loading..", "alert-info", true);

					// LOGIN
					$http(
						{
							method : 'POST',
							url : AJAX_URL + 'makepassword',
							data : 
							{
								'email' : $scope.customerData.email,
								'password' : $scope.customerData.password
							}
						}
					).then(function(response) {
						if(response.data.message != null){
							$scope.error.password = null;
							$scope.error.confirmpassword = null;
							
							$scope.setMessage(response.data.message, response.data.type);
						
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
						$scope.loading = false;
					}, function(error){
						console.log(error.message);
						$scope.loading = false;
					});
				} else if($scope.loading == true) {
					console.log("still on loading");
				}
			}

			$scope.loginButtonClicked = function($link){
				$scope.setMessage("Loading..", "alert-info", true);

				// LOGIN
				$http(
					{
						method : 'POST',
						url : AJAX_URL + 'login',
						data : 
						{
							'email' : $scope.customerData.email,
							'password' : $scope.customerData.password
						}
					}
				).then(function(response) {
					if(response.data.message != null){
						$scope.error.email = null;

						$scope.setMessage(response.data.message, response.data.type);
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