<?php
	class Prodi_model extends CI_Model{

		public function add_prodi($data){
			$this->db->insert('prodi', $data);
			return true;
		}

		public function get_all_prodi(){
            $this->db->select('prodi.idprodi,prodi.namaprodi,prodi.dayatampung,fakultas.idfakultas, fakultas.namafakultas');
            $this->db->from('prodi');
            $this->db->join('fakultas','fakultas.idfakultas=prodi.idfakultas');

			$query = $this->db->get();
			return $result = $query->result_array();
		}

		public function get_prodi_by_id($id){
			$query = $this->db->get_where('prodi', array('idprodi' => $id));
			return $result = $query->row_array();
		}

		public function get_prodi_id($id){
			$query = $this->db->get_where('prodi', array('idprodi' => $id));
			return $result = $query->row();
		}

		public function get_prodi_by_name($namaprodi){
			$query = $this->db->get_where('prodi', array('namaprodi' => $namaprodi));
			return $result = $query->row();
		}

		public function edit_prodi($data, $id){
			$this->db->where('idprodi', $id);
			$this->db->update('prodi', $data);
			return true;
		}

		
		
		public function dd_prodi()
    	{
			// ambil data dari db
			$this->db->order_by('namaprodi', 'asc');
			$result = $this->db->get('prodi');
			
			// bikin array
			// please select berikut ini merupakan tambahan saja agar saat pertama
			// diload akan ditampilkan text please select.
			$dd[''] = '--PILIH SALAH SATU--';
			if ($result->num_rows() > 0) {
				foreach ($result->result() as $row) {
				// tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
					$dd[strtoupper($row->namaprodi)] = strtoupper($row->namaprodi);
				}
			}
			return $dd;
    	}

	}

?>