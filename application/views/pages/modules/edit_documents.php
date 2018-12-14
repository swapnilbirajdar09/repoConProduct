<!-- page content --> 
<script src="<?php echo base_url(); ?>assets/dropzone/dropzone.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dropzone/dropzone.css">
<?php 
$createdtime = new DateTime($documentDetails[0]['created_date']);
$modifiedtime = new DateTime($documentDetails[0]['modified_date']);
?>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Edit Document 
        <a class="btn btn btn-sm theme_bg w3-hover-text-grey" href="<?php echo base_url(); ?>modules/manage_documents"> Back to Manage Document </a></h3>
      </div>
      <div class="title_left">
        
      </div>
      <div>
      <?php 
      if($documentDetails[0]['modified_by']==''){
        ?>
        <span class="pull-right w3-small"><b><i>Last modified by <?php echo $documentDetails[0]['created_by']; ?>, <?php echo $createdtime->format("d M y H:i a"); ?></i></b></span>
        <?php 
      }
      else{
        ?>
        <span class="pull-right w3-small"><b><i>Last modified by <?php echo $documentDetails[0]['modified_by']; ?>, <?php echo $modifiedtime->format("d M y H:i a"); ?></i></b></span>
        <?php 
      }
      ?>
  </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
      <!-- edit document div -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><?php echo $documentDetails[0]['document_title']; ?> details</h2>            
            <ul class="nav navbar-right panel_toolbox">
              <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="container x_content">
            <div class="col-md-12">
              <form id="editDocument_form" name="editDocument_form" enctype="multipart/form-data">
                <div class="w3-col l12 w3-margin-bottom">                
                  <div class="col-md-4 col-xs-12 w3-margin-bottom">
                    <input type="hidden" name="document_id" value="<?php echo base64_encode($documentDetails[0]['document_id']); ?>">
                    <label>Document Title: </label>
                    <input type="text" class="w3-input" name="document_title" id="document_title" placeholder="Enter Document title" value="<?php echo $documentDetails[0]['document_title']; ?>" style="border-bottom-color: #CCCCCC" required>
                  </div>
                  <div class="col-md-4 col-xs-12 w3-margin-bottom">
                    <label>Document Type: </label>
                    <select class="w3-input" name="document_type" id="document_type" style="border-bottom-color: #CCCCCC">
                      <option value="0" class="w3-light-grey">Choose document type</option>
                      <?php 
                      if($allDocument_types){
                        foreach ($allDocument_types as $key) {
                          ?>
                          <option value="<?php echo $key['document_type']; ?>" <?php if($documentDetails[0]['document_type']==$key['document_type']){ echo 'selected';} ?>><?php echo $key['document_type']; ?></option>
                          <?php
                        }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-md-4 col-xs-12 w3-margin-bottom">
                    <label>Revision Number(#): </label>
                    <input type="number" class="w3-input" name="revision_number" id="revision_number" placeholder="Enter Revision number" min="1" value="<?php echo $documentDetails[0]['revision_no']; ?>" style="border-bottom-color: #CCCCCC" required>
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
            <h2><?php echo $documentDetails[0]['document_title']; ?> Documents</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="container x_content">

            <div class="col-md-12">
              <div class="w3-col l12 w3-margin-bottom">
                <?php 
                $image_arr=json_decode($documentDetails[0]['document_file']);
                ?>                                
                <?php 
                $count=1;
                foreach ($image_arr as $key=>$file) {
                  $ext_arr=explode('.',$file);
                  $ext=end($ext_arr);
                  ?>
                  <div class="w3-padding-small" style="display: inline;">
                    <span class="w3-text-grey w3-round w3-border" style="padding:0px 4px;display: inline-block;margin-bottom: 5px"><?php echo 'File_'.$count.'.'.$ext; ?>
                      <a onclick="removeFile('<?php echo $key; ?>','<?php echo $documentDetails[0]['document_id']; ?>')" class="w3-medium w3-text-red btn" id="fileBtn_<?php echo $key; ?>" style="padding:1px;margin:0" title="remove file"> <i class="fa fa-times"></i></a>
                    </span>
                  </div>
                  <?php
                  $count++;
                }
                ?>
              </div>
              <!-- upload document div -->
              <div class="col-md-12 w3-small w3-padding-small w3-margin-bottom">
               <div class="col-md-6 col-xs-12 w3-padding-small" style="background-color: #F7F7F7">
                <div class="w3-col l6 w3-margin-bottom">
                  <form id="uploadFileForm" enctype="multipart/form-data">
                    <input type="hidden" name="doc_title" value="<?php echo $documentDetails[0]['document_title']; ?>">
                    <input type="hidden" name="doc_id" value="<?php echo base64_encode($documentDetails[0]['document_id']); ?>">
                    <input type="hidden" name="doc_type" value="<?php echo $documentDetails[0]['document_type']; ?>">
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
<script src="<?php echo base_url();?>assets/js/module/user/document.js"></script>

        <!-- /page content