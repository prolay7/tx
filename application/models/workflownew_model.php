<?php

/**
* 
*/
class Workflownew_model extends CI_Model
{
	
	public function __construct()
    {
        $this->load->database();
    }

    public function get_jobposts($search_string=null,$search_string2=null, $order=null, $order_type='Asc', $limit_start, $limit_end, $sort_type='ASC')
    {
        
        //$this->db->select('category.id');
        $this->db->select('*');
        $this->db->from('workflow_data');
        
        $year=explode('-',$search_string)[0];
        $month=explode('-',$search_string)[1];
        $month=!empty($month)?$month:date('m');
        $year=!empty($year)?$year:date('Y');
        if(!empty($month)){
            $this->db->where('YEAR(created)', $year);
            $this->db->where('MONTH(created)', $month);
        }
        if(!empty($month) && empty($search_string2) || $search_string2==null || $search_string2==''){
            $this->db->where('YEAR(created)', $year);
            $this->db->where('MONTH(created)', $month);
        }

        if(!empty($month) && !empty($search_string2) || $search_string2!=null || $search_string2!=''){
            $this->db->where('YEAR(created)', $year);
            $this->db->where('MONTH(created)', $month);
            $this->db->where("(lineNumber LIKE '%".$search_string2."%' OR name LIKE '%".$search_string2."%')");
        }

        $this->db->group_by('workflow_data.id');

        /*if($order){
            $this->db->order_by($order, $order_type);
        }else{
            $this->db->order_by('id', $order_type);
        }*/

        $this->db->order_by('lineNumber', $sort_type);

        if($limit_start!='all'){
          $this->db->limit($limit_start, $limit_end);  
        }
        
        //$this->db->limit('4', '4');


        $query = $this->db->get();
        //echo '<pre>'; print_r($query->result_array()); die;
        //echo $this->db->last_query();//die;
        return $query->result();  
    }


    public function count_jobs($search_string=null, $search_string2=null, $order=null)
    {
        $this->db->select('*');
        $this->db->from('workflow_data');
        $year=explode('-',$search_string)[0];
        $month=explode('-',$search_string)[1];
        $month=!empty($month)?$month:date('m');
        $year=!empty($year)?$year:date('Y');
        if(!empty($month)){
            $this->db->where('YEAR(created)', $year);
            $this->db->where('MONTH(created)', $month);
        }
        if(!empty($month) && empty($search_string2) || $search_string2==null || $search_string2==''){
            $this->db->where('YEAR(created)', $year);
            $this->db->where('MONTH(created)', $month);
        }

        if(!empty($month) && !empty($search_string2) || $search_string2!=null || $search_string2!=''){
            $this->db->where('YEAR(created)', $year);
            $this->db->where('MONTH(created)', $month);
            $this->db->where("(lineNumber LIKE '%".$search_string2."%' OR name LIKE '%".$search_string2."%')");
        }
        if($order){
            $this->db->order_by($order, 'ASC');
        }else{
            $this->db->order_by('id', 'ASC');
        }
        $query = $this->db->get();
        return $query->num_rows();        
    }

    public function get_by_column($column){
    	$this->db->where('stage_column',$column);
    	$query=$this->db->get('workflow_stages');
    	return $query->result();
    }

    public function max_column_order(){
       $query=$this->db->query("SELECT MAX(stage_order) as wid FROM `workflow_stages`"); 
       
       return $query->result();
    }


    public function get_last_column_in_table(){
    	$query=$this->db->query("SELECT COLUMN_NAME, ORDINAL_POSITION FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'tx' AND TABLE_NAME ='workflow_data' ORDER BY ORDINAL_POSITION DESC LIMIT 1");
    	return $query->result()[0]->COLUMN_NAME;

    }

    public function add_new_column($column,$color,$stage_order){
    	$query=$this->db->query('ALTER TABLE `workflow_data` ADD `'.$column.'` VARCHAR(255) NOT NULL AFTER `'.$this->get_last_column_in_table().'`;');
    	if($query){
    		$this->db->insert('workflow_stages',array('stage_column'=>$column,'stage_name'=>$column,'stage_color'=>$color,'stage_order'=>$stage_order));
    		return true;
    	} else{
    		return false;
    	}
    }

    public function update_column($column_old,$column_new,$color){

      	$query=$this->db->query('ALTER TABLE `workflow_stages` CHANGE `'.$column_old.'` `'.$column_new.'` VARCHAR(255) NOT NULL;');
    	
    	if($query){
    		$this->db->where('stage_name',$column_old);
    		$this->db->update('workflow_stages',array('stage_name'=>$column_new,'stage_color'=>$color));
    		return true;
    	} else{
    		return false;
    	}
    }

    public function delete_column($column){
    	$query=$this->db->query('ALTER TABLE `workflow_data` DROP `'.$column.'`;');
    	if($query){
    		$this->db->where('stage_name',$column);
    		$this->db->delete('workflow_stages');
    		return true;
    	}else{
    		return flase;
    	}
    }


    public function get_show_hide(){
        $this->db->where('title','show_hide');
        $result=$this->db->get('settings');
        return $result->result();
    }

    public function getlanguages($condition){
        $this->db->where($condition);
        $query=$this->db->get('languages');
        return $query->result();
    }

    public function getbidjobs($condition){
        $this->db->where($condition);
        $query=$this->db->get('bidjob');
        return $query->result();
    }

    public function gettransalator($condition){
        $this->db->where($condition);
        $query=$this->db->get('translator');
        return $query->result();
    }

    public function getStages(){
    	$this->db->order_by('stage_order');
    	$query=$this->db->get('workflow_stages');
        return $query->result();
    }
}