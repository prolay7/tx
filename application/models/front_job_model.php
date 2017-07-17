<?php
class Front_job_model extends CI_Model {

    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

     public function get_jobpost($language_from=null, $search_string=null, $order="id", $order_type='DESC', $job_type, $limit_start, $limit_end)
    {
        $this->db->select('*');
        $this->db->from('jobpost');
		$this->db->where("stage !=",2);
		$this->db->where("job_type", 0);
		$this->db->where("approval_status", 1);

        if ($job_type == 'proofreading') {
            $this->db->where('(proofreadType = "editing" or proofreadType = "comparison")');
        } elseif ($job_type == 'translation') {
            $this->db->where('(proofreadType != "editing" and proofreadType != "comparison")');
        }

		if($language_from != null && $language_from != 0){
			$this->db->where('language', $language_from);
		}


            if($search_string){

			$lan_sql="select * from `languages` where `name`='".$search_string."'";
			//echo $lan_sql;
		$lan_query=$this->db->query($lan_sql);
		$lan_num=$lan_query->num_rows();
		if ($lan_num > 0)
        {
		$lan_fetch=$lan_query->row();
		$lan_id=$lan_fetch->id;


		$this->db->where("(`language` LIKE '%".$lan_id."%')");
        }else{
		$this->db->where("(`description` LIKE '%$search_string%' OR `name` LIKE '%$search_string%' )");
		/*$this->db->like('description', $search_string);*/
		}




		}

		$this->db->group_by('jobpost.id');
        if($order != '' && $order != false) {
        $this->db->order_by($order, $order_type);
        }else{
            $this->db->order_by('id', 'DESC');
        }


		// if($order){
		// 	$this->db->order_by($order, $order_type);
		// }else{
		//     $this->db->order_by('id', $order_type);
		// }


		$this->db->limit($limit_start, $limit_end);

        $query = $this->db->get();
		// echo $this->db->last_query();
		return $query->result_array();
    }


    function count_jobpost($language_from=null,$search_string=null, $order='id', $job_type=null)
    {
		$this->db->select('*');
		$this->db->from('jobpost');
		$this->db->where("stage !=",2);
        $this->db->where("approval_status", 1);
		$this->db->where("job_type", 0);

        if ($job_type == 'proofreading') {
            $this->db->where('(proofreadType = "editing" or proofreadType = "comparison")');
        } elseif ($job_type == 'translation') {
            $this->db->where('(proofreadType != "editing" or proofreadType != "comparison")');
        }

		if($language_from != null && $language_from != 0){
			$this->db->where('language', $language_from);
		}

		if($search_string){

			$lan_sql="select * from `languages` where `name`='".$search_string."'";
		$lan_query=$this->db->query($lan_sql);
		$lan_num=$lan_query->num_rows();
		if ($lan_num > 0)
        {
		$lan_fetch=$lan_query->row();
		$lan_id=$lan_fetch->id;


		$this->db->where("(`language` LIKE '%".$lan_id."%')");
        }else{
		$this->db->where("(`description` LIKE '%$search_string%' OR `name` LIKE '%$search_string%' )");
		/*$this->db->like('description', $search_string);*/
		}




		}
		if($order != '' && $order != false) {
            $this->db->order_by($order, 'DESC');
        }else{
            $this->db->order_by('id', 'DESC');
		}
		$query = $this->db->get();
		return $query->num_rows();
    }



}
?>
