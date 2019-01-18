<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Site_inspection extends CI_Controller {

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
    }

    // main index function
    public function index() {
        $role = $this->session->userdata('role');
        // get project session
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];
        if ($role == 'company_admin') {

            if ($project_id == '') {
                //check session variable set or not, otherwise logout
                redirect('user/create_project');
            }
            $data['allWitems'] = Site_inspection::getAllWitems();
            // // print_r($data);
            $data['projects'] = Site_inspection::getAllprojects();
        } else {
            $user_name = $this->session->userdata('user_name');
            $user_id = $this->session->userdata('user_id');
            $role = $this->session->userdata('role');
            $sessionArr = explode('/', $role);
            $role_id = $sessionArr[0];
            $role_name = $sessionArr[1];
            $data['features'] = Site_inspection::getAllFeatuesForUser($user_id, $role_id);
            $data['allWitems'] = Site_inspection::getAllWitems();
        }

        // get checklist details
        $selected = '';
        if (isset($_POST['selected_witem']) && $_POST['selected_witem'] != '') {
            $selected = $_POST['selected_witem'];
            $data['checklistDetails'] = Site_inspection::getSlabCycleDetails($selected);
        }
        $data['roles'] = Site_inspection::getAllRoles();
        $this->load->view('includes/header', $data);
        $this->load->view('pages/modules/site_inspection', $data);
        $this->load->view('includes/footer');
    }

