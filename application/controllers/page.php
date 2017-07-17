<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//error_reporting(0);
class Page extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
    }

    public function index() {
		$page_id = $this->uri->segment(2);
		//echo $page_id;die;
        $sql = "SELECT * FROM `cms` WHERE  alias = '$page_id' ";
		$results = $this->db->query($sql);
		if ($results->num_rows > 0) {
			$result_arr = $results->result(); 
			$data['page_content'] = $result_arr[0]->content;
		 $this->load->view('vwPage',$data);
		} else{
			 $data['content'] = 'error_404'; // View name 
        $this->load->view('translator/error_404',$data);
		}
        //$this->load->view('vwPage',$data);
    }
	public function contactus(){
	 $this->load->view('vwContactUs');
	}
	public function contact(){
		    //echo 'test';die;
			
			$data['first_name']=$this->input->post('first_name');
			$data['last_name']=$this->input->post('last_name');
			$data['email_address']=$this->input->post('email_address');		
			$data['address']=$this->input->post('address');
			$data['message']=$this->input->post('message');
			$data['phone']=$this->input->post('phone');					
			
			$this->email->set_mailtype("html");
			$this->email->from($this->input->post('email_address'));
			
			$sql = "SELECT * FROM settings WHERE id = '1'";
      		 $val = $this->db->query($sql);
			$fetch= $val->row();
			$email=$fetch->email; 
			
			$this->email->to($email);
			$this->email->subject('Contact Us');
			$html_email = $this->load->view('email/vwContactEmail', $data, true);
			$this->email->message($html_email);
			$mail=$this->email->send(); 
		    if($mail)
			{
			$this->session->set_flashdata('success_message', 'Thank you for contact with us.');
            redirect('page/contact-us');
			}
			else
			{
			$this->session->set_flashdata('error_message', 'Something happend,Please try again.');
            redirect('page/contact-us');	
			}
			
	
	}


    public function viewer1($job_id='')
    {
            //$job_id = (int) $this->uri->segment(4);

            $this->load->helper('file');

            $document_obj = $this->db->select('file')->from('jobpost')->where('id', $job_id)->get();

            if ($document_obj->num_rows()) {

                $file_arr = explode('##', $document_obj->row()->file);

                foreach ($file_arr as $key => $file) {
                    if ($file) {
                        $file_path = "./uploads/jobpost/{$file}";
                        $file_info = get_file_info($file_path);
                        $file_type = get_mime_by_extension($file_path);

                        $data['documents'][$key]['document']  = 'jobpost/'.$file;
                        $data['documents'][$key]['file_info'] = $file_info;
                        $data['documents'][$key]['file_type'] = $file_type;
                    }
                }


                $this->load->view('translator/vwDocumentViewer1', $data);
            } else {
                redirect($this->agent->referrer());
            }

        }
    }
		
