<?php
class Privatejob_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

     public function get_privatejob($search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
		$invite_id =$this->session->userdata('translator_id');
				$this->db->distinct();

				$this->db->select('job_id');
				$this->db->from('send_invitation');
				
				$this->db->where('invite_id', $invite_id);
				
				
				


		//$this->db->group_by('send_invitation.id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}


		$this->db->limit($limit_start, $limit_end);
				
								
				$query = $this->db->get();
				//echo $this->db->last_query();
				return $query->result_array();	
    } 	
	
		
		

    
    function count_privatejob($search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
				$invite_id =$this->session->userdata('translator_id');
				$this->db->distinct();
				
				$this->db->select('job_id');
				$this->db->from('send_invitation');
				
				$this->db->where('invite_id', $invite_id);
				
				
				if($order){
				$this->db->order_by($order, 'Asc');
				}else{
				$this->db->order_by('id', 'Asc');
				}
				$query = $this->db->get();
				
 
				return $query->num_rows();      
           
    } 	
	}
				//

?>