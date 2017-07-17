<?php
class Adminmainbanner_model extends CI_Model {
 
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
    public function get_mainbanner_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('mainbanner');
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
    public function get_mainbanner($search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		//$this->db->select('category.id');
		$this->db->select('*');
		$this->db->from('mainbanner');
		
		
		if($search_string){
			$this->db->like('name', $search_string);
			$this->db->like('desc', $search_string);
		}


		$this->db->group_by('mainbanner.id');

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
    function count_mainbanner($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('mainbanner');
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

 
	function delete_mainbanner($id){
		$this->db->where('id', $id);
		$this->db->delete('mainbanner'); 
	}
	
	
	
 
}
?>