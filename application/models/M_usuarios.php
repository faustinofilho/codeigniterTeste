<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_usuarios extends CI_Model {
	
	public function store($dados = null, $id = null) {
		
		if ($dados) {
			if ($id) {
				$this->db->where('id', $id);
				if ($this->db->update("usuarios", $dados)) {
					return true;
				} else {
					return false;
				}
			} else {
				if ($this->db->insert("usuarios", $dados)) {
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
		return $this->db->get('usuarios');
	}

	
	public function delete($id = null){
		if ($id) {
			return $this->db->where('id', $id)->delete('usuarios');
		}
	}
}
