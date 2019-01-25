<!-- page content --> 

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Manage Documents </h3>
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
                        <h2><i class="fa fa-file"></i> Upload documents</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <?php //print_r($roles);
                    ?>
                    <div class="container x_content">
                        <form id="document_uploadForm">
                            <div class="w3-col l12">
                                <div class="w3-col l12">
                                    <div class="col-md-4 col-xs-12 w3-margin-bottom">
                                        <label>Document Title: </label>
                                        <input type="text" class="w3-input" name="document_title" id="document_title" placeholder="Enter Document title" style="border-bottom-color: #CCCCCC" required>
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
                                    <?php //if($lastRevision_no){ ?>
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
                                    <?php // }  ?>
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

            <!-- view all document div -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-list"></i> All Documents</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <?php //print_r($allDocuments); ?>
                    <div class="container x_content">
                        <div id="table_msg"></div>
                        <div class="w3-col l12 w3-padding w3-small" id="allDocumentDiv">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr >
                                        <th class="text-center">Document Title</th>
                                        <th class="text-center">Type</th>
                                        <th class="text-center">Revision No</th>
                                        <th class="text-center">Total Files</th>
                                        <th class="text-center">Uploaded by</th>
                                        <th class="text-center">Uploaded date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $role_id = '';
                                    $sharedRoles = '';
                                    if ($allDocuments) {
                                        foreach ($allDocuments as $doc) {
                                            $cls = '';

                                            $role = $this->session->userdata('role');
                                            if ($role == 'company_admin') {
                                                
                                            } else {
                                                $role = $this->session->userdata('role');
                                                $sessionArr = explode('/', $role);
                                                $role_id = $sessionArr[0];
                                                $role_name = $sessionArr[1];
                                            }
                                            $sharedRoles = json_decode($doc['shared_with'], TRUE);

                                            if (in_array($role_id, $sharedRoles) || $role == 'company_admin') {
                                                if ($doc['delete_reason'] != '') {
                                                    $cls = 'w3-grey';
                                                }
                                                ?>

                                                <tr class="w3-center <?php echo $cls; ?>">
                                                    <td><?php echo $doc['document_title']; ?></td>
                                                    <td><?php echo $doc['document_type']; ?></td>
                                                    <td>#<?php echo $doc['revision_no']; ?></td>
                                                    <td><?php echo count(json_decode($doc['document_file']), TRUE); ?></td>
                                                    <td><?php echo $doc['created_by']; ?></td>
                                                    <td><?php
                                                        $dtime = new DateTime($doc['created_date']);
                                                        echo $dtime->format("d M y H:i a");
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button data-toggle="dropdown" id="actionBtn_<?php echo $doc['document_id']; ?>" class="btn btn-default w3-small dropdown-toggle" type="button" style="padding: 2px 6px">Action <span class="caret"></span>
                                                            </button>
                                                            <ul role="menu" class="dropdown-menu pull-right">
                                                                <li><a title="View files" class="btn btn-xs text-left" data-toggle="modal" data-target="#DocModal_<?php echo $doc['document_id']; ?>" onclick="openHelp('DocModal_<?php echo $doc['document_id']; ?>')">View Files</a>
                                                                </li>
                                                                <?php
                                                                $user_role = $this->session->userdata('role');
                                                                if ($user_role == 'company_admin') {
                                                                    $user_name = $this->session->userdata('usersession_name');
                                                                } else {
                                                                    $user_name = $this->session->userdata('user_name');
                                                                }
                                                                if ($user_role == 'company_admin' || $user_name == $doc['created_by']) {
                                                                    if ($doc['delete_reason'] == '') {
                                                                        ?>
                                                                        <li>
                                                                            <a class="btn btn-xs text-left" data-toggle="modal" data-target="#RequestModal_<?php echo $doc['document_id']; ?>" onclick="openNewModal('RequestModal_<?php echo $doc['document_id']; ?>');"  title="Send Request For Deletion">Request For Deletion</a>
                                                                        </li>
                                                                    <?php } else {
                                                                        ?>
                                                                        <li>
                                                                            <a class="btn btn-xs text-left" onclick="showMsg()" title="Request For Deletion">Request For Deletion</a>
                                                                        </li>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!--Modal to edit product--> 
                                            <div class="modal fade bs-example-modal-lg" id="DocModal_<?php echo $doc['document_id']; ?>" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-md ">
                                                    <!--                                                Modal content starts -->
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                            </button>
                                                            <h3 class="modal-title w3-center"><?php echo $doc['document_title']; ?> <span class="badge w3-grey w3-text-white w3-small"><?php echo $doc['document_type']; ?></span></h3>
                                                        </div>
                                                        <!--                                                    Modal body starts -->
                                                        <div class="modal-body">
                                                            <!--                                                        Modal container starts -->
                                                            <div class="container"> 
                                                                <div class="col-lg-12">
                                                                    <div class="w3-col l12 w3-padding">
                                                                        <span class="pull-left"><b>Revision No.:</b> #<?php echo $doc['revision_no']; ?></span>
                                                                        <span class="pull-right"><b>Uploaded By:</b> <?php echo $doc['created_by']; ?>, <?php echo $dtime->format("d M y H:i:s"); ?></span>
                                                                    </div>
                                                                    <?php
                                                                    $image_arr = json_decode($doc['document_file']);
                                                                    ?>                                
                                                                    <div class="w3-col l12 w3-padding">
                                                                        <?php
                                                                        $count = 1;
                                                                        foreach ($image_arr as $file) {
                                                                            $arr = explode('/', $file);
                                                                            $filename = $arr[3];
                                                                            $ext_arr = explode('.', $file);
                                                                            $ext = end($ext_arr);
                                                                            switch ($ext) {
                                                                                case "jpg":
                                                                                    $image = 'fa-file-image-o';
                                                                                    break;
                                                                                case "jpeg":
                                                                                    $image = 'fa-file-image-o';
                                                                                    break;
                                                                                case "JPG":
                                                                                    $image = 'fa-file-image-o';
                                                                                    break;
                                                                                case "JPEG":
                                                                                    $image = 'fa-file-image-o';
                                                                                    break;
                                                                                case "png":
                                                                                    $image = 'fa-file-image-o';
                                                                                    break;
                                                                                case "docx":
                                                                                    $image = 'fa-file-word-o';
                                                                                    break;
                                                                                case "doc":
                                                                                    $image = 'fa-file-word-o';
                                                                                    break;
                                                                                case "pdf":
                                                                                    $image = 'fa-file-pdf-o';
                                                                                    break;
                                                                                case "text":
                                                                                    $image = 'fa-file-text-o';
                                                                                    break;
                                                                                case "zip":
                                                                                    $image = 'fa-file-archive-o';
                                                                                    break;
                                                                                case "pptx":
                                                                                    $image = 'fa-file-powerpoint-o';
                                                                                    break;
                                                                                default:
                                                                                    $image = 'fa-file-o';
                                                                            }
                                                                            ?>
                                                                            <div class="w3-padding-small" style="display: inline;">
                                                                                <a class="w3-text-grey btn w3-round"  target="_self" href="<?php echo base_url() . $file; ?>"  download="<?php echo $filename . '.' . $ext; ?>" title="Download <?php echo $filename; ?>" style="padding:4px;display: inline-block;"><b></b><i class="fa <?php echo $image; ?> w3-jumbo"></i></a>
                                                                            </div>
                                                                            <?php
                                                                            $count++;
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--                                                        Modal container ends -->
                                                        </div>
                                                        <!--                                                    Modal Body ends -->
                                                    </div>
                                                    <!--                                                Modal contenet ends -->
                                                </div>
                                            </div>
                                            <!--                                        Modal ends here -->


                                            <!--Modal to edit product--> 
                                            <div class="modal fade bs-example-modal-lg" id="RequestModal_<?php echo $doc['document_id']; ?>" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-md ">
                                                    <!--                                                Modal content starts -->
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                            </button>
                                                            <h3 class="modal-title w3-center"><?php echo $doc['document_title']; ?> <span class="badge w3-grey w3-text-white w3-small"><?php echo $doc['document_type']; ?></span></h3>
                                                        </div>
                                                        <!--                                                    Modal body starts -->
                                                        <div class="modal-body">
                                                            <!--                                                        Modal container starts -->
                                                            <div class="container"> 
                                                                <!-- Div for images-->

                                                                <div class="col-lg-12">
                                                                    <div class="w3-col l12 w3-padding">
                                                                        <span class="pull-left"><b>Revision No.:</b> #<?php echo $doc['revision_no']; ?></span>
                                                                        <span class="pull-right"><b>Uploaded By:</b> <?php echo $doc['created_by']; ?>, <?php echo $dtime->format("d M y H:i:s"); ?></span>
                                                                    </div>
                                                                    <?php
                                                                    $image_arr = json_decode($doc['document_file']);
                                                                    ?>                                
                                                                    <div class="w3-col l12 w3-padding">
                                                                        <?php
                                                                        $count = 1;
                                                                        foreach ($image_arr as $file) {
                                                                            $arr = explode('/', $file);
                                                                            $filename = $arr[3];
                                                                            $ext_arr = explode('.', $file);
                                                                            $ext = end($ext_arr);
                                                                            switch ($ext) {
                                                                                case "jpg":
                                                                                    $image = 'fa-file-image-o';
                                                                                    break;
                                                                                case "jpeg":
                                                                                    $image = 'fa-file-image-o';
                                                                                    break;
                                                                                case "JPG":
                                                                                    $image = 'fa-file-image-o';
                                                                                    break;
                                                                                case "JPEG":
                                                                                    $image = 'fa-file-image-o';
                                                                                    break;
                                                                                case "png":
                                                                                    $image = 'fa-file-image-o';
                                                                                    break;
                                                                                case "docx":
                                                                                    $image = 'fa-file-word-o';
                                                                                    break;
                                                                                case "doc":
                                                                                    $image = 'fa-file-word-o';
                                                                                    break;
                                                                                case "pdf":
                                                                                    $image = 'fa-file-pdf-o';
                                                                                    break;
                                                                                case "text":
                                                                                    $image = 'fa-file-text-o';
                                                                                    break;
                                                                                case "zip":
                                                                                    $image = 'fa-file-archive-o';
                                                                                    break;
                                                                                case "pptx":
                                                                                    $image = 'fa-file-powerpoint-o';
                                                                                    break;
                                                                                default:
                                                                                    $image = 'fa-file-o';
                                                                            }
                                                                            ?>
                                                                            <div class="w3-padding-small" style="display: inline;">
                                                                                <a class="w3-text-grey btn w3-round"  target="_self" href="<?php echo base_url() . $file; ?>"  download="<?php echo $filename . '.' . $ext; ?>" title="Download <?php echo $filename; ?>" style="padding:4px;display: inline-block;"><b></b><i class="fa <?php echo $image; ?> w3-jumbo"></i></a>
                                                                            </div>
                                                                            <?php
                                                                            $count++;
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <!-- Div For Images -->
                                                                <form id="reason_form_<?php echo $doc['document_id']; ?>" name="reason_form_<?php echo $doc['document_id']; ?>">
                                                                    <div class="col-lg-12">
                                                                        <div class="w3-col l12 w3-padding">
                                                                            <div class="form-group">
                                                                                <label>Select Reason For <font color ="red"><span id ="pname_star">*</span></font></label>
                                                                                <select class="w3-input w3-border" name="reason_type" id="reason_type_<?php echo $doc['document_id']; ?>" style="border-bottom-color: #CCCCCC">
                                                                                    <option value="0" class="w3-light-grey">Choose document type</option>
                                                                                    <option value="Incorrect data" class="w3-light-grey">Incorrect data</option>
                                                                                    <option value="Incomplete data" class="w3-light-grey">Incomplete data</option>
                                                                                    <option value="Not compatible data format" class="w3-light-grey">Not compatible data format</option>
                                                                                    <option value="Others" class="w3-light-grey">Others</option>                                                                              
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Select Reason For <font color="red"><span id ="pname_star">*</span></font></label>
                                                                                <textarea class="w3-input w3-border" name="reason_description" id="reason_description_<?php echo $doc['document_id']; ?>" placeholder="Description For the reason."></textarea>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <button type="button" class="btn w3-blue w3-text-white" id="submitBtn" name="submitBtn" onclick="removeDocument('<?php echo base64_encode($doc['document_id']); ?>', '<?php echo $doc['document_id']; ?>')" >Submit</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <!-- Modal container ends -->
                                                    </div>
                                                    <!--  Modal Body ends -->
                                                </div>
                                                <!--   Modal content ends -->
                                            </div>
                                    </div>
                                    <!--   Modal ends here -->
                                    <?php
                                }
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="7" class="w3-center theme_text"><b>No Documents Uploaded</b></td>
                            </tr>
                        <?php } ?>                       
                        </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!-- view all document div ends -->
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
<script src="<?php echo base_url(); ?>assets/dropzone/dropzone.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dropzone/dropzone.css">
<!-- /page content