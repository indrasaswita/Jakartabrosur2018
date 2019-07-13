module.exports = function(app) {
	app.controller('AdmJobquantitiesController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window) {

			$scope.jobtypes = null;
			$scope.saving = false;
			$scope.activejobtype = 0;
			$scope.selectedquantity = null;
			$scope.coatingtypes = [];
			$scope.selectedcoatid = 0;
			$scope.newquantities = [];
			$scope.quantities = [];
			$scope.addloading = false;
			$scope.selectedjobsubtype = null;

			$scope.quantitiesdefault = [
					1, 2, 5, 10, 20, 50, 100, 250, 500, 1000, 2000, 5000, 10000, 20000, 50000, 100000
				];

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
									$.each($item2.jobsubtypequantity, function($index3, $item3) {
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

			$scope.addjobquantityOF = function($quantity) {
				if ($quantity.addflagOF)
					$quantity.addflagOF = false;
				else
					$quantity.addflagOF = true;
				//$scope.addjobquantity('OF', $quantity);
			}

			$scope.addjobquantityDG = function($quantity) {
				if($quantity.addflagDG)
					$quantity.addflagDG = false;
				else	
					$quantity.addflagDG = true;
				//$scope.addjobquantity('DG', $quantity);
			}

			$scope.addjobquantityAll = function(){
				$quantityDG = $scope.newquantitiesDG;
				$quantityOF = $scope.newquantitiesOF;

				$addnewquantities = [];

				$.each($quantityOF, function($index, $item){
					if($item.addflagOF){
						$temp = {
							"quantityID": $item.id,
							"ofdg": "1", //OF : 1
							"jobsubtypeID": $scope.selectedjobsubtype.id,
							"favourite": 0
						};
						$addnewquantities.push($temp);
					}
				});
				$.each($quantityDG, function($index, $item) {
					if ($item.addflagDG) {
						$temp = {
							"quantityID": $item.id,
							"ofdg": "2", //DG : 2
							"jobsubtypeID": $scope.selectedjobsubtype.id,
							"favourite": 0
						};
						$addnewquantities.push($temp);
					}
				});

				//$addnewquantities semua data yang bakal di add ke server
				//console.log($addnewquantities);

				//$scope.addloading = true;
				$http({
					method: "POST",
					url: AJAX_URL+"jobsubtypequantity/store",
					data: $addnewquantities
				}).then(function(response){
					if(response!=null){
						if(response.data != null){
							if(typeof response.data == "string"){
								if(response.data == "success"){
									$.each($addnewquantities, function($newindex, $newitem){

										//console.log('new quantityid: ' + $newitem.quantityID);
										$.each($scope.jobtypes, function($index, $item){
											if($item!=null){
												//console.log('jobtypeID: ' + $item.id);
												$.each($item.jobsubtype, function($index2, $item2){
													//yang boleh di masukin cuma yang id jobsubtypenya sama dengan yang baru
													if ($item2 != null && $item2.id == $newitem.jobsubtypeID) {
														//OOFSET
														$temp = null;
														$.each($scope.newquantitiesOF, function($i, $ii) {
															//console.log($newitem.quantityID+" == "+$ii.id)
															if ($newitem.quantityID == $ii.id) {

																//KALO ADA YG SAMA, brarti bener di add
																//AMBIL DATANYA
																$temp = $newitem;
																$temp.quantity = $scope.clone($ii);
															}
														});

														//data di store di $temp;
														//kalo $temp tidak null, di cek uda ada di sebelomnya ga? kalo belom baru di add ke yg jobsubtypequantity

														if ($temp != null) {
															//console.log("FOUND di data yang di kirim");
															$found = false;

															$.each($item2.jobsubtypequantity, function($index3, $item3) {
																if ($item3 != null) {
																	if ($item3.jobsubtypeID == $newitem.jobsubtypeID && $item3.quantityID == $newitem.quantityID && $item3.ofdg == $newitem.ofdg) {
																		$found = true; //digagalin add
																		console.log("DOUBLE, uda di add sebelomnya");
																	}
																}
															});

															if ($found == false) {
																$item2.jobsubtypequantity.push($temp);
																//console.log("BISA DI ADD, soalny belom ada di sbeelomnya");
															}else{
																//console.log("TIDAK BISA DI ADD, soalnya sebelomnya uda ada");
															}
														}
													}else{
														//console.log("NOT Error: Jobsubtype kosong atau tidak sama tidak sama dengan id yang baru");
													}
												});
											}
										});

									});
									$("#addquantity").modal('hide');
								}
							}
						}else{
							console.log("The return value is null, not error");
						}
					}
				}, function(error){
					console.log(error);
				});
			}

			$scope.getquantities = function(){
				$http({
					method: "GET",
					url: API_URL+"quantities"
				}).then(function(response){
					if(response!=null){
						if(response.data != null){
							if(typeof response.data != "string"){
								$scope.quantities = response.data;
							}
						}else{
							console.log("The return value is null, not error");
						}
					}
				}, function(error){
					console.log(error);
				});
			}

			$scope.addnewquantity = function($jobsubtype){
				$scope.selectedjobsubtype = $jobsubtype;

				$scope.newquantityOF = []; //buat kosongin yang kedua kali mau add
				$scope.newquantityDG = []; //buat kosongin yang kedua kali mau add

				if($scope.newquantitiesOF != null){
					$scope.newquantitiesOF.splice(0, $scope.newquantitiesOF.length);
				}
				if ($scope.newquantitiesDG != null) {
					$scope.newquantitiesDG.splice(0, $scope.newquantitiesDG.length);
				}


				$scope.newquantitiesOF = $scope.quantities.slice(0);
				$.each($scope.newquantitiesOF, function($index, $item) {
					$item.deleteflagOF = false;
				});
				$.each($scope.newquantitiesOF, function($index, $item){
					//item id = id untuk quantity yang baru yang mau di apus
					//disamain dengan quantity id yang ada di perulangan jobsubtype variable $jobsubtype
					if ($item != null) {
						$.each($jobsubtype.jobsubtypequantity, function($index2, $item2) {
							if ($item2 != null) {
								if ($item.deleteflagOF == false && $item2.ofdg == 1) {
									if ($item.id == $item2.quantity.id) {
										//jika ketemu ada yang sama maka di delete $itemnya..
										$item.deleteflagOF = true;
										$item.addflagOF = false;
									}
								}
							}
						});
					}
				});


				//DELETE DI ARRAYNYA
				/*$total = $scope.newquantitiesOF.length;

				for ($i = $total - 1; $i >= 0; $i--){
					if ($scope.newquantitiesOF[$i] != null) {
						if($scope.newquantitiesOF[$i].deleteflagOF == true){
							$scope.newquantitiesOF.splice($i, 1);
						}
					}
				}*/



				//DIGITAL
				$scope.newquantitiesDG = $scope.quantities.slice(0);

				$.each($scope.newquantitiesDG, function($index, $item) {
					$item.deleteflagDG = false;
				});

				$.each($scope.newquantitiesDG, function($index, $item) {
					//item id = id untuk quantity yang baru yang mau di apus
					//disamain dengan quantity id yang ada di perulangan jobsubtype variable $jobsubtype
					if ($item != null) {
						$.each($jobsubtype.jobsubtypequantity, function($index2, $item2) {
							if ($item2 != null) {
								if ($item.deleteflagDG == false && $item2.ofdg==2) {
									if ($item.id == $item2.quantity.id) {
										//jika ketemu ada yang sama maka di delete $itemnya..
										$item.deleteflagDG = true;
										$item.addflagDG = false;
									}
								}
							}
						});
					}
				});

				$("#addquantity").modal('show');
				$scope.unselectall();
			}

			$scope.unselectall = function(){
				//refresh all OF waktu klik modal
				$.each($scope.newquantitiesOF, function($i, $item) {
					if ($item.addflagOF) {
						$item.addflagOF = false;
					}
				});
				//refresh all DG waktu klik modal
				$.each($scope.newquantitiesDG, function($i, $item) {
					if ($item.addflagDG) {
						$item.addflagDG = false;
					}
				});
			}

			$scope.addnewjobquantity = function($item){
				$http({
					method: "POST",
					url: AJAX_URL+"jobsubtypequantity/addnewjobquantity",
					data: {
						'jobsubtypeID': $item.id,
						'ofdg': 1, //OF default,
						'quantity': 1
					}
				}).then(function(response){
					if(response!=null){
						if(response.data != null){
							if(typeof response.data == "string"){
								if(response.data == "error"){
									console.log("error database");
								}else{
									//success returnnya id yang baru
									$temp = {
										"id": response.data,
										"jobsubtypeID": $item.id,
										"ofdg": 1,
										"quantity": 1
									};
									$item.jobsubtypequantity.push($temp);
									console.log($temp);
									console.log($item);
								}
							}
						}else{
							console.log("The return value is null, not error");
						}
						$("#quantitychangecoat").modal('hide');
					}
				}, function(error){
						console.log(error);
						$("#quantitychangecoat").modal('hide');
				});
			}

			$scope.deletejobquantity = function($parent, $item, $index){
				$http({
					method: "POST",
					url: AJAX_URL + "jobsubtypequantity/"+$item.id+"/delete"
				}).then(function(response){
					if(response!=null){
						if(response.data != null){
							if(typeof response.data == "string"){
								if(response.data == "success"){
									$parent.jobsubtypequantity.splice($index, 1);
								}
								else{
									console.log(response.data);
								}
							}
						}else{
							console.log("The return value is null, not error");
						}
					}
				}, function(error){
					console.log(error);
				});
			}

			$scope.changecoatclicked = function($quantity){
				console.log($quantity);
				$scope.selectedquantity = $quantity;
				if($scope.selectedquantity!=null){
					$scope.selectedcoatid = $quantity.coatingtype.id;
					$('#quantitychangecoat').modal('show');
				}
			}

			$scope.getcoatingtypes = function(){
				$http({
					method: "GET",
					url: API_URL+"coatingtypes"
				}).then(function(response){
					if(response!=null){
						if(response.data != null){
							if(typeof response.data != "string"){
								//success
								$scope.coatingtypes = response.data;
							}
						}else{
							console.log("The return value is null, not error");
						}
					}
				}, function(error){
					console.log(error);
				});
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

			$scope.changeOFDG = function($id, $item){
				$http({
					method: "POST",
					url: AJAX_URL+"jobsubtypequantity/"+$id+"/changeofdg"
				}).then(function(response){
					if(response!=null){
						if(response.data != null){
							if(typeof response.data == "string"){
								$item.ofdg = response.data;
							}
						}else{
							console.log("ID Not found");
						}
					}
				}, function(error){
					console.log(error);
				});
			}

			$scope.changequantity = function($id, $quantity, $item) {
				$http({
					method: "POST",
					url: AJAX_URL + "jobsubtypequantity/" + $id + "/changequantity",
					data: {
						'quantity': $quantity
					}
				}).then(function(response) {
					if (response != null) {
						if (response.data != null) {
							if (typeof response.data == "string") {
								if(response.data == "success"){
									$item.quantity = $quantity;
								}
							}
						} else {
							console.log("ID Not found");
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

		}
	]);
};