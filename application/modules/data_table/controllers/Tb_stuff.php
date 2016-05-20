<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tb_stuff extends MX_Controller
{

	function __construct() {
		parent::__construct();
	}


	function get($order_by,$sorting) {
		$this->load->model('tb_stuff_model');
		$query = $this->tb_stuff_model->get($order_by,$sorting);
		return $query;
	}

	function get_all_count(){
		$this->load->model('tb_stuff_model');
		$query = $this->tb_stuff_model->get_all_count();
		return $query;
	}


}

