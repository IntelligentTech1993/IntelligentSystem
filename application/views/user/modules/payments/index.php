<?php 

	$payment_stripe = 0;

	$payment_paypal = 0;

    $payment_paytabs =0;



	if(!empty($system_setting)){

		foreach ($system_setting as $system) {

			if($system['key'] == 'stripe_allow'){

				$payment_stripe = $system['value'];

			}

			if($system['key'] == 'paypal_allow'){

				$payment_paypal = $system['value'];

			}

			if($system['key'] == 'paytabs_allow'){

				$payment_paytabs = $system['value'];

			}

		}

	}	



    	

    	

 ?>

	<div class="">

        <?php //$this->load->view('user/includes/search_include'); ?>

        <section class="profile-section">

            <div class="container">

                <div class="row">	

                    <div class="col-md-12">

                        <ol class="breadcrumb menu-breadcrumb">

                            <li><a href="#"><?php echo (!empty($user_language[$user_selected]['lg_home']))?$user_language[$user_selected]['lg_home']:$default_language['en']['lg_home']; ?></a> <i class="fa fa fa-chevron-right"></i></li>

                            <li class="active"><?php echo (!empty($user_language[$user_selected]['lg_my_profile']))?$user_language[$user_selected]['lg_my_profile']:$default_language['en']['lg_my_profile']; ?></li>        

                        </ol>

                    </div>

                </div>

                <div class="row">	

                    <div class="col-md-12">

                        <h3 class="page-title"><?php echo (!empty($user_language[$user_selected]['lg_my_payments']))?$user_language[$user_selected]['lg_my_payments']:$default_language['en']['lg_my_payments']; ?></h3>

                    </div>

                </div>

            </div>

        </section>

        <div class="tab-section grey-bg">

            <div class="container">

                <div class="row">

                    <div class="col-md-12">

                    	<div class="tab-list payments-tabs">

                            <ul>

                                <li>

									<a href="<?php echo base_url().'purchases';?>">

										<span class="visible-xxs"><i class="fa fa-credit-card" aria-hidden="true"></i> <?php if($order_count>0){?><span class="badge badge-white position-right"><?php echo $order_count ;?></span><?php }?></span> 

										<span class="hidden-xxs"><?php echo (!empty($user_language[$user_selected]['lg_my_purchases']))?$user_language[$user_selected]['lg_my_purchases']:$default_language['en']['lg_my_purchases']; ?> <?php if($order_count>0){?><span class="badge badge-white position-right"><?php echo $order_count ;?></span><?php }?></span>

									</a>

								</li>

                                <li>

									<a href="<?php echo base_url().'sales';?>">

										<span class="visible-xxs"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?php if($sell_order_count>0){?><span class="badge badge-white position-right"><?php echo $sell_order_count;?></span><?php }?></span> 

										<span class="hidden-xxs"><?php echo (!empty($user_language[$user_selected]['lg_my_sales']))?$user_language[$user_selected]['lg_my_sales']:$default_language['en']['lg_my_sales']; ?> <?php if($sell_order_count>0){?><span class="badge badge-white position-right"><?php echo $sell_order_count;?></span><?php }?></span>

									</a>

								</li>

                                <li class="active">

									<a href="javascript:;">

										<span class="visible-xxs"><i class="fa fa-money" aria-hidden="true"></i> <?php if($wallet_order_count>0){?><span class="badge badge-white position-right"><?php echo $wallet_order_count;?></span><?php }?></span> 

										<span class="hidden-xxs"><?php echo (!empty($user_language[$user_selected]['lg_my_payments']))?$user_language[$user_selected]['lg_my_payments']:$default_language['en']['lg_my_payments']; ?> <?php if($wallet_order_count>0){?><span class="badge badge-white position-right"><?php echo $wallet_order_count;?></span><?php }?></span>

									</a>

								</li>



								<li>

									<a href="<?php echo base_url().'files';?>">

										<span class="visible-xxs"><i class="fa fa-file" aria-hidden="true"></i></span> 

										<span class="hidden-xxs"><?php echo (!empty($user_language[$user_selected]['lg_my_files']))?$user_language[$user_selected]['lg_my_files']:$default_language['en']['lg_my_files']; ?></span>

									</a>

								</li>



                            </ul>

                        </div>		

                    </div>

                </div>

            </div>

        </div>

        <div class="tab-content grey-bg">

            <div class="container">

                <div class="row wallet-balance m-b-20">

                    <div class="col-md-6">

                        <div class="withdraw-amount">

                         <?php

						 $country_name = $this->session->userdata('country_name');

						 $rupee_rate  = $this->session->userdata('rupee_rate');

			  			$dollar_rate = $this->session->userdata('dollar_rate');

						 $t_amount=0;

						 $tl_amount=0;

						 $total_amount = 0;

						 $total_amount1 = 0;

						 $rate_symbol = '';
						 $all_sources = array();
						 if(!empty($order_details)) 

						 {

							foreach($order_details as $item_am) {
								
								$all_sources[] = $item_am['source'];

								if($item_am['payment_status']!=2)

								{

									$c_amounts =$item_am['item_amount'];		

									

									$commision_rate = (($c_amounts*$item_am['commision'])/100);

										$c_amount = $c_amounts - $commision_rate ;							

									$t_amount = $c_amount;

									$dollar_amount= $item_am['dollar_amount'];

									$t_amount = $c_amount;
 									$currency_option = (!empty($item_am['currency_type']))?$item_am['currency_type']:'USD';
									$rate_symbol = currency_sign($currency_option);	

									$total_amount += $t_amount;

								}

										

								if($item_am['payment_status']==0){

									$cls_amount =$item_am['item_amount'];

									$commision_rates = (($cls_amount*$item_am['commision'])/100);

										$cl_amount = $c_amounts - $commision_rates ;	

									$dl_amount =$item_am['dollar_amount'];

									$tl_amount = $cl_amount;

									$currency_option = (!empty($item_am['currency_type']))?$item_am['currency_type']:'USD';
									$rate_symbol = currency_sign($currency_option);	
 

												$tl_amount = $tl_amount;

											 

											

											$total_amount1 += $tl_amount;

								}

							}

						 }?>

                            <span class="unit-price"><?php echo (!empty($user_language[$user_selected]['lg_current_balance']))?$user_language[$user_selected]['lg_current_balance']:$default_language['en']['lg_current_balance']; ?>:</span> <span class="price-tag"><?php echo $rate_symbol ;?><?php echo $total_amount;?></span>

                        </div>

                    </div>

                    <?php if($total_amount1>0){

                    	$all_sources = array_unique($all_sources);
						$asc = count($all_sources);
                    ?>

					<div class="col-md-6 text-right">

						<a href="javascript:;" data-sources="<?php echo implode('-', $all_sources); ?>" onclick="withdraw_all(this,'<?php echo $asc; ?>');" class="withdraw_all_sources btn btn-primary btn-border text-uppercase bold"><?php echo (!empty($user_language[$user_selected]['lg_request_entire_amount']))?$user_language[$user_selected]['lg_request_entire_amount']:$default_language['en']['lg_request_entire_amount']; ?></a>

                    </div>

                    <?php }?>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="table-responsive order-table">

                        	<form method="post" autocomplete="off" action="<?php echo base_url();?>payments">
                                    		<table>
                                    			<tr>
                                    				<td><input value="<?php if(isset($_POST["fromdate"]) && !empty($_POST["fromdate"])) echo $_POST["fromdate"];?>" type="text" placeholder="From Date" class="form-control fromdate"  name="fromdate"></td>
                                    				<td><input type="text" placeholder="To Date" value="<?php if(isset($_POST["todate"]) && !empty($_POST["todate"])) echo $_POST["todate"];?>" class="form-control todate" name="todate"></td>
                                    				<?php
                                    				if(isset($_POST["orderstatus"]) && !empty($_POST["orderstatus"]))
                                    				{
                                    					$orderstatus= $_POST["orderstatus"];
                                    				}
                                    				else
                                    				{
                                    					$orderstatus= '';
                                    				} 
                                    					
                                    				?>
                                    				<td><select class="form-control" name="orderstatus">
                                    					<option value="" <?php if($orderstatus=='') echo 'selected';?>>Select Status</option>
                                    					<option value="1" <?php if($orderstatus=='1') echo 'selected';?>>Request Sent</option>
                                    					<option value="2" <?php if($orderstatus=='2') echo 'selected';?>>Payments Received</option>
                                    					</select>
	                                    			</td>
	                                    			<td><button name="form_submit" value="true" type="submit">Search</button></td>
	                                    			<td><button onclick="window.location.href='<?php echo base_url();?>sales'" name="form_submit" value="true" type="reset">Reset</button></td>
	                                    			</tr>
                                    		</table>
                                    		
                                    	</form>

                            <table class="table table-actions-bar">

                                <thead>

                                    <tr>

                                        <th><?php echo (!empty($user_language[$user_selected]['lg_order_date']))?$user_language[$user_selected]['lg_order_date']:$default_language['en']['lg_order_date']; ?></th>



                                        <th><?php echo (!empty($user_language[$user_selected]['lg_order_id']))?$user_language[$user_selected]['lg_order_id']:$default_language['en']['lg_order_id']; ?></th>



                                        <th><?php echo (!empty($user_language[$user_selected]['lg_buyer']))?$user_language[$user_selected]['lg_buyer']:$default_language['en']['lg_buyer']; ?></th>



                                        <th><?php echo (!empty($user_language[$user_selected]['lg_payments']))?$user_language[$user_selected]['lg_payments']:$default_language['en']['lg_payments']; ?></th>



                                        <th><?php echo (!empty($user_language[$user_selected]['lg_amount']))?$user_language[$user_selected]['lg_amount']:$default_language['en']['lg_amount']; ?></th>

                                    </tr>

                                </thead>



                                <tbody>

                                <?php

								 if(!empty($order_details)) 

								 {								

									 		$country_name = $this->session->userdata('country_name');

											$rupee_rate  = $this->session->userdata('rupee_rate');

											$dollar_rate  = $this->session->userdata('dollar_rate');

								 	

									foreach($order_details as $item) { 	

										 $source = $item['source']; 

                                         $seller_id = $item['seller_id']; 


								$currency_option = (!empty($item['currency_type']))?$item['currency_type']:'USD';
								$rate_symbol = currency_sign($currency_option);

								  			

									$rates = $item['item_amount'];

									$request_sent =  (!empty($user_language[$user_selected]['lg_request_sent']))?$user_language[$user_selected]['lg_request_sent']:$default_language['en']['lg_request_sent'];


								$payment_received =  (!empty($user_language[$user_selected]['lg_payment_received']))?$user_language[$user_selected]['lg_payment_received']:$default_language['en']['lg_payment_received'];


								$withdraw_amount =  (!empty($user_language[$user_selected]['lg_withdraw_amount']))?$user_language[$user_selected]['lg_withdraw_amount']:$default_language['en']['lg_withdraw_amount'];

									$commision_rate = (($rates*$item['commision'])/100);

										$rate = $rates - $commision_rate ;

									$rate = number_format((float)$rate, 2, '.', '');

											 

											

									$f_uid = $item['user_id'];

									$t_uid = $item['USERID'];

									$gid   = $item['gigs_id'];

									$id    = $item['id'];

									$status = $item['payment_status']; 

									if($status ==1) {

										$sts='<b class="text-danger">'.$request_sent.'</b>';

									}elseif($status ==2){

										$sts='<b class="text-success">'.$payment_received.'</b>';

									}else{

										$single ="'";

										$sts='<a href="javascript:;" onclick="withdram_model('.$id.','.$single.$source.$single.','.$seller_id.')" class="btn btn-primary btn-border btn-sm">'.$withdraw_amount.'</a>';

									}

									

									$created_on = '-';

									if (isset($item['created_at'])) {

										if (!empty($item['created_at']) && $item['created_at'] != "0000-00-00 00:00:00") {

											$created_on = date('j F Y g:i', strtotime($item['created_at']));

										}

									}

									if($item['gig_image_thumb']!='')

											{

												$image_url=base_url().$item['gig_image_thumb'];

											}

											else

											{

												$image_url='assets/images/gig-small.jpg';

											}

											$user_linkone=base_url().'user-profile/'.$item['username'];

								?>

                                    <tr>

                                        <td>

                                            <div class="product-group">

                                                <div class="pro_img">

                                                    <a href="javascript:;" onclick="wallets_view(<?php echo $item['id'];?>)"><img src="<?php echo $image_url;?>" alt="" width="50" height="34"></a>

                                                </div>

                                                <div class="pull-left">

                                                    <h4 class="product-name2" ><a href="javascript:;" onclick="wallets_view(<?php echo $item['id'];?>)"><?php echo ucfirst(str_replace("-"," ",$item['title'])); ?></a></h4> <span class="order_date"><?php echo $created_on;?></span> 

                                                </div>

                                            </div>

                                        </td>

                                        <td><a href="javascript:;" onclick="wallets_view(<?php echo $item['id'];?>)"><?php echo $item['id'];?></a></td>

                                        <td>

                                            <a href="<?php echo $user_linkone;?>" class="text-dark"><b><?php echo ucfirst($item['fullname']);?></b></a>

                                        </td>

                                        <td><?php echo $sts;?></td>

                                        <td><b><?php echo $rate_symbol.$rate;?></b></td>

                                    </tr>

                                    <?php

									}

								 

									 }

									 

									 else { ?>

                                    <tr>

                                        <td colspan="5"><p class="text-center text-danger m-b-0"><?php echo (!empty($user_language[$user_selected]['lg_no_records_found']))?$user_language[$user_selected]['lg_no_records_found']:$default_language['en']['lg_no_records_found']; ?></p></td>

                                    </tr>

                                    <?php } ?>

                                </tbody>

                            </table>

                             <form method="post" action="<?php echo base_url();?>user/payments/generate_reports">
                                    		<table>
                                    			<tr>
                                    				<td><input value="<?php if(isset($_POST["fromdate"]) && !empty($_POST["fromdate"])) echo $_POST["fromdate"];?>" type="hidden" placeholder="From Date" class="form-control" name="fromdate"></td>
                                    				<td><input type="hidden" placeholder="To Date" value="<?php if(isset($_POST["todate"]) && !empty($_POST["todate"])) echo $_POST["todate"];?>" class="form-control" name="todate"></td>
                                    				<td><input type="hidden" placeholder="To Date" value="<?php if(isset($_POST["orderstatus"]) && !empty($_POST["orderstatus"])) echo $_POST["orderstatus"];?>" class="form-control" name="orderstatus"></td>
                                    				                                    				
	                                    			<td><button name="form_submit" value="pdf" type="submit">PDF</button></td>
	                                    			<td><!-- <button name="form_submit" value="excel" type="submit">Excel</button> --></td>
	                                    			<td><!-- <button name="form_submit" value="word" type="submit">Word</button> --></td>
	                                    			
	                                    			</tr>
                                    		</table>
                                    		
                                    	</form>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="bottom-pagination">

                            <ul class="pagination pagination-sm">

                                <li><?php echo $links; ?></li>  

                            </ul>

                        </div>	

                    </div>	

				</div>

            </div>

		</div>

			<div id="purchase-popup" class="modal fade custom-popup order-popup" role="dialog">

				<div class="modal-dialog">

					<div class="modal-content" id="purchases_model_deatils"></div>

				</div>

			</div>

            <div id="message-popup" class="modal fade custom-popup" role="dialog">

				<div class="modal-dialog">

					<div class="modal-content">

						<button type="button" class="close" data-dismiss="modal">&times;</button>

						<div class="modal-body">

						<div class="msg-user-details" id="msg-user-details"></div>

							<div class="new-message">

                            <div id="_error_"></div>

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

     </div>

     <div id="withdraw-popup" class="modal fade custom-popup grey-popup" role="dialog">

				<div class="modal-dialog">

					<div class="modal-content">

						<button type="button" class="close" data-dismiss="modal">&times;</button>

						<div class="modal-header text-center">

							<h5><?php echo (!empty($user_language[$user_selected]['lg_withdraw_amount']))?$user_language[$user_selected]['lg_withdraw_amount']:$default_language['en']['lg_withdraw_amount']; ?></h5>

						</div>

						<div class="modal-body">

							<div class="table-responsive" id="wallets_gigs_details"></div>

							 <div id="payment-method">

								<h4 class="clearfix"><?php echo (!empty($user_language[$user_selected]['lg_select_your_payment_method']))?$user_language[$user_selected]['lg_select_your_payment_method']:$default_language['en']['lg_select_your_payment_method']; ?></h4>

									<div class="payment-method">

										<p>

										

									<?php  if($payment_paypal == 1){ ?>

									<span class="remove_paypal">

									<input class="le-radio" type="radio" name="group2" value="Direct" id="request_payment_method"> <img src="assets/images/paypal-icon.png" alt="Paypal">

									<label class="radio-label bold "><?php echo (!empty($user_language[$user_selected]['lg_paypal']))?$user_language[$user_selected]['lg_paypal']:$default_language['en']['lg_paypal']; ?></label>

									</span>

									<?php } ?>



									<?php if ($payment_paytabs == 1) { ?>  


										<span class="remove_paytabs">

									<input class="le-radio" type="radio" name="group2" value="paytabs" id="request_payment_method">

									<label class="radio-label bold ">PayTabs</label>

									</span>

                              

                             
                                    <?php }  ?>   



									<?php  if($payment_stripe == 1){ ?>

									<span class="remove_stripe">

									<input class="le-radio" type="radio" name="group2" value="stripe" id="request_payment_method">

									<label class="radio-label bold "><?php echo (!empty($user_language[$user_selected]['lg_stripe']))?$user_language[$user_selected]['lg_stripe']:$default_language['en']['lg_stripe']; ?></label>

									</span>

									<?php } ?>

									</p>



									</div>

							</div> 

							<div class="row">

								<div class="col-md-12">

									<div class="withdraw-amount">

										<span class="unit-price"><?php echo (!empty($user_language[$user_selected]['lg_requested_amount']))?$user_language[$user_selected]['lg_requested_amount']:$default_language['en']['lg_requested_amount']; ?> :</span><span class="price-tag"><?php echo $rate_symbol ?></span><span class="price-tag" id="wallets_request_amount"></span>

									</div>

								</div>

							</div>

							<div class="withdraw-btn">

                            	<input type="hidden" name="request_payment_id" id="request_payment_id" value="" />

                            	<button type="button" onclick="payment_request();" class="btn btn-primary btn-border"><?php echo (!empty($user_language[$user_selected]['lg_request_withdraw']))?$user_language[$user_selected]['lg_request_withdraw']:$default_language['en']['lg_request_withdraw']; ?></button>

							</div>

						</div>

						<div class="modal-footer text-left">

							<div class="media secure-money">

								<div class="media-left">

									<img width="46" height="40" src="assets/images/secure-money.png" alt="">

								</div>

								<div class="media-body">

									<span><?php echo (!empty($user_language[$user_selected]['lg_your_deposit_will_be_securely_held_in_escrow_until_you_are_happy_to_release_it_to_the_seller_upon_hourlie_completion']))?$user_language[$user_selected]['lg_your_deposit_will_be_securely_held_in_escrow_until_you_are_happy_to_release_it_to_the_seller_upon_hourlie_completion']:$default_language['en']['lg_your_deposit_will_be_securely_held_in_escrow_until_you_are_happy_to_release_it_to_the_seller_upon_hourlie_completion']; ?>.</span>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

            <div id="withdraw-redirect-popup" class="modal fade custom-popup grey-popup" role="dialog">

				<div class="modal-dialog">

					<div class="modal-content">

						<button type="button" class="close" data-dismiss="modal">&times;</button>

						<div class="modal-header text-center">

							<h5><?php echo (!empty($user_language[$user_selected]['lg_withdraw_amount']))?$user_language[$user_selected]['lg_withdraw_amount']:$default_language['en']['lg_withdraw_amount']; ?></h5>

						</div>

						<div class="modal-body">

							<div class="table-responsive" id="wallets_gigs_details"></div>

							 <div id="payment-method">

								<div class="alert alert-danger text-center">

									<strong><?php echo (!empty($user_language[$user_selected]['lg_you_have_not_entered_your_bank_account_details']))?$user_language[$user_selected]['lg_you_have_not_entered_your_bank_account_details']:$default_language['en']['lg_you_have_not_entered_your_bank_account_details']; ?>.<br/><?php echo (!empty($user_language[$user_selected]['lg_please_click_the_button_below_to_add_your_account_payment_details']))?$user_language[$user_selected]['lg_please_click_the_button_below_to_add_your_account_payment_details']:$default_language['en']['lg_please_click_the_button_below_to_add_your_account_payment_details']; ?>. </strong>

								</div>

								<div class="text-center"><a href="javascript:void(0)" id="check_and_fillaccount" data-toggle="modal" data-target="#paypal-popup" class="btn btn-primary"onclick="checkandfillaccount()" ><?php echo (!empty($user_language[$user_selected]['lg_add_account_details']))?$user_language[$user_selected]['lg_add_account_details']:$default_language['en']['lg_add_account_details']; ?></a></div>

							</div> 							 

						</div>

						<div class="modal-footer text-left">

							<div class="media secure-money">

								<div class="media-left">

									<img width="46" height="40" src="assets/images/secure-money.png" alt="">

								</div>

								<div class="media-body">

									<span><?php echo (!empty($user_language[$user_selected]['lg_your_deposit_will_be_securely_held_in_escrow_until_you_are_happy_to_release_it_to_the_seller_upon_hourlie_completion']))?$user_language[$user_selected]['lg_your_deposit_will_be_securely_held_in_escrow_until_you_are_happy_to_release_it_to_the_seller_upon_hourlie_completion']:$default_language['en']['lg_your_deposit_will_be_securely_held_in_escrow_until_you_are_happy_to_release_it_to_the_seller_upon_hourlie_completion']; ?>.</span>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

			<div id="paypal-popup" class="modal fade custom-popup" role="dialog">

				<div class="modal-dialog">

					<div class="modal-content">

						<button type="button" class="close" data-dismiss="modal">&times;</button>

						<div class="modal-header text-center">

							<h4 class="sign-title"><?php echo (!empty($user_language[$user_selected]['lg_add_account_details']))?$user_language[$user_selected]['lg_add_account_details']:$default_language['en']['lg_add_account_details']; ?></h4>

						</div>

						<div class="modal-body">

							<form class="form-horizontal" id="bank_details_form">

                            	<div class="error_msg text-center" id="paypal_errormsg"></div>

							

								<div class="form-group paypal_input_content">

									<label class="col-lg-4"><?php echo (!empty($user_language[$user_selected]['lg_paypal_email_id']))?$user_language[$user_selected]['lg_paypal_email_id']:$default_language['en']['lg_paypal_email_id']; ?></label>

									<div class="col-lg-8">

										<input type="text" id="user_paypal_id" name="user_paypal_id" class="form-control paypal_input">

									</div>

								</div>



								<div class="form-group stripe_input_content">

									<label class="col-lg-4"><?php echo (!empty($user_language[$user_selected]['lg_the_account_holders_name']))?$user_language[$user_selected]['lg_the_account_holders_name']:$default_language['en']['lg_the_account_holders_name']; ?></label>

									<div class="col-lg-8">

									<input type="text" id="account_holder_name" name="account_holder_name" class="form-control stripe_input only_alphabets">

									</div>

								</div>

								<div class="form-group stripe_input_content">

									<label class="col-lg-4"><?php echo (!empty($user_language[$user_selected]['lg_account_number']))?$user_language[$user_selected]['lg_account_number']:$default_language['en']['lg_account_number']; ?></label>

									<div class="col-lg-8">

										<input type="text" id="account_number" name="account_number" class="form-control stripe_input  only_numeric">

									</div>

								</div>

								<div class="form-group stripe_input_content">

									<label class="col-lg-4"><?php echo (!empty($user_language[$user_selected]['lg_iban']))?$user_language[$user_selected]['lg_iban']:$default_language['en']['lg_iban']; ?></label>

									<div class="col-lg-8">

										<input type="text" id="account_iban" name="account_iban" class="form-control stripe_input" onkeypress="return IsAlphaNumeric(event);" ondrop="return false;" onpaste="return false;">

									</div>

								</div>

								<div class="form-group stripe_input_content">

									<label class="col-lg-4"><?php echo (!empty($user_language[$user_selected]['lg_bank_name']))?$user_language[$user_selected]['lg_bank_name']:$default_language['en']['lg_bank_name']; ?></label>

									<div class="col-lg-8">

										<input type="text" id="bank_name" name="bank_name" class="form-control stripe_input  only_alphabets">

									</div>

								</div>

								<div class="form-group stripe_input_content">

									<label class="col-lg-4"><?php echo (!empty($user_language[$user_selected]['lg_bank_address']))?$user_language[$user_selected]['lg_bank_address']:$default_language['en']['lg_bank_address']; ?></label>

									<div class="col-lg-8">

										<input type="text" id="bank_address" name="bank_address" class="form-control stripe_input">

									</div>

								</div>

								<div class="form-group stripe_input_content">

									<label class="col-lg-4"><?php echo (!empty($user_language[$user_selected]['lg_sort_code']))?$user_language[$user_selected]['lg_sort_code']:$default_language['en']['lg_sort_code']; ?>(<?php echo (!empty($user_language[$user_selected]['lg_uk']))?$user_language[$user_selected]['lg_uk']:$default_language['en']['lg_uk']; ?>)</label>

									<div class="col-lg-8">

										<input type="text" id="sort_code" name="sort_code" class="form-control stripe_input only_numeric" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_uk_bank_code']))?$user_language[$user_selected]['lg_uk_bank_code']:$default_language['en']['lg_uk_bank_code']; ?> (<?php echo (!empty($user_language[$user_selected]['lg_6_digits_usually_displayed_as_3_pairs_of_numbers']))?$user_language[$user_selected]['lg_6_digits_usually_displayed_as_3_pairs_of_numbers']:$default_language['en']['lg_6_digits_usually_displayed_as_3_pairs_of_numbers']; ?>)">

									</div>

								</div>

								<div class="form-group stripe_input_content">

									<label class="col-lg-4"><?php echo (!empty($user_language[$user_selected]['lg_routing_number']))?$user_language[$user_selected]['lg_routing_number']:$default_language['en']['lg_routing_number']; ?>(<?php echo (!empty($user_language[$user_selected]['lg_us']))?$user_language[$user_selected]['lg_us']:$default_language['en']['lg_us']; ?>)</label>

									<div class="col-lg-8">

										<input type="text" id="routing_number" name="routing_number" class="form-control stripe_input only_numeric" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_the_american_bankers_association_number']))?$user_language[$user_selected]['lg_the_american_bankers_association_number']:$default_language['en']['lg_the_american_bankers_association_number']; ?> (<?php echo (!empty($user_language[$user_selected]['lg_consists_of_9_digits']))?$user_language[$user_selected]['lg_consists_of_9_digits']:$default_language['en']['lg_consists_of_9_digits']; ?>) <?php echo (!empty($user_language[$user_selected]['lg_and_is_also_called_a_aba_routing_number']))?$user_language[$user_selected]['lg_and_is_also_called_a_aba_routing_number']:$default_language['en']['lg_and_is_also_called_a_aba_routing_number']; ?>">

									</div>

								</div>

								<div class="form-group stripe_input_content">

									<label class="col-lg-4"><?php echo (!empty($user_language[$user_selected]['lg_ifsc_code']))?$user_language[$user_selected]['lg_ifsc_code']:$default_language['en']['lg_ifsc_code']; ?>(<?php echo (!empty($user_language[$user_selected]['lg_indian']))?$user_language[$user_selected]['lg_indian']:$default_language['en']['lg_indian']; ?>)</label>

									<div class="col-lg-8">

										<input type="text" id="account_ifsc" name="account_ifsc" onkeypress="return IsAlphaNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control stripe_input" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_financial_system_code']))?$user_language[$user_selected]['lg_financial_system_code']:$default_language['en']['lg_financial_system_code']; ?>, <?php echo (!empty($user_language[$user_selected]['lg_which_is_a_unique_11']))?$user_language[$user_selected]['lg_which_is_a_unique_11']:$default_language['en']['lg_which_is_a_unique_11']; ?>-<?php echo (!empty($user_language[$user_selected]['lg_digit_code_that_identifies_the_bank_branch']))?$user_language[$user_selected]['lg_digit_code_that_identifies_the_bank_branch']:$default_language['en']['lg_digit_code_that_identifies_the_bank_branch']; ?> i.e. <?php echo (!empty($user_language[$user_selected]['lg_icic0001245']))?$user_language[$user_selected]['lg_icic0001245']:$default_language['en']['lg_icic0001245']; ?>">

									</div>

								</div>







								<div class="form-group">

									<div class="col-lg-6 stripe_input_content"><p class="text-danger error_note" ></p></div>

									<div class="col-lg-6"><button type="button" onclick="user_paypal_submit()" id="payment_btn" class="btn btn-primary logon-btn pull-right"><?php echo (!empty($user_language[$user_selected]['lg_save']))?$user_language[$user_selected]['lg_save']:$default_language['en']['lg_save']; ?></button></div>

								</div>

							</form>

						</div>

					</div>

				</div>

			</div>

            <div id="withdraw-all" class="modal fade custom-popup grey-popup" role="dialog">

				<div class="modal-dialog">

					<div class="modal-content">

						<button type="button" class="close" data-dismiss="modal">&times;</button>

						<div class="modal-header text-center">

							<h5><?php echo (!empty($user_language[$user_selected]['lg_withdraw_amount']))?$user_language[$user_selected]['lg_withdraw_amount']:$default_language['en']['lg_withdraw_amount']; ?></h5>

						</div>

						<div class="modal-body">

							<div class="row">

								<div class="col-md-12">

									<div class="withdraw-amount">

                                    <?php

                                     $tot_amount=0;

                                     $pay_throught = '';

									 if(!empty($order_details)) 

									 {

										foreach($order_details as $item_am) {

											if($item_am['payment_status']==0){

												$c_amount = $item_am['item_amount'];

												$pay_throught = strtolower($item_am['source']);

												$tot_amount =$tot_amount+$c_amount;

											}

											

										}

									 }?>

										<span class="unit-price"><?php echo (!empty($user_language[$user_selected]['lg_available_balance']))?$user_language[$user_selected]['lg_available_balance']:$default_language['en']['lg_available_balance']; ?> :</span> <span class="price-tag"><?php echo $rate_symbol.$total_amount1;?></span>

									</div>

								</div>

							</div>

							<form>

							 <div id="payment-method">

								<h4 class="clearfix"><?php echo (!empty($user_language[$user_selected]['lg_select_your_payment_method']))?$user_language[$user_selected]['lg_select_your_payment_method']:$default_language['en']['lg_select_your_payment_method']; ?></h4>

									<div class="payment-method">

										

										<?php  if($payment_paypal == 1){ ?>

											<input class="le-radio" type="radio" name="group2" value="Direct" checked="checked"> <img src="assets/images/paypal-icon.png" alt="Paypal">

											<label class="radio-label bold "><?php echo (!empty($user_language[$user_selected]['lg_paypal']))?$user_language[$user_selected]['lg_paypal']:$default_language['en']['lg_paypal']; ?></label>

										<?php } ?>



										<?php  if($payment_paytabs == 1){ ?>

											<input class="le-radio" type="radio" name="group2" value="paytabs">

											<label class="radio-label bold ">PayTabs</label>

										<?php } ?>



										<?php  if($payment_stripe == 1){ ?>

											<input class="le-radio" type="radio" name="group2" value="stripe">

											 <label class="radio-label bold "><?php echo (!empty($user_language[$user_selected]['lg_stripe']))?$user_language[$user_selected]['lg_stripe']:$default_language['en']['lg_stripe']; ?></label>

										<?php } ?>

										

										



									</div>

							</div> 

									<div>

										<button type="button" onclick="overall_payment_request()" class="btn btn-primary btn-border">Request <?php echo (!empty($user_language[$user_selected]['lg_request_withdraw']))?$user_language[$user_selected]['lg_request_withdraw']:$default_language['en']['lg_request_withdraw']; ?></button>

									</div>

								</form>

						</div>

						<div class="modal-footer text-left">

							<div class="media secure-money">

								<div class="media-left">

									<img width="46" height="40" src="assets/images/secure-money.png" alt="">

								</div>

								<div class="media-body">

									<span><?php echo (!empty($user_language[$user_selected]['lg_your_deposit_will_be_securely_held_in_escrow_until_you_are_happy_to_release_it_to_the_seller_upon_hourlie_completion']))?$user_language[$user_selected]['lg_your_deposit_will_be_securely_held_in_escrow_until_you_are_happy_to_release_it_to_the_seller_upon_hourlie_completion']:$default_language['en']['lg_your_deposit_will_be_securely_held_in_escrow_until_you_are_happy_to_release_it_to_the_seller_upon_hourlie_completion']; ?>.</span>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

     

     

			

			

			

			

            

            

		