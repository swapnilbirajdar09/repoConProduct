<?php

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAllCompanies() {
        $sql = "SELECT * FROM company_tab";
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

}
