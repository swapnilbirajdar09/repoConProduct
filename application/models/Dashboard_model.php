<?php

class Dashboard_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //--------------fun for get all queries
    public function getAllQueries_dashboard() {
        $sql = "SELECT * FROM rfi_query_tab where status='0'";
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