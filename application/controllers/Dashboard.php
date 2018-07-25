<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->library("Pdf");
        $this->load->model('Laporan_model','laporan');
        $this->load->model('Pengaturan_model','pengaturan');
        $this->load->model('Prodi_model','prodi');
        $this->load->model('User_model','user');
        $this->load->model('Pendaftar_model','pendaftar');
	}
	
	public function index()
	{
		$totalkosong = ((int)$this->laporan->totaldayatampung()->dayatampung)-((int)$this->laporan->totalterima());
		$totalterima = (int)$this->laporan->totalterima();
		$totaluser = $this->user->count_all();
		$totalpendaftar = $this->pendaftar->count_all($this->pengaturan->gettahunakademik()->nilai);
		
		$data = array(
			'view' => 'grafik/g_rekap',
			'totalkosong' => $totalkosong,
			'totalterima' => $totalterima,
			'totaluser' => $totaluser,
			'totalpendaftar' => $totalpendaftar,
		);

		$this->load->view('layout',$data);
	}
}
