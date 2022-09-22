<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Sales extends CI_Controller {
    public $data;
    public function __construct() {
        parent::__construct();
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

        $this->data['theme'] = 'user';
        $this->data['module'] = 'sales';
		$this->load->model('user_panel_model');
		$this->load->model('payment_model');
		$this->load->model('api_gigs_model','gigs');
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
		$this->load->model('gigs_model');
		$this->load->model('templates_model');
		$this->data['title'] = 'Gigs';
        $this->data['categories_subcategories'] = $this->user_panel_model->categories_subcategories();  
        $this->data['footer_main_menu'] = $this->user_panel_model->footer_main_menu();
        $this->data['footer_sub_menu'] = $this->user_panel_model->footer_sub_menu();
        $this->data['system_setting'] = $this->user_panel_model->system_setting(); 
		$this->data['gig_price'] = $this->gigs_model->gig_price();
		if($this->session->userdata('SESSION_USER_ID')==''){ 
			redirect(base_url(''));
		}
    }
    public function index($offset=0) {



    	$first = (!empty($this->user_language[$this->user_selected]['lg_first']))?$this->user_language[$this->user_selected]['lg_first']:$this->default_language['en']['lg_first'];

    	$last = (!empty($this->user_language[$this->user_selected]['lg_last']))?$this->user_language[$this->user_selected]['lg_last']:$this->default_language['en']['lg_last'];

		 $this->load->library('pagination');
		 $config['base_url'] = base_url().'sales';
         $config['per_page'] = 20;                
         $config['total_rows'] =  $this->payment_model->get_selluser_details($this->session->userdata('SESSION_USER_ID'),0,0,0);   
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
		 $this->data['page_title'] = 'Sales';
		 $this->data['userid'] = $this->session->userdata('SESSION_USER_ID');
		 $this->data['order_count'] = $this->payment_model->get_user_orders_count($this->session->userdata('SESSION_USER_ID'));  
		 $this->data['order_data'] = $this->payment_model->get_selluser_details($this->session->userdata('SESSION_USER_ID'),1,$offset,$config['per_page']); 
		 $this->data['sales_order_count'] = $this->payment_model->get_selluser_orders_count($this->session->userdata('SESSION_USER_ID')); 
		 $this->data['wallet_order_count'] = $this->payment_model->get_wallets_orders_count($this->session->userdata('SESSION_USER_ID'));
		 $this->data['page'] = 'index';
		 $this->data['gigs_country']             =  $this->gigs_model->gigs_country();
  		 $this->load->vars($this->data);  
  		 
		 $this->load->view($this->data['theme'].'/template');
    }
	public function get_user_feedback()
	{
		$f_id=$this->input->post('f_id');
		$t_id=$this->input->post('t_id');
		$g_id=$this->input->post('g_id');
		$order_id=$this->input->post('order_id');
		$user_data = $this->user_panel_model->get_user_data($t_id);
		$query_res = $this->db->query("SELECT AVG(feedback.rating) FROM `feedback`
			     left join sell_gigs on sell_gigs.id = feedback.`gig_id`
			     WHERE sell_gigs.user_id = $t_id AND feedback.`to_user_id` = $t_id;");
        $result_count = $query_res->row_array();
		$rat=0;
		if($result_count['AVG(feedback.rating)']!='')
		{
			$rat=round($result_count['AVG(feedback.rating)']);
		} 
		$html ='';
		$prof_img    = base_url().'assets/images/avatar2.jpg';
		if($user_data['user_thumb_image'] != '') $prof_img = base_url().$user_data['user_thumb_image']; 
		$name=$user_data['fullname']; 
		$country=$user_data['country']; 
		$sortname ='IN';
		if($user_data['sortname']!='')
		{
			$sortname=$user_data['sortname']; 
		}

		$from = (!empty($this->user_language[$this->user_selected]['lg_from']))?$this->user_language[$this->user_selected]['lg_from']:$this->default_language['en']['lg_from'];

		$contact = (!empty($this->user_language[$this->user_selected]['lg_contact']))?$this->user_language[$this->user_selected]['lg_contact']:$this->default_language['en']['lg_contact'];

		$html .='<div class="media">
					<div class="media-left">
						<img width="50" height="50" class="img-circle" src="'.$prof_img.'" alt="'.$name.'">
					</div>
					<div class="media-body">
						<div class="user-details">
						<div class="user-name-block">
							<a href="'.base_url().'user-profile/'.$user_data["username"].'" class="user-name">'.$name.'</a>
						</div>
						<div class="user-contact">
							<ul class="list-inline">
								<li class="user-rating"><span id="stars-existing" class="starrr" data-rating="'.$rat.'"></span></li>
								<script type="text/javascript" src="'.base_url().'assets/js/rating.js"></script>
								<li class="user-country2">'.$from.' '.$country.' <span class="ppcn country '.$sortname.'"></li>
								<li class="contact-list"><a href="javascript:;" class="btn btn-primary btn-sm btn-border" onclick="message_contact_user();">'.$contact.'</a></li>
								<input type="hidden" name="sb_user_id" id="sb_user_id" value="'.$t_id.'">
							</ul>
						</div>
					</div>
					</div>
				</div>';
		$temp='';
		$user_feed='';		
		if($t_id)
		{
			$query = $this->db->query("SELECT a.*,cu.fullname,cu.user_thumb_image,cu.username FROM `feedback` as a 
			left join members cu on cu.USERID = a.from_user_id
			WHERE a.`from_user_id` = $t_id and a.`to_user_id` = $f_id and a.`gig_id` = $g_id and a.`order_id` = $order_id;");
        	$result = $query->row_array();
			$query_two = $this->db->query("SELECT a.*,cu.fullname,cu.user_thumb_image,cu.username FROM `feedback` as a 
			left join members cu on cu.USERID = a.from_user_id
			WHERE a.`from_user_id` =$f_id and a.`to_user_id` = $t_id and a.`gig_id` = $g_id and a.`order_id` = $order_id;");
        	$result_array = $query_two->row_array();
			if($result)
			{
				$temp =1;
				$date       = new DateTime();
				$match_date = new DateTime($result['created_date']);
				$interval   = $date->diff($match_date);
				if($interval->days == 0) $tme = date(' h:i A',strtotime($result['created_date']));
				else  $tme = $interval->days.' Days ago ';
				$user_img='assets/images/avatar2.jpg';
				if($result['user_thumb_image']!=''){ $user_img =base_url().$result['user_thumb_image'];}
				$name= $result['fullname'];
				$comment= $result['comment'];
				$rating= $result['rating'];
				$user_feed.='<div class="feedback-area">
									<ul class="feedback-list">
										<li class="media">
											<a href="'.base_url().'user-profile/'.$result["username"].'" class="pull-left"><img width="26" height="26" alt="" src="'.$user_img.'"></a>
											<div class="media-body">
												<div class="feedback-info">
													<div class="feedback-author">
														<a href="'.base_url().'user-profile/'.$result["username"].'">'.$name.'</a>
													</div>
													<span class="feedback-time">'.$tme.'</span>
												</div>
												<script type="text/javascript" src="'.base_url().'assets/js/rating.js"></script>
												<p>'.$comment.'  <span id="stars-existing" class="starrr" data-rating="'.$rating.'"></span></p>';
									if($result_array){
										$user_img1='assets/images/avatar2.jpg';
										if($result_array['user_thumb_image']!=''){ $user_img1 =base_url().$result_array['user_thumb_image'];}
										$name1= $result_array['fullname'];
										$comment1= $result_array['comment'];
										$rating1= $result_array['rating'];
										$date       = new DateTime();
										$match_date1 = new DateTime($result_array['created_date']);
										$interval1   = $date->diff($match_date1);
										if($interval1->days == 0) $tme1 = date(' h:i A',strtotime($result_array['created_date']));
										else  $tme1 = $interval1->days.' Days ago ';
									$user_feed.='<div class="media">
													<a href="'.base_url().'user-profile/'.$result_array["username"].'" class="pull-left"><img width="26" height="26" alt="" src="'.$user_img1.'"></a>
													<div class="media-body">
														<div class="feedback-info">
															<div class="feedback-author">
																<a href="'.base_url().'user-profile/'.$result_array["username"].'">'.$name1.'</a>
															</div>
															<span class="feedback-time">'.$tme1.'</span>
														</div>
														<p>'.$comment1.'</p>
													</div>
												</div>';
									}else{
											
                                           $user_feed.=' <form action="" type="post" id="feedback_rating_form">
                                                <input type="hidden" id="rating_frmuser" value="'.$t_id.'" name="rating_frmuser" />
                                                <input type="hidden" id="rating_touser" value="'.$f_id.'" name="rating_touser" />
                                                <input type="hidden" id="rating_gig" value="'.$g_id.'" name="rating_gig" />
												<input type="hidden" id="rating_orderid" value="'.$order_id.'" name="rating_orderid" />
												<div class="error_msg" id="_error_msg"></div>
                                                <div class="row">
                                                    <div class="form-group clearfix">
                                                        <div class="col-md-12">
                                                            <textarea rows="4" class="form-control" name="comment" id="comment" placeholder="Reply"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                    </div>
                                                    <div class="col-md-6 text-right">
                                                        <input type="button" value="Send Feedback" onclick="submit_commentsales();" class="btn btn-primary btn-border" data-loading-text="Loading...">
                                                    </div>
                                                </div>
                                            </form>';
											
									}
							$user_feed.='</div>
										</li>
									</ul>
								</div>';
			}
			else
			{
				$temp =2;
			}
		}
		echo json_encode( array('user_content'=>$html,'status'=>$temp,'user_feed'=>$user_feed,'f_id'=>$f_id,'t_id'=>$t_id,'g_id'=>$g_id,'order_id'=>$order_id));
	}
	public function save_feedback()
	{
		$f_id=$this->input->post('rating_frmuser');
		$t_id=$this->input->post('rating_touser');
		$g_id=$this->input->post('rating_gig');
		$orderid=$this->input->post('rating_orderid');
		$comment=$this->input->post('comment');
		$rating_input=$this->input->post('rating_input');
		$from_timezone = $this->session->userdata('time_zone');
			$data['from_user_id'] = $t_id;
			$data['to_user_id'] = $f_id; 
			$data['gig_id'] = $g_id;
			$data['order_id'] = $orderid;
			$data['rating']= 0;
			$data['sent_recieved'] = 1;
			$data['comment'] =$comment; 
			$data['time_zone'] =$from_timezone;
		   	date_default_timezone_set($from_timezone); 
		    $current_time= date('Y-m-d H:i:s');
			$data['created_date'] =$current_time;
			$data['	status'] =1;
			if($this->db->insert('feedback',$data))
			{
				$query = $this->db->query("SELECT sg.title,m.fullname as buyername,m.username as buyerusername,  m.email as buyeremail, sm.fullname as sellername,sm.username as sellerusername FROM `payments` as py
					LEFT JOIN sell_gigs as sg ON sg.id = py.gigs_id	
					LEFT JOIN members as m ON m.USERID = py.USERID
					LEFT JOIN members as sm ON sm.USERID = py.seller_id
					WHERE py.`id` = $orderid");
				$data_one = $query->row_array();
				$title= ucfirst($data_one['title']);
				$to_email= $data_one['buyeremail'];
				$bodyid = 17;
				$tempbody_details= $this->templates_model->get_usertemplate_data($bodyid);
				$body=$tempbody_details['template_content'];
				$message='';
				$gig_preview_link  = base_url().'gig-preview/'.$title ;
				$user_profile_link  = base_url().'user-profile/'.$data_one['sellerusername'];
				$body = str_replace('{base_url}', $this->base_domain, $body);
				$body = str_replace('{base_image}',$this->base_domain.'/'.$this->logo_front, $body);
				$body = str_replace('{user_profile_link}', $user_profile_link, $body);
				$body = str_replace('{gig_preview_link}', $gig_preview_link, $body);
		    	$body = str_replace('{site_name}',$this->site_name, $body);				
				$body = str_replace('{buyer_name}', $data_one['buyername'], $body);
				$body = str_replace('{seller_name}', $data_one['sellername'], $body);
				$body = str_replace('{title}',str_replace("-"," ",$title), $body);
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
				$this->email->subject('Reply Feedback from '.$data_one['sellername']);
				$this->email->message($message);
				if($this->email->send())
				{
					echo 1;
				}else{
					echo 1;
				}
			}
			else
			{
				echo 2;
			}
	}
	public function get_user_content()
	{
		$f_id=$this->input->post('f_id');
		$user_data = $this->user_panel_model->get_user_data($f_id); 
		$html ='';
		$prof_img    = base_url().'assets/images/avatar2.jpg';
		if($user_data['user_thumb_image'] != '') $prof_img = base_url().$user_data['user_thumb_image']; 
		$name=$user_data['fullname']; 
		$country=$user_data['country']; 
		$sortname ='';
		if($user_data['sortname']!='')
		{
			$sortname=$user_data['sortname']; 
		}
		$user_link_one=base_url().'user-profile/'.$user_data['username'];
		$temp='';
		$temp=1;
		$html .='<div class="pull-left user-img" style="margin-right: 10px;">
                            <a href="'.$user_link_one.'"><img src="'.$prof_img.'" alt="" class="w-40 img-circle"></a><span class="online"></span>
                        </div>
                        <div class="user-info pull-left">
                            <div class="dropdown">
                                <a href="'.$user_link_one.'">'.$name.'</a>
                            </div>
							<p class="text-muted m-0">'.$country.' <span class="ppcn country '.$sortname.'"></p>
                        </div>';
					
		echo json_encode( array('user_content'=>$html,'status'=>$temp));
	}
	public function change_gigs_status()
	{
		
		$p_id = $this->input->post('p_id');
		$sts  = $this->input->post('sts');
		$val  = $this->input->post('val');
		$from_timezone = $this->session->userdata('time_zone');
		$data['time_zone'] =$from_timezone;
		date_default_timezone_set($from_timezone); 
		$current_time= date('Y-m-d H:i:s');
		if($sts == 6 && $val==1){
			
			$sts = 7; // Completed Request 
		}
		$data_up['seller_status'] = $sts;	
		$data_up['notification_status'] = 1;
		$data_up['update_date'] = $current_time;
		if($sts==5){
		$data_up['update_date'] = $current_time;
		$data_up['notification_status'] = 1;	
		$data_up['cancel_notification_status'] = 1;
		}
		if($this->db->update('payments',$data_up,array('id'=>$p_id)))
		{
			$query = $this->db->query("SELECT sg.title,m.fullname as buyername,m.username as buyerusername,m.USERID as buyer_id, m.email as buyeremail,sm.email as selleremail, sm.fullname as sellername,sm.username as sellerusername FROM `payments` as py
					LEFT JOIN sell_gigs as sg ON sg.id = py.gigs_id	
					LEFT JOIN members as m ON m.USERID = py.USERID
					LEFT JOIN members as sm ON sm.USERID = py.seller_id
					WHERE py.`id` = $p_id");
			$data_one = $query->row_array();
			$title= ucfirst($data_one['title']);
			if($sts ==6)
			{
				$to_email= $data_one['buyeremail'];
				$notify_user_id = $data_one['buyer_id'];
				$bodyid = 18;
				$tempbody_details= $this->templates_model->get_usertemplate_data($bodyid);
				$body=$tempbody_details['template_content'];
				$message='';
				$gig_preview_link  = base_url().'gig-preview/'.$title ;
				$gig_purchase  = base_url().'purchases/';
				$body = str_replace('{base_url}', $this->base_domain, $body);
				$body = str_replace('{base_image}',$this->base_domain.'/'.$this->logo_front, $body);
				$body = str_replace('{gig_purchase}', $gig_purchase, $body);
				$body = str_replace('{gig_preview_link}', $gig_preview_link, $body);
                $body = str_replace('{site_name}',$this->site_name, $body);					
				$body = str_replace('{buyer_name}', $data_one['buyername'], $body);
				$body = str_replace('{gig_owner}', $data_one['sellername'], $body);
				$body = str_replace('{title}',str_replace("-"," ",$title), $body);
			
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
				$this->email->subject('Your Order Completed');
				$this->email->message($message);
				$this->email->send();
				
				//order complete request accept_buyer_request
				$title= ucfirst($data_one['title']);
				$to_email= $data_one['selleremail'];
				$bodyid = 30;
				$tempbody_details= $this->templates_model->get_usertemplate_data($bodyid);
				$body=$tempbody_details['template_content'];
				$message='';
				$gig_preview_link  = base_url().'sales';
				$body = str_replace('{base_url}', $this->base_domain, $body);
				$body = str_replace('{base_image}',$this->base_domain.'/'.$this->logo_front, $body);
				$body = str_replace('{gig_preview_link}', $gig_preview_link, $body);
                $body = str_replace('{site_name}',$this->site_name, $body);					
				$body = str_replace('{buyer_name}', $data_one['buyername'], $body);
				$body = str_replace('{gig_owner}', $data_one['sellername'], $body);
				$body = str_replace('{title}',str_replace("-"," ",$title), $body);
			
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
				$this->email->subject('Order Complete Request');
				$this->email->message($message);
				$this->email->send();
				
				$title = str_replace('-', ' ', $title);

         		$this->gigs->order_status_notification($notify_user_id,$title,'Order Complete Request');
			}
			elseif($sts ==8)
			{
				$query = $this->db->query("SELECT sg.title,m.fullname as buyername,sm.USERID as seller_id,m.username as buyerusername, m.email as buyeremail,sm.email as selleremail,sm.fullname as sellername,sm.username as sellerusername FROM `payments` as py
						LEFT JOIN sell_gigs as sg ON sg.id = py.gigs_id	
						LEFT JOIN members as m ON m.USERID = py.USERID
						LEFT JOIN members as sm ON sm.USERID = py.seller_id
						WHERE py.`id` = $p_id");
					
				$data_one = $query->row_array();
				
				$notify_user_id = $data_one['seller_id'];

				$title= ucfirst($data_one['title']);
				$to_email= $data_one['selleremail'];
				$bodyid = 30;
				$tempbody_details= $this->templates_model->get_usertemplate_data($bodyid);
				$body=$tempbody_details['template_content'];
				$message='';
				$gig_preview_link  = base_url().'purchases';
				$body = str_replace('{base_url}', $this->base_domain, $body);
				$body = str_replace('{base_image}',$this->base_domain.'/'.$this->logo_front, $body);
				$body = str_replace('{gig_preview_link}', $gig_preview_link, $body);
                $body = str_replace('{site_name}',$this->site_name, $body);					
				$body = str_replace('{buyer_name}', $data_one['buyername'], $body);
				$body = str_replace('{gig_owner}', $data_one['sellername'], $body);
				$body = str_replace('{title}',str_replace("-"," ",$title), $body);
			
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
				$this->email->subject('Order Complete Request');
				$this->email->message($message);
				$this->email->send();
         		$title = str_replace('-',' ',$title);
				$this->gigs->order_status_notification($notify_user_id,$title,'Order Complete Request');
			}
			elseif($sts ==7)
			{
				$query = $this->db->query("SELECT sg.title,m.fullname as buyername,m.USERID as buyer_id,m.username as buyerusername, m.email as buyeremail, sm.fullname as sellername,sm.username as sellerusername FROM `payments` as py
						LEFT JOIN sell_gigs as sg ON sg.id = py.gigs_id	
						LEFT JOIN members as m ON m.USERID = py.USERID
						LEFT JOIN members as sm ON sm.USERID = py.seller_id
						WHERE py.`id` = $p_id");
				$data_one = $query->row_array();
				$notify_user_id = $data_one['buyer_id'];
				$title= ucfirst($data_one['title']);
				$to_email= $data_one['buyeremail'];
				$bodyid = 29;
				$tempbody_details= $this->templates_model->get_usertemplate_data($bodyid);
				$body=$tempbody_details['template_content'];
				$message='';
				$gig_preview_link  = base_url().'purchases';
				$body = str_replace('{base_url}', $this->base_domain, $body);
				$body = str_replace('{base_image}',$this->base_domain.'/'.$this->logo_front, $body);
				$body = str_replace('{gig_preview_link}', $gig_preview_link, $body);
                $body = str_replace('{site_name}',$this->site_name, $body);					
				$body = str_replace('{buyer_name}', $data_one['buyername'], $body);
				$body = str_replace('{gig_owner}', $data_one['sellername'], $body);
				$body = str_replace('{title}',str_replace("-"," ",$title), $body);
			
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
				$this->email->subject('Order Complete Request');
				$this->email->message($message);
				$this->email->send();

				$title = str_replace('-',' ',$title);
				$this->gigs->order_status_notification($notify_user_id,$title,'Order Complete Request');
         
			}
			else if($sts ==5)
			{
				$to_email = $data_one['buyeremail'];
				
				$notify_user_id = $data_one['buyer_id'];

				$bodyid = 25;
				$tempbody_details= $this->templates_model->get_usertemplate_data($bodyid);
				$body=$tempbody_details['template_content'];
				$message='';
				$gig_preview_link  = base_url().'gig-preview/'.$title ;
				$purchase_link  = base_url().'purchases/' ;
				$body = str_replace('{base_url}', $this->base_domain, $body);
				$body = str_replace('{base_image}',$this->base_domain.'/'.$this->logo_front, $body);
				  $body = str_replace('{site_name}',$this->site_name, $body);				
				$body = str_replace('{gig_preview_link}', $gig_preview_link, $body);		 
				$body = str_replace('{purchase_link}', $purchase_link, $body);		 
				$body = str_replace('{buyer_name}', $data_one['buyername'], $body);
				$body = str_replace('{gig_owner}', $data_one['sellername'], $body);
				$body = str_replace('{title}',str_replace("-"," ",$title), $body);
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
				$this->email->subject('Your Order Declined from '.$data_one['sellername']);
				$this->email->message($message);
				$this->email->send();
				
				$title = str_replace('-',' ',$title);
				$this->gigs->order_status_notification($notify_user_id,$title,'Your Order Declined from '.$data_one['sellername']);
         
			}
			
			echo 1;
		}
		else
		{
			echo 2;
		}
	}
	
	 public function file_remove(){
	 	
	 	$id = base64_decode($this->input->get('id'));
	 	$this->payment_model->remove_file($id);
	 		$message = (!empty($this->user_language[$this->user_selected]['lg_file_has_been_removed']))?$this->user_language[$this->user_selected]['lg_file_has_been_removed']:$this->default_language['en']['lg_file_has_been_removed'];
	 	$this->session->set_flashdata('msg', $message);
	 	$url = base_url().'files';
	 	redirect($url,'refresh');
	 }
	
	 

	public function my_files($offset=0){


		$first = (!empty($this->user_language[$this->user_selected]['lg_first']))?$this->user_language[$this->user_selected]['lg_first']:$this->default_language['en']['lg_first'];

    	$last = (!empty($this->user_language[$this->user_selected]['lg_last']))?$this->user_language[$this->user_selected]['lg_last']:$this->default_language['en']['lg_last'];


		 $this->data['page']   = 'files';
		 $uid = 0 ;
		if (!($this->session->userdata('SESSION_USER_ID'))) {	 }else{
		 	$uid = $this->session->userdata('SESSION_USER_ID');	
		 }

		 $this->load->library('pagination');
		 $config['base_url'] = base_url().'files';
         $config['per_page'] = 20;                
         $config['total_rows'] =  $this->payment_model->get_selluser_details_success($this->session->userdata('SESSION_USER_ID'),0,0,0);   
		 $config['uri_segment'] = 2;		
         $config['full_tag_open'] = '<ul class="pagination">';
         $config['full_tag_close'] = '</ul>';
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
		 $this->payment_model->check_and_remove();
         $this->pagination->initialize($config);
		 $this->data['links'] = $this->pagination->create_links();
		 $this->data['page_title'] = 'Sales';
		 $this->data['userid'] =  $uid;
		 $this->data['order_count'] = $this->payment_model->get_user_orders_count_success($uid);  
		 $this->data['order_data'] = $this->payment_model->get_selluser_details_success($uid,1,$offset,$config['per_page']); 
		 $this->data['sales_order_count'] = $this->payment_model->get_selluser_orders_count($uid); 
                 $this->data['gigs_country'] =  $this->gigs_model->gigs_country();
		 $this->data['wallet_order_count'] = $this->payment_model->get_wallets_orders_count($uid);
		 $this->load->vars($this->data);  
		 $this->load->view($this->data['theme'].'/template');
	}
	public function my_upload_file(){

			
			if($_FILES['product_upload']){

			$uid = 0 ;
	if (!($this->session->userdata('SESSION_USER_ID'))) {	 }else{

		 	  $uid = $this->session->userdata('SESSION_USER_ID');	
			  $time_zone = $this->session->userdata('time_zone');	
		 } 

				ini_set('max_execution_time', 0);
				ini_set('upload_max_filesize','20M');

				$picName = $_FILES['product_upload']['name'];	
		  		$extn = explode('.',$picName);
	   	  		$flname  = $extn[0] ;
				$config['upload_path'] = 'uploads/digital/';
				$config['allowed_types'] = 'zip';
				$config['file_name'] = $flname;
				$config['max_size'] = '5000000000';
				$config['overwrite'] = TRUE;
				$this->load->library('upload', $config);
				
				$params = array();

				if ($this->upload->do_upload('product_upload'))
				{

					 $details = $this->upload->data();
    
					date_default_timezone_set($time_zone);
					$date_time = date('Y-m-d H:i:s');

					$digital_data = $this->input->post();

					$digital_data['filename'] 		= $details['file_name'];
					$digital_data['file_size']		= $details['file_size'];
					$digital_data['upload_user_id'] = $uid;
					$digital_data['added_on']		= $date_time;
					$digital_data['time_zone']		= $time_zone;
					$digital_data['buyer_show'] 	= '0';
					$digital_data['seller_show'] 	= '0';

					$this->db->insert('digital_download',$digital_data);
					$message = (!empty($this->user_language[$this->user_selected]['lg_file_has_been_uploaded_successfully']))?$this->user_language[$this->user_selected]['lg_file_has_been_uploaded_successfully']:$this->default_language['en']['lg_file_has_been_uploaded_successfully'];

					$this->session->set_flashdata('msg',$message);
					$url = base_url().'files';
                    redirect($url);
				}else{
					$error_msg = $this->upload->display_errors();
					$this->session->set_flashdata('msg_error',$error_msg);
					$message = (!empty($this->user_language[$this->user_selected]['lg_sorry_file_upload_failed']))?$this->user_language[$this->user_selected]['lg_sorry_file_upload_failed']:$this->default_language['en']['lg_sorry_file_upload_failed'];

					$this->session->set_flashdata('msg',$message);
					$url = base_url().'sales';
                    redirect($url);
				}
			}else{
				echo 'Please Choose File';
			}	
	}

	public function get_sales_details()
	{
		if($this->input->post()){

		$id=$this->input->post('id');
		
		$pay_data = $this->payment_model->get_salespayment_details($id);
		$uid = '';
		if (!($this->session->userdata('SESSION_USER_ID'))) {	 }else{

			$uid = $this->session->userdata('SESSION_USER_ID');
		}
		$upload_files  = $this->payment_model->get_upload_files($id,$uid);

		if(!empty($pay_data['gigs_id'])){

			
			if($pay_data['gig_price']=='')
			{
				$result_details = $this->db->get_where('sell_gigs',array('id' => $pay_data['gigs_id']))->row_array();

				$gig_item_amount = $result_details['gig_price']; // Payment Price 
			}
			else
			{
				$gig_item_amount = $pay_data['gig_price']; // Payment Price 
			}	
			
		}
		
		$extra_gigs_ref = json_decode($pay_data['extra_gig_ref']);	
			
		if(!empty($extra_gigs_ref))
		{
		$extra_gig_query = $this->db->query(" SELECT options  , currency_type FROM user_required_extra_gigs WHERE id in ($extra_gigs_ref)");		 
		$extra_gig_result = $extra_gig_query->result_array();		 
		}
		$country_name = $this->session->userdata('country_name');
		$this->data['gig_price'] = $this->gigs_model->gig_price();
		$_sprice = $this->gigs_model->extra_gig_price();
		$this->data['extra_gig_price'] ='';	
		if (!empty($_sprice)) {
		$this->data['extra_gig_price'] = implode("",$_sprice);
		}
			
		 
		// $gig_rate = implode($this->data['gig_price']);// Fixed Price 
		$gig_rate = $gig_item_amount;  // Dynamic Price 
			
$currency_option = (!empty($pay_data['currency_type']))?$pay_data['currency_type']:'USD';
$rate_symbol = currency_sign($currency_option); 

		 $created_on = '-';
		 $_uid=$pay_data['USERID'];
		$query_feed = $this->db->query("SELECT AVG(feedback.rating) FROM `feedback`
			     left join sell_gigs on sell_gigs.id = feedback.`gig_id`
			     WHERE sell_gigs.user_id = $_uid AND feedback.`to_user_id` = $_uid;");
		$fe_count = $query_feed->row_array();
		$rat=0;
		if($fe_count['AVG(feedback.rating)']!='')
		{
			$rat=round($fe_count['AVG(feedback.rating)']);
		} 
		if (isset($pay_data['created_at'])) {
			if (!empty($pay_data['created_at']) && $pay_data['created_at'] != "0000-00-00 00:00:00") {
				$created_on = date('M j, Y g:i A', strtotime($pay_data['created_at']));
			}
		}


		$failed =  (!empty($this->user_language[$this->user_selected]['lg_failed']))?$this->user_language[$this->user_selected]['lg_failed']:$this->default_language['en']['lg_failed'];

		$declined =  (!empty($this->user_language[$this->user_selected]['lg_declined']))?$this->user_language[$this->user_selected]['lg_declined']:$this->default_language['en']['lg_declined'];

		$new =  (!empty($this->user_language[$this->user_selected]['lg_new']))?$this->user_language[$this->user_selected]['lg_new']:$this->default_language['en']['lg_new'];

		$cancelled =  (!empty($this->user_language[$this->user_selected]['lg_cancelled']))?$this->user_language[$this->user_selected]['lg_cancelled']:$this->default_language['en']['lg_cancelled'];

		$refunded =  (!empty($this->user_language[$this->user_selected]['lg_refunded']))?$this->user_language[$this->user_selected]['lg_refunded']:$this->default_language['en']['lg_refunded'];

		$pending =  (!empty($this->user_language[$this->user_selected]['lg_pending']))?$this->user_language[$this->user_selected]['lg_pending']:$this->default_language['en']['lg_pending'];

		$process =  (!empty($this->user_language[$this->user_selected]['lg_process']))?$this->user_language[$this->user_selected]['lg_process']:$this->default_language['en']['lg_process'];

		$completed =  (!empty($this->user_language[$this->user_selected]['lg_completed']))?$this->user_language[$this->user_selected]['lg_completed']:$this->default_language['en']['lg_completed'];

		$complete_request =  (!empty($this->user_language[$this->user_selected]['lg_complete_request']))?$this->user_language[$this->user_selected]['lg_complete_request']:$this->default_language['en']['lg_complete_request'];

			                            $status = $pay_data['seller_status']; 
											if($status ==0) {
												$sts=$failed;
												$class='label-danger';
											}elseif($status ==1) {
												$sts=$new;
												$class='label-success';
												if($pay_data['buyer_status'] ==1) { if($pay_data['cancel_accept'] ==1){
													$sts=$cancelled;
													$class='label-danger';
													if($pay_data['pay_status']=='Payment Processed'){
														$sts=$refunded;
													$class='label-info';
													}
												}
												}
											}elseif($status ==2){
												$sts=$pending;
												$class='label-warning';
												if($pay_data['buyer_status'] ==1) { if($pay_data['cancel_accept'] ==1){
													$sts=$cancelled;
													$class='label-danger';
													if($pay_data['pay_status']=='Payment Processed'){
														$sts=$refunded;
													$class='label-info';
													}
												}
												}
											}elseif($status ==3){
												$sts=$process;
												$class='label-primary';
												if($pay_data['buyer_status'] ==1) { if($pay_data['cancel_accept'] ==1){
													$sts=$cancelled;
													$class='label-danger';
													if($pay_data['pay_status']=='Payment Processed'){
														$sts=$refunded;
													$class='label-info';
													}
												}
												}
											}elseif($status ==4){
												$sts=$refunded;
												$class='label-danger';
											}elseif($status ==5){
												$sts=$declined;
												$class='label-danger';
											}elseif($status ==6){
												$sts=$completed;
												$class='label-success';
											}
											$fead_stautus=0;
											if($status ==6) {
												$sts=$completed;
												$class='label-success';
											}
											if($status ==7)
											{
												$sts=$complete_request;
												$class='label-success';
											}
											else
											{
												$b_sts=$pending;
											}


			$image_url='assets/images/gig-small.jpg';
			if($pay_data['gig_image_thumb']!='')
			{
				$image_url=base_url().$pay_data['gig_image_thumb'];
			}
			$user_image_url=base_url().'assets/images/avatar2.jpg';
			if($pay_data['user_thumb_image']!='')
			{
				$user_image_url=base_url().$pay_data['user_thumb_image'];
			}
			$user_link_one=base_url().'user-profile/'.$pay_data['username'];
			$gig_link= base_url().'gig-preview/'.$pay_data['title'];

			$sales_details =  (!empty($this->user_language[$this->user_selected]['lg_sales_details']))?$this->user_language[$this->user_selected]['lg_sales_details']:$this->default_language['en']['lg_sales_details'];

			$transaction_id = (!empty($this->user_language[$this->user_selected]['lg_transaction_id']))?$this->user_language[$this->user_selected]['lg_transaction_id']:$this->default_language['en']['lg_transaction_id'];

			$maximum_file_upload_size_5mb = (!empty($this->user_language[$this->user_selected]['lg_maximum_file_upload_size_5mb']))?$this->user_language[$this->user_selected]['lg_maximum_file_upload_size_5mb']:$this->default_language['en']['lg_maximum_file_upload_size_5mb'];

			$upload_final_files = (!empty($this->user_language[$this->user_selected]['lg_upload_final_files']))?$this->user_language[$this->user_selected]['lg_upload_final_files']:$this->default_language['en']['lg_upload_final_files'];

			$upload = (!empty($this->user_language[$this->user_selected]['lg_upload']))?$this->user_language[$this->user_selected]['lg_upload']:$this->default_language['en']['lg_upload'];

		$html='';
		$html_table_header = '<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-header text-center">
						<h5>'.$sales_details .'</h5>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-8">
								<h5 class="order-number">'.$transaction_id.': #'.$pay_data['paypal_uid'].'</h5>
								<h5 class="order-date">'.$created_on.'</h5>
							</div>
							<div class="col-sm-4">
								<div class="text-right summary">
									<span class="order-status '.$class.'">'.$sts.'</span>
								</div>
							</div>
						</div>';

	if(($pay_data['seller_status']!=0) &&($pay_data['seller_status']!=4) &&($pay_data['seller_status']!=5) && ($sts!='Cancelled')){


	$html_table_header .= '<div class="well">
							<div class="row">
							<div class="col-sm-8">
                                    <label>'.$upload_final_files.'</label>
									<p class="text-info">'.$maximum_file_upload_size_5mb.'</p>
							</div>
                            <div class="col-sm-4">
                                    <a href="javascript:void(0)" class="order-status btn btn-primary" onclick="upload_product()">'.$upload.'</a>
                                    <form action="'.base_url().'user/sales/my_upload_file" method="post" enctype="multipart/form-data" id="product_upload_form" >
                                    <input class="form-control" type="file" name="product_upload" id="product_upload" style="display:none"  >
                                    <input type="hidden" name="gig_id" value="'.$pay_data['gigs_id'].'">
                                    <input type="hidden" name="order_id" value="'.$pay_data['id'].'">
                                    <input type="hidden" name="seller_id" value="'.$pay_data['seller_id'].'">
                                    <input type="hidden" name="buyer_id" value="'.$pay_data['USERID'].'">
                                    </form>
                            </div>
                            </div>
                        </div>';
                        if(!empty($upload_files)){
                        	
                        	$base_url = base_url();

                    $html_table_header .= '<ul class="files-list">';
                        	
                      foreach ($upload_files as $files) {

						$size = $files['file_size'];
                      	$base = log($size) / log(1024);
                      	if($base < 0){
                      		$base = 0;
                      	}
  						$suffix = array( "KB", "MB", "GB", "TB");
  						$f_base = floor($base);
						$size =  round(pow(1024, $base - floor($base)), 1) . $suffix[$f_base];

						$db_timezone   = $files['time_zone'];
						$db_time       = $files['added_on']; 
						$user_timezone =  $this->session->userdata('time_zone');	

						date_default_timezone_set($db_timezone);
						$originalTime = new DateTime($db_time);
						$originalTime->setTimeZone(new DateTimeZone($user_timezone)); 
						date_default_timezone_set($user_timezone) ; 
						$times = $originalTime->format('M jS \a\t h:i:s A');

						$download = (!empty($this->user_language[$this->user_selected]['lg_download']))?$this->user_language[$this->user_selected]['lg_download']:$this->default_language['en']['lg_download']; 


					$html_table_header .= '
                        <li>
                            <div class="files-cont">
                                <div class="file-type">
                                    <span class="files-icon"><i class="fa fa-file-zip-o"></i></span>
                                </div>
                                <div class="files-info">
                                    <span class="file-name text-ellipsis"><a href="javascript:void(0)">'.$files['filename'].'</a></span>
                                    <span class="file-author"><a href="javascript:void(0)">'.ucwords($files['username']).'</a></span> <span class="file-date">'.$times.'</span>
                                    <div class="file-size">Size: '.$size.'</div>
                                </div>
                               <a href="'.$base_url.'uploads/digital/'.$files['filename'].'" download class="btn btn-primary btn-border btn-sm files-download">'.$download.'</a>
                            </div>
							<a href="javascript:void(0)" data-url="'.$base_url.'fileremove?id='.base64_encode($files['id']).'" onclick="remove_details(this)" class="files-delete" title="Delete File"><i class="fa fa-close"></i></a>
                        </li>';
                  }  	

          $html_table_header .= '</ul>';         

                  	}
              }    	

              $item = (!empty($this->user_language[$this->user_selected]['lg_item']))?$this->user_language[$this->user_selected]['lg_item']:$this->default_language['en']['lg_item'];

						$product_name = (!empty($this->user_language[$this->user_selected]['lg_product_name']))?$this->user_language[$this->user_selected]['lg_product_name']:$this->default_language['en']['lg_product_name'];

						$quantity = (!empty($this->user_language[$this->user_selected]['lg_quantity']))?$this->user_language[$this->user_selected]['lg_quantity']:$this->default_language['en']['lg_quantity'];

						$to_tal = (!empty($this->user_language[$this->user_selected]['lg_total']))?$this->user_language[$this->user_selected]['lg_total']:$this->default_language['en']['lg_total']; 

	$html_table_header .= '<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>'.$item.'</th>
									<th>'.$product_name.'</th>
									<th>'.$quantity.'</th>
									<th class="text-right">'.$to_tal.'</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$image_url.'" width="50" height="34" alt="'.$pay_data['title'].'"></td>
									<td>
										<a class="product_name text-ellipsis" href="'.$gig_link.'">'.str_replace("-"," ",ucfirst($pay_data['title'])).'</a>
									</td>
									<td class="text-center"> 1 </td>
									<td class="total text-right">'.$rate_symbol.$gig_rate.'</td>
								</tr>';

						$html_table_contents = '';
									if(!empty($extra_gig_result))
									{	
									$rupee_rate  = $this->session->userdata('rupee_rate');
									$dollar_rate = $this->session->userdata('dollar_rate');				
									foreach($extra_gig_result as $extras)
									{		
									$decoded_extras = 	json_decode($extras['options']);
									$gig_values =  explode('___',$decoded_extras);	
									$currency_type = $gig_values[3];
 
									$currency_option = (!empty($pay_data['currency_type']))?$pay_data['currency_type']:'USD';
									$rate_symbol = currency_sign($currency_option); 
									$rate = $gig_values[2];
								//$rate =$this->data['extra_gig_price'];
								  
								//$total = $pay_data['item_amount'];
								$total = $pay_data['item_amount'];
								 
								
									$html_table_contents .= '<tr>
									<td> &nbsp; </td>
									<td><span class="text-ellipsis">'.$gig_values[0].'</span></td>	
									<td class="text-center">'.$gig_values[1].'</td>
									<td class="total text-right">'.$rate_symbol.$rate.'</td>
								</tr>' ;	   	 	
									}
									}	
									else
									{
										 
										$total = $pay_data['item_amount'];
										 
									}
									
		if($pay_data['payment_super_fast_delivery']==0)
		{
			$super_fast_delivery_desc = $pay_data['super_fast_delivery_desc'] ;
			if(empty($super_fast_delivery_desc))
			{
				$super_fast_delivery_desc = 'Super fast delivery';
			}
		 
			 
				$currency_option = (!empty($pay_data['currency_type']))?$pay_data['currency_type']:'USD';
									$rate_symbol = currency_sign($currency_option); 
			//$super_fast_delivery_charge = $pay_data['extra_gig_indian_rupee'];
			//$super_fast_delivery_charge= $pay_data['extra_gig_indian_rupee'];
			$super_fast_delivery_charge=$pay_data['extra_gig_dollar'];

			$super_fast = (!empty($this->user_language[$this->user_selected]['lg_super_fast']))?$this->user_language[$this->user_selected]['lg_super_fast']:$this->default_language['en']['lg_super_fast']; 
			 
			$html_table_contents .= '<tr>
									<td> <span class="super-fast">'.$super_fast.'</span> </td>
									<td><span class="text-ellipsis">'.$super_fast_delivery_desc.'</span></td>	
									<td class="text-center">1</td>
									<td class="total text-right">'.$rate_symbol.$super_fast_delivery_charge.'</td>
								</tr>' ;
		}


		$grand_total = (!empty($this->user_language[$this->user_selected]['lg_grand_total']))?$this->user_language[$this->user_selected]['lg_grand_total']:$this->default_language['en']['lg_grand_total'];

						$buyer_details = (!empty($this->user_language[$this->user_selected]['lg_buyer_details']))?$this->user_language[$this->user_selected]['lg_buyer_details']:$this->default_language['en']['lg_buyer_details'];

						$from = (!empty($this->user_language[$this->user_selected]['lg_from']))?$this->user_language[$this->user_selected]['lg_from']:$this->default_language['en']['lg_from'];

						$contact = (!empty($this->user_language[$this->user_selected]['lg_contact']))?$this->user_language[$this->user_selected]['lg_contact']:$this->default_language['en']['lg_contact'];
															
								
						$html_table_footer =	'</tbody>
							<tfoot>								 
								<tr>
									<td></td>
									<td class="grand-total" colspan="2">'.$grand_total.'</td>
									<td class="grand-total text-right">'.$rate_symbol.$total.'</td>
								</tr>
							</tfoot>
						</table>
					</div>
					</div>
					<div class="modal-footer text-left">
						<h3 class="order-title">'.$buyer_details.'</h3>
						<div class="media secure-money">
							<div class="media-left">
								<a href="'.$user_link_one.'"><img width="50" height="50" src="'.$user_image_url.'" class="img-circle" alt="'.$pay_data['fullname'].'"></a>
							</div>
							<div class="media-body">
								<div class="user-details">
								<div class="user-name-block">
									<a href="'.$user_link_one.'" class="user-name">'.$pay_data['fullname'].'</a>
								</div>
								<div class="user-contact">
									<ul class="list-inline">
										<li class="user-rating feedback-area">
											<script type="text/javascript" src="'.base_url().'assets/js/rating.js"></script>
											<span id="stars-existing" class="starrr" data-rating="'.$rat.'"></span>
										</li>
										<li class="user-country2"><b>'.$from.':</b> '.$pay_data['country'].' <span class="ppcn country '.$pay_data['sortname'].'"></li>
										<li class="contact-list"><a href="javascript:;" class="btn btn-primary btn-sm btn-border" onclick="message_contact_user();">'.$contact.'</a></li>
										<input type="hidden" name="sb_user_id" id="sb_user_id" value="'.$pay_data['USERID'].'">
									</ul>
								</div>
							</div>
							</div>
						</div>
					</div>';
					//<li class="contact-list"><a href="#" class="btn btn-primary btn-sm btn-border" data-toggle="modal" data-target="#message-popup">Contact</a></li>
					 $html = $html_table_header.$html_table_contents.$html_table_footer;
					echo json_encode( array('content'=>$html,'status'=>1));
		}
	}

public function get_sales_details_files()
	{
		if($this->input->post()){

		$id=$this->input->post('id');
		
		$pay_data = $this->payment_model->get_salespayment_details($id);
		$uid = '';
		if (!($this->session->userdata('SESSION_USER_ID'))) {	 }else{

			$uid = $this->session->userdata('SESSION_USER_ID');
		}

		$upload_files  = $this->payment_model->get_upload_files($id,$uid);

		$html_table_header = '';

		if (isset($pay_data['created_at'])) {
			if (!empty($pay_data['created_at']) && $pay_data['created_at'] != "0000-00-00 00:00:00") {
				$created_on = date('M j, Y g:i A', strtotime($pay_data['created_at']));
			}
		}
			  
 		 
            if(!empty($upload_files)){
            	
            	$base_url = base_url();

            	 $file_details = (!empty($this->user_language[$this->user_selected]['lg_file_details']))?$this->user_language[$this->user_selected]['lg_file_details']:$this->default_language['en']['lg_file_details']; 

        $html_table_header .= '<button type="button" class="close" data-dismiss="modal">&times;</button>
		<div class="modal-header text-center">
			<h5>'. $file_details .'</h5>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-6">
					<h5 class="order-number">#'.$pay_data['paypal_uid'].'</h5>
					<h5 class="order-date">'.$created_on.'</h5>
				</div>
				 
			</div><ul class="files-list">';
                        	
                      foreach ($upload_files as $files) {

						$size = $files['file_size'];
                      	$base = log($size) / log(1024);
  						$suffix = array( "KB", "MB", "GB", "TB");
  						if($base<0){
  							$base = 0;
  						}
  						$f_base = floor($base);
  						$index = (!empty($suffix[$f_base]))?$suffix[$f_base]:'';
  						$size =  round(pow(1024, $base - floor($base)), 1) . $index;

						$db_timezone   = $files['time_zone'];
						$db_time       = $files['added_on']; 
						$user_timezone =  $this->session->userdata('time_zone');	

						date_default_timezone_set($db_timezone);
						$originalTime = new DateTime($db_time);
						$originalTime->setTimeZone(new DateTimeZone($user_timezone)); 
						date_default_timezone_set($user_timezone) ; 
						$times = $originalTime->format('M jS \a\t h:i:s A'); 

						$download = (!empty($this->user_language[$this->user_selected]['lg_download']))?$this->user_language[$this->user_selected]['lg_download']:$this->default_language['en']['lg_download'];


					$html_table_header .= '
                        <li>
                            <div class="files-cont">
                                <div class="file-type">
                                    <span class="files-icon"><i class="fa fa-file-zip-o"></i></span>
                                </div>
                                <div class="files-info">
                                    <span class="file-name text-ellipsis"><a href="javascript:void(0)">'.$files['filename'].'</a></span>
                                    <span class="file-author"><a href="javascript:void(0)">'.ucwords($files['username']).'</a></span> <span class="file-date">'.$times.'</span>
                                    <div class="file-size">Size: '.$size.'</div>
                                </div>
                               <a href="'.$base_url.'uploads/digital/'.$files['filename'].'" download class="btn btn-primary btn-border btn-sm files-download">'.$download.'</a>
                            </div>
                            <a href="javascript:void(0)" data-url="'.$base_url.'fileremove?id='.base64_encode($files['id']).'" onclick="remove_details(this)" class="files-delete" title="Delete File"><i class="fa fa-close"></i></a>
                        </li>';
                  }  	

          $html_table_header .= '</ul>';         

                  	}else{

                  		$no_details_found = (!empty($this->user_language[$this->user_selected]['lg_no_details_found']))?$this->user_language[$this->user_selected]['lg_no_details_found']:$this->default_language['en']['lg_no_details_found']; 
                  		$html_table_header .= $no_details_found ;
                  	}
                  	 
					 $html = $html_table_header;
					echo json_encode( array('content'=>$html,'status'=>1));
		}
	}

	public function accept_buyer_request()
	{
		$p_id  = $this->input->post('p_id');
		$data_up['cancel_accept'] = 1;
		$data_up['notification_status'] = 1;
		$from_timezone = $this->session->userdata('time_zone');
		date_default_timezone_set($from_timezone); 
		$current_time= date('Y-m-d H:i:s');
		$data_up['update_date'] = $current_time;
		
		if($this->db->update('payments',$data_up,array('id'=>$p_id)))
		{
			$query = $this->db->query("SELECT sg.title,m.fullname as buyername,m.username as buyerusername, m.email as buyeremail, sm.fullname as sellername,sm.username as sellerusername,py.USERID as gbid,py.seller_id as gsid FROM `payments` as py
					LEFT JOIN sell_gigs as sg ON sg.id = py.gigs_id	
					LEFT JOIN members as m ON m.USERID = py.USERID
					LEFT JOIN members as sm ON sm.USERID = py.seller_id
					WHERE py.`id` = $p_id");
			$data_one = $query->row_array();
			$title= $data_one['title'];
			$to_email= $data_one['buyeremail'];
				$bodyid = 27;
				$tempbody_details= $this->templates_model->get_usertemplate_data($bodyid);
				$body=$tempbody_details['template_content'];
				$message='';
				$gig_preview_link  = base_url().'gig-preview/'.$title ;
				$purchase_link  = base_url().'purchases/' ;
				$body = str_replace('{base_url}', $this->base_domain, $body);
				$body = str_replace('{base_image}',$this->base_domain.'/'.$this->logo_front, $body);
				$body = str_replace('{gig_preview_link}', $gig_preview_link, $body);	
				$body = str_replace('{purchase_link}', $purchase_link, $body);	
                $body = str_replace('{site_name}',$this->site_name, $body);					
				$body = str_replace('{buyer_name}', $data_one['buyername'], $body);
				$body = str_replace('{gig_owner}', $data_one['sellername'], $body);
				$body = str_replace('{title}',str_replace("-"," ",$title), $body);
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
				$this->email->subject('Your Cancel Request Accepted from '.$data_one['sellername']);
				$this->email->message($message);
				$this->email->send();
	
			  $cancelmessage = 'Your Cancel Request Accepted from '.$data_one['sellername'];
			  $gbid = $data_one['gbid'];
			  $this->gigs->order_status_notification($gbid,$title,$cancelmessage);

			echo 1;
		}
		else
		{
			echo 2;
		}
	}


	public function generate_reports()
	{
		if($_POST['form_submit']=='pdf')
		{
		
		$this->data['order_data']=$this->payment_model->get_selluser_details($this->session->userdata('SESSION_USER_ID'),2,0,0);
        $html=$this->load->view('user/modules/pdf/sales_pdf',$this->data,TRUE);
        $pdfFilePath = "Gigs Sales Reports-".date('d/m/Y').".pdf";
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($pdfFilePath, "D"); 

		}

		

	}
}
?>