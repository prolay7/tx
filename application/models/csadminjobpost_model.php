<?php
class Csadminjobpost_model extends CI_Model {

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
    public function get_jobpost_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('jobpost');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array();
    }

public function get_jobpost($csCreator,$search_string=null, $order=null, $order_type='Desc', $limit_start, $limit_end, $get_pending = 1, $isProofreadJob = 0)
    {
	    $this->db->select('*');
		$this->db->from('jobpost');
		$this->db->order_by("created", "desc");
        $this->db->order_by('approval_status', 'asc');
		$this->db->where("csCreator" , $csCreator);
		//$this->db->where("approval_status" , $get_pending);

		$this->db->where("isProofreadJob", $isProofreadJob);

		if($search_string){
			//$this->db->like('description', $search_string);
			$this->db->where("(`name` LIKE '%$search_string%' or `lineNumberCode` LIKE '%$search_string%')");
		}

		$this->db->group_by('jobpost.id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('modified', $order_type);
		}


		$this->db->limit($limit_start, $limit_end);

        $query = $this->db->get();
		// echo $this->db->last_query();die;
		return $query->result_array();
    }

    function count_jobpost($csCreator,$search_string=null, $order=null, $get_pending = 1, $isProofreadJob = 0)
    {
		$this->db->select('*');
		$this->db->from('jobpost');
		$this->db->where("csCreator" , $csCreator);
		$this->db->where("isProofreadJob", $isProofreadJob);
		if($search_string){
			//$this->db->like('description', $search_string);
			$this->db->where("(`name` LIKE '%$search_string%' or `lineNumberCode` LIKE '%$search_string%')");
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();
    }


    function store_jobpost($data)
    {
		$insert = $this->db->insert('jobpost', $data);
	    return $insert;
	}
     function store_invoice($data)
    {
		$insert=$this->db->insert('invoice', $data);
	    return $insert;
	}
	 function store_reinvoice($data,$id)
    {
		$update=$this->db->update('invoice',$data,array('bid_id' =>$id));
		//$this->db->update('mytable', $data, array('id' => $id));
	    return $update;
	}
	   function store_message($data)
    {
		$insert=$this->db->insert('message', $data);
	    return $insert;
	}

    /**
    * Update category
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_jobpost($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('jobpost', $data);
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
	function delete_jobpost($id){
		$this->db->where('id', $id);
		$this->db->delete('jobpost');
	}



 //$this->db->where("(`name` LIKE '%$search_string%' OR `description` LIKE '%$search_string%')");
}
?>
