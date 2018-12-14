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
       // $data['roles'] = Createuser::getProjectRoles();
       // $data['users'] = Createuser::getProjectUsers();
        //print_r($data);        die();

        $data['projects'] = Create_project::getAllprojects();

        $this->load->view('includes/header', $data);
        $this->load->view('pages/user/create_project',$data);
        $this->load->view('includes/footer');
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

     public function create_Newproject() {
         
  		extract($_POST);
		  $data=$_POST;
		  $company_id = $this->session->userdata('company_id');
		  $data['company_id'] = $company_id;
		  $path = base_url();
		  $url = $path.'api/user/Createuser_api/create_Newproject';
		  $ch = curl_init($url);
		  curl_setopt($ch, CURLOPT_POST, true);
		  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		  $response_json = curl_exec($ch);
		  curl_close($ch);
		  $response = json_decode($response_json, true);
 //print_r($response_json);die();
   if ($response['status'] == 200) {
            $response = array('status' => '200',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
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
			</script>');
        }  else {
            $response = array('status' => 500,
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong> Something Went Wrong. Project Not Created Successfully.
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