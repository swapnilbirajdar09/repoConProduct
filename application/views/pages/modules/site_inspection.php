<!-- page content --> 
<style type="text/css">
    /* ================ The Timeline ================ */

    .timeline {
        position: relative;
        width: 660px;
        margin: 0 auto;
        margin-top: 20px;
        padding: 1em 0;
        list-style-type: none;
    }

    .timeline:before {
        position: absolute;
        left: 50%;
        top: 0;
        content: ' ';
        display: block;
        width: 6px;
        height: 100%;
        margin-left: -3px;
        background: rgb(80,80,80);
        background: -moz-linear-gradient(top, rgba(80,80,80,0) 0%, rgb(80,80,80) 8%, rgb(80,80,80) 92%, rgba(80,80,80,0) 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(30,87,153,1)), color-stop(100%,rgba(125,185,232,1)));
        background: -webkit-linear-gradient(top, rgba(80,80,80,0) 0%, rgb(80,80,80) 8%, rgb(80,80,80) 92%, rgba(80,80,80,0) 100%);
        background: -o-linear-gradient(top, rgba(80,80,80,0) 0%, rgb(80,80,80) 8%, rgb(80,80,80) 92%, rgba(80,80,80,0) 100%);
        background: -ms-linear-gradient(top, rgba(80,80,80,0) 0%, rgb(80,80,80) 8%, rgb(80,80,80) 92%, rgba(80,80,80,0) 100%);
        background: linear-gradient(to bottom, rgba(80,80,80,0) 0%, rgb(80,80,80) 8%, rgb(80,80,80) 92%, rgba(80,80,80,0) 100%);

        z-index: 5;
    }

    .timeline li {
        padding: 1em 0;
    }

    .timeline li:after {
        content: "";
        display: block;
        height: 0;
        clear: both;
        visibility: hidden;
    }

    .direction-l {
        position: relative;
        width: 300px;
        float: left;
        text-align: right;
    }

    .direction-r {
        position: relative;
        width: 300px;
        float: right;
    }

    .flag-wrapper {
        position: relative;
        display: inline-block;

        text-align: center;
    }

    .flag {
        position: relative;
        display: inline;
        background: rgb(248,248,248);
        padding: 6px 10px;
        border-radius: 5px;

        font-weight: 600;
        text-align: left;
    }

    .direction-l .flag {
        -webkit-box-shadow: -1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
        -moz-box-shadow: -1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
        box-shadow: -1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
    }

    .direction-r .flag {
        -webkit-box-shadow: 1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
        -moz-box-shadow: 1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
        box-shadow: 1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
    }

    .direction-l .flag:before,
    .direction-r .flag:before {
        position: absolute;
        top: 50%;
        right: -40px;
        content: ' ';
        display: block;
        width: 12px;
        height: 12px;
        margin-top: -10px;
        background: #fff;
        border-radius: 10px;
        border: 4px solid rgb(255,80,80);
        z-index: 10;
    }

    .direction-r .flag:before {
        left: -40px;
    }

    .direction-l .flag:after {
        content: "";
        position: absolute;
        left: 100%;
        top: 50%;
        height: 0;
        width: 0;
        margin-top: -8px;
        border: solid transparent;
        border-left-color: rgb(248,248,248);
        border-width: 8px;
        pointer-events: none;
    }

    .direction-r .flag:after {
        content: "";
        position: absolute;
        right: 100%;
        top: 50%;
        height: 0;
        width: 0;
        margin-top: -8px;
        border: solid transparent;
        border-right-color: rgb(248,248,248);
        border-width: 8px;
        pointer-events: none;
    }

    .time-wrapper {
        display: inline;

        line-height: 1em;
        font-size: 12px;
        color: rgb(250,80,80);
        vertical-align: middle;
    }

    .direction-l .time-wrapper {
        float: left;
    }

    .direction-r .time-wrapper {
        float: right;
    }

    .time {
        display: inline-block;
        padding: 4px 6px;
        background: rgb(248,248,248);
    }

    .desc {
        margin: 3px 5px;

        font-size: 12px;
        font-style: italic;
        line-height: 1.5em;
    }

    .direction-r .desc {
        margin: 3px 5px;
    }

    /* ================ Timeline Media Queries ================ */

    @media screen and (max-width: 660px) {

        .timeline {
            width: 100%;
            padding: 4em 0 1em 0;
        }

        .timeline li {
            padding: 2em 0;
        }

        .direction-l,
        .direction-r {
            float: none;
            width: 100%;

            text-align: center;
        }

        .flag-wrapper {
            text-align: center;
        }

        .flag {
            background: rgb(255,255,255);
            z-index: 15;
        }

        .direction-l .flag:before,
        .direction-r .flag:before {
            position: absolute;
            top: -30px;
            left: 50%;
            content: ' ';
            display: block;
            width: 12px;
            height: 12px;
            margin-left: -9px;
            background: #fff;
            border-radius: 10px;
            border: 4px solid rgb(255,80,80);
            z-index: 10;
        }

        .direction-l .flag:after,
        .direction-r .flag:after {
            content: "";
            position: absolute;
            left: 50%;
            top: -8px;
            height: 0;
            width: 0;
            margin-left: -8px;
            border: solid transparent;
            border-bottom-color: rgb(255,255,255);
            border-width: 8px;
            pointer-events: none;
        }

        .time-wrapper {
            display: block;
            position: relative;
            margin: 4px 0 0 0;
            z-index: 14;
        }

        .direction-l .time-wrapper {
            float: none;
        }

        .direction-r .time-wrapper {
            float: none;
        }

        .desc {
            position: relative;
            margin: 1em 0 0 0;
            padding: 1em;
            background: rgb(245,245,245);
            -webkit-box-shadow: 0 0 1px rgba(0,0,0,0.20);
            -moz-box-shadow: 0 0 1px rgba(0,0,0,0.20);
            box-shadow: 0 0 1px rgba(0,0,0,0.20);

            z-index: 15;
        }

        .direction-l .desc,
        .direction-r .desc {
            position: relative;
            margin: 1em 1em 0 1em;
            padding: 1em;

            z-index: 15;
        }

    }

    @media screen and (min-width: 400px ?? max-width: 660px) {

        .direction-l .desc,
        .direction-r .desc {
            margin: 1em 4em 0 4em;
        }

    }
