module.exports = function(app){
	/*app.controller('OffsetPricing', ['$scope', '$http', 'ProductService', "$routeParams", 'API_URL',
		function($scope, $http, ProductService, $routeParams, API_URL){*/
	app.controller('LoginModal', ['$scope', '$http', 'API_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, BASE_URL, $window){
			$scope.nextUrl = '';
			$scope.logintabs = [
				{
					label : "LOG-IN",
					value : "login",
					button : "Log Me In!",
				},
				{
					label : "SIGN-UP",
					value : "register",
					button : "Next >",
				}
			];
			$scope.localselected = {
				logintab : "login"
			};
			$scope.customerData = {
					'companyID' : '1', 
					'email' : 'indrasaswita@gmail.com', 
					'password' : 'password', 
					'name' : 'Indra Saswita', 
					'type' : 'personal', 
					'title' : 'Mr.', 
					'address' : 'Pangeraj Kayajsandjf', 
					'postcode' : '10730', 
					'cityID' : 1, 
					'phone' : '0216491502', 
					'news' : '1', //INI DATA YANG BUAT DI STORE KE DB (0-1)
					'newsvalue' : true, //INI YANG BUAT TAMPILAN (true-false)
					'balance' : '0',
					'terms' : false
			};

			$scope.clearAllData = function(){
				$scope.customerData = {
					'companyID' : '1', 
					'email' : '', 
					'password' : '', 
					'name' : '', 
					'type' : 'personal', 
					'title' : 'Mr.', 
					'address' : '', 
					'postcode' : '', 
					'cityID' : 1, 
					'phone' : '', 
					'news' : '1', 
					'newsvalue' : true,
					'balance' : '0',
					'terms' : false
				}
			}
			$scope.alertshow = false;
			$scope.clearAllData.call();
			$scope.setNews = function(value){
				if (value) $scope.customerData.news = 1;
				else $scope.customerData.news = 0;
			}
			$scope.setSelectedTab = function(logintab){
				$scope.localselected.password = '';
				$scope.alertshow = false;
				$scope.localselected.logintab = logintab;
				if (logintab == "login"){
					$('#loginModalSize').addClass('modal-sm').removeClass('modal-lg');
				}else if(logintab == "register"){
					$('#loginModalSize').removeClass('modal-sm').addClass('modal-lg');
				}
			}
			$scope.getSelectedTabButton = function(){
				for($i = 0; $i < $scope.logintab.length; $i++){
					if ($scope.localselected.logintab == $scope.logintab.value){
						return $scope.logintab[$i].button;
					}
				}
				return "...";
			}

			$scope.loginButtonClicked = function($link){
				if ($scope.localselected.logintab == "login")
				{

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
								if($link == null)
									location.reload();	
								else if($scope.nextUrl != '')
									$window.location.href=BASE_URL+$scope.nextUrl;
								else
									$window.location.href=BASE_URL+$link;
							}
						}
					});
				}
				else if ($scope.localselected.logintab == "register")
				{
					// REGISTER
					//console.log($scope.customerData);
					$scope.error = [];
					if ($scope.customerData.cpassword != $scope.customerData.password)
					{
						$scope.error.cpassword = ["Confirm password tidak sesuai password Anda."];
					}
					else if ($scope.customerData.terms == false)
					{
						$scope.error.terms = ["Anda belum setuju dengan Syarat & Ketentuan yang berlaku."];
					}
					else
					{
						$scope.alertmessage = 'Loading...';
						$scope.alerttype = "alert-info";
						$scope.alertshow = true;

						$http(
							{
								method : 'POST',
								url : API_URL + 'register',
								data : $scope.customerData
							}
						).then(
							function(response) {
								if(response.data.type=="alert-success")
								{
									if($link == null)
									{
										$scope.setSelectedTab("login");
										$scope.alertmessage = response.data.message;
										$scope.alerttype = response.data.type;
										$scope.alertshow = true;

										$tempmail = $scope.customerData.email;
										$scope.clearAllData();
										$scope.customerData.email = $tempmail;

										$('#login-password').focus();
									}
									else
									{
										$window.location.href=BASE_URL+$link;
									}
								}
								else if(response.data.type=="alert-danger")
								{
									//EMAILNY DUPLICATED
									$scope.alertmessage = response.data.message;
									$scope.alerttype = response.data.type;
									$scope.alertshow = true;
									$('#signup-username').focus();
								}
							},function(error){
								$scope.alertshow = false;
								$scope.error = response.data;
							}
						);
					}
					console.log($scope.error);
				}
			}
			$scope.getIndex0 = function($input){
				if ($input != null)
				{
					return $input[0];
				}
				return "";
			}
			$scope.addThousandSeparator = function(x) {
			    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			}

			$scope.isTheSame = function(x, y) {
				if (x == y) return true;
			    return false;
			}

			$scope.setNextUrl = function($url)
			{
				$scope.nextUrl = $url;
			}
		}
	]);
}