
<title>Dashboard</title>
<!-- page content -->
<!--  -->
<div class="right_col" role="main">
    <!-- top tiles -->
    <!--    <div class="row tile_count">
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
        </div>-->
    <!-- /top tiles -->

    <div class="container page_title" style="margin-top: 0px;margin-bottom: 0px;" >
        <div id="err_message"></div>
        <div class="row x_title">
            <div class="w3-padding">
                <h3><i class="fa fa-cubes"></i> All Companies </h3>
            </div>
        </div>
        <div class="container x_title" style=" margin-top: 5px;">
            <table id="datatable" class="table">
                <thead>
                    <tr class="theme_bg">
                        <th class="w3-center"><span>Sr.No</span></th>
                        <th class="w3-center"><span>User Name</span></th>
                        <th class="w3-center"><span>Email</span></th>
                        <th class="w3-center"><span>Company name</span></th>
                        <th class="w3-center"><span>Company Id</span></th>
                        <th class="w3-center"><span>Package</span></th>
                        <th class="w3-center"><span>Expiry Date</span></th>                        
                        <th class="w3-center"><span>Action</span></th>
                    </tr>
                </thead>
                <tbody>                    
                    <?php
                    //print_r($companies);
                    if ($companies != '' && $companies['status'] == '200') {
                        $count = 1;
                        $package = '';
                        foreach ($companies['status_message'] as $key) {
                            switch ($key['Package_purchased']) {
                                case 0:
                                    $package = 'Free';
                                case 1;
                                    $package = '1 Year';
                                case 6:
                                    $package = '6 Months';
                                default :
                                    $package = 'Free';
                            }
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $count ?></td>
                                <td class="text-center"><?php echo $key['full_name'] ?></td>
                                <td class="text-center"><?php echo $key['email'] ?></td>
                                <td class="text-center"><?php echo $key['company_name'] ?></td>
                                <td class="text-center"><?php echo $key['company_id'] ?></td>
                                <td class="text-center"><?php echo $package ?></td>
                                <td class="text-center"><?php echo $key['expiry_date'] ?></td>
                                <td class="text-center"></td>
                            </tr>
                            <?php
                            $count++;
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="8" class="w3-center">
                                <span> No User Found </span>
                            </td>              
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- add skill div end -->          
<!-- /page content -->
<!-- script for category -->

