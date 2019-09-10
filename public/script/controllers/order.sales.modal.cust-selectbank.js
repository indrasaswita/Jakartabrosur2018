module.exports = function(app) {
	app.controller('OrdersalesSelectbankController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window) {

			var a = "BANK INDONESIA";
			var b = "AAA";
			console.log(a.findInside(b));

			$scope.banks = [];
			$scope.searchbankinput = "";

			$scope.fillbanks = function(whendone) {
				$http(
					{
						method: 'GET',
						url: API_URL + 'banks'
					}
				).then(function(response) {
					if (response.data != null) {
						if (response.data.length > 0) {
							$scope.banks = response.data;
							if (whendone instanceof Function) { whendone(); }
						}
					} else {
						console.log('Null return when calling banks - order.sales.modal.cust-selectbank')
					}
				}, function(error) {
					console.log("Error when calling banks - order.sales.modal.cust-selectbank");
				});
			};

			$scope.searchbank = function(){
				if ($scope.searchbankinput == "") {
					$.each($scope.banks, function($index, $item) {
						$item.show = true;
					});
				} else {
					$.each($scope.banks, function($index, $item){
						if ($item.alias.toLowerCase().findInside($scope.searchbankinput.toLowerCase())
							|| $item.bankname.toLowerCase().findInside($scope.searchbankinput.toLowerCase())) {
							$item.show = true;
						}else{
							$item.show = false;
						}
					});
				}
			}

			$scope.fillbanks(function(){
				$scope.searchbank();
			});

			$scope.setcustbankconf = function($bank){
				$scope.konfirmasi.newcustacc.bank = $scope.clone($bank);
				$("#ordersales-customer-selectbank").modal('hide');
			}

		}
	]);
};