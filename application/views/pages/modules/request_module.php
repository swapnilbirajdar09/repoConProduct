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
    <div class="row">
        <div class="w3-col l12 w3-padding-small w3-margin-top page_title">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-list"></i> All Pending Request</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="w3-col l12 w3-padding w3-text-black"><span class="w3-medium"></span></div>

                <div class="container x_content">
                    <div id="table_msg"></div>
                    <div class="w3-col l12 w3-padding w3-small" id="allDocumentDiv">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Sr.No</th>
                                    <th class="text-center">Document Name</th>
                                    <th class="text-center">Requested By</th>
                                    <th class="text-center">Requested From</th> 
                                    <th class="text-center">Added Date</th>                        
                                    <th class="text-center">Estimated Date</th>                        
                                    <th class="text-center">Status</th>                        
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // print_r($approveRequests);
                                $i = 1;
                                $author = '';
                                if ($approveRequests['status'] != 500) {
                                    foreach ($approveRequests['status_message'] as $val) {
                                        $role = $this->session->userdata('role');
                                        if ($role == 'company_admin') {
                                            $author = 'Administrator';
                                        } else {
                                            $role = $this->session->userdata('role');
                                            $user_name = $this->session->userdata('user_name');
                                            $author = explode('/', $role);
                                            $roleid = $author[0];
                                            $rolename = $author[1];
                                            $author = $user_name;
                                        }
                                        if ($val['status'] == '0') {
                                            $status = 'Pending';
                                            $color = 'w3-blue';
                                        } else {
                                            $status = 'Uploaded';
                                            $color = 'w3-green';
                                        }
                                        //echo $author.' // '.$val['requested_by'].'<br>';
                                        if ($author == $val['requested_by'] || $role == 'company_admin') {
                                            ?>
                                            <tr class="w3-center">
                                                <td style=" vertical-align: middle;"><?php echo $i; ?></td>
                                                <td style=" vertical-align: middle;"><?php echo $val['document_name']; ?></td>
                                                <td style=" vertical-align: middle;"><?php echo $val['requested_by']; ?></td>
                                                <td style=" vertical-align: middle;"><p><?php echo $val['requested_from']; ?></p></td>  
                                                <td style=" vertical-align: middle;"><p><?php echo $val['created_date']; ?></p></td>                                    
                                                <td style=" vertical-align: middle;"><?php echo $val['estimated_date'] ?></td>                                    
                                                <td style=" vertical-align: middle;"><span class="badge <?php echo $color; ?>"><?php echo $status; ?></span></td>                                    
                                                <td style=" vertical-align: middle;">
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" id="actionBtn_<?php echo $val['request_id']; ?>" class="btn btn-default w3-small dropdown-toggle" type="button" style="padding: 2px 6px">Action <span class="caret"></span>
                                                        </button>
                                                        <ul role="menu" class="dropdown-menu pull-right">              
                                                            <li>
                                                                <a title="View Query" class="btn btn-xs text-left" data-toggle="modal" data-target="#RFIModal_<?php echo $val['request_id']; ?>" onclick="openHelp('<?php echo $val['request_id']; ?>')">View Query</a>
                                                            </li>
                                                            <?php
                                                            $user_role = $this->session->userdata('role');
                                                            if ($user_role == 'company_admin') {
                                                                $user_name = $this->session->userdata('usersession_name');
                                                            } else {
                                                                $user_name = $this->session->userdata('user_name');
                                                            }
                                                            if ($user_role == 'company_admin' || $user_name == $val['created_by']) {
                                                                if ($val['status'] == '1') {
                                                                    ?>
                                                                    <li><a title="Resolved query" class="btn btn-xs text-left" onclick="deleteRequest('<?php echo $val['request_id']; ?>');" >Resolved</a>
                                                                    </li>
                                                                    <!--     <li>
                                                                             <a class="btn btn-xs text-left" onclick="removeQuery('<?php echo $val['query_id']; ?>')" title="Delete document">Delete Query</a>
                                                                         </li> -->
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>  
                                            <!-- Modal to View Query -->
                                        <div class="modal fade bs-example-modal-lg" id="RFIModal_<?php echo $val['request_id']; ?>" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-md ">
                                                <!-- Modal content View Query -->
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                        </button>
                                                        <div class="col-lg-6">
                                                            <h4 class="modal-title w3-padding-left"><b>Query:</b> <?php echo $val['document_name']; ?></h4>
                                                        </div>
                                                    </div>
                                                    <!-- Modal body starts -->
                                                    <div class="modal-body">
                                                        <!-- Modal container starts -->
                                                        <div class="container"> 
                                                            <div class="w3-col l12 w3-padding w3-medium">
                                                                <div class="col-lg-6">
                                                                    <label>Query Raised To : </label>
                                                                    <p>                                        
                                                                        <?php echo $val['requested_from']; ?>
                                                                    </p>
                                                                </div> 
                                                                <div class="col-lg-6">
                                                                    <label>Estimated date : </label>
                                                                    <p>                                        
                                                                        <?php echo $val['estimated_date']; ?>
                                                                    </p>
                                                                </div> 
                                                            </div>
                                                            <div class="w3-col l12 w3-padding w3-medium">
                                                                <div class="col-lg-6">
                                                                    <label>Created Date : </label>
                                                                    <p>                                        
                                                                        <?php echo $val['created_date']; ?>
                                                                    </p>
                                                                </div> 
                                                                <?php if ($val['accepted_date'] != '0000-00-00 00:00:00') { ?>
                                                                    <div class="col-lg-6">
                                                                        <label>Uploaded Date : </label>
                                                                        <p>                                        
                                                                            <?php echo $val['accepted_date']; ?>
                                                                        </p>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>

                                                            <!--                                                                <div class="col-lg-12 w3-medium">
                                                                                                                                <hr>
                                                                                                                                <label>Comments: </label>
                                                                                                                                <form id="rfiReply_form_<?php echo $val['request_id']; ?>">
                                                                                                                                    <div class="w3-col l12 w3-round w3-light-grey w3-padding w3-margin-bottom">
                                                                                                                                        <textarea name="comment_posted" id="comment_posted_<?php echo $val['request_id']; ?>" class="w3-input w3-margin-bottom" rows="2" placeholder="Type here to reply..." required></textarea>
                                                                                                                                        <input type="hidden" id="request_id" name="request_id" value="<?php echo $val['request_id']; ?>">
                                                                                                                                        <div class="comment_msg"></div>
                                                                                                                                        <button id="commentBtn" class="btn theme_bg btn-small w3-small pull-right" onclick="savecomment('<?php echo $val['request_id']; ?>');" type="button"><i class="fa fa-reply"></i> Post Comment</button>
                                                                                                                                    </div>
                                                                                                                                </form>
                                                            
                                                                                                                                <div class="w3-col l12 w3-small comment_list" id="comment_list_<?php echo $val['request_id']; ?>">
                                                            
                                                                                                                                </div>
                                                                                                                            </div>-->
                                                        </div>
                                                        <!-- Modal container ends -->
                                                    </div>
                                                    <!-- Modal Body ends -->
                                                </div>
                                                <!-- Modal contenet ends -->
                                            </div>
                                        </div>                               
                                        <!-- Modal ends here -->                              
                                        <?php
                                        $i++;
                                    }
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="8" class="w3-center theme_text"><b>No Requests.</b></td>
                                </tr>
                            <?php } ?>                       
                            </tbody>
                        </table>
                    </div>
                </div>
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
                //console.log(response);
                //return false;
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
<script>
// ----function to open modal product------//
    function openHelp(modal_id) {
        var modal = $('#RFIModal_' + modal_id);
        modal.addClass('in');
        //getComments(modal_id);
        $('.comment_msg').html('');

    }

    //--------Reject query
    function deleteRequest(request_id) {
        $.confirm({
            title: '<h4 class="w3-text-red">Please confirm the action!</h4><span class="w3-medium">Do you really want to Delete this Request?</span>',
            content: '',
            type: 'red',
            buttons: {
                confirm: function () {
                    $.ajax({
                        type: "GET",
                        url: BASE_URL + "modules/request_module/deleteRequest",
                        data: {
                            request_id: request_id
                        },
                        cache: false,
                        success: function (response) {
                            // alert(response);
                            var data = JSON.parse(response);
                            switch (data.status) {
                                case 'success':
                                    $('#message').html(data.message);
                                    break;
                                case 'error':
                                    $('#message').html(data.message);
                                    break;
                                default:
                                    $('#message').html('<div class="alert alert-danger alert-dismissible" style="margin-bottom:5px"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><b>Error:</b> Something went wrong! Try refreshing page and Save again.!</strong></div>');
                                    setTimeout(function () {
                                        $('.alert_message').fadeOut('fast');
                                    }, 8000); // <-- time in milliseconds
                                    break;
                            }
                        }
                    });
                },
                cancel: function () {
                }
            }
        });
    }
</script> 
