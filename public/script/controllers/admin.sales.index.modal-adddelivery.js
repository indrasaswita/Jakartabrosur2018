module.exports = function(app){
	app.controller('AdmSalesadddeliveryController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $window){

			$scope.addnewaddress = false;
			$scope.newaddress = {
				"name": "",
				"address": "",
				"addressnotes": "",
				"cityID": ""
			};
			$scope.cityloading = false;
			$scope.customeraddressloading = false;

			$('#addDeliveryModal').on('shown.bs.modal', function () {
				setTimeout(function(){
					if($scope.headers[$scope.selectedheaderindex].salesdetail != null){
						if($scope.headers[$scope.selectedheaderindex].salesdetail.length > 0){
							//reset dulu, kosongin dulu yg di pilih
							$scope.newdelivery.deliverydetail = [];

							//UNTUK SELECT YANG INDEX 0 DOANG, karena index 0 dibuat false di awal
							$.each($scope.headers[$scope.selectedheaderindex].salesdetail, function($i, $ii){
								if($i == 0){
									$scope.setDeliverydetail($ii, true);
								}else{
									$scope.setDeliverydetail($ii, false);
								}
							});
						}
					}
				}, 1);
			});

			$scope.setDeliverydetail = function($detail, $init=null){
				if($init==null){
					if($detail.deliveryselected!=null){
						$detail.deliveryselected = !$detail.deliveryselected;
					}else{
						$detail.deliveryselected = true;
					}
				}else{
					$detail.deliveryselected = $init;
				}
				if($detail.deliveryselected==true)
				{
					//cek dulu uda ada ato belom
					$notfound = true;
					$.each($scope.newdelivery.deliverydetail, function($i, $ii){
						if($ii.salesdetailID == $detail.id)
						{
							$notfound = false;
						}
					});

					if($notfound == true){
						$temp = $scope.clone($detail);
						$scope.newdelivery.deliverydetail.push({
							"salesdetailID" : $temp.id,
							"deliveryshow" : false,
							"totalweight" : 0,
							"totalpackage" : 1,
							"ammount" : parseInt($temp.cartheader.quantitytypenameantity),
							"actualprice" : parseInt($temp.cartheader.deliveryprice),
							"totalquantity" : parseInt($temp.cartheader.quantity),
							"quantitytypename" : $temp.cartheader.quantitytypename,
							"jobtitle" : $temp.cartheader.jobsubtype.name + " " + $temp.cartheader.jobtitle
						});
					}
				}
				else
				{
					$.each($scope.newdelivery.deliverydetail, function($i, $ii){
						if($ii.salesdetailID == $detail.id){
							$scope.newdelivery.deliverydetail.splice($i, 1);
							return false;
						}
					});
				}
			}

			$scope.setadddeliverystatus = function($value){
				$scope.addnewaddress = $value;

				if($value){
					if($scope.cities == null){
						if(!$scope.cityloading){
							$scope.cityloading = true;
							$scope.fillCities(function(response){
								$scope.cityloading = false;
								$.each(response.data, function($i, $ii){
									if($ii.name == "Jakarta"){
										$scope.newaddress.city = $ii;
									}
								});
							}, function(error){
								$scope.cityloading = false;
							});
						}
					}
				}
			}

			$scope.insertcustomeraddress = function(){
				$customerID = $scope.headers[$scope.selectedheaderindex].customer.id;

				if(!$scope.customeraddressloading){
					$scope.customeraddressloading = true;
					$http({
						method: "POST",
						url: AJAX_URL+"custadds/store/"+$customerID,
						data: $scope.newaddress
					}).then(function(response){
						if(response.data!=null)
						{
							if(response.data instanceof Array)
							{
								$.each($scope.headers, function($i, $ii){
									if($ii.customerID == $customerID){
										$ii.customer.customeraddress = response.data;
									}
								});
								//tinggal select yang sudah di add
								//karena ascending, makanya di pilih yang paling akhir
								$scope.newdelivery.deliveryaddressID = response.data[response.data.length-1].addressID;

								$scope.addnewaddress = false;
							}else{
								console.log('response not array');
							}
						}else{
							console.log("no response, null");
						}
						$scope.customeraddressloading = false;
					}, function(error){
						console.log(error);
						$scope.customeraddressloading = false;
					});
				}
			}

			$scope.saveDelivery = function(){
				//DARI DIALOG BOX, MODAL
				
				$time = $scope.newdelivery.arrivedtime;
				$date = $scope.newdelivery.arriveddate;
				$scope.newdelivery.delivtime = $date.getFullYear()+"-"+$scope.zeroFill($date.getMonth(),2)+"-"+$scope.zeroFill($date.getDate(),2)+" "+$scope.zeroFill($time.getHours(),2)+":"+$scope.zeroFill($time.getMinutes(),2)+":"+$scope.zeroFill($time.getSeconds(),2);

				$http(
					{
						method: "POST",
						url   : AJAX_URL+"admin/sales/delivery/"+$scope.selectedheaderid+"/store",
						data  : $scope.newdelivery	
					}
				).then(function(response){
					if(typeof response.data === "string")
					{
						if(response.data == "success")
						{
							$window.location.href=BASE_URL+"admin/allsales";
						}
					}
				});
			}

		}
	]);
}