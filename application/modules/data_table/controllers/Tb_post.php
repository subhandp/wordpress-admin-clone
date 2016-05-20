<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tb_post extends MX_Controller
{

	function __construct() {
		parent::__construct();
	}
	
	function get_all_count(){
		$this->load->model('tb_post_model');
		$query = $this->tb_post_model->get_all_count();
		return $query;
	}
	
	function get_where($arr) {
		$this->load->model('tb_post_model');
		$query = $this->tb_post_model->get_where($arr);
		return $query;
	}

	function get_where_order($arr,$order_by,$sorting) {
		$this->load->model('tb_post_model');
		$query = $this->tb_post_model->get_where_order($arr,$order_by,$sorting);
		return $query;
	}

	function get_where_num($arr) {
		$this->load->model('tb_post_model');
		$query = $this->tb_post_model->get_where_num($arr);
		return $query;
	}

	function _insert($data) {
		$this->load->model('tb_post_model');
		$id=$this->tb_post_model->_insert($data);
		return $id;
	}

	function get_paged_list($limit,$offset,$order_colomn,$order_type) {
		$this->load->model('tb_post_model');
		$query = $this->tb_post_model->get_paged_list($limit,$offset,$order_colomn,$order_type);
		return $query;
	}

	function get_tags($data){
		$this->load->model('tb_post_model');
		$query = $this->tb_post_model->get_tags($data);
		return $query;
	}

	function get_tags_num($data){
		$this->load->model('tb_post_model');
		$query = $this->tb_post_model->get_tags_num($data);
		return $query;
	}

	function _update($id, $data) {
		$this->load->model('tb_post_model');
		$this->tb_post_model->_update($id, $data);
	}

	function _update_batch($where,$data){
		$this->load->model('tb_post_model');
		$this->tb_post_model->_update_batch($where,$data);
	}
	
	function get_kategori($data){
		$this->load->model('tb_post_model');
		$query = $this->tb_post_model->get_kategori($data);
		return $query;
	}

}

