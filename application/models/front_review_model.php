<?php
class Front_Review_model extends CI_Model {


    public function __construct()
    {
        $this->load->database();
    }


    public function get_review($search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {

		$trans_id=$this->session->userdata('translator_id');
		$this->db->select('*');
		$this->db->from('ratings');
		$this->db->where('translator_id', $trans_id);

		if ($search_string) {
		    $this->db->like('name', $search_string);
			$this->db->or_like('description', $search_string);
		}

		$this->db->group_by('ratings.id');

		if ($order) {
			$this->db->order_by($order, $order_type);
		} else {
		    $this->db->order_by('id', $order_type);
		}


		$this->db->limit($limit_start, $limit_end);


		$query = $this->db->get();
		// echo '<pre>'; echo $this->db->last_query(); exit;
		//echo "<pre>";print_r( $query->result_array());die;
		return $query->result();
    }

    function count_review($search_string=null, $order=null)
    {
		$trans_id=$this->session->userdata('translator_id');
		$this->db->select('*');
		$this->db->from('ratings');
		$this->db->where('translator_id', $trans_id);

		//echo 'test'.$search_string;
		//die;
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
