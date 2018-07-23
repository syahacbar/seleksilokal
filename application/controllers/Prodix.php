<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Prodi extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('prodi_model', 'prodi_model');
		}

		public function index(){
			$data['all_prodi'] =  $this->prodi_model->get_all_prodi();
			$data['view'] = 'prodi/prodi_list';
			$this->load->view('layout', $data);
		}
		
		public function add(){
			if($this->input->post('submit')){
				$this->form_validation->set_rules('idfakultas', 'Nama Fakultas', 'trim|required');
				$this->form_validation->set_rules('namaprodi', 'Nama Prodi', 'trim|required');
				$this->form_validation->set_rules('dayatampung', 'Daya Tampung', 'trim|required');
				
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'dd_fakultas' => $this->prodi_model->dd_fakultas(),
						'fakultas_selected' => $this->input->post('fakultas') ? $this->input->post('fakultas') : '',
						'view' => 'prodi/prodi_add',
					);
					$this->load->view('layout', $data);
				}
				else{
					$dataprodi = array(
						'namaprodi' => $this->input->post('namaprodi'),
						'dayatampung' => $this->input->post('dayatampung'),
						'idfakultas' => $this->input->post('idfakultas'),
						
					);
					
					$dataprodi = $this->security->xss_clean($dataprodi);
					$result = $this->prodi_model->add_prodi($dataprodi);
					if($result){
						$this->session->set_flashdata('msg', 'Record is Added Successfully!');
						redirect(base_url('prodi'));
					}
				}
			}
			else{
				$data = array(
					'dd_fakultas' => $this->prodi_model->dd_fakultas(),
					'fakultas_selected' => $this->input->post('fakultas') ? $this->input->post('fakultas') : '',
					'view' => 'prodi/prodi_add',
				);
				
				$this->load->view('layout', $data);
			}
			
		}

		public function edit($id = 0){
			if($this->input->post('submit')){
				$this->form_validation->set_rules('idfakultas', 'Nama Fakultas', 'trim|required');
				$this->form_validation->set_rules('namaprodi', 'Nama Prodi', 'trim|required');
				$this->form_validation->set_rules('dayatampung', 'Daya Tampung', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$row=$this->prodi_model->get_prodi_id($id);
					$data = array(
						'prodi' => $this->prodi_model->get_prodi_by_id($id),
						'dd_fakultas' => $this->prodi_model->dd_fakultas(),
						'fakultas_selected' => $this->input->post('fakultas') ? $this->input->post('fakultas') : $row->idfakultas,
						'view' => 'prodi/prodi_edit',
					);
					
					$this->load->view('layout', $data);
				}
				else{
					$dataprodi = array(
						'namaprodi' => $this->input->post('namaprodi'),
						'dayatampung' => $this->input->post('dayatampung'),
						'idfakultas' => $this->input->post('idfakultas'),
						
					);
					
					$dataprodi = $this->security->xss_clean($dataprodi);
					
					$result = $this->prodi_model->edit_prodi($dataprodi, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Record is Updated Successfully!');
						redirect(base_url('prodi'));
					}
				}
			}
			else{
				$row=$this->prodi_model->get_prodi_id($id);
				$data = array(
					'prodi' => $this->prodi_model->get_prodi_by_id($id),
					'dd_fakultas' => $this->prodi_model->dd_fakultas(),
					'fakultas_selected' => $this->input->post('fakultas') ? $this->input->post('fakultas') : $row->idfakultas,
					'view' => 'prodi/prodi_add',
				);
				$data['view'] = 'prodi/prodi_edit';
				$this->load->view('layout', $data);
			}
		}

		public function del(){
			$id = $this->input->post('idprodi');
			$this->db->delete('prodi', array('idprodi' => $id));
			$this->session->set_flashdata('msg', 'Record is Deleted Successfully!');
			redirect(base_url('prodi'));
		}
    }
?>