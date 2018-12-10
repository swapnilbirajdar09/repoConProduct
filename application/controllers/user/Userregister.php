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

        //print_r($data);        die();
        $this->load->view('includes/header');
        $this->load->view('pages/user/user_register', $data);
        $this->load->view('includes/footer');
    }

    public function registerUser() {
        extract($_POST);
        $data = $_POST;
        $countries = explode("/", $country);
        $countryName = $countries[0]; // piece1
        $countryId = $countries[1]; // piece2
        if ($countryId == '0') {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible" style="margin-bottom:5px">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><b>Error:</b> Please Select Valid Country Name!</strong> 
            </div>'
                    //'<b>Error:</b> You Have Not Registered Successfully!'
            );
            echo $response;
            die();
        }

        $stateId = '';
        $states = explode("/", $state);
        $stateName = $states[0]; // piece1
        $stateId = $states[1]; // piece2
        if ($stateId == '0') {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible" style="margin-bottom:5px">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><b>Error:</b> Please Select Valid State Name!</strong> 
            </div>'
                    //'<b>Error:</b> You Have Not Registered Successfully!'
            );
            echo $response;
            die();
        }
        if ($city == '0') {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible" style="margin-bottom:5px">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><b>Error:</b> Please Select Valid City Name!</strong> 
            </div>'
                    //'<b>Error:</b> You Have Not Registered Successfully!'
            );
            echo $response;
        }
        $path = base_url();
        $url = $path . 'api/user/Registeruser_api/registerUser';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //echo $response_json;die();
        if ($response) {
            $response = array(
                'status' => 'success',
                'message' => '<div class="alert alert-success alert-dismissible" role="alert" style="margin-bottom:5px">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><b>Success:</b> You Have Successfully Registered..!</strong> 
            </div>'
                    //'<b>Success:</b> You Have Successfully Registered.!'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible" style="margin-bottom:5px">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><b>Error:</b> You Have Not Registered Successfully!</strong> 
            </div>'
                    //'<b>Error:</b> You Have Not Registered Successfully!'
            );
        }
        echo json_encode($response);
    }

    public function getAllCountries() {
        $path = base_url();
        $url = $path . 'api/user/Registeruser_api/getAllCountries';
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
        //print_r($response_json);
    }

    //------------fun for get the state by country id
    public function getCountryState() {
        extract($_GET);
        $path = base_url();
        $url = $path . 'api/user/Registeruser_api/getCountryState?country=' . $country;
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        print_r($response_json);
    }

//-------------fun for get the cities by state id
    public function getStateCity() {
        extract($_GET);
        $path = base_url();
        $url = $path . 'api/user/Registeruser_api/getStateCity?state=' . $state;
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        print_r($response_json);
    }

}
