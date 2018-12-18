<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Raisequery_rfi extends CI_Controller {

    // Addproduct controller
    public function __construct() {
        parent::__construct();
        // load common model
        $role = $this->session->userdata('role');

        if ($role == 'company_admin') {
            $admin_name = $this->session->userdata('usersession_name');
            if ($admin_name == '') {
//     //check session variable set or not, otherwise logout
                redirect('login');
            }
        } else {
            $user_name = $this->session->userdata('user_name');
            $user_id = $this->session->userdata('user_id');
            $project_id = $this->session->userdata('project_id');
            $role = $this->session->userdata('role');
            $sessionArr = explode('/', $role);
            $role_id = $sessionArr[0];
            $role_name = $sessionArr[1];

            if ($user_name == '') {
//     //check session variable set or not, otherwise logout
                redirect('login');
            }
        }
        $this->load->model('modules/query_model');
    }

    // main index function
    public function index() {
        $role = $this->session->userdata('role');

        if ($role == 'company_admin') {
            $project_id = $this->session->userdata('project_id');
            if ($project_id == '') {
                //check session variable set or not, otherwise logout
                redirect('user/create_project');
            }
            $data['queries'] = Raisequery_rfi::getAllQueries();
            $data['projects'] = Raisequery_rfi::getAllprojects();
        } else {
            $user_name = $this->session->userdata('user_name');
            $user_id = $this->session->userdata('user_id');
            $project_id = $this->session->userdata('project_id');
            $role = $this->session->userdata('role');
            $sessionArr = explode('/', $role);
            $role_id = $sessionArr[0];
            $role_name = $sessionArr[1];
            $data['features'] = Raisequery_rfi::getAllFeatuesForUser($user_id, $role_id);
            $data['queries'] = Raisequery_rfi::getAllQueries();
        }
        $this->load->view('includes/header', $data);
        $this->load->view('pages/modules/requestForInfo', $data);
        $this->load->view('includes/footer');
    }

    public function getAllFeatuesForUser($user_id, $role_id) {
        $path = base_url();
        $url = $path . 'api/user/User_api/getAllFeatuesForUser?user_id=' . $user_id . '&role_id=' . $role_id;
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
    }

//-------------fun for ge all projects
    public function getAllprojects() {
        $company_id = $this->session->userdata('company_id');
        $path = base_url();
        $url = $path . 'api/user/Role_api/getAllProjects?company_id=' . $company_id;
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
    }

//-------------fun for save query details
    public function raiseQuery() {
        extract($_POST);
        $data = $_POST;

        $prod_Arr = array();
        $imageArr = array();
        //print_r($_POST);
        //print_r($_FILES);
        $allowed_types = ['gif', 'jpg', 'png', 'jpeg', 'JPG', 'GIF', 'JPEG', 'PNG'];
        for ($i = 0; $i < count($_FILES['prod_image']['name']); $i++) {
            $imagePath = '';
            $product_image = $_FILES['prod_image']['name'][$i];
            if (!empty(($_FILES['prod_image']['name'][$i]))) {
                $extension = pathinfo($_FILES['prod_image']['name'][$i], PATHINFO_EXTENSION);

                $_FILES['userFile']['name'] = $queryTitle . '_' . $i . '.' . $extension;
                $_FILES['userFile']['type'] = $_FILES['prod_image']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['prod_image']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['prod_image']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['prod_image']['size'][$i];

                $uploadPath = 'assets/modules/query_images/';  //upload images in images/desktop/ folder
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png|jpeg'; //allowed types of images           
                $config['overwrite'] = FALSE;
                $this->load->library('upload', $config);
                //load upload file config.
                $this->upload->initialize($config);
                if ($this->upload->do_upload('userFile')) {
                    $fileData = $this->upload->data();
                    $imagePath = 'assets/modules/query_images/' . $fileData['file_name'];
                } else {
                    $response = array(
                        'status' => 'validation',
                        'message' => $this->upload->display_errors('<div class="alert alert-warning alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong>', '</div>'),
                    );
                    echo json_encode($response);
                    die();
                }
            }
            $imageArr[] = $imagePath;
        }
        $data['project_id'] = $this->session->userdata('project_id');
        if ($imagePath == '') {
            $data['images'] = '';
        } else {
            $data['images'] = json_encode($imageArr);
        }
        $user_role = $this->session->userdata('role');
        if ($user_role == 'company_admin') {
            $data['created_by'] = $this->session->userdata('usersession_name');
        } else {
            $data['created_by'] = $this->session->userdata('user_name');
        }
        //print_r($data);die();
        //$header = array('user_id' =>  $user_id);
        $path = base_url();
        $url = $path . 'api/modules/Rfiquery_api/raiseQuery';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
//        print_r($response_json);
//        die();
        if ($response['status'] == 'success') {
            $response = array('status' => 'success',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> Query Raised Successfully.
                </div>
                <script>
                window.setTimeout(function() {
                 $(".alert").fadeTo(500, 0).slideUp(500, function(){
                     $(this).remove(); 
                     });
                     location.reload();
                     }, 1000);
                     </script>');
        } elseif ($response['status'] == 'validation') {
            $response = array('status' => 'validation',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failure!</strong> Something Went Wrong. Email Id Must be Unique.
                </div>
                <script>
                window.setTimeout(function() {
                 $(".alert").fadeTo(500, 0).slideUp(500, function(){
                     $(this).remove(); 
                     });
                     }, 5000);
                     </script>');
        } else {
            $response = array('status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failure!</strong> Something Went Wrong. Query Not Raised Successfully.
                </div>
                <script>
                window.setTimeout(function() {
                 $(".alert").fadeTo(500, 0).slideUp(500, function(){
                     $(this).remove(); 
                     });
                     }, 5000);
                     </script>');
        }
        echo json_encode($response);
    }

//------------fun for get all queries
    public function getAllQueries() {
        $path = base_url();
        $url = $path . 'api/modules/Rfiquery_api/getAllQueries';
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
    }

//---------------fun for delete query
    public function removeQuery() {
        extract($_GET);
        $path = base_url();
        $url = $path . 'api/modules/Rfiquery_api/removeQuery?query_id=' . $query_id;
        //create a new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        if ($response['status'] == 'success') {
            $response = array(
                'status' => 'success',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> Query Removed successfully.
                </div>
                <script>
                window.setTimeout(function() {
                 $(".alert").fadeTo(500, 0).slideUp(500, function(){
                     $(this).remove(); 
                     });
                     location.reload();
                     }, 1000);
                     </script>'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failure!</strong> Query Not Removed Successfully.
                </div>
                <script>
                window.setTimeout(function() {
                 $(".alert").fadeTo(500, 0).slideUp(500, function(){
                     $(this).remove(); 
                     });
                     }, 5000);
                     </script>'
            );
        }
        echo json_encode($response);
    }

//---------fun for edit query page view
    public function edit_query($param = '') {
        $query_id = base64_decode($param);

        $path = base_url();
        $url = $path . 'api/modules/Rfiquery_api/getQueryDetails?query_id=' . $query_id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // authenticate API
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_USERPWD, API_USER . ":" . API_PASSWD);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($output, true);

        $role = $this->session->userdata('role');

        if ($role == 'company_admin') {
            $data['projects'] = Raisequery_rfi::getAllprojects();
            $data['queryDetails'] = $response;
        } else {
            $user_name = $this->session->userdata('user_name');
            $user_id = $this->session->userdata('user_id');
            $project_id = $this->session->userdata('project_id');
            $role = $this->session->userdata('role');
            $sessionArr = explode('/', $role);
            $role_id = $sessionArr[0];
            $role_name = $sessionArr[1];
            $data['features'] = Raisequery_rfi::getAllFeatuesForUser($user_id, $role_id);
            $data['queryDetails'] = $response;
        }

        $this->load->view('includes/header', $data);
        $this->load->view('pages/modules/edit_queries', $data);
        $this->load->view('includes/footer');
    }

    // post comment to rfi query
    public function addComment() {
        extract($_POST);
        // print_r($_POST);die();
        $data = $_POST;
        $session_name = $this->session->userdata('usersession_name');
        $session_role = $this->session->userdata('role');
        if ($session_role == 'company_admin') {
            $data['author'] = 'Administrator';
        } else {
            $user_name = $this->session->userdata('user_name');
            $data['author'] = $user_name;
        }

        $path = base_url();
        $url = $path . 'api/modules/Query_api/saveComments';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);

        if ($response) {
            $response = array(
                'status' => 'success',
                'message' => '<p class="w3-green w3-padding-small w3-small"><strong>Success!</strong> Comment posted successfully!</p>'
            );
            echo json_encode($response);
            die();
        } else {
            $response = array(
                'status' => 'error',
                'message' => '<p class="w3-red w3-padding-small w3-small"><strong>Error!</strong> Comment not posted successfully!</p>'
            );
            echo json_encode($response);
            die();
        }
    }

//--------------fun for update query Details
    public function updateQueryDetails() {
        extract($_POST);
        $data = $_POST;
        $session_name = $this->session->userdata('usersession_name');
        $session_role = $this->session->userdata('role');
        if ($session_role == 'company_admin') {
            $data['author'] = 'Administrator';
        } else {
            $user_name = $this->session->userdata('user_name');
            $data['author'] = $user_name;
        }

        $path = base_url();
        $url = $path . 'api/modules/rfiquery_api/updateQueryDetails';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // authenticate API
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_USERPWD, API_USER . ":" . API_PASSWD);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($output, true);

        if ($response) {
            $response = array(
                'status' => 'success',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Details updated successfully.</div>'
            );
            echo json_encode($response);
            die();
        } else {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong> Perhaps you have not changed any value.</div>'
            );
            echo json_encode($response);
            die();
        }
    }

