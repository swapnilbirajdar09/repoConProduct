<title>Construction Manager | Grant Privilege</title>
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="row x_title">
                <div class="col-md-6">
                    <h3><i class="fa fa-plus"></i> Grant Privileges </h3>
                </div>
            </div>        
            <?php // print_r($projects); ?>
            <div class="col-lg-12">
                <div class="col-md-12 w3-center" id="messageDiv"></div>
                <form id="grantPrivilege" name="grantPrivilege" method="post">
                    <div class="col-md-6 col-xs-12 col-sm-12 page_title w3-border-right">
                        <div class="col-md-12 col-sm-12 col-xs-12 w3-margin-bottom">
                            <div class="form-group">
                                <label for="features">Features <b class="w3-text-red w3-medium">*</b> :</label>
                                <select class="w3-input" name="feature" id="feature" style="border-bottom-color: #CCCCCC">
                                    <option value="0" class="w3-light-grey">Choose Feature</option>
                                    <?php
                                    //print_r($features);
                                    if ($features['status'] != 500) {
                                        foreach ($features['status_message'] as $key) {
                                            ?>
                                            <option value="<?php echo $key['feature_id']; ?>"><?php echo $key['feature_name']; ?></option>
                                            <?php
                                        }
                                    } else {
                                        ?>  
                                        <option>No Features Are Available.</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 w3-margin-bottom">
                            <div class="form-group">
                                <label for="grades">Grades <b class="w3-text-red w3-medium"></b> </label><br>
                                <?php
                                //print_r($grades);
                                if ($grades['status'] != 500) {
                                    foreach ($grades['status_message'] as $key) {
                                        ?>
                                        <input type="checkbox" id="grades" name="grades[]" value="<?php echo $key['grade_id']; ?>"> Grade <?php echo $key['grade']; ?><br>
                                        <?php
                                    }
                                } else {
                                    ?>  
                                    <center><span>No Features Are Available.</span></center>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="w3-col l12 form-group w3-center w3-padding-top">
                            <button id="grantPrivBtn" class=" w3-button w3-margin-top theme_bg" type="submit"> Grant privilege </button>
                        </div>
                        <div class="col-md-12 w3-center" id="message"></div>
                    </div>
                    <div class="col-md-6 col-xs-12 col-sm-12 w3-padding" style="background-color: #FFF; display: none;">
                        <div class="w3-col l12">
                            <div class="row x_title">
                                <div class="">
                                    <h4><i class="fa fa-users"></i> All Roles </h4>
                                </div>
                            </div>
                            <div class="container x_title" style=" margin-top: 5px;">
                                <table id="" class="table">
                                    <thead>
                                        <tr class="theme_bg">
                                            <th class="w3-center"><span>Sr.No</span></th>
                                            <th class="w3-center"><span>Role Name</span></th>                                                
                                            <th class="w3-center"><span>Action</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
//                                        if ($roles['status'] != 500) {
//                                            $i = 1;
//                                            foreach ($roles['status_message'] as $val) {
//                                                ?>
<!--                                                <tr>
                                                    <td class="w3-center"><span>//<?php echo $i; ?></span></td>
                                                    <td class="w3-center"><span>//<?php echo $val['role_name']; ?></span></td>
                                                    <td class="w3-center"><a onclick="deleteRole(//<?php echo $val['role_id']; ?>);" class="btn w3-text-red"><i class="fa fa-trash"></i> Delete</a></td>
                                                </tr>-->
                                                //<?php
//                                                $i++;
//                                            }
//                                        } else {
                                            ?>
<!--                                            <tr>
                                                <td colspan="3" class="w3-center">No Roles Found.</td>
                                            </tr>-->
                                        <?php //} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $("#grantPrivilege").submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>user/grant_permission/grantPrivilege",
                cache: false,
                data: $('#grantPrivilege').serialize(),
                beforeSend: function () {
                    $('#grantPrivBtn').prop('disabled', true);
                },
                success: function (response) {
                    console.log(response);
                    var data = JSON.parse(response);
                    // Re_Enabling the Elements
                    $('#grantPrivBtn').prop('disabled', false);
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
                        case 'validation':
                            //$('#ajax_danger_alert').show();
                            $('#message').html(data.message);
                            setTimeout(function () {
                                $('.alert_message').fadeOut('fast');
                            }, 10000); // <-- time in milliseconds
                            break;
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
                    $('#grantPrivBtn').prop('disabled', false);
//                $('#ajax_danger_alert').show();
                    $('#message').html('<div class="alert alert-danger alert-dismissible" style="margin-bottom:5px"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><b>Error:</b> Something went wrong! Try refreshing page and Save again.</strong></div>');
                    setTimeout(function () {
                        $('.alert_message').fadeOut('fast');
                    }, 4000); // <-- time in milliseconds  
                }
            });
        });
    });

</script>
<script src="<?php echo base_url(); ?>assets/js/module/user/createRole.js"></script>

