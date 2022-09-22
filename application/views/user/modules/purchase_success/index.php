<div class="content page-content">

	<div class="container">

		<div class="row">

			<div class="col-lg-12 ">

                <div class="text-center">

                		<?php if($this->session->userdata('message') && $i ==0) { ?>

		<div class="alert alert-danger text-center fade in" id="flash_succ_message"><?php echo $this->session->userdata('message');?></div>

    <?php   $this->session->unset_userdata('message'); } ?>

                    <h1><?php echo (!empty($user_language[$user_selected]['lg_thank_you_for_purchasing']))?$user_language[$user_selected]['lg_thank_you_for_purchasing']:$default_language['en']['lg_thank_you_for_purchasing']; ?></h1>

                    <h4><?php echo (!empty($user_language[$user_selected]['lg_we_will_let_you_know_when_your_items_are_complete']))?$user_language[$user_selected]['lg_we_will_let_you_know_when_your_items_are_complete']:$default_language['en']['lg_we_will_let_you_know_when_your_items_are_complete']; ?></h4>

                </div>

                <?php 

				

				$country_name = $this->session->userdata('country_name');

				$rate = $purchase_details['item_amount'];

				$currency_option = (!empty($purchase_details['currency_type']))?$purchase_details['currency_type']:'USD';
                $rate_symbol = currency_sign($currency_option);

				/*$currency_option = $purchase_details['currency_type'];

				$rate_symbol = '$';

				

					if(!empty($currency_option)=='USD'){ $rate_symbol = '$'; }

					if(!empty($currency_option)=='EUR'){ $rate_symbol = '€'; }

					if(!empty($currency_option)=='GBP'){ $rate_symbol = '£'; }
*/


				 $created_on = date('j F Y g:i A', strtotime($purchase_details['created_at']));

				?>

				<div class="table-responsive m-t-50">

					<table class="table">

						<thead>

							<tr>

								<th><?php echo (!empty($user_language[$user_selected]['lg_order_details']))?$user_language[$user_selected]['lg_order_details']:$default_language['en']['lg_order_details']; ?></th>







								<th><?php echo (!empty($user_language[$user_selected]['lg_transaction_id']))?$user_language[$user_selected]['lg_transaction_id']:$default_language['en']['lg_transaction_id']; ?></th>







								<th><?php echo (!empty($user_language[$user_selected]['lg_seller']))?$user_language[$user_selected]['lg_seller']:$default_language['en']['lg_seller']; ?></th>







								<th><?php echo (!empty($user_language[$user_selected]['lg_amount']))?$user_language[$user_selected]['lg_amount']:$default_language['en']['lg_amount']; ?></th>



							</tr>

						</thead>

						<tbody>

							<tr>

								<td>

									<div class="product-group">

										<div class="pro_img">

											<a href="javascript:;"  onclick="purchase_view(<?php echo $purchase_details['id'];?>)" ><img src="<?php echo base_url().$purchase_details['gig_image'] ?>" class="thumb-sm" alt="<?php echo $purchase_details['title'] ; ?>"></a>

										</div>

										<div class="pull-left">

											<h4 class="product-name2"><a href="javascript:;"  onclick="purchase_view(<?php echo $purchase_details['id'];?>)" ><?php echo ucfirst(str_replace("-"," ",$purchase_details['title'])); ?></a></h4> <span class="order_date"><?php echo  $created_on; ?></span> 

										</div>

									</div>

								</td>

								<td>

								<?php 

									if($purchase_details['source']=='paypal' || $purchase_details['source']=='stripe')
									{

									if($purchase_details['paypal_uid'] =='issue'){ ?>

								    	<a href="javascript:void(0);" class="btn btn-xs btn-danger">Failed</a>

									<?php }else{ ?>

								<a href="javascript:;" onclick="purchase_view(<?php echo $purchase_details['id'];?>)" ><?php echo $purchase_details['paypal_uid'] ; ?></a>

								<?php } }


								if($purchase_details['source']=='paytabs')
									{

									if($purchase_details['paytabs_uid'] ==''){ ?>

								    	<a href="javascript:void(0);" class="btn btn-xs btn-danger">Failed</a>

									<?php }else{ ?>

								<a href="javascript:;" onclick="purchase_view(<?php echo $purchase_details['id'];?>)" ><?php echo $purchase_details['paytabs_uid'] ; ?></a>

								<?php } }


								 ?>

							</td>

								<td>

									<a href="<?php echo base_url().'user-profile/'.$purchase_details['username']; ?>" class="text-dark"><b><?php echo $purchase_details['fullname'] ; ?></b></a>

								</td>

								<td><b><?php echo $rate_symbol.$rate; ?></b></td>

							</tr>

						</tbody>

					</table>

				</div>

				<div class="text-center thanks-cont">

                    <h3><?php echo (!empty($user_language[$user_selected]['lg_if_you_want_check_your_all_purchases']))?$user_language[$user_selected]['lg_if_you_want_check_your_all_purchases']:$default_language['en']['lg_if_you_want_check_your_all_purchases']; ?>, <?php echo (!empty($user_language[$user_selected]['lg_click_on_below_link']))?$user_language[$user_selected]['lg_click_on_below_link']:$default_language['en']['lg_click_on_below_link']; ?></h3>

                    <a href="<?php echo base_url()."purchases"; ?>" class="btn btn-primary btn-border"><?php echo (!empty($user_language[$user_selected]['lg_view_my_orders']))?$user_language[$user_selected]['lg_view_my_orders']:$default_language['en']['lg_view_my_orders']; ?></a> <span class="or-space">or</span> <a href="<?php echo base_url()."buy-service"; ?>" class="underline-link"> <?php echo (!empty($user_language[$user_selected]['lg_continue_shopping']))?$user_language[$user_selected]['lg_continue_shopping']:$default_language['en']['lg_continue_shopping']; ?></a>

                </div>

			</div>

		</div>

	</div>

</div>

<div id="message-popup" class="modal fade custom-popup" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<button type="button" class="close" data-dismiss="modal">&times;</button>

			<div class="modal-body">

			<div class="msg-user-details" id="msg-user-details"></div>

				<div class="new-message">

				<div id="_error_" class="error_msg"></div>

				<form id="form_messagecontent_id" method="post" enctype="multipart/form-data" >

				<input type="hidden" name="sell_gigs_userid" id="sell_gigs_userid" value=""/>						

					<div class="form-group">

						<label class="form-label"><?php echo (!empty($user_language[$user_selected]['lg_your_message']))?$user_language[$user_selected]['lg_your_message']:$default_language['en']['lg_your_message']; ?></label>

						<textarea name="chat_message_content" placeholder="Message" required="" id="messageone" class="form-control"></textarea>

					</div>						

				</form>

			</div>

			<button type="submit" name="submit" class="btn btn-primary btn-style" onclick="save_newchat();"><?php echo (!empty($user_language[$user_selected]['lg_send']))?$user_language[$user_selected]['lg_send']:$default_language['en']['lg_send']; ?></button>

			</div>

		</div>

	</div>

</div>

<div id="purchase-popup" class="modal fade custom-popup order-popup" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content" id="purchases_model_deatils"></div>

	</div>

</div>