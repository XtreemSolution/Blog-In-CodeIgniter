<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blogs extends CI_Controller
{
	function __construct() {
		Parent::__construct();	
		$this->load->model('front/blogs_model', 'blogs');
	
	}
    function index()
    {
        $output['page_title'] = 'Blogs';
        $output['left_menu'] = 'Blogs';
        $output['title'] = 'Blog - Xtreem Solution';
        $blogsRecords = $this->blogs->getAllRecords(); 
        $output['blogsRecords'] =  $blogsRecords;
       	$this->load->view('front/includes/header', $output);
        $this->load->view('front/blogs/blog_list');
        $this->load->view('front/includes/footer');
    }

    function add() { 

        $output['page_title']   = 'Blogs module';
        $output['title'] = 'Blog - Xtreem Solution';
        $output['id']           = '';
        $output['title']         = '';
        $output['content']      = '';
        $output['image']      = '';
        $output['success']      = "";
       
        if (isset($_POST) && !empty($_POST)) {

            $success = true;
            $this->form_validation->set_rules('title', 'Title ', 'trim|required');
            $this->form_validation->set_rules('content', 'Content', 'trim|required');

            if (empty($_FILES['image_name']['name'])) {
                $this->form_validation->set_rules('image_name', 'Image', 'required');
            }
            if ($this->form_validation->run()) {

                if (isset($_FILES['image_name']['name'])) {
                        $directory = './assets/uploads/blogs';
                        @mkdir($directory, 0777);
                        @chmod($directory, 0777);
                        $config['upload_path']   = $directory;
                        $config['allowed_types'] = 'gif|jpeg|jpg|png';
                        $config['encrypt_name']  = true;
                        $this->load->library('upload', $config);
                        $response=$this->upload->initialize($config);
                      
                        if ($this->upload->do_upload('image_name')) {
                            $uploadData = $this->upload->data();
                            $file_name = $uploadData['file_name'];
                            $file_title = $_FILES['image_name']['name'];
                            $inputData = array();
                            $input['image_name'] = $file_name;
                        }else{
                        	$error = array('error' => $this->upload->display_errors());
                        
                        }
                        
                    }
                     
                    $input['add_date'] = date('Y-m-d H:i:s');
                    $input['content'] = $this->input->post('content');
                    $input['title']  = $this->input->post('title');
                    $user_id = $this->blogs->addNewRecord($input);
                    $message = 'Record inserted successfully';
                    $success = true;
                    $output['redirectURL']  = site_url('blogs');
                    } else {
                        $success = false;
                        $message = validation_errors();
                    }

                    $output['message'] = $message;
                    $output['success'] = $success;
                    echo json_encode($output);die;
        }

        $this->load->view('front/includes/header', $output);
        $this->load->view('front/blogs/blog_form');
        $this->load->view('front/includes/footer');
    }

    function delete()
    {
        $id = $this->input->post('record_id');
        $record = $this->blogs->getSingleRecordById($id);
        unlink("assets/uploads/blogs/".$record->image_name);
        $this->blogs->deleteRecordById($id);
        $data['success'] = true;
        $data['message'] = 'Record deleted successfully';
        $data['callBackFunction'] = 'callBackCommonDelete';
        echo json_encode($data);die;
    }

    function update($updateUserId)
    {

        $output['page_title']   = 'Blogs module';
        $output['title'] = 'Blog - Xtreem Solution';
        $record = $this->blogs->getSingleRecordById($updateUserId);
        $this->common_model->checkRequestedDataExists($record);
        $output['success'] = "";
        $output['id'] = $record->id;
        $output['title'] = $record->title;;
        $output['content'] = $record->content;;
        $output['image'] = $record->image_name;;
  
        if (isset($_POST) && !empty($_POST)) {

            $success = true;
             $this->form_validation->set_rules('title', 'Title ', 'trim|required');
            $this->form_validation->set_rules('content', 'Content', 'trim|required');
            if ($this->form_validation->run()) {
                $input = array();
                if (isset($_FILES['image_name']['name'])) {
                    
                    $directory = './assets/uploads/blogs';
                    unlink("assets/uploads/blogs/".$record->image_name);
                    @mkdir($directory, 0777);
                    @chmod($directory, 0777);
                    $config['upload_path']   = $directory;
                    $config['allowed_types'] = 'gif|jpeg|jpg|png';
                    $config['encrypt_name']  = true;
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('image_name')) {
                     
                        $uploadData = $this->upload->data();
                        $file_name = $uploadData['file_name'];
                        $file_title = $_FILES['image_name']['name'];
                        $inputData = array();
                        $input['image_name'] = $file_name;
                    }
                }
                        $input['add_date'] = date('Y-m-d H:i:s');
                        $input['content'] = $this->input->post('content');
                        $input['title']  = $this->input->post('title');
                        $this->blogs->updateRecordById($updateUserId, $input);
                        $message = 'Record update successfully';
                        $success = true;
                        $output['redirectURL'] = site_url();
                } else {
                $success = false;
                $message = validation_errors();
            }

            $output['message'] = $message;
            $output['success'] = $success;
            echo json_encode($output);die;
        }

        $this->load->view('front/includes/header', $output);
        $this->load->view('front/blogs/blog_form');
        $this->load->view('front/includes/footer');
    }

    function view($id)
    {
        $output['page_title']   = 'Blogs module';
        $output['title'] = 'Blog - Xtreem Solution';
        $record = $this->blogs->getSingleRecordById($id);
        $this->common_model->checkRequestedDataExists($record);
        $output['blogRecords'] = $record;
        $this->load->view('front/includes/header', $output);
        $this->load->view('front/blogs/view_blogs');
        $this->load->view('front/includes/footer');
    }
}
