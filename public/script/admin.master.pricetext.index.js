module.exports = function(app){
	app.controller('AdmPricetextController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $window){
			$scope.customer = null;
			$scope.errormessage = "";

			$scope.initProfile = function($customer)
			{
				$scope.customer = JSON.parse($customer);
				if($scope.customer.phone1==null)
					$scope.customer.phone1 = "";
				if($scope.customer.phone2==null)
					$scope.customer.phone2 = "";
				if($scope.customer.phone3==null)
					$scope.customer.phone3 = "";
				$scope.customer.news = $scope.customer.news==1?true:false;
				$scope.validate();
			}

			$scope.validate = function(){
				$scope.error = [];
				if($scope.customer.name==null){
					$scope.error.name = "TERJADI ERROR";
				}else if($scope.customer.name.length < 10){
					$scope.error.name = "Nama Anda kurang spesifik (min. 10 karakter)";
				}else if($scope.customer.name.length > 64){
					$scope.error.name = "Nama Anda terlalu panjang, mohon di singkat (max. 64 karakter)";
				}else{
					$scope.error.name = "";
				}

				if($scope.customer.email == null){
					$scope.error.email = "TERJADI ERROR";
				}else if(!$scope.validateEmail($scope.customer.email)){
					$scope.error.email = "Email yang Anda masukkan salah!";
				}else if($scope.customer.email.length>64){
					$scope.error.email = "Email terlalu panjang.";
				}else{
					$scope.error.email = "";
				}

				if($scope.customer.phone1 == null){
					$scope.error.phone1 = "TERJADI ERROR";
				}else if(isNaN($scope.customer.phone1)){
					$scope.error.phone1 = "Nomor telp harus berupa angka.";
				}else{
					$scope.error.phone1 = "";
				}

				if($scope.customer.phone2 == null){
					$scope.error.phone2 = "TERJADI ERROR";
				}else if(isNaN($scope.customer.phone2)){
					$scope.error.phone2 = "Nomor telp harus berupa angka.";
				}else{
					$scope.error.phone2 = "";
				}

				if($scope.customer.phone3 == null){
					$scope.error.phone3 = "TERJADI ERROR";
				}else if(isNaN($scope.customer.phone3)){
					$scope.error.phone3 = "Nomor telp harus berupa angka.";
				}else{
					$scope.error.phone3 = "";
				}
			}
			$scope.apiInitCustomer = function($customer)
			{
				$scope.customer = $customer;
				$scope.customer.news = $scope.customer.news==1?true:false;
			}

			$scope.initCustomer = function($customer){
				$scope.customer = JSON.parse($customer);
			}

			$scope.changeProfile = function()
			{
				$scope.customer.news = $scope.customer.news==true?1:0;
				$http
					(
						{
							method: 	"POST",
							url: 		AJAX_URL+"profile/update/"+$scope.customer.id,
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
				if ($scope.customer == null) {
					$scope.errormessage = "Isi Password Anda";
				} else if ($scope.customer.password == null) {
					$scope.errormessage = "Isi Password Anda";
				} else if ($scope.customer.password.length == 0) {
					$scope.errormessage = "Isi Password Anda";
				} else if ($scope.customer.newpass == null) {
					$scope.errormessage = "Password Baru harus diisi";
				} else if ($scope.customer.newpass.length == 0) {
					$scope.errormessage = "Password Baru harus diisi";
				} else if ($scope.customer.cnewpass != $scope.customer.newpass) {
					$scope.errormessage = "Harap isi Konfirmasi Password sama dengan Password Baru";
				} else {
					$http
						(
							{
								method: "POST",
								url: AJAX_URL+"chpass/update/"+$scope.customer.id,
								data: $scope.customer
							}
						)
					.then(
						function(response){
							if(response.data.status=="success")
							{
								//console.log(response);
								$window.location.href=BASE_URL+'profile';
							}
							else if(response.data.status=="error")
								$scope.errormessage = response.data.data;
						}
						,function(error){
							console.log(error);
							$scope.errormessage = "link error, hubungi Customer Service";
						}
					)
				}
			}
			$scope.deleteAddress = function($item, $index){
				$scope.selecteditem = {
					'index' : $index,
					'id' : $item.id,
					'name' : $item.address.name
				};
				$('#confirmationdelete').modal("show");
			}

			$scope.fillCities();

			$scope.deleteConfirmation = function($id){
				$scope.id = $id;
				$http
					(
						{
							method: "POST",
							url: API_URL+"profile/delete/"+$scope.id,
							data: $scope.id		
						}
					).then(
						function(response){
							if(response.data != null){
								if(response.data.constructor === String)	{
									if(response.data == "success"){
										$scope.customer.customeraddress.splice($scope.selecteditem.index,1);
									}
								}
							}
						}
						,function(error){
							$scope.errors = error.data;
						}
					)
				$('#confirmationdelete').modal("hide");
			}
			$scope.createAddress = function(){
				$('#createnewaddress').modal("show");
			}
			$scope.setCustomerID = function($customerID){
				$scope.customerID = $customerID;
			}
			$scope.saveNewAddress = function(){
				$http({
					method: "POST",
					url: API_URL+"custadds/store/"+$scope.customerID,
					data: $scope.newaddress
				}).then(function(response){
					if(response.data != null){
						if(Array.isArray(response.data)){
							$scope.customer.customeraddress = response.data;
							$scope.newaddress = [];
							$('#createnewaddress').modal('hide');
						}
					}
				}, function(error){
					$scope.newaddresserror = 'error dari server';
				});
			}
			$scope.deleteAddrCompany = function($item, $index){
				$scope.selecteditem = {
					'index' : $index,
					'id' : $item.id,
					'address' : $item.address
				};
				$('#confaddressdelete').modal("show");
			}
			$scope.deleteConfAddrCompany = function($id){
				console.log($id);
				$scope.id = $id;
				$http
					(
						{
							method: "POST",
							url: API_URL+"profile/deletecompany/"+$scope.id,
							data: $scope.id		
						}
					).then(
						function(response){
							if(response.data != null){
								if(response.data.constructor === String)	{
									if(response.data == "success"){
										$scope.customer.company.companyaddress.splice($scope.selecteditem.index,1);
									}
								}
							}
						}
						,function(error){
							$scope.errors = error.data;
						}
					)
			}
			$scope.createAddressCompany = function(){
				$('#createnewaddrcompany').modal("show");
			}
			$scope.saveNewAddrCompany = function(){
				console.log($scope.newaddresscomp);
				$http({
					method: "POST",
					url: API_URL+"profile/strcompanyaddr/"+$scope.customerID,
					data: $scope.newaddresscomp
				}).then(function(response){
					if(response.data != null){
						if(Array.isArray(response.data)){
							$scope.customer.company.companyaddress = response.data;
							$scope.newaddress = [];
							$('#createnewaddrcompany').modal("hide");
						}
					}
				}, function(error){
					$scope.newaddresserror = 'error dari server';
				});
			}
		}
	]);
};