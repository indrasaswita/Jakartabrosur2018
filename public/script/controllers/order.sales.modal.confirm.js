module.exports = function(app) {
	app.controller('OrdersalesPaymentconfirmController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window) {

			$scope.doconfirm = function(){
				
				$http({
					method: "POST",
					url: AJAX_URL+"salespayment/insert",
					data: $scope.konfirmasi
				}).then(function(response){
					if(response!=null){
						if(response.data != null){
							if(typeof response.data == "object"){
								$scope.selectedSalesheader.salespayment = response.data;

								$scope.selectedSalesheader.totalpay = 0;
								$.each($scope.selectedSalesheader.salespayment, function($index, $item){
									$scope.selectedSalesheader.totalpay+=$item.ammount;
								});

								//KOPAS DARI ORDER SALES INDEX
								if ($scope.selectedSalesheader.totalpay > $scope.selectedSalesheader.totalprice)
									$scope.selectedSalesheader.paymentdetail = "LEBIH BAYAR. Kelebihan pembayaran akan ditransfer kerekening Anda keesokan hari.";
								else if ($scope.selectedSalesheader.totalpay == $scope.selectedSalesheader.totalprice) {
									if ($scope.selectedSalesheader.tungguverif == true)
										$scope.selectedSalesheader.paymentdetail = "Sedang menunggu proses verifikasi pembayaran. Hubungi kami u/ mempercepat.";
									else
										$scope.selectedSalesheader.paymentdetail = "LUNAS";
								}
								else {
									if ($scope.selectedSalesheader.totalpay == 0)
										$scope.selectedSalesheader.paymentdetail = "Belum ada pembayaran, silahkan lakukan pembayaran.";
									else
										$scope.selectedSalesheader.paymentdetail = "Anda kurang bayar.";
								}

								$scope.afterpayment();
							}
						}else{
							//tidak berhasil save ke db;
							console.log("tidak berhasil save ke db");
						}
					}
				}, function(error){
					console.log(error);
				});
			}

			$scope.afterpayment = function(){
				$("#ordersales-payment-confirm").modal('hide');

				$scope.showpaymentinfo($scope.selectedSalesheader);

				var maxTime = 5000, // 5 seconds
					startTime = Date.now();

				var interval = setInterval(function() {
					if ($("#payment-detail-" + $scope.selectedSalesheader.id).is(':visible')) {
						// visible, do something
						$scope.scrollTo("#payment-detail-" + $scope.selectedSalesheader.id, -10);
						clearInterval(interval);
					} else {
						// still hidden
						if (Date.now() - startTime > maxTime) {
							// hidden even after 'maxTime'. stop checking.
							clearInterval(interval);
						}
					}
				},
					100 // 0.1 second (wait time between checks)
				);
			}

		}
	]);
};