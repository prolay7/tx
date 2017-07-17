<?php
class Admincompletedjob_model extends CI_Model {

    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    public function get_completedjob($search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end, $get_pending = 1)
    {
        $this->db->select('*, b.id as bidjob_id, p3.review_stage as stage, p3.id as proofread_job_award_id');
        $this->db->from('jobpost as j');
        $this->db->join('bidjob as b', 'b.job_id = j.id');
        $this->db->join('proofread_jobs as p1', 'p1.job_id = j.id');
        $this->db->join('proofread_jobs_docs as p2', 'p2.proofread_job_id = p1.id');
        $this->db->join('proofread_jobs_awarded as p3', 'p3.proofread_doc_id = p2.id');
        $this->db->where('p3.review_stage = 3');
        $this->db->where("j.approval_status" , $get_pending);
        $this->db->where('b.awarded = 1');

        if ($search_string) {
            $this->db->where("(j.name LIKE '%$search_string%' OR j.lineNumberCode LIKE '%$search_string%')");
        }

        $this->db->order_by('p3.complete_date', 'DESC');

        $this->db->group_by('j.id');

        $this->db->limit($limit_start, $limit_end);

        $query = $this->db->get();

//        echo "DBEUG: ".$this->db->last_query();die;
        return $query->result_array();
    }


    function count_completedjob($search_string=null, $order=null, $get_pending = 1)
    {
        $this->db->select('*, b.id as bidjob_id, p3.review_stage as stage, p3.id as proofread_job_award_id');
        $this->db->from('jobpost as j');
        $this->db->join('bidjob as b', 'b.job_id = j.id');
        $this->db->join('proofread_jobs as p1', 'p1.job_id = j.id');
        $this->db->join('proofread_jobs_docs as p2', 'p2.proofread_job_id = p1.id');
        $this->db->join('proofread_jobs_awarded as p3', 'p3.proofread_doc_id = p2.id');
        $this->db->where('p3.review_stage = 3');
        $this->db->where("j.approval_status" , $get_pending);
        $this->db->where('b.awarded = 1');

        if ($search_string) {
            $this->db->where("(j.name LIKE '%$search_string%' OR j.lineNumberCode LIKE '%$search_string%')");
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



    // function store_jobpost($data)
    // {
	// 	$insert = $this->db->insert('jobpost', $data);
	//     return $insert;
	// }
    //  function store_invoice($data)
    // {
	// 	$insert=$this->db->insert('invoice', $data);
	//     return $insert;
	// }
	//  function store_reinvoice($data,$id)
    // {
	// 	$update=$this->db->update('invoice',$data,array('bid_id' =>$id));
	// 	//$this->db->update('mytable', $data, array('id' => $id));
	//     return $update;
	// }
	//    function store_message($data)
    // {
	// 	$insert=$this->db->insert('message', $data);
	//     return $insert;
	// }
    //
    // /**
    // * Update category
    // * @param array $data - associative array with data to store
    // * @return boolean
    // */
    // function update_jobpost($id, $data)
    // {
	// 	$this->db->where('id', $id);
	// 	$this->db->update('jobpost', $data);
	// 	$report = array();
	// 	$report['error'] = $this->db->_error_number();
	// 	$report['message'] = $this->db->_error_message();
	// 	if($report !== 0){
	// 		return true;
	// 	}else{
	// 		return false;
	// 	}
	// }
    //
    // /**
    // * Delete category
    // * @param int $id - category id
    // * @return boolean
    // */
	// function delete_jobpost($id){
	// 	$this->db->where('id', $id);
	// 	$this->db->delete('jobpost');
	// }



 //$this->db->where("(`name` LIKE '%$search_string%' OR `description` LIKE '%$search_string%')");
}
?>
