<!DOCTYPE html>
<html ng-app="app">
    <head>
        <title>SPMI</title>
       
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        
        <link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">
        <link href="css/main.css" rel="stylesheet" type="text/css">


        @if (env('APP_ENV') == 'local')

            <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
            <link href="bower_components/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
            <link href="bower_components/angular-bootstrap/ui-bootstrap-csp.css" rel="stylesheet" type="text/css">
            <link href="bower_components/angular-bootstrap-nav-tree-js/dist/abn_tree.css" rel="stylesheet" type="text/css">
            <link href="bower_components/angular-chart.js/dist/angular-chart.min.css" rel="stylesheet" type="text/css">
            <link href="bower_components/json-formatter/dist/json-formatter.css" rel="stylesheet" type="text/css">
            
            <script src="bower_components/jquery/dist/jquery.min.js"></script>
            <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
            <script src="bower_components/Chart.js/Chart.min.js"></script>
            <script src="bower_components/moment/min/moment.min.js"></script>

            <script src="bower_components/angular/angular.min.js"></script>
            <script src="bower_components/angular-ui-router/release/angular-ui-router.min.js"></script>
            <script src="bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>
            <script src="bower_components/angular-bootstrap-nav-tree-js/dist/abn_tree_directive.js"></script>
            <script src="bower_components/ng-file-upload/ng-file-upload-all.min.js"></script>
            <script src="bower_components/angular-chart.js/dist/angular-chart.min.js"></script>
            <script src="bower_components/angular-messages/angular-messages.min.js"></script>
            <script src="bower_components/json-formatter/dist/json-formatter.min.js"></script>
        
        @endif

        @if (env('APP_ENV') == 'production')


            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
            <link href="css/ui-bootstrap-csp.css" rel="stylesheet" type="text/css">
            <link href="css/abn_tree.css" rel="stylesheet" type="text/css">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/angular-chart.js/0.8.5/angular-chart.min.css" rel="stylesheet" type="text/css">
            <link href="css/json-formatter.min.css" rel="stylesheet" type="text/css">
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>

            <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.15/angular-ui-router.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.14.2/ui-bootstrap-tpls.min.js"></script>
            <script src="js/abn_tree_directive.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/danialfarid-angular-file-upload/9.0.13/ng-file-upload-all.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-chart.js/0.8.5/angular-chart.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.0-beta.1/angular-messages.min.js"></script>
            <script src="js/json-formatter.min.js"></script>

        @endif

        <script src="app/app.js"></script>

        <script src="app/components/stats/stats.js"></script>

        <script src="app/admin/admin.js"></script>
        <script src="app/user/endUser.js"></script>

        <script src="app/admin/foundation/foundation.js"></script>
        <script src="app/admin/university/university.js"></script>
        <script src="app/admin/department/department.js"></script>
        <script src="app/admin/job/job.js"></script>

        <script src="app/admin/standard/standard.js"></script>
        <script src="app/admin/standardDocument/standardDocument.js"></script>
        <script src="app/admin/guide/guide.js"></script>
        <script src="app/admin/instruction/instruction.js"></script>
        <script src="app/admin/form/form.js"></script>

        <script src="app/admin/user/user.js"></script>
        <script src="app/admin/semester/semester.js"></script>
        <script src="app/admin/groupJob/groupJob.js"></script>
        <script src="app/admin/work/work.js"></script>
        <script src="app/admin/project/project.js"></script>

        <script src="app/user/task/task.js"></script>
        <script src="app/user/subordinat/subordinat.js"></script>

    </head>

    <body>
        
        <div class="container-fluid">

            <div class="container">
                <img src="image/logo.jpg"/>
            </div>
           
            <div ui-view></div>

            <div class="row">
                <center>
                    Copyright 2015  
                </center>
                
            </div>
            
        </div>
    
       
    </body>
</html>
