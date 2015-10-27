(function () {
	
	angular
		.module('app')
		.factory('JobService', ['$http', '$q', '$cacheFactory', JobService])
		.controller('JobController', ['$scope', '$state', 'UniversityService', 'JobService', JobController])
		.controller('CreateJobController', ['$scope', '$state', '$timeout', 'UniversityService', 'DepartmentService', 'JobService', CreateJobController])
		.controller('UpdateJobController', ['$scope', '$state', '$stateParams', '$timeout', 'UniversityService', 'DepartmentService', 'JobService', UpdateJobController])

})()



function JobService ($http, $q, $cacheFactory) {
	
	function JobService() {
		
		var self = this
		var cacheUniversity = null
		var $httpDefaultCache = $cacheFactory.get('$http');

		
		self.get = function () {
			var deferred = $q.defer()
			$http.get('/jobs')
				.then(function(response){
					deferred.resolve(response)
				}, function(response){
					deferred.reject(response)
				})
			return deferred.promise 
		}

		self.show = function (request) {
			var deferred = $q.defer()
			$http.get('/jobs/' + request)
				.then(function(response){
					deferred.resolve(response)
				}, function(response){
					deferred.reject(response)
				})
			return deferred.promise 
		}
		
		self.store = function(request) {
			var deferred = $q.defer()
			$http.post('/job/store', request)
				.then(function(response){
					$httpDefaultCache.removeAll()
					deferred.resolve(response)
				}, function(response){
					deferred.reject(response)
				})
			return deferred.promise 
		}
		
		self.update = function (request) {
			var deferred = $q.defer()
			$http.post('/job/update', request)
				.then(function(response){
					$httpDefaultCache.removeAll()
					deferred.resolve(response)
				}, function(response){
					deferred.reject(response)
				})
			return deferred.promise 
		}
		
		self.destroy = function (request) {
			var deferred = $q.defer()
			$http.post('/job/destroy', request)
				.then(function(response){
					$httpDefaultCache.removeAll()
					deferred.resolve(response)
				}, function(response){
					deferred.reject(response)
				})
			return deferred.promise 
		}
		
		self.department = function (request) {
			var deferred = $q.defer()
			$http.get('/job/department/' + request)
				.then(function(response){
					deferred.resolve(response)
				}, function(response){
					deferred.reject(response)
				})
			return deferred.promise 
		}
		
		self.university = function (request) {
			var deferred = $q.defer()
			$http.get('/job/university/' + request)
				.then(function(response){
					deferred.resolve(response)
				}, function(response){
					deferred.reject(response)
				})
			return deferred.promise 
		}
		
		self.validating = function (request) {
			var deferred = $q.defer()
			$http.get('/job/validating/' + request.name + '/' + request.department_id + '/' + request.id)
				.then(function(response){
					deferred.resolve(response)
				}, function(response){
					deferred.reject(response)
				})
			return deferred.promise 
		}
		
		self.users = function (request) {
			var deferred = $q.defer()
			$http.get('/job/users/' + request)
				.then(function(response){
					deferred.resolve(response)
				}, function(response){
					deferred.reject(response)
				})
			return deferred.promise

		}
		
		self.subs = function (request) {
			var deferred = $q.defer()
			$http.get('/job/subs/' + request)
				.then(function(response){
					deferred.resolve(response)
				}, function(response){
					deferred.reject(response)
				})
			return deferred.promise
		}
	}
	
	return new JobService()
}

function JobController ($scope, $state, UniversityService, JobService) {
	$scope.jobs = []
	$scope.universities = []

	$scope.load = function () {
		UniversityService
			.get()
			.then(function (response) {
				$scope.universities = response;
				$scope.university_id = response[0].id;	

				JobService
					.university($scope.university_id)
					.then(function (response) {
						$scope.jobs = response.data;
					})
			})
		
	}

	$scope.select = function () {
		JobService
			.university($scope.university_id)
			.then(function (response) {
				$scope.jobs = response.data;
			})
	}

	$scope.update = function (request) {
		$state.go('main.admin.job.update', {jobId: request})
	}

	$scope.destroy = function (request) {
		var alert = confirm("Apakah Anda yakin ingin menghapus Job ini?")
		if (alert == true) {
			JobService
				.destroy({id: request})
				.then(function() {
					$scope.load();
				})
		}
	}

	$scope.load()
}

