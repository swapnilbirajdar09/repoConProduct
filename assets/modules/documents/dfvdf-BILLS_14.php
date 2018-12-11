<?php

class Adminprofile_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // update admin details function
    public function updateAdminDetails($data) {
        extract($data);
        $sql = "UPDATE admin_tab SET profile_image='$imagePath',username = '$userName',password = '$password',admin_email = '$eMail',"
                . "admin_officetype = '$officeType',admin_number = '$number',admin_office_address = '".addslashes($officeAddress)."',admin_firstname = '$firstName',"
                . "admin_lastname = '$lastName' WHERE admin_id = '1'";
               // echo $sql; die();
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getAdminDetails() {
        $sql = "SELECT * FROM admin_tab";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    // get admin mailid
    public function getAdminEmail() {
        $sql = "SELECT admin_email FROM admin_tab";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

}
