<?php
class Banner_model extends CI_Model {
 
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
    public function get_banner_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('banner');
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
    public function get_banner($search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		//$this->db->select('category.id');
		$this->db->select('*');
		$this->db->from('banner');
		
		if($search_string){
			$this->db->like('title', $search_string);
			
		}


		$this->db->group_by('banner.id');

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
    function count_banner($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('banner');
		if($search_string){
			$this->db->like('title', $search_string);
			
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
    function store_banner($data)
    {
		$insert = $this->db->insert('banner', $data);
	    return $insert;
	}

    /**
    * Update category
    * @param array $data - associative array with data to store
    * @return boolean
    */
   

    /**
    * Delete category
    * @param int $id - category id
    * @return boolean
    */
	function update_banner($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('banner', $data);
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
	function delete_banner($id){
		$this->db->where('id', $id);
		$this->db->delete('banner'); 
	}
	
	
 
}
?>