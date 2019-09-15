module.exports = function(app) {
	app.controller('SubnavigationController', ['$timeout', '$scope', '$http', 'API_URL', 'BASE_URL', 'AJAX_URL', '$window',
		function($timeout, $scope, $http, API_URL, BASE_URL, AJAX_URL, $window) {
			
			$scope.subnavs = [
				{
					link: BASE_URL + 'orderlistcustomer',
					route: ['orderlistcustomer'],
					label: 'Order List',
					glyphicon: 'fa-th',
					login: 'false'
				},
				{
					link: BASE_URL + 'orderlistcustomer',
					route: ['shop', 'shop/{pages}'],
					label: 'Selection',
					glyphicon: 'fa-analytics',
					login: 'false'
				},
				{
					link: BASE_URL + 'cart',
					route: ['cart', 'cart/{cart}'],
					label: 'Keranjang Belanja',
					glyphicon: 'fa-shopping-basket',
					login: 'true'
				},
				{
					link: BASE_URL + 'sales/all',
					route: ['sales/all', 'payment', 'payment/{payment}', 'payment/confirm', 'payment/confirm/{id}', 'addresses', 'addresses/{addresses}', 'sales/cartheader/{cartid}'],
					label: 'Proses & Pembayaran',
					glyphicon: 'fa-shopping-bag',
					login: 'true'
				}
			];

			$scope.globalSubnav = function($current, $idlogin) {

				if($idlogin!=''){
					$.each($scope.subnavs, function($index, $item){
						$scope.subnavs[$index].login = 'false';
					});
				}

				$scope.subnavbefore = [];
				$scope.subnavafter = [];
				$scope.subnavcurrent = null;
				$after = false;
				$.each($scope.subnavs, function($index, $item) {
					if (!$scope.isInside($current, $item.route)) {
						if ($after == false) {
							$scope.subnavbefore.push($item);
						}
						else {
							$scope.subnavafter.push($item);
						}
					}
					else {
						$after = true;
						$scope.subnavcurrent = $item;
					}
				});
			}
			$scope.isInside = function($current, $arr) {
				$result = false;
				$.each($arr, function($index, $item) {
					//console.log($current +", "+ $item);
					if ($current == $item) {
						$result = true;
						return false;
					}
				});
				return $result;
			}
			//$scope.globalSubnav();

		}
	]);
}