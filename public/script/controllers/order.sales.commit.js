module.exports = function(app){
	app.controller('SalesCommitController', ['$scope', '$http', 'API_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, BASE_URL, $window){

			$scope.initData = function($datas){
				$scope.salesdetail = JSON.parse($datas);
				$scope.salesdetail.created_at = $scope.makeDateTime($scope.salesdetail.created_at);
				$scope.salesdetail.cartheader.created_at = $scope.makeDateTime($scope.salesdetail.cartheader.created_at);
				$.each($scope.salesdetail.cartheader.cartfile, function($index, $item){
					$item.created_at = $scope.makeDateTime($item.created_at);
					$.each($item.file, function($index2, $item2){
						$item2.created_at = $scope.makeDateTime($item2.created_at);
					});
				});
				$.each($scope.salesdetail.cartheader.cartpreview, function($index, $item){
					$item.waiting = false;
					$item.created_at = $scope.makeDateTime($item.created_at);
					$.each($item.file, function($index2, $item2){
						$item2.created_at = $scope.makeDateTime($item2.created_at);
					});
				});
			}

			$scope.acceptFile = function($item){
				$item.waiting = true;
				if($item.waiting)
				{
					$http({
						method: "POST",
						url: API_URL+"commit/cartpreview/"+$item.id+"/accept"
					}).then(function(response){
						if(response.data!=null){
							if(response.data.constructor === String){
								if(response.data == 'success'){
									$item.commit = 1;
								}
							}
						}
						if($item.commit == 0){
							$window.location.reload();
						}
						$item.waiting = false;
					}, function(error){
						$window.location.reload();
						$item.waiting = false;
					});
				}
			}


			$scope.rejectFile = function($item){
				$item.waiting = true;
				if($item.waiting)
				{
					$http({
						method: "POST",
						url: API_URL+"commit/cartpreview/"+$item.id+"/reject"
					}).then(function(response){
						if(response.data!=null){
							if(response.data.constructor === String){
								if(response.data == 'success'){
									$item.commit = -1;
								}
							}
						}
						if($item.commit == 0){
							$window.location.reload();
						}
						$item.waiting = false;
					}, function(error){
						$window.location.reload();
						$item.waiting = false;
					});
				}
			}

			$scope.canbecommit = function(){
				$ready = true;
				$.each($scope.salesdetail.cartheader.cartpreview, function($index, $item){
					if($item.commit != 1)
						$ready = false;
				});
				return $ready;
			}

			$scope.commit = function(){
				$scope.commitloading = true;
				if($scope.commitloading)
				{
					$http({
						method: "POST",
						url: API_URL+"commit/salesdetail/"+$scope.salesdetail.id
					}).then(function(response){
						if(response.data!=null){
						if(response.data.constructor === String){
								if(response.data == 'success'){
									$scope.salesdetail.commited = 1;
								}
							}
						}
						if($scope.salesdetail.commited == 0){
							$window.location.reload();
						}
						$scope.commitloading = false;
					}, function(error){
						$window.location.reload();
						$scope.commitloading = false;
					});
				}
			}

			$scope.undocommit = function(){
				$scope.commitloading = true;
				if($scope.commitloading)
				{
					$http({
						method: "POST",
						url: API_URL+"commit/salesdetail/"+$scope.salesdetail.id+"/undo"
					}).then(function(response){
						if(response.data!=null){
							if(response.data.constructor === String){
								if(response.data == 'success'){
									$scope.salesdetail.commited = 0;
								}
							}
						}
						if($scope.salesdetail.commited == 1){
							$window.location.reload();
						}
						$scope.commitloading = false;
					}, function(error){
						$window.location.reload();
						$scope.commitloading = false;
					});
				}
			}

			$scope.undoFile = function($item){
				$item.waiting = true;
				if($item.waiting)
				{
					$http({
						method: "POST",
						url: API_URL+"commit/cartpreview/"+$item.id+"/undo"
					}).then(function(response){
						if(response.data!=null){
							if(response.data.constructor === String){
								if(response.data == 'success'){
									$item.commit = 0;
								}
							}
						}
						if($item.commit == 1 || $item.commit == -1){
							$window.location.reload();
						}
						$item.waiting = false;
					}, function(error){
						$window.location.reload();
						$item.waiting = false;
					});
				}
			}

			$scope.preview = function($name, $url){
				$scope.filename = $name;
				$("#previewfile").attr('src', BASE_URL+$url);
				$('#previewfileModal').modal('show');
			}

		}
	]);
}