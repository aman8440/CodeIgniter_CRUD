<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CrudModel extends CI_Model
{
  public function insert_data($postdata)
  {
    $hash_pass = password_hash($postdata['password'], PASSWORD_DEFAULT);
    $post['name'] = $postdata['name'];
    $post['email'] = $postdata['email'];
    $post['phone'] = $postdata['phone'];
    $post['gender'] = $postdata['gender'];
    $post['image'] = $postdata['file'];
    $post['pass'] = $hash_pass;

    $q = $this->db->insert('tm_crud', $post);
    if ($q) {
      return true;
    } else {
      log_message('error', 'Database update error: ' . $this->db->last_query());
      return false;
    }
  }
  public function update_data($postdata)
  {
    if (!isset($postdata['id'])) {
      return false;
    }
    $image = isset($postdata['file']) && !empty($postdata['file']) ? $postdata['file'] : $postdata['file_old'];
    $post = [
      'name' => $postdata['name'],
      'email' => $postdata['email'],
      'phone' => $postdata['phone'],
      'gender' => $postdata['gender'],
      'image' => $image,
      'status' => $postdata['status']
    ];
    $this->db->where('id', $postdata['id']);
    $q = $this->db->update('tm_crud', $post);

    if ($q) {
      return true;
    } else {
      log_message('error', 'Database update error: ' . $this->db->last_query());
      return false;
    }
  }
  public function check_unique_email($email)
  {
    $query = $this->db->query("SELECT * from tm_crud WHERE email='$email'");
    $email = $query->result();

    if (count($email) > 0) {
      return false;
    } else {
      return true;
    }
  }

  public function check_unique_phone($phone)
  {
    $query = $this->db->query("SELECT * from tm_crud WHERE phone='$phone'");
    $phone = $query->result();

    if (count($phone) > 0) {
      return false;
    } else {
      return true;
    }
  }
  public function all_data($id = '')
  {
    if ($id != '') {
      $q = $this->db->where('id', $id)->get('tm_crud');
      if ($q->num_rows()) {
        return $q->row();
      } else {
        return false;
      }
    } else {
      $q = $this->db->order_by('id', 'asc')->get('tm_crud');
      if ($q->num_rows()) {
        return $q->result();
      } else {
        return false;
      }
    }
  }

  public function delete_data($id)
  {
    $q = $this->db->where('id', $id)->delete('tm_crud');
    if ($q) {
      return true;
    } else {
      log_message('error', 'Database update error: ' . $this->db->last_query());
      return false;
    }
  }

  public function get_count($search = '')
  {
    if ($search) {
      $this->db->like('id', $search);
      $this->db->or_like('name', $search);
      $this->db->or_like('email', $search);
      $this->db->or_like('phone', $search);
      $this->db->or_like('gender', $search);
      $this->db->or_like('status', $search);
    }
    return $this->db->count_all_results('tm_crud');
  }

  public function get_users($search = '', $sort_by = 'id', $order = 'desc', $limit = 5, $offset = 0)
  {
    if ($search) {
      $query = $this->db->like('id', $search)->or_like('name', $search)->or_like('email', $search)->or_like('phone', $search)->or_like('gender', $search)->or_like('status', $search)->order_by($sort_by, $order)->limit($limit, $offset)->get('tm_crud');
      return $query->result();
    }
    else{
      $query = $this->db->order_by($sort_by, $order)->limit($limit, $offset)->get('tm_crud');
      return $query->result();
    }
  }
}
;