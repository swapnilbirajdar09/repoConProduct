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
        if ($role == 'company_admin') {
            $data['projects'] = User_dashboard::getAllprojects();
        } else {
            $user_id = $this->session->userdata('user_id');
            $project_id = $this->session->userdata('project_id');

            $data['features'] = User_dashboard::getAllFeatuesForUser($user_id);
        }
        $this->load->view('includes/header', $data);
        $this->load->view('pages/dashboard', $data);
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

    public function getAllFeatuesForUser($project_id) {
        $path = base_url();
        $url = $path . 'api/user/User_api/getAllFeatuesForUser?project_id=' . $project_id;
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
        $proj_id = base64_decode($project_id);
        $session_data = array(
            'project_id' => $proj_id
        );
        //start session of user if login success
        $this->session->set_userdata($session_data);
        redirect('user_dashboard');
    }

}
