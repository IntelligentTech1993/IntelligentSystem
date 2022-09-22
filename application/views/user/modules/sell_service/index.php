			<?php 	//$this->load->view('user/includes/search_include');

				// Setting Price Option 0 - Fixed, 1 - Dynamic.  

				 $allow	= ($price_option['value'] == 'dynamic')?1:0; 
				 $currency_option = (!empty($currency_option))?$currency_option:'USD';
				 $currency_sign = currency_sign($currency_option);
			 ?>

			<section class="sell-banner parallax">

				<div class="container">

					<div class="row">

						<div class="col-md-12 sell-banner-cont">

								<h2><?php echo (!empty($user_language[$user_selected]['lg_creating_gigs_is_easy']))?$user_language[$user_selected]['lg_creating_gigs_is_easy']:$default_language['en']['lg_creating_gigs_is_easy']; ?>.</h2>	

								<h2 class="center-cont"><?php echo (!empty($user_language[$user_selected]['lg_start_selling_now']))?$user_language[$user_selected]['lg_start_selling_now']:$default_language['en']['lg_start_selling_now']; ?>!</h2>	

								<div class="create-gig">										 

									<button type="button" id="create_gig_btn" class="btn btn-yellow"><?php echo (!empty($user_language[$user_selected]['lg_create_a_gig']))?$user_language[$user_selected]['lg_create_a_gig']:$default_language['en']['lg_create_a_gig']; ?></button>

								</div>	

						</div>

					</div>

				</div>

			</section>

			<div class="milestone-area">	

				<div class="container">				

					<div class="row milestone-section">

						<div class="col-sm-2 text-center">

							<span class="circle-bg orange-bg"><img src="<?php echo base_url(); ?>assets/images/circle-map.png"></span>

							<p class="miles-title"><?php echo (!empty($user_language[$user_selected]['lg_create_your_gig']))?$user_language[$user_selected]['lg_create_your_gig']:$default_language['en']['lg_create_your_gig']; ?></p>

						</div>

						<div class="col-sm-2 text-center">

							<span class="circle-bg orange-bg"><img src="<?php echo base_url(); ?>assets/images/publish-icon.png"></span>

							<p class="miles-title"><?php echo (!empty($user_language[$user_selected]['lg_publish']))?$user_language[$user_selected]['lg_publish']:$default_language['en']['lg_publish']; ?></p>

						</div>

						<div class="col-sm-2 text-center">

							<span class="circle-bg orange-bg"><img src="<?php echo base_url(); ?>assets/images/receive-orders-icon.png"></span>

							<p class="miles-title"><?php echo (!empty($user_language[$user_selected]['lg_receive_orders']))?$user_language[$user_selected]['lg_receive_orders']:$default_language['en']['lg_receive_orders']; ?></p>

						</div>

						<div class="col-sm-2 text-center">

							<span class="circle-bg green-bg"><img src="<?php echo base_url(); ?>assets/images/deliver-work-icon.png"></span>

							<p class="miles-title"><?php echo (!empty($user_language[$user_selected]['lg_deliver_the_work']))?$user_language[$user_selected]['lg_deliver_the_work']:$default_language['en']['lg_deliver_the_work']; ?></p>

						</div>

						<div class="col-sm-2 text-center">

							<span class="circle-bg green-bg"><img src="<?php echo base_url(); ?>assets/images/get-paid-icon.png"></span>

							<p class="miles-title"><?php echo (!empty($user_language[$user_selected]['lg_get_paid']))?$user_language[$user_selected]['lg_get_paid']:$default_language['en']['lg_get_paid']; ?></p>

						</div>

						<div class="col-sm-2 text-center">

							<span class="circle-bg green-bg"><img src="<?php echo base_url(); ?>assets/images/money-bag.png"></span>

							<p class="miles-title"><?php echo (!empty($user_language[$user_selected]['lg_withdraw_funds']))?$user_language[$user_selected]['lg_withdraw_funds']:$default_language['en']['lg_withdraw_funds']; ?></p>

						</div>

						<div class="col-sm-12 text-center">

							<img src="<?php echo base_url(); ?>assets/images/side-arrow.png">

						</div>

						<div class="col-sm-12">

							<span class="left-arrow"><img src="<?php echo base_url(); ?>assets/images/down-arrow.png"></span>

						</div>

					</div>

				</div>

			</div>

			<section id="post_gig_area" class="post-gig-area">	

				<div class="container">		

					<div class="row">

						<div class="col-md-8 col-sm-12">                                                   

							<h3 class="post-gig-title"><?php echo (!empty($user_language[$user_selected]['lg_post_a_gig_in_few_seconds']))?$user_language[$user_selected]['lg_post_a_gig_in_few_seconds']:$default_language['en']['lg_post_a_gig_in_few_seconds']; ?></h3>

							<p class="sub-title"><?php echo (!empty($user_language[$user_selected]['lg_gig']))?$user_language[$user_selected]['lg_gig']:$default_language['en']['lg_gig']; ?>: <?php echo (!empty($user_language[$user_selected]['lg_a_packed_service_you_can_deliver_remotely_or__around_you_for_a_fixed_price_in_a_set_time_frame']))?$user_language[$user_selected]['lg_a_packed_service_you_can_deliver_remotely_or__around_you_for_a_fixed_price_in_a_set_time_frame']:$default_language['en']['lg_a_packed_service_you_can_deliver_remotely_or__around_you_for_a_fixed_price_in_a_set_time_frame']; ?>.</p>

							<input type="hidden" id="payment_option" value="<?php echo $price_option['value']; ?>">	

							<input type="hidden" class="gig_title_valid" value="0">	



							<form id="sell_service"   action="<?php echo base_url()."user/sell_service/add_gigs"; ?>" method="post" class="sell-service-form" enctype= "multipart/form-data" >

								<input type="hidden" name="country_name" id="country_name" value="">

								<input type="hidden" name="client_timezone" id="client_timezone" value="">

								<input type="hidden" name="full_country_name" id="full_country_name" value="<?php echo @$full_country_name; ?>">

								<input type="hidden" name="extra_gig_rate" id="extra_gig_rate" value="<?php echo $extra_gig_price['value']; ?>">

								<input type="hidden" name="dollar_rate" id="dollar_rate" value="<?php echo $dollar_rate; ?>">

								<input type="hidden" name="rupee_rate" id="rupee_rate" value="<?php echo $rupee_rate; ?>">

								<input type="hidden" name="youtube_url" id="youtube_url" value="">

								<input type="hidden" name="vimeo_url" id="vimeo_url" value="">

								<input type="hidden" name="vimeo_video_id" id="vimeo_video_id" value="">

								<div class="form-group clearfix">

									<label class="label-title"><?php echo (!empty($user_language[$user_selected]['lg_title_for_your_gig']))?$user_language[$user_selected]['lg_title_for_your_gig']:$default_language['en']['lg_title_for_your_gig']; ?> <span class="required">*</span></label>

									<div class="name-block">

										<span class="name-input">

											<input type="text" name="gig_title" id="gig_title" onkeyup="gig_title_check(this)" onchange="gig_title_check(this)" value="" class="form-control gig-name " maxlength="80" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_i_can']))?$user_language[$user_selected]['lg_i_can']:$default_language['en']['lg_i_can']; ?>">	

										</span>

										<span class="currency">

											<?php echo (!empty($user_language[$user_selected]['lg_for']))?$user_language[$user_selected]['lg_for']:$default_language['en']['lg_for']; ?> <span class="currency-group">
												<?php 
												$rate = $gig_price['value'];
												$extra_gig_price = $extra_gig_price['value'];
											?>

												<?php echo $currency_sign; ?>	 <input type="text" class="form-control amount numberonly" name="gig_price" onfocusout="inputfocusout(this)" id="gig_price" <?php echo ($allow==1)?'':'readonly'; ?>  value="<?php echo ($allow==1)?'':$rate; ?>">

												</span>

										</span>

									</div>

									<span class="form-description"><?php echo (!empty($user_language[$user_selected]['lg_eg']))?$user_language[$user_selected]['lg_eg']:$default_language['en']['lg_eg']; ?>.<?php echo (!empty($user_language[$user_selected]['lg_i_can_repair_a_door_in_paris']))?$user_language[$user_selected]['lg_i_can_repair_a_door_in_paris']:$default_language['en']['lg_i_can_repair_a_door_in_paris']; ?></span>

									<small class="error_msg help-block gig_title_error" style="display: none;"><?php echo (!empty($user_language[$user_selected]['lg_please_enter_a_title']))?$user_language[$user_selected]['lg_please_enter_a_title']:$default_language['en']['lg_please_enter_a_title']; ?></small>



									<small class="error_msg help-block gig_title_already_error" style="display: none;"><?php echo (!empty($user_language[$user_selected]['lg_this_title_is_already_taken']))?$user_language[$user_selected]['lg_this_title_is_already_taken']:$default_language['en']['lg_this_title_is_already_taken']; ?></small>



									<small class="error_msg help-block gig_price_error" style="display: none;"><?php echo (!empty($user_language[$user_selected]['lg_please_enter_the_price_for_gig']))?$user_language[$user_selected]['lg_please_enter_the_price_for_gig']:$default_language['en']['lg_please_enter_the_price_for_gig']; ?></small>

									

									

								</div>

								<div class="form-group clearfix delivery-day">

								<label class="label-title"><?php echo (!empty($user_language[$user_selected]['lg_when_will_you_deliver_the_gig']))?$user_language[$user_selected]['lg_when_will_you_deliver_the_gig']:$default_language['en']['lg_when_will_you_deliver_the_gig']; ?>? <span class="required">*</span></label>

								<input type="text" name="delivering_time" id="delivering_time" class="form-control" maxlength="2" onkeyup="max_lenght(this)" onblur="checkinput(this)" onchange="max_lenght(this)" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_just_type_number_of_days']))?$user_language[$user_selected]['lg_just_type_number_of_days']:$default_language['en']['lg_just_type_number_of_days']; ?> (<?php echo (!empty($user_language[$user_selected]['lg_ex']))?$user_language[$user_selected]['lg_ex']:$default_language['en']['lg_ex']; ?>: 2 <?php echo (!empty($user_language[$user_selected]['lg_days']))?$user_language[$user_selected]['lg_days']:$default_language['en']['lg_days']; ?>)"><span class="actual_delivery_days" id="main_delivery_days"> </span>

								<small class="error_msg help-block main_delivery_days_error" style="display: none;"><?php echo (!empty($user_language[$user_selected]['lg_please_enter_a_estimated_delivery_days']))?$user_language[$user_selected]['lg_please_enter_a_estimated_delivery_days']:$default_language['en']['lg_please_enter_a_estimated_delivery_days']; ?></small>

								<small class="error_msg help-block delivery_days_error" style="display: none;"><?php echo (!empty($user_language[$user_selected]['lg_please_enter_a_days_1_to_29']))?$user_language[$user_selected]['lg_please_enter_a_days_1_to_29']:$default_language['en']['lg_please_enter_a_days_1_to_29']; ?>.</small>

								</div>

                                                  

								<div class="form-group clearfix">

									<label class="label-title"><?php echo (!empty($user_language[$user_selected]['lg_pick_category']))?$user_language[$user_selected]['lg_pick_category']:$default_language['en']['lg_pick_category']; ?> <span class="required">*</span></label>

									<div class="category-select">
									<span class="">
									<select class="select gig-category" id="gig_category_id" name="gig_category_id">										

									<option value=""><?php echo (!empty($user_language[$user_selected]['lg_select_category']))?$user_language[$user_selected]['lg_select_category']:$default_language['en']['lg_select_category']; ?></option>

										<?php foreach($categories_subcategories as $cat) { 

											if($cat['parent']==0){

												$query  = $this->db->query("SELECT `CATID` , `name` FROM `categories` WHERE `parent` = ". $cat['CATID']." and status=0 and delete_sts = 0 ");

												$result = $query->result_array(); 

												$result_count = $query->num_rows();

											?>
											
											<option class="categoryselected category_main_menu" value="<?php echo $cat['CATID']; ?>"> <?php echo $cat['name']; ?> </option>    

										<?php 

										if($result_count>0){

											foreach($result as $sub_category_list){ ?>

											<option class="sub_category_menu" value="<?php echo $sub_category_list['CATID']; ?>"> <?php echo $sub_category_list['name']; ?> </option>    

										<?php     	 }

												   }

												}

											}

									?>

									</select>	
									</span>
									<small class="error_msg help-block gig_category_id_error" style="display: none;"><?php echo (!empty($user_language[$user_selected]['lg_please_select_a_category']))?$user_language[$user_selected]['lg_please_select_a_category']:$default_language['en']['lg_please_select_a_category']; ?></small>

									</div>

								</div>

								<div class="form-group clearfix">

									<label class="label-title"><?php echo (!empty($user_language[$user_selected]['lg_add_tags']))?$user_language[$user_selected]['lg_add_tags']:$default_language['en']['lg_add_tags']; ?> <span class="small-title">(<?php echo (!empty($user_language[$user_selected]['lg_separated_with_a_comma']))?$user_language[$user_selected]['lg_separated_with_a_comma']:$default_language['en']['lg_separated_with_a_comma']; ?>)</span></label>

									<input type="text" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_enter_your_tags']))?$user_language[$user_selected]['lg_enter_your_tags']:$default_language['en']['lg_enter_your_tags']; ?>" name="gig_tags" id="gig_tags" data-role="tagsinput" class="form-control">	

								</div>

								<div class="form-group add-image clearfix">

                                    <input type="hidden" name="image_array" id="image_array" value="" />

                                    <input type="hidden" name="image_div_id" id="image_div_id" value="1" />

                                    <input type="hidden" name="delete_image_array" id="delete_image_array" value="" />

                                    <input type="hidden" name="deleted_image_array" id="deleted_image_array" value=""  />

                                    <input type="hidden" name="video_array" id="video_array" value="" />

                                    <input type="hidden" name="video_div_id" id="video_div_id" value="1" />

									<label class="label-title"><?php echo (!empty($user_language[$user_selected]['lg_make_it_fun']))?$user_language[$user_selected]['lg_make_it_fun']:$default_language['en']['lg_make_it_fun']; ?>:<?php echo (!empty($user_language[$user_selected]['lg_upload_photos_or_videos']))?$user_language[$user_selected]['lg_upload_photos_or_videos']:$default_language['en']['lg_upload_photos_or_videos']; ?>! <span class="text-muted" style="color:#999;">(<?php echo (!empty($user_language[$user_selected]['lg_image']))?$user_language[$user_selected]['lg_image']:$default_language['en']['lg_image']; ?> <span class="required">*</span>)</span></label>

									<div class="upload-block">

										<div class="photos-upload image_upload" id="upload_image_btn">	

												<div id="show_loader" style="display:none;">

                                                    <img src="<?php echo base_url().'assets/images/loader.gif'; ?>" >

												</div>

											<h4><?php echo (!empty($user_language[$user_selected]['lg_upload']))?$user_language[$user_selected]['lg_upload']:$default_language['en']['lg_upload']; ?></h4>

											<p> <?php echo (!empty($user_language[$user_selected]['lg_photos']))?$user_language[$user_selected]['lg_photos']:$default_language['en']['lg_photos']; ?></p>

										</div>

                                        <div class="photos-upload">

											<div id="video_show_loader" style="display: none;">

												<img src="<?php echo base_url().'assets/images/loader.gif'; ?>" >

											</div>

                                            <input class="gig-img-upload" id="video_files" name="gig_video" size="20" type="file">

											<h4> <?php echo (!empty($user_language[$user_selected]['lg_upload']))?$user_language[$user_selected]['lg_upload']:$default_language['en']['lg_upload']; ?></h4>

											<p> <?php echo (!empty($user_language[$user_selected]['lg_videos']))?$user_language[$user_selected]['lg_videos']:$default_language['en']['lg_videos']; ?> </p>                                                                                            

                                        </div>  

										<div class="embedded" id="third_party">

											<h4><?php echo (!empty($user_language[$user_selected]['lg_embedded']))?$user_language[$user_selected]['lg_embedded']:$default_language['en']['lg_embedded']; ?></h4>

											<p><?php echo (!empty($user_language[$user_selected]['lg_from_3rd_party_sites']))?$user_language[$user_selected]['lg_from_3rd_party_sites']:$default_language['en']['lg_from_3rd_party_sites']; ?></p>

										</div>											 

									</div>

									<div class="embedded-url" style="display:none">

										<label class="label-title"><?php echo (!empty($user_language[$user_selected]['lg_add_url']))?$user_language[$user_selected]['lg_add_url']:$default_language['en']['lg_add_url']; ?></label>

										<input class="form-control" type="text">

									</div>

                                <small class="error_msg help-block pull-left" id="image_video_error_msg" ></small> 

								</div>

                                <div class="form-group clearfix uploaded-section" style="display: none"> </div> 

                                <small class="error_msg help-block image_error_error" style="display: none;"><?php echo (!empty($user_language[$user_selected]['lg_please_upload_a_file']))?$user_language[$user_selected]['lg_please_upload_a_file']:$default_language['en']['lg_please_upload_a_file']; ?></small>



								<div class="form-group item-description clearfix">

									<label class="label-title"><?php echo (!empty($user_language[$user_selected]['lg_provide_more_details_about_your_gig']))?$user_language[$user_selected]['lg_provide_more_details_about_your_gig']:$default_language['en']['lg_provide_more_details_about_your_gig']; ?> <span class="required">*</span></label>

									<textarea rows="5" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_explain_in_more_detail_what_exactly_you_will_deliver_to_the_buyer']))?$user_language[$user_selected]['lg_explain_in_more_detail_what_exactly_you_will_deliver_to_the_buyer']:$default_language['en']['lg_explain_in_more_detail_what_exactly_you_will_deliver_to_the_buyer']; ?>..." name="gig_details" id="gig_details" class="form-control"></textarea>

									<?php echo display_ckeditor($ckeditor_editor); ?>

									<small  class="error_msg help-block" id="desc_err" ></small>

									<small class="error_msg help-block  gig_details_error" style="display: none;"><?php echo (!empty($user_language[$user_selected]['lg_please_enter_about_your_gig_details']))?$user_language[$user_selected]['lg_please_enter_about_your_gig_details']:$default_language['en']['lg_please_enter_about_your_gig_details']; ?></small>

								</div>

								<div class="form-group clearfix">

									<label class="label-title"><?php echo (!empty($user_language[$user_selected]['lg_earn_extra_money']))?$user_language[$user_selected]['lg_earn_extra_money']:$default_language['en']['lg_earn_extra_money']; ?> - <?php echo (!empty($user_language[$user_selected]['lg_offer_optional_add']))?$user_language[$user_selected]['lg_offer_optional_add']:$default_language['en']['lg_offer_optional_add']; ?>-<?php echo (!empty($user_language[$user_selected]['lg_on_services_to_the_buyer']))?$user_language[$user_selected]['lg_on_services_to_the_buyer']:$default_language['en']['lg_on_services_to_the_buyer']; ?></label>

									<div class="add-more-items clearfix">

                                  	<input type="hidden" name="extra_gig_rate_symbol" id="extra_gig_rate_symbol" value="<?php echo $currency_sign; ?>">

                                    <div class="clearfix" id="row_id_1">

									<span class="close-offer"><i class="fa fa-times" onclick="remove_div(1);" aria-hidden="true"></i></span>

