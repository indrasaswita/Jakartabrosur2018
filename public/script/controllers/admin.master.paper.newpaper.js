module.exports = function(app){
	app.controller('AdmNewPaperController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window){
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
				$scope.getCoatingtypes();
				$scope.getPapertypes();
				$scope.papers = JSON.parse($input);
				$.each($scope.papers, function($index, $item){
					$item.showdetail = false;
					$.each($item.paperdetail, function($index2, $item2){
						$scope.papers[$index].paperdetail[$index2].buyprice = parseInt($item2.buyprice);
						$scope.papers[$index].paperdetail[$index2].sellprice = parseInt($item2.sellprice);
						$scope.papers[$index].paperdetail[$index2].unitprice = parseFloat($item2.unitprice);
					})
				});
			}

			$scope.changepaperdetail = function($paperID, $column, $item){
				$http({
					method: "POST",
					url: AJAX_URL+"paper/"+$paperID+"/changepaper/"+$column
				}).then(function(response){
					if(response!=null){
						if(response.data != null){
							if(typeof response.data == "string"){
								$item[$column] = response.data;
							}
						}else{
							console.log("PaperID not found..");
							$window.location.reload();
						}
					}
				}, function(error){
					console.log(error);
					//$window.location.reload();
				});
			}

			$scope.changepapertype = function($paperID, $item) {
				$http({
					method: "POST",
					url: AJAX_URL + "paper/" + $paperID + "/changepapertype",
					data: {
						0: $item.papertype.id
					}
				}).then(function(response) {
					if (response != null) {
						if (response.data != null) {
							console.log(response.data);
							if (typeof response.data == "string") {
								if(response.data == "success"){
									console.log("success");
								}
							}
						} else {
							console.log("PaperID not found..");
							$window.location.reload();
						}
					}
				}, function(error) {
					console.log(error);
					//$window.location.reload();
				});
			}

			$scope.getCoatingtypes = function(){
				$http({
					method: "GET",
					url: API_URL+"coatingtypes"
				}).then(function(response){
					if(response!=null){
						if(response.data != null){
							$scope.coatingtypes = response.data;
						}else{
							console.log("The return value is null, not error");
						}
					}
				}, function(error){
					console.log(error);
				});
			}

			$scope.getPapertypes = function() {
				$http({
					method: "GET",
					url: API_URL + "papertypes"
				}).then(function(response) {
					if (response != null) {
						if (response.data != null) {
							$scope.papertypes = response.data;
						} else {
							console.log("The return value is null, not error");
						}
					}
				}, function(error) {
					console.log(error);
				});
			}

			$scope.addfieldnewpaper = function() {
				$newpaper = {
					"papertypeID": "1",
					"name": $scope.newname,
					"color": $scope.newcolor,
					"gramature": $scope.newgramature,
					"texture": 0,
					"numerator": 0,
					"varnish": 0,
					"spotuv": 0,
					"laminating": 0,
					"folding": 0,
					"perforation": 0,
					"diecut": 0,
					"coatingtypeID": 1
				};
				$scope.papers.push($newpaper);
			}

			$scope.savenewpaper = function($item){
				$http({
					method: "POST",
					url: AJAX_URL+"paper/savenewpaper",
					data: $item
				}).then(function(response){
					if(response!=null){
						if(response.data != null){
							if(typeof response.data == "string"){
								$item.id = response.data;
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