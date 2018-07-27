<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Grafik_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pengaturan_model','pengaturan');
    }

    public function get_penerimaan()
    {
         
        $this->db->select('*');
        $this->db->from('v_rekap');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_jumlah_suku()
    {
        $query = $this->db->query('SELECT DISTINCT p.suku, (SELECT COUNT(pd.suku) FROM pendaftar pd WHERE pd.suku=p.suku) AS jumlah
        FROM pendaftar p'); 
        return $query->result();
    }

    public function get_jumlah_tahunlulus()
    {
        $query = $this->db->query('SELECT DISTINCT p.tahunlulus, (SELECT COUNT(pd.tahunlulus) FROM pendaftar pd WHERE pd.tahunlulus=p.tahunlulus) AS jumlah
        FROM pendaftar p'); 
        return $query->result();
    }
}