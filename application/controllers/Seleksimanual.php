<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Seleksimanual extends MY_Controller {
    var $column_search = array('nopendaftar','namapendaftar','tempatlahir','tanggallahir','jeniskelamin','suku','jenjangslta','jurusanslta','tahunlulus','asalslta'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Penerimaan_model','penerimaan');
        $this->load->model('Seleksimanual_model','seleksimanual');
        $this->load->model('Prodi_model','prodi');
        $this->load->model('Pengaturan_model','pengaturan');
    }
 
    public function index()
    {
        $this->ion_auth->is_admin() ? $dd_prodi = $this->seleksimanual->dd_prodi() : $dd_prodi = $this->seleksimanual->dd_prodi();
        $data = array(
            'tahunakademik' => $this->pengaturan->gettahunakademik()->nilai,
			'view' => 'seleksimanual/seleksimanual_view',
			'dd_prodi' => $dd_prodi,
            'prodi_selected' => $this->input->post('pilihprodi') ? $this->input->post('pilihprodi') : '',
        );	
        $this->load->view('layout',$data);
    }

    public function getdayatampungprodi()
    {
        $prodiname = $this->input->post('pilihprodi');
        $data = $this->prodi->get_by_prodiname($prodiname);
        echo json_encode($data);
    }
 
    public function ajax_list()
    {
        $sesipilihan = $this->pengaturan->getsesipilihan()->nilai;
        $tahunakademik = $this->pengaturan->gettahunakademik()->nilai;
        $list = $this->seleksimanual->get_datatables($sesipilihan,$tahunakademik);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $result) {
            $no++;
           
            $prodipilihan = "";
            if(isset($_POST['is_prodi'])){
                if($_POST['is_prodi']==$result->pilihan1){
                    $prodipilihan = "1 ";
                    if($_POST['is_prodi']==$result->pilihan2){
                        $prodipilihan .= "| 2 ";
                    }
                    if($_POST['is_prodi']==$result->pilihan3){
                        $prodipilihan .= "| 3 ";
                    }
                }
                
                elseif($_POST['is_prodi']==$result->pilihan2){
                    $prodipilihan = "2 ";
                    if($_POST['is_prodi']==$result->pilihan3){
                        $prodipilihan .= "| 3 ";
                    }
                }

                elseif($_POST['is_prodi']==$result->pilihan3){
                    $prodipilihan = "3";
                }
            }
            $row = array(); 
            $result->suku=="P" ? $suku="Papua" : $suku="Non Papua";
            if(date('Y')-$result->tahunlulus>3){
                $row[] = '<font color="red"><strong><center><input type="checkbox" name="nopendaftar" value="'.$result->nopendaftar.'"></center></strong></font>';
                $row[] = '<font color="red"><strong>'.$result->nopendaftar.'</strong></font>';
                $row[] = '<font color="red"><strong>'.$result->namapendaftar;
                $row[] = '<font color="red"><center><strong>'.$prodipilihan.'</strong></center></font>';
                $row[] = '<font color="red"><strong>'.$suku.'</strong></font>';
                $row[] = '<font color="red"><strong>'.$result->jurusanslta.'</strong></font>';
                $row[] = '<font color="red"><strong>'.$result->nbahasa.'</strong></font>';
                $row[] = '<font color="red"><strong>'.$result->nipa.'</strong></font>';
                $row[] = '<font color="red"><strong>'.$result->nips.'</strong></font>';
                $row[] = '<font color="red"><strong>'.$result->nverbal.'</strong></font>';
                $row[] = '<font color="red"><strong>'.$result->ratarata.'</strong></font>';
                $row[] = '<font color="red"><strong>'.$result->tahunlulus.'</strong></font>';
            } else {
                $row[] = '<center><input type="checkbox" name="nopendaftar" value="'.$result->nopendaftar.'"></center>';
                $row[] = $result->nopendaftar;
                $row[] = $result->namapendaftar;
                $row[] = "<center><strong>".$prodipilihan."</strong></center>";
                $row[] = $suku;
                $row[] = $result->jurusanslta;
                $row[] = $result->nbahasa;
                $row[] = $result->nipa;
                $row[] = $result->nips;
                $row[] = $result->nverbal;
                $row[] = $result->ratarata;
                $row[] = $result->tahunlulus;
            }
            //add html for action
            $row[] = '<a class="btn btn-xs btn-info" href="javascript:void(0)" title="Detail" onclick="detail_record('."'".$result->nopendaftar."'".')"><i class="glyphicon glyphicon-search"></i> Detail</a>
                    <a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Terima" onclick="terima('."'".$result->nopendaftar."'".')"><i class="glyphicon glyphicon-ok-circle"></i> Terima</a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->seleksimanual->count_all(),
                        "recordsFiltered" => $this->seleksimanual->count_filtered($sesipilihan,$tahunakademik),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function terima($id)
    {
        $datainput = array(
            'nopendaftar' => $id,
            'idprodi' => $this->prodi->get_by_prodiname($this->input->post('pilihprodi'))->idprodi,
        );
        $dataupdate = array(
            'status' => $this->input->post('status'),
        );
        $insert = $this->seleksimanual->save($datainput);
        $insert = $this->seleksimanual->update($dataupdate,array('nopendaftar'=>$id));
        echo json_encode($datainput);
        
    }

    public function terimakolektif()
    {
        $arrnopendaftar = explode(',',$this->input->post('nopendaftar'));
        foreach ($arrnopendaftar as $nopendaftar){
            $datainput = array(
                'idprodi' => $this->prodi->get_by_prodiname($this->input->post('pilihprodi'))->idprodi,
                'nopendaftar' => $nopendaftar,
            );
            $dataupdate = array(
                'status' => $this->input->post('status'),
            );
            $insert = $this->seleksimanual->save($datainput);
            $insert = $this->seleksimanual->update($dataupdate,array('nopendaftar'=>$nopendaftar));
        } 
        echo json_encode($arrnopendaftar);
    }
    
}