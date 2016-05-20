<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tb_tag_post_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function get_table() {
		$table = "tb_tag_post";
		return $table;
	}

	function _insert($data) {
		$table = $this->get_table();
		$this->db->insert($table, $data);
	}

	function _delete($id) {
		$table = $this->get_table();
		$this->db->where('id_post', $id);
		$this->db->delete($table);
	}

}

