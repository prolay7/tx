<?php



/**

* 

*/

class Workflow_model extends CI_Model

{

	public function __construct()
    {
        $this->load->database();
    }

    public function add_work_flow_data($data){

    	$insert = $this->db->insert('workflow', $data);

	    return $insert;

    }

    public function update_work_flow_data($data,$condition){

    	$this->db->where($condition);

    	$updated=$this->db->update('workflow', $data);

	    return $updated;
    }

    public function get_workflow(){



    	$this->db->select('*');

    	$this->db->from('workflow');



    	/*if ($search_string){

    		//$this->db->where("(`price` LIKE '$search_string')");

    		$this->db->where('created_date',$search_string);

    	}



        if($payment_status!='') {

			//echo $payment_status;die;

			//$this->db->where('payment',$payment_status);

		}





    	$this->db->limit($limit_start, $limit_end);*/

    	$query = $this->db->get();



    	return $query->result();
    }

    public function get_all_jobs($condition='',$order='DESC',$order_by='',$group_by='',$offset=0,$limit_start='',$limit_end=''){

    	if($condition!=''){

    		$this->db->where($condition);

    	}



    	if($order_by!=''){

    		$this->db->order_by($order_by, $order);

    	}



    	if($group_by!=''){

    		$this->db->group_by('id');

    	}
    }


    public function get_jobs($condition=''){

    	if($condition!=''){

    		$this->db->where($condition);

    	}



    	$this->db->order_by('id', 'desc');

        $this->db->group_by('id');

    

    	$query=$this->db->get('jobpost');

    	return $query->result();
    }

    public function gettransalator($condition){

    	$this->db->where($condition);

    	$query=$this->db->get('translator');

    	return $query->result();
    }

    public function getbidjobs($condition){

    	$this->db->where($condition);

    	$query=$this->db->get('bidjob');

    	return $query->result();
    }

    public function getlanguages($condition){

    	$this->db->where($condition);

    	$query=$this->db->get('languages');

    	return $query->result();
    }


//10-05-17
    public function get_jobposts($search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
        
        //$this->db->select('category.id');
        $this->db->select('*');
        $this->db->from('jobpost');
        
        $year=explode('-',$search_string)[0];
        $month=explode('-',$search_string)[1];
        if(!empty($month)){
            $this->db->where('YEAR(created)', $year);
            $this->db->where('MONTH(created)', $month);
        }


        $this->db->group_by('jobpost.id');

        if($order){
            $this->db->order_by($order, $order_type);
        }else{
            $this->db->order_by('id', $order_type);
        }


        $this->db->limit($limit_start, $limit_end);
        //$this->db->limit('4', '4');


        $query = $this->db->get();
        //echo '<pre>'; print_r($query->result_array()); die;
        //echo $this->db->last_query();die;
        return $query->result();  
    }


    public function count_jobs($search_string=null, $order=null)
    {
        $this->db->select('*');
        $this->db->from('jobpost');
        $year=explode('-',$search_string)[0];
        $month=explode('-',$search_string)[1];
        if(!empty($month)){
            $this->db->where('YEAR(created)', $year);
            $this->db->where('MONTH(created)', $month);
        }
        if($order){
            $this->db->order_by($order, 'DESC');
        }else{
            $this->db->order_by('id', 'DESC');
        }
        $query = $this->db->get();
        return $query->num_rows();        
    }


}