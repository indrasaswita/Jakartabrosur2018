module.exports = function(app){
	app.controller('SignupController', ['$scope', '$http', 'API_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, BASE_URL, $window){
			$scope.nextUrl = '';

			$scope.clearAllData = function(){
				$scope.customerData = {
					'companyID' : '1', 
					'email' : '', 
					'password' : '', 
					'cpassword' : '', 
					'name' : '', 
					'type' : 'personal', 
					'title' : 'Mr.', 
					'phone1' : '', 
					'phone2' : '', 
					'phone3' : '', 
					'news' : true, 
					'balance' : '0',
					'terms' : false
				}
				$scope.error = {
					'email' : null, 
					'password' : null, 
					'cpassword' : null, 
					'name' : null, 
					'type' : null, 
					'title' : null, 
					'phone1' : null, 
					'phone2' : null, 
					'phone3' : null, 
					'terms' : null
				}
			}


			$scope.setMessage = function($text, $type, $loading=false){
					$scope.alertmessage = $text;
					$scope.alerttype = $type;
					$scope.alertshow = true;
					$scope.alertpulse = $loading;
			}

			$scope.alertshow = false;
			$scope.clearAllData.call();
			$scope.setNews = function(value){
				if (value) $scope.customerData.news = 1;
				else $scope.customerData.news = 0;
			}

			$scope.validatelocal = function(){

				$return_value = true;

				//EMAIL
				if($scope.customerData.email != null)
					if($scope.customerData.email.length==0){
						$scope.error.email = "Anda belum memasukkan 'Email' Anda.";
						$return_value = false;
					}else if(!$scope.validateEmail($scope.customerData.email)){
						$scope.error.email = "'Email' yang dimasukkan tidak benar.";
						$return_value = false;
					}else{
						$scope.error.email = null;
					}

				if($scope.customerData.password!=null)
					if($scope.customerData.password.length==0){
						$scope.error.password = "Anda belum memasukkan 'Password' Anda.";
						$return_value = false;
					}else if($scope.customerData.password.length<6){
						$scope.error.password = "Minimal 6 karakter untuk 'Password'.";
						$return_value = false;
					}else{
						$scope.error.password = null;
					}

				if($scope.customerData.cpassword!=null)
					if($scope.customerData.cpassword.length==0){
						$scope.error.cpassword = "Anda belum memasukkan 'Konfirmasi Password' Anda.";
						$return_value = false;
					}else if($scope.customerData.cpassword!=$scope.customerData.password){
						$scope.error.cpassword = "'Konfirmasi Password' harus sama dengan 'Password' Anda.";
						$return_value = false;
					}else{
						$scope.error.cpassword = null;
					}

				if($scope.customerData.name!=null)
					if($scope.customerData.name.length==0){
						$scope.error.name = "Anda belum memasukkan 'Nama Lengkap' Anda.";
						$return_value = false;
					}else if($scope.customerData.name.length<3){
						$scope.error.name = "'Nama' Anda terlalu singkat, mohon masukkan 'Nama Lengkap' Anda.";
						$return_value = false;
					}else{
						$scope.error.name = null;
					}

				if($scope.customerData.phone1!=null)
					if($scope.customerData.phone1.length==0){
						$scope.error.phone1 = "Anda belum memasukkan 'Nomor HP' Anda.";
						$return_value = false;
					}else if($scope.customerData.phone1.length<6){
						$scope.error.phone1 = "'Nomor Telepon' Anda terlalu singkat.";
						$return_value = false;
					}else if(!$scope.isNum($scope.customerData.phone1)){
						$scope.error.phone1 = "'Nomor Telepon' Anda masukkan harus angka.";
						$return_value = false;
					}else{
						$scope.error.phone1 = null;
					}

				if($scope.customerData.phone2!=null)
					if($scope.customerData.phone2.length>0 && $scope.customerData.phone2.length<6){
						$scope.error.phone2 = "'Nomor Telepon' Anda terlalu singkat.";
						$return_value = false;
					}else if(!$scope.isNum($scope.customerData.phone2)){
						$scope.error.phone2 = "'Nomor Telepon' Anda masukkan harus angka.";
						$return_value = false;
					}else{
						$scope.error.phone2 = null;
					}

				if($scope.customerData.phone3!=null)
					if($scope.customerData.phone3.length>0 && $scope.customerData.phone3.length<6){
						$scope.error.phone3 = "'Nomor Telepon' Anda terlalu singkat.";
						$return_value = false;
					}else if(!$scope.isNum($scope.customerData.phone3)){
						$scope.error.phone3 = "'Nomor Telepon' Anda masukkan harus angka.";
						$return_value = false;
					}else{
						$scope.error.phone3 = null;
					}

				if(!$scope.customerData.terms){
					$scope.error.terms = "Anda harus menyetujui 'Syarat & Ketentuan' yang berlaku.";
					$return_value = false;
				}else{
					$scope.error.terms = null;
				}

				$scope.alertshow = true;

				return $return_value;
			}

			$scope.signupClicked = function($link){
				$scope.setMessage('Loading..', 
					"alert-info", true);

				// REGISTER

				if ($scope.validatelocal()) {

					$http(
						{
							method : 'POST',
							url : API_URL + 'register',
							data : $scope.customerData
						}
					).then(
						function(response) {
							if(response.data != null){
								if(response.data.code==1)
								{
									$scope.setMessage(response.data.message, 'alert-danger', false);
									$window.location.href=BASE_URL+'login';
								}
								else if(response.data.code==0)
								{
									//EMAILNY DUPLICATED
									$scope.setMessage(response.data.message, 'alert-danger', false);
								}
							}else{
								$scope.setMessage("ERROR IN RESULT..", 'alert-danger', false);
							}
						},function(error){
							$scope.setMessage("ERROR IN REQUEST: "+error.exception, 'alert-danger', false);
						}
					);
				} else {
					$scope.alertshow = false;
				}
				
			}

			$scope.setNextUrl = function($url)
			{
				$scope.nextUrl = $url;
			}

		}
	]);
}