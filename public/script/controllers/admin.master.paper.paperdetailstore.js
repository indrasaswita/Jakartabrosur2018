module.exports = function(app){
	app.controller('AdmPaperdetailController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window){
			
			$scope.selectedpaper = 0;
			$scope.selectvendor = null;
			$scope.papers = [];
			$scope.newplanosizes = [];
			$scope.unittypes = [
				{'type': 'lembar'}, 
				{'type': 'meter'}
			];

			$scope.initData = function($input)
			{
				$scope.papers = JSON.parse($input);
				$scope.getallvendor();
			}

			$scope.temp = "";
			$scope.temp2 = 0;
			$scope.savestat = function($input, $paperID) {
				if($paperID != $scope.temp2){
					$scope.temp = "";
					$scope.temp2 = $paperID;
				}


				if($scope.temp == $input)
					return false;
				if($scope.temp != $input){
					$scope.temp = $input;
					return true;	
				}
			}

			$scope.selectpaper = function($index){
				$scope.selectedpaper = $index;
			}

			$scope.getallvendor = function(){
				$http({
					method: "GET",
					url: API_URL+"admin/vendor/allshop"
				}).then(function(response){
					if(response!=null){
						if(response.data != null){
							$scope.vendors = response.data;
						}else{
							console.log("The return value is null, not error");
						}
					}
				}, function(error){
					console.log(error);
				});
			}

			$scope.showaddtoko = function(){
				$scope.selectedvendor = $scope.vendors[0];

				$scope.newplanosizes = [];
				$scope.addnewplanorow();

				$('#addplanosize').modal("show");
			}

			$scope.showaddplanosize = function($vendor){
				$scope.selectedvendor = $vendor;

				$scope.newplanosizes = [];
				$scope.addnewplanorow();

				$('#addplanosize').modal("show");
			}

			$scope.addnewplanorow = function(){
				$temp = {
					"width": 65,
					"length": 100,
					"inputstate": "pertotal",
					"inputprice": 500000,
					"margin": 4,
					"totalpcs": 500,
					"unittype": $scope.unittypes[0],
					"error" : {
						"size" : null
					}
				};

				$scope.newplanosizes.push($temp);
				$scope.checksize($temp.width, $temp.length, $temp);
			}

			//HARGA UNIT TOTAL KG PINDAH KE GODHAND

			$scope.getkgprice = function($item, $paper) {
				$result = -2;
				if($item != null)
					if($item.unittype.type == "lembar"){
						if($item.inputstate == "pertotal")
							$result = $scope.total2kg($item.inputprice, $paper.gramature, $item.width, $item.length);
						else if($item.inputstate == "perkg")
							$result = $item.inputprice;
						else if($item.inputstate == "perunit")
							$result = $scope.unit2kg($item.inputprice, $item.totalpcs, $paper.gramature, $item.width, $item.length);
					}

				return $result;
			}

			$scope.gettotalprice = function($item, $paper) {
				$result = -1;
				if ($item != null)
					if ($item.unittype.type == "lembar") {
						if ($item.inputstate == "pertotal")
							$result = $item.inputprice;
						else if ($item.inputstate == "perkg")
							$result = $scope.kg2total($item.inputprice, $paper.gramature, $item.width, $item.length);
						else if ($item.inputstate == "perunit")
							$result = $scope.unit2total($item.inputprice, $item.totalpcs);
					}
				return $result;
			}

			$scope.getunitprice = function($item, $paper) {
				$result = -3;
				if($item != null)
					if($item.unittype.type == "lembar"){
						if ($item.inputstate == "pertotal")
							$result = $scope.total2unit($item.inputprice, $item.totalpcs);
						else if ($item.inputstate == "perkg")
							$result = $scope.kg2unit($item.inputprice, $paper.gramature, $item.width, $item.length);
						else if ($item.inputstate == "perunit")
							$result = $item.inputprice;
					}
				return $result;
			}

			$scope.changeinputstate = function($item) {
				if ($item.inputstate == "pertotal") {
					$item.inputstate = "perkg";
				} else if ($item.inputstate == "perkg") {
					$item.inputstate = "perunit";
				} else if ($item.inputstate == "perunit") {
					$item.inputstate = "pertotal";
				}
			}

			$scope.checksize = function($w, $l, $newrow){
				$seterror = false;
				$.each($scope.papers[$scope.selectedpaper].paperdetail, function($index, $item){
					if($item.vendorID == $scope.selectedvendor.id){
						if($item.plano.width == $w &&
							$item.plano.length == $l){
							$seterror = true;
						}
					}
				})
				if($seterror){
					$scope.newsaveerror = true;
					$newrow.error = {
						"size": "( planosize duplicated )"
					};
				}else{
					$scope.newsaveerror = false;
					$newrow.error = {
						"size": null
					};
				}
			}

			$scope.savenewplano = function(){
				$duplicated = false;
				$.each($scope.newplanosizes, function($i, $ii){
					if($ii.error.size!=null)
						$duplicated = true;
					$ii.paper = $scope.papers[$scope.selectedpaper];
					$ii.buyprice = $scope.gettotalprice($ii, $scope.papers[$scope.selectedpaper]);
					$ii.sellprice = ($scope.gettotalprice($ii, $scope.papers[$scope.selectedpaper]) * (100 + $ii.margin) / 100);
					$ii.unitprice = ($scope.getunitprice($ii, $scope.papers[$scope.selectedpaper]) * (100 + $ii.margin) / 100);
					//$ii.unittype = $ii.unittype.type;
					$ii.vendor = $scope.selectedvendor;
				});


				if(!$duplicated && !$scope.savewaiting){
					$scope.savewaiting = true;
					$http({
						method: "POST",
						url: AJAX_URL+"paperdetail/savenewplano",
						data: $scope.newplanosizes
					}).then(function(response){
						if(response!=null){
							if(response.data != null){
								console.log(response.data);
								if(typeof response.data == "string"){
					
								}
							}else{
								console.log("The return value is null, not error");
							}
						}
						$scope.savewaiting = false;
					}, function(error){
						console.log(error);
						$scope.savewaiting = false;
					});
				}else{
					console.log("DUPLIICATE / MASI NUNGGU SAVE RESPONSE DARI SERVER")
				}
			}

		}
	]);
};