<?php
error_reporting(0);
/**
* 
*/
class Admin_Compliants extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'path'));
		$this->load->model('compliant_model');
	}


	function index(){
        
		if(!$this->session->userdata('is_admin')){
            redirect('admin/login');
        } else{
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
            $marked_as=$this->input->post('marked_as');
            $per_page=!empty($per_page)?$per_page: $this->session->userdata('per_page_selected');
            $marked_as=!empty($marked_as)?$marked_as: $this->session->userdata('marked_as_selected');
            //echo 'sdfdsfdsfsdf '.$per_page;
            //pagination settings
            $config['per_page'] =!isset($per_page)?$per_page:100;
            $config['base_url'] = base_url().'admin/compliants';
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

                    if($marked_as){
                    	$filter_session_data['marked_as_selected'] = $marked_as;
                    }else{
                        $marked_as = $this->session->userdata('marked_as_selected');
                    }



                    //save session data into the session
                    $this->session->set_userdata($filter_session_data);

                    $data['count_compliants']= $this->compliant_model->count_compliants($search_string, $search_string2,$marked_as,$order);
                    $config['total_rows'] = $data['count_compliants'];

                    //fetch sql data into arrays
                    if($search_string){
                        if($order){
                            $data['compliants'] = $this->compliant_model->get_all_compliants($search_string, $search_string2,$marked_as, $order, $order_type, $per_page,$limit_end, $sort_type);
                        }else{
                            $data['compliants'] = $this->compliant_model->get_all_compliants($search_string, $search_string2,$marked_as,'', $order_type, $per_page,$limit_end, $sort_type);
                        }
                    }else{
                        if($order){
                            $data['compliants'] = $this->compliant_model->get_all_compliants('', '','', $order, $order_type, 100,'', $sort_type);
                        }else{
                            $data['compliants'] = $this->compliant_model->get_all_compliants('', '', '','', $order_type, 100,'', $sort_type);
                        }
                    }
             } else {
                //clean filter data inside section;
                $filter_session_data['search_string_selected'] = null;
                $filter_session_data['search_string_selected2'] = null;
                $filter_session_data['per_page_selected'] = null;
                $filter_session_data['marked_as_selected'] = null;
                $filter_session_data['order'] = null;
                $filter_session_data['order_type'] = null;
                $this->session->set_userdata($filter_session_data);

                //pre selected options
                $data['search_string_selected'] = '';
                $data['search_string_selected2'] = '';
                $data['order'] = 'id';

                //fetch sql data into arrays
                $data['count_compliants']= $this->compliant_model->count_compliants(trim($cyear.'-'.$cmonth));
                $cyear=date('Y');
                $cmonth=date('m');
                $data['compliants'] = $this->compliant_model->get_all_compliants(trim($cyear.'-'.$cmonth),'','','', $order_type,100,'', $sort_type);
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
            $data['marked_as_data']=array('1'=>'Marked as Edit','2'=>'Marked as Error','all_marked'=>'Show All');


            $this->load->view('admin/vwAdminCompliant',$data); 
        }
	}


	public function getinstant_complaiant_notification($type){

		if($type=='notify'){
			$result=$this->compliant_model->get_comaplaint_recent();

			if(!empty($result) || $result!=NULL){
				$return['success']=true;
				$return['job_name']=$result[0]->job_name;
				$return['line_no']=$result[0]->line_no;
				$return['marked_as']=$result[0]->marked_as;
				$translator_ids=comma_separated_to_array($result[0]->translators);
				foreach ($translator_ids as $key => $value) {
					$translators=$this->compliant_model->gettransalator($value);
					$return['translators']=ucwords($translators[0]->first_name.' '.$translators[0]->last_name).'<br>';
				}
				
			}else{
				$return['success']=false;
			}
		}
			

		echo json_encode($return);

	}

    public function rate_translator(){
       //      print_r($_POST);die;
        $job_id=$this->input->post('job_id');
        $translator_id=$this->input->post('translator_id');
   
        $rating=$this->input->post('ratings');

        $found=$this->compliant_model->getratings($job_id,$translator_id);
        $return['found']=$found;
        if(!empty($found) || $found!=null){
             $update=$this->compliant_model->update_rating(['rating'=>$rating,'date_rated'=>date('Y-m-d H:i:s')],['job_id'=>$job_id,'translator_id'=>$translator_id]);
             $return['step1']=1;
        }else if(empty($found) || $found==null){
             $update=$this->compliant_model->insert_rating(['job_id'=>$job_id,'translator_id'=>$translator_id,'rating'=>$rating,'date_rated'=>date('Y-m-d H:i:s')]);
               $return['step2']=2;
        }
       
       //print_r($update);die;
        if($update){
            $return['success']='Rating updated';
        }else{
            $return['error']='Rating not updated';
        }

        echo json_encode($return);

    }


	function reset()
    {
        //echo 'test';die;

        $this->session->unset_userdata('search_string_selected');
        $this->session->unset_userdata('search_string_selected2');
        $this->session->set_userdata('per_page_selected',100);
        redirect(base_url().'admin/compliants');
    }
}