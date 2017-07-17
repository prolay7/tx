<?php
class Common_model extends CI_Model {

   	public function __construct()
   	{
      parent::__construct();
   	}

   	public function get_all($table,$fiels,$mid,$order)
	{
		$this->db->select($fiels);
		$this->db->from($table);
		$this->db->order_by($mid,$order);
		$query = $this->db->get();
		return $query->result();	
	}
	
	public function get_single($fields,$table)
	{
		$this->db->select($fields);
		$this->db->from($table);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function get_single_content($fiels,$table,$db_field,$id)
	{
		$this->db->select($fiels);
		$this->db->from($table);
		$this->db->where($db_field,$id);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function get_contents($fiels,$table,$field_id,$id,$mid,$order)
	{
		$this->db->select($fiels);
		$this->db->from($table);
		$this->db->order_by($mid,$order);
		$this->db->where($field_id,$id);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function insert_content($table,$contents)
	{
		if($this->db->insert($table, $contents)) {
			echo 1;	
		} else {
			echo 0;
		}
	}
	
	public function delete_contents($table,$field_id,$id)
	{
		if($this->db->delete($table, array($field_id => $id )))
		{
			echo 1;
		} else {
			echo 0;	
		}
	}
	
	public function edit($table,$data,$id_field_table,$id,$sucess_message,$error_message)
	{
		
		$this->db->where($id_field_table, $id);
		if($this->db->update($table, $data)) {
			echo $sucess_message;
		} else {
			echo $error_message;	
		}
	}
	
	public function custom_single_result_query($query)
	{
		$query = $this->db->query($query);
		return $query->row_array();
	}
	
	public function custom_query($query)
	{
		$query = $this->db->query($query);
		return $query->result();
	}
	
	public function custom_count($query)
	{
		$query = $this->db->query($query);
		return $query->num_rows();	
	}
	
	public function check_duplicate($table,$field,$singleVariable)
	{
		$query = $this->db->get_where($table, array($field => $singleVariable));
			if ($query->num_rows() == '0') {
				echo 'true';
			} else {
				echo 'false';
		  	}
	}
	
	
}
