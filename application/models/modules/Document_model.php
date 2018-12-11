<?php

class Document_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // get all document types
    public function getDocumentTypes() {
        $sql = "SELECT * FROM document_type_tab";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    // get last revision number of document uploaded for this project
    public function lastRevision($project_id){
        $sql = "SELECT revision_no FROM document_tab WHERE project_id='$project_id' ORDER BY document_id DESC LIMIT 1";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            foreach ($result->result_array() as $key) {
                return $key['revision_no'];
            }
        }
    }

    // get users asssociated with this project
    public function getUserAssoc($project_id){
        $sql = "SELECT * FROM user_tab,role_tab WHERE user_tab.role_id=role_tab.role_id AND role_tab.project_id='$project_id' ORDER BY role_tab.role_id";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    // get roles asssociated with this project
    public function getRolesAssoc($project_id){
        $sql = "SELECT * FROM role_tab WHERE project_id='$project_id'";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    // get all documents with this project
    public function getAllDocuments($project_id){
        $sql = "SELECT * FROM document_tab WHERE project_id='$project_id'";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    // add new document function
    public function addDocument($data){
        extract($data);
        $insert_data = array(
            'document_title' => $document_title,
            'document_type' => $document_type,
            'project_id' => $project_id,
            'revision_no' => $revision_number,
            'document_file' => $images,
            'created_by' => $author,
            'created_date' => date('Y-m-d H:i:s')
        );
        // print_r($insert_data);die();
        $this->db->insert('document_tab',$insert_data);
        if($this->db->affected_rows()>0){
            return true;
        }
        else{
            return false;
        }
    }

}
