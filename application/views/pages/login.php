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
        <!-- Custom Theme Style -->
        <link href="<?php echo base_url(); ?>assets/build/css/custom.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/build/css/animate.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/build/css/w3.css" rel="stylesheet">
        <!-- angular-->
        <script src="<?php echo base_url(); ?>assets/js/angular.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/angular-sanitize.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/const.js"></script>

    </head>

    <body class="login" style="background-image: url(<?php echo base_url(); ?>);background-position: center;">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper" ng-app="loginApp" ng-controller="loginController">
                <div class="animate form login_form w3-padding">
                    <section class="login_content w3-padding w3-white w3-text-grey w3-card-2">
                        <form ng-submit="submit()" method="POST">
                            <h1>Login Form</h1>

                            <div ng-bind-html="message"></div>

                            <div>
                                <input type="text" ng-model="username" class="form-control w3-small" placeholder="Enter username here..." required>
                            </div>
                            <div>
                                <input type="password" ng-model="password" class="form-control w3-small" placeholder="Enter password here..." required>
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block" type="submit">
                                    <span ng-show="loginButtonText == 'Authenticating user. Please wait...'"><i class="fa fa-circle-o-notch fa-spin"></i></span>
                                    {{ loginButtonText}}
                                </button>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">
                                    <a href="#signup" class="to_register" >Lost your password?</a>
                                </p>

                                <div class="clearfix"></div>
                                <br />

                                <div>

                                    <p>©2018 All Rights Reserved | Powered by <a target="_blank" href="https://bizmo-tech.com">Bizmo Technologies</a></p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>

                <div id="forgotpassword" class="animate form registration_form w3-padding">
                    <section class="login_content w3-padding w3-white w3-text-grey w3-card-2">
                        <div class="w3-padding" ng-bind-html="messageinfo"></div>
                        <form >
                            <h1>Get Password</h1>
                            <h6>Don't remember your password? Please enter valid email-id to get your password!</h6>
                            <div>
                                <input type="email" ng-model="email_id" class="form-control" placeholder="Enter email-ID here..." required>
                            </div>              
                            <div>
                                <button class="btn btn-primary btn-block" ng-click="forgetPassword()">Submit</button>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">I have a password ?
                                    <a href="#signin" class="to_register"> Log in </a>
                                </p>

                                <div class="clearfix"></div>
                                <br />
                                <div>
                                    <!-- <h1><i class="fa fa-circle-o w3-orange w3-padding-tiny w3-text-white" style="text-shadow: 2px 2px #ff0000;"></i> Swan Industries</h1> -->
                                    <p>©2018 All Rights Reserved | Powered by <a target="_blank" href="https://bizmo-tech.com">Bizmo Technologies</a></p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>

        <!-- Authenticate user script  -->
        <script>
            var loginApp = angular.module('loginApp', ['ngSanitize']);
            loginApp.controller('loginController', function ($scope, $http, $timeout, $window) {
                $scope.loginButtonText = "Log in as Administrator";
                $scope.test = "false";

                $scope.submit = function ()
                {
                    $scope.message = '';
                    // spinner on button
                    $scope.test = "true";
                    $scope.loginButtonText = "Authenticating user. Please wait...";

                    // Do login here        
                    $timeout(function () {
                        // POST form data to controller
                        $http({
                            method: 'POST',
                            url: BASE_URL + 'login/adminlogin',
                            headers: {'Content-Type': 'application/json'},
                            data: JSON.stringify({username: $scope.username, password: $scope.password})
                        }).then(function (data) {
                            //alert(data);
                            if (data.data == 200) {
                                //alert('got');
                                $scope.message = '<p class="w3-green w3-padding-small">Login Successfull! Welcome Admin.</p>';
                                $window.location.href = BASE_URL + 'user_dashboard';
                            } else {
                                $scope.message = data.data;
                            }

                        });
                        $scope.loginButtonText = "Log in as Administrator";
                    }, 2000);

                };

                $scope.forgetPassword = function () {
                    //$.alert();
                    $http({
                        method: 'POST',
                        url: '<?php echo base_url(); ?>login/forgetPassword',
                        headers: {'Content-Type': 'application/json'},
                        data: JSON.stringify({email_id: $scope.email_id})
                    }).then(function (data) {
                        //alert(data.data);
                        console.log(data.data);
                        $scope.messageinfo = '<p class="w3-green w3-padding-small">' + data.data + '</p>';
                    });
                };


            });
        </script>
    </body>
</html>
