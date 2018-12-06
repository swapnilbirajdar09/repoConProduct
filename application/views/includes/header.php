<?php
//start session     
$admin_name = $this->session->userdata('admin_name');
$session_name = '';
if ($admin_name != '') {
    $sessionArr = explode('|', $admin_name);
    $session_name = $sessionArr[1];
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
                        <a href="<?php echo base_url(); ?>admin/dashboard" class="site_title" style="padding-left: 15px">
                            <i class="fa fa-circle-o w3-orange w3-padding-tiny w3-text-white" style="text-shadow: 2px 2px #ff0000;border-radius: 0;"></i> Swan Industries
                        </a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <!-- <h3>General</h3> -->
                            <ul class="nav side-menu">
                                <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard </a></li>
                                <li><a><i class="fa fa-cubes"></i> Raw Material Section <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo base_url(); ?>materials/addmaterial">Add New Material</a></li>
                                        <li><a href="<?php echo base_url(); ?>materials/allmaterial">View All Materials</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo base_url(); ?>admin/machine/addmachine"><i class="fa fa-sliders"></i> Machine Section </a>
                                </li>
                                <li><a href="<?php echo base_url(); ?>employee/employee"><i class="fa fa-user"></i> Employee Section </a>
                                </li>
                                <li><a><i class="fa fa-cube"></i> Product Section <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo base_url(); ?>admin/products/addproduct">Add New Product</a></li>
                                        <li><a href="<?php echo base_url(); ?>admin/products/allproduct">View All Products</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-list"></i> Inventory Section <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo base_url(); ?>inventory/showinventory">View Inventory</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-first-order"></i> Customer Purchase Order <span class=" fa fa-chevron-down" style="margin: -15px 0 0 0"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo base_url(); ?>po_order/po_order">Add Customer Purchase Order</a></li>
                                        <li><a href="<?php echo base_url(); ?>po_order/show_purchase_orders">Show Customers Purchase Orders</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo base_url(); ?>required_rawmaterial/Required_rawmaterial"><i class="fa fa-sliders"></i> Required Raw Material </a></li>
                                <li><a href="<?php echo base_url(); ?>sharing/Shared_PO"><i class="fa fa-list"></i>Sharing Planning</a></li>
                                <li><a><i class="fa fa-wrench"></i> Production Section <span class=" fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo base_url(); ?>production/production_planning">Production Planning</a></li>
                                        <li><a href="<?php echo base_url(); ?>production/production">Production Module</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo base_url(); ?>finished_products/finished_products"><i class="fa fa-cube"></i>Finished Products</a></li>
                                <li><a><i class="fa fa-clipboard"></i> P.O Reports <span class=" fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">                                        
                                        <li><a href="<?php echo base_url(); ?>reports/pending_orders">Customers Pending Orders Section</a></li>
                                        <li><a href="<?php echo base_url(); ?>reports/inprocessproduct_stock">In-process Products</a></li>
                                        <li><a href="<?php echo base_url(); ?>reports/rejectionproduct_stock">In-process Rejected Products</a></li>                                        
                                        <li><a href="<?php echo base_url(); ?>reports/finishedproduct_stock">Finished Products</a></li>
                                        <li><a href="<?php echo base_url(); ?>reports/dispatched_products">Dispatched Products</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo base_url(); ?>settings/Settings"><i class="fa fa-cog"></i>Settings</a></li>
                            </ul>
                        </div>
                        <div class="menu_section">
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small w3-center">
                        <a href="<?php echo base_url(); ?>settings/Settings" data-toggle="tooltip" data-placement="top" title="Settings" style="width: 50%;">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url(); ?>login/logoutAdmin" style="width: 50%;">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>
            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Welcome <b><?php echo $session_name; ?> </b>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <li>
                                        <a href="<?php echo base_url(); ?>settings/Settings" data-toggle="tooltip" data-placement="top" title="Settings" style="width: 50%;">
                                            <span class="glyphicon glyphicon-cog" aria-hidden="true"> SETTINGS</span>
                                        </a>
                                    </li>
                                    <li><a href="<?php echo base_url(); ?>login/logoutAdmin"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!--       </div>
                </div>
            
              </body>
              </html> -->
