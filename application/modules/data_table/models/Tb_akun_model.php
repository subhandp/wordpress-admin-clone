<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tb_akun_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function get_table() {
		$table = "tb_akun";
		return $table;
	}

}

