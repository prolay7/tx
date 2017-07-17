<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
error_reporting(0);
class Admin_Invite extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
       $this->load->model('admin_email_translator_model');

        /*if(!$this->session->userdata('is_admin')){
            redirect('admin/login');
        }*/
		//echo '<pre>'; print_r($this->session->userdata);
    }

	/**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {if($this->session->userdata('is_admin')){
			redirect('admin/dashboard');
        }else{
        	$this->load->view('admin/vwLogin');	
        }
	}//index
	
	
	public function send()
    { 
	  if(!$this->session->userdata('is_admin')){
				redirect('admin/login');
			}else{
				
		$this->uri->segment(3);
		//$des = $this->input->post('description');
		$email =  $this->input->post('email');
		$data['message_error'] = "";
		$data['message_success'] = "";
		$job_id= $this->uri->segment(3);
		//$this->form_validation->set_rules('description', 'Description', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		if($this->form_validation->run() == FALSE) {
		} else {
						
			$sql2 = "SELECT * FROM jobpost WHERE id='". $job_id."' ";
			$val2 = $this->db->query($sql2);
			$job = $val2->row();
			
			
			$language_id=$job->language;
			//echo $language_id;
			$pieces = explode("/", $language_id);
			$languagef_id=$pieces[0];
			$sql5="select `name` from `languages` where `id`='$languagef_id'";
			$query5=$this->db->query($sql5);
			$fetch5=$query5->row();
			$languagef_name=$fetch5->name;
			
			$language_id=$pieces[1];
			$sql6="select `name` from `languages` where `id`='$language_id'  ";
			//echo $sql;die;
			$query6=$this->db->query($sql6);
			$fetch6=$query6->row();
			$language_name=$fetch6->name;

			$job_description=$job->description;
			if(strlen($job_description)>100)
			{
			$job_description=substr($job_description,0,100).'...'; 
			}
			else
			{
			$job_description=$job->description;
			}
              
			
			
			$email =  $this->input->post('email');
			$sql1 = "SELECT * FROM translator WHERE email_address='". $email."' ";
			$val1 = $this->db->query($sql1);
			$row_email1 = $val1->row();
			//echo '<pre>';print_r($row_email1);die;
			 $mail=$row_email1->id;
			$hash = md5(uniqid(rand()));
			$invitation_insert_data = array(
				
				'job_id' => $this->uri->segment(3),
				'description' => $this->input->post('description'),
				'invite_id' =>  $mail,			
				'hash' => $hash,
				'created' => date('Y-m-d h:i:s')
							
			); //echo'<pre>'; print_r($invitation_insert_data);die;
				 $query=$this->db->insert('send_invitation',$invitation_insert_data);
				 if($this->input->post('description')!=" "){
					 $description=$this->input->post('description');
				 }
				 else{
					 $description= "No Description";
				 }
				
				//echo $description; 
			 if($query){
					
					$data = array(
						'job_id' => $this->uri->segment(3),
						'job_name' => $this->input->post('job_name'),
						'job_alias' => $this->input->post('job_alias'),
						'description' => $description,
						'job_description'=>$job_description,
						'hash' => $hash,
						'lang_from'=>$languagef_name,
						'lang_to'=>$language_name,
						'created' => date('Y-m-d h:i:s')
					);	
					//echo'<pre>';print_r($data);die;
					
			$jobid=$this->uri->segment(3);
					$mailTo = $email;
					$mailName = $row_email1->first_name." ".$row_email1->last_name;
					$data['name'] = $mailName;
					$data['id'] = $mail;
					$this->email->set_mailtype("html");
					$this->email->from('info@montesinotranslation.com');
					$this->email->to($mailTo);
					$this->email->subject('Invitation Email');
					$html_email = $this->load->view('email/vwTranslatorSendInvitation', $data ,true);
					$this->email->message($html_email);
					$this->email->send();
				
					// echo $this->email->print_debugger(array('headers'));

				 	
					
					}
					$this->session->set_flashdata('message_success_new', 'successfully sent invitation.');
					redirect('admin_translator/viewdemo/'.$mail.'/'.$jobid);
				//redirect('admin_translators/'.$job_id);
				
			
		}
		
	}}
	
	public function send1()
    { 
	  if(!$this->session->userdata('is_admin')){
				redirect('admin/login');
			}else{
				
		$job_id= $this->uri->segment(3);
		if($this->input->post('check')){//echo "hello";
		$emailArr = $this->input->post('check');
			//echo'<pre>'; print_r($emailArr);die;
		 $email = implode(",",$emailArr);
		$sql = "SELECT * FROM `translator` WHERE `id` in( " . $email . " )";
		$val = $this->db->query($sql);
		$translator = $val->result();
		
			$data['message_error'] = "";
			$data['message_success'] = "";
			$job_id= $this->uri->segment(3);
			
			$sql1 = "SELECT * FROM jobpost WHERE id='". $job_id."' ";
			$val1 = $this->db->query($sql1);
			$job = $val1->row();
			$job_alias=$job->alias;
			$job_name=$job->name;
			
			
			$language_id=$job->language;
			//echo $language_id;
			$pieces = explode("/", $language_id);
			$languagef_id=$pieces[0];
			$sql5="select `name` from `languages` where `id`='$languagef_id'";
			$query5=$this->db->query($sql5);
			$fetch5=$query5->row();
			$languagef_name=$fetch5->name;
			
			$language_id=$pieces[1];
			$sql6="select `name` from `languages` where `id`='$language_id'  ";
			//echo $sql;die;
			$query6=$this->db->query($sql6);
			$fetch6=$query6->row();
			$language_name=$fetch6->name;

			
			
			
			
			
		/*	$job_lang_to=$job->language;
			$sq="SELECT * FROM languages WHERE id='". $job_lang_to."' ";
			$va = $this->db->query($sq);
			$lang_to_arr = $va->row();
			$lang_to=$lang_to_arr->name;
			$job_lang_from=$job->language_from;
			$sq1="SELECT * FROM languages WHERE id='". $job_lang_from."' ";
			$va1 = $this->db->query($sq1);
			$lang_from_arr = $va1->row();
			$lang_from=$lang_from_arr->name;*/
			
			
			
			$job_description=$job->description;
			if(strlen($job_description)>100)
			{
			$job_description=substr($job_description,0,100).'...'; 
			}
			else
			{
			$job_description=$job->description;
			}
                                      
			
			
			$hash = md5(uniqid(rand()));
			$invitation_insert_data = array(
				
				'job_id' => $this->uri->segment(3),
				'description' => $job_description,
				'invite_id' =>  $email,			
				'hash' => $hash,
				'created' => date('Y-m-d h:i:s')
							
			); //echo'<pre>'; print_r($invitation_insert_data);die;
				 $query=$this->db->insert('send_invitation',$invitation_insert_data);
				
				
			
				
				//echo $description; 
			 if($query){
					
					$data = array(
						'job_id' => $this->uri->segment(3),
						'job_name' => $job_name,
						'job_alias' => $job_alias,
						//'description' => $description,
						'job_description'=>$job_description,
						'hash' => $hash,
						'lang_from'=>$languagef_name,
						'lang_to'=>$language_name,
						'created' => date('Y-m-d h:i:s')
					);	
					//echo'<pre>';print_r($data);die;
					foreach ($translator as $key => $value)
					{
					$jobid=$this->uri->segment(3);
					$mailTo = $value->email_address;
					$mailName = $value->first_name." ".$value->last_name;
					$data['name'] = $mailName;
					$data['id'] = $value->id;
					$this->email->set_mailtype("html");
					$this->email->from('info@montesinotranslation.com');
					$this->email->to($mailTo);
					$this->email->subject('Invitation Email');
					$html_email = $this->load->view('email/vwTranslatorSendInvitation1', $data ,true);
					$this->email->message($html_email);
					$this->email->send();
				
					}

					}
					$this->session->set_flashdata('msg', 'successfully sent invitations.');
					redirect('admin_translators/'.$jobid);
				//redirect('admin_translators/'.$job_id);
				
			
	
		
	}else{
		$this->session->set_flashdata('wmsg', 'Select atleast one translator.');
		redirect('admin_translators/'.$job_id);
		
		
		}
	
	}
	}

	 public function check()
    {		
		$data['message_error'] = "";
		$data['message_success'] = "";
		$translator_id = $this->uri->segment(3);
		$job_alias = $this->uri->segment(4);
		$job_id = $this->db->get_where('jobpost',['alias' => $job_alias]);
		if($job_id->num_rows() > 0){
		    $job_id = $job_id->first_row()->id;
        }else{
		    $job_id = '';
        }
		$sql = "SELECT * FROM translator WHERE id = '" . $translator_id . "'AND verified = '1' ";
		$val = $this->db->query($sql);
		$fetch=$val->row();
		$is_valid = $val->num_rows();
		if($is_valid>0)
		{	
			$this->session->set_flashdata('is_invited', 'true.');
			redirect('job/'.$job_id.'/'.$job_alias);
		}
		else
		{
			$data = array(
							'email_name' => $fetch->email_name,
							'first_name' => $fetch->first_name,
							'last_name' => $fetch->last_name,
							'is_invited_translator' => true
							);
			$this->session->set_userdata($data);
			$this->session->set_flashdata('message_success_new', 'Fill up the Form  .');
			redirect('translator/registration');
		}
		
    }
   public function emaillist()
   {
	
		$filter_session_data="";
        //all the posts sent by the view      
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 

        //pagination settings
        $config['per_page'] = 20;
        $config['base_url'] = base_url().'admin/emaillist';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';

        //limit end
        $page = $this->uri->segment(4);

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
        if($search_string !== false && $order !== false || $this->uri->segment(4) == true){ 


            //echo $search_string;
			//echo $order;
			//echo $order_type;
			//echo $this->uri->segment(4); die;
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

            $data['count_translator']= $this->admin_email_translator_model->count_translator($search_string, $order);
            $config['total_rows'] = $data['count_translator'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['translator'] = $this->admin_email_translator_model->get_translator($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['translator'] = $this->admin_email_translator_model->get_translator($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['translator'] = $this->admin_email_translator_model->get_translator('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['translator'] = $this->admin_email_translator_model->get_translator('', '', $order_type, $config['per_page'],$limit_end);        
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
            $data['count_translator']= $this->admin_email_translator_model->count_translator();
            $data['translator'] = $this->admin_email_translator_model->get_translator('', '', $order_type, $config['per_page'],$limit_end);   
            $config['total_rows'] = $data['count_translator'];

        }//!isset($manufacture_id) && !isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   
			
        //load the view
        $this->load->view('admin/vwEmaillist',$data);
	
   }

}