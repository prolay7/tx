<?php error_reporting(0);

class Admin_profit extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('jobprofit_model');
    }


    function index()
    {
        $admin_id = $this->session->userdata('admin_id');
        $adminsql = "select `admin_type` from `admin` where `id`='$admin_id' ";
        $adminquery = $this->db->query($adminsql);
        $adminfetch = $adminquery->row();
        $admin_type = $adminfetch->admin_type;

        if (in_array($admin_type, array('1', '5'))) {
            //all the posts sent by the view
            $search_string = $this->input->post('search_string');
            $start_date = $this->input->post('invoiceDateFrom');
            $end_date = $this->input->post('invoiceDateTo');
            $lang_from = $this->input->post('language_from');
            $lang_to = $this->input->post('language_to');
            $lang_check_reverse = $this->input->post('lang_reverse_search');
            $search_string = preg_replace('/[^A-Za-z0-9\s\-\:]/', '', $search_string);
            $search_string = trim($search_string);
            $order = $this->input->post('order');
            $order_type = $this->input->post('order_type');
            //pagination settings
            $config['per_page'] = 12;
            $config['base_url'] = base_url() . 'admin/profit';
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = 20;
            $config['full_tag_open'] = '<ul>';
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';

            $page = $this->uri->segment(3);

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
                    $order_type = 'Asc';
                }
            }
            $data['order_type_selected'] = $order_type;
            if ($search_string != '' || $order != '' || $this->uri->segment(3) == true) {
                if ($this->input->post('percentage_from') != '' || $this->input->post('percentage_to') != '' || $this->session->userdata('percentage_from') != false || $this->session->userdata('percentage_to') != false) {
                    $percentage_from = $this->input->post('percentage_from');
                    $percentage_to = $this->input->post('percentage_to');
                    if ($percentage_from != '' || $percentage_to != '') {
                        $filter_session_data['percentage_from'] = $percentage_from;
                        $filter_session_data['percentage_to'] = $percentage_to;
                        if($percentage_from == ''){
                            $this->session->unset_userdata('percentage_from');
                        }
                        if($percentage_to == ''){
                            $this->session->unset_userdata('percentage_to');
                        }
                    } elseif ($this->session->userdata('percentage_from') != false || $this->session->userdata('percentage_to') != false) {

                        if($this->session->userdata('percentage_from')!= false) {
                            $percentage_from = $this->session->userdata('percentage_from');
                        }else{
                            $percentage_from = '';
                        }
                        if($this->session->userdata('percentage_to') != false){
                            $percentage_to = $this->session->userdata('percentage_to');
                        }else{
                            $percentage_to = '';
                        }
                    }
                    if ($start_date != '' && $end_date != '') {
                        $filter_session_data['start_date'] = $start_date;
                        $filter_session_data['end_date'] = $end_date;
                    } elseif ($this->session->userdata('start_date') != false) {
                        $start_date = $this->session->userdata('start_date');
                        $end_date = $this->session->userdata('end_date');
                    }


                    if ($lang_from != '' && $lang_to != '') {
                        $filter_session_data['lang_from'] = $lang_from;
                        $filter_session_data['lang_to'] = $lang_to;
                    } elseif ($this->session->userdata('lang_from') != false) {
                        $lang_from = $this->session->userdata('lang_from');
                        $lang_to = $this->session->userdata('lang_to');
                    }

                    if ($lang_check_reverse != false) {
                        $filter_session_data['lang_check_reverse'] = $lang_check_reverse;
                    } elseif ($this->session->userdata('lang_check_reverse') != false) {
                        if ($this->input->server('REQUEST_METHOD') != 'POST') {
                            $lang_check_reverse = $this->session->userdata('lang_check_reverse');
                        } else {
                            $this->session->unset_userdata('lang_check_reverse');
                        }
                    }
                    $filter_session_data['search_string_selected'] = null;
                    $filter_session_data['order'] = null;
                    $filter_session_data['order_type'] = null;
                    $this->session->set_userdata($filter_session_data);
                    $data['jobprofit'] = $this->jobprofit_model->get_jobprofit($search_string, $order, $order_type, $config['per_page'], $limit_end, $start_date, $end_date, $lang_from, $lang_to, $lang_check_reverse);

                    //pre selected options
                    $data['search_string_selected'] = '';
                    $data['order'] = 'id';
                    $data['count_jobprofit'] = $this->jobprofit_model->count_jobprofit('', '', $start_date, $end_date, 0, $lang_from, $lang_to, $lang_check_reverse, $percentage_from,$percentage_to);
                    $data['jobprofit'] = $this->jobprofit_model->get_jobprofit('', '', $order_type, $config['per_page'], $limit_end, $start_date, $end_date, $lang_from, $lang_to, $lang_check_reverse, $percentage_from,$percentage_to);

                    $data['finance_summary'] = $this->jobprofit_model->get_finance_summary('', $start_date, $end_date, $lang_from, $lang_to, $lang_check_reverse, $percentage_from,$percentage_to);
                    $config['total_rows'] = $data['count_jobprofit'];
                } else {
                    if ($search_string) {
                        $filter_session_data['search_string_selected'] = $search_string;
                    } else {
                        $search_string = $this->session->userdata('search_string_selected');
                        $filter_session_data['search_string_selected'] = $search_string;
                    }

                    $data['search_string_selected'] = $search_string;

                    if ($start_date != '' && $end_date != '') {
                        $filter_session_data['start_date'] = $start_date;
                        $filter_session_data['end_date'] = $end_date;
                    } elseif ($this->session->userdata('start_date') != false) {
                        $start_date = $this->session->userdata('start_date');
                        $end_date = $this->session->userdata('end_date');
                    }


                    if ($lang_from != '' && $lang_to != '') {
                        $filter_session_data['lang_from'] = $lang_from;
                        $filter_session_data['lang_to'] = $lang_to;
                    } elseif ($this->session->userdata('lang_from') != false) {
                        $lang_from = $this->session->userdata('lang_from');
                        $lang_to = $this->session->userdata('lang_to');
                    }

                    if ($lang_check_reverse != false) {
                        $filter_session_data['lang_check_reverse'] = $lang_check_reverse;
                    } elseif ($this->session->userdata('lang_check_reverse') != false) {
                        if ($this->input->server('REQUEST_METHOD') != 'POST') {
                            $lang_check_reverse = $this->session->userdata('lang_check_reverse');
                        } else {
                            $this->session->unset_userdata('lang_check_reverse');
                        }
                    }

                    if ($order) {
                        $filter_session_data['order'] = $order;
                    } else {
                        $order = $this->session->userdata('order');
                    }

                    $data['order'] = $order;

                    //save session data into the session
                    $this->session->set_userdata($filter_session_data);

                    $data['count_jobprofit'] = $this->jobprofit_model->count_jobprofit($search_string, $order, $start_date, $end_date, 0, $lang_from, $lang_to, $lang_check_reverse);
                    $config['total_rows'] = $data['count_jobprofit'];

                    //fetch sql data into arrays
                    if ($search_string) {
                        if ($order) {
                            $data['jobprofit'] = $this->jobprofit_model->get_jobprofit($search_string, $order, $order_type, $config['per_page'], $limit_end, $start_date, $end_date, $lang_from, $lang_to, $lang_check_reverse);
                        } else {
                            $data['jobprofit'] = $this->jobprofit_model->get_jobprofit($search_string, '', $order_type, $config['per_page'], $limit_end, $start_date, $end_date, $lang_from, $lang_to, $lang_check_reverse);
                        }
                        $data['finance_summary'] = $this->jobprofit_model->get_finance_summary($search_string, $start_date, $end_date, $lang_from, $lang_to, $lang_check_reverse);
                    } else {
                        if ($order) {
                            $data['jobprofit'] = $this->jobprofit_model->get_jobprofit('', $order, $order_type, $config['per_page'], $limit_end, $start_date, $end_date, $lang_from, $lang_to, $lang_check_reverse);
                            $data['finance_summary'] = $this->jobprofit_model->get_finance_summary('', $order, $start_date, $end_date, $lang_from, $lang_to, $lang_check_reverse);
                        } else {
                            $data['jobprofit'] = $this->jobprofit_model->get_jobprofit('', '', $order_type, $config['per_page'], $limit_end, $start_date, $end_date, $lang_from, $lang_to, $lang_check_reverse);
                            $data['finance_summary'] = $this->jobprofit_model->get_finance_summary('', $start_date, $end_date, $lang_from, $lang_to, $lang_check_reverse);
                        }
                    }
                }
            } else {
                if ($this->input->post('percentage_from') != '' || $this->input->post('percentage_to')!= '' || $this->session->userdata('percentage_from') != false || $this->session->userdata('percentage_to') != false) {
                    $percentage_from = $this->input->post('percentage_from');
                    $percentage_to = $this->input->post('percentage_to');
                    if ($percentage_from != '' || $percentage_to != '') {
                        if($percentage_from!= '') {
                            $filter_session_data['percentage_from'] = $percentage_from;
                        }
                        if($percentage_to != ''){
                            $filter_session_data['percentage_to'] = $percentage_to;
                        }
                        if($percentage_from == ''){
                            $this->session->unset_userdata('percentage_from');
                        }
                        if($percentage_to == ''){
                            $this->session->unset_userdata('percentage_to');
                        }
                    } elseif ($this->session->userdata('percentage_from') != false || $this->session->userdata('percentage_to')!= false) {
                        if($this->session->userdata('percentage_from')!= false) {
                            $percentage_from = $this->session->userdata('percentage_from');
                        }else{
                            $percentage_from = '';
                        }
                        if($this->session->userdata('percentage_to')!= false){
                            $percentage_to = $this->session->userdata('percentage_to');
                        }else{
                            $percentage_to = '';
                        }
                    }

                    if ($start_date != '' && $end_date != '') {
                        $filter_session_data['start_date'] = $start_date;
                        $filter_session_data['end_date'] = $end_date;
                    } elseif ($this->session->userdata('start_date') != false) {
                        $start_date = $this->session->userdata('start_date');
                        $end_date = $this->session->userdata('end_date');
                    }


                    if ($lang_from != '' && $lang_to != '') {
                        $filter_session_data['lang_from'] = $lang_from;
                        $filter_session_data['lang_to'] = $lang_to;
                    } elseif ($this->session->userdata('lang_from') != false) {
                        $lang_from = $this->session->userdata('lang_from');
                        $lang_to = $this->session->userdata('lang_to');
                    }

                    if ($lang_check_reverse != false) {
                        $filter_session_data['lang_check_reverse'] = $lang_check_reverse;
                    } elseif ($this->session->userdata('lang_check_reverse') != false) {
                        if ($this->input->server('REQUEST_METHOD') != 'POST') {
                            $lang_check_reverse = $this->session->userdata('lang_check_reverse');
                        } else {
                            $this->session->unset_userdata('lang_check_reverse');
                        }
                    }
                    $filter_session_data['search_string_selected'] = null;
                    $filter_session_data['order'] = null;
                    $filter_session_data['order_type'] = null;
                    $this->session->set_userdata($filter_session_data);

//                    $data['jobprofit'] = $this->jobprofit_model->get_jobprofit($search_string, $order, $order_type, $config['per_page'], $limit_end, $start_date, $end_date, $lang_from, $lang_to, $lang_check_reverse);
                    //pre selected options
                    $data['search_string_selected'] = '';
                    $data['order'] = 'id';
                    $data['count_jobprofit'] = $this->jobprofit_model->count_jobprofit('', '', $start_date, $end_date, 0, $lang_from, $lang_to, $lang_check_reverse, $percentage_from,$percentage_to);
                    $data['jobprofit'] = $this->jobprofit_model->get_jobprofit('', '', $order_type, $config['per_page'], $limit_end, $start_date, $end_date, $lang_from, $lang_to, $lang_check_reverse, $percentage_from,$percentage_to);

                    $data['finance_summary'] = $this->jobprofit_model->get_finance_summary('', $start_date, $end_date, $lang_from, $lang_to, $lang_check_reverse, $percentage_from,$percentage_to);
                    $config['total_rows'] = $data['count_jobprofit'];
                } else {

                    //Setting search data to session for pegination, also to show on view page search text fields
                    if ($start_date != '' && $end_date != '') {
                        $filter_session_data['start_date'] = $start_date;
                        $filter_session_data['end_date'] = $end_date;
                    } elseif ($this->session->userdata('start_date') != false) {
                        $start_date = $this->session->userdata('start_date');
                        $end_date = $this->session->userdata('end_date');
                    }


                    if ($lang_from != '' && $lang_to != '') {
                        $filter_session_data['lang_from'] = $lang_from;
                        $filter_session_data['lang_to'] = $lang_to;
                    } elseif ($this->session->userdata('lang_from') != false) {
                        $lang_from = $this->session->userdata('lang_from');
                        $lang_to = $this->session->userdata('lang_to');
                    }

                    if ($lang_check_reverse != false) {
                        $filter_session_data['lang_check_reverse'] = $lang_check_reverse;
                    } elseif ($this->session->userdata('lang_check_reverse') != false) {
                        if ($this->input->server('REQUEST_METHOD') != 'POST') {
                            $lang_check_reverse = $this->session->userdata('lang_check_reverse');
                        } else {
                            $this->session->unset_userdata('lang_check_reverse');
                        }
                    }

                    //clean filter data inside section
                    $filter_session_data['search_string_selected'] = null;
                    $filter_session_data['order'] = null;
                    $filter_session_data['order_type'] = null;
                    $this->session->set_userdata($filter_session_data);

                    //pre selected options
                    $data['search_string_selected'] = '';
                    $data['order'] = 'id';
                    //fetch sql data into arrays
                    if ($start_date != '' && $end_date != '') {
                        $data['count_jobprofit'] = $this->jobprofit_model->count_jobprofit('', '', $start_date, $end_date, 0, $lang_from, $lang_to, $lang_check_reverse);
                        $data['jobprofit'] = $this->jobprofit_model->get_jobprofit('', '', $order_type, $config['per_page'], $limit_end, $start_date, $end_date, $lang_from, $lang_to, $lang_check_reverse);

                        $data['finance_summary'] = $this->jobprofit_model->get_finance_summary('', $start_date, $end_date, $lang_from, $lang_to, $lang_check_reverse);
                    } else {
                        $data['count_jobprofit'] = $this->jobprofit_model->count_jobprofit('', '', '', '', 0, $lang_from, $lang_to, $lang_check_reverse);
                        $data['jobprofit'] = $this->jobprofit_model->get_jobprofit('', '', $order_type, $config['per_page'], $limit_end, '', '', $lang_from, $lang_to, $lang_check_reverse);

                        $data['finance_summary'] = $this->jobprofit_model->get_finance_summary('', '', '', $lang_from, $lang_to, $lang_check_reverse);
                    }
                    $config['total_rows'] = $data['count_jobprofit'];
                }
            }


            //   echo '<pre>'; print_r($data['jobprofit']); exit;
