<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeController extends CI_Controller
{
  public function index()
  {
    // $data= $this->homeModel->queries();

    // echo "User Id: $data->role_id <br>";
    // echo "User Name: $data->role_name <br>";
    // echo "User Phone: $data->role_phone <br>";
    // // echo "User Id:" . $data['role_id'] . "<br>";
    // // echo "User Name:" . $data['role_name'] . "<br>";
    // // echo "User Phone:" . $data['role_phone'] . "<br>";
    // // foreach ($data as $value) {
    // //   // echo "User Id:" . $value['role_id'] . "<br>";
    // //   // echo "User Name:" . $value['role_name'] . "<br>";
    // //   // echo "User Phone:" . $value['role_phone'] . "<br>";
    // //   echo "User Id: $value->role_id <br>";
    // //   echo "User Name: $value->role_name <br>";
    // //   echo "User Phone: $value->role_phone <br>";
    // // }

    // $this->load->library('email');
    // $this->load->helper('form');
    // $this->load->helper('test');
    // clean($data);
    // echo form_input('username', 'Sam Curran');
    // echo form_textarea('username', 'Sam Curran');
    // echo form_dropdown('username', 'Sam Curran');

    // $array= array('Name' => 'Tim David', 'Work' => 'Gaming');
    // $array1= array('Name' => 'David Warner', 'Work' => 'Cricket');

    // $this->load->library('custom');
    // $this->custom->sum();

    // clean($array);
    // $this->form_validation->set_rules('name','Name', 'required',['required'=>'%s cannot be blank.']);
    // $this->form_validation->set_rules('phone', 'Contact Number', 'required|numeric|trim|min_length[10]|max_length[10]');
    // $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    // $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|trim|matches[passconf]');
    // $this->form_validation->set_rules('passconf', 'Confirm Password', 'required|min_length[8]|trim');
  }
}
;