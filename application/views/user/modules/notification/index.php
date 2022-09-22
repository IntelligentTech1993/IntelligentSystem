<div class="notification-section">
            <div class="tab-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="list-group notify-list">
                                                            
                                <?php 
                                if(!empty($list)) {
                               // $image  = base_url().'assets/images/avatar2.jpg';
                                $time_zone = $this->session->userdata('time_zone');
                                date_default_timezone_set($time_zone);
                                foreach($list as $notifications)
                                {   
                            
                                $db_time =  $notifications['created_date'];
                                        $db_timezone = $notifications['time_zone'];
                                        /* $time_taken = $this->notification_model->mylastupdate($db_time,$db_timezone,$time_zone); */
                                    
         
                                                      $date = new DateTime($notifications['created_date']);
                                                       // $date->setTimezone(new DateTimeZone($time_zone));                                                        
                                                        $time = date($notifications['created_date']);                                                        
                                                       //echo "posted time :" .$time ;
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
                            $time_taken = (!empty($this->user_language[$this->user_selected]['lg_just_now']))?$this->user_language[$this->user_selected]['lg_just_now']:$this->default_language['en']['lg_just_now'];
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
                         $time_taken =  $total_seconds == 1 ? $total_seconds . $months_ago : $total_seconds . $months_ago;
                    }   

                    $years_ago = (!empty($this->user_language[$this->user_selected]['lg_years_ago']))?$this->user_language[$this->user_selected]['lg_years_ago']:$this->default_language['en']['lg_years_ago'];
                
                    if ($total_seconds >= $intervals['year'])
                    {
                        $total_seconds = floor($total_seconds/$intervals['year']);
                         $time_taken =  $total_seconds == 1 ? $total_seconds .' '. $years_ago : $total_seconds .' '. $years_ago;
                    }    
            
            $username = $notifications['buyer_username'];
            $name = ucfirst($notifications['buyer_name']);
            $title = ucfirst($notifications['title']);
            $status = '';
            if(!empty($notifications['buyer_img']))
            {
             $image = $notifications['buyer_img'];    
            }else{
                $image = base_url().'assets/images/avatar2.jpg';
            }
            if($notifications['status']=='completed')
            {      
                 $data = array('notification_status'=>0);
                $this->db->where('id',$notifications['id']);
                $this->db->update('payments',$data);

                $has_completed_the_gig = (!empty($this->user_language[$this->user_selected]['lg_has_completed_the_gig']))?$this->user_language[$this->user_selected]['lg_has_completed_the_gig']:$this->default_language['en']['lg_has_completed_the_gig'];
                
                 $html = '<li id="remove_payments_'.$notifications['id'].'" class="list-group-item">
                    <a href="'.base_url().'purchases" class="notify-content">                            
                    <img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
                    <strong>'.ucfirst($username).'</strong> <span class="grey-text">'.$has_completed_the_gig.'</span> <strong>'.str_replace("-"," ",$title).'</strong>   
                    <span class="time">- '.$time_taken.' </span>
                    </a>
                    <span title="Delete" class="noti-close"><i class="fa fa-times" onclick = "hide_notification(\'payments\','.$notifications['id'].')" ></i></span>
                    </li>';   
                
                 echo $html;
            
            }
             elseif ($notifications['status']=='completedrequest') 
            {
                $data = array('notification_status'=>0);
                $this->db->where('id',$notifications['id']);
                $this->db->update('payments',$data);

                $request_a_order_complete = (!empty($this->user_language[$this->user_selected]['lg_request_a_order_complete']))?$this->user_language[$this->user_selected]['lg_request_a_order_complete']:$this->default_language['en']['lg_request_a_order_complete'];
                 
                $html = '<li id="remove_payments_'.$notifications['id'].'" class="list-group-item">
                    <a href="'.base_url().'purchases" class="notify-content">                            
                    <img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
                    <strong>'.ucfirst($name).'</strong> <span class="grey-text">  '.$request_a_order_complete.' </span> <strong>'.ucfirst(str_replace("-"," ",$title)).'</strong>  
                    <span class="time">- '.$time_taken.' </span>
                    </a>
                    <span title="Delete" class="noti-close"><i class="fa fa-times" onclick = "hide_notification(\'payments\','.$notifications['id'].')" ></i></span>
                    </li>';      
                
                echo $html;
                
                 
            }
            elseif ($notifications['status']=='complete-request-accept') 
            {
                $data = array('notification_status'=>0);
                $this->db->where('id',$notifications['id']);
                $this->db->update('payments',$data);

                $complete_request_accepted = (!empty($this->user_language[$this->user_selected]['lg_complete_request_accepted']))?$this->user_language[$this->user_selected]['lg_complete_request_accepted']:$this->default_language['en']['lg_complete_request_accepted'];
                 
                $html = '<li id="remove_payments_'.$notifications['id'].'" class="list-group-item">
                    <a href="'.base_url().'sales" class="notify-content">                            
                    <img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
                    <strong>'.ucfirst($name).'</strong> <span class="grey-text">  '.$complete_request_accepted.' </span> <strong>'.ucfirst(str_replace("-"," ",$title)).'</strong>  
                    <span class="time">- '.$time_taken.' </span>
                    </a>
                    <span title="Delete" class="noti-close"><i class="fa fa-times" onclick = "hide_notification(\'payments\','.$notifications['id'].')" ></i></span>
                    </li>';      
                
                echo $html;
                
                 
            }
            elseif ($notifications['status']=='buyed') 
            {
                $data = array('notification_status'=>0);
                $this->db->where('id',$notifications['id']);
                $this->db->update('payments',$data);

                 $purchased_your_gigs = (!empty($this->user_language[$this->user_selected]['lg_purchased_your_gigs']))?$this->user_language[$this->user_selected]['lg_purchased_your_gigs']:$this->default_language['en']['lg_purchased_your_gigs'];
                 
                $html = '<li id="remove_payments_'.$notifications['id'].'" class="list-group-item">
                    <a href="'.base_url().'sales" class="notify-content">                            
                    <img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
                    <strong>'.ucfirst($name).'</strong> <span class="grey-text"> '.$purchased_your_gigs.' </span> <strong>'.ucfirst(str_replace("-"," ",$title)).'</strong>  
                    <span class="time">- '.$time_taken.' </span>
                    </a>
                    <span title="Delete" class="noti-close"><i class="fa fa-times" onclick = "hide_notification(\'payments\','.$notifications['id'].')" ></i></span>
                    </li>';      
                
                echo $html;
                
                 
            }
            elseif ($notifications['status']=='own_buying') 
            {
                 $data = array('notification_status'=>0);
                $this->db->where('id',$notifications['id']);
                $this->db->update('payments',$data);

                $you_have_made_a_purchase_on_a_gig = (!empty($this->user_language[$this->user_selected]['lg_you_have_made_a_purchase_on_a_gig']))?$this->user_language[$this->user_selected]['lg_you_have_made_a_purchase_on_a_gig']:$this->default_language['en']['lg_you_have_made_a_purchase_on_a_gig'];
                 
                $html = '<li id="remove_payments_'.$notifications['id'].'" class="list-group-item">                    
                    <a href="'.base_url().'purchases" class="notify-content">                            
                    <img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
                     <span class="grey-text">'.$you_have_made_a_purchase_on_a_gig.' <strong>'.ucfirst(str_replace("-"," ",$title)).'</strong>   from </span> <strong>'.ucfirst($name).'</strong>    
                    <span class="time">- '.$time_taken.' </span>
                    </a>
                    <span title="Delete" class="noti-close"><i class="fa fa-times" onclick = "hide_notification(\'payments\','.$notifications['id'].')"></i></span>
                    </li>';      
                
                echo $html;
                
                 
            }
            elseif ($notifications['status']=='admin_payment') 
            {

                $the_admin_has_released_payment_for_gig = (!empty($this->user_language[$this->user_selected]['lg_the_admin_has_released_payment_for_gig']))?$this->user_language[$this->user_selected]['lg_the_admin_has_released_payment_for_gig']:$this->default_language['en']['lg_the_admin_has_released_payment_for_gig'];


                 $html = '<li class="list-group-item">
                    <a href="'.base_url().'payments" class="notify-content">                            
                    <img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
                    <strong>'.ucfirst($username).'</strong> <span class="grey-text"> '.$the_admin_has_released_payment_for_gig.' </span> <strong>'.ucfirst(str_replace("-"," ",$title)).'</strong>   
                    <span class="time">- '.$time_taken.' </span>
                    </a>
                    <span title="Delete" class="noti-close"><i class="fa fa-times" onclick = "hide_notification()" ></i></span>
                    </li>';   
                      echo $html;
            }
            elseif ($notifications['status']=='to_user')   
            {
                $data = array('notification_status'=>0);
                $this->db->where('id',$notifications['id']);
                $this->db->update('feedback',$data);

                $given_reply_feedback_on = (!empty($this->user_language[$this->user_selected]['lg_given_reply_feedback_on']))?$this->user_language[$this->user_selected]['lg_given_reply_feedback_on']:$this->default_language['en']['lg_given_reply_feedback_on'];


                $html = '<li id="remove_feedback_'.$notifications['id'].'" class="list-group-item">
                    <a href="'.base_url().'purchases" class="notify-content">                            
                    <img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">                        
                    <strong>'.ucfirst($name).'</strong> '.$given_reply_feedback_on.' </span> <strong>'.ucfirst(str_replace("-"," ",$title)).'</strong>   
                    <span class="time">- '.$time_taken.' </span>
                    </a>
                    <span title="Delete" class="noti-close"><i class="fa fa-times" onclick = "hide_notification(\'feedback\','.$notifications['id'].')" ></i></span>
                    </li>';   
                
                 echo $html; 
            }
            elseif ($notifications['status']=='from_user')   
            {
                $id=$notifications['id'];
                $query = $this->db->query("SELECT sent_recieved FROM `feedback` WHERE `id` = $id " );
                $notificationsdata = $query->row_array();
                 $data = array('notification_status'=>0);
                $this->db->where('id',$notifications['id']);
                $this->db->update('feedback',$data);
                $s1=$notificationsdata['sent_recieved'];
                if($s1==1){
                    $rep='reply';
                }else
                {
                    $rep='';
                }

                $given = (!empty($this->user_language[$this->user_selected]['lg_given']))?$this->user_language[$this->user_selected]['lg_given']:$this->default_language['en']['lg_given'];

                $feedback_on = (!empty($this->user_language[$this->user_selected]['lg_feedback_on']))?$this->user_language[$this->user_selected]['lg_feedback_on']:$this->default_language['en']['lg_feedback_on'];

                $html = '<li id="remove_feedback_'.$notifications['id'].'" class="list-group-item">
                    <a href="'.base_url().'sales" class="notify-content">                            
                    <img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">                    
                    <strong>'.ucfirst($name).'</strong> '.$given.' '.$rep.' '.$feedback_on.'  </span> <strong>'.ucfirst(str_replace("-"," ",$title)).'</strong>   
                    <span class="time">- '.$time_taken.' </span>
                    </a>
                    <span title="Delete" class="noti-close"><i class="fa fa-times" onclick = "hide_notification(\'feedback\','.$notifications['id'].')" ></i></span>
                    </li>';   
                
                 echo $html; 
            }
            elseif ($notifications['status']=='payment_release') 
            {
                 $data = array('notification_paycomplete'=>0);
                $this->db->where('id',$notifications['id']);
                $this->db->update('payments',$data);

                $admin_released_payment_for_a_completed_gig = (!empty($this->user_language[$this->user_selected]['lg_admin_released_payment_for_a_completed_gig']))?$this->user_language[$this->user_selected]['lg_admin_released_payment_for_a_completed_gig']:$this->default_language['en']['lg_admin_released_payment_for_a_completed_gig'];
                 
                $html = '<li id="remove_payments_'.$notifications['id'].'" class="list-group-item">                    
                    <a href="'.base_url().'gig-preview/'.$title.'" class="notify-content">                            
                    <img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
                     <span class="grey-text">'.$admin_released_payment_for_a_completed_gig.' <strong>'.ucfirst(str_replace("-"," ",$title)).'</strong>     </span>    
                    <span class="time">- '.$time_taken.' </span>
                    </a>
                    <span title="Delete" class="noti-close"><i class="fa fa-times" onclick = "hide_notification(\'payments\','.$notifications['id'].')"></i></span>
                    </li>';      
                
                echo $html;
                
                 
            }
             elseif ($notifications['status']=='buyer_cancel') 
            {
                 $data = array('cancel_notification_status'=>0);
                $this->db->where('id',$notifications['id']);
                $this->db->update('payments',$data);

                 $cancel_the_gigs_of = (!empty($this->user_language[$this->user_selected]['lg_cancel_the_gigs_of']))?$this->user_language[$this->user_selected]['lg_cancel_the_gigs_of']:$this->default_language['en']['lg_cancel_the_gigs_of'];
                 
                $html = '<li id="remove_payments_'.$notifications['id'].'" class="list-group-item">                    
                    <a href="'.base_url().'sales" class="notify-content">                            
                    <img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
                     <span class="grey-text"> <strong>'.ucfirst($name).'</strong> '.$cancel_the_gigs_of.' <strong>'.ucfirst(str_replace("-"," ",$title)).'</strong>    </span>    
                    <span class="time">- '.$time_taken.' </span>
                    </a>
                    <span title="Delete" class="noti-close"><i class="fa fa-times" onclick = "hide_notification(\'payments\','.$notifications['id'].')"></i></span>
                    </li>';      
                
                echo $html;
                
                 
            } 
             elseif ($notifications['status']=='seller_cancelled') 
            {
                 $data = array('cancel_notification_status'=>0);
                $this->db->where('id',$notifications['id']);
                $this->db->update('payments',$data);

                $has_accepted_the_cancel_request = (!empty($this->user_language[$this->user_selected]['lg_has_accepted_the_cancel_request']))?$this->user_language[$this->user_selected]['lg_has_accepted_the_cancel_request']:$this->default_language['en']['lg_has_accepted_the_cancel_request'];
                 
                $html = '<li id="remove_payments_'.$notifications['id'].'" class="list-group-item">                    
                    <a href="'.base_url().'purchases" class="notify-content">                            
                    <img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
                     <span class="grey-text"> <strong>'.ucfirst($name).'</strong>'.$has_accepted_the_cancel_request.' <strong>'.ucfirst(str_replace("-"," ",$title)).'</strong>    </span>    
                    <span class="time">- '.$time_taken.' </span>
                    </a>
                    <span title="Delete" class="noti-close"><i class="fa fa-times" onclick = "hide_notification(\'payments\','.$notifications['id'].')"></i></span>
                    </li>';      
                
                echo $html;
                
                 
            } 
             elseif ($notifications['status']=='buyer_accept_seller_declined') 
            {
                 $data = array('cancel_notification_status'=>0);
                $this->db->where('id',$notifications['id']);
                $this->db->update('payments',$data);

                $has_accepted_the_declined_request = (!empty($this->user_language[$this->user_selected]['lg_has_accepted_the_declined_request']))?$this->user_language[$this->user_selected]['lg_has_accepted_the_declined_request']:$this->default_language['en']['lg_has_accepted_the_declined_request'];
                 
                $html = '<li id="remove_payments_'.$notifications['id'].'" class="list-group-item">                    
                    <a href="'.base_url().'sales" class="notify-content">                            
                    <img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
                     <span class="grey-text"> <strong>'.ucfirst($name).'</strong> '.$has_accepted_the_declined_request.' <strong>'.ucfirst(str_replace("-"," ",$title)).'</strong>    </span>    
                    <span class="time">- '.$time_taken.' </span>
                    </a>
                    <span title="Delete" class="noti-close"><i class="fa fa-times" onclick = "hide_notification(\'payments\','.$notifications['id'].')"></i></span>
                    </li>';      
                
                echo $html;
                
                 
            }
            elseif ($notifications['status']=='seller_cancel') 
            {
                 $data = array('cancel_notification_status'=>0);
                $this->db->where('id',$notifications['id']);
                $this->db->update('payments',$data);

                $decline_the_gigs_of = (!empty($this->user_language[$this->user_selected]['lg_decline_the_gigs_of']))?$this->user_language[$this->user_selected]['lg_decline_the_gigs_of']:$this->default_language['en']['lg_decline_the_gigs_of'];
                 
                $html = '<li id="remove_payments_'.$notifications['id'].'" class="list-group-item">                    
                    <a href="'.base_url().'purchases" class="notify-content">                            
                    <img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
                     <span class="grey-text"> <strong>'.ucfirst($name).'</strong> '.$decline_the_gigs_of.' <strong>'.ucfirst(str_replace("-"," ",$title)).'</strong>    </span>    
                    <span class="time">- '.$time_taken.' </span>
                    </a>
                    <span title="Delete" class="noti-close"><i class="fa fa-times" onclick = "hide_notification(\'payments\','.$notifications['id'].')"></i></span>
                    </li>';      
                
                echo $html;
                
                 
            }
            elseif ($notifications['status']=='cancel_payment_received') 
            {
                 $data = array('notification_paycomplete'=>0);
                $this->db->where('id',$notifications['id']);
                $this->db->update('payments',$data);

                $admin_released_cancel_payment_for_a_gig = (!empty($this->user_language[$this->user_selected]['lg_admin_released_cancel_payment_for_a_gig']))?$this->user_language[$this->user_selected]['lg_admin_released_cancel_payment_for_a_gig']:$this->default_language['en']['lg_admin_released_cancel_payment_for_a_gig'];
                 
                $html = '<li id="remove_payments_'.$notifications['id'].'" class="list-group-item">                    
                    <a href="'.base_url().'gig-preview/'.$title.'" class="notify-content">                            
                    <img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
                     <span class="grey-text">'.$admin_released_cancel_payment_for_a_gig.' <strong>'.ucfirst(str_replace("-"," ",$title)).'</strong>     </span>    
                    <span class="time">- '.$time_taken.' </span>
                    </a>
                    <span title="Delete" class="noti-close"><i class="fa fa-times" onclick = "hide_notification(\'payments\','.$notifications['id'].')"></i></span>
                    </li>';      
                
                echo $html;
                
                 
            }
            elseif ($notifications['status']=='decline_payment_received') 
            {
                 $data = array('notification_paycomplete'=>0);
                $this->db->where('id',$notifications['id']);
                $this->db->update('payments',$data);

                $admin_released_decline_payment_for_a_gig = (!empty($this->user_language[$this->user_selected]['lg_admin_released_decline_payment_for_a_gig']))?$this->user_language[$this->user_selected]['lg_admin_released_decline_payment_for_a_gig']:$this->default_language['en']['lg_admin_released_decline_payment_for_a_gig'];
                 
                $html = '<li id="remove_payments_'.$notifications['id'].'" class="list-group-item">                    
                    <a href="'.base_url().'gig-preview/'.$title.'" class="notify-content">                            
                    <img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
                     <span class="grey-text">'.$admin_released_decline_payment_for_a_gig.' <strong>'.ucfirst(str_replace("-"," ",$title)).'</strong>     </span>    
                    <span class="time">- '.$time_taken.' </span>
                    </a>
                    <span title="Delete" class="noti-close"><i class="fa fa-times" onclick = "hide_notification(\'payments\','.$notifications['id'].')"></i></span>
                    </li>';      
                
                echo $html;
                
                 
            }
            elseif ($notifications['status']=='buyer_cancel_payment') 
            {
                 $data = array('notification_paycomplete'=>0);
                $this->db->where('id',$notifications['id']);
                $this->db->update('payments',$data);

                $admin_released_cancel_payment_for_a_gig = (!empty($this->user_language[$this->user_selected]['lg_admin_released_cancel_payment_for_a_gig']))?$this->user_language[$this->user_selected]['lg_admin_released_cancel_payment_for_a_gig']:$this->default_language['en']['lg_admin_released_cancel_payment_for_a_gig'];
                 
                $html = '<li id="remove_payments_'.$notifications['id'].'" class="list-group-item">                    
                    <a href="'.base_url().'purchases" class="notify-content">                            
                    <img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
                     <span class="grey-text">'. $admin_released_cancel_payment_for_a_gig.' <strong>'.ucfirst(str_replace("-"," ",$title)).'</strong>     </span>    
                    <span class="time">- '.$time_taken.' </span>
                    </a>
                    <span title="Delete" class="noti-close"><i class="fa fa-times" onclick = "hide_notification(\'payments\','.$notifications['id'].')"></i></span>
                    </li>';      
                
                echo $html;
                
                 
            }
            elseif ($notifications['status']=='buyer_decline_payment') 
            {
                 $data = array('notification_paycomplete'=>0);
                $this->db->where('id',$notifications['id']);
                $this->db->update('payments',$data);

                $admin_released_payment_for_a_gig = (!empty($this->user_language[$this->user_selected]['lg_admin_released_payment_for_a_gig']))?$this->user_language[$this->user_selected]['lg_admin_released_payment_for_a_gig']:$this->default_language['en']['lg_admin_released_payment_for_a_gig'];
                 
                $html = '<li id="remove_payments_'.$notifications['id'].'" class="list-group-item">                    
                    <a href="'.base_url().'purchases" class="notify-content">                            
                    <img width="32" class="img-circle" src="'.$image.'" alt="'.$username.'">
                     <span class="grey-text">'.$admin_released_payment_for_a_gig.' <strong>'.ucfirst(str_replace("-"," ",$title)).'</strong>     </span>    
                    <span class="time">- '.$time_taken.' </span>
                    </a>
                    <span title="Delete" class="noti-close"><i class="fa fa-times" onclick = "hide_notification(\'payments\','.$notifications['id'].')"></i></span>
                    </li>';      
                
                echo $html;
                
                 
            }
           
        }
    }  else { 
                
                $sorry = (!empty($this->user_language[$this->user_selected]['lg_sorry']))?$this->user_language[$this->user_selected]['lg_sorry']:$this->default_language['en']['lg_sorry'];

                $no_notifications = (!empty($this->user_language[$this->user_selected]['lg_no_notifications']))?$this->user_language[$this->user_selected]['lg_no_notifications']:$this->default_language['en']['lg_no_notifications'];

                 $html = '<li class="list-group-item">
                    <a href="javascript:;" class="notify-content">                                                                  
                    <p class="text-center m-b-0"> <strong>'.$sorry.' !</strong> '.$no_notifications.'</span></p>
                    </a>                    
                    </li>';   
                
                 echo $html;   
    } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>