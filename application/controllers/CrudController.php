<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CrudController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('crudModel');
    $this->load->library('pagination');
    $this->load->library('session');
  }
  public function index()
  {
    $this->load->view('insert');
  }
  public function add_data()
  {
    if ($this->form_validation->run('signup') == true) {
      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'pdf|gif|jpg|png';
      $config['max_size'] = 600;
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('file')) {
        $error['err'] = array('error' => $this->upload->display_errors());
        $this->load->view('insert', $error);
      } else {
        $data = $this->upload->data();
        $postdata = $this->input->post();
        $postdata['file'] = $data['file_name'];
        $check = $this->crudModel->insert_data($postdata);
        if ($check) {
          $this->session->set_flashdata('successMsg', 'Data Inserted Successfully');
          redirect('crudController/all_data');
        } else {

        }
      }
    } else {
      $this->load->view('insert');
    }
  }
  
  public function update_data(){
    if ($this->form_validation->run('update') == true) {
      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'pdf|gif|jpg|png';
      $config['max_size'] = 600;
      $this->load->library('upload',$config);
      $this->upload->do_upload('file');
      $data= $this->upload->data();
      $postdata = $this->input->post();
      $postdata['file'] = $data['file_name'];
      if(empty($postdata['file'])){
        $postdata['file']= $postdata['file_old'];
      }else{
        $postdata['file'] = $data['file_name'];
      }

      $check = $this->crudModel->update_data($postdata);
      if ($check) {
        $this->session->set_flashdata('updateMsg', 'Data Updated Successfully');
        redirect('crudController/all_data');
      }
    } else {
      $id= $this->input->post('id');
      $data['arr'] = $this->crudModel->all_data($id);
      $this->load->view('insert',$data);
    }
  }
  public function all_data($id='')
  {
    if($id != ''){
      $data['arr'] = $this->crudModel->all_data($id);
      $this->load->view('insert', $data);
    }
    else{
      $search = isset($_GET['search']) ? $_GET['search'] : '';
      $sea= trim($search);
      $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'id';
      $order = isset($_GET['order']) ? $_GET['order'] : 'desc';
      $limit = isset($_GET['limit']) ? $_GET['limit'] : 5;
      $offset = isset($_GET['per_page']) ? $_GET['per_page'] : 0;
      
      $config['base_url'] = 'http://localhost/ci/crudController/all-data';
      $config['total_rows'] = $this->crudModel->get_count($sea);
      $config['per_page'] = $limit;
      $config['uri_segment'] = 3;
      $config['page_query_string'] = TRUE;
      $config['reuse_query_string'] = TRUE;
      $this->pagination->initialize($config);
      $data['arr'] = $this->crudModel->get_users($sea, $sort_by, $order, $limit, $offset);
      $data['pagination'] = $this->pagination->create_links();
      $data['limit'] = $limit;
      $data['offset']= $offset;
      $data['total_records'] = $config['total_rows'];
      $data['sort_by'] = $sort_by;
      $data['order'] = $order;

      $this->load->view('all-data',$data);
    }
  }
  public function is_password_strong($password)
  {
    if (preg_match('#[0-9]#', $password) && preg_match('#[a-zA-Z]#', $password)) {
      return TRUE;
    }
    $this->form_validation->set_message('is_password_strong', 'The {field} field must contain at least one number and one letter.');
    return FALSE;
  }
  public function file_check()
  {
    if (empty($_FILES['file']['name'])) {
      $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
      return false;
    }
    return true;
  }
  public function check_email()
  {
    $email = $this->input->post('email');
    $email_exists = $this->crudModel->check_unique_email($email);

    if (!$email_exists) {
      echo '<span class="error";">Email already exists</span>';
    } else {
      echo '';
    }
  }

  public function check_phone()
  {
    $phone = $this->input->post('phone');
    $phone_exists = $this->crudModel->check_unique_phone($phone);

    if (!$phone_exists) {
      echo '<span class="error">Phone number already exists</span>';
    } else {
      echo ''; 
    }
  }

  public function delete_data($id){
    $check= $this->crudModel->delete_data($id);
    if ($check) {
      $this->session->set_flashdata('deleteMsg', 'Data Deleted Successfully');
      redirect('crudController/all_data');
    }
  }
};