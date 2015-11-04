(function () {
	'use strict'

	angular
		.module('app', ['ngCookies', 'ui.router', 'ui.bootstrap', 'ngFileUpload', 'chart.js', 'ngMessages', 'jsonFormatter', 'angularBootstrapNavTree', 'pdf'])
		.run(['$rootScope', '$state', '$stateParams', '$timeout', 'Authorization', 'UserService', AppRun])
		.config(['$stateProvider', '$urlRouterProvider', '$httpProvider', AppConfiguration])
		.filter('debug', function() {
  			return function(input) {
    			if (input === '') return 'empty string';
    				return input ? input : ('' + input);

    			return JSON.stringify(input)
  			}
  		})
		.factory('Authorization', ['$rootScope', '$state', '$q', 'UserService', Authorization])
		.controller('AppController', ['$scope', '$state', 'Session', 'UserService', AppController])
		.controller('LoginController', ['$rootScope', '$scope', '$state', '$stateParams', 'UserService', LoginController])
		.controller('RegisterController', ['$rootScope', '$scope', '$state', '$timeout', '$modal', 'UserService', RegisterController])
		.controller('InformationRegistrationController', ['$scope', '$state', '$stateParams', '$timeout', InformationRegistrationController])
		
})();

function AppRun ($rootScope, $state, $stateParams, $timeout, Authorization, UserService) {
	
	$rootScope.pushIfUnique = function (parent, child) {
		var i = 0;
		counter = 0;
		for (i = 0 ; i < parent.length ; i++) {
			if (angular.equals(parent[i], child)) {
				break;
				return -1
			}
			counter++
		}

		console.log(parent.length)

		if (counter === parent.length) {
			parent.push(child)
			return counter
		}
	}

	$rootScope.findObject = function (parent, child) {
		var i = 0;
		counter = 0;

		for (i = 0 ; i < parent.length ; i++) {
			if (angular.equals(parent[i], child)) {
				return i
			}
			counter++
		}

		if (counter === parent.length) {
			return -1
		}
	}

	
	$rootScope.first = false
	$rootScope.toDenied = false;

	$rootScope.run = false
	
	//Authorization.authorize();

	//$state.go('main.login')


	
	$rootScope.$on('$stateChangeStart', function(event, toState, toStateParams, fromState) {
		// track the state the user wants to go to; authorization service needs this

			$rootScope.toState = toState;
			$rootScope.toStateParams = toStateParams;
			
			$rootScope.fromState = fromState;

		
			

			/*
				if (!UserService.isAuthenticated()) {

					//console.log('toState:' + $rootScope.toState.name)
	            	//console.log('fromState:' + $rootScope.fromState.name)

		            
	            	

					//Authorization.authorize();

					if ($rootScope.toState.name !== 'main.login' && $rootScope.first) {
						event.preventDefault();
					}

					if ($rootScope.toState.name == $rootScope.fromState.name) {
						event.preventDefault();
					}
					
					//Authorization.authorize();
					
					//event.preventDefault();
				} else {
					if ($rootScope.toState.name == 'main.login') {
						event.preventDefault();
					}

	            	if (!UserService.isInAnyRole($rootScope.toState.data.type) && $rootScope.fromState.name == 'main.denied') {
	            		event.preventDefault();
	            	}


	            	if (!UserService.isInAnyRole($rootScope.toState.data.type) && $rootScope.fromState.name !== 'main.denied' &&
	            		$rootScope.toDenied == false) 
	            	{
	            		$rootScope.toDenied = true
	            		event.preventDefault();
	            		$state.go('main.denied');
	            		event.preventDefault();
	            	}
	            	$rootScope.toDenied = false
					//Authorization.authorize();
				}
			*/


  	});
  	
}

