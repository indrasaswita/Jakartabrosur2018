module.exports = function(app) {
	app.controller('NavHeaderController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window) {

			$scope.isOrder = function($input){
				if($input == 'orderlistcustomer')
					return true;
				else if($input.startsWith('shop/'))
					return true;
				else
					return false;
			}

			$scope.isCustTransaksi = function($input){
				if($input.startsWith('cart'))
					return true;
				else if($input.startsWith('sales/all'))
					return true;
				else
					return false;
			}

			$scope.isEmpMaster = function($input){
				if($input == "admin/master/pricepaper" ||
					$input == "admin/master/newpaper" ||
					$input == "admin/master/paperdetailstore" ||
					$input == "admin/master/finishings" ||
					$input == "admin/master/customer")
					return true;
				else
					return false;
			}

			$scope.isEmpTransaksi = function($input){
				if($input == "admin/allsales" ||
					$input == "admin/pricetext" ||
					$input == "admin/cart" ||
					$input == "admin/master/pendingcompany" ||
					$input == "admin/master/pendingcustomer")
					return true;
				else
					return false;
			}

			$scope.isEmpJobsubtype = function($input){
				if($input == "admin/master/shoppricing" ||
					$input == "admin/master/jobactivation" ||
					$input == "admin/master/jobeditor" ||
					$input == "admin/master/jobfinishingeditor" ||
					$input == "admin/master/jobsizeeditor" ||
					$input == "admin/master/jobpapereditor" ||
					$input == "admin/master/jobquantityeditor")
					return true;
				else
					return false;
			}

			$scope.isAccount = function($input){
				if($input == "notification" ||
					$input == "profile" ||
					$input == "chpass" ||
					$input.startsWith("login") ||
					$input == "signup")
					return true;
				else
					return false;
			}

		}
	]);
};