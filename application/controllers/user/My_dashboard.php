<?php 



class My_dashboard extends CI_Controller{

	public function __construct() {

		parent::__construct();  
		error_reporting(0);
		$this->load->helper('currency');
		$this->load->model('user_panel_model');
		$this->load->helper('custom_language');
		$this->load->model('my_dashboard_model');

      $default_language_select=default_language();

      if($this->session->userdata('user_select_language')=='')
      {
        $this->data['user_selected'] = $default_language_select['language_value']; 
      }
      else
      {
        $this->data['user_selected'] =$this->session->userdata('user_select_language');
      }

      $this->data['active_language']= $active_lang = active_language();

   
     
      $lg = custom_language($this->data['user_selected']);

      $this->data['default_language'] = $lg['default_lang']; 

      $this->data['user_language'] = $lg['user_lang'];

      $this->user_selected = (!empty($this->data['user_selected']))?$this->data['user_selected']:'en';

      $this->default_language = (!empty($this->data['default_language']))?$this->data['default_language']:'';

      $this->user_language = (!empty($this->data['user_language']))?$this->data['user_language']:'';


      $this->load->model('payment_model');


		

		$this->load->helper('favourites');

    	$common_settings = gigs_settings();
    	$default_currency = 'USD';
        if(!empty($common_settings)){
          foreach($common_settings as $datas){
            if($datas['key']=='currency_option'){
             $default_currency = $datas['value'];
            }
         }
        }

        $this->load->helper('currency');
        $this->default_currency      = $default_currency;
        $this->default_currency_sign = currency_sign($default_currency);
        $this->smtp_config           = smtp_mail_config();

    	$result = gigs_settings();



		$this->data['theme'] = 'user'; 

		$this->data['module'] = 'my_dashboard';             

		$this->data['slogan']                    = $this->user_panel_model->get_slogan();

		$this->data['footer_main_menu']			 = $this->user_panel_model->footer_main_menu();

		$this->data['footer_sub_menu'] 			 = $this->user_panel_model->footer_sub_menu();

		$this->data['system_setting'] 			 = $this->user_panel_model->system_setting();    

		$this->data['policy_setting'] 			 = $this->user_panel_model->policy_setting();  	

		$this->data['categories_subcategories']  = $this->user_panel_model->categories_subcategories();

        //$this->data['rupee_dollar_rate']         = $this->user_panel_model->get_rupee_dollar_rate();

		

		$this->data['country_list']       = $this->user_panel_model->country_list(); 

		

		$this->email_address='mail@example.com';

		$this->email_tittle='Gigs';

		$this->logo_front=base_url().'assets/images/logo.png';

		$this->site_name ='gigs';

		

		$this->secret_key = '';

		$this->publishable_key = '';



		$publishable_key =  '';

		$secret_key =  '';

		$live_publishable_key =  '';

		$live_secret_key =  '' ;

		$this->paypal_id='';
		$paypal_option='';



		if(!empty($result))

		{

			foreach($result as $data){

				if($data['key'] == 'email_address'){

					$this->email_address = !empty($data['value']) ? $data['value'] : 'mail@example.com' ;

				}

				if($data['key'] == 'email_tittle'){

					$this->email_tittle = !empty($data['value']) ? $data['value'] : 'Gigs' ;

				}

				if($data['key'] == 'admin_commision'){

					$this->admin_commision = !empty($data['value']) ? $data['value'] : '0' ;

				}

				if($data['key'] == 'base_domain'){

					$this->base_domain = $data['value'];

				}

				if($data['key'] == 'logo_front'){

					$this->logo_front = base_url().$data['value'];

				}

				if($data['key'] == 'site_name' ||  $data['key'] == 'website_name'){

					$this->site_name = $data['value'];

				}





				if($data['key'] == 'live_publishable_key'){

					$live_publishable_key = $data['value'];

				}



				if($data['key'] == 'live_secret_key'){

					$live_secret_key = $data['value'];

				}





				if($data['key'] == 'publishable_key'){

					$publishable_key = $data['value'];

				}



				if($data['key'] == 'secret_key'){

					$secret_key = $data['value'];

				}

				if($data['key'] == 'stripe_option'){

					$stripe_option = $data['value'];

				}


				if($data['key'] == 'paypal_option'){

					$paypal_option = $data['value'];

				}




				$this->data['currency_option'] = 'USD';

	  			if($data['key']=='currency_option'){

	 				$this->data['currency_option'] =$data['value'];

	 			}

	 	 

			}



			if($stripe_option == 1){

				$this->publishable_key = $publishable_key;

				$this->secret_key      = $secret_key;

 			}

			if($stripe_option == 2){

				$this->publishable_key = $live_publishable_key;

				$this->secret_key      = $live_secret_key; 

			}


			if($paypal_option == 1){

				$this->paypal_id = $this->db->select('sandbox_email')->get('paypal_details')->row()->sandbox_email;

				

 			}

			if($paypal_option == 2){

				$this->paypal_id = $this->db->select('email')->get('paypal_details')->row()->email;

				

			}







		}



   

}

public function index()

{  

	
         $this->data['page_title'] = 'Dashboard';

		 $this->data['userid'] = $this->session->userdata('SESSION_USER_ID');

		 $this->data['profile'] = $this->my_dashboard_model->profile($this->session->userdata('SESSION_USER_ID'));
		
		 $this->data['page'] = 'index';

  	    $this->load->vars($this->data);  

		 $this->load->view($this->data['theme'].'/template');



}  


public function gigs_sales()
{
	    
	$months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');

	 $userid= $this->session->userdata('SESSION_USER_ID');
	 $from_timezone = $this->session->userdata('time_zone');      
    date_default_timezone_set($from_timezone);
	 $year=date('Y');


	 $json = array();

	    foreach ($months as $num => $name) {

	    	$sales = $this->db->query('SELECT COUNT(*)AS gigs_sales FROM `payments`WHERE `seller_status`=6 AND seller_id='.$userid.' AND Month(created_at)='.$num.' && YEAR(created_at)='.$year.'')->row_array(); 

	    	 $json[] = array('month' => $name, 'sales' =>$sales['gigs_sales']);
	    
	    }

	    echo json_encode($json);
	   
}


public function my_gigs_status()
{
	  
	 $userid= $this->session->userdata('SESSION_USER_ID');
	 $from_timezone = $this->session->userdata('time_zone');      
    date_default_timezone_set($from_timezone);
	 $year=date('Y');


	 $json = array();

	//  1.New 2.Pending 3.Processing 4.Refunded 5.Decline 6.Completed 

	    	$result = $this->db->query('SELECT COUNT(*) as gigs_count,seller_status, 
	    		CASE
	    		 WHEN seller_status = 1 THEN "New" 
	    		 WHEN seller_status = 2 THEN "Pending" 
	    		 WHEN seller_status = 3 THEN "Processing" 
	    		 WHEN seller_status = 4 THEN "Refunded" 
	    		 WHEN seller_status = 5 THEN "Decline" 
	    		 WHEN seller_status = 6 THEN "Completed" 
	    		 ELSE "Inactive" 
	    		 END AS gigs_status FROM `payments`WHERE seller_id='.$userid.' AND seller_status >=1 AND seller_status <=6 AND YEAR(created_at)='.$year.' GROUP BY(seller_status)')->result_array(); 



	    	foreach ($result as $value) {

	    	   		 $json[] = array('label' => $value['gigs_status'], 'value' =>$value['gigs_count'],);
	    	}

	    	
	    
	  

	    echo json_encode($json);
	   
}


public function my_gigs_amount()
{
	    
	$months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');

	 $userid= $this->session->userdata('SESSION_USER_ID');
	 $from_timezone = $this->session->userdata('time_zone');      
    date_default_timezone_set($from_timezone);
	 $year=date('Y');


	 $json = array();

	    foreach ($months as $num => $name) {

	    	$sales = $this->db->query('SELECT IFNULL(SUM(item_amount),0)AS gigs_sales_amount FROM `payments`WHERE `seller_status`=6 AND `payment_status`=2 AND seller_id='.$userid.' AND Month(created_at)='.$num.' && YEAR(created_at)='.$year.'')->row_array(); 

	    	 $json[] = array('month' => $name, 'amount' =>number_format($sales['gigs_sales_amount'],2));
	    
	    }

	    echo json_encode($json);
	   
}


	public function my_purchase($offset=0)
	{

		$first = (!empty($this->user_language[$this->user_selected]['lg_first']))?$this->user_language[$this->user_selected]['lg_first']:$this->default_language['en']['lg_first'];

    	$last = (!empty($this->user_language[$this->user_selected]['lg_last']))?$this->user_language[$this->user_selected]['lg_last']:$this->default_language['en']['lg_last'];

		$this->load->library('pagination');

        $config['base_url'] = base_url().'purchases';

        $config['per_page'] = 1;                

        $config['total_rows'] =  $this->payment_model->get_user_orders($this->session->userdata('SESSION_USER_ID'),0,0,0);   

		$config['uri_segment'] = 2;		

        $config['full_tag_open'] = '<ul class="pagination">';

        $config['full_tag_close'] = '</ul>';

        //$config['reuse_query_string'] = TRUE;

        $config['first_link'] = $first;

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



        $config['last_link'] = $last;

        $config['last_tag_open'] = '<li>';

        $config['last_tag_close'] = '</li>';



         $this->pagination->initialize($config);

		 $this->data['links'] = $this->pagination->create_links();

		 $this->data['page_title'] = 'Purchases';

		 $this->data['userid'] = $this->session->userdata('SESSION_USER_ID'); 

		 $this->data['order_count'] = $this->payment_model->get_selluser_orders_count($this->session->userdata('SESSION_USER_ID'));  

		 $this->data['order_data'] = $this->payment_model->get_user_orders($this->session->userdata('SESSION_USER_ID'),1,$offset,$config['per_page']);
		 
		 $this->data['purchases_order_count'] = $this->payment_model->get_user_orders_count($this->session->userdata('SESSION_USER_ID'));  

		 $this->data['wallet_order_count'] = $this->payment_model->get_wallets_orders_count($this->session->userdata('SESSION_USER_ID'));

		 $user_id=$this->session->userdata('SESSION_USER_ID');

		 $bank_query = $this->db->query("SELECT * FROM `bank_account` WHERE `user_id` = $user_id ");

		 $this->data['list'] = $bank_query->row_array();

         $this->data['page_title'] = 'My Purchase';

		 $this->data['userid'] = $this->session->userdata('SESSION_USER_ID');

		 $this->data['profile'] = $this->my_dashboard_model->profile($this->session->userdata('SESSION_USER_ID'));
		
		 $this->data['page'] = 'my_purchase';

  	    $this->load->vars($this->data);  

		 $this->load->view($this->data['theme'].'/template');
	}


	public function my_subscription()
    {



		$userid = $this->session->userdata('SESSION_USER_ID');

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
        $this->data['page'] = 'my_subscription';
        $this->data['list'] = $this->my_dashboard_model->get_mysubscription($userid);
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');
    }



	}

	?>