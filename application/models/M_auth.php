<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_auth extends CI_Model {
	public function CekLogin($table,$pk,$id){
		$this->db->where($pk, $id);
		return $this->db->get($table)->row_array();
	}
}