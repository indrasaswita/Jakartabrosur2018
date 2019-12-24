module.exports = function(app){
	app.controller('AdmSalesmanualpaymentController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $window){
			$scope.errormessage = "";

			$scope.setbank = function($alias){
				$.each($scope.banks, function($i, $ii){
					if($ii.alias == $alias){
						$scope.selectedbank = $ii;
						setTimeout(function(){ $(".selectpicker").selectpicker('refresh'); }, 50);
					}
				});
			}

			$scope.submitnewcustacc = function(){
				if($scope.selectedbank==null){
					$scope.errormessage = "Tidak ada bank yang dipilih";
				}else if($scope.selectedaccname==null){
					$scope.errormessage = "Isi Nama Pemilik Akun";
				}else if($scope.selectedaccname.length<3){
					$scope.errormessage = "Isi Nama Pemilik Akun DENGAN BENAR";
				}else if($scope.selectedaccname.length>50){
					$scope.errormessage = "Isi Nama Pemilik Akun DENGAN BENAR";
				}else{
					$http({
						method: "POST",
						url: AJAX_URL+"custaccs/store",
						data: {
							"bankID": $scope.selectedbank.id,
							"accname": $scope.selectedaccname,
							"accno": $scope.selectedaccno==null?"":$scope.selectedaccno,
							"acclocation": '',
							"custID": $scope.selectedheader.customer.id
						}
					}).then(function(response){
						if(response.data!=null){
							if(Array.isArray(response.data)){
								$scope.customerbankaccs = response.data;
								setTimeout(function(){ $(".selectpicker").selectpicker('refresh'); }, 50);
								console.log($scope.customerbankaccs);

								$.each($scope.customerbankaccs, function($i, $ii){
									if($ii.accname == $scope.selectedaccname
											&& $ii.bankID == $scope.selectedbank.id){
										$scope.selectedcustacc = $ii;
									}
								});
							}else{
								$scope.errormessage = "RETURN SALAH BENTUK.";
							}
						}else{
							$scope.errormessage = "GAGAL SAVE ACC";
						}
					}, function(error){
						console.log(error);
						$scope.errormessage = "ERROR saat SAVE custACC";
					});
				}
			}

			$scope.submitManualPayment = function(){
				if($scope.selectedammount == null){
					console.log('tidak boleh 0');
				}else if($scope.selectedammount < 10000){
					console.log('tidak boleh 0');
				}else if($scope.selectedheader.id==null){
					console.log("salesID is null");
				}else if($scope.selectedcustacc==null){
					console.log("Akun bank customer masih kosong");
				}else
				{
					$http({
						"method" 	: "POST",
						"url" 		: AJAX_URL+"admin/payment/"+$scope.selectedheader.id,
						"data"		: {
							"ammount" : $scope.selectedammount,
							"custacc"	: $scope.selectedcustacc.id,
							"paydate"	: $scope.selectedpaydate.getDateOnly(),
							'compacc' : $scope.selectedcompacc.id
						}
					}).then(function(response){
						if(response.data != null)
							if(typeof response.data === 'string')
							{
								if (response.data == "success")
								{
									$dt = new Date();
									
									$arr = {
										'paydate' : $scope.selectedpaydate.getDateOnly(),
										'veriftime' : $dt.getDateOnly(),
										'ammount' : $scope.selectedammount
									}

									$scope.headers[$selectedindex].payments.push($arr);
									$totalpayment = 0;
									$.each($scope.headers[$selectedindex].payments, function($index, $item){
										$totalpayment += $item.ammount;
									});
									$scope.headers[$selectedindex].totalpayment = $totalpayment;
									$scope.selectedheader = $scope.clone($scope.headers[$selectedindex]);
								}
							}
					},function(error){});
				}
			}
		}
	]);
}