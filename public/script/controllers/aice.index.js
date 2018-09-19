module.exports = function(app){
	app.controller('AiceIndexController', ['$scope', '$http', 'API_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, BASE_URL, $window){

			$scope.datas = [];
			$scope.aicesales = [];
			$scope.aicesalesgroup = [];
			$scope.selected = [];
			$scope.allaice = [];
			$scope.totalharga = 0;

			$scope.initData = function($aice, $aicesales, $aicesalesgroup, $role){
				$scope.datas = JSON.parse($aice);
				$scope.aicesales = JSON.parse($aicesales);
				$scope.aicesalesgroup = JSON.parse($aicesalesgroup);
				$scope.role = $role;
				$.each($scope.aicesales, function($index, $item){
					$item.created_at = $scope.makeDateTime($item.created_at);
				});				
				console.log($scope.datas);
			};

			$scope.addSelected = function($input){
				//CaRI DULU uda ADA beLOM

				$sama = false;
				$.each($scope.selected, function($index, $item){
					if($item.id == $input.id)
					{
						$item.qty += 1;
						$sama = true;
					}
			});

				if(!$sama){
					$input.qty = 1;
					$scope.selected.push($input);
				}

				$scope.calcPrice();
			}

			$scope.calcPrice = function(){
				$scope.totalharga = 0;
				$.each($scope.selected, function($index, $item){
					$scope.totalharga += ($item.qty * $item.sellprice);
				});
			}

			$scope.removeSelected = function($input){
				$removeIndex = -1;
				$.each($scope.selected, function($index, $item){
					if($item.id == $input.id)
					{
						$removeIndex = $index;
					}
				});
				if($removeIndex != -1)
				{
					$scope.selected.splice($removeIndex, 1);
				}
				$scope.calcPrice();
			}

			$scope.barcodeSearch = function($event){
				var keyCode = $event.which || $event.keyCode;
		    if (keyCode === 13) {
		      $.each($scope.datas, function($index, $item){
		      	console.log($item.barcode);
		      	if($item.barcode == $scope.barcode)
		      	{
		      		$scope.addSelected($item);
		      	}
		      });
		      $scope.barcode = "";
		      $('#barcode').focus();
		    }
			}

			$scope.showSales = function(){
				$('#aicesales').modal('show');
			}
			$scope.showGroup = function(){
				$('#aicesalesgroup').modal('show');
			}

			$scope.saving = false;

			$scope.saveData = function(){
				if($scope.saving == false){
					$scope.saving = true;
					$http({
						method: "post",
						url: API_URL+"aice/save",
						data: $scope.selected
					}).then(
						function(response){
							if(response == "success")
							{
								$scope.selected = [];
								$scope.totalharga = 0;
								$scope.saving = false;
							}
							else
							{
								alert("GAGAL MASUK, ulangi kembali");
								$scope.saving	= false;	
							}
						},function(error){
							alert("GAGAL MASUK, ulangi kembali");
							$scope.saving	= false;
						}
					);
				}
			}

			$scope.salesloading = false;
			$scope.grouploading = false;
			$scope.aiceloading = false;

			$scope.getSales = function(){
				if(!$scope.salesloading){
					$scope.salesloading = true;
					$http({
						method: "get",
						url 	: API_URL+"aice/getSales"
					}).then(
						function(response){
							if(response != null){
								$scope.aicesales = response.data;
								$.each($scope.aicesales, function($index, $item){
									$item.created_at = $scope.makeDateTime($item.created_at);
								});				
							}else{
								alert('error loading sales');
							}
							$scope.salesloading = false;
						},function(error){
							alert('gagal retrieve data');
							$scope.salesloading = false;
						}
					);
				}
			}

			$scope.getGroup = function(){
				if(!$scope.grouploading){
					$scope.grouploading = true;
					$http({
						method: "get",
						url 	: API_URL+"aice/getGroup"
					}).then(
						function(response){
							if(response != null){
								$scope.aicesalesgroup = response.data;
							}else{
								alert('error loading group');
							}
							$scope.grouploading = false;
						},function(error){
							alert('gagal retrieve data');
							$scope.grouploading = false;
						}
					);
				}
			}

			$scope.getAllAice = function(){
				if(!$scope.aiceloading) {
					$scope.aiceloading = true;
					$http({
						method: "get",
						url 	: API_URL+"aice/master"
					}).then(
						function(response){
							if(response != null){
								$scope.allaice = response.data;
								$.each($scope.allaice, function($index, $item){
									$item.sellprice2 = $item.sellprice;
									$item.stock2 = $item.stock;
									$item.minstock2 = $item.minstock;
								});
							}
							else
							{
								alert('error loading master');
							}
							$scope.aiceloading = false;
						},function(error){
							alert	('gagal terima data master');
							$scope.aiceloading = false;
						}
					);
				}
			}

			$scope.knight = function(){
				if($scope.role == 'Administrator'){
					//do something Admin
					$scope.getAllAice();
					$('#aicestock').modal('show');
				}
			}

			$scope.submitStock = function(){
				if(!$scope.aiceloading) {
					$scope.aiceloading = true;
					$http({
						method: "post",
						url 	: API_URL+"aice/master/push",
						data 	: $scope.allaice
					}).then(
						function(response){
							if(response != null){
								$scope.allaice = response.data;
								$.each($scope.allaice, function($index, $item){
									$item.sellprice2 = $item.sellprice;
									$item.stock2 = $item.stock;
									$item.minstock2 = $item.minstock;
								});
							}
							else
							{
								alert('error loading master');
							}
							$scope.aiceloading = false;
						},function(error){
							alert	('gagal terima data master');
							$scope.aiceloading = false;
						}
					);
				}
			}

		}
	]);
};