<div class="name-block2">

	<span class="name-input2"><input type="text" name="extra_gigs[]" value="" id='label_name_1'  class="form-control extra_money_price gig-name gigs_name_opt" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_i_can']))?$user_language[$user_selected]['lg_i_can']:$default_language['en']['lg_i_can']; ?>"  date-no="1" ></span>

	<span class="currency">

	<?php echo (!empty($user_language[$user_selected]['lg_for']))?$user_language[$user_selected]['lg_for']:$default_language['en']['lg_for']; ?>  <span class="currency-group">	                                                                                 

	<?php echo $currency_sign; ?> 

	<input type="text" class="form-control amount numberonly" name="extra_gigs_amount[]" data-bv-field="extra_gigs_amount[]" <?php echo ($allow==1)?'':'readonly'; ?> onfocusout="inputfocusout(this)" id='label_val_1' value="<?php echo $ex_price = ($allow==1)?'':$extra_gig_price ?>">

	<input type="hidden"  id="readonly_dynamic" value="<?php echo ($allow==1)?'':'readonly'; ?>"> 

	</span>  <?php echo (!empty($user_language[$user_selected]['lg_in']))?$user_language[$user_selected]['lg_in']:$default_language['en']['lg_in']; ?> <input type="text"  value="1"  onkeyup="extra_gig_days(this,1)" onfocusout="inputfocusout(this)" class="form-control amount2 numberonly"  name="extra_gigs_delivery[]">

	<span class="sub_delivery_days"><?php echo (!empty($user_language[$user_selected]['lg_day']))?$user_language[$user_selected]['lg_day']:$default_language['en']['lg_day']; ?></span></span>                                                

