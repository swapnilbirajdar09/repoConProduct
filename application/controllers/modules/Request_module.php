<?php

class Request_module extends CI_Controller {

    // Addproduct controller
    public function __construct() {
        parent::__construct();
        // load common model
        date_default_timezone_set('Asia/kolkata');
    }

    // main index function
    public function index() {
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];

        if ($project_id == '') {
            //check session variable set or not, otherwise logout
            redirect('user/create_project');
        }

        $data['roles'] = Request_module::getProjectRoles();
        $data['approveRequests'] = Request_module::getApprovedRequests();
        $this->load->view('includes/header');
        $this->load->view('pages/modules/request_module', $data);
        $this->load->view('includes/footer');
    }

    public function getProjectRoles() {
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];
        $path = base_url();
        $url = $path . 'api/user/Createuser_api/getProjectRoles?project_id=' . $project_id;
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

    public function getApprovedRequests() {
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];
        $path = base_url();
        $url = $path . 'api/modules/Request_api/getApprovedRequests?project_id=' . $project_id;
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

    public function createNewReq() {
        extract($_POST);
        // print_r($_POST);
        $data = $_POST;
        if ($roles == '0') {
            $response = array(
                'status' => 'validation',
                'message' => '<div class="alert alert-danger alert-dismissible" style="margin-bottom:5px">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><b>Error:</b> Please Select Valid Role Name!</strong> 
            </div>');
            echo $response;
            die();
        }
        // $project_id = $this->session->userdata('project_id');
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];
        $data['project_id'] = $project_id;
        $session_role = $this->session->userdata('role');
        if ($session_role == 'company_admin') {
            $data['author'] = 'Administrator';
        } else {
            $role = $this->session->userdata('role');
            $user_name = $this->session->userdata('user_name');
            $author = explode('/', $role);
            $roleid = $author[0];
            $rolename = $author[1];
            $data['role_id'] = $roleid;
            $data['author'] = $user_name;
        }
        $role_name = explode('/', $roles);
        //print_r($rolename)
        $request_name = $role_name[1];
        $data['requested_from'] = $request_name;
        //print_r($data);die();
        $path = base_url();
        $url = $path . 'api/modules/Request_api/createNewReq';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //  print_r($response); die();
        if ($response == 'true') {
            $response = array('status' => 'success',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> Document Request send Successfully.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			location.reload();
			}, 1000);
			</script>');
        } else {
            $response = array('status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong> Something Went Wrong. Request Sending failed.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			}, 5000);
			</script>');
        }
        echo json_encode($response);
    }

}

?>