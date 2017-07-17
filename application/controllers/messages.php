<?php

	Class Messages extends CI_Controller {

        function __construct() {
    		parent::__construct();

    		$this->load->model('message');

        }

		function index($start = 0) {

			if ($_POST){
				$search_string = $this->input->post('search_keywords'); 
				$this->session->set_userdata('search_stringMessages', $this->input->post('search_keywords'));
			}

			$data['messages'] = $this->message->getAllMessages(10,$start,$this->session->userdata('search_stringMessages'));
			$config['total_rows'] = $this->message->getTotalMessages($this->session->userdata('search_stringMessages'));

            $config['base_url'] = base_url().'admin/message';

            $config['per_page'] = 10;
            $config['uri_segment'] = 3;

            $this->pagination->initialize($config);
            $data['pages'] = $this->pagination->create_links();

			$this->load->view('admin/includes/vwHeader');
			$this->load->view('admin/messages', $data);
			$this->load->view('admin/includes/vwFooter');
		}

		function sitewidenotification() {

			if ($_POST){

				$allUsers = $this->message->getAllTranslatorsInfo();

				foreach ($allUsers as $rowUser){

					$notification = array(
						'translatorID' => $rowUser->id,
						'message' => $this->input->post('notificationcontent',true),
						'created' => date('Y-m-d h:i:s')
					);

					$results = $this->message->updateMessage($notification);

				}

			}

			redirect(base_url().'admin/messages');

		}

	}

?>