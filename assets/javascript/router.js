angular.module('org.nemanjan00.bulk', ['ui.router', 'org.nemanjan00.bulk.controllers'])

.config(function($stateProvider, $urlRouterProvider, $locationProvider) {
	$locationProvider.html5Mode(true);
	
	$stateProvider
		.state('app', {
			url: "/app",
			abstract: true,
			templateUrl: "templates/menu.html"
		})

		.state('app.home', {
			url: "/home",
			views: {
				'menuContent' :{
					templateUrl: "templates/index.html",
				}
			}
		})

	$urlRouterProvider.otherwise('/app/home');
});
