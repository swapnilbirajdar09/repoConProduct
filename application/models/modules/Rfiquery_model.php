
<?php

class Rfiquery_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

//----------fun for save the query details
    public function raiseQuery($data) {
        extract($data);
        // print_r($data);
        $sql = "INSERT INTO rfi_query_tab(project_id,query_title,query_description,raised_to,"
                . "images,resolved_by,resolved_status,created_by,"
                . "created_date)"
                . "VALUES('$project_id','" . addslashes($queryTitle) . "','" . addslashes($queryDescription) . "','$role_type',"
                . "'$images','','0','$created_by',NOW())";
        if ($this->db->query($sql)) {
            $response = array('status' => 'success',
                'status_message' => 'Query Raised Successfully.');
        } else {
            $response = array('status' => 'error',
                'status_message' => 'Query Not Raised Successfully.');
        }
        return $response;
    }

//-------fun for get all role
    public function getRoleName() {
        $sql = "SELECT * FROM role_tab";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

//--------------fun for get all queries
    public function getAllQueries() {
        $sql = "SELECT * FROM rfi_query_tab where status='1' AND resolved_status ='0'";
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

    public function updateQueryDetails($query_id) {
        // extract($data);
        //   $update_data = array(
        // 'query_title' => addslashes($query_title),
        // 'query_description' => addslashes($queryDescription),
        //  'modified_by' => $author,
        //  'modified_date' => date('Y-m-d H:i:s')
        //  'resolved_status' => '1'
        //     );

        $sql = "UPDATE rfi_query_tab SET resolved_status = '1' WHERE query_id = '$query_id'";
        $this->db->query($sql);
        // print_r($insert_data);die();
        //  $this->db->where('query_id', base64_decode($query_id));
        //  $this->db->update('rfi_query_tab', $update_data);
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

//-------fun for remove image
    public function removeImage($key, $query_id, $author) {
        //extract($data);        
        $sql = "SELECT images FROM rfi_query_tab WHERE query_id='$query_id'";
        $result_arr = $this->db->query($sql);
        foreach ($result_arr->result_array() as $row) {
            $currentFiles = $row['images'];
        }
        $fileArr = json_decode($currentFiles);
        // unset key value
        unlink($fileArr[$key]);

        unset($fileArr[$key]);
        $fileArr = array_values($fileArr);
        $result = array(
            'images' => json_encode($fileArr),
            'modified_by' => $author,
            'modified_date' => date('Y-m-d H:i:s')
        );

        $this->db->where('query_id', $query_id);
        $this->db->update('rfi_query_tab', $result);
        if ($this->db->affected_rows() == 1) {
            $response = array(
                'status' => 'success',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Image was successfully deleted.</div>'
            );
            //return $response;
        } else {
            $response = array(
                'status' => 'failure',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Image was not deleted.</div>'
            );
            //return $response;
        }
        return $response;
    }

    // get query comments
    public function getQueryComments($query_id) {
        $sql = "SELECT * FROM rfi_query_response_tab WHERE query_id='$query_id'";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

}
