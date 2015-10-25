(function () {

	angular
		.module('app')
		.controller('UserProjectController', ['$scope', '$state', '$timeout', 'ProjectService', UserProjectController])
		.controller('DetailUserProjectController', ['$scope', '$state', '$stateParams', '$timeout', '$modal', 'ProjectService', DetailUserProjectController])
		.controller('ModalDetailUserProjectController', ['$scope', '$timeout', '$modalInstance', 'member', 'user', ModalDetailUserProjectController])
		.controller('FormDetailUserProjectController', ['$scope', '$state', '$stateParams', '$timeout', 'ProjectService', FormDetailUserProjectController])

		.directive('userNodeList', ['$compile', userNodeList])
		.directive('userNode', ['$compile', userNode])
		.directive('userNodeFormList', ['$compile', userNodeFormList])

})()

function userNodeList ($compile) {
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
            		+ '<user-node ng-repeat="item in nodes track by $index" ng-model="item" nodes="nodes" node-index="$index + 1" parent-index="' + $scope.parentIndex + '" node-controller="' + $scope.nodeController + '"></user-node>'
            	+ '</accordion>'

            //console.log($scope.template)
            if (angular.isArray($scope.nodes)) {
                $element.append($scope.template);
            } 
            $compile($element.contents())($scope.$new());
        }, 
    };
}

function userNode ($compile) {
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
                			+ '</accordion-heading>'

                			+ '<div class="row">'
                				+ '<div class="col-md-7">'
		                			+ '<h3>{{ parentIndexString }}{{ nodeIndex }}. {{ node.header }}</h3>'
		                			+ '<h3>Deskripsi</h3>'
	                				+ '<div class="col-md-12">'
	                					+ '<p>{{ node.description }}</p>'
	                				+ '</div><br/>'
	                			+ '</div>'

	                			+ '<div class="col-md-5">'
	                				+ '<div class="panel panel-default">'
	                					+ '<div class="panel-heading clearfix">'
	                						+ '<div class="panel-title pull-left">'
	                							+ 'Delegation'
	                						+ '</div>'
	                						+ '<div class="panel-title pull-right">'
	                							+ '<button ng-if="isLeader" ng-click="delegateNode(node)" class="btn btn-primary btn-xs"><i class="fa fa-plus fa-xs"></i></button>'
	                						+ '</div>'
	                					+ '</div>'
	                					+ '<div class="panel-body">'
	                						+ '<div class="list-group">'
									        	+ '<a href="" ng-click="detail(work)" class="list-group-item" ng-repeat="object in node.delegations">'
										        	+ '<i class="fa" ng-class="{'
									        			+ '\'fa-user\': object.id !== leaderId,'
									        			+ '\'fa-star\': object.id == leaderId'
								        			+ '}"></i>&nbsp;{{ object.name }}'
									        	+ '</a>'
									    	+ '</div>'
	                					+ '</div>'
	                				+ '</div>'
	                			+ '</div>'

                			+ '</div>'

                			+ '<div ng-if="node.forms">'
                				+ '<node-form-list ng-model="node" node-controller="' + $scope.nodeController + '"></node-form-list>'
                			+ '</div>'
                			+ '<user-node-list ng-model="node.children" node="node" node-controller="' + $scope.nodeController + '" parent-index="' + $scope.parentIndexStringNode + '"></user-node-list>'
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
                			+ '</accordion-heading>'

                			+ '<div class="row">'
                				+ '<div class="col-md-7">'
		                			+ '<h3>{{ parentIndexString }}{{ nodeIndex }}. {{ node.header }}</h3>'
		                			+ '<h3>Deskripsi</h3>'
	                				+ '<div class="col-md-12">'
	                					+ '<p>{{ node.description }}</p>'
	                				+ '</div><br/>'
	                			+ '</div>'

	                			+ '<div class="col-md-5">'
	                				+ '<div class="panel panel-default">'
	                					+ '<div class="panel-heading clearfix">'
	                						+ '<div class="panel-title pull-left">'
	                							+ 'Delegation'
	                						+ '</div>'
	                						+ '<div class="panel-title pull-right">'
	                							+ '<button ng-if="isLeader" ng-click="delegateNode(node)" class="btn btn-primary btn-xs"><i class="fa fa-plus fa-xs"></i></button>'
	                						+ '</div>'
	                					+ '</div>'
	                					+ '<div class="panel-body">'
	                						+ '<div class="list-group">'
									        	+ '<a href="" ng-click="detail(work)" class="list-group-item" ng-repeat="object in node.delegations">'
									        		+ '<i class="fa" ng-class="{'
										        		+ '\'fa-user\': object.id !== leaderId,'
									        			+ '\'fa-star\': object.id == leaderId'
								        			+ '}"></i>&nbsp;{{ object.name }}'
									        	+ '</a>'
									    	+ '</div>'
	                					+ '</div>'
	                				+ '</div>'
	                			+ '</div>'

                			+ '</div>'


                			+ '<div ng-if="node.forms">'
                				+ '<user-node-form-list ng-model="node" node-controller="' + $scope.nodeController + '"></node-form-list>'
                			+ '</div>'
                			+ '<user-node-list ng-model="node.children" node="node" node-controller="' + $scope.nodeController + '" parent-index="' + $scope.parentIndexStringNode + '"></user-node-list>'
                		+ '</accordion-group>'
              		+ '</div>'

                $element.append($scope.template);
            }

            $compile($element.contents())($scope.$new());
        }
    };
}