//----------------fun for remove image
    public function removeImage() {
        extract($_GET);
        if (isset($query_id) && $query_id != '') {
            $data['key'] = $key;
            $data['query_id'] = $query_id;
            $session_name = $this->session->userdata('usersession_name');
            $session_role = $this->session->userdata('role');
            if ($session_role == 'company_admin') {
                $data['author'] = 'Administrator';
            } else {
                $user_name = $this->session->userdata('user_name');
                $data['author'] = $user_name;
            }
            $path = base_url();
            $url = $path . 'api/modules/rfiquery_api/removeImage';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            // authenticate API
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
            curl_setopt($ch, CURLOPT_USERPWD, API_USER . ":" . API_PASSWD);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            //close cURL resource
            curl_close($ch);
            $result = json_decode($output, true);
            //print_r($output);die();
            if ($result['status'] == 'warning') {
                echo $result['message'];
                die();
            }
            if ($result['status'] == 'success') {
                echo $result['message'];
            } else {
                echo $result['message'];
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Image not found.</div>';
        }
    }

//------------fun for upload image
    public function uploadImage() {
        extract($_POST);
        $data = $_POST;
        $data['query_id'] = $query_id;
        $session_name = $this->session->userdata('usersession_name');
        $session_role = $this->session->userdata('role');
        if ($session_role == 'company_admin') {
            $data['author'] = 'Administrator';
        } else {
            $user_name = $this->session->userdata('user_name');
            $data['author'] = $user_name;
        }
        $filepath = '';

        $file_name = $_FILES['doc_file']['name'];
        if (!empty(($_FILES['doc_file']['name']))) {
            $extension = pathinfo($_FILES['doc_file']['name'], PATHINFO_EXTENSION);
            $_FILES['userFile']['name'] = $query_title . '_' . time() . '.' . $extension;
            $_FILES['userFile']['type'] = $_FILES['doc_file']['type'];
            $_FILES['userFile']['tmp_name'] = $_FILES['doc_file']['tmp_name'];
            $_FILES['userFile']['error'] = $_FILES['doc_file']['error'];
            $_FILES['userFile']['size'] = $_FILES['doc_file']['size'];

            $uploadPath = 'assets/modules/query_images/';  //upload images in images/desktop/ folder

            $config['upload_path'] = $uploadPath;
            $config['overwrite'] = FALSE;
            $config['allowed_types'] = '*'; //allowed types of files
            $this->load->library('upload', $config);  //load upload file config.
            $this->upload->initialize($config);
            $image_path = '';

            if ($this->upload->do_upload('userFile')) {
                $fileData = $this->upload->data();
                $filepath = 'assets/modules/query_images/' . $fileData['file_name'];
            } else {
                $response = array(
                    'status' => 'validation',
                    'message' => $this->upload->display_errors('<div class="alert alert-warning alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong>', '</div>'),
                    'field' => 'doc_file'
                );
                echo json_encode($response);
                die();
            }
        }
        $data['filepath'] = $filepath;
        // print_r($data);die();
        $path = base_url();
        $url = $path . 'api/modules/Query_api/uploadImage';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // authenticate API
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_USERPWD, API_USER . ":" . API_PASSWD);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $result = json_decode($output, true);
//        print_r($output);
//        die();
        if ($result) {
            $response = array(
                'status' => 'success',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> File uploaded successfully.</div>'
            );
            echo json_encode($response);
            die();
        } else {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> File was not uploaded.</div>'
            );
            echo json_encode($response);
            die();
        }
    }

    // get associated comments for query
    public function getQueryComments() {
        extract($_GET);
        $path = base_url();
        $url = $path . 'api/modules/rfiquery_api/getQueryComments?query_id=' . $query_id;
        // echo $url;die();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        // authenticate API
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_USERPWD, API_USER . ":" . API_PASSWD);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($output, true);
        // echo $output;
        if (!$response) {
            echo '<span>No Comments Available.</span>';
        } else {
            foreach ($response as $key) {
                echo '
            <div class="w3-border w3-padding" >
             <label><i>' . $key['created_by'] . '-' . $key['created_date'] . '</i></label>
              <p><i class="fa fa-quote-left"></i> 
                 <i>' . $key['response_description'] . '</i> 
                 <i class="fa fa-quote-right"></i></p>
               </div>
             </div>
            ';
            }
        }
    }

}
