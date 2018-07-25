<?php
class User_model extends CI_Model{

    var $column_order = array('','username','email','created_on','last_login'); //set column field database for datatable orderable
    var $column_search = array('username','email'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('users.id' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
        $this->db->select('*') ;
        $this->db->from('users');
        $this->db->join('users_has_fakultas','users_has_fakultas.user_id=users.id');
        $this->db->join('fakultas','fakultas.idfakultas=users_has_fakultas.fakultas_id');

 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from('users');
        return $this->db->count_all_results();
    }
		public function add_user($data){
			$this->db->insert('user', $data);
			return true; 
		}
		public function get_all_users(){
			$query = $this->db->get('user');
			return $result = $query->result_array();
		}
		public function get_user_by_id($id){
			$query = $this->db->get_where('user', array('iduser' => $id));
			return $result = $query->row_array();
		}
		public function edit_user($id,$data ){
			$this->db->where('iduser', $id);
			$this->db->update('user', $data);
			return true;
		}
}
?>