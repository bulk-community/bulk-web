angular.module('org.nemanjan00.open-pua', ['ui.router', 'org.nemanjan00.open-pua.controllers'])

.config(function($stateProvider, $urlRouterProvider, $locationProvider) {
	$locationProvider.html5Mode(true);
	
	$stateProvider
		.state('app', {
			url: "/app",
			abstract: true,
			templateUrl: "templates/menu.html"
		})

		.state('app.map', {
			url: "/map",
			views: {
				'menuContent' :{
					templateUrl: "templates/index.html",
				}
			}
		})

	$urlRouterProvider.otherwise('/app/api');
});
