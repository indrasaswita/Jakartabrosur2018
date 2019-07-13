module.exports = function(app) {
	app.controller('AdmChangetheworldController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window) {
			$scope.datas = [];
			$scope.details = [];
			$scope.keys = [];
			$scope.values = [];
			$scope.messages = "";
			$scope.uploadloading = false;
			$scope.activetable = "";

			$scope.initData = function($input){
				$scope.datas = JSON.parse($input);
			}

			$scope.requestTable = function($table){
				$scope.activetable = $table;
				$http({
					method: "GET",
					url: AJAX_URL+"admin/ctw/getbytablename/"+$table
				}).then(function(response){
					$scope.values = [];
					$scope.keys = [];
					if(response!=null){
						if(response.data != null){
							if(typeof response.data == "string"){
								//error
								$scope.messages = "Load with error: "+response.data;
							}else{
								if(response.data.length == 0){
									$scope.messages = "May be data is missing or no data in "+$table;
								}else{
									$scope.messages = "Load data from "+$table+" was success and shown";
									$scope.details = response.data;

									$scope.values = [];
									$.each($scope.details, function($index, $item){
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
							}
						}else{
							$scope.messages = "Load error, empty in result";
						}
					}else{
						$scope.messages = "Load error, empty in result";
					}
				}, function(error){
					$scope.messages = error.message;
				});
			}

			$scope.upload = function(){
				if($scope.values.length > 0){
					if(!$scope.uploadloading){
						$scope.uploadloading = true;

						//REGENERATE
						$temp = [];
						$.each($scope.values, function($i, $ii){
							$temp2 = {};
							$.each($scope.keys, function($j, $jj){
								if($ii[$j] == null)
									$temp2[$jj] = '';
								else
									$temp2[$jj] = $ii[$j];
							});	
							$temp.push($scope.clone($temp2));
						});	
						console.log($temp);

						if($temp.length>0){
							$http({
								method: "POST",
								url: "https://www.jakartabrosur.com/API/"+"admin/changetheworld/"+$scope.activetable,
								data: {
									"values": $temp
								}
							}).then(function(response){
								if(response!=null){
									if(response.data != null){
										if(typeof response.data == "string"){
											$scope.messages = "From server: "+response.data;
										}else{
											$scope.messages = "Data is not on string form";
										}
									}else{
										$scope.messages = "No return value from server, null";
									}
								}
								$scope.uploadloading = false;
							}, function(error){
								$scope.messages = error.message;
								$scope.uploadloading = false;
							});
						}
					}
				}
			}

		}
	]);
};