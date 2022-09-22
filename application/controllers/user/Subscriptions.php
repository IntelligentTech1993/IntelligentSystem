<?php

if (!defined('BASEPATH'))

    exit('No direct script access allowed');

class Subscriptions extends CI_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        error_reporting(0);

         $config = array();
        $this->load->helper('custom_language');
        $this->load->library('paypal_lib');

        $this->load->model('templates_model');

      $this->data['user_selected'] =$this->session->userdata('user_select_language');

      $this->data['active_language']= $active_lang = active_language();

          
      $lg = custom_language($this->data['user_selected']);

      $this->data['default_language'] = $lg['default_lang']; 

      $this->data['user_language'] = $lg['user_lang'];

      $this->user_selected = (!empty($this->data['user_selected']))?$this->data['user_selected']:'en';

      $this->default_language = (!empty($this->data['default_language']))?$this->data['default_language']:'';

      $this->user_language = (!empty($this->data['user_language']))?$this->data['user_language']:'';

      $query = $this->db->query("select * from system_settings WHERE status = 1");
    $result = $query->result_array();
    $this->email_address='mail@example.com';
    $this->email_tittle='Gigs';
     $this->base_domain = base_url();
     $this->logo_front=base_url().'assets/images/logo.png';
    if(!empty($result))

    {

    foreach($result as $data){

    if($data['key'] == 'email_address'){

    $this->email_address = !empty($data['value']) ?$data['value'] : 'mail@example.com' ;

    }

     if($data['key'] == 'email_tittle'){

    $this->email_tittle =!empty($data['value']) ? $data['value'] : 'gigs' ;

    }

       if($data['key'] == 'logo_front'){

    $this->logo_front = base_url().$data['value'];

    }

    if($data['key'] == 'site_name' ||  $data['key'] == 'website_name'){

    $this->site_name = $data['value'];

    }

      $this->data['currency_option'] = 'USD';

          if($data['key']=='currency_option'){

      $this->data['currency_option'] =$data['value'];

        }

    }

    }

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

    $this->data['secret_key'] = '';

    $this->data['publishable_key'] = '';



    $publishable_key =  '';

    $secret_key =  '';

    $live_publishable_key =  '';

    $live_secret_key =  '';

    $stripe_option = '';

    $this->paypal_id='';
    $paypal_option='';


    $this->paytabs_email='';
    $this->paytabs_secretkey='';
    $paytabs_option='';

    $this->data['paytabs_allow'] ='';



   /***********************Stripe API Key and Secret Key  ***************************/



   /***********************Amplifypay API Key and Secret Key  ***************************/



   $this->data['amplify_api_key']     = '';

   $this->data['amplify_secret_key']  = '';

   $this->data['paypal_allow']        = '';

   $this->data['stripe_allow']        = '';



   $demo_amplify_api_key    = '';

   $demo_amplify_secret_key = '';

   $live_amplify_api_key    = '';

   $live_amplify_secret_key = '';

   $amplifypay_option       = '';

   $this->data['subscription_notify_days']        = '7';


   /***********************Amplifypay API Key and Secret Key  ***************************/



   if(!empty($common_settings))

    {

      foreach($common_settings as $datas){
        if($datas['key'] == 'paypal_allow'){

          $this->data['paypal_allow'] = $datas['value'];

        }

        if($datas['key'] == 'stripe_allow'){

          $this->data['stripe_allow'] = $datas['value'];

        }

         if($datas['key'] == 'paytabs_allow'){

          $this->data['paytabs_allow'] = $datas['value'];

        }

        if($datas['key'] == 'paytabs_option'){

          $paytabs_option = $datas['value'];

        }

         if($datas['key'] == 'secret_key'){

          $secret_key = $datas['value'];

        }

        if($datas['key'] == 'publishable_key'){

          $publishable_key = $datas['value'];

        }

        if($datas['key'] == 'live_secret_key'){

          $live_secret_key = $datas['value'];

        }

        if($datas['key'] == 'live_publishable_key'){

          $live_publishable_key = $datas['value'];

        }

        if($datas['key'] == 'stripe_option'){

          $stripe_option = $datas['value'];

        }

        if($datas['key'] == 'paypal_option'){

          $paypal_option = $datas['value'];

        }

        if($datas['key'] == 'amplifypay_option'){

          $amplifypay_option = $datas['value'];

        }if($datas['key'] == 'amplifypay_api_key'){

          $demo_amplify_api_key = $datas['value'];

        }

        if($datas['key'] == 'amplifypay_merchant_id'){

          $demo_amplify_secret_key = $datas['value'];

        }



        if($datas['key'] == 'live_amplifypay_api_key'){

          $live_amplify_api_key = $datas['value'];

        }

        if($datas['key'] == 'live_amplifypay_merchant_id'){

          $live_amplify_secret_key = $datas['value'];

        }
        if($datas['key']=='currency_option'){

         $this->data['currency_option'] =$datas['value'];

        }

        if($datas['key']=='subscription_notify_days'){

         $this->data['subscription_notify_days'] =$datas['value'];

        }

      }

      if(@$stripe_option == 1){

        $this->data['publishable_key'] = $publishable_key;

        $this->data['secret_key']      = $secret_key;

      }

      if(@$stripe_option == 2){

        $this->data['publishable_key'] = $live_publishable_key;

        $this->data['secret_key']      = $live_secret_key;

      }

      if($amplifypay_option == 1){

       $this->data['amplify_api_key']     = $demo_amplify_api_key;

       $this->data['amplify_secret_key']  = $demo_amplify_secret_key;

      }

      if($amplifypay_option == 2){

        $this->data['amplify_api_key']     = $live_amplify_api_key;

        $this->data['amplify_secret_key']  = $live_amplify_secret_key;

      }

      if($paypal_option == 1){

        $this->paypal_id = $this->db->select('sandbox_email')->get('paypal_details')->row()->sandbox_email;

        

      }

      if($paypal_option == 2){

        $this->paypal_id = $this->db->select('email')->get('paypal_details')->row()->email;

        

      }

    }


    if($paytabs_option == 1){

        $this->paytabs_email = $this->db->select('sandbox_email')->get('paytabs_details')->row()->sandbox_email;
        $this->paytabs_secretkey = $this->db->select('sandbox_secretkey')->get('paytabs_details')->row()->sandbox_secretkey;


      }

      if($paytabs_option == 2){

        $this->paytabs_email = $this->db->select('email')->get('paytabs_details')->row()->email;
        $this->paytabs_secretkey = $this->db->select('secretkey')->get('paytabs_details')->row()->secretkey;

      }



       $config['publishable_key'] = $this->data['publishable_key'];

       $config['secret_key'] = $this->data['secret_key'];

       $this->load->library('stripe',$config);

        

        $this->load->helper('currency');
        $this->default_currency      = $default_currency;
        $this->default_currency_sign = currency_sign($default_currency);
        $this->smtp_config           = smtp_mail_config();

         $this->data['default_currency_sign'] =$this->default_currency_sign;

        $this->data['theme'] = 'user';

        $this->data['module'] = 'subscriptions';

		$this->load->model('user_panel_model');

		$this->load->model('subscriptions_model');

		$this->data['title'] = 'Gigs';

    $this->data['categories_subcategories'] = $this->user_panel_model->categories_subcategories();  

    $this->data['footer_main_menu'] = $this->user_panel_model->footer_main_menu();

    $this->data['footer_sub_menu'] = $this->user_panel_model->footer_sub_menu();

		$this->data['system_setting'] = $this->user_panel_model->system_setting(); 		



		if($this->session->userdata('SESSION_USER_ID')==''){ 

			redirect(base_url(''));

		}



    }

    public function index() {

    	

		 $this->data['page_title'] = 'Subscriptions';

     $this->data['subscriptionmethod'] = 'New';

		 $this->data['userid'] = $this->session->userdata('SESSION_USER_ID');

		 $this->data['subscriptions']  =  $this->subscriptions_model->subscription_data();
		 	 
		 $this->data['page'] = 'index';

  	 $this->load->vars($this->data);  

		 $this->load->view($this->data['theme'].'/template');

    }


    public function renewal() {

      

     $this->data['page_title'] = 'Subscriptions';

     $this->data['subscriptionmethod'] = 'Renewal';

     $this->data['userid'] = $this->session->userdata('SESSION_USER_ID');

     $this->data['subscriptions']  =  $this->subscriptions_model->subscription_data();
       
     $this->data['page'] = 'index';

     $this->load->vars($this->data);  

     $this->load->view($this->data['theme'].'/template');

    }


    public function payment()

