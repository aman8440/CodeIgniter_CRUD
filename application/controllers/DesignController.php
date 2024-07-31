<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DesignController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('pagination');
    $this->load->library('session');
    $this->load->library('email');
  }
  public function index()
  {
    if ($this->session->userdata('user_id')) {
      redirect('dashboard');
    } else {
      redirect('login');
    }
  }
  public function login()
  {
    if ($this->session->userdata('user_id')) {
      redirect('dashboard');
    }
    if ($this->form_validation->run('login') == true) {
      $postdata = $this->input->post();
      $check = $this->designModel->login($postdata);

      if ($check) {
        if ($check->is_admin == 'yes') {
          $this->session->set_userdata('user_id', $check->id);
          $this->session->set_userdata('username', $check->username);
          $this->session->set_flashdata('successMsg', 'Login Successfully');
          redirect('dashboard');
        } else {
          $this->session->set_flashdata('errorMsg', 'You are not authorized to access this area');
          redirect('login');
        }
      } else {
        $this->session->set_flashdata('errorMsg', 'Invalid username or password');
        redirect('login');
      }
    } else {
      $this->load->view('login');
    }
  }
  public function logout()
  {
    $this->session->sess_destroy();
    redirect('login');
  }

  public function dashboard()
  {
    if (!$this->session->userdata('user_id')) {
      redirect('login');
    } else {
      $user_id = $this->session->userdata('user_id');
      if ($user_id) {
        $data['user'] = $this->designModel->get_username_by_session($user_id);

        if (empty($data['user'])) {
          show_404();
        }

        $this->load->view('dashboard', $data);
      } else {
        redirect('login');
      }
    }
  }
  public function add_data()
  {
    if (!$this->session->userdata('user_id')) {
      redirect('login');
    } else {
      $user_id = $this->session->userdata('user_id');
      $data['user'] = $this->designModel->get_username_by_session($user_id);

      if ($this->form_validation->run('adding') == true) {
        if (empty($data['user'])) {
          show_404();
        }

        $postdata = $this->input->post();
        $check = $this->designModel->insert_data($postdata);

        if ($check) {
          $this->session->set_flashdata('successMsg', 'Data Inserted Successfully');
          redirect('list');
        } else {
          $this->session->set_flashdata('errorMsg', 'Please fill all fields correctly');
          redirect('add');
        }
      } else {
        $this->load->view('edit-user', $data);
      }
    }
  }

  public function update_data()
  {
    if (!$this->session->userdata('user_id')) {
      redirect('login');
    } else {
      $user_id = $this->session->userdata('user_id');
      $data['user'] = $this->designModel->get_username_by_session($user_id);

      if ($this->form_validation->run('updating') == true) {
        if (empty($data['user'])) {
          show_404();
        }
        $postdata = $this->input->post();

        $check = $this->designModel->updateData($postdata);
        if ($check) {
          $this->session->set_flashdata('successMsg', 'Data Updated Successfully');
          redirect('list');
        } else {
          $this->session->set_flashdata('errorMsg', 'Please fill all fields correctly');
          redirect('edit/' . $postdata['id']);
        }
      } else {
        $id = $this->input->post('id');
        $data['arr'] = $this->designModel->all_data($id);
        $this->load->view('edit-user', $data);
      }
    }
  }
  public function all_data($id = '')
  {
    if (!$this->session->userdata('user_id')) {
      redirect('login');
    } else {
      $user_id = $this->session->userdata('user_id');
      $data['user'] = $this->designModel->get_username_by_session($user_id);

      if ($id != '') {
        $data['arr'] = $this->designModel->all_data($id);
        $this->load->view('edit-user', $data);
      } else {
        $config = array();
        $config['base_url'] = base_url('list');
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['page_query_string'] = TRUE;
        $config['reuse_query_string'] = TRUE;
        $config['full_tag_open'] = '<div class="paginaton-div"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a href="#" class="active">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $search = $this->input->get('search', TRUE);
        $search = $this->security->xss_clean($search);
        $search = $this->db->escape_str($search);
        $sea = trim($search);
        $sort_by = $this->input->get('sort_by', TRUE) ?: 'username';
        $sort_by = $this->security->xss_clean($sort_by);
        $sort_by = $this->db->escape_str($sort_by);
        $sort_by = trim($sort_by);
        $sort_order = $this->input->get('sort_order') ? $this->input->get('sort_order') : 'asc';

        $config['total_rows'] = $this->designModel->count_users($sea);
        $this->pagination->initialize($config);

        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

        $data['users'] = $this->designModel->fetch_users($config['per_page'], $page, $sea, $sort_by, $sort_order);
        $data['offset'] = $page;
        $data['sort_by'] = $sort_by;
        $data['sort_order'] = $sort_order;
        $data['links'] = $this->pagination->create_links();

        $this->load->view('list-users', $data);
      }
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
    $email_exists = $this->designModel->check_unique_email($email);

    if (!$email_exists) {
      echo '<span class="error";">Email already exists</span>';
    } else {
      echo '';
    }
  }
  public function check_semail()
  {
    $email = $this->input->post('semail');
    $email_exists = $this->designModel->check_unique_semail($email);

    if (!$email_exists) {
      echo '<span class="error";">Security Email already exists</span>';
    } else {
      echo '';
    }
  }
  public function check_username()
  {
    $username = $this->input->post('username');
    $user_exists = $this->designModel->check_unique_username($username);

    if (!$user_exists) {
      echo '<span class="error";">Username already exists</span>';
    } else {
      echo '';
    }
  }

  public function check_phone()
  {
    $phone = $this->input->post('phone');
    $phone_exists = $this->designModel->check_unique_phone($phone);

    if (!$phone_exists) {
      echo '<span class="error">Phone number already exists</span>';
    } else {
      echo '';
    }
  }

  public function delete_data($id)
  {
    if (!$this->session->userdata('user_id')) {
      redirect('login');
    } else {
      $check = $this->designModel->deleteData($id);
      if ($check) {
        $this->session->set_flashdata('successMsg', 'Data Deleted Successfully');
        redirect('list');
      } else {
        $this->session->set_flashdata('errorMsg', 'Data does not deleted');
        redirect('list');
      }
    }
  }
  public function send_email()
  {
    if (!$this->session->userdata('user_id')) {
      redirect('login');
    } else {
      $this->load->view('change-password');
    }
  }
  public function mail_verification()
  {
    if (!$this->session->userdata('user_id')) {
      redirect('login');
    } else {
      if ($this->form_validation->run('email') == true) {
        $email = $this->input->post('email');
        $token = bin2hex(random_bytes(50));
        $expiry_time = time() + 300;
        $this->designModel->save_token($email, $token, $expiry_time);
        $this->email->from('no-reply@example.com', 'Service');
        $this->email->to($email);
        $this->email->subject('Password Reset');
        $message = 'Click the following link to reset your password: ';
        $message .= base_url('designController/reset_password/' . $token);
        $message .= ' This link will expire in 1 hour.';
        $this->email->message($message);

        if ($this->email->send()) {
          $data['forgot_pass_mail'] = true;
        } else {
          $data['forgot_pass_mail'] = false;
        }

        $this->load->view('change-password', $data);
      } else {
        $this->load->view('change-password');
      }
    }
  }
  public function check_email_exists($email)
  {
    if ($this->designModel->email_exists($email)) {
      return TRUE;
    } else {
      $this->form_validation->set_message('check_email_exists', 'The email is not registered.');
      return FALSE;
    }
  }
  public function reset_password($token)
  {
    $query = $this->db->get_where('password_resets', array('token' => $token));
    $reset_data = $query->row();

    if ($reset_data && $reset_data->expiry_time > time()) {
      $data['token'] = $token;
      $this->load->view('reset-password', $data);
    } else {
      $this->session->set_flashdata('errorMsg', 'The password reset link is invalid or has expired.');
      $this->load->view('change-password');
    }
  }

  public function update_password()
  {
    $token = $this->input->post('token');
    $password = $this->input->post('password');

    $query = $this->db->get_where('password_resets', array('token' => $token));
    $reset_data = $query->row();

    if ($reset_data && $reset_data->expiry_time > time()) {
      $this->db->where('email', $reset_data->email);
      $this->db->update('data_record', array('password' => password_hash($password, PASSWORD_BCRYPT)));

      $user_query = $this->db->get_where('data_record', array('email' => $reset_data->email));
      $user_data = $user_query->row();
      $this->db->delete('password_resets', array('token' => $token));

      if ($user_data->is_admin == 'yes') {
        $this->session->set_flashdata('successMsg', 'Your password has been updated successfully. Please log in again.');
        $this->session->unset_userdata('user_id');
        $this->session->sess_destroy();
        redirect('login');
      } else {
        $this->session->set_flashdata('successMsg', 'Your password has been updated successfully.');
        redirect('dashboard');
      }
    } else {
      $this->session->set_flashdata('errorMsg', 'The password reset link is invalid or has expired.');
      $this->load->view('change-password');
    }
  }
  public function profile($id = '')
  {
    if (!$this->session->userdata('user_id')) {
      redirect('login');
    } else {
      $user_id = $this->session->userdata('user_id');
      $data['user'] = $this->designModel->get_username_by_session($user_id);
      $data['arr'] = $this->designModel->all_data($id);
      $data['imag'] = $this->designModel->get_image_name($data['arr']->email);
      // print_r($data);
      $this->load->view('user-profile', $data);
    }
  }
  public function profile_data()
  {
    if (!$this->session->userdata('user_id')) {
      redirect('login');
    } else {
      $user_id = $this->session->userdata('user_id');
      $data['user'] = $this->designModel->get_username_by_session($user_id);

      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'jpg|png|jpeg';
      $config['max_size'] = 500;

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('file')) {
        $error = $this->upload->display_errors();
        log_message('error', 'File upload error: ' . $error);

        $id = $this->input->post('id');
        $data['arr'] = $this->designModel->all_data($id);

        $response = array('status' => 'error', 'error' => $error);
        $this->session->set_flashdata('errorMsg', $error);
        $this->load->view('user-profile', $data);
      } else {
        $id = $this->input->post('id');
        $upload_data = $this->upload->data();
        $image_name = $upload_data['file_name'];
        $email = $this->designModel->get_email_by_id($id);

        if (!$email) {
          $response = array('status' => 'error', 'error' => 'User email not found.');
          echo json_encode($response);
          return;
        }

        $check = $this->designModel->prf_data($email, $image_name);

        if ($check) {
          $this->session->set_flashdata('successMsg', 'Image Uploaded Successfully');
          $data['imag'] = $this->designModel->get_image_name($email);
          $data['arr'] = $this->designModel->all_data($id);
          $this->load->view('user-profile', $data);
        } else {
          $response = array('status' => 'error', 'message' => 'Your image was not uploaded. Please try again.');
          $this->session->set_flashdata('errorMsg', 'Your image was not uploaded. Please try again.');
          $data['arr'] = $this->designModel->all_data($id);
          $this->load->view('user-profile', $data);
        }
        print_r(json_encode($data));
      }
    }
  }
  public function delete_image()
  {
    if (!$this->session->userdata('user_id')) {
      redirect('login');
    } else {
      $id = $this->input->post('id');
      $id = strval($id);
      $email = $this->designModel->get_email_by_id($id);

      if (!$email) {
        $response = array('status' => 'error', 'message' => 'User email not found.');
        echo json_encode($response);
        return;
      }

      $delete = $this->designModel->delete_image($email);

      if ($delete) {
        $this->session->set_flashdata('successMsg', 'Image deleted successfully.');
        $response = array('status' => 'success', 'message' => 'Image deleted successfully.');
      } else {
        $response = array('status' => 'error', 'message' => 'Image deletion failed. Please try again.');
        $this->session->set_flashdata('errorMsg', 'Image deletion failed. Please try again.');
      }

      echo json_encode($response);
    }
  }
};
