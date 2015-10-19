(function () {

	angular
		.module('app')
		.factory('DepartmentService', ['$http', DepartmentService])
		.controller('DepartmentController', ['$scope', '$state', 'DepartmentService', DepartmentController])
		.controller('CreateDepartmentController', ['$scope', '$state', '$timeout', 'UniversityService', 'DepartmentService', CreateDepartmentController])
		.controller('UpdateDepartmentController', ['$scope', '$state', '$stateParams', '$timeout', 'UniversityService', 'DepartmentService', UpdateDepartmentController])


})();

function DepartmentService ($http) {
	return {
		get: function () {
			return $http.get('/departments')
		},
		show: function (request) {
			return $http.get('/departments/' + request)
		},
		store: function(request) {
			return $http.post('/department/store', request)
		},
		update: function (request) {
			return $http.post('/department/update', request)
		},
		destroy: function (request) {
			return $http.post('/department/destroy', request)
		},
		university: function (request) {
			return $http.get('/department/university/' + request)
		},
		validating: function (request) {
			return $http.post('/department/validating', request)
		}
	}
}

function DepartmentController ($scope, $state, DepartmentService) {
	$scope.departments = []

	$scope.load = function () {
		DepartmentService
			.get()
			.then(function (response) {
				$scope.departments = response.data;
			})
	}

	$scope.update = function (request) {
		$state.go('main.admin.department.update', {departmentId: request})
	}

	$scope.destroy = function (request) {
		var alert = confirm("Apakah Anda yakin ingin menghapus Department ini?")
		if (alert == true) {
			DepartmentService
				.destroy({id: request}) 
				.then(function () {
					$scope.load();
				})
		}
	}

	$scope.load()
}

function CreateDepartmentController ($scope, $state, $timeout, UniversityService, DepartmentService) {
	var timeoutPromise;
	$scope.input = {}
	$scope.universities = {}
	$scope.departments = {}
	$scope.validated = false;
	
	$scope.load = function() {
		$scope.loadingUniversity = true
		UniversityService
			.get()
			.then(function (response) {
				$scope.universities = response;
				$scope.loadingUniversity = false
			})
	}

	$scope.$watch('input.name', function () {
		var validName = $scope.DepartmentForm.name.$invalid
		var dirtyName = $scope.DepartmentForm.name.$dirty
		
		if (!validName && dirtyName) {
			$timeout.cancel(timeoutPromise)
			$scope.loading = true;
			timeoutPromise = $timeout(function() {
				DepartmentService
					.validating($scope.input)
					.then(function (response) {
						console.log(response.data);
						if (response.data.length > 0) {
							$scope.exist = true
						} else {
							$scope.exist = false
						}
						$scope.loading = false;
					})
			}, 1000)
		}
		
	})


	$scope.submit = function () {
		$scope.DepartmentForm.name.$setDirty();
		$scope.DepartmentForm.university_id.$setDirty();

		if ($scope.DepartmentForm.$valid) {
			DepartmentService
				.store($scope.input)
				.then(function () {
					$state.go('main.admin.department')
				})
		} else {
			$scope.validated = true;
		}
		
	}

	$scope.select = function() {
		$scope.loadingDepartment = true
		DepartmentService
			.university($scope.input.university_id)
			.then(function (response) {
				$scope.loadingDepartment = false
				$scope.departments = response.data

				if ($scope.input.name) {
					$timeout.cancel(timeoutPromise)
					$scope.loading = true;
					timeoutPromise = $timeout(function() {
						DepartmentService
							.validating($scope.input)
							.then(function (response) {
								console.log(response.data);
								if (response.data.length > 0) {
									$scope.exist = true
								} else {
									$scope.exist = false
								}
								$scope.loading = false;
							})
					}, 1000)
				}
		})
	}

	$scope.load();

}

function UpdateDepartmentController ($scope, $state, $stateParams, $timeout, UniversityService, DepartmentService) {
	var timeoutPromise;
	$scope.input = {}
	$scope.departments = {}
	$scope.universities = {}
	$scope.validated = false;

	$scope.load = function() {
		

		$scope.loadingUniversity = true
		$scope.loadingDepartment = true
		

		DepartmentService
			.show($stateParams.departmentId)
			.then(function (response) {
				$scope.input = response.data;

				UniversityService
					.get()
					.then(function (response) {
						$scope.universities = response;
						$scope.loadingUniversity = false

						DepartmentService
							.university($scope.input.university_id)
							.then(function (response) {
								$scope.departments = response.data
								$scope.loadingDepartment = false
							})

				})
		})
	}

	$scope.$watch('input.name', function () {
		var validName = $scope.DepartmentForm.name.$invalid
		var dirtyName = $scope.DepartmentForm.name.$dirty
		
		if (!validName && dirtyName) {
			$timeout.cancel(timeoutPromise)
			$scope.loading = true;
			timeoutPromise = $timeout(function() {
				DepartmentService
					.validating($scope.input)
					.then(function (response) {
						console.log(response.data);
						if (response.data.length > 0) {
							$scope.exist = true
						} else {
							$scope.exist = false
						}
						$scope.loading = false;
					})
			}, 1000)
		}
		
	})


	$scope.submit = function () {
		$scope.DepartmentForm.name.$setDirty();
		$scope.DepartmentForm.university_id.$setDirty();

		if ($scope.DepartmentForm.$valid) {
			DepartmentService
				.update($scope.input)
				.then(function (response) {
					$state.go('main.admin.department');
				})
		} else {
			$scope.validated = true;
		}
	}

	$scope.select = function() {
		$scope.loadingDepartment = true
		DepartmentService
			.university($scope.input.university_id)
			.then(function (response) {
				$scope.loadingDepartment = false
				$scope.departments = response.data
		})
	}

	$scope.load();
}