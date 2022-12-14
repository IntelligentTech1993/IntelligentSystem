<?php 
class User extends CI_Controller{
    public function __construct() {
        parent::__construct();
        error_reporting(0);
        $this->data['theme'] = 'admin';
        $this->data['module'] = 'user';
        $this->load->model('admin_panel_model');
        $this->data['admin_id'] = $this->session->userdata('id');
        $this->user_role = !empty($this->session->userdata('user_role'))?$this->session->userdata('user_role'):0;
    }
    public function index()
    {
        $this->data['page']='index';
        $this->data['list'] = $this->admin_panel_model->get_user();
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
    }
    public function edit_user($id)
    {

        if($this->data['admin_id'] > 1){
            $this->session->set_flashdata('message', '<p class="alert alert-danger">Permission Denied</p>');    
            redirect(base_url().'admin/user');

        }else{
        $this->data['page'] = 'edit_user'; 
        $this->data['list'] = $this->admin_panel_model->edit_user($id);
        if($this->input->post('form_submit'))
        {
            $data['fullname'] = $this->input->post('user_fullname');
            $data['verified'] = $this->input->post('user_verified');
            $data['status'] = $this->input->post('status');
            $this->db->where('USERID',$id);
            if($this->db->update('members',$data))
            {
				$message='<div class="alert alert-success text-center fade in" id="flash_succ_message">User edited successfully.</div>';
				
            }
			$this->session->set_flashdata('message',$message);
			redirect(base_url().'admin/user');
        }
    }
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
    }
}
?>