<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>assets/fa/css/font-awesome.min.css" rel="stylesheet">

    <!-- angular-->
    <script src="<?php echo base_url(); ?>assets/js/angular.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/angular-sanitize.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/const.js"></script>
    <style type="text/css">
    body {
        padding-top: 90px;
    }
    .panel-login {
        border-color: #ccc;
        -webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
        -moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
        box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
    }
    .panel-login>.panel-heading {
        color: #00415d;
        background-color: #fff;
        border-color: #fff;
        text-align:center;
    }
    .panel-login>.panel-heading a{
        text-decoration: none;
        color: #666;
        font-weight: bold;
        font-size: 15px;
        -webkit-transition: all 0.1s linear;
        -moz-transition: all 0.1s linear;
        transition: all 0.1s linear;
    }
    .panel-login>.panel-heading a.active{
        color: #029f5b;
        font-size: 18px;
    }
    .panel-login>.panel-heading hr{
        margin-top: 10px;
        margin-bottom: 0px;
        clear: both;
        border: 0;
        height: 1px;
        background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
        background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
        background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
        background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
    }
    .panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="password"] {
        height: 45px;
        border: 1px solid #ddd;
        font-size: 16px;
        -webkit-transition: all 0.1s linear;
        -moz-transition: all 0.1s linear;
        transition: all 0.1s linear;
    }
    .panel-login input:hover,
    .panel-login input:focus {
        outline:none;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
        border-color: #ccc;
    }
    .btn-login {
        background-color: #59B2E0;
        outline: none;
        color: #fff;
        font-size: 14px;
        height: auto;
        font-weight: normal;
        padding: 14px 0;
        text-transform: uppercase;
        border-color: #59B2E6;
    }
    .btn-login:hover,
    .btn-login:focus {
        color: #fff;
        background-color: #53A3CD;
        border-color: #53A3CD;
    }
    .forgot-password {
        text-decoration: underline;
        color: #888;
    }
    .forgot-password:hover,
    .forgot-password:focus {
        text-decoration: underline;
        color: #666;
    }

    .btn-register {
        background-color: #1CB94E;
        outline: none;
        color: #fff;
        font-size: 14px;
        height: auto;
        font-weight: normal;
        padding: 14px 0;
        text-transform: uppercase;
        border-color: #1CB94A;
    }
    .btn-register:hover,
    .btn-register:focus {
        color: #fff;
        background-color: #1CA347;
        border-color: #1CA347;
    }

</style>
</head>

<body class="login" style="background-image: url(<?php echo base_url(); ?>assets/modules/login.jpg);background-position: center;">

    <!------ Include the above in your HEAD tag ---------->

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 " >
                <div class="panel panel-login" style="padding: 20px">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="#" class="active" id="admin_login-form-link">Admin Login</a>
                            </div>
                            <div class="col-xs-6">
                                <a href="#" id="user_login-form-link">User Login</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="admin_login-form" role="form" style="display: block;">
                                    <div id="adminOutput"></div>
                                    <div class="form-group">
                                        <input type="text" name="admin_email" id="admin_email" tabindex="1" class="form-control" placeholder="Enter your Email Id here" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="admin_password" id="admin_password" tabindex="2" class="form-control" placeholder="Enter your Password here">
                                    </div>
                                    <!-- <div class="form-group text-center">
                                        <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                        <label for="remember"> Remember Me</label>
                                    </div> -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <button type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login"> Log In as Administrator </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <a tabindex="5" href="<?php echo base_url(); ?>admin_forgetpassword" class="forgot-password">Forgot Password?</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form id="user_login-form" role="form" style="display: none;">
                                    <div id="userOutput"></div>
                                    <div class="form-group">
                                        <input type="text" name="user_email" id="user_email" tabindex="1" class="form-control" placeholder="Enter your Email Id here" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="user_password" id="user_password" tabindex="2" class="form-control" placeholder="Enter your Password here">
                                    </div>
                                    <!-- <div class="form-group text-center">
                                        <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                        <label for="remember"> Remember Me</label>
                                    </div> -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <button type="submit" name="userlogin-submit" id="userlogin-submit" tabindex="4" class="form-control btn btn-login"> Log In as User </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <a tabindex="5" href="<?php echo base_url(); ?>user_forgetpassword" class="forgot-password">Forgot Password?</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {

            $('#admin_login-form-link').click(function(e) {
                $("#admin_login-form").delay(100).fadeIn(100);
                $("#user_login-form").fadeOut(100);
                $('#user_login-form-link').removeClass('active');
                $(this).addClass('active');
                e.preventDefault();
            });
            $('#user_login-form-link').click(function(e) {
                $("#user_login-form").delay(100).fadeIn(100);
                $("#admin_login-form").fadeOut(100);
                $('#admin_login-form-link').removeClass('active');
                $(this).addClass('active');
                e.preventDefault();
            });

        });

        //  ------------------------ADMIN LOGIN FORM -------------------------//
        $(function () {
            $("#admin_login-form").submit(function () {
                dataString = $("#admin_login-form").serialize();
                $.ajax({
                    type: "POST",
                    url: BASE_URL+'login/adminlogin',
                    data: dataString,
                    return: false, 
                    beforeSend: function(){
                        $('#login-submit').prop('disabled', true);
                        $('#login-submit').html('<i class="fa fa-circle-o-notch fa-spin w3-large"></i> <b>Checking credentials...</b>');
                    },
                    success: function(data){
                        $('#login-submit').prop('disabled', false);
                        $('#adminOutput').html(data);
                        $('#login-submit').html('Log In as Administrator');                        
                    },
                    error:function(data){
                       $('#adminOutput').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
                       $('#login-submit').html('Log In as Administrator');
                       window.setTimeout(function() {
                         $(".alert").fadeTo(500, 0).slideUp(500, function(){
                           $(this).remove(); 
                       });
                     }, 5000);
                   }
               });
        return false;  //stop the actual form post !important!
    });
        });
//  -------------------------END -------------------------------//

//  ------------------------USER LOGIN FORM -------------------------//
        $(function () {
            $("#user_login-form").submit(function () {
                dataString = $("#user_login-form").serialize();
                $.ajax({
                    type: "POST",
                    url: BASE_URL+'user/userrole_login/user_login',
                    data: dataString,
                    return: false, 
                    beforeSend: function(){
                        $('#userlogin-submit').prop('disabled', true);
                        $('#userlogin-submit').html('<i class="fa fa-circle-o-notch fa-spin w3-large"></i> <b>Checking credentials...</b>');
                    },
                    success: function(data){
                        $('#userlogin-submit').prop('disabled', false);
                        $('#userOutput').html(data);
                        $('#userlogin-submit').html(' Log In as User ');                        
                    },
                    error:function(data){
                       $('#userOutput').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
                       $('#userlogin-submit').html(' Log In as User ');
                       window.setTimeout(function() {
                         $(".alert").fadeTo(500, 0).slideUp(500, function(){
                           $(this).remove(); 
                       });
                     }, 5000);
                   }
               });
        return false;  //stop the actual form post !important!
    });
        });
//  -------------------------END -------------------------------//
</script>
</body>
</html>
