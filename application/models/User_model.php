<?php
	class User_model extends CI_Model{
		public function add_user($data){
			$this->db->insert('user', $data);
			return true;
		}
		public function get_all_users(){
			$query = $this->db->get('user');
			return $result = $query->result_array();
		}
		public function get_user_by_id($id){
			$query = $this->db->get_where('user', array('iduser' => $id));
			return $result = $query->row_array();
		}
		public function edit_user($id,$data ){
			$this->db->where('iduser', $id);
			$this->db->update('user', $data);
			return true;
		}
	}
?>