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

    public function getAllFeatuesForUser($user_id, $role_id) {
        $query = "SELECT * FROM features_tab";
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

//---update email from user tab--//
    public function updateUserRoleEmail($data) {
        extract($data);
        $sql = "UPDATE user_tab SET user_email='$email' WHERE user_id='$user_id'";
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

    //----fetch details from user tab ---//
    public function getUserRoleDetails($user_id) {
        //extract($data);
        $query = "SELECT * FROM user_tab WHERE user_id='$user_id'";
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

    //----update username from user tab ---//
    public function updateUserRoleUname($data) {
        extract($data);
        $sql = "UPDATE user_tab SET user_name='$uname' WHERE user_id='$user_id'";
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

    //----update Password from user tab ---//
    public function updateUserRolePass($data) {
        extract($data);
        //print_r($data);
        $sql = "UPDATE user_tab SET password='$pass' WHERE user_id ='$user_id'";
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

//---fun for start the session of project_id

    public function startSesstionByProjectID($project_id) {
        $sqlSelect = "SELECT * FROM project_tab WHERE project_id = '$project_id'";
        $resultsel = $this->db->query($sqlSelect);
        foreach ($resultsel->result_array() as $val) {
            $project_id = $val['project_id'];
            $project_name = $val['project_name'];
        }
        $response = array(
            'status' => 200,
            'project_id' => base64_encode($project_id . '|' . $project_name)
        );
        return $response;
    }

}
