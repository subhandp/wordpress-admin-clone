<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

function pagination_modifikasi($base_url,$total_rows,$limit,$uri_segment){
	$ci=& get_instance();
	$ci->load->library('pagination');
	$config['base_url']=site_url($base_url);
	$config['total_rows'] =$total_rows;
	$config['per_page'] = $limit;
	$config['uri_segment'] = $uri_segment;
	$config['full_tag_open'] = "<ul class='pagination pull-right'>";
	$config['full_tag_close'] ="</ul>";
	$config['num_tag_open'] = '<li>';
	$config['num_tag_close'] = '</li>';
	$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
	$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
	$config['next_tag_open'] = "<li>";
	$config['next_tagl_close'] = "</li>";
	$config['prev_tag_open'] = "<li>";
	$config['prev_tagl_close'] = "</li>";
	$config['first_tag_open'] = "<li>";
	$config['first_tagl_close'] = "</li>";
	$config['last_tag_open'] = "<li>";
	$config['last_tagl_close'] = "</li>";
	$ci->pagination->initialize($config);
	$data= $ci->pagination->create_links();
	return $data;
 }

 ?>
