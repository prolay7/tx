<?php
class Adminworkingjob_model extends CI_Model {

    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    public function get_workingjob($search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end, $get_pending = 1)
    {
         $this->db->select('j.*, b.id as bid_id, b.*');
         $this->db->from('jobpost as j');
         $this->db->join('proofread_jobs as prj', 'prj.job_id = j.id');
         $this->db->join('bidjob as b', 'b.job_id = j.id');
         $this->db->where('prj.review_stage', 2);
         $this->db->where('(b.is_done != 1 OR b.is_rated != 1)');
         $this->db->where(array(
            'b.awarded' => 1,
            'j.approval_status' => $get_pending
         ));

         $this->db->order_by("b.award_date", "desc");

         if ($search_string) {
             $this->db->where("j.name LIKE '%$search_string%' OR j.lineNumberCode LIKE '%$search_string%'");
         }

	     $this->db->limit($limit_start, $limit_end);

         $query = $this->db->get();

         if ($query->num_rows) {
             $result = $query->result_array();
         } else {
             $result = null;
         }

//	      echo $this->db->last_query();die;
	     return $result;
    }

    function count_workingjob($search_string=null, $order=null, $get_pending = 1)
    {
        $this->db->select('j.*, b.id as bid_id, b.*');
        $this->db->from('jobpost as j');
        $this->db->join('proofread_jobs as prj', 'prj.job_id = j.id');
        $this->db->join('bidjob as b', 'b.job_id = j.id');
        $this->db->where('prj.review_stage', 2);
        $this->db->where('(b.is_done != 1 OR b.is_rated != 1)');
        $this->db->where(array(
            'b.awarded' => 1,
            'j.approval_status' => $get_pending
        ));

        if ($search_string) {
            $this->db->where("j.name LIKE '%$search_string%' OR j.lineNumberCode LIKE '%$search_string%'");
        }

        if ($order) {
            $this->db->order_by("j.{$order}", 'DESC');
        } else {
            $this->db->order_by('b.award_date', 'DESC');
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    /* JBP */
    function getLanguageInfo($languageID)
    {
        $this->db->where('id',$languageID);
        $this->db->select()->from('languages');
        $query = $this->db->get();

        return $query->first_row();
    }

   	/* JBP */

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
