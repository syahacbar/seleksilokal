<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library("Pdf");
        $this->load->model('Laporan_model','laporan');
        $this->load->model('Pengaturan_model','pengaturan');
        $this->load->model('Prodi_model','prodi');
    }

	public function index()
	{
        $data = array (
            'view' => 'grafik/g_rekap',
        );

        $this->load->view('layout',$data);
    }
}