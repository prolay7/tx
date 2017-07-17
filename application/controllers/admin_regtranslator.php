<?php error_reporting(0);
error_reporting(0);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_regtranslator extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->helper(array('form', 'url'));
        $this->load->model('adminregtranslator_model');
        $this->load->model('adminreview_model');
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
		$language= $this->input->post('language',true);
        $search_string = trim($this->input->post('search_string',true));
        $order = $this->input->post('order',true);
        $order_type = $this->input->post('order_type',true);
		$job_id_no=$this->uri->segment(2);
        //pagination settings
        $config['per_page'] = 10;
        $config['base_url'] = base_url().'admin_translators/'.$job_id_no;
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

            $data['count_translator']= $this->adminregtranslator_model->count_translator($language,$search_string, $order);
            $config['total_rows'] = $data['count_translator'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['translator'] = $this->adminregtranslator_model->get_translator($language,$search_string, $order, $order_type, $config['per_page'],$limit_end);
                }else{
                    $data['translator'] = $this->adminregtranslator_model->get_translator($language,$search_string, '', $order_type, $config['per_page'],$limit_end);
                }
            }else{
                if($order){
                    $data['translator'] = $this->adminregtranslator_model->get_translator($language,'', $order, $order_type, $config['per_page'],$limit_end);
                }else{
                    $data['translator'] = $this->adminregtranslator_model->get_translator($language,'', '', $order_type, $config['per_page'],$limit_end);
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
            $data['count_translator']= $this->adminregtranslator_model->count_translator();
            $data['translator'] = $this->adminregtranslator_model->get_translator('','', '', $order_type, $config['per_page'],$limit_end);
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
        $this->load->view('admin/vwTranslator',$data);

   }
   //index
	 function reset()
		{
			//echo 'test';die;
			$referrer=$this->agent->referrer();
			$ref = explode('/',$referrer);

//			var_dump(end($ref));exit();
			$this->session->unset_userdata('search_string_selected');
			redirect($referrer);
		}


    function resettranslator()
    {
        //echo 'test';die;

        $this->session->unset_userdata('search_string_selected');
        redirect(base_url().'admin_translators/0/');
    }


    public function edit()
    {
		if(!$this->session->userdata('is_admin')){
			$this->load->view('admin/index');
		} else {
			$data['message_error'] = "";
			$data['message_success'] = "";

			$trans_id= $this->uri->segment(4);

			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('location', 'Location', 'trim|required');

			$sql = "SELECT * FROM translator WHERE id = '" . $trans_id . "'";
			$val = $this->db->query($sql);
			$data['results'] = $val->result_array();


			if($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('flash_error', 'errorValidation');
				//$this->load->view('artist/artists/vwChangeprofile', $data);
			} else {


					$languageArr = $this->input->post('language');
					$language = implode(",",$languageArr);
					$language = ",".$language.",";
					$sql = "UPDATE translator SET
					`first_name`   = '".$this->input->post('first_name')."',
					`last_name`   = '". $this->input->post('last_name') ."',
					`location`    = '". $this->input->post('location') .
					"' WHERE id = '" . $trans_id . "'";
					$val = $this->db->query($sql);

					$data['message_success'] = "Successfully Change Your Profile";

				$sql = "SELECT * FROM translator WHERE id = '" . $trans_id . "'";
				$val = $this->db->query($sql);
				$data['results'] = $val->result_array();
				$this->session->set_flashdata('flash_error', 'errorValidation');


			}
			$this->load->view('admin/vwTranslatorProfile', $data);
		}
	}

	public function edittranslator()
    {
		if(!$this->session->userdata('is_admin')){
			$this->load->view('admin/index');
		} else {
			$data['message_error'] = "";
			$data['message_success'] = "";

			$trans_id= $this->uri->segment(3);
			//echo $trans_id;die;
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('location', 'Location', 'trim|required');

			$sql = "SELECT * FROM translator WHERE id = '" . $trans_id . "'";
			$val = $this->db->query($sql);
			$data['results'] = $val->result_array();


			if($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('flash_error', 'errorValidation');
				//$this->load->view('artist/artists/vwChangeprofile', $data);
			} else {


					$languageArr = $this->input->post('language');
					$language = implode(",",$languageArr);
					$language = ",".$language.",";
					$sql = "UPDATE translator SET
					`first_name`   = '".$this->input->post('first_name')."',
					`last_name`   = '". $this->input->post('last_name') ."',
					`location`    = '". $this->input->post('location') .
					"' WHERE id = '" . $trans_id . "'";
					$val = $this->db->query($sql);

					$data['message_success'] = "Successfully Change Your Profile";

				$sql = "SELECT * FROM translator WHERE id = '" . $trans_id . "'";
				$val = $this->db->query($sql);
				$data['results'] = $val->result_array();
				$this->session->set_flashdata('flash_error', 'errorValidation');


			}
			$this->load->view('admin/vwTranslatorProfileedit', $data);
		}
	}

	 public function delete()
    {
	if($this->session->userdata('is_admin')){
       $id = $this->uri->segment(4);
	   $job=$this->uri->segment(3);
	 // echo $id;die;
		$sql = "SELECT * FROM translator WHERE id = " . $id . " ";
		$val = $this->db->query($sql);
		$row = $val->row_array();

		$this->adminregtranslator_model->delete_translator($id);
		$this->session->set_flashdata('success_message', 'Successfully Deleted');
        redirect('admin_translators/'.$job);
      } else {
		$this->session->set_flashdata('error_message', ' Not Deleted');
        redirect('admin_translators/'.$job);
      }

    }//delete

	 public function deletetranslator()
    {
	if($this->session->userdata('is_admin')){
       $id = $this->uri->segment(3);

	 // echo $id;die;
		$sql = "SELECT * FROM translator WHERE id = " . $id . " ";
		$val = $this->db->query($sql);
		$row = $val->row_array();

		$this->adminregtranslator_model->delete_translator($id);
		$this->session->set_flashdata('success_message', 'Successfully Deleted');
        redirect('admin_translators/'.$job);
      } else {
		$this->session->set_flashdata('error_message', ' Not Deleted');
        redirect('admin_translators/'.$job);
      }

    }//delete

	public function reviewlist()
	{
		if (!$this->session->userdata('is_admin')) {
		          $this->load->view('admin/vwLogin');
		} else {
    		//echo 'test';die;
    	    $filter_session_data="";
    		$trans_id=  $this->uri->segment(3);
            $search_string = $this->input->post('search_string');
            $order =$this->input->post('order');
            $order_type = $this->input->post('order_type');


    		$config['uri_segment'] =4;
            $config['per_page'] =10;
            $config['base_url'] = base_url().'admin/translatorreview/'.$trans_id.'/';
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = 20;
            $config['full_tag_open'] = '<ul>';
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';

            $page = $this->uri->segment(4);

            $limit_end = ($page * $config['per_page']) - $config['per_page'];

            if ($limit_end < 0) {
                $limit_end = 0;
            }

            if ($order_type) {
                $filter_session_data['order_type'] = $order_type;
            } else {

                if ($this->session->userdata('order_type')) {
                    $order_type = $this->session->userdata('order_type');
                } else {
                    $order_type = 'DESC';
                }
            }

            $data['order_type_selected'] = $order_type;

            if ($search_string !== false && $order !== false || $this->uri->segment(4) == true) {
                if ($search_string) {
                    $filter_session_data['search_string_selected'] = $search_string;
                } else {
                    $search_string = $this->session->userdata('search_string_selected');
                }

                $data['search_string_selected'] = $search_string;

                if ($order) {
                    $filter_session_data['order'] = $order;
                } else {
                    $order = $this->session->userdata('order');
                }

                $data['order'] = $order;

                $this->session->set_userdata($filter_session_data);

                $data['count_review']= $this->adminreview_model->count_review($trans_id,$search_string, $order);

                $config['total_rows'] = $data['count_review'];

                if ($search_string) {

                    if ($order) {
                        $data['review'] = $this->adminreview_model->get_review($trans_id,$search_string, $order, $order_type, $config['per_page'],$limit_end);
                    } else {
                        $data['review'] = $this->adminreview_model->get_review($trans_id,$search_string, '', $order_type, $config['per_page'],$limit_end);
                    }

                } else {

                    if ($order) {
                        $data['review'] = $this->adminreview_model->get_review($trans_id,'', $order, $order_type, $config['per_page'],$limit_end);
                    } else {
                        $data['review'] = $this->adminreview_model->get_review($trans_id,'', '', $order_type, $config['per_page'],$limit_end);
                    }
                }
            } else {

                $filter_session_data['search_string_selected'] = null;
                $filter_session_data['order'] = null;
                $filter_session_data['order_type'] = null;

                $this->session->set_userdata($filter_session_data);

                $data['search_string_selected'] = '';
                $data['order'] = 'id';
                $data['count_review']= $this->adminreview_model->count_review($trans_id);
                $data['review']= $this->adminreview_model->get_review($trans_id,'', '', $order_type,$config['per_page'],$limit_end);
                $config['total_rows'] = $data['count_review'];
            }

            $data['translator_name'] = $this->adminreview_model->get_translator_name($trans_id);
            $data['no_awarded_jobs'] = $this->adminreview_model->get_jobs_awarded($trans_id);
            $data['rating'] = $this->adminreview_model->get_average_rating($trans_id);

            $this->pagination->initialize($config);
    		$this->load->view('admin/vwReviewList',$data);
        }

    }
}
