<title>Construction Manager | Register User</title>

<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">
                <div class="row x_title">
                    <div class="col-md-6">
                        <h3><i class="fa fa-plus"></i> Register Company </h3>
                    </div>
                </div>             
                <form id="userRegister" name="userRegister" method="post">
                    <div class="w3-col l12 page_title">

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
                                <label for="customer_name">Full Name <b class="w3-text-red w3-medium">*</b> </label>
                                <input type="text" class="form-control" id="user_fullname" name="user_fullname" placeholder="Enter User name" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                            <div class="form-group">
                                <label for="prod_type">Email <b class="w3-text-red w3-medium">*</b> </label>
                                <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Enter User Email" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom" >
                            <div class="form-group w3-col l12">
                                <label for="stock_plant">Mobile No <b class="w3-text-red w3-medium">*</b> </label>
                                <input type="number" maxlength="10" min="0" class="form-control" id="user_mobile" name="user_mobile" placeholder="Enter User Mobile No" required>
                            </div>                          
                        </div>                        
                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                            <div class="form-group">
                                <label for="product_name">Company Name <b class="w3-text-red w3-medium">*</b> </label>
                                <input type="text" class="form-control" id="company_name" ng-model="company_name" name="company_name" placeholder="Enter product name" required>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 w3-margin-bottom">
                            <div class="form-group">
                                <label for="divrawing_no">Address <b class="w3-text-red w3-medium">*</b> </label>
                                <textarea class="form-control" id="user_address" ng-model="user_address" name="user_address" placeholder="Enter User Address" style="resize: none;"></textarea>
<!--                                <input type="text" class="form-control" id="user_address" ng-model="user_address" name="user_address" placeholder="Enter drawing number">-->
                            </div>
                        </div>
                        <?php //print_r($country['status_message'][0]);?>
                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                            <div class="form-group">
                                <label for="revision_no">Country <b class="w3-text-red w3-medium">*</b> </label>
                                <select name="country" id="country" class="form-control selectpicker" onchange="getCountryState();" data-placeholder="Choose country" tabindex="2" data-hide-disabled="true">
                                    <option value="0">Choose country</option>
                                    <?php for ($i = 0; $i < count($country['status_message']); $i++) { ?>
                                        <option value="<?php echo $country['status_message'][$i]['name'] . '/' . $country['status_message'][$i]['id']; ?>" <?php
//                                        if ($userDetails[0]['user_country'] == $country[$i]['name']) {
//                                            echo 'selected';
//                                        }
                                        ?>>
                                                    <?php echo $country['status_message'][$i]['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                            <div class="form-group">
                                <label for="revision_no">State <b class="w3-text-red w3-medium">*</b> </label>
                                <select id="state" name="state" class="form-control form-control selectpicker" onchange="getStateCity();" tabindex="2" data-hide-disabled="true">
                                    <option value="0">Choose a Country first</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                            <div class="form-group">
                                <label for="revision_no">City <b class="w3-text-red w3-medium">*</b> </label>
                                <select id="city" name="city" class="form-control form-control selectpicker" tabindex="2" data-hide-disabled="true">
                                    <option value="">Choose a State first</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                            <div class="form-group">
                                <label for="revision_no">Postal Code <b class="w3-text-red w3-medium">*</b> </label>
                                <input type="number" class="form-control" id="postal_code" ng-model="postal_code" name="postal_code" placeholder="Enter Postal Code">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                            <div class="form-group">
                                <label for="revision_no">Package Choosed <b class="w3-text-red w3-medium">*</b> </label>
<!--                                <input type="text" class="form-control" id="revision_no" ng-model="revision_no" name="revision_no" placeholder="Enter revision number">-->
                                <select id="package" name="package" class="form-control form-control selectpicker" data-hide-disabled="true">
                                    <option value="0">Free</option>
                                    <option value="6">6 Months</option>
                                    <option value="1">Year</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="w3-col l12 page_title w3-margin-top w3-margin-bottom">
                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                            <div class="form-group">
                                <label for="customer_name">Username <b class="w3-text-red w3-medium">*</b> :</label>
                                <input type="text" class="form-control" id="user_username" name="user_username" placeholder="Enter username" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                            <div class="form-group">
                                <label for="customer_name">Password <b class="w3-text-red w3-medium">*</b> :</label>
                                <input type="text" class="form-control" id="user_password" name="user_password" placeholder="Enter password " required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                            <div class="form-group">
                                <label for="prod_type">Confirm Password <b class="w3-text-red w3-medium">*</b> :</label>
                                <input type="text" class="form-control" onkeyup="checkPassword();" id="confPassword" name="confPassword" placeholder="Enter confirm password" required>
                            </div>
                        </div>
                        <div class="w3-col l12 w3-margin-left w3-padding-small w3-center" id="message"></div>

                        <div class="w3-col l12 form-group w3-center w3-padding-top">
                            <button id="register" class=" w3-button w3-margin-top theme_bg" type="button" onclick="registerUser();" > Register </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--<script src="<?php echo base_url(); ?>assets/js/module/user/userRegister.js"></script>-->
<script type="text/javascript">
    function registerUser() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>user/userregister/registerUser",
            cache: false,
            data: $('#userRegister').serialize(),
            beforeSend: function () {
                //$('#register').prop('disabled', true);
            },
            success: function (response) {
                //console.log(response);
                var data = JSON.parse(response);
                //alert(response);
                // Re_Enabling the Elements
                $('#register').prop('disabled', false);
                // response message
                switch (data.status) {
                    case 'success':
                        //$('#ajax_success_alert').show();
                        $('#message').html(data.message);
                        setTimeout(function () {
                            window.location.reload();
                        }, 1500); // <-- time in milliseconds 
                        break;
                    case 'error':
                        //$('#ajax_danger_alert').show();
                        $('#message').html(data.message);
                        setTimeout(function () {
                            $('.alert_message').fadeOut('fast');
                        }, 10000); // <-- time in milliseconds
                        break;
//                    case 'validation':
                    default:
                        //$('#ajax_validation_alert').show();
                        $('#message').html('<div class="alert alert-danger alert-dismissible" style="margin-bottom:5px"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><b>Error:</b> Something went wrong! Try refreshing page and Save again.!</strong></div>');
                        setTimeout(function () {
                            $('.alert_message').fadeOut('fast');
                        }, 8000); // <-- time in milliseconds
                        break;
                }
            },
            error: function (response) {
                // Re_Enabling the Elements
                $('#register').prop('disabled', false);
                $('#ajax_danger_alert').show();
                $('.ajax_danger_alert').html(' Something went wrong! Try refreshing page and Save again.');
                setTimeout(function () {
                    $('.alert_message').fadeOut('fast');
                }, 4000); // <-- time in milliseconds  
            }
        });
    }



    function checkPassword() {
        if ($('#user_password').val() == $('#confPassword').val()) {
            $('#register').prop("disabled", false);
            $('#message').html('');
        } else {
            $('#message').html('<label>Password Not Matching</label>').css('color', 'red');
            $('#register').prop("disabled", true);
        }
    }
// get state by country
    function getCountryState() {
        var country = $("#country").val();
        $.ajax({
            type: "GET",
            url: BASE_URL + "user/userregister/getCountryState",
            data: {
                country: country
            },
            cache: false,
            success: function (data) {
                var stateData = '';
                stateData = JSON.parse(data);
                var i;
                var state = $('#state');
                state.find('option:not(:first-child)').remove();
                for (i = 0; i < stateData.length; i++) {
                    $('#state').append('<option value="' + stateData[i].name + '/' + stateData[i].id + '">' + stateData[i].name + '</option>');
                }
            }
        });
    }
// ---------- get city by state
    function getStateCity() {
        var state = $("#state").val();
        $.ajax({
            type: "GET",
            url: BASE_URL + "user/userregister/getStateCity",
            data: {
                state: state
            },
            cache: false,
            success: function (data) {

                var cityData = '';
                cityData = JSON.parse(data);
                var i;
                var city = $('#city');
                city.find('option:not(:first-child)').remove();
                for (i = 0; i < cityData.length; i++) {
                    $('#city').append('<option value="' + cityData[i].name + '">' + cityData[i].name + '</option>');
                }
            }
        });
    }
</script>

