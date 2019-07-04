module.exports = function(app) {
	app.controller('AdmChangetheworldController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window) {
			$scope.datas = [];
			$scope.details = [];
			$scope.keys = [];
			$scope.values = [];

			$scope.initData = function($input){
				$scope.datas = JSON.parse($input);
			}

			$scope.requestTable = function($table){
				$http({
					method: "GET",
					url: AJAX_URL+"admin/ctw/getbytablename/"+$table
				}).then(function(response){
					if(response!=null){
						if(response.data != null){
							if(typeof response.data == "string"){
								//error
								console.log(response.data);
							}else{
								$scope.details = response.data;

								$scope.value = [];
								$.each($scope.details, function($index, $item){
									if($index == 0){
										$scope.keys = [];
									}
									$temp = [];
									for(var key in $item){
										if($index == 0){
											$scope.keys.push(key);
										}
										$temp.push($item[key]);
									}
									$scope.values.push($temp);
								});
							}
						}else{
							console.log("The return value is null, not error");
						}
					}
				}, function(error){
					console.log(error);
				});
			}

		}
	]);
};