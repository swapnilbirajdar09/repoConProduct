
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

//----------------------get query details
    public function getQueryDetails($query_id) {
        $sql = "SELECT * FROM rfi_query_tab WHERE query_id = '$query_id'";
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

    // post new comment
    public function postComment($replyfor,$comment_posted,$author){
        // $ins_Data = array(
        //     'query_id' => base64_decode($replyfor),
        //     'response_description' => addslashes($comment_posted),
        //     'created_by' => $author,
        //     'created_date' => date('Y-m-d H:i:s')
        // );
        $this->db->set('query_id', $replyfor);
$this->db->set('response_description', addslashes($comment_posted));
$this->db->set('created_by', $author);
$this->db->set('created_date', date('Y-m-d H:i:s'));
        //print_r($ins_Data);die();
        $this->db->insert('rfi_query_response_tab');
        if($this->db->affected_rows()>0){
            return true;
        }
        else{
            return false;
        }
    }

    // get query comments
    public function getQueryComments($query_id){
        $sql = "SELECT * FROM rfi_query_response_tab WHERE query_id='$query_id'";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

}
