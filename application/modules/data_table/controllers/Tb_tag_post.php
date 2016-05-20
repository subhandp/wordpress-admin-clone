<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tb_tag_post extends MX_Controller
{

	function __construct() {
		parent::__construct();
	}

	function _insert($data) {
		$this->load->model('tb_tag_post_model');
		$this->tb_tag_post_model->_insert($data);
	}
	
	function _delete($id) {
		$this->load->model('tb_tag_post_model');
		$this->tb_tag_post_model->_delete($id);
	}
}

