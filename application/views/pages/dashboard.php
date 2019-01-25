
<title>Dashboard</title>


<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="row tile_count">
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Documents</span>
            <div class="count green"><?php echo $countofDocuments['status_message'][0]['COUNT(document_id)']; ?></div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Total Queries</span>
            <div class="count green"><?php echo $countofQuery['status_message'][0]['COUNT(query_id)']; ?></div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Pending Queries</span>
            <div class="count green"><?php echo $countofPendingQuery['status_message'][0]['COUNT(query_id)']; ?></div>
        </div>

        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Working Users</span>
            <div class="count green"><?php echo $countoFUser['status_message'][0]['COUNT(user_id)']; ?></div>
        </div>
    </div> 
    <!-- /top tiles -->

    <div class="row">
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
                    <div class="w3-col l12 w3-padding w3-text-black"><span class="w3-large">Status Priorities:</span></div>
                    <div class="w3-col l12 w3-padding">
                        <div class="col-md-3 w3-padding" style=" background-color: #ff8080;">
                            <span class="w3-text-white">Not Seen From 3 hr.</span>
                        </div>
                        <div class="col-md-1"></div>

                        <div class="col-md-3 w3-padding" style=" background-color: #ff3333;">
                            <span class="w3-text-white">Not Seen From 4 hr.</span>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-3 w3-padding" style=" background-color: #cc0000;">
                            <span class="w3-text-white">Not Seen From 5 hr.</span>
                        </div>
                    </div>
                    <div id="table_msg"></div>
                    <div class="w3-col l12 w3-padding w3-small" id="">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr >
                                    <th class="text-center">Sr.No</th>
                                    <th class="text-center">Query Title</th>
                                    <th class="text-center">Query Raised By</th>
                                    <th class="text-center">Raised Date</th>
                                    <th class="text-center">Query Raised To</th>                        
                                    <th class="text-center">Status</th>                        
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                if ($queries['status'] != 500) {
                                    foreach ($queries['status_message'] as $val) {
                                        $date_a = new DateTime($val['created_date']);
                                        $dat = date("Y-m-d H:i:s");
                                        $date_b = new DateTime($dat);
                                        //echo $date_a.'/'.$date_b;
                                        $interval = date_diff($date_a, $date_b);
                                        $diff = $interval->format('%h');
                                        //echo $diff;
                                        if ($diff >= 3) {
                                            $bgcolor = "background-color: #ff8080";
                                        } elseif ($diff >= 4) {
                                            $bgcolor = "background-color: #ff3333";
                                        } elseif ($diff >= 5) {
                                            $bgcolor = "background-color: #cc0000";
                                        } else {
                                            $bgcolor = "background-color: #ffffff";
                                        }

                                        $session_role = $this->session->userdata('role');
                                        if ($session_role == 'company_admin') {
                                            $author = 'Administrator';
                                        } else {
                                            $role = $this->session->userdata('role');
                                            $user_name = $this->session->userdata('user_name');
                                            $author = explode('/', $role);
                                            $roleid = $author[0];
                                            $rolename = $author[1];
                                            $author = $user_name;
                                        }

                                        if ($rolename == $val['raised_to'] || $role == 'company_admin') {
                                            ?>
                                            <tr class="w3-center">
                                                <td style=" vertical-align: middle;"><?php echo $i; ?></td>
                                                <td style=" vertical-align: middle;"><?php echo $val['query_title']; ?></td>
                                                <td style=" vertical-align: middle;"><?php echo $val['created_by']; ?></td>
                                                <td style=" vertical-align: middle;"><?php echo $val['created_date']; ?></td>
                                                <td style=" vertical-align: middle;"><p><?php echo $val['raised_to']; ?></p></td>                                        
                                                <td style=" vertical-align: middle; <?php echo $bgcolor; ?>" ></td>                                        
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
                                                        <?php //echo $user_name; ?>

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
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="7" class="w3-center theme_text"><b>No Requests Raised.</b></td>
                                </tr>
                            <?php } ?>                       
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- All queries for checklist failure -->
    <!--all raised queries for checklist failure starts here--> 
    <div class="row">
        <div class="w3-col l12 w3-padding-small w3-margin-top page_title">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-list"></i> All Raised Queries For Checklist Failure</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="container x_content">
                    <div class="w3-col l12 w3-margin-left w3-padding-small w3-center" id="message"></div>
                    <div id="table_msg"></div>
                    <div class="w3-col l12 w3-padding w3-small" id="">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr >
                                    <th class="text-center">Sr.No</th>
                                    <th class="text-center">Query Title</th>
                                    <th class="text-center">Query Raised By</th>
                                    <th class="text-center">Raised Date</th>
                                    <th class="text-center">Status</th>                        
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                if ($checklistQueries['status'] != 500) {
                                    foreach ($checklistQueries['status_message'] as $val) {
                                        ?>
                                        <tr class="w3-center">
                                            <td style=" vertical-align: middle;"><?php echo $i; ?></td>
                                            <td style=" vertical-align: middle;"><?php echo $val['query_title']; ?></td>
                                            <td style=" vertical-align: middle;"><?php echo $val['created_by']; ?></td>
                                            <td style=" vertical-align: middle;"><?php echo $val['created_date']; ?></td>
                                            <td style=" vertical-align: middle;"><span class="badge">Pending</span></td>                                        
                                            <td style=" vertical-align: middle;">
                                                <div class="btn-group">
                                                    <button data-toggle="modal" data-target="#RFIModal_<?php echo $val['query_id']; ?>" onclick="openHelp('<?php echo $val['query_id']; ?>')" class="btn btn-default w3-small dropdown-toggle w3-blue" type="button" style="padding: 2px 6px">View</button>
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
                                                    <div class="col-lg-6">
                                                        <h4 class="modal-title w3-left w3-margin-left"><b>Query:</b> <?php echo $val['query_title']; ?></h4>
                                                    </div>
                                                </div>
                                                <!-- Modal body starts -->
                                                <div class="modal-body">
                                                    <!-- Modal container starts -->
                                                    <div class="container"> 
                                                        <div class="w3-col l12 w3-padding w3-medium">
                                                            <div class="col-lg-6">
                                                                <label>Description : </label>
                                                                <p>                                        
                                                                    <?php echo $val['query_description']; ?>
                                                                </p>
                                                            </div> 
                                                            <div class="col-lg-6">
                                                                <label>Created date : </label>
                                                                <p>                                        
                                                                    <?php echo $val['created_date']; ?>
                                                                </p>
                                                            </div> 
                                                        </div>
                                                        <div class="w3-col l12 w3-padding w3-medium">
                                                            <div class="col-lg-6">
                                                                <label>Created By : </label>
                                                                <p>
                                                                    <?php echo $val['created_by']; ?>
                                                                </p>
                                                            </div> 
                                                            <div class="col-lg-6">
                                                                <label>Status : </label>
                                                                <span class="badge">Pending</span>
                                                            </div> 
                                                        </div>
                                                        <!--                                                        <div class="w3-col l12 w3-padding w3-medium">
                                                                                                                    <label>Query Raised To : </label>
                                                                                                                    <p>
                                                        <?php
//                                                                $shared = json_decode($val['shared_with'], TRUE);
//                                                                foreach ($shared as $row) {  
                                                        ?>
                                                                                                                        
                                                                                                                        <span><i class="fa fa-check w3-text-green"></i><?php ?></span><br>
                                                        <?php //}   ?>
                                                                                                                    </p>
                                                                                                                </div>                        -->

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
                            <td colspan="7" class="w3-center theme_text"><b>No Requests Raised.</b></td>
                        </tr>
                    <?php } ?>                       
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--all raised queries for checklist failure ends here-->

<!-- All pending documents for request module -->
<div class="row">
    <div class="w3-col l12 w3-padding-small w3-margin-top page_title">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-list"></i> All Pending and Uploaded Document Request For Request Module</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
<!--                <div class="w3-col l12 w3-padding w3-text-black" id="message"><span class="w3-medium"></span></div>-->

            <div class="container x_content">
                <div id="table_msg"></div>
                <div class="w3-col l12 w3-padding w3-small" id="allDocumentDiv" style=" overflow: auto">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Sr.No</th>
                                <th class="text-center">Document Name</th>
                                <th class="text-center">Requested By</th>
                                <th class="text-center">Requested From</th> 
<!--                                    <th class="text-center">Added Date</th>                        -->
                                <th class="text-center">Estimated Date</th>                        
                                <th class="text-center">Uploaded Date</th>                        
                                <th class="text-center">Delay</th>                        
                                <th class="text-center">Status</th>                        
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //print_r($approveRequests);
                            $i = 1;
                            $status = '';
                            $col = '';
                            if ($requests['status'] != 500) {
                                foreach ($requests['status_message'] as $val) {
                                    $role = $this->session->userdata('role');
                                    if ($role == 'company_admin') {
                                        $rolename = 'Administrator';
                                    } else {
                                        $role = $this->session->userdata('role');
                                        $user_name = $this->session->userdata('user_name');
                                        $author_new = explode('/', $role);
                                        $roleid = $author_new[0];
                                        $rolename = $author_new[1];
                                        $author = $user_name;
                                    }
                                    if ($val['status'] == '0') {
                                        $status = 'Pending';
                                        $color = 'w3-blue';
                                    } else {
                                        $status = 'Uploaded';
                                        $color = 'w3-green';
                                    }

                                    if ($val['estimated_date'] > $val['accepted_date']) {
                                        $col = 'w3-text-green';
                                    }
                                    if ($val['estimated_date'] < $val['accepted_date']) {
                                        $col = 'w3-text-red';
                                    }

                                    $date_a = new DateTime($val['estimated_date']);
                                    $dat = date("Y-m-d H:i:s");
                                    $date_b = new DateTime($val['accepted_date']);
                                    //echo $date_a.'/'.$date_b;
                                    $interval = date_diff($date_a, $date_b);
                                    $diff = $interval->format('%a');
                                    //echo $diff;
                                    if ($diff == 0) {
                                        $col = 'w3-text-green';
                                    }
                                    //echo $rolename . '//' . $val['requested_from'] . '<br>';
                                    if ($rolename == $val['requested_from'] || $role == 'company_admin') {
                                        ?>
                                        <tr class="w3-center">
                                            <td style=" vertical-align: middle;"><?php echo $i; ?></td>
                                            <td style=" vertical-align: middle;"><?php echo $val['document_name']; ?></td>
                                            <td style=" vertical-align: middle;"><?php echo $val['requested_by']; ?></td>
                                            <td style=" vertical-align: middle;"><p><?php echo $val['requested_from']; ?></p></td>  
            <!--                                                <td style=" vertical-align: middle;"><p><?php echo $val['created_date']; ?></p></td>                                    -->
                                            <td style=" vertical-align: middle;"><?php echo $val['estimated_date']; ?></td>                                    
                                            <td style=" vertical-align: middle;"><?php echo $val['accepted_date']; ?></td>                                    
                                            <td style=" vertical-align: middle;">
                                                <span class="<?php echo $col; ?>"><?php
                                                    $date_a = new DateTime($val['estimated_date']);
                                                    $dat = date("Y-m-d H:i:s");
                                                    $date_b = new DateTime($val['accepted_date']);
                                                    //echo $date_a.'/'.$date_b;
                                                    $interval = date_diff($date_a, $date_b);
                                                    $diff = $interval->format('%a');
                                                    echo $diff;
                                                    ?>
                                                </span>
                                            </td>                                    
                                            <td style=" vertical-align: middle;"><span class="badge <?php echo $color; ?>"><?php echo $status; ?></span></td>                                    
                                            <td style=" vertical-align: middle;">
                                                <div class="btn-group">
                                                    <?php if ($val['status'] == '0') { ?>
                                                        <a id="actionBtn_<?php echo $val['request_id']; ?>" href="<?php echo base_url(); ?>user_dashboard/uploadDocument/<?php echo base64_encode($val['request_id'] . '/' . $val['document_name'] . '/' . $val['requested_by']); ?>" class="btn w3-small w3-blue" style="padding: 2px 6px">Upload</a>
                                                    <?php } else { ?>
                                                        <a id="" class="btn w3-small w3-blue" style="padding: 2px 6px" disabled="disabled">Uploaded</a>
                                                    <?php } ?>
                                                    <!--                                                        <ul role="menu" class="dropdown-menu pull-right">              
                                                                                                                <li>
                                                                                                                    <a title="View Query" class="btn btn-xs text-left" data-toggle="modal" data-target="#RFIModal_<?php echo $val['request_id']; ?>" onclick="openHelp('<?php echo $val['request_id']; ?>')">View Query</a>
                                                                                                                </li>-->
                                                    <?php
//                                                            $user_role = $this->session->userdata('role');
//                                                            if ($user_role == 'company_admin') {
//                                                                $user_name = $this->session->userdata('usersession_name');
//                                                            } else {
//                                                                $user_name = $this->session->userdata('user_name');
//                                                            }
//                                                            if ($user_role == 'company_admin' || $user_name == $val['created_by']) {
                                                    ?>
                                                    <!--                                                                <li><a title="Resolved query" class="btn btn-xs text-left" oncick="lupdateQuery('<?php echo $val['request_id']; ?>');" >Resolved</a>
                                                                                                                    </li>-->
                                                    <!--     <li>
                                                             <a class="btn btn-xs text-left" onclick="removeQuery('<?php echo $val['query_id']; ?>')" title="Delete document">Delete Query</a>
                                                         </li> -->
                                                    <?php
//                                                            }
                                                    ?>
                                                    <!--                                                        </ul>-->
                                                </div>
                                            </td>
                                        </tr>                                                              
                                        <?php
                                        $i++;
                                    } 
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="9" class="w3-center theme_text"><b>No Requests Raised.</b></td>
                                </tr>
                            <?php } ?>                       
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--all pending documents for request module ends here-->
<!-----------------------------------------------Div for documents are starts here------------------------------------>
<!-- view all document div -->
<div class="row">
    <div class="w3-col l12 w3-padding-small w3-margin-top page_title">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-list"></i> Documents For Deletion</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <?php //print_r($allDocuments);          ?>
            <div class="container x_content">
                <div id="table_msg"></div>
                <div class="w3-col l12 w3-padding w3-small" id="">
                    <table id="" class="table table-striped table-bordered">
                        <thead>
                            <tr >
                                <td class="text-center">Sr.No</td>
                                <th class="text-center">Doc Title</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Revision No</th>
                                <th class="text-center">Reason</th>
                                <th class="text-center">Uploaded by</th>
                                <th class="text-center">Added date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $role_id = '';
                            $sharedRoles = '';
                            $i = 1;
                            if ($allDocuments['status'] == 200) {
                                foreach ($allDocuments['status_message'] as $doc) {
                                    $role = $this->session->userdata('role');
                                    if ($role == 'company_admin') {
                                        
                                    } else {
                                        $role = $this->session->userdata('role');
                                        $sessionArr = explode('/', $role);
                                        $role_id = $sessionArr[0];
                                        $role_name = $sessionArr[1];
                                    }
                                    //$sharedRoles = json_decode($doc['shared_with'], TRUE);
                                    //if (in_array($role_id, $sharedRoles) || $role == 'company_admin') {
                                    ?>

                                    <tr class="w3-center">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $doc['document_title']; ?></td>
                                        <td><?php echo $doc['document_type']; ?></td>
                                        <td>#<?php echo $doc['revision_no']; ?></td>
                                        <td width="250px"><p><?php echo $doc['reason_type'] . ' (' . $doc['delete_reason'] . ')'; ?></p></td>
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
                                                    <li><a title="View files" class="btn btn-xs text-left" data-toggle="modal" data-target="#DocModal_<?php echo $doc['document_id']; ?>" onclick="openHelpDoc('<?php echo $doc['document_id']; ?>')">View Files</a>
                                                    </li>
                                                    <?php
                                                    $user_role = $this->session->userdata('role');
                                                    if ($user_role == 'company_admin') {
                                                        $user_name = $this->session->userdata('usersession_name');
                                                    } else {
                                                        $user_name = $this->session->userdata('user_name');
                                                    }
                                                    if ($user_role == 'company_admin' || $user_name == $doc['created_by']) {
                                                        ?>
                                                        <li>
                                                            <a class="btn btn-xs text-left" onclick="removeDoc('<?php echo base64_encode($doc['document_id']); ?>', '<?php echo $doc['document_id']; ?>')" title="Delete Document">Delete Document</a>
                                                        </li>
                                                        <?php
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
                                            <!--      Modal body starts -->
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
                                                                    <a class="w3-text-grey btn w3-round"  target="_self" href="<?php echo base_url() . $file; ?>"  download="<?php echo 'File_' . $count . '.' . $ext; ?>" title="Download <?php echo $filename; ?>" style="padding:4px;display: inline-block;"><b></b><i class="fa <?php echo $image; ?> w3-jumbo"></i></a>
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
                                <?php
                                $i++;
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="9" class="w3-center theme_text"><b>No Pending Documents For Deletion</b></td>
                            </tr>
                        <?php } ?>                       
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- view all document div ends -->
<!------------------------------------------ends here ---------------------------------------------------->

<!-----------------------------------------------Div for top 10 documents are starts here------------------------------------>
<!-- view Top 10 document list -->
<div class="row">
    <div class="w3-col l12 w3-padding-small w3-margin-top page_title">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-list"></i> Recent Documents </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <?php //print_r($allDocuments);          ?>
            <div class="container x_content">
                <div id="table_msg"></div>
                <div class="w3-col l12 w3-padding w3-small" id="">
                    <table id="" class="table table-striped table-bordered">
                        <thead>
                            <tr >
                                <td class="text-center">Sr.No</td>
                                <th class="text-center">Doc Title</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Revision No</th>
                                <th class="text-center">Added by</th>
                                <th class="text-center">Added date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $role_id = '';
                            $sharedRoles = '';
                            $i = 1;
                            if ($topDocuments['status'] == 200) {
                                foreach ($topDocuments['status_message'] as $top) {
                                    $role = $this->session->userdata('role');
                                    if ($role == 'company_admin') {
                                        
                                    } else {
                                        $role = $this->session->userdata('role');
                                        $sessionArr = explode('/', $role);
                                        $role_id = $sessionArr[0];
                                        $role_name = $sessionArr[1];
                                    }
                                    ?>

                                    <tr class="w3-center">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $top['document_title']; ?></td>
                                        <td><?php echo $top['document_type']; ?></td>
                                        <td>#<?php echo $top['revision_no']; ?></td>
                                        <td><?php echo $top['created_by']; ?></td>
                                        <td><?php
                                            $dtime = new DateTime($top['created_date']);
                                            echo $dtime->format("d M y H:i a");
                                            ?>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" id="actionBtn_<?php echo $top['document_id']; ?>" class="btn btn-default w3-small dropdown-toggle" type="button" style="padding: 2px 6px">Action <span class="caret"></span>
                                                </button>
                                                <ul role="menu" class="dropdown-menu pull-right">
                                                    <li><a title="View files" class="btn btn-xs text-left" data-toggle="modal" data-target="#DocModal_<?php echo $top['document_id']; ?>" onclick="openHelpDoc('<?php echo $top['document_id']; ?>')">View Files</a>
                                                    </li>
                                                    <?php
                                                    $user_role = $this->session->userdata('role');
                                                    if ($user_role == 'company_admin') {
                                                        $user_name = $this->session->userdata('usersession_name');
                                                    } else {
                                                        $user_name = $this->session->userdata('user_name');
                                                    }
                                                    if ($user_role == 'company_admin' || $user_name == $top['created_by']) {
                                                        ?>
                                                        <li>


                                                        </li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <!--Modal to edit product--> 
                                <div class="modal fade bs-example-modal-lg" id="DocModal_<?php echo $top['document_id']; ?>" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-md ">
                                        <!--                                                Modal content starts -->
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                </button>
                                                <h3 class="modal-title w3-center"><?php echo $top['document_title']; ?> <span class="badge w3-grey w3-text-white w3-small"><?php echo $top['document_type']; ?></span></h3>
                                            </div>
                                            <!--                                                    Modal body starts -->
                                            <div class="modal-body">
                                                <!--                                                        Modal container starts -->
                                                <div class="container"> 
                                                    <div class="col-lg-12">
                                                        <div class="w3-col l12 w3-padding">
                                                            <span class="pull-left"><b>Revision No.:</b> #<?php echo $top['revision_no']; ?></span>
                                                            <span class="pull-right"><b>Uploaded By:</b> <?php echo $top['created_by']; ?>, <?php echo $dtime->format("d M y H:i:s"); ?></span>
                                                        </div>
                                                        <?php
                                                        $image_arr = json_decode($top['document_file']);
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
                                                                    <a class="w3-text-grey btn w3-round"  target="_self" href="<?php echo base_url() . $file; ?>"  download="<?php echo 'File_' . $count . '.' . $ext; ?>" title="Download <?php echo $filename; ?>" style="padding:4px;display: inline-block;"><b></b><i class="fa <?php echo $image; ?> w3-jumbo"></i></a>
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
                                <?php
                                $i++;
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="9" class="w3-center theme_text"><b>Document Not Found</b></td>
                            </tr>
                        <?php } ?>                       
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- view all document div ends -->

</div>

<?php ?>
<script>
    // ----function to open modal product------//
    function openHelpDoc(modal_id) {
        var modal = $('#DocModal_' + modal_id);
        modal.addClass('in');
    }
    // fucntion to delete document
    function removeDoc(doc_id, key) {
        $.confirm({
            title: '<h4 class="w3-text-red">Please confirm the action!</h4><span class="w3-medium">Are You Sure..? You Want To Delete This Document?</span>',
            type: 'red',
            content: '',
            buttons: {
                confirm: function () {
                    $.ajax({
                        type: "GET",
                        url: BASE_URL + "modules/manage_documents/removeDoc",
                        data: {
                            doc_id: doc_id
                        },
                        cache: false,
                        beforeSend: function () {
                            $('#actionBtn_' + key).html('<i class="fa fa-circle-o-notch fa-spin"></i> Sending');
                        },
                        success: function (data) {
                            $('#table_msg').html(data);
                            $('#actionBtn_' + key).html('Action <span class="caret"></span>');

                            window.setTimeout(function () {
                                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                                    $(this).remove();
                                });
                                window.location.reload();
                            }, 1500);
                        },
                        error: function (data) {
                            $('#table_msg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
                            $('#actionBtn_' + key).html('Action <span class="caret"></span>');
                            window.setTimeout(function () {
                                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                                    $(this).remove();
                                });
                            }, 5000);
                        }
                    });
                },
                cancel: function () {
                }
            }
        });
    }

//--------update query
    function updateQueryStatus(query_id) {
        $.confirm({
            title: '<h4 class="w3-text-green">Please confirm the action!</h4><span class="w3-medium">Do you really want to Change Status to Approved Of this Query?</span>',
            content: '',
            type: 'green',
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

    function approveRequest(request_id) {
        $.confirm({
            title: '<h4 class="w3-text-green">Please confirm the action!</h4><span class="w3-medium">Do you really want to Change Status to Approved Of this Request?</span>',
            content: '',
            type: 'green',
            buttons: {
                confirm: function () {
                    $.ajax({
                        type: "GET",
                        url: BASE_URL + "user_dashboard/approveRequest",
                        data: {
                            request_id: request_id
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

    function rejectRequest(request_id) {
        $.confirm({
            title: '<h4 class="w3-text-green">Please confirm the action!</h4><span class="w3-medium">Do you really want to Change Status to Approved Of this Request?</span>',
            content: '',
            type: 'green',
            buttons: {
                confirm: function () {
                    $.ajax({
                        type: "GET",
                        url: BASE_URL + "user_dashboard/rejectRequest",
                        data: {
                            request_id: request_id
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
        //getComments(modal_id);
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

