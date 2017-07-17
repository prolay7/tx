<?php

error_reporting(0);

/**
* 
*/
class Admin_Workflownew extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
        $this->load->helper(array('form', 'url', 'path'));
        $this->load->model('workflownew_model');
	}

	 public function index(){
        if(!$this->session->userdata('is_admin')){
            redirect('admin/login');
        } else{
//echo $this->session->userdata('search_string_selected2');
            $filter_session_data="";
            $sort_type = $this->session->userdata('sort_type');
            //all the posts sent by the view  
            $years=$this->input->post('years',true);   
            $months=$this->input->post('months',true); 

            $search_string =(!empty($years))?trim($years.'-'.$months):'';
            $search_string2=$this->input->post('search_by',true);
            $order = $this->session->userdata('order'); 
            $order_type = $this->session->userdata('order_type'); 

            $per_page=$this->input->post('per_page');
            $per_page=!empty($per_page)?$per_page: $this->session->userdata('per_page_selected');
            //echo 'sdfdsfdsfsdf '.$per_page;
            //pagination settings
            $config['per_page'] =$per_page;
            $config['base_url'] = base_url().'admin/workflow';
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = 20;
            $config['full_tag_open'] = '<ul>';
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';

            //limit end
                $page = $this->uri->segment(3);

                //math to get the initial record to be select in the database
                $limit_end = ($page * $config['per_page']) - $config['per_page'];
                if ($limit_end < 0){
                    $limit_end = 0;
                } 

                $data['limit_end']=$limit_end;
                $filter_session_data['limit_end'] = $limit_end;

                //if order type was changed
                if($order_type){
                    $filter_session_data['order_type'] = $order_type;
                }
                else{
                    //we have something stored in the session? 
                    if($this->session->userdata('order_type')){
                        $order_type = $this->session->userdata('order_type');    
                    }else{
                        //if we have nothing inside session, so it's the default "Asc"
                        $order_type = 'ASC';    
                    }
                }

            //make the data type var avaible to our view
            $data['order_type_selected'] = $order_type; 

            if($search_string!='' || $search_string !== false || $search_string2 !== false || $this->uri->segment(3) == true){
                    if($order){
                        $filter_session_data['order'] = $order;
                    }
                    else{
                        $order =$this->session->userdata('order');
                    }
                    $data['order'] = $order;
                    if($search_string){
                        $filter_session_data['search_string_selected'] = $search_string;
                    }else{
                        $search_string = $this->session->userdata('search_string_selected');
                    }
                    $data['search_string_selected'] = $search_string;
                    if($search_string2){
                        $filter_session_data['search_string_selected2'] = $search_string2;
                    }else{
                        $search_string2 = $this->session->userdata('search_string_selected2');
                    }
                    $data['search_string_selected2'] = $search_string2;

                if($per_page){
                        $filter_session_data['per_page_selected'] = $per_page;
                    }else{
                        $per_page = $this->session->userdata('per_page_selected');
                    }
                    $data['per_page_selected'] = $per_page;

                    //save session data into the session
                    $this->session->set_userdata($filter_session_data);

                    $data['count_jobs']= $this->workflownew_model->count_jobs($search_string, $search_string2, $order);
                    $config['total_rows'] = $data['count_jobs'];

                    //fetch sql data into arrays
                    if($search_string){
                        if($order){
                            $data['jobs'] = $this->workflownew_model->get_jobposts($search_string, $search_string2, $order, $order_type, $per_page,$limit_end, $sort_type);
                        }else{
                            $data['jobs'] = $this->workflownew_model->get_jobposts($search_string, $search_string2, '', $order_type, $per_page,$limit_end, $sort_type);
                        }
                    }else{
                        if($order){
                            $data['jobs'] = $this->workflownew_model->get_jobposts('', '', $order, $order_type, $per_page,$limit_end, $sort_type);
                        }else{
                            $data['jobs'] = $this->workflownew_model->get_jobposts('', '', '', $order_type, $per_page,$limit_end, $sort_type);
                        }
                    }
             } else {
                //clean filter data inside section;
                $filter_session_data['search_string_selected'] = null;
                $filter_session_data['search_string_selected2'] = null;
                $filter_session_data['per_page_selected'] = null;
                $filter_session_data['order'] = null;
                $filter_session_data['order_type'] = null;
                $this->session->set_userdata($filter_session_data);

                //pre selected options
                $data['search_string_selected'] = '';
                $data['search_string_selected2'] = '';
                $data['order'] = 'id';

                //fetch sql data into arrays
                $data['count_jobs']= $this->workflownew_model->count_jobs();
                $data['jobs'] = $this->workflownew_model->get_jobposts(trim(date('Y').'-'.date('m')), '', $order_type,$per_page,$limit_end, $sort_type);
                $config['total_rows'] = $data['count_jobs'];
             }

             //initializate the panination helper
            $this->pagination->initialize($config);
            $admin_id = $this->session->userdata('admin_id');
            if($admin_id){
                $data['admin_type'] = $this->db->select('admin_type')->get_where('admin',['id' =>$admin_id])->first_row()->admin_type;
            }else{
                $data['admin_type'] = '';
            }

            $data['months']=array(''=>'Select Month','01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');
                           
            $data['years'] = array_combine(range(date('Y')-10,2050), range(date('Y')-10,2050));
            $data['per_page_data']=array('10'=>'10','50'=>'50','100'=>'100','200'=>'200','500'=>'500','1000'=>'1000','all'=>'Show All');


            $this->load->view('admin/vwAdminWorkflownew',$data); 
        }
    }
}