<?php

class Contact_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function admincontact_details() {
        $sql = "SELECT * From admin_tab";
        $result = $this->db->query($sql);
       if ($result->num_rows() <= 0) {
            return FALSE;
        } else {
            return $result->result_array();
        }
    }


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