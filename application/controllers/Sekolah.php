
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  
class Sekolah extends MY_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sekolah_model','sekolah');
    }
 
    public function index()
    {
        $data['view'] = 'sekolah/sekolah_view';
        $this->load->view('layout',$data);
    }
 
    public function ajax_list()
    {
        $list = $this->sekolah->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $result) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $result->namasekolah;
            $row[] = $result->alamat;
            $row[] = $result->kota;
 
            //add html for action
            $row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_record('."'".$result->idsekolah."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_record('."'".$result->idsekolah."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->sekolah->count_all(),
                        "recordsFiltered" => $this->sekolah->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($id)
    {
        $data = $this->sekolah->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        if ($this->input->post('namasekolah') == '') {
            $res['error']['namasekolah'] = 'Nama Sekolah tidak boleh kosong';
        }
        if ($this->input->post('alamat') == '') {
            $res['error']['alamat'] = 'Alamat Sekolah tidak boleh kosong';
        }  
        if ($this->input->post('kota') == '') {
            $res['error']['kota'] = 'Daerah/Wilayah Sekolah tidak boleh kosong';
        }    
            
        if (empty($res['error'])) {

            $res['hasil'] = 'sukses';
            $res['status'] = TRUE;

            $data = array(
                    'namasekolah' => strtoupper($this->input->post('namasekolah')),
                    'alamat' => strtoupper($this->input->post('alamat')),
                    'kota' => strtoupper($this->input->post('kota')),
                );
            $insert = $this->sekolah->save($data);
            } else {
                $res['hasil'] = 'gagal';
                $res['status'] = FALSE;
            }
        echo json_encode($res);
    }
 
    public function ajax_update()
    {
        if ($this->input->post('namasekolah') == '') {
            $res['error']['namasekolah'] = 'Nama Sekolah tidak boleh kosong';
        }
        if ($this->input->post('alamat') == '') {
            $res['error']['alamat'] = 'Alamat Sekolah tidak boleh kosong';
        }  
        if ($this->input->post('kota') == '') {
            $res['error']['kota'] = 'Daerah/Wilayah Sekolah tidak boleh kosong';
        }    
            
        if (empty($res['error'])) {

            $res['hasil'] = 'sukses';
            $res['status'] = TRUE;

            $data = array(
                'namasekolah' => strtoupper($this->input->post('namasekolah')),
                'alamat' => strtoupper($this->input->post('alamat')),
                'kota' => strtoupper($this->input->post('kota')),
            );

            $this->sekolah->update(array('idsekolah' => $this->input->post('idsekolah')), $data);
        } else {
            $res['hasil'] = 'gagal';
            $res['status'] = FALSE;
        }
        echo json_encode($res);
    }
 
    public function ajax_delete($id)
    {
        $this->sekolah->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
}