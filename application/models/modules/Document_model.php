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

    // delete document
    public function removeDoc($document_id){
        $sql = "DELETE FROM document_tab WHERE document_id='$document_id'";
        $result = $this->db->query($sql);
        if($this->db->affected_rows()>0){
            return true;
        }
        else{
            return false;
        }
    }

    // get all documents with this project
    public function getAllDocuments($project_id){
        $sql = "SELECT * FROM document_tab WHERE project_id='$project_id' ORDER BY document_id DESC";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    // get document detials 
    public function getDocumentDetail($doc_id){
        $sql = "SELECT * FROM document_tab WHERE document_id='$doc_id'";
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

    // edit document function
    public function updateDocument($data){
        extract($data);
        $update_data = array(
            'document_title' => $document_title,
            'document_type' => $document_type,
            'revision_no' => $revision_number,
            'modified_by' => $author,
            'modified_date' => date('Y-m-d H:i:s')
        );
        // print_r($insert_data);die();
        $this->db->where('document_id', base64_decode($document_id));
        $this->db->update('document_tab', $update_data);
        if($this->db->affected_rows()>0){
            return true;
        }
        else{
            return false;
        }
    }

    // upload portfolio image
    public function uploadFile($data){
        extract($data);
        $doc_id=base64_decode($document_id);
        $currentFiles='';
        $sql = "SELECT document_file FROM document_tab WHERE document_id='$doc_id'";
        $result_arr = $this->db->query($sql);
        foreach ($result_arr->result_array() as $key) {
            $currentFiles = $key['document_file'];
        }

        $fileArr=json_decode($currentFiles);
        array_push($fileArr,$filepath);
        $result = array(
            'document_file' => json_encode($fileArr),
            'modified_by' => $author,
            'modified_date' => date('Y-m-d H:i:s')
        );

        $this->db->where('document_id', base64_decode($document_id));
        $this->db->update('document_tab', $result);
        if($this->db->affected_rows()==1){
            return true;
        }
        else{
            return false;
        }
    }

    // remove file
    public function removeFile($key,$document_id,$author){
        $sql = "SELECT document_file FROM document_tab WHERE document_id='$document_id'";
        $result_arr = $this->db->query($sql);
        foreach ($result_arr->result_array() as $row) {
            $currentFiles = $row['document_file'];
        }

        $fileArr=json_decode($currentFiles);
        if(count($fileArr)==1){
            $response=array(
                'status'    =>  'false',
                'message'   =>  '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Cannot remove File. Atleast one file should be uploaded.</div>'
            );
            return $response;
            die();
        }
        unlink($fileArr[$key]);

        // unset key value
        unset($fileArr[$key]);
        $fileArr = array_values($fileArr);
        $result = array(
            'document_file' => json_encode($fileArr),
            'modified_by' => $author,
            'modified_date' => date('Y-m-d H:i:s')
        );

        $this->db->where('document_id', $document_id);
        $this->db->update('document_tab', $result);
        if($this->db->affected_rows()==1){
            $response=array(
                'status'    =>  'success',
                'message'   =>  '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> File was successfully deleted.</div>'
            );
            return $response;
        }
        else{
            $response=array(
                'status'    =>  'failure',
                'message'   =>  '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> File was not deleted.</div>'
            );
            return $response;
        }
    }

}
