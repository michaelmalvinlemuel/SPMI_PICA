(function() {

	angular.module('app')
		.factory('ProjectService', ['$http', '$state', '$q', ProjectService])
		.controller('ProjectController', ['$scope', '$state', '$timeout', 'ProjectService', ProjectController])
		.controller('CreateProjectController', ['$rootScope', '$scope', '$state', '$stateParams', '$modal', '$timeout', 'ProjectService', CreateProjectController])
		.controller('UpdateProjectController', ['$scope', '$state', '$stateParams', '$modalInstance', '$timeout', 'ProjectService', UpdateProjectController])
		.controller('ModalUserProjectController', ['$scope', '$timeout', '$modalInstance', 'user', 'UserService', ModalUserProjectController])
		.controller('ModalProjectController', ['$scope', '$timeout', '$modalInstance', 'project', 'ProjectService', ModalProjectController])

		.directive('nodeList', function($compile) {
		    return {
		        restrict: 'E',
		        terminal: true,
		        replace: true,
		        transclude: true,
		        scope: {
		            nodes: '=ngModel',
		            node: '=',
		            nodeController: '@',
		            parentIndex: '@'
		        },
		        controller: '@',
		        name: 'nodeController',
		        link: function ($scope, $element, $attrs) {

		        	//$scope.parentIndex += 1
		        	$scope.template = ''
			        	+ '<accordion close-others="false">'
	                		+ '<node ng-repeat="item in nodes track by $index" ng-model="item" nodes="nodes" node-index="$index + 1" parent-index="' + $scope.parentIndex + '" node-controller="' + $scope.nodeController + '"></node>'
	                		+ '<div class="pull-left" style="margin-top: 5px;">'
	                			+ '<button ng-if="!node.forms" ng-click="create(nodes)" class="btn btn-primary"><i class="fa fa-plus"></i></button>&nbsp;'
	            				+ '<button ng-if="parentIndex && !nodes.length && !node.forms" ng-click="form(node)" class="btn btn-warning"><i class="fa fa-file-text-o"></i></button>'
	            			+ '</div>'
	                	+ '</accordion>'

	                //console.log($scope.template)
		            if (angular.isArray($scope.nodes)) {
		                $element.append($scope.template);
		            } 
		            $compile($element.contents())($scope.$new());
		        }, 
		    };
		})

		.directive('node', function($compile) {
		    return {
		        restrict: 'E',
		        terminal: true,
		        replace: true,
		        transclude: true,
		        scope: {
		            node: '=ngModel',
		            nodes: '=',
		            nodeController: '@',
		            nodeIndex: '=',
		            parentIndex: '@'
		        },
		        controller: '@',
		        name: 'nodeController',

		        link: function ($scope, $element, $attrs) {
		        	//console.log($scope.parentIndex);

		        	if ($scope.parentIndex == 'undefined') {
		        		//console.log('undefined: true')
		        		$scope.parentIndexString = ''
		        	} else {
		        		//console.log('undefined: false')
		        		$scope.parentIndexString = $scope.parentIndex + '.'
		        	}

		        	$scope.parentIndexStringNode = $scope.parentIndexString + $scope.nodeIndex
		        	
		            if (angular.isArray($scope.node.children) && $scope.node.children.length > 0) {
		            	$scope.template = ''
		            		+ '<div style="margin-top: 5px;">'
		                		+ '<accordion-group is-open="node.open">'

		                			+ '<accordion-heading>'
		                				
		                				+ '<i class="pull-left glyphicon" ng-class="{'
								            + '\'glyphicon-chevron-down\': node.open,'
								            + '\'glyphicon-chevron-right\': !node.open}">'
							           	+ '</i>&nbsp;'
							           	+ '{{ parentIndexString }}{{ nodeIndex }}. {{node.header}}'

							           	+ '<div class="pull-right">'
							           		+ '<button ng-click="update(nodeIndex, nodes)" class="btn btn-success btn-xs"><i class="fa fa-edit fa-xs"></i></button>&nbsp;'
							           		+ '<button ng-click="delete(nodeIndex, nodes)" class="btn btn-danger btn-xs"><i class="fa fa-close fa-xs"></i></button>'
							           	+ '</div>'
		                			+ '</accordion-heading>'

		                			+ '<h3>{{ parentIndexString }}{{ nodeIndex }}. {{ node.header }}</h3>'
		                			+ '<h3>Deskripsi</h3>'
	                				+ '<div class="col-md-12">'
	                					+ '<p>{{ node.description }}</p>'
	                				+ '</div><br/>'
		                			+ '<div ng-if="node.forms">'
		                				+ '<node-form-list ng-model="node" node-controller="' + $scope.nodeController + '"></node-form-list>'
		                			+ '</div>'
		                			+ '<node-list ng-model="node.children" node="node" node-controller="' + $scope.nodeController + '" parent-index="' + $scope.parentIndexStringNode + '"></node-list>'
		                		+ '</accordion-group>'
		 					+ '</div>'

		                $element.append($scope.template);

		            } else {

		            	$scope.template = ''
		            		+ '<div style="margin-top: 5px;">'
		                		+ '<accordion-group>'
		                			+ '<accordion-heading>'
		                				+ '<i class="pull-left glyphicon" ng-class="{'
								            + '\'glyphicon-chevron-down\': node.open,'
								            + '\'glyphicon-chevron-right\': !node.open}">'
							           	+ '</i>&nbsp;'
							           	+ '{{ parentIndexString }}{{ nodeIndex }}. {{node.header}}'

							           	+ '<div class="pull-right">'
							           		+ '<button ng-click="update(nodeIndex, nodes)" class="btn btn-success btn-xs"><i class="fa fa-edit fa-xs"></i></button>&nbsp;'
							           		+ '<button ng-click="delete(nodeIndex, nodes)" class="btn btn-danger btn-xs"><i class="fa fa-close fa-xs"></i></button>'
							           	+ '</div>'
		                			+ '</accordion-heading>'

		                			+ '<h3>{{ parentIndexString }}{{ nodeIndex }}. {{ node.header }}</h3>'
		                			+ '<h3>Deskripsi</h3>'
		                			+ '<div class="col-md-12">'
	                					+ '<p>{{ node.description }}</p>'
	                				+ '</div><br/>'
		                			+ '<div ng-if="node.forms">'
		                				+ '<node-form-list ng-model="node" node-controller="' + $scope.nodeController + '"></node-form-list>'
		                			+ '</div>'
		                			+ '<node-list ng-model="node.children" node="node" node-controller="' + $scope.nodeController + '" parent-index="' + $scope.parentIndexStringNode + '"></node-list>'
		                		+ '</accordion-group>'
		              		+ '</div>'

		                $element.append($scope.template);
		            }

		            $compile($element.contents())($scope.$new());
		        }
		    };
		})

		.directive('nodeFormList', function($compile) {
			return {
				restrict: 'E',
				terminal: true,
				replace: true,
				transclude: true,
				scope: {
					node: '=ngModel',
					nodes: '=',
					nodeController: '@',
				},
				controller: '@',
				name: 'nodeController',
				link: function ($scope, $element, $attrs) {

					$scope.template = ''
						+ '<div class="row">'
							+ '<div class="col-lg-12">'
								+ '<h3>Formulir</h3>'
								+ '<div class="row">'
									+ '<div class="col-md-6">'									
										+ '<div class="form-group has-feedback">'
		                                	+ '<label class="control-label">Bobot Pekerjaan</label>&nbsp;<label style="color: #a94442;">*</label>'
			                				+ '<input type="text" ng-model="node.weight" name="name" class="form-control">'
			                			+ '</div>'
			                		+ '</div>'
			                	+ '</div>'
	                			+ '<label class="control-label">Dafar Formulir Penugasan</label>&nbsp;<label style="color: #a94442;">*</label>'
	            				+ '<div class="panel panel-default">'
	                				+ '<div class="panel-heading clearfix">'
	                    				+ '<div class="panel-title pull-left">'
	                    					+ '<div class="form-inline">'
		                						+ '<div class="form-group">'
		                        					+ '<button ng-click="createForm(node)" class="btn btn-primary btn-xs"><i class="fa fa-plus fa-xs"></i></button>'
		                        				+ '</div>'
		                        			+ '</div>'
	                    				+ '</div>'
	                    				+ '<div class="pull-right">'
							           		+ '<button ng-click="deleteForm(node)" class="btn btn-danger btn-xs"><i class="fa fa-close fa-xs"></i></button>'
							           	+ '</div>'
	                				+ '</div>'
	                				+ '<div class="panel-body">'
	                    				+ '<div class="row">'
	                        				+ '<div class="col-md-12">'
	                        					+ '<div class="table-responsive">'
								                    + '<table class="table table-hover">'
								                        + '<thead>'
								                            + '<tr>'
								                                + '<th>#</th>'
								                                + '<th><a href="" ng-click="sortField = \'name\'	; reverse = !reverse">Formulir</a></th>'
								                                + '<th>Action</th>'
								                            + '</tr>'
								                        + '</thead>'
								                        + '<tbody>'
								                            + '<tr ng-repeat="object in node.forms | filter:query |   orderBy:sortField:reverse track by $index">'
								                                + '<td>{{ $index + 1 }}</td>'
								                                + '<td>{{ object.description }}</td>'
								                                + '<td>'
									                                + '<button popover="Update" popover-trigger="mouseenter" ng-click="updateFormItem($index, node.forms, node)" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></button>&nbsp;|&nbsp;'
									                                + '<button popover="Delete" popover-trigger="mouseenter" ng-click="deleteNodeForm($index, node.forms)" class="btn btn-danger btn-xs"><i class="fa fa-close"></i></button>'
								                                + '</td>'
								                            + '</tr>'
								                        + '</tbody>'
								                    + '</table>'
												+ '</div>'
	                        				+ '</div>'
	                        			+ '</div>'
	                        		+ '</div>'
	                        	+ '</div>'
	                        + '</div>'
                       	+ '</div>	'

					$element.append($scope.template);

					$compile($element.contents())($scope.$new());
				}
			}
		})
})();

