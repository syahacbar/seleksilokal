<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Jurusanslta extends MY_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jurusanslta_model','jurusanslta');
    }
 
    public function index()
    {
        $data['view'] = 'jurusanslta/jurusanslta_view';
        $this->load->view('layout',$data);
    }
 
    public function ajax_list() 
    {
        $list = $this->jurusanslta->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $result) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $result->kodejurusanslta;
            $row[] = $result->deskripsi;
 
            //add html for action
            $row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_record('."'".$result->idjurusanslta."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_record('."'".$result->idjurusanslta."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->jurusanslta->count_all(),
                        "recordsFiltered" => $this->jurusanslta->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($id)
    {
        $data = $this->jurusanslta->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        if ($this->input->post('kodejurusanslta') == '') {
            $res['error']['kodejurusanslta'] = 'Kode Jurusan SLTA tidak boleh kosong';
        }
        if ($this->input->post('deskripsi') == '') {
            $res['error']['deskripsi'] = 'Deskripsi tidak boleh kosong';
        }    
            
        if (empty($res['error'])) {

            $res['hasil'] = 'sukses';
            $res['status'] = TRUE;

            $data = array(
                    'kodejurusanslta' => strtoupper($this->input->post('kodejurusanslta')),
                    'deskripsi' => strtoupper($this->input->post('deskripsi')),
                );
            $insert = $this->jurusanslta->save($data);
        } else {
            $res['hasil'] = 'gagal';
            $res['status'] = FALSE;
        }
        
        echo json_encode($res);
    }
 
    public function ajax_update()
    {
        if ($this->input->post('kodejurusanslta') == '') {
            $res['error']['kodejurusanslta'] = 'Kode Jurusan SLTA tidak boleh kosong';
        }
        if ($this->input->post('deskripsi') == '') {
            $res['error']['deskripsi'] = 'Deskripsi tidak boleh kosong';
        }    
            
        if (empty($res['error'])) {

            $res['hasil'] = 'sukses';
            $res['status'] = TRUE;

            $data = array(
                'kodejurusanslta' => strtoupper($this->input->post('kodejurusanslta')),
                'deskripsi' => strtoupper($this->input->post('deskripsi')),
            );
            $this->jurusanslta->update(array('idjurusanslta' => $this->input->post('idjurusanslta')), $data);
        } else {
            $res['hasil'] = 'gagal';
            $res['status'] = FALSE;
        }
        
        echo json_encode($res);
    }
 
    public function ajax_delete($id)
    {
        $this->jurusanslta->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
}