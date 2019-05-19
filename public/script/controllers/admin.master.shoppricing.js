module.exports = function(app){
	app.controller('AdmShoppricingController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window) {

			$scope.constants = null;
			$scope.finishings = null;
			$scope.finishingindex = 0;

			$scope.finishingside = [
				{
					value: -1,
					label: "-1 [Tidak diberikan pilihan SISI Finishing]"
				},
				{
					value: 0,
					label: "0 [Bisa 1 sisi / 2 sisi finishing, pelanggan diberikan pilihan]"
				},
				{
					value: 1,
					label: "1 [Tidak bisa pilih, karena cuma ada 1 sisi finishing]"
				}
			];

			$scope.priceper = [
				{ value: "cm" },
				{ value: "kg" },
				{ value: "pcs" },
				{ value: "m" }
			];

			$scope.initData = function($constants, $finishings) {
				$scope.constants = JSON.parse($constants);

				if ($scope.constants != null)
					$.each($scope.constants, function($index, $item) {
						if ($item != null) {
							$scope.constants[$index].updated_at = $scope.makeDateTime($item.updated_at);
							$scope.constants[$index].price = parseFloat($item.price);
						}
					});

				$scope.finishings = JSON.parse($finishings);

				if ($scope.finishings != null) {
					$.each($scope.finishings, function($index, $item) {
						if ($item != null) {
							$scope.finishings[$index].updated_at = $scope.makeDateTime($item.updated_at);
							if ($item.finishingoption != null) {
								$.each($item.finishingoption, function($index2, $item2) {
									$scope.finishings[$index].finishingoption[$index2].price = parseFloat($item2.price);
									$scope.finishings[$index].finishingoption[$index2].priceminim = parseInt($item2.priceminim);
									$scope.finishings[$index].finishingoption[$index2].pricebase = parseInt($item2.pricebase);
								});
							}
						}
					});
				}
			}

			$scope.prevjob = function() {
				if ($scope.finishingindex == 0) {
					//PALING DEPAN
				} else {
					$scope.finishingindex--;
				}
			}

			$scope.nextjob = function() {
				if ($scope.finishingindex == $scope.finishings.length - 1) {
					//PALING BELAKANG
				} else {
					$scope.finishingindex++;
				}
			}

			$scope.togglestatus = function() {
				$scope.finishings[$scope.finishingindex].status = !$scope.finishings[$scope.finishingindex].status;
			}

			$scope.showdialog = function(){
				$("#savefinishingconfirm").modal("show");
			}

			$scope.showdialogconstant = function() {
				$("#saveconstantconfirm").modal("show");
			}

			$scope.showdialogaddconstant = function() {
				$("#addnewconstant").modal("show");
			}

			$scope.save = function(){
				$http({
					method: "POST",
					url: AJAX_URL+"shoppricing/finishing/update",
					data: $scope.finishings[$scope.finishingindex]
				}).then(function(response){
					console.log(response.data);	
				}, function(error){
					console.log(error.statusText);
				});
				$("#savefinishingconfirm").modal("hide");
			}

			$scope.saveconstant = function(){
				$http({
					method: "POST",
					url: AJAX_URL+"shoppricing/constant/update",
					data:$scope.constants
				}).then(function(response){
					console.log(response.data);
				}, function(error){
					console.log(error.statusText);
				});
				$("#saveconstantconfirm").modal('hide');
			}
			$scope.insertconstant = function() {
				$http({
					method: "POST",
					url: AJAX_URL + "shoppricing/constant/insert",
					data: $scope.constants
				}).then(function(response) {
					console.log(response.data);
				}, function(error) {
					console.log(error.statusText);
				});
				$("#saveconstantconfirm").modal('hide');
			}
		}
	]);
};