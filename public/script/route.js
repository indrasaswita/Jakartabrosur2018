module.exports = function(app){
	app.config(["$routeProvider", "$locationProvider",
		function($routeProvider, $locationProvider) {
		  $routeProvider
		   .when('/product/:id', {
		    templateUrl: 'view/product.php',
		    controller: 'ProductController'
		  })
		   .when('/product', {
		    templateUrl: 'view/product.php',
		    controller: 'ProductController'
		  });

		   $routeProvider.otherwise({redirectTo : "/product"});

		  // configure html5 to get links working on jsfiddle
		  // $locationProvider.html5Mode(true);
		}
	]);
}