</div>	

										</div>	                     



				<div id="add_extra_gig">

					<input type="hidden" name="table_content" id="table_content" value="2">

				</div>                                                                            

					<div class="add-more">	

						<a href="javascript:;" class="add-more-btn" onclick="add_extra_service();">+ <?php echo (!empty($user_language[$user_selected]['lg_add_more_items']))?$user_language[$user_selected]['lg_add_more_items']:$default_language['en']['lg_add_more_items']; ?></a>

					</div>

				</div>

				</div>

				<small class="error_msg help-block extra_gigs_validate" style="display: none;" ><?php echo (!empty($user_language[$user_selected]['lg_please_enter_the_price_for_extra_gig']))?$user_language[$user_selected]['lg_please_enter_the_price_for_extra_gig']:$default_language['en']['lg_please_enter_the_price_for_extra_gig']; ?></small>

				<small class="error_msg help-block extra_gigs_gig_name" style="display: none;" ><?php echo (!empty($user_language[$user_selected]['lg_please_enter_the_gig_name']))?$user_language[$user_selected]['lg_please_enter_the_gig_name']:$default_language['en']['lg_please_enter_the_gig_name']; ?></small>



				<div class="form-group clearfix">

               <label class="label-title"><?php echo (!empty($user_language[$user_selected]['lg_super_fast_delivery']))?$user_language[$user_selected]['lg_super_fast_delivery']:$default_language['en']['lg_super_fast_delivery']; ?></label>

				<div class="delivery-block clearfix">                                                                                   

					<div class="checkbox checkbox-primary checkbox-inline pull-left">

						<input type="checkbox" name="super_fast_delivery" class="validdays"  id="super_fast_delivery" value="yes" disabled="disabled" >

						<label for="super_fast_delivery">&nbsp; </label>

					</div>

					<span class="super-fast"><?php echo (!empty($user_language[$user_selected]['lg_super_fast']))?$user_language[$user_selected]['lg_super_fast']:$default_language['en']['lg_super_fast']; ?></span>

					

					<div class="name-block2 superfast-block">

					<span class="name-input2"><input name="super_fast_delivery_desc" id="super_fast_delivery_desc" value="" class="form-control gig-name" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_i_can_deliver_the_gigs']))?$user_language[$user_selected]['lg_i_can_deliver_the_gigs']:$default_language['en']['lg_i_can_deliver_the_gigs']; ?>" type="text" disabled="disabled"></span>

						<span class="currency">

					 <?php echo (!empty($user_language[$user_selected]['lg_for']))?$user_language[$user_selected]['lg_for']:$default_language['en']['lg_for']; ?> <?php echo $currency_sign; ?> <span class="currency-group"><input type="text" disabled="disabled" class="form-control validdays  amount numberonly" name="super_fast_charges" onfocusout="inputfocusout(this)" id="super_fast_charges" value="<?php echo ($allow==1)?'':$extra_gig_price; ?>" <?php echo ($allow==1)?'':''; ?> ></span> <?php echo (!empty($user_language[$user_selected]['lg_in']))?$user_language[$user_selected]['lg_in']:$default_language['en']['lg_in']; ?> <input type="text" value="1" onfocusout="inputfocusout(this)" onkeyup="extra_gig_days(this,2)" onmouseup="extra_gig_days(this,2)" class="form-control amount2 numberonly" name="super_fast_delivery_date" maxlength="2" id="super_fast_delivery_date" disabled="disabled" >

					 <span class="sub_delivery_days"><?php echo (!empty($user_language[$user_selected]['lg_day']))?$user_language[$user_selected]['lg_day']:$default_language['en']['lg_day']; ?></span></span>                                             

					</div>	

					<div class="name-block3">                                               

					</div>	

				</div>

				<small class="error_msg" id="super_fast_delivery_time_error"> </small>

				<small class="error_msg help-block super_fast_error" style="display: none;" ><?php echo (!empty($user_language[$user_selected]['lg_please_enter_a_description']))?$user_language[$user_selected]['lg_please_enter_a_description']:$default_language['en']['lg_please_enter_a_description']; ?></small>

				<small class="error_msg help-block super_fast_priece_error" style="display: none;" ><?php echo (!empty($user_language[$user_selected]['lg_please_enter_a_super_fast_price']))?$user_language[$user_selected]['lg_please_enter_a_super_fast_price']:$default_language['en']['lg_please_enter_a_super_fast_price']; ?></small>

				</div>

								<div class="form-group select-condition clearfix">

									<label class="label-title"><?php echo (!empty($user_language[$user_selected]['lg_how_are_you_planning_to_work_with_the_buyer']))?$user_language[$user_selected]['lg_how_are_you_planning_to_work_with_the_buyer']:$default_language['en']['lg_how_are_you_planning_to_work_with_the_buyer']; ?>? <span class="required">*</span></label>

									<div class="buyer-option">

										<div class="radio radio-primary">

											<input type="radio" value="0" id="radio3" name="work_option">

											<label for="radio3">

												<?php echo (!empty($user_language[$user_selected]['lg_remotely']))?$user_language[$user_selected]['lg_remotely']:$default_language['en']['lg_remotely']; ?>

											</label>

										</div>

										<div class="radio radio-primary">

											<input type="radio"  value="1" id="radio4" name="work_option">

											<label for="radio4">

												<?php echo (!empty($user_language[$user_selected]['lg_on']))?$user_language[$user_selected]['lg_on']:$default_language['en']['lg_on']; ?>-<?php echo (!empty($user_language[$user_selected]['lg_site']))?$user_language[$user_selected]['lg_site']:$default_language['en']['lg_site']; ?> 

											</label>

										</div>

										<small class="error_msg help-block work_option_error" style="display: none;" ><?php echo (!empty($user_language[$user_selected]['lg_please_select_any_option']))?$user_language[$user_selected]['lg_please_select_any_option']:$default_language['en']['lg_please_select_any_option']; ?></small>

									</div>

								</div>

								<div class="form-group item-description clearfix">

									<label class="label-title"><?php echo (!empty($user_language[$user_selected]['lg_what_do_you_need_from_the_buyer_to_get_started']))?$user_language[$user_selected]['lg_what_do_you_need_from_the_buyer_to_get_started']:$default_language['en']['lg_what_do_you_need_from_the_buyer_to_get_started']; ?> </label>

                                     <textarea rows="4" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_explain_what_you_will_need_from_the_buyer_to_deliver_the_world']))?$user_language[$user_selected]['lg_explain_what_you_will_need_from_the_buyer_to_deliver_the_world']:$default_language['en']['lg_explain_what_you_will_need_from_the_buyer_to_deliver_the_world']; ?>..." name="requirements" id="requirements" class="form-control"></textarea>

                                     <?php echo display_ckeditor($ckeditor_editor_one); ?>

								</div>

								<div class="form-group agreement clearfix">

									<div class="checkbox checkbox-primary checkbox-inline">

                                      <input type="checkbox" name="terms_conditions" id="terms_conditions" value="terms_conditions"  >

									<label for="terms_conditions">&nbsp; </label>

									</div>

									<?php echo (!empty($user_language[$user_selected]['lg_i_confirm_that_i_am_able_to_deliver_this_service_to_buyers_within_the_delivery_time_specified']))?$user_language[$user_selected]['lg_i_confirm_that_i_am_able_to_deliver_this_service_to_buyers_within_the_delivery_time_specified']:$default_language['en']['lg_i_confirm_that_i_am_able_to_deliver_this_service_to_buyers_within_the_delivery_time_specified']; ?>.<br>

									<?php echo (!empty($user_language[$user_selected]['lg_i_will_update_or_pause_my_gig_if_i_can_no_longer_meet_this_delivery_time']))?$user_language[$user_selected]['lg_i_will_update_or_pause_my_gig_if_i_can_no_longer_meet_this_delivery_time']:$default_language['en']['lg_i_will_update_or_pause_my_gig_if_i_can_no_longer_meet_this_delivery_time']; ?>.<br>

									<?php echo (!empty($user_language[$user_selected]['lg_i_understand_that_late_delivery_will_adversely_affect_my_rankings_on']))?$user_language[$user_selected]['lg_i_understand_that_late_delivery_will_adversely_affect_my_rankings_on']:$default_language['en']['lg_i_understand_that_late_delivery_will_adversely_affect_my_rankings_on']; ?><span class="sitename2"><?php  if(!empty($site_name)) {echo  $site_name; } ?></span> <?php echo (!empty($user_language[$user_selected]['lg_and_will_entitle_the_buyer_to_a_refund']))?$user_language[$user_selected]['lg_and_will_entitle_the_buyer_to_a_refund']:$default_language['en']['lg_and_will_entitle_the_buyer_to_a_refund']; ?>. <?php echo (!empty($user_language[$user_selected]['lg_see']))?$user_language[$user_selected]['lg_see']:$default_language['en']['lg_see']; ?> <a href="<?php echo base_url().'tandc'?>" target="_blank" class="chk-link"> T&amp;Cs </a>

									<small class="error_msg help-block terms_conditions_error" style="display: none;"><?php echo (!empty($user_language[$user_selected]['lg_please_accept_terms']))?$user_language[$user_selected]['lg_please_accept_terms']:$default_language['en']['lg_please_accept_terms']; ?> & <?php echo (!empty($user_language[$user_selected]['lg_conditions']))?$user_language[$user_selected]['lg_conditions']:$default_language['en']['lg_conditions']; ?></small>

								</div>

								<input type="hidden" name="form_submit" value="add"> 

								<a href="javascript:void(0)" onclick="sell_services_add()" class="btn btn-yellow sell_service_submit"  ><?php echo (!empty($user_language[$user_selected]['lg_post_your_ad']))?$user_language[$user_selected]['lg_post_your_ad']:$default_language['en']['lg_post_your_ad']; ?></a> 

                                

							</form>

						</div>

						<div class="col-md-4 hidden-xs hidden-sm">

							<div class="left-sidebar">	

								<div class="testimonials">	

									<p>"<?php echo (!empty($user_language[$user_selected]['lg_if_people_understood_the_banking_system_they_would_revolt']))?$user_language[$user_selected]['lg_if_people_understood_the_banking_system_they_would_revolt']:$default_language['en']['lg_if_people_understood_the_banking_system_they_would_revolt']; ?>."</p>

									<span class="client-name"><?php echo (!empty($user_language[$user_selected]['lg_henry_ford']))?$user_language[$user_selected]['lg_henry_ford']:$default_language['en']['lg_henry_ford']; ?></span>		

								</div>	

								<div class="daily-figures">	

									<span>.</span><br>

									<span><p class="figure-title">“<?php echo (!empty($user_language[$user_selected]['lg_latest']))?$user_language[$user_selected]['lg_latest']:$default_language['en']['lg_latest']; ?><br><?php echo (!empty($user_language[$user_selected]['lg_daily_figures']))?$user_language[$user_selected]['lg_daily_figures']:$default_language['en']['lg_daily_figures']; ?>”</p></span>

									<span>.</span><br>	

									<span><i class="fa fa-chevron-down"></i></span>	

								</div>

							</div>

						</div>

					</div>	

				</div>	

			</section>