{

  if($this->input->post('submit'))

  { 


    if($this->input->post('group2')=='PayTabs')
    {
      $this->paytabs_payments();
    }
    else
    {
   
            $from_timezone = $this->session->userdata('time_zone');      
            date_default_timezone_set($from_timezone); 
            $current_time= date('Y-m-d H:i:s');

            $data['subscription_id']   = $this->input->post('subscription_id');
            $data['subscription_name']     = $this->input->post('subscription_name');
            $data['subscription_period']   = $this->input->post('subscription_period');
            $data['subscription_gigs']   = $this->input->post('subscription_gigs');
            $data['subscription_amount']   = $this->input->post('subscription_amount');
            $data['userid']          = $this->session->userdata('SESSION_USER_ID');
            $currency_symbol   =  $this->default_currency_sign;
            $data['time_zone'] = $this->session->userdata('time_zone');
            
            $amount              =   $data['subscription_amount'];

            if($currency_symbol=="$"){ $currency_type = 'USD';}

            if($currency_symbol=="€"){ $currency_type = 'EUR';}

            if($currency_symbol=="£"){ $currency_type = 'GBP';}

            $data['currency_type']  =  $currency_type; 

            $data['expired_date']         =  Date('Y-m-d H:i:s', strtotime("+".$data['subscription_period'].""));  

            $data['created_at']  = $current_time;

            $data['status']      = 1;

            $data['source']      = 'paypal';

            $check_already_subscribe=$this->db->query("select * from subscriptions_payments WHERE userid = ".$data['userid']." AND subscription_payment_status=1 AND status=1")->row_array();

            if(!empty($check_already_subscribe))
            {

              $this->db->where('id',$check_already_subscribe['id']);
              $this->db->delete('subscriptions_payments');


              if($this->db->insert('subscriptions_payments',$data)){

                    $users_tbl_id  =  $this->db->insert_id();

                    $data['payments_id']=$users_tbl_id; 

                    $this->db->insert('subscriptions_payments_logs',$data);

                    $log_tbl_id  =  $this->db->insert_id(); 

                    $amount_1 =intval(($amount*100))/100;

                    $s_name=  $data['subscription_name'] ;

                    if($amount==0)
                    {
                      $this->free_subscription($users_tbl_id,$log_tbl_id);
                    }
                    else
                    {
                       $this->buy($users_tbl_id,$amount_1,$log_tbl_id,$s_name,$currency_type);
                    }

                    

                  }

            }
            else
            {
                  if($this->db->insert('subscriptions_payments',$data)){

                    $users_tbl_id  =  $this->db->insert_id();

                    $data['payments_id']=$users_tbl_id; 

                    $this->db->insert('subscriptions_payments_logs',$data);

                    $log_tbl_id  =  $this->db->insert_id();

                    $amount_1 =intval(($amount*100))/100;

                    $s_name=  $data['subscription_name'] ;

                      if($amount==0)
                      {
                        $this->free_subscription($users_tbl_id,$log_tbl_id);
                      }
                      else
                      {
                         $this->buy($users_tbl_id,$amount_1,$log_tbl_id,$s_name,$currency_type);
                      }

                  }

            }

      }

  }

}

