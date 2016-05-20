<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tb_post_kategori extends MX_Controller
{

	function __construct() {
		parent::__construct();
	}

	function get_where($arr) {
		$this->load->model('tb_post_kategori_model');
		$query = $this->tb_post_kategori_model->get_where($arr);
		return $query;
	}

	function _update($id, $data) {
		$this->load->model('tb_post_kategori_model');
		$this->tb_post_kategori_model->_update($id, $data);
	}

}

