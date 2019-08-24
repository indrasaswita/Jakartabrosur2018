module.exports = function(app){
	app.controller('OrderCartController', ['$timeout', '$scope', '$http', 'API_URL', 'BASE_URL', 'AJAX_URL', '$window',
		function($timeout, $scope, $http, API_URL, BASE_URL, AJAX_URL, $window){
			$scope.URL = 'http://localhost:8000/';

			$scope.selected=[];
			$scope.selectedPrice = 0;
			$scope.totalSelected = 0;
			$scope.jobtypes = ["flyer"];
			$scope.error = "";
			$scope.second = 0;
			$scope.deliveries = [];

			$scope.selectedCart = [];
			$scope.selectedCartDelete = [];
			$scope.cartdeleteloading = false;
			$scope.cartduplicateloading = false;
			$scope.cartedittitleloading = false;
			$scope.newtitle = "";
			$scope.selectedFile = [];
			$scope.selectedFileindex = -1;
			$scope.allchecked;
			$scope.stateupload = "";
			$scope.uploadwaiting = false;
			$scope.errormessage = ""; // untuk di add dan changefile

			$scope.tick = function(){
				$scope.second = parseInt(Date.now()/1000);
				$timeout($scope.tick, 1000);
			}
			$timeout($scope.tick, 1000);
			
			$scope.initSelectedID = function($id){
				if ($id != 0)
				{
					$.each($scope.carts, function($i, $ii) {
						if($ii.id == $id){
							if(!$ii.showdetail)
								$scope.showingdetail($ii, $i);
						}
					});
				}
			}
			$scope.initSelectedDetail = function($stat) {
				if ($stat != "") {
					$.each($scope.carts, function($i, $ii) {
						if ($ii.showdetail) {
							if ($stat == "fl" && !$ii.showfile){
								$ii.showinfo = false;
								$ii.showfile = true;
								$ii.showdelivery = false;
							} else if ($stat == "dl" && !$ii.showdelivery){
								$ii.showinfo = false;
								$ii.showfile = false;
								$ii.showdelivery = true;
							} else if ($stat == "in" && !$ii.showinfo) {
								$ii.showinfo = true;
								$ii.showfile = false;
								$ii.showdelivery = false;
							}
						}
					});
				}
			}
			$scope.showeditfile = function ($cart, $file){
				$scope.selectedCart = $cart;
				$scope.selectedFile = $file;

				$scope.stateupload = "revisi";
				$("#changeFileModal").modal('show');
			}
			$scope.changeTitle = function($item){
				$('#changeTitleModal').modal('show');
				$scope.setSelectedItem($item);
			}
			$scope.changeSpec = function($item){
				$('#changeSpecModal').modal('show');
				$scope.setSelectedItem($item);
			}
			$scope.getwidth = function($input){
				return $input.substring(0, $input.indexOf('x'));
			}
			$scope.getlength = function($input){
				return $input.substring($input.indexOf('x') + 1, $input.indexOf('cm'));
			}
			$scope.qtyIncr = function(){
				if($scope.edit.quantity<100)
					$scope.edit.quantity++;
				$scope.updatePrice();
			}
			$scope.qtyDecr = function(){
				if($scope.edit.quantity>1)
					$scope.edit.quantity--;
				$scope.updatePrice();
			}

			$scope.countSelectedPrice = function(){
				$scope.selectedPrice = 0;
				$scope.totalSelected = 0;

				$.each($scope.carts, function($i, $ii){
					if($ii.checked){
						$scope.selectedPrice += parseFloat($ii.printprice) + parseFloat($ii.deliveryprice) - parseFloat($ii.discount);
						$scope.totalSelected++;
					}
				});

				if($scope.totalSelected == $scope.carts.length){
					$scope.allchecked = true;
				}else{
					$scope.allchecked = false;
				}

			}

			$scope.checkAll = function(){
				if ($scope.allchecked == true) {
					//deselect all
					$.each($scope.carts, function($index, $item) {
						$scope.carts[$index].checked = false;
					});
				} else {
					//select all
					$.each($scope.carts, function($index, $item) {
						$scope.carts[$index].checked = true;
					});
				}

				$.each($scope.carts, function($index, $item){
					$item.showdetail = false;
				})

				$scope.countSelectedPrice();
			}

			$scope.checkChanged = function($item){
				$scope.countSelectedPrice();

				if ($scope.totalSelected == $scope.carts.length) {
					if ($scope.allchecked == false)
						$scope.allchecked = true;
				} else {
					if ($scope.allchecked == true)
						$scope.allchecked = false;
				}
			}

			$scope.initData = function($carts, $deliveries){
				$scope.carts = JSON.parse($carts);
				$scope.deliveries = JSON.parse($deliveries);
				$scope.allchecked = true;
				$scope.checkAll(); //hitung total dan check all and hide all
				$.each($scope.carts, function($i, $ii){
					if ($i == 0) {
						$scope.carts[$i].showdetail = true;
						$scope.selectedCart = $scope.carts[$i];
					}

					$scope.carts[$i].showinfo = true;
					$scope.carts[$i].showfile = false;
					$scope.carts[$i].showdelivery = false;
					if($ii.created_at != null)
						$scope.carts[$i].created_at = $scope.makeDateTime($ii.created_at);
					if ($ii.updated_at != null)
						$scope.carts[$i].updated_at = $scope.makeDateTime($ii.updated_at);


					$.each($ii.cartdetail, function($j, $jj) {
						$jj.jobtypelong =
							($jj.jobtype == "OF") ? "Offset Print" :
								($jj.jobtype == "DG") ? "Digital Print" :
									($jj.jobtype == "PL") ? "Large Format" : "Others";
					});

					$.each($ii.cartfile, function($j, $jj){
						if ($jj.file.created_at != null)
							$scope.carts[$i].cartfile[$j].file.created_at = $scope.makeDateTime($jj.file.created_at);
						if ($jj.file.updated_at != null)
							$scope.carts[$i].cartfile[$j].file.updated_at = $scope.makeDateTime($jj.file.updated_at);
					});

					$.each($scope.deliveries, function($j, $jj){
						//SELECT $scope.carts.DELIVERY nya dari object $scope.deliveries, biar bisa modalnya di select perobject (ng-model)
						if($jj.id == $ii.deliveryID){
							$ii.delivery = $jj;
						}
					});

				});

			}

			$scope.showingdetail = function($cart, $index){
				if ($cart.showdetail == true) {
					$scope.selectedcartindex = -1;
					$cart.showdetail = false;
				} else {
					$scope.hideall();
					$scope.selectedcartindex = $index;
					$scope.selectedCart = $cart;
					$cart.showdetail = true;
					$scope.showinfo($cart);
				}
			}

			//SHOW INFO - DELIVERY - FILE
			$scope.showinfo = function($cart) {
				$cart.showinfo = true;
				$cart.showfile = false;
				$cart.showdelivery = false;
			}

			//SHOW INFO - DELIVERY - FILE
			$scope.showdelivery = function($cart) {
				$cart.showinfo = false;
				$cart.showfile = false;
				$cart.showdelivery = true;
			}

			//SHOW INFO - DELIVERY - FILE
			$scope.showfile = function($cart) {
				$cart.showinfo = false;
				$cart.showfile = true;
				$cart.showdelivery = false;
			}

			$scope.hideall = function(){
				$.each($scope.carts, function($i, $ii){
					$scope.carts[$i].showdetail = false;
				});
			}

			$scope.setPapersize = function($width, $length){
				$scope.edit.width = parseFloat($width);
				$scope.edit.length = parseFloat($length);
			}

			$scope.addnewfile = function(){
				if(!$scope.loadingunbindfiles)
				{
					$scope.unbindedfiles = [];
					$scope.loadingunbindfiles = true;
					$http({
						method:'GET',
						url 	:API_URL+"files/unbinded"
					}).then(function(response){
						$scope.unbindedfiles = response.data;
						$scope.loadingunbindfiles = false;
					}, function(error){
						if(error != null){
							if(error.status == "403"){
								$window.location.reload();
							}
						}
					});
				}
				$scope.stateupload = "addnew";
				$("#addFileModal").modal('show');
			}

			$scope.warningdelete = function($selectedcartdelete){
				$scope.selectedCartDelete = $selectedcartdelete;
				$("#warningcartdelete").modal("show");
			}

			$scope.cartdelete = function(){
				if ($scope.selectedCartDelete != null) {
					if(!$scope.cartdeleteloading){
						$scope.cartdeleteloading = true;
						$http(
							{
								method: 'POST',
								url: AJAX_URL + 'cart/delete',
								data: $scope.selectedCartDelete.id
							}
						).then(function(response) {
							if (response != null) {
								if (response.data != null) {
									$scope.carts = response.data;
									$("#warningcartdelete").modal("hide");
									$scope.checkAll();
								}
							} else
								console.log('response = null');
							$scope.cartdeleteloading = false;
						}, function(error) {
							if (error != null) {
								if (error.status == 403) {
									$window.location.reload();
								}
							}
							$scope.cartdeleteloading = false;
						});
					}
				}
			}

			$scope.cartduplicate = function($cartid) {
				if (!$scope.cartduplicateloading) {
					$scope.cartduplicateloading = true;
					$http(
						{
							method: 'POST',
							url: AJAX_URL + 'cart/duplicate',
							data: $cartid
						}
					).then(function(response) {
						if (response != null) {
							if (response.data != null) {
								$scope.carts = response.data;
								$("#warningcartdelete").modal("hide");
								$scope.checkAll();
							}
						} else
							console.log('response = null');
						$scope.cartduplicateloading = false;
					}, function(error) {
						if (error != null) {
							if (error.status == 403) {
								$window.location.reload();
							}
						}
						$scope.cartduplicateloading = false;
					});
				}
			}

			$scope.edititem = function($item){

				//convert
				$tmps = $scope.clone($item);

				delete $tmps.cartfile;
				$tmps.deliveryID = $tmps.delivery.id;
				delete $tmps.delivery;
				if($tmps.deliveryID == 0){
					$tmps.deliverylocked = true;
				} else {
					$tmps.deliverylocked = false;
				}

				$tmps.pagename = $tmps.jobsubtype.link;
				delete $tmps.jobsubtype;
				delete $tmps.buyprice;
				delete $tmps.checked;
				delete $tmps.created_at;
				delete $tmps.updated_at;
				delete $tmps.customerID;
				delete $tmps.deliveryprice;
				delete $tmps.deliverytime;
				delete $tmps.discount;
				delete $tmps.filestatus;
				delete $tmps.printprice;
				delete $tmps.processtime;
				delete $tmps.quantitytypename;
				delete $tmps.showdelivery;
				delete $tmps.showdetail;
				delete $tmps.showfile;
				delete $tmps.showinfo;
				delete $tmps.totalweight;
				delete $tmps.totalpackage;

				if($tmps.cartdetail.length == 1){
					//no detail
					$cd = $tmps.cartdetail[0];
					$tmps.paperID = $cd.paperID;
					$tmps.printerID = $cd.printerID;
					if($cd.side2 > 0){
						$tmps.sideprint = "2";
					}else{
						$tmps.sideprint = "1";
					}
					//$tmps.sizeID = $cd.sizeID; //size id carinya dari database
					//karena yang di simpan dalam bentuk imagewidth dan image length
					$tmps.finishings = [];
					$.each($cd.cartdetailfinishing, function($i, $ii){
						$temp = {
							"finishingID": $ii.id,
							"optionID": $ii.optionID
						};
						$tmps.finishings.push($temp);
					});
					$tmps.printtype = $cd.jobtype;
				}
				$tmps.cartID = $tmps.id;
				delete $tmps.id;
				delete $tmps.cartdetail;
				$addurl = JSON.stringify($tmps);
				$goto = BASE_URL + "shop/" + $tmps.pagename + "?ss=" + $addurl;
				$window.location.href = $goto;
			}

			$scope.showedittitle = function($cart){
				$scope.selectedCartTitle = $cart;
				$scope.newtitle = $scope.selectedCartTitle.jobtitle;
				$("#editcarttitle").modal('show');
				$('#editcarttitle').on('shown.bs.modal', function() {
					$('#editcart-newtitle').focus();
					$('#editcart-newtitle').keypress(function(event){
						var keycode = (event.keyCode ? event.keyCode : event.which);
						if (keycode == '13') {
							$scope.edittitle();
						}
					});
				});
			}

			$scope.edittitle = function(){
				if ($scope.selectedCartTitle != null && $scope.selectedCartTitle.jobtitle != $scope.newtitle) {
					if (!$scope.cartedittitleloading) {
						$scope.cartedittitleloading = true;
						$http(
							{
								method: 'POST',
								url: AJAX_URL + 'cart/edittitle',
								data: {
									0: $scope.selectedCartTitle.id,
									1: $scope.newtitle
								}
							}
						).then(function(response) {
							if (response != null) {
								if (response.data != null) {
									$scope.carts = response.data;
									$("#editcarttitle").modal("hide");
									$scope.checkAll();
								}
							} else
								console.log('response = null');
							$scope.cartedittitleloading = false;
						}, function(error) {
							if (error != null) {
								if (error.status == 403) {
									$window.location.reload();
								}
							}
							$scope.cartedittitleloading = false;
						});
					}
				}
			}

			

			$scope.review = function(){
				$scope.selected = [];
				$.each($scope.carts, function($i, $ii) {
					$scope.selected.push($ii);
				});

				$("#reviewCartModal").modal("show");
			}

			$scope.checkout = function(){

				$http(
					{
						method: 'POST',
						url: API_URL+'sales/create',
						data: $scope.selected 
					}
				).then(function(response){
					if (response == null)
					{
						console.log('return null, data kiriman juga null');
					}
					else
					{
						//$window.location.href="payment/"+response;
						$window.location.href=BASE_URL+"sales/all";
					}
				});
				//$window.location.href="payment";
			}

			$scope.fillPapers = function()
			{
				$http(
					{
						method : 'GET',
						url : API_URL + 'papers/OF'
					}
				).then(function(response) {
					$scope.papers = response.data;
					//console.log(response);
				});
			};
			$scope.fillPapers();

			$scope.fillPapersizes = function()
			{
				$http(
					{
						method : 'GET',
						url : API_URL + 'papersizes'
					}
				).then(function(response) {
					$scope.papersizes = response.data;
					//console.log(response);
				});
			};
			$scope.fillPapersizes();

			$scope.showfiles = function($cart, $cartid){
				$scope.loadingcartfiles = false;
				//$scope.tempcart = $cart;
				//console.log($scope.tempcart);
				//$scope.fillCartfiles($cartid);
				//ga usa refresh lagi, soalnya kan di page pertama load uda ada
				if($cart!=null)
					if($cart.cartfile!=null)
						if($cart.cartfile.length>0)
							$scope.setFilePreview($cart.cartfile[0].file);


				$scope.loadingcartfiles = false;
				$('#changeFileModal').modal('show');
			}

			$scope.fillCartfiles = function($cartid)
			{
				if(!$scope.loadingcartfiles)
				{
					$scope.loadingcartfiles = true;
					$http(
						{
							method : 'GET',
							url : API_URL + 'cartfiles/'+$cartid
						}
					).then(function(response) {
						$scope.tempcart.cartfile = response.data;
						//console.log(response);
						if(typeof response == "object"){
							if(response.data.length > 0)
							{
								$scope.setFilePreview($scope.tempcart.cartfile[0]);
							}
						}
						$scope.loadingcartfiles = false;
					});
				}
			}

			$scope.setFilePreview = function($item){
				$scope.selectedfile = $item;
			}

			$scope.updateTitle = function($id)
			{
				$http(
					{
						method : 'POST',
						url : API_URL + 'cartdetails/title/update',
						data : {
							'cartID' : $scope.edit.id,
							'jobtitle' : $scope.edit.jobtitle,
							'jobtype' : $scope.edit.jobtype,
							'customernote' : $scope.edit.customernote
						}
					}
				).then(function(response) {
					//$scope.initData(response);
					//console.log(response);
					if(typeof response == "object"){
						$scope.updateCartrow($scope.edit.id, response[0]);
						$('#changeTitleModal').modal('hide')
					}
				});
			};

			$scope.updateCartrow = function($id, $data){
				$.each($scope.carts, function($index, $item){
					if($item.id == $id){
						//console.log("SaMa di " + $index);
						$scope.carts[0] = $data;
					}
				});
			}


			$(function() {
				var token = $('input[name="_token"]').val();
				$(document).ajaxSend(function(e, xhr, options) {
					console.log("ajax token!!!");
					xhr.setRequestHeader('X-CSRF-Token', token);
				});
			});

			$('#is-uploader').on('change', function(e) {
				e.preventDefault();
				e.stopPropagation();
				if ($(this)[0]['file'].files) {
					if ($(this)[0]['file'].files.length > 0) {
						$scope.upload($(this)[0]['file'].files);
					}
				}
				return false;
			});

			$scope.choosefileclicked = function() {
				$('#btn-choose-file').click();
			}

			$scope.upload = function(files) {
				var data = new FormData();
				$scope.errormessage = '';
				$scope.uploadwaiting = true;
				$scope.loadingfiles = true;

				$counterror = 0;
				$scope.$apply(function() { });

				angular.forEach(files, function(value) {
					$ext = value.name.substring(value.name.lastIndexOf('.') + 1);

					if (!$scope.val_ext("upload-file", $ext)) {
						$scope.errormessage = value.name + " : tidak bisa upload dengan file format " + $ext + ".";
						$counterror++;
					} else if (!$scope.val_size(value.size)) {
						$scope.errormessage = value.name + "( "+(value.size/1024/1024)+" MB ): file terlalu besar.";
						$counterror++;
					} else {
						$scope.errormessage = "";
						data.append("files[]", value);
					}
					$scope.$apply(function() { });

					if ($scope.errormessage != '') {
						//BUANGAN SUPAYA BISA LOAD HTML DOANG (GA TAU KNPAA)
						console.log($scope.errormessage);
						try {
							$http({
								method: 'GET',
								url: BASE_URL,
								data: data,
								withCredentials: true,
								headers: { 'Content-Type': undefined },
								transformRequest: angular.identity
							}).then(function(response) { },
								function(error) {
									console.log(error);
								});
						} catch (error) { }


						//refesh data kalo ga bisa ke upload (loading filesnya jangan di apus)
						$scope.loadingfiles = false;
						$scope.uploadwaiting = false;
						//$scope.refreshUploadedImage();
						//$scope.uploadwaiting = false;
						$scope.$apply(function() { });
					}else{

						//UPLOAD FILE DATA
						$url = "";
						if($scope.stateupload == "revisi"){
							$url = AJAX_URL + 'cartfiles/' + $scope.selectedCart.id + '/revision/' + $scope.selectedFile.id;
						} else if($scope.stateupload == "addnew") {
							$url = AJAX_URL + 'cartfiles/' + $scope.selectedCart.id + '/upload';
						}

						$scope.uploadprogress("POST", data, $url, function(response){
							//WHEN DONE
							if (response != null) {
								console.log(response.constructor);
								if (response.constructor === Array) {
									$scope.selectedCart.cartfile = [];
									$scope.selectedCart.cartfile = response;
									$.each($scope.selectedCart.cartfile, function($i, $ii) {
										if ($ii.file.id == $scope.selectedFile.id) {
											$scope.selectedFile = $ii.file;
										}
									});

									if ($scope.stateupload == "revisi") {
										$scope.errormessage = "file berhasil diganti..";
									} else if ($scope.stateupload == "addnew") {
										$scope.errormessage = "berhasil tambah file..";
									}
								}
								else if (response.constructor === String) {
									$scope.errormessage = response.constructor;
									$scope.uploadedfiles = [];
								}
								else {
									$scope.errormessage = "Error, tidak dapat terima data yang sudah di upload (empty).";
									$scope.uploadedfiles = [];
								}
							}
							else {
								$scope.errormessage = "Error, tidak dapat terima data yang sudah di upload (null).";
								$scope.uploadedfiles = [];
								//console.log	('NO DATA in PendIMG');
							}
							$scope.loadingfiles = false;
							$scope.uploadwaiting = false;
							//$scope.errormessage = "";
						}, function(response){
							//WHEN FAILED
							console.log(response);
							if (response.status == 419) {
								$scope.errormessage = "Unknown Status: May be the Session is over, please re-login to upload";
							} else {
								$scope.errormessage = response.statusText;
							}
							$scope.loadingfiles = false;
							$scope.uploadwaiting = false;
							$scope.uploadsuccess = false;;
						});
					}
				});

				//JANGAN DI BUANG, harusnya di pake
				//$scope.clearFileInput('file');
			};

		}
	]);
};