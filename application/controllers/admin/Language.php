<?php
error_reporting(-1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller {

   public $data;

   public function __construct() {

        parent::__construct();
        $this->load->model('language_model','language');
        $this->load->model('language_web_model','web_language');
        $this->data['view'] = 'admin';
        $this->data['base_url'] = base_url();
        $this->load->library('form_validation');
        $this->data['module'] = 'language';
        $this->data['theme'] = 'admin';
        $this->data['admin_id'] = $this->session->userdata('id');
        $this->user_role = !empty($this->session->userdata('user_role'))?$this->session->userdata('user_role'):0;   
      

    }

  	public function index()
  	{
  		redirect(base_url('pages'));
  	}

    public function languages()

  {

        if($this->input->post()){
      if($this->data['admin_id'] > 1){
            $this->session->set_flashdata('message', '<p class="alert alert-danger">Permission Denied</p>');    
            redirect(base_url().'admin/language/languages');

        }else{

      $result = $this->language->language_model();

      if($result==true){

        $this->session->set_flashdata('message','The Language has been added successfully...');

      }else{

        $this->session->set_flashdata('message','Already exists');

      }

        redirect(base_url('admin/language/languages'));

    }
  }

    $this->data['list'] = $this->language->lang_data();

      $this->data['page'] = 'index';

        $this->load->vars($this->data);

        $this->load->view($this->data['theme'].'/template');

  }

  	public function pages()
  	{

      $this->data['list'] = $this->language->page_list();
      $this->data['page'] = 'pages';
      $this->load->vars($this->data);
      $this->load->view($this->data['theme'].'/template');
    
  	}
    public function language()
  	{
          $this->data['page'] = 'language_keywords';
          $this->data['active_language'] = $this->language->active_language();
          $this->load->vars($this->data);
          $this->load->view($this->data['theme'].'/template');

  	}
    public function language_list()
  	{
        $page_key = $this->input->post('page_key');
  			$lists = $this->language->language_list($page_key);

         $data = array();
            $no = $_POST['start'];
            $active_language = $this->language->active_language();
            foreach ($lists as $keyword) {
             // $no++;
            $row    = array();
           // $row[] = $no;
               if (!empty($active_language))
                            {
                                      foreach ($active_language as $rows)
                                      { 

                                       $lg_language_name = $keyword['lang_key'];   
                                       $language_key = $rows['language_value']; 


                                      $key = $keyword['language'] ;
                                      $value = ($language_key == $key)?$keyword['lang_value']:'';
                                      $key = $keyword['language'];
                                      $currenct_page_key_value = $this->language->currenct_page_key_value($lists);

                                    
                                     
                                      $name =(!empty($currenct_page_key_value[$lg_language_name][$language_key]['name']))?$currenct_page_key_value[$lg_language_name][$language_key]['name']:'';
                                      $placeholder =(!empty($currenct_page_key_value[$lg_language_name][$language_key]['placeholder']))?$currenct_page_key_value[$lg_language_name][$language_key]['placeholder']:'';
                                      $validation1 =(!empty($currenct_page_key_value[$lg_language_name][$language_key]['validation1']))?$currenct_page_key_value[$lg_language_name][$language_key]['validation1']:'';
                                      $validation2 =(!empty($currenct_page_key_value[$lg_language_name][$language_key]['validation2']))?$currenct_page_key_value[$lg_language_name][$language_key]['validation2']:'';
                                      $validation3 =(!empty($currenct_page_key_value[$lg_language_name][$language_key]['validation3']))?$currenct_page_key_value[$lg_language_name][$language_key]['validation3']:'';
                                      $lang_key =(!empty($currenct_page_key_value[$lg_language_name][$language_key]['lang_key']))?$currenct_page_key_value[$lg_language_name][$language_key]['lang_key']:'';

                                    
                                      $type =$currenct_page_key_value[$lg_language_name]['en']['type'];
                                      

                                      //$readonly = ($language_key=='en')?'readonly':'';

                                      $readonly = '';
                                      

                           $row[] = '<input type="text" class="form-control" placeholder="Name" name="'.$lg_language_name.'['.$language_key.'][lang_value]" value="'.$name.'" '.$readonly.' ><br>
                          <input type="text" class="form-control" placeholder="Placeholder" name="'.$lg_language_name.'['.$language_key.'][placeholder]" value="'.$placeholder.'" '.$readonly.' ><br>
                          <input type="text" class="form-control" placeholder="Validation 1" name="'.$lg_language_name.'['.$language_key.'][validation1]" value="'.$validation1.'" '.$readonly.' ><br>
                          <input type="text" class="form-control" placeholder="Validation 2" name="'.$lg_language_name.'['.$language_key.'][validation2]" value="'.$validation2.'" '.$readonly.' ><br>
                          <input type="text" class="form-control" placeholder="Validation 3" name="'.$lg_language_name.'['.$language_key.'][validation3]" value="'.$validation3.'" '.$readonly.' ><br>
                          <input type="text" class="form-control" value="'.$lang_key.'" readonly >
                          <input type="hidden" class="form-control" name="'.$lg_language_name.'['.$language_key.'][type]" value="'.$type.'" '.$readonly.' >';
                                      }

                      }

                      $data[] = $row;
                      }
          $output = array(
                          "draw" => $_POST['draw'],
                          "recordsTotal" => $this->language->language_list_all($page_key),
                          "recordsFiltered" => $this->language->language_list_filtered($page_key),
                          "data" => $data,
                  );

          //output to json format
          echo json_encode($output);

  	}


  	public function update_multi_language()

    {

      if ($this->input->post()) {

        $page_key = $this->input->post('page_key');

if($this->data['admin_id'] > 1){
            $this->session->set_flashdata('message', '<p class="alert alert-danger">Permission Denied</p>');    
            redirect(base_url().'language/pages/'.$page_key.'');

        }else{

          
        $data = $this->input->post();

     
        

        foreach($data as $row => $object)

        {

          if (!empty($object)) {



            foreach ($object as $key => $value) {

                       



              $this->db->where('language', $key);
              $this->db->where('lang_key', $row);
              $this->db->where('type', $value['type']);
              $this->db->where('page_key', $page_key);

            $record = $this->db->count_all_results('app_language_management');



              if ($record==0) {
                 $array = array(
                          'language' =>$key,
                          'lang_key' =>$row,
                          'lang_value' =>$value['lang_value'],
                          'placeholder'=>$value['placeholder'],
                          'validation1'=>$value['validation1'],
                          'validation2'=>$value['validation2'],
                          'validation3'=>$value['validation3'],
                          'type'=>$value['type'],
                          'page_key'=>$page_key,
                        );

                $this->db->insert('app_language_management', $array);

              }else{

                 $this->db->where('language', $key);
                 $this->db->where('lang_key', $row);
                 $this->db->where('type', $value['type']);
                 $this->db->where('page_key', $page_key);


                 $array = array(
                          'lang_value' =>$value['lang_value'],
                          'placeholder'=>$value['placeholder'],
                          'validation1'=>$value['validation1'],
                          'validation2'=>$value['validation2'],
                          'validation3'=>$value['validation3'],
                          'type'=>$value['type'],
                          'page_key'=>$page_key,
                        );

                  $this->db->update('app_language_management', $array);

              }

            }



          }

        }

      }
    }

      
     
      redirect(base_url().'language/pages/'.$page_key.'');

    }

public function add_keyword()

  {


    if($this->input->post()){
      $page_key = $this->input->post('page_key');
      if($this->data['admin_id'] > 1){
            $this->session->set_flashdata('message', '<p class="alert alert-danger">Permission Denied</p>');    
            redirect(base_url().'language/add-keyword/'.$page_key.'');

        }else{

      $result = $this->language->keyword_model();

      if($result == true){

        $this->session->set_flashdata('message','The Keyword has been added successfully...');

      }elseif(is_array($result) && count($result)==0){

        $this->session->set_flashdata('message','The Keyword has been added successfully...');

      }elseif(is_array($result) && count($result)> 0){

        $this->session->set_flashdata('message','Already exists'.implode(',',$result));

      } else{

        $this->session->set_flashdata('message','Already exists');

      }
    }

         redirect(base_url().'language/add-keyword/'.$page_key.'');

    }



        $this->data['page'] = 'add_keyword';

        $this->load->vars($this->data);

        $this->load->view($this->data['theme'].'/template');



  }



  public function add_page()

  {


      if($this->input->post()){
        $page_name = $this->input->post('page_name');
        if($this->data['admin_id'] > 1){
              $this->session->set_flashdata('message', '<p class="alert alert-danger">Permission Denied</p>');    
              redirect(base_url().'language/add-page');

          }else{

        $result = $this->language->page_model();

        if($result == true){

          $this->session->set_flashdata('message','The page has been added successfully...');

        } else{

          $this->session->set_flashdata('message','Already exists');

        }
      }

         redirect(base_url().'language/add-page');

    }



        $this->data['page'] = 'add_page';

        $this->load->vars($this->data);

        $this->load->view($this->data['theme'].'/template');



  }


    public function update_language_status()

  {

     $id = $this->input->post('id');

    $status = $this->input->post('update_language');

    if($status==2)
    {
      $this->db->where('id',$id);
      $this->db->where('default_language',1);
      $data=$this->db->get('language')->result_array();

      if(!empty($data))
      {
        echo "0";
      }
      else
      {
        $this->db->query(" UPDATE `language` SET `status` = ".$status." WHERE `id` = ".$id." ");
        echo "1";
      }

    }
    else
    {
      $this->db->query(" UPDATE `language` SET `status` = ".$status." WHERE `id` = ".$id." ");
      echo "1";
    }

    

  }


  public function update_language_default()

  {

     $id = $this->input->post('id');

        $this->db->where('id',$id);
      $this->db->where('status',1);
      $data=$this->db->get('language')->result_array();

      if(!empty($data))
      {
        $this->db->query("UPDATE language SET default_language = ''");
            $this->db->query(" UPDATE `language` SET `default_language` = 1 WHERE `id` = ".$id." ");
            echo "1";
      }
      else
      {
        echo "0";
      }

    

  }


  public function keywords()
  {
          $this->data['page'] = 'web_language_keywords';
          $this->data['active_language'] = $this->language->active_language();
          $this->load->vars($this->data);
          $this->load->view($this->data['theme'].'/template');
  }


  public function language_web_list()
    {
        $lists = $this->web_language->language_list();

         $data = array();
            $no = $_POST['start'];
            $active_language = $this->web_language->active_language();
            foreach ($lists as $keyword) {
             // $no++;
            $row    = array();
           // $row[] = $no;
               if (!empty($active_language))
                            {
                                      foreach ($active_language as $rows)
                                      { 

                                       $lg_language_name = $keyword['lang_key'];   
                                       $language_key = $rows['language_value']; 


                                      $key = $keyword['language'] ;
                                      $value = ($language_key == $key)?$keyword['lang_value']:'';
                                      $key = $keyword['language'];
                                      $currenct_page_key_value = $this->web_language->currenct_page_key_value($lists);

                                    
                                     
                                      $name =(!empty($currenct_page_key_value[$lg_language_name][$language_key]['name']))?$currenct_page_key_value[$lg_language_name][$language_key]['name']:'';
                                       $lang_key =(!empty($currenct_page_key_value[$lg_language_name][$language_key]['lang_key']))?$currenct_page_key_value[$lg_language_name][$language_key]['lang_key']:'';

                                    
                                      
                                      

                                      //$readonly = ($language_key=='en')?'readonly':'';

                                      $readonly = '';
                                      

                           $row[] = '<input type="text" class="form-control" placeholder="Name" name="'.$lg_language_name.'['.$language_key.'][lang_value]" value="'.$name.'" '.$readonly.' ><br>
                            <input type="text" class="form-control" value="'.$lang_key.'" readonly >
                         ';
                                      }

                      }

                      $data[] = $row;
                      }
          $output = array(
                          "draw" => $_POST['draw'],
                          "recordsTotal" => $this->web_language->language_list_all(),
                          "recordsFiltered" => $this->web_language->language_list_filtered(),
                          "data" => $data,
                  );

          //output to json format
          echo json_encode($output);

    }


    public function update_multi_web_language()

    {

      if ($this->input->post()) {

        

if($this->data['admin_id'] > 1){
            $this->session->set_flashdata('message', '<p class="alert alert-danger">Permission Denied</p>');    
            redirect(base_url().'language/keywords');

        }else{

          
        $data = $this->input->post();

     
        

        foreach($data as $row => $object)

        {

          if (!empty($object)) {



            foreach ($object as $key => $value) {

                       



              $this->db->where('language', $key);
              $this->db->where('lang_key', $row);
              
            $record = $this->db->count_all_results('language_management');



              if ($record==0) {
                 $array = array(
                          'language' =>$key,
                          'lang_key' =>$row,
                          'lang_value' =>$value['lang_value'],
                          
                        );

                $this->db->insert('language_management', $array);

              }else{

                 $this->db->where('language', $key);
                 $this->db->where('lang_key', $row);
               

                 $array = array(
                          'lang_value' =>$value['lang_value'],
                          
                        );

                  $this->db->update('language_management', $array);

              }

            }



          }

        }

      }
    }

      
     
      redirect(base_url().'language/keywords');

    }



    public function add_web_keyword()

  {


    if($this->input->post()){
      if($this->data['admin_id'] > 1){
            $this->session->set_flashdata('message', '<p class="alert alert-danger">Permission Denied</p>');    
            redirect(base_url().'language/add-web-keyword');

        }else{

      $result = $this->web_language->keyword_model();

      if($result == true){

        $this->session->set_flashdata('message','The Keyword has been added successfully...');

      }elseif(is_array($result) && count($result)==0){

        $this->session->set_flashdata('message','The Keyword has been added successfully...');

      }elseif(is_array($result) && count($result)> 0){

        $this->session->set_flashdata('message','Already exists'.implode(',',$result));

      } else{

        $this->session->set_flashdata('message','Already exists');

      }
    }

         redirect(base_url().'language/add-web-keyword');

    }



        $this->data['page'] = 'add_web_keyword';

        $this->load->vars($this->data);

        $this->load->view($this->data['theme'].'/template');



  }






  }
