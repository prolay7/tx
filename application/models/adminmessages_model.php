<?php
class Adminmessages_model extends CI_Model {
 
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
      
    
	    public function get_jobmessages($search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$job_id= $this->uri->segment(2); 
		$this->db->select('*');
		$this->db->from('message');
		$this->db->where(array('job_id'=>$job_id,'type'=>'0'));	
		$this->db->order_by("id", "asc");
		
		if($search_string){
			//echo $search_string; die;
			$this->db->like('name', $search_string);
			//$this->db->like('desc', $search_string);
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
		//echo $this->db->last_query(); die;
		
		return $query->result_array(); 	
    }

  
    function count_jobmessages($search_string=null, $order=null)
    {   $job_id= $this->uri->segment(2);
		$this->db->select('*');
		$this->db->from('message');
		$this->db->where(array('job_id'=>$job_id,'type'=>'0'));	
		if($search_string){
			$this->db->like('name', $search_string);
			//$this->db->like('desc', $search_string);
		}
		$this->db->group_by('message.id');
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id', 'Asc');
		}
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		return $query->num_rows();        
    }
	
	
}
?>