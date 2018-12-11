<?php

class Projectuser_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getProjectRoles($project_id) {
        $sql = "SELECT * FROM role_tab WHERE project_id = '$project_id'";
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

    public function createNewUser($data) {
        extract($data);
        //print_r($data);die();
        $project_name = '';
        $sqlSelect = "SELECT * FROM project_tab WHERE project_id = '$project_id'";
        $result = $this->db->query($sqlSelect);
        foreach ($result->result_array() as $key) {
            $project_name = $key['project_name'];
        }
        $unique = rand(1111, 9999);
        $username = $userFirstName[0] . '.' . $userLastName . '@' . $unique;
        $roles = explode("/", $roles);
        $role_id = $roles[0]; // piece1
        $role_name = $roles[1];
        $sql = "INSERT INTO user_tab(project_id,role_id,role_name,"
                . "first_name,last_name,user_email,user_mobile,"
                . "user_name,password,created_date)"
                . "VALUES('$project_id','$role_id','$role_name','" . addslashes($userFirstName) . "',"
                . "'" . addslashes($userLastName) . "',"
                . "'$userEmail','$user_mobile','$username','$userPassword',NOW())";
        if ($this->db->query($sql)) {
            $emailsend = Projectuser_model::sendEmail($project_name, $userFirstName, $role_name, $userLastName, $userEmail, $username, $userPassword);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function sendEmail($project_name, $userFirstName, $role_name, $userLastName, $userEmail, $username, $userPassword) {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'mx1.hostinger.in',
            'smtp_port' => '587',
            'smtp_user' => 'support@bizmo-tech.com', // change it to yours
            'smtp_pass' => 'Descartes@1990', // change it to yours
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );
        $uname = $userFirstName . ' ' . $userLastName;
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('support@bizmo-tech.com', "Admin Team");
        $this->email->to($userEmail, $uname);
        $this->email->subject("Bizmo Technology Support");
        $this->email->message('<html>
            <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="http://jobmandi.in/css/bootstrap/bootstrap.min.css">
            <script src="http://jobmandi.in/css/bootstrap/jquery.min.js"></script>
            <script src="http://jobmandi.in/css/bootstrap/bootstrap.min.js"></script>
            </head>
            <body>
            <div class="container col-lg-8" style="box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)!important;margin:10px; font-family:Candara;">
            <h2 style="color:#4CAF50; font-size:30px">Admin Team Support</h2>
            <h3 style="font-size:15px;"> Your Login Credentials For Project Name - ' . $project_name . ' <br>'
                . ' Role:- ' . $role_name . ' <br>
                UserName :- ' . $username . '<br>
                Password :- ' . $userPassword . '<br>    
            <br></h3>
            <div class="col-lg-12">
            <div class="col-lg-4"></div>
            <div class="col-lg-4"></div>
            </div>
            <h4 style="font-size:15px;"><b>Thank You..!</b></h4>
            </div>
            </body></html>');

        if ($this->email->send()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
