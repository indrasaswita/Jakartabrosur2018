module.exports = function(app){
	app.controller('AdmSalesaddprooffileController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $window){

			$scope.errormessage = "";
			
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
					url: AJAX_URL+'upload/preview/'+cartID,
					data: data,
					withCredentials: true,
					headers: {'Content-Type': undefined },
					transformRequest: angular.identity
				}).then(function(response) {
					if(response.data!=null)
					{
						if(Array.isArray(response.data))
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
					//$scope.allowed();
				}, function(error) {
					$scope.errormessage = "Error file (error not detected), call customer service for this error";
					$scope.uploadwaiting = false;
				});

				//buat apus file abis d input
				//$scope.clearFileInput('file');
			}

		}
	]);
}