<!-- page content --> 

<div class="right_col" role="main" ng-app="siteApp" ng-cloak ng-controller="siteCtrl">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Site Inspection Controller </h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
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
                  if(empty($allWitems)){
                    ?>
                    <li class="w3-border-bottom w3-padding w3-center w3-text-red">
                      <span>
                        No Work Item Found
                      </span>
                    </li>
                    <?php 
                  }else
                  {
                    foreach ($allWitems as $item){
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
                        if($allWitems){
                          foreach ($allWitems as $key) {
                            echo '<option value="'.$key['witem_id'].'">'.$key['witem_name'].'</option>';
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-lg-12 col-xs-12 col-sm-12 w3-margin-bottom">
                      <label>Enter Activity: (max. 255 chars)</label>
                      <input type="text" name="activity" style="padding: 5px 2px 5px 5px" class="w3-input" id="activity" placeholder="Enter Activity here." maxlength="255">
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12 w3-margin-bottom ">
                      <label>Comments (if any - optional):</label>
                      <textarea class="w3-input" name="activity_comment" placeholder="Type here for detailed information" rows="4" required></textarea>
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
            <div class="w3-col l12 w3-margin-top" style="height: 450px;overflow-y: scroll;">
            </div>
          </div>
        </div>
      </div>
      <!-- view all document div ends -->
    </div>
  </div>
</div>
<script src="<?php echo base_url();?>assets/js/module/user/sitecontroller.js"></script>

        <!-- /page content