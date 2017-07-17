<?php
class Cms_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get cms by his is
    * @param int $cms_id 
    * @return array
    */
    public function get_cms_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('cms');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Fetch cms data from the database
    * possibility to mix search, filter and order
    * @param int $manufacuture_id 
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_cms($search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$this->db->select('cms.id');
		$this->db->select('cms.title');
		$this->db->select('cms.label');
		$this->db->select('cms.content');
		$this->db->from('cms');
		
		if($search_string){
			$this->db->like('label', $search_string);
			$this->db->like('content', $search_string);
		}


		$this->db->group_by('cms.id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}


		$this->db->limit($limit_start, $limit_end);
		//$this->db->limit('4', '4');


		$query = $this->db->get();
		
		return $query->result_array(); 	
    }

    /**
    * Count the number of rows
    * @param int $manufacture_id
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_cms($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('cms');
		if($search_string){
			$this->db->like('label', $search_string);
			$this->db->like('content', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_cms($data)
    {
		$insert = $this->db->insert('cms', $data);
	    return $insert;
	}

    /**
    * Update cms
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_cms($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('cms', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

    /**
    * Delete cms
    * @param int $id - cms id
    * @return boolean
    */
	function delete_cms($id){
		$this->db->where('id', $id);
		$this->db->delete('cms'); 
	}
 
}
?>