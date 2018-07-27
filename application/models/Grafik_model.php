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
}