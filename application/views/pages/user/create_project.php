<title>Construction Manager | Create Project</title>
<?php
// get project session
$projSession = $this->session->userdata('project_id');
$projArr = explode('|', base64_decode($projSession));
$project_id = $projArr[0];
$project_name = strtoupper($projArr[1]);
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
                                    if ($projects['status'] != '200') {
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
                                                    if ($proj['project_id'] == $project_id) {
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
                <div class="w3-col l12">
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
                                        <input type="number" name="slab_cycle_count" id="slab_cycle_count" autocomplete="off" class="w3-input" min="0" placeholder="Enter Slab Cycle count" value="<?php
                                        if ($slab_cycle[0]['slab_cycles'] != '0') {
                                            echo $slab_cycle[0]['slab_cycles'];
                                        }
                                        ?>" required>
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
                <div class="w3-col l12">

                    <div class="x_panel">
                        <div class="x_title">
                            <h2><i class="fa fa-briefcase"></i> Add Work Item / Building </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="container x_content">
                            <div class="w3-col l12 w3-margin-top">
                                <form id="addWitemForm">
                                    <div class="input-group">
                                        <input type="text" name="work_item" id="work_item" autocomplete="off" class="w3-input" placeholder="Enter Work Item / Building here" required>
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
                                <div class="w3-col l12 w3-border" style="max-height: 250px;overflow-y: auto;">
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

            </div>

            <!-- add work item list div -->
            <div class="col-md-8 col-sm-12 col-xs-12">

                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-check-circle"></i> Add Checklist</h2>
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
                                            <label>Work Item / Building:</label>
                                            <select class="w3-input" name="work_item_selected" id="work_item_selected">
                                                <option value="0" class="w3-light-grey">Choose Work Item / Building first</option>
                                                <?php
                                                if ($allWitems) {
                                                    foreach ($allWitems as $key) {
                                                        echo '<option value="' . $key['witem_id'] . '">' . $key['witem_name'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-xs-12 col-sm-12 w3-margin-bottom">
                                            <label>Select Day:</label>
                                            <select class="w3-input" name="day_selected" id="day_selected">
                                                <option value="0" class="w3-light-grey">Choose any one day</option>
                                                <?php
                                                if ($slab_cycle[0]['slab_cycles'] != '0' && $slab_cycle[0]['slab_cycles'] != '') {
                                                    for ($i = 1; $i <= $slab_cycle[0]['slab_cycles']; $i++) {
                                                        echo '<option value="' . $i . '"> Day-' . $i . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <?php
                                            if ($slab_cycle[0]['slab_cycles'] == '0' || $slab_cycle[0]['slab_cycles'] == '') {
                                                echo '<label class="w3-text-red"><i class="fa fa-chevron-left"></i> NOTE: Please set Slab Cycle first!</label>';
                                            }
                                            ?>
                                        </div>

                                        <div class="col-lg-12 col-xs-12 col-sm-12 w3-margin-bottom">
                                            <label>Enter Activity: (max. 255 chars)</label>
                                            <input type="text" name="activity[]" style="padding: 5px 2px 5px 5px" class="w3-input" id="activity" placeholder="Enter Activity here." maxlength="255" required>
                                        </div>
                                        <div class="w3-col l12 s12 m12" id="addedmore_imageDiv"></div>
                                        <div class="w3-col l12 w3-margin-bottom">
                                            <a id="add_moreimage" title="Add More Activity" class="btn w3-text-red add_moreProduct w3-small w3-right w3-margin-top"><b>Add More Activity <i class="fa fa-plus"></i></b>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 w3-center" id="btnsubmit">
                                        <button class="btn w3-button theme_bg" id="addActivityBtn" type="submit"><i class="fa fa-plus"></i> Add Activity </button>
                                    </div>
                                </div>

                            </form>
                            <div id="formOutput" class="w3-margin"></div> 

                            <br>
                            <div class="row">
                                <hr>
                                <label>Choose Checklist / Slab Cycle to fetch Details:</label>
                                <select class="w3-input w3-light-grey" ng-model='checklist_workitem' ng-change='fetchChecklistDetails()' name="checklist_workitem" id="checklist_workitem">
                                    <?php
                                    if ($allWitems) {
                                        foreach ($allWitems as $key) {
                                            echo '<option value="' . $key['witem_id'] . '">' . $key['witem_name'] . ' Slab Cycle</option>';
                                        }
                                    }
                                    ?>
                                </select>

                                <div class="col-md-12" id="checklistDetails" ng-bind-html="checklistDetails"></div>
                                <br>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
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
                    <div class="col-lg-12 col-xs-12 col-sm-12 w3-margin-bottom">\n\
                    <label>Enter Activity: (max. 255 chars)</label>\n\
                    <input type="text" name="activity[]" style="padding: 5px 2px 5px 5px" class="w3-input" id="activity" placeholder="Enter Activity here." maxlength="255" required>\n\
                    </div>\n\
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
<script src="<?php echo base_url(); ?>assets/js/module/user/genericsetting.js"></script>
