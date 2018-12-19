<!-- page content --> 

<?php
//print_r($activityDetails[0]);
$createdtime = new DateTime($activityDetails[0]['created_date']);
$modifiedtime = new DateTime($activityDetails[0]['modified_date']);
?>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>View Activity <a class="btn btn btn-sm theme_bg w3-hover-text-grey" href="<?php echo base_url(); ?>/modules/site_inspection"><i class="fa fa-chevron-left"></i> Back to SIte Inspection Controller </a></h3>
      </h3>
    </div>
    <?php
    if ($activityDetails[0]['modified_by'] == '') {
      ?>
      <span class="pull-right w3-small"><b><i>Last modified by <?php echo $activityDetails[0]['created_by']; ?>, <?php echo $createdtime->format("d M y H:i a"); ?></i></b></span>
      <?php
    } else {
      ?>
      <span class="pull-right w3-small"><b><i>Last modified by <?php echo $activityDetails[0]['modified_by']; ?>, <?php echo $modifiedtime->format("d M y H:i a"); ?></i></b></span>
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
          <h2>Activity Details</h2>            
          <ul class="nav navbar-right panel_toolbox">
            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="container x_content">
          <div class="col-md-12">
            <div class="col-md-6 w3-border-right">
              <label class="w3-medium"><i class="fa fa-check-square-o"></i> <?php echo $activityDetails[0]['activity_name']; ?></label>
              <br>
              <label class="w3-small badge"> <?php echo $activityDetails[0]['work_item']; ?></label>
              <br>
              <?php 
              if($activityDetails[0]['comments']!=''){
                ?>
                <p><i class="fa fa-quote-left"></i><i><?php echo $activityDetails[0]['comments']; ?></i><i class="fa fa-quote-right"></i></p> 
              <?php } ?>                                   
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- edit document div ends -->

    <!-- document gallery -->
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Checklist Images</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="container x_content">
          <div class="col-md-12">
            <div class="w3-col l12 w3-margin-bottom">
              <?php
              $image_arr = json_decode($activityDetails[0]['images']);
                                //print_r($image_arr);
              ?>                                
              <?php
              $count = 1;
              if ($image_arr != '' && $image_arr != []) {
                foreach ($image_arr as $key => $file) {
                                        //echo $key;
                  $arr = explode('/', $file);
                  $filename = $arr[3];
                  $ext_arr = explode('.', $file);
                  $ext = end($ext_arr);
                  ?>
                  <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="image view view-first" style="height: 150px">
                      <img style="width: 100%;height:100%" class="img img-thumbnail" src="<?php echo base_url() . $file; ?>" alt="image">
                      <div class="mask no-caption">
                        <div class="tools" style="margin: 20px 0">
                          <a class="btn w3-small"  target="_self" href="<?php echo base_url() . $file; ?>" title="Download image" download="<?php echo $filename; ?>" style="padding:4px;display: inline-block;" ><i class="fa fa-download"></i> Download</a>
                        </div>
                        <div class="tools" style="margin: 20px 0">
                          <a class="btn w3-small" onclick="removeImageInfo('<?php echo $key; ?>', '<?php echo $activityDetails[0]['activity_id']; ?>')" id="image_<?php echo $activityDetails[0]['activity_id']; ?>" title="Delete image" style="padding:4px;display: inline-block;" ><i class="fa fa-close"></i> Delete Image</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                  $count++;
                }
              } else {
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
                  <form id="upload_imageForm" enctype="multipart/form-data">
                    <input type="hidden" name="work_item" value="<?php echo $activityDetails[0]['work_item']; ?>">
                    <input type="hidden" name="activity" value="<?php echo $activityDetails[0]['activity_name']; ?>">
                    <input type="hidden" name="activity_comment" value="<?php echo $activityDetails[0]['comments']; ?>">
                    <input type="hidden" name="activity_id" value="<?php echo base64_encode($activityDetails[0]['activity_id']); ?>">
                    <label>Select File: <font color ="red"><span id ="simage_star">*</span></font></label>
                    <input type="file" name="activity_file" id="activity_file" class="w3-input w3-border" style="padding:5px" required>
                    <span class="w3-text-red w3-small" id="file_error"></span>
                    <div class="w3-col l12 w3-margin-top">
                      <button type="submit" title="upload file" id="uploadFilebtn" class="btn theme_bg"><i class="fa fa-upload"></i> Upload File</button>
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
<script src="<?php echo base_url(); ?>assets/js/module/user/editSite.js"></script>

<!-- /page content