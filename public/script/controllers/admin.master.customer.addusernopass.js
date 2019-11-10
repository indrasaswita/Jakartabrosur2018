module.exports = function(app){
	app.controller('AddUserNoPassController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $window){

			$scope.clearNewitem = function(){
				$scope.newitem = {
					"name": "",
					"phone1": "",
					"phone2": "",
					"phone3": "",
					"title": "Mr.",
					"type": "personal",
					"companyID": "1"
				};
			}

			$scope.initData = function($customers, $companies){
				$scope.customers = JSON.parse($customers);
				$scope.companies = JSON.parse($companies);
				$.each($scope.customers, function($index, $item){
					$item.created_at = $scope.makeDateTime($item.created_at);
					$item.updated_at = $scope.makeDateTime($item.updated_at);
				});

				$scope.resetmail();
			}

			$scope.resetmail = function(){
					$('input.email').prop('disabled', false);
					$('.addusernopass').removeClass('found');
					$('#checkmail').show();
					$('#resetmail').hide();
					$('input.email').focus();
					$scope.emailerror = null;
					$scope.activemail = "";
					//$scope.activemail = "indrasaswitaa@gmail.com";
					$scope.found = null;
			}

			$scope.getNameFromMail = function(str) {
				var frags = str.split('.');
				for (i=0; i<frags.length; i++) {
					frags[i] = frags[i].charAt(0).toUpperCase() + frags[i].slice(1);
				}
				return frags.join(' ');
			}

			$scope.checkemail = function(){
				$scope.clearNewitem();

				if($scope.activemail.length==0){
					$scope.emailerror = "Isi email Customer yang mau ditambahin.";
					$('input.email').focus();
				}else{
					$scope.found = null;
					$.each($scope.customers, function($i, $ii){
						if($ii.email == $scope.activemail){
							$scope.found = $ii;
						}
					});

					if($scope.found == null){
						//found (ALWAYS ONLY ONE)
						//1. set nama orangnya dari email (. jadi spasi, Huruf depan huruf gede)

						$scope.newitem.name = $scope.getNameFromMail($scope.activemail.substring(0, $scope.activemail.indexOf('@')));
					}

					if($scope.validateEmail($scope.activemail)){
						$scope.emailerror = "";
						//EDIT and show dong
						$('.addusernopass').addClass('found');
						$('input.email').attr('disabled', 'disabled');
						$('#checkmail').hide();
						$('#resetmail').show();
					}else{
						$scope.emailerror = "Email yang dimasukkan salah, silahkan masukan email yang benar.";
						$('input.email').focus();
					}
				} 
			}

			$scope.saveusernopass = function(){
				$scope.newitem.email = $scope.activemail;

				$http({
					method: "POST",
					url: AJAX_URL+"master/customer/saveusernopass",
					data: $scope.newitem
				}).then(function(response){
					if(response.data!=null)
					{
						if(response.data){
							//success
							$temp = $scope.activemail;
							$scope.resetmail();
							$scope.activemail = $temp;
							$scope.emailerror = "Success updated";
						} else {
							//not success
							$scope.emailerror = "Not Success";
						}
					} else {
						//not success
						$scope.emailerror = "Not Success";
					}
				});
			}

			$scope.updateusernopass = function(){
				$http({
					method: "POST",
					url: AJAX_URL+"master/customer/updateusernopass",
					data: $scope.found
				}).then(function(response){
					if(response.data!=null)
					{
						if(response.data){
							//success
							$temp = $scope.activemail;
							$scope.resetmail();
							$scope.activemail = $temp;
							$scope.emailerror = "Success updated";
						} else {
							//not success
							$scope.emailerror = "Not Success";
						}
					} else {
						//not success
						$scope.emailerror = "Not Success";
					}
				});
			}

		}
	]);
}