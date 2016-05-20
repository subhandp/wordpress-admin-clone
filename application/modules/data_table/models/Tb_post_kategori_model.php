<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tb_post_kategori_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function get_table() {
		$table = "Tb_post_kategori";
		return $table;
	}
	
	function get_where($arr) {
		$table = $this->get_table();
		$this->db->where($arr);
		$query=$this->db->get($table);
		return $query;
	}

	function _update($id, $data) {
		$table = $this->get_table();
		$this->db->where('tb_post_kategori.id_post_kategori', $id);
		$this->db->update($table, $data);
	}

}

