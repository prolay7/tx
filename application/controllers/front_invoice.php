<?php error_reporting(0);

class Front_Invoice extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->helper(array('form', 'url'));

    }


    public function sort()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->input->is_ajax_request() == true) {
            $this->session->set_userdata('order_direction', $this->input->post('sort_type'));
            echo "success";

        }
    }


    function index($start = 0)
    {
        $this->load->model('front_invoice_model');

        if (!$this->session->userdata('is_translator')) {

            $this->load->view('translator/vwLogin');

        } else {
            $order_direction = $this->session->userdata('order_direction');
            if (!$order_direction) {
                $order_direction = 'DESC';
            }
            if ($_POST) {
                $dateFrom = $this->input->post('invoiceDateFrom', true);
                $dateTo = $this->input->post('invoiceDateTo', true);
                $search_string = $this->input->post('search_string', true);
                $payment_status = $this->input->post('payment_status', true);
                $order_direction = $this->input->post('order_direction', true);

                $this->session->set_userdata('dateFromFront', $this->input->post('invoiceDateFrom'));
                $this->session->set_userdata('dateToFront', $this->input->post('invoiceDateTo'));
                $this->session->set_userdata('search_stringFront', $this->input->post('search_string'));
                $this->session->set_userdata('payment_statusFront', $this->input->post('payment_status'));
            }

            $data['invoice'] = $this->front_invoice_model->fetchMyInvoices(10, $start, $this->session->userdata('search_stringFront'), $this->session->userdata('payment_statusFront'), $this->session->userdata('dateFromFront'), $this->session->userdata('dateToFront'), $order_direction);

            $config['total_rows'] = $this->front_invoice_model->getTotalNumberOfMyInvoices($this->session->userdata('search_stringFront'), $this->session->userdata('payment_statusFront'), $this->session->userdata('dateFromFront'), $this->session->userdata('dateToFront'));

            $config['base_url'] = base_url() . 'translator/invoice/';

            $config['per_page'] = 10;
            $config['uri_segment'] = 3;

            $this->pagination->initialize($config);
            $data['pages'] = $this->pagination->create_links();

            $computeReceivable = $this->front_invoice_model->getTotalReceivable();
            $receivable = 0.00;

            foreach ($computeReceivable as $rowReceivable) {
                $receivable = $receivable + $rowReceivable->price;
            }

            $data['receivable'] = $receivable;

            $this->pagination->initialize($config);

            $this->load->view('translator/translators/vwInvoice', $data);
        }

    }

    function clearFilters()
    {

        $this->session->unset_userdata('dateFromFront');
        $this->session->unset_userdata('dateToFront');
        $this->session->unset_userdata('search_stringFront');
        $this->session->unset_userdata('payment_statusFront');
        $this->session->unset_userdata('order_direction');

    }

    function privatejob($start = 0)
    {

        $this->load->model('front_invoice_model');

        $data['invitations'] = $this->front_invoice_model->fetchMyInvitations(10, $start);
        $config['total_rows'] = $this->front_invoice_model->getTotalNumberOfMyInvitations();

        $config['base_url'] = base_url() . 'translator/privatejob/';

        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pages'] = $this->pagination->create_links();

        $this->load->view('translator/invitespage');

    }

}
