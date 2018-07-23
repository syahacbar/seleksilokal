<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Seleksimanual extends CI_Controller {
    var $column_search = array('nopendaftar','namapendaftar','tempatlahir','tanggallahir','jeniskelamin','suku','jenjangslta','jurusanslta','tahunlulus','asalslta'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    
    public function __construct()
    {
        parent::__construct();
       // $this->load->model('Pendaftar_model','pendaftar');
        $this->load->model('Seleksimanual_model','seleksimanual');
        $this->load->model('Prodi_model','prodi');
    }
 
    public function index()
    {
        $data = array(
			'view' => 'seleksimanual/seleksimanual_view',
			'dd_prodi' => $this->prodi->dd_prodi(),
			'prodi_selected' => $this->input->post('pilihprodi') ? $this->input->post('pilihprodi') : '',
        );	
        $this->load->view('layout',$data);
    }
 
    public function ajax_list()
    {
        $list = $this->seleksimanual->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $result) {
            $no++;
            $rata = ($result->nbahasa+$result->nipa+$result->nips+$result->nverbal)/4;
            if($rata<=50 && $result->suku=="P"){
                $rata += 0.2*$rata;
            }
			$row = array(); 
			$row[] = '';
            $row[] = $result->nopendaftar;
            $row[] = $result->namapendaftar;
            $row[] = $result->pilihan1;
            $row[] = $result->pilihan2;
            $row[] = $result->pilihan3;
            $row[] = $result->suku;
            $row[] = $result->nbahasa;
            $row[] = $result->nipa;
            $row[] = $result->nips;
            $row[] = $result->nverbal;
            $row[] = $rata;
            $row[] = $result->tahunlulus;
            $row[] = $result->status;
 
            //add html for action
            $row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Terima" onclick="edit_record('."'".$result->nopendaftar."'".')"><i class="glyphicon glyphicon-ok-circle"></i> Terima</a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->seleksimanual->count_all(),
                        "recordsFiltered" => $this->seleksimanual->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    
    public function tampilprodi()
    {
        $sql = "SELECT * FROM pendaftar";
        $sql .= " WHERE ";

        if(isset($_POST['is_prodi']))
        {
                $sql .= "(pilihan1 = '".$_POST["is_prodi"]."' OR ";
                $sql .= "pilihan2 = '".$_POST["is_prodi"]."' OR ";
                $sql .= "pilihan3 = '".$_POST["is_prodi"]."') AND ";
        }

        $i = 0;
        foreach ($this->column_search as $item) // loop column 
        {
            if(isset($_POST['search']['value']))
            {
                if($i===0) // first loop
                {
                    $sql .= "(".$item." LIKE '%".$_POST['search']['value']."%')";
                }
            }
            $i++;
        }

        if(isset($_POST['order']))
        {
            $sql .= "ORDER BY ".$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir']." ";
        }
        else
        {
            $sql .= 'ORDER BY nopendaftar ASC ';
        }

        $sql1 = '';

        if($_POST['length'] != -1)
        {
            $sql1 .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        $query = $this->db->query($sql);
        $number_filter_row = $query->num_rows();
        $query1 = $this->db->query($sql.$sql1);
        $list = $query1->result();


        $data = array();
        $no = $_POST['start'];
        foreach ($list as $result) {
            $no++;
            $rata = ($result->nbahasa+$result->nipa+$result->nips+$result->nverbal)/4;
            if($rata<=50 && $result->suku=="P"){
                $rata += 0.2*$rata;
            }
			$row = array(); 
			$row[] = '';
            $row[] = $result->nopendaftar;
            $row[] = $result->namapendaftar;
            $row[] = $result->pilihan1;
            $row[] = $result->pilihan2;
            $row[] = $result->pilihan3;
            $row[] = $result->suku;
            $row[] = $result->nbahasa;
            $row[] = $result->nipa;
            $row[] = $result->nips;
            $row[] = $result->nverbal;
            $row[] = $rata;
            $row[] = $result->tahunlulus;
            $row[] = $result->status;
 
            //add html for action
            $row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Terima" onclick="edit_record('."'".$result->nopendaftar."'".')"><i class="glyphicon glyphicon-ok-circle"></i> Terima</a>';
 
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->seleksimanual->count_all(),
            "recordsFiltered" => $number_filter_row,
            "data" => $data,
        );
    //output to json format
    echo json_encode($output);

    }
}