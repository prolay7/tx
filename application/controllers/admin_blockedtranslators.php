<?php error_reporting(0);
error_reporting(0);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
* 
*/
class Admin_blockedtranslators extends CI_Controller
{
	
	public function __construct()
    {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
        $this->load->model('adminblockedtranslator_model');
        $this->load->model('adminreview_model');
        if(!$this->session->userdata('is_admin')){
            redirect('admin/login');
        }
		//echo '<pre>'; print_r($this->session->userdata);
    }

    public function index()
    {

        $filter_session_data="";
        //all the posts sent by the view
        $language= $this->input->post('language',true);
        $search_string = trim($this->input->post('search_string',true));
        $order = $this->input->post('order',true);
        $order_type = $this->input->post('order_type',true);
        $job_id_no=$this->uri->segment(2);
        //pagination settings
        $config['per_page'] = 3;
        $config['base_url'] = base_url().'admin_blocked_translators/'.$job_id_no;
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

       if($order_type){
            $filter_session_data['order_type'] = $order_type;
        }
        else{

            if($this->session->userdata('order_type')){
                $order_type = $this->session->userdata('order_type');
            }else{

                $order_type = 'Desc';
            }
        }

        $data['order_type_selected'] = $order_type;


        if($language !='' ||$search_string !== false && $order !== false || $this->uri->segment(3) == true){
            if($language){
                $filter_session_data['language_selected'] = $language;
            }else{
                $stage=$this->session->userdata('language_selected');
                $filter_session_data['language_selected'] = $language;
            }
            $data['language_selected'] = $language;
            if($search_string){
                $filter_session_data['search_string_selected'] = $search_string;
            }else{
                $search_string = $this->session->userdata('search_string_selected');
            }
            $data['search_string_selected'] = $search_string;

            if($order){
                $filter_session_data['order'] = $order;
            }
            else{
                $order =$this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            $this->session->set_userdata($filter_session_data);

            $data['count_translator']= $this->adminblockedtranslator_model->count_translator($language,$search_string, $order);
            $config['total_rows'] = $data['count_translator'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['translator'] = $this->adminblockedtranslator_model->get_translator($language,$search_string, $order, $order_type, $config['per_page'],$limit_end);
                }else{
                    $data['translator'] = $this->adminblockedtranslator_model->get_translator($language,$search_string, '', $order_type, $config['per_page'],$limit_end);
                }
            }else{
                if($order){
                    $data['translator'] = $this->adminblockedtranslator_model->get_translator($language,'', $order, $order_type, $config['per_page'],$limit_end);
                }else{
                    $data['translator'] = $this->adminblockedtranslator_model->get_translator($language,'', '', $order_type, $config['per_page'],$limit_end);
                }
            }

        }else{

            //clean filter data inside section;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_translator']= $this->adminblockedtranslator_model->count_translator();
            $data['translator'] = $this->adminblockedtranslator_model->get_translator('','', '', $order_type, $config['per_page'],$limit_end);
            $config['total_rows'] = $data['count_translator'];

        }//!isset($manufacture_id) && !isset($search_string) && !isset($order)

        //initializate the panination helper
        $this->pagination->initialize($config);
        $admin_id = $this->session->userdata('admin_id');
        if($admin_id){
            $data['admin_type'] = $this->db->select('admin_type')->get_where('admin',['id' =>$admin_id])->first_row()->admin_type;
        }else{
            $data['admin_type'] = '';
        }
        //load the view
        $this->load->view('admin/vwBlockedTranslator',$data);

   }
   //index
     function reset()
        {
            //echo 'test';die;
            $referrer=$this->agent->referrer();
            $ref = explode('/',$referrer);

//          var_dump(end($ref));exit();
            $this->session->unset_userdata('search_string_selected');
            redirect($referrer);
        }


    function resettranslator()
    {
        //echo 'test';die;

        $this->session->unset_userdata('search_string_selected');
        redirect(base_url().'admin_blocked_translators/0/');
    }
}