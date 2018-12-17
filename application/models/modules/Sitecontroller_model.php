<?php

class Sitecontroller_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // get all work item types
    public function getAllWitems() {
        $sql = "SELECT * FROM work_list_tab ORDER BY witem_id DESC";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    // get all activites
    public function getAllActivity($project_id) {
        $sql = "SELECT * FROM checklist_activity_tab WHERE project_id='$project_id' ORDER BY activity_id DESC";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }  

    // delete work item
    public function delWitem($item_id){
        $sql = "DELETE FROM work_list_tab WHERE witem_id='$item_id'";
        $result = $this->db->query($sql);
        if($this->db->affected_rows()==1){
            $response=array(
                'status'    =>  'success',
                'message'   =>  '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Work Item successfully deleted.</div>'
            );
            return $response;
        }
        else{
            $response=array(
                'status'    =>  'failure',
                'message'   =>  '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Work Item not deleted.</div>'
            );
            return $response;
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

    // get activity detials 
    public function getActivityDetail($act_id){
        $sql = "SELECT * FROM checklist_activity_tab WHERE activity_id='$act_id'";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    // add new work item function
    public function addWitem($data){
        extract($data);
        $insert_data = array(
            'witem_name' => strtoupper($work_item),
            'project_id' => $project_id,
            'created_by' => $author,
            'created_date' => date('Y-m-d H:i:s')
        );
        // print_r($insert_data);die();
        $this->db->insert('work_list_tab',$insert_data);
        if($this->db->affected_rows()>0){
            return true;
        }
        else{
            return false;
        }
    }

    // add new activity function
    public function addActivity($data){
        extract($data);
        $insert_data = array(
            'activity_name' => $activity,
            'work_item' => $work_item_selected,
            'comments' => $activity_comment,
            'images' => $images,
            'project_id' => $project_id,
            'created_by' => $author,
            'created_date' => date('Y-m-d H:i:s')
        );
        // print_r($insert_data);die();
        $this->db->insert('checklist_activity_tab',$insert_data);
        if($this->db->affected_rows()>0){
            return true;
        }
        else{
            return false;
        }
    }

    // edit document function
    public function updateChecklist($data){
        extract($data);
        $update_data = array(
            'work_item' => $work_item_selected,
            'activity_name' => $activity,
            'comments' => $activity_comment,
            'modified_by' => $author,
            'modified_date' => date('Y-m-d H:i:s')
        );
        // print_r($insert_data);die();
        $this->db->where('activity_id', base64_decode($activity_id));
        $this->db->update('checklist_activity_tab', $update_data);
        if($this->db->affected_rows()>0){
            return true;
        }
        else{
            return false;
        }
    }

    // upload portfolio image
    public function uploadImageInfo($data){
        extract($data);
        $act_id=base64_decode($activity_id);
        $currentFiles='';
        $sql = "SELECT images FROM checklist_activity_tab WHERE activity_id='$act_id'";
        $result_arr = $this->db->query($sql);
        foreach ($result_arr->result_array() as $key) {
            $currentFiles = $key['images'];
        }

        $fileArr=json_decode($currentFiles);
        array_push($fileArr,$filepath);
        $result = array(
            'images' => json_encode($fileArr),
            'modified_by' => $author,
            'modified_date' => date('Y-m-d H:i:s')
        );

        $this->db->where('activity_id', base64_decode($activity_id));
        $this->db->update('checklist_activity_tab', $result);
        if($this->db->affected_rows()==1){
            return true;
        }
        else{
            return false;
        }
    }

    // delete activity
    public function removeActivity($activity_id){
        $sql = "DELETE FROM checklist_activity_tab WHERE activity_id='$activity_id'";
        $result = $this->db->query($sql);
        if($this->db->affected_rows()>0){
            return true;
        }
        else{
            return false;
        }
    }

    // remove file
    public function removeImageInfo($key,$activity_id,$author){
        $sql = "SELECT images FROM checklist_activity_tab WHERE activity_id='$activity_id'";
        $result_arr = $this->db->query($sql);
        foreach ($result_arr->result_array() as $row) {
            $currentFiles = $row['images'];
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
        // unset key value
        unset($fileArr[$key]);
        $fileArr = array_values($fileArr);
        $result = array(
            'images' => json_encode($fileArr),
            'modified_by' => $author,
            'modified_date' => date('Y-m-d H:i:s')
        );

        $this->db->where('activity_id', $activity_id);
        $this->db->update('checklist_activity_tab', $result);
        if($this->db->affected_rows()==1){
            $response=array(
                'status'    =>  'success',
                'message'   =>  '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> File was successfully deleted.</div>'
            );
            unlink($fileArr[$key]);
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
