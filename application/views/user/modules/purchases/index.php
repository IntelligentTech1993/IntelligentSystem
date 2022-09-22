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

                        <h3 class="page-title"><?php echo (!empty($user_language[$user_selected]['lg_my_purchases']))?$user_language[$user_selected]['lg_my_purchases']:$default_language['en']['lg_my_purchases']; ?></h3>

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

                                <li class="active">

									<a href="javascript:;">

										<span class="visible-xxs"><i class="fa fa-credit-card" aria-hidden="true"></i> <?php if($purchases_order_count>0){?><span class="badge badge-white position-right"><?php echo $purchases_order_count;?></span><?php }?></span> 

										<span class="hidden-xxs"><?php echo (!empty($user_language[$user_selected]['lg_my_purchases']))?$user_language[$user_selected]['lg_my_purchases']:$default_language['en']['lg_my_purchases']; ?> <?php if($purchases_order_count>0){?><span class="badge badge-white position-right"><?php echo $purchases_order_count;?></span><?php }?></span>

									</a>

								</li>

                                <li>

									<a href="<?php echo base_url().'sales';?>">

										<span class="visible-xxs"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?php if($order_count>0){?><span class="badge badge-white position-right"><?php echo $order_count;?></span><?php }?></span> 

										<span class="hidden-xxs"><?php echo (!empty($user_language[$user_selected]['lg_my_sales']))?$user_language[$user_selected]['lg_my_sales']:$default_language['en']['lg_my_sales']; ?> <?php if($order_count>0){?><span class="badge badge-white position-right"><?php echo $order_count;?></span><?php }?></span>

									</a>

								</li>

                                <li>

									<a href="<?php echo base_url().'payments';?>">

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

                <div class="row">

                    <div class="col-md-12">

                                <div class="table-responsive order-table">

                                	<form method="post" autocomplete="off" action="<?php echo base_url();?>purchases">
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
                                    					<option value="1" <?php if($orderstatus=='1') echo 'selected';?>>New</option>
                                    					<option value="2" <?php if($orderstatus=='2') echo 'selected';?>>Pending</option>
                                    					<option value="3" <?php if($orderstatus=='3') echo 'selected';?>>Processing</option>
                                    					<option value="4" <?php if($orderstatus=='4') echo 'selected';?>>Refunded</option>
                                    					<option value="5" <?php if($orderstatus=='5') echo 'selected';?>>Decline</option>
                                    					<option value="6" <?php if($orderstatus=='6') echo 'selected';?>>Completed</option>
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

                                                <th><?php echo (!empty($user_language[$user_selected]['lg_order_title']))?$user_language[$user_selected]['lg_order_title']:$default_language['en']['lg_order_title']; ?> </th>



                                                <th><?php echo (!empty($user_language[$user_selected]['lg_order_id']))?$user_language[$user_selected]['lg_order_id']:$default_language['en']['lg_order_id']; ?></th>



                                                <th><?php echo (!empty($user_language[$user_selected]['lg_delivery_date']))?$user_language[$user_selected]['lg_delivery_date']:$default_language['en']['lg_delivery_date']; ?></th>



                                                <th><?php echo (!empty($user_language[$user_selected]['lg_seller']))?$user_language[$user_selected]['lg_seller']:$default_language['en']['lg_seller']; ?></th>



                                                <th><?php echo (!empty($user_language[$user_selected]['lg_feedback']))?$user_language[$user_selected]['lg_feedback']:$default_language['en']['lg_feedback']; ?></th>



                                                <th><?php echo (!empty($user_language[$user_selected]['lg_order_cancel']))?$user_language[$user_selected]['lg_order_cancel']:$default_language['en']['lg_order_cancel']; ?></th>



                                                <th><?php echo (!empty($user_language[$user_selected]['lg_amount']))?$user_language[$user_selected]['lg_amount']:$default_language['en']['lg_amount']; ?></th>



												<th><?php echo (!empty($user_language[$user_selected]['lg_order_status']))?$user_language[$user_selected]['lg_order_status']:$default_language['en']['lg_order_status']; ?></th>

                                            </tr>

                                        </thead>



                                        <tbody>

										<?php

										 if(!empty($order_data)) 

										 {

											$country_name = $this->session->userdata('country_name');

											$rupee_rate  = $this->session->userdata('rupee_rate');

											$dollar_rate  = $this->session->userdata('dollar_rate');

											$failed = (!empty($user_language[$user_selected]['lg_failed']))?$user_language[$user_selected]['lg_failed']:$default_language['en']['lg_failed'];

											 $new = (!empty($user_language[$user_selected]['lg_new']))?$user_language[$user_selected]['lg_new']:$default_language['en']['lg_new'];

											 $cancelled = (!empty($user_language[$user_selected]['lg_cancelled']))?$user_language[$user_selected]['lg_cancelled']:$default_language['en']['lg_cancelled'];

											 $process = (!empty($user_language[$user_selected]['lg_process']))?$user_language[$user_selected]['lg_process']:$default_language['en']['lg_process'];

											 $pending = (!empty($user_language[$user_selected]['lg_pending']))?$user_language[$user_selected]['lg_pending']:$default_language['en']['lg_pending'];

											 $refunded = (!empty($user_language[$user_selected]['lg_refunded']))?$user_language[$user_selected]['lg_refunded']:$default_language['en']['lg_refunded'];

											 $decline_request = (!empty($user_language[$user_selected]['lg_decline_request']))?$user_language[$user_selected]['lg_decline_request']:$default_language['en']['lg_decline_request'];

											 $declined = (!empty($user_language[$user_selected]['lg_declined']))?$user_language[$user_selected]['lg_declined']:$default_language['en']['lg_declined'];

											 $completed = (!empty($user_language[$user_selected]['lg_completed']))?$user_language[$user_selected]['lg_completed']:$default_language['en']['lg_completed'];

											 $completed_accept = (!empty($user_language[$user_selected]['lg_completed_accept']))?$user_language[$user_selected]['lg_completed_accept']:$default_language['en']['lg_completed_accept'];

											 $see_feedback = (!empty($user_language[$user_selected]['lg_see_feedback']))?$user_language[$user_selected]['lg_see_feedback']:$default_language['en']['lg_see_feedback'];
											 
											 $leave_feedback = (!empty($user_language[$user_selected]['lg_leave_feedback']))?$user_language[$user_selected]['lg_leave_feedback']:$default_language['en']['lg_leave_feedback'];

										 

											foreach($order_data as $item) { 	

											 $paypal_uid = $item['paypal_uid'];	

											 $source = $item['source'];		

                                             $ref='';

											 $refclass='';

											 $status = $item['seller_status']; 

                                           	if(($item['payment_status']==2 && ($status==5 || ($status==1 && $item['buyer_status']==1)))){

											    $ref='refunded';

												 $refclass='label label-info';

										   }											   

										
										$currency_option = (!empty($item['currency_type']))?$item['currency_type']:'USD';
										$rate_symbol = currency_sign($currency_option);	 
										$rate = $item['item_amount'];
										$f_uid = $item['user_id'];
										$t_uid = $userid;
										$gid   = $item['gigs_id'];
										$status = $item['seller_status']; 
										$order_id =$item['id'];
										if($status ==0) {

												$sts=''.$failed.'';

												$class='label-danger';

											}elseif($status ==1) {

												$sts=''.$new.'';

												$class='label-success';

												if($item['buyer_status'] ==1) { if($item['cancel_accept'] ==1){

													$sts=''.$cancelled.'';

													$class='label-danger';

													if($item['pay_status']=='Payment Processed'){

													$class='label-info';

													}

												}

												}

											}elseif($status ==2){

												$sts=''.$pending.'';

												$class='label-warning';

												if($item['buyer_status'] ==1) { if($item['cancel_accept'] ==1){

													$sts=''.$cancelled.'';

													$class='label-danger';

													if($item['pay_status']=='Payment Processed'){

													$class='label-info';

													}

												}

												}

											}elseif($status ==3){

												$sts=''.$process.'';

												$class='label-primary';

												if($item['buyer_status'] ==1) { if($item['cancel_accept'] ==1){

													$sts=''.$cancelled.'';

													$class='label-danger';

													if($item['pay_status']=='Payment Processed'){

													$class='label-info';

													}

												}

												}

											}elseif($status ==4){

												$sts=''.$refunded.'';

												$class='label-danger';

											}elseif($status ==5){

												$sts=''.$declined.'';

												$class='label-danger';

											}elseif($status ==6){

												$sts=''.$completed.'';

												$class='label-success';

											}elseif($status ==7){

												$sts=''.$completed_accept.'';

												$class='label-success';

											}



											if($paypal_uid == 'issue'){

												$sts=''.$failed.'';

												$class='label-danger';

											}

											



											$fead_stautus=0;

											if($status ==6) {

												

												$query = $this->db->query("SELECT id FROM `feedback` WHERE `from_user_id` = $t_uid and `to_user_id` = '$f_uid' and `gig_id` = $gid and `order_id` = $order_id;");
												$result = array();
												if($query->num_rows() > 0){
													$result = $query->row_array();	
												}

												$fead_stautus=1; 

												if(!empty($result['id'])){

													$b_sts=''.$see_feedback.'';

												}else

												{

													$b_sts=''.$leave_feedback.'';

												}

											}

											else

											{

												$b_sts=''.$pending.'';

											}

											 $created_on = '-';

                                            if (isset($item['created_at'])) {

                                                if (!empty($item['created_at']) && $item['created_at'] != "0000-00-00 00:00:00") {

                                                    $created_on = date('j F Y G:i', strtotime($item['created_at']));

                                                }

                                            }

											$delivery_date = date('d M Y', strtotime($item['delivery_date']));

											 // if (isset($item['delivery_date'])) {

            //                                     if (!empty($item['delivery_date']) || !empty($item['delivering_time']) && $item['delivery_date'] != "0000-00-00 00:00:00") {

												// 	$date = strtotime("+".$item['delivering_time']." days", strtotime($item['delivery_date']));

												// 	$delivery_date = date("d M Y", $date);

            //                                         //$delivery_date = date('d M Y', strtotime($item['delivery_date']));

            //                                     }

            //                                 }

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

                                                            <a href="javascript:;" onclick="purchase_view(<?php echo $item['id'];?>)"><img src="<?php echo $image_url;?>" alt="" width="50" height="34"></a>

                                                        </div>

                                                        <div class="pull-left">

                                                            <h4 class="product-name2"><a href="javascript:;" onclick="purchase_view(<?php echo $item['id'];?>)"><?php echo ucfirst(str_replace("-"," ",$item['title'])); ?></a></h4> <span class="order_date"><?php echo $created_on;?></span> 

                                                        </div>

                                                    </div>

                                                </td>

                                                <td><a href="javascript:;" onclick="purchase_view(<?php echo $item['id'];?>)" ><?php echo $item['id'];?></a></td>

                                                <td>

                                                    <span class="label label-success"><?Php echo $delivery_date; ?></span>

                                                </td>

                                                <td>

                                                    <a href="<?php echo $user_linkone;?>" class="text-dark"><b><?php echo ucfirst($item['fullname']);?></b></a>

                                                </td>

                                                <td><a href="javascript:;" <?php if($fead_stautus ==1){?> onclick="add_feedback(<?php echo $f_uid;?> ,<?php echo $t_uid;?>, <?php echo $gid;?>, <?php echo $item['id'];?>);" <?php }else { ?> onclick="add_seller_feedbacks()" <?php  } ?>><?php echo $b_sts;?></a></td>

                                                 <td class="text-center">

                                                

												<?php if($item['buyer_status'] ==0 && $status !=6 && $sts!='Completed Accept') { if($status !=0 ){ if($status !=5 ){

													  

													 

													?>

												<a href="javascript:;" onclick="buyer_cancel(<?php echo $item['id'];?>,'<?php echo $source; ?>')" ><span class="label label-danger"><?php echo (!empty($user_language[$user_selected]['lg_cancel']))?$user_language[$user_selected]['lg_cancel']:$default_language['en']['lg_cancel']; ?></span></a>

                                                    <?php }else{ echo '<span>-</span>'; } }else{ echo '<span>-</span>'; }  } else if($item['buyer_status'] ==1) { if($item['cancel_accept'] ==1){?>

                                                    	 <span>-</span>

                                                    <?php } else{?>

                                                    	<span class="label label-danger"><?php echo (!empty($user_language[$user_selected]['lg_request_send']))?$user_language[$user_selected]['lg_request_send']:$default_language['en']['lg_request_send']; ?></span>

													<?php }} else {?>

                                                    	-

                                                    <?php }?>

                                                </td>

                                                <td><?php echo $rate_symbol.$rate ;?></td>

                                               

                                                <td>

                                                <?php if($status ==5){ if($item['decline_accept']==1) {?>

                                                	<span class="label <?php echo $class;?>"><?php echo 'Declined';?></span>

													 <span class="<?php echo $refclass;?>"><?php echo$ref;?></span>

                                                <?php } else{?>

                                                	<a href="javascript:;" onclick="buyer_accept_seller_request(<?php echo $item['id'];?>,'<?php echo $source; ?>')"><span class="label <?php echo $class;?>"><?php echo (!empty($user_language[$user_selected]['lg_decline_request']))?$user_language[$user_selected]['lg_decline_request']:$default_language['en']['lg_decline_request']; ?></span></a>

                                                <?php  }

                                            } else{ ?>


                                            	<?php if($sts=='Completed Accept') {

												 	    $buyer_id = $this->session->userdata('SESSION_USER_ID');
												 		$gig_id  = $item['gigs_id'];
												 		$order_id  =$item['id'];
												 		$seller_id  =$item['seller_id'];

												 	$this->db->where(array('seller_id' => $seller_id,'buyer_id' => $buyer_id,'gig_id' => $gig_id,'order_id' => $order_id,'rejected_request' => 0 ));	
												 	$reject_count = $this->db->count_all_results('buyer_rejected_list');

												 	if($reject_count == 1 || $reject_count > 1){ ?>
												 		<span class="btn btn-warning btn-xs"><?php echo (!empty($user_language[$user_selected]['lg_reject_request_completed']))?$user_language[$user_selected]['lg_reject_request_completed']:$default_language['en']['lg_reject_request_completed']; ?></span>
												 	<?php }else{  ?>
												 		
                                                    	<div class="dropdown">
												<button class="btn btn-xs btn-info dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><?php echo $sts;?>
												<span class="caret"></span></button>



												<ul class="dropdown-menu pull-right" role="menu" aria-labelledby="menu1">
												<li role="presentation"><a role="menuitem" tabindex="-1" href="" <?php if($sts=='Completed Accept') { ?> onclick="change_product_status_update(6,<?php echo $item['id'];?>);" <?php } ?> ><?php echo (!empty($user_language[$user_selected]['lg_completed']))?$user_language[$user_selected]['lg_completed']:$default_language['en']['lg_completed']; ?></a></li>
												<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0);"  onclick="popup_reject(<?php echo $item['gigs_id'];?>,<?php echo $item['id'];?>,<?php echo $item['seller_id']; ?>)"><?php echo (!empty($user_language[$user_selected]['lg_reject_request']))?$user_language[$user_selected]['lg_reject_request']:$default_language['en']['lg_reject_request']; ?></a></li>
												</ul>



												</div>
												<?php } ?>
												<!-- <?php echo $sts;?> --></span>
													 <span class="<?php echo $refclass;?>"><?php echo$ref;?></span>
													 
													 <?php }else{ ?>

                                                    <a href="javascript:;">
                                                    <span class="label <?php echo $class;?>"   >
                                                    	<div class="dropdown">
											
												 
												</div><?php echo $sts;?></span>
													 <span class="<?php echo $refclass;?>"><?php echo$ref;?></span>
												</a>  

												<?php } ?>

												<!-- <a href="javascript:;">

                                                    <span class="label <?php echo $class;?>" <?php if($sts=='Completed Accept') { ?> onclick="change_product_status_update(6,<?php echo $item['id'];?>);" <?php } ?> ><?php echo $sts;?></span>

													 <span class="<?php echo $refclass;?>"><?php echo$ref;?></span>

												</a>	 -->

                                                    <?php }?>

                                                </td>

                                            </tr>

											 <?php  }

                                                } else { ?>

                                                <tr>

                                                    <td colspan="8"><p class="text-center text-danger m-b-0"><?php echo (!empty($user_language[$user_selected]['lg_no_records_found']))?$user_language[$user_selected]['lg_no_records_found']:$default_language['en']['lg_no_records_found']; ?></p></td>

                                                </tr>

                                                <?php } ?>

                                        </tbody>

                                    </table>

                                    <form method="post" action="<?php echo base_url();?>user/purchases/generate_reports">
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


			<?php 
										$buyer_id = $this->session->userdata('SESSION_USER_ID');
										
									 ?>

			<div id="reject-popup" class="modal fade custom-popup" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<div class="modal-body">
						<div class="msg-user-details" id="msg-user-details"></div>
							<div class="new-message">
                            <div id="_error_" class="error_msg"></div>
							<form id="rejected_orders" method="post" action="<?php echo base_url().'user/buy_service/rejected_orders';?>" >
                            <input type="hidden" name="hidd_gig_id" id="hidd_gig_id" value=""/>
                            <input type="hidden" name="hide_order_id" id="hide_order_id" value=""/>
                            <input type="hidden" name="hide_seller_id" id="hide_seller_id" value=""/>				
                            <input type="hidden" name="buyer_id" id="buyer_id" value="<?php echo $buyer_id; ?>"/>						
								<div class="form-group">
									<label class="form-label"><?php echo (!empty($user_language[$user_selected]['lg_your_complaint']))?$user_language[$user_selected]['lg_your_complaint']:$default_language['en']['lg_your_complaint']; ?></label>
									<textarea name="reject_message_content" placeholder="Your Queries" required="" id="reject_message_content" class="form-control"></textarea>
								</div>						
							
						<button type="submit" name="submit" value="submit" class="btn btn-primary btn-style"><?php echo (!empty($user_language[$user_selected]['lg_send']))?$user_language[$user_selected]['lg_send']:$default_language['en']['lg_send']; ?></button>
						</form>
						</div>
						</div>
					</div>
				</div>
			</div>

            

            <div id="feedback-popup" class="modal fade custom-popup order-popup" role="dialog">

				<div class="modal-dialog">

					<div class="modal-content">

						<button type="button" class="close" data-dismiss="modal">&times;</button>

						<div class="modal-header text-center">

							<h5><?php echo (!empty($user_language[$user_selected]['lg_leave_feedback']))?$user_language[$user_selected]['lg_leave_feedback']:$default_language['en']['lg_leave_feedback']; ?></h5>

						</div>

						<div class="modal-body">

							<div id="parent_user_details"></div>

							<div class="feedback-area">

									<ul class="feedback-list">

										<li class="media">

                                        	<div id="_error_msg" class="error_msg"></div>



											<a href="javascript:;" class="pull-left" id="reset_user_image"></a>

											<div class="media-body">

                                            <form action="" type="post" id="feedback_rating_form">

                                                <input type="hidden" id="rating_frmuser" value="" name="rating_frmuser" />

                                                <input type="hidden" id="rating_touser" value="" name="rating_touser" />

                                                <input type="hidden" id="rating_gig" value="" name="rating_gig" />

                                                <input type="hidden" id="rating_orderid" value="" name="rating_orderid" />

                                                <div class="row">

                                                    <div class="form-group clearfix">

                                                        <div class="col-md-12">

                                                            <textarea rows="4" class="form-control" name="comment" id="comment" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_comment']))?$user_language[$user_selected]['lg_comment']:$default_language['en']['lg_comment']; ?>"></textarea>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-md-6">

                                                        <span id="stars-existing" class="starrr" data-rating=''></span> 

                                                        <input type="hidden" id="rating_input" value="" name="rating_input" />

                                                    </div>

                                                    <div class="col-md-6 text-right">

                                                        <input type="button" value="<?php echo (!empty($user_language[$user_selected]['lg_send_feedback']))?$user_language[$user_selected]['lg_send_feedback']:$default_language['en']['lg_send_feedback']; ?>" onclick="submit_comment();" class="btn btn-primary btn-border" data-loading-text="<?php echo (!empty($user_language[$user_selected]['lg_loading']))?$user_language[$user_selected]['lg_loading']:$default_language['en']['lg_loading']; ?>...">

                                                    </div>

                                                </div>

                                            </form>

											</div>

										</li>

									</ul>

								</div>

						</div>

					</div>

				</div>

			</div>

            

            <div id="see-feedback" class="modal fade custom-popup order-popup" role="dialog">

				<div class="modal-dialog">

					<div class="modal-content">

						<button type="button" class="close" data-dismiss="modal">&times;</button>

						<div class="modal-header text-center">

							<h5><?php echo (!empty($user_language[$user_selected]['lg_see_your_feedback']))?$user_language[$user_selected]['lg_see_your_feedback']:$default_language['en']['lg_see_your_feedback']; ?></h5>

						</div>

						<div class="modal-body">

							<div id="parent_user_detailsone"></div>

							<div id="feedback_user_area"></div>

						</div>

					</div>

				</div>

			</div>

     </div>

     

     <div id="status-popup-buyer" class="modal fade custom-popup" role="dialog">

        <div class="modal-dialog">

            <div class="modal-content">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <div class="modal-header text-center">

                    <h5><?php echo (!empty($user_language[$user_selected]['lg_cancel_your_order']))?$user_language[$user_selected]['lg_cancel_your_order']:$default_language['en']['lg_cancel_your_order']; ?></h5>

                </div>

                <div class="modal-body">

                <div class="error_msg text-center" id="reason_errormsg"> </div>

                <form id="change_gigs_status" method="post" enctype="multipart/form-data">

                	<input type="hidden" name="sell_gigs_statusid" id="sell_gigs_statusid" value="" />
                	<input type="hidden" name="" id="payment_soruce" value="" />

                        <div class="form-group">

                            <label><?php echo (!empty($user_language[$user_selected]['lg_reason']))?$user_language[$user_selected]['lg_reason']:$default_language['en']['lg_reason']; ?></label>

							<span class="status-select">

								<input type="text" name="reason_txt" id="reason_txt" value="" class="form-control no_spl_chars" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_enter_reason']))?$user_language[$user_selected]['lg_enter_reason']:$default_language['en']['lg_enter_reason']; ?>" />

							</span>

                        </div>

                        <div class="form-group" id="cancel_fields">

                            <label><?php echo (!empty($user_language[$user_selected]['lg_paypal_email_id']))?$user_language[$user_selected]['lg_paypal_email_id']:$default_language['en']['lg_paypal_email_id']; ?></label>

                            <input type="text" class="form-control" value="<?php echo $list['paypal_email_id'];?>" name="paypal_email" id="paypal_email">

                        </div>

                        <div class="form-group stripe_input_content">
						<label ><?php echo (!empty($user_language[$user_selected]['lg_the_account_holders_name']))?$user_language[$user_selected]['lg_the_account_holders_name']:$default_language['en']['lg_the_account_holders_name']; ?></label>
						<input type="text" id="account_holder_name" name="account_holder_name" class="form-control stripe_input only_alphabets">
						</div>

						<div class="form-group stripe_input_content">
						<label ><?php echo (!empty($user_language[$user_selected]['lg_account_number']))?$user_language[$user_selected]['lg_account_number']:$default_language['en']['lg_account_number']; ?></label>
						<input type="text" id="account_number" name="account_number" class="form-control stripe_input only_numeric">
						</div>

								<div class="form-group stripe_input_content">
									<label ><?php echo (!empty($user_language[$user_selected]['lg_iban']))?$user_language[$user_selected]['lg_iban']:$default_language['en']['lg_iban']; ?></label>
									<input type="text" id="account_iban" name="account_iban" onkeypress="return IsAlphaNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control stripe_input">

								</div>

								<div class="form-group stripe_input_content">
									<label ><?php echo (!empty($user_language[$user_selected]['lg_bank_name']))?$user_language[$user_selected]['lg_bank_name']:$default_language['en']['lg_bank_name']; ?></label>
										<input type="text" id="bank_name" name="bank_name" class="form-control stripe_input only_alphabets">
								</div>

								<div class="form-group stripe_input_content">

									<label  ><?php echo (!empty($user_language[$user_selected]['lg_bank_address']))?$user_language[$user_selected]['lg_bank_address']:$default_language['en']['lg_bank_address']; ?></label>
										<input type="text" id="bank_address" name="bank_address" class="form-control stripe_input">
								</div>
								<div class="form-group stripe_input_content">
									<label  ><?php echo (!empty($user_language[$user_selected]['lg_sort_code']))?$user_language[$user_selected]['lg_sort_code']:$default_language['en']['lg_sort_code']; ?>(<?php echo (!empty($user_language[$user_selected]['lg_uk']))?$user_language[$user_selected]['lg_uk']:$default_language['en']['lg_uk']; ?>)</label>
										<input type="text" id="sort_code" name="sort_code" class="form-control stripe_input only_numeric" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_uk_bank_code']))?$user_language[$user_selected]['lg_uk_bank_code']:$default_language['en']['lg_uk_bank_code']; ?> (<?php echo (!empty($user_language[$user_selected]['lg_6_digits_usually_displayed_as_3_pairs_of_numbers']))?$user_language[$user_selected]['lg_6_digits_usually_displayed_as_3_pairs_of_numbers']:$default_language['en']['lg_6_digits_usually_displayed_as_3_pairs_of_numbers']; ?>)">

								</div>

								<div class="form-group stripe_input_content">

									<label ><?php echo (!empty($user_language[$user_selected]['lg_routing_number']))?$user_language[$user_selected]['lg_routing_number']:$default_language['en']['lg_routing_number']; ?>(<?php echo (!empty($user_language[$user_selected]['lg_us']))?$user_language[$user_selected]['lg_us']:$default_language['en']['lg_us']; ?>)</label>
										<input type="text" id="routing_number" name="routing_number" class="form-control stripe_input only_numeric" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_the_american_bankers_association_number']))?$user_language[$user_selected]['lg_the_american_bankers_association_number']:$default_language['en']['lg_the_american_bankers_association_number']; ?> (<?php echo (!empty($user_language[$user_selected]['lg_consists_of_9_digits']))?$user_language[$user_selected]['lg_consists_of_9_digits']:$default_language['en']['lg_consists_of_9_digits']; ?>) <?php echo (!empty($user_language[$user_selected]['lg_and_is_also_called_a_aba_routing_number']))?$user_language[$user_selected]['lg_and_is_also_called_a_aba_routing_number']:$default_language['en']['lg_and_is_also_called_a_aba_routing_number']; ?>">
								</div>

								<div class="form-group stripe_input_content">

									<label ><?php echo (!empty($user_language[$user_selected]['lg_ifsc_code']))?$user_language[$user_selected]['lg_ifsc_code']:$default_language['en']['lg_ifsc_code']; ?>(<?php echo (!empty($user_language[$user_selected]['lg_indian']))?$user_language[$user_selected]['lg_indian']:$default_language['en']['lg_indian']; ?>)</label>
 

										<input type="text" id="account_ifsc" name="account_ifsc" onkeypress="return IsAlphaNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control stripe_input" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_financial_system_code']))?$user_language[$user_selected]['lg_financial_system_code']:$default_language['en']['lg_financial_system_code']; ?>, <?php echo (!empty($user_language[$user_selected]['lg_which_is_a_unique_11']))?$user_language[$user_selected]['lg_which_is_a_unique_11']:$default_language['en']['lg_which_is_a_unique_11']; ?>-<?php echo (!empty($user_language[$user_selected]['lg_digit_code_that_the_bank_branch']))?$user_language[$user_selected]['lg_digit_code_that_the_bank_branch']:$default_language['en']['lg_digit_code_that_the_bank_branch']; ?> i.e. <?php echo (!empty($user_language[$user_selected]['lg_icic0001245']))?$user_language[$user_selected]['lg_icic0001245']:$default_language['en']['lg_icic0001245']; ?>">

									 

								</div>

                        <div class="form-group text-right">

                            <button class="btn btn-primary btn-border" onclick="change_productorder_status();" type="button"><?php echo (!empty($user_language[$user_selected]['lg_update']))?$user_language[$user_selected]['lg_update']:$default_language['en']['lg_update']; ?> </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

		</div>

        

        <div id="buyer_accept_model" class="modal fade custom-popup" role="dialog">

        <div class="modal-dialog">

            <div class="modal-content">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <div class="modal-header text-center">

                     <h5><?php echo (!empty($user_language[$user_selected]['lg_buyer_accept_request']))?$user_language[$user_selected]['lg_buyer_accept_request']:$default_language['en']['lg_buyer_accept_request']; ?></h5>


                </div>

                <div class="modal-body">

				<div class="error_msg text-center" id="reason_errormsgone"> </div>

					<form>

						<input type="hidden" id="buyer_accept_rowid" name="buyer_accept_rowid" value="" />
						<input type="hidden" id="buyer_accept_rowtype" name="buyer_accept_rowtype" value="" />

                        <div class="form-group">

							<h4 id="reason_txt_message"><?php echo (!empty($user_language[$user_selected]['lg_seller_decline_this_order']))?$user_language[$user_selected]['lg_seller_decline_this_order']:$default_language['en']['lg_seller_decline_this_order']; ?>,<?php echo (!empty($user_language[$user_selected]['lg_please_accept_this_request']))?$user_language[$user_selected]['lg_please_accept_this_request']:$default_language['en']['lg_please_accept_this_request']; ?>?</h4>

                        </div>

						<div class="form-group payment_type_block">

                            <label><?php echo (!empty($user_language[$user_selected]['lg_paypal_email_id']))?$user_language[$user_selected]['lg_paypal_email_id']:$default_language['en']['lg_paypal_email_id']; ?></label>

                            <input type="text" class="form-control" value="<?php echo $list['paypal_email_id'];?>" name="paypal_emailid" id="paypal_emailid">

                        </div>

                        <div class="form-group decline_stripe_input_content">
						<label ><?php echo (!empty($user_language[$user_selected]['lg_the_account_holders_name']))?$user_language[$user_selected]['lg_the_account_holders_name']:$default_language['en']['lg_the_account_holders_name']; ?></label>
						<input type="text" id="decline_account_holder_name" name="decline_account_holder_name" class="form-control stripe_input only_alphabets">
						</div>

						<div class="form-group decline_stripe_input_content">
						<label ><?php echo (!empty($user_language[$user_selected]['lg_account_number']))?$user_language[$user_selected]['lg_account_number']:$default_language['en']['lg_account_number']; ?></label>
						<input type="text" id="decline_account_number" name="decline_account_number" class="form-control stripe_input only_numeric">
						</div>

								<div class="form-group decline_stripe_input_content">
									<label ><?php echo (!empty($user_language[$user_selected]['lg_iban']))?$user_language[$user_selected]['lg_iban']:$default_language['en']['lg_iban']; ?></label>
									<input type="text" id="decline_account_iban" name="decline_account_iban" onkeypress="return IsAlphaNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control stripe_input">

								</div>

								<div class="form-group decline_stripe_input_content">
									<label ><?php echo (!empty($user_language[$user_selected]['lg_bank_name']))?$user_language[$user_selected]['lg_bank_name']:$default_language['en']['lg_bank_name']; ?></label>
										<input type="text" id="decline_bank_name" name="decline_bank_name" class="form-control stripe_input only_alphabets">
								</div>

								<div class="form-group decline_stripe_input_content">

									<label  ><?php echo (!empty($user_language[$user_selected]['lg_bank_address']))?$user_language[$user_selected]['lg_bank_address']:$default_language['en']['lg_bank_address']; ?></label>
										<input type="text" id="decline_bank_address" name="decline_bank_address" class="form-control stripe_input">
								</div>
								<div class="form-group decline_stripe_input_content">
									<label  ><?php echo (!empty($user_language[$user_selected]['lg_sort_code']))?$user_language[$user_selected]['lg_sort_code']:$default_language['en']['lg_sort_code']; ?>(<?php echo (!empty($user_language[$user_selected]['lg_uk']))?$user_language[$user_selected]['lg_uk']:$default_language['en']['lg_uk']; ?>)</label>
										<input type="text" id="decline_sort_code" name="decline_sort_code" class="form-control stripe_input only_numeric" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_uk_bank_code']))?$user_language[$user_selected]['lg_uk_bank_code']:$default_language['en']['lg_uk_bank_code']; ?> (<?php echo (!empty($user_language[$user_selected]['lg_6_digits_usually_displayed_as_3_pairs_of_numbers']))?$user_language[$user_selected]['lg_6_digits_usually_displayed_as_3_pairs_of_numbers']:$default_language['en']['lg_6_digits_usually_displayed_as_3_pairs_of_numbers']; ?>)">

								</div>

								<div class="form-group decline_stripe_input_content">

									<label ><?php echo (!empty($user_language[$user_selected]['lg_routing_number']))?$user_language[$user_selected]['lg_routing_number']:$default_language['en']['lg_routing_number']; ?>(<?php echo (!empty($user_language[$user_selected]['lg_us']))?$user_language[$user_selected]['lg_us']:$default_language['en']['lg_us']; ?>)</label>
										<input type="text" id="decline_routing_number" name="decline_routing_number" class="form-control stripe_input only_numeric" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_the_american_bankers_association_number']))?$user_language[$user_selected]['lg_the_american_bankers_association_number']:$default_language['en']['lg_the_american_bankers_association_number']; ?> (<?php echo (!empty($user_language[$user_selected]['lg_consists_of_9_digits']))?$user_language[$user_selected]['lg_consists_of_9_digits']:$default_language['en']['lg_consists_of_9_digits']; ?>) <?php echo (!empty($user_language[$user_selected]['lg_and_is_also_called_a_aba_routing_number']))?$user_language[$user_selected]['lg_and_is_also_called_a_aba_routing_number']:$default_language['en']['lg_and_is_also_called_a_aba_routing_number']; ?>">
								</div>

								<div class="form-group decline_stripe_input_content">

									<label ><?php echo (!empty($user_language[$user_selected]['lg_ifsc_code']))?$user_language[$user_selected]['lg_ifsc_code']:$default_language['en']['lg_ifsc_code']; ?>(<?php echo (!empty($user_language[$user_selected]['lg_indian']))?$user_language[$user_selected]['lg_indian']:$default_language['en']['lg_indian']; ?>)</label>
 

										<input type="text" id="decline_account_ifsc" name="decline_account_ifsc" onkeypress="return IsAlphaNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control stripe_input" placeholder="<?php echo (!empty($user_language[$user_selected]['lg_financial_system_code']))?$user_language[$user_selected]['lg_financial_system_code']:$default_language['en']['lg_financial_system_code']; ?>, <?php echo (!empty($user_language[$user_selected]['lg_which_is_a_unique_11']))?$user_language[$user_selected]['lg_which_is_a_unique_11']:$default_language['en']['lg_which_is_a_unique_11']; ?>-<?php echo (!empty($user_language[$user_selected]['lg_digit_code_that_the_bank_branch']))?$user_language[$user_selected]['lg_digit_code_that_the_bank_branch']:$default_language['en']['lg_digit_code_that_the_bank_branch']; ?> i.e. <?php echo (!empty($user_language[$user_selected]['lg_icic0001245']))?$user_language[$user_selected]['lg_icic0001245']:$default_language['en']['lg_icic0001245']; ?>">

									 

								</div>





                        <div class="form-group text-right" id="accept_div_row">

							<button class="btn btn-primary btn-border" onclick="buyer_accept_order_request();" type="button"><?php echo (!empty($user_language[$user_selected]['lg_save']))?$user_language[$user_selected]['lg_save']:$default_language['en']['lg_save']; ?> & <?php echo (!empty($user_language[$user_selected]['lg_accept']))?$user_language[$user_selected]['lg_accept']:$default_language['en']['lg_accept']; ?></button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

	</div>

<div class="modal center-modal custom-popup fade" id="feedbackmodel" role="dialog" >

	<div class="modal-dialog" >

		<div class="modal-content">

			<div class="modal-header text-center">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

				<h5 class="modal-title" id="myModalLabel"><?php echo (!empty($user_language[$user_selected]['lg_no_feedback']))?$user_language[$user_selected]['lg_no_feedback']:$default_language['en']['lg_no_feedback']; ?> </h5>

			</div>

			<div class="modal-body">

				<div class="alert alert-danger feedback-alert"><?php echo (!empty($user_language[$user_selected]['lg_feedback_can_be_provided_once_the_order_is_completed']))?$user_language[$user_selected]['lg_feedback_can_be_provided_once_the_order_is_completed']:$default_language['en']['lg_feedback_can_be_provided_once_the_order_is_completed']; ?>.</div>

			</div>

		</div>

	</div>

</div>