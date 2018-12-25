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
                                            $selected='';
                                            if(isset($_POST['selected_witem']) && $_POST['selected_witem']==$key['witem_id']){
                                                $selected='selected';
                                            }
                                            echo '<option value="' . $key['witem_id'] . '" '.$selected.'>' . $key['witem_name'] . '</option>';
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
                                    <span class="w3-padding"><?php echo $key['witem_name']; ?> CHECKLIST</span>
                                </div>
                                <br><br>
                                <!-- The Timeline -->
                                <ul class="timeline">
                                    <?php

                                    $count = '0';
                                    $direction = 'direction-l';
                                    foreach ($checklistDetails as $key) {
                                        $dtime = new DateTime($key['created_date']);
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
                                                <div class="desc"><?php echo $key['comments']; ?></div>
                                                <div class="desc">
                                                  <!-- <a class="btn btn-sm w3-text-grey w3-hover-text-black" style="padding: 2px 5px;background-color: #DDDDDD" href="<?php echo base_url(); ?>modules/site_inspection/view_checklist/<?php echo base64_encode($key['activity_id']); ?>"><i class="fa fa-edit"></i> View</a> -->
                                                  <?php
                                                  $user_role = $this->session->userdata('role');
                                                  if ($user_role == 'company_admin') {
                                                    $user_name = $this->session->userdata('usersession_name');
                                                } else {
                                                    $user_name = $this->session->userdata('user_name');
                                                }
                                                if ($key['status']=='0' || $key['status']=='2') {
                                                    ?>
                                                    <a class="btn btn-sm w3-text-grey w3-hover-text-black" style="padding: 2px 5px;background-color: #DDDDDD" id="markBtn_<?php echo $key['activity_id']; ?>" onclick="mark('<?php echo base64_encode($key['activity_id']); ?>', 'done', '<?php echo $key['activity_id']; ?>')"><i class="fa fa-check-circle"></i> Mark as Done</a>
                                                <?php }
                                                else{
                                                ?> 
                                                <a class="btn btn-sm w3-text-grey w3-hover-text-black" style="padding: 2px 5px;background-color: #DDDDDD" id="markBtn_<?php echo $key['activity_id']; ?>" onclick="mark('<?php echo base64_encode($key['activity_id']); ?>', 'undone', '<?php echo $key['activity_id']; ?>')"><i class="fa fa-times-circle"></i> Unmark as Done</a>
                                                <?php } ?>                                                   
                                                    <a class="btn btn-sm w3-text-grey w3-hover-text-black" id="delBtn_<?php echo $key['activity_id']; ?>" style="padding: 2px 5px;background-color: #DDDDDD" onclick="removeActivity('<?php echo base64_encode($key['activity_id']); ?>', '<?php echo $key['activity_id']; ?>')"><i class="fa fa-warning"></i> Report Issue</a>
                                                
                                            </div>
                                        </div>
                                    </li>

                                    <?php
                                }
                           
                            ?>
                        </ul>
                        <?php
                    }
                        else {
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

