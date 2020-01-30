module.exports = function(app){
	app.controller('AdminSalesController', ['$timeout', '$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$window',
		function($timeout, $scope, $http, API_URL, AJAX_URL, BASE_URL, $window){
			$scope.initHeader = function($headers, $deliveries, $couriers, $activeemployee){
				$scope.headers = JSON.parse($headers);
				$scope.deliveries = JSON.parse($deliveries);
				$scope.couriers = JSON.parse($couriers);
				$activeemployee = parseInt($activeemployee);

				$.each($scope.headers, function($i, $item) {

					$scope.headers[$i].updated_at = $scope.makeDateTime($item.updated_at+"");
					$scope.headers[$i].created_at = $scope.makeDateTime($item.created_at+"");
					console.log($scope.headers[$i].created_at);
					$scope.headers[$i].showdetail = false;
					$scope.headers[$i].showdelivery = false;
					$scope.headers[$i].showpayment = false;

					$item.totalprice = 0;
					
					$courierID = 1;
					if($scope.couriers.length>0)
						$courierID = $scope.couriers[0].id;
					$.each($scope.couriers, function($az, $courier){
						if($courier.id == $activeemployee)
							$courierID = $activeemployee;
					});


					if($item.customer != null){
						var nw = new Date(Date.now());
						$scope.newdelivery = {
							"employeeID" : $courierID,
							"arrivedtime" : new Date(0, 0, 0, nw.getHours(), nw.getMinutes(), nw.getSeconds()),
							"arriveddate" : new Date(nw.getFullYear(), nw.getMonth(), nw.getDate(), 0, 0, 0),
							"receiver" : $item.customer.name,
							"deliveryaddress" : '',
							"deliveryID" : 1,
							"employeenote" : '',
							"suratno" : '',
							"suratimage" : '',
							"deliverydetail" : []
						};
					}

					if($item.salesdetail != null){
						$.each($item.salesdetail, function($index, $item2){
							if ($item2.cartheader != null)
							{
								$item2.cartheader.printprice = parseInt($item2.cartheader.printprice);
								$item2.cartheader.deliveryprice = parseInt($item2.cartheader.deliveryprice);
								$item2.cartheader.discount = parseInt($item2.cartheader.discount);
								$item2.cartheader.buyprice = parseInt($item2.cartheader.buyprice);

								$item.totalprice += $item2.cartheader.printprice + $item2.cartheader.deliveryprice - $item2.cartheader.discount;
								$item.deliveryselected = true;

								$item2.totalkirim = 0;
								$item2.totalhargakirim = 0;
								$.each($item2.salesdeliverydetail, function($j, $jj){
									$item2.totalkirim += parseInt($jj.quantity);
									$item2.totalhargakirim += parseFloat($jj.actualprice);
								});
							}
							else
							{
								// $item2.cartheader.printprice = 0;
								// $item2.cartheader.deliveryprice = 0;
								// $item2.cartheader.discount = 0;
								// $item2.cartheader.buyprice = 0;
								// $item2.cartheader.totalprice = 0;
								// $item2.cartheader.totalkirim = 0;
								// $item2.cartheader.totalhargakirim = 0;
							}
						});
					}

					if($item.salesdelivery != null){
						$.each($item.salesdelivery, function($index, $item2){
							$item2.created_at = Date.parse($item2.created_at);
						});
					}

					$item.totalpay = 0;
					$item.tungguverif = false;
					$.each($item.salespayment, function($index, $item2){
						$item.totalpay += $item2.ammount;
						if($item2.salespaymentverif==null)
							$item.tungguverif = true;
					})

					if($item.totalpay > $item.totalprice)
						$item.paymentdetail = "LEBIH BAYAR. Jangan lupa transfer kelebihannya.";
					else if($item.totalpay == $item.totalprice)
					{
						if($item.tungguverif == true)
							$item.paymentdetail = "PENDING.";
						else
							$item.paymentdetail = "LUNAS";
					}
					else
					{
						if($item.totalpay == 0)
							$item.paymentdetail = "Customer belom bayar.";
						else
							$item.paymentdetail = "Customer kurang bayar.";
					}
				});
			};

			$scope.refreshAllAccount = function(){
				$scope.updateCompAcc(1);
				//datanya di store di $scope.klikbca;
			}

			$scope.refreshAllAccount();

			$scope.typeoff = function($input){
				return typeof $input;
			}

			$scope.tick = 0;
			$scope.updateCounter = function(){
				if($scope.tick > 99999) 
					$scope.tick = 0;
				$scope.tick++;
				$timeout($scope.updateCounter, 300);
			}
			$scope.updateCounter();

			$scope.showdetail = function($item){
				$show = true;
				if($item.showdetail == true)
					$show = false;

				$.each($scope.headers, function($index, $item2){
					$item2.showdetail = false;
					$item2.showpayment = false;
					$item2.showdelivery = false;
					$item2.showtracking = false;
				});

				if($show)
					$item.showdetail = true;
			}

			$scope.showpayment = function($item){
				$show = true;
				if($item.showpayment == true)
					$show = false;

				$.each($scope.headers, function($index, $item2){
					$item2.showdetail = false;
					$item2.showpayment = false;
					$item2.showdelivery = false;
					$item2.showtracking = false;
				});

				if($show)
					$item.showpayment = true;
			}

			$scope.showdelivery = function($item){
				$show = true;
				if($item.showdelivery == true)
					$show = false;

				$.each($scope.headers, function($index, $item2){
					$item2.showdetail = false;
					$item2.showpayment = false;
					$item2.showdelivery = false;
					$item2.showtracking = false;
				});

				if($show)
					$item.showdelivery = true;
			}

			$scope.showtracking = function($item){
				$show = true;
				if($item.showtracking == true)
					$show = false;

				$.each($scope.headers, function($index, $item2){
					$item2.showdetail = false;
					$item2.showpayment = false;
					$item2.showdelivery = false;
					$item2.showtracking = false;
				});

				if($show)
					$item.showtracking = true;
			}

			$scope.changeStatusFile = function($item)
			{
				//REQUEST to change to SERVER
				$value = $item.statusfile;
				$item.statusfile = -1;
				$http({
					"method": "POST",
					"url" 	: API_URL+"admin/tracking/chstfile",
					"data" 	: {
						"salesID" : $item.salesID,
						"cartID" : $item.cartID
					}
				}).then(
					function(response){
						$item.statusfile = $value;
						if(response.data!=null)
							if(typeof response.data === "string")
								if(response.data == '0')
								{
									$item.statusfile = 0;
									$item.statusctp = 0;
									$item.statusprint = 0;
									$item.statuspacking = 0;
									$item.statusdelivery = 0;
									$item.statusdone = 0;
									$item.pip = 0; //lastUpdate jadi sekarang
								}
								else if(response.data == '1')
								{
									$item.statusfile = 1;
									$item.pip = 0; //lastUpdate jadi sekarang
								}
					},function(error){
						$item.statusfile = $value;
					}
				);
			}

			$scope.changeStatusCTP = function($item)
			{
				//REQUEST to change to SERVER
				$value = $item.statusctp;
				$item.statusctp = -1;
				$http({
					"method": "POST",
					"url" 	: API_URL+"admin/tracking/chstctp",
					"data" 	: {
						"salesID" : $item.salesID,
						"cartID" : $item.cartID
					}
				}).then(
					function(response){
						$item.statusctp = $value;
						if(response.data!=null)
							if(typeof response.data === "string")
								if(response.data == '0')
								{
									$item.statusctp = 0;
									$item.statusprint = 0;
									$item.statuspacking = 0;
									$item.statusdelivery = 0;
									$item.statusdone = 0;
									$item.pip = 0; //lastUpdate jadi sekarang
								}
								else if(response.data == '1')
								{
									$item.statusfile = 1;
									$item.statusctp = 1;
									$item.pip = 0; //lastUpdate jadi sekarang
								}
					},function(error){
						$item.statusctp = $value;
					}
				);
			}

			$scope.changeStatusPrint = function($item)
			{
				//REQUEST to change to SERVER
				$value = $item.statusprint;
				$item.statusprint = -1;
				$http({
					"method": "POST",
					"url" 	: API_URL+"admin/tracking/chstprint",
					"data" 	: {
						"salesID" : $item.salesID,
						"cartID" : $item.cartID
					}
				}).then(
					function(response){
						$item.statusprint = $value;
						if(response.data!=null)
							if(typeof response.data === "string")
								if(response.data == '0')
								{
									$item.statusprint = 0;
									$item.statuspacking = 0;
									$item.statusdelivery = 0;
									$item.statusdone = 0;
									$item.pip = 0; //lastUpdate jadi sekarang
								}
								else
								{
									$item.statusfile = 1;
									$item.statusctp = 1;
									$item.statusprint = 1;
									$item.pip = 0; //lastUpdate jadi sekarang
								}
					},function(error){
						$item.statusprint = $value;
					}
				);
			}

			$scope.changeStatusPacking = function($item)
			{
				//REQUEST to change to SERVER
				$value = $item.statuspacking;
				$item.statuspacking = -1;
				$http({
					"method": "POST",
					"url" 	: API_URL+"admin/tracking/chstpackaging",
					"data" 	: {
						"salesID" : $item.salesID,
						"cartID" : $item.cartID
					}
				}).then(
					function(response){
						$item.statuspacking = $value;
						if(response.data!=null)
							if(typeof response.data === "string")
								if(response.data == '0')
								{
									$item.statuspacking = 0;
									$item.statusdelivery = 0;
									$item.statusdone = 0;
									$item.pip = 0; //lastUpdate jadi sekarang
								}
								else if(response.data == '1')
								{
									$item.statusfile = 1;
									$item.statusctp = 1;
									$item.statusprint = 1;
									$item.statuspacking = 1;
									$item.pip = 0; //lastUpdate jadi sekarang
								}
					},function(error){
						$item.statuspacking = $value;
					}
				);
			}

			$scope.changeStatusDelivery = function($item)
			{
				//REQUEST to change to SERVER
				$value = $item.statusdelivery;
				$item.statusdelivery = -1;
				$http({
					"method": "POST",
					"url" 	: API_URL+"admin/tracking/chstdelivery",
					"data" 	: {
						"salesID" : $item.salesID,
						"cartID" : $item.cartID
					}
				}).then(
					function(response){
						$item.statusdelivery = $value;
						if(response.data!=null)
							if(typeof response.data === "string")
								if(response.data == '0')
								{
									$item.statusdelivery = 0;
									$item.statusdone = 0;
									$item.pip = 0; //lastUpdate jadi sekarang
								}
								else if(response.data == '1')
								{
									$item.statusfile = 1;
									$item.statusctp = 1;
									$item.statusprint = 1;
									$item.statuspacking = 1;
									$item.statusdelivery = 1;
									$item.pip = 0; //lastUpdate jadi sekarang
								}
					},function(error){
						$item.statusdelivery = $value;
					}
				);
			}

			$scope.changeStatusDone = function($item)
			{
				//REQUEST to change to SERVER
				$value = $item.statusdone;
				$item.statusdone = -1;
				$http({
					"method": "POST",
					"url" 	: API_URL+"admin/tracking/chstdone",
					"data" 	: {
						"salesID" : $item.salesID,
						"cartID" : $item.cartID
					}
				}).then(
					function(response){
						$item.statusdone = $value;
						if(response.data!=null)
							if(typeof response.data === "string")
								if(response.data == '0')
								{
									$item.statusdone = 0;
									$item.pip = 0; //lastUpdate jadi sekarang
								}
								else if(response.data == '1')
								{
									$item.statusfile = 1;
									$item.statusctp = 1;
									$item.statusprint = 1;
									$item.statuspacking = 1;
									$item.statusdelivery = 1;
									$item.statusdone = 1;
									$item.pip = 0; //lastUpdate jadi sekarang
								}
					},function(error){
						$item.statusdone = $value;
					}
				);
			}

			$scope.selectVerif = function($item){
				$scope.modalselected = $item;
				$scope.modalselected.salesTime = $scope.makeDateTime($scope.modalselected.salesTime);
			};
			$scope.searchOnVerifs = function(){
				//console.log($scope.paiddatas);
				if ($scope.searchingkey == "")
					$scope.searchedpaiddatas = $scope.paiddatas;
				else
				{
					$scope.searchedpaiddatas = [];
					for ($i = 0; $i < $scope.paiddatas.length; $i++) {
						if($scope.isContained($scope.paiddatas[$i]['accname'], $scope.searchingkey)
							|| $scope.isContained($scope.paiddatas[$i]['accno']+"", $scope.searchingkey)
							|| $scope.isContained($scope.paiddatas[$i]['bankname']+"", $scope.searchingkey)
							|| $scope.isContained($scope.paiddatas[$i]['ammount']+"", $scope.searchingkey))
							$scope.searchedpaiddatas.push($scope.paiddatas[$i]);
					}
				}
			};
			$scope.isContained = function($string, $key){
				if ($string.toLowerCase().indexOf($key.toLowerCase()) != -1)
					return true;
				else
					return false;
			};

			$scope.setHeaderFromValue = function($salesheader){
				$scope.headerselected = $salesheader;
				//console.log($scope.headerselected);
				/*$temp = $salesheader.tempo.split(' ')[0];
				$temp = $temp.split('-');
				$scope.headerselected.tempo = new Date($temp[0], $temp[1]-1, $temp[2]);*/
				$scope.getDetailData($salesheader.salesID);

			};

			$scope.setDetailFromValue = function($salesdetail){
				$scope.detailselected = $salesdetail;
				$scope.getCartData($salesdetail.cartID);
			}

			$scope.totalDetail = 0;
			$scope.getDetailData = function($id){
				$http(
					{
						method : 'GET',
						url : API_URL + 'salesdetails/'+$id+'/header'
					}
				).then(function(response) {
					$scope.salesdetails = response.data;
					$scope.totalDetail = 0;
					for($i = 0; $i < response.data.length; $i++){
						$scope.totalDetail = $scope.totalDetail + parseInt(response.data[$i].totalprice);
					}
				});
			}

			$scope.makeManualPayment = function($header, $index)
			{
				if($header != null)
				{
					$scope.getCustomerBankAccs($header.customerID);
					//all accs will be stored at $scope.customerbankaccs (var)
					//kalo kosong, bisa tambahin di modal langsung

					$scope.getbanks(function(data){
						//whendone
						$scope.banks = data;
						$.each($scope.banks, function($i, $ii){
							if($ii.alias == "BCA"){
								$scope.selectedbank = $ii;
							}
						});

						//d sm job here
						$selectedindex = $index;
						$scope.selectedheader = $scope.clone($header);
						$scope.selectedammount = 10000;
						$('#manualPaymentModal').modal('show');
						$dt = new Date();
						$scope.selectedpaydate = $scope.makeDate($dt.getDateOnly());
					}, function(){
						//error
						console.log("Gagal ambil data banks");
					});

				}
			}

			$scope.makePaymentVerif = function($payment, $selectedindex)
			{
				/*$scope.selectedverif = {
					"salesID" : $payment.salesID,
					"paymentID" : $payment.id,
					"ammount" : $payment.ammount,
					"note" : "#job"+$scope.zeroFill($payment.salesID, 5),
					"paydate" : $payment.paydate,
					"custaccbank" : $payment.customeracc.bank.bankname,
					"compaccbank" : $payment.companyacc.bank.alias,
					"custaccno" : $payment.customeracc.accno,
					"compaccno" : $payment.companyacc.accno,
					"custaccname" : $payment.customeracc.accname,
					"compaccname" : $payment.companyacc.accname,
					"veriftime" : $payment.veriftime
				};*/
				$scope.selectedverif = $payment;
				$scope.selectedverif.note = "#job"+$scope.zeroFill($payment.salesID, 5);
				$scope.selectedverif.selectedindex = $selectedindex;
				//console.log($scope.selectedverif);
				//default variable will be shown from $scope.selectedverif;
				$('#paymentVerifModal').modal('show');
			}

			$scope.submitPaymentVerif = function(){
				if($scope.selectedverif.veriftime == null)
				{
					$http({
						"method" 	: "POST",
						"url" 		: API_URL+"admin/verif/store",
						"data"		: {
							"salesID" : $scope.selectedverif.salesID,
							"paymentID"	: $scope.selectedverif.id,
							"ammount"	: $scope.selectedverif.ammount,
							"verifnote"	: $scope.selectedverif.note,
						}
					}).then(function(response){
						if(response.data != null)
							if(typeof response.data === 'string')
							{
								if (response.data == "success")
								{
									$dt = new Date();
									$scope.selectedverif.veriftime = $dt.getDateOnly();
								}
							}
					},function(error){});
				}
			}

			$scope.showSentConfirm = function($item){
				$scope.selecteddelivery = $scope.clone($item);
				$scope.selecteddelivery.arrivedtime = new Date(Date.parse($scope.selecteddelivery.arrivedtime));
				$.each($scope.selecteddelivery.salesdeliverydetail, function($index, $item){
					$item.deliveryshow = false;
					$item.weight = parseFloat($item.weight);
				});
				//console.log($scope.selecteddelivery);
				$('#sentConfirmModal').modal('show');
			}

			$scope.showAddDelivery = function($index, $salesID){
				$scope.selectedheaderindex = $index;
				$scope.selectedheaderid = $salesID;

				$('#addDeliveryModal').modal('show');
				$('#addDeliveryModal').on('shown.bs.modal', function () {
					if($scope.headers[$scope.selectedheaderindex].customer.customeraddress != null){
						if($scope.headers[$scope.selectedheaderindex].customer.customeraddress.length > 0){
							$scope.newdelivery.deliveryaddressID = $scope.headers[$scope.selectedheaderindex].customer.customeraddress[$scope.headers[$scope.selectedheaderindex].customer.customeraddress.length-1].addressID;
						}
					}
				});
			}

			$scope.updateDelivery = function(){
				$date = $scope.selecteddelivery.arrivedtime;
				$scope.selecteddelivery.delivtime = $date.getFullYear()+"-"+$scope.zeroFill($date.getMonth(),2)+"-"+$scope.zeroFill($date.getDate(),2)+" "+$scope.zeroFill($date.getHours(),2)+":"+$scope.zeroFill($date.getMinutes(),2)+":"+$scope.zeroFill($date.getSeconds(),2);

				$scope.updateDeliveryUniversal();
			}

			$scope.sentConfirm = function(){
				$date = $scope.selecteddelivery.arrivedtime;
				$scope.selecteddelivery.delivtime = $date.getFullYear()+"-"+$scope.zeroFill($date.getMonth(),2)+"-"+$scope.zeroFill($date.getDate(),2)+" "+$scope.zeroFill($date.getHours(),2)+":"+$scope.zeroFill($date.getMinutes(),2)+":"+$scope.zeroFill($date.getSeconds(),2);

				$.each($scope.selecteddelivery.salesdeliverydetail, function($index, $item){
					$item.status = 2;
				});

				console.log($scope.selecteddelivery);

				$scope.updateDeliveryUniversal();
			}

			$scope.printDeliveryNote = function($item){
				$scope.selecteddelivery = $scope.clone($item);
				$scope.selecteddelivery.delivtime = $scope.selecteddelivery.arrivedtime;
				$.each($scope.selecteddelivery.salesdeliverydetail, function($index, $item){
					$item.status = 1;
					$item.weight = parseFloat($item.weight);
				});

				$scope.updateDeliveryUniversal();
			}

			//INPUT DATANYA DARI SELECTEDDELIVERY
			$scope.updateDeliveryUniversal = function(){
				$http({
					"method" : "POST",
					"url"    : AJAX_URL+"admin/sales/delivery/update",
					"data"   : $scope.selecteddelivery
				}).then(function(response){
					if(typeof response.data === "string")
					{
						if(response.data == "success")
						{
							$window.location.href=BASE_URL+"admin/allsales";
						}
					}
				});
			}

			$scope.showUpdateDelivery = function($item){
				$scope.selecteddelivery = $scope.clone($item);
				$scope.selecteddelivery.arrivedtime = new Date(Date.parse($scope.selecteddelivery.arrivedtime));
				$.each($scope.selecteddelivery.salesdeliverydetail, function($index, $item){
					$item.deliveryshow = false;
					$item.weight = parseFloat($item.weight);
				});
				//console.log($scope.selecteddelivery);
				$('#updateDeliveryModal').modal('show');
			}


			$scope.getCartData = function($id){
				$http(
					{
						method : 'GET',
						url : API_URL + 'cartdetails/'+$id+'/header'
					}
				).then(function(response) {
					$scope.cartdetails = response.data;
				});
			}
			$scope.cancelUpdate = function(){
				$('#btn-cancel').attr('hidden', 'hidden');
				$('#btn-add').removeAttr('hidden');
				$('#btn-update').removeClass('btn-primary').addClass('btn-second').attr('disabled', 'disabled');
				$('#form-open').attr('action', $scope.URL+'salesheader');
				$('#form-method').val('POST');
			}
			
			$scope.fillPapers.call();

			$scope.getVerifData = function()
			{
				console.log('DEPRECATED: verif');
				$http(
					{
						method : 'GET',
						url : API_URL + 'verif'
					}
				).then(function(response) {
					console.log(response.data);
					$scope.paiddatas = response.data;
					$scope.searchOnVerifs();
					//$('#form-paperID').children().remove();
				});
			};
			//$scope.getVerifData.call();

			$scope.getCustomerBankAccs = function($customerID)
			{
				$scope.customerbankaccs = null;
				$http(
					{
						method : 'GET',
						url : AJAX_URL + 'bankaccs/customer/' + $customerID
					}
				).then(function(response) {
					if(response.data != null)
						if(Array.isArray(response.data)){
							$scope.customerbankaccs = response.data;

							if($scope.customerbankaccs.length>0)
								$scope.selectedcustacc = $scope.customerbankaccs[0];
						}
				}, function(error){
					console.log(errormessage);
				});
			};

			$scope.fillCompanyBankAccs(function(response){
				$scope.companybankaccs = response;
				if($scope.companybankaccs != null){
					if($scope.companybankaccs.length > 0){
						$scope.selectedcompacc = $scope.companybankaccs[0];
					}
				}
			});

			$scope.deleteheader = function($salesheader, $index){
				$http({
					method: "POST",
					url: AJAX_URL+"admin/salesheader/"+$salesheader.id+"/delete"
				}).then(function(response){
					if(response.data!=null)
					{
						if(response.data instanceof Array)
						{
							if(response.data[0] == 1){
								$scope.headers.splice($index, 1);
							}
						}
					}
				});
			}

			$scope.verify = function()
			{
				$http(
					{
						method 	: 'POST',
						url 	: API_URL + 'verif/store',
						data 	: {
							'id' 		: $scope.modalselected.salesID
						}
					}
				).then(function(response) {
					console.log(response.data);
				});
			}

			$scope.resetCommitPreview = function($cartpreview){
				$http({
					method: "POST",
					url: AJAX_URL+"commit/cartpreview/"+$cartpreview.id+"/undo"
				}).then(function(response){
					if(response.data != null){
						if(response.data.constructor === String){
							if(response.data == "success")
								$cartpreview.commit = 0;
						}
					}else{
						console.log("Error, tidak ada return value..");
					}
				});
			}

			$scope.deletePreview = function($cartpreview, $salesdetail, $index){
				$http({
					method: "POST",
					url: AJAX_URL+"admin/cartpreview/"+$cartpreview.id+"/delete"
				}).then(function(response){
					if(response.data != null){
						if(response.data.constructor === String){
							if(response.data == true){
								$salesdetail.cartheader.cartpreview.splice($index, 1);
							}
						}else{
							console.log("Failed to delete");
						}
					}else{
						console.log("Cartpreview data not found in database");
					}
				});
			}

			$scope.addprooffile = function($item){
				$scope.selectedsalesdetail = $item;
				$("#addprooffileModal").modal("show");
			}

			$scope.sendwacommit = function($url, $pid, $sid){
				$window.open("http://wa.me/?text=Silahkan+cek+sebelum+di+print.+Mohon+untuk+ketelitian+dalam+pengecekan+huruf+dalam+text%2C+letak+atau+posisi+gambar%2C+warna%2C+dan+tulisan+yang+tertera+pada+hasil+cetakan.+Kami+tetap+berusaha+untuk+memberikan+yang+terbaik.%0D%0A%0D%0ACek%20di%20"+$url+"sales%2Fall%3Fs%3D"+$sid+"%26a%3Dproof%26aa%3D"+$pid);
			}
			
			$scope.searchingkey = "";
			$scope.modal = {
				bankID : 5,
				accno: "",
				accname: "",
				acclocation: ""
			};


			


			$scope.printworkorder = function(item){
				console.log(item);
				var linewidth = 1;

				var winparams = 'dependent=no,locationbar=no,scrollbars=no,menubar=no,'+
					'resizable,screenX=450,screenY=0,width=270,height=500';

				var bootstrap = '<link async rel="stylesheet" href="'+BASE_URL+'css/bootstrap.css?version=0.2">';

				var scss = "<style type='text/css' media='print'>"
						+"@page "
						+"{ "
						+"	size: auto; "
						+" margin: 0mm; "
						+"}"
						+"</style>"
						+"<script src='"+BASE_URL+"js/jquery.min.js'></script>"
						+"<script src='"+BASE_URL+"script/constants/JsBarcode.ean-upc.min.js'></script>"
						+"<link async rel='stylesheet' href='"+BASE_URL+"css/onlyprint.css'>";
				//scss to remove HEADER AND FOOTER

				var prebarcode = app.logoforprint;


				prebarcode += 'Nomor Job. ' + $scope.zeroFill(item.id, 4) + ' -- ' 
					+ $scope.zeroFill(item.created_at.getDate(), 2)+'/'+$scope.zeroFill(item.created_at.getMonth(), 2)+'/'+item.created_at.getFullYear()+'<br>'
					+ item.customer.name + ' '
					+ item.customer.phone1 + '<br><br>';
				prebarcode += item.paymentdetail;

				var afterbarcode = "<div class='barcode-label'>";

				var barcode = "";
				barcode = '110'+$scope.zeroFill(item.id, 8);
				
				afterbarcode += '</div>';
				prebarcode += '<br>';


				afterbarcode += '<hr class="solid"><br>';
				$.each(item.salesdetail, function($i, $salesdetail){
					afterbarcode += '<div class="title">'
						+ $salesdetail.cartheader.jobsubtype.name
						+ ' <b>' + $salesdetail.cartheader.jobtitle
						+ '</b></div>'
						+	'<div class="">'
						+ $salesdetail.cartheader.quantity.toString().addThousandSeparator()
						+ ' ' + $salesdetail.cartheader.quantitytypename;

					afterbarcode += '<span class="pull-xs-right">'
						+ $salesdetail.cartheader.cartfile.length
						+ ' files.'
						+ '</span>';

					afterbarcode += '</div>';
					if($salesdetail.cartheader.cartfile.length>1){
						$.each($salesdetail.cartheader.cartdetail, function($j, $cartfile){
							afterbarcode += '<div>'
								+ 'Nama file: '
								+ $cartfile.file.filename 
								+ '</div>';
						});
					}


					$.each($salesdetail.cartheader.cartdetail, function($j, $cartdetail){
						afterbarcode += '<div class="detail">';

						if($salesdetail.cartheader.cartdetail.length>1)
							afterbarcode += '> <b>'+$cartdetail.cartname+'</b><br>';

						afterbarcode += ($cartdetail.jobtype=='OF'?"OFFSET":$cartdetail.jobtype=='DG'?"DIGITAL":"OTHER")
							+ ' ' + $cartdetail.printer.machinename + '<br>'
							+ $cartdetail.totaldruct + ' druct'
							+ ' +ins. '
							+ $cartdetail.inschiet + '<br>'
							+ 'AREA JADI&nbsp; : ' + $cartdetail['imagewidth']
							+ ' x ' + $cartdetail['imagelength'] + ' CM <br>'
							+ '> Susunan ' + $cartdetail.totalinprintx + ' x ' + $cartdetail.totalinprinty + ' + ' + $cartdetail.totalinprintrest + ' = '+$cartdetail.totalinprint+'<br>'
							+ 'Uk. Kertas : ' + $cartdetail['printwidth']
							+ ' x ' + $cartdetail['printlength'] + ' CM <br>'
							+ 'Uk. PLANO&nbsp; : ' + $cartdetail['plano']['width']
							+ ' x ' + $cartdetail['plano']['length'] + ' CM'
							+ '<hr class="dashed">'
							+ $cartdetail.paper.papertype.name + ': '
							+ $cartdetail.paper.name + ' '
							+ $cartdetail.paper.color + ' '
							+ $cartdetail.paper.gramature + 'gsm <br>'
							+ $cartdetail.vendor.name + ' '
							+ $cartdetail.vendor.phone1 + '<br>'
							+ 'Beli ' + $cartdetail.totalplano.toString().addThousandSeparator() + ' plano belah '+$cartdetail.totalinplano+'<br>'
							+ '> Pembagian ' + $cartdetail.totalinplanox + ' x ' + $cartdetail.totalinplanoy + ' + ' + $cartdetail.totalinplanorest + ' = '+$cartdetail.totalinplano+'<br>'
							+ 'Kira-kira Rp ' + $cartdetail.totalpaperprice.toString().addThousandSeparator()
							+ '<hr class="dashed">';

						if($cartdetail.employeenote.length > 1){
							afterbarcode += 'Catatan kerja, '
							+ $cartdetail.employeenote + '.'
						}


						$.each($cartdetail.cartdetailfinishing, function($k, $cartdetailfinishing){

							afterbarcode += '<div class="">'
								+	'- ' + $cartdetailfinishing.finishing.name
								+ ', '
								+ $cartdetailfinishing.finishingoption.optionname
								+ '</div>';
						});

						afterbarcode += '</div>';
					});
					afterbarcode += '<hr class="solid"><br><br>';
				});

				afterbarcode += '<div class="text-xs-center">Selamat bekerja</div>';

				var htmlPop = scss
						+ '<div class="view-small-invoice">'
						+	prebarcode
						+ '<div class="text-xs-center">'
						+ '	<svg class="barcode"'
						+	'		jsbarcode-format="upc"'
						+	'		jsbarcode-value="'+barcode+'"'
						+	'		jsbarcode-textmargin="0"'
						+	'		jsbarcode-margintop="5"'
						+	'		jsbarcode-marginright="0"'
						+	'		jsbarcode-marginbottom="2"'
						+	'		jsbarcode-marginleft="0"'
						+	'		jsbarcode-height="25"'
						+	'		jsbarcode-fontsize="10"'
						+	'		jsbarcode-fontoptions="normal">'
						+	'	</svg>'
						+ '</div>'
						+ afterbarcode
						+ '</div>'
						+ '<script>'
						+ 'JsBarcode(".barcode").init();'
						+ '</script>'; 

				var printWindow = window.open ("", "PDF", winparams);
				printWindow.document.write (scss+htmlPop);
				printWindow.document.close();

				var intv = setInterval(function(){
					printWindow.focus();
					printWindow.print();
					clearInterval(intv);
					//printWindow.close();
				}, 200);
			}


		}
	]);
};