function AppConfiguration ($stateProvider, $urlRouterProvider, $httpProvider) {
	
	var promise = function ($rootScope, $q, $timeout, Authorization) {

		var deferred = $q.defer();

		//console.log($rootScope.fromState.name)
		//console.log($rootScope.toState.name)
		//console.log('stop fucking logging')
		//console.log('authorization resolving')

	 	Authorization.authorize().then(function(response) {
			//console.log('config authrize success')
			deferred.resolve(response)
		}, function(response) {
			//console.log('config authrize failure');
			deferred.reject(response)
		})
		
		return deferred.promise;

	}

	var resolve = {
		Session: promise
	}

	$urlRouterProvider.otherwise('/');
	
	
	$httpProvider.defaults.cache = true;
	$httpProvider.defaults.useXDomain = true;
	//$httpProvider.defaults.withCredentials = true;
	
	
	
	
	
					
	$stateProvider
		.state('main', {
			resolve: resolve,
			abstract: true,
			url: '',
			
		})

		.state('main.app', {
			url: '/',
			views: {
				'@': {
					templateUrl: 'app/views/main.html',
					controller: 'AppController'
				}
			},
			data: {
				type: ['1']
			},
		})

		.state('login', {
			url:'/login',
			views: {
				'': {
					templateUrl: 'app/views/login.html',
					controller: 'LoginController'
				}
			},
			data: {
				type: []
			},
			resolve: {
				back: function($rootScope, $q, $state, UserService) {
					var deferred = $q.defer()



					UserService.identity()
						.then(function() {
							if($rootScope.toState.name == 'login' || $rootScope.toState.name == 'register') {
								deferred.resolve()
								$state.go($rootScope.fromState.name)
							}
							deferred.resolve()
						}, function() {
							deferred.resolve()
						})

					return deferred.promise
				}
			}

		})

	$stateProvider
		.state('register', {
			url:'/register',
			views: {
				'': {
					templateUrl: 'app/views/register.html',
					controller: 'RegisterController'
				}
			},
			data: {
				type: []
			},
			resolve: {
				back: function($rootScope, $q, $state, UserService) {
					var deferred = $q.defer()

					UserService.identity()
						.then(function() {
							if($rootScope.toState.name == 'login' || $rootScope.toState.name == 'register') {
								deferred.resolve()
								$state.go($rootScope.fromState.name)
							}
							deferred.resolve()
						}, function() {
							deferred.resolve()
						})

					return deferred.promise
				}
			}

		})
		
		.state('error', {
			views: {
				'': {
					templateUrl: 'app/views/error.html'
				}
			},
			data: {
				type: []
			},
			resolve: {
				back: function($rootScope, $q, $state, UserService) {
					var deferred = $q.defer()

					UserService.identity()
						.then(function() {
							if($rootScope.toState.name == 'error') {
								deferred.resolve()
								$state.go($rootScope.fromState.name)
							}
							deferred.resolve()
						}, function() {
							deferred.resolve()
						})

					return deferred.promise
				}
			}
		})

		.state('register.information', {
			url: '/information',
			params: { 
		        // here we define default value for foo
		        // we also set squash to false, to force injecting
		        // even the default value into url
		        email: {
		          
		        },
		        // this param is not part of url
		        // it could be passed with $state.go or ui-sref 
		        hiddenParam: 'YES',
	      	},
			views: {
				'@': {
					templateUrl: 'app/views/information.html',
					controller: 'InformationRegistrationController'
				}
			}
		})

	$stateProvider
		.state('main.admin', {
			url:'/admin',
			parent: 'main',
			views: {
				'@': {
					templateUrl: 'app/admin/views/main.html',
					controller: 'AdminController'
				},
				'content@main.admin': {
					templateUrl: 'app/admin/views/dashboard.html',
					controller: 'AdminController'
				}
			},
			data: {
				type: ['1']
			},
			resolve: resolve,
		
		})

	
		.state('main.admin.user', {
			url: '/user',
			views: {
				'content': {
					templateUrl: 'app/admin/user/views/list.html',
					controller: 'UserController'
				}
			},
			resolve: resolve,
		})

		.state('main.admin.user.create', {
			url: '/create',
			views: {
				'content@main.admin': {
					templateUrl: 'app/admin/user/views/form.html',
					controller: 'CreateUserController'
				},
			}
		})

		.state('main.admin.user.update', {
			url: '/update/:userId',
			views: {
				'content@main.admin': {
					templateUrl: 'app/admin/user/views/form.html',
					controller: 'UpdateUserController'
				},
			}
		})
		
		.state('main.admin.document', {
			url: '/document',
			views: {
				'content@main.admin': {
					templateUrl: 'app/admin/document/views/list.html',
					controller: 'DocumentController'
				}
			},
			resolve: resolve,
		})


		//Work

		.state('main.admin.groupJob', {
			url: '/groupJob',
			views: {
				'content': {
					templateUrl: 'app/admin/groupJob/views/list.html',
					controller: 'GroupJobController'
				}
			},
			resolve: resolve,
		})

		.state('main.admin.groupJob.create', {
			url: '/create',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/groupJob/views/form.html',
					controller: 'CreateGroupJobController'
				}
			}
		})

		.state('main.admin.groupJob.update', {
			url: '/update/:groupJobId',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/groupJob/views/form.html',
					controller: 'UpdateGroupJobController'
				}
			}
		})



		.state('main.admin.semester', {
			url: '/semester',
			views: {
				'content': {
					templateUrl: 'app/admin/semester/views/list.html',
					controller: 'SemesterController'
				}
			},
			resolve: resolve,
		})

		.state('main.admin.semester.create', {
			url: '/create',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/semester/views/form.html',
					controller: 'CreateSemesterController'
				}
			}
		})

		.state('main.admin.semester.update', {
			url: '/update/:semesterId',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/semester/views/form.html',
					controller: 'UpdateSemesterController'
				}
			}
		})

	
		.state('main.admin.work', {
			url: '/work',
			views: {
				'content': {
					templateUrl: 'app/admin/work/views/list.html',
					controller: 'WorkController'
				}
			},
			resolve: resolve,
		})

		.state('main.admin.work.create', {
			url: '/create',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/work/views/form.html',
					controller: 'CreateWorkController'
				}
			}
		})

		.state('main.admin.work.update', {
			url: '/update/:workId',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/work/views/form.html',
					controller: 'UpdateWorkController'
				}
			}
		})

		.state('main.admin.project', {
			url: '/project',
			views: {
				'content': {
					templateUrl: 'app/admin/project/views/list.html',
					controller: 'ProjectController'
				}
			},
			resolve: resolve,
		})

		.state('main.admin.project.create', {
			url: '/create',
			views: {
				'content@main.admin': {
					templateUrl: 'app/admin/project/views/detail.html',
					controller: 'CreateProjectController'
				}
			},
			resolve: resolve,
		})

		.state('main.admin.project.update', {
			url: '/update/:projectId',
			views: {
				'content@main.admin': {
					templateUrl: 'app/admin/project/views/detail.html',
					controller: 'UpdateProjectController'
				}
			},
			resolve: resolve,
		})



		//Document
	
		.state('main.admin.standard', {
			url: '/standard',
			views: {
				'content': {
					templateUrl: 'app/admin/standard/views/list.html',
					controller: 'StandardController'
				}
			},
			resolve: resolve,
		})

		.state('main.admin.standard.create', {
			url: '/create',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/standard/views/form.html',
					controller: 'CreateStandardController'
				}
			}
		})

		.state('main.admin.standard.update', {
			url: '/update/:standardId',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/standard/views/form.html',
					controller: 'UpdateStandardController'
				}
			}
		})


		//Organization
	
		.state('main.admin.standarddocument', {
			url: '/standarddocument',
			views: {
				'content': {
					templateUrl: 'app/admin/standardDocument/views/list.html',
					controller: 'StandardDocumentController'
				}
			},
			resolve: resolve,
		})

		.state('main.admin.standarddocument.create', {
			url: '/create',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/standardDocument/views/form.html',
					controller: 'CreateStandardDocumentController'
				}
			}
		})

		.state('main.admin.standarddocument.update', {
			url: '/update/:standarddocumentId',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/standardDocument/views/form.html',
					controller: 'UpdateStandardDocumentController'
				}
			}
		})




		.state('main.admin.guide', {
			url: '/guide',
			views: {
				'content': {
					templateUrl: 'app/admin/guide/views/list.html',
					controller: 'GuideController'
				}
			},
			resolve: resolve,
		})

		.state('main.admin.guide.create', {
			url: '/create',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/guide/views/form.html',
					controller: 'CreateGuideController'
				}
			}
		})

		.state('main.admin.guide.update', {
			url: '/update/:guideId',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/guide/views/form.html',
					controller: 'UpdateGuideController'
				}
			}
		})




		.state('main.admin.instruction', {
			url: '/instruction',
			views: {
				'content': {
					templateUrl: 'app/admin/instruction/views/list.html',
					controller: 'InstructionController'
				}
			},
			resolve: resolve,
		})

		.state('main.admin.instruction.create', {
			url: '/create',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/instruction/views/form.html',
					controller: 'CreateInstructionController'
				}
			}
		})

		.state('main.admin.instruction.update', {
			url: '/update/:instructionId',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/instruction/views/form.html',
					controller: 'UpdateInstructionController'
				}
			}
		})




		.state('main.admin.form', {
			url: '/form',
			views: {
				'content': {
					templateUrl: 'app/admin/form/views/list.html',
					controller: 'FormController'
				}
			},
			resolve: resolve,
		})

		.state('main.admin.form.create', {
			url: '/create',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/form/views/form.html',
					controller: 'CreateFormController'
				}
			}
		})

		.state('main.admin.form.update', {
			url: '/update/:formId',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/form/views/form.html',
					controller: 'UpdateFormController'
				}
			}
		})

		.state('main.admin.foundation', {
			url: '/foundation',
			views: {
				'content': {
					templateUrl: 'app/admin/foundation/views/list.html',
					controller: 'FoundationController'
				}
			},
			resolve: resolve,
		})

		.state('main.admin.foundation.create', {
			url: '/create',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/foundation/views/form.html',
					controller: 'CreateFoundationController'
				}
			}
		})

		.state('main.admin.foundation.update', {
			url: '/update/:universityId',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/foundation/views/form.html',
					controller: 'UpdateFoundationController'
				}
			}
		})


		.state('main.admin.university', {
			url: '/university',
			views: {
				'content': {
					templateUrl: 'app/admin/university/views/list.html',
					controller: 'UniversityController'
				}
			},
			resolve: resolve,
		})

		.state('main.admin.university.create', {
			url: '/create',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/university/views/form.html',
					controller: 'CreateUniversityController'
				}
			}
		})

		.state('main.admin.university.update', {
			url: '/update/:universityId',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/university/views/form.html',
					controller: 'UpdateUniversityController'
				}
			}
		})




		.state('main.admin.department', {
			url: '/department',
			views: {
				'content': {
					templateUrl: 'app/admin/department/views/list.html',
					controller: 'DepartmentController'
				}
			},
			resolve: resolve,
		})

		.state('main.admin.department.create', {
			url: '/create',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/department/views/form.html',
					controller: 'CreateDepartmentController'
				}
			}
		})

		.state('main.admin.department.update', {
			url: '/update/:departmentId',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/department/views/form.html',
					controller: 'UpdateDepartmentController'
				}
			}
		})




		.state('main.admin.job', {
			url: '/job',
			views: {
				'content': {
					templateUrl: 'app/admin/job/views/list.html',
					controller: 'JobController'
				}
			},
			resolve: resolve,
		})

		.state('main.admin.job.create', {
			url: '/create',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/job/views/form.html',
					controller: 'CreateJobController'
				}
			}
		})

		.state('main.admin.job.update', {
			url: '/update/:jobId',
			views: {
				'content@main.admin' : {
					templateUrl: 'app/admin/job/views/form.html',
					controller: 'UpdateJobController'
				}
			}
		})



	

		.state('main.user', {
			url:'/user',
			views: {
				'@': {
					templateUrl: 'app/user/views/main.html',
					controller: 'EndUserController'
				}
			},
			data: {
				type: ['1','2']
			},
			resolve: resolve,
		})

		.state('main.user.task', {
			url: '/task',
			views: {
				'content': {
					templateUrl: 'app/user/task/views/list.html',
					controller: 'TaskController'
				}
			},
			resolve: resolve,
		})

		.state('main.user.task.form', {
			url:'/:batchId',
			views: {
				'content@main.user': {
					templateUrl: 'app/user/task/views/form.html',
					controller: 'TaskFormController'
				}
			}
		})

		.state('main.user.project', {
			url: '/project',
			views: {
				'content': {
					templateUrl: 'app/user/project/views/list.html',
					controller: 'UserProjectController'
				}
			},
			resolve: resolve,
		})

		.state('main.user.project.detail', {
			url: '/:projectId',
			views: {
				'content@main.user': {
					templateUrl: 'app/user/project/views/detail.html',
					controller: 'DetailUserProjectController'
				}
			}
		})
		
		.state('main.user.project.detail.form', {
			url: '/:formId',
			views: {
				'content@main.user': {
					templateUrl: 'app/user/project/views/upload.html',
					controller: 'FormDetailUserProjectController'
				}
			}
		})



		.state('main.user.subordinat', {
			url: '/subordinat',
			views: {
				'content': {
					templateUrl: 'app/user/subordinat/views/list.html',
					controller: 'SubordinatController'
				}
			},
			resolve: resolve,
		})

		.state('main.denied', {
			url: '/denies',
			params: { 
		        // here we define default value for foo
		        // we also set squash to false, to force injecting
		        // even the default value into url
		        email: {
		          
		        },
		        // this param is not part of url
		        // it could be passed with $state.go or ui-sref 
		        hiddenParam: 'YES',
	      	},
			views: {
				'@': {
					templateUrl: 'app/views/denied.html',
					controller: function ($scope, $state, $stateParams, UserService) {
						$scope.email = $stateParams.email

						$scope.logout = function() {
							UserService
								.logout()
								.then(function () {
									$state.go('login');
								})
						}
					}
				}
			},
			data: {
				type: []
			}
		})

		.state('main.notFound', {
			url: '/404',
			views: {
				'@': {
					template: '<h1>404 - Not Found</h1>'
				}
			}, 
			resolve: {
				Session: function() {
					return undefined;
				}
			}
		})
}

