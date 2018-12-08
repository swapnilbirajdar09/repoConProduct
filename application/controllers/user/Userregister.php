<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Userregister extends CI_Controller {

    // Addproduct controller
    public function __construct() {
        parent::__construct();
        // load common model
    }

    // main index function
    public function index() {
        $data['country'] = Userregister::getAllCountries();
        print_r($data);die();
        $this->load->view('includes/header');
        $this->load->view('pages/user/user_register', $data);
        $this->load->view('includes/footer');
    }

    public function registerUser() {
        extract($_POST);
        $data = $_POST;
        print_r($data);
        die();
        $path = base_url();
        $url = $path . 'api/user/Registeruser_api/registerUser';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        print_r($response);
    }

    public function getAllCountries() {
        $username = 'BizmoTech';
        $password = 'Descartes@1990';
        $path = base_url();
        $url = $path . 'api/user/Registeruser_api/getAllCountries';
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
        $response_json = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($response_json, true);
        //return $response;
        print_r($response_json);
    }

}
