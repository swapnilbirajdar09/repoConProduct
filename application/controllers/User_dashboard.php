<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_dashboard extends CI_Controller {

    // Addproduct controller
    public function __construct() {
        parent::__construct();
        // load common model
        $admin_name = $this->session->userdata('usersession_name');
        //  if ($admin_name == '') {
        //     //check session variable set or not, otherwise logout
        //  redirect('login');
        //  } 
    }

    // main index function
    public function index() {

        $role = $this->session->userdata('role');
        //echo $role;die();
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];
        if ($role == 'company_admin') {
            $data['projects'] = User_dashboard::getAllprojects();
            //$project_id = $this->session->userdata('project_id');
            if ($project_id == '') {
                //check session variable set or not, otherwise logout
                redirect('user/create_project');
            }
        } else {
            $user_id = $this->session->userdata('user_id');
            //$project_id = $this->session->userdata('project_id');
            $role = $this->session->userdata('role');
            $sessionArr = explode('/', $role);
            $role_id = $sessionArr[0];
            $role_name = $sessionArr[1];
            $data['features'] = User_dashboard::getAllFeatuesForUser($user_id, $role_id);
        }
        //$project_id = $this->session->userdata('project_id');die();
        $data['queries'] = User_dashboard::getAllQueries_dashboard();
        $data['allDocuments'] = User_dashboard::allDocuments();

        $this->load->view('includes/header', $data);
        $this->load->view('pages/dashboard', $data);
        $this->load->view('includes/footer');
    }

    public function allDocuments() {
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];
        $path = base_url();
        $url = $path . 'api/Dashboard_api/allDocuments?project_id='.$project_id;
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response_json);die();
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

//------------fun for get all queries
    public function getAllQueries_dashboard() {
        $path = base_url();
        $url = $path . 'api/Dashboard_api/getAllQueriesdashboard';
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response_json);die();
        return $response;
    }

    public function getAllFeatuesForUser($user_id, $role_id) {
        $path = base_url();
        $url = $path . 'api/user/User_api/getAllFeatuesForUser?user_id=' . $user_id . '&role_id=' . $role_id;
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

    public function startSesstionByProjectID() {
        extract($_GET);
        $session_data = array(
            'project_id' => $project_id
        );
        //start session of user if login success
        $this->session->set_userdata($session_data);
        redirect('user_dashboard');
    }

    public function updateQueryStatus() {
        extract($_GET);

        $session_name = $this->session->userdata('usersession_name');
        $session_role = $this->session->userdata('role');
        if ($session_role == 'company_admin') {
            $data['author'] = 'Administrator';
        } else {
            $user_name = $this->session->userdata('user_name');
            $data['author'] = $user_name;
        }
        $path = base_url();
        $url = $path . 'api/Dashboard_api/updateQueryStatus?query_id=' . $query_id;
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //  print_r($response_json);die();
        if ($response['status'] == 'success') {
            $response = array(
                'status' => 'success',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> Approved Status Updated successfully.
                </div>
                <script>
                window.setTimeout(function() {
                 $(".alert").fadeTo(500, 0).slideUp(500, function(){
                     $(this).remove(); 
                     });
                     location.reload();
                     }, 1000);
                     </script>'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failure!</strong>Status Updation Failed.
                </div>
                <script>
                window.setTimeout(function() {
                 $(".alert").fadeTo(500, 0).slideUp(500, function(){
                     $(this).remove(); 
                     });
                     }, 5000);
                     </script>'
            );
        }
        echo json_encode($response);
    }

//-----reject query
    public function RejectQueryStatus() {
        extract($_GET);

        $session_name = $this->session->userdata('usersession_name');
        $session_role = $this->session->userdata('role');
        if ($session_role == 'company_admin') {
            $data['author'] = 'Administrator';
        } else {
            $user_name = $this->session->userdata('user_name');
            $data['author'] = $user_name;
        }
        $path = base_url();
        $url = $path . 'api/Dashboard_api/RejectQueryStatus?query_id=' . $query_id;
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //  print_r($response_json);die();
        if ($response['status'] == 'success') {
            $response = array(
                'status' => 'success',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> Query Rejected successfully.
                </div>
                <script>
                window.setTimeout(function() {
                 $(".alert").fadeTo(500, 0).slideUp(500, function(){
                     $(this).remove(); 
                     });
                     location.reload();
                     }, 1000);
                     </script>'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failure!</strong>Query Rejection Failed.
                </div>
                <script>
                window.setTimeout(function() {
                 $(".alert").fadeTo(500, 0).slideUp(500, function(){
                     $(this).remove(); 
                     });
                     }, 5000);
                     </script>'
            );
        }
        echo json_encode($response);
    }

}
