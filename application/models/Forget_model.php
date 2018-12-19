<?php

class Forget_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

// ----------------------FORGET PASSWORD MODEL-------------------------------------//
    public function getPassword($admin_email) {
        $query = "SELECT * FROM company_tab WHERE email='$admin_email'";
        //echo $query;        die();
        $result = $this->db->query($query);

        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 412,
                'status_message' => 'Email ID not registered. New user can register your account through Registration page!'
            );
        } else {
            $password = '';

            foreach ($result->result_array() as $row) {
                $password = $row['password'];
            }
            $emailSend = Forget_model::sendPassword($admin_email, $password);
            if ($emailSend['status'] == 200) {
                $response = array(
                    'status' => 200,
                    'status_message' => 'Password has been sent to your registered Email ID.'
                );
            } else {
                $response = array(
                    'status' => 500,
                    'status_message' => 'Email Error. Password sending failed.'
                );
            }
        }
        return $response;
    }

    public function getUserPassword($user_email) {
        $query = "SELECT * FROM user_tab WHERE user_email='$user_email'";
        //echo $query;        die();
        $result = $this->db->query($query);

        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 412,
                'status_message' => 'Email ID not registered. New user can register your account through Registration page!'
            );
        } else {
            $password = '';

            foreach ($result->result_array() as $row) {
                $password = $row['password'];
            }
            $emailSend = Forget_model::sendPassword($user_email, $password);
            if ($emailSend['status'] == 200) {
                $response = array(
                    'status' => 200,
                    'status_message' => 'Password has been sent to your registered Email ID.'
                );
            } else {
                $response = array(
                    'status' => 500,
                    'status_message' => 'Email Error. Password sending failed.'
                );
            }
        }
        return $response;
    }

    // -----------------------PASSWORD EMAIL MODEL----------------------//
    public function sendPassword($email_id, $password) {
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
        //$config['smtp_crypto'] = 'tls';
        //return ($config);die();
        //($password);

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('support@bizmo-tech.com', "Admin Team");
        $this->email->to($email_id);
        $this->email->subject("Password Request-Construction Manager");
        $this->email->message('<html>
        <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body>
        <div class="container col-lg-8" style="box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)!important;margin:10px; font-family:Candara;">
        <h2 style="color:blue; font-size:25px">Password for Construction Manager!</h2>
        <h3 style="font-size:15px;">Hello User,<br></h3>
        <h3 style="font-size:15px;">We have recieved a request to have your password for <u>Construction Manager Website</u>.</h3>
        <h3 style="font-size:15px;">Following is the requested password for ' . $email_id . '</h3>
        <h3>Password: ' . $password . '</h3>
        <br><br>
        <h5>Note: If you did not make this request, then kindly ignore this message.</h5>
        <div class="col-lg-12">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
        </div>
        </body></html>');
//print_r($this->email->print_debugger());die();
        if ($this->email->send()) {
            $response = array(
                'status' => 200, //---------email sending succesfully 
                'status_message' => 'Email Sent Successfully.',
            );
        } else {
            //print_r($this->email->print_debugger());die();
            $response = array(
                'status' => 500, //---------email send failed
                'status_message' => 'Email Sending Failed.'
            );
        }
        return $response;
    }

}
