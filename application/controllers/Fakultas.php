<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Fakultas extends MY_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Fakultas_model','fakultas');
        $this->load->model('User_model','user');
    }
 
    public function index()
    {
        $data['view'] = 'fakultas/fakultas_view';
        $this->load->view('layout',$data);
    }
 
    public function ajax_list()
    {
        $list = $this->fakultas->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $result) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = strtoupper($result->namafakultas);
            $row[] = $result->namadekan;
 
            //add html for action
            $row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_record('."'".$result->idfakultas."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_record('."'".$result->idfakultas."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->fakultas->count_all(),
                        "recordsFiltered" => $this->fakultas->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($id)
    {
        $data = $this->fakultas->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        if ($this->input->post('namafakultas') == '') {
            $data['error']['namafakultas'] = 'Nama Fakultas tidak boleh kosong';
        }
        if ($this->input->post('namadekan') == '') {
            $data['error']['namadekan'] = 'Nama Dekan tidak boleh kosong';
        }
        if ($this->input->post('username') == '') {
            $data['error']['username'] = 'Username tidak boleh kosong';
        }
        if ($this->input->post('password') == '') {
            $data['error']['password'] = 'Password tidak boleh kosong';
        }    
            
        if (empty($data['error'])) {

            $data['hasil'] = 'sukses';
            $data['status'] = TRUE;

            $datau = array(
                    'username' => $this->input->post('username'),
                    'password' => $this->input->post('password'),
                    'is_admin' => '0',
                );
            $insert = $this->user->add_user($datau);
            
            $dataf = array(
                    'namafakultas' => $this->input->post('namafakultas'),
                    'namadekan' => $this->input->post('namadekan'),
                    'iduser' => $this->db->insert_id(),
                );
            $insert = $this->fakultas->save($dataf);
        } else {
            $data['hasil'] = 'gagal';
            $data['status'] = FALSE;
        }

        echo json_encode($data);
    }
 
    public function ajax_update()
    {
        if ($this->input->post('namafakultas') == '') {
            $data['error']['namafakultas'] = 'Nama Fakultas tidak boleh kosong';
        }
        if ($this->input->post('namadekan') == '') {
            $data['error']['namadekan'] = 'Nama Dekan tidak boleh kosong';
        }
        if ($this->input->post('username') == '') {
            $data['error']['username'] = 'Username tidak boleh kosong';
        }
            
        if (empty($data['error'])) {

            $data['hasil'] = 'sukses';
            $data['status'] = TRUE;
        
            if(empty($this->input->post('password'))){
                $datau = array(
                    'username' => $this->input->post('username'),
                );
            } else {
                $datau = array(
                    'username' => $this->input->post('username'),
                    'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                );
            };
            
            $dataf = array(
                'namafakultas' => $this->input->post('namafakultas'),
                'namadekan' => $this->input->post('namadekan'),
            );
            $this->fakultas->update(array('idfakultas' => $this->input->post('idfakultas')), $dataf);
            $this->user->edit_user($this->input->post('iduser'), $datau);
        } else {
            $data['hasil'] = 'gagal';
            $data['status'] = FALSE;
        }
        echo json_encode($data);
    }
 
    public function ajax_delete($id)
    {
        $this->fakultas->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
}