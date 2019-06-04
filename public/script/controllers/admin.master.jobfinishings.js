module.exports = function(app) {
	app.controller('AdmJobfinishingsController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window) {

			$scope.jobtypes = null;
			$scope.saving = false;
			$scope.activejobtype = 0;

			$scope.initData = function($input) {
				$scope.jobtypes = JSON.parse($input);

				//BUAT TOTAL FINISHING OF DAN DG per jobtypes
				if ($scope.jobtypes != null) {
					$.each($scope.jobtypes, function($index, $item) {
						if ($item != null) {
							$.each($item.jobsubtype, function($index2, $item2) {
								if ($item2 != null) {
									$item2.totalOF = 0;
									$item2.totalDG = 0;
									$.each($item2.jobsubtypefinishing, function($index3, $item3) {
										if ($item3 != null) {

											if ($item3.ofdg == 1) $item2.totalOF++;
											else if ($item3.ofdg == 2) $item2.totalDG++;

										}
									});
								}
							});
						}
					});
				}
				$scope.hideall();
				$scope.closeallchangeprice();
			}

			$scope.hideall = function(){
				if ($scope.jobtypes != null) {
					$.each($scope.jobtypes, function($index, $item) {
						if ($item != null) {
							$.each($item.jobsubtype, function($index2, $item2){
								if ($item2 != null) {
									$item2.editmode = false;	
									$.each($item2.jobsubtypefinishing, function($index3, $item3){
										if($item3!=null){
											$item3.showoptions = false;
										}
									});
								}
							});
						}
					});
				}
			}

			$scope.hidealloptions = function() {
				if ($scope.jobtypes != null) {
					$.each($scope.jobtypes, function($index, $item) {
						if ($item != null) {
							$.each($item.jobsubtype, function($index2, $item2) {
								if ($item2 != null) {
									$.each($item2.jobsubtypefinishing, function($index3, $item3) {
										if ($item3 != null) {
											$item3.showoptions = false;
										}
									});
								}
							});
						}
					});
				}
			}

			$scope.showoptions_clicked = function($item){
				if(!$item.showoptions){
					$scope.hidealloptions();
					$item.showoptions = true;
				}else{
					$scope.hidealloptions();
				}
			}

			$scope.prevlist = function(){
				if ($scope.activejobtype > 0)
					$scope.activejobtype--;
			}

			$scope.nextlist = function() {
				if ($scope.activejobtype < $scope.jobtypes.length-1)
					$scope.activejobtype++;
			}

			$scope.toggleedit = function ($item){
				$temp = $item.editmode;
				//hideall
				$scope.hideall();
				$item.editmode = !$temp;
			}

			$scope.togglesubtype = function($jobsubtype, $subtypeindex, $jobtypeindex){
				$id = $jobsubtype.id;
				$http({
					method: "POST",
					url: AJAX_URL+"jobsubtype/"+$id+"/activate",
					data: $jobsubtype.active
				}).then(function(response){
					if(response != null)
						if(typeof response.data == "string")
							if(response.data == "success"){
								$jobsubtype.errormessage = "<b class='tx-success'>success!</b>";

								console.log('subtypeindex: ' + $subtypeindex + " ---  jobindex: " + $jobtypeindex);
								if ($jobsubtype.active == 0)
									$scope.jobtypes[$jobtypeindex].jobsubtype[$subtypeindex].active = 1;
								else
									$scope.jobtypes[$jobtypeindex].jobsubtype[$subtypeindex].active = 0;
							}else{
								$jobsubtype.errormessage = "<span class='tx-danger'>"+response.data+"</span>";
							}
							console.log(response.data);
				}, function(error){
					console.log(error);
					$jobsubtype.errormessage = "<span class='tx-danger'>ERROR system, read console.</span>";
				});
			}

			$scope.closeallchangeprice = function() {
				if ($scope.jobtypes != null) {
					$.each($scope.jobtypes, function($index, $item) {
						if ($item != null) {
							$.each($item.jobsubtype, function($index2, $item2) {
								if ($item2 != null) {
									$.each($item2.jobsubtypefinishing, function($index3, $item3) {
										if ($item3 != null) {
											$.each($item3.finishing.finishingoption, function($index4, $item4){
												$item4.pricebaseinput = false;
												$item4.newpricebase = $item4.pricebase;
												$item4.priceminiminput = false;
												$item4.newpriceminim = $item4.priceminim;
												$item4.priceinput = false;
												$item4.price = parseFloat($item4.price);
												$item4.newprice = $item4.price;
											});
										}
									});
								}
							});
						}
					});
				}
			}

			$scope.changepricebase = function($item) {
				$scope.closeallchangeprice();
				$item.pricebaseinput = true;
			}

			$scope.changeprice = function($item) {
				$scope.closeallchangeprice();
				$item.priceinput = true;
			}

			$scope.changepriceminim = function($item) {
				$scope.closeallchangeprice();
				$item.priceminiminput = true;
			}

			$scope.changeoptionpricebyid = function($id, $priceminim, $price, $pricebase){
				if ($scope.jobtypes != null) {
					$.each($scope.jobtypes, function($index, $item) {
						if ($item != null) {
							$.each($item.jobsubtype, function($index2, $item2) {
								if ($item2 != null) {
									$.each($item2.jobsubtypefinishing, function($index3, $item3) {
										if ($item3 != null) {
											$.each($item3.finishing.finishingoption, function($index4, $item4) {
												if($item4.id == $id){
													$item4.priceminim = $priceminim;
													$item4.pricebase = $pricebase;
													$item4.price = $price;
												}
											});
										}
									});
								}
							});
						}
					});
				}
			}

			$scope.savepriceminim = function($item){
				console.log("SAVE PRICE MINIM");
				$saveloading = true;
				$http({
					method: "POST",
					url: AJAX_URL+"finishingoption/priceminim/update",
					data: {
						"priceminim": $item.newpriceminim,
						"id": $item.id
					}
				}).then(function(response){
					if(response!=null){
						if(response.data != null){
							if(typeof response.data == "string"){
								if(response.data == "success"){
									//GANTI SEMUA FINISHINGOPTIONID yang sesuai jadi harga itu

									$scope.changeoptionpricebyid($item.id, $item.newpriceminim, $item.price, $item.pricebase);

									console.log("perubahan berhasil");
								}else if(response.data == "no changes"){
									console.log('tidak ada perubahan pada database');
								}else if(response.data == "not found"){
									console.log('error, id not found');
									$window.location.reload();
								}

								$scope.closeallchangeprice();
							}
						}else{
							console.log("The return value is null, not error");
						}
					}
				}, function(error){
					console.log(error);
				});
			}
			$scope.saveprice = function($item) {
				console.log("SAVE PRICE");
				$saveloading = true;
				$http({
					method: "POST",
					url: AJAX_URL + "finishingoption/price/update",
					data: $item.newprice
				}).then(function(response) {
					if (response != null) {
						if (response.data != null) {
							if (typeof response.data == "string") {
								if (response.data == "success") {
									//GANTI SEMUA FINISHINGOPTIONID yang sesuai jadi harga itu
									$scope.changeoptionpricebyid($item.id, $item.priceminim, $item.newprice, $item.pricebase);

									console.log("perubahan berhasil");
								} else if (response.data == "no changes") {
									console.log('tidak ada perubahan pada database');
								} else if (response.data == "not found") {
									console.log('error, id not found');
									$window.location.reload();
								}

								$scope.closeallchangeprice();
							}
						} else {
							console.log("The return value is null, not error");
						}
					}
				}, function(error) {
					console.log(error);
				});
			}

			$scope.savepricebase = function($item) {
				console.log("SAVE PRICE BASE");
				$saveloading = true;
				$http({
					method: "POST",
					url: AJAX_URL + "finishingoption/pricebase/update",
					data: $item.newpricebase
				}).then(function(response) {
					if (response != null) {
						if (response.data != null) {
							if (typeof response.data == "string") {
								if (response.data == "success") {
									//GANTI SEMUA FINISHINGOPTIONID yang sesuai jadi harga itu

									$scope.changeoptionpricebyid($item.id, $item.priceminim, $item.price, $item.newpricebase);

									console.log("perubahan berhasil");
								} else if (response.data == "no changes") {
									console.log('tidak ada perubahan pada database');
								} else if (response.data == "not found") {
									console.log('error, id not found');
									$window.location.reload();
								}

								$scope.closeallchangeprice();
							}
						} else {
							console.log("The return value is null, not error");
						}
					}
				}, function(error) {
					console.log(error);
				});
			}

			$scope.changemustdo = function($id, $item) {
				$http({
					method: "POST",
					url: AJAX_URL + "jobsubtypefinishing/" + $id + "/changemustdo"
				}).then(function(response) {
					if (response != null) {
						if (response.data != null) {
							if (typeof response.data == "string") {
								$item.mustdo = response.data == 1 ? true : false;
							}
						} else {
							console.log("ID Not found");
						}
					}
				}, function(error) {
					console.log(error);
				});
			}

			$scope.tambahfinishing = function(){
				$("#addnewfinishing").modal('show');
			}
			$scope.ofdgchanged = function(){
				$scope.ofdg = false;
				console.log("abc");
			}
		}
	]);
};