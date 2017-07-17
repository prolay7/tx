<?php
class Adminbidjob_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

   
   public function get_bidjob($search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {	
	    $job_id= $this->uri->segment(2);     
	    $this->db->select('*');        
		$this->db->from('bidjob');
		$this->db->where(array('job_id'=>$job_id));
		$this->db->order_by("id", "desc");
		
		if($search_string){
			 $this->db->where("(`proposal` LIKE '%$search_string%' OR `price` LIKE '%$search_string%' OR `time_need` LIKE             '%$search_string%' )");
		}

		$this->db->group_by('bidjob.id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}


		$this->db->limit($limit_start, $limit_end);

        $query = $this->db->get();
		//echo $this->db->last_query();die;
		return $query->result_array(); 	
    }

    
    function count_bidjob($search_string=null, $order=null)
    {
		$job_id= $this->uri->segment(2);  
		$this->db->select('*');		
		$this->db->from('bidjob');
		$this->db->where(array('job_id'=>$job_id));		
	    
		 
		if($search_string){
			 $this->db->where("(`proposal` LIKE '%$search_string%' OR `price` LIKE '%$search_string%' OR `time_need` LIKE             '%$search_string%' )");
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }  



    function store_bidjob($data)
    {
		$insert = $this->db->insert('bidjob', $data);
	    return $insert;
	}

   
    function update_bidjob($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('bidjob', $data);
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
	function delete_bidjob($id){
		$this->db->where('id', $id);
		$this->db->delete('bidjob'); 
	}
	
	
	
       // $this->db->from('bidjob');
		//$this->db->where(array('job_id'=>$job_id));
		//$this->db->order_by("id", "desc");
}
?>