<div class="modal fade" id="avatar-gig-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" data-backdrop="static" data-keyboard="false" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">   

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal">&times;</button>

				<h4 class="modal-title"><?php echo (!empty($user_language[$user_selected]['lg_upload_image']))?$user_language[$user_selected]['lg_upload_image']:$default_language['en']['lg_upload_image']; ?></h4>

                <span id="image_size" > <?php echo (!empty($user_language[$user_selected]['lg_please_upload_a_image_of_size_above']))?$user_language[$user_selected]['lg_please_upload_a_image_of_size_above']:$default_language['en']['lg_please_upload_a_image_of_size_above']; ?> 680*460 </span> 

			</div>

			<div class="modal-body">

				<div id="gigimg_loader" class="loader-wrap" style="display: none;">

					<div class="loader"><?php echo (!empty($user_language[$user_selected]['lg_loading']))?$user_language[$user_selected]['lg_loading']:$default_language['en']['lg_loading']; ?>...</div>

				</div>

				<div class="image-editor">

					<input type="hidden" name="select_row_id" id="select_row_id" value="1" />

					<input type="file" id="fileopen"  name="file" class="cropit-image-input">

					<span class="error_msg help-block" id="error_msg_model" ></span> 

					<div class="cropit-preview"></div>

					<div class="row resize-bottom">

						<div class="col-md-4">

							<div class="image-size-label"><?php echo (!empty($user_language[$user_selected]['lg_resize_image']))?$user_language[$user_selected]['lg_resize_image']:$default_language['en']['lg_resize_image']; ?></div>

						</div>

						<div class="col-md-4"><input type="range" class="custom cropit-image-zoom-input"></div>

						<div class="col-md-4 text-right"><button class="btn btn-primary export"><?php echo (!empty($user_language[$user_selected]['lg_done']))?$user_language[$user_selected]['lg_done']:$default_language['en']['lg_done']; ?></button></div>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>



