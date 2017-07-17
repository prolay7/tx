<?php
class Admin_review_model extends CI_Model {

    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    public function createPendingJob($data) {
    	$insert_data = array(
    		"job_id" => $data['job_id'],
    		"translator_id" => $data['translator_id'],
    		"totalfiles" => $data['totalfiles'],
    		"review_stage" => 1, // pending, hiring, working, completed
    		"review_type" => 1, // pbli or provate
    		"translation_completed" => 1, // added just in case cancel is considered
    	);
    	if($this->db->insert("proofread_jobs", $insert_data)) {
    		return TRUE;
    	} else {
    		return FALSE;
    	}
    }

    public function getProofRead() {

    }

    public function get_joblist($search_string = null, $limit_start = 0, $limit_end = 10)
    {
        $this->db->select('*, proofread_jobs.id as pf_id, jobpost.id as id');
        $this->db->from('jobpost');
        $this->db->join('proofread_jobs', 'proofread_jobs.job_id = jobpost.id');
        $this->db->where("proofread_required NOT IN (-1, 0)");
        $this->db->where('jobpost.approval_status', 1);
        $this->db->group_by('jobpost.id');
        $this->db->order_by("jobpost.created", "desc");
        $this->db->limit($limit_end, $limit_start);

        if ($search_string) {
            $this->db->where("`name` LIKE '%$search_string%' OR lineNumberCode LIKE '%$search_string%'");
        }

        $query = $this->db->get();
//        echo $this->db->last_query();die;
        return $query->result_array();
    }

    public function count_joblist($search_string = null)
    {
        $this->db->select('*, proofread_jobs.id as pf_id, jobpost.id as id');
        $this->db->from('jobpost');
        $this->db->join('proofread_jobs', 'proofread_jobs.job_id = jobpost.id');
        $this->db->where("proofread_required NOT IN (-1, 0)");
        $this->db->where('jobpost.approval_status', 1);
        $this->db->group_by('jobpost.id');
        $this->db->order_by("jobpost.id", "desc");

        if($search_string){
            $this->db->where("`name` LIKE '%$search_string%' OR lineNumberCode LIKE '%$search_string%'");
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_jobpost($search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end, $review_stage = 1)
    {
        $this->db->select('*, proofread_jobs.id as pf_id');
        $this->db->from('jobpost');
        $this->db->join('proofread_jobs', 'proofread_jobs.job_id = jobpost.id');
        $this->db->where("proofread_required IN (-1, 0, 1)");
        $this->db->where('proofread_jobs.review_stage', 0);
        $this->db->where('approval_status', 0);
        $this->db->group_by('jobpost.id');
        $this->db->order_by("jobpost.id", "desc");
        $this->db->limit($limit_start, $limit_end);

	    if ($search_string) {
              $this->db->where("`name` LIKE '%$search_string%' OR lineNumberCode LIKE '%$search_string%'");
	    }

        $query = $this->db->get();
//         echo $this->db->last_query();die;
        return $query->result_array();
    }

    function count_jobpost($search_string=null, $order=null)
    {
        $this->db->select('*, proofread_jobs.id as pf_id');
        $this->db->from('jobpost');
        $this->db->join('proofread_jobs', 'proofread_jobs.job_id = jobpost.id');
        $this->db->where("review_stage", 0);
        $this->db->where("proofread_required IN (-1, 0, 1)");
        $this->db->where('proofread_jobs.review_stage', 0);
        $this->db->where('approval_status', 0);
        $this->db->order_by('jobpost.id','DESC');
        $this->db->group_by('jobpost.id');

		if($search_string){
			$this->db->where("`name` LIKE '%$search_string%' OR lineNumberCode LIKE '%$search_string%'");
		}

		$query = $this->db->get();
		return $query->num_rows();
    }

    public function get_hiringjob($search_string=null, $order=null, $order_type='DESC', $limit_start, $limit_end, $get_pending = 1)
    {
         $this->db->select('j.*');
         $this->db->from('jobpost as j');
         $this->db->join('proofread_jobs as prj', 'prj.job_id = j.id');
         $this->db->where('proofread_required > 0');
         $this->db->where(array(
             'j.stage' => '0',
             'j.approval_status' => $get_pending,
             'j.jobDone' => 0,
             'prj.translation_completed' => 0,
           //  'prj.review_stage' => 1
         ));

        // $this->db->order_by("j.date_posted", "desc");

         if ($search_string) {
             $this->db->where("j.name LIKE '%$search_string%' OR j.lineNumberCode LIKE '%$search_string%'");
         }

        $this->db->group_by('j.id');
		
		$this->db->order_by("j.id", "desc");

        $this->db->limit($limit_start, $limit_end);

        $query = $this->db->get();

//         echo $this->db->last_query();die;
        return $query->result_array();
    }


    function count_hiringjob($search_string=null, $order=null, $get_pending = 1)
    {
        $this->db->select('j.*');
        $this->db->from('jobpost as j');
        $this->db->join('proofread_jobs as prj', 'prj.job_id = j.id');
        $this->db->where(array(
          'j.stage' => '0',
          'j.approval_status' => $get_pending,
          'j.jobDone' => 0,
          'prj.translation_completed' => 0,
          'prj.review_stage' => 1
        ));

        if ($search_string) {
            $this->db->where("j.name LIKE '%$search_string%' OR j.lineNumberCode LIKE '%$search_string%'");
        }

        if ($order) {
            $this->db->order_by("j.{$order}", 'DESC');
        } else {
            $this->db->order_by('j.id', 'DESC');
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_awarded_document_summary($job_id)
    {
        $proofread_job_obj = $this->db->from('proofread_jobs')->where('job_id', $job_id)->get();

        $is_awarded_all = false;

        if ($proofread_job_obj->num_rows()) {
            $sql = "SELECT
                      count(*) AS total_doc,
                      (SELECT count(*)
                       FROM proofread_jobs_awarded
                       WHERE
                         proofread_doc_id IN (SELECT id FROM proofread_jobs_docs WHERE proofread_job_id = {$proofread_job_obj->row()->id})
                      ) AS num_doc_awarded
                    FROM proofread_jobs p1
                     JOIN proofread_jobs_docs p2 ON p2.proofread_job_id = p1.id
                    WHERE
                     p1.job_id = {$job_id}";

             $query = $this->db->query($sql);

             $row = $query->row();

             if ($row->total_doc == $row->num_doc_awarded) {
                 $is_awarded_all = true;
             }

             return $is_awarded_all;
        }
    }
}
?>
