module.exports = function(app){
	app.controller('AdminSalesController', ['$timeout', '$scope', '$http', 'API_URL', 'BASE_URL', '$window',
		function($timeout, $scope, $http, API_URL, BASE_URL, $window){
			$scope.initHeader = function($headers, $deliveries, $couriers, $activeemployee){
				$scope.headers = JSON.parse($headers);
				$scope.deliveries = JSON.parse($deliveries);
				$scope.couriers = JSON.parse($couriers);
				$activeemployee = parseInt($activeemployee);

				$.each($scope.headers, function($i, $item) {
					$scope.headers[$i].updated_at = $scope.makeDateTime($item.updated_at+"");
					$scope.headers[$i].created_at = $scope.makeDateTime($item.created_at+"");
					$scope.headers[$i].showdetail = false;
					$scope.headers[$i].showdelivery = false;
					$scope.headers[$i].showpayment = false;

					$item.totalprice = 0;
					
					if($scope.couriers.length>0)
						$courierID = $scope.couriers[0].id;
					$.each($scope.couriers, function($az, $courier){
						if($courier.id == $activeemployee)
							$courierID = $activeemployee;
					});

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
					})

					$.each($item.salesdelivery, function($index, $item2){
						$item2.created_at = Date.parse($item2.created_at);
					});

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

					//d sm job here
					$selectedindex = $index;
					$scope.selectedheader = $scope.clone($header);
					$scope.selectedammount = 10000;
					$('#manualPaymentModal').modal('show');
					$dt = new Date();
					$scope.selectedpaydate = $scope.makeDate($dt.getDateOnly());
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
				console.log($scope.selectedverif);
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

			$scope.submitManualPayment = function(){
				if($scope.selectedammount == null)
				{
					console.log('tidak boleh 0');
				}
				else if($scope.selectedammount < 10000)
				{
					console.log('tidak boleh 0');
				}
				else
				{
					$http({
						"method" 	: "POST",
						"url" 		: API_URL+"admin/payment/"+$scope.selectedheader.salesID,
						"data"		: {
							"ammount" : $scope.selectedammount,
							"custacc"	: $scope.selectedcustacc.id,
							"paydate"	: $scope.selectedpaydate.getDateOnly(),
							'compacc' : $scope.selectedcompacc.id
						}
					}).then(function(response){
						if(response.data != null)
							if(typeof response.data === 'string')
							{
								if (response.data == "success")
								{
									$dt = new Date();
									
									$arr = {
										'paydate' : $scope.selectedpaydate.getDateOnly(),
										'veriftime' : $dt.getDateOnly(),
										'ammount' : $scope.selectedammount
									}

									$scope.headers[$selectedindex].payments.push($arr);
									$totalpayment = 0;
									$.each($scope.headers[$selectedindex].payments, function($index, $item){
										$totalpayment += $item.ammount;
									});
									$scope.headers[$selectedindex].totalpayment = $totalpayment;
									$scope.selectedheader = $scope.clone($scope.headers[$selectedindex]);
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
					"url"    : API_URL+"admin/sales/delivery/update",
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

			$scope.setDeliverydetail = function($detail){
				$detail.deliveryselected = !$detail.deliveryselected;
				if($detail.deliveryselected==true)
				{
					//cek dulu uda ada ato belom
					$notfound = true;
					$.each($scope.newdelivery.deliverydetail, function($i, $ii){
						if($ii.salesdetailID == $detail.id)
						{
							$notfound = false;
						}
					});

					if($notfound == true){
						$temp = $scope.clone($detail);
						$scope.newdelivery.deliverydetail.push({
							"salesdetailID" : $temp.id,
							"deliveryshow" : false,
							"totalweight" : 0,
							"totalpackage" : 1,
							"ammount" : parseInt($temp.cartheader.quantity),
							"actualprice" : parseInt($temp.cartheader.deliveryprice),
							"totalquantity" : parseInt($temp.cartheader.quantity),
							"quantitytypename" : $temp.cartheader.quantitytypename,
							"jobtitle" : $temp.cartheader.jobsubtype.name + " " + $temp.cartheader.jobtitle
						});
					}
				}
				else
				{
					$.each($scope.newdelivery.deliverydetail, function($i, $ii){
						if($ii.salesdetailID == $detail.id){
							$scope.newdelivery.deliverydetail.splice($i, 1);
							return false;
						}
					});
				}
			}

			$scope.saveDelivery = function(){
				//DARI DIALOG BOX, MODAL
				
				$time = $scope.newdelivery.arrivedtime;
				$date = $scope.newdelivery.arriveddate;
				$scope.newdelivery.delivtime = $date.getFullYear()+"-"+$scope.zeroFill($date.getMonth(),2)+"-"+$scope.zeroFill($date.getDate(),2)+" "+$scope.zeroFill($time.getHours(),2)+":"+$scope.zeroFill($time.getMinutes(),2)+":"+$scope.zeroFill($time.getSeconds(),2);

				$http(
					{
						method: "POST",
						url   : API_URL+"admin/sales/delivery/"+$scope.selectedheaderid+"/store",
						data  : $scope.newdelivery	
					}
				).then(function(response){
					if(typeof response.data === "string")
					{
						if(response.data == "success")
						{
							$window.location.href=BASE_URL+"admin/allsales";
						}
					}
				});
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
						url : API_URL + 'bankaccs/customer/' + $customerID
					}
				).then(function(response) {
					if(response.data != null)
						if(response.data.constructor === Array){
							$scope.customerbankaccs = response.data;

							if($scope.customerbankaccs.length>0)
								$scope.selectedcustacc = $scope.customerbankaccs[0];
						}
				});
			};

			$scope.fillCompanyBankAccs();

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
					url: API_URL+"commit/cartpreview/"+$cartpreview.id+"/undo"
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

			$scope.deletePreview = function($cartpreviewID, $salesdetail){
				$http({
					method: "POST",
					url: API_URL+"admin/cartpreview/"+$cartpreviewID+"/delete"
				}).then(function(response){
					if(response.data != null){
						if(reponse.data.constructor !== String){
							$scope.selectedsalesdetail = response.data;
						}else{
							console.log(response.data);
						}
					}else{
						console.log("Error, tidak ada return value..");
					}
				});
			}

			$scope.addprooffile = function($item){
				$scope.selectedsalesdetail = $item;
				$("#addprooffileModal").modal("show");
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
			
			$scope.searchingkey = "";
			$scope.modal = {
				bankID : 5,
				accno: "",
				accname: "",
				acclocation: ""
			};


			//UPLOAD ON modals/ADDPROOFFILE.blade.php
			$scope.uploadpreviewClick = function($cartID, $index)
			{
				$("#uploadpreview").click();
				//$scope.activeCustomerID = $custID;
				$scope.activeCartID = $cartID;
			}
			
			$('#uploadpreview').on('change', function(e) 
			{ 
				console.log($(this)[0].files);
				if ($(this)[0].files){
					if ($(this)[0].files.length > 0) {
						$scope.uploadpreview($(this)[0].files, $scope.activeCartID);
					}
				} 
				return false;
			});

			$scope.uploadpreview = function(files, cartID){
				var data = new FormData();
				$scope.uploaderror = '';
				$scope.uploadwaiting = true;

				angular.forEach(files, function(value){
					$ext = value.name.substring(value.name.lastIndexOf('.') + 1);
					if ($ext != 'tiff' &&
						$ext != 'tif' &&
						$ext != 'jpg' &&
						$ext != 'jpeg') //indesign
					{
						//FORMAT NGACOK
						$scope.uploaderror = value.name+" : tidak bisa upload dengan file format "+$ext+".";
					}
					else if(value.size > 50 * 1024 * 1024)
					{
						$scope.uploaderror = value.name+" : file terlalu besar.";
					}
					else 
					{
						$scope.uploaderror = "";
						//BERHASIL -> ADD files[] ke data
						data.append("files[]", value);
						//data.append('jobsubtypeID', $scope.selected.jobsubtypeID);
						//jobsubtypeID -> dibuang, ditambahkan dengan user dapat mengganti filename dan deskripsi
					}
				});
				
				$http({
					method: 'POST',
					url: API_URL+'upload/preview/'+cartID,
					data: data,
					withCredentials: true,
					headers: {'Content-Type': undefined },
					transformRequest: angular.identity
				}).then(function(response) {
					if(response.data!=null)
					{
						if(response.data.constructor === Array)
						{
							$scope.selectedsalesdetail.cartheader.cartpreview = response.data;
						}
						else
							console.log(response);
					}
					else
					{
						console.log(response);
					}
					$scope.uploadwaiting = false;
					$scope.allowed();
				}).error(function(error) {
					$scope.error.files = "Error file (error not detected), call customer service for this error";
					$scope.uploadwaiting = false;
				});

				//buat apus file abis d input
				//$scope.clearFileInput('file');
			}
		}
	]);
};