function Authorization ($rootScope, $state, $q, UserService) {
    var auth = {}

    auth.authorize = function () {

    	var deferred = $q.defer();

		UserService.identity()
      		.then(function(response) {
            	
            	//console.log($rootScope.toState.data.type)
            	//console.log($rootScope.toState.data.type.length > 0)
            	//console.log(!UserService.isInAnyRole($rootScope.toState.data.type))
            	
            
            	//console.log($rootScope.toState.data.type.length)
            	//console.log(!UserService.isInAnyRole($rootScope.toState.data.type))

            	deferred.resolve();
            	if ($rootScope.toState.data.type && $rootScope.toState.data.type.length > 0 &&
            		!UserService.isInAnyRole($rootScope.toState.data.type)) {
            		console.log('denied')
            		$state.go('main.denied')
            	}

            	//console.log('Check Loading: ' + $rootScope.toState.name)
            	if ($rootScope.toState.name == 'login') {
            		$state.go($rootScope.fromState.name)
            	}

        		//console.log('authorization ambigous')
        		//return response
            }, function(response) {

            	deferred.resolve();
        		//console.log('authorization failure')
        		$state.go('login')
        		//console.log('authorization failure after login')
        		//deferred.reject(response);
            	}
            )
		
		return deferred.promise
    }

    return auth;
}

