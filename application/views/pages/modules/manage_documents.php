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
              <div class="w3-col l7">
                <div class="w3-col l12">
                  <div class="col-md-6 col-xs-12 w3-margin-bottom">
                    <label>Document Title: </label>
                    <input type="text" class="w3-input" name="document_title" id="document_title" placeholder="Enter Document title" style="border-bottom-color: #CCCCCC" required>
                  </div>
                  <div class="col-md-6 col-xs-12 w3-margin-bottom">
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
                </div>
                <div class="w3-col l12">
                  <div class="col-md-6 col-xs-12 w3-margin-bottom">
                    <label>Revision Number(#): </label>
                    <input type="number" class="w3-input" name="revision_number" id="revision_number" placeholder="Enter Revision number" min="1" style="border-bottom-color: #CCCCCC" required>
                  </div>
                  <div class="col-md-6 w3-margin-bottom w3-small" >
                    <i><span>Last Document Revision Number: </span>
                      <label>
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
              <div class="w3-col l5 w3-padding-right w3-padding-left">
                <div class="col-md-12 col-xs-12 w3-round w3-border" style="height: 200px">
                  <h5><b>Share Document with: </b></h5>
                  <div class="w3-col l12 col-xs-12">
                    <?php 
                    if($assocRoles){
                      foreach ($assocRoles as $key) {
                        ?>
                        <div class="col-md-4 col-xs-12">
                          <div class="checkbox" style="margin:5px">
                            <label>
                              <input type="checkbox" name="roleAssoc[]" value="<?php echo $key['role_id']; ?>"> <?php echo $key['role_name']; ?>
                            </label>
                          </div>
                        </div>
                        <?php
                      }
                    }
                    ?>
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


            <div class="w3-col l12 w3-padding w3-small" id="allPortfolioDiv">
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
                        echo $dtime->format("d M y H:i:s");
                        ?></td>
                        <td>
                          <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-default w3-small dropdown-toggle" type="button" style="padding: 2px 6px">Action <span class="caret"></span>
                            </button>
                            <ul role="menu" class="dropdown-menu pull-right">
                              <li><a title="view files" href="<?php echo base_url(); ?>admin/manage_portfolio/portfolio/<?php echo $doc['document_id']; ?>">View Files</a>
                              </li>
                              <li><a ng-click="removePortfolio(<?php echo $doc['document_id']; ?>)" title="delete document">Delete Document</a>
                              </li>

                            </ul>
                          </div>
                        </td>
                      </tr>
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
        <!-- /page content