function CreateJobController ($scope, $state, $timeout, UniversityService, DepartmentService, JobService) {
	var timeoutPromise;
	$scope.input = {}
	$scope.universities = {}
	$scope.departments = {}
	$scope.jobs = {}
	$scope.validated = false;


	$scope.load = function() {
		$scope.hasDepartment = true
		$scope.loadingUniversity = true
		UniversityService
			.get()
			.then(function (response) {
				$scope.universities = response;
				$scope.loadingUniversity = false
			})
	}

	$scope.$watch('input.name', function () {
		var validName = $scope.JobForm.name.$invalid
		var dirtyName = $scope.JobForm.name.$dirty
		
		if (!validName && dirtyName) {
			$timeout.cancel(timeoutPromise)
			$scope.loading = true;
			timeoutPromise = $timeout(function() {
				JobService
					.validating($scope.input)
					.then(function (response) {
						//console.log(response.data);
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
		$scope.JobForm.university_id.$setDirty();
		$scope.JobForm.department_id.$setDirty();
		$scope.JobForm.name.$setDirty();

		if ($scope.JobForm.$valid) {
			JobService
				.store($scope.input)
				.then(function () {
					$state.go('main.admin.job')
				})
		} else {
			$scope.validated = true;
		}
	}

	$scope.selectUniversity = function (id) {
		$scope.loadingDepartment = true
		DepartmentService
			.university(id)
			.then(function (response) {
				$scope.departments = response.data;
				$scope.loadingDepartment = false
				$scope.loadingJob = true
				if (response.data.length > 0) {
					$scope.hasDepartment = true
				} else {
					$scope.hasDepartment = false
				}

				JobService
					.university(id)
					.then(function (response) {
						//console.log(response.data);
						$scope.jobs = response.data;
						$scope.loadingJob = false
					})
			})
	}

	$scope.load();

}

function UpdateJobController ($scope, $state, $stateParams, $timeout, UniversityService, DepartmentService, JobService) {
	var timeoutPromise;
	$scope.input = {}
	$scope.universities = {}
	$scope.departments = {}
	$scope.jobs = {}
	$scope.validated = false;


	$scope.load = function() {
		$scope.loadingUniversity = true
		$scope.loadingDepartment = true

		JobService
			.show($stateParams.jobId)
			.then(function (response) {
				$scope.input = response.data;
				$scope.input.multiple = response.data.multiple == 1 ? true : false;

				UniversityService
					.get()
					.then(function (response) {
						$scope.universities = response;
						$scope.university_id = $scope.input.department.university.id;
						$scope.loadingUniversity = false

						DepartmentService
							.university($scope.university_id)
							.then(function (response) {
								$scope.departments = response.data;
								$scope.loadingDepartment = false;
								if (response.data.length > 0) {
									$scope.hasDepartment = true
								} else {
									$scope.hasDepartment = false
								}

								JobService
									.university($scope.university_id)
									.then(function (response) {
										$scope.jobs = response.data;
									})

							})


					})
			})
	}

	$scope.$watch('input.name', function () {
		var validName = $scope.JobForm.name.$invalid
		var dirtyName = $scope.JobForm.name.$dirty
		
		if (!validName && dirtyName) {
			$timeout.cancel(timeoutPromise)
			$scope.loading = true;
			timeoutPromise = $timeout(function() {
				JobService
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
		$scope.JobForm.university_id.$setDirty();
		$scope.JobForm.department_id.$setDirty();
		$scope.JobForm.name.$setDirty();

		if ($scope.JobForm.$valid) {
			JobService
				.update($scope.input)
				.then(function () {
					$state.go('main.admin.job');
				})
		} else {
			$scope.validated = true;
		}
		
		
	}


	$scope.selectUniversity = function (id) {
		$scope.loadingDepartment = true
		DepartmentService
			.university(id)
			.then(function (response) {
				$scope.departments = response.data;
				$scope.loadingDepartment = false
				$scope.loadingJob = true
				if (response.data.length > 0) {
					$scope.hasDepartment = true
				} else {
					$scope.hasDepartment = false
				}
				JobService
					.university(id)
					.then(function (response) {
						console.log(response.data);
						$scope.jobs = response.data;
						$scope.loadingJob = false
					})
			})
	}

	$scope.load();
}


