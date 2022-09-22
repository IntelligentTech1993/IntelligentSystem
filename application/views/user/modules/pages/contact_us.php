<style type="text/css">

.app-footer img {
    max-width:95%;
}
   
.no-float {
   float:none !important;
}

.md-mb-32 {
   margin-bottom:32px;
}

.shadow-block {
   background:#fff;
   padding:32px;
   border:1px solid #b8b8b8;
   box-shadow:0 0 22px 5px rgba(0,
   0,
   0,
   0.05)
}
.address-info {
   margin-left:32px
}
.address-info a {
   color:#000
}
.address-info a:hover,
.address-info a:focus {
   color:#ff9c00
}
.address-info dl i {
   font-size:23px;
   background:#C9BEFD;
   -webkit-background-clip:text;
   -webkit-text-fill-color:transparent
}
.address-info .dl-horizontal dt {
   width:auto;
   margin-top:3px
}
.address-info .dl-horizontal dd {
   margin-left:32px
}
.address-info address p {
   font-size:16px;
   line-height:27px
}
.shadow-block .col-md-5 .address-info:nth-child(2n) dl i {
   font-size:20px
}
.shadow-block .col-md-5 .address-info:last-child dl i {
   font-size:18px
}
.contact-overlay {
   border-left:1px solid #d8d8d8
}
.contact-overlay .contact-registration .form-control {
   background:#ecf0f3;
   border:0 solid transparent;
   border-radius:32px;
   box-shadow:none;
   margin-bottom:23px;
   height:50px;
   line-height:1.42857;
   padding:6px 12px 6px 32px;
   width:100%
}
.contact-registration .form-control::-webkit-input-placeholder {
   color:#C9BEFD;
   font-size:16px
}
.contact-registration .form-control:-moz-placeholder {
   color:#C9BEFD;
   font-size:16px
}
.contact-registration .form-control::-moz-placeholder {
   color:#C9BEFD;
   font-size:16px
}
.contact-registration .form-control:-ms-input-placeholder {
   color:#C9BEFD;
   font-size:16px
}
.contact-registration .form-control:focus::-webkit-input-placeholder {
   color:#b1c1ce
}
.contact-registration .form-control:focus:-moz-placeholder {
   color:#b1c1ce
}
.contact-registration .form-control:focus::-moz-placeholder {
   color:#b1c1ce
}
.contact-registration .form-control:focus:-ms-input-placeholder {
   color:#b1c1ce
}
.contact-overlay .contact-registration .textarea-block .form-control {
   height:140px
}
.contact-overlay .contact-registration .form-control-feedback {
   right:14px;
   top:18px !important
}
.contact-overlay .btn-theme {
   padding:10px 68px;
   text-transform:uppercase
}


@media only screen and (max-width: 991px) {
   
   .shadow-block {
      padding:32px 14px
   }
}
@media only screen and (max-width: 767px) {
   
   .address-info {
      text-align:center;
      margin-left:0px
   }
   .address-info address p {
      text-align:center
   }
   .contact-overlay {
      border-left:0px solid transparent
   }
   
   .app-footer img {
    max-width: 68%;
    margin: 5px auto 5px;
}

   .app-footer img.last-child-blk {
    margin: 5px auto 23px;
}
   
   
}

.btn-contact
{
    background: #C9BEFD;
    color: #fff;
}

</style>

<?php 

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
     
      $lg = custom_language($this->data['user_selected']);

      $this->data['default_language'] = $lg['default_lang']; 

      $this->data['user_language'] = $lg['user_lang'];

      $this->user_selected = (!empty($this->data['user_selected']))?$this->data['user_selected']:'en';

      $this->default_language = (!empty($this->data['default_language']))?$this->data['default_language']:'';

      $this->user_language = (!empty($this->data['user_language']))?$this->data['user_language']:'';
      
      $query=$this->db->query("select * from system_settings WHERE status = 1");
   $result=$query->result_array();
   
    $website_email ='admin@dreamguys.co.in';
    $website_android='';
    $website_ios='';
      
   if(!empty($result))
   {
      $sitename=$meta_keywords=$meta_description='';
   foreach($result as $data){
      if($data['key'] == 'android'){
           $website_android = $data['value'];
   }
         if($data['key'] == 'ios'){
          $website_ios = $data['value'];
      
   }
   
   if($data['key'] == 'email_address'){
      $website_email = $data['value'];
   }
     
   }
   }
   
   ?>

