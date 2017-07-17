<?php
class Dashboard_model extends CI_Model {

    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    public function get_workingjob($search_string=null, $stage=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
        $this->db->select('*, bidjob.id as bidjob_id, bidjob.price as bid_price');
        $this->db->from('bidjob');
        $this->db->join('jobpost', 'jobpost.id = bidjob.job_id');
        $this->db->where('jobpost.proofread_required IN (-1, 0)');
        $this->db->where('bidjob.stage IN (1, 2)');
        $this->db->where('awarded = 1');
        $this->db->where('((is_done = 1 and is_rated = 0) or (is_done = 0 and is_rated = 1) or (is_done = 0 and is_rated = 0))');
        $this->db->order_by('bidjob.award_date', 'desc');
        $this->db->order_by("date_posted", "desc");

        if ($search_string) {
			$sql="select * from `jobpost` where `name` LIKE '%".$search_string."%' OR lineNumberCode LIKE '%".$search_string."%'";
			$query=$this->db->query($sql);

			$sql1="select * from `translator` where `first_name`='".$search_string."' ";
			$query1=$this->db->query($sql1);

			$sql2="select * from `translator` where `last_name`='".$search_string."' ";
			$query2=$this->db->query($sql2);

			if ($query->num_rows()>0) {
                foreach ($query->result_array() as $row) {
                    $ids_arr[] = $row['id'];
                }

                $ids = implode(',', $ids_arr);
                $this->db->where("bidjob.job_id IN (".$ids.")");
			} elseif ($query1->num_rows()>0) {
    			$fetch1=$query1->row();
    			$trans_id1=$fetch1->id;
    			if ($trans_id1) {
                    $this->db->where(array('bidjob.trans_id'=>$trans_id1));
    			}
			} elseif ($query2->num_rows()>0) {
    			$fetch2=$query2->row();
    			$trans_id2=$fetch2->id;
    			if ($trans_id2) {
                    $this->db->where(array('bidjob.trans_id'=>$trans_id2));
    			}
			} else {
                $time=$search_string*1440;
                $this->db->where("(`proposal` LIKE '%$search_string%' OR bidjob.`price` LIKE '%$search_string%' OR `time_need` LIKE '%$time%' )");
			}
		}

		$this->db->limit($limit_start, $limit_end);

		$query = $this->db->get();

//        echo $this->db->last_query(); exit;
		return $query->result_array();
    }

    /**
    * Count the number of rows
    * @param int $manufacture_id
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_workingjob($search_string=null,$stage=null, $order=null)
    {
        $this->db->select('*, bidjob.id as bidjob_id');
        $this->db->from('bidjob');
        $this->db->join('jobpost', 'jobpost.id = bidjob.job_id');
        $this->db->where('jobpost.proofread_required IN (-1, 0)');
		$this->db->where('bidjob.stage IN (1, 2)');
        $this->db->where('awarded = 1');
        $this->db->where('((is_done = 1 and is_rated = 0) or (is_done = 0 and is_rated = 1) or (is_done = 0 and is_rated = 0))');
        $this->db->order_by('bidjob.award_date', 'desc');

		if ($search_string) {
			$sql="select * from `jobpost` where `name` LIKE '%".$search_string."%' OR lineNumberCode LIKE '%".$search_string."%'";
			$query=$this->db->query($sql);

			$sql1="select * from `translator` where `first_name`='".$search_string."' ";
			$query1=$this->db->query($sql1);

			$sql2="select * from `translator` where `last_name`='".$search_string."' ";
			$query2=$this->db->query($sql2);

			if ($query->num_rows()>0) {
                foreach ($query->result_array() as $row) {
                    $ids_arr[] = $row['id'];
                }

                $ids = implode(',', $ids_arr);
                $this->db->where("bidjob.job_id IN (".$ids.")");
			} elseif ($query1->num_rows()>0) {
    			$fetch1=$query1->row();
    			$trans_id1=$fetch1->id;
    			if ($trans_id1) {
                    $this->db->where(array('bidjob.trans_id'=>$trans_id1));
    			}
			} elseif ($query2->num_rows()>0) {
    			$fetch2=$query2->row();
    			$trans_id2=$fetch2->id;
    			if ($trans_id2) {
                    $this->db->where(array('bidjob.trans_id'=>$trans_id2));
    			}
			} else {
                $time=$search_string*1440;
                $this->db->where("(`proposal` LIKE '%$search_string%' OR bidjob.`price` LIKE '%$search_string%' OR `time_need` LIKE '%$time%' )");
			}
		}

		$query = $this->db->get();
//		echo $this->db->last_query(); die;
		return $query->num_rows();
    }


}
?>
