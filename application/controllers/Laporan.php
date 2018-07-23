<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library("Pdf");
        $this->load->model('Laporan_model','laporan');
        $this->load->model('Pengaturan_model','pengaturan');
        $this->load->model('Prodi_model','prodi');
    }

	public function index()
	{
        
    }
    
    public function laporanexcel()
	{
		$data = array(
            'list' => $this->laporan->get_printall(),
            'tahunakademik' => $this->pengaturan->gettahunakademik()->nilai,
            'title' => 'PESERTA LULUS SELEKSI JALUR LOKAL UNIPA TAHUN 2018',
        );
		$this->load->view('laporan/laporanexcel',$data);
		
    }
    
    public function pdfsk()
    {
        $data =array(
            'fakultas' => $this->laporan->fakultas_array(),
        );
		$this->load->view('laporan/skpdf', $data);
    }

    public function pdfcetak()
    {
        $data =array(
            'prodi' => $this->laporan->prodi_array(),
        );
		$this->load->view('laporan/cetakpdf', $data);
    }

    public function rekapitulasi()
    {
        $data =array(
            'prodi' => $this->prodi->get_prodi(),
            'view' => 'laporan/rekapitulasi',
        );
        $this->load->view('layout',$data);
        //echo json_encode($data);
    }

    public function rekapitulasi_list()
    {
        $list = $this->laporan->get_datatables_rekap();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $result) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $result->namaprodi;
            $row[] = $result->peminat;
            $row[] = $result->dayatampung;
            $row[] = $result->terima;
            $row[] = $result->kosong." (".round($result->persenkosong*100,2)."%)";
 
            //add html for action
            $row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_record('."'".$result->idprodi."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_record('."'".$result->idprodi."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->prodi->count_all(),
                        "recordsFiltered" => $this->prodi->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function gettotal()
    {
        $totalkosong = ((int)$this->laporan->totaldayatampung()->dayatampung)-((int)$this->laporan->totalterima());
        $dayatampung = (int)$this->laporan->totaldayatampung()->dayatampung;
        $persenkosong = round((($totalkosong/$dayatampung)*100),2);
        $data = array(
            'totalpeminat'=> $this->laporan->totalpeminat(), 
            'totaldayatampung'=> $dayatampung,
            'totalterima'=>$this->laporan->totalterima(),
            'totalkosong'=>$totalkosong,
            'persenkosong'=>$persenkosong,
        );
        echo json_encode($data);
    }
	
}
