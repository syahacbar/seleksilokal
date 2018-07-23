<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  
class Jenjangslta extends MY_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jenjangslta_model','jenjangslta');
    }
 
    public function index()
    {
        $data['view'] = 'jenjangslta/jenjangslta_view';
        $this->load->view('layout',$data);
    }
 
    public function ajax_list()
    {
        $list = $this->jenjangslta->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $result) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $result->kodejenjangslta;
            $row[] = $result->deskripsi;
 
            //add html for action
            $row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_record('."'".$result->idjenjangslta."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_record('."'".$result->idjenjangslta."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->jenjangslta->count_all(),
                        "recordsFiltered" => $this->jenjangslta->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($id)
    {
        $data = $this->jenjangslta->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        if ($this->input->post('kodejenjangslta') == '') {
            $res['error']['kodejenjangslta'] = 'Kode Jenjang SLTA tidak boleh kosong';
        }
        if ($this->input->post('deskripsi') == '') {
            $res['error']['deskripsi'] = 'Deskripsi tidak boleh kosong';
        }    
            
        if (empty($res['error'])) {

            $res['hasil'] = 'sukses';
            $res['status'] = TRUE;

            $data = array(
                    'kodejenjangslta' => strtoupper($this->input->post('kodejenjangslta')),
                    'deskripsi' => strtoupper($this->input->post('deskripsi')),
                );
            $insert = $this->jenjangslta->save($data);
            } else {
                $res['hasil'] = 'gagal';
                $res['status'] = FALSE;
            }
        echo json_encode($res);
    }
 
    public function ajax_update()
    {
        if ($this->input->post('kodejenjangslta') == '') {
            $res['error']['kodejenjangslta'] = 'Kode Jenjang SLTA tidak boleh kosong';
        }
        if ($this->input->post('deskripsi') == '') {
            $res['error']['deskripsi'] = 'Deskripsi tidak boleh kosong';
        }    
            
        if (empty($res['error'])) {

            $res['hasil'] = 'sukses';
            $res['status'] = TRUE;

            $data = array(
                'kodejenjangslta' =>  strtoupper($this->input->post('kodejenjangslta')),
                'deskripsi' =>  strtoupper($this->input->post('deskripsi')),
            );
            $this->jenjangslta->update(array('idjenjangslta' => $this->input->post('idjenjangslta')), $data);
        } else {
            $res['hasil'] = 'gagal';
            $res['status'] = FALSE;
        }
        echo json_encode($res);
    }
 
    public function ajax_delete($id)
    {
        $this->jenjangslta->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
}