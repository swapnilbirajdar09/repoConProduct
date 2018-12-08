<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Addcompany extends CI_Controller {

    // Addproduct controller
    public function __construct() {
        parent::__construct();
        // load common model
    }

    // main index function
    public function index() {
        $data['country'] = Addcompany::getAllCountries();
        $this->load->view('includes/Super_admin/admin_header');
        $this->load->view('pages/admin/add_company', $data);
        $this->load->view('includes/Super_admin/admin_footer');
    }

    public function getAllCountries() {
        $path = base_url();
        $url = $path . 'api/user/Registeruser_api/getAllCountries';
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
//        curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
    }

}
