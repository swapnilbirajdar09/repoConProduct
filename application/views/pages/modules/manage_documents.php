<!-- page content --> 
<script src="<?php echo base_url(); ?>assets/dropzone/dropzone.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dropzone/dropzone.css">

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Manage Documents </h3>
      </div>
    </div>

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
          <div class="container x_content">
            <form id="document_uploadForm">
              <div class="w3-col l12">
                <div class="w3-col l12">
                  <div class="col-md-4 col-xs-12 w3-margin-bottom">
                    <label>Document Title: </label>
                    <input type="text" class="w3-input" name="document_title" id="document_title" placeholder="Enter Document title" style="border-bottom-color: #CCCCCC" required>
                  </div>
                  <div class="col-md-4 col-xs-12 w3-margin-bottom">
                    <label>Document Type: </label>
                    <select class="w3-input" name="document_type" id="document_type" style="border-bottom-color: #CCCCCC">
                      <option value="0" class="w3-light-grey">Choose document type</option>
                      <?php 
                      if($allDocument_types){
                        foreach ($allDocument_types as $key) {
                          ?>
                          <option value="<?php echo $key['document_type']; ?>"><?php echo $key['document_type']; ?></option>
                          <?php
                        }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-md-4 col-xs-12 w3-margin-bottom">
                    <label>Revision Number(#): </label>
                    <input type="number" class="w3-input" name="revision_number" id="revision_number" placeholder="Enter Revision number" min="1" style="border-bottom-color: #CCCCCC" required>
                    <div class="w3-col l12 w3-margin-top w3-small" >
                      <i><span>Last Document Revision Number : </span>
                        <label class="w3-medium">
                          <?php 
                          if($lastRevision_no){
                            echo '#'.$lastRevision_no;
                          }
                          else{
                            echo 'No Documents uploaded yet!';
                          }
                          ?>
                        </label>
                      </i>

                    </div>
                  </div>
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
                    <th class="text-center"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  if($allDocuments){
                    foreach($allDocuments as $doc){
                      ?>
                      <tr class="w3-center">
                        <td><?php echo $doc['document_title']; ?></td>
                        <td><?php echo $doc['document_type']; ?></td>
                        <td>#<?php echo $doc['revision_no']; ?></td>
                        <td><?php echo count(json_decode($doc['document_file']),TRUE); ?></td>
                        <td><?php echo $doc['created_by']; ?></td>
                        <td><?php 
                        $dtime = new DateTime($doc['created_date']);
                        echo $dtime->format("d M y H:i a");
                        ?></td>
                        <td>
                          <div class="btn-group">
                            <button data-toggle="dropdown" id="actionBtn_<?php echo $doc['document_id']; ?>" class="btn btn-default w3-small dropdown-toggle" type="button" style="padding: 2px 6px">Action <span class="caret"></span>
                            </button>
                            <ul role="menu" class="dropdown-menu pull-right">
                              <li><a title="View files" class="btn btn-xs text-left" data-toggle="modal" data-target="#DocModal_<?php echo $doc['document_id']; ?>" onclick="openHelp('DocModal_<?php echo $doc['document_id']; ?>')">View Files</a>
                              </li>
                              <?php 
                              $user_role= $this->session->userdata('role');
                              $user_name= $this->session->userdata('usersession_name');
                              if($user_role=='company_admin' || $user_name==$doc['created_by']){
                                ?>
                                <li><a title="view files" class="btn btn-xs text-left" href="<?php echo base_url(); ?>modules/manage_documents/edit_document/<?php echo base64_encode($doc['document_id']); ?>">Edit Files</a>
                                </li>
                                <li><a class="btn btn-xs text-left" onclick="removeDocument('<?php echo base64_encode($doc['document_id']); ?>','<?php echo $doc['document_id']; ?>')" title="Delete document">Delete Document</a>
                                </li>
                                <?php 
                              }
                              ?>
                            </ul>
                          </div>
                        </td>
                      </tr>

                      <!-- Modal to edit product -->
                      <div class="modal fade bs-example-modal-lg" id="DocModal_<?php echo $doc['document_id']; ?>" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-md ">
                          <!-- Modal content starts -->
                          <div class="modal-content">

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                              </button>
                              <h3 class="modal-title w3-center"><?php echo $doc['document_title']; ?> <span class="badge w3-grey w3-text-white w3-small"><?php echo $doc['document_type']; ?></span></h3>
                            </div>
                            <!-- Modal body starts -->
                            <div class="modal-body">
                              <!-- Modal container starts -->
                              <div class="container"> 
                                <div class="col-lg-12">
                                  <div class="w3-col l12 w3-padding">
                                    <span class="pull-left"><b>Revision No.:</b> #<?php echo $doc['revision_no']; ?></span>
                                    <span class="pull-right"><b>Uploaded By:</b> <?php echo $doc['created_by']; ?>, <?php echo $dtime->format("d M y H:i:s"); ?></span>
                                  </div>
                                  <?php 
                                  $image_arr=json_decode($doc['document_file']);
                                  ?>                                
                                  <div class="w3-col l12 w3-padding">
                                    <?php 
                                    $count=1;
                                    foreach ($image_arr as $file) {
                                      $arr=explode('/', $file);
                                      $filename=$arr[3];
                                      $ext_arr=explode('.',$file);
                                      $ext=end($ext_arr);
                                      ?>
                                      <div class="w3-padding-small" style="display: inline;">
                                        <a class="w3-text-grey btn w3-round w3-border"  target="_self" href="<?php echo base_url().$file; ?>" title="Download file" download="<?php echo 'File_'.$count.'.'.$ext; ?>" style="padding:4px;display: inline-block;"><b><i class="fa fa-download"></i></b> <?php echo 'File_'.$count.'.'.$ext; ?></a>
                                      </div>
                                      <?php
                                      $count++;
                                    }
                                    ?>
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
                    } 
                  }
                  else{
                    ?>
                    <tr>
                      <td colspan="5" class="w3-center theme_text"><b>No Documents Uploaded</b></td>
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
<script src="<?php echo base_url();?>assets/js/module/user/document.js"></script>

        <!-- /page content