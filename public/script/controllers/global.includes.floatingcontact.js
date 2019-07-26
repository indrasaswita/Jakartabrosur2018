module.exports = function(app) {
	app.controller('FloatingcontactController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window) {

			$scope.faquestionsloading = false;
			$scope.faquestions = [];



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
						url: AJAX_URL + "faquestions"
					}).then(function(response) {
						if (response != null) {
							if (response.data != null) {
								if (typeof response.data == "string") {
									$scope.faquestionsmaster = response.data;
									$scope.faquestions = $scope.clone($scope.faquestionsmaster);
								}
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

		}
	]);
};