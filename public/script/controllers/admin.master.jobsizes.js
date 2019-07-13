module.exports = function(app) {
	app.controller('AdmJobsizesController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window) {

			$scope.jobtypes = null;
			$scope.saving = false;
			$scope.activejobtype = 0;
			$scope.loadingofdg = false;

			$scope.newjobsizes = [];
			$scope.sizes = []; //ambil data dari ajax

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
									$.each($item2.jobsubtypesize, function($index3, $item3) {
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
				$scope.getallsizes(); //INIT
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

			/*$scope.showoptions_clicked = function($item){
				if(!$item.showoptions){
					$scope.hidealloptions();
					$item.showoptions = true;
				}else{
					$scope.hidealloptions();
				}
			}*/

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

			$scope.getallsizes = function(){
				$http({
					method: "GET",
					url: API_URL+"sizes"
				}).then(function(response){
					if(response!=null){
						if(response.data != null){
							$scope.sizes = response.data;
							$.each($scope.sizes, function($index, $item){
								if($item!=null){
									$item.width = parseFloat($item.width);
									$item.length = parseFloat($item.length);
								}
							});
						}else{
							console.log("The return value is null, not error");
						}
					}
				}, function(error){
					console.log(error);
				});
			}

			$scope.changeOfDg = function($jobsubtypesize){
				if($scope.loadingofdg == false){
					$scope.loadingofdg = true;
					$http({
						method: "POST",
						url: AJAX_URL+"jobsubtypesize/"+$jobsubtypesize.id+"/changeofdg"
					}).then(function(response){
						if(response!=null){
							if(response.data != null){
								if(typeof response.data == "string"){
									$jobsubtypesize.ofdg = response.data;
								}else{
									console.log("NO CHANGE FROM DB, ERROR");
								}
							}else{
								console.log("The return value is null, ID not found");
							}
						}else{
							console.log("error, response is null");
						}

						$scope.loadingofdg = false;
					}, function(error){
						console.log(error);
						$scope.loadingofdg = false;
					});
				}
			}

			$scope.addnewjobsize = function($jobsubtypeID){
				$scope.newjobsizes = []; //clear
				$scope.addnewjobsizerow();

				$scope.selectedjobsubtypeID = $jobsubtypeID;


				$("#addnewjobsize").modal('show');
			}

			$scope.addnewjobsizerow = function(){
				$temp = {
					name: "",
					custominput: false,
					length: 0.0,
					width: 0.0,
					size: null
				};
				if($scope.sizes.length>0)
					$temp.size = $scope.sizes[0];
				else
					alert("error, no sizes from db");
				$scope.newjobsizes.push($temp); //push
			}

			$scope.savenewjobsizes = function(){
				//console.log($scope.newjobsizes);

				$newarray = [];
				$.each($scope.newjobsizes, function($index, $item){
					$temp = null;
					$temp = {};

					if($item.custominput){
						if($item.length == 0 || $item.width == 0)
							$temp.valid = false;
						else if($item.name.length == 0)
							$temp.valid = false;
						else 
							$temp.valid = true;
					}else{
						$temp.valid = true;
					}

					if ($temp.valid){
						$temp.jobsubtypeID = $scope.selectedjobsubtypeID;
						$temp.ofdg = 1; //dibuat offset
						if($item.custominput){
							// CUSTOM SIZE
							$temp.width = $item.width;
							$temp.length = $item.length;
							$temp.name = $item.name; //save size by name
							$temp.sizeID = null;
						}else{
							//terdaftar
							if($item.size != null){
								$temp.width = $item.size.width;
								$temp.length = $item.size.length;
								$temp.name = $item.size.name;
								$temp.sizeID = $item.size.id;
							}
						}
						$newarray.push($temp);
					}
				});

				$http({
					method: "POST",
					url: AJAX_URL+"jobsubtypesize/store",
					data: $newarray
				}).then(function(response){
					if(response!=null){
						if(response.data != null){
							if(typeof response.data == "string"){
								
							}
						}else{
							console.log("The return value is null, not error");
						}
					}
				}, function(error){
					console.log(error);
				});
			}

			$scope.selectedchanged = function($item){
				if($item.custominput){
					$item.size = null;
				}else{
					$item.width = 0;
					$item.length = 0;
				}
			}

		}
	]);
};