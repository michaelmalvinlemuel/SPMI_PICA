(function () {
	
	angular
		.module('app')
		.factory('FoundationService', ['$http', FoundationService])
		.controller('FoundationController', ['$scope', '$state', 'FoundationService', FoundationController])
		.controller('CreateFoundationController', ['$scope', '$state', 'FoundationService', CreateFoundationController])
		.controller('UpdateFoundationController', ['$scope', '$state', '$stateParams', 'FoundationService', UpdateFoundationController])
})();

function FoundationService ($http) {
	return {
		get: function () {
			return $http.get('/foundations')
		},
		show: function (request) {
			return $http.get('/foundations/' + request)
		},
		store: function(request) {
			return $http.post('/foundation/store', request)
		},
		update: function (request) {
			return $http.post('/foundation/update', request)
		},
		destroy: function (request) {
			return $http.post('/foundation/destroy', request)
		}
	}
}

function FoundationController ($scope, $state, FoundationService) {
	$scope.foundations = {}

	$scope.load = function () {
		FoundationService
			.get()
			.then(function (response) {
				console.log(response);
				$scope.foundations = response.data
				console.log(JSON.stringify($scope.foundations))
			})
	}

	$scope.update = function (request) {
		$state.go('main.admin.foundation.update', {foundationId: request})
	}

	$scope.destroy = function (request) {
		var alert = confirm("Apakah Anda yakin ingin menghapus Universitas ini?")
		if (alert == true) {
			FoundationService
				.destroy({id: request})
				.then(function () {
					$scope.load()
				})
		}
	}

	$scope.load()
}

function CreateFoundationController ($scope, $state, FoundationService) {
	$scope.input = {}

	$scope.load = function() {

	}

	$scope.submit = function () {
		FoundationService
			.store($scope.input)
			.then(function () {
				$state.go('main.admin.foundation')
			})
	}

	$scope.load();

}

function UpdateFoundationController ($scope, $state, $stateParams, FoundationService) {
	$scope.input = {}

	$scope.load = function() {
		FoundationService
			.show($stateParams.foundationId)
			.then(function (response) {
				$scope.input = response.data;
			})
	}

	$scope.submit = function () {
		FoundationService
			.update($scope.input) 
			.then(function (response) {
					$state.go('main.admin.foundation')
			})
	}

	$scope.load();
}