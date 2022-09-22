<?php 
$this->load->helper('custom_language');

 $default_language_select=default_language();

      if($this->session->userdata('user_select_language')=='')
      {
       $user_selected = $default_language_select['language_value']; 
      }
      else
      {
        $user_selected =$this->session->userdata('user_select_language');
      }

      // $user_selected  = $this->session->userdata('user_select_language');
      // $active_language = active_language();
      // $my_language = array();
      // $my_language[] ='en';

      // if(!empty($active_language)){

      //   foreach ($active_language as $value) {

      //     $my_language[] = $value['language_value'];

      //   }
      // }
      // $activelang = array_filter($my_language);
       
      // $key = $user_selected;
    
      // if (!in_array($key, $activelang)) {

      //    //$user_selected = 'en';
      //  // $this->session->set_userdata('user_select_language','en');
      // }
      // $user_selected = (!empty($user_selected))?$user_selected:'en';
     
      $lg = custom_language($user_selected);
      $default_language = $lg['default_lang']; 
      $user_language = $lg['user_lang'];

    

 ?>
<script type="text/javascript">
    

	var old_password = '<?php echo (!empty($user_language[$user_selected]['lg_please_enter_your_old_password']))?$user_language[$user_selected]['lg_please_enter_your_old_password']:$default_language['en']['lg_please_enter_your_old_password']; ?>';

	var check_password = '<?php echo (!empty($user_language[$user_selected]['lg_the_password_is_not_correct']))?$user_language[$user_selected]['lg_the_password_is_not_correct']:$default_language['en']['lg_the_password_is_not_correct']; ?>';

	var new_password = '<?php echo (!empty($user_language[$user_selected]['lg_please_enter_your_new_password']))?$user_language[$user_selected]['lg_please_enter_your_new_password']:$default_language['en']['lg_please_enter_your_new_password']; ?>';

	var repeate_password = '<?php echo (!empty($user_language[$user_selected]['lg_please_reenter_your_new_password']))?$user_language[$user_selected]['lg_please_reenter_your_new_password']:$default_language['en']['lg_please_reenter_your_new_password']; ?>';

	var match_password = "<?php echo (!empty($user_language[$user_selected]['lg_the_new_password_and_confirm_password_does_not_match']))?$user_language[$user_selected]['lg_the_new_password_and_confirm_password_does_not_match']:$default_language['en']['lg_the_new_password_and_confirm_password_does_not_match']; ?>";

	var username = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_your_user_name']))?$user_language[$user_selected]['lg_please_enter_your_user_name']:$default_language['en']['lg_please_enter_your_user_name']; ?>";
	
	var email = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_your_email_address']))?$user_language[$user_selected]['lg_please_enter_your_email_address']:$default_language['en']['lg_please_enter_your_email_address']; ?>";
	
	var valid_email = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_a_valid_email_address']))?$user_language[$user_selected]['lg_please_enter_a_valid_email_address']:$default_language['en']['lg_please_enter_a_valid_email_address']; ?>";

	var phone_number = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_your_phone_number']))?$user_language[$user_selected]['lg_please_enter_your_phone_number']:$default_language['en']['lg_please_enter_your_phone_number']; ?>";

	var address = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_your__address']))?$user_language[$user_selected]['lg_please_enter_your__address']:$default_language['en']['lg_please_enter_your__address']; ?>";

	var city = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_your_city']))?$user_language[$user_selected]['lg_please_enter_your_city']:$default_language['en']['lg_please_enter_your_city']; ?>";

	var zip_code = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_your_zip_code']))?$user_language[$user_selected]['lg_please_enter_your_zip_code']:$default_language['en']['lg_please_enter_your_zip_code']; ?>";

	var reset_link = "<?php echo (!empty($user_language[$user_selected]['lg_we_have_sent_you_mail_with_password_reset_link']))?$user_language[$user_selected]['lg_we_have_sent_you_mail_with_password_reset_link']:$default_language['en']['lg_we_have_sent_you_mail_with_password_reset_link']; ?>";

	var password_does_not_match = "<?php echo (!empty($user_language[$user_selected]['lg_password_does_not_match']))?$user_language[$user_selected]['lg_password_does_not_match']:$default_language['en']['lg_password_does_not_match']; ?>";

	var your_username = "<?php echo (!empty($user_language[$user_selected]['lg_your_username']))?$user_language[$user_selected]['lg_your_username']:$default_language['en']['lg_your_username']; ?>";

	var name = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_your__name']))?$user_language[$user_selected]['lg_please_enter_your__name']:$default_language['en']['lg_please_enter_your__name']; ?>";

	var existing_user = "<?php echo (!empty($user_language[$user_selected]['lg_the_username_is_already_exists']))?$user_language[$user_selected]['lg_the_username_is_already_exists']:$default_language['en']['lg_the_username_is_already_exists']; ?>";

	var existing_email = "<?php echo (!empty($user_language[$user_selected]['lg_the_email_is_already_exists']))?$user_language[$user_selected]['lg_the_email_is_already_exists']:$default_language['en']['lg_the_email_is_already_exists']; ?>";

	var country = "<?php echo (!empty($user_language[$user_selected]['lg_please_select_a_country']))?$user_language[$user_selected]['lg_please_select_a_country']:$default_language['en']['lg_please_select_a_country']; ?>";

	var state = "<?php echo (!empty($user_language[$user_selected]['lg_please_select_a_state']))?$user_language[$user_selected]['lg_please_select_a_state']:$default_language['en']['lg_please_select_a_state']; ?>";

	var login_username_email = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_username_or_email']))?$user_language[$user_selected]['lg_please_enter_username_or_email']:$default_language['en']['lg_please_enter_username_or_email']; ?>";

	var enter_password = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_password']))?$user_language[$user_selected]['lg_please_enter_password']:$default_language['en']['lg_please_enter_password']; ?>";

	var password_validation = "<?php echo (!empty($user_language[$user_selected]['lg_the_password_must_be_8_to_20_characters_with_a_special_character_and_number']))?$user_language[$user_selected]['lg_the_password_must_be_8_to_20_characters_with_a_special_character_and_number']:$default_language['en']['lg_the_password_must_be_8_to_20_characters_with_a_special_character_and_number']; ?>";

	var wrong_login = "<?php echo (!empty($user_language[$user_selected]['lg_login_failed_wrong_user_credentials']))?$user_language[$user_selected]['lg_login_failed_wrong_user_credentials']:$default_language['en']['lg_login_failed_wrong_user_credentials']; ?>";

	var activation_link = "<?php echo (!empty($user_language[$user_selected]['lg_activation_link_has_been_sent_to_your_mailid']))?$user_language[$user_selected]['lg_activation_link_has_been_sent_to_your_mailid']:$default_language['en']['lg_activation_link_has_been_sent_to_your_mailid']; ?>";

	var deactivated = "<?php echo (!empty($user_language[$user_selected]['lg_your_account_has_been_deactivated']))?$user_language[$user_selected]['lg_your_account_has_been_deactivated']:$default_language['en']['lg_your_account_has_been_deactivated']; ?>";

	var contact_admin = "<?php echo (!empty($user_language[$user_selected]['lg_please_contact_admin']))?$user_language[$user_selected]['lg_please_contact_admin']:$default_language['en']['lg_please_contact_admin']; ?>";

	var currency_field = "<?php echo (!empty($user_language[$user_selected]['lg_currency_field_is_required']))?$user_language[$user_selected]['lg_currency_field_is_required']:$default_language['en']['lg_currency_field_is_required']; ?>";

	var your_password_must = "<?php echo (!empty($user_language[$user_selected]['lg_your_password_must']))?$user_language[$user_selected]['lg_your_password_must']:$default_language['en']['lg_your_password_must']; ?>";

	var be_at_least_8_characters = "<?php echo (!empty($user_language[$user_selected]['lg_be_at_least_8_characters']))?$user_language[$user_selected]['lg_be_at_least_8_characters']:$default_language['en']['lg_be_at_least_8_characters']; ?>";

	var include_a_lowercase_letter = "<?php echo (!empty($user_language[$user_selected]['lg_include_a_lowercase_letter']))?$user_language[$user_selected]['lg_include_a_lowercase_letter']:$default_language['en']['lg_include_a_lowercase_letter']; ?>";

	var include_a_number = "<?php echo (!empty($user_language[$user_selected]['lg_include_a_number']))?$user_language[$user_selected]['lg_include_a_number']:$default_language['en']['lg_include_a_number']; ?>";

	var include_an_uppercase_letter = "<?php echo (!empty($user_language[$user_selected]['lg_include_an_uppercase_letter']))?$user_language[$user_selected]['lg_include_an_uppercase_letter']:$default_language['en']['lg_include_an_uppercase_letter']; ?>";

	var include_a_special_character = "<?php echo (!empty($user_language[$user_selected]['lg_include_a_special_character']))?$user_language[$user_selected]['lg_include_a_special_character']:$default_language['en']['lg_include_a_special_character']; ?>";

	var something_went_wrong = "<?php echo (!empty($user_language[$user_selected]['lg_something_went_wrong']))?$user_language[$user_selected]['lg_something_went_wrong']:$default_language['en']['lg_something_went_wrong']; ?>";

	var thanks = "<?php echo (!empty($user_language[$user_selected]['lg_thanks']))?$user_language[$user_selected]['lg_thanks']:$default_language['en']['lg_thanks']; ?>";

	var reset_link = "<?php echo (!empty($user_language[$user_selected]['lg_reset_link']))?$user_language[$user_selected]['lg_reset_link']:$default_language['en']['lg_reset_link']; ?>";

	var activation_mail_has_been_sent_to_registered_mail_id = "<?php echo (!empty($user_language[$user_selected]['lg_activation_mail_has_been_sent_to_registered_mail_id']))?$user_language[$user_selected]['lg_activation_mail_has_been_sent_to_registered_mail_id']:$default_language['en']['lg_activation_mail_has_been_sent_to_registered_mail_id']; ?>";

	var the_days_should_be_less_than_actual_delivery_days = "<?php echo (!empty($user_language[$user_selected]['lg_the_days_should_be_less_than_actual_delivery_days']))?$user_language[$user_selected]['lg_the_days_should_be_less_than_actual_delivery_days']:$default_language['en']['lg_the_days_should_be_less_than_actual_delivery_days']; ?>";

	var please_enter_a_correct_url = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_a_correct_url']))?$user_language[$user_selected]['lg_please_enter_a_correct_url']:$default_language['en']['lg_please_enter_a_correct_url']; ?>";

	var please_enter_any_one_url = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_any_one_url']))?$user_language[$user_selected]['lg_please_enter_any_one_url']:$default_language['en']['lg_please_enter_any_one_url']; ?>";

	var please_upload_size_more_than = "<?php echo (!empty($user_language[$user_selected]['lg_please_upload_size_more_than']))?$user_language[$user_selected]['lg_please_upload_size_more_than']:$default_language['en']['lg_please_upload_size_more_than']; ?>";

	var invalid_extension = "<?php echo (!empty($user_language[$user_selected]['lg_invalid_extension']))?$user_language[$user_selected]['lg_invalid_extension']:$default_language['en']['lg_invalid_extension']; ?>";

	var supports = "<?php echo (!empty($user_language[$user_selected]['lg_supports']))?$user_language[$user_selected]['lg_supports']:$default_language['en']['lg_supports']; ?>";

	var files_only = "<?php echo (!empty($user_language[$user_selected]['lg_files_only']))?$user_language[$user_selected]['lg_files_only']:$default_language['en']['lg_files_only']; ?>";

	var saved = "<?php echo (!empty($user_language[$user_selected]['lg_saved']))?$user_language[$user_selected]['lg_saved']:$default_language['en']['lg_saved']; ?>";

	var save = "<?php echo (!empty($user_language[$user_selected]['lg_save']))?$user_language[$user_selected]['lg_save']:$default_language['en']['lg_save']; ?>";

	var for_index = "<?php echo (!empty($user_language[$user_selected]['lg_for']))?$user_language[$user_selected]['lg_for']:$default_language['en']['lg_for']; ?>";

	var in_index = "<?php echo (!empty($user_language[$user_selected]['lg_in']))?$user_language[$user_selected]['lg_in']:$default_language['en']['lg_in']; ?>";

	var day_index = "<?php echo (!empty($user_language[$user_selected]['lg_day']))?$user_language[$user_selected]['lg_day']:$default_language['en']['lg_day']; ?>";

	var i_can = "<?php echo (!empty($user_language[$user_selected]['lg_i_can']))?$user_language[$user_selected]['lg_i_can']:$default_language['en']['lg_i_can']; ?>";

	var please_upload_file_having_extensions = "<?php echo (!empty($user_language[$user_selected]['lg_please_upload_file_having_extensions']))?$user_language[$user_selected]['lg_please_upload_file_having_extensions']:$default_language['en']['lg_please_upload_file_having_extensions']; ?>";

	var zip_only = "<?php echo (!empty($user_language[$user_selected]['lg_zip_only']))?$user_language[$user_selected]['lg_zip_only']:$default_language['en']['lg_zip_only']; ?>";

	var maximum_upload_files_size_less_than_or_equal_to_5_mb = "<?php echo (!empty($user_language[$user_selected]['lg_maximum_upload_files_size_less_than_or_equal_to_5_mb']))?$user_language[$user_selected]['lg_maximum_upload_files_size_less_than_or_equal_to_5_mb']:$default_language['en']['lg_maximum_upload_files_size_less_than_or_equal_to_5_mb']; ?>";

	var remove = "<?php echo (!empty($user_language[$user_selected]['lg_remove']))?$user_language[$user_selected]['lg_remove']:$default_language['en']['lg_remove']; ?>";

	var are_you_sure_you_want_to_remove_this = "<?php echo (!empty($user_language[$user_selected]['lg_are_you_sure_you_want_to_remove_this']))?$user_language[$user_selected]['lg_are_you_sure_you_want_to_remove_this']:$default_language['en']['lg_are_you_sure_you_want_to_remove_this']; ?>";

	var cancel = "<?php echo (!empty($user_language[$user_selected]['lg_cancel']))?$user_language[$user_selected]['lg_cancel']:$default_language['en']['lg_cancel']; ?>";

	var confirm = "<?php echo (!empty($user_language[$user_selected]['lg_confirm']))?$user_language[$user_selected]['lg_confirm']:$default_language['en']['lg_confirm']; ?>";

	var accept = "<?php echo (!empty($user_language[$user_selected]['lg_accept']))?$user_language[$user_selected]['lg_accept']:$default_language['en']['lg_accept']; ?>";

	var please_enter_some_content = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_some_content']))?$user_language[$user_selected]['lg_please_enter_some_content']:$default_language['en']['lg_please_enter_some_content']; ?>";

	var please_add_rating = "<?php echo (!empty($user_language[$user_selected]['lg_please_add_rating']))?$user_language[$user_selected]['lg_please_add_rating']:$default_language['en']['lg_please_add_rating']; ?>";

	var please_select_users = "<?php echo (!empty($user_language[$user_selected]['lg_please_select_users']))?$user_language[$user_selected]['lg_please_select_users']:$default_language['en']['lg_please_select_users']; ?>";
	
	var account_number = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_a_account_number']))?$user_language[$user_selected]['lg_please_enter_a_account_number']:$default_language['en']['lg_please_enter_a_account_number']; ?>";
	
	var bank_name = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_a_bank_name']))?$user_language[$user_selected]['lg_please_enter_a_bank_name']:$default_language['en']['lg_please_enter_a_bank_name']; ?>";
	
	var ifsc_code = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_ifsc_code']))?$user_language[$user_selected]['lg_please_enter_ifsc_code']:$default_language['en']['lg_please_enter_ifsc_code']; ?>";
	
	var bank_address = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_bank_address']))?$user_language[$user_selected]['lg_please_enter_bank_address']:$default_language['en']['lg_please_enter_bank_address']; ?>";
	
	var pancard_no = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_pancard_no']))?$user_language[$user_selected]['lg_please_enter_pancard_no']:$default_language['en']['lg_please_enter_pancard_no']; ?>";
	
	var paypal_email_id = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_paypal_email_id']))?$user_language[$user_selected]['lg_please_enter_paypal_email_id']:$default_language['en']['lg_please_enter_paypal_email_id']; ?>";

	var accept = "<?php echo (!empty($user_language[$user_selected]['lg_accept']))?$user_language[$user_selected]['lg_accept']:$default_language['en']['lg_accept']; ?>";


	var please_enter_cancellation_reason_and_paypal_id = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_cancellation_reason_and_paypal_id']))?$user_language[$user_selected]['lg_please_enter_cancellation_reason_and_paypal_id']:$default_language['en']['lg_please_enter_cancellation_reason_and_paypal_id']; ?>";


	var please_enter_cancellation_reason = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_cancellation_reason']))?$user_language[$user_selected]['lg_please_enter_cancellation_reason']:$default_language['en']['lg_please_enter_cancellation_reason']; ?>";


	var please_enter_the_paypal_id = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_the_paypal_id']))?$user_language[$user_selected]['lg_please_enter_the_paypal_id']:$default_language['en']['lg_please_enter_the_paypal_id']; ?>";


	var please_enter_id = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_id']))?$user_language[$user_selected]['lg_please_enter_id']:$default_language['en']['lg_please_enter_id']; ?>";


	var please_provide_your_bank_sort_code_or_routing_number_or_ifsc_code = "<?php echo (!empty($user_language[$user_selected]['lg_please_provide_your_bank_sort_code_or_routing_number_or_ifsc_code']))?$user_language[$user_selected]['lg_please_provide_your_bank_sort_code_or_routing_number_or_ifsc_code']:$default_language['en']['lg_please_provide_your_bank_sort_code_or_routing_number_or_ifsc_code']; ?>";


	var enter_message_content = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_message_content']))?$user_language[$user_selected]['lg_please_enter_message_content']:$default_language['en']['lg_please_enter_message_content']; ?>";


	var messages = "<?php echo (!empty($user_language[$user_selected]['lg_messages']))?$user_language[$user_selected]['lg_messages']:$default_language['en']['lg_messages']; ?>";


	var see_all_notifications = "<?php echo (!empty($user_language[$user_selected]['lg_see_all_notifications']))?$user_language[$user_selected]['lg_see_all_notifications']:$default_language['en']['lg_see_all_notifications']; ?>";


	var see_all_messages = "<?php echo (!empty($user_language[$user_selected]['lg_see_all_messages']))?$user_language[$user_selected]['lg_see_all_messages']:$default_language['en']['lg_see_all_messages']; ?>";


	var notifications = "<?php echo (!empty($user_language[$user_selected]['lg_notifications']))?$user_language[$user_selected]['lg_notifications']:$default_language['en']['lg_notifications']; ?>";


	var no_chats_available = "<?php echo (!empty($user_language[$user_selected]['lg_no_chats_available']))?$user_language[$user_selected]['lg_no_chats_available']:$default_language['en']['lg_no_chats_available']; ?>";


	var no_message = "<?php echo (!empty($user_language[$user_selected]['lg_no_message']))?$user_language[$user_selected]['lg_no_message']:$default_language['en']['lg_no_message']; ?>";


	var please_upload_image_file_only = "<?php echo (!empty($user_language[$user_selected]['lg_please_upload_image_file_only']))?$user_language[$user_selected]['lg_please_upload_image_file_only']:$default_language['en']['lg_please_upload_image_file_only']; ?>";


	var error_occured = "<?php echo (!empty($user_language[$user_selected]['lg_error_occured']))?$user_language[$user_selected]['lg_error_occured']:$default_language['en']['lg_error_occured']; ?>";


	var loading_conversation = "<?php echo (!empty($user_language[$user_selected]['lg_loading_conversation']))?$user_language[$user_selected]['lg_loading_conversation']:$default_language['en']['lg_loading_conversation']; ?>";


	var please_enter_about_your_gig_details = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_about_your_gig_details']))?$user_language[$user_selected]['lg_please_enter_about_your_gig_details']:$default_language['en']['lg_please_enter_about_your_gig_details']; ?>";


	var please_enter_a_description = "<?php echo (!empty($user_language[$user_selected]['lg_please_enter_a_description']))?$user_language[$user_selected]['lg_please_enter_a_description']:$default_language['en']['lg_please_enter_a_description']; ?>";


	var please_upload_atleast_one_image = "<?php echo (!empty($user_language[$user_selected]['lg_please_upload_atleast_one_image']))?$user_language[$user_selected]['lg_please_upload_atleast_one_image']:$default_language['en']['lg_please_upload_atleast_one_image']; ?>";

	var lg_search_your_gigs = '<?php echo (!empty($user_language[$user_selected]['lg_search_your_gigs']))?$user_language[$user_selected]['lg_search_your_gigs']:$default_language['en']['lg_search_your_gigs']; ?>';
	
</script>