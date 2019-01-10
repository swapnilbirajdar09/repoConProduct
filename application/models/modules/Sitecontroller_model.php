<?php

class Sitecontroller_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // get all work item types
    public function getAllWitems($project_id) {
        $sql = "SELECT * FROM work_list_tab WHERE project_id='$project_id' ORDER BY witem_id DESC";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    // get all activites
    public function getAllActivity($project_id) {
        $sql = "SELECT * FROM checklist_activity_tab WHERE project_id='$project_id' ORDER BY day";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    // get slab cycle details
    public function getSlabCycleDetails($project_id,$witem_id) {
        $sql = "SELECT * FROM work_list_tab, checklist_activity_tab WHERE work_list_tab.witem_id=checklist_activity_tab.work_item AND checklist_activity_tab.project_id='$project_id' AND checklist_activity_tab.work_item='$witem_id' ORDER BY day";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    // delete work item
    public function delWitem($item_id) {
        $sql = "DELETE FROM work_list_tab WHERE witem_id='$item_id'";
        $result = $this->db->query($sql);
        if ($this->db->affected_rows() == 1) {
            $response = array(
                'status' => 'success',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Work Item successfully deleted.</div>'
            );
            return $response;
        } else {
            $response = array(
                'status' => 'failure',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Work Item not deleted.</div>'
            );
            return $response;
        }
    }

    // get all documents with this project
    public function getAllDocuments($project_id) {
        $sql = "SELECT * FROM document_tab WHERE project_id='$project_id' ORDER BY document_id DESC";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    // get activity detials 
    public function getActivityDetail($act_id) {
        $sql = "SELECT * FROM checklist_activity_tab WHERE activity_id='$act_id'";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    // add new work item function
    public function addWitem($data) {
        extract($data);
        $insert_data = array(
            'witem_name' => strtoupper($work_item),
            'project_id' => $project_id,
            'created_by' => $author,
            'created_date' => date('Y-m-d H:i:s')
        );
        // print_r($insert_data);die();
        $this->db->insert('work_list_tab', $insert_data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // add new activity function
    public function addActivity($data) {
        extract($data);
        // print_r($data);die();
        $insert_data = array(
            'activity_name' => addslashes($activity),
            'work_item' => $work_item_selected,
            'day' => $day_selected,
            'project_id' => $project_id,
            'comments' => '',
            'created_by' => $author,
            'created_date' => date('Y-m-d H:i:s')
        );
        // print_r($insert_data);die();
        $this->db->insert('checklist_activity_tab', $insert_data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // edit document function
    public function updateChecklist($data) {
        extract($data);
        $update_data = array(
            'work_item' => $work_item_selected,
            'activity_name' => addslashes($activity),
            'comments' => addslashes($activity_comment),
            'modified_by' => $author,
            'modified_date' => date('Y-m-d H:i:s')
        );
        // print_r($insert_data);die();
        $this->db->where('activity_id', base64_decode($activity_id));
        $this->db->update('checklist_activity_tab', $update_data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // mark checklist as done
    public function markChecklistDone($act_id,$author) {
        $update_data = array(
            'status' => '1',
            'modified_by' => $author,
            'modified_date' => date('Y-m-d H:i:s')
        );
        // print_r($insert_data);die();
        $this->db->where('activity_id', $act_id);
        $this->db->update('checklist_activity_tab', $update_data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // mark checklist as undone
    public function markChecklistUndone($act_id,$author) {
        $update_data = array(
            'status' => '0',
            'modified_by' => $author,
            'modified_date' => date('Y-m-d H:i:s')
        );
        // print_r($insert_data);die();
        $this->db->where('activity_id', $act_id);
        $this->db->update('checklist_activity_tab', $update_data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

//--------fun for save report issue
    public function saveComments($data) {
        extract($data);
        $data = array(
            'activity_id' => $activity_id,
            'response_description' => addslashes($comment_posted),
            'created_by' => $author,
            'created_date' => date('Y-m-d H:i:s')
        );

        $sql = $this->db->set($data)->get_compiled_insert('checklist_query_tab');
        $result = $this->db->query($sql);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
  public function getQueryComments($activity_id) {
        $sql = "SELECT * FROM checklist_query_tab WHERE activity_id='$activity_id'";
        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    // upload portfolio image
    public function uploadImageInfo($data) {
        extract($data);
        $currentFiles = '';
        $sql = "SELECT images FROM checklist_activity_tab WHERE activity_id='$activity_id'";
        $result_arr = $this->db->query($sql);
        foreach ($result_arr->result_array() as $key) {
            $currentFiles = $key['images'];
        }
        $fileArr=array();

        if($currentFiles=='' || $currentFiles=='[]'){
            $fileArr[]=$filepath;
        }
        else{
         $fileArr = json_decode($currentFiles);
         array_push($fileArr, $filepath); 
     }


     $result = array(
        'images' => json_encode($fileArr),
        'comments' => addslashes($checklist_comment),
        'modified_by' => $author,
        'modified_date' => date('Y-m-d H:i:s')
    );

     $this->db->where('activity_id', $activity_id);
     $this->db->update('checklist_activity_tab', $result);
     if ($this->db->affected_rows() == 1) {
        return true;
    } else {
        return false;
    }
}

    // delete activity
public function removeActivity($activity_id) {
    $sql = "DELETE FROM checklist_activity_tab WHERE activity_id='$activity_id'";
    $result = $this->db->query($sql);
    if ($this->db->affected_rows() > 0) {
        return true;
    } else {
        return false;
    }
}

    // remove file
public function removeImageInfo($key, $activity_id, $author) {
    $sql = "SELECT images FROM checklist_activity_tab WHERE activity_id='$activity_id'";
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

    $this->db->where('activity_id', $activity_id);
    $this->db->update('checklist_activity_tab', $result);
    if ($this->db->affected_rows() == 1) {
        $response = array(
            'status' => 'success',
            'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> File was successfully deleted.</div>'
        );
        return $response;
    } else {
        $response = array(
            'status' => 'failure',
            'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> File was not deleted.</div>'
        );
        return $response;
    }
}

//    public function getAllActivities($project_id){
//        
//    }
}
