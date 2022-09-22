<?php //$this->load->view('user/includes/search_include'); ?>
<section class="profile-section">
	<div class="container">
	<?php if($this->session->userdata('message')) {					 ?>
		<div class="alert alert-success text-center fade in alert-dismissable" id="flash_succ_message"><?php echo $this->session->userdata('message');?></div>
	<?php } ?>
		<div class="row">	
			<div class="col-md-12">
				<ol class="breadcrumb menu-breadcrumb">
					<li><a href="<?php echo base_url(); ?>"><?php echo (!empty($user_language[$user_selected]['lg_home']))?$user_language[$user_selected]['lg_home']:$default_language['en']['lg_home']; ?></a> <i class="fa fa fa-chevron-right"></i></li>
					<li class="active"><?php echo (!empty($user_language[$user_selected]['lg_profile']))?$user_language[$user_selected]['lg_profile']:$default_language['en']['lg_profile']; ?></li>        
				</ol>
			</div>
		</div>
	
		<div class="row">	
			<div class="col-md-12">
				<div class="user-block"  >
					<div class="user-image">
														
						  <div id="crop-avatar">
		
		<div id="profile-avatar"> 
			<div class="avatar-view" id="img_view">
			<?php $image =  base_url().'assets/images/avatar-lg.jpg' ;
		if(!empty($profile['user_profile_image']))
		{
			$image = base_url().$profile['user_profile_image'];
		}
		 ?>
		  <img style="cursor:pointer;" src="<?php echo $image; ?>" alt="Avatar">
		  <div class="change-img-text"><?php echo (!empty($user_language[$user_selected]['lg_change_image']))?$user_language[$user_selected]['lg_change_image']:$default_language['en']['lg_change_image']; ?></div>
		 </div>
		 <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
	</div> 
	<!-- Cropping modal -->
	<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
	  <div class="modal-dialog">
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
				  <div class="col-md-12">
					<div class="avatar-wrapper"></div>
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
							$query_feed = $this->db->query("SELECT AVG(rating),count(id) FROM `feedback` WHERE  rating !=0 AND `to_user_id` = ".$profile['USERID']."");
							$fe_count = $query_feed->row_array();
							$rat=0;
							$rat_count =0;
							if($fe_count['AVG(rating)']!='')
							{
							$rat=round($fe_count['AVG(rating)']);
							$rat_count=round($fe_count['count(id)']);
							}
								?>
								<li class="user-rating feedback-area"> <span id="stars-existing" class="starrr" data-rating="<?php echo $rat;?>"> </span>(<?php echo $rat_count;?>)</li>
			<?php if(!empty($country_name)) { ?>				
				<li class="user-country2"><?php echo (!empty($user_language[$user_selected]['lg_from']))?$user_language[$user_selected]['lg_from']:$default_language['en']['lg_from']; ?> <?php echo $country_name; ?> <span class="ppcn country <?php echo $country_shortname; ?>"></span></li> <?php } ?>
							</ul>
						</div>
						<div class="user-description">
															<p class="user-desc"> <?php echo ucfirst($profile['description']); ?> <span class="more-desc"></span></p>
						</div>
															<?php if(!empty($profile['lang_speaks'])) { ?>

						<div class="user-language">
							<span><img src="<?php echo base_url(); ?>assets/images/li-world.png"></span>
																	<?php echo (!empty($user_language[$user_selected]['lg_speaks']))?$user_language[$user_selected]['lg_speaks']:$default_language['en']['lg_speaks']; ?>: <span id="language_list"><?php echo ucfirst($profile['lang_speaks']);  ?></span> 
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
						<li class="active">
							<a href="javascript:;">
								<span class="visible-xxs"><i class="fa fa-user" aria-hidden="true"></i></span>
								<span class="hidden-xxs"><?php echo (!empty($user_language[$user_selected]['lg_profile']))?$user_language[$user_selected]['lg_profile']:$default_language['en']['lg_profile']; ?></span>
							</a>
						</li>
						<li>
							<a href="<?php echo base_url().'payment-settings'; ?>">
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
				<form action="<?php echo base_url().'profile'; ?>" method="post" >
					<div class="row">
						<div class="col-md-9 col-sm-12">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label><?php echo (!empty($user_language[$user_selected]['lg_email']))?$user_language[$user_selected]['lg_email']:$default_language['en']['lg_email']; ?> :</label>
										<input type="text" class="form-control" value="<?php echo $profile['email']; ?>" disabled>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label><?php echo (!empty($user_language[$user_selected]['lg_phone']))?$user_language[$user_selected]['lg_phone']:$default_language['en']['lg_phone']; ?> :</label>
										<input type="text" name="user_contact" id="user_contact" class="form-control" value="<?php echo $profile['contact']; ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label><?php echo (!empty($user_language[$user_selected]['lg_name']))?$user_language[$user_selected]['lg_name']:$default_language['en']['lg_name']; ?> :</label>
										<input type="text"  name="user_name" id="user_name" class="form-control  only_alphabets" value="<?php echo $profile['fullname']; ?>" required >
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group clearfix">	
										<label><?php echo (!empty($user_language[$user_selected]['lg_speaks']))?$user_language[$user_selected]['lg_speaks']:$default_language['en']['lg_speaks']; ?> :</label>
										<input type="text" name="language_tags" id="tokenfield" class="form-control" value="<?php echo ucfirst($profile['lang_speaks']); ?>" >
									</div> 
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label><?php echo (!empty($user_language[$user_selected]['lg_country']))?$user_language[$user_selected]['lg_country']:$default_language['en']['lg_country']; ?> :</label>
										<select name="country_id" id="country_id" class="form-control"> 
											<option value="">--<?php echo (!empty($user_language[$user_selected]['lg_select_country']))?$user_language[$user_selected]['lg_select_country']:$default_language['en']['lg_select_country']; ?>--</option>
											<?php foreach($country_list as $countries) { ?>
											<option value="<?php echo $countries['id']; ?>" <?php if($profile['country']==$countries['id']) echo 'selected'; ?>  ><?php echo $countries['country']; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label><?php echo (!empty($user_language[$user_selected]['lg_state']))?$user_language[$user_selected]['lg_state']:$default_language['en']['lg_state']; ?>/<?php echo (!empty($user_language[$user_selected]['lg_province']))?$user_language[$user_selected]['lg_province']:$default_language['en']['lg_province']; ?>:</label>
										<?php if(!empty($profile['state'])) {
										$query = $this->db->query("SELECT * FROM `states` WHERE `country_id` =". $profile['country']." AND `state_status` = 1");
										$result = $query->result_array();
										} ?>
										<select name="state_id" id="state_id" class="form-control">
											<option value="">--<?php echo (!empty($user_language[$user_selected]['lg_select_state']))?$user_language[$user_selected]['lg_select_state']:$default_language['en']['lg_select_state']; ?>--</option>
											<?php  if(!empty($result)) {
											foreach($result as $states) { ?>
											<option value="<?php echo $states['state_id']; ?>" <?php if($profile['state']==$states['state_id']) echo 'selected'; ?>  ><?php echo $states['state_name']; ?></option>
											<?php } } ?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group">
										<label><?php echo (!empty($user_language[$user_selected]['lg_zip_code']))?$user_language[$user_selected]['lg_zip_code']:$default_language['en']['lg_zip_code']; ?>:</label>
										<input type="text" name="user_zip" id="user_zip" value="<?php  echo $profile['zipcode'] ?>"  class="form-control">
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label><?php echo (!empty($user_language[$user_selected]['lg_city']))?$user_language[$user_selected]['lg_city']:$default_language['en']['lg_city']; ?>:</label>
										<input type="text" name="user_city" id="user_city" value="<?php echo $profile['city']; ?>" class="form-control">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label><?php echo (!empty($user_language[$user_selected]['lg_address_line']))?$user_language[$user_selected]['lg_address_line']:$default_language['en']['lg_address_line']; ?>:</label>
										<input type="text" name="user_addr" id="user_addr" value="<?php echo $profile['address']; ?>" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label><?php echo (!empty($user_language[$user_selected]['lg_profession']))?$user_language[$user_selected]['lg_profession']:$default_language['en']['lg_profession']; ?>:</label>
										 <select name="profession" class="form-control">
										 <option value="">--<?php echo (!empty($user_language[$user_selected]['lg_select_profession']))?$user_language[$user_selected]['lg_select_profession']:$default_language['en']['lg_select_profession']; ?>--</option>
											<?php foreach($profession as $prof) { ?>
											<option value="<?php echo $prof['id'] ; ?>" <?php if($profile['profession']==$prof['id']) { echo "selected";} ?> ><?php echo $prof['profession_name'] ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label><?php echo (!empty($user_language[$user_selected]['lg_something_about_you']))?$user_language[$user_selected]['lg_something_about_you']:$default_language['en']['lg_something_about_you']; ?>:</label>
										<textarea maxlength="225" name="user_desc" id="user_desc" class="form-control" cols="5" rows="5"><?php echo $profile['description']; ?></textarea>
									</div>
								</div>
							</div>
							<div class="text-center">
								<button type="submit" name="form_submit" value="true" class="btn btn-primary save-btn"><?php echo (!empty($user_language[$user_selected]['lg_save']))?$user_language[$user_selected]['lg_save']:$default_language['en']['lg_save']; ?></button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>