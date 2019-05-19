module.exports = function(app){
	app.controller('AdmPricetextController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $window){

			$scope.pricetexts = null;
			$scope.selectedidx = 0;

			$scope.initData = function($datas){
				$scope.pricetexts = JSON.parse($datas);
				$.each($scope.pricetexts, function($index, $item){
					if($item.pricetext != null){
						$scope.pricetexts[$index].pricetext = $scope.trustAsHtml($item.pricetext);

						$scope.pricetexts[$index].pricetextwa = $scope.stripTagsWA($item.pricetext);
					}
					console.log($item.employee);
				});
			}

			$scope.setActiveindex = function(){
				$.each($scope.pricetexts, function($index, $item) {
					if ($index == $scope.selectedidx) {
						$scope.pricetexts[$index].active = true;
					} else {
						$scope.pricetexts[$index].active = false;
					}
				});
			}

			$scope.nextbtnclicked = function(){
				if($scope.selectedidx<$scope.pricetexts.length-1)
					$scope.selectedidx++;
			}

			$scope.prevbtnclicked = function() {
				if ($scope.selectedidx > 0)
					$scope.selectedidx--;
			}
		}
	]);
};