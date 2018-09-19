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
) //'http://localhost:8000/API/');


/*
.constant('API_URL', )
.constant('WEB_URL', 'http://localhost:8000/');*/