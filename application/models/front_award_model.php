<?php
class Front_award_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get artist by his is
    * @param int $artist_id 
    * @return array
    */
  
    /**
    * Fetch artist data from the database
    * possibility to mix search, filter and order
    * @param int $manufacuture_id 
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_bidjob($search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {    
	    
		$trans_id=$this->session->userdata('translator_id');
		$this->db->select('*');
		$this->db->from('bidjob');
		$this->db->where('trans_id', $trans_id);
		$this->db->where('awarded',1); 
		  
		if($search_string){
		    //echo 'test'.$search_string;
            //die;
			$this->db->like('name', $search_string);
			$this->db->or_like('description', $search_string);
		}


		$this->db->group_by('bidjob.id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}


		$this->db->limit($limit_start, $limit_end);
		//$this->db->limit('4', '4');


		$query = $this->db->get();
		//echo '<pre>'; echo $this->db->last_query();
		//echo "<pre>";print_r( $query->result_array());die;
		return $query->result_array();
		
    }

    /**
    * Count the number of rows
    * @param int $manufacture_id
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_bidjob($search_string=null, $order=null)
    {
		$trans_id=$this->session->userdata('translator_id');
		$this->db->select('*');
		$this->db->from('bidjob');
		$this->db->where('trans_id', $trans_id);
		$this->db->where('awarded',1); 
		//echo 'test'.$search_string;
		//die;
		if($search_string){
			$this->db->like('name', $search_string);
			$this->db->like('description', $search_string);
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