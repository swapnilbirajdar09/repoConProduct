<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_dashboard extends CI_Controller {

    // Addproduct controller
    public function __construct() {
        parent::__construct();
        // load common model
    }

    // main index function
    public function index() {
        $data['companies'] = Admin_dashboard::getAllCompanies();
        $this->load->view('includes/Super_admin/admin_header');
        $this->load->view('pages/admin/admin_dashboard',$data);
        $this->load->view('includes/Super_admin/admin_footer');
    }

    public function getAllCompanies() {
        $path = base_url();
        $url = $path . 'api/admin/Admindashboard_api/getAllCompanies';
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

}
