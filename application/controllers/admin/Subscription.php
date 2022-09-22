<?php 
class Subscription extends CI_Controller{
    public function __construct() {
        parent::__construct();
        error_reporting(0);
        $this->data['theme'] = 'admin';
        $this->data['module'] = 'subscription';
        $this->load->model('subscription_model');
        $this->data['admin_id'] = $this->session->userdata('id');
        $this->user_role = !empty($this->session->userdata('user_role'))?$this->session->userdata('user_role'):0;
    }
    public function index()
    {

        if($this->input->post()){
            if($this->data['admin_id'] > 1){
            $this->session->set_flashdata('message', '<p class="alert alert-danger">Permission Denied</p>');    
            redirect(base_url().'admin/language_management_controller/language');

        }else{

            $result = $this->subscription_model->subscriptions();

            if($result==true){

                $this->session->set_flashdata('message','The Subscription has been added successfully...');

            }else{

                $this->session->set_flashdata('message','Already exists');

            }

                redirect(base_url('admin/subscription'));

        }
       }
        $this->data['page']='index';
        $this->data['subscriptioncount'] = $this->subscription_model->subscription_count();
        $this->data['list'] = $this->subscription_model->subscription_data();
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
    }

    public function update_subscription_status()
    {
        $id = $this->input->post('id');

        $status = $this->input->post('status');

        $update_data['status'] = $status;

        $this->db->query(" UPDATE `subscription` SET `status` = ".$status." WHERE `id` = ".$id." ");
    }

    public function delete_subscription()
        {
            if($this->data['admin_id'] > 1){
            $this->session->set_flashdata('message', '<p class="alert alert-danger">Permission Denied</p>');    
            redirect(base_url().'admin/category');

        }else{
        $id = $this->input->post('id');
        $this->db->where('id',$id);
        if($this->db->delete('subscription'))
        {
        echo 1;
        }
            $message="<div class='alert alert-success text-center fade in' id='flash_succ_message'>Subscription Successfully Deleted.</div>";
        $this->session->set_flashdata('message', $message);
    }
        }


        public function check_subscription()
    {
        $subscription =  $this->input->post('subscription_name');    
        $result = $this->subscription_model->check_subscription($subscription);
         if ($result > 0) {
                 $isAvailable = FALSE;
           } else {               
                     $isAvailable = TRUE;
           }
           
           echo json_encode(
                   array(
                           'valid' => $isAvailable
                   ));
    }

       public function check_subscription_rate()
    {
        $subscription_rate =  $this->input->post('subscription_rate');    
        $result = $this->subscription_model->check_subscription_rate($subscription_rate);
        if( $subscription_rate <=0 ||  $subscription_rate=='')
        {
             if ($result >0) {
                 $isAvailable = FALSE;
               } else {               
                $isAvailable = TRUE;
               }
        }
        else
        {
             $isAvailable = TRUE;
        }
        
           
           echo json_encode(
                   array(
                           'valid' => $isAvailable
                   ));
    }
    
}
?>