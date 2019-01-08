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

    //---fun for update query status ,, status changed to 1 for approved query

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

    //---reject query status change to 2


    public function RejectQueryStatus($query_id) {
        $sql = "UPDATE rfi_query_tab SET status = '2' WHERE query_id = '$query_id'";
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

    //---------fu for all document
    public function allDocuments($project_id) {
        $sql = "SELECT * FROM document_tab WHERE project_id = '$project_id' AND status='1' AND delete_reason != '' ";
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
  //---------function for top 10 document list
    public function topDocuments($project_id) {
        $sql = "SELECT * FROM document_tab WHERE project_id = '$project_id' AND status='0'  ORDER BY created_date DESC LIMIT 10";
       // echo $sql;die();
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
//----query for count of document
      public function countoFDocuments($project_id) {
        $sql = "SELECT COUNT(document_id) from document_tab WHERE project_id = '$project_id'";
       // echo $sql;die();
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

    //----query for count of all queries
      public function countoFQuery($project_id) {
        $sql = "SELECT COUNT(query_id) from rfi_query_tab WHERE project_id = '$project_id'";
       // echo $sql;die();
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
     //----query for count of pending queries
      public function countoFPendingQuery($project_id) {
        $sql = "SELECT COUNT(query_id) from rfi_query_tab WHERE project_id = '$project_id' AND status = '0' ";
       // echo $sql;die();
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

      //----query for count of total working user
      public function countoFUser($project_id) {
        $sql = "SELECT COUNT(user_id) from user_tab WHERE project_id = '$project_id'";
       // echo $sql;die();
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
