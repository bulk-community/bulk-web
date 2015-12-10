angular.module('org.nemanjan00.bulk.controllers', ['ui.bootstrap'])
.controller("MainPage", function($scope, $uibModal, $http){
	$scope.open = function () {
		$scope.modal = $uibModal.open({
			animation: $scope.animationsEnabled,
			templateUrl: 'loading.html',
			size: "sm",
			resolve: {
				items: function () {
				return $scope.items;
				}
			}
		});
	}

	$scope.open();
	
	$scope.opener = [];
	$scope.cold_read = [];
	$scope.quest_opener = [];

	$scope.safeApply = function() {
		var phase = this.$root.$$phase;
		if(!(phase == '$apply' || phase == '$digest')) {
			this.$apply();
		}
	};

	$scope.load = 0;

	$http.get('/api/opener')
	.success(function(data, status, headers, config) {
		$scope.opener = data;

		$scope.load++;
		if($scope.load > 2){
			$scope.modal.close();
		}
	});

	$http.get('/api/cold-read')
	.success(function(data, status, headers, config) {
		$scope.cold_read = data;
		
		$scope.load++;
		if($scope.load > 2){
			$scope.modal.close();
		}
	});
	
	$http.get('/api/quest-opener')
	.success(function(data, status, headers, config) {
		$scope.quest_opener = data;

		$scope.load++;
		if($scope.load > 2){
			$scope.modal.close();
		}
	});
});

