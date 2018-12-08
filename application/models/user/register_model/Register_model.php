<?php

class Register_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function registerUser($data) {
        extract($data);
        //print_r($data);die();
        $expiry_date = '';
        switch ($package) {
            case '0':
                $expiry_date = date('Y-m-d', strtotime('+' . 3 . ' months'));
                break;
            case '6':
                $expiry_date = date('Y-m-d', strtotime('+' . $package . ' months'));
                break;
            case '1':
                $expiry_date = date('Y-m-d', strtotime('+' . $package . ' years'));
                break;
        }

        $sql = "INSERT INTO company_tab(full_name,username,email,"
                . "mobile_no,company_name,address,city,state,country,"
                . "postal_code,package_purchased,password,expiry_date,added_date)"
                . "VALUES('" . addslashes($user_fullname)."','" . addslashes($user_username)."','$user_email',"
                . "'$user_mobile','" . addslashes($company_name)."','" . addslashes($user_address)."',"
                . "'$country','$state','$city',"
                . "'$postal_code','$package','$user_password','$expiry_date',NOW())";
        if ($this->db->query($sql)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getAllCountries() {
        $sql = "SELECT * FROM countries";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 500,
                'status_message' => 'No data found.');
        } else {
            $response = array(
                'status' => 200,
                'status_message' => $result->result_array());
        }
        return $response;
    }

    //------------fun for get all states by country id
    public function getCountryState($country) {
        $countryName = '';
        $countryId = '';
        $countries = explode("/", $country);
        $countryName = $countries[0]; // piece1
        $countryId = $countries[1]; // piece2

        $sql = "SELECT * FROM states WHERE country_id = '$countryId'";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

//------------fun for get all states by state id
    public function getStateCity($state) {
        $stateName = '';
        $stateId = '';
        $states = explode("/", $state);
        $stateName = $states[0]; // piece1
        $stateId = $states[1]; // piece2

        $sql = "SELECT * FROM cities WHERE state_id = '$stateId'";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

}
