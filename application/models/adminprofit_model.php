<?php
class Adminprofit_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }
      
    public function get_awardjob($search_string=null, $stage=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		//$job_id= $this->uri->segment(3);
		$this->db->select('*');
		$this->db->from('bidjob');
		$this->db->where(array('awarded'=>'1'));
		$this->db->order_by("id", "desc");
		
		if($search_string){
			 $this->db->where("(`proposal` LIKE '%$search_string%' OR `price` LIKE '%$search_string%' OR `time_need` LIKE '%$search_string%' )");
		}
        if($stage!='') {
			$this->db->where('stage',$stage);
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
		//echo $this->db->last_query(); die;
		
		return $query->result_array(); 	
    }

    /**
    * Count the number of rows
    * @param int $manufacture_id
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_awardjob($search_string=null,$stage=null, $order=null)
    {   //$job_id= $this->uri->segment(3);
		$this->db->select('*');
		$this->db->from('bidjob');
		$this->db->where(array('awarded'=>'1'));
		if($search_string){
			$this->db->where("(`proposal` LIKE '%$search_string%' OR `price` LIKE '%$search_string%' OR `time_need` LIKE '%$search_string%' )");
		}
		if($stage!='') {
			$this->db->where('stage',$stage);
		}
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