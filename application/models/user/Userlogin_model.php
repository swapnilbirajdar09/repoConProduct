
<?php

class Userlogin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function userrole_login($data) {
    	extract($data);
        //---get user details
       // $login_passwordNew = base64_encode($login_password);
        $sql = "SELECT * FROM user_tab, role_tab where role_tab.role_id = user_tab.role_id AND user_email = '$login_username' AND password = '$login_password' ";
        $result = $this->db->query($sql);
     
     $project_id = '';
      $user_id = '';
         $username = '';
        $user_role = '';
       // $role_name = '';
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 500
            );
            return $response;
            die();
        } else {
            foreach ($result->result_array() as $key) {
            	$project_id = $key['project_id'];
               $user_id = $key['user_id'];
                $username = $key['user_name'];
                $user_role = $key['role_id'] . '/' . $key['role_name'];
            }
            	$response = array(
                'status' => 200,
                'project_id'=> $project_id,
                'user_id' => $user_id,
                'userrole_name'=> $user_name,
                'role' => $user_role
            );
        }

        return $response;
    }

}
