module.exports = function(app){
	app.controller('NotificationController', ['$scope', '$http', 'API_URL', 'AJAX_URL', 'BASE_URL', '$cookies', '$window',
		function($scope, $http, API_URL, AJAX_URL, BASE_URL, $cookies, $window){
			//$scope.notifications = null;

			$scope.initData = function($datas){
				$scope.notifications = JSON.parse($datas);
			}

			$scope.view = function($item){
				if(!$item.viewed && $item.ownerID!=null){
					$http({
						method: 'POST',
						url: AJAX_URL + 'notification/view/' + $item.id
					}).then(function(response) {
						if(response.data != null){
							console.log(response.data);
							if(typeof response.data == "string"){
								if(response.data == "success"){
									$item.viewed = true;
								}else{
									console.log("Error (change view state): "+response.data);
								}
							}
						}
					}, function(error){
						alert(error);
					});
				}
			}

			$scope.viewAll = function (){

			}
		}
	]);
};