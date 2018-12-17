<!-- page content --> 
<style type="text/css">
/* ================ The Timeline ================ */

.timeline {
  position: relative;
  width: 660px;
  margin: 0 auto;
  margin-top: 20px;
  padding: 1em 0;
  list-style-type: none;
}

.timeline:before {
  position: absolute;
  left: 50%;
  top: 0;
  content: ' ';
  display: block;
  width: 6px;
  height: 100%;
  margin-left: -3px;
  background: rgb(80,80,80);
  background: -moz-linear-gradient(top, rgba(80,80,80,0) 0%, rgb(80,80,80) 8%, rgb(80,80,80) 92%, rgba(80,80,80,0) 100%);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(30,87,153,1)), color-stop(100%,rgba(125,185,232,1)));
  background: -webkit-linear-gradient(top, rgba(80,80,80,0) 0%, rgb(80,80,80) 8%, rgb(80,80,80) 92%, rgba(80,80,80,0) 100%);
  background: -o-linear-gradient(top, rgba(80,80,80,0) 0%, rgb(80,80,80) 8%, rgb(80,80,80) 92%, rgba(80,80,80,0) 100%);
  background: -ms-linear-gradient(top, rgba(80,80,80,0) 0%, rgb(80,80,80) 8%, rgb(80,80,80) 92%, rgba(80,80,80,0) 100%);
  background: linear-gradient(to bottom, rgba(80,80,80,0) 0%, rgb(80,80,80) 8%, rgb(80,80,80) 92%, rgba(80,80,80,0) 100%);
  
  z-index: 5;
}

.timeline li {
  padding: 1em 0;
}

.timeline li:after {
  content: "";
  display: block;
  height: 0;
  clear: both;
  visibility: hidden;
}

.direction-l {
  position: relative;
  width: 300px;
  float: left;
  text-align: right;
}

.direction-r {
  position: relative;
  width: 300px;
  float: right;
}

.flag-wrapper {
  position: relative;
  display: inline-block;
  
  text-align: center;
}

.flag {
  position: relative;
  display: inline;
  background: rgb(248,248,248);
  padding: 6px 10px;
  border-radius: 5px;
  
  font-weight: 600;
  text-align: left;
}

.direction-l .flag {
  -webkit-box-shadow: -1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
  -moz-box-shadow: -1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
  box-shadow: -1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
}

.direction-r .flag {
  -webkit-box-shadow: 1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
  -moz-box-shadow: 1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
  box-shadow: 1px 1px 1px rgba(0,0,0,0.15), 0 0 1px rgba(0,0,0,0.15);
}

.direction-l .flag:before,
.direction-r .flag:before {
  position: absolute;
  top: 50%;
  right: -40px;
  content: ' ';
  display: block;
  width: 12px;
  height: 12px;
  margin-top: -10px;
  background: #fff;
  border-radius: 10px;
  border: 4px solid rgb(255,80,80);
  z-index: 10;
}

.direction-r .flag:before {
  left: -40px;
}

.direction-l .flag:after {
  content: "";
  position: absolute;
  left: 100%;
  top: 50%;
  height: 0;
  width: 0;
  margin-top: -8px;
  border: solid transparent;
  border-left-color: rgb(248,248,248);
  border-width: 8px;
  pointer-events: none;
}

.direction-r .flag:after {
  content: "";
  position: absolute;
  right: 100%;
  top: 50%;
  height: 0;
  width: 0;
  margin-top: -8px;
  border: solid transparent;
  border-right-color: rgb(248,248,248);
  border-width: 8px;
  pointer-events: none;
}

.time-wrapper {
  display: inline;
  
  line-height: 1em;
  font-size: 0.66666em;
  color: rgb(250,80,80);
  vertical-align: middle;
}

.direction-l .time-wrapper {
  float: left;
}

.direction-r .time-wrapper {
  float: right;
}

.time {
  display: inline-block;
  padding: 4px 6px;
  background: rgb(248,248,248);
}

.desc {
  margin: 3px 5px;
  
  font-size: 0.77777em;
  font-style: italic;
  line-height: 1.5em;
}

.direction-r .desc {
  margin: 3px 5px;
}

/* ================ Timeline Media Queries ================ */

@media screen and (max-width: 660px) {

  .timeline {
    width: 100%;
    padding: 4em 0 1em 0;
  }

  .timeline li {
    padding: 2em 0;
  }

  .direction-l,
  .direction-r {
    float: none;
    width: 100%;

    text-align: center;
  }

  .flag-wrapper {
    text-align: center;
  }

  .flag {
    background: rgb(255,255,255);
    z-index: 15;
  }

  .direction-l .flag:before,
  .direction-r .flag:before {
    position: absolute;
    top: -30px;
    left: 50%;
    content: ' ';
    display: block;
    width: 12px;
    height: 12px;
    margin-left: -9px;
    background: #fff;
    border-radius: 10px;
    border: 4px solid rgb(255,80,80);
    z-index: 10;
  }

  .direction-l .flag:after,
  .direction-r .flag:after {
    content: "";
    position: absolute;
    left: 50%;
    top: -8px;
    height: 0;
    width: 0;
    margin-left: -8px;
    border: solid transparent;
    border-bottom-color: rgb(255,255,255);
    border-width: 8px;
    pointer-events: none;
  }

  .time-wrapper {
    display: block;
    position: relative;
    margin: 4px 0 0 0;
    z-index: 14;
  }

  .direction-l .time-wrapper {
    float: none;
  }

  .direction-r .time-wrapper {
    float: none;
  }

  .desc {
    position: relative;
    margin: 1em 0 0 0;
    padding: 1em;
    background: rgb(245,245,245);
    -webkit-box-shadow: 0 0 1px rgba(0,0,0,0.20);
    -moz-box-shadow: 0 0 1px rgba(0,0,0,0.20);
    box-shadow: 0 0 1px rgba(0,0,0,0.20);

    z-index: 15;
  }

  .direction-l .desc,
  .direction-r .desc {
    position: relative;
    margin: 1em 1em 0 1em;
    padding: 1em;

    z-index: 15;
  }

}

@media screen and (min-width: 400px ?? max-width: 660px) {

  .direction-l .desc,
  .direction-r .desc {
    margin: 1em 4em 0 4em;
  }

}
</style>
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
                            echo '<option value="'.$key['witem_name'].'">'.$key['witem_name'].'</option>';
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
            <div class="w3-col l12 w3-margin-top" style="height: 450px;overflow-y: scroll;">
              <!-- The Timeline -->
              <ul class="timeline">
                <?php 
                if($allActivities){
                  $count='0';
                  $direction='direction-l';
                  foreach ($allActivities as $key) {
                    $dtime = new DateTime($key['created_date']);
                    $dated = $dtime->format("d M Y h:i a");
                    if($count=='1'){
                      $direction='direction-r';
                      $count='0';
                    }
                    else{
                      $direction='direction-l';
                      $count='1';
                    }
                    echo '
                    <li>
                    <div class="'.$direction.'">
                    <div class="flag-wrapper">
                    <span class="flag">'.$key['work_item'].'</span>
                    <span class="time-wrapper"><span class="time"><b>'.$key['created_by'].'</b> '.$dated.'</span></span>
                    </div>
                    <div class="desc w3-small">'.$key['activity_name'].'</div>
                    <div class="desc">'.$key['comments'].'</div>
                    </div>
                    </li>
                    ';
                    ?>
                    <?php 
                  }
                }
                else{
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
<script src="<?php echo base_url();?>assets/js/module/user/sitecontroller.js"></script>

        <!-- /page content