<title>Construction Manager | Request Module</title>
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">
                <div class="row x_title">
                    <div class="col-md-6">
                        <h3><i class="fa fa-plus"></i> Document Request </h3>
                    </div>
                </div>             
                <form id="createNewReq" name="createNewReq" method="post">
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
                                <label for="customer_name">Document Name <b class="w3-text-red w3-medium">*</b> </label>
                                <input type="text" class="form-control" id="document_name" name="document_name" placeholder="Enter Document Name Here" required>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom" >
                            <div class="form-group w3-col l12">
                                <label for="stock_plant">Estimated Date <b class="w3-text-red w3-medium">*</b> </label>
                                <input type="date" maxlength="10" min="0" class="form-control" id="estimated_date" name="estimated_date"  required>
                            </div>                          
                        </div> 

                        
                       

                        <?php //print_r($roles);?>
                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                            <div class="form-group">
                                <label for="revision_no">Document From <b class="w3-text-red w3-medium">*</b> </label>
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
                        <div class="w3-col l12 form-group w3-center w3-padding-top">
                            <button id="submitReq" class="w3-button w3-margin-top theme_bg" type="submit" > Submit Request </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>
<script type="text/javascript">
 $("#createNewReq").submit(function (e) {
        	//alert('hi');
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>modules/request_module/createNewReq",
                cache: false,
                data: $('#createNewReq').serialize(),
                beforeSend: function () {
                    $('#submitReq').prop('disabled', true);
                },
                success: function (response) {
                    console.log(response);return false;
                    var data = JSON.parse(response);
                    $('#submitReq').prop('disabled', false);
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
                    $('#submitReq').prop('disabled', false);
                    $('#message').html('<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><b>Error:</b> Something went wrong! Try refreshing page and Save again.</strong></div>window.setTimeout(function() {	$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove(); });}, 5000);');
                    setTimeout(function () {
                        $('.alert_message').fadeOut('fast');
                    }, 4000); // <-- time in milliseconds  
                }
            });
        });

</script>

