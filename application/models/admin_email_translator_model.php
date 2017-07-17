<?php
class Admin_email_translator_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_translator_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('send_invitation');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Fetch category data from the database
    * possibility to mix search, filter and order
    * @param int $manufacuture_id 
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_translator($search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$job_id=$this->uri->segment(3);
		$this->db->select('*');
		$this->db->from('send_invitation');
		$this->db->where('job_id', $job_id);
		
		if($search_string){
			$this->db->like('name', $search_string);
			$this->db->like('desc', $search_string);
		}


		$this->db->group_by('send_invitation.id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}


		$this->db->limit($limit_start, $limit_end);
		//$this->db->limit('4', '4');


		$query = $this->db->get();
		//echo '<pre>'; print_r($query->result_array()); die;
		
		return $query->result_array(); 	
    }

    /**
    * Count the number of rows
    * @param int $manufacture_id
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_translator($search_string=null, $order=null)
    {
		$job_id=$this->uri->segment(3);
		$this->db->select('*');
		$this->db->from('send_invitation');
		$this->db->where('job_id', $job_id);
		if($search_string){
			$this->db->like('name', $search_string);
			$this->db->like('desc', $search_string);
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
    function store_translator($data)
    {
		$insert = $this->db->insert('send_invitation', $data);
	    return $insert;
	}

    /**
    * Update category
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_translator($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('send_invitation', $data);
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
    * Delete category
    * @param int $id - category id
    * @return boolean
    */
	function delete_translator($id){
		$this->db->where('id', $id);
		$this->db->delete('send_invitation'); 
	}
	
	
	
 
}
?>