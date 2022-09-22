<?php 
class Subscribers extends CI_Controller{
    public function __construct() {
        parent::__construct();
        error_reporting(0);
        $this->data['theme'] = 'admin';
        $this->data['module'] = 'subscribers';
        $this->load->model('subscription_model');
        $this->data['admin_id'] = $this->session->userdata('id');
        $this->user_role = !empty($this->session->userdata('user_role'))?$this->session->userdata('user_role'):0;
    }
    public function index()
    {

        $this->load->library('pagination');
        $config['base_url'] = base_url("admin/subscribers/");
        $config['total_rows'] = $this->db->count_all('payments');
        $config['per_page'] = 15;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="javascript:;">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
        $this->data['page'] = 'index';
        $this->data['list'] = $this->subscription_model->get_allsubscribers();
        $this->data['data'] = $this->subscription_model->get_allexpired_subscribers();
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
    }
}

?>