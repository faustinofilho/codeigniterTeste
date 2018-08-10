<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_clientes extends CI_Model {
	
	public function store($dados = null, $id = null) {
		
		if ($dados) {
			if ($id) {
				$this->db->where('id', $id);
				if ($this->db->update("clientes", $dados)) {
					return true;
				} else {
					return false;
				}
			} else {
				if ($this->db->insert("clientes", $dados)) {
					return true;
				} else {
					return false;
				}
			}
		}
		
	}
	
	public function get($id = null){
		
		if ($id) {
			$this->db->where('id', $id);
		}
		$this->db->order_by("id", 'desc');
		return $this->db->get('clientes');
	}

	
	public function delete($id = null){
		if ($id) {
			return $this->db->where('id', $id)->delete('clientes');
		}
	}
}
