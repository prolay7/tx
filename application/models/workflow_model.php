<?php



/**

* 

*/

class Workflow_model extends CI_Model

{

    public function __construct()
    {
        $this->load->database();
    }

    public function add_work_flow_data($data){

        $insert = $this->db->insert('workflow', $data);

        return $insert;

    }

    public function update_work_flow_data($data,$condition){

        $this->db->where($condition);

        $updated=$this->db->update('workflow', $data);

        return $updated;
    }

    public function get_workflow(){



        $this->db->select('*');

        $this->db->from('workflow');



        /*if ($search_string){

            //$this->db->where("(`price` LIKE '$search_string')");

            $this->db->where('created_date',$search_string);

        }



        if($payment_status!='') {

            //echo $payment_status;die;

            //$this->db->where('payment',$payment_status);

        }





        $this->db->limit($limit_start, $limit_end);*/

        $query = $this->db->get();



        return $query->result();
    }

    public function get_all_jobs($condition='',$order='DESC',$order_by='',$group_by='',$offset=0,$limit_start='',$limit_end=''){

        if($condition!=''){

            $this->db->where($condition);

        }



        if($order_by!=''){

            $this->db->order_by($order_by, $order);

        }



        if($group_by!=''){

            $this->db->group_by('id');

        }
    }


    public function get_jobs($condition=''){

        if($condition!=''){

            $this->db->where($condition);

        }



        $this->db->order_by('id', 'desc');

        $this->db->group_by('id');

    

        $query=$this->db->get('jobpost');

        return $query->result();
    }

    public function gettransalator($condition){

        $this->db->where($condition);

        $query=$this->db->get('translator');

        return $query->result();
    }

    public function getbidjobs($condition){

        $this->db->where($condition);

        $query=$this->db->get('bidjob');

        return $query->result();
    }

    public function getlanguages($condition){

        $this->db->where($condition);

        $query=$this->db->get('languages');

        return $query->result();
    }


//10-05-17
    public function get_jobposts($search_string=null,$search_string2=null, $order=null, $order_type='Asc', $limit_start, $limit_end, $sort_type='ASC')
    {
        
        //$this->db->select('category.id');
        $this->db->select('*');
        $this->db->from('jobpost');
        
        $year=explode('-',$search_string)[0];
        $month=explode('-',$search_string)[1];
        $month=!empty($month)?$month:date('m');
        $year=!empty($year)?$year:date('Y');
        
        if(empty($search_string2) || $search_string2==null || $search_string2==''){
            $this->db->where('YEAR(created)', $year);
            $this->db->where('MONTH(created)', $month);
        }

        if(!empty($search_string2) || $search_string2!=null || $search_string2!=''){
            $this->db->where('YEAR(created)', $year);
            $this->db->where('MONTH(created)', $month);
            $this->db->where("(lineNumber LIKE '%".$search_string2."%' OR name LIKE '%".$search_string2."%')");
        }

        $this->db->group_by('jobpost.id');

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
        //echo $this->db->last_query();die;
        return $query->result();  
    }