function Node(name, children) {
    this.name = name;
    this.open = false;
    this.children = children || [];
}

function ProjectService ($http, $state, $q) {

	var project = {}
	var deferred = $q.defer();
	var createNode = function() {}
	var updateNode = function() {}
	var deleteNode = function() {}

	var deleteNodeForm = function() {}

	var createNodeFormItem = function() {}
	var updateNodeFormItem = function() {}
	var deleteNodeFormItem = function() {}

	project.flushNode = function() {
		this.createNode = undefined
		this.updateNode = undefined
		this.deleteNode = undefined
		this.deleteNodeForm = undefined
	}

	project.setCreateNode = function(fn) {
		this.createNode = fn
	}

	project.setUpdateNode = function(fn) {
		this.updateNode = fn
	}

	project.setDeleteNode = function (fn) {
		this.deleteNode = fn
	}

	project.setDeleteNodeForm = function(fn) {
		this.deleteNodeForm = fn
	}

	project.setCreateNodeFormItem = function(fn){
		this.createNodeFormItem = fn
	}

	project.setUpdateNodeFormItem = function(fn) {
		this.updateNodeFormItem = fn
	}

	project.setDeleteNodeFormItem = function (fn) {
		this.deleteNodeFormItem = fn
	}

	project.createNode = this.createNode
	project.updateNode = this.updateNode
	project.deleteNode = this.deleteNode

	project.deleteNodeForm = deleteNodeForm

	project.createNodeFormItem = this.createNodeFormItem
	project.updateNodeFormItem = this.updateNodeFormItem
	project.deleteNodeFormItem = this.deleteNodeFormItem

	project.get = function () {

		$http.get('/projects/get')
			.then(function(response) {
				deferred.resolve(response.data)
			}, function(response) {
				deferred.reject(response)
			})

		return deferred.promise;
	}

	project.show = function (request) {
		$http.get('/projects/show/' + request)
			.then(function(response) {
				deferred.resolve(response.data)
			}, function(response) {
				deferred.reject(response)
			})

		return deferred.promise;
	}

	project.store = function (request) {
		$http.get('/project/store')
			.then(function(response) {
				deferred.resolve(response.data)
			}, function(response) {
				deferred.reject(response)
			})

		return deferred.promise;
	}

	project.update = function (request) {
		$http.get('/project/update')
			.then(function(response) {
				deferred.resolve(response.data)
			}, function(response) {
				deferred.reject(response)
			})

		return deferred.promise;
	}

	project.destroy = function (request) {
		$http.get('/project/destroy')
			.then(function(response) {
				deferred.resolve(response.data)
			}, function(response) {
				deferred.reject(response)
			})

		return deferred.promise;
	}

	return project;
}

