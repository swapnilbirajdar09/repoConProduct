<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Create_project extends CI_Controller {

    // Addproduct controller
    public function __construct() {
        parent::__construct();
        // load common model
    }

    // main index function
    public function index() {
        $data['projects'] = Create_project::getAllprojects();
        $data['slab_cycle'] = Create_project::getSlabCycle();
        $data['allWitems'] = Create_project::getAllWitems();
        $data['allActivities'] = Create_project::getAllActivity();

        $this->load->view('includes/header', $data);
        $this->load->view('pages/user/create_project', $data);
        $this->load->view('includes/footer');
    }

    // get all work activity
    public function getAllActivity() {
        // get project session
        $projSession = $this->session->userdata('project_id');
        $projArr=explode('|', base64_decode($projSession));
        $project_id=$projArr[0];
        $path = base_url();
        $url = $path . 'api/modules/sitecontroller_api/getAllActivity?project_id=' . base64_encode($project_id);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // authenticate API
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_USERPWD, API_USER . ":" . API_PASSWD);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($output, true);
        return $response;
    }

    public function getAllprojects() {
        $company_id = $this->session->userdata('company_id');
        $path = base_url();
        $url = $path . 'api/user/Role_api/getAllProjects?company_id=' . $company_id;
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
    }

    // get all work items
    public function getAllWitems() {
        // get project session
        $projSession = $this->session->userdata('project_id');
        $projArr=explode('|', base64_decode($projSession));
        $project_id=$projArr[0];
        $path = base_url();
        $url = $path . 'api/modules/sitecontroller_api/getAllWitems?project_id='.$project_id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // authenticate API
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_USERPWD, API_USER . ":" . API_PASSWD);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($output, true);
        return $response;
    }

    // get slab cycle by project id
    public function getSlabCycle() {
        // get project session
        $projSession = $this->session->userdata('project_id');
        $projArr=explode('|', base64_decode($projSession));
        $project_id=$projArr[0];
        $path = base_url();
        $url = $path . 'api/user/createuser_api/getSlabCycle?project_id='.$project_id;
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
    }

    // get slab cycle details by cycle id
    public function getSlabCycleDetails() {
        // get project session
        $projSession = $this->session->userdata('project_id');
        $projArr=explode('|', base64_decode($projSession));
        $project_id=$projArr[0];
        $project_name=strtoupper($projArr[1]);
        extract($_GET);
        // get project session
        $projSession = $this->session->userdata('project_id');
        $projArr=explode('|', base64_decode($projSession));
        $project_id=$projArr[0];
        $path = base_url();
        $url = $path . 'api/modules/sitecontroller_api/getSlabCycleDetails?project_id='.$project_id.'&witemid='.$witemid;
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        // print_r($response);die();

        if($response){
            echo '
            <div class="w3-col l12 w3-margin-top" style="border:1px solid #E6E9ED;padding: 10px;overflow-x: scroll;">
            <table class="table table-bordered table-responsive">
            <tbody>
            <tr>
            <td><b>Project:</b></td>
            <td> '.$project_name.' </td>
            </tr>

            </tbody>
            </table>
            <br>
            <table class="table table-bordered table-responsive">
            <thead>
            <tr>
            <th>Sr. No.</th>
            <th>Day\'s</th>
            <th>Activity</th>
            <th>Date</th>
            <th>Status</th>
            </tr>
            </thead>
            <tbody>
            ';
            $curr_Day='0';
            for ($i=0; $i <count($response) ; $i++) { 
                $dtime = new DateTime($response[$i]['created_date']);


                $day=$response[$i]['day'];
                $srno=$i+1;
                $rowspan='1';
                $status='';
                if($response[$i]['status']=='1'){
                    $status='<span class="badge w3-green"><i class="fa fa-check-circle"></i> Done</span>';
                }
                else if($response[$i]['status']=='2'){
                    $status='<span class="badge w3-red"><i class="fa fa-warning"></i> Issue</span>';
                }
                else{
                    $status='<span class="badge"><i class="fa fa-marker"></i> Pending</span>';
                }

                echo '
                <tr>                                            
                <td rowspan="1" style="vertical-align: middle;">'.$srno.'.</td>
                <td rowspan="'.$rowspan.'" style="vertical-align: middle;"><b>Day '.$day.'</b></td>
                <td>'.$response[$i]['activity_name'].'</td>
                <td>'.$dtime->format("d/m/Y").'</td>
                <td class="text-center">'.$status.'</td>
                
                </tr>                                                                        
                ';
            }
            echo '
            </tbody>
            </table>
            </div>
            ';
        }
        else{
            echo '<div class="alert alert-warning w3-margin-top alert-dismissible fade in w3-round">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Sorry!</strong> Checklist / Slab Cycle Details not available.
            </div>';
        }
    }

    public function create_Newproject() {

        extract($_POST);
        $data = $_POST;
        $session_role = $this->session->userdata('role');
        if ($session_role == 'company_admin') {
            $data['author'] = 'Administrator';
        } else {
            $user_name = $this->session->userdata('user_name');
            $data['author'] = $user_name;
        }

        $company_id = $this->session->userdata('company_id');
        $data['company_id'] = $company_id;
        $path = base_url();
        $url = $path . 'api/user/Createuser_api/create_Newproject';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        if ($response['status'] == 200) 
        {
            $session_data = array(
                'project_id' => $response['project_id']
            );
            $this->session->set_userdata($session_data);
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> Project Created successfully.
            </div>
            <script>
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove(); 
                    });
                    location.reload();
                    }, 1000);
                    </script>';
                } 
                else 
                {
                    echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Failure!</strong> Project Not Created Successfully.
                    </div>';
                }
            }

// update slab cycle for project
            public function addSlabCycle() {

                extract($_POST);
                $data = $_POST;        
        // get project session
                $projSession = $this->session->userdata('project_id');
                $projArr=explode('|', base64_decode($projSession));
                $project_id=$projArr[0];
                $data['project_id'] = $project_id;
                $path = base_url();
                $url = $path . 'api/user/createuser_api/addSlabCycle';
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response_json = curl_exec($ch);
                curl_close($ch);
                $response = json_decode($response_json, true);
        // print_r($response_json);die();
                if ($response){
                    echo '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> Slab Cycle Updated.
                    </div>
                    <script>
                    window.setTimeout(function() {
                        $(".alert").fadeTo(500, 0).slideUp(500, function(){
                            $(this).remove(); 
                            });
                            location.reload();
                            }, 1000);
                            </script>';
                        } 
                        else 
                        {
                            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Failure!</strong> Slab Cycle not updated! Perhaps you have not changed the value since last modified.
                            </div>';
                        }
                    }

                }
