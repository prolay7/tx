<?php
class Front_message_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

     public function get_messages($search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		//$this->db->select('category.id');
		$this->db->select('*');
		$this->db->from('message');
		$this->db->where(array('type'=>'0'));	
		$this->db->order_by("id", "desc");
		
		if($search_string){
			//echo $search_string; die;
			$this->db->like('name', $search_string);
			//$this->db->like('desc', $search_string);
		}


		$this->db->group_by('message.job_id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}


		$this->db->limit($limit_start, $limit_end);
		//$this->db->limit('4', '4');


		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		
		return $query->result_array(); 	
    }

  
    function count_messages($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('message');
		$this->db->where(array('type'=>'0'));	
		if($search_string){
			$this->db->like('name', $search_string);
			//$this->db->like('desc', $search_string);
		}
		$this->db->group_by('message.job_id');
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id', 'Asc');
		}
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		return $query->num_rows();        
    }
    public function get_bidjob($search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {    
	    
		//$trans_id=$this->session->userdata('translator_id');
		$job_id=$this->uri->segment(3);	
		$this->db->select('*');
		$this->db->from('message');
		$this->db->where('job_id', $job_id);
		$this->db->where('type',0); 
		  
		if($search_string){
		    //echo 'test'.$search_string;
            //die;
			$this->db->like('name', $search_string);
			$this->db->or_like('description', $search_string);
		}


		$this->db->group_by('message.id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}


		$this->db->limit($limit_start, $limit_end);
		//$this->db->limit('4', '4');


		$query = $this->db->get();
			//echo "<pre>";print_r( $query->result_array()); 
		//echo '<pre>'; echo $this->db->last_query();die;
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
		//$trans_id=$this->session->userdata('translator_id');
		$job_id=$this->uri->segment(3);
		$this->db->select('*');
		$this->db->from('message');
		$this->db->where('job_id', $job_id);
		$this->db->where('type',0); 
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
		//echo $query;die;
		//echo "<pre>";print_r( $query->result_array()); die;
		//echo $query->num_rows();die;
		return $query->num_rows();        
    }
	
	
	
	 function store_reply($data)
    {
		$insert=$this->db->insert('message', $data);
	    return $insert;
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