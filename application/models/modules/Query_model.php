<?php

class Query_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function uploadImage($data) {
        extract($data);
        $query_id = base64_decode($query_id);
        $currentFiles = '';
        $fileArr = array();
        $sql = "SELECT images FROM rfi_query_tab WHERE query_id='$query_id'";
        $result_arr = $this->db->query($sql);
        foreach ($result_arr->result_array() as $key) {
            $currentFiles = $key['images'];
        }
        if ($currentFiles != '' && $currentFiles != '[]') {
            $fileArr = json_decode($currentFiles);
            array_push($fileArr, $filepath);
        } else {
            $fileArr[] = $filepath;
        }
        $json = json_encode($fileArr);
        $dat = date('Y-m-d H:i:s');
        $result = array(
            'images' => $json,
            'modified_by' => $author,
            'modified_date' => $dat
        );
        //print_r($result);
        //die();
        $this->db->where('query_id', $query_id);
        $this->db->update('rfi_query_tab', $result);

        if ($this->db->affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
//--------fun for save comments
    public function saveComments($data) {
        extract($data);
        $data = array(
            'query_id' => $query_id,
            'response_description' => addslashes($comment_posted),
            'created_by' => $author,
            'created_date' => date('Y-m-d H:i:s')
        );

        $sql = $this->db->set($data)->get_compiled_insert('rfi_query_response_tab');
        $result = $this->db->query($sql);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
