module.exports = function(app){
	app.controller('AdmPricePaperController', ['$scope', '$http', 'API_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, BASE_URL, $cookies, $window){
			$scope.selectedpapers = [];
			$scope.errorsubmit = "";

			$scope.variable = {
				"priceper" : 10000,
				"margin" : 10,
				"selecteduom" : "kg",
				"papershop" : null,
				"priceperuom" : ["kg", 'pcs', 'meter', 'ream']
			};

			$scope.initData = function($input)
			{
				$scope.papers = JSON.parse($input);
				$.each($scope.papers, function($index, $item){
					$item.showdetail = false;
					$.each($item.paperdetail, function($index2, $item2){
						$scope.papers[$index].paperdetail[$index2].buyprice = parseInt($item2.buyprice);
						$scope.papers[$index].paperdetail[$index2].sellprice = parseInt($item2.sellprice);
						$scope.papers[$index].paperdetail[$index2].unitprice = parseFloat($item2.unitprice);
						$scope.papers[$index].paperdetail[$index2].selected = false;
					})
				});
				console.log($scope.papers);
			}

			$scope.showdetail = function($data)
			{
				$temp = !$data.showdetail;

				$.each($scope.papers, function($index, $item){
					$item.showdetail = false;
				});

				$data.showdetail = $temp;
			}

			$scope.getTokoKertas = function(){
				$http({
					method: "GET",
					url 	: API_URL+"admin/papershop"
				}).then(function(response){
					if(response!=null){
						console.log(response.data);
						$scope.papershops = response.data;
						if($scope.papershops.length>1)
						{
							$scope.variable.papershop = $scope.papershops[0];
						}
					}
				}, function(error){

				});
			}

			$scope.getTokoKertas();

			$scope.changecheck = function($item, $item2)
			{
				$item2.selected = !$item2.selected;
				$scope.postchecked($item, $item2);
			}

			$scope.postcheckedByPaper = function($paper, $status)
			{
				$.each($paper.paperdetail, function($j, $detail){
					$paper.paperdetail[$j].selected = $status;
					$scope.postchecked($paper, $detail);
				});
			}

			$scope.getPrice = function($gramature, $width, $length, $totalpcs){

				if ($scope.variable.selecteduom == "kg") {
					$newpricebuy = $scope.variable.priceper * $gramature * $width * $length / 20000;
					$newpricesell = $newpricebuy * (1 + $scope.variable.margin / 100);
					$newpriceunit = $newpricesell / $totalpcs;
				}else if ($scope.variable.selecteduom == "pcs") {
					$buyperlembar = $scope.variable.priceper;

					$newpricebuy = $buyperlembar * $totalpcs;
					$newpricesell = $newpricebuy * (1 + $scope.variable.margin / 100);
					$newpriceunit = $newpricesell / $totalpcs;
				} else if ($scope.variable.selecteduom == "meter") {
					$buypermeter = $scope.variable.priceper;

					$newpricebuy = $buypermeter * $totalpcs;
					$newpricesell = $newpricebuy * (1 + $scope.variable.margin / 100);
					$newpriceunit = $newpricesell / $totalpcs;
				}

				return {
					"newpricebuy" : $newpricebuy,
					"newpricesell" : $newpricesell,
					"newpriceunit" : $newpriceunit
				};
			}

			$scope.changePrice = function(){
				$.each($scope.selectedpapers, function($i, $ii){
					$result = $scope.getPrice($ii.papergramature, $ii.planolength, $ii.planowidth, $ii.totalpcs);
					$scope.selectedpapers[$i].newpricebuy = $result["newpricebuy"];
					$scope.selectedpapers[$i].newpricesell = $result['newpricesell'];
					$scope.selectedpapers[$i].newpriceunit = $result['newpriceunit'];
					$scope.selectedpapers[$i].vendorID = $scope.variable.papershop.id;
				});
			}

			$scope.submitChange = function(){
				if($scope.selectedpapers.length != 0)
				{
					$scope.changePrice();
					$scope.errorsubmit = "";
					$http({
						"method" 	: "POST",
						"url"			: API_URL+"admin/master/paper/update",
						"data"		: $scope.selectedpapers
					}).then(function(response){
						$success = false;
						if(response!=null)
						{
							if(typeof response === "string")
							{
								if(response == "success")
								{
									$success = true;
								}
							}
						}
						if($success)
						{
							//$window.location.href=BASE_URL+"admin/master/paper";
							$scope.errorsubmit = "";
						}
						else
						{
							$('#submitModal').modal('hide');
							$scope.errorsubmit = "GAGAL SUBMIT!";
						}
					});
				}
				else
				{
					$scope.errorsubmit = "Masih Kosong!";
				}
			}

			$scope.setSelectedUOM = function($item){
				$scope.variable.selecteduom = $item;
				$scope.changePrice();
			}

			$scope.confirmSubmit = function(){
				if($scope.selectedpapers.length != 0)
				{
					$('#submitModal').modal("show");
					$scope.errorsubmit = "";
				}
				else
				{
					$scope.errorsubmit = "Masih Kosong!";
				}
			}

			$scope.postchecked = function($paper, $detail)
			{
				$founded = false;
				$.each($scope.selectedpapers, function($i, $ii){
					if($ii!=null)
					{
						//console.log($ii);
						if($paper.id == $ii.paperID
							&& $detail.vendorID == $ii.vendorID
							&& $detail.planoID == $ii.planoID)
						{
							if($detail.selected == false)
								$scope.selectedpapers.splice($i, 1);

							$founded = true;
						}
					}
				});

				$scope.errorsubmit = "";

				if($founded == false && $detail.selected == true)
				{
					$detail.selected = true;
					
					$result = $scope.getPrice($paper.gramature, $detail.plano.length, $detail.plano.width, $detail.totalpcs);

					$temp = {
						"paperID" : $paper.id,
						"papername" : $paper.name,
						"papergramature" : $paper.gramature,
						"papercolor" : $paper.color,
						"vendorID" : $detail.vendorID,
						"vendorname" : $detail.vendor.name,
						"planoID" : $detail.planoID,
						"planowidth" : $detail.plano.width,
						"planolength" : $detail.plano.length,
						"pricebuy" : $detail.buyprice,
						"pricesell" : $detail.sellprice,
						"priceunit" : $detail.unitprice,
						"unittype" : $detail.unittype,
						"totalpcs" : $detail.totalpcs,
						"newpricebuy" : $result["newpricebuy"],
						'newpricesell' : $result["newpricesell"],
						"newpriceunit" : $result["newpriceunit"]
					};
					$scope.selectedpapers.push($temp);
				}
			}
		}
	]);
};