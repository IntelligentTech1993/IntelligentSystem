<?php 
class Client extends CI_Controller{
    public function __construct() {
        parent::__construct();
        error_reporting(0);
        $this->data['theme'] = 'admin';
        $this->data['module'] = 'client';
        $this->load->model('admin_panel_model');
        $this->data['admin_id'] = $this->session->userdata('id');
        $this->user_role = !empty($this->session->userdata('user_role'))?$this->session->userdata('user_role'):0;
    }
    public function index()
    {
        $this->data['page'] = 'index';
        $this->data['list'] = $this->admin_panel_model->get_client_list();
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
        
    }
    


    
    public function create()
    {   
       
        if($this->input->post('form_submit'))
        {
            if($this->data['admin_id'] > 1){
            $this->session->set_flashdata('message', '<p class="alert alert-danger">Permission Denied</p>');    
            redirect(base_url().'admin/client');

        }else{
         
        $data['client_raw_image'] = $this->input->post('imageurl');
        $data['client_cropped_image'] = $this->input->post('imageurl'); 
        $data['client_name'] = $this->input->post('client_name');
        $data['status'] = $this->input->post('status'); 
    
        if($this->db->insert('client',$data))
        {
			$message='<div class="alert alert-success text-center fade in" id="flash_succ_message">Client added successfully.</div>';
			
        }
		   $this->session->set_flashdata('message',$message);
            redirect(base_url().'admin/client');
        }
    }
        $this->data['page']='create';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
    }
    
    public function edit($id) 
    {

        if($this->data['admin_id'] > 1){
            $this->session->set_flashdata('message', '<p class="alert alert-danger">Permission Denied</p>');    
            redirect(base_url().'admin/client');

        }else{
         if($this->input->post('form_submit'))
        {
            
         $data['client_raw_image'] = $this->input->post('imageurl');
        $data['client_cropped_image'] = $this->input->post('imageurl');   
        $data['client_name'] = $this->input->post('client_name');
        $data['status'] = $this->input->post('status'); 
        $this->db->where('id',$id);
        if($this->db->update('client',$data))
        {
			$message='<div class="alert alert-success text-center fade in" id="flash_succ_message">Edited successfully.</div>';
			
        }
		   $this->session->set_flashdata('message',$message);
            redirect(base_url().'admin/client');
        }
    }
        $this->data['page']='edit';
        $this->data['list'] = $this->admin_panel_model->edit_client_list($id);
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
        
    }
    public function delete()
    {
        if($this->data['admin_id'] > 1){
            $this->session->set_flashdata('message', '<p class="alert alert-danger">Permission Denied</p>');    
            redirect(base_url().'admin/client');

        }else{
        $id = $this->input->post('tbl_id');
        $this->db->where('id',$id);
        if($this->db->delete('client'))
        {
			$message="<div class='alert alert-success text-center fade in' id='flash_succ_message'>Delete successfully.</div>";
			
            echo 1;
        }
            $this->session->set_flashdata('message',$message);    
        }
    }

    public function upload_image(){
        
        if(!empty($_POST['dgt'])){

            $output = json_decode($_POST['dgt'][0], TRUE);
            if(isset($output) && isset($output['output']) && isset($output['output']['image'])){

                $file = $output['output']['image'];
                $file_name = time().$output['input']['name'];

                if(isset($file)){
                    /* Check jpeg file */
                    if(stripos($file, 'data:image/jpeg;base64,') === 0)
                    {
                        $img = base64_decode(str_replace('data:image/jpeg;base64,', '', $file));                        
                    }/* Check png file */
                    else if(stripos($file, 'data:image/png;base64,') === 0)
                    {
                        $img = base64_decode(str_replace('data:image/png;base64,', '', $file));                     
                    }
                    else /* error */
                    {
                        $result =  array('error' => 'Non-image file');
                    }
                    $result = file_put_contents('uploads/client_image/' . $file_name, $img);

                    if($result == FALSE){
                        $result =  array('error' => 'Failed to write to file, may not have permission');
                    }else{
                        $result = array('image_url' =>'uploads/client_image/'.$file_name);
                    }

                    // if(isset($result['image_url'])){
                    //     $this->db->truncate('user_details');
                    //     $this->db->insert('user_details',$result);
                    // }
                    echo json_encode($result);

                }
            }
        }
    }
}
?>