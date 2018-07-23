<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Peserta extends MY_Controller {

		function __construct()
		{ 
			parent::__construct();
			$this->load->model('Peserta_model');
			$this->load->model('Prodi_model');
			$this->load->model('Jenjangslta_model');
			$this->load->model('Jurusanslta_model');
			$this->load->library('form_validation');        
			$this->load->library('datatables');
		}

		public function index()
		{
			$data['view'] = 'peserta/peserta_list';
			$this->load->view('layout', $data);
		} 
		
		public function json() {
			header('Content-Type: application/json');
			echo $this->Peserta_model->json();
		}

		public function read($id) 
    {
        $row = $this->Peserta_model->get_by_id($id);
        if ($row) {
            $data = array(
		'nopeserta' => $row->nopeserta,
		'namapeserta' => $row->namapeserta,
		'tempatlahir' => $row->tempatlahir,
		'tanggallahir' => $row->tanggallahir,
		'jeniskelamin' => $row->jeniskelamin,
		'suku' => $row->suku,
		'pilihan1' => $row->pilihan1,
		'pilihan2' => $row->pilihan2,
		'pilihan3' => $row->pilihan3,
		'jenjangslta' => $row->jenjangslta,
		'jurusanslta' => $row->jurusanslta,
		'tahunlulus' => $row->tahunlulus,
		'asalslta' => $row->asalslta,
		'nbahasa' => $row->nbahasa,
		'nipa' => $row->nipa,
		'nips' => $row->nips,
		'nverbal' => $row->nverbal,
		'status' => $row->status,
		'tahunakademik' => $row->tahunakademik,
		'view' => 'peserta/peserta_detail',
	    );
            $this->load->view('layout', $data);
        } else {
            $this->session->set_flashdata('msg', 'Record Not Found');
            redirect(site_url('peserta'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('peserta/create_action'),
			'namapeserta' => set_value('namapeserta'),
			'tempatlahir' => set_value('tempatlahir'),
			'tanggallahir' => set_value('tanggallahir'),
			'jeniskelamin' => set_value('jeniskelamin'),
			'suku' => set_value('suku'),
			'pilihan1' => set_value('pilihan1'),
			'pilihan2' => set_value('pilihan2'),
			'pilihan3' => set_value('pilihan3'),
			'jenjangslta' => set_value('jenjangslta'),
			'jurusanslta' => set_value('jurusanslta'),
			'tahunlulus' => set_value('tahunlulus'),
			'asalslta' => set_value('asalslta'),
			'nbahasa' => set_value('nbahasa'),
			'nipa' => set_value('nipa'),
			'nips' => set_value('nips'),
			'nverbal' => set_value('nverbal'),
			'status' => set_value('status'),
			'tahunakademik' => set_value('tahunakademik'),
			'view' => 'peserta/peserta_add',
			'nopeserta'=> $this->Peserta_model->get_last_id(),
			'dd_prodi' => $this->Prodi_model->dd_prodi(),
			'p1_selected' => $this->input->post('pilihan1',TRUE),
			'p2_selected' => $this->input->post('pilihan2',TRUE),
			'p3_selected' => $this->input->post('pilihan3',TRUE),
			'dd_jenjangslta'  => $this->Jenjangslta_model->dd_jenjangslta(),
			'jenjang_selected' => $this->input->post('jenjangslta',TRUE),
			'dd_jurusanslta'  => $this->Jurusanslta_model->dd_jurusanslta(),
			'jurusan_selected' => $this->input->post('jurusanslta',TRUE),
		);
        $this->load->view('layout', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'nopeserta'=> $this->input->post('nopeserta',TRUE),
				'namapeserta' => strtoupper($this->input->post('namapeserta',TRUE)),
				'tempatlahir' => strtoupper($this->input->post('tempatlahir',TRUE)),
				'tanggallahir' => $this->input->post('tanggallahir',TRUE),
				'jeniskelamin' => $this->input->post('jeniskelamin',TRUE),
				'suku' => $this->input->post('suku',TRUE),
				'pilihan1' => $this->input->post('pilihan1',TRUE),
				'pilihan2' => $this->input->post('pilihan2',TRUE),
				'pilihan3' => $this->input->post('pilihan3',TRUE),
				'jenjangslta' => $this->input->post('jenjangslta',TRUE),
				'jurusanslta' => $this->input->post('jurusanslta',TRUE),
				'tahunlulus' => $this->input->post('tahunlulus',TRUE),
				'asalslta' => strtoupper($this->input->post('asalslta',TRUE)),
				'nbahasa' => $this->input->post('nbahasa',TRUE),
				'nipa' => $this->input->post('nipa',TRUE),
				'nips' => $this->input->post('nips',TRUE),
				'nverbal' => $this->input->post('nverbal',TRUE),
				'status' => $this->input->post('status',TRUE),
				'tahunakademik' => $this->input->post('tahunakademik',TRUE),
				);

            $this->Peserta_model->insert($data);
            $this->session->set_flashdata('msg', 'Create Record Success');
            redirect(site_url('peserta'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Peserta_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('peserta/update_action'),
		'nopeserta' => set_value('nopeserta', $row->nopeserta),
		'namapeserta' => set_value('namapeserta', $row->namapeserta),
		'tempatlahir' => set_value('tempatlahir', $row->tempatlahir),
		'tanggallahir' => set_value('tanggallahir', $row->tanggallahir),
		'jeniskelamin' => set_value('jeniskelamin', $row->jeniskelamin),
		'suku' => set_value('suku', $row->suku),
		'pilihan1' => set_value('pilihan1', $row->pilihan1),
		'pilihan2' => set_value('pilihan2', $row->pilihan2),
		'pilihan3' => set_value('pilihan3', $row->pilihan3),
		'jenjangslta' => set_value('jenjangslta', $row->jenjangslta),
		'jurusanslta' => set_value('jurusanslta', $row->jurusanslta),
		'tahunlulus' => set_value('tahunlulus', $row->tahunlulus),
		'asalslta' => set_value('asalslta', $row->asalslta),
		'nbahasa' => set_value('nbahasa', $row->nbahasa),
		'nipa' => set_value('nipa', $row->nipa),
		'nips' => set_value('nips', $row->nips),
		'nverbal' => set_value('nverbal', $row->nverbal),
		'status' => set_value('status', $row->status),
		'tahunakademik' => set_value('tahunakademik', $row->tahunakademik),
		'view' => 'peserta/peserta_edit',
		'dd_prodi'  => $this->Prodi_model->dd_prodi(),
		'p1_selected' => $row->pilihan1,
		'p2_selected' => $row->pilihan2,
		'p3_selected' => $row->pilihan3,
		'dd_jenjangslta'  => $this->Jenjangslta_model->dd_jenjangslta(),
		'jenjang_selected' => $row->jenjangslta,
		'dd_jurusanslta'  => $this->Jurusanslta_model->dd_jurusanslta(),
		'jurusan_selected' => $row->jurusanslta,
	    );
			$this->load->view('layout', $data);
        } else {
            $this->session->set_flashdata('msg', 'Record Not Found');
            redirect(site_url('peserta'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('nopeserta', TRUE));
        } else {
            $data = array(
		'namapeserta' => strtoupper($this->input->post('namapeserta',TRUE)),
		'tempatlahir' => strtoupper($this->input->post('tempatlahir',TRUE)),
		'tanggallahir' => $this->input->post('tanggallahir',TRUE),
		'jeniskelamin' => $this->input->post('jeniskelamin',TRUE),
		'suku' => $this->input->post('suku',TRUE),
		'pilihan1' => $this->input->post('pilihan1',TRUE),
		'pilihan2' => $this->input->post('pilihan2',TRUE),
		'pilihan3' => $this->input->post('pilihan3',TRUE),
		'jenjangslta' => $this->input->post('jenjangslta',TRUE),
		'jurusanslta' => $this->input->post('jurusanslta',TRUE),
		'tahunlulus' => $this->input->post('tahunlulus',TRUE),
		'asalslta' => strtoupper($this->input->post('asalslta',TRUE)),
		'nbahasa' => $this->input->post('nbahasa',TRUE),
		'nipa' => $this->input->post('nipa',TRUE),
		'nips' => $this->input->post('nips',TRUE),
		'nverbal' => $this->input->post('nverbal',TRUE),
		'status' => $this->input->post('status',TRUE),
		'tahunakademik' => $this->input->post('tahunakademik',TRUE),
	    );

            $this->Peserta_model->update($this->input->post('nopeserta', TRUE), $data);
            $this->session->set_flashdata('msg', 'Update Record Success');
            redirect(site_url('peserta'));
        }
    }
    
    public function delete() 
    {
		$this->Peserta_model->delete();
		$this->session->set_flashdata('msg', 'Delete Record is Updated Successfully!');
      	redirect('peserta');
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('namapeserta', 'namapeserta', 'trim|required');
	$this->form_validation->set_rules('tempatlahir', 'tempatlahir', 'trim|required');
	$this->form_validation->set_rules('tanggallahir', 'tanggallahir', 'trim|required');
	$this->form_validation->set_rules('jeniskelamin', 'jeniskelamin', 'trim|required');
	$this->form_validation->set_rules('suku', 'suku', 'trim|required');
	$this->form_validation->set_rules('pilihan1', 'pilihan1', 'trim|required');
	$this->form_validation->set_rules('pilihan2', 'pilihan2', 'trim|required');
	$this->form_validation->set_rules('pilihan3', 'pilihan3', 'trim|required');
	$this->form_validation->set_rules('jenjangslta', 'jenjangslta', 'trim|required');
	$this->form_validation->set_rules('jurusanslta', 'jurusanslta', 'trim|required');
	$this->form_validation->set_rules('tahunlulus', 'tahunlulus', 'trim|required');
	$this->form_validation->set_rules('asalslta', 'asalslta', 'trim|required');
	$this->form_validation->set_rules('nbahasa', 'nbahasa', 'trim|required|numeric');
	$this->form_validation->set_rules('nipa', 'nipa', 'trim|required|numeric');
	$this->form_validation->set_rules('nips', 'nips', 'trim|required|numeric');
	$this->form_validation->set_rules('nverbal', 'nverbal', 'trim|required|numeric');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('tahunakademik', 'tahunakademik', 'trim|required');

	$this->form_validation->set_rules('nopeserta', 'nopeserta', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
	
	public function importpeserta()
    {
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));

        $fileName = time().$_FILES['file']['name'];
         
        $config['upload_path'] = './assets/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') )
        $this->upload->display_errors();
             
        $media = $this->upload->data('');
        $inputFileName = 'assets/'.$media['file_name'];
         
        try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
             
            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
												FALSE);
												
                 $data = array(
                    "nopeserta"=> $rowData[0][0],
                    "namapeserta"=> strtoupper($rowData[0][1]),
                    "tempatlahir"=> strtoupper($rowData[0][2]),
                    "tanggallahir"=> date("d-m-Y",($rowData[0][3]-25569) * 86400),
                    "jeniskelamin"=> strtoupper($rowData[0][4]),
                    "suku"=> strtoupper($rowData[0][5]),
                    "pilihan1"=> strtoupper($rowData[0][6]),
                    "pilihan2"=> strtoupper($rowData[0][7]),
                    "pilihan3"=> strtoupper($rowData[0][8]),
                    "jenjangslta"=> strtoupper($rowData[0][9]),
                    "jurusanslta"=> strtoupper($rowData[0][10]),
                    "tahunlulus"=> $rowData[0][11],
                    "asalslta"=> strtoupper($rowData[0][12]),
                    "nbahasa"=> $rowData[0][13],
                    "nipa"=> $rowData[0][14],
                    "nips"=> $rowData[0][15],
                    "nverbal"=> $rowData[0][16],
                    "status"=> "B",
                    "tahunakademik"=> $rowData[0][17]
                );
                 
                //sesuaikan nama dengan nama tabel
                $insert = $this->db->insert("peserta",$data);       
			}
			delete_files($media['file_path']);
        redirect('peserta');
    }

	
}
?>