function ProjectController ($scope, $state, $timeout, ProjectController) {
	$scope.projects = []


	$scope.detail = function (request) {
		$state.go('main.admin.project.detail')
	}

	$scope.destroy = function(request) {

	}
}



function CreateProjectController ($rootScope, $scope, $state, $stateParams, $modal, $timeout, ProjectService) {

	$scope.input = {}
	$scope.input.projects = []
	$scope.input.users = []

	$scope.status = {}

	$scope.projects = []

	$scope.users = []

	$scope.load = function() {

		ProjectService.flushNode()

		ProjectService.setCreateNode(function(nodes) {

			var modalInstance = $modal.open({
	      		animation: true,
	      		templateUrl: 'app/admin/project/views/modal.html',
	      		controller: 'ModalProjectController',
	      		resolve: {
	        		project: function () {
	          			return undefined;
	        		}
	      		}
	    	})

	    	modalInstance.result.then(function (project) {
	    		$rootScope.pushIfUnique(nodes, project)
	    		//nodes.push({name: 'a', open: false, children: []})
	      		
	    	}, function () {
	      		//$log.info('Modal dismissed at: ' + new Date());
	    	})
		})

		ProjectService.setUpdateNode(function(index, nodes) {

			var modalInstance = $modal.open({
				animation: true,
				templateUrl: 'app/admin/project/views/modal.html',
				controller: 'ModalProjectController',
				resolve: {
					project: function () {
						return nodes;
					}
				}
			})

			modalInstance.result.then(function (project) {
				nodes[index].header = project.header;
				nodes[index].description = project.description
			}, function () {

			})
		})

		ProjectService.setDeleteNode(function() {
			var alert = confirm('Apakah Anda yakin ingin menghapus butir ini?')
			return alert
		})

		ProjectService.setDeleteNodeForm(function(index, forms) {
			var alert = confirm('Apakah anda yakin ingin menghapus form ini?');
			if (alert == true) {
				forms.splice(index, 1)
			}
		})

		ProjectService.setCreateNodeFormItem(function (node) {
			//node.forms.push({form: 'DummyForm', user: 'DummyUser'})
			var modalInstance = $modal.open({
				animation: true,
				templateUrl: 'app/admin/form/views/modal.html',
				controller: 'CreateModalFormController',
				resolve: {
					forms: function() {
						return node
					}
				}
			})

			modalInstance.result.then(function (forms) {
				$rootScope.pushIfUnique(node.forms, forms.form)

			}, function() {

			})
		})

		ProjectService.setUpdateNodeFormItem(function (index, forms, node) {
			$scope.tmp = []
			$scope.tmp.form = forms[index]

			var modalInstance = $modal.open({
				animation: true,
				templateUrl: 'app/admin/form/views/modal.html',
				controller: 'UpdateModalFormController',
				resolve: {
					forms: function() {
						return $scope.tmp
					}
				}
			})

			modalInstance.result.then(function (forms) {
				console.log(forms)
				if ($rootScope.findObject(node.forms, forms.form) == -1) {
	    			node.forms[index] = forms.form
	    		} else {
	    			alert('Formulir ini sudah bagian dari pekerjaan')
	    		}
			}, function() {

			})
		})
	}

	$scope.addProjectMember = function() {

		var modalInstance = $modal.open({
			animate: true,
			templateUrl: 'app/admin/user/views/modal.html',
			controller: 'ModalUserProjectController',
			size: 'lg',
			resolve: {
				user: function () {
					return $scope.users
				}
			}
		})

		modalInstance.result.then(function (user) {
			console.log(user)
			$scope.users = user
			$scope.input.users = $scope.users
		}, function () {

		})
	}

	$scope.create = function (nodes) {
		ProjectService.createNode(nodes)
	}

	$scope.update = function (index, nodes) {
		ProjectService.updateNode(index, nodes[index - 1])
	}

	$scope.delete = function (index, nodes) {
		if(ProjectService.deleteNode()) {
			nodes.splice(index - 1, 1)
		}
	}

	$scope.form = function (node) {
		node.forms = []
	}

	$scope.createForm = function(node) {
		ProjectService.createNodeFormItem(node)
	}

	$scope.deleteForm = function(node) {
		var alert = confirm('Apakah anda yakin ingin meghapus Formulir ini?')
		if (alert == true) {
			node.forms = undefined	
		}
	}

	$scope.updateFormItem = function(index, forms, node) {
		ProjectService.updateNodeFormItem(index, forms, node)
	}

	$scope.deleteNodeForm = function(index, forms) {
		ProjectService.deleteNodeForm(index, forms)
	}

	$scope.setLeader = function(object) {
		for (var i = 0 ; i < $scope.users.length ; i++) {
			if ($scope.users[i].id == object.id) {
				$scope.users[i].leader = true
			} else {
				$scope.users[i].leader = false
			}
		}
		$scope.input.users = $scope.users
	}

	$scope.today = function() {
		$scope.input.start = new Date();
		//$scope.input.ended = new Date();
	}

  	$scope.toggleMin = function() {
    	$scope.minDate = $scope.minDate ? null : new Date();
  	};

  	$scope.openStart = function($event) {
    	$scope.status.openedStart = true;
  	};

  	$scope.openEnded = function($event) {
    	$scope.status.openedEnded = true;
  	};

  	$scope.dateOptions = {
    	formatYear: 'yy',
    	startingDay: 1
  	};

  	$scope.statusStart = {
    	openedStart: false
  	};

  	$scope.statusEnded = {
    	openedEnded: false
  	};

  	$scope.pickStart = function() {
		if ($scope.input.start > $scope.input.ended) {
			$scope.minDateEnded = $scope.input.start
			if ($scope.limit) {
				$scope.input.ended = $scope.input.start
			} else {
				$scope.input.ended = undefined
			}
			
		}
	}

	$scope.$watch('projects', function() {
		$scope.input.projects = $scope.projects
	})


	$scope.submit = function() {
		$scope.input.projects = $scope.projects 
		$scope.input.users = $scope.users 

		ProjectService
			.store($scope.input)
			.then(function() {

			}, function () {

			})
	}


	$scope.load();
}

function UpdateProjectController ($scope, $state, $stateParams, $timeout, ProjectService) {
}

function ModalUserProjectController ($scope, $timeout, $modalInstance, user, UserService) {
	$scope.users = []
	$scope.input = []

	$scope.load = function() {
		$scope.userProject = user

		UserService
			.get()
			.then(function (response) {
				$scope.users = response.data
				for (var i = 0 ; i < $scope.users.length ; i++) {
					for (var j = 0 ; j < $scope.userProject.length ; j++) {
						if ($scope.users[i].id == $scope.userProject[j].id) {
							$scope.users[i].leader = $scope.userProject[j].leader
							$scope.users[i].check = $scope.userProject[j].check
						}
					}
				}
			})
	}

	$scope.checkAll = function() {
		$scope.input = []
		var counter = 0

		for (var i = 0 ; i < $scope.users.length ; i++) {
			$scope.users[i].leader = false
			if ($scope.checked) {
				$scope.users[i].check = true
				$scope.input.push($scope.users[i])
				counter++
			} else {
				$scope.users[i].check = false
			}
		}

		$scope.selected = counter + ' user selected from ' + $scope.users.length
	}

	$scope.checkCustom = function() {
		$scope.checked = false;
		var counter = 0
		$scope.input = []

		for (var i = 0 ; i < $scope.users.length ; i ++) {
			$scope.users[i].leader = false
			if ($scope.users[i].check == true) {
				$scope.input.push($scope.users[i])
				counter++
			}
		}

		$scope.selected = counter + ' user selected from ' + $scope.users.length

	}

	$scope.submit = function () {
		$modalInstance.close($scope.input)
	}

	$scope.close = function () {
		$modalInstance.dismiss('cancel');
	}

	$scope.load();
}


function ModalProjectController($scope, $timeout, $modalInstance, project, ProjectService) {

	$scope.input = project
	console.log($scope.input)

	$scope.submit = function () {

		console.log($scope.input)

		if (true) {

			console.log($scope.input.children)

			if ($scope.input.children) {
				console.log('update')
				$modalInstance.close($scope.input)

			} else {
				console.log('insert')
				$scope.input.open = false,
				$scope.input.children = []
				$modalInstance.close($scope.input)
			}
			
		} else {
			$scope.validated = true;
		}
	}

	$scope.close = function () {
		$modalInstance.dismiss('cancel');
	}
}
