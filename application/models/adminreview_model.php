<?php
class Adminreview_model extends CI_Model {


    public function __construct()
    {
        $this->load->database();
    }


    public function get_average_rating($translator_id)
    {
        $sql = "SELECT TRUNCATE(sum(rating)/count(id), 2) as average_rating FROM ratings WHERE translator_id = ".$translator_id;
        $query = $this->db->query($sql);

        return $query->row();
    }

    public function get_translator_name($translator_id)
    {
        $this->db->select('*')->from('translator');
        $this->db->where('id', $translator_id);

        $query = $this->db->get();

        return $query->row();
    }

    public function get_jobs_awarded($translator_id)
    {
        $sql = "SELECT COUNT(id) as awarded FROM bidjob WHERE trans_id = ".$translator_id." AND awarded = 1";
        $query = $this->db->query($sql);

        return $query->row();
    }

    public function get_review($trans_id=null,$search_string=null, $order=null, $order_type='Asc',$limit_start, $limit_end)
    {
		$this->db->select('*');
		$this->db->from('ratings');
		$this->db->where('translator_id', $trans_id);

		if( $search_string) {
			$this->db->like('name', $search_string);
			$this->db->or_like('description', $search_string);
		}

		$this->db->group_by('ratings.id');

		if ($order) {
			$this->db->order_by($order, $order_type);
		} else {
		    $this->db->order_by('id', $order_type);
		}

		$this->db->limit($limit_start,$limit_end);

		$query = $this->db->get();
		// echo '<pre>'; echo $this->db->last_query();	die;
		return $query->result();

    }

    function count_review($trans_id,$search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('review');
		$this->db->where('translator_id', $trans_id);


		if($search_string){
			$this->db->like('name', $search_string);
			$this->db->like('description', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id', 'Asc');
		}
		$query = $this->db->get();

		return $query->num_rows();
    }


}
?>
