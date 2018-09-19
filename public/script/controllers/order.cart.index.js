module.exports = function(app){
	app.controller('OrderCartController', ['$timeout', '$scope', '$http', 'API_URL', 'BASE_URL', '$window',
		function($timeout, $scope, $http, API_URL, BASE_URL, $window){
			$scope.URL = 'http://localhost:8000/';

			$scope.selected=[];
			$scope.selectedPrice = 0;
			$scope.jobtypes = ["flyer"];
			$scope.error = "";
			$scope.second = 0;

			$scope.tick = function(){
				$scope.second = parseInt(Date.now()/1000);
				$timeout($scope.tick, 1000);
			}
			$timeout($scope.tick, 1000);
			
			$scope.initSelectedID = function($id){
				if ($id != 0)
				{
					for (var i = 0; i < $scope.carts.length; i++) {
						if($scope.carts[i].id == $id && $scope.carts[i].filestatus == true){
							$scope.carts[i].checked = true;
							$scope.selectedPush($scope.carts[i]);
						}
					}
				}
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

			$scope.selectedPush = function ($item){
				$scope.selected.push($item);
				$scope.countSelectedPrice();
			}
			$scope.countSelectedPrice = function(){
				$scope.selectedPrice = 0;
				for($i=0;$i<$scope.selected.length;$i++){
					$item = $scope.selected[$i];
					$scope.selectedPrice+=parseFloat($item.printprice)+parseFloat($item.deliveryprice)-parseFloat($item.discount);
				}
			}

			$scope.checkChanged = function($item){
				if($item.filestatus == 1)
					if($item.checked == true)
					{
						$scope.selectedPush($item);
					}
					else
					{
						for (var i = 0; i < $scope.selected.length; i++) {
							if($scope.selected[i].id == $item.id){
								$scope.selected.splice(i, 1);
							}
						}
						$scope.countSelectedPrice();
					}
				else
				{
					$item.checked = false;
					$scope.error = "Sebelum Anda dapat memilih, Jakartabrosur harus melakukan pengecekan file.";

					$timeout(function(){
						$("html, body").stop().animate({scrollTop:$('#errorfocus').offset().top-20}, 500, 'swing');
					});
				}
			}

			$scope.initData = function($input){
				$scope.carts = JSON.parse($input);
				for($i = 0; $i < $scope.carts.length; $i++){
					$scope.carts[$i].checked = false;
					$.each($scope.carts[$i].cartdetail, function($index, $item){
						$item.jobtype = 
							($item.jobtype == "OF") ? "Offset Print" :
							($item.jobtype == "DG") ? "Digital Print" :
							($item.jobtype == "PL") ? "Large Format" : "Others";
					});
				}
			}

			$scope.setPapersize = function($width, $length){
				$scope.edit.width = parseFloat($width);
				$scope.edit.length = parseFloat($length);
			}

			$scope.createcartfile = function($file){
				if(!$scope.loadingcartfiles)
				{
					$data = {
						'cartID' : $scope.tempcart.id,
						'fileID' : $file.id
					};
					$scope.loadingcartfiles = true;
					$http({
						method: "POST",
						url 	: API_URL+"cartfiles/create",
						data 	: $data
					}).then(function(response){
						if(response != null)
							$scope.tempcart.cartfile = response.data;
						else
							console.log('error when send data - create cartfile');

						$scope.toggleupload = false;
						$scope.loadingcartfiles = false;
					});
				}

			}

			$scope.addnewfile = function(){
				$scope.toggleupload=true;
				if(!$scope.loadingunbindfiles)
				{
					$scope.loadingunbindfiles = true;
					$http({
						method:'GET',
						url 	:API_URL+"files/unbinded"
					}).then(function(response){
						$scope.unbindedfiles = response.data;
						$scope.loadingunbindfiles = false;
					});
				}
			}

			$scope.removecartfile = function($item){
				if(!$scope.loadingcartfiles)
				{
					$scope.loadingcartfiles = true;

					$http({
						method: "GET",
						url 	: API_URL+"cartfiles/"+$item.id+"/delete"
					}).then(function(response){
						$scope.tempcart.cartfile = response.data;
						$scope.loadingcartfiles = false;
					});
				}
			}

			$('#real-dropzonew').on('change', function(e) 
			{
				e.preventDefault();
				e.stopPropagation();
				if ($(this)[0]['file'].files){
					if ($(this)[0]['file'].files.length > 0) {
						$scope.upload($(this)[0]['file'].files);
					}
				} 
				return false;
			});

			$scope.upload = function(files){
				if(!$scope.loadingcartfiles)
				{

					var data = new FormData();

					angular.forEach(files, function(value){
						$ext = value.name.substring(value.name.lastIndexOf('.') + 1);
						if ($ext != 'cdr' &&
							$ext != 'zip' &&
							$ext != 'rar' &&
							$ext != 'ai' &&
							$ext != 'xls' &&
							$ext != 'xlsx' &&
							$ext != 'doc' &&
							$ext != 'docx' &&
							$ext != 'tiff' &&
							$ext != 'tif' &&
							$ext != 'pdf' &&
							$ext != 'jpg' &&
							$ext != 'jpeg' &&
							$ext != 'psd' &&
							$ext != '7z' &&
							$ext != 'indd') //indesign
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
							//jobsubtypeID -> dibuang, ditambahkan dengan user dapat 
						}
					});

					//tempcart --> yang di select pas buka tombol changefile.blade.php
					$scope.loadingcartfiles = true;
					$http({
						method: 'POST',
						url 	: API_URL+"cartfiles/"+$scope.tempcart.id+"/upload",
						data 	: data,
						withCredentials: true,
						headers: {'Content-Type': undefined },
						transformRequest: angular.identity
					}).then(
						function(response){
							$scope.tempcart.cartfile = response.data;
							$scope.toggleupload = false;
							$scope.loadingcartfiles = false;
						},function(error){
							alert(response);
						}
					);
				}
			}

			$scope.delete = function($input){
				//console.log($input['id']);
				$http(
					{
						method : 'POST',
						url : API_URL + 'cart/delete',
						data : $input['id']
					}
				).then(function(response) {
					//alert(response);
			    	if(response!=null){
			    		$scope.carts = response.data;
			    		//if ($scope.uploadedfiles.length > 0) $scope.tableshow = true;
			    	}else
			    		console.log	('response = null');
					//alert('resonse' + response);
				});
			}

			$scope.checkout = function(){
				/*$selectedids = [];
				$.each($scope.selected, function($index, $item){
					$selectedids.push($item['id']);
				});*/

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
				$scope.tempcart = $cart;
				//console.log($scope.tempcart);
				//$scope.fillCartfiles($cartid);
				//ga usa refresh lagi, soalnya kan di page pertama load uda ada
				if($cart!=null)
					if($cart.cartfile!=null)
						if($cart.cartfile.length>0)
							$scope.setFilePreview($cart.cartfile[0].file);


				$scope.toggleupload = false;
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
		}
	]);
};