<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tb_uploads extends MX_Controller
{

	function __construct() {
		parent::__construct();
	}


	function _get($order) {
		$this->load->model('tb_uploads_model');
		$query = $this->tb_uploads_model->_get($order);
		return $query;
	}

	function get_where($arr) {
		$this->load->model('tb_uploads_model');
		$query = $this->tb_uploads_model->get_where($arr);
		return $query;
	}

	function _insert($data) {
		$this->load->model('tb_uploads_model');
		$id=$this->tb_uploads_model->_insert($data);
		return $id;
	}
	
	function get_all_count(){
		$this->load->model('tb_uploads_model');
		$query = $this->tb_uploads_model->get_all_count();
		return $query;
	}

}

