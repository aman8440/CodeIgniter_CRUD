<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeModel extends CI_Model{
  public function queries(){
    // $q= $this->db->query('SELECT * FROM tm_role');
    // return $this->db->select('count(role_id)')->where('role_id',2)->get('tm_role')->row();
    // return $q->result();
    // return $q->result_array();
    // return $this->db->get('tm_role')->num_rows();
    return $this->db->get('tm_role')->row();
  }
  public function add_data($postdata){
    $hash_pass= password_hash($postdata['password'],PASSWORD_DEFAULT);

    $post['role_name']= $postdata['name'];
    $post['role_email']= $postdata['email'];
    $post['role_phone']= $postdata['phone'];
    $post['role_image']= $postdata['file'];
    $post['role_pass']= $hash_pass;
    

    $this->db->insert('tm_role',$post);
  }
};