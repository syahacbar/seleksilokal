<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class User extends MY_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model','user');
    }
 
    public function index()
    {
        $data['view'] = 'user/user_view';
        $this->load->view('layout',$data);
    }
 
    public function ajax_list()
    {
        $list = $this->user->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $result) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $result->username;
            $row[] = $result->email;
            $row[] = $result->created_on;
            $row[] = $result->last_login;
 
            //add html for action
            $row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_record('."'".$result->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_record('."'".$result->id."'".')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->user->count_all(),
                        "recordsFiltered" => $this->user->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
}