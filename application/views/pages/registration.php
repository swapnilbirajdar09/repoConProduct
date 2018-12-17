<section class="about-area ptb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sec-title">
                    <h2>Registration<span class="sec-title-border"><span></span><span></span><span></span></span></h2>
                    
                </div>
            </div>
        </div>
       
    </div>
</section>
 <div class="container">
            	<form  id="userRegister" name="userRegister">
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
								<div class="row">
									<div class="col-lg-6">
									<input type="text"  id="user_fullname" name="user_fullname" placeholder="Enter Your Full name" required>
									</div>
									<div class="col-lg-6">
										 <input type="email" id="user_email" name="user_email" placeholder="Enter Your Email Id" required>
									</div>
									<div class="col-lg-6">
										 <input type="number" maxlength="10" min="0" id="user_mobile" name="user_mobile" placeholder="Enter Your Mobile No" required>
									</div>
									<div class="col-lg-6">
										 <input type="text"  id="company_name" ng-model="company_name" name="company_name" placeholder="Enter Your product name" required>
									</div>
									<div class="col-lg-12">
										<textarea  id="user_address" ng-model="user_address" name="user_address" placeholder="Enter Your Address"></textarea>
									</div>
									<div class="col-lg-6" style="margin-bottom:15px;">
									<select name="country" id="country" class="form-control selectpicker" onchange="getCountryState();" data-placeholder="Choose country" tabindex="2" data-hide-disabled="true">
                                    <option value="0">Choose country</option>
                                    <?php for ($i = 0; $i < count($country['status_message']); $i++) { ?>
                                        <option value="<?php echo $country['status_message'][$i]['name'] . '/' . $country['status_message'][$i]['id']; ?>" >
                                          <?php echo $country['status_message'][$i]['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
									</div>
									<div class= "col-lg-6" style="margin-bottom:15px;">
										 <select id="state" name="state" class="form-control form-control selectpicker" onchange="getStateCity();" tabindex="2" data-hide-disabled="true">
                                    <option value="0">Choose a Country first</option>
                                </select>
									</div>
									<div class = "col-lg-6" style="margin-bottom:15px;">
										 <select id="city" name="city" class="form-control form-control selectpicker" tabindex="2" data-hide-disabled="true">
                                    <option value="0">Choose a State first</option>
                                </select>
									</div>
									<div class="col-lg-6">
										  <input type="number"  id="postal_code" ng-model="postal_code" name="postal_code" placeholder="Enter Postal Code">
									</div>
									<div class="col-lg-6" style="margin-bottom:15px;">
									<select id="package" name="package" class="form-control form-control selectpicker" data-hide-disabled="true">
                                    <option value="0">Free</option>
                                    <option value="6">6 Months</option>
                                    <option value="1">Year</option>
                                </select>
									</div>
									<div class="col-lg-6">
										<input type="text" class="form-control" id="user_username" name="user_username" placeholder="Enter username" required>
									</div>
									<div class="col-lg-6">
										 <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Enter password " required>
									</div>
									<div class="col-lg-6">
										<input type="password" class="form-control" onkeyup="checkPassword();" id="confPassword" name="confPassword" placeholder="Enter confirm password" required>
									</div>

									<div class="col-lg-12" style="text-align:center;float:center">
									<button id="register" class="btn btn-primary btn-lg" style="text-align:center;margin:10px;" type="button" > Register </button>
								</div>
								</div>
				            </form>
				            <div class="w3-col l12 w3-margin-left w3-padding-small w3-center" style="margin:10px;" id="message"></div>
				         
        </div>
<div class="google-map"></div>
<script type="text/javascript">
    $(function () {
        $("#register").click(function () {
        	//alert('enter step 1');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>registration/registerUser",
                cache: false,
                data: $('#userRegister').serialize(),
                beforeSend: function () {
                    $('#register').prop('disabled', true);
                },
                success: function (response) {
                	//alert('enter step 2');
                    console.log(response);
                    var data = JSON.parse(response);
                 //   alert(response);
                    // Re_Enabling the Elements
                    $('#register').prop('disabled', false);
                    // response message
                    switch (data.status) {
                        case 'success':
                            //$('#ajax_success_alert').show();
                            $('#message').html(data.message);
                            setTimeout(function () {
                                //window.location.reload();
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
                	    	alert('enter step 3');
                    // Re_Enabling the Elements
                    $('#register').prop('disabled', false);
                    $('#ajax_danger_alert').show();
                    $('.ajax_danger_alert').html(' Something went wrong! Try refreshing page and Save again.');
                    setTimeout(function () {
                        $('.alert_message').fadeOut('fast');
                    }, 4000); // <-- time in milliseconds  
                }
            });
        });
    });



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
            url: BASE_URL + "registration/getCountryState",
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
            url: BASE_URL + "registration/getStateCity",
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