<div class="modal custom-popup fade" id="third-party-gig-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" data-backdrop="static" data-keyboard="false" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">   

			<div class="modal-header text-center">

				<button type="button" class="close" data-dismiss="modal">&times;</button>

				<h5 class="modal-title"> <?php echo (!empty($user_language[$user_selected]['lg_upload_video_link']))?$user_language[$user_selected]['lg_upload_video_link']:$default_language['en']['lg_upload_video_link']; ?> </h5>

			</div>

			<div class="modal-body">

				<div class="form-group">

					<label> <?php echo (!empty($user_language[$user_selected]['lg_upload_video_link']))?$user_language[$user_selected]['lg_upload_video_link']:$default_language['en']['lg_upload_video_link']; ?> : </label>	 <input type="url" name="" class="form-control" id="youtube_url_link" value="" />

					<span id ="error_youtube_link" class="error_msg" >  </span>

				</div>

				<div class="form-group">

					<label> <?php echo (!empty($user_language[$user_selected]['lg_vimeo_link']))?$user_language[$user_selected]['lg_vimeo_link']:$default_language['en']['lg_vimeo_link']; ?> : </label>	 <input type="url" name="" class="form-control" id="vimeo_url_link"  value="" />

					<span id ="error_vimeo_link" class="error_msg" >  </span>

				</div>   

                 <button type="button" class="btn btn-primary logon-btn" id="third_party_videos" value="submit" ><?php echo (!empty($user_language[$user_selected]['lg_submit']))?$user_language[$user_selected]['lg_submit']:$default_language['en']['lg_submit']; ?></button>

			</div>

		</div>

	</div>

