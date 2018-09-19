module.exports = function(app){
	app.controller('AdmCustomerController', ['$scope', '$http', 'API_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, BASE_URL, $window){
			$scope.initData = function($datas){
				$scope.customers = JSON.parse($datas);
				$.each($scope.customers, function($index, $item){
					$item.created_at = $scope.makeDateTime($item.created_at);
					$item.totalbelanja = 0;
					$.each($item.salesheader, function($index2, $item2){
						$item2.created_at = $scope.makeDateTime($item2.created_at);
						$.each($item2.salesdetail, function($index3, $item3){
							$item.totalbelanja += $item3.cartheader.printprice - $item3.cartheader.discount;
						});
					});
				});
			}

			$scope.hideAll = function(){
				$.each($scope.customers, function($index, $item){
					$item.showdetail = false;
					$item.showpurchase = false;
					$item.showeditpanel = false;
				});
			}

			$scope.showdetailclicked = function($item){
				$flag = false;
				if(!$item.showdetail)
					$flag = true;
				$scope.hideAll();
				if($flag)
					$item.showdetail = true;
			}

			$scope.showpurchaseclicked = function($item){
				$flag = false;
				if(!$item.showpurchase)
					$flag = true;
				$scope.hideAll();
				if($flag)
					$item.showpurchase = true;
			}

			$scope.showeditpanelclicked = function($item){
				$flag = false;
				if(!$item.showeditpanel)
					$flag = true;
				$scope.hideAll();
				if($flag)
					$item.showeditpanel = true;
			}
		}
	]);
}