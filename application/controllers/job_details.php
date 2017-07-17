<?php if (!defined('BASEPATH')) die();
class Job_details extends CI_Controller {
	
	function __construct()	
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('front_job_model');
	}
		
	public function index()
	{
		    $job_id = $this->uri->segment(3);
            //echo $alias; die;
            $sql = "SELECT *, j.id AS id, j.created AS created, p1.id AS proofread_job_id FROM jobpost j";
            $sql .= " LEFT JOIN proofread_jobs p1 ON p1.job_id = j.id ";
            $sql .= "WHERE j.id = '" . $job_id . "' ";
           
            $val = $this->db->query($sql);
            //echo $sql;
            $data['results'] = $val->result_array();
		$this->load->view('translator/view_job_details', $data);
		//echo $this->uri->segment(3);
	}

}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
