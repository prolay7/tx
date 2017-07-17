<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_Cms extends CI_Controller {

       public function __construct()
    {
        parent::__construct();
        $this->load->model('cms_model');

        if(!$this->session->userdata('is_admin')){
            redirect('admin/login');
        }
    }

	/**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {
        //all the posts sent by the view      
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 

        //pagination settings
        $config['per_page'] = 50;
        $config['base_url'] = base_url().'admin/cms';
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
                $order_type = 'Asc';    
            }
        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;        


        //we must avoid a page reload with the previous session data
        //if any filter post was sent, then it's the first time we load the content
        //in this case we clean the session filter data
        //if any filter post was sent but we are in some page, we must load the session data

        //filtered && || paginated
        if($search_string !== false && $order !== false || $this->uri->segment(3) == true){ 
           
            /*
            The comments here are the same for line 79 until 99

            if post is not null, we store it in session data array
            if is null, we use the session data already stored
            we save order into the the var to load the view with the param already selected       
            */


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
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            $this->session->set_userdata($filter_session_data);

            $data['count_cms']= $this->cms_model->count_cms($search_string, $order);
            $config['total_rows'] = $data['count_cms'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['cms'] = $this->cms_model->get_cms($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['cms'] = $this->cms_model->get_cms($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['cms'] = $this->cms_model->get_cms('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['cms'] = $this->cms_model->get_cms('', '', $order_type, $config['per_page'],$limit_end);        
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
            $data['count_cms']= $this->cms_model->count_cms();
            $data['cms'] = $this->cms_model->get_cms('', '', $order_type, $config['per_page'],$limit_end);   
            $config['total_rows'] = $data['count_cms'];

        }//!isset($manufacture_id) && !isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/cms/list';
        $this->load->view('admin/cms/vwManageCMS',$data);
		

    }//index

	
	public function update()
    {
        //cms id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('label', 'Page Name', 'required');
			$this->form_validation->set_rules('title', 'Page Title', 'required');
            $this->form_validation->set_rules('content', 'Page Content', 'required');
            //$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>', '</div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                    'label' => $this->input->post('label'),
					'title' => $this->input->post('title'),
                    'content' => $this->input->post('content'),
                );
                //if the insert has returned true then we show the flash message
                if($this->cms_model->update_cms($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/cms/update/'.$id.'');

            } else {
				$this->session->set_flashdata('flash_message', 'not_updated');
			}

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //cms data 
        $data['cms'] = $this->cms_model->get_cms_by_id($id);
		//load the view
        $data['main_content'] = 'admin/cms/edit';
		$this->load->view('admin/cms/vwEditCMS',$data);            

    }//update
	
	/**
    * Delete cms by his id
    * @return void
    */
    public function delete()
    {
        //cms id 
        $id = $this->uri->segment(4);
        $this->cms_model->delete_cms($id);
		$this->session->set_flashdata('flash_message', 'deleted');
        redirect('admin/cms');
    }//delete
   
    
	    function create_slug($replace=array(), $delimiter='-') 
	{
		$sql = "SELECT * FROM `cms`";
		$results = $this->db->query($sql);
		$data = $results->result_array();
		//print_r($data);
		foreach ($data as $row){
			$string= $row['label'];
			$id=$row['id'];
			$alias = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
			$alias = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $alias);
			$alias = strtolower(trim($alias, '-'));
			$alias = preg_replace("/[\/_|+ -]+/", $delimiter, $alias);
			
			echo $alias.'<br/>';
			$sql1 = "UPDATE cms SET `alias` =  '" . $alias . "' WHERE id = '" . $id . "' ";
				$val1 = $this->db->query($sql1);
				

			
		}
		
		/*$sql1 = "SELECT alias FROM `blog` WHERE `alias`='$alias'";
		$results1 = $this->db->query($sql1);
		$count=$results1->num_rows;
		$concatcount=0;
			if ($count> 0) {
				$concatcount++;
				$result = $results1->result_array();
				$alias= $alias."-".$concatcount;
			}*/
		
		//return $alias;
		
		}
}

