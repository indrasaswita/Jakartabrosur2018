module.exports = function(app){
	app.controller('AllSalesController', ['$scope', '$http', 'BASE_URL', 'AJAX_URL', 'API_URL', '$window',
		function($scope, $http, BASE_URL, AJAX_URL, API_URL, $window){

			$scope.konfirmasi = {
				"newcustacc": {
					"accno": "",
					"accname": "",
					"bankid": ""
				},
				"inputnew": true,
			};
			$scope.searchbankinput = "";
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

			$scope.loadingsavecustacc = false;

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

							$.each($item2.cartheader.cartdetail, function($j, $jj){
								$jj.jobtypelong = 
									($jj.jobtype == "OF") ? "Offset Print" : 
									($jj.jobtype == "DG") ? "Digital Print" : "Not Set";
							});

							if($item2.updated_at != null)
								$item2.updated_at = $scope.makeDateTime($item2.updated_at+'');

							$item.totalprice += $item2.cartheader.printprice + $item2.cartheader.deliveryprice - $item2.cartheader.discount;

							$item2.totalkirim = 0;
							$item2.totalhargakirim = 0;
							$.each($item2.salesdeliverydetail, function($j, $jj){
								$item2.totalkirim += parseInt($jj.quantity);
								$item2.totalhargakirim += parseFloat($jj.actualprice);
								if ($jj.salesdelivery != null) {
									$jj.salesdelivery.created_at = $scope.makeDateTime($jj.salesdelivery.created_at);
									$jj.salesdelivery.arrivedtime = $scope.makeDateTime($jj.salesdelivery.arrivedtime);
								}
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
			$scope.fillCustomerBankAccs(function(){
				if($scope.custaccs != null)
					if($scope.custaccs.length > 0){
						$scope.selectbanksender($scope.custaccs[0]);

						//$scope.konfirmasi.newcustacc.bank = $scope.clone(custacc.bank);
					}
			});

			$scope.selectbanksender = function(custacc){
				$scope.konfirmasi.custacc = custacc;
			}

			//darigodhands
			$scope.fillCompanyBankAccs(function() {
				if ($scope.compaccs != null)
					if ($scope.compaccs.length > 0)
						$scope.selectbanktrf($scope.compaccs[0])
			});

			$scope.selectbanktrf = function(compacc){
				$scope.konfirmasi.compacc = $scope.clone(compacc);
			}

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

			$scope.linkmakepayment = function(item){
				$scope.showpayment(item);
				$scope.showpaymentconfirm(item);
			}

			$scope.hidealldetail = function(){
				$.each($scope.sales, function($index, $item){
					$item.showinfo = false;
					$item.showdelivery = false;
					$item.showpayment = false;
					$item.showtracking = false;
					$.each($item.salesdetail, function($j, $jj) {
						$jj.showsubinfo = false;
					});
					$item.showpaymentconfirm = false;
					$item.showpaymentinfo = false;
				});
			}
			$scope.hideallsubpayment = function(){
				$.each($scope.sales, function($index, $item) {
					$item.showpaymentconfirm = false;
					$item.showpaymentinfo = false;
				});
			}
			$scope.hideallsubinfo = function() {
				$.each($scope.sales, function($index, $item) {
					$.each($item.salesdetail, function($j, $jj){
						$jj.showsubinfo = false;
					});
				});
			}

			$scope.showpreview = function($item){
				$scope.onpreview = true;
				$scope.previewfile = $item;
			}

			$scope.showprogress = function($salesdetail){
				//$scope.salesdetail => untuk variable di dalam printprogress
				$scope.salesdetail = $salesdetail;
				$("#print-progress-modal").modal('show');
			}
			$scope.showconfirmmodal = function($salesheader){
				$scope.konfirmasi.paymentammount = $salesheader.totalprice - $salesheader.totalpay;
				$scope.konfirmasi.salesID = $salesheader.id;
				$scope.selectedSalesheader = $salesheader;
				$('#ordersales-payment-confirm').modal('show');
			}
			$scope.showselectbank = function() {
				$('#ordersales-customer-selectbank').on('shown.bs.modal', function() {
					$('#input-banksearch').focus();
					$('#input-banksearch').val("");
				})  
				$('#ordersales-customer-selectbank').modal('show');
			}
			$scope.showselectedfile = function($file, $cart, $salesdetail){
				$scope.selectedFile = $file;
				$scope.selectedCart = $cart;
				$scope.selectedSalesdetail = $salesdetail;
				$("#viewcartfile-modal").modal('show');
			}
			$scope.showcartpreview = function($file, $preview) {
				$scope.selectedFile = $file;
				$scope.selectedCartpreview = $preview;
				$("#viewcartpreview-modal").modal('show');
			}
			$scope.showdelivery = function($item){
				$show = $item.showdelivery;
				$scope.hidealldetail();
				$item.showdelivery = true;
			}
			$scope.showpayment = function($item){
				$show = $item.showpayment;
				$scope.hidealldetail();	
				$item.showpayment = true;
			}
			$scope.showdetail = function($item) {

				$show = $item.showdetail;
				if(!$item.showinfo && !$item.showdelivery && !$item.showpayment){
					$item.showinfo = true;
				}
				if (!$show) $item.showdetail = true;
				else $item.showdetail = false;
			}
			$scope.showpaymentconfirm = function($item){
				$show = $item.showpaymentconfirm;
				$scope.hideallsubpayment();
				if(!$show) $item.showpaymentconfirm = true;
				else $item.showpaymentconfirm = false;
			}
			$scope.showpaymentinfo = function($item) {
				$show = $item.showpaymentinfo;
				$scope.hideallsubpayment();
				if (!$show) $item.showpaymentinfo = true;
				else $item.showpaymentinfo = false;
			}
			$scope.showinfo = function($item) {
				$show = $item.showinfo;
				$scope.hidealldetail();
				$item.showinfo = true;
			}
			$scope.showsubinfo = function($item) {
				$show = $item.showsubinfo;
				$scope.hideallsubinfo();
				if (!$show) $item.showsubinfo = true;
				else $item.showsubinfo = false;
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

			$scope.savecustbankacc = function(){
				if($scope.konfirmasi.newcustacc.bank == null){
					$scope.errorsavecustacc = "Anda wajib pilih akun bank Anda.";
				}else if($scope.konfirmasi.newcustacc.accname == ""){
					$scope.errorsavecustacc = "Nama Pemilik Akun wajib diisi.";
				}else{
					if(!$scope.loadingsavecustacc)
					{
						$scope.loadingsavecustacc = true;
						$http({
							method: "POST",
							url: AJAX_URL+"custbankaccs/save",
							data: $scope.konfirmasi.newcustacc
						}).then(function(response){
							if(response!=null){
								if(response.data != null){
									if(typeof response.data == "object"){
										$scope.custaccs = response.data[1];

										console.log($scope.custaccs.length + " -> " + response.data[1].length);

										$.each($scope.custaccs, function($index, $item){
											if($item.id == response.data[0]){
												$scope.konfirmasi.custacc = $item;
											}
										});

										$scope.konfirmasi.newcustacc = {};
										$scope.konfirmasi.inputnew = false;
									}
								}else{
									console.log("The return value is null, not error");
								}
							}
							$scope.loadingsavecustacc = false;
						}, function(error){
							console.log(error);
							$scope.loadingsavecustacc = false;
						});
					}
				}
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
		}
	]);
};