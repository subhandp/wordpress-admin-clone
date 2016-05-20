<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tb_tags extends MX_Controller
{

	function __construct() {
		parent::__construct();
	}

	function _get() {
		$this->load->model('tb_tags_model');
		$query = $this->tb_tags_model->_get();
		return $query;
	}

	function _insert($data) {
		$this->load->model('tb_tags_model');
		$id=$this->tb_tags_model->_insert($data);
		return $id;
	}
}

