<?php //$this->load->view('user/includes/search_include'); ?>
			<section class="profile-section">
				<div class="container">
					<?php if($this->session->userdata('message')) {  ?>
						<div class="alert alert-success text-center fade in alert-dismissable" id="flash_succ_message"><?php echo $this->session->userdata('message');?></div>
					<?php } ?>
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
							<div class="user-block"  >
								<div class="user-image">
                                                                    
                                      <div id="crop-avatar">
                	
                    <div id="profile-avatar"> 
                        <div class="avatar-view" id="img_view" title="Click to change picture">
                          <?php $image =  base_url().'assets/images/avatar-lg.jpg' ;
					if(!empty($profile['user_profile_image']))
					{
						$image = base_url().$profile['user_profile_image'];
					}
					 ?>
                      <img style="cursor:pointer;" src="<?php echo $image; ?>" alt="Avatar">
                     </div>
                     <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
                </div> 
                <!-- Cropping modal -->
                <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <form class="avatar-form" action="<?php echo base_url().'prf_crop';?>" enctype="multipart/form-data" method="post">
                        <div class="modal-header">
                          <button class="close" data-dismiss="modal" type="button">&times;</button>
                          <h4 class="modal-title" id="avatar-modal-label"><?php echo (!empty($user_language[$user_selected]['lg_change_avatar']))?$user_language[$user_selected]['lg_change_avatar']:$default_language['en']['lg_change_avatar']; ?></h4>
                        </div>
                        <div class="modal-body">
                          <div class="avatar-body">
            
                            <!-- Upload image and data -->
                            <div class="avatar-upload">
                              <input class="avatar-src" name="avatar_src" type="hidden">
                              <input class="avatar-data" name="avatar_data" type="hidden"> 
                               <label for="avatarInput"><?php echo (!empty($user_language[$user_selected]['lg_local_upload']))?$user_language[$user_selected]['lg_local_upload']:$default_language['en']['lg_local_upload']; ?></label>
                              <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                            </div>
            
                            <!-- Crop and preview -->
                            <div class="row">
                              <div class="col-md-9">
                                <div class="avatar-wrapper"></div>
                              </div>
                              <div class="col-md-3">
                                <div class="avatar-preview preview-lg"></div>
                                <div class="avatar-preview preview-md"></div>
                                <div class="avatar-preview preview-sm"></div>
                              </div>
                            </div>
                             <div class="row avatar-btns"> 
                              <div class="col-md-3 pull-right">
                                <button class="btn btn-primary btn-block avatar-save" type="submit"><?php echo (!empty($user_language[$user_selected]['lg_done']))?$user_language[$user_selected]['lg_done']:$default_language['en']['lg_done']; ?></button>
                              </div>
                            </div>
                          </div>
                        </div> 
                      </form>
                    </div>
                  </div>
                </div><!-- /.modal -->
                 <!-- Loading state -->
                <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div> 
            
		</div>
									
								</div>
								<div class="user-details">
									<div class="user-name-block">
                                     <input type="text" name="show_user_name" id="show_user_name" value="<?php echo $profile['fullname'];  ?>" style="display: none" >
                                       <input type="button" name="save" id="save" value="save" style="display: none" >  <input type="button" name="cancel" id="cancel" value="cancel" style="display: none">
										<h3 id="uname-edit" class="user-name"><?php echo ucfirst($profile['fullname']);  ?></h3>
                                     <input type="hidden" name="hidden_user_name" id="hidden_user_name" value="<?php echo $profile['fullname'];  ?>" > 
									</div>
									<div class="user-contact">
										<ul class="list-inline">
                                        <?php 
										$query_feed = $this->db->query("SELECT AVG(rating),count(id) FROM `feedback` WHERE rating !=0 AND `to_user_id` = ".$profile['USERID']."");
										$fe_count = $query_feed->row_array();
										$rat=0;
										$rat_count=0;
										if($fe_count['AVG(rating)']!='')
										{
										$rat=round($fe_count['AVG(rating)']);
										$rat_count=$fe_count['count(id)'];
										}
											?>
											<li class="user-rating feedback-area"> 
                                             <span id="stars-existing" class="starrr" data-rating="<?php echo $rat;?>"> </span>(<?php echo $rat_count;?>)</li>
							 <?php if(!empty($country_name)) { ?>				<li class="user-country2">FROM <?php echo $country_name; ?> <span class="ppcn country <?php echo $country_shortname; ?>"></span></li> <?php } ?>                                           
										</ul>
									</div>
									<div class="user-description">
                                                                        <p class="user-desc"> <?php echo ucfirst($profile['description']); ?> <span class="more-desc">
                                                                        </span></p>
									</div>
									<?php if(!empty($profile['lang_speaks'])) { ?>	
                                    <div class="user-language">
										<span><img src="<?php echo base_url(); ?>assets/images/li-world.png"></span>
 	                                      Speaks: <span id="language_list"><?php echo ucfirst($profile['lang_speaks']);  ?></span> 	
                                          <input type="hidden" value="" id="lang_speaks">
										</span>
									</div>
                                    <?php } ?>	
								</div>
							</div>
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
									<li>
										<a href="<?php echo base_url().'password'; ?>">
											<span class="visible-xxs"><i class="fa fa-key" aria-hidden="true"></i></span> 
											<span class="hidden-xxs"><?php echo (!empty($user_language[$user_selected]['lg_password']))?$user_language[$user_selected]['lg_password']:$default_language['en']['lg_password']; ?></span> 
										</a>
									</li>
									<li>
										<a href="<?php echo base_url().'profile'; ?>">
											<span class="visible-xxs"><i class="fa fa-user" aria-hidden="true"></i></span>
											<span class="hidden-xxs"><?php echo (!empty($user_language[$user_selected]['lg_profile']))?$user_language[$user_selected]['lg_profile']:$default_language['en']['lg_profile']; ?></span>
										</a>
									</li>
									<li class="active">
										<a href="javascript:;">
											<span class="visible-xxs"><i class="fa fa-money" aria-hidden="true"></i></span>
											<span class="hidden-xxs"><?php echo (!empty($user_language[$user_selected]['lg_payment_settings']))?$user_language[$user_selected]['lg_payment_settings']:$default_language['en']['lg_payment_settings']; ?></span>
										</a>
									</li>
								</ul>
							</div>		
						</div>
					</div>
				</div>
			</div>
			<div class="tab-content">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<form id="add_payment_details" action="<?php echo base_url().'payment-settings'; ?>" method="post" >
								<div class="row">
									<div class="col-md-9 col-sm-9">
										<!--<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Applicant Name :</label>
													<input type="text" class="form-control" name="applicant_name" id="applicant_name" value="<?php echo ucfirst($list['user_name']); ?>" required="required" >
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Account Number :</label>
													<input type="text" name="account_number" id="account_number" class="form-control" value="<?php  echo ucfirst($list['acc_no']);  ?>" required="required">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Bank Name :</label>
													<input type="text" name="bank_name" id="bank_name" class="form-control" value="<?php echo ucfirst($list['bank_name']);   ?>" required="required" >
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Bank IFSC Code :</label>
													<input type="text" name="ifsc_code" id="ifsc_code" class="form-control" value="<?php echo ucfirst($list['ifsc_code']);  ?>"  >
												</div>
											</div>
										</div>
                                        <div class="form-group">
											<label>Bank Address :</label>
											<textarea maxlength="225" name="bank_addr" id="bank_addr" class="form-control" cols="5" rows="5" required="required" ><?php echo ucfirst($list['bank_addr']);  ?></textarea>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Pancard No:</label>
													<input type="text" name="pan_no" id="pan_no" value="<?php echo ucfirst($list['pancard_no']);   ?>" class="form-control" required="required">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>PayPal ID:</label>
													<input type="text" name="paypal_id" id="paypal_id" value="<?php echo ucfirst($list['paypal_account']);   ?>" class="form-control" required="required" >
												</div>
											</div>
										</div>-->
                                        <div class="row">											 
											<div class="col-md-6 col-sm-9">
												 
													<label><?php echo (!empty($user_language[$user_selected]['lg_paypal_email_id']))?$user_language[$user_selected]['lg_paypal_email_id']:$default_language['en']['lg_paypal_email_id']; ?>:</label>
													<input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="paypal_email_id" id="paypal_email_id" value="<?php echo $list['paypal_email_id'];   ?>" class="form-control" required="required" >
												 
											</div>
										</div>
										<div class="text-left">
											<button type="submit" name="form_submit" value="true" class="btn btn-primary save-btn"><?php echo (!empty($user_language[$user_selected]['lg_save']))?$user_language[$user_selected]['lg_save']:$default_language['en']['lg_save']; ?></button>
										</div>                                    
									</div>
								</div>
							</form>
							<hr/>
								<div class="row">
								 
									<div class="col-md-9 col-sm-9">
										
										<form class="form-horizontal" id="bank_details_form" action="<?php echo base_url().'user/payments/add_stripe_details'; ?>" method="POST">
											<div class="error_msg text-center" id="paypal_errormsg"></div>

										<h3><?php echo (!empty($user_language[$user_selected]['lg_stripe_account_details']))?$user_language[$user_selected]['lg_stripe_account_details']:$default_language['en']['lg_stripe_account_details']; ?></h3>
								
								
								<div class="row">											 

									<div class="col-md-6 col-sm-6">
									 
										<label><?php echo (!empty($user_language[$user_selected]['lg_the_account_holders_name']))?$user_language[$user_selected]['lg_the_account_holders_name']:$default_language['en']['lg_the_account_holders_name']; ?>:</label>
										<input type="text" id="account_holder_name" name="account_holder_name" class="form-control stripe_input" value="<?php echo (!empty($stripe_details['account_holder_name']))?$stripe_details['account_holder_name']:'';?>" required="required">
									 
									</div>
									<div class="col-md-6 col-sm-6">
									<label><?php echo (!empty($user_language[$user_selected]['lg_account_number']))?$user_language[$user_selected]['lg_account_number']:$default_language['en']['lg_account_number']; ?>:</label>

										<input type="text" id="account_number" name="account_number" class="form-control stripe_input" value="<?php echo (!empty($stripe_details['account_number']))?$stripe_details['account_number']:'';?>" required="required">

								 

								</div>

							</div>

								<div class="row">											 

									<div class="col-md-6 col-sm-9">

									 

									<label><?php echo (!empty($user_language[$user_selected]['lg_iban']))?$user_language[$user_selected]['lg_iban']:$default_language['en']['lg_iban']; ?>:</label>

										<input type="text" id="account_iban" name="account_iban" class="form-control stripe_input" value="<?php echo (!empty($stripe_details['account_iban']))?$stripe_details['account_iban']:'';?>">

							 

								</div>

					 										 

									<div class="col-md-6 col-sm-6">

								 

									<label><?php echo (!empty($user_language[$user_selected]['lg_bank_name']))?$user_language[$user_selected]['lg_bank_name']:$default_language['en']['lg_bank_name']; ?>:</label>


										<input type="text" id="bank_name" name="bank_name" class="form-control stripe_input" value="<?php echo (!empty($stripe_details['bank_name']))?$stripe_details['bank_name']:'';?>">

							 

								</div>

							</div>

								<div class="row">											 

									<div class="col-md-6 col-sm-9">

										 

									<label><?php echo (!empty($user_language[$user_selected]['lg_bank_address']))?$user_language[$user_selected]['lg_bank_address']:$default_language['en']['lg_bank_address']; ?>:</label>

										<input type="text" id="bank_address" name="bank_address" class="form-control stripe_input" value="<?php echo (!empty($stripe_details['bank_address']))?$stripe_details['bank_address']:'';?>">

									 

								</div>

						 											 

									<div class="col-md-6 col-sm-6">

									 
									<label><?php echo (!empty($user_language[$user_selected]['lg_sort_code']))?$user_language[$user_selected]['lg_sort_code']:$default_language['en']['lg_sort_code']; ?>(<?php echo (!empty($user_language[$user_selected]['lg_uk']))?$user_language[$user_selected]['lg_uk']:$default_language['en']['lg_uk']; ?>):</label>

										<input type="text" id="sort_code" name="sort_code" class="form-control stripe_input" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_uk_bank_code']))?$user_language[$user_selected]['lg_uk_bank_code']:$default_language['en']['lg_uk_bank_code']; ?> (<?php echo (!empty($user_language[$user_selected]['lg_6_digits_usually_displayed_as_3_pairs_of_numbers']))?$user_language[$user_selected]['lg_6_digits_usually_displayed_as_3_pairs_of_numbers']:$default_language['en']['lg_6_digits_usually_displayed_as_3_pairs_of_numbers']; ?>)" value="<?php echo (!empty($stripe_details['sort_code']))?$stripe_details['sort_code']:'';?>">

									 

								</div>

							</div>

								<div class="row">											 

									<div class="col-md-6 col-sm-9">

									 

									<label><?php echo (!empty($user_language[$user_selected]['lg_routing_number']))?$user_language[$user_selected]['lg_routing_number']:$default_language['en']['lg_routing_number']; ?>(<?php echo (!empty($user_language[$user_selected]['lg_us']))?$user_language[$user_selected]['lg_us']:$default_language['en']['lg_us']; ?>):</label>

										<input type="text" id="routing_number" name="routing_number" class="form-control stripe_input" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_the_american_bankers_association_number']))?$user_language[$user_selected]['lg_the_american_bankers_association_number']:$default_language['en']['lg_the_american_bankers_association_number']; ?> (<?php echo (!empty($user_language[$user_selected]['lg_consists_of_9_digits']))?$user_language[$user_selected]['lg_consists_of_9_digits']:$default_language['en']['lg_consists_of_9_digits']; ?>) and is also called a ABA Routing Number" value="<?php echo (!empty($stripe_details['routing_number']))?$stripe_details['routing_number']:'';?>">

								 

								</div>
								<div class="col-md-6 col-sm-6">
										<label><?php echo (!empty($user_language[$user_selected]['lg_ifsc_code']))?$user_language[$user_selected]['lg_ifsc_code']:$default_language['en']['lg_ifsc_code']; ?>(<?php echo (!empty($user_language[$user_selected]['lg_indian']))?$user_language[$user_selected]['lg_indian']:$default_language['en']['lg_indian']; ?>):</label>

										<input type="text" id="account_ifsc" name="account_ifsc" class="form-control stripe_input" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_financial_system_code']))?$user_language[$user_selected]['lg_financial_system_code']:$default_language['en']['lg_financial_system_code']; ?>, <?php echo (!empty($user_language[$user_selected]['lg_which_is_a_unique_11']))?$user_language[$user_selected]['lg_which_is_a_unique_11']:$default_language['en']['lg_which_is_a_unique_11']; ?>-<?php echo (!empty($user_language[$user_selected]['lg_digit_code_that_identifies_the_bank_branch']))?$user_language[$user_selected]['lg_digit_code_that_identifies_the_bank_branch']:$default_language['en']['lg_digit_code_that_identifies_the_bank_branch']; ?> i.e. <?php echo (!empty($user_language[$user_selected]['lg_icic0001245']))?$user_language[$user_selected]['lg_icic0001245']:$default_language['en']['lg_icic0001245']; ?>" value="<?php echo (!empty($stripe_details['account_ifsc']))?$stripe_details['account_ifsc']:'';?>">

								</div>
							</div>
<?php $save = (!empty($user_language[$user_selected]['lg_save']))?$user_language[$user_selected]['lg_save']:$default_language['en']['lg_save']; ?>
							<div class="row">		
								<div class="col-lg-12"><p class="text-danger error_note" ></p></div>				
								<div class="col-lg-12">
									<input type="submit" id="payment_btn" class="btn btn-primary save-btn" value="<?php echo $save; ?>">
								</div>                                    
							</div>

										</form>
									</div>
								</div>		
						</div>
					</div>
				</div>
			</div>