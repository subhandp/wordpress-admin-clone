<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tb_kategori extends MX_Controller
{

	function __construct() {
		parent::__construct();
	}

	function _get() {
		$this->load->model('tb_kategori_model');
		$query = $this->tb_kategori_model->_get();
		return $query;
	}
	
	function get_post_kategori($id_post){
		$this->load->model('tb_kategori_model');
		$query = $this->tb_kategori_model->get_post_kategori($id_post);
		return $query;
	}	

	function _insert($data) {
		$this->load->model('tb_kategori_model');
		$id=$this->tb_kategori_model->_insert($data);
		return $id;
	}

	function get_where($arr) {
		$this->load->model('tb_kategori_model');
		$query = $this->tb_kategori_model->get_where($arr);
		return $query;
	}
	
}

