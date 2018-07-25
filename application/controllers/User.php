<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class User extends MY_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model','user');
        $this->load->model('Fakultas_model','fakultas');
    }
 
    public function index()
    {
        $data = array(
            'view' => 'user/user_view',
            'dd_fakultas' => $this->fakultas->dd_fakultas(),
            'fakultas_selected' => $this->input->post('fakultas') ? $this->input->post('fakultas') : '',
        );
        $this->load->view('layout',$data);
    }
 
    public function ajax_list()
    {
        $list = $this->user->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $result) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $result->username;
            $row[] = $result->email;
            $row[] = $result->created_on;
            $row[] = $result->last_login;
 
            //add html for action
            $row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_record('."'".$result->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_record('."'".$result->id."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->user->count_all(),
                        "recordsFiltered" => $this->user->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

     
    public function ajax_edit($id)
    {
        $data = $this->user->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        if ($this->input->post('username') == '') {
            $res['error']['username'] = 'Username tidak boleh kosong';
        }
        if ($this->input->post('password') == '') {
            $res['error']['password'] = 'Password tidak boleh kosong';
        } 
        if ($this->input->post('idfakultas') == '') {
            $res['error']['idfakultas'] = 'Fakultas harus dipilih';
        } 
            
        if (empty($res['error'])) {

            $res['hasil'] = 'sukses';
            $res['status'] = TRUE;
 
            $data = array(
                    'username' => $this->input->post('username'),
                    'password' => $this->input->post('password'),
                    'dayatampung' => $this->input->post('dayatampung'),
                    'idfakultas' => $this->input->post('idfakultas'),
                );
            $insert = $this->prodi->save($data);
        } else {
            $res['hasil'] = 'gagal';
            $res['status'] = FALSE;
        }
        echo json_encode($res);
    }
  
    public function ajax_update()
    {
        if ($this->input->post('namaprodi') == '') {
            $res['error']['namaprodi'] = 'Nama Prodi tidak boleh kosong';
        }
        if ($this->input->post('jenjang') == '') {
            $res['error']['jenjang'] = 'Jenjang Prodi tidak boleh kosong';
        }
        if ($this->input->post('dayatampung') == '') {
            $res['error']['dayatampung'] = 'Daya Tampung tidak boleh kosong';
        }    
        if ($this->input->post('idfakultas') == '') {
            $res['error']['idfakultas'] = 'Fakultas harus dipilih';
        } 
             
        if (empty($res['error'])) {

            $res['hasil'] = 'sukses';
            $res['status'] = TRUE;

            $data = array(
                'namaprodi' => $this->input->post('namaprodi'),
                'jenjang' => $this->input->post('jenjang'),
                'dayatampung' => $this->input->post('dayatampung'),
                'idfakultas' => $this->input->post('idfakultas'),
            );
            $this->prodi->update(array('idprodi' => $this->input->post('idprodi')), $data);
       
        } else {
            $res['hasil'] = 'gagal';
            $res['status'] = FALSE;
        }
        echo json_encode($res);
    }
 
    public function ajax_delete($id)
    {
        $this->prodi->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
}