function userNodeFormList ($compile) {
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
                                	+ '<label class="control-label">Bobot Pekerjaan:&nbsp;</label>'
	                				+ '{{ node.weight }}'
	                			+ '</div>'
	                		+ '</div>'
	                	+ '</div>'
        				+ '<div class="panel panel-default">'
            				+ '<div class="panel-heading clearfix">'
                				+ '<label class="control-label">Dafar Formulir Penugasan</label>'
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
						                                + '<th><a href="" ng-click="sortField = \'uploader\'; reverse = !reverse">Uploader</a></th>'
						                                + '<th><a href="" ng-click="sortField = \'date\'	; reverse = !reverse">Date Upload</a></th>'
						                                + '<th>Action</th>'
						                            + '</tr>'
						                        + '</thead>'
						                        + '<tbody>'
						                            + '<tr ng-repeat="object in node.forms | filter:query |   orderBy:sortField:reverse track by $index">'
						                                + '<td>{{ $index + 1 }}</td>'
						                                + '<td>{{ object.description }}</td>'
						                                + '<td>{{ object.uploads.users.name }}</td>'
						                                + '<td>{{ object.uploads.created_at | date:\'dd-MM-yyyy hh:mm\' }}</td>'
						                                + '<td>'
							                                + '<button ng-if="node.isDelegate" popover="Detail" popover-trigger="mouseenter" ng-click="detailForm(object.project_form_item_id)" class="btn btn-info btn-xs"><i class="fa fa-search"></i></button>&nbsp;'
						                                + '</td>'
						                            + '</tr>'
						                        + '</tbody>'
						                    + '</table>'
										+ '</div>'
										+ '<pre>{{ node.isDelegate | json }}</pre>'
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
}

function UserProjectController($scope, $state, $timeout, ProjectService) {
	$scope.listprojects = []

	$scope.load = function() {
		//ProjectService.flushNode

		$scope.listprojects = []

		ProjectService
			.user($scope.user.id)
			.then(function(response) {
				console.log(response)
				$scope.listprojects = response;
			})
	}

	$scope.detail = function (request) {
		$state.go('main.user.project.detail', {projectId: request})
	}

	$scope.load();
}

