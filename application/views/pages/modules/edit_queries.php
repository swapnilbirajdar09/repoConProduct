<!-- page content --> 
<script src="<?php echo base_url(); ?>assets/dropzone/dropzone.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dropzone/dropzone.css">
<?php
//print_r($queryDetails['status_message'][0]);
$createdtime = new DateTime($queryDetails['status_message'][0]['created_date']);
$modifiedtime = new DateTime($queryDetails['status_message'][0]['modified_date']);
?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Document </h3>
            </div>
            <?php
            if ($queryDetails['status_message'][0]['modified_by'] == '') {
                ?>
                <span class="pull-right w3-small"><b><i>Last modified by <?php echo $queryDetails['status_message'][0]['created_by']; ?>, <?php echo $createdtime->format("d M y H:i a"); ?></i></b></span>
                <?php
            } else {
                ?>
                <span class="pull-right w3-small"><b><i>Last modified by <?php echo $queryDetails['status_message'][0]['modified_by']; ?>, <?php echo $modifiedtime->format("d M y H:i a"); ?></i></b></span>
                <?php
            }
            ?>
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <!-- edit document div -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Query Details</h2>            
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="container x_content">
                        <div class="col-md-12">
                            <form id="editDocument_form" name="editDocument_form" enctype="multipart/form-data">
                                <div class="w3-col l12 w3-margin-bottom">                
                                    <div class="col-md-6 col-xs-12 w3-margin-bottom">
                                        <input type="hidden" name="document_id" value="<?php echo base64_encode($queryDetails['status_message'][0]['query_id']); ?>">
                                        <label>Query Title: </label>
                                        <input type="text" class="w3-input" name="document_title" id="document_title" placeholder="Enter Document title" value="<?php echo $queryDetails['status_message'][0]['query_title']; ?>" style="border-bottom-color: #CCCCCC" required>
                                    </div>

                                    <div class="col-md-6 col-xs-12 w3-margin-bottom">
                                        <label>Query Description(#): </label>
<!--                                        <input type="number" class="w3-input" name="revision_number" id="revision_number" placeholder="Enter Revision number" min="1" value="<?php //echo $queryDetails['status_message'][0]['query_description']; ?>" style="border-bottom-color: #CCCCCC" required>-->
                                        <textarea class="w3-input w3-border w3-margin-bottom" placeholder="Query Description" name="queryDescription" id="queryDescription" rows="5" cols="50" style="resize: none;" required><?php echo $queryDetails['status_message'][0]['query_description']; ?></textarea>
                                    </div> 
                                    <div class="w3-col l12 w3-center">
                                        <button type="submit" id="updateDocBtn" class="btn theme_bg w3-hover-text-grey btn-large"><i class="fa fa-edit"></i> Click here to Save Changes</button>
                                        <div id="response_msg"></div>
                                    </div>                
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- edit document div ends -->

            <!-- document gallery -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Query Images</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="container x_content">

                        <div class="col-md-12">
                            <div class="w3-col l12 w3-margin-bottom">
                                <?php
                                $image_arr = json_decode($queryDetails['status_message'][0]['images']);
                                ?>                                
                                <?php
                                $count = 1;
                                if($image_arr != ''){
                                foreach ($image_arr as $key=>$file) {
                                    $arr = explode('/', $file);
                                    $filename = $arr[3];
                                    $ext_arr = explode('.', $file);
                                    $ext = end($ext_arr);
                                    ?>
                                    <div class="col-md-3">
                                        <div class="image view view-first" style="height: 150px">
                                            <img style="width: 100%;height:100%" class="img img-thumbnail" src="<?php echo base_url() . $file; ?>" alt="image">
                                            <div class="mask no-caption">
                                                <div class="tools" style="margin: 20px 0">
                                                    <a class="btn w3-small"  target="_self" href="<?php echo base_url() . $file; ?>" title="Download image" download="<?php echo $filename; ?>" style="padding:4px;display: inline-block;" ><i class="fa fa-download"></i> Download</a>
                                                </div>
                                                <div class="tools" style="margin: 20px 0">
                                                    <a class="btn w3-small" onclick="deleteQueryImage('<?php echo $key; ?>','<?php echo $queryDetails['status_message'][0]['query_id']; ?>')" title="Delete image" style="padding:4px;display: inline-block;" ><i class="fa fa-close"></i> Delete Image</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $count++;
                                }}else{
                                ?>
                                <div class="w3-col l12 w3-margin-top"> 
                                    <center><h3>No Images are available</h3></center>
                                </div>
                                <?php } ?>
                            </div>
                            <!-- upload document div -->
                            <div class="col-md-12 w3-small w3-padding-small w3-margin-bottom">
                                <div class="col-md-6 col-xs-12 w3-padding-small" style="background-color: #F7F7F7">
                                    <div class="w3-col l6 w3-margin-bottom">
                                        <form id="uploadFileForm" enctype="multipart/form-data">
                                            <input type="hidden" name="query_title" value="<?php echo $queryDetails['status_message'][0]['query_title']; ?>">
                                            <input type="hidden" name="query_id" value="<?php echo base64_encode($queryDetails['status_message'][0]['query_id']); ?>">
                                            <label>Select File: <font color ="red"><span id ="simage_star">*</span></font></label>
                                            <input type="file" name="doc_file" id="doc_file" class="w3-input w3-border" style="padding:5px" required>
                                            <span class="w3-text-red w3-small" id="file_error"></span>
                                            <div class="w3-col l12 w3-margin-top">
                                                <button type="submit" title="upload file" id="uploadFile" class="btn theme_bg"><i class="fa fa-upload"></i> Upload File</button>
                                            </div>
                                        </form>
                                        <div id="file_msg"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- upload document -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- document gallery ends -->
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/module/user/editQuery.js"></script>

<!-- /page content