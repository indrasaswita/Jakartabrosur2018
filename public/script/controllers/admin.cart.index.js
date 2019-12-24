module.exports = function(app){
	app.controller('AdminCartController', ['$scope', '$http', 'API_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, BASE_URL, $window){
			$scope.carts = [];
			$scope.rejectbtns = [
				{
					'label' : 'Not HIGHRES',
					'message' : 'File yang dibuat tidak highres, mohon untuk mengupload file yang bagus.'
				},
				{
					'label' : 'Tidak Sesuai',
					'message' : 'File tidak sesuai dengan ukuran maupun jumlah yang diinginkan.'
				},
				{
					'label' : 'Missing Font',
					'message' : 'File tidak dapat dibuka dengan baik, FONT tidak terbaca oleh komputer kami.'
				}
			];
			
			$scope.initData = function($items){
				$scope.carts = JSON.parse($items);
				$.each($scope.carts, function($i, $ii){
					$scope.carts[$i].created_at = $scope.makeDateTime($ii.created_at);
					$scope.carts[$i].updated_at = $scope.makeDateTime($ii.updated_at);
					$scope.carts[$i].showdetail = false;
				});	
			}

			$scope.initData_2 = function($jobsubtypes, $printers, $papers, $deliveries){
				$scope.jobsubtypes = JSON.parse($jobsubtypes);
				$scope.printers = JSON.parse($printers);
				$scope.papers = JSON.parse($papers);
				$scope.deliveries = JSON.parse($deliveries);
			}

			$scope.deletecart = function($item){
				$http({
					method: "get",
					url: API_URL+"admin/cart/"+$item.id+"/delete"
				}).then(function(response){
					if(response.data!=null)
					{
						if(response.data.constructor === String)
						{
							if(response.data == 'deleted')
							{
								//DELETED in return string
								$.each($scope.carts, function($i, $ii){
									if($ii.id == $item.id)
									{
										$scope.carts.splice($ii);
										return false;
									}
								});
							}
						}
					}
				});
			}

			$scope.submitemployeenote = function($index, $index2){
				$http({
					"method" 	: "POST",
					"url"		 	: API_URL+"admin/cart/employeenote",
					"data" 		: {
						"cartdetaildID" : $scope.carts[$index].cartdetail[$index2].id,
						"employeenote" : $scope.carts[$index].cartdetail[$index2].employeenote
					}
				}).then(function(response){
					if(response!=null)
						$scope.carts[$index].cartdetail[$index2].employeenote = response.data;
					else
						$scope.carts[$index].cartdetail[$index2].employeenote = '';
				});
			}

			$scope.showdetail = function($item)
			{
				if($item.showdetail)
				{
					$item.showdetail = false;
				}
				{
					$anyopen = false;
					$.each($scope.carts, function($i, $ii){
						if($ii.showdetail)
							$anyopen = true;
					});

					if($anyopen)
					{
						$scope.closeAllDetail();
					}
					$item.showdetail = true;
				}
			}

			$scope.closeAllDetail = function(){
				$.each($scope.carts, function($i, $ii){
					$scope.carts[$i].showdetail = false;
				});
			}

			$scope.addbyadmin = function(){
				$('#addbyadminModal').modal('show');
			}

			

			$scope.setFileOK = function($item){
				$http(
					{
						method:"POST",
						url:API_URL+"cartheaders/filestatus/setOK/"+$item.id
					}
				).then(function(response){
					if(response.data.status == "success")
						$scope.carts = response.data;
					else
						console.log('ERROR di Set File status => OK')
				},function(error){});
			}

			$scope.setFileNotOK = function(){
				$('#cartRejectModal').modal('show');
			}

			$scope.uploadoriginalClick = function($custID, $cartID, $index)
			{
				$("#uploadoriginal").click();
				$scope.activeCustomerID = $custID;
				$scope.activeCartID = $cartID;
				$scope.activeCartIndex = $index;
			}

			$('#uploadoriginal').on('change', function(e) 
			{ 
				if ($(this)[0].files){
					if ($(this)[0].files.length > 0) {
						$scope.uploadoriginal($(this)[0].files, $scope.activeCustomerID, $scope.activeCartID);
					}
				} 
				return false;
			});

			//TAMBAH FILE BARU BY ADMIN
			$scope.uploadoriginal = function(files, custID, cartID){
				var data = new FormData();
				$scope.uploaderror = '';
				$scope.uploadwaiting = true;

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
						//jobsubtypeID -> dibuang, ditambahkan dengan user dapat mengganti filename dan deskripsi
					}
				});
				
				$http({
					method: 'POST',
					url: API_URL+'upload/original/'+custID+'/'+cartID,
					data: data,
					withCredentials: true,
					headers: {'Content-Type': undefined },
					transformRequest: angular.identity
				}).then(function(response) {
					if(response.data!=null)
					{
						console.log(response.data);
						if(Array.isArray(response.data))
						{
							$scope.carts[$scope.activeCartIndex].cartfile = response.data;
						}
						else
							console.log(response.data);
					}
					else
					{
						console.log(response.data);
					}
					$scope.uploadwaiting = false;
					$scope.allowed();
				}).error(function(error) {
					
					$scope.error.files = "Error file (error not detected), call customer service for this error";
					$scope.uploadwaiting = false;
				});
			}
		}
	]);
};