<section class="contact-block ">
            <div class="container">
               <div class="row">
                  <div class="col-md-12 col-xs-12 text-center md-mb-32">
                     <h2><?php echo (!empty($user_language[$user_selected]['lg_contact_us']))?$user_language[$user_selected]['lg_contact_us']:$default_language['en']['lg_contact_us']; ?></h2>
                     <p style="text-align:center"><?php echo (!empty($user_language[$user_selected]['lg_if_you_have_any_questions_or_suggestions']))?$user_language[$user_selected]['lg_if_you_have_any_questions_or_suggestions']:$default_language['en']['lg_if_you_have_any_questions_or_suggestions']; ?>, <?php echo (!empty($user_language[$user_selected]['lg_please_fill_out_the_form_below_and_we_aim_to_respond_within_5_days']))?$user_language[$user_selected]['lg_please_fill_out_the_form_below_and_we_aim_to_respond_within_5_days']:$default_language['en']['lg_please_fill_out_the_form_below_and_we_aim_to_respond_within_5_days']; ?>. <?php echo (!empty($user_language[$user_selected]['lg_you_may_also_email_one_of_our_team_at']))?$user_language[$user_selected]['lg_you_may_also_email_one_of_our_team_at']:$default_language['en']['lg_you_may_also_email_one_of_our_team_at']; ?> <?php echo $website_email;?></p>
                     <p style="text-align:center"><?php echo (!empty($user_language[$user_selected]['lg_thanks']))?$user_language[$user_selected]['lg_thanks']:$default_language['en']['lg_thanks']; ?>!</p>
                     <p style="text-align:center"><?php echo (!empty($user_language[$user_selected]['lg_we_look_forward_to_hearing_from_you']))?$user_language[$user_selected]['lg_we_look_forward_to_hearing_from_you']:$default_language['en']['lg_we_look_forward_to_hearing_from_you']; ?>.</p>
                  </div>
               </div>                
               <div class="row">
                   <span id="success_contact" style="color: #29c729;margin-left: 40%;font-size: 20px;display: none;"> <?php echo (!empty($user_language[$user_selected]['lg_submitted_success']))?$user_language[$user_selected]['lg_submitted_success']:$default_language['en']['lg_submitted_success']; ?>...!</span>
                  <div class="col-md-12 col-sm-11 center-block no-float" style="margin-bottom: 15px;">
                     <div class="shadow-block">
                        <div class="row">
                           <div class="col-md-5 col-sm-6">
                              
                              <div class="address-info md-mt-32">
                                 <h3><?php echo (!empty($user_language[$user_selected]['lg_email']))?$user_language[$user_selected]['lg_email']:$default_language['en']['lg_email']; ?></h3>
                                 <dl class="dl-horizontal">
                                    <dt><i class="fa fa-envelope" aria-hidden="true"></i></dt>
                                    <dd>
                                       <address>
                                          <p><a href="mailto:<?php echo $website_email;?>"><?php echo $website_email;?></a></p>
                                       </address>
                                    </dd>
                                 </dl><?php if($website_android!='' || $website_ios!='')
                                 { ?>
                                 <h3><?php echo (!empty($user_language[$user_selected]['lg_download_app']))?$user_language[$user_selected]['lg_download_app']:$default_language['en']['lg_download_app']; ?></h3>
                                 <ul class="list-inline list-unstyled app-footer">
                                    <?php if(!empty($website_android))
                                    {
                                       echo'<li class="col-sm-6 col-xs-12"><a target="_blank" href="'.$website_android.'"><img src="'.base_url().'assets/images/googleplaystore-image.png" class="img-responsive"></a></li>';
                                    }
                                     
                                     if(!empty($website_ios))
                                     {
                                       echo'<li class="col-sm-6 col-xs-12"><a target="_blank" href="'.$website_ios.'"><img src="'.base_url().'assets/images/appstore-image.png" class="last-child-blk img-responsive"></a></li>';
                                     }
                                     ?>
                                     
                                     </ul>
                                  <?php } ?>
                              </div>
                           </div>
                           <div class="col-md-7 col-sm-6">
                              <div class="contact-overlay" id="contact-section">
                                 <div class="row">

                                    <div class="col-md-9 col-sm-11 center-block no-float">
                                       <div class="contact-registration">
                                          <form id="contact_us_form" method="POST" autocomplete="off">
                                             <div class="form-group">
                                                <input type="text" required class="form-control" id="contact_name" name="name" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_name']))?$user_language[$user_selected]['lg_name']:$default_language['en']['lg_name']; ?> *">
                                                <span style="color: red; text-align: center;display: none;" id="c_name"><?php echo (!empty($user_language[$user_selected]['lg_name_field_is_required']))?$user_language[$user_selected]['lg_name_field_is_required']:$default_language['en']['lg_name_field_is_required']; ?></span>
                                             </div>
                                             <div class="form-group">
                                                <input type="email" required class="form-control" id="contact_email" name="email" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_email']))?$user_language[$user_selected]['lg_email']:$default_language['en']['lg_email']; ?> *">
                                                <span style="color: red; text-align: center;display: none;" id="c_email"><?php echo (!empty($user_language[$user_selected]['lg_email_field_is_required']))?$user_language[$user_selected]['lg_email_field_is_required']:$default_language['en']['lg_email_field_is_required']; ?></span>
                                             </div>
                                             <div class="form-group">
                                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_contact_number']))?$user_language[$user_selected]['lg_contact_number']:$default_language['en']['lg_contact_number']; ?> *" >
                                             </div>
                                             <div class="form-group">
                                                <div class="textarea-block">
                                                   <textarea class="form-control" required id="contact_message" name="message" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_message']))?$user_language[$user_selected]['lg_message']:$default_language['en']['lg_message']; ?> *" ></textarea>
                                                   <span style="color: red; text-align: center;display: none;" id="c_message"><?php echo (!empty($user_language[$user_selected]['lg_message_field_is_required']))?$user_language[$user_selected]['lg_message_field_is_required']:$default_language['en']['lg_message_field_is_required']; ?></span>
                                                </div>
                                             </div>
                                             <div class="form-group">
                                             </div>
                                             <div class="form-group text-center">
                                                <button class="btn btn-contact btn-lg" type="submit" id="contact_us_submit" value="submit"><?php echo (!empty($user_language[$user_selected]['lg_submit']))?$user_language[$user_selected]['lg_submit']:$default_language['en']['lg_submit']; ?></button>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
