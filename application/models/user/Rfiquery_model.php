
<?php

class Rfiquery_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
//----------fun for save the query details
    public function raiseQuery($data) {
        extract($data);
        $sql = "INSERT INTO rfi_query_tab(project_id,query_title,query_description,"
                . "images,resolved_by,created_by,"
                . "created_date)"
                . "VALUES('$project_id','" . addslashes($queryTitle) . "','" . addslashes($queryDescription) . "',"
                . "'$images','','$created_by',NOW())";
        if ($this->db->query($sql)) {
            $response = array('status' => 'success',
                'status_message' => 'Query Raised Successfully.');
        } else {
            $response = array('status' => 'error',
                'status_message' => 'Query Not Raised Successfully.');
        }
        return $response;
    }
//--------------fun for get all queries
    public function getAllQueries() {
        $sql = "SELECT * FROM rfi_query_tab";
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
//------------fun for delete query
    public function removeQuery($query_id) {
        $sql = "DELETE FROM rfi_query_tab WHERE query_id = '$query_id'";
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
