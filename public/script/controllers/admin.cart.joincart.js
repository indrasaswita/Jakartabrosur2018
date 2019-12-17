module.exports = function(app){
	app.controller('AdmJoincartController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $window){
			$scope.carts = null;

			$scope.initData = function($datas){
				$scope.carts = JSON.parse($datas);
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
						}
					});
				}
			}

		}
	]);
}