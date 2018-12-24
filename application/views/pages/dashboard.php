
<title>Dashboard</title>


<div class="right_col" role="main">
    <!-- top tiles -->
  <!----      <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
                <div class="count">2500</div>
                <span class="count_bottom"><i class="green">4% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>
                <div class="count">123.50</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
                <div class="count green">2,500</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
                <div class="count">4,567</div>
                <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
                <div class="count">2,315</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
                <div class="count">7,325</div>
                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
        </div> --->
    <!-- /top tiles -->

 <!---   <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;" >
        <div id="err_message"></div>
        <div class="row x_title">
            <div class="w3-padding">
                <h3><i class="fa fa-cubes"></i> All Companies </h3>
            </div>
        </div>
        <div class="container x_title" style=" margin-top: 5px;">
      
        </div>
    </div> --->

    <div class="w3-col l12 w3-padding-small w3-margin-top page_title">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-list"></i> All Pending Queries</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="container x_content">
            	<div class="w3-col l12 w3-margin-left w3-padding-small w3-center" id="message"></div>
                <div id="table_msg"></div>
                <div class="w3-col l12 w3-padding w3-small" id="allDocumentDiv">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr >
                                <th class="text-center">Sr.No</th>
                                <th class="text-center">Query Title</th>
                                <th class="text-center">Query Raised To</th>                        
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //print_r($queries);
                            $i = 1;
                            if ($queries['status'] != 500) {
                                foreach ($queries['status_message'] as $val) {
                                    ?>
                                    <tr class="w3-center">
                                        <td style=" vertical-align: middle;"><?php echo $i; ?></td>
                                        <td style=" vertical-align: middle;"><?php echo $val['query_title']; ?></td>
                                        <td style=" vertical-align: middle; width: 450px;"><p><?php echo $val['raised_to']; ?></p></td>                                        
                                        <td style=" vertical-align: middle;">
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" id="actionBtn_<?php echo $val['query_id']; ?>" class="btn btn-default w3-small dropdown-toggle" type="button" style="padding: 2px 6px">Action <span class="caret"></span>
                                                </button>
                                                <ul role="menu" class="dropdown-menu pull-right">              
                                                    <li>
                                                        <a title="View Query" class="btn btn-xs text-left" data-toggle="modal" data-target="#RFIModal_<?php echo $val['query_id']; ?>" onclick="openHelp('<?php echo $val['query_id']; ?>')">View Query</a>
                                                    </li>
                                                    <?php
                                                    $user_role = $this->session->userdata('role');
                                                    if ($user_role == 'company_admin') {
                                                        $user_name = $this->session->userdata('usersession_name');
                                                    } else {
                                                        $user_name = $this->session->userdata('user_name');
                                                    }
                                                    if ($user_role == 'company_admin' || $user_name == $val['created_by']) {
                                                        ?>
                                                        <li><a title="Approve Query" class="btn btn-xs text-left" onclick="updateQueryStatus('<?php echo $val['query_id']; ?>');" >Approve Query</a>
                                                        </li>
                                                         <li><a title="Reject Query" class="btn btn-xs text-left" onclick="RejectQueryStatus('<?php echo $val['query_id']; ?>');" >Reject Query</a>
                                                        </li>
                                                   <!--     <li>
                                                            <a class="btn btn-xs text-left" onclick="removeQuery('<?php echo $val['query_id']; ?>')" title="Delete document">Delete Query</a>
                                                        </li> -->
                                                        <?php
                                                    }
                                                    ?>

                                                </ul>
                                            </div>
                                        </td>
                                    </tr>  
                                    <!-- Modal to View Query -->
                                <div class="modal fade bs-example-modal-lg" id="RFIModal_<?php echo $val['query_id']; ?>" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-md ">
                                        <!-- Modal content View Query -->
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title w3-left w3-margin-left"><b>Query:</b> <?php echo $val['query_title']; ?></h4>
                                            </div>
                                            <!-- Modal body starts -->
                                            <div class="modal-body">
                                                <!-- Modal container starts -->
                                                <div class="container"> 
                                                    <div class="col-lg-12">
                                                        <div class="w3-col l12 w3-padding w3-medium">
                                                            <label>Description: </label>
                                                            <p>                                        
                                                                <?php echo $val['query_description']; ?>
                                                            </p>
                                                        </div>    
                                                         <div class="w3-col l12 w3-padding w3-medium">
                                                            <label>Query Raised To : </label>
                                                            <p>                                        
                                                                <?php echo $val['raised_to']; ?>
                                                            </p>
                                                        </div>                        
                                                        <div class="w3-col l12 w3-margin-bottom w3-padding w3-medium">

                                                          <?php
                                                            if ($val['images'] != '[]' && $val['images'] != '') {
                                                                $image_arr = json_decode($val['images']);
                                                                $count = 1;
                                                                echo '<label>Images: </label><br>';
                                                                foreach ($image_arr as $file) {
                                                                    $arr = explode('/', $file);
                                                                    $filename = $arr[3];
                                                                    $ext_arr = explode('.', $file);
                                                                    $ext = end($ext_arr);
                                                                    ?>
                                                                    <div class="col-md-3">
                                                                        <div class="image view view-first" style="height: 100px">
                                                                            <img style="width: 100%;height:100%" class="img img-thumbnail" src="<?php echo base_url() . $file; ?>" alt="image">
                                                                            <div class="mask no-caption">
                                                                                <div class="tools" style="margin: 20px 0">
                                                                                    <a class="btn w3-small"  target="_self" href="<?php echo base_url() . $file; ?>" title="Download image" download="<?php echo $filename; ?>" style="padding:4px;display: inline-block;" ><i class="fa fa-download"></i> download</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    $count++;
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                   <!--   <div class="col-lg-12 w3-medium">
                                                            <hr>
                                                            <label>Comments: </label>
                                                        <form id="rfiReply_form_<?php echo $val['query_id']; ?>">
                                                                <div class="w3-col l12 w3-round w3-light-grey w3-padding w3-margin-bottom">
                                                                    <textarea name="comment_posted" id="comment_posted_<?php echo $val['query_id']; ?>" class="w3-input w3-margin-bottom" rows="2" placeholder="Type here to reply..." required></textarea>
                                                                    <input type="hidden" id="query_id" name="query_id" value="<?php echo $val['query_id']; ?>">
                                                                    <div class="comment_msg"></div>
                                                                    <button id="commentBtn" class="btn theme_bg btn-small w3-small pull-right" onclick="savecomment('<?php echo $val['query_id']; ?>');" type="button"><i class="fa fa-reply"></i> Post Comment</button>
                                                                </div>
                                                            </form>

                                                            <div class="w3-col l12 w3-small comment_list" id="comment_list_<?php echo $val['query_id']; ?>">

                                                            </div>
                                                        </div> -->
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
                                $i++;
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="5" class="w3-center theme_text"><b>No Requests Raised.</b></td>
                            </tr>
                        <?php } ?>                       
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<?php ?>
<script>
//--------update query
function updateQueryStatus(query_id) {
    $.confirm({
        title: '<h4 class="w3-text-red">Please confirm the action!</h4><span class="w3-medium">Do you really want to Change Status to Approved Of this Query?</span>',
        content: '',
        type: 'red',
        buttons: {
            confirm: function () {
                $.ajax({
                    type: "GET",
                    url: BASE_URL + "user_dashboard/updateQueryStatus",
                    data: {
                        query_id: query_id
                    },
                    cache: false,
                    success: function (response) {
                      // alert(response);
                        var data = JSON.parse(response);
                        switch (data.status) {
                            case 'success':
                                $('#message').html(data.message);
                                break;
                            case 'error':
                                $('#message').html(data.message);
                                break;
                            default:
                                $('#message').html('<div class="alert alert-danger alert-dismissible" style="margin-bottom:5px"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><b>Error:</b> Something went wrong! Try refreshing page and Save again.!</strong></div>');
                                setTimeout(function () {
                                    $('.alert_message').fadeOut('fast');
                                }, 8000); // <-- time in milliseconds
                                break;
                        }
                    }
                });
            },
            cancel: function () {
            }
        }
    });
}
</script>
<script>
// ----function to open modal product------//
function openHelp(modal_id) {
    var modal = $('#RFIModal_' + modal_id);
    modal.addClass('in');
    getComments(modal_id);
    $('.comment_msg').html('');

}
</script> 
<script>
//--------Reject query
function RejectQueryStatus(query_id) {
    $.confirm({
        title: '<h4 class="w3-text-red">Please confirm the action!</h4><span class="w3-medium">Do you really want to Reject this Query?</span>',
        content: '',
        type: 'red',
        buttons: {
            confirm: function () {
                $.ajax({
                    type: "GET",
                    url: BASE_URL + "user_dashboard/RejectQueryStatus",
                    data: {
                        query_id: query_id
                    },
                    cache: false,
                    success: function (response) {
                      // alert(response);
                        var data = JSON.parse(response);
                        switch (data.status) {
                            case 'success':
                                $('#message').html(data.message);
                                break;
                            case 'error':
                                $('#message').html(data.message);
                                break;
                            default:
                                $('#message').html('<div class="alert alert-danger alert-dismissible" style="margin-bottom:5px"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><b>Error:</b> Something went wrong! Try refreshing page and Save again.!</strong></div>');
                                setTimeout(function () {
                                    $('.alert_message').fadeOut('fast');
                                }, 8000); // <-- time in milliseconds
                                break;
                        }
                    }
                });
            },
            cancel: function () {
            }
        }
    });
}
</script>        
<!-- /page content -->
<!-- script for category -->

