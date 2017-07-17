<?php
class Front_invoice_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }
      
    public function get_invoice($search_string=null, $stage=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$trans_id= $this->session->userdata('translator_id');
		$this->db->select('*');
		$this->db->from('bidjob');
		$this->db->where(array('awarded'=>'1','trans_id' =>$trans_id,'stage' => 2));
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
		//echo'<pre>'; print_r($query->result_array());die;
		
		return $query->result_array(); 	
    }

    function getTotalReceivable(){

    	$this->db->select()->from('invoice');
    	$this->db->join('bidjob','bidjob.id = invoice.bid_id');
    	$this->db->where('invoice.trans_id', $this->session->userdata('translator_id'));
    	$this->db->where('awarded',1);
    	$this->db->where('payment',0);
	   	$query = $this->db->get();

    	return $query->result();
    }

   	function fetchMyInvoices($num = 10, $start, $search_string = null, $payment_status = null, $dueFrom = null, $dueTo = null,$order_direction = 'DESC'){

    	if ($dueFrom){
 
 			$dateToConvert = strtotime($dueFrom);	
    		$dateFromNew = date( 'Y-m-d H:i:s', $dateToConvert );
    		$dateToConvert = strtotime($dueTo);
    		$dateToNew = date( 'Y-m-d H:i:s', $dateToConvert );

			$this->db->where('date_add(complete_date, INTERVAL 31 DAY) >=', $dateFromNew);
			$this->db->where('date_add(complete_date, INTERVAL 31 DAY) <=', $dateToNew);
			$this->db->where('payment',0);

			$this->db->order_by('complete_date',"ASC");

		} else {

	    	if ($search_string){
	    		$this->db->like('name',$search_string);
	    		$this->db->or_like('invoice_id',$search_string);
	    	}

	    	if ($payment_status){
	    		$this->db->where('payment',$payment_status);
	    	}

		}

    	$this->db->select('*, bidjob.trans_id AS bidjobID, bidjob.price AS bidjobprice')->from('invoice')->limit($num,$start);
    	$this->db->join('bidjob','bidjob.id = invoice.bid_id');
		$this->db->join('jobpost','jobpost.id = invoice.job_id');
		
    	$trans_id= $this->session->userdata('translator_id');
		$this->db->where('invoice.trans_id', $trans_id);
        $this->db->where('is_deleted', 0);
        $this->db->order_by('invoice.payment_date',$order_direction);
	   	$query = $this->db->get();

    	return $query->result();
    }

    function getTotalNumberOfMyInvoices ($search_string = null, $payment_status = null, $dueFrom = null, $dueTo = null){

    	if ($dueFrom){

 			$dateToConvert = strtotime($dueFrom);	
    		$dateFromNew = date( 'Y-m-d H:i:s', $dateToConvert );
    		$dateToConvert = strtotime($dueTo);
    		$dateToNew = date( 'Y-m-d H:i:s', $dateToConvert );

			$this->db->where('date_add(complete_date, INTERVAL 31 DAY) >=', $dateFromNew);
			$this->db->where('date_add(complete_date, INTERVAL 31 DAY) <=', $dateToNew);
			$this->db->where('payment',0);
			
		} else {

	    	if ($search_string){
	    		$this->db->like('name',$search_string);
	    		$this->db->or_like('invoice_id',$search_string);
	    	}

	    	if ($payment_status){
	    		$this->db->where('payment',$payment_status);
	    	}

		}

    	$this->db->select('*, bidjob.trans_id AS bidjobID')->from('invoice');
    	$this->db->join('bidjob','bidjob.id = invoice.bid_id');
    	$this->db->join('jobpost','jobpost.id = invoice.job_id');
    	$trans_id= $this->session->userdata('translator_id');
		
		$this->db->where('invoice.trans_id', $trans_id);
        $this->db->where('is_deleted', 0);

    	$query = $this->db->get();    	

    	return $query->num_rows();
    }

    function fetchMyInvitations($num = 0, $start = 0){

    	$this->db->select()->from('send_invitation');
    	$this->db->join('invite','invite.id = send_invitation.invite_id');
    	//$this->db->join('jobpost','jobpost.id = send_invitation.job_id');
    	$query = $this->db->get();

    	return $query->result();
    }

    function getTotalNumberOfMyInvitations(){

    	$this->db->select()->from('send_invitation');
    	$this->db->join('invite','invite.id = send_invitation.invite_id');
    	//$this->db->join('jobpost','jobpost.id = send_invitation.job_id');
    	$query = $this->db->get();

    	return $query->num_rows();
    }

    function getBidInfo($bidID) {
    	$this->db->where('id', $bidID);
    	$this->db->select()->from('bidjob');
    	$query = $this->db->get();

    	return $query->first_row();
    }

    /**
    * Count the number of rows
    * @param int $manufacture_id
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_invoice($search_string=null,$stage=null, $order=null)
    {  $trans_id= $this->session->userdata('translator_id');
		
		$this->db->select('*');
		$this->db->from('bidjob');
		$this->db->where(array('awarded'=>'1','trans_id' =>$trans_id,'stage' => 2));
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