function AppController	($scope, $state, Session, UserService) {
	$scope.user = {}
	//$state.go('main.login')
	/*
	$scope.load = function () {
		UserService
			.identity()
			.then(function (response) {
				$scope.user = response;
				if (response.type == '2') {
					$state.go('main.user');
				}
			}, function (response) {
				console.log(response)
			})
	}
	*/

	//$scope.load();
}

function LoginController ($rootScope, $scope, $state, $stateParams, UserService) {
	$scope.input = {}
	$scope.validated = false
	$scope.errorLogin = false
	$scope.alert = {}

	$scope.load = function () {
		
	}

	$scope.submit = function () {

		$scope.LoginForm.email.$setDirty();
		$scope.LoginForm.password.$setDirty();

		if ($scope.LoginForm.$valid) {

			UserService
				.login($scope.input)
				.then(function (response) {
					console.log(response)

					if (response.header) {

						$scope.alert.header = response.header
						$scope.alert.message = response.message
						$scope.errorLogin = true;
						$scope.input.password = undefined
						$scope.validated = true

					} else {

						if (response.status == '1') {
							$state.go('register.information', {email: response.email})
						}

						if (response.status == '2') {
							if (response.type == '1') {
								$state.go('main.app')
							} else if (response.type == '2') {
								$state.go('main.user')
							} else {
								$state.go('main.denied')
							}	
						}
							
					}
					
				})

		} else {
			$scope.validated = true;
		}
	}

	$scope.register = function() {
		$state.go('register')
	}

	$scope.load();
}

