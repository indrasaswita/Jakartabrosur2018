module.exports = function(app){
	app.controller('HomePageController', ['$scope', '$http', 'API_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, BASE_URL, $window){
			$scope.customers = [];

			$scope.initData = function($customers){
				$scope.customers = JSON.parse($customers);

				$.each($scope.customers, function($index, $item) {
					$scope.customers[$index].updated_at = $scope.makeDateTime($item.updated_at);
					$scope.customers[$index].created_at = $scope.makeDateTime($item.created_at);
				});	

				if($scope.customers!=null)
					$scope.getActiveCustomer();
			}
			

			$scope.getActiveCustomer = function(){
				$scope.totalloggedweek = 0;
				$scope.totalsignedweek = 0;
				$today = new Date();
				$.each($scope.customers, function($index, $item) {
					if($item.created_at!=null){
						
						if ($scope.DateDiff.inWeeks($item.created_at, $today)<7){
							$scope.totalsignedweek++;

						}
					}
					if ($item.updated_at != null) {

						if ($scope.DateDiff.inWeeks($item.updated_at, $today) < 7) {
							$scope.totalloggedweek++;

						}
					}
				});	
			}

			$scope.printImg = function(imgName) {
				var printContents = document.getElementById(imgName);
				var popupWin = window.open();
				popupWin.document.open()
				popupWin.document.write('<html><head><link rel="stylesheet" type="text/css" href="style.css" /></head><body onload="window.print()">'
					+ '<div> HELLOWORLD'
					+ '</div>'
					+ '</html>');
				popupWin.document.close();
			}
		}
	]);
};