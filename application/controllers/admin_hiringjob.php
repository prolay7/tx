<?php error_reporting(0);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_hiringjob extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('adminhiringjob_model');
		$this->load->helper('path');
        if(!$this->session->userdata('is_admin')){
            redirect('admin/login');
        }
		//echo '<pre>'; print_r($this->session->userdata);
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
 		 if($id == NULL){
			$sql = "SELECT * FROM ".$table." WHERE 1 AND `alias` ='".$str."'";
			} else {
			$sql = "SELECT * FROM ".$table." WHERE 1 AND `alias` ='".$str."' AND `id` <> '".$id."'";
			}
			$res = mysql_query($sql);
			$rowcount = mysql_num_rows($res);

			if($rowcount == 0) {
			return $str;
			} else {
			return false;
			}
    		}

    public function index()
    {
        //all the posts sent by the view
        $search_string = $this->input->post('search_string');
        $search_string = preg_replace('/[^A-Za-z0-9\s\-\:]/', '', $search_string);
        $search_string = trim($search_string);

        $order = $this->input->post('order');
        $order_type = $this->input->post('order_type');

        //pagination settings
        $config['per_page'] =10;
        $config['base_url'] = base_url().'admin/hiringjob';
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



            $data['count_hiringjob']= $this->adminhiringjob_model->count_hiringjob($search_string, $order);
            $config['total_rows'] = $data['count_hiringjob'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['hiringjob'] = $this->adminhiringjob_model->get_hiringjob($search_string, $order, $order_type, $config['per_page'],$limit_end);
                }else{
                    $data['hiringjob'] = $this->adminhiringjob_model->get_hiringjob($search_string, '', $order_type, $config['per_page'],$limit_end);
                }
            }else{
                if($order){
                    $data['hiringjob'] = $this->adminhiringjob_model->get_hiringjob('', $order, $order_type, $config['per_page'],$limit_end);
                }else{
                    $data['hiringjob'] = $this->adminhiringjob_model->get_hiringjob('', '', $order_type, $config['per_page'],$limit_end);
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

            $data['count_hiringjob']= $this->adminhiringjob_model->count_hiringjob();
            $data['hiringjob'] = $this->adminhiringjob_model->get_hiringjob('', '', $order_type, $config['per_page'],$limit_end);
            $config['total_rows'] = $data['count_hiringjob'];

          }

        //   echo '<pre>'; print_r($data['count_hiringjob']); exit;

        $this->pagination->initialize($config);
        $this->load->view('admin/jobpost/vwHiringJob',$data);


 }



}