    public function count_jobs($search_string=null, $search_string2=null, $order=null)
    {
        $this->db->select('*');
        $this->db->from('jobpost');
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


    public function get_workflow_edited_columns($stage_column){
        $this->db->select('*');
        $this->db->from('workflow_edited');
        //$this->db->where('data_month',3);
        $this->db->where('stage_column',$stage_column);
        $this->db->order_by('stage_order', 'ASC');
        //$this->db->group_by('stage_column');
       // $this->db->group_by('data_month');
        $query=$this->db->get();
        //echo $this->db->last_query();die;
        return $query->result();
    }

    public function get_stage_name($stage_column){
        $this->db->select('*');
        $this->db->where('stage_column',$stage_column);
        $query=$this->db->get('workflow_edited');
        return $query->result();
    }
    public function get_cell_data($data_id,$stage_column,$stage_cell){
        $this->db->select('*');
        $this->db->where('data_id',$data_id);
        $this->db->where('stage_column',$stage_column);
        $this->db->where('stage_cell',$stage_cell);
        $query=$this->db->get('workflow_edited');
        //echo $this->db->last_query();die;
        return $query->result();
    }


//11-05-17
    public function get_distinct_column(){
        $query=$this->db->query("SELECT DISTINCT(stage_column) FROM `workflow_edited` ORDER BY `stage_order` ASC");
        return $query->result();
    }

    public function get_count_distinct_column(){
        $query=$this->db->query('SELECT COUNT(DISTINCT(stage_column)) as total FROM `workflow_edited` ORDER BY `stage_order` ASC');
        return $query->result()[0]->total;
    }

    PUBLIC function get_max_sort_order(){
        $query=$this->db->query('SELECT MAX(DISTINCT(stage_order)) as max FROM `workflow_edited` ORDER BY `stage_order` ASC');
        return $query->result()[0]->max;
    }

    public function get_cell_data_by_cell_column($column,$cell='',$data_id=''){

        $this->db->where('stage_column',$column);
        if($cell!=''){
          $this->db->where('stage_cell',$cell);  
        }
        if($data_id!=''){
            $this->db->where('data_id',$data_id); 
        }
        
        $query=$this->db->get('workflow_edited');
        return $query->result();
    }

    public function count_stage_column_by_key($key){
        $query=$this->db->query("SELECT count(*) as counted FROM `workflow_edited` where stage_column='".$key."'");
        return $query->result()[0]->counted;
    }


    public function add_stage_data($data){
        $insert = $this->db->insert('workflow_edited', $data);
        return $insert;
    }

    public function last_stage_column($condition=''){
        if($condition!=''){
           $query=$this->db->query("SELECT MAX(wid) as wid FROM `workflow_edited` WHERE `stage_cell`='".$condition."'"); 
        } else{
            $query=$this->db->query("SELECT MAX(wid) as wid FROM `workflow_edited`"); 
        }
        
        return $query->result();

    }


    public function update_stage_data($data,$condition){
        $this->db->where($condition);
        $updated=$this->db->update('workflow_edited', $data);
        return $this->db->last_query();//$updated;
    }

    public function delete_stage_data($condition){
        $this->db->where($condition);
        $deleted=$this->db->delete('workflow_edited');
        return $deleted;
    }

    public function get_stage($condition){
        $this->db->where($condition);
        $query=$this->db->get('workflow_edited');
        return $query->result();
    }

    //14-05-17
    public function get_stage_column_no(){
        $query=$this->db->query("SELECT MAX(`stage_column_no`) as max_stage_column_no FROM `workflow_edited`");
        return $query->result()[0]->max_stage_column_no;
    }

    public function get_show_hide(){
        $this->db->where('title','show_hide');
        $result=$this->db->get('settings');
        return $result->result();
    }

    //17-05-17
    public function get_order($column){
        $this->db->where('stage_column',$column);
        $result=$this->db->get('workflow_edited');
        return $result->result();
    }

    //19-05-17
    public function get_stage_attributes($id){
        $this->db->where('stage_id',$id);
        $result=$this->db->get('workflow_stage_data_attributes');
        return $result->result();
    }

    public function get_stage_attributes_byname($name){
        $this->db->where('attr_name',$name);
        $result=$this->db->get('workflow_stage_data_attributes');
        return $result->result();
    }


    public function get_stage_max_attribute(){
        $query=$this->db->query("SELECT MAX(`attr_value`) as attr_value FROM `workflow_stage_data_attributes`");
        return $query->result()[0]->attr_value;
    }

    public function add_stage_attribute($data){
        $insert = $this->db->insert('workflow_stage_data_attributes', $data);
        return $insert;
    }

    public function update_stage_attribute($data,$condition){
        $this->db->where($condition);
        $insert = $this->db->update('workflow_stage_data_attributes', $data);
        return $insert;
    }

    public function delete_stage_attribute($condition){
        $this->db->where($condition);
        $insert = $this->db->delete('workflow_stage_data_attributes');
        return $insert;
    }


    //12-07-17


    public function get_prev_priority($stage_order,$stage_cell=''){
        //$result=$this->db->query("SELECT * FROM workflow_edited WHERE stage_priority=1 AND stage_cell='".$stage_cell."' AND stage_data=1 AND stage_order<".$stage_order);
        $result=$this->db->query("SELECT * FROM workflow_edited WHERE stage_order<".$stage_order." GROUP BY stage_order");
        return $result->result();
    }

    public function get_prev_priority2($wid){
        $result=$this->db->query("SELECT * FROM workflow_edited WHERE wid=".$wid);
        return $result->result();
    }

    public function get_next_priority($stage_order){
        $result=$this->db->query('SELECT * FROM workflow_edited WHERE stage_priority=1 AND stage_order>'.$stage_order);
        return $result->result();
    }


   public function get_data_by_line_data_id($data_id,$line_no,$column){
       // $result=$this->db->query('SELECT * FROM workflow_edited WHERE data_line_number='.$line_no.' AND data_id='.$data_id.' AND stage_column="'.$column.'"');
        $result=($data_id!='')?$this->db->query('SELECT * FROM workflow_edited WHERE data_id='.$data_id.' AND data_line_number='.$line_no.' GROUP by stage_cell'):$this->db->query('SELECT * FROM workflow_edited WHERE data_line_number='.$line_no.' GROUP by stage_cell');
        return $result->result();
    }

    public function get_min_wid(){
        $result=$this->db->query('SELECT min(wid) as min_wid FROM workflow_edited');
        return $result->result();
    }

    //12-07-17


    //13-07-17
    public function add_client_compliant($data){
        $insert = $this->db->insert('workflow_compliants', $data);
        return $insert;
    }

    public function update_client_compliant($data,$condition){
        $this->db->where($condition);
        $insert = $this->db->update('workflow_compliants', $data);
        return $insert;
    }

    public function get_compliant_by_lineno($line_no){
        $this->db->where('line_no',$line_no);
        $result=$this->db->get('workflow_compliants');
        return $result->result();
    }


}