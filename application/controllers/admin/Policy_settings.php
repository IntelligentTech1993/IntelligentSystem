<?php 
class Policy_settings extends CI_Controller
{
    public function __construct() {
        parent::__construct();
      //  error_reporting(0);
        $this->data['theme'] = 'admin';
        $this->data['module'] = 'policy_settings';        
        $this->load->model('admin_panel_model');
        $this->data['admin_id'] = $this->session->userdata('id');
        $this->user_role = !empty($this->session->userdata('user_role'))?$this->session->userdata('user_role'):0;
    }
     public function index($offset = 0) {      
        $this->load->library('pagination');
        $config['base_url'] = site_url("admin/policy_settings/");
        $config['total_rows'] = $this->db->count_all('policy_settings');
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
        $this->data['links'] = $this->pagination->create_links();
        $this->data['list'] = $this->admin_panel_model->get_policy_settings($offset,$config['per_page']);                
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
    }


    public function create(){


                    if($this->input->post('form_submit'))
            {

                if($this->data['admin_id'] > 1){
            $this->session->set_flashdata('message', '<p class="alert alert-danger">Permission Denied</p>');    
            redirect(base_url().'admin/policy_settings');

        }else{

            $count=$this->db->query('SELECT id FROM policy_settings where status=0');
            if ( $count->num_rows() <= 3)
            {

            $data['policy_raw_image'] = $this->input->post('imageurl');
            $data['policy_cropped_image'] = $this->input->post('imageurl');     
            $data['policy_name'] = $this->input->post('policy_name');
            $data['policy_terms'] = $this->input->post('policy_description');
            $data['status'] = 0;
            $this->db->insert('policy_settings',$data);
            $message='<div class="alert alert-success text-center fade in" id="flash_succ_message">Placeholder Created</div>';
            
            }else{
                $message='<div class="alert alert-danger text-center fade in" id="flash_succ_message">You have already created four Placeholder settings.if you want to create more setting please inactive any one existing policy.</div>';
            }
            $this->session->set_flashdata('message',$message);
            redirect(base_url('admin/policy_settings'));
            }
            }
            $this->data['page'] = 'add_policy';
            $this->load->vars($this->data);
            $this->load->view($this->data['theme'].'/template');
            }
    public function edit($id)
    {
          if($this->input->post('form_submit'))
        {

            if($this->data['admin_id'] > 1){
            $this->session->set_flashdata('message', '<p class="alert alert-danger">Permission Denied</p>');    
            redirect(base_url().'admin/policy_settings');

        }else{

            $data['policy_raw_image'] = $this->input->post('imageurl');
            $data['policy_cropped_image'] = $this->input->post('imageurl');   
            $data['policy_name'] = $this->input->post('policy_name');
            $data['policy_terms'] = $this->input->post('policy_description');
            $data['status'] = $this->input->post('status');
            $this->db->where('id',$id);
            $this->db->update('policy_settings',$data);
            $message='<div class="alert alert-success text-center fade in" id="flash_succ_message">Placeholder updated</div>';               
        $this->session->set_flashdata('message',$message);
        redirect(base_url('admin/policy_settings'));
        }
    }
        $this->data['list'] = $this->admin_panel_model->edit_policy_settings($id);             
        $this->data['page'] = 'edit_policy';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
       }
      public function delete() {   
        if($this->data['admin_id'] > 1){
            $this->session->set_flashdata('message', '<p class="alert alert-danger">Permission Denied</p>');    
            redirect(base_url().'admin/policy_settings');

        }else{
        $ads_id = $this->input->post('tbl_id');
        $this->db->where('id',$ads_id);
        if($this->db->delete('policy_settings'))
        {
                $message='<div class="alert alert-success text-center fade in" id="flash_succ_message">Placeholder deleted. </div>';
            
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
                $file_name =  time().$output['input']['name'];

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
                    $result = file_put_contents('uploads/policy_image/' . $file_name, $img);

                    if($result == FALSE){
                        $result =  array('error' => 'Failed to write to file, may not have permission');
                    }else{
                        $result = array('image_url' =>'uploads/policy_image/'.$file_name);
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