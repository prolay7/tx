<?php
error_reporting(0);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_Banner extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
       $this->load->model('banner_model');

        if(!$this->session->userdata('is_admin')){
            redirect('admin/login');
        }
		//echo '<pre>'; print_r($this->session->userdata);
    }

	/**
    * Load the main view with all the current model model's data.
    * @return void
    */public function index()
    {
		$filter_session_data="";
        //all the posts sent by the view      
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 

        //pagination settings
        $config['per_page'] = 10;
        $config['base_url'] = base_url().'admin/banner';
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

            $data['count_banner']= $this->banner_model->count_banner($search_string, $order);
            $config['total_rows'] = $data['count_banner'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['banner'] = $this->banner_model->get_banner($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['banner'] = $this->banner_model->get_banner($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['banner'] = $this->banner_model->get_banner('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['banner'] = $this->banner_model->get_banner('', '', $order_type, $config['per_page'],$limit_end);        
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
            $data['count_banner']= $this->banner_model->count_banner();
            $data['wedding'] = $this->banner_model->get_banner('', '', $order_type, $config['per_page'],$limit_end);   
            $config['total_rows'] = $data['count_banner'];

        }//!isset($manufacture_id) && !isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $this->load->view('admin/banner/vwBannerlist',$data);
		

		
	}
    public function add()
    {
       $data['message_error'] = "";
		$data['message_success'] = "";
      error_reporting(0);
	if(!$this->session->userdata('is_admin')){
			$this->load->view('admin/vwLogin');	
		} else {
			$data['message_error'] = "";
			$data['message_success'] = "";
			$luser_id= $this->session->userdata('admin_id');
			$this->form_validation->set_rules('title', 'Image title', 'trim|required');
			if($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('flash_error', 'errorValidation');
			} else{
				
				if($_FILES['images']['size'] != 0){
					$timestamp = time();
					$config['upload_path'] = './uploads/banner';
					$config['allowed_types'] = 'gif|jpg|jpeg|png';
					$config['file_name']     = $timestamp;
					$config['max_size']	= '10024';
					$config['max_width']  = '2024';
					$config['max_height']  = '2024';
			
					$this->load->library('upload', $config);
					if(!is_dir($config['upload_path'])){
						mkdir($config['upload_path'], 0755, TRUE);
					}
					
					if ( ! $this->upload->do_upload('images')) {
						$data['message_error'] = $this->upload->display_errors();
					} else {
						
					//$this->load->library('image_lib');
					
					$this->upload->do_upload('images');
					$upload_data = $this->upload->data();
					
					$this->load->library('image_lib');
					
					$imagesname = $upload_data['file_name'];
					$image_config["image_library"] = "gd2";
					$image_config["source_image"] = $upload_data["full_path"];
					$image_config['create_thumb'] = FALSE;
					$image_config['maintain_ratio'] = TRUE;
					$image_config['quality'] = "100%";
					
					
					$image_config['new_image'] = $upload_data["file_path"] . 'normal/'.$upload_data['file_name'];
					$image_config['width'] =1349;
					$image_config['height'] = 500;
					$dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($image_config['width'] / $image_config['height']);
					$image_config['master_dim'] = ($dim > 0)? "height" : "width";
					$this->image_lib->initialize($image_config);
					$this->image_lib->resize();
					$this->image_lib->clear();
		
					
	 
	 				$data_to_store = array(
                    'title' => $this->input->post('title'),
					'images' => $imagesname,
					'status' => $this->input->post('status'),
					'created' => date('Y-m-d h:i:s')
                );
                //if the insert has returned true then we show the flash message
						if($this->banner_model->store_banner($data_to_store))
						{
							$data['message_success'] = "banner pic added successfully."; 
						}
						else
						{
							$data['message_error'] = "There are some problem to add banner.";
						}
					}
				} else {
					
					$data['message_error'] = "Please be select  a file.";
					
					
				}
			}
			$sql = "SELECT * FROM banner WHERE id = '" . $luser_id . "'";
			$data['results'] = array();
			$val = $this->db->query($sql);
			if ($val->num_rows) 
			{
				$data['results'] = $val->result_array();
			} 
			$this->load->view('admin/banner/vwAddbanner', $data);
		}
    }//add
	 public function edit()
	 { 
	 error_reporting(0);
	if(!$this->session->userdata('is_admin')){
			$this->load->view('admin/vwLogin');	
		} else {
			$data['message_error'] = "";
			$data['message_success'] = "";
			$luser_id= $this->session->userdata('admin_id');
				if($_FILES['images']['size'] != 0){
					$timestamp = time();
					$config['upload_path'] = './uploads/banner';
					$config['allowed_types'] = 'gif|jpg|jpeg|png';
					$config['file_name']     = $timestamp;
					$config['max_size']	= '10024';
					$config['max_width']  = '2024';
					$config['max_height']  = '2024';
			
					$this->load->library('upload', $config);
					if(!is_dir($config['upload_path'])){
						mkdir($config['upload_path'], 0755, TRUE);
					}
					if ( ! $this->upload->do_upload('images')) {
						$data['message_error'] = $this->upload->display_errors();
					} else {
						$this->upload->do_upload('images');
						$upload_data = $this->upload->data();
						$this->load->library('image_lib');
						$imagesname = $upload_data['file_name'];
						$image_config["image_library"] = "gd2";
						$image_config["source_image"] = $upload_data["full_path"];
						$image_config['create_thumb'] = FALSE;
						$image_config['maintain_ratio'] = TRUE;
						$image_config['quality'] = "100%";
						$image_config['new_image'] = $upload_data["file_path"] . 'normal/'.$upload_data['file_name'];
						$image_config['width'] = 1349;
						$image_config['height'] = 500;
						$dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($image_config['width'] / $image_config['height']);
						$image_config['master_dim'] = ($dim > 0)? "height" : "width";
						$this->image_lib->initialize($image_config);
						$this->image_lib->resize();
						$this->image_lib->clear();
						 $id = $this->uri->segment(3);
						 $sql2="SELECT * from banner WHERE id = '" . $id . "'";
						$val2 = $this->db->query($sql2); 
						$update = $val2->result_array();
						$unlinkpath = "./uploads/banner/"; 				
						unlink($unlinkpath."normal/".$update[0]['images']);
						unlink($unlinkpath.$update[0]['images']);
						$sql = "UPDATE banner SET 
						`images`    = '". $upload_data['file_name'] ."',
						`status`    = '".  $this->input->post('status')."',
						`modified` = '".date('Y-m-d h:i:s')."'      
						WHERE id = '" . $id . "'";
						$val = $this->db->query($sql);
						$data['message_success'] = "Successfully Change Your picture";
					}
				}else {
						if($this->input->post('preimage') != "")  {
						$id = $this->uri->segment(3);
						 $sql2="SELECT * from banner WHERE id = '" . $id . "'";
						$val2 = $this->db->query($sql2); 
						$update = $val2->result_array();	
						$sql = "UPDATE banner SET 
						`status`    = '".  $this->input->post('status')."',
						`modified` = '".date('Y-m-d h:i:s')."'      
						WHERE id = '" . $id . "'";
						$val = $this->db->query($sql);
						$data['message_success'] = "Successfully Updated";
					} 
				}
			
			 $id = $this->uri->segment(3);
			$sql = "SELECT * FROM banner WHERE id = '" . $id . "'";
			$data['results'] = array();
			$val = $this->db->query($sql);
			if ($val->num_rows) {
				$data['results'] = $val->result_array();
			} 
			$this->load->view('admin/banner/vwBanner', $data);
		}
	
	
	}
	 public function delete()
    {		
		 $id = $this->uri->segment(3);
		$sql = "SELECT * FROM banner WHERE id = " . $id . " ";
		$val = $this->db->query($sql);
		$row = $val->row_array();
		$image = $row['images'];
		$path = './uploads/banner/normal/'.$image;
		unlink($path);
			$path1 = './uploads/banner'.$image;
		unlink($path1);
			
        //category id 
       
        $this->banner_model->delete_banner($id);
		$this->session->set_flashdata('flash_message', 'deleted');
        redirect('admin/banner');
    }//delete
}
	