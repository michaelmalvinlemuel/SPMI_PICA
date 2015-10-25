(function () {
	
	angular
		.module('app')
		.controller('EndUserController', ['$scope', '$state', 'UserService', EndUserController])	
})()

function EndUserController ($scope, $state, UserService) {
	$scope.debug = true
	$scope.load = function () {

		$scope.user = UserService.session();
	}

	$scope.logout = function () {
		UserService
			.logout()
			.then(function () {
				$state.go('login');
			})
	}

	$scope.load()
}	

