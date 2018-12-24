<title>Raise Query | Construction Manager</title>
<div class="right_col" role="main">
    <div class="row x_title">
        <div class="col-md-6">
            <h3><i class="fa fa-check"></i> Raise Query For Information(RFI) </h3>
        </div>
    </div> 
    <div class="row w3-padding-small page_title">
        <div class="w3-col l12 w3-margin-left w3-padding-small w3-center" id="message"></div>
        <form id="raiseQueryForm" name="raiseQueryForm" method="post">
            <div class="w3-col l12 s12 m12 w3-margin-top">
                <div class="col-lg-6 w3-padding-small" id="deletecat">
                    <div class="w3-col l12 s12 m12 w3-padding-bottom">
                        <label> Query Title: <font color ="red"><span id ="pname_star">*</span></font></label><br>
                        <font color ="red"><span id ="product_name_span"></span></font>
                        <input type="text" name="queryTitle" id="queryTitle" value="" placeholder="Query Title" class="w3-input w3-border w3-margin-bottom" required>
                    </div>                           
                    <!-- kk -->
                    <div class="w3-col l12 s12 m12 w3-padding-bottom">
                        <label> Query Description: <font color ="red"><span id ="pdescription_star">*</span></font></label><br>
                        <font color ="red"><span id ="product_description_span"></span></font>
                        <textarea class="w3-input w3-border w3-margin-bottom" placeholder="Query Description" name="queryDescription" id="queryDescription" rows="5" cols="50" style="resize: none;" required></textarea>
                    </div>
                       <div class="w3-col l12 s12 m12 w3-padding-bottom">
                          <label>Raised To : <font color ="red"><span id ="pdescription_star">*</span></font></label>
                         <select class="w3-input" name="role_type" id="role_type" style="border-bottom-color: #CCCCCC">
                          <option value="0" class="w3-light-grey">Select Role</option>
                           <?php
                           //print_r($allrole_types);die();
                             if ($allrole_types) {
                              foreach ($allrole_types as $key) {
                            ?>
                            <option value="<?php echo $key['role_name']; ?>"><?php echo $key['role_name']; ?></option>
                            <?php
                              }
                             }
                            ?>
                          </select>
                       </div>
                    <!-- kk -->                            
                </div>
                <!-- ---div for images -->
                <div class="col-lg-6 w3-padding-tiny" id="deletecat">
                    <div class="w3-col l12 s12 m12">
                        <div class="w3-col l6 ">
                            <label>Images:</label>
                            <input type="file" name="prod_image[]" id="prod_image" class="w3-input w3-border" onchange="readURL(this);">
                        </div>
                        <div class="w3-col l6 w3-padding-small w3-margin-top">
                            <img src="" width="auto" id="adminImagePreview" height="150px" alt="Image will be displayed here once chosen." class=" w3-center img img-thumbnail">
                        </div>
                        <div class="w3-col l12 s12 m12" id="addedmore_imageDiv"></div>
                        <div class="w3-col l12 w3-margin-bottom">
                            <a id="add_moreimage" title="Add new Image" class="btn w3-text-red add_moreProduct w3-small w3-right w3-margin-top"><b>Add image <i class="fa fa-plus"></i></b>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- ---div for images -->
            </div>                   
            <div class="w3-col l12 w3-center" id="btnsubmit">
                <button id="raiseQry" type="submit" title="Raise Query" class="w3-margin w3-medium w3-button theme_bg">Raise Query</button>
            </div>
        </form>
    </div>
    <div class="row">
    	<div class="w3-col l12 w3-padding-small w3-margin-top page_title">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-list"></i> All Approved Queries</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="container x_content">
                <div id="table_msg"></div>
                <div class="w3-col l12 w3-padding w3-small" id="allDocumentDiv">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr >
                                <th class="text-center">Sr.No</th>
                                <th class="text-center">Query Title</th>
                                <th class="text-center">Query Raised To</th> 
                                <th class="text-center">Created Date</th>                        
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //print_r($queries);
                            $i = 1;
                            if ($queries['status'] != 500) {
                                foreach ($queries['status_message'] as $val) {
                                    ?>
                                    <tr class="w3-center">
                                        <td style=" vertical-align: middle;"><?php echo $i; ?></td>
                                        <td style=" vertical-align: middle; width: 350px;"><?php echo $val['query_title']; ?></td>
                                        <td style=" vertical-align: middle; width: 200px;"><p><?php echo $val['raised_to']; ?></p></td>  
                                          <td style=" vertical-align: middle; width: 450px;"><p><?php echo date('d F Y', strtotime($val['created_date'])) ?></p></td>                                    
                                        <td style=" vertical-align: middle;">
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" id="actionBtn_<?php echo $val['query_id']; ?>" class="btn btn-default w3-small dropdown-toggle" type="button" style="padding: 2px 6px">Action <span class="caret"></span>
                                                </button>
                                                <ul role="menu" class="dropdown-menu pull-right">              
                                                    <li>
                                                        <a title="View Query" class="btn btn-xs text-left" data-toggle="modal" data-target="#RFIModal_<?php echo $val['query_id']; ?>" onclick="openHelp('<?php echo $val['query_id']; ?>')">View Query</a>
                                                    </li>
                                                    <?php
                                                    $user_role = $this->session->userdata('role');
                                                    if ($user_role == 'company_admin') {
                                                        $user_name = $this->session->userdata('usersession_name');
                                                    } else {
                                                        $user_name = $this->session->userdata('user_name');
                                                    }
                                                    if ($user_role == 'company_admin' || $user_name == $val['created_by']) {
                                                        ?>
                                                        <li><a title="Resolved query" class="btn btn-xs text-left" onclick="updateQuery('<?php echo $val['query_id']; ?>');" >Resolved</a>
                                                        </li>
                                                   <!--     <li>
                                                            <a class="btn btn-xs text-left" onclick="removeQuery('<?php echo $val['query_id']; ?>')" title="Delete document">Delete Query</a>
                                                        </li> -->
                                                        <?php
                                                    }
                                                    ?>

                                                </ul>
                                            </div>
                                        </td>
                                    </tr>  
                                    <!-- Modal to View Query -->
                                <div class="modal fade bs-example-modal-lg" id="RFIModal_<?php echo $val['query_id']; ?>" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-md ">
                                        <!-- Modal content View Query -->
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title w3-left w3-margin-left"><b>Query:</b> <?php echo $val['query_title']; ?></h4>
                                            </div>
                                            <!-- Modal body starts -->
                                            <div class="modal-body">
                                                <!-- Modal container starts -->
                                                <div class="container"> 
                                                    <div class="col-lg-12">
                                                        <div class="w3-col l12 w3-padding w3-medium">
                                                            <label>Description: </label>
                                                            <p>                                        
                                                                <?php echo $val['query_description']; ?>
                                                            </p>
                                                        </div>    
                                                         <div class="w3-col l12 w3-padding w3-medium">
                                                            <label>Query Raised To : </label>
                                                            <p>                                        
                                                                <?php echo $val['raised_to']; ?>
                                                            </p>
                                                        </div>                        
                                                        <div class="w3-col l12 w3-margin-bottom w3-padding w3-medium">

                                                          <?php
                                                            if ($val['images'] != '[]' && $val['images'] != '') {
                                                                $image_arr = json_decode($val['images']);
                                                                $count = 1;
                                                                echo '<label>Images: </label><br>';
                                                                foreach ($image_arr as $file) {
                                                                    $arr = explode('/', $file);
                                                                    $filename = $arr[3];
                                                                    $ext_arr = explode('.', $file);
                                                                    $ext = end($ext_arr);
                                                                    ?>
                                                                    <div class="col-md-3">
                                                                        <div class="image view view-first" style="height: 100px">
                                                                            <img style="width: 100%;height:100%" class="img img-thumbnail" src="<?php echo base_url() . $file; ?>" alt="image">
                                                                            <div class="mask no-caption">
                                                                                <div class="tools" style="margin: 20px 0">
                                                                                    <a class="btn w3-small"  target="_self" href="<?php echo base_url() . $file; ?>" title="Download image" download="<?php echo $filename; ?>" style="padding:4px;display: inline-block;" ><i class="fa fa-download"></i> download</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    $count++;
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                      <div class="col-lg-12 w3-medium">
                                                            <hr>
                                                            <label>Comments: </label>
                                                        <form id="rfiReply_form_<?php echo $val['query_id']; ?>">
                                                                <div class="w3-col l12 w3-round w3-light-grey w3-padding w3-margin-bottom">
                                                                    <textarea name="comment_posted" id="comment_posted_<?php echo $val['query_id']; ?>" class="w3-input w3-margin-bottom" rows="2" placeholder="Type here to reply..." required></textarea>
                                                                    <input type="hidden" id="query_id" name="query_id" value="<?php echo $val['query_id']; ?>">
                                                                    <div class="comment_msg"></div>
                                                                    <button id="commentBtn" class="btn theme_bg btn-small w3-small pull-right" onclick="savecomment('<?php echo $val['query_id']; ?>');" type="button"><i class="fa fa-reply"></i> Post Comment</button>
                                                                </div>
                                                            </form>

                                                            <div class="w3-col l12 w3-small comment_list" id="comment_list_<?php echo $val['query_id']; ?>">

                                                            </div>
                                                        </div>
                                                    </div>
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
                        } else {
                            ?>
                            <tr>
                                <td colspan="5" class="w3-center theme_text"><b>No Requests Raised.</b></td>
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
<script src="<?php echo base_url(); ?>assets/js/module/user/requestForInfo.js"></script>
<script>
                                                        $(document).ready(function () {
                                                        var max_fields = 5;
                                                        var wrapper = $("#addedmore_imageDiv");
                                                         var add_button = $("#add_moreimage");
                                                          var x = 1;
                                                         $(add_button).click(function (e) {
                                                                  e.preventDefault();
                                                                        if (x < max_fields) {
                                                                            x++;
                                                                            $(wrapper).append('<div>\n\
                    <div class="w3-col l12 s12 m12 w3-margin-top">\n\
                    <div class="w3-col l6 w3-padding-small">\n\
                    <label>Images:</label>\n\
                    <input type="file" name="prod_image[]" id="prod_image" class="w3-input w3-border" onchange="readURLNEW(this,' + x + ');" required>\n\
                    </div>\n\
                    <div class="w3-col l6 w3-padding-small">\n\
                    <img src="" width="auto" id="adminImagePreview_' + x + '" height="150px" alt=" Image Will Be Displayed Here Once Chosen." class=" w3-center img img-thumbnail">\n\
                    </div>\n\
                    <a href="#" class="delete btn w3-text-black w3-left w3-small" title="remove image">remove <i class="fa fa-remove"></i>\n\
                    </a>\n\
                    </div>\n\
                    </div>'); //add input box
                                                                        } else {
                                                                            $.alert('<label class="w3-label w3-text-red"><i class="fa fa-warning w3-xxlarge"></i> You Reached the maximum limit of adding ' + max_fields + ' fields</label>');   //alert when added more than 4 input fields
                                                                        }
                                                                    });
                                                                    $(wrapper).on("click", ".delete", function (e) {
                                                                        e.preventDefault();
                                                                        $(this).parent('div').remove();
                                                                        x--;
                                                                    });
                                                                });
</script>
<script>
    // ----function to preview selected image for profile------//
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#adminImagePreview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
// ------------function preview image end------------------//
    function readURLNEW(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#adminImagePreview_' + id).attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }


    $(function () {
        $("#raiseQueryForm").submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>modules/raisequery_rfi/raiseQuery",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $('#raiseQry').prop('disabled', true);
                },
                success: function (response) {
                    console.log(response);
                    //alert(response);
                    var data = JSON.parse(response);
                    $('#raiseQry').prop('disabled', false);
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
                            $('#message').html('<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><b>Error:</b> Something went wrong! Try refreshing page and Save again.</strong></div>');
                            break;
                    }
                },
                error: function (response) {
                    // Re_Enabling the Elements
                    $('#raiseQry').prop('disabled', false);
                    $('#message').html('<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><b>Error:</b> Something went wrong! Try refreshing page and Save again.</strong></div>');
                    setTimeout(function () {
                        $('.alert_message').fadeOut('fast');
                    }, 4000); // <-- time in milliseconds  
                }
            });
        });
    });
</script>