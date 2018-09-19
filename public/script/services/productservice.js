module.exports = function(app){
	app.factory("ProductService", ["$resource",
		function($resource){
			return $resource("", null,{
				getProduct : {method : "get", url : "/json/products/:qty/:size/:mat/:gram/:sdp", isArray : true}
			});
		}
	]);
}