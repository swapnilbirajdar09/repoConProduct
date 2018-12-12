
<?php

class Rfiquery_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

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

}
