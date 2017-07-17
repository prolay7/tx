<?php


/**
* 
*/
class Compliant_model extends CI_Model
{
	public function __construct()
    {
        $this->load->database();
    }

    public function get_all_compliants($search_string=null,$search_string2=null,$marked_as=null, $order=null, $order_type='Asc', $limit_start, $limit_end, $sort_type='ASC'){
    	$this->db->select('*');
        $this->db->from('workflow_compliants');

        $year=explode('-',$search_string)[0];
        $month=explode('-',$search_string)[1];
        $month=!empty($month)?$month:date('m');
        $year=!empty($year)?$year:date('Y');


        if((empty($search_string2) || $search_string2==null || $search_string2=='') && (empty($marked_as) || $marked_as==null || $marked_as=='')){
            $this->db->where('YEAR(date_added)', $year);
            $this->db->where('MONTH(date_added)', $month);
           
        }

        if((empty($search_string2) || $search_string2==null || $search_string2=='') && (!empty($marked_as) || $marked_as!=null || $marked_as!='')){
            $this->db->where('YEAR(date_added)', $year);
            $this->db->where('MONTH(date_added)', $month);
            if($marked_as!='all_marked'){
            	$this->db->where('marked_as', $marked_as);
            }
           
        }

        if((!empty($search_string2) || $search_string2!=null || $search_string2!='') && (!empty($marked_as) || $marked_as!=null || $marked_as!='')){
            $this->db->where('YEAR(date_added)', $year);
            $this->db->where('MONTH(date_added)', $month);
            if($marked_as!='all_marked'){
            	$this->db->where('marked_as', $marked_as);
            }
            
            $this->db->where("(line_no LIKE '%".$search_string2."%' OR job_name LIKE '%".$search_string2."%' OR compliant LIKE '%".$search_string2."%' OR answer LIKE '%".$search_string2."%')");
        }



        $this->db->order_by('line_no', $sort_type);

        if($limit_start!='all'){
          $this->db->limit($limit_start, $limit_end);  
        }

        $query = $this->db->get();

    	return $query->result();
    }

    public function count_compliants($search_string=null, $search_string2=null,$marked_as=null, $order=null)
    {
        $this->db->select('*');
        $this->db->from('workflow_compliants');
        $year=explode('-',$search_string)[0];
        $month=explode('-',$search_string)[1];
        $month=!empty($month)?$month:date('m');
        $year=!empty($year)?$year:date('Y');
        if(!empty($month) && !empty($marked_as)){
            $this->db->where('YEAR(date_added)', $year);
            $this->db->where('MONTH(date_added)', $month);
            if($marked_as!='all_marked'){
            	$this->db->where('marked_as', $marked_as);
            }
           
        }
     
        if((empty($search_string2) || $search_string2==null || $search_string2=='') && (empty($marked_as) || $marked_as==null || $marked_as=='')){
            $this->db->where('YEAR(date_added)', $year);
            $this->db->where('MONTH(date_added)', $month);
            $this->db->where('marked_as', $marked_as);
        }

        if((!empty($search_string2) || $search_string2!=null || $search_string2!='') && (!empty($marked_as) || $marked_as!=null || $marked_as!='')){
            $this->db->where('YEAR(date_added)', $year);
            $this->db->where('MONTH(date_added)', $month);
            if($marked_as!='all_marked'){
            	$this->db->where('marked_as', $marked_as);
            }
            $this->db->where("(line_no LIKE '%".$search_string2."%' OR job_name LIKE '%".$search_string2."%' OR compliant LIKE '%".$search_string2."%' OR answer LIKE '%".$search_string2."%')");
        }
        if($order){
            $this->db->order_by($order, 'ASC');
        }else{
            $this->db->order_by('id', 'ASC');
        }
        $query = $this->db->get();
        return $query->num_rows();        
    }


    public function get_comaplaint_recent(){
        $query='SELECT MAX(id) as max_id FROM workflow_compliants';
        $max_id=$this->db->query($query);
        $m=$max_id->result();
        $this->db->where('id',$m[0]->max_id);
        $query2=$this->db->get('workflow_compliants');

        return $query2->result();
    }

    public function getalltranslators(){
        $query="SELECT GROUP_CONCAT(translators) as trans FROM workflow_compliants";
        $result=$this->db->query($query);
        return $result->result();
    }

    public function gettotalcompliants(){
        $query="SELECT COUNT(*) as counted FROM workflow_compliants";
        $result=$this->db->query($query);
        return $result->result();
    }

    public function gettransalator($id){

        $this->db->where('id',$id);
		$query=$this->db->get('translator');

        return $query->result();
    }

    public function getuser($id){

        $this->db->where('id',$id);
        $query=$this->db->get('admin');

        return $query->result();
    }

    public function getratings($job_id,$trans_id){
        $this->db->where('job_id',$job_id);
        $this->db->where('translator_id',$trans_id);
        $query=$this->db->get('ratings');
        return $query->result();
    }

    public function update_rating($data=null,$condition=null){
        $this->db->where($condition);
        $insert = $this->db->update('ratings', $data);
        //return $this->db->last_query();
       return $insert;
    }

    public function insert_rating($data){
        $insert = $this->db->insert('ratings', $data);
        //return $this->db->last_query();
       return $insert;
    }
}