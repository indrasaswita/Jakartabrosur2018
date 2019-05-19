module.exports = function(app) {
	app.controller('AdmJobpapersController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window) {

			$scope.jobtypes = null;
			$scope.saving = false;
			$scope.activejobtype = 0;
			$scope.selectedpaper = null;
			$scope.coatingtypes = [];
			$scope.selectedcoatid = 0;
			$scope.newpapers = [];
			$scope.papers = [];
			$scope.addloading = false;
			$scope.selectedjobsubtype = null;

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
									$.each($item2.jobsubtypepaper, function($index3, $item3) {
										if ($item3 != null) {
											$item3.paper.coatingtype.info = $scope.trustAsHtml($item3.paper.coatingtype.info);

											if ($item3.ofdg == 1) $item2.totalOF++;
											else if ($item3.ofdg == 2) $item2.totalDG++;

										}
									});
								}
							});
						}
					});
				}

				$scope.getpapers();
				$scope.getcoatingtypes();
				$scope.hideall();
				$scope.closeallchangeprice();
			}

			$scope.addjobpaperOF = function($paper) {
				if ($paper.addflagOF)
					$paper.addflagOF = false;
				else
					$paper.addflagOF = true;
				//$scope.addjobpaper('OF', $paper);
			}

			$scope.addjobpaperDG = function($paper) {
				if($paper.addflagDG)
					$paper.addflagDG = false;
				else	
					$paper.addflagDG = true;
				//$scope.addjobpaper('DG', $paper);
			}

			$scope.removejobpaper = function($jobsubtype, $jobsubtypepaper, $index){
				$jobsubtypeID = $jobsubtype.id; 
				$ofdg = $jobsubtypepaper.ofdg;
				$paperID = $jobsubtypepaper.paperID;
				$http({
					method: "POST",
					url: AJAX_URL + "jobsubtypepaper/remove",
					data: {
						"jobsubtypeID": $jobsubtypeID,
						"ofdg": $ofdg,
						"paperID": $paperID
					}
				}).then(function(response) {
						if (response != null) {
							if (response.data != null) {
								if (typeof response.data == "string") {
									if (response.data == "success") {
										$jobsubtype.jobsubtypepaper.splice($index, 1);
									}
								}
							} else {
								console.log("The return value is null, not error");
							}
						}
					}, function(error) {
						console.log(error);
					});
			}

			$scope.addjobpaperAll = function(){
				$paperDG = $scope.newpapersDG;
				$paperOF = $scope.newpapersOF;

				$addnewpapers = [];

				$.each($paperOF, function($index, $item){
					if($item.addflagOF){
						$temp = {
							"paperID": $item.id,
							"ofdg": "1", //OF : 1
							"jobsubtypeID": $scope.selectedjobsubtype.id,
							"favourite": 0
						};
						$addnewpapers.push($temp);
					}
				});
				$.each($paperDG, function($index, $item) {
					if ($item.addflagDG) {
						$temp = {
							"paperID": $item.id,
							"ofdg": "2", //DG : 2
							"jobsubtypeID": $scope.selectedjobsubtype.id,
							"favourite": 0
						};
						$addnewpapers.push($temp);
					}
				});

				//$addnewpapers semua data yang bakal di add ke server
				//console.log($addnewpapers);

				//$scope.addloading = true;
				$http({
					method: "POST",
					url: AJAX_URL+"jobsubtypepaper/store",
					data: $addnewpapers
				}).then(function(response){
					if(response!=null){
						if(response.data != null){
							if(typeof response.data == "string"){
								if(response.data == "success"){
									$.each($addnewpapers, function($newindex, $newitem){

										//console.log('new PAPERid: ' + $newitem.paperID);
										$.each($scope.jobtypes, function($index, $item){
											if($item!=null){
												//console.log('jobtypeID: ' + $item.id);
												$.each($item.jobsubtype, function($index2, $item2){
													if ($item2 != null) {
														//OOFSET
														$temp = null;
														$.each($scope.newpapersOF, function($i, $ii) {
															//console.log($newitem.paperID+" == "+$ii.id)
															if ($newitem.paperID == $ii.id) {

																//KALO ADA YG SAMA, brarti bener di add
																//AMBIL DATANYA
																$temp = $newitem;
																$temp.paper = $scope.clone($ii);
															}
														});

														//data di store di $temp;
														//kalo $temp tidak null, di cek uda ada di sebelomnya ga? kalo belom baru di add ke yg jobsubtypepaper

														if ($temp != null) {
															//console.log("FOUND di data yang di kirim");
															$found = false;

															$.each($item2.jobsubtypepaper, function($index3, $item3) {
																if ($item3 != null) {
																	if ($item3.jobsubtypeID == $newitem.jobsubtypeID && $item3.paperID == $newitem.paperID && $item3.ofdg == $newitem.ofdg) {
																		$found = true; //digagalin add
																		console.log("DOUBLE, uda di add sebelomnya");
																	}
																}
															});

															if ($found == false) {
																$item2.jobsubtypepaper.push($temp);
																//console.log("BISA DI ADD, soalny belom ada di sbeelomnya");
															}else{
																//console.log("TIDAK BISA DI ADD, soalnya sebelomnya uda ada");
															}
														}
													}else{
														console.log("NOT FOUND di data yang di kirim");
													}
												});
											}
										});

									});
									$("#addpaper").modal('hide');
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

			$scope.getpapers = function(){
				$http({
					method: "GET",
					url: API_URL+"papers"
				}).then(function(response){
					if(response!=null){
						if(response.data != null){
							if(typeof response.data != "string"){
								$scope.papers = response.data;
							}
						}else{
							console.log("The return value is null, not error");
						}
					}
				}, function(error){
					console.log(error);
				});
			}

			$scope.addnewpaper = function($jobsubtype){
				$scope.selectedjobsubtype = $jobsubtype;

				if($scope.newpapersOF != null){
					$scope.newpapersOF.splice(0, $scope.newpapersOF.length);
				}
				if ($scope.newpapersDG != null) {
					$scope.newpapersDG.splice(0, $scope.newpapersDG.length);
				}


				$scope.newpapersOF = $scope.papers.slice(0);
				$.each($scope.newpapersOF, function($index, $item) {
					$item.deleteflagOF = false;
				});
				$.each($scope.newpapersOF, function($index, $item){
					//item id = id untuk paper yang baru yang mau di apus
					//disamain dengan paper id yang ada di perulangan jobsubtype variable $jobsubtype
					if ($item != null) {
						$.each($jobsubtype.jobsubtypepaper, function($index2, $item2) {
							if ($item2 != null) {
								if ($item.deleteflagOF == false && $item2.ofdg == 1) {
									if ($item.id == $item2.paper.id) {
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
				/*$total = $scope.newpapersOF.length;

				for ($i = $total - 1; $i >= 0; $i--){
					if ($scope.newpapersOF[$i] != null) {
						if($scope.newpapersOF[$i].deleteflagOF == true){
							$scope.newpapersOF.splice($i, 1);
						}
					}
				}*/



				//DIGITAL
				$scope.newpapersDG = $scope.papers.slice(0);

				$.each($scope.newpapersDG, function($index, $item) {
					$item.deleteflagDG = false;
				});

				$.each($scope.newpapersDG, function($index, $item) {
					//item id = id untuk paper yang baru yang mau di apus
					//disamain dengan paper id yang ada di perulangan jobsubtype variable $jobsubtype
					if ($item != null) {
						$.each($jobsubtype.jobsubtypepaper, function($index2, $item2) {
							if ($item2 != null) {
								if ($item.deleteflagDG == false && $item2.ofdg==2) {
									if ($item.id == $item2.paper.id) {
										//jika ketemu ada yang sama maka di delete $itemnya..
										$item.deleteflagDG = true;
										$item.addflagDG = false;
									}
								}
							}
						});
					}
				});

				//DELETE DIGITAL
				/*$total = $scope.newpapersDG.length;

				for ($i = $total - 1; $i >= 0; $i--) {
					if ($scope.newpapersDG[$i] != null) {
						if ($scope.newpapersDG[$i].deleteflagDG == true) {
							$scope.newpapersDG.splice($i, 1);
							console.log("DELET: " + $i);
						}
					}
				}*/

				$("#addpaper").modal('show');
			}

			$scope.changecoatsave = function(){
				$http({
					method: "POST",
					url: AJAX_URL+"paper/changecoatingtype",
					data: {
						'paper': $scope.selectedpaper,
						'newcoatid': $scope.selectedcoatid
					}
				}).then(function(response){
					if(response!=null){
						if(response.data != null){
							if(typeof response.data == "string"){
								if(response.data == "success"){

									//AMBIL DATA DARI ARRAY COATIINGTYPE
									$temp = null;
									$.each($scope.coatingtypes, function($index, $item){
										if($item.id == $scope.selectedcoatid){
											$temp = $item;
										}
									});
									console.log($temp);
										
									//CHANGE ALL COATING DATA
									if ($scope.jobtypes != null) {
										$.each($scope.jobtypes, function($index, $item) {
											$.each($item.jobsubtype, function($index2, $item2) {
												$.each($item2.jobsubtypepaper, function($index3, $item3) {

													if ($item3 != null) {
														if($item3.paper.id == $scope.selectedpaper.id){
															console.log("GANTI");
															console.log($item3.paper);
															$item3.paper.coatingtype = $temp;
															$item3.paper.coatingtypeID = $scope.selectedcoatid;
															console.log($item3.paper);
														}
													}
												});
											});
										});
									}

								}
							}
						}else{
							console.log("The return value is null, not error");
						}
						$("#paperchangecoat").modal('hide');
					}
				}, function(error){
						console.log(error);
						$("#paperchangecoat").modal('hide');
				});
			}

			$scope.changecoatclicked = function($paper){
				console.log($paper);
				$scope.selectedpaper = $paper;
				if($scope.selectedpaper!=null){
					$scope.selectedcoatid = $paper.coatingtype.id;
					$('#paperchangecoat').modal('show');
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