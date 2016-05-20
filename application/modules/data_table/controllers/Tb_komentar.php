<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tb_komentar extends MX_Controller
{

	function __construct() {
		parent::__construct();
	}

	function get_all_count(){
		$this->load->model('tb_komentar_model');
		$query = $this->tb_komentar_model->get_all_count();
		return $query;
	}

	function get_order($order,$sorting) {
		$this->load->model('tb_komentar_model');
		$query = $this->tb_komentar_model->get_order($order,$sorting);
		return $query;
	}

	function get_where($arr) {
		$this->load->model('tb_komentar_model');
		$query = $this->tb_komentar_model->get_where($arr);
		return $query;
	}

	function get_where_order($arr,$order,$sorting) {
		$this->load->model('tb_komentar_model');
		$query = $this->tb_komentar_model->get_where_order($arr,$order,$sorting) ;
		return $query;
	}

	function get_where_num($arr) {
		$this->load->model('tb_komentar_model');
		$query = $this->tb_komentar_model->get_where_num($arr);
		return $query;
	}

	function _update($id, $data) {
		$this->load->model('tb_komentar_model');
		$this->tb_komentar_model->_update($id, $data);
	}

	function _custom_query($mysql_query) {
		$this->load->model('tb_komentar_model');
		$query = $this->tb_komentar_model->_custom_query($mysql_query);
		return $query;
	}

	function _custom_query_num($mysql_query) {
		$this->load->model('tb_komentar_model');
		$query = $this->tb_komentar_model->_custom_query_num($mysql_query);
		return $query;
	}

	function join_komentar_pending_num(){
		$this->load->model('tb_komentar_model');
		$query = $this->tb_komentar_model->join_komentar_pending_num();
		return $query;	
	}

	function join_komentar_post($limit,$offset) {
		$this->load->model('tb_komentar_model');
		$query = $this->tb_komentar_model->join_komentar_post($limit,$offset);
		return $query;
	}

	function join_komentar_post_num($limit,$offset) {
		$this->load->model('tb_komentar_model');
		$query = $this->tb_komentar_model->join_komentar_post_num($limit,$offset);
		return $query;
	}

}

