<?php
error_reporting(1);
class Cs_admin extends CI_Controller {

    /**
    * Check if the admin is logged in, if he's not,
    * send him to the login page
    * @return void
    */

    function __construct() {
		parent::__construct();
//		print $this->session->userdata('admin_type');exit();
    	if($this->session->userdata("admin_type") != 3) {
			redirect('admin');
		}
		$this->load->model('adminjobpost_model');
		$this->load->model('csadminjobpost_model');

        date_default_timezone_set('America/New_York');
    }
    
    public function testing() {
       echo 'test';

   }

    public function upload()
    {
		error_reporting(E_ALL);

        if (isset($_FILES["myfile"])) {
            $newRet  = "";
            $ret =  array();
            $error =$_FILES["myfile"]["error"];

            if (!is_array($_FILES["myfile"]['name'])) {
                $newdir=time();
                $output_dir = "./uploads/jobpost/".$newdir."/";
                $dir = $newdir."/";

                if (!is_dir($output_dir)) {
                    mkdir($output_dir);
                }

                $RandomNum = time();
                if (!is_dir($output_dir)) {
                    mkdir($output_dir);
                }
                $RandomNum = time();
                if(!preg_match('/[^\x20-\x7f]/',$_FILES['myfile']['name'])){
                    $ImageName = $_FILES['myfile']['name'];
                }else {
                    if (strpos($_FILES['myfile']['name'], '.') != false) {
                        $ext = '.' . end(explode('.', $_FILES['myfile']['name']));
                    } else {
                        $ext = '';
                    }
                    $ImageName = time() . $ext;
                }
                $NewImageName = $ImageName;

                move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir. $NewImageName);
                $newRet .= $dir.$NewImageName."##";
                echo $newRet;
            }
        }

