module.exports = function(app) {
	app.controller('FloatingcontactController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window) {

			$scope.faquestionsloading = false;
			$scope.faquestions = [];
			$scope.faquestionsmaster = [];

			$scope.hoverfloatingcontact = function() {
				$('#floating-link').removeClass('hide');
			}
			$scope.leavefloatingcontact = function() {
				$('#floating-link').addClass('hide');
			}
			$scope.openfloatingcontact = function() {
				$scope.loadfaquestion();
				$('#floating-panel').modal('show');
			}

			$scope.loadfaquestion = function(){
				if (!$scope.faquestionsloading) {
					$scope.faquestionsloading = true;
					$http({
						method: "GET",
						url: AJAX_URL+"faquestions"
					}).then(function(response) {
						if (response != null) {
							if (response.data != null) {
								$scope.faquestionsmaster = response.data;
								$.each($scope.faquestionsmaster, function($index, $item){
									$scope.faquestionsmaster[$index].show = false;
								});
								$scope.faquestions = $scope.getfavourites($scope.faquestionsmaster);
								console.log($scope.faquestions);
								console.log("masuk ques");
							} else {
								console.log("The return value is null, not error");
							}
						}
						$scope.faquestionsloading = false;
					}, function(error) {
						console.log(error);
						$scope.faquestionsloading = false;
					});
				}
			}

			$scope.getfavourites = function($master){
				$temp = [];
				$.each($master, function($i, $ii){
					if ($ii.favourite == 1) {
						$temp.push($ii);
					}
				});
				return $temp;
			}

			$scope.gettemennya = function($master, $typeid){
				$temp = [];
				$.each($master, function($i, $ii){
					//insert selain type id dia, yang fav
					if ($ii.favourite == 1 && $ii.questiontypeID != $typeid) {
						$temp.push($ii);
					}
					//insert yang type idnya sama - temennya
					if($ii.questiontypeID == $typeid){
						$temp.push($ii);
					}
				});
				return $temp;
			}

			$scope.selecttemennya = function($item){
				//input berupa faquestion (single)
				if($item.show == false){
					//kalo masi hidden
					$scope.faquestions = $scope.gettemennya($scope.faquestionsmaster, $item.questiontypeID);
					$scope.hideall();
					$.each($scope.faquestions, function($i, $ii) {
						if ($item.id == $ii.id) {
							$scope.faquestions[$i].show = true;	
						}
					});
				}else{
					//kalo show -> make hidden
					$scope.hideall();
				}
			}

			$scope.hideall = function(){
				$.each($scope.faquestions, function($index, $item) {
					$scope.faquestions[$index].show = false;
				});
			}

		}
	]);
};