//print $data['avarage_profit_margin'];exit();
            $this->pagination->initialize($config);
            if($this->input->is_ajax_request() == true) {
                echo json_encode('success');
                exit();
            }else{
                $this->load->view('admin/jobpost/vwAdminProfit', $data);
            }

        } else {
            $this->load->view('admin/jobpost/vwAdminProfit_sub');
        }

    }


    public function viewjobprofit()
    {
        $id = $this->uri->segment(3);
        $sql = "select * from `bidjob` where `id`='$id'";
        $query = $this->db->query($sql);
        $data['fetch'] = $query->row();
        $this->load->view('admin/jobpost/vwjobprofitDetails', $data);
    }

    public function load_line_number_details()
    {
        $line_number_code = $this->input->get('line_number_code',true);

        $data['line_numbers'] = $this->jobprofit_model->get_line_number_info($line_number_code);
        $data['line_number_code'] = $line_number_code;

        echo $this->load->view('admin/vwLineNumberDetails', $data, true);
    }

    public function resetsearch()
    {
        $this->session->unset_userdata('search_string_selected');
        $this->session->unset_userdata('order');
        $this->session->unset_userdata('order_type');
        $this->session->unset_userdata('start_date');
        $this->session->unset_userdata('end_date');
        $this->session->unset_userdata('lang_from');
        $this->session->unset_userdata('lang_to');
        $this->session->unset_userdata('lang_check_reverse');
        $this->session->unset_userdata('percentage_from');
        $this->session->unset_userdata('percentage_to');
        redirect(base_url() . 'admin/profit');
        exit();
    }
}
