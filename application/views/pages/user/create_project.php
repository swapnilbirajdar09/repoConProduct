<title>Construction Manager | Create Project</title>
<?php 
// get project session
$projSession = $this->session->userdata('project_id');
$projArr=explode('|', base64_decode($projSession));
$project_id=$projArr[0];
$project_name=strtoupper($projArr[1]);
?>
<!-- page content -->
<div class="right_col" role="main" ng-app="genericApp" ng-cloak ng-controller="genericCtrl">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Project Generics</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <!-- create new project div -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-diamond"></i> Create new Project</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="container x_content">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <form id="addProjectForm">
                                <div class="col-md-12 col-sm-12 col-xs-12 w3-margin-bottom">
                                    <div class="form-group">
                                        <label for="projectName">Project Title <b class="w3-text-red w3-medium">*</b>: </label>
                                        <input type="text" class="w3-input" id="projectName" name="projectName" placeholder="Enter Project Title Here" required>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12 w3-margin-bottom" >
                                    <div class="form-group w3-col l12">
                                        <label for="projectDesc">Project Description (optional): </label>
                                        <textarea class="w3-input w3-margin-bottom" placeholder="Type a short description about project" name="projectDesc" id="projectDesc" rows="5" cols="50" style="resize: none;"></textarea>
                                    </div>                          
                                </div> 
                                <div class="col-md-12 w3-margin-bottom">
                                    <button id="project_done" class="btn w3-hover-grey theme_bg" type="submit" > Create new Project </button>
                                </div>
                                <div class="w3-col l12" id="errProjectMsg">
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">

                            <div class="col-md-12 col-sm-12 col-xs-12 w3-padding" style="overflow-y: auto;background-color: #F7F7F7">
                                <label>All Projects: </label>
                                <ul style="list-style: none;padding: 0">

                                    <?php
                                    if ($projects['status']!='200') {
                                        ?>
                                        <li class="w3-padding w3-center w3-text-grey">
                                            <b>
                                                No Projects Available
                                            </b>
                                        </li>
                                        <?php
                                    } else {
                                        foreach ($projects['status_message'] as $proj) {
                                            ?>
                                            <li class="w3-border-bottom w3-padding" title="<?php echo $proj['project_description']; ?>">
                                                <div class="w3-row">
                                                    <span>
                                                        <?php echo strtoupper($proj['project_name']); ?>
                                                    </span>
                                                    <?php 
                                                    if($proj['project_id']==$project_id){
                                                        ?>
                                                        <i>(Active Session)</i>
                                                        <?php
                                                    }
                                                    ?>                                                    
                                                </div>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>     

            <!-- set slab cycle div -->
            <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-briefcase"></i> Set Slab Cycles (in days)</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="container x_content">
                    <div class="w3-col l12 w3-margin-top">
                        <form id="addSSCForm">
                            <div class="input-group">
                                <input type="number" name="slab_cycle_count" id="slab_cycle_count" autocomplete="off" class="w3-input" min="0" placeholder="Enter Slab Cycle count" required>
                                <div class="input-group-btn">
                                    <button class="btn w3-button theme_bg" id="addSSCBtn" type="submit">
                                        <i class="fa fa-refresh"></i> Update
                                    </button>
                                </div>
                            </div>
                            <div class="w3-text-red w3-col l12" id="errSSCMsg">
                            </div>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
        </div>

        <!-- add work item list div -->
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-briefcase"></i> Add Work Item</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="container x_content">
                    <div class="w3-col l12 w3-margin-top">
                        <form id="addWitemForm">
                            <div class="input-group">
                                <input type="text" name="work_item" id="work_item" autocomplete="off" class="w3-input" placeholder="Enter Work Item here" required>
                                <div class="input-group-btn">
                                    <button class="btn w3-button theme_bg" id="addWitemBtn" type="submit">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="w3-text-red w3-col l12" id="errWitemMsg">
                            </div>
                        </form>
                    </div>

                    <!-- all work item list div -->
                    <div class="w3-col l12 w3-padding-small" id="allWitemDiv">
                        <div class="w3-col l12 w3-border" style="height: 325px;overflow-y: auto;">
                            <ul style="list-style: none;padding: 0">

                                <?php
                                if (empty($allWitems)) {
                                    ?>
                                    <li class="w3-border-bottom w3-padding w3-center w3-text-red">
                                        <span>
                                            No Work Item Found
                                        </span>
                                    </li>
                                    <?php
                                } else {
                                    foreach ($allWitems as $item) {
                                        ?>
                                        <li class="w3-border-bottom w3-padding">
                                            <div class="w3-row">

                                                <div class="w3-col l10 m10 s10">
                                                    <span>
                                                        <?php echo $item['witem_name']; ?>
                                                    </span>
                                                </div>
                                                <div class="w3-col l2 m2 s2">
                                                    <a onclick="delWitem('<?php echo $item['witem_id']; ?>')" title="Delete Work Item" class="btn" style="padding: 0"><i class="fa fa-close"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- add work item list div ends -->
        <!-- add checklist div -->
        <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-check-circle"></i> Daily Checklist</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="container x_content">
                    <div class="w3-col l12 w3-margin-top" id="addActivityDiv">
                        <form id="addChecklistForm">
                            <div class="w3-col l12">
                                <div class="w3-col l12">
                                    <div class="col-lg-6 col-xs-12 col-sm-12 w3-margin-bottom">
                                        <label>Work Item:</label>
                                        <select class="w3-input" name="work_item_selected" id="work_item_selected">
                                            <option value="0">Choose Work Item first</option>
                                            <?php
                                            if ($allWitems) {
                                                foreach ($allWitems as $key) {
                                                    echo '<option value="' . $key['witem_name'] . '">' . $key['witem_name'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- ---div for images -->
                                    <div class="col-lg-6 w3-padding-tiny">
                                        <div class="w3-col l12 s12 m12">
                                            <div class="w3-col l6 ">
                                                <label>Images:</label>
                                                <input type="file" name="image[]" id="image" class="w3-input w3-border" onchange="readURL(this);">
                                            </div>
                                            <div class="w3-col l6 w3-padding-small w3-margin-top">
                                                <img src="<?php echo base_url(); ?>assets/images/no-image-selected.png" width="auto" id="ImagePreview" height="150px" alt="Image will be displayed here once chosen." class=" w3-center img img-thumbnail">
                                            </div>
                                            <div class="w3-col l12 s12 m12" id="addedmore_imageDiv"></div>
                                            <div class="w3-col l12 w3-margin-bottom">
                                                <a id="add_moreimage" title="Add new Image" class="btn w3-text-red add_moreProduct w3-small w3-right w3-margin-top"><b>Add image <i class="fa fa-plus"></i></b>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ---div for images -->
                                    <div class="col-lg-12 col-xs-12 col-sm-12 w3-margin-bottom">
                                        <label>Enter Activity: (max. 255 chars)</label>
                                        <input type="text" name="activity" style="padding: 5px 2px 5px 5px" class="w3-input" id="activity" placeholder="Enter Activity here." maxlength="255">
                                    </div>
                                    <div class="col-lg-12 col-sm-12 col-xs-12 w3-margin-bottom ">
                                        <label>Comments (if any - optional):</label>
                                        <textarea class="w3-input" name="activity_comment" placeholder="Type here for detailed information" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 w3-center" id="btnsubmit">
                                    <button class="btn w3-button theme_bg" id="addActivityBtn" type="submit"><i class="fa fa-plus"></i> Add Activity </button>
                                </div>
                            </div>

                        </form>
                        <div id="formOutput" class="w3-margin"></div>              
                    </div>
                </div>
            </div>
        </div>
        <!-- add checklist div ends -->

        <!-- view all document div -->
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
                    <div id="checklistmsg"></div>
                    <div class="w3-col l12 w3-margin-top" style="height: 450px;overflow-y: scroll;">
                        <!-- The Timeline -->
                        <ul class="timeline">
                            <?php
                            if ($allActivities) {
                                $count = '0';
                                $direction = 'direction-l';
                                foreach ($allActivities as $key) {
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
                                                <span class="flag"><?php echo $key['work_item']; ?></span>
                                                <span class="time-wrapper"><span class="time"><?php echo $dated; ?></span></span>
                                            </div>
                                            <div class="desc w3-small w3-text-grey"><b>by <?php echo $key['created_by']; ?></b></div>
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
                                            if ($user_role == 'company_admin' || $user_name == $key['created_by']) {
                                                ?>
                                                <a class="btn btn-sm w3-text-grey w3-hover-text-black" style="padding: 2px 5px;background-color: #DDDDDD" href="<?php echo base_url(); ?>modules/site_inspection/edit_checklist/<?php echo base64_encode($key['activity_id']); ?>"><i class="fa fa-edit"></i> Edit</a>

                                                <a class="btn btn-sm w3-text-grey w3-hover-text-black" id="delBtn_<?php echo $key['activity_id']; ?>" style="padding: 2px 5px;background-color: #DDDDDD" onclick="removeActivity('<?php echo base64_encode($key['activity_id']); ?>', '<?php echo $key['activity_id']; ?>')"><i class="fa fa-trash"></i> Delete</a>
                                            <?php }?>
                                        </div>
                                    </div>
                                </li>

                                <?php
                            }
                        } else {
                            ?>
                            <?php
                        }
                        ?>

                    </ul>

                </div>
            </div>
        </div>
    </div>
    <!-- view all document div ends -->
</div>
</div>
</div>
<script src="<?php echo base_url(); ?>assets/js/module/user/genericsetting.js"></script>
