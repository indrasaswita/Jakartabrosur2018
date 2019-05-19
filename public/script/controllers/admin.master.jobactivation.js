module.exports = function(app) {
	app.controller('AdmJobactivationController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window) {

			$scope.jobtypes = null;
			$scope.saving = false;

			$scope.initData = function($input) {
				$scope.jobtypes = JSON.parse($input);
				$scope.hideall();
			}

			$scope.hideall = function(){
				if ($scope.jobtypes != null) {
					$.each($scope.jobtypes, function($index, $item) {
						if ($item != null) {
							$scope.jobtypes[$index].editmode = false;
						}
					});
				}
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

		}
	]);
};