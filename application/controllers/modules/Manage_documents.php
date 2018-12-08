<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_documents extends CI_Controller {

    // Addproduct controller
    public function __construct() {
        parent::__construct();
        // load common model
        // $this->load->model('modules/product_model');
    }

    // main index function
    public function index() {
        $username = 'BizmoTech';
        $password = 'Descartes@1990';
        $path = base_url();
        $url = $path . 'api/user/Registeruser_api/getAllCountries';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_USERPWD, $username.":".$password);     
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($output, true);
        print_r($response);

        // $this->load->view('includes/header');
        // $this->load->view('pages/modules/manage_documents');
        // $this->load->view('includes/footer');
    }

}
