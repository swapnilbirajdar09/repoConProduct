<title>Construction Manager | Register User</title>
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">
                <div class="row x_title">
                    <div class="col-md-6">
                        <h3><i class="fa fa-plus"></i> Create New User </h3>
                    </div>
                </div>             
                <form id="createNewUser" name="createNewUser" method="post">
                    <div class="w3-col l12 page_title">
                        <div class="w3-col l12 w3-margin-left w3-padding-small w3-center" id="message"></div>
                        <!-- Alert for Validating Ajax Profile Edit Section -->
                        <div class="col-lg-3 col-md-4 alert_message" id="ajax_validation_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
                            <div class="alert alert-warning  fade show alert-dismissible" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <span class="ajax_validation_alert"></span>
                            </div>
                        </div>
                        <!-- Alert for Validating Ajax Profile Edit Section -->
                        <!-- Alerts for Member actions -->
                        <div class="col-lg-3 col-md-4 alert_message" id="ajax_success_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
                            <div class="alert alert-success  fade show alert-dismissible" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <!-- Success Alert Content -->
                                <span class="ajax_success_alert"></span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 alert_message" id="ajax_danger_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
                            <div class="alert alert-danger  fade show alert-dismissible" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <!-- Success Alert Content -->
                                <span class="ajax_danger_alert"></span>
                            </div>
                        </div>
                        <!-- warning alerts -->
                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                            <div class="form-group">
                                <label for="customer_name">First Name <b class="w3-text-red w3-medium">*</b> </label>
                                <input type="text" class="form-control" id="userFirstName" name="userFirstName" placeholder="Enter User First name" required>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom" >
                            <div class="form-group w3-col l12">
                                <label for="stock_plant">Last Name <b class="w3-text-red w3-medium">*</b> </label>
                                <input type="text" maxlength="10" min="0" class="form-control" id="userLastName" name="userLastName" placeholder="Enter User Last Name" required>
                            </div>                          
                        </div> 

                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                            <div class="form-group">
                                <label for="prod_type">Email <b class="w3-text-red w3-medium">*</b> </label>
                                <input type="email" class="form-control" id="userEmail" name="userEmail" placeholder="Enter User Email" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                            <div class="form-group">
                                <label for="product_name">Mobile No <b class="w3-text-red w3-medium">*</b> </label>
                                <input type="number" min="0" class="form-control" id="user_mobile" ng-model="user_mobile" name="user_mobile" placeholder="Enter User Mobile Number" required>
                            </div>
                        </div>

                        <?php //print_r($roles);?>
                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                            <div class="form-group">
                                <label for="revision_no">Roles <b class="w3-text-red w3-medium">*</b> </label>
                                <select name="roles" id="roles" class="form-control selectpicker" data-placeholder="Choose User" data-hide-disabled="true">
                                    <option value="0">Choose Role</option>
                                    <?php if ($roles['status'] == 500) { ?>
                                        <option value="0"> No Roles Available.</option>
                                        <?php
                                    } else {
                                        for ($i = 0; $i < count($roles['status_message']); $i++) {
                                            ?>
                                            <option value="<?php echo $roles['status_message'][$i]['role_id'] . '/' . $roles['status_message'][$i]['role_name']; ?>">
                                                <?php echo $roles['status_message'][$i]['role_name']; ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                            <div class="form-group">
                                <label for="product_name">Password <b class="w3-text-red w3-medium">*</b> </label>
                                <input type="text" class="form-control" id="userPassword" ng-model="userPassword" name="userPassword" placeholder="Enter User Password" required>
                            </div>
                        </div>

                        <div class="w3-col l12 form-group w3-center w3-padding-top">
                            <button id="createUser" class="w3-button w3-margin-top theme_bg" type="submit" > Create User  </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--<script src="<?php echo base_url(); ?>assets/js/module/user/userRegister.js"></script>-->
<script type="text/javascript">
    $(function () {
        $("#createNewUser").submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>user/createuser/createNewUser",
                cache: false,
                data: $('#createNewUser').serialize(),
                beforeSend: function () {
                    $('#createUser').prop('disabled', true);
                },
                success: function (response) {
                    //console.log(response);
                    var data = JSON.parse(response);
                    // console.log(response);
                    //return false;
                    // Re_Enabling the Elements
                    $('#createUser').prop('disabled', false);
                    // response message
                    switch (data.status) {
                        case 'success':
                            $('#message').html(data.message);
                            break;
                        case 'error':
                            $('#message').html(data.message);
                            break;
                        case 'validation':
                            $('#message').html(data.message);
                            break;
                        default:
                            $('#message').html('<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><b>Error:</b> Something went wrong! Try refreshing page and Save again.</strong></div>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove(); });}, 5000);');
                            break;
                    }
                },
                error: function (response) {
                    // Re_Enabling the Elements
                    $('#createUser').prop('disabled', false);
                    $('#message').html('<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><b>Error:</b> Something went wrong! Try refreshing page and Save again.</strong></div>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove(); });}, 5000);');
                    setTimeout(function () {
                        $('.alert_message').fadeOut('fast');
                    }, 4000); // <-- time in milliseconds  
                }
            });
        });
    });

</script>

