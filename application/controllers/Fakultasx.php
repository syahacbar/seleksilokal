<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Fakultasx extends MY_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('fakultas_modelx','fakultas_model');
			$this->load->model('user_model');
		}
		public function index(){
			$data['all_fakultas'] =  $this->fakultas_model->get_all_fakultas();
			$data['view'] = 'fakultasx/fakultas_list';
			$this->load->view('layout', $data);
		}
		
		public function add(){
			if($this->input->post('submit')){
				$this->form_validation->set_rules('namafakultas', 'Nama Fakultas', 'trim|required');
				$this->form_validation->set_rules('namadekan', 'Nama Dekan', 'trim|required');
				$this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'fakultasx/fakultas_add';
					$this->load->view('layout', $data);
				}
				else{
					$datauser = array(
						'username' => $this->input->post('username'),
						'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					);
					$datauser = $this->security->xss_clean($datauser);
					$this->db->insert('user',$datauser);
					$iduser= $this->db->insert_id();
					$datafakultas = array(
						'namafakultas' => $this->input->post('namafakultas'),
						'namadekan' => $this->input->post('namadekan'),
						'iduser' => $iduser,
					);
					$datafakultas = $this->security->xss_clean($datafakultas);
					$result = $this->fakultas_model->add_fakultas($datafakultas);
					if($result){
						$this->session->set_flashdata('msg', 'Record is Added Successfully!');
						redirect(base_url('fakultas'));
					}
				}
			}
			else{
				$data['view'] = 'fakultasx/fakultas_add';
				$this->load->view('layout', $data);
			}
			
		}
		public function edit($id = 0){
			if($this->input->post('submit')){
				$this->form_validation->set_rules('namafakultas', 'Nama Fakultas', 'trim|required');
				$this->form_validation->set_rules('namadekan', 'Nama Dekan', 'trim|required');
				$this->form_validation->set_rules('username', 'Username', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['fakultas'] = $this->fakultas_model->get_fakultas_by_id($id);
					$data['view'] = 'fakultasx/fakultas_edit';
					$row = $this->fakultas_model->get_fakultas_id($id);
					$data['user'] = $this->user_model->get_user_by_id($row->iduser);
					$this->load->view('layout', $data);
				}
				else{
					$datafakultas = array(
						'namafakultas' => $this->input->post('namafakultas'),
						'namadekan' => $this->input->post('namadekan'),
					);
					$datafakultas = $this->security->xss_clean($datafakultas);
					$row = $this->fakultas_model->get_fakultas_id($id);
					$datauser = array(
						'username' => $this->input->post('username'),
						'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
						'updated_at' => date('Y-m-d : h:m:s'),
					);
					$datauser = $this->security->xss_clean($datauser);
					$this->user_model->edit_user($datauser, $row->iduser);
					
					$result = $this->fakultas_model->edit_fakultas($datafakultas, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Record is Updated Successfully!');
						redirect(base_url('fakultas'));
					}
				}
			}
			else{
				$data['fakultas'] = $this->fakultas_model->get_fakultas_by_id($id);
				$row = $this->fakultas_model->get_fakultas_id($id);
				$data['user'] = $this->user_model->get_user_by_id($row->iduser);
				$data['view'] = 'fakultasx/fakultas_edit';
				$this->load->view('layout', $data);
			}
		}
		
		public function del(){
			$id = $this->input->post('idfakultas');
			$row = $this->fakultas_model->get_fakultas_id($id);
			$iduser = $row->iduser;
			$this->db->delete('fakultas', array('idfakultas' => $id));
			$this->db->delete('user', array('iduser' => $iduser));
			$this->session->set_flashdata('msg', 'Record is Deleted Successfully!');
			redirect(base_url('fakultas'));
		}
    }
?>