<?php
class Awardjob_model extends CI_Model {

    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    public function get_awardjob($stage=null, $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    $this->db->select('bidjob.*');
		$this->db->from('bidjob');
        $this->db->join('jobpost', 'jobpost.id = bidjob.job_id');
        $this->db->join('invoice','invoice.bid_id = bidjob.id');
		$this->db->where('bidjob.awarded', 1);
		$this->db->where('bidjob.stage IN (2, 3)');
        $this->db->where('jobpost.proofread_required IN (-1, 0)');
//        $this->db->where('bidjob.is_done', 1);
//        $this->db->where('bidjob.is_rated', 1);
        $this->db->order_by('bidjob.complete_date', 'desc');
        $this->db->group_by('bidjob.id');

        if ($search_string) {
			$sql = "select * from `jobpost` where `name` LIKE '%".$search_string."%' OR lineNumberCode = '".$search_string."'";
			$query = $this->db->query($sql);

			$sql1 = "select * from `translator` where `first_name`='".$search_string."' ";
			$query1 = $this->db->query($sql1);

			$sql2 = "select * from `translator` where `last_name`='".$search_string."' ";
			$query2 = $this->db->query($sql2);

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
//		 echo $this->db->last_query();die;
		return $query->result_array();
    }


    function count_awardjob($stage=null,$search_string=null, $order=null)
    {
        $this->db->select('bidjob.*');
        $this->db->from('bidjob');
        $this->db->join('jobpost', 'jobpost.id = bidjob.job_id');
        $this->db->join('invoice','invoice.bid_id = bidjob.id');
        $this->db->where('bidjob.awarded', 1);
		$this->db->where('bidjob.stage', 3);
        $this->db->where('jobpost.proofread_required IN (-1, 0)');
//        $this->db->where('bidjob.is_done', 1);
//        $this->db->where('bidjob.is_rated', 1);
        $this->db->group_by('bidjob.id');

        if ($search_string) {
			$sql="select * from `jobpost` where `name` LIKE '%".$search_string."%' OR lineNumberCode = '".$search_string."'";
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

		// if($order){
		// 	$this->db->order_by($order, 'Asc');
		// }else{
		//     $this->db->order_by('id', 'Asc');
		// }

		$query = $this->db->get();
		return $query->num_rows();
    }

    /* Update by JBP */
 	function getJobInfo($id) {
 		$this->db->where('id',$id);
 		$this->db->select()->from('jobpost');
 		$query = $this->db->get();

 		return $query->first_row();
 	}

    function getBidders($jobID){
        $this->db->select('*,translator.id as translatorID, bidjob.id as bid_id');
        $this->db->from('bidjob');
        $this->db->join('jobpost','jobpost.id = bidjob.job_id');
        $this->db->join('translator','translator.id = bidjob.trans_id');
    	$this->db->where('job_id', $jobID);
    	$this->db->where('hiring_close_notification', 0);
    	$this->db->where('awarded', 0);

    	$query = $this->db->get();

    	return $query->result();
    }

    function updateMessage($messageInfo) {
    	$this->db->insert('notifications',$messageInfo);
    	return $this->db->insert_id();
    }
    /* End of Update */
}
?>
