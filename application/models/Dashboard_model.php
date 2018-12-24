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

    //---fun for update query status

    public function updateQueryStatus($query_id) {
      
        $sql = "UPDATE rfi_query_tab SET status = '1' WHERE query_id = '$query_id'";
          $this->db->query($sql);
       
        if ($this->db->affected_rows() > 0) {
            $response = array(
                'status' => 'success',
                'status_message' => 'Role Deleted Successfully.');
        } else {
            $response = array(
                'status' => 'error',
                'status_message' => 'Role Not Deleted Successfully.');
        }
        return $response;
    }

 }