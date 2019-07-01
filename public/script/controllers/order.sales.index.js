module.exports = function(app){
	app.controller('AllSalesController', ['$scope', '$http', 'BASE_URL', 'AJAX_URL', 'API_URL', '$window',
		function($scope, $http, BASE_URL, AJAX_URL, API_URL, $window){
			$scope.URL = 'http://localhost:8000/';
			$scope.selectedfilter = null;
			$scope.filters = [
				{
					"name": "Semua",
					"icon": "fa-filter",
					"link": "semua"
				},
				{
					"name": "Belum Bayar",
					"icon": "fa-wallet",
					"link": "belumbayar"
				},
				{
					"name": "Diproses",
					"icon": "fa-tasks",
					"link": "diproses"
				},
				{
					"name": "Dikirim",
					"icon": "fa-truck-loading",
					"link": "dikirim"
				},
				{
					"name": "Selesai",
					"icon": "fa-box-check",
					"link": "selesai"
				}
			];

			$scope.setselectedfilter = function($input, $refresh){
				$scope.selectedfilter = $input;
				if($input=="")
					$scope.selectedfilter = "semua";

				if($refresh){
					//LOADING UNTUK REFRESH
					$http({
						method: "GET",
						url: AJAX_URL+"allsales/filterorder/"+$input
					}).then(function(response){
						if(response!=null){
							if(response.data != null){
								if(typeof response.data == "string"){
									console.log("HASILNYA STRING, error");
								}else{
									$scope.sales = response.data;
									$scope.afterinitsales();
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

			$scope.initAllSales = function($input){
				$scope.sales = JSON.parse($input);
				$scope.afterinitsales();
			}

			$scope.afterinitsales = function(){
				$.each($scope.sales, function($index, $item){
					if($item!=null){
						$scope.loadingfilter = false;
	$item.created_at = $scope.makeDateTime($item.created_at);
						$item.showpayment = false;
						$item.showdelivery = false;
						$item.showdetail = false;
						$item.totalprice = 0;
						$.each($item.salesdetail, function($index2, $item2){
							$item2.cartheader.printprice = parseInt($item2.cartheader.printprice);
							$item2.cartheader.deliveryprice = parseInt($item2.cartheader.deliveryprice);
							$item2.cartheader.discount = parseInt($item2.cartheader.discount);
							$item2.cartheader.buyprice = parseInt($item2.cartheader.buyprice);

							if($item2.updated_at != null)
								$item2.updated_at = $scope.makeDateTime($item2.updated_at+'');

							$item.totalprice += $item2.cartheader.printprice + $item2.cartheader.deliveryprice - $item2.cartheader.discount;

							$item2.totalkirim = 0;
							$item2.totalhargakirim = 0;
							$.each($item2.salesdeliverydetail, function($j, $jj){
								$item2.totalkirim += parseInt($jj.quantity);
								$item2.totalhargakirim += parseFloat($jj.actualprice);
							});
						})
						$item.totalpay = 0;
						$item.tungguverif = false;

						$.each($item.salespayment, function($index, $item2){
							$item.totalpay += $item2.ammount;
							if($item2.salespaymentverif==null)
								$item.tungguverif = true;
						})

						if($item.totalpay > $item.totalprice)
							$item.paymentdetail = "LEBIH BAYAR. Kelebihan pembayaran akan ditransfer kerekening Anda keesokan hari.";
						else if($item.totalpay == $item.totalprice)
						{
							if($item.tungguverif == true)
								$item.paymentdetail = "Sedang menunggu proses verifikasi pembayaran. Hubungi kami u/ mempercepat.";
							else
								$item.paymentdetail = "LUNAS";
						}
						else
						{
							if($item.totalpay == 0)
								$item.paymentdetail = "Belum ada pembayaran, silahkan lakukan pembayaran.";
							else
								$item.paymentdetail = "Anda kurang bayar.";
						}
					}
					else{
						$scope.loadingfilter = true;
					}
				});
			}

			$scope.makeDateTime = function($input){
				if ($input == 'null') return null;
				$temp = $input.split(' ')[0];
				$temp = $temp.split('-');
				$temp2 = $input.split(' ')[1];
				$temp2 = $temp2.split(':');
				return new Date($temp[0], $temp[1]-1, $temp[2], $temp2[0], $temp2[1], $temp2[2]);
			}

			$scope.isLunas = function($item){
				if ($item.status=='LUNAS')
					return true;
				else
					return false;
			}

			//darigodhands
			$scope.fillCompanyBankAccs.call();

			$scope.commit = function($item, $item2){
				//yang di send item2 <= salesdetail dari item
				/*$http({
					"method" : "POST",
					"url"		 : API_URL+"sales/"+$data.id+"/commit"
					//salesdetail.id yang di pilih, biar langsung find idNya di table Salesdetails
				}).then(function(response){
					if(response!=null)
						if(typeof response === "string")
							if(response == "success")
								$data.commited = 1;
				});*/

				$http({
					method: "POST",
					url: API_URL+"customer/"+$item.customerID+"/makesession"
				}).then(function(response){
					if(response.data!=null){
						if(response.data.constructor === String){
							$scope.session = response.data;
							$window.location.href = BASE_URL+"sales/commit/"+$item2.id+"/"+$item.id+"/"+$scope.session;
						}else
							$scope.session = null;
					}else
						$scope.session = null;
				});

			}

			$scope.sendcommit = function($url, $item, $item2){
				if($scope.session == null){
					$http({
						method: "POST",
						url: API_URL+"customer/"+$item.customerID+"/makesession"
					}).then(function(response){
						if(response.data!=null){
							if(response.data.constructor === String){
								$scope.session = response.data;
								$scope.sendwacommit($url, $item2.id, $item.id, $scope.session);
							}
							else
								$scope.session = null;
						}else{
							$scope.session = null;
							$window.location.reload();
						}
					}, function(error){
						$window.location.reload();
					});
				}else{
					$scope.sendwacommit($url, $item2.id, $item.id, $scope.session);
				}
				
			}

			$scope.sendwacommit = function($url, $did, $sid, $key){
				$window.open("http://wa.me/?text=Cek%20kembali%20cetakan%20Anda%20sebelum%20naik%20cetak,%20klik%20di%20"+$url+"sales%2Fcommit%2F"+$did+"%2F"+$sid+"%2F"+$key);
			}

			$scope.makeSession = function($customerID){
				$http({
					method: "POST",
					url: API_URL+"customer/"+$customerID+"/makesession"
				}).then(function(response){
					if(response.data!=null){
						if(response.data.constructor === String)
							$scope.session = response.data;
						else
							$scope.session = null;
					}else
						$scope.session = null;
				});
			}

			$scope.hidealldetail = function(){
				$.each($scope.sales, function($index, $item){
					$item.showdetail = false;
					$item.showdelivery = false;
					$item.showpayment = false;
					$item.showtracking = false;
				});
			}

			$scope.showpreview = function($item){
				$scope.onpreview = true;
				$scope.previewfile = $item;
			}

			$scope.showdelivery = function($item){
				$show = $item.showdelivery;
				$scope.hidealldetail();
				if(!$show) $item.showdelivery = true;
				else $item.showdelivery = false;
			}
			$scope.showpayment = function($item){
				$show = $item.showpayment;
				$scope.hidealldetail();	
				if(!$show) $item.showpayment = true;
				else $item.showpayment = false;
			}
			$scope.showdetail = function($item){
				$show = $item.showdetail;
				$scope.hidealldetail();
				if(!$show) $item.showdetail = true;
				else $item.showdetail = false;
			}
			$scope.showtracking = function($item){
				$show = $item.showtracking;
				$scope.hidealldetail();
				if(!$show) $item.showtracking = true;
				else $item.showtracking = false;
			}
			$scope.showfiles = function($item){

				$http({
					method: "GET",
					url: 	API_URL+"cartfiles/"+$item['cartID']
				}).then(
					function(response){
						if(response!=null)
						{
							$scope.selecteddetail = $item; // buat show data
							$scope.files = response.data;
							$scope.onpreview = false;
							$.each($scope.files, function($index, $item){
								if($item.file.updated_at!=null)
									$item.file.updated_at = $scope.makeDateTime($item.file.updated_at);
								else
									$item.file.updated_at = "";
							});
							$("#filesModal").modal('show');
						}
					},function(error){
						console.log(response);
					}
				);
			}
			$scope.deletecartfile = function($item, $index){
				console.log($item);
				$http({
					method: "GET",
					url 	: API_URL+"cartfiles/"+$item.id+"/delete"
				}).then(
					function(response){
						//balikin flag
						$item.ondelete = false;

						$scope.files.splice($index, 1);
					},function(error){
						//balikin flag
						$item.ondelete = false;
						alert('tidak bisa delete - cartfiles');
					}
				);
			}
			$scope.showupdatefile = function($item){
				$item.onupdate = true;
			}
			// $scope.filtersales = function($id){
			// 	if (!$scope.loadingfilter) {
			// 		$scope.loadingfilter = true;
			// 		$http({
			// 			method: "GET",
			// 			url: API_URL + "filtersales/" + $id
			// 		}).then(function(response) {
			// 			$scope.sales = [];
			// 			$scope.sales = response.data;
			// 			console.log(response.data);
			// 			$.each($scope.sales, function($index, $item) {
			// 				$item.created_at = $scope.makeDateTime($item.created_at);
			// 			});
			// 			$("#filter-0").removeClass("active");
			// 			$("#filter-1").removeClass("active");
			// 			$("#filter-2").removeClass("active");
			// 			$("#filter-3").removeClass("active");
			// 			$("#filter-4").removeClass("active");

			// 			$("#filter-" + $id).addClass("active");

			// 			$scope.allsalespagetitle = $id == 0 ? "<i class='far fa-filter margin-right-5'></i> Semua Transaksi / Tanpa Filter" : $id == 1 ? "<i class='far fa-wallet margin-right-5'></i> Transaksi Masih Butuh Pembayaran" : $id == 2 ? "<i class='far fa-tasks margin-right-5'></i> Transaksi Dalam Proses Cetak" : $id == 3 ? "<i class='far fa-truck-loading margin-right-5'></i> Transaksi Dalam Pengiriman" : "<i class='far fa-box-check margin-right-5'></i> Transaksi Sudah Selesai";
			// 			$scope.loadingfilter = false;
			// 		}, function(error) {
			// 			$scope.loadingfilter = false;
			// 		});
			// 	}	
			// }
		}
	]);
};