        exit;
	}

	function linkdelete() {
		$id=$this->input->post('id');

		$path = './uploads/jobpost/'.$id;
		unlink($path);
		echo "Remove sucessfully";
	}

	function UrlAlias ($string, $table, $id = NULL) {
        //remove any '-' from the string they will be used as concatonater
        $str = str_replace('-', ' ', $string);
        $str = str_replace('_', ' ', $string);
        // remove any duplicate whitespace, and ensure all characters are alphanumeric
        $str = preg_replace(array('/\s+/','/[^A-Za-z0-9\-]/'), array('-',''), $str);

        // lowercase and trim
        $str = trim(strtolower($str));

  		// checking if in db or not
 		if($id == NULL) {
			$sql = "SELECT * FROM ".$table." WHERE 1 AND `alias` ='".$str."'";
		} else {
			$sql = "SELECT * FROM ".$table." WHERE 1 AND `alias` ='".$str."' AND `id` <> '".$id."'";
		}

		$res = mysql_query($sql);
		$rowcount = mysql_num_rows($res);

		if($rowcount == 0) {
			return $str;
		} else {
			$number=mt_rand ( 100 , 999);
			return $str.$number;
			//return false;
		}
    }

	function index() {
		$data['message_error'] = "";
		$data['message_success'] = "";
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        	$this->form_validation->set_rules('name', 'jobpost Job Name', 'required');
			$this->form_validation->set_rules('clientName', 'jobpost Client Name', 'required');
			$this->form_validation->set_rules('price', 'jobpost Price', 'trim|required|numeric');
			$this->form_validation->set_rules('desc', 'jobpost Description', 'required');
			$this->form_validation->set_rules('language', 'jobpost Language', 'required');
			$this->form_validation->set_rules('stage', 'jobpost Stage', 'required');
			$this->form_validation->set_rules('lineNumber', 'Line Number', 'trim|numeric');

		    if ($this->form_validation->run())
	        {
				$alias = $this->input->post('alias');
				$name = $this->input->post('name');

				if($alias == '') {
	       			$str = $this->UrlAlias($name, 'jobpost');
	        	} else {
	       		 	$str = $this->UrlAlias($alias,'jobpost');
	        	}

				if($str) {
                    $line_month = $this->input->post('lineMonth') ? $this->input->post('lineMonth') : $this->input->post('_lineMonth');
                    $line_year = $this->input->post('lineYear') ? $this->input->post('lineYear') : $this->input->post('_lineYear');
                    $line_number = $this->input->post('lineNumber') ? $this->input->post('lineNumber') : $this->input->post('_lineNumber');

                    $line_number_code = 'M'.$line_month.$line_year.'L'.$line_number;

	                $data_to_store = array(
	                    'name' => $this->input->post('name'),
	                    'file_link' => $this->input->post('file_link',TRUE),
						'alias'=> $str,
						'file' => $this->input->post('totalFile'),
	                    'description' => $this->input->post('desc'),
						/*'language_from' => $this->input->post('language_from'),*/
						'language' => $this->input->post('language_from')."/".$this->input->post('language'),
						'price' => $this->input->post('price'),
						'totalFile' => $this->input->post('totalFile'),
						'status' => 0,
						'stage' => $this->input->post('stage'),
						'job_type' =>$this->input->post('type'),
						'created' => date('Y-m-d H:i:s'),

						'lineNumberCode' => $line_number_code,
						'lineNumber' => $line_number,
						'lineMonth' => $line_month,
						'lineYear' => $line_year,
						'approval_status' => 0,
						'csCreator' => $this->session->userdata('admin_id'),
						'dueDate' => $this->input->post('dueDate').' '.$this->input->post('hour').':'.$this->input->post('minute').' '.$this->input->post('ampm'),
						'clientName' => $this->input->post('clientName'),
	                );

	                if($this->adminjobpost_model->store_jobpost($data_to_store)) {
						$data['message_success'] = "Job Successfully Sent For Admin Approval";
					 	$this->load->view("admin/cust_service/vwAddJobPost", $data);
					}
				}
				else
				{
					$data['message_error'] =  "Please try another alias!";
				}
	    	} else {
	    		$data['curr_values'] = $this->input->post();
	    		$this->load->view("admin/cust_service/vwAddJobPost", $data);
	    	}

		} else {
			$this->load->view("admin/cust_service/vwAddJobPost", $data);
		}
	}
	function listsJobApproval(){
		//all the posts sent by the view
        $search_string = $this->input->post('search_string');
        $order = $this->input->post('order');
        $order_type = $this->input->post('order_type');
		$csCreator = $this->session->userdata("admin_id");
        //pagination settings
        $config['per_page'] =10;
        $config['base_url'] = base_url().'cs_admin/csListForApprovalJobs';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';

        $page = $this->uri->segment(3);

        $limit_end=($page * $config['per_page']) - $config['per_page'];
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

                $order_type = 'Asc';
            }
        }

        $data['order_type_selected'] = $order_type;

        if($search_string !='' || $order !='' || $this->uri->segment(3) == true){

			 if($search_string){
                $filter_session_data['search_string_selected'] = $search_string;
            }else{
                $search_string =$this->session->userdata('search_string_selected');
				$filter_session_data['search_string_selected'] = $search_string;
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



            $data['count_jobpost']= $this->csadminjobpost_model->count_jobpost($csCreator,$search_string, $order);
            $config['total_rows'] = $data['count_jobpost'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['jobpost'] = $this->csadminjobpost_model->get_jobpost($csCreator, $search_string, $order, $order_type, $config['per_page'],$limit_end);
                }else{
                    $data['jobpost'] = $this->csadminjobpost_model->get_jobpost($csCreator, $search_string, '', $order_type, $config['per_page'],$limit_end);
                }
            }else{
                if($order){
                    $data['jobpost'] = $this->csadminjobpost_model->get_jobpost($csCreator,'', $order, $order_type, $config['per_page'],$limit_end);
                }else{
                    $data['jobpost'] = $this->csadminjobpost_model->get_jobpost($csCreator,'', '', $order_type, $config['per_page'],$limit_end);
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['search_string_selected'] = null;
			$filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays

            $data['count_jobpost']= $this->csadminjobpost_model->count_jobpost($csCreator);
            $data['jobpost'] = $this->csadminjobpost_model->get_jobpost($csCreator,'', '', $order_type, $config['per_page'],$limit_end);
            $config['total_rows'] = $data['count_jobpost'];

          }
        $this->pagination->initialize($config);

      	$this->load->view("admin/cust_service/vwListsJobPost", $data);



	}


	function saveJobApproval() {
		$this->form_validation->set_rules('name', 'jobpost Job Name', 'required');
		$this->form_validation->set_rules('clientName', 'jobpost Client Name', 'required');
		$this->form_validation->set_rules('price', 'jobpost Price', 'trim|required|numeric');
		$this->form_validation->set_rules('desc', 'jobpost Description', 'required');
/*			$this->form_validation->set_rules('language_from', 'jobpost language From', 'required');*/
		$this->form_validation->set_rules('language', 'jobpost Language', 'required');
		$this->form_validation->set_rules('stage', 'jobpost Stage', 'required');
		$this->form_validation->set_rules('totalFile', 'upload file ', 'required');
		$this->form_validation->set_rules('lineNumber', 'Line Number', 'trim|numeric|required');

	    if ($this->form_validation->run())
        {

			$alias = $this->input->post('alias');
			$name = $this->input->post('name');

			if($alias == '') {
       			$str = $this->UrlAlias($name, 'jobpost');
        	} else {
       		 	$str = $this->UrlAlias($alias,'jobpost');
        	}

			if($str) {
                $data_to_store = array(
                    'name' => $this->input->post('name'),
					'alias'=> $str,
					'file' => $this->input->post('totalFile'),
                    'description' => $this->input->post('desc'),
					/*'language_from' => $this->input->post('language_from'),*/
					'language' => $this->input->post('language_from')."/".$this->input->post('language'),
					'price' => $this->input->post('price'),
					'totalFile' => $this->input->post('totalFile'),
					'status' => 0,
					'stage' => $this->input->post('stage'),
					'job_type' =>$this->input->post('type'),
					'created' => date('Y-m-d h:i:s'),

					'lineNumberCode' => "M".$this->input->post('lineMonth').$this->input->post('lineYear')."L".$this->input->post('lineNumber'),
					'lineNumber' => $this->input->post('lineNumber'),
					'lineMonth' => $this->input->post('lineMonth'),
					'lineYear' => $this->input->post('lineYear'),
					'approval_status' => 0,
					'csCreator' => $this->session->userdata('admin_id'),
					'dueDate' => $this->input->post('dueDate'),
					'clientName' => $this->input->post('clientName'),
                );

                if($this->adminjobpost_model->store_jobpost($data_to_store)) {
     //                //$data['message_success'] = "jobpost added successfully.";
					// $job_id = $this->db->insert_id();
					// $sql1 = "select * from jobpost where id=$job_id and job_type=0";
					// $val1 = $this->db->query($sql1);
					// $check = $val1->num_rows();
					// if($check == 1){
					// 	$rows = $val1->row();

					// 	$job_name = $rows->name;
					// 	$job_desc = $rows->description;
					// 	$job_alias = $rows->alias;

					// 	$job_language = $rows->language;
					// 	$inIds = "'".str_replace("/", "','", $job_language)."'";
					// 	$sql_lan = "SELECT name FROM `languages` WHERE `id` IN(".$inIds.")";

					// 	$val_lan = $this->db->query($sql_lan);
					// 	$lang = $val_lan->result_array();
					// 	$lang2 = $lang[0]['name'].' to '.$lang[1]['name'];

					// 	$lang = $this->input->post('language_from')."/".$this->input->post('language');
					// 	$sql = "SELECT * FROM translator WHERE language like '%".",".$lang.","."%' ";
					// 	//echo $sql;die;
					// 	$val = $this->db->query($sql);
					// 	$row_email = $val->result();

					// 	$data = array(
					// 		'job_name' => $job_name,
					// 		'description' => $job_desc,
					// 		'job_alias' => $job_alias,
					// 		'translate_to'=> $lang2,
					// 		'created' => date('Y-m-d h:i:s')
					// 	);

					// 	foreach ($row_email as $key => $value)
					// 	{
					// 		$mailTo = $value->email_address;
					// 		//echo $mailTo;die;
					// 		$mailName = $value->first_name;
					// 		$mailhash = $value->hash;

					// 		$mailId=$value->id;
					// 		$data['name'] = $mailName;
					// 		$data['hash'] = $mailhash;
					// 		$data['id'] = $mailId;
					// 		$this->email->set_mailtype("html");
					// 		$this->email->from('info@montesinotranslation.com');
					// 		$this->email->to($mailTo);
					// 		$this->email->subject('Invitation');
					// 		$html_email = $this->load->view('email/vwTranslatorSend', $data ,true);
					// 		$this->email->message($html_email);
					// 		$this->email->send();
					// 	}
					// }
				 	$data['message_success'] = "Job Successfully Sent For Admin Approval";
				}
			}
			else
			{
				$data['message_error'] =  "Please try another alias!";
			}
    	}
    	$this->load->view("admin/cust_service/vwAddJobPost", $data);
	}



    public function delete()
	{
		$id = $this->uri->segment(3);
	   //echo $id;die;
		$sql = "SELECT * FROM jobpost WHERE id = " . $id . " ";
		$val = $this->db->query($sql);
		$row = $val->row_array();

		$this->csadminjobpost_model->delete_jobpost($id);
		$this->session->set_flashdata('success_message', 'Successfully Deleted');
		redirect('cs_admin/listsJobApproval');
	}

	public function pendingEditApproval($job_id)
    {
		$data['message_error'] = "";
		$data['message_success'] = "";
		if($this->input->post("name")) {
				$sql="SELECT * FROM `jobpost` where `id`='$job_id' ";
				$qry=$this->db->query($sql);
				$data['fetch']=$qry->row();

				$this->form_validation->set_rules('name', 'jobpost Job Name', 'required');
				$this->form_validation->set_rules('clientName', 'jobpost Client Name', 'required');
				$this->form_validation->set_rules('desc', 'jobpost Description', 'required');
				$this->form_validation->set_rules('language', 'jobpost Language', 'required');
				$this->form_validation->set_rules('lineNumber', 'Line Number', 'trim|numeric|required');

			    if ($this->form_validation->run() == FALSE) {

					$this->load->view('admin/cust_service/vwPostJobForApproval', $data);

				} else {
					$number_of_files = sizeof($_FILES['userfile']['tmp_name']);
					$files = $_FILES['userfile'];

						$name = $this->input->post('name');
						$prefile = $this->input->post('prefile');
						$newfile = $prefile.$this->input->post('totalFile');
						$str = $this->UrlAlias($name,'jobpost',$job_id);
						if($str) {
							$proofread_required = 0;
							$proofreadType = "";
							if($this->input->post('proofread_required') && !is_null($this->input->post('proofread_required'))) {
								$proofread_required = $this->input->post("proofread_required");
							}

							if($this->input->post('proofreadType') && !is_null($this->input->post('proofreadType'))) {
								$proofreadType = $this->input->post("proofreadType");
							}

                            $due_date = $this->input->post('dueDate').' '.$this->input->post('hour').':'.$this->input->post('minute').' '.$this->input->post('ampm');

							$lineNumberCode = 'M'.$this->input->post('lineMonth').$this->input->post('lineYear').'L'.$this->input->post('lineNumber');

							$today = date('Y-m-d H:i:s');

							$val = $this->db->update('jobpost',
                                array(
							        'name' => $this->input->post('name'),
                                    'clientName' => $this->input->post('clientName'),
                                    'description' => $this->input->post('desc'),
                                    'job_type' => $this->input->post('type'),
                                    'language' => $this->input->post('language_from')."/". $this->input->post('language'),
                                    'price' => $this->input->post('price'),
                                    'file' => $newfile,
                                    'stage' => 0,
                                    'status' => 1,
                                    'modified' => $today,
                                    'lineNumberCode' => $lineNumberCode,
                                    'lineNumber' => $this->input->post('lineNumber'),
                                    'lineMonth' => $this->input->post('lineMonth'),
                                    'lineYear' => $this->input->post('lineYear'),
                                    'approval_status' => 0,
                                    'dueDate' => $due_date,
                                    'clientName' => $this->input->post('clientName')
                                ),
                                array('id' => $job_id)
                            );

							$path = './uploads/jobpost/'.$this->input->post('prefile');
							unlink($path);
						} else {
							$this->session->set_flashdata('error_message', 'Please try another alias!');
							redirect('cs_admin/pendingEditApproval/'.$job_id);
						}

						if ($val == TRUE) {
							$sql1 = "select * from jobpost where id='".$job_id."' and job_type=0";
							$val1 = $this->db->query($sql1);
							$check = $val1->num_rows();

							if ($check == 1) { // if public
								$rows = $val1->row();
								$job_name = $rows->name;
								$job_desc = $rows->description;
								$job_alias = $rows->alias;

								$job_language = $rows->language;
								$inIds = "'".str_replace("/", "','", $job_language)."'";
								$sql_lan = "SELECT name FROM `languages` WHERE `id` IN(".$inIds.")";
								$val_lan = $this->db->query($sql_lan);
								$lang = $val_lan->result_array();
								$lang2 = $lang[0]['name'].' to '.$lang[1]['name'];

								$lang = $this->input->post('language_from')."/". $this->input->post('job_language') ;

								$sql = "SELECT * FROM translator WHERE language like '%".",".$lang.","."%' ";
								$val = $this->db->query($sql);
								$row_email = $val->result();

								$data = array(
									'job_name' => $job_name,
									'description' => $job_desc,
									'translate_to'=>$lang2,
									'job_alias' => $job_alias,
									'created' => date('Y-m-d h:i:s')
								);

								foreach ($row_email as $key => $value) {
									$mailTo = $value->email_address;
									$mailName = $value->first_name;
									$mailhash = $value->hash;

									$mailId=$value->id;
									$data['name'] = $mailName;
									$data['hash'] = $mailhash;
									$data['id'] = $mailId;
									$this->email->set_mailtype("html");
									$this->email->from('info@montesinotranslation.com');
									$this->email->to($mailTo);
									$this->email->subject('Invitation');
									$html_email = $this->load->view('email/vwTranslatorSend', $data ,true);
									$this->email->message($html_email);
									 $this->email->send();
								}
							}

							$this->session->set_flashdata('success_message', 'Job has been successfully approved');
							redirect('cs_admin/pendingEditApproval/'.$job_id);
						} else {
							$this->session->set_flashdata('error_message', 'Not Updated');
							redirect('cs_admin/pendingEditApproval/'.$job_id);
						}


		      	}
			} else {
			    $sql="SELECT * FROM `jobpost` where `id`='$job_id' ";
				$qry=$this->db->query($sql);
				if($qry->num_rows()=='1')
				{
			        $data['fetch']=$qry->row();
					$this->load->view('admin/cust_service/vwPostJobForApproval', $data);
				}
			}
		}


    public function removefile()
    {
        if ($this->session->userdata('admin_type') == 3) {
            $id = $this->uri->segment(3);
            $old=$this->uri->segment(4);
            $oldf=$this->uri->segment(5);
            if($oldf == ''){
                $oldfile=$old.'##';
            }else{
                $oldfile=$old.'/'.$oldf.'##';}
            //echo $oldfile;die;
            $sql = "SELECT * FROM jobpost WHERE id = " . $id . " ";
            $val = $this->db->query($sql);
            $row = $val->row_array();
            $file = $row['file'];
            //echo"$file";die;
            $filename = strstr($file, '/',true);
            if($oldf == ''){
                $old=$old;
            }else{
                $old=$old.'/'.$oldf;}
            //echo './uploads/jobpost/'.$old; die;
            $path = './uploads/jobpost/'.$old;
            unlink($path);
            //echo $file ;
            $string = str_replace($oldfile, "", $file);
            //echo $string;die;
            $sql1 = "UPDATE `jobpost` SET
    					`file`   = '".$string."'
    					 WHERE `id` = '" .$id. "'";

            $val1 = $this->db->query($sql1);
            $this->session->set_flashdata('success_message', 'Successfully Removed');
            redirect($this->agent->referrer());
        }
    }

    public function get_job_price()
    {
        $line_month  = $this->input->get('line_month');
        $line_year   = $this->input->get('line_year');
        $line_number = $this->input->get('line_number');

        $sql = "SELECT * FROM jobpost WHERE lineMonth = {$line_month} AND lineYear = {$line_year} AND lineNumber = {$line_number} ORDER BY created DESC";
        $query = $this->db->query($sql);

        $ids = null;

        if ($query->num_rows()) {

            $job_info = $query->result_array();

            foreach ($job_info as $job) {
                $ids_arr[] = $job['id'];
            }

            $ids = implode(',', $ids_arr);

            // get total expenses for the selected jobpost
            $sql = "SELECT SUM(price) AS price FROM bidjob WHERE awarded = 1 AND job_id IN ({$ids})";
            $bidjob_query = $this->db->query($sql);

            $total_bidjob = $bidjob_query->row();

            $remaining_balance = $job_info[0]['price'] - $total_bidjob->price;

            $data_string = [
                'price' => $remaining_balance,
                'original_price' => $job_info[0]['price'],
                'bid_price' => $total_bidjob->price
            ];

            $data = json_encode($data_string);

        } else {
            $data = null;
        }

        echo $data; exit;
    }

    public function check_line_numbers()
    {
        $line_month  = $this->input->get('line_month');
        $line_year   = $this->input->get('line_year');
        $line_number = $this->input->get('line_number');

        if ($line_number and $line_month and $line_year) {
            $sql = "SELECT * FROM jobpost WHERE lineMonth = {$line_month} AND lineYear = {$line_year} AND lineNumber = {$line_number}";
            $query = $this->db->query($sql);

            if ($query->num_rows()) {
                $check_obj = $query->row();

                $language = explode('/', $check_obj->language);

                $sql = "SELECT `name` FROM languages WHERE id = {$language[0]}";
                $qry_from = $this->db->query($sql);
                $from_lang = $qry_from->row();

                $sql = "SELECT `name` FROM languages WHERE id = {$language[1]}";
                $qry_to = $this->db->query($sql);
                $to_lang = $qry_to->row();

                $data_string = [
                    'job_name'      => $check_obj->name,
                    'language_from' => $from_lang->name,
                    'language_to'   => $to_lang->name,
                    'price'         => $check_obj->price,
                    'date_added'    => date('jS F Y', strtotime($check_obj->created))
                ];

                $data = json_encode($data_string);
            } else {
                $data = null;
            }
        } else {
            $data = null;
        }


        echo $data; exit;
    }

    public function viewer()
    {
        $job_id   = (int) $this->uri->segment(3);
        $document = base64_decode($this->uri->segment(4));

        $this->load->helper('file');

        $document_obj = $this->db->select('file')->from('jobpost')->where('id', $job_id)->get();

        if ($document_obj->num_rows()) {

            $file_arr = explode('##', $document_obj->row()->file);

            foreach ($file_arr as $key => $file) {
                if ($file == $document) {
                    $file_path = "./uploads/jobpost/{$file}";
                    $file_info = get_file_info($file_path);
                    $file_type = get_mime_by_extension($file_path);

                    $data['documents'][$key]['document']  = 'jobpost/'.$file;
                    $data['documents'][$key]['file_info'] = $file_info;
                    $data['documents'][$key]['file_type'] = $file_type;

                    break;
                }
            }

            $this->load->view('admin/jobpost/vwAdminJobDocumentViewer', $data);
        } else {
            redirect('cs_admin/csListForApprovalJobs');
        }
    }
}