//-----------fun for save query for checklist failure
    public function raiseQueryForChecklistFailure() {
        extract($_POST);
        $data = $_POST;

        //  print_r($_POST);die();
        if ($query_title == '') {
            $response = array(
                'status' => 'validation',
                'message' => '<p class="w3-red w3-padding-small w3-small"><strong>Warning!</strong> Please fill the query title.!</p>'
            );
            echo json_encode($response);
            die();
        }

        if (!isset($shared_with)) {
            $response = array(
                'status' => 'validation',
                'message' => '<p class="w3-red w3-padding-small w3-small"><strong>Warning!</strong> Please Choose at least one role first.!</p>'
            );
            echo json_encode($response);
            die();
        }

        if ($comment_posted == '') {
            $response = array(
                'status' => 'validation',
                'message' => '<p class="w3-red w3-padding-small w3-small"><strong>Warning!</strong> Please please fill the query description.!</p>'
            );
            echo json_encode($response);
            die();
        }
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];
        $session_name = $this->session->userdata('usersession_name');
        $session_role = $this->session->userdata('role');
        if ($session_role == 'company_admin') {
            $data['author'] = 'Administrator';
        } else {
            $user_name = $this->session->userdata('user_name');
            $data['author'] = $user_name;
        }
        $data['project_id'] = $project_id;
        $data['shared_with'] = json_encode($shared_with);

        $path = base_url();
        $url = $path . 'api/modules/sitecontroller_api/raiseQueryForChecklistFailure';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response_json);
        //die();

        if ($response) {
            $response = array(
                'status' => 'success',
                'message' => '<p class="w3-green w3-padding-small w3-small"><strong>Success!</strong> Query raised successfully!</p>'
            );
            echo json_encode($response);
            die();
        } else {
            $response = array(
                'status' => 'error',
                'message' => '<p class="w3-red w3-padding-small w3-small"><strong>Error!</strong> Query not raised successfully!</p>'
            );
            echo json_encode($response);
            die();
        }
    }

    public function getAllRoles() {
        // $project_id = $this->session->userdata('project_id');
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];
        $path = base_url();
        $url = $path . 'api/user/Role_api/getAllRoles?project_id=' . $project_id;
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

    // post comment to rfi query
    public function addComment() {
        extract($_POST);
        //  print_r($_POST);die();
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
        $url = $path . 'api/modules/sitecontroller_api/saveComments';
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

    // get associated comments for query
    public function getQueryComments() {
        extract($_GET);
        $path = base_url();
        $url = $path . 'api/modules/rfiquery_api/getQueryComments?activity_id=' . $activity_id;
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

    // add new work item function
    public function addWitem() {
        extract($_POST);
        // print_r($_FILES);
        // get project session
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];
        $data = $_POST;
        $data['project_id'] = $project_id;

        $session_name = $this->session->userdata('usersession_name');
        $session_role = $this->session->userdata('role');
        if ($session_role == 'company_admin') {
            $data['author'] = 'Administrator';
        } else {
            $user_name = $this->session->userdata('user_name');
            $data['author'] = $user_name;
        }

        // print_r($data);die();
        $path = base_url();
        $url = $path . 'api/modules/sitecontroller_api/addWitem';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($output, true);
        if ($response) {
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Work Item added.</div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Work Item was not added successfully.</div>';
        }
    }

    // get all work items
    public function getAllWitems() {
        // get project session
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];
        $path = base_url();
        $url = $path . 'api/modules/sitecontroller_api/getAllWitems?project_id=' . $project_id;
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
        return $response;
    }

    // get all work items
    public function getAllActivity() {
        $project_id = $this->session->userdata('project_id');
        $path = base_url();
        $url = $path . 'api/modules/sitecontroller_api/getAllActivity?project_id=' . base64_encode($project_id);
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
        return $response;
    }

    // add new activity in checklist function
    public function addActivity() {
        extract($_POST);
        // print_r($_FILES);
        // get project session
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];
        $data = $_POST;
        $data['project_id'] = $project_id;

        $session_name = $this->session->userdata('usersession_name');
        $session_role = $this->session->userdata('role');
        if ($session_role == 'company_admin') {
            $data['author'] = 'Administrator';
        } else {
            $user_name = $this->session->userdata('user_name');
            $data['author'] = $user_name;
        }

        // print_r($data);die();
        $path = base_url();
        $url = $path . 'api/modules/sitecontroller_api/addActivity';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($output, true);
        // print_r($output);die();
        if ($response) {
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Activity added.</div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Activity was not added successfully.</div>';
        }
    }

    // get last revision number for current project
    public function getlastRevision() {
        $project_id = $this->session->userdata('project_id');
        $path = base_url();
        $url = $path . 'api/modules/document_api/getlastRevision?project_id=' . $project_id;
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
        return $response;
    }

    // edit document fucntion
    public function updateChecklist() {
        extract($_POST);
        // print_r($_FILES);
        $data = $_POST;
        $session_name = $this->session->userdata('usersession_name');
        $session_role = $this->session->userdata('role');
        if ($session_role == 'company_admin') {
            $data['author'] = 'Administrator';
        } else {
            $user_name = $this->session->userdata('user_name');
            $data['author'] = $user_name;
        }
        // validate fields
        if ($work_item_selected == '0') {
            $response = array(
                'status' => 'validation',
                'message' => '<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong> Choose Valid Work item Type first !</div>',
                'field' => 'document_type'
            );
            echo json_encode($response);
            die();
        }

        $path = base_url();
        $url = $path . 'api/modules/Sitecontroller_api/updateChecklist';
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

    // mark checklist as done
    public function markChecklistDone() {
        extract($_GET);
        $author = '';
        $session_name = $this->session->userdata('usersession_name');
        $session_role = $this->session->userdata('role');
        if ($session_role == 'company_admin') {
            $author = 'Administrator';
        } else {
            $user_name = $this->session->userdata('user_name');
            $author = $user_name;
        }
        $path = base_url();
        $url = $path . 'api/modules/sitecontroller_api/markChecklistDone?activity_id=' . $act_id . '&author=' . $author;
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
        if ($response) {
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Checklist Status marked as <b>Done</b>.</div>';
            die();
        } else {

            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong> Checklist Status was not changed.</div>';
            die();
        }
    }

    // mark checklist as undone
    public function markChecklistUndone() {
        extract($_GET);
        $author = '';
        $session_name = $this->session->userdata('usersession_name');
        $session_role = $this->session->userdata('role');
        if ($session_role == 'company_admin') {
            $author = 'Administrator';
        } else {
            $user_name = $this->session->userdata('user_name');
            $author = $user_name;
        }
        $path = base_url();
        $url = $path . 'api/modules/sitecontroller_api/markChecklistUndone?activity_id=' . $act_id . '&author=' . $author;
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
        if ($response) {
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Checklist Status marked as <b>Undone</b>.</div>';
            die();
        } else {

            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong> Checklist Status was not changed.</div>';
            die();
        }
    }

    // upload checklist images
    public function uploadImageInfo() {
        extract($_POST);
        $data = $_POST;
        $data['activity_id'] = base64_decode($activity_id_upload);
        $session_name = $this->session->userdata('usersession_name');
        $session_role = $this->session->userdata('role');
        if ($session_role == 'company_admin') {
            $data['author'] = 'Administrator';
        } else {
            $user_name = $this->session->userdata('user_name');
            $data['author'] = $user_name;
        }
        $filepath = '';
        $file_name = $_FILES['checklist_image']['name'];
        if (!empty(($_FILES['checklist_image']['name']))) {
            $extension = pathinfo($_FILES['checklist_image']['name'], PATHINFO_EXTENSION);
            $_FILES['userFile']['name'] = 'Activity_IU0' . $data['activity_id'] . '_' . time() . '.' . $extension;
            $_FILES['userFile']['type'] = $_FILES['checklist_image']['type'];
            $_FILES['userFile']['tmp_name'] = $_FILES['checklist_image']['tmp_name'];
            $_FILES['userFile']['error'] = $_FILES['checklist_image']['error'];
            $_FILES['userFile']['size'] = $_FILES['checklist_image']['size'];

            $uploadPath = 'assets/modules/site_images/';  //upload images in images/desktop/ folder

            $config['upload_path'] = $uploadPath;
            $config['overwrite'] = TRUE;
            $config['max_size'] = '10000';
            $config['allowed_types'] = 'gif|jpg|png|jpeg'; //allowed types of files
            $this->load->library('upload', $config);  //load upload file config.
            $this->upload->initialize($config);
            $image_path = '';

            if ($this->upload->do_upload('userFile')) {
                $fileData = $this->upload->data();
                $filepath = 'assets/modules/site_images/' . $fileData['file_name'];
            } else {
                $response = array(
                    'status' => 'validation',
                    'message' => $this->upload->display_errors('<div class="alert alert-warning alert-dismissible fade in w3-margin-top"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning-</strong>', '</div>')
                );
                echo json_encode($response);
                die();
            }
        }
        $data['filepath'] = $filepath;
        $path = base_url();
        $url = $path . 'api/modules/Sitecontroller_api/uploadImageInfo';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $result = json_decode($output, true);
        if ($result == 200) {
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

// remove work item
    public function delWitem() {
        extract($_GET);
        if (isset($item_id) && $item_id != '') {
            $data['item_id'] = $item_id;

            $path = base_url();
            $url = $path . 'api/modules/sitecontroller_api/delWitem';
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
// print_r($result);die();
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
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> File not found.</div>';
        }
    }

    // remove Activity
    public function removeActivity() {
        extract($_GET);
        $path = base_url();
        $url = $path . 'api/modules/sitecontroller_api/removeActivity?act_id=' . $act_id;
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
        if ($response == true) {
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Activity deleted successfully.</div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Activity deletion failed.</div>';
        }
    }

    // get slab cycle details by cycle id
    public function getSlabCycleDetails($selected_witem) {
        // get project session
        $projSession = $this->session->userdata('project_id');
        $projArr = explode('|', base64_decode($projSession));
        $project_id = $projArr[0];
        $path = base_url();
        $url = $path . 'api/modules/sitecontroller_api/getSlabCycleDetails?project_id=' . $project_id . '&witemid=' . $selected_witem;
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

    // fucntion to display edit checklist page
    public function edit_checklist($param = '') {
        $path = base_url();
        $url = $path . 'api/modules/sitecontroller_api/getActivityDetail?activity_id=' . $param;
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
            $data['allWitems'] = Site_inspection::getAllWitems();
            $data['allActivities'] = Site_inspection::getAllActivity();
            // // print_r($data);
            $data['projects'] = Site_inspection::getAllprojects();
        } else {
            $user_name = $this->session->userdata('user_name');
            $user_id = $this->session->userdata('user_id');
            $project_id = $this->session->userdata('project_id');
            $role = $this->session->userdata('role');
            $sessionArr = explode('/', $role);
            $role_id = $sessionArr[0];
            $role_name = $sessionArr[1];
            $data['features'] = Site_inspection::getAllFeatuesForUser($user_id, $role_id);
            $data['allWitems'] = Site_inspection::getAllWitems();
            $data['allActivities'] = Site_inspection::getAllActivity();
        }

        $data['activityDetails'] = $response;
        $this->load->view('includes/header', $data);
        $this->load->view('pages/modules/edit_checklist', $data);
        $this->load->view('includes/footer');
    }

    // fucntion to display view checklist page
    public function view_checklist($param = '') {
        $path = base_url();
        $url = $path . 'api/modules/sitecontroller_api/getActivityDetail?activity_id=' . $param;
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
            $data['allWitems'] = Site_inspection::getAllWitems();
            $data['allActivities'] = Site_inspection::getAllActivity();
            // // print_r($data);
            $data['projects'] = Site_inspection::getAllprojects();
        } else {
            $user_name = $this->session->userdata('user_name');
            $user_id = $this->session->userdata('user_id');
            $project_id = $this->session->userdata('project_id');
            $role = $this->session->userdata('role');
            $sessionArr = explode('/', $role);
            $role_id = $sessionArr[0];
            $role_name = $sessionArr[1];
            $data['features'] = Site_inspection::getAllFeatuesForUser($user_id, $role_id);
            $data['allWitems'] = Site_inspection::getAllWitems();
            $data['allActivities'] = Site_inspection::getAllActivity();
        }

        $data['activityDetails'] = $response;
        //print_r($data);die();
        $this->load->view('includes/header', $data);
        $this->load->view('pages/modules/view_checklist', $data);
        $this->load->view('includes/footer');
    }

//----------------fun for remove image
    public function removeImageInfo() {
        extract($_GET);
        // print_r($_GET);die();
        if (isset($activity_id) && $activity_id != '') {
            $data['key'] = $key;
            $data['activity_id'] = $activity_id;
            $session_name = $this->session->userdata('usersession_name');
            $session_role = $this->session->userdata('role');
            if ($session_role == 'company_admin') {
                $data['author'] = 'Administrator';
            } else {
                $user_name = $this->session->userdata('user_name');
                $data['author'] = $user_name;
            }

            $path = base_url();
            $url = $path . 'api/modules/Sitecontroller_api/removeImageInfo';
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
            // print_r($output);die();
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

}