</div>





<div class="extra_gig_content" style="display: none;">

<div class='clearfix extra-gig-option' id='row_id_#' >

	<span class='close-offer'><i class='fa fa-times' aria-hidden='true' onclick='remove_div(#);' ></i></span>

    <div class='name-block2'>

        <span class='name-input2'>

        	<input type='text' name='extra_gigs[]' value='' class='form-control extra_money_price gig-name gigs_name_opt' date-no="#" id='label_name_#' placeholder='I can'></span>

        <span class='currency'><?php echo (!empty($user_language[$user_selected]['lg_for']))?$user_language[$user_selected]['lg_for']:$default_language['en']['lg_for']; ?> 
        	<span class='currency-group'><?php echo $currency_sign; ?> 
        	<input type='text' class='form-control amount numberonly' name='extra_gigs_amount[]' data-bv-field='extra_gigs_amount[]' onfocusout="inputfocusout(this)" <?php  echo ($allow==1)?'':'readonly'; ?> id='label_val_#' value='<?php echo $ex_price; ?>'>
        </span> <?php echo (!empty($user_language[$user_selected]['lg_in']))?$user_language[$user_selected]['lg_in']:$default_language['en']['lg_in']; ?>
        <input type='text'   class='form-control amount2 numberonly addmore' value='1' onkeypress='return event.charCode >= 48 && event.charCode <= 57'  onkeyup='extra_gig_days(this,1)'  onfocusout='inputfocusout(this)' onmouseup='extra_gig_days(this,1)'  name='extra_gigs_delivery[]'>

        <span class='sub_delivery_days'><?php echo (!empty($user_language[$user_selected]['lg_day']))?$user_language[$user_selected]['lg_day']:$default_language['en']['lg_day']; ?></span></span>

	</div>	

</div>	

</div>	