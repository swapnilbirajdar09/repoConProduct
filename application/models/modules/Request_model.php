<?php

class Request_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

   public function createNewReq($data)
   {
   	  $role_id ='';
   	    extract($data);

   	    if($role_id == '')
   	    {
   	    	$role_id = 0;
   	    }
        $insert_data = array(
        	'project_id' => $project_id,
            'document_name' => $document_name,
            'role_id' => $role_id,
            'requested_by' => $author,
            'requested_from' => $requested_from,
            'estimated_date' => $estimated_date,
            'status' => '0',
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => $author
        );
        // print_r($insert_data);die();
        $this->db->insert('request_tab', $insert_data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

   }

}