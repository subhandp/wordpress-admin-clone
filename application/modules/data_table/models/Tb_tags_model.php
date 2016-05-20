<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tb_tags_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function get_table() {
		$table = "tb_tags";
		return $table;
	}

	function _get(){
		$table = $this->get_table();
		$query=$this->db->get($table);
		return $query;
	}

	function _insert($data) {
		$table = $this->get_table();
		$this->db->insert($table, $data);
		$id=$this->db->insert_id();
		return $id;
	}


}

