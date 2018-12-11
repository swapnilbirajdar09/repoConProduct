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

}