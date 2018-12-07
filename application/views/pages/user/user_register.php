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
                <!--                <form id="userRegister" ng-app="userRegisterForm" ng-cloak ng-controller="userRegisterCtrl">-->
                <!--                    <fieldset>-->
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
                            <label for="customer_name">Full Name <b class="w3-text-red w3-medium">*</b> :</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter customer name" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                        <div class="form-group">
                            <label for="prod_type">Email <b class="w3-text-red w3-medium">*</b> :</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter customer name" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom" >
                        <div class="form-group w3-col l12">
                            <label for="stock_plant">Mobile No <b class="w3-text-red w3-medium">*</b> :</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter customer name" required>
                        </div>                          
                    </div>                        
                    <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                        <div class="form-group">
                            <label for="product_name">Company Name <b class="w3-text-red w3-medium">*</b> :</label>
                            <input type="text" class="form-control" id="product_name" ng-model="product_name" name="product_name" placeholder="Enter product name" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                        <div class="form-group">
                            <label for="divrawing_no">Address </label>
                            <input type="text" class="form-control" id="drawing_no" ng-model="drawing_no" name="drawing_no" placeholder="Enter drawing number">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                        <div class="form-group">
                            <label for="revision_no">Country </label>
                            <input type="text" class="form-control" id="revision_no" ng-model="revision_no" name="revision_no" placeholder="Enter revision number">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                        <div class="form-group">
                            <label for="revision_no">State </label>
                            <input type="text" class="form-control" id="revision_no" ng-model="revision_no" name="revision_no" placeholder="Enter revision number">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                        <div class="form-group">
                            <label for="revision_no">City </label>
                            <input type="text" class="form-control" id="revision_no" ng-model="revision_no" name="revision_no" placeholder="Enter revision number">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                        <div class="form-group">
                            <label for="revision_no">Postal Code </label>
                            <input type="text" class="form-control" id="revision_no" ng-model="revision_no" name="revision_no" placeholder="Enter revision number">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                        <div class="form-group">
                            <label for="revision_no">Package Choosed </label>
                            <input type="text" class="form-control" id="revision_no" ng-model="revision_no" name="revision_no" placeholder="Enter revision number">
                        </div>
                    </div>
                </div>
                <div class="w3-col l12 page_title w3-margin-top">
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
                    <div class="form-group w3-center w3-padding-top">
                        <button class="w3-button w3-margin-top theme_bg" type="button" ng-click="submitProduct()"><i class="fa fa-plus"></i> Add This Product</button>
                    </div>
                </div>

                <!--                </form>-->
            </div>
        </div>
    </div>
</div>
