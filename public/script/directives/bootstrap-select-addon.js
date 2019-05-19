module.exports = function(app){
	app.directive('pageRefresh', function($timeout) {
		return {
			restrict: 'A',
			link: function( $scope, elem, attrs ) {    
				elem.ready(function(){
					$scope.$apply(function(){
						$scope.afterAngular();
					})
				})
			}  
		}
	});
}