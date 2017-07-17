<?php
class Adminhiringjob_model extends CI_Model {

    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }



    /*public function get_hiringjob($search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end, $get_pending = 1)
    {
        if (!is_null($search_string) and $search_string != '') {
            $where = " AND (name LIKE '%{$search_string}%' OR lineNumberCode LIKE '%{$search_string}%') ";
        }

        $sql = "SELECT j.*
                FROM jobpost j
                WHERE
                    j.stage = 0 AND
                    -- j.status = 1 AND
                    j.proofread_required IN (-1, 0) AND
                    j.approval_status = 1
                    {$where}
                GROUP BY j.id
                ORDER BY modified DESC, date_posted DESC, created DESC";

        $sql .= " LIMIT {$limit_end}, {$limit_start}";

        $query = $this->db->query($sql);

//        echo $this->db->last_query(); exit;
		return $query->result_array();
    }*/
    
    public function get_hiringjob($search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end, $get_pending = 1)
    {
        if (!is_null($search_string) and $search_string != '') {
            $where = " AND name LIKE '%{$search_string}%' OR lineNumberCode LIKE '%{$search_string}%' ";
        }

        $sql = "SELECT *
                FROM (
                    SELECT j.*
                    FROM jobpost j
                    WHERE
                        j.stage = 0 AND
                        /*(j.status = 1 OR 0) AND*/
                        j.proofread_required IN (-1, 0) AND
                        j.approval_status = 1
                        {$where}
                    GROUP BY j.id
                    -- UNION
                    -- SELECT j.*
                    -- FROM jobpost j
                    --     JOIN proofread_jobs p ON p.job_id = j.id
                    -- WHERE
                    --     j.stage = 0 AND
                    --     /*(j.status = 1 OR 0) AND*/
                    --     j.proofread_required = 1 AND
                    --     j.approval_status = 1  AND
                    --     p.review_stage = 0
                    --     {$where}
                    -- GROUP BY j.id
                ) t1
                WHERE
                    stage = 0
                ORDER BY created desc";

        $sql .= " LIMIT {$limit_end}, {$limit_start}";

        $query = $this->db->query($sql);

        // echo $this->db->last_query(); exit;
		return $query->result_array();
    }


    function count_hiringjob($search_string=null, $order=null)
    {
        if (!is_null($search_string) and $search_string != '') {
            $where = " AND (j.name LIKE '%{$search_string}%' OR j.lineNumberCode LIKE '%{$search_string}%') ";
        }

        $sql = "SELECT j.*
                FROM jobpost j
                WHERE
                    j.stage = 0 AND
                    -- j.status = 1 AND
                    j.proofread_required IN (-1, 0) AND
                    j.approval_status = 1
                    {$where}
                GROUP BY j.id";

        $query = $this->db->query($sql);

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