function buy($id,$amount,$user_id,$g_name,$currency_type){

    //Set variables for paypal form

    $returnURL =base_url($this->data['theme'] .'/subscriptions/paypal_success/'); //payment success url

    $cancelURL = base_url($this->data['theme'] .'/subscriptions/paypal_cancel'); //payment cancel url

    $notifyURL = base_url().'user/subscriptions/ipn'; //ipn url

    $userID = $user_id; //current user id

    $name =$g_name;

    $this->paypal_lib->add_field('return', $returnURL);

    $this->paypal_lib->add_field('cancel_return', $cancelURL);

    $this->paypal_lib->add_field('notify_url', $notifyURL);

    $this->paypal_lib->add_field('item_name', $name);

    $this->paypal_lib->add_field('custom', $userID);

    $this->paypal_lib->add_field('item_number',  $id);

    $this->paypal_lib->add_field('amount',  $amount);   

    $this->paypal_lib->add_field('currency_code', $currency_type);  

    $this->paypal_lib->add_field('business', $this->paypal_id); 
    // $this->paypal_lib->add_field('currency_code', $currency_type); 

    //$this->paypal_lib->image($logo);

    $this->paypal_lib->paypal_auto_form();

  }

  function paypal_success(){


     if(isset($_POST["txn_id"]) && !empty($_POST["txn_id"]))
      {
        $paypalInfo =  $this->input->post();
        $txn_id= $paypalInfo['txn_id']; 
        $item_number=$paypalInfo['item_number']; 
        $cm=$paypalInfo['cm'];  
      }
      else
      {
        $paypalInfo =  $this->input->get();
        $txn_id= $paypalInfo['tx']; 
        $item_number=$paypalInfo['item_number'];
        $cm=$paypalInfo['cm'];
      }

    $order_id= $txn_id;         

    $table_data['paypal_uid'] = $txn_id;

    $table_data['subscription_payment_status'] = 1;

    $uid = $item_number; 

    $logid = $cm;               

    $this->db->where('id',$uid);

    if($this->db->update('subscriptions_payments', $table_data))
    {
        $this->db->where('id',$logid);
        $this->db->update('subscriptions_payments_logs',$table_data);

        $query = $this->db->query("SELECT *, m.username, m.email FROM subscriptions_payments as s 

                                    JOIN members m on m.USERID = s.userid

                                    WHERE id = '".$uid."'");

        $data_one = $query->row_array();

        $to_email= $data_one['email'];

        $username = $data_one['username'];

        $bodyid = 37;

        $tempbody_details= $this->templates_model->get_usertemplate_data($bodyid);

        $body=$tempbody_details['template_content'];

        $message='';

        //$gig_preview_link  = base_url().'gig-preview/'.$title ;            

        $body = str_replace('{base_url}', $this->base_domain, $body);

        $body = str_replace('{base_image}',$this->base_domain.'/'.$this->logo_front, $body); 

        $body = str_replace('{username}', $data_one['username'], $body);

        $body = str_replace('{subscription_name}', $data_one['subscription_name'], $body);

        $body = str_replace('{currency_type}', $data_one['currency_type'], $body);

        $body = str_replace('{subscription_period}', $data_one['subscription_period'], $body);

        $body = str_replace('{subscription_gigs}', $data_one['subscription_gigs'], $body);

        $body = str_replace('{subscription_amount}', $data_one['subscription_amount'], $body);

        $body = str_replace('{expired_date}', $data_one['expired_date'], $body);

        $body = str_replace('{sitetitle}',$this->site_name, $body); 

                            $message ='<table style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">

                <tr>

                  <td></td>

                  <td width="600" style="box-sizing: border-box; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">

                    <div style="box-sizing: border-box; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">

                      <table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff">

                        <tr>

                          <td style="box-sizing: border-box; vertical-align: top; text-align: left; margin: 0; padding: 20px;" valign="top">

                            <table width="100%" cellpadding="0" cellspacing="0">

                              <tr>

                                <td style="text-align:center;">

                                  <a href="{base_url}" target="_blank"><img src="'.$this->logo_front.'" style="width:90px" /></a>

                                </td>

                              </tr>

                              <tr>

                                <td>'.$body.'</td>

                              </tr>

                            </table>

                          </td>

                        </tr>

                      </table>

                      <div style="box-sizing: border-box; width: 100%; clear: both; color: #999; margin: 0; padding: 15px 15px 0 15px;">

                        <table width="100%">

                          <tr>

                            <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0;" align="center" valign="top">

                              &copy; '.date("Y").' <a href="'.$this->base_domain.'" target="_blank" style="color:#bbadfc;" target="_blank">'.$this->site_name.'</a> All Rights Reserved.

                            </td>

                          </tr>

                        </table>

                      </div>

                    </div>

                  </td>

                </tr>

              </table>'; 

        $this->load->helper('file');  

        $this->load->library('email');
        
        $this->email->initialize($this->smtp_config);

        $this->email->set_newline("\r\n");

        $this->email->from($this->email_address,$this->email_tittle); 

        $this->email->to($to_email); 

        $this->email->subject('Subscription Payment Success ');

        $this->email->message($message);

       $this->email->send();

      redirect(base_url().'sell-service');
    }

  }

   function free_subscription($uid,$logid){

    $table_data['paypal_uid'] = 'Free Subscription';

    $table_data['subscription_payment_status'] = 1;

    $this->db->where('id',$uid);

    if($this->db->update('subscriptions_payments', $table_data))
    {
        $this->db->where('id',$logid);
        $this->db->update('subscriptions_payments_logs',$table_data);

        $query = $this->db->query("SELECT *, m.username, m.email FROM subscriptions_payments as s 

                                    JOIN members m on m.USERID = s.userid

                                    WHERE id = '".$uid."'");

        $data_one = $query->row_array();

        $to_email= $data_one['email'];

        $username = $data_one['username'];

        

        $bodyid = 37;

        $tempbody_details= $this->templates_model->get_usertemplate_data($bodyid);

        $body=$tempbody_details['template_content'];

        $message='';

        //$gig_preview_link  = base_url().'gig-preview/'.$title ;            

        $body = str_replace('{base_url}', $this->base_domain, $body);

        $body = str_replace('{base_image}',$this->base_domain.'/'.$this->logo_front, $body); 

        $body = str_replace('{username}', $data_one['username'], $body);

        $body = str_replace('{subscription_name}', $data_one['subscription_name'], $body);

        $body = str_replace('{currency_type}', $data_one['currency_type'], $body);

        $body = str_replace('{subscription_period}', $data_one['subscription_period'], $body);

        $body = str_replace('{subscription_gigs}', $data_one['subscription_gigs'], $body);

        $body = str_replace('{subscription_amount}', $data_one['subscription_amount'], $body);

        $body = str_replace('{expired_date}', $data_one['expired_date'], $body);

        $body = str_replace('{sitetitle}',$this->site_name, $body); 

                            $message ='<table style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">

                <tr>

                  <td></td>

                  <td width="600" style="box-sizing: border-box; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">

                    <div style="box-sizing: border-box; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">

                      <table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff">

                        <tr>

                          <td style="box-sizing: border-box; vertical-align: top; text-align: left; margin: 0; padding: 20px;" valign="top">

                            <table width="100%" cellpadding="0" cellspacing="0">

                              <tr>

                                <td style="text-align:center;">

                                  <a href="{base_url}" target="_blank"><img src="'.$this->logo_front.'" style="width:90px" /></a>

                                </td>

                              </tr>

                              <tr>

                                <td>'.$body.'</td>

                              </tr>

                            </table>

                          </td>

                        </tr>

                      </table>

                      <div style="box-sizing: border-box; width: 100%; clear: both; color: #999; margin: 0; padding: 15px 15px 0 15px;">

                        <table width="100%">

                          <tr>

                            <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0;" align="center" valign="top">

                              &copy; '.date("Y").' <a href="'.$this->base_domain.'" target="_blank" style="color:#bbadfc;" target="_blank">'.$this->site_name.'</a> All Rights Reserved.

                            </td>

                          </tr>

                        </table>

                      </div>

                    </div>

                  </td>

                </tr>

              </table>'; 

        $this->load->helper('file');  

        $this->load->library('email');
        
        $this->email->initialize($this->smtp_config);

        $this->email->set_newline("\r\n");

        $this->email->from($this->email_address,$this->email_tittle); 

        $this->email->to($to_email); 

        $this->email->subject('Subscription Payment Success ');

        $this->email->message($message);

        $this->email->send();

      redirect(base_url().'sell-service');
    }

  }

  function paypal_cancel(){

      redirect(base_url().'subscriptions');

    }



    public function stripe_payment() { 



    $from_timezone = $this->session->userdata('time_zone');      
    date_default_timezone_set($from_timezone); 
    $current_time= date('Y-m-d H:i:s');

    $data['subscription_id']   = $this->input->post('subscription_id');
    $data['subscription_name']     = $this->input->post('subscription_name');
    $data['subscription_period']   = $this->input->post('subscription_period');
    $data['subscription_gigs']   = $this->input->post('subscription_gigs');
    $data['subscription_amount']   = $this->input->post('subscription_amount');
    $data['userid']          = $this->session->userdata('SESSION_USER_ID');
    $data['expired_date']         =  Date('Y-m-d H:i:s', strtotime("+".$data['subscription_period']."")); 

    $currency_symbol   =  $this->default_currency_sign;
    $data['time_zone'] = $this->session->userdata('time_zone');
    $amount              =   $data['subscription_amount'];

    if($currency_symbol=="$"){ $currency_type = 'USD';}

    if($currency_symbol=="€"){ $currency_type = 'EUR';}

    if($currency_symbol=="£"){ $currency_type = 'GBP';}

    $data['currency_type']  =  $currency_type; 
     
    $stripe_token = $this->input->post('access_token');
    $amount   = ($amount * 100); // Dollar in cents 
     
      $charges_array                 = array();

      $charges_array['amount']       = $amount;

      $charges_array['currency']     = $currency_type;

      $charges_array['description']  = $data['subscription_name'];

      $charges_array['source']       = $stripe_token;

        $response = $this->stripe->stripe_charges($charges_array);

        $charge_id = "issue";

       $stripe_payment_status='Failed';

      if(!empty($response)){

        $stripe_payment_status='Success';

        $data['stripe_charge'] = $response; 

        $response  = json_decode($response,true);
        if(!empty($response['id'])){
          $charge_id = $response['id'];
        }else{
          $charge_id = 0;
        }
        $charge_id = (!empty($charge_id))?$charge_id:'issue';

        

      } 

       $data['subscription_payment_status'] = ($charge_id!='issue')?1:0;  

       $data['created_at']    = $current_time;

       $data['status']        = 1;

       $data['paypal_uid']    = $charge_id; 

       $data['source']      = 'stripe';   

        $check_already_subscribe=$this->db->query("select * from subscriptions_payments WHERE userid = ".$data['userid']." AND subscription_payment_status=1 AND status=1")->row_array(); 
        if(!empty($check_already_subscribe))
        {

            $this->db->where('id',$check_already_subscribe['id']);
            $this->db->delete('subscriptions_payments');

             $this->db->insert('subscriptions_payments',$data); 
             $insert_id = $this->db->insert_id();

             $data['payments_id']=$insert_id; 

            $this->db->insert('subscriptions_payments_logs',$data);

         }
         else
         {
             $this->db->insert('subscriptions_payments',$data); 
             $insert_id = $this->db->insert_id();

             $data['payments_id']=$insert_id; 

            $this->db->insert('subscriptions_payments_logs',$data);
         }   

       

       $result = array('status'=>$stripe_payment_status,'payment_id'=>$insert_id);



       $query = $this->db->query("SELECT *, m.username, m.email FROM subscriptions_payments as s 

                                    JOIN members m on m.USERID = s.userid

                                    WHERE id = '".$insert_id."'");

        $data_one = $query->row_array();

        $to_email= $data_one['email'];

        $username = $data_one['username'];

        $bodyid = 37;

        $tempbody_details= $this->templates_model->get_usertemplate_data($bodyid);

        $body=$tempbody_details['template_content'];

        $message='';

        //$gig_preview_link  = base_url().'gig-preview/'.$title ;            

        $body = str_replace('{base_url}', $this->base_domain, $body);

        $body = str_replace('{base_image}',$this->base_domain.'/'.$this->logo_front, $body); 

        $body = str_replace('{username}', $data_one['username'], $body);

        $body = str_replace('{subscription_name}', $data_one['subscription_name'], $body);

        $body = str_replace('{currency_type}', $data_one['currency_type'], $body);

        $body = str_replace('{subscription_period}', $data_one['subscription_period'], $body);

        $body = str_replace('{subscription_gigs}', $data_one['subscription_gigs'], $body);

        $body = str_replace('{subscription_amount}', $data_one['subscription_amount'], $body);

        $body = str_replace('{expired_date}', $data_one['expired_date'], $body);

        $body = str_replace('{sitetitle}',$this->site_name, $body); 

                            $message ='<table style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">

                <tr>

                  <td></td>

                  <td width="600" style="box-sizing: border-box; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">

                    <div style="box-sizing: border-box; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">

                      <table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff">

                        <tr>

                          <td style="box-sizing: border-box; vertical-align: top; text-align: left; margin: 0; padding: 20px;" valign="top">

                            <table width="100%" cellpadding="0" cellspacing="0">

                              <tr>

                                <td style="text-align:center;">

                                  <a href="{base_url}" target="_blank"><img src="'.$this->logo_front.'" style="width:90px" /></a>

                                </td>

                              </tr>

                              <tr>

                                <td>'.$body.'</td>

                              </tr>

                            </table>

                          </td>

                        </tr>

                      </table>

                      <div style="box-sizing: border-box; width: 100%; clear: both; color: #999; margin: 0; padding: 15px 15px 0 15px;">

                        <table width="100%">

                          <tr>

                            <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0;" align="center" valign="top">

                              &copy; '.date("Y").' <a href="'.$this->base_domain.'" target="_blank" style="color:#bbadfc;" target="_blank">'.$this->site_name.'</a> All Rights Reserved.

                            </td>

                          </tr>

                        </table>

                      </div>

                    </div>

                  </td>

                </tr>

              </table>';

        $this->load->helper('file');  

        $this->load->library('email');
        
        $this->email->initialize($this->smtp_config);

        $this->email->set_newline("\r\n");

        $this->email->from($this->email_address,$this->email_tittle); 

        $this->email->to($to_email); 

        $this->email->subject('Subscription Payment Success');

        $this->email->message($message);

       $this->email->send();


       if($stripe_payment_status=='Failed')
       {
        $this->session->set_flashdata('message','Payment Failed. Please try again');
       }


       echo json_encode($result);




       die();

    }


    public function subscriptions_payments_validity()
    {
        $from_timezone = $this->session->userdata('time_zone');      
        date_default_timezone_set($from_timezone); 
        $current_time= date('Y-m-d H:i:s');

        $current_time=Date('Y-m-d H:i:s', strtotime("+ ".$this->data['subscription_notify_days']." Days")); 

              $where1=array('expired_date <=' => $current_time,
                            'subscription_payment_status'=>1,
                            'status'=>1);

            // $check_validity =$this->db->query("SELECT *, m.username, m.email, IF(TIMESTAMPDIFF(DAY, '".date('Y-m-d H:i:s')."', expired_date)=0, '1', TIMESTAMPDIFF(DAY, '".date('Y-m-d H:i:s')."', expired_date))  AS 'expire_days' FROM `subscriptions_payments` JOIN members m on m.USERID = userid WHERE `expired_date` <= '".$current_time."' AND `subscription_payment_status` = 1 AND `status` = 1")->result_array();

             $check_validity = $this->db->query("SELECT s.userid,s.expired_date, m.username, m.email, IF(TIMESTAMPDIFF(DAY, '".date('Y-m-d H:i:s')."', expired_date)=0, '1', TIMESTAMPDIFF(DAY, '".date('Y-m-d H:i:s')."', expired_date))  AS 'expire_days' FROM subscriptions_payments s 

                                    JOIN members m on m.USERID = s.userid

                                    WHERE(`expired_date` >= '".date('Y-m-d H:i:s')."' AND `expired_date` <= '".$current_time."')  AND `subscription_payment_status` = 1 ")->result_array();


            foreach ($check_validity as $data_one) {
             

        $to_email= $data_one['email'];

        $username = $data_one['username'];

        $bodyid = 37;

        $tempbody_details= $this->templates_model->get_usertemplate_data($bodyid);

        $body=$tempbody_details['template_content'];

        $message='';

        //$gig_preview_link  = base_url().'gig-preview/'.$title ;            

        $body = str_replace('{base_url}', $this->base_domain, $body);

        $body = str_replace('{base_image}',$this->base_domain.'/'.$this->logo_front, $body); 

        $body = str_replace('{username}', $data_one['username'], $body);

        $body = str_replace('{subscription_name}', $data_one['subscription_name'], $body);

        $body = str_replace('{currency_type}', $data_one['currency_type'], $body);

        $body = str_replace('{subscription_period}', $data_one['subscription_period'], $body);

         $body = str_replace('{subscription_gigs}', $data_one['subscription_gigs'], $body);

        $body = str_replace('{subscription_amount}', $data_one['subscription_amount'], $body);

        $body = str_replace('{expired_date}', $data_one['expired_date'], $body);

        $body = str_replace('{sitetitle}',$this->site_name, $body); 

          $message ='<table style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">

                <tr>

                  <td></td>

                  <td width="600" style="box-sizing: border-box; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">

                    <div style="box-sizing: border-box; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">

                      <table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff">

                        <tr>

                          <td style="box-sizing: border-box; vertical-align: top; text-align: left; margin: 0; padding: 20px;" valign="top">

                            <table width="100%" cellpadding="0" cellspacing="0">

                              <tr>

                                <td style="text-align:center;">

                                  <a href="{base_url}" target="_blank"><img src="'.$this->logo_front.'" style="width:90px" /></a>

                                </td>

                              </tr>

                              <tr>

                                <td>'.$body.'</td>

                              </tr>

                            </table>

                          </td>

                        </tr>

                      </table>

                      <div style="box-sizing: border-box; width: 100%; clear: both; color: #999; margin: 0; padding: 15px 15px 0 15px;">

                        <table width="100%">

                          <tr>

                            <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0;" align="center" valign="top">

                              &copy; '.date("Y").' <a href="'.$this->base_domain.'" target="_blank" style="color:#bbadfc;" target="_blank">'.$this->site_name.'</a> All Rights Reserved.

                            </td>

                          </tr>

                        </table>

                      </div>

                    </div>

                  </td>

                </tr>

              </table>';

        $this->load->helper('file');  

        $this->load->library('email');
        
        $this->email->initialize($this->smtp_config);

        $this->email->set_newline("\r\n");

        $this->email->from($this->email_address,$this->email_tittle); 

        $this->email->to($to_email); 

        $this->email->subject('Subscription Expire in '.$data_one['expire_days'].' Days');

        $this->email->message($message);

        $this->email->send();

      }


    }




    public function paytabs_payments()
    {
            $from_timezone = $this->session->userdata('time_zone');      
            date_default_timezone_set($from_timezone); 
            $current_time= date('Y-m-d H:i:s');

            $data['subscription_id']   = $this->input->post('subscription_id');
            $data['subscription_name']     = $this->input->post('subscription_name');
            $data['subscription_period']   = $this->input->post('subscription_period');
            $data['subscription_gigs']   = $this->input->post('subscription_gigs');
            $data['subscription_amount']   = $this->input->post('subscription_amount');
            $data['userid']          = $this->session->userdata('SESSION_USER_ID');
            $currency_symbol   =  $this->default_currency_sign;
            $data['time_zone'] = $this->session->userdata('time_zone');
            
            $amount              =   $data['subscription_amount'];

            if($currency_symbol=="$"){ $currency_type = 'USD';}

            if($currency_symbol=="€"){ $currency_type = 'EUR';}

            if($currency_symbol=="£"){ $currency_type = 'GBP';}

            $data['currency_type']  =  $currency_type; 

            $data['expired_date']         =  Date('Y-m-d H:i:s', strtotime("+".$data['subscription_period'].""));  

            $data['created_at']  = $current_time;

            $data['status']      = 1;

            $data['source']      = 'paytabs';

            $check_already_subscribe=$this->db->query("select * from subscriptions_payments WHERE userid = ".$data['userid']." AND subscription_payment_status=1 AND status=1")->row_array();

            if(!empty($check_already_subscribe))
            {

              $this->db->where('id',$check_already_subscribe['id']);
              $this->db->delete('subscriptions_payments');


              if($this->db->insert('subscriptions_payments',$data)){

                    $users_tbl_id  =  $this->db->insert_id();

                    $data['payments_id']=$users_tbl_id; 

                    $this->db->insert('subscriptions_payments_logs',$data);

                    $log_tbl_id  =  $this->db->insert_id(); 

                    $amount_1 =intval(($amount*100))/100;

                    $s_name=  $data['subscription_name'] ;

                    if($amount==0)
                    {
                      $this->free_subscription($users_tbl_id,$log_tbl_id);
                    }
                    else
                    {
                       $this->paytabs($users_tbl_id,$amount_1,$log_tbl_id,$s_name,$currency_type);
                    }

                    

                  }

            }
            else
            {
                  if($this->db->insert('subscriptions_payments',$data)){

                    $users_tbl_id  =  $this->db->insert_id();

                    $data['payments_id']=$users_tbl_id; 

                    $this->db->insert('subscriptions_payments_logs',$data);

                    $log_tbl_id  =  $this->db->insert_id();

                    $amount_1 =intval(($amount*100))/100;

                    $s_name=  $data['subscription_name'] ;

                      if($amount==0)
                      {
                        $this->free_subscription($users_tbl_id,$log_tbl_id);
                      }
                      else
                      {
                         $this->paytabs($users_tbl_id,$amount_1,$log_tbl_id,$s_name,$currency_type);
                      }

                  }

            }
    }


    public function paytabs($id,$amount,$log_id,$g_name,$currency_type)
    {

        //paytabs----------------------------                     

            $ip =isset($_SERVER['HTTP_CLIENT_IP'])?$_SERVER['HTTP_CLIENT_IP']:isset($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR'];
             $USERID = $this->session->userdata('SESSION_USER_ID');
             $userdetails=$this->db->query('select m.email,m.fullname,m.city,m.contact,m.address,m.zipcode,c.sortname,c.country,s.state_name from members as m 
                         LEFT JOIN country as c on c.id=m.country
                         LEFT JOIN states as s on s.state_id=m.state
                         WHERE USERID='.$USERID.'')->row_array();


$details= array("merchant_email" => $this->paytabs_email,
                "secret_key" => $this->paytabs_secretkey,
                "site_url" => base_url($this->data['theme']),
                "return_url" => base_url($this->data['theme'] .'/subscriptions/paytabs_success/'),
                "title" => $g_name,
                "cc_first_name" => $userdetails['fullname'],
                "cc_last_name" => "Not Mentioned",
                "cc_phone_number" => !empty($userdetails['contact'])?$userdetails['contact']:'0000',
                "phone_number" => !empty($userdetails['contact'])?$userdetails['contact']:'0000',
                "email" => $userdetails['email'],
                "products_per_title" => $g_name,
                "unit_price" => $amount,
                "quantity" => "1",
                "other_charges" => "0",
                "amount" => $amount,
                "discount" => "0",
                "currency" => $currency_type,
                "reference_no" => $id.'||'.$log_id,
                "ip_customer" =>$ip,
                "ip_merchant" =>$ip,
                "billing_address" => !empty($userdetails['address'])?$userdetails['address']:'Not Mentioned',
                "city" => !empty($userdetails['city'])?$userdetails['city']:'Not Mentioned',
                "state" => !empty($userdetails['state_name'])?$userdetails['state_name']:'Not Mentioned',
                "postal_code" => !empty($userdetails['zipcode'])?$userdetails['zipcode']:'Not Mentioned',
                "country" => !empty($userdetails['sortname'])?$userdetails['sortname']:'IND',
                "shipping_first_name" => $userdetails['fullname'],
                "shipping_last_name" =>  "Not Mentioned",
                "address_shipping" => !empty($userdetails['address'])?$userdetails['address']:'Not Mentioned',
                "state_shipping" => !empty($userdetails['state_name'])?$userdetails['state_name']:'Not Mentioned',
                "city_shipping" => !empty($userdetails['city'])?$userdetails['city']:'Not Mentioned',
                "postal_code_shipping" => !empty($userdetails['zipcode'])?$userdetails['zipcode']:'Not Mentioned',
                "country_shipping" => !empty($userdetails['sortname'])?$userdetails['sortname']:'IND',
                "msg_lang" => "English",
                "cms_with_version" => "CodeIgniter 3.1.9"
         );


              $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL,"https://www.paytabs.com/apiv2/create_pay_page");
            curl_setopt($ch, CURLOPT_POST, 1);
            
            // In real life you should use something like:
            curl_setopt($ch, CURLOPT_POSTFIELDS, 
                     http_build_query($details));

            // Receive server response ...
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            $info = curl_getinfo($ch);

            curl_close ($ch);
            

            $pay_tabs_response=json_decode($response);


            if(!empty($pay_tabs_response->payment_url))
            {
               $this->db->where('id',$id)->update('subscriptions_payments',array('paytabs_payment_page_response'=>$response));
               $this->db->where('id',$log_id)->update('subscriptions_payments_logs',array('paytabs_payment_page_response'=>$response));
              redirect(urldecode($pay_tabs_response->payment_url));
            }
            else
            {

              $message = str_replace('_', ' ', $pay_tabs_response->result); 
              $this->session->set_flashdata('message',$message);
              redirect(base_url().'gigs');
            }
    }

 public function paytabs_success()
 {

      $referenceno=$_REQUEST['payment_reference'];

       $details= array("merchant_email" => $this->paytabs_email,
              "secret_key" => $this->paytabs_secretkey,
              "payment_reference"=>$referenceno
       );


      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL,"https://www.paytabs.com/apiv2/verify_payment");
      curl_setopt($ch, CURLOPT_POST, 1);
      // In real life you should use something like:
      curl_setopt($ch, CURLOPT_POSTFIELDS, 
      http_build_query($details));

      // Receive server response ...
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      $response = curl_exec($ch);



      $info = curl_getinfo($ch);

      curl_close ($ch);



      $pay_success_response=json_decode($response);



       if(isset($_POST["txn_id"]) && !empty($_POST["txn_id"]))
      {
        $paypalInfo =  $this->input->post();
        $txn_id= $paypalInfo['txn_id']; 
        $item_number=$paypalInfo['item_number']; 
        $cm=$paypalInfo['cm'];  
      }
      else
      {
        $paypalInfo =  $this->input->get();
        $txn_id= $paypalInfo['tx']; 
        $item_number=$paypalInfo['item_number'];
        $cm=$paypalInfo['cm'];
      }

    $order_id= $pay_success_response->transaction_id;         

    $table_data['paytabs_uid'] = $pay_success_response->transaction_id;

    $table_data['paytabs_details'] = $response;

    $table_data['subscription_payment_status'] = 1;

    $item_number=explode('||', $pay_success_response->reference_no);

    $uid = $item_number[0]; 

    $logid = $item_number[1];           

    $this->db->where('id',$uid);

    if($this->db->update('subscriptions_payments', $table_data))
    {
        $this->db->where('id',$logid);
        $this->db->update('subscriptions_payments_logs',$table_data);

        $query = $this->db->query("SELECT *, m.username, m.email FROM subscriptions_payments as s 

                                    JOIN members m on m.USERID = s.userid

                                    WHERE id = '".$uid."'");

        $data_one = $query->row_array();

        $to_email= $data_one['email'];

        $username = $data_one['username'];

        $bodyid = 37;

        $tempbody_details= $this->templates_model->get_usertemplate_data($bodyid);

        $body=$tempbody_details['template_content'];

        $message='';

        //$gig_preview_link  = base_url().'gig-preview/'.$title ;            

        $body = str_replace('{base_url}', $this->base_domain, $body);

        $body = str_replace('{base_image}',$this->base_domain.'/'.$this->logo_front, $body); 

        $body = str_replace('{username}', $data_one['username'], $body);

        $body = str_replace('{subscription_name}', $data_one['subscription_name'], $body);

        $body = str_replace('{currency_type}', $data_one['currency_type'], $body);

        $body = str_replace('{subscription_period}', $data_one['subscription_period'], $body);

        $body = str_replace('{subscription_gigs}', $data_one['subscription_gigs'], $body);

        $body = str_replace('{subscription_amount}', $data_one['subscription_amount'], $body);

        $body = str_replace('{expired_date}', $data_one['expired_date'], $body);

        $body = str_replace('{sitetitle}',$this->site_name, $body); 

                            $message ='<table style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">

                <tr>

                  <td></td>

                  <td width="600" style="box-sizing: border-box; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">

                    <div style="box-sizing: border-box; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">

                      <table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff">

                        <tr>

                          <td style="box-sizing: border-box; vertical-align: top; text-align: left; margin: 0; padding: 20px;" valign="top">

                            <table width="100%" cellpadding="0" cellspacing="0">

                              <tr>

                                <td style="text-align:center;">

                                  <a href="{base_url}" target="_blank"><img src="'.$this->logo_front.'" style="width:90px" /></a>

                                </td>

                              </tr>

                              <tr>

                                <td>'.$body.'</td>

                              </tr>

                            </table>

                          </td>

                        </tr>

                      </table>

                      <div style="box-sizing: border-box; width: 100%; clear: both; color: #999; margin: 0; padding: 15px 15px 0 15px;">

                        <table width="100%">

                          <tr>

                            <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0;" align="center" valign="top">

                              &copy; '.date("Y").' <a href="'.$this->base_domain.'" target="_blank" style="color:#bbadfc;" target="_blank">'.$this->site_name.'</a> All Rights Reserved.

                            </td>

                          </tr>

                        </table>

                      </div>

                    </div>

                  </td>

                </tr>

              </table>'; 

        $this->load->helper('file');  

        $this->load->library('email');
        
        $this->email->initialize($this->smtp_config);

        $this->email->set_newline("\r\n");

        $this->email->from($this->email_address,$this->email_tittle); 

        $this->email->to($to_email); 

        $this->email->subject('Subscription Payment Success ');

        $this->email->message($message);

       $this->email->send();

      redirect(base_url().'sell-service');
    }



 }


}

?>