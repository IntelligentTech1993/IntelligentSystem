<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User_Authentication extends CI_Controller
{
    function __construct() {
		parent::__construct();
		// Load user model
		//$this->load->model('user');
    error_reporting(0);
        $this->load->helper('custom_language');

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

      // $my_language = array();

      // $my_language[] ='en';

      // if(!empty($active_lang)){

      //   foreach ($active_lang as $value) {

      //     $my_language[] = $value['language_value'];

      //   }
      // }
      // $activelang = array_filter($my_language);
       
      // $key = $this->data['user_selected'];
    
      // if (!in_array($key, $activelang)) {

      //    $this->data['user_selected'] = 'en';

      //   $this->session->set_userdata('user_select_language','en');

      //    //header("Refresh:0");
      // }
     
      $lg = custom_language($this->data['user_selected']);

      $this->data['default_language'] = $lg['default_lang']; 

      $this->data['user_language'] = $lg['user_lang'];

      $this->user_selected = (!empty($this->data['user_selected']))?$this->data['user_selected']:'en';

      $this->default_language = (!empty($this->data['default_language']))?$this->data['default_language']:'';

      $this->user_language = (!empty($this->data['user_language']))?$this->data['user_language']:'';

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

    }
    
    public function index(){
		// Include the facebook api php libraries
		include_once APPPATH."libraries/inc/facebook.php";
		
		// Facebook API Configuration
		$appId = '1212301268787200';
		$appSecret = '665ad6ecbf61bbdf7f8a4d55a3022f65';
		$redirectUrl = base_url() .'user/user_authentication/';
		$fbPermissions = 'email';
		
		//Call Facebook API
		$facebook = new Facebook(array(
		  'appId'  => $appId,
		  'secret' => $appSecret
		
		));
		$fbuser = $facebook->getUser();
		
        if ($fbuser) {
			$userProfile = $facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
			print_r($userProfile);exit;
            // Preparing data for database insertion
			$userData['oauth_provider'] = 'facebook';
			$userData['oauth_uid'] = $userProfile['id'];
            $userData['first_name'] = $userProfile['first_name'];
            $userData['last_name'] = $userProfile['last_name'];
            $userData['email'] = $userProfile['email'];
			$userData['gender'] = $userProfile['gender'];
			$userData['locale'] = $userProfile['locale'];
            $userData['profile_url'] = 'https://www.facebook.com/'.$userProfile['id'];
            $userData['picture_url'] = $userProfile['picture']['data']['url'];
			// Insert or update user data
            //$userID = $this->user->checkUser($userData);
           /* if(!empty($userID)){
                $data['userData'] = $userData;
                $this->session->set_userdata('userData',$userData);
            } else {
               $data['userData'] = array();
            }*/
        } else {
			$fbuser = '';
            $data['authUrl'] = $facebook->getLoginUrl(array('redirect_uri'=>$redirectUrl,'scope'=>$fbPermissions));
        }
		$this->load->view('user/modules/user_authentication/index',$data);
    }
	
	public function logout() {
		$this->session->unset_userdata('userData');
        $this->session->sess_destroy();
		redirect('/user_authentication');
    }
}
