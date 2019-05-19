module.exports = function(app) {
	app.controller('AdmJobeditorController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window) {

			$scope.jobsubtypes = null;
			$scope.saving = false;

			$scope.initData = function($input){
				$scope.jobsubtypes = JSON.parse($input);
				$.each($scope.jobsubtypes, function($index, $item){
					$scope.jobsubtypes[$index].editmode = false;
					$scope.jobsubtypes[$index].saveerror = "";
				});
			}

			$scope.toggleedit = function($item){
				$temp = $item.editmode;
				if($temp == false){
					$.each($scope.jobsubtypes, function($i, $ii){
						$ii.editmode = false;
					});
				}
				$item.editmode = !$temp;
			}

			$scope.saveitem = function($index, $item){
				$http({
					method:'POST',
					url: AJAX_URL+"jobeditor/jobsubtypes/update",
					data: $item
				}).then(function(response){
					if(response.data!=null){
						if(typeof response.data == "object"){
							$scope.jobsubtypes[$index] = response.data;
							$scope.jobsubtypes[$index].saveerror = "Update Success";
							$scope.jobsubtypes[$index].editmode = true;
						}
						else{
							$scope.jobsubtypes[$index].saveerror = "Tidak ada return data";
						}
					}else{
						$scope.jobsubtypes[$index].saveerror = "Tidak ada return data";
					}
				}, function(error){
					$scope.jobsubtypes[$index].saveerror = "Error: bisa di lihat di console";
					console.log(error);
				});
			}
		}
	]);
};