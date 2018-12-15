<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Kuwait');   //set Kuwait's timezone
        //$this->load->model('search_model');
    }

    //-------UPDATE ADMIN EMAIL FUNCTION--------------//
    public function updateEmail($data) {
        extract($data);

        $sql = "UPDATE company_tab SET email='$email' WHERE company_id='$company_id'";

        if ($this->db->query($sql)) {
            $response = array(
                'status' => 200,
                'status_message' => 'Email Updated Successfully..!');
        } else {
            $response = array(
                'status' => 500,
                'status_message' => 'Email Updation Failed...!');
        }
        return $response;
    }

    //-------UPDATE username FUNCTION--------------//
    public function updateUname($data) {
        extract($data);
        $sql = "UPDATE company_tab SET username='$uname' WHERE company_id='$company_id'";

        if ($this->db->query($sql)) {
            $response = array(
                'status' => 200,
                'status_message' => 'Username Updated Successfully..!');
        } else {
            $response = array(
                'status' => 500,
                'status_message' => 'Username Updation Failed...!');
        }
        return $response;
    }

    //---------UPDATE ADMIN EMAIL ENDS------------------//
    //-------UPDATE Password FUNCTION--------------//
    public function updatePass($data) {
        extract($data);
        //print_r($data);
        $sql = "UPDATE company_tab SET password='$pass' WHERE company_id ='$company_id'";

        if ($this->db->query($sql)) {
            $response = array(
                'status' => 200,
                'status_message' => 'Password Updated Successfully..!');
        } else {
            $response = array(
                'status' => 500,
                'status_message' => 'Password Updation Failed...!');
        }
        return $response;
    }

    public function getUserDetails($company_id) {
        //extract($data);
        $query = "SELECT * FROM company_tab WHERE company_id='$company_id'";

        $result = $this->db->query($query);

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

    public function getAllFeatuesForUser($project_id) {
        $query = "SELECT * FROM user_tab,role_tab WHERE user_tab.role_id = role_tab.role_id AND project_id='$project_id'";
        $result = $this->db->query($query);
        $currentFiles = '';
        $arr = array();
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 500,
                'status_message' => 'No data found.');
        } else {
            foreach ($result->result_array() as $key) {
                $currentFiles = json_decode($key['features']);
            }

            foreach ($currentFiles as $key) {
                $sql = "SELECT * FROM features_tab WHERE feature_id = '$key'";
                $resultsel = $this->db->query($query);

                $arr [] = $resultsel->result_array();
            }

            $response = array(
                'status' => 200,
                'status_message' => $arr);
        }
        return $response;
    }

}