function RegisterController($rootScope, $scope, $state, $timeout, $modal, UserService) {

	var timeoutNikPromise, timeoutEmailPromise
	$scope.input = {}
	$scope.input.userJobs = []
	$scope.years = {}
	$scope.months = {}
	$scope.days = {}
	$scope.validated = false

	$scope.load = function () {
		$scope.submitting = false
		$scope.years =  generateYear()
	}

	$scope.$watch('input.nik', function () {
		var validInput = $scope.RegistrationForm.nik.$invalid
		var dirtyInput = $scope.RegistrationForm.nik.$dirty
		
		if (!validInput && dirtyInput) {
			$timeout.cancel(timeoutNikPromise)
			$scope.loadingNik = true;
			timeoutNikPromise = $timeout(function() {
				UserService
					.validatingNik($scope.input)
					.then(function (response) {
						if (response.data.length > 0) {
							$scope.existNik = true
						} else {
							$scope.existNik = false
						}
						$scope.loadingNik = false;
					})
			}, 1000)
		}		
	})

	$scope.$watch('input.email', function () {
		var validInput = $scope.RegistrationForm.email.$invalid
		var dirtyInput = $scope.RegistrationForm.email.$dirty
		
		if (!validInput && dirtyInput) {
			$timeout.cancel(timeoutEmailPromise)
			$scope.loadingEmail = true;
			timeoutEmailPromise = $timeout(function() {
				UserService
					.validatingEmail($scope.input)
					.then(function (response) {
						console.log(response.data);
						if (response.data.length > 0) {
							$scope.existEmail = true
						} else {
							$scope.existEmail = false
						}
						$scope.loadingEmail = false;
					})
			}, 1000)
		}		
	})

	$scope.selectYear = function () {
		console.log('1')
		$scope.month = undefined;
		$scope.day = undefined;
		$scope.months = generateMonth()
		$scope.input.born = undefined
	}

	$scope.selectMonth = function () {
		console.log('2')
		$scope.day = undefined;
		$scope.days = generateDay($scope.year, $scope.month)
		$scope.input.born = undefined
	}

	$scope.selectDay = function () {
		$scope.input.born = new Date($scope.year.year, $scope.month - 1, $scope.day.day + 1)
	}

	$scope.submit = function () {
		
		$scope.RegistrationForm.nik.$setDirty();
		$scope.RegistrationForm.name.$setDirty();
		$scope.RegistrationForm.day.$setDirty();
		$scope.RegistrationForm.address.$setDirty();
		$scope.RegistrationForm.email.$setDirty();
		$scope.RegistrationForm.password.$setDirty();
		$scope.RegistrationForm.confirmation.$setDirty();

		if ($scope.RegistrationForm.$valid) {
			$scope.submitting = true
			UserService
				.register($scope.input)
				.then(function () {
					$scope.submitting = false
					$state.go('register.information', {email: $scope.input.email})
					
				}, function() {
					$state.go('error')
				})
		} else {
			$scope.validated = true;
		}
		
	}

	$scope.load();
}

function InformationRegistrationController($scope, $state, $stateParams, $timeout) {
	$scope.email = $stateParams.email
}








































