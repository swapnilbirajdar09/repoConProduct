<!-- page content --> 

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Upload Documents </h3>
            </div>
        </div>
        <?php
//$project_id = $this->session->userdata('project_id');
//echo $project_id;
        ?>
        <div class="clearfix"></div>

        <div class="row">
            <!-- upload document div -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-file"></i> Upload documents For Request Module</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <?php
                    //print_r($roles);
                    //echo $requested_by;
                    ?>
                    <div class="container x_content">
                        <form id="document_uploadForm">
                            <div class="w3-col l12">
                                <div class="w3-col l12">
                                    <div class="col-md-4 col-xs-12 w3-margin-bottom">
                                        <label>Document Title: </label>
                                        <input type="text" class="w3-input" name="document_title" value="<?php echo $document_name; ?>" id="document_title" placeholder="Enter Document title" style="border-bottom-color: #CCCCCC" required>
                                        <input type="hidden" class="w3-input" name="request_id" value="<?php echo $request_id; ?>" id="request_id" placeholder="Enter Document title" style="border-bottom-color: #CCCCCC" required>
                                        <div class="w3-col l12 w3-margin-top w3-small" >
                                            <label> Shared With: </label><br>
                                            <?php
                                            if ($roles['status'] == 200) {
                                                foreach ($roles['status_message'] as $key) {
                                                    ?>
                                                    <input type="checkbox" checked id="shared_with" name="shared_with[]" value="<?php echo $key['role_id']; ?>"> <?php echo $key['role_name']; ?><br>
                                                    <?php
                                                }
                                            } else {
                                                echo '<span class="w3-light-grey">No Roles Are Available</span>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-12 w3-margin-bottom">
                                        <label>Document Type: </label>
                                        <select class="w3-input" name="document_type" id="document_type" style="border-bottom-color: #CCCCCC">
                                            <option value="0" class="w3-light-grey">Choose document type</option>
                                            <?php
                                            if ($allDocument_types) {
                                                foreach ($allDocument_types as $key) {
                                                    ?>
                                                    <option value="<?php echo $key['document_type']; ?>"><?php echo $key['document_type']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?php //if($lastRevision_no){  ?>
                                    <div class="col-md-4 col-xs-12 w3-margin-bottom">
                                        <label>Revision Number(#): </label>
                                        <input type="number" class="w3-input" name="revision_number" id="revision_number" placeholder="Enter Revision number" min="1" style="border-bottom-color: #CCCCCC" required>
                                        <div class="w3-col l12 w3-margin-top w3-small" >
                                            <i><span>Last Document Revision Number : </span>
                                                <label class="w3-medium">
                                                    <?php
                                                    if ($lastRevision_no) {
                                                        echo '#' . $lastRevision_no;
                                                    } else {
                                                        echo 'No Documents uploaded yet!';
                                                    }
                                                    ?>
                                                </label>
                                            </i>
                                        </div>
                                    </div>
                                    <?php // }   ?>
                                </div>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <label>Document Files: </label>
                                <div id="file_drop" class="dropzone w3-light-grey" style="border:none;font-size: 25px">
                                    <div class="dropzone-previews"></div> 
                                </div>
                            </div>
                            <div class="col-md-12 w3-center w3-margin-top w3-margin-bottom">
                                <button type="submit" id="uploadDocBtn" class="btn theme_bg w3-hover-text-grey btn-large"><i class="fa fa-upload"></i> Click here to Upload Documents</button>
                                <div id="response_msg"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- upload document div ends -->
        </div>
    </div>
</div>
<script>
    function openNewModal(modal_id) {
        var modal = $('#' + modal_id);
        modal.addClass('in');
    }
</script>
<script src="<?php echo base_url(); ?>assets/js/module/user/document.js"></script>
<script src="<?php echo base_url(); ?>assets/dropzone/dropzone_new.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dropzone/dropzone.css">
<!-- /page content