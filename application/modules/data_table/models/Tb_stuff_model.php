<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tb_stuff_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function get_table() {
		$table = "tb_stuff";
		return $table;
	}


	function get($order_by,$sorting) {
		$table = $this->get_table();
		$this->db->order_by($order_by,$sorting);
		$query=$this->db->get($table);
		return $query;
	}

	function get_all_count() {
		$table = $this->get_table();
		$query=$this->db->count_all_results($table);
		return $query;
	}


}

