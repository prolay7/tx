<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_Testimonial extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('admintestimonial_model');

        if(!$this->session->userdata('is_admin')){
            redirect('admin/login');
        }
		//echo '<pre>'; print_r($this->session->userdata);
    }

	/**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {
	   
		$filter_session_data="";
        //all the posts sent by the view      
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 

        //pagination settings
        $config['per_page'] = 10;
        $config['base_url'] = base_url().'admin/testimoniallist';
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


       
        if($search_string !== false && $order !== false || $this->uri->segment(3) == true){ 


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

            $data['count_testimonial']= $this->admintestimonial_model->count_testimonial($search_string, $order);
            $config['total_rows'] = $data['count_testimonial'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['testimonial'] = $this->admintestimonial_model->get_testimonial($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['testimonial'] = $this->admintestimonial_model->get_testimonial($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['testimonial'] = $this->admintestimonial_model->get_testimonial('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['testimonial'] = $this->admintestimonial_model->get_testimonial('', '', $order_type, $config['per_page'],$limit_end);        
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
            $data['count_testimonial']= $this->admintestimonial_model->count_testimonial();
            $data['testimonial'] = $this->admintestimonial_model->get_testimonial('', '', $order_type, $config['per_page'],$limit_end);   
            $config['total_rows'] = $data['count_testimonial'];

        }//!isset($manufacture_id) && !isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   
			
        //load the view
        $this->load->view('admin/vwTestimonialList',$data);
	
   }//index
	
	
	public function add()
    {
	        //echo 'test';die;
			if($this->session->userdata('is_admin')){
				$data['message_error'] = "";
				$data['message_success'] = "";
				$this->form_validation->set_rules('name', 'testimonial name', 'required');
				$this->form_validation->set_rules('designation', 'testimonial designation', 'required');
				$this->form_validation->set_rules('desc','testimonial description', 'required');
				if ($this->form_validation->run()== FALSE){
				$this->session->set_flashdata('flash_error', 'errorValidation');				
			} else
				{   
				    if($_FILES['file']['size'] != 0){
					$timestamp = time();
					$config['upload_path'] = './uploads/testimonial';
					$config['allowed_types'] = 'gif|jpg|jpeg|png';
                        if(!preg_match('/[^\x20-\x7f]/',$_FILES['file']['name'])){
                            $config['file_name'] = $_FILES['file']['name'];
                        }else{
                            $config['file_name'] =$timestamp;
                        }
					$config['max_size']	= '10024';
					$config['max_width']  = '2024';
					$config['max_height']  = '2024';
			
					$this->load->library('upload', $config);
					if(!is_dir($config['upload_path'])){
						mkdir($config['upload_path'], 0755, TRUE);
					}
					
					if ($this->upload->do_upload('file'))
					{																
				    $upload_data = $this->upload->data();			
					$imagename= $upload_data['file_name'];
					
					$data_to_store = array(
					'name' => $this->input->post('name'),
					'designation' => $this->input->post('designation'),					
					'desc' => $this->input->post('desc'),
					'image'=>$imagename,
					'status' => $this->input->post('status'),
					'created' => date('Y-m-d h:i:s')
					);
				    $query=$this->db->insert('testimonial',$data_to_store);
					if($query)
					{
				    $data['message_success'] = "Successfully Testimonial Added. ";
					}
					else
					{
				    $data['message_error'] = "Testimonial Not Added. ";
					}			
				    } 
					else
					{
					$data['message_error'] = $this->upload->display_errors();
					} 
			    }
				else
				{
				$data['message_error'] ="Please be select  a file.";	
				}
				}	 
			 
			$this->load->view('admin/vwAddTestimonial',$data); 
			} 
			else {
				$this->session->set_flashdata('error_message', 'Not Permited');
				 redirect('admin/index');
			}
			
	 }
	
	
	
	
	
	 public function delete()
    {		
	if($this->session->userdata('is_admin')){
       $id = $this->uri->segment(3);
	   //echo $id;die;
		$sql = "SELECT * FROM testimonial WHERE id = " . $id . " ";
		$val = $this->db->query($sql);
		$row = $val->row_array();
			
		$this->admintestimonial_model->delete_testimonial($id);
		$this->session->set_flashdata('success_message', 'Successfully Deleted');		
        redirect('admin/testimoniallist');
      } else {
		$this->session->set_flashdata('error_message', ' Not Deleted');		
        redirect('admin/index');
      }
		
    }
	public function edit()
	{ 
    if($this->session->userdata('is_admin'))
	{
       $id = $this->uri->segment(3);
			$sql = "SELECT * FROM `testimonial` WHERE id = '" . $id . "'";
			$data['results'] = array();
			$val = $this->db->query($sql);
			if ($val->num_rows) {
				$data['results'] = $val->result_array();
			} 
			$this->load->view('admin/vwEditTestimonial', $data);
	   
	   
	   
      } else 
	  {
		$this->session->set_flashdata('error_message', ' Not Deleted');
        redirect('admin/index');
      }		
    
	
	}
	
	
	public function editprof()
	{ 
	        //echo $id = $this->uri->segment(3);die;
			$this->form_validation->set_rules('name', 'testimonial name', 'required');
			$this->form_validation->set_rules('designation', 'testimonial designation', 'required');
			$this->form_validation->set_rules('desc','testimonial description', 'required');
			if ($this->form_validation->run()== FALSE){
			$this->session->set_flashdata('flash_error', 'errorValidation');				
			}
			else
			{
			        $data['message_error'] = "";
			        $data['message_success'] = "";
			        $id = $this->uri->segment(3);
				    if($_FILES['file']['size'] != 0)
					{
					$timestamp = time();
					$config['upload_path'] = './uploads/testimonial';
					$config['allowed_types'] = 'gif|jpg|jpeg|png';
                        if(!preg_match('/[^\x20-\x7f]/',$_FILES['file']['name'])){
                            $config['file_name'] =$_FILES['file']['name'];
                        }else{
                            $config['file_name'] =$timestamp;
                        }
					$config['max_size']	= '10024';
					$config['max_width']  = '2024';
					$config['max_height']  = '2024';
			
					$this->load->library('upload', $config);
					if(!is_dir($config['upload_path'])){
						mkdir($config['upload_path'], 0755, TRUE);
					}
					if ($this->upload->do_upload('file')) {					
						$upload_data = $this->upload->data();
						$imagename=$upload_data['file_name'];			
						$preimage = "./uploads/testimonial/".$this->input->post('preimage');							
						if($preimage!="" && file_exists($preimage))
						{
						unlink($preimage);
						}
								$data_to_store = array(
					'name' => $this->input->post('name'),
					'designation' => $this->input->post('designation'),					
					'desc' => $this->input->post('desc'),
					'image'=>$imagename,
					'status' => $this->input->post('status'),
					'modified' => date('Y-m-d h:i:s')
					);
					$this->db->where('id', $id);
					$query=$this->db->update('testimonial',$data_to_store);	
					$data['message_success'] = "Successfully Updated";					
					} else
					{
						$data['message_error'] = $this->upload->display_errors();
					}
					
					
					
					
				    }else 
					{
					if($this->input->post('preimage') != "")  {
					$id = $this->uri->segment(3);						
					$data_to_store = array(
					'name' => $this->input->post('name'),
					'designation' => $this->input->post('designation'),					
					'desc' => $this->input->post('desc'),
					'image'=>$this->input->post('preimage'),
					'status' => $this->input->post('status'),
					'modified' => date('Y-m-d h:i:s')
					);
					$this->db->where('id', $id);
					$query=$this->db->update('testimonial',$data_to_store);	
					$data['message_success'] = "Successfully Updated";
					} 
				}
			
			
			} 
			$id = $this->uri->segment(3);
			$sql = "SELECT * FROM `testimonial` WHERE id = '" . $id . "'";
			$data['results'] = array();
			$val = $this->db->query($sql);
			if ($val->num_rows) {
				$data['results'] = $val->result_array();
				$this->load->view('admin/vwEditTestimonial', $data);
				
		}
	}
	
	

	
	
		

}