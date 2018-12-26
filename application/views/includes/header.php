<?php
////start session 
$role = $this->session->userdata('role');
// get project session
$projSession = $this->session->userdata('project_id');
$projArr = explode('|', base64_decode($projSession));
$project_id = $projArr[0];
$project_name = strtoupper($projArr[1]);
if ($role == 'company_admin') {
    $admin_name = $this->session->userdata('usersession_name');
    $company_id = $this->session->userdata('company_id');
    $session_name = '';
    if ($admin_name != '') {
//    $sessionArr = explode('|', $admin_name);
        $session_name = $admin_name;
    }
} else {
    $user_name = $this->session->userdata('user_name');
    $user_id = $this->session->userdata('user_id');
    $role = $this->session->userdata('role');
    $grade_id = $this->session->userdata('grade_id');

    $sessionArr = explode('/', $role);
    $role_id = $sessionArr[0];
    $role_name = $sessionArr[1];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="images/favicon.ico" type="image/ico" />
        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo base_url(); ?>assets/fa/css/font-awesome.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="<?php echo base_url(); ?>assets/build/css/custom.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/build/css/w3.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/build/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/build/css/dhtmlxcalendar.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/alert/jquery-confirm.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/build/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <!-- angular-->
        <script src="<?php echo base_url(); ?>assets/js/angular.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/angular-sanitize.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/const.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/dhtmlxcalendar.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/dhtmlxcalendar_deprecated.js"></script>
    </head>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?php echo base_url(); ?>user_dashboard" class="site_title" style="padding-left: 15px">Const.Manager</a>
                    </div>
                    <div class="clearfix"></div>
                    <?php //print_r($features);
                    ?>
                    <!-- sidebar menu -->
                    <?php if ($role == 'company_admin') { ?>
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <!-- <h3>General</h3> -->
                                <ul class="nav side-menu">
                                    <li><a href="<?php echo base_url(); ?>user_dashboard"><i class="fa fa-dashboard"></i> Dashboard </a></li>
                                    <li><a href="<?php echo base_url(); ?>user/create_project"><i class="fa fa-plus-circle"></i> Create Project </a></li>
                                    <li><a href="<?php echo base_url(); ?>user/grant_permission"><i class="fa fa-users"></i> Grant Privilege </a></li>
                                    <li><a href="<?php echo base_url(); ?>user/roles"><i class="fa fa-user-secret"></i> Create Role </a></li>
                                    <li><a href="<?php echo base_url(); ?>user/createuser"><i class="fa fa-user"></i> Create User </a></li>
                                    <li><a href="<?php echo base_url(); ?>modules/site_inspection"><i class="fa fa-check-circle"></i> Site Inspection </a></li>
                                    <li><a href="<?php echo base_url(); ?>modules/raisequery_rfi"><i class="fa fa-question"></i> Raise Query (RFI) </a></li>
                                    <li><a href="<?php echo base_url(); ?>modules/manage_documents"><i class="fa fa-file"></i> Manage Document </a></li> 
                                    <li><a href="<?php echo base_url(); ?>user/user_settings"><i class="fa fa-cog"></i>Settings</a></li>
                                </ul>
                            </div>
                            <div class="menu_section">
                            </div>
                        </div>
                        <!-- /sidebar menu -->
                        <!-- /menu footer buttons -->
                        <div class="sidebar-footer hidden-small w3-center">
                            <a href="<?php echo base_url(); ?>user/user_settings" data-toggle="tooltip" data-placement="top" title="Settings" style="width: 50%;">
                                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url(); ?>login/logoutAdmin" style="width: 50%;">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                            </a>
                        </div>
                        <!-- /menu footer buttons -->
                        <?php
                    } else {
                        //print_r($features);
                        ?>
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <!-- <h3>General</h3> -->
                                <ul class="nav side-menu">
                                    <li><a href="<?php echo base_url(); ?>user_dashboard"><i class="fa fa-dashboard"></i> Dashboard </a></li>
                                    <?php
                                    //print_r($features);
                                    $gradlist = '';
                                    if ($features['status'] != 500) {
                                        foreach ($features['status_message'] as $key) {
                                            $gradlist = json_decode($key['grades_assigned'], true);
                                            if (in_array($grade_id, $gradlist)) {
                                                //print_r($key);
                                                if ($key['feature_name'] == 'Document controller') {
                                                    $symbole = 'check-circle';
                                                }if ($key['feature_name'] == 'Site Inspection') {
                                                    $symbole = 'file';
                                                }if ($key['feature_name'] == 'Raise Query') {
                                                    $symbole = 'check';
                                                }
                                                ?>
                                                <li><a href="<?php echo base_url(); ?><?php echo $key['url']; ?>"><i class="fa fa-<?php echo $symbole; ?>"></i> <?php echo $key['feature_name']; ?> </a></li>                                                           
                                                <?php
                                            }
                                        }
                                    } else {
                                        ?>
                                        <li><span>No Features Available.</span></li>
                                    <?php } ?>
                                    <li><a href="<?php echo base_url(); ?>user/user_profile"><i class="fa fa-cog"></i>Settings</a></li>
                                    <!--                   <li><a href="<?php //echo base_url();              ?>user/user_settings"><i class="fa fa-cog"></i>Settings</a></li>-->
                                </ul>
                            </div>
                            <div class="menu_section">
                            </div>
                        </div>
                        <!-- /sidebar menu -->
                        <!-- /menu footer buttons -->
                        <div class="sidebar-footer hidden-small w3-center">
                            <a href="<?php echo base_url(); ?>user/user_settings" data-toggle="tooltip" data-placement="top" title="Settings" style="width: 50%;">
                                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url(); ?>login/logoutAdmin" style="width: 50%;">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                            </a>
                        </div>

                    <?php } ?>
                </div>
            </div>
            <!-- top navigation -->
            <?php if ($role == 'company_admin') { ?>
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Welcome <b><?php echo $session_name; ?>  </b>
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <li><a href="<?php echo base_url(); ?>user/user_settings"><i class="fa fa-cog pull-right"></i> Settings</a></li>
                                        <li><a href="<?php echo base_url(); ?>login/logoutAdmin"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                    </ul>
                                </li>
                                <li class="">
                                    <?php
                                    $curr_project = 'Select Project';
                                    if ($project_id != '') {
                                        $curr_project = $project_name;
                                    }
                                    ?>
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><b><?php echo $curr_project; ?></b> <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <?php
                                    // print_r($projects);
                                    // $project_id = $this->session->userdata('project_id');
                                    ?>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <?php
                                        if ($projects['status'] != 500) {
                                            foreach ($projects['status_message'] as $key) {
                                                ?>
                                                <li <?php
                                                if ($key['project_id'] == $project_id) {
                                                    echo 'class="active"';
                                                }
                                                ?>><a href="<?php echo base_url(); ?>user_dashboard/startSesstionByProjectID?project_id=<?php echo base64_encode($key['project_id'] . '|' . $key['project_name']); ?>"><?php echo strtoupper($key['project_name']); ?></a></li>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                            <li><a >No Projects Created.</a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            <?php } else { ?>
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Welcome <b><?php echo $user_name; ?>  </b>
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <!--                                        <li><a href="<?php echo base_url(); ?>user/user_settings"><i class="fa fa-cog pull-right"></i> Settings</a></li>-->
                                        <li><a href="<?php echo base_url(); ?>user/userrole_login/logOutUser"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                    </ul>
                                </li>                                
                            </ul>
                            <?php // print_r($features);
                            ?>
                        </nav>
                    </div>
                </div>
            <?php } ?>
            <!-- /top navigation -->

            <!--       </div>
                </div>
            
              </body>
              </html> -->
