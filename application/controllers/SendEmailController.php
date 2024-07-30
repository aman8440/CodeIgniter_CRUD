<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class SendEmailController extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->library('email');
    $this->load->helper('form');
  }
  public function index(){
      $this->load->helper('form');
      $this->load->view('send-Email');
  }
  public function send_email(){
    $this->load->config('email');
    $form_email= $this->config->item('smtp_user');
    $to_email = $this->input->post('email');
    $subject= $this->input->post('subject');
    $message= $this->input->post('message');

    $this->email->from($form_email);
    $this->email->to($to_email);
    $this->email->subject($subject);
    $this->email->message($message);
    if($this->email->send())
      $this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
    else
      $this->session->set_flashdata("email_sent","You have encountered an error");
    $this->load->view('send-Email');
  }
};