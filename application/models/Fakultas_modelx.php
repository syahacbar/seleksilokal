<?php
	class Fakultas_modelx extends CI_Model{
		public function add_fakultas($datafakultas){
			$this->db->insert('fakultas',$datafakultas);
			return true;
		}
		public function get_all_fakultas(){
            $this->db->select('fakultas.idfakultas,fakultas.namafakultas,fakultas.namadekan,user.iduser, user.username, user.password, user.is_admin');
            $this->db->from('fakultas');
            $this->db->join('user','user.iduser=fakultas.iduser');
			$query = $this->db->get();
			return $result = $query->result_array();
		}
		public function get_fakultas_by_id($id){
			$query = $this->db->get_where('fakultas', array('idfakultas' => $id));
			return $result = $query->row_array();
		}
		
		public function get_fakultas_id($id){
			$query = $this->db->get_where('fakultas', array('idfakultas' => $id));
			return $result = $query->row();
		}
		public function edit_fakultas($datafakultas, $id){
			$this->db->where('idfakultas', $id);
			$this->db->update('fakultas', $datafakultas);
			return true;
		}
	}
?>