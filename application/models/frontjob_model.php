<?php
class Frontjob_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }
      public function get_jobpost_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('jobpost');
		$this->db->where('id', $id);
		
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    public function get_jobpost($search_string=null, $language=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {    
		$this->db->select('*');
		$this->db->from('jobpost');
		$this->db->where(array('status'=>'1','stage'=>'0'));

		if($search_string){
			$this->db->where("(name LIKE '%$search_string%' OR description LIKE '%$search_string%' )");
		}
		
		if($language!='') {
			$this->db->where('language',$language);
		}

		$this->db->group_by('jobpost.id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}

		$this->db->limit($limit_start, $limit_end);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//die;
		return $query->result_array();
		//echo "<pre>";print_r( $query->result_array()); 	
    }

    /**
    * Count the number of rows
    * @param int $manufacture_id
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_jobpost($search_string=null, $language=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('jobpost');
		$this->db->where(array('status'=>'1','stage'=>'0'));

		if($search_string){
			$this->db->where("(name LIKE '%$search_string%' OR description LIKE '%$search_string%' )");
		}
		
		if($language!='') {
			$this->db->where('language',$language);
		}
		
		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}
		
		$query = $this->db->get();
		
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
   /* function store_artist($data)
    {
		$insert = $this->db->insert('artist_image_gallery', $data);
	    return $insert;
	}*/

    /**
    * Update artist
    * @param array $data - associative array with data to store
    * @return boolean
    */
  
	

 
}
?>