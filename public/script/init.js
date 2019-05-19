module.exports = angular.module('jakartabrosur', 
	[
		"ngRoute",
		"ngResource",
		"ngCookies",
		"ngSanitize",
		"angularUtils.directives.dirPagination"
	]
,function($interpolateProvider) 
	{
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }
)