<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tb_uploads_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function get_table() {
		$table = "tb_uploads";
		return $table;
	}
	

	function _get($order) {
		$table = $this->get_table();
		$this->db->order_by('id_upload', $order);
		$query=$this->db->get($table);
		return $query;
	}

	function get_where($arr) {
		$table = $this->get_table();
		$this->db->where($arr);
		$query=$this->db->get($table);
		return $query;
	}

	function _insert($data) {
		$table = $this->get_table();
		$this->db->insert($table, $data);
		$id=$this->db->insert_id();
		return $id;
	}
	
	function get_all_count() {
		$table = $this->get_table();
		$query=$this->db->count_all_results($table);
		return $query;
	}

}

