<?php

//error_reporting(0);
class Admin_awardjob extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('awardjob_model');
        if (!$this->session->userdata('is_admin')) {
            redirect('admin/login');
        }
    }


    function index()
    {
        if (!$this->session->userdata('is_admin')) {
            redirect('admin/login');
        } else {
            $admin_id = $this->session->userdata('admin_id');
            if ($admin_id) {
                $this->load->model('common_model');
                $admin_type = $this->common_model->get_contents('admin_type', 'admin', 'id', $admin_id, 'id', 'DESC')[0]->admin_type;
            } else {
                $admin_type = '';
            }
            //all the posts sent by the view
            $search_string = $this->input->post('search_string');
            $search_string = preg_replace('/[^A-Za-z0-9\s\-\:]/', '', $search_string);
            $search_string = trim($search_string);

            $stage = $this->input->post('job_stage');
            $order = 'complete_date';
            $order_type = 'desc';

            //pagination settings
            $config['per_page'] = 10;
            $config['base_url'] = base_url() . 'admin/awardjob';
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

            if ($stage != '' || $search_string != '' || $order != '' || $this->uri->segment(3) == true) {

                if ($stage) {
                    $filter_session_data['stage_selected'] = $stage;
                } else {
                    $stage = $this->session->userdata('stage_selected');
                    $filter_session_data['stage_selected'] = $stage;
                }
                $data['stage_selected'] = $stage;

                 if($search_string){
                     $filter_session_data['search_string_selected'] = $search_string;
                 }else{
                     $search_string =$this->session->userdata('search_string_selected');
                 	$filter_session_data['search_string_selected'] = $search_string;
                 }
                 $data['search_string_selected'] = $search_string;

                if ($order) {
                    $filter_session_data['order'] = $order;
                } else {
                    $order = $this->session->userdata('order');
                }
                $data['order'] = $order;

                //save session data into the session
                $this->session->set_userdata($filter_session_data);


                $data['count_awardjob'] = $this->awardjob_model->count_awardjob($stage, $search_string, $order);
                $config['total_rows'] = $data['count_awardjob'];

                //fetch sql data into arrays
                if ($search_string) {
                    if ($order) {
                        $data['awardjob'] = $this->awardjob_model->get_awardjob($stage, $search_string, $order, $order_type, $config['per_page'], $limit_end);
                    } else {
                        $data['awardjob'] = $this->awardjob_model->get_awardjob($stage, $search_string, '', $order_type, $config['per_page'], $limit_end);
                    }
                } else {
                    if ($order) {
                        $data['awardjob'] = $this->awardjob_model->get_awardjob($stage, '', $order, $order_type, $config['per_page'], $limit_end);
                    } else {
                        $data['awardjob'] = $this->awardjob_model->get_awardjob($stage, '', '', $order_type, $config['per_page'], $limit_end);
                    }
                }

            } else {

                //clean filter data inside section
                $filter_session_data['search_string_selected'] = null;
                $filter_session_data['stage_selected'] = null;
                $filter_session_data['order'] = null;
                $filter_session_data['order_type'] = null;
                $this->session->set_userdata($filter_session_data);

                //pre selected options
                $data['search_string_selected'] = '';
                $data['stage_selected'] = '';
                $data['order'] = 'id';

                //fetch sql data into arrays

                $data['count_awardjob'] = $this->awardjob_model->count_awardjob();
                $data['awardjob'] = $this->awardjob_model->get_awardjob('', '', '', $order_type, $config['per_page'], $limit_end);
                $config['total_rows'] = $data['count_awardjob'];

            }
            $data['admin_type'] = $admin_type;
            $this->pagination->initialize($config);
            $this->load->view('admin/jobpost/vwAwardJob', $data);

        }

    }

    public function resetcompleted(){
        $filter_session_data['search_string_selected'] = null;
        $filter_session_data['stage_selected'] = null;
        $filter_session_data['order'] = null;
        $filter_session_data['order_type'] = null;
        $this->session->unset_userdata($filter_session_data);
        redirect(base_url().'admin/awardjob');
    }


    public function review()
    {

        //echo $this->uri->segment(3);
        //echo $this->uri->segment(4);die;
        $this->load->view('admin/vwTranslatorRating');

    }


    public function give_rating()
    {
        $value = $this->input->post('value');
        $translator_id = $this->input->post('translator_id');
        $job_id = $this->input->post('job_id');

        $sql = "SELECT *  FROM `review` WHERE `job_id`='" . $job_id . "' and `translator_id`='" . $translator_id . "'  ";
        $query = $this->db->query($sql);
        $num = $query->num_rows();
        if ($num > 0) {
            $review_result = $query->row();
            $review_id = $review_result->id;
            $update_data = array(
                'rating' => $value,
                'modified' => date("Y-m-d H:i:s")
            );
            $this->db->where('id', $review_id);
            $this->db->update('review', $update_data);

        } else {
            $insert_data = array(
                'job_id' => $job_id,
                'translator_id' => $translator_id,
                'rating' => $value,
                'created' => date("Y-m-d H:i:s")
            );
            $this->db->insert('review', $insert_data);
        }

    }


    public function give_rating_comment()
    {
        $translator_id = $this->uri->segment(3);
        $job_id = $this->uri->segment(4);
        $message = $this->input->post('message');

        $sql = "SELECT *  FROM `review` WHERE `job_id`='" . $job_id . "' and `translator_id`='" . $translator_id . "' ";
        $query = $this->db->query($sql);
        $num = $query->num_rows();
        if ($num > 0) {
            $fetch = $query->row();
            $rating = $fetch->rating;

            $update_data = array(
                'comment' => $message
            );
            $this->db->where(array('job_id' => $job_id, 'translator_id' => $translator_id));
            $this->db->update('review', $update_data);
            $this->session->unset_userdata('comment');

            $sql1 = "SELECT *  FROM `translator` WHERE `id`='" . $translator_id . "' ";
            $query1 = $this->db->query($sql1);
            $fetch1 = $query1->row();
            $trans_name = $fetch1->first_name . ' ' . $fetch1->last_name;
            $trans_email = $fetch1->email_address;


            $sql2 = "SELECT *  FROM `jobpost` WHERE `id`='" . $job_id . "' ";
            $query2 = $this->db->query($sql2);
            $fetch2 = $query2->row();
            $job_name = $fetch2->name;


            $Emaildata['trans_name'] = $trans_name;
            $Emaildata['job_name'] = $job_name;
            $Emaildata['rating'] = $rating;
            $Emaildata['message'] = $message;

            $this->email->set_mailtype("html");
            $this->email->from(CONTACT_FROM);
            $this->email->to($trans_email);
            $this->email->subject('Your are reviewed for job ' . $job_name);

            //echo '<pre>'; print_r($Emaildata); die;

            $html_email = $this->load->view('email/vwTransReview', $Emaildata, true);
            $this->email->message($html_email);
            $mail = $this->email->send();

            $this->session->set_flashdata('success_message', 'Successfully reviewed');
            $reffer = $this->agent->referrer();
            redirect($reffer);
        } else {
            $this->session->set_userdata('comment', $message);
            $this->session->set_flashdata('error_message', 'please rate the translator as well');
            $reffer = $this->agent->referrer();
            redirect($reffer);
        }

    }

    public function viewawardjob()
    {
        if (!$this->session->userdata('is_admin')) {
            redirect('admin/login');
        } else {
            $id = $this->uri->segment(3);
            $sql = "select * from `bidjob` where `id`='$id'";
            $query = $this->db->query($sql);
            $data['fetch'] = $query->row();
            $this->load->view('admin/jobpost/vwAwardJobDetails', $data);

        }
    }

    /* Update by JBP */
    public function jobcomplete()
    {
        $id = $this->uri->segment(3);

        $jobInfo = $this->awardjob_model->getJobInfo($id);

        $bidders = $this->awardjob_model->getBidders($id);

        if (count($bidders)) {
            foreach ($bidders as $rowBidder) {
                $messageInfo = array(
                    'translatorID' => $rowBidder->trans_id,
                    'message' => '<a href = "' . base_url() . 'job/' . $jobInfo->alias . '">' . $jobInfo->name . "</a> is now closed for bidding.",
                    'created' => date("Y-m-d H:i:s")
                );

                $this->awardjob_model->updateMessage($messageInfo);

                $mailTo = $rowBidder->email_address;
                $mailName = $rowBidder->first_name;

                $lang_obj = explode('/', $jobInfo->language);

                $lang_from = $this->db->from('languages')->where('id', $lang_obj[0])->get();
                $lang_to = $this->db->from('languages')->where('id', $lang_obj[1])->get();

                $data['translator_name'] = $mailName;
                $data['job_name'] = $jobInfo->name;
                $data['lang_from'] = $lang_from->row()->name;
                $data['lang_to'] = $lang_to->row()->name;

                $this->email->set_mailtype("html");
                $this->email->from('info@montesinotranslation.com');
                $this->email->to($mailTo);
                $this->email->subject('Hiring is closed!');
                $html_email = $this->load->view('email/vwHiringClosed', $data, true);
                $this->email->message($html_email);
                $this->email->send();

                $message = "Hiring for the job {$jobInfo->name}, translation from {$lang_from->row()->name} to {$lang_to->row()->name} you bidded for is now closed. Thank you for bidding.";

                $post_to_chat_box = [
                    'bid_id' => $rowBidder->bid_id,
                    'job_id' => $jobInfo->id,
                    'trans_id' => $rowBidder->trans_id,
                    'type' => 'admin',
                    'status' => 'unread',
                    'jobname' => $jobInfo->name,
                    'userID' => 1,
                    'userName' => 'Guest',
                    'channel' => 1,
                    'dateTime' => date('Y-m-d H:i:s'),
                    'text' => $message,
                    'ip' => '127.0.0.1'
                ];

                $this->db->insert('ajax_chat_messages', $post_to_chat_box);
            }
        }

        $this->db->update('jobpost', array('stage' => 2, 'hiring_close_notification' => 1), array('id' => $id));

        $this->session->set_flashdata('success_message', 'Job is closed.');
        $referrer = $this->agent->referrer();
        $referrer = str_replace('?prompt=1', '', $referrer);

        redirect($referrer);
    }

    public function jobopen()
    {

        $id = $this->uri->segment(3);

        $sql = "UPDATE `jobpost` SET  `stage` = '0' WHERE `id` = '" . $id . "'";

        $val = $this->db->query($sql);

        $jobInfo = $this->awardjob_model->getJobInfo($id);

        $bidders = $this->awardjob_model->getBidders($id);

        foreach ($bidders as $rowBidder) {

            $messageInfo = array(
                'translatorID' => $rowBidder->trans_id,
                'message' => '<a href = "' . base_url() . 'job/' . $jobInfo->alias . '">' . $jobInfo->name . "</a> is now open for bidding.",
                'created' => date("Y-m-d H:i:s")
            );

            $this->awardjob_model->updateMessage($messageInfo);

        }

        $this->session->set_flashdata('success_message', 'Job is open.');
        $referrer = $this->agent->referrer();
        redirect($referrer);
    }

    /* End of Update by JBP */


    public function awardcomplete()
    {
        if ($this->session->userdata('is_admin')) {
            $admin_id = $this->session->userdata('admin_id');
            $data['message_error'] = "";
            $data['message_success'] = "";
            //artist id
            $id = $this->uri->segment(3);
            $job_id = $this->uri->segment(4);

            if ($id != '') {
                $date = date('Y-m-d h-i-s');
                $sql = "UPDATE `bidjob` SET  `awarded`='1' ,completed_admin_id = ".$admin_id.",`stage` = '2',`complete_date`='$date' WHERE `id` = '" . $id . "'";
                $val = $this->db->query($sql);

                if ($val) {
                    $transql = "select `trans_id`,`price` from `bidjob` where `id`='$id'";
                    $tranval = $this->db->query($transql);
                    $tranfetch = $tranval->row();
                    $trans_id = $tranfetch->trans_id;
                    $price = $tranfetch->price;
                    //echo $trans_id;die;

                    $jobsql = "select * from `jobpost` where `id`='$job_id'";
                    $jobval = $this->db->query($jobsql);
                    $jobfetch = $jobval->row();
                    $job_name = $jobfetch->name;
                    $job_description = $jobfetch->description;
                    $job_created = $jobfetch->created;
                    $job_alias = $jobfetch->alias;

                    $emailsql = "select * from `translator` where `id`='$trans_id'";
                    $emailval = $this->db->query($emailsql);
                    $emailfetch = $emailval->row();
                    $trans_email = $emailfetch->email_address;
                    $trans_name = $emailfetch->first_name . '&nbsp;' . $emailfetch->last_name;


                    //echo $trans_name;die;


                    $data['name'] = $trans_name;
                    $data['job_name'] = $job_name;
                    $data['job_description'] = $job_description;
                    $data['job_created'] = $job_created;
                    $data['job_alias'] = $job_alias;
                    //$data['invoice'] =$invoice;

                    $mailTo = $trans_email;
                    $mailName = $trans_name;
                    $this->email->set_mailtype("html");
                    $this->email->from('info@montesinotranslation.com');
                    $this->email->to($mailTo);
                    $this->email->subject('Award Job Completion');
                    $html_email = $this->load->view('email/vwTranslatorAwardCompletion', $data, true);
                    $this->email->message($html_email);
                    $this->email->send();

                    $invoice_id = time();
                    $data['invoice'] = $invoice_id;
                    $data['price'] = $price;
                    $invoicesql = "select * from  invoice where bid_id=$id";
                    $query = $this->db->query($invoicesql);
                    $inv = $query->num_rows();
                    if ($inv > 1) {
                        $data_to_store = array(
                            'invoice_id' => $invoice_id,
                            'job_id' => $job_id,
                            'trans_id' => $trans_id,
                            'modified' => date('Y-m-d H:i:s')
                        );
                        $this->db->update('invoice', $data_to_store, array('bid_id' => $id));
                    } else {

                        $data_to_store = array(
                            'bid_id' => $id,
                            'invoice_id' => $invoice_id,
                            'job_id' => $job_id,
                            'trans_id' => $trans_id,
                            'created' => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('invoice', $data_to_store);

                    }

                    $mailTo = $trans_email;
                    $mailName = $trans_name;
                    $this->email->set_mailtype("html");
                    $this->email->from('info@montesinotranslation.com');
                    $this->email->to($mailTo);
                    $this->email->subject('Award Job Completion Invoice');
                    $html_email = $this->load->view('email/vwTranslatorAwardCompletioninvoice', $data, true);
                    $this->email->message($html_email);
                    $this->email->send();


                    $this->session->set_flashdata('success_message', ' Awarded job Completed');
                    $referrer = $this->agent->referrer();
                    redirect($referrer);
                }
            } else {
                $this->session->set_flashdata('error_message', 'Sorry, some problem occured. Please try again');
                $referrer = $this->agent->referrer();
                redirect($referrer);
            }
        } else {
            redirect('admin/index');
        }
    }//update

    public function awarduncomplete()
    {

        if ($this->session->userdata('is_admin')) {
            $data['message_error'] = "";
            $data['message_success'] = "";
            //artist id
            $id = $this->uri->segment(3);
            $job_id = $this->uri->segment(4);

            if ($id != '') {
                $sql = "UPDATE `bidjob` SET `awarded` = '1',`stage` = '1', `is_done` = 0 WHERE `id` = '" . $id . "'";
                $val = $this->db->query($sql);

                $sql = "UPDATE invoice SET is_deleted = 1 WHERE bid_id = {$id}";
                $this->db->query($sql);

                $sql = "SELECT * FROM jobpost WHERE id = {$job_id} AND proofread_required = 1";
                $query = $this->db->query($sql);

                if ($query->num_rows()) {
                    $sql = "UPDATE proofread_jobs SET review_stage = 0 WHERE job_id = {$job_id}";
                    $this->db->query($sql);
                }

                $this->session->set_flashdata('success_message', 'Awarded Job marked as Not Compleated');
                $referrer = $this->agent->referrer();
                redirect($referrer);
            } else {
                $this->session->set_flashdata('error_message', 'Sorry, some problem occured. Please try again');
                $referrer = $this->agent->referrer();
                redirect($referrer);
            }
        } else {
            redirect('admin/index');
        }


    }


    public function complete()
    {

        if ($this->session->userdata('is_admin')) {
            $admin_id = $this->session->userdata('admin_id');
            $data['message_error'] = "";
            $data['message_success'] = "";
            //artist id
            $id = $this->uri->segment(3);
            $job_id = $this->uri->segment(4);
            if ($id != '') {
                $date = date('Y-m-d h-i-s');
                $sql = "UPDATE `bidjob` SET  `awarded`='1' ,completed_admin_id = ".$admin_id.",`stage` = '2',`complete_date`='$date' WHERE `id` = '" . $id . "'";
                $val = $this->db->query($sql);

                if ($val) {
                    $transql = "select `trans_id` from `bidjob` where `id`='$id'";
                    $tranval = $this->db->query($transql);
                    $tranfetch = $tranval->row();
                    $trans_id = $tranfetch->trans_id;

                    $jobsql = "select * from `jobpost` where `id`='$job_id'";
                    $jobval = $this->db->query($jobsql);
                    $jobfetch = $jobval->row();
                    $job_name = $jobfetch->name;
                    $job_description = $jobfetch->description;
                    $job_created = $jobfetch->created;
                    $job_alias = $jobfetch->alias;

                    $emailsql = "select * from `translator` where `id`='$trans_id'";
                    $emailval = $this->db->query($emailsql);
                    $emailfetch = $emailval->row();
                    $trans_email = $emailfetch->email_address;
                    $trans_name = $emailfetch->first_name . '&nbsp;' . $emailfetch->last_name;


                    //echo $trans_name;die;


                    $data['name'] = $trans_name;
                    $data['job_name'] = $job_name;
                    $data['job_description'] = $job_description;
                    $data['job_created'] = $job_created;
                    $data['job_alias'] = $job_alias;

                    $mailTo = $trans_email;
                    $mailName = $trans_name;
                    $this->email->set_mailtype("html");
                    $this->email->from('info@montesinotranslation.com');
                    $this->email->to($mailTo);
                    $this->email->subject('Award Job Completion');
                    $html_email = $this->load->view('email/vwTranslatorAwardCompletion', $data, true);
                    $this->email->message($html_email);
                    $this->email->send();


                    $this->session->set_flashdata('success_message', ' Awarded job Completed');
                    redirect('admin_invoice/index/');
                }
            } else {
                $this->session->set_flashdata('error_message', 'Sorry, some problem occured. Please try again');
                redirect('admin_invoice/index/');
            }
        } else {
            redirect('admin/index');
        }


    }//update


}
