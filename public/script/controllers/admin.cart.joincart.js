module.exports = function(app){
	app.controller('AdmJoincartController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $window){
			$scope.carts = null;
			$scope.joincartwaiting = false;
			$scope.joincarterror = "";
			$scope.changecustomererror = "";

			$scope.initData = function($datas){
				$scope.carts = JSON.parse($datas);
				//$scope.getcustomers();
				$.each($scope.carts, function($index, $item){
					//$item.enable = true;
					$item.selected = false;
					$item.created_at = $scope.makeDateTime($item.created_at);
					$item.updated_at = $scope.makeDateTime($item.updated_at);
				});
			}

			$scope.splitcustomer = function($index, $customerID){

				if($index != $scope.carts.length - 1){
					if($scope.carts[$index+1].customerID == $customerID){
						return false;
					}else{
						return true;
					}
				}else{
					return true;
				}
			}

			$scope.selectAllbyCust = function($customerID){
				$.each($scope.carts, function($index, $item){
					if($item.customerID == $customerID){
						//$item.enable = true;
						$item.selected = true;
					}else{
						//$item.enable = false;
						$item.selected = false;
					}
				});	
			}

			$scope.setOtherDisabled = function($customerID, $selectedCart){
				console.log($selectedCart.selected);

				$.each($scope.carts, function($index, $item){
					if($item.customerID != $customerID){
						//disabled
						//$item.enable = false;
						$item.selected = false;
					}else{
						//$item.enable = true;
					}
				});	

			}

			$scope.getcustomers = function($customerID, whendone, whenfailed){
				$http({
					method: "GET",
					url: AJAX_URL+"customers"
				}).then(function(response){
					if(response.data!=null)
					{
						if(response.data.constructor === Array)
						{
							$scope.customers = response.data;

							if(whendone instanceof Function){
								whendone();
							}
						}else{
							if(whenfailed instanceof Function)
								whenfailed();
						}
					}else{
						if(whenfailed instanceof Function)
							whenfailed();
					}
				}, function(error){
					if(whenfailed instanceof Function){
						whenfailed();
					}
				});
			}

			$scope.dochange = function($customer){
				if($scope.selectedcarts == null){
					$scope.changecustomererror = "Error: selectedcarts = null";
				}else{
					$count = 0;
					$.each($scope.selectedcarts, function($i, $ii){
						if($ii.selected)
							$count ++;
					});

					if($count == 0){
						$scope.changecustomererror = "Belum ada yang dipilih";
					}else{
						$.each($scope.selectedcarts, function($i, $ii){

							if($ii.selected){
								$http({
									method: "POST",
									url: AJAX_URL+"admin/cart/"+$ii.id+"/changecustomer/"+$customer.id
								}).then(function(response){
									if(response.data!=null)
									{
										if(response.data.constructor === Array){
											$scope.carts = response.data;
											$('#modal-changecustomer').modal('hide');
										}else{
											$scope.changecustomererror = "Result is not an Array.";
										}
									}else{
										$scope.changecustomererror = "Result was null.";
									}
								}, function(error){
									$scope.changecustomererror = "Something wrong. Check console";
									console.log("This is error, from "+AJAX_URL+"admin/cart/"+$ii.id+"/changecustomer/"+$customer.id);
									console.log(error);
								});
							}
						});
						
					}
				}
			}

			$scope.changecustomermodal = function($customerID){
				if($scope.joincartwaiting == false){
					$scope.joincartwaiting = true;
					$scope.getcustomers($customerID, function(){
						//WHEN DONE
						$scope.selectedcarts = [];
						$.each($scope.carts, function($i, $ii){
							if($ii.customerID == $customerID){
								$ii.selected = false;
								$scope.selectedcarts.push($ii);
							}
						});

						//select index = $customerID
						$.each($scope.customers, function($i, $ii){
							if($ii.id == $customerID){
								$scope.selectedcustomer = $ii;
							}
						});

						$("#modal-changecustomer").modal('show');


						$scope.joincartwaiting = false;
					}, function(){
						//WHEN FAILED
						$scope.joincartwaiting = false;
					});
				}
			}

			$scope.checkout = function($customerID){
				$count = 0;
				$.each($scope.carts, function($index, $item){
					if($item.customerID == $customerID
							&& $item.selected == true){
						$count++;
					}
				});

				if($count == 0){
					//belom ada yang di selected
					//send error message
					console.log("NO ONE SELECTED");
				}else{
					//checkout here
					$allselected = [];
					$.each($scope.carts, function($index, $item){
						if($item.selected)
							$allselected.push($item);
					});

					if($scope.joincartwaiting == false){
						$scope.joincartwaiting = true;
						$http({
							method: "POST",
							url: AJAX_URL+"admin/cart/checkout",
							data: $allselected
						}).then(function(response){
							if(response.data!=null)
							{
								if(response.data.constructor === String)
								{
									$window.location.href=BASE_URL+"admin/allsales?id="+response.data;
								}
							}else{
								console.log("return null");
								$scope.joincartwaiting = false;
							}
						}, function(error){
							$scope.joincartwaiting = false;
						});
					}
				}
			}

		}
	]);
}