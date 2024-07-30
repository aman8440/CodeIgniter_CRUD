<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Pagination extends CI_Pagination {

  public function create_links() {
    $this->cur_page = isset($this->cur_page) ? (string) $this->cur_page : '1';
    if ($this->total_rows === 0 || $this->per_page === 0) {
      return '';
    }
    $num_pages = (int) ceil($this->total_rows / $this->per_page);

    if ($num_pages === 1) {
      return '';
    }
    $CI =& get_instance();

    if ($CI->config->item('enable_query_strings') === TRUE || $this->page_query_string === TRUE) {
      if ($CI->input->get($this->query_string_segment) !== NULL) {
        $this->cur_page = (string) $CI->input->get($this->query_string_segment);
      }
    } else {
      if ($CI->uri->segment($this->uri_segment) !== NULL) {
        $this->cur_page = (string) $CI->uri->segment($this->uri_segment);
      }
    }

    if (!ctype_digit($this->cur_page)) {
      $this->cur_page = '1';
    }
    if ((int)$this->cur_page > $num_pages) {
      $this->cur_page = (string) $num_pages;
    }
    if ((int)$this->cur_page < 1) {
      $this->cur_page = '1';
    }

    $uri_page_number = $this->cur_page;
    $this->cur_page = (int) $this->cur_page;
    $start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
    $end = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;

    $output = '';

    if ($this->first_link !== FALSE && $this->cur_page > ($this->num_links + 1)) {
      $output .= $this->first_tag_open.'<a href="'.$this->_create_link(1).'">'.$this->first_link.'</a>'.$this->first_tag_close;
    }
    if ($this->prev_link !== FALSE && $this->cur_page !== 1) {
      $i = $uri_page_number - 1;

      if ($i === 0 && $this->first_url !== '') {
        $output .= $this->prev_tag_open.'<a href="'.$this->first_url.'">'.$this->prev_link.'</a>'.$this->prev_tag_close;
      } else {
        $output .= $this->prev_tag_open.'<a href="'.$this->_create_link($i).'">'.$this->prev_link.'</a>'.$this->prev_tag_close;
      }
    }
    if ($this->display_pages !== FALSE) {
      for ($loop = $start - 1; $loop <= $end; $loop++) {
        $i = $loop + 1;

        if ($this->cur_page === $i) {
          $output .= $this->cur_tag_open.$i.$this->cur_tag_close;
        } else {
          $output .= $this->num_tag_open.'<a href="'.$this->_create_link($i).'">'.$i.'</a>'.$this->num_tag_close;
        }
      }
    }
    if ($this->next_link !== FALSE && $this->cur_page < $num_pages) {
      $output .= $this->next_tag_open.'<a href="'.$this->_create_link($this->cur_page + 1).'">'.$this->next_link.'</a>'.$this->next_tag_close;
    }
    if ($this->last_link !== FALSE && ($this->cur_page + $this->num_links) < $num_pages) {
      $output .= $this->last_tag_open.'<a href="'.$this->_create_link($num_pages).'">'.$this->last_link.'</a>'.$this->last_tag_close;
    }
    $output = preg_replace('#([^:])//+#', '\\1/', $output);
    return $this->full_tag_open.$output.$this->full_tag_close;
  }

  private function _create_link($page) {
    if ($this->page_query_string === TRUE) {
      return $this->base_url.'&amp;'.$this->query_string_segment.'='.$page;
    }

    return rtrim($this->base_url, '/') .'/'. $page;
  }
}
