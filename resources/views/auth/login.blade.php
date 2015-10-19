<!DOCTYPE html>
<html>
    <head>
        <title>SPMI</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">

        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    </head>
    <body>
        

           
                <div style="width: 1010px; margin-left:auto; margin-right:auto;">

                 
                    <div class="row" style="margin-left:auto; margin-right:auto;">
                        <img src="../image/logo.jpg"/>
                    </div>

                    

                    <div class="row" style="padding-bottom: 100px; padding-top:100px;">

                        <div class="col-xs-3">
                        </div>

                         <div class="col-xs-6" >
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    Login Form
                                </div>

                                <div class="panel-body">
                                    <div class="col-xs-12">

                                        <form class="form-horizontal" method="post" submit="/auth/login">
                                            {!! csrf_field() !!}
                                            <div class="form-group">
                                                <label class="control-label">Username</label>
                                                <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                                            </div>
                                           
                                            <div class="form-group">
                                                <label class="control-label">Password</label>
                                                <input type="password" name="password" class="form-control">
                                            </div>

                                            <div>
                                                <input type="checkbox" name="remember"> Remember Me
                                            </div>

                                            <div class="form-group">

                                                <div class="pull-right">
                                                    <input type="submit" value="Login"  class="btn btn-primary">
                                                </div>
                                            </div>     
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-xs-3">
                        </div>
                    </div>

                    <div class="row">
                        <center>
                            Copyright 2015  
                        </center>
                        
                    </div>
                        
                 </div>
     

       
    </body>
</html>

