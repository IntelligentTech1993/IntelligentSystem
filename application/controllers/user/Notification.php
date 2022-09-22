<?php 
class Notification extends CI_Controller{
    public function __construct() {
        parent::__construct();  
        error_reporting(0);      
        $this->load->model('notification_model');
		$query = $this->db->query("select * from system_settings WHERE status = 1");
		$result = $query->result_array();
		$this->email_address='mail@example.com';
		$this->email_tittle='Gigs';
		$this->logo_front=base_url().'assets/images/logo.png';
		if(!empty($result))
		{
		foreach($result as $data){
		if($data['key'] == 'email_address'){
		$this->email_address = !empty($data['value']) ?$data['value'] : 'mail@example.com' ;
		}
	   if($data['key'] == 'email_tittle'){
		$this->email_tittle =!empty($data['value']) ? $data['value'] : 'Gigs' ;
		}
		if($data['key'] == 'base_domain'){
		$this->base_domain = $data['value'];
		}
		if($data['key'] == 'logo_front'){
		$this->logo_front = $data['value'];
		}
		if($data['key'] == 'site_name' ||  $data['key'] == 'website_name'){
		$this->site_name = $data['value'];
		}
		}
		}
		$this->load->model('user_panel_model');
		$this->load->helper('favourites');

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

         //$this->data['user_selected'] = 'en';

       // $this->session->set_userdata('user_select_language','en');

         //header("Refresh:0");
     // }
     
      $lg = custom_language($this->data['user_selected']);

      $this->data['default_language'] = $lg['default_lang']; 

      $this->data['user_language'] = $lg['user_lang'];

      $this->user_selected = (!empty($this->data['user_selected']))?$this->data['user_selected']:'en';

      $this->default_language = (!empty($this->data['default_language']))?$this->data['default_language']:'';

      $this->user_language = (!empty($this->data['user_language']))?$this->data['user_language']:'';
      
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
    
    public function get_notification_count()
    {
        $result = $this->notification_model->new_notification_count();
	 	  //print_r($result);exit;
        $html = '';
		$total_count=0;
    	if(!empty($result))
		{
			$total_count =count($result);
			$image  = base_url().'assets/images/avatar2.jpg';
			$time_zone = $this->session->userdata('time_zone');  
			foreach($result as $notifications)
			{   
			 
				  $date = new DateTime($notifications['created_date']);
					$time = date($notifications['created_date']);
					 date_default_timezone_set($time_zone);
					 $date1= date('Y-m-d H:i:s') ;
					 
						$now = new DateTime($date1);
						$ref = new DateTime($time);
						$diff = $now->diff($ref);
						$total_seconds = 0 ;       
						$days = $diff->days;
						$hours = $diff->h;
						$mins = $diff->i;                                                            
						if(!empty($days)&&($days>0)) 
						{
						 $days_to_seconds = $diff->days*24*60*60;
						 $total_seconds = $total_seconds+$days_to_seconds;                                                   
						}
						if(!empty($hours)&&($hours>0)) 
						{
						 $hours_to_seconds = $diff->h*60*60;
						 $total_seconds = $total_seconds+$hours_to_seconds;
						}
						if(!empty($mins)&&($mins>0)) 
						{
						 $min_to_seconds = $mins*60;
						 $total_seconds = $total_seconds+$min_to_seconds;
						}
						$intervals      = array (
							'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute'=> 60
						);
						$time_taken = '';
					   //now we just find the difference

						$just_now = (!empty($this->user_language[$this->user_selected]['lg_just_now']))?$this->user_language[$this->user_selected]['lg_just_now']:$this->default_language['en']['lg_just_now'];
	
					if ($total_seconds < 60 || $total_seconds==0 )
					{
							$time_taken = $just_now;
						//$time_taken = $total_seconds == 1 ? $total_seconds . ' second ago' : $total_seconds . ' seconds ago';
					}       

					$minutes_ago = (!empty($this->user_language[$this->user_selected]['lg_minutes_ago']))?$this->user_language[$this->user_selected]['lg_minutes_ago']:$this->default_language['en']['lg_minutes_ago'];
				
					if ($total_seconds >= 60 && $total_seconds < $intervals['hour'])
					{
						$total_seconds = floor($total_seconds/$intervals['minute']);
						 $time_taken =  $total_seconds == 1 ? $total_seconds .' '. $minutes_ago : $total_seconds .' '. $minutes_ago;
					}       

					$hours_ago = (!empty($this->user_language[$this->user_selected]['lg_hours_ago']))?$this->user_language[$this->user_selected]['lg_hours_ago']:$this->default_language['en']['lg_hours_ago'];
				
					if ($total_seconds >= $intervals['hour'] && $total_seconds < $intervals['day'])
					{
						$total_seconds = floor($total_seconds/$intervals['hour']);
						 $time_taken =  $total_seconds == 1 ? $total_seconds .' '. $hours_ago : $total_seconds .' '. $hours_ago;
					}   

					$day_ago = (!empty($this->user_language[$this->user_selected]['lg_day_ago']))?$this->user_language[$this->user_selected]['lg_day_ago']:$this->default_language['en']['lg_day_ago'];
				
					if ($total_seconds >= $intervals['day'] && $total_seconds < $intervals['week'])
					{
						$total_seconds = floor($total_seconds/$intervals['day']);
						 $time_taken =  $total_seconds == 1 ? $total_seconds .' '. $day_ago : $total_seconds .' '. $day_ago;
					}   

					$week_ago = (!empty($this->user_language[$this->user_selected]['lg_week_ago']))?$this->user_language[$this->user_selected]['lg_week_ago']:$this->default_language['en']['lg_week_ago'];
				
					if ($total_seconds >= $intervals['week'] && $total_seconds < $intervals['month'])
					{
						$total_seconds = floor($total_seconds/$intervals['week']);
						 $time_taken =  $total_seconds == 1 ? $total_seconds .' '. $week_ago : $total_seconds .' '. $week_ago;
					}   

					$months_ago = (!empty($this->user_language[$this->user_selected]['lg_months_ago']))?$this->user_language[$this->user_selected]['lg_months_ago']:$this->default_language['en']['lg_months_ago'];
				
					if ($total_seconds >= $intervals['month'] && $total_seconds < $intervals['year'])
					{
						$total_seconds = floor($total_seconds/$intervals['month']);
						 $time_taken =  $total_seconds == 1 ? $total_seconds .' '. $months_ago : $total_seconds .' '. $months_ago;
					}   

					$years_ago = (!empty($this->user_language[$this->user_selected]['lg_years_ago']))?$this->user_language[$this->user_selected]['lg_years_ago']:$this->default_language['en']['lg_years_ago'];
				
					if ($total_seconds >= $intervals['year'])
					{
						$total_seconds = floor($total_seconds/$intervals['year']);
						 $time_taken =  $total_seconds == 1 ? $total_seconds .' '. $years_ago : $total_seconds .' '. $years_ago;
					}      
				
				$username = $notifications['buyer_username'];
				$name = $notifications['buyer_name'];
				$title = $notifications['title'];
				$id=   $notifications['id'];
				$status_s= $notifications['status'];
				if(!empty($notifications['buyer_img']))
				{
				 $image = base_url().$notifications['buyer_img'];    
				}
				$active_class = '';
				
				 if($notifications['notification_status']==1)
				{
				$active_class = 'active';
				}
				$status = '';
				if($notifications['status']=='completed')
				{   

					$completed_your_order = (!empty($this->user_language[$this->user_selected]['lg_completed_your_order']))?$this->user_language[$this->user_selected]['lg_completed_your_order']:$this->default_language['en']['lg_completed_your_order'];
				   
				$html .= '<li class="media notification-message">
						<a onclick="change_notification_status('.$id.', \''.$status_s.'\',\'purchases\');" href="javascript:;">
								<div class="media-left">
										<img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
								</div>
								<div class="media-body">
										<p class="m-0 noti-details"><span class="noti-title">"'.$name.'"</span> '.$completed_your_order.' <span class="noti-title">"'.str_replace("-"," ",$title).'"</span></p>
										<p class="m-0"><span class="notification-time">'.$time_taken.'</span></p>
								</div>
						</a>
						</li>';      
				 
				}
				elseif($notifications['status']=='completedrequest'){

					$request_a_order_complete = (!empty($this->user_language[$this->user_selected]['lg_request_a_order_complete']))?$this->user_language[$this->user_selected]['lg_request_a_order_complete']:$this->default_language['en']['lg_request_a_order_complete'];

					$completed_your_order = (!empty($this->user_language[$this->user_selected]['lg_completed_your_order']))?$this->user_language[$this->user_selected]['lg_completed_your_order']:$this->default_language['en']['lg_completed_your_order'];

					$has_been_completed = (!empty($this->user_language[$this->user_selected]['lg_has_been_completed']))?$this->user_language[$this->user_selected]['lg_has_been_completed']:$this->default_language['en']['lg_has_been_completed'];


					$html .= '<li class="media notification-message">
						<a onclick="change_notification_status('.$id.', \''.$status_s.'\',\'purchases\');" href="javascript:;">
								<div class="media-left">
										<img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
								</div>
								<div class="media-body">
										<p class="m-0 noti-details"><span class="noti-title">"'.$name.'"</span>  '.$request_a_order_complete.' <span class="noti-title">"'.str_replace("-"," ",$title).' '.$has_been_completed.'"</span></p>
										<p class="m-0"><span class="notification-time">'.$time_taken.'</span></p>
								</div>
						</a>
						</li>';      
					
				}
				elseif($notifications['status']=='complete-request-accept'){

					$complete_request_accepted = (!empty($this->user_language[$this->user_selected]['lg_complete_request_accepted']))?$this->user_language[$this->user_selected]['lg_complete_request_accepted']:$this->default_language['en']['lg_complete_request_accepted'];

					$has_been_completed = (!empty($this->user_language[$this->user_selected]['lg_has_been_completed']))?$this->user_language[$this->user_selected]['lg_has_been_completed']:$this->default_language['en']['lg_has_been_completed'];


					$html .= '<li class="media notification-message">
						<a onclick="change_notification_status('.$id.', \''.$status_s.'\',\'sales\');" href="javascript:;">
								<div class="media-left">
										<img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
								</div>
								<div class="media-body">
										<p class="m-0 noti-details"><span class="noti-title">"'.$name.'"</span>  '.$complete_request_accepted.' <span class="noti-title">"'.str_replace("-"," ",$title).' '.$has_been_completed.'"</span></p>
										<p class="m-0"><span class="notification-time">'.$time_taken.'</span></p>
								</div>
						</a>
						</li>';      
					
				}
				elseif ($notifications['status']=='buyed') 
				{               

					$has_purchased_your_gig = (!empty($this->user_language[$this->user_selected]['lg_has_purchased_your_gig']))?$this->user_language[$this->user_selected]['lg_has_purchased_your_gig']:$this->default_language['en']['lg_has_purchased_your_gig'];

					$html .= '<li class="media notification-message">
						<a onclick="change_notification_status('.$id.', \''.$status_s.'\',\'sales\');" href="javascript:;">
								<div class="media-left">
										<img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
								</div>
								<div class="media-body">
										<p class="m-0 noti-details"><span class="noti-title">'.$name.'</span> '.$has_purchased_your_gig.' <span class="noti-title">"'.str_replace("-"," ",$title).'"</span></p>
										<p class="m-0"><span class="notification-time">'.$time_taken.'</span></p>
								</div>
						</a>
						</li>';  
				}
				elseif ($notifications['status']=='payment_release') 
				{               
					$admin_released_payment_for_a_completed_gig = (!empty($this->user_language[$this->user_selected]['lg_admin_released_payment_for_a_completed_gig']))?$this->user_language[$this->user_selected]['lg_admin_released_payment_for_a_completed_gig']:$this->default_language['en']['lg_admin_released_payment_for_a_completed_gig'];


					$html .= '<li class="media notification-message">
						<a onclick="change_notification_status('.$id.', \''.$status_s.'\',\'payments\');" href="javascript:;">
								<div class="media-left">
										<img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
								</div>
								<div class="media-body">
								<p class="m-0 noti-details">'.$admin_released_payment_for_a_completed_gig.' <span class="noti-title">"'.str_replace("-"," ",$title).'"</span></p>
										<p class="m-0"><span class="notification-time">'.$time_taken.'</span></p>
								</div>
						</a>
						</li>';  
				}
				  elseif ($notifications['status']=='own_buying') 
				{

					$you_have_made_a_purchase_from = (!empty($this->user_language[$this->user_selected]['lg_you_have_made_a_purchase_from']))?$this->user_language[$this->user_selected]['lg_you_have_made_a_purchase_from']:$this->default_language['en']['lg_you_have_made_a_purchase_from'];
					
					$html .= '<li class="media notification-message">
						<a onclick="change_notification_status('.$id.', \''.$status_s.'\',\'purchases\');" href="javascript:;">
								<div class="media-left">
										<img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
								</div>
								<div class="media-body">
								<p class="m-0 noti-details">'.$you_have_made_a_purchase_from.' <span class="noti-title">'.$name.'</span></p>
								<p class="m-0"><span class="notification-time">'.$time_taken.'</span></p>
								</div>
								</a>
								</li>';
								}
				elseif ($notifications['status']=='buyer_cancel') 
				{

					$cancel_the_gigs_of = (!empty($this->user_language[$this->user_selected]['lg_cancel_the_gigs_of']))?$this->user_language[$this->user_selected]['lg_cancel_the_gigs_of']:$this->default_language['en']['lg_cancel_the_gigs_of'];
					
					$html .= '<li class="media notification-message">
						<a onclick="change_notification_status('.$id.', \''.$status_s.'\',\'sales\');" href="javascript:;">
								<div class="media-left">
										<img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
								</div>
								<div class="media-body">
								<p class="m-0 noti-details"><span class="noti-title">'.$name.'</span> '.$cancel_the_gigs_of.' <span class="noti-title">"'.str_replace("-"," ",$title).'"</span></p>
								<p class="m-0"><span class="notification-time">'.$time_taken.'</span></p>
								</div>
								</a>
								</li>';
								}
				elseif ($notifications['status']=='seller_cancel') 
				{

					$decline_the_gigs_of = (!empty($this->user_language[$this->user_selected]['lg_decline_the_gigs_of']))?$this->user_language[$this->user_selected]['lg_decline_the_gigs_of']:$this->default_language['en']['lg_decline_the_gigs_of'];
					
					$html .= '<li class="media notification-message">
						<a onclick="change_notification_status('.$id.', \''.$status_s.'\',\'purchases\');" href="javascript:;">
								<div class="media-left">
										<img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
								</div>
								<div class="media-body">
								<p class="m-0 noti-details"><span class="noti-title">'.$name.'</span> '.$decline_the_gigs_of.' <span class="noti-title">"'.str_replace("-"," ",$title).'"</span></p>
								<p class="m-0"><span class="notification-time">'.$time_taken.'</span></p>
								</div>
								</a>
								</li>';
								}				
				if(($notifications['status'])=='to_user')
				{

					$given_reply_feedback_on = (!empty($this->user_language[$this->user_selected]['lg_given_reply_feedback_on']))?$this->user_language[$this->user_selected]['lg_given_reply_feedback_on']:$this->default_language['en']['lg_given_reply_feedback_on'];
					
					$html .= '<li class="media notification-message">
						<a onclick="change_notification_status('.$id.', \''.$status_s.'\',\'purchases\');" href="javascript:;">
								<div class="media-left">
										<img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
								</div>
								<div class="media-body">
										<p class="m-0 noti-details"><span class="noti-title">'.$name.'</span> '.$given_reply_feedback_on.'  <span class="noti-title">" '.str_replace("-"," ",$title).' "</span></p>
										<p class="m-0"><span class="notification-time">'.$time_taken.'</span></p>
								</div>
						</a>
						</li>';  
				  
				}
				if(($notifications['status'])=='from_user')
				{
				$query = $this->db->query("SELECT sent_recieved FROM `feedback` WHERE `id` = $id " );
        		$notificationsdata = $query->row_array();
				$s1=$notificationsdata['sent_recieved'];
				if($s1==1){
					$rep='reply';
					$link='purchases';
				}else
				{
					$rep='';
					$link='sales';
				}

				$given = (!empty($this->user_language[$this->user_selected]['lg_given']))?$this->user_language[$this->user_selected]['lg_given']:$this->default_language['en']['lg_given'];

				$feedback_on = (!empty($this->user_language[$this->user_selected]['lg_feedback_on']))?$this->user_language[$this->user_selected]['lg_feedback_on']:$this->default_language['en']['lg_feedback_on'];


					$html .= '<li class="media notification-message">
						<a onclick="change_notification_status('.$id.', \''.$status_s.'\',\''.$link.'\');" href="javascript:;">
								<div class="media-left">
										<img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
								</div>
								<div class="media-body">
										<p class="m-0 noti-details"><span class="noti-title">'.$name.'</span> '.$given.' '.$rep.' '.$feedback_on.' <span class="noti-title">" '.str_replace("-"," ",$title).' "</span></p>
										<p class="m-0"><span class="notification-time">'.$time_taken.'</span></p>
								</div>
						</a>
						</li>';  
				  
				}   
				
				
				if(($notifications['status'])=='seller_cancelled')
				{

					$has_accepted_the_cancel_request = (!empty($this->user_language[$this->user_selected]['lg_has_accepted_the_cancel_request']))?$this->user_language[$this->user_selected]['lg_has_accepted_the_cancel_request']:$this->default_language['en']['lg_has_accepted_the_cancel_request'];
				  
					$html .= '<li class="media notification-message">
						<a onclick="change_notification_status('.$id.', \''.$status_s.'\',\'purchases\');" href="javascript:;">
								<div class="media-left">
										<img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
								</div>
								<div class="media-body">
										<p class="m-0 noti-details"><span class="noti-title">'.$name.'</span> '.$has_accepted_the_cancel_request.' <span class="noti-title">" '.str_replace("-"," ",$title).' "</span></p>
										<p class="m-0"><span class="notification-time">'.$time_taken.'</span></p>
								</div>
						</a>
						</li>';  
				  
				}   
				if(($notifications['status'])=='buyer_cancelled')
				{

					$has_accepted_the_declined_request = (!empty($this->user_language[$this->user_selected]['lg_has_accepted_the_declined_request']))?$this->user_language[$this->user_selected]['lg_has_accepted_the_declined_request']:$this->default_language['en']['lg_has_accepted_the_declined_request'];
				  
					$html .= '<li class="media notification-message">
						<a onclick="change_notification_status('.$id.', \''.$status_s.'\',\'purchases\');" href="javascript:;">
								<div class="media-left">
										<img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
								</div>
								<div class="media-body">
										<p class="m-0 noti-details"><span class="noti-title">'.$name.'</span> '.$has_accepted_the_declined_request.'  <span class="noti-title">" '.str_replace("-"," ",$title).' "</span></p>
										<p class="m-0"><span class="notification-time">'.$time_taken.'</span></p>
								</div>
						</a>
						</li>';  
				  
				}  
				if ($notifications['status']=='buyer_cancel_payment') 
				{               

					$admin_released_cancel_payment_for_a_gig = (!empty($this->user_language[$this->user_selected]['lg_admin_released_cancel_payment_for_a_gig']))?$this->user_language[$this->user_selected]['lg_admin_released_cancel_payment_for_a_gig']:$this->default_language['en']['lg_admin_released_cancel_payment_for_a_gig'];


					$html .= '<li class="media notification-message">
						<a onclick="change_notification_status('.$id.', \''.$status_s.'\',\'payments\');" href="javascript:;">
								<div class="media-left">
										<img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
								</div>
								<div class="media-body">
								<p class="m-0 noti-details">'.$admin_released_cancel_payment_for_a_gig.' <span class="noti-title">"'.str_replace("-"," ",$title).'"</span></p>
										<p class="m-0"><span class="notification-time">'.$time_taken.'</span></p>
								</div>
						</a>
						</li>';  
				}
				elseif ($notifications['status']=='buyer_decline_payment') 
				{               

					$admin_released_decline_payment_for_a_gig = (!empty($this->user_language[$this->user_selected]['lg_admin_released_decline_payment_for_a_gig']))?$this->user_language[$this->user_selected]['lg_admin_released_decline_payment_for_a_gig']:$this->default_language['en']['lg_admin_released_decline_payment_for_a_gig'];

					$html .= '<li class="media notification-message">
						<a onclick="change_notification_status('.$id.', \''.$status_s.'\',\'payments\');" href="javascript:;">
								<div class="media-left">
										<img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
								</div>
								<div class="media-body">
								<p class="m-0 noti-details">'.$admin_released_decline_payment_for_a_gig.'<span class="noti-title">"'.str_replace("-"," ",$title).'"</span></p>
										<p class="m-0"><span class="notification-time">'.$time_taken.'</span></p>
								</div>
						</a>
						</li>';  
				}
				if(($notifications['status'])=='seller_declined')
				{

					$has_declined_your_order = (!empty($this->user_language[$this->user_selected]['lg_has_declined_your_order']))?$this->user_language[$this->user_selected]['lg_has_declined_your_order']:$this->default_language['en']['lg_has_declined_your_order'];
				  
					$html .= '<li class="media notification-message">
						<a onclick="change_notification_status('.$id.', \''.$status_s.'\',\'sales\');" href="javascript:;">
								<div class="media-left">
										<img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
								</div>
								<div class="media-body">
										<p class="m-0 noti-details"><span class="noti-title">'.$name.'</span> '.$has_declined_your_order.'  <span class="noti-title">" '.str_replace("-"," ",$title).' "</span></p>
										<p class="m-0"><span class="notification-time">'.$time_taken.'</span></p>
								</div>
						</a>
						</li>';  
				  
				}   
				
				if(($notifications['status'])=='buyer_accept_seller_declined')
				{

					$has_accepted_the_declined__request = (!empty($this->user_language[$this->user_selected]['lg_has_accepted_the_declined__request']))?$this->user_language[$this->user_selected]['lg_has_accepted_the_declined__request']:$this->default_language['en']['lg_has_accepted_the_declined__request'];
				  
					$html .= '<li class="media notification-message">
						<a onclick="change_notification_status('.$id.', \''.$status_s.'\',\'sales\');" href="javascript:;">
								<div class="media-left">
										<img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
								</div>
								<div class="media-body">
										<p class="m-0 noti-details"><span class="noti-title">'.$name.'</span> '.$has_accepted_the_declined__request.'  <span class="noti-title">" '.str_replace("-"," ",$title).' "</span></p>
										<p class="m-0"><span class="notification-time">'.$time_taken.'</span></p>
								</div>
						</a>
						</li>';  
				  
				}


				if(($notifications['status'])=='admin_accept_buyer_declined')
				{
					$images=base_url().'assets/images/avatar2.jpg';
					$has_declined_buyer_order = (!empty($this->user_language[$this->user_selected]['lg_admin_changed_your_order_status_for']))?$this->user_language[$this->user_selected]['lg_admin_changed_your_order_status_for']:$this->default_language['en']['lg_admin_changed_your_order_status_for'];
				  
					$html .= '<li class="media notification-message">
						<a onclick="change_notification_status('.$id.', \''.$status_s.'\',\'purchases\');" href="javascript:;">
								<div class="media-left">
										<img width="32" class="img-circle" src="'.$images.'" alt="'.$username.'">
								</div>
								<div class="media-body">
										<p class="m-0 noti-details">'.$has_declined_buyer_order.'  <span class="noti-title">" '.str_replace("-"," ",$title).' "</span></p>
										<p class="m-0"><span class="notification-time">'.$time_taken.'</span></p>
								</div>
						</a>
						</li>';  
				  
				}  

				if(($notifications['status'])=='admin_accept_seller_declined')
				{
					$images=base_url().'assets/images/avatar2.jpg';
					$has_declined_seller_order = (!empty($this->user_language[$this->user_selected]['lg_admin_changed_the_order_status_for']))?$this->user_language[$this->user_selected]['lg_admin_changed_the_order_status_for']:$this->default_language['en']['lg_admin_changed_the_order_status_for'];
				  
					$html .= '<li class="media notification-message">
						<a onclick="change_notification_status('.$id.', \''.$status_s.'\',\'sales\');" href="javascript:;">
								<div class="media-left">
										<img width="32" class="img-circle" src="'.$images.'" alt="'.$username.'">
								</div>
								<div class="media-body">
										<p class="m-0 noti-details">'.$has_declined_seller_order.' <span class="noti-title">" '.str_replace("-"," ",$title).' "</span></p>
										<p class="m-0"><span class="notification-time">'.$time_taken.'</span></p>
								</div>
						</a>
						</li>';  
				  
				}  

			}
			        
			} 
            else {
                 $html .= '';
        
    		}
    
        //echo $result;
		echo json_encode( array('new_data'=>$html,'new_total'=>$total_count));
    }
    public function get_new_notification()
    {
        $result = $this->notification_model->notification_all_gigs();
        $html = '';
    if(!empty($result))
    {
        $image  = base_url().'assets/images/avatar2.jpg';
        $time_zone = $this->session->userdata('time_zone');  
        foreach($result as $notifications)
        {   
			  $date = new DateTime($notifications['created_date']);
				$date->setTimezone(new DateTimeZone($time_zone));                                                        
				$time = $date->format('Y-m-d H:i:s');                                                        
			 //   echo "posted time :" .$time ;
				
				 date_default_timezone_set($time_zone);
				 $date1= date('Y-m-d H:i:s') ;
				 
					$now = new DateTime($date1);
					$ref = new DateTime($time);
					$diff = $now->diff($ref);
					//print_r($diff);
					$total_seconds = 0 ;       
					$days = $diff->days;
					$hours = $diff->h;
					$mins = $diff->i;                                                            
					if(!empty($days)&&($days>0)) 
					{
					 $days_to_seconds = $diff->days*24*60*60;
					 $total_seconds = $total_seconds+$days_to_seconds;                                                   
					}
					if(!empty($hours)&&($hours>0)) 
					{
					 $hours_to_seconds = $diff->h*60*60;
					 $total_seconds = $total_seconds+$hours_to_seconds;
					}
					if(!empty($mins)&&($mins>0)) 
					{
					 $min_to_seconds = $mins*60;
					 $total_seconds = $total_seconds+$min_to_seconds;
					}
					$intervals      = array (
						'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute'=> 60
					);
					$time_taken = '';
				   //now we just find the difference

    				if ($total_seconds < 60 || $total_seconds==0 )
					{
							$time_taken = $just_now;
						//$time_taken = $total_seconds == 1 ? $total_seconds . ' second ago' : $total_seconds . ' seconds ago';
					}       

					$minutes_ago = (!empty($this->user_language[$this->user_selected]['lg_minutes_ago']))?$this->user_language[$this->user_selected]['lg_minutes_ago']:$this->default_language['en']['lg_minutes_ago'];
				
					if ($total_seconds >= 60 && $total_seconds < $intervals['hour'])
					{
						$total_seconds = floor($total_seconds/$intervals['minute']);
						 $time_taken =  $total_seconds == 1 ? $total_seconds .' '. $minutes_ago : $total_seconds .' '. $minutes_ago;
					}       

					$hours_ago = (!empty($this->user_language[$this->user_selected]['lg_hours_ago']))?$this->user_language[$this->user_selected]['lg_hours_ago']:$this->default_language['en']['lg_hours_ago'];
				
					if ($total_seconds >= $intervals['hour'] && $total_seconds < $intervals['day'])
					{
						$total_seconds = floor($total_seconds/$intervals['hour']);
						 $time_taken =  $total_seconds == 1 ? $total_seconds .' '. $hours_ago : $total_seconds .' '. $hours_ago;
					}   

					$day_ago = (!empty($this->user_language[$this->user_selected]['lg_day_ago']))?$this->user_language[$this->user_selected]['lg_day_ago']:$this->default_language['en']['lg_day_ago'];
				
					if ($total_seconds >= $intervals['day'] && $total_seconds < $intervals['week'])
					{
						$total_seconds = floor($total_seconds/$intervals['day']);
						 $time_taken =  $total_seconds == 1 ? $total_seconds .' '. $day_ago : $total_seconds .' '. $day_ago;
					}   

					$week_ago = (!empty($this->user_language[$this->user_selected]['lg_week_ago']))?$this->user_language[$this->user_selected]['lg_week_ago']:$this->default_language['en']['lg_week_ago'];
				
					if ($total_seconds >= $intervals['week'] && $total_seconds < $intervals['month'])
					{
						$total_seconds = floor($total_seconds/$intervals['week']);
						 $time_taken =  $total_seconds == 1 ? $total_seconds .' '. $week_ago : $total_seconds .' '. $week_ago;
					}   

					$months_ago = (!empty($this->user_language[$this->user_selected]['lg_months_ago']))?$this->user_language[$this->user_selected]['lg_months_ago']:$this->default_language['en']['lg_months_ago'];
				
					if ($total_seconds >= $intervals['month'] && $total_seconds < $intervals['year'])
					{
						$total_seconds = floor($total_seconds/$intervals['month']);
						 $time_taken =  $total_seconds == 1 ? $total_seconds .' '. $months_ago : $total_seconds .' '. $months_ago;
					}   

					$years_ago = (!empty($this->user_language[$this->user_selected]['lg_years_ago']))?$this->user_language[$this->user_selected]['lg_years_ago']:$this->default_language['en']['lg_years_ago'];
				
					if ($total_seconds >= $intervals['year'])
					{
						$total_seconds = floor($total_seconds/$intervals['year']);
						 $time_taken =  $total_seconds == 1 ? $total_seconds .' '. $years_ago : $total_seconds .' '. $years_ago;
					}       
            
            $username = $notifications['buyer_username'];
            $name = $notifications['buyer_name'];
            $title = $notifications['title'];
            if(!empty($notifications['buyer_img']))
            {
             $image = base_url().$notifications['buyer_img'];    
            }
            $active_class = '';
            
             if($notifications['notification_status']==1)
            {
            $active_class = 'active';
            }
            $status = '';
            if($notifications['status']=='completed')
            {   

            	$completed_your_order = (!empty($this->user_language[$this->user_selected]['lg_completed_your_order']))?$this->user_language[$this->user_selected]['lg_completed_your_order']:$this->default_language['en']['lg_completed_your_order'];
               
            $html .= '<li class="media notification-message">
                    <a href="'.base_url().'gig-preview/'.$title.'">
                            <div class="media-left">
                                    <img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
                            </div>
                            <div class="media-body">
								<p class="m-0 noti-details"><span class="noti-title">"'.$name.'"</span>'.$completed_your_order.' <span class="noti-title">"'.str_replace("-"," ",$title).'"</span></p>
								<p class="m-0"><span class="notification-time">'.$time_taken.'</span></p>
                            </div>
                    </a>
                    </li>';      
             
            }
            elseif ($notifications['status']=='buyed') 
            {               

            	$has_purchased_your_gig = (!empty($this->user_language[$this->user_selected]['lg_has_purchased_your_gig']))?$this->user_language[$this->user_selected]['lg_has_purchased_your_gig']:$this->default_language['en']['lg_has_purchased_your_gig'];


                $html .= '<li class="media notification-message">
                    <a href="'.base_url().'gig-preview/'.$title.'">
                            <div class="media-left">
                                    <img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
                            </div>
                            <div class="media-body">
                                    <p class="m-0 noti-details"><span class="noti-title">'.$name.'</span>'.$has_purchased_your_gig.' <span class="noti-title">"'.str_replace("-"," ",$title).'"</span></p>
                                    <p class="m-0"><span class="notification-time">'.$time_taken.'</span></p>
                            </div>
                    </a>
                    </li>';  
            }
              elseif ($notifications['status']=='own_buying') 
            {

            	$you_have_made_a_purchase__from = (!empty($this->user_language[$this->user_selected]['lg_you_have_made_a_purchase__from']))?$this->user_language[$this->user_selected]['lg_you_have_made_a_purchase__from']:$this->default_language['en']['lg_you_have_made_a_purchase__from'];
                
                $html .= '<li class="media notification-message">
                    <a href="'.base_url().'gig-preview/'.$title.'">
                            <div class="media-left">
                                    <img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
                            </div>
                            <div class="media-body">
                            <p class="m-0 noti-details">'.$you_have_made_a_purchase__from.' <span class="noti-title">'.$name.'</span></p>
                            <p class="m-0"><span class="notification-time">'.$time_taken.'</span></p>
                            </div>
                            </a>
                            </li>';
                            }
            if(($notifications['status'])=='to_user')
            {

            	$given_feedback_on = (!empty($this->user_language[$this->user_selected]['lg_given_feedback_on']))?$this->user_language[$this->user_selected]['lg_given_feedback_on']:$this->default_language['en']['lg_given_feedback_on'];
                
                $html .= '<li class="media notification-message">
                    <a href="'.base_url().'gig-preview/'.$title.'">
                            <div class="media-left">
                                    <img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
                            </div>
                            <div class="media-body">
                                    <p class="m-0 noti-details"><span class="noti-title">'.$name.'</span> '.$given_feedback_on.'  <span class="noti-title">" '.str_replace("-"," ",$title).' "</span></p>
                                    <p class="m-0"><span class="notification-time">'.$time_taken.'</span></p>
                            </div>
                    </a>
                    </li>';  
              
            }
            if(($notifications['status'])=='from_user')
            {

            	$given_feedback_on = (!empty($this->user_language[$this->user_selected]['lg_given_feedback_on']))?$this->user_language[$this->user_selected]['lg_given_feedback_on']:$this->default_language['en']['lg_given_feedback_on'];
              
                $html .= '<li class="media notification-message">
                    <a href="'.base_url().'gig-preview/'.$title.'">
                            <div class="media-left">
                                    <img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
                            </div>
                            <div class="media-body">
                                    <p class="m-0 noti-details"><span class="noti-title">'.$name.'</span> '.$given_feedback_on.'  <span class="noti-title">" '.str_replace("-"," ",$title).' "</span></p>
                                    <p class="m-0"><span class="notification-time">'.$time_taken.'</span></p>
                            </div>
                    </a>
                    </li>';  
              
            }   
        }
    echo $html;        
            } 
            else {

            	$sorry = (!empty($this->user_language[$this->user_selected]['lg_sorry']))?$this->user_language[$this->user_selected]['lg_sorry']:$this->default_language['en']['lg_sorry'];

            	$no_notifications = (!empty($this->user_language[$this->user_selected]['lg_no_notifications']))?$this->user_language[$this->user_selected]['lg_no_notifications']:$this->default_language['en']['lg_no_notifications'];

                 $html .= '<li class="media notification-message">
                    <a href="javascript:;">                             
                            <div class="media-body">
                                    <p style="text-align:center;" > '.$sorry.' ! '.$no_notifications.' </p>                                    
                            </div>
                    </a>
                    </li>';  
      echo $html;
        
    }
    
    }
    
	public function mail_notification()
	{
		$query = $this->db->query("SELECT * FROM (SELECT payments.id, `members`.`fullname` AS buyer_name,  `members`.`user_thumb_image` AS buyer_img , `members`.email as buyer_email , payments.created_at AS created_date ,  `members`.`username` AS buyer_username, sell_gigs.title , 'buyed' as status
, payments.notification_status
FROM  `payments` 
INNER JOIN members ON payments.`USERID` =  `members`.`USERID` 
INNER JOIN sell_gigs ON payments.`gigs_id` = sell_gigs.id
WHERE payments.seller_status = 1
AND payments.mail_sent = 1 
AND payments.notification_status = 1
UNION
SELECT payments.id, `members`.`fullname` AS buyer_name,  `members`.`user_thumb_image` AS buyer_img , `members`.email as buyer_email , payments.created_at AS created_date , `members`.`username` AS buyer_username, sell_gigs.title , 'completed' as status
, payments.notification_status
FROM  `payments` 
INNER JOIN members ON payments.`USERID` =  `members`.`USERID` 
INNER JOIN sell_gigs ON payments.`gigs_id` = sell_gigs.id
WHERE payments.seller_status = 6
AND payments.mail_sent = 1 
AND payments.notification_status = 1
UNION
SELECT payments.id, `members`.`fullname` AS buyer_name,  `members`.`user_thumb_image` AS buyer_img, `members`.email as buyer_email , payments.created_at AS created_date,  `members`.`username` AS buyer_username, sell_gigs.title,  'own_buying' AS 
STATUS , payments.notification_status
FROM  `payments` 
INNER JOIN members ON payments.`seller_id` =  `members`.`USERID` 
INNER JOIN sell_gigs ON payments.`gigs_id` = sell_gigs.id
WHERE payments.seller_status =1
AND payments.mail_sent = 1 
AND payments.notification_status = 1
UNION
SELECT feedback.id, `members`.`fullname` AS buyer_name,  `members`.`user_thumb_image` AS buyer_img, `members`.email as buyer_email , feedback.created_date AS created_date,  `members`.`username` AS buyer_username, sell_gigs.title,  'to_user' AS 
STATUS , feedback.notification_status
FROM  `feedback` 
INNER JOIN members ON members.`USERID` =  `feedback`.`from_user_id` 
INNER JOIN sell_gigs ON feedback.`gig_id` = sell_gigs.id
WHERE feedback.notification_status = 1
AND feedback.mail_sent = 1 
UNION 
SELECT feedback.id, `members`.`fullname` AS buyer_name,  `members`.`user_thumb_image` AS buyer_img, `members`.email as buyer_email , feedback.created_date AS created_date,  `members`.`username` AS buyer_username, sell_gigs.title,  'from_user' AS 
STATUS , feedback.notification_status
FROM  `feedback` 
INNER JOIN members ON members.`USERID` =  `feedback`.`from_user_id` 
INNER JOIN sell_gigs ON feedback.`gig_id` = sell_gigs.id
WHERE feedback.notification_status = 1
AND feedback.mail_sent = 1 
) a ORDER BY a.created_date DESC ");
$result = $query->result_array();
  foreach($result as $notifications)
        {
			$id = $notifications['id'];
        	 $username = $notifications['buyer_username'];
            $name = $notifications['buyer_name'];
            $title = $notifications['title'];
			$buyer_email =  $notifications['buyer_email'];
            if(!empty($notifications['buyer_img']))
            {
             $image = base_url().$notifications['buyer_img'];    
            }
			
			$owner_gig_query = $this->db->query("SELECT members.fullname, members.username,members.email  FROM  `sell_gigs`  
												INNER JOIN members ON members.USERID = sell_gigs.`user_id` 
												WHERE  `title` =  '".$title."'");
			$owner_of_gig	= $owner_gig_query->row_array();								
			
   echo "username ".$username." name "	.$name ." title " . $title . " Owner of gig ".$owner_of_gig['fullname'] ." Owner of gig username " .$owner_of_gig['username'] ." Owner email " .$owner_of_gig['email'] . " buyer email " .$buyer_email;
			
			  if($notifications['status']=='completed')
            {                                    
        
			 
        $url=base_url().'user_profile/'.$username;                                         
        $this->load->model('templates_model');
        $message='';
        $welcomemessage='';
        $template_title=1;
        $tempheader_details= $this->templates_model->get_usertemplate_data($template_title);
        $template=2;
        $tempfooter_details= $this->templates_model->get_usertemplate_data($template);
        $bodyid = 8;
        $tempbody_details= $this->templates_model->get_usertemplate_data($bodyid);
        $body=$tempbody_details['template_content'];
		 
		$gig_preview_link  = base_url().'gig-preview/'.$title ;
		$user_profile_link = base_url().'user-profile/'.$username;		 
		$body = str_replace('{base_url}', $this->base_domain, $body);
        $body = str_replace('{gig_owner}', $owner_of_gig['fullname'], $body);
        $body = str_replace('{sell_name}', $name, $body);
        $body = str_replace('{title}',str_replace("-"," ",$title), $body);				
        $body = str_replace('{gig_preview_link}', $gig_preview_link, $body);
        $body = str_replace('{user_profile_link}', $user_profile_link, $body);
		$body = str_replace('{site_name}',$this->site_name, $body);
        $message .=                    $message ='<table style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
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
        $this->email->to($buyer_email); 
        $this->email->subject('Update from '.$this->site_name);
        $this->email->message($message);	 
        if($this->email->send())
        { 
		  
			$update_data['mail_sent'] = 0;
			$this->db->where('id',$id);
			$this->db->update('payments',$update_data);
        }	 
        }
        elseif ($notifications['status']=='buyed') 
        { 
        $url=base_url().'user-profile/'.$username;                                         
        $this->load->model('templates_model');
        $message='';
        $welcomemessage='';
        $template_title=1;
        $tempheader_details= $this->templates_model->get_usertemplate_data($template_title);
        $template=2;
        $tempfooter_details= $this->templates_model->get_usertemplate_data($template);
        $bodyid=9;
        $tempbody_details= $this->templates_model->get_usertemplate_data($bodyid);
        $body=$tempbody_details['template_content'];	 
				
		$gig_preview_link  = base_url().'gig-preview/'.$title ;
		$user_profile_link = base_url().'user-profile/'.$username;	 
		$body = str_replace('{base_url}', $this->base_domain, $body);
        $body = str_replace('{buyer_name}', $name , $body);
        $body = str_replace('{sell_name}', $owner_of_gig['fullname'], $body);
        $body = str_replace('{title}',str_replace("-"," ",$title), $body);				
        $body = str_replace('{gig_preview_link}', $gig_preview_link , $body);
        $body = str_replace('{user_profile_link}', $user_profile_link, $body);
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
        $this->email->to($owner_of_gig['email']); 
        $this->email->subject('Update from '.$this->site_name);
        $this->email->message($message);
		 
        if($this->email->send())
        {            
			$update_data['mail_sent'] = 0;
			$this->db->where('id',$id);
			$this->db->update('payments',$update_data);
        }	
        }
        elseif ($notifications['status']=='own_buying') 
        { 
        $url=base_url().'user-profile/'.$username;                                         
        $this->load->model('templates_model');
        $message='';
        $welcomemessage='';
        $template_title=1;
        $tempheader_details= $this->templates_model->get_usertemplate_data($template_title);
        $template=2;
        $tempfooter_details= $this->templates_model->get_usertemplate_data($template);
        $bodyid=10;
        $tempbody_details= $this->templates_model->get_usertemplate_data($bodyid);
        $body=$tempbody_details['template_content'];
		$body = str_replace('{base_url}', $this->base_domain, $body);
		$body = str_replace('{base_image}',$this->base_domain.'/'.$this->logo_front, $body);
        $body = str_replace('{buyer_name}', $name , $body);
        $body = str_replace('{seller_name}', $owner_of_gig['fullname'], $body);
        $body = str_replace('{title}', str_replace("-"," ",$title), $body);				
        $body = str_replace('{gig_preview_link}', $username, $body);
        $body = str_replace('{user_profile_link}', $url, $body);
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
        $this->email->to($buyer_email); 
        $this->email->subject('Update from '.$this->site_name);
        $this->email->message($message);
		 
        if($this->email->send())
        {            
			$update_data['mail_sent'] = 0;
			$this->db->where('id',$id);
			$this->db->update('payments',$update_data);
        }	   
              
        }
            if(($notifications['status'])=='to_user')
            {
				

        $url=base_url().'user_profile/'.$username;                                         
        $this->load->model('templates_model');
        $message='';
        $welcomemessage='';
        $template_title=1;
        $tempheader_details= $this->templates_model->get_usertemplate_data($template_title);
        $template=2;
        $tempfooter_details= $this->templates_model->get_usertemplate_data($template);
        $bodyid=7;
        $tempbody_details= $this->templates_model->get_usertemplate_data($bodyid);
        $body=$tempbody_details['template_content'];
		 
		$gig_preview_link  = base_url().'gig-preview/'.$title ;
		$user_profile_link = base_url().'user-profile/'.$username;		 
		$body = str_replace('{base_url}', $this->base_domain, $body);
		$body = str_replace('{base_image}',$this->base_domain.'/'.$this->logo_front, $body);
        $body = str_replace('{own_name}', $owner_of_gig['fullname'], $body);
        $body = str_replace('{seller_name}', $name, $body);
        $body = str_replace('{title}', str_replace("-"," ",$title), $body);				
        $body = str_replace('{gig_preview_link}', $gig_preview_link, $body);
        $body = str_replace('{user_profile_link}', $user_profile_link, $body);
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
        $this->email->to($owner_of_gig['email']); 
        $this->email->subject('Update from '.$this->site_name);
        $this->email->message($message);
		 
        if($this->email->send())
        {            
			$update_data['mail_sent'] = 0;
			$this->db->where('id',$id);
			$this->db->update('feedback',$update_data);
        }	   
     
     	}
            if(($notifications['status'])=='from_user')
            {
				
				                                    
        
        $url=base_url().'user_profile/'.$username;                                         
        $this->load->model('templates_model');
        $message='';
        $welcomemessage='';
        $template_title=1;
        $tempheader_details= $this->templates_model->get_usertemplate_data($template_title);
        $template=2;
        $tempfooter_details= $this->templates_model->get_usertemplate_data($template);
        $bodyid=7;
        $tempbody_details= $this->templates_model->get_usertemplate_data($bodyid);
        $body=$tempbody_details['template_content'];
		$body = str_replace('{base_url}', $this->base_domain, $body);
		$body = str_replace('{base_image}',$this->base_domain.'/'.$this->logo_front, $body); 
        $body = str_replace('{gig_owner}', $owner_of_gig['fullname'], $body);
        $body = str_replace('{sell_name}', $name, $body);
        $body = str_replace('{title}', $title, $body);				
        $body = str_replace('{gig_preview_link}', $username, $body);
        $body = str_replace('{user_profile_link}', $url, $body);
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
        $this->email->to($owner_of_gig['email']); 
        $this->email->subject('Update from '.$this->site_name);
        $this->email->message($message);
		 
        if($this->email->send())
        {            
			$update_data['mail_sent'] = 0;
			$this->db->where('id',$id);
			$this->db->update('feedback',$update_data);
        }	          
              
            } 
		
		}
	}
	
    public function update_notification()
    {        
        $table_name = $this->input->post('table_name');
        //$update_data = array('notification_status'=>2);
        $id = $this->input->post('id');
        /*$this->db->where('id',$id);
        if($this->db->update($table_name,$update_data))
        {
        echo 1;     
        } */
        $query = $this->db->query("UPDATE $table_name SET  `notification_status` = 2 WHERE `id` = $id ");           
        if($query)
        {
            echo 1;
        }
    }
    public function update_notifications()
    {        
        $table_name = $this->input->post('table_name');
        //$update_data = array('notification_status'=>2);
        $id = $this->input->post('id');
        /*$this->db->where('id',$id);
        if($this->db->update($table_name,$update_data))
        {
        echo 1;     
        } */
        $query = $this->db->query("UPDATE $table_name SET  `notification_seen` = 2 WHERE `id` = $id ");           
        if($query)
        {
            echo 1;
        }
    }
	public function change_notification_status()
	{
		$sts = $this->input->post('sts');
        //$update_data = array('notification_status'=>2);
        $id = $this->input->post('id');
		$table= ' ';
		if($sts=='completed')
		{
			$table= 'payments';
		}
		elseif($sts=='completedrequest')
		{
			$table= 'payments';
		}
		elseif($sts=='buyed')
		{
			$table= 'payments';
		}
		elseif($sts=='own_buying')
		{
			$table= 'payments';
		}
		elseif($sts=='to_user')
		{
			$table= 'feedback';
		}
		elseif($sts=='from_user')
		{
			$table= 'feedback';
		}
		elseif($sts=='payment_release')
		{
			$table=  'payments';
		}
		elseif($sts=='buyer_cancel')
		{
			$table= 'payments';
		}
		elseif($sts=='seller_cancel')
		{
			$table= 'payments';
		}
		elseif($sts=='buyer_decline_payment')
		{
			$table= 'payments';
		}
		elseif($sts=='complete-request-accept')
		{
			$table= 'payments';
		}
		elseif($sts=='buyer_cancel_payment')
		{
			$table= 'payments';
		}
		elseif($sts=='buyer_cancel')
		{
			$table= 'payments';
		}
		elseif($sts=='seller_cancel')
		{
			$table= 'payments';
		}
		elseif($sts=='seller_cancelled')
		{
			$table= 'payments';
		}
		elseif($sts=='buyer_accept_seller_declined')
		{
			$table= 'payments';
		}
		elseif($sts=='buyer_cancelled')
		{
			$table= 'payments';
		}
		elseif($sts=='seller_declined')
		{
			$table= 'payments';
		}
		elseif ($sts=='admin_accept_buyer_declined') {
			$table= 'buyer_rejected_list';
		}
		elseif ($sts=='admin_accept_seller_declined') {
			$table= 'buyer_rejected_list';
		}
		if(!empty($table))
		{
			
				if($sts=='buyer_cancel'){
					$query = $this->db->query("UPDATE $table SET  `cancel_notification_status` = 0 WHERE `id` = $id ");
				}
				else if($sts =='seller_cancel')
				{
					$query = $this->db->query("UPDATE $table SET  `cancel_notification_status` = 0 WHERE `id` = $id ");
				}
				else if($sts =='buyer_decline_payment')
				{
					$query = $this->db->query("UPDATE $table SET  `notification_status` = 0 WHERE `id` = $id ");
				}
				else if($sts =='complete-request-accept')
				{
					$query = $this->db->query("UPDATE $table SET  `notification_status` = 0 WHERE `id` = $id ");
				}
				else if($sts =='admin_accept_buyer_declined')
				{
					$query = $this->db->query("UPDATE $table SET  `notification_seen` = 2 WHERE `id` = $id ");
				}
				else if($sts =='admin_accept_seller_declined')
				{
					$query = $this->db->query("UPDATE $table SET  `notification_seen` = 3 WHERE `id` = $id ");
				}
				else
				{
					$query = $this->db->query("UPDATE $table SET  `notification_status` = 0 WHERE `id` = $id ");
				}
			
			echo 1;
		}
		else
		{
			echo 2;
		}
	}
    
}
?>