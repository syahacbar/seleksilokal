<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  
class Pengaturan extends MY_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pengaturan_model','pengaturan');
    }
 
    public function index() 
    {
        $data = array( 
            'view' => 'pengaturan/pengaturan_view',
            'dd_sesipilihan' =>  $this->pengaturan->dd_sesipilihan(),
            'sesipilihan_selected' => $this->input->post('sesipilihan') ? $this->input->post('sesipilihan') : $this->pengaturan->getsesipilihan()->nilai,
            'dd_tahunakademik' =>  $this->pengaturan->dd_tahunakademik(),
            'tahunakademik_selected' => $this->input->post('tahunakademik') ? $this->input->post('tahunakademik') : $this->pengaturan->gettahunakademik()->nilai,
            'namarektor' => $this->pengaturan->getnamarektor()->nilai,
            'niprektor' => $this->pengaturan->getniprektor()->nilai,
        );
        $this->load->view('layout',$data);
    }

    public function pengaturan_list() 
    {
        $data = array( 
            'view' => 'pengaturan/pengaturan_view',
            'dd_sesipilihan' =>  $this->pengaturan->dd_sesipilihan(),
            'sesipilihan_selected' => $this->input->post('sesipilihan') ? $this->input->post('sesipilihan') : $this->pengaturan->getsesipilihan()->nilai,
            'dd_tahunakademik' =>  $this->pengaturan->dd_tahunakademik(),
            'tahunakademik_selected' => $this->input->post('tahunakademik') ? $this->input->post('tahunakademik') : $this->pengaturan->gettahunakademik()->nilai,
            'namarektor' => $this->pengaturan->getnamarektor()->nilai,
            'niprektor' => $this->pengaturan->getniprektor()->nilai,
        );
        echo json_encode($data);
    }

    public function simpansesipilihan()
    {
        $data = array(
            'hasil' => 'sukses',
            'status' => TRUE,
        );
        $this->pengaturan->updatepengaturan(array('nilai'=>$_POST['sesipilihan']),array('parameter'=>'sesipilihan'));
        echo json_encode($data);
    }

    public function simpantahunakademik()
    {
        $data = array(
            'hasil' => 'sukses',
            'status' => TRUE,
        );
        $this->pengaturan->updatepengaturan(array('nilai'=>$_POST['tahunakademik']),array('parameter'=>'tahunakademik'));
        echo json_encode($data);
    }

    public function simpannamarektor()
    {
        $data = array(
            'hasil' => 'sukses',
            'status' => TRUE,
        );
        $this->pengaturan->updatepengaturan(array('nilai'=>$_POST['namarektor']),array('parameter'=>'namarektor'));
        echo json_encode($data);
    }

    public function simpanniprektor()
    {
        $data = array(
            'hasil' => 'sukses',
            'status' => TRUE,
        );
        $this->pengaturan->updatepengaturan(array('nilai'=>$_POST['niprektor']),array('parameter'=>'niprektor'));
        echo json_encode($data);
    }
}
 