function DetailUserProjectController($scope, $state, $stateParams, $timeout, $modal, ProjectService) {

	$scope.input = {}
	$scope.input.projects = []
	$scope.input.users = []

	$scope.status = {}

	$scope.projects = []

	$scope.users = []

	$scope.project_id = {}

	$scope.load = function() {
		
		if ($scope.user) {
			ProjectService.setUserId($scope.user.id)
		}
		
		ProjectService.flushNode()

		ProjectService.setDelegateNode(function(node) {

			$scope.project_id = node.id

			var modalInstance = $modal.open({
				animate: true,
				templateUrl: 'app/admin/user/views/modal.html',
				controller: 'ModalDetailUserProjectController',
				size: 'lg',
				resolve: {
					member: function() {
						return $scope.users
					},
					user: function () {
						return node.delegations
					}
				}
			})

			modalInstance.result.then(function (user) {
				node.delegations = user

				$scope.userMember = {}
				$scope.userMember.project_id = $scope.project_id
				$scope.userMember.delegations = user
				//console.log($scope.user);

				
				ProjectService
					.delegate($scope.userMember)
					.then(function() {
						alert('Project Ini berhasil didelegasikan')
					}, function() {

					})
				
			}, function () {

			})
		})

		ProjectService.setDetailForm(function (formId) {
			$state.go('main.user.project.detail.form', {formId: formId})
		})

		ProjectService
			.showLast($stateParams.projectId)
			.then(function(response) {
				$scope.input = response
				
				//$scope.input.user_id = $scope.user.id
				
				$scope.input.start = new Date(response.date_start)
				$scope.input.ended = new Date(response.date_ended)

				$scope.projects = $scope.input.projects
				
				var recursiveChecking = function(node) {
					for (var i = 0 ; i < node.length ; i++) {
						if (node[i].children.length > 0) {
							recursiveChecking(node[i].children)
						} else {
							for(var j = 0 ; j < node[i].forms.length ; j++) {
								if(node[i].forms[j].uploads) {
									var time = new Date(node[i].forms[j].uploads.created_at)
									time.addHours(7)
									
									node[i].forms[j].uploads.created_at = time
								}
							}
							
							for(var j = 0 ; j < node[i].delegations.length ; j++) {
								if(node[i].delegations[j].id == ProjectService.userId) {
									node[i].isDelegate = true
									break
								}
							}
						}
					}
				}
				
				recursiveChecking($scope.projects)
				
				$scope.users = $scope.input.users
				
				$scope.isLeader = false
				
				for (var i = 0 ; i < $scope.users.length ; i++) {
					$scope.users[i].check = false
					
					if ($scope.users[i].id == ProjectService.userId && $scope.users[i].leader == true) {
						$scope.isLeader = true
						$scope.leaderId = $scope.users[i].id
					}
				}

			})
	}


	$scope.$watch('projects', function() {
		$scope.input.projects = $scope.projects
	})

	$scope.delegateNode = function(node) {
		ProjectService.delegateNode(node)
	}

	$scope.detailForm = function(projectId, formId) {
		ProjectService.detailForm(projectId, formId)
	} 


	$scope.submit = function() {
		$scope.input.projects = $scope.projects 
		$scope.input.users = $scope.users 
		$scope.msg = []
		$scope.weight = 0

		ProjectService
			.update($scope.input)
			.then(function() {
				$state.go('main.admin.project')
			}, function () {

			})
	}

	$scope.load();
}

function ModalDetailUserProjectController($scope, $timeout, $modalInstance, member, user) {
	
	$scope.users = []
	$scope.input = []
	$scope.members = member 
	$scope.delegations = user
	$scope.leader = {}

	$scope.load = function() {
		//console.log($scope.delegations)
		for (var i = 0 ; i < $scope.members.length ; i++) {
			if ($scope.members[i].leader == false) {

				var counter = 0
				for (var j = 0 ; j < $scope.delegations.length ; j++) {
					if ($scope.members[i].id == $scope.delegations[j].id) {
						$scope.members[i].check = true
						break;
					}
					counter++
					
				}

				if (counter == $scope.delegations.length) {
					$scope.members[i].check = false
				}

				$scope.users.push($scope.members[i])

			} else {
				$scope.leader = $scope.members[i]
			}
		}
		
		$scope.selected = counter-1 + ' user selected from ' + $scope.users.length

			
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
			//$scope.users[i].leader = false
			if ($scope.users[i].check == true) {
				$scope.input.push($scope.users[i])
				counter++
			}
		}

		$scope.selected = counter + ' user selected from ' + $scope.users.length
	}

	$scope.submit = function () {
		$scope.checkCustom();
		
		$scope.temp = $scope.input
		$scope.input = []
		$scope.input.push($scope.leader)
		
		for (var i = 0 ; i < $scope.temp.length ; i++) {
			$scope.input.push($scope.temp[i]);
		}

		$modalInstance.close($scope.input)
	}

	$scope.close = function () {
		$modalInstance.dismiss('cancel');
	}

	$scope.load();
}

function FormDetailUserProjectController($scope, $state, $stateParams, $timeout, ProjectService) {
	$scope.form = {}
	$scope.input = {}
	
	$scope.load = function() {
		
		ProjectService
			.form($stateParams.formId)
			.then(function(response) {
				$scope.form = response
				$scope.input = response.form
				
				//console.log($scope.form.uploads)
				
				for (var i = 0 ; i < $scope.form.uploads.length ; i++) {
					console.log($scope.form.uploads[i])
					
					var time = new Date($scope.form.uploads[i].created_at)
					time.addHours(7)
					$scope.form.uploads[i].created_at = time
				}
				
				$scope.sortField = 'created_at'
				$scope.reverse = true
				
			}, function() {
				
			})
		
		ProjectService
			.leader($stateParams.projectId)
			.then(function(response) {
				$scope.project = response
				$scope.leader = response.leader
			}, function() {})
	}
	
	$scope.upload = function(file) {
		$scope.input.user_id = $scope.user.id
		$scope.input.project_form_item_id = $stateParams.formId
		
		ProjectService
			.upload($scope.input, file)
			.then(function(response) {
				alert('Upload Success');
				$scope.load()
			}, function() {
				
			})
	}
	
	$scope.load()
}