</style>
<div class="right_col" role="main" ng-app="siteApp" ng-cloak ng-controller="siteCtrl">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Site Inspection Controller </h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">

            <!-- view all checklist div -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-list"></i> Checklist Timeline</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="container x_content">
                        <div class="col-md-4">
                            <form method="POST" action="<?php echo base_url(); ?>modules/site_inspection">
                                <label>Select Work Item / Building</label>
                                <select class="w3-input w3-margin-bottom" name="selected_witem" id="selected_witem">
                                    <option value="0" class="w3-light-grey">Choose Work Item / Building first</option>
                                    <?php
                                    if ($allWitems) {
                                        foreach ($allWitems as $key) {
                                            $selected = '';
                                            if (isset($_POST['selected_witem']) && $_POST['selected_witem'] == $key['witem_id']) {
                                                $selected = 'selected';
                                            }
                                            echo '<option value="' . $key['witem_id'] . '" ' . $selected . '>' . $key['witem_name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <button type="submit" class="btn theme_bg w3-margin-bottom"><i class="fa fa-refresh"></i> Fetch Checklist Details</button>
                            </form>
                        </div>
                        <div id="checklistmsg"></div>
                        <div class="w3-col l12 w3-margin-top" style="height: 450px;overflow-y: scroll;">
                            <?php
                            if (isset($checklistDetails) && $checklistDetails) {
                                ?>
                                <div class="col-md-4 col-md-offset-4 col-xs-12 col-sm-12 w3-center w3-margin-bottom w3-xlarge w3-light-grey ">
                                    <span class="w3-padding"><?php echo $checklistDetails[0]['witem_name']; ?> CHECKLIST</span>
                                </div>
                                <br><br>
                                <!-- The Timeline -->
                                <ul class="timeline">
                                    <?php
                                    $count = '0';
                                    $direction = 'direction-l';
                                    foreach ($checklistDetails as $key) {
                                        $dtime = new DateTime($key['modified_date']);
                                        $dated = $dtime->format("d M Y h:i a");
                                        if ($count == '1') {
                                            $direction = 'direction-r';
                                            $count = '0';
                                        } else {
                                            $direction = 'direction-l';
                                            $count = '1';
                                        }
                                        ?>
                                        <li>
                                            <div class="<?php echo $direction; ?>">
                                                <div class="flag-wrapper">
                                                    <span class="flag" title="Slab Cycle Checklist">SSC: <span class="w3-large">Day <?php echo $key['day']; ?></span></span><br>
                                                </div>
                                                <div class="desc w3-medium"><i class="fa fa-check-circle"></i> <?php echo $key['activity_name']; ?></div>
                                                <div class="desc"><i class="fa fa-quote-left"></i> <?php echo $key['comments']; ?> <i class="fa fa-quote-right"></i></div>
                                                <div class="desc">
                                                    <?php
                                                    $user_role = $this->session->userdata('role');
                                                    if ($user_role == 'company_admin') {
                                                        $user_name = $this->session->userdata('usersession_name');
                                                    } else {
                                                        $user_name = $this->session->userdata('user_name');
                                                    }
                                                    if ($key['status'] == '0' || $key['status'] == '2') {
                                                        ?>
                                                        <a class="btn btn-sm w3-text-grey w3-hover-text-black" style="padding: 2px 5px;background-color: #DDDDDD" id="markBtn_<?php echo $key['activity_id']; ?>" data-toggle="modal" data-target="#ActModal_<?php echo $key['activity_id']; ?>" onclick="openHelp('ActModal_<?php echo $key['activity_id']; ?>')"><i class="fa fa-check-circle"></i> Mark as Done</a>
                                                        <?php
                                                    } else {
                                                        ?> 
                                                        <a class="btn btn-sm w3-text-grey w3-hover-text-black" style="padding: 2px 5px;background-color: #DDDDDD" id="markBtn_<?php echo $key['activity_id']; ?>" onclick="mark('<?php echo base64_encode($key['activity_id']); ?>', 'undone', '<?php echo $key['activity_id']; ?>')"><i class="fa fa-times-circle"></i> Unmark as Done</a>
                                                    <?php } ?>                                                   
                                                    <a class="btn btn-sm w3-text-grey w3-hover-text-black"  style="padding: 2px 5px;background-color: #DDDDDD" data-toggle="modal" data-target="#Reportissue_<?php echo $key['activity_id']; ?>" onclick="openHelp('Reportissue_<?php echo $key['activity_id']; ?>')"><i class="fa fa-warning"></i> Report Issue</a>

                                                </div>
                                            </div>
                                        </li>
                                        <!--Modal to upload images and comment--> 
                                        <div class="modal fade bs-example-modal-lg" id="ActModal_<?php echo $key['activity_id']; ?>" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-md ">
                                                <!--Modal content starts -->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                        </button>
                                                        <h4 class="modal-title">
                                                            <i class="fa fa-check-circle"></i> <?php echo $key['activity_name']; ?> <span class="badge w3-grey w3-text-white w3-small"><?php echo $key['witem_name']; ?></span>
                                                        </h4>
                                                    </div>
                                                    <!--Modal body starts -->
                                                    <div class="modal-body">
                                                        <!--Modal container starts -->
                                                        <div class="container"> 
                                                            <div class="col-md-12">
                                                                <div class="w3-col l5 w3-left w3-small w3-text-grey">
                                                                    <span title="Slab Cycle Checklist">SSC: <b>Day <?php echo $key['day']; ?></b></span>
                                                                </div>
                                                                <div class="w3-col l7 w3-right w3-small w3-text-grey">
                                                                    <span class="w3-right">Last modified by <b><?php echo $key['modified_by']; ?></b> on <b><?php echo $dated; ?></b></span>
                                                                </div>                                                     
                                                                <br><br>
                                                                <div class="w3-col l12 w3-margin-bottom w3-margin-top" style="display: inline;">

                                                                    <?php
                                                                    if ($key['status'] == '0' || $key['status'] == '2') {
                                                                        ?>
                                                                        <a class="btn btn-md btn-block btn-success" onclick="mark('<?php echo base64_encode($key['activity_id']); ?>', 'done', '<?php echo $key['activity_id']; ?>')"> <i class="fa fa-check-square"></i> Mark this Checklist as Done</a>
                                                                        <?php
                                                                    } else {
                                                                        ?> 
                                                                        <a class="btn btn-md btn-block btn-danger" onclick="mark('<?php echo base64_encode($key['activity_id']); ?>', 'undone', '<?php echo $key['activity_id']; ?>')"> <i class="fa fa-check-square"></i> Unmark this Checklist as Done</a>
                                                                    <?php } ?> 
                                                                    <hr>
                                                                </div>
                                                            </div>
                                                            <a class="btn" data-toggle="collapse" data-target="#uploadImageDiv_<?php echo $key['activity_id']; ?>"><i class="fa fa-chevron-circle-down"></i> Upload Images here</a>
                                                            <div id="uploadImageDiv_<?php echo $key['activity_id']; ?>" class="collapse">
                                                                <div class="col-md-12">                                     
                                                                    <div class="w3-col l12 w3-padding-small" style="background-color: #F7F7F7">
                                                                        <h4><i class="fa fa-file-image-o"></i> Upload Images</h4>
                                                                        <form id="uploadChecklistImage_<?php echo $key['activity_id']; ?>" onsubmit="checklistImageForm('<?php echo $key['activity_id']; ?>')" enctype="multipart/form-data">
                                                                            <input type="hidden" name="activity_id_upload" value="<?php echo base64_encode($key['activity_id']); ?>">
                                                                            <div class="col-lg-6">
                                                                                <label>Select Image: <font color ="red"><span id ="simage_star">* (less than 10MB)</span></font></label>
                                                                                <input type="file" name="checklist_image" id="checklist_image_<?php echo $key['activity_id']; ?>" class="w3-input w3-margin-bottom w3-border" style="padding:5px" required>                 
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <label>Comment (If any): </label>
                                                                                <textarea name="checklist_comment" class="w3-input w3-margin-bottom w3-border" rows="3" placeholder="Enter comment here, if any"><?php echo $key['comments']; ?></textarea>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <button type="submit" title="upload file" id="uploadFilebtn_<?php echo $key['activity_id']; ?>" class="btn theme_bg" ><i class="fa fa-upload"></i> Save and Upload Image</button>
                                                                            </div>
                                                                        </form>
                                                                        <div id="uploadImageMsg_<?php echo $key['activity_id']; ?>"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <hr>
                                                                    <div class="w3-col l12 w3-padding-small">
                                                                        <h4><i class="fa fa-picture-o"></i> Uploaded Images</h4>
                                                                    </div>
                                                                    <div class="w3-col l12 w3-margin-bottom" id="allImagesDiv_<?php echo $key['activity_id']; ?>">
                                                                        <?php
                                                                        if ($key['images'] != '' && $key['images'] != '[]') {
                                                                            $image_arr = json_decode($key['images']);
                                                                            foreach ($image_arr as $img => $file) {
                                                                                $arr = explode('/', $file);
                                                                                ?>
                                                                                <div class="col-md-4 col-sm-12 col-xs-12" style="vertical-align: middle;">
                                                                                    <div class="image view view-first" style="height: 150px;">
                                                                                        <img style="width: 100%;height: 100%;vertical-align: middle;" class="img img-thumbnail" src="<?php echo base_url() . $file; ?>" alt="image">
                                                                                        <div class="mask no-caption">
                                                                                            <div class="tools" style="margin: 20px 0">
                                                                                                <a class="btn w3-small" target="_blank" title="View image" href="<?php echo base_url(); ?><?php echo $file; ?>" style="padding:4px;display: inline-block;" ><i class="fa fa-download"></i> View Image</a>
                                                                                            </div>
                                                                                            <div class="tools" style="margin: 20px 0">
                                                                                                <a class="btn w3-small" onclick="removeImageInfo('<?php echo $img; ?>', '<?php echo $key['activity_id']; ?>')" id="image_<?php echo $key['activity_id']; ?>" title="Delete image" style="padding:4px;display: inline-block;" ><i class="fa fa-close"></i> Delete Image</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <?php
                                                                            }
                                                                        } else {
                                                                            ?>
                                                                            <div class="w3-col l12"> 
                                                                                <center><label><i class="fa fa-warning"></i> No Images uploaded !</label></center>
                                                                            </div>
                                                                        <?php } ?>
                                                                        <div id="deleteImageMsg_<?php echo $key['activity_id']; ?>"></div>
                                                                    </div>
                                                                </div> 
                                                            </div>

                                                        </div>
                                                        <!--Modal container ends -->
                                                    </div>
                                                    <!--Modal Body ends -->
                                                </div>
                                                <!--Modal contenet ends -->
                                            </div>
                                        </div>
                                        <!--Modal ends here -->

                                        <!--Modal to report issue comment--> 
                                        <div class="modal fade bs-example-modal-lg" id="Reportissue_<?php echo $key['activity_id']; ?>" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-md ">
                                                <!--Modal content starts -->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                        </button>
                                                        <h4 class="modal-title">
                                                            <i class="fa fa-check-circle"></i> <?php echo $key['activity_name']; ?> <span class="badge w3-grey w3-text-white w3-small"><?php echo $key['witem_name']; ?></span>
                                                        </h4>
                                                    </div>
                                                    <!--Modal body starts -->
                                                    <div class="modal-body">
                                                        <!--Modal container starts -->
                                                        <div class="container"> 
                                                            <div class="col-md-12">
                                                                <div class="w3-col l5 w3-left w3-small w3-text-grey">
                                                                    <span title="Slab Cycle Checklist">SSC: <b>Day <?php echo $key['day']; ?></b></span>
                                                                </div>
                                                                <div class="col-lg-12 w3-medium">
                                                                    <hr>
                                                                    <form id="rfiReply_form_<?php echo $key['activity_id']; ?>">
                                                                        <div class="w3-col l12 w3-round w3-light-grey w3-padding w3-margin-bottom">
                                                                            <div class="w3-col l6">
                                                                                <label>Query Title</label>
                                                                                <input type="text" name="query_title" class="w3-input" >
                                                                                <input type="hidden" name="activity_id" class="w3-input" value="<?php echo $key['activity_id']; ?>">
                                                                            </div>
                                                                            <div class="w3-col l6 w3-padding">
                                                                                <label>Shared With :</label> <br>
                                                                                <?php
                                                                                if ($roles['status'] == 200) {
                                                                                    foreach ($roles['status_message'] as $val) {
                                                                                        ?>
                                                                                        <input type="checkbox" checked id="shared_with" name="shared_with[]" value="<?php echo $val['role_id']; ?>"> <?php echo $val['role_name']; ?><br>
                                                                                        <?php
                                                                                    }
                                                                                } else {
                                                                                    echo '<span class="w3-light-grey">No Roles Are Available</span>';
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                            <label>Description: </label>
                                                                            <textarea name="comment_posted" id="comment_posted" class="w3-input w3-margin-bottom" rows="2" placeholder="Type here to reply..." required></textarea>

                                                                            <div id="comment_msg" class="comment_msg"></div>
                                                                            <?php // echo $key['activity_id']; ?>
                                                                            <button id="commentBtn" class="btn theme_bg btn-small w3-small pull-right" onclick="raiseQuery(<?php echo $key['activity_id']; ?>);" type="button">Submit</button>
                                                                      <!--       <button id="commentBtn" class="btn theme_bg btn-small w3-small pull-right" onclick="savecomment('<?php echo $key['activity_id']; ?>');" type="button"><i class="fa fa-reply"></i> Post Comment</button> -->
                                                                        </div>
                                                                    </form>
                                                                      <!--  <div class="w3-col l12 w3-small comment_list" id="comment_list_<?php echo $key['activity_id']; ?>">
                                                                            </div> -->
                                                                </div>
                                                                <div class="w3-col l7 w3-right w3-small w3-text-grey">
                                                                </div>                                                     
                                                                <br><br>
                                                                <div class="w3-col l12 w3-margin-bottom w3-margin-top" style="display: inline;">
                                                                    <hr>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--Modal container ends -->
                                                    </div>
                                                    <!--Modal Body ends -->
                                                </div>
                                                <!--Modal contenet ends -->
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                <?php
                            } else {
                                ?>
                                <div class="col-md-12 col-xs-12 col-sm-12 w3-text-grey">
                                    <span><i class="fa fa-warning w3-large"></i> <b>Warning!</b> No Checklist Available for selected Work Item / Building.</span>
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- view all document div ends -->
        </div>
    </div>
</div>
<script>
    // update changes of document
    function raiseQuery(activity_id) {
       
        dataString = $("#rfiReply_form_" + activity_id).serialize();
        //alert(dataString);
        $.ajax({
            url: BASE_URL + "modules/site_inspection/raiseQueryForChecklistFailure", // point to server-side PHP script
            data: dataString,
            type: 'POST',
            dataType: 'text',
            beforeSend: function () {
                $('#commentBtn').prop('disabled', true);
                $('#commentBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i> Submitting..');
            },
            success: function (response) {
                console.log(response);
                $('#commentBtn').prop('disabled', false);
                $('#commentBtn').html('Submit');
                var data = JSON.parse(response);
                // response message
                switch (data.status) {
                    case 'success':
                        $('#comment_msg').html(data.message);
                        setTimeout(function () {
                            window.location.reload();
                        }, 1500); // <-- time in milliseconds 
                        break;

                    case 'error':
                        $('#comment_msg').html(data.message);
                        setTimeout(function () {
                            $('.alert').fadeOut('fast');
                        }, 10000); // <-- time in milliseconds
                        break;

                    case 'validation':
                        $('#comment_msg').html(data.message);

                        setTimeout(function () {
                            $('.alert').fadeOut('fast');
                        }, 8000); // <-- time in milliseconds
                        break;
                    default:
                        $('#comment_msg').html('<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Fatal Error-</strong> Something went wrong. Please Logout your account and Try Logging in again.</div>');
                        setTimeout(function () {
                            $('.alert').fadeOut('fast');
                        }, 8000); // <-- time in milliseconds
                        break;
                }
            },
            error: function (data) {
                $('#commentBtn').prop('disabled', false);
                $('#comment_msg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
                $('#commentBtn').html('Submit');
                window.setTimeout(function () {
                    $(".alert").fadeTo(500, 0).slideUp(500, function () {
                        $(this).remove();
                    });
                }, 5000);
            }
        });
        return false;  //stop the actual form post !important!
    }
    ;



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
                    <input type="file" name="image[]" id="image" class="w3-input w3-border" onchange="readURLNEW(this,' + x + ');" required>\n\
                    </div>\n\
                    <div class="w3-col l6 w3-padding-small">\n\
                    <img src="<?php echo base_url(); ?>assets/images/no-image-selected.png" width="auto" id="ImagePreview_' + x + '" height="150px" alt="Image will be displayed here once chosen." class=" w3-center img img-thumbnail" width="auto" height="150px">\n\
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


    // preview images
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#ImagePreview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // ------------function preview image end------------------//
    function readURLNEW(input, id) {
        //alert(id);
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#ImagePreview_' + id).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
<script src="<?php echo base_url(); ?>assets/js/module/user/sitecontroller.js"></script>

