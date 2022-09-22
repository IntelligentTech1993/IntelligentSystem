<div class="msg-section">
            <input type="hidden" name="message_page" id="message_page" value="true"  />
            <?php  //$this->load->view('user/includes/search_include'); ?>
            <section class="profile-section">
                <div class="container">
                    <div class="row">   
                        <div class="col-md-12">
                            <ol class="breadcrumb menu-breadcrumb">
                                <li><a href="<?php echo base_url(); ?>"><?php echo (!empty($user_language[$user_selected]['lg_home']))?$user_language[$user_selected]['lg_home']:$default_language['en']['lg_home']; ?></a> <i class="fa fa fa-chevron-right"></i></li>
                                <li class="active"><?php echo (!empty($user_language[$user_selected]['lg_my_profile']))?$user_language[$user_selected]['lg_my_profile']:$default_language['en']['lg_my_profile']; ?></li>        
                            </ol>
                        </div>
                    </div>
                    <div class="row">   
                        <div class="col-md-12">
                            <h3 class="page-title"><?php echo (!empty($user_language[$user_selected]['lg_my_messages']))?$user_language[$user_selected]['lg_my_messages']:$default_language['en']['lg_my_messages']; ?></h3>
                        </div>
                    </div>
                </div>
            </section>
            <div class="tab-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-list">
                                <ul>
                                    <li class="active"><a href="#"><?php echo (!empty($user_language[$user_selected]['lg_inbox']))?$user_language[$user_selected]['lg_inbox']:$default_language['en']['lg_inbox']; ?></a></li>
                                </ul>    
                            </div>      
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="container">
                    <div class="row">
                     <?php 
                       if(!empty($chat_list)) {  ?>
                        <div class="col-sm-4 message-user" id="message_user">
                            <a href="#" id="close_btn"><i class="fa fa-close"></i></a>
                            <div id="msglist" class="list-group msg-list student_chat_list">
                            <?php 
                            if(!empty($chat_list)) {                                
                                
                            $chatuser_det = $chat_list['details'];
                            
                                foreach ($chatuser_det as $key => $result) {
                                    $image_url='assets/images/avatar2.jpg';                                                                         
                                    if($result['profile_image']!=''){
                                        $image_url =$result['profile_image'];
                                    }
                                ?>
                                <a href="javascript:;" id="active_user_<?php echo $result['user_id']; ?>" chat_id="<?php echo $result['user_id']; ?>" chat_type="1" tz="<?php echo $result['timezone']; ?>" class="list-group-item " onClick="email_list_active(this,<?php echo $result['user_id']; ?>,'<?php echo $result['timezone']; ?>'); chat_details(<?php echo $result['user_id']; ?>);">
                                    <img src="<?php echo base_url().$image_url;?>" class="pull-left w-40 m-r img-circle" alt="">
                                    <div class="clear">
                                        <span class="msg-user-name"><?php echo $result['firstname'] ?></span>
                                        <span id="chat_list_id<?php echo $result['user_id']; ?>">
                                        <?php
                                        $msg ='';
                                        $tme='';
                                        $me='' ; 

                                        $you_sent_an_attachment = (!empty($user_language[$user_selected]['lg_you_sent_an_attachment']))?$user_language[$user_selected]['lg_you_sent_an_attachment']:$default_language['en']['lg_you_sent_an_attachment'];

                                        $you_received_an_attachment = (!empty($user_language[$user_selected]['lg_you_received_an_attachment']))?$user_language[$user_selected]['lg_you_received_an_attachment']:$default_language['en']['lg_you_received_an_attachment'];

                                        $you = (!empty($user_language[$user_selected]['lg_you']))?$user_language[$user_selected]['lg_you']:$default_language['en']['lg_you'];

                                        $days_ago = (!empty($user_language[$user_selected]['lg_days_ago']))?$user_language[$user_selected]['lg_days_ago']:$default_language['en']['lg_days_ago'];


                                            $querys = $this->db->query("SELECT * FROM chats WHERE id =".$result['chat_id']);
                                            $user_last = $querys->row_array();
                                            
                                            if($user_last){
                                                
                                                    if($user_last['chat_from']==$this->session->userdata('SESSION_USER_ID')){ $me=$you.' '.':';}
                                                    $date       = new DateTime();
                                                    $match_date = new DateTime($user_last['date_time']);
                                                    $interval   = $date->diff($match_date);
                                                    if($interval->days == 0)
                                                    {
                                                        if($user_last['chat_from']==$this->session->userdata('SESSION_USER_ID'))
                                                        {
                                                         $tme = date(' h:i A',strtotime($user_last['chat_from_time']));
                                                        }
                                                        else
                                                        {
                                                            $tme = date(' h:i A',strtotime($user_last['chat_to_time']));
                                                        }
                                                    }
                                                    else 
                                                    { 
                                                        $tme = $interval->days.' '.$days_ago;
                                                    }
                                            if(!empty($user_last['content'])){ 
                                                    //$msg = substr($user_last['content'], 0, 15);  
                                                    $msg = $user_last['content'];
                                            }
                                            else
                                            {
                                                if($user_last['chat_from']==$this->session->userdata('SESSION_USER_ID')){ 
                                                $strpath=explode("/",$user_last['file_path']);
                                                $strpathone=strtolower(end($strpath));  

                                                $me= $you.' '.':';

                                                $msg = $you_sent_an_attachment;
                                                }
                                                else
                                                {
                                                    $msg = $you_received_an_attachment;
                                                }
                                            }
                                            ?>
                                            <span class="time-text pull-right"><?php echo $tme; ?></span><span class="clear text-ellipsis text-xs msg-text"><?php echo  $me. $msg ;?></span>
                                            <?php   
                                            }else
                                            {  
                                                ?>
                                                <span class="time-text pull-right"> </span><span class="clear text-ellipsis text-xs msg-text"><?php echo (!empty($user_language[$user_selected]['lg_no_message']))?$user_language[$user_selected]['lg_no_message']:$default_language['en']['lg_no_message']; ?></span>
                                                <?php
                                            }
                                        ?>
                                        </span>
                                    </div>
                                </a>
                            <?php } } else { ?><p> <?php echo (!empty($user_language[$user_selected]['lg_no_chats']))?$user_language[$user_selected]['lg_no_chats']:$default_language['en']['lg_no_chats']; ?>  </p> <?php } ?>
                                
                            </div>
                        </div>
                        <div class="col-sm-4 mobile-chat">
                            <a id="chat_btn" href="#">
                                <span class="btn btn-sm btn-primary">
                                    <i class="fa fa-list"></i> <?php echo (!empty($user_language[$user_selected]['lg_chats_list']))?$user_language[$user_selected]['lg_chats_list']:$default_language['en']['lg_chats_list']; ?>
                                </span>
                            </a>
                        </div>
                        <div class="col-sm-8 chat-contents">
                            <div class="panel m-b-0">
                                <div class="panel-heading" id="headuser_details_set"> </div>
                                <div class="panel-body">
                                    <div id="chat-box" class="chat-box slimscrollleft">
                                        <div class="chats" id="chat_details_appnd"></div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    
                                    <form  name="chat_form" action="" method="post" id="form_content_id"  enctype="multipart/form-data" onSubmit="return save_chat();">
                                        <div class="message-bar">
                                            <div class="message-inner">
                                                <input name="new_message_image[]" id="new_message_image" type="file" style="display:none" size="2000000" >
                                                <a class="link icon-only" href="javascript:;"  title="<?php echo (!empty($user_language[$user_selected]['lg_click_to_upload_images']))?$user_language[$user_selected]['lg_click_to_upload_images']:$default_language['en']['lg_click_to_upload_images']; ?>" onclick="$('#new_message_image').focus().trigger('click');"><i class="fa fa-paperclip"></i></a>
                                                <input type="hidden" name="active_chat_id" id="active_chat_id" value="" />
                                                <input type="hidden" name="temp_chat_data" id="temp_chat_data" value="0" />
                                                <input type="hidden" name="temp_chat_tz" id="temp_chat_tz" value="" />
                                                <div class="message-area">
                                                    <input type="text" name="chat_message_content" id="chat_message_content" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_write_message']))?$user_language[$user_selected]['lg_write_message']:$default_language['en']['lg_write_message']; ?>..." class="form-control msg-type" >
                                                </div>
                                                <a class="link" href="javascript:void(0);"><button><i class="fa fa-paper-plane"></button></i></a> 
                                            </div>
                                        </div>
                                        <div class="progress msg-progress" style="display:none">
                                            <div class="progress-bar progress-bar-striped active progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%"></div>
                                        </div>
                                        <div  id="new_status_attaches"> </div>
                                  </form>
                                    
                                    
                                </div>
                            </div>
                        </div>
                        <?php } else {?>
                        <div class="col-sm-12"> <p class="text-center"> <?php echo (!empty($user_language[$user_selected]['lg_sorry']))?$user_language[$user_selected]['lg_sorry']:$default_language['en']['lg_sorry']; ?> ! <?php echo (!empty($user_language[$user_selected]['lg_no_messages']))?$user_language[$user_selected]['lg_no_messages']:$default_language['en']['lg_no_messages']; ?> </p></div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>