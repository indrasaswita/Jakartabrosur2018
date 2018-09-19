module.exports = function(app){
	app.controller('TrackingController', ['$scope', '$http', 'API_URL', 
		function($scope, $http, API_URL){
			$scope.URL = 'http://localhost:8000/';
			$scope.cartfileShow = false;

			$scope.initData = function($input){
				$scope.carts = JSON.parse($input);
				for($i = 0; $i < $scope.carts.length; $i++)
				{
					$scope.carts[$i].process = "Error!"
					if ($scope.carts[$i].statusfile == 1) $scope.carts[$i].process = "File Sudah Ok!";
					if ($scope.carts[$i].statusctp == 1) $scope.carts[$i].process = "Kami siap mencetak";
					if ($scope.carts[$i].statusprint == 1) $scope.carts[$i].process = "Kami selesai mencetak";
					if ($scope.carts[$i].statuspacking == 1) $scope.carts[$i].process = "Pesanan sudah dipersiapkan";
					if ($scope.carts[$i].statusdelivery == 1) $scope.carts[$i].process = "Kami sedang melakukan pengiriman";
					if ($scope.carts[$i].statusdone == 1) $scope.carts[$i].process = "Pesanan selesai!";
				}
			}

			$scope.getPcImage = function($name, $value){
				if ($value == 1) $status = "ok";
				else $status = "no"
				return "image/pc-"+$name+"-"+$status+".png";
			}

			$scope.getFilesData = function($cartdetailID)
			{
				$scope.cartdetailID = $cartdetailID;
				$http(
					{
						method : 'GET',
						url : API_URL + 'cartfiles/'+ $cartdetailID
					}
				).then(function(response) {
					$scope.cartfiles = response.data;
					$scope.cartfileShow = true;
				});
			}
			//$scope.getFilesData(1);
		}
	]);
};