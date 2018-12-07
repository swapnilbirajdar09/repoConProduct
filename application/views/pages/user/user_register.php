<title>Construction Manager | Register User</title>
<style type="text/css">
    #addProduct fieldset{
        /*display: none;*/
        margin-bottom: 16px
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">
                <div class="row x_title">
                    <div class="col-md-6">
                        <h3><i class="fa fa-plus"></i> Register User </h3>
                    </div>
                </div>             
                <form id="userRegister" name="userRegister">
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
                            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter customer name" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                        <div class="form-group">
                            <label for="prod_type">Email <b class="w3-text-red w3-medium">*</b> </label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter customer name" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom" >
                        <div class="form-group w3-col l12">
                            <label for="stock_plant">Mobile No <b class="w3-text-red w3-medium">*</b> </label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter customer name" required>
                        </div>                          
                    </div>                        
                    <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                        <div class="form-group">
                            <label for="product_name">Company Name <b class="w3-text-red w3-medium">*</b> </label>
                            <input type="text" class="form-control" id="product_name" ng-model="product_name" name="product_name" placeholder="Enter product name" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                        <div class="form-group">
                            <label for="divrawing_no">Address <b class="w3-text-red w3-medium">*</b> </label>
                            <input type="text" class="form-control" id="drawing_no" ng-model="drawing_no" name="drawing_no" placeholder="Enter drawing number">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                        <div class="form-group">
                            <label for="revision_no">Country <b class="w3-text-red w3-medium">*</b> </label>
                            <input type="text" class="form-control" id="revision_no" ng-model="revision_no" name="revision_no" placeholder="Enter revision number">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                        <div class="form-group">
                            <label for="revision_no">State <b class="w3-text-red w3-medium">*</b> </label>
                            <input type="text" class="form-control" id="revision_no" ng-model="revision_no" name="revision_no" placeholder="Enter revision number">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                        <div class="form-group">
                            <label for="revision_no">City <b class="w3-text-red w3-medium">*</b> </label>
                            <input type="text" class="form-control" id="revision_no" ng-model="revision_no" name="revision_no" placeholder="Enter revision number">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                        <div class="form-group">
                            <label for="revision_no">Postal Code <b class="w3-text-red w3-medium">*</b> </label>
                            <input type="text" class="form-control" id="revision_no" ng-model="revision_no" name="revision_no" placeholder="Enter revision number">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                        <div class="form-group">
                            <label for="revision_no">Package Choosed <b class="w3-text-red w3-medium">*</b> </label>
                            <input type="text" class="form-control" id="revision_no" ng-model="revision_no" name="revision_no" placeholder="Enter revision number">
                        </div>
                    </div>
                </div>
                <div class="w3-col l12 page_title w3-margin-top">
                    <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                        <div class="form-group">
                            <label for="customer_name">Username <b class="w3-text-red w3-medium">*</b> :</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter customer name" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                        <div class="form-group">
                            <label for="customer_name">Password <b class="w3-text-red w3-medium">*</b> :</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter customer name" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                        <div class="form-group">
                            <label for="prod_type">Confirm Password <b class="w3-text-red w3-medium">*</b> :</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter customer name" required>
                        </div>
                    </div>
                    <div class="w3-col l12 form-group w3-center w3-padding-top">
                        <button id="register" class=" w3-button w3-margin-top theme_bg" type="button" ng-click="registerCompany()"> Register </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/module/user/profile.js"></script>
<script type="text/javascript">
// get state by country
                            function getCountryState() {
                                var country = $("#country").val();
                                $.ajax({
                                    type: "GET",
                                    url: BASE_URL + "user/search/advance_search/getCountryState",
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
                                    url: BASE_URL + "user/search/advance_search/getStateCity",
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

