	<div class="">

        <?php //$this->load->view('user/includes/search_include'); ?>

        <section class="profile-section">

            <div class="container">

			<?php if($this->session->flashdata('msg_error')){ ?>

			<div class="row">

				<div class="col-md-12">

					<div class="alert alert-danger"><?php echo $this->session->flashdata('msg_error'); ?></div>

				</div>

			</div>

			<?php }  ?>

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

                       <h3 class="page-title"><?php echo (!empty($user_language[$user_selected]['lg_my_sales']))?$user_language[$user_selected]['lg_my_sales']:$default_language['en']['lg_my_sales']; ?></h3>

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

                                <li class="active">

									<a href="javascript:;">

										<span class="visible-xxs"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?php if($sales_order_count>0){?><span class="badge badge-white position-right"><?php echo $sales_order_count;?></span><?php }?></span> 

										<span class="hidden-xxs"><?php echo (!empty($user_language[$user_selected]['lg_my_sales']))?$user_language[$user_selected]['lg_my_sales']:$default_language['en']['lg_my_sales']; ?> <?php if($sales_order_count>0){?><span class="badge badge-white position-right"><?php echo $sales_order_count;?></span><?php }?></span>

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

                                	<form method="post" autocomplete="off" action="<?php echo base_url();?>sales">
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



                                                <th><?php echo (!empty($user_language[$user_selected]['lg_buyer']))?$user_language[$user_selected]['lg_buyer']:$default_language['en']['lg_buyer']; ?></th>



                                                <th><?php echo (!empty($user_language[$user_selected]['lg_feedback']))?$user_language[$user_selected]['lg_feedback']:$default_language['en']['lg_feedback']; ?></th>



                                                <th><?php echo (!empty($user_language[$user_selected]['lg_cancel_request']))?$user_language[$user_selected]['lg_cancel_request']:$default_language['en']['lg_cancel_request']; ?></th>



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

											 $completed_request = (!empty($user_language[$user_selected]['lg_completed_request']))?$user_language[$user_selected]['lg_completed_request']:$default_language['en']['lg_completed_request'];

											 $see_feedback = (!empty($user_language[$user_selected]['lg_see_feedback']))?$user_language[$user_selected]['lg_see_feedback']:$default_language['en']['lg_see_feedback'];

											 

											foreach($order_data as $item) { 

										 

											$rate = $item['item_amount'];

										 
$currency_option = (!empty($item['currency_type']))?$item['currency_type']:'USD';
$rate_symbol = currency_sign($currency_option);
 
											 

											$f_uid = $item['user_id'];

											$t_uid = $item['USERID'];

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

														$sts=''.$refunded.'';

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

														$sts=''.$refunded.'';

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

														$sts=''.$refunded.'';

													$class='label-info';

													}

												}

												}

											}elseif($status ==4){

												$sts=''.$refunded.'';

												$class='label-danger';

											}elseif($status ==5){

												if($item['decline_accept'] ==0)

												{

													$sts=''.$decline_request.'';

												}

												else{

													$sts=''.$declined.'';

												}

												$class='label-danger';

											}elseif($status ==6){

												$sts=''.$completed.'';

												$class='label-success';

											}elseif($status ==7){

												$sts=''.$completed_request.'';

												$class='label-success';

											}

											$fead_stautus=0;

											if($status ==6) {

												

												$query = $this->db->query("SELECT id FROM `feedback` WHERE `from_user_id` = $t_uid and `to_user_id` = $f_uid and `gig_id` = $gid and `order_id` = $order_id;");

        										$result = $query->row_array();

												$fead_stautus=1; 

												if($result['id']!=''){

													$b_sts=''.$see_feedback.'';

												}else

												{

													$fead_stautus=2; 	

													$b_sts=''.$pending.'';

												}

											}

											else

											{

												$fead_stautus=2; 

												$b_sts=''.$pending.'';

											}

											 $created_on = '-';

                                            if (isset($item['created_at'])) {

                                                if (!empty($item['created_at']) && $item['created_at'] != "0000-00-00 00:00:00") {

                                                    $created_on = date('j F Y g:i', strtotime($item['created_at']));

                                                }

                                            }

											$delivery_date = date('d M Y', strtotime($item['delivery_date']));

											 // if (isset($item['delivery_date'])) {								 

            //                                     if (!empty($item['delivery_date'])  && $item['delivery_date'] != "0000-00-00 00:00:00" || $item['delivering_time']) {



												// $date = strtotime("+".$item['delivering_time']." days", strtotime($item['delivery_date']));

												//  $delivery_date = date("d M Y", $date);

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

                                                            <a href="javascript:;" onclick="sales_view(<?php echo $item['id'];?>)"><img src="<?php echo $image_url;?>" alt="" width="50" height="34"></a>

                                                        </div>

                                                        <div class="pull-left">

                                                            <h4 class="product-name2"><a href="javascript:;" onclick="sales_view(<?php echo $item['id'];?>)"><?php echo ucfirst(str_replace("-"," ",$item['title']));?></a></h4> <span class="order_date"><?php echo $created_on;?></span> 

                                                        </div>

                                                    </div>

                                                </td>

                                                <td><a href="javascript:;" onclick="sales_view(<?php echo $item['id'];?>)" ><?php echo $item['id'];?></a></td>

                                                <td>

                                                    <span class="label label-success"><?Php echo $delivery_date; ?></span>

                                                </td>

                                                <td>

                                                    <a href="<?php echo $user_linkone;?>" class="text-dark"><b><?php echo ucfirst($item['fullname']);?></b></a>

                                                </td>

                                                <td>

													<a href="javascript:;" <?php if($fead_stautus ==1 ){ ?> onclick="add_seller_feedback(<?php echo $f_uid;?> ,<?php echo $t_uid;?>, <?php echo $gid;?>,<?php echo $item['id'];?>);" <?php } else { ?>  onclick="add_seller_feedbacks();" <?php  }?>><?php echo $b_sts;?></a>

												</td>

                                                <td class="text-center">

													<?php if($item['buyer_status'] ==0 && $status ==6 ) {?>

                                                    	-

                                                    <?php } else if($item['buyer_status'] ==1) {

														if($item['cancel_accept'] ==0){?>

                                                        	<a href="javascript:;" onclick="show_cancelreason('<?php echo $item['cancel_reason'] ?>',<?php echo $item['cancel_accept'] ?>,<?php echo $item['id'];?>);"><span class="label label-danger"><?php echo (!empty($user_language[$user_selected]['lg_cancel_request']))?$user_language[$user_selected]['lg_cancel_request']:$default_language['en']['lg_cancel_request']; ?></span></a>

                                                        <?php }else{?>

                                                    	 	<a href="javascript:;" onclick="show_cancelreason('<?php echo $item['cancel_reason'] ?>',<?php echo $item['cancel_accept'] ?>,<?php echo $item['id'];?>);"><span class="label label-danger"><?php echo (!empty($user_language[$user_selected]['lg_view_reason']))?$user_language[$user_selected]['lg_view_reason']:$default_language['en']['lg_view_reason']; ?></span></a>

                                                    <?php } } else {?>

                                                    	-

                                                    <?php }?>

                                                </td>

                                                <td><?php echo $rate_symbol.$rate ;?></td>

                                                <td>

                                                	<?php if($item['buyer_status'] ==1) {?>

                                                    	<span class="label <?php echo $class;?>"><?php echo $sts;?></span>

                                                	<?php }else if($status ==0) {?>

                                                    	<span class="label <?php echo $class;?>"><?php echo $sts;?></span>

                                                	<?php } else if($status ==6) {?>

                                                     	<span class="label <?php echo $class;?>"><?php echo $sts;?></span>

                                                    <?php }else if($status ==5) {?>

                                                     	<span class="label <?php echo $class;?>"><?php echo $sts;?></span>

                                                    <?php }else{?>

                                                    	<a href="javascript:;" <?php if($status!=7) { ?> onclick="change_gig_status(<?php echo $item['id'];?>, <?php echo $status;?>);" <?php } ?>><span class="label <?php echo $class;?>"><?php echo $sts;?></span></a>

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

                                    <form method="post" action="<?php echo base_url();?>user/sales/generate_reports">
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

											<a href="#" class="pull-left"><img class="img-circle" width="60" height="60" alt="" src="assets/images/user.jpg"></a>

											<div class="media-body">

                                            <form action="" type="post" id="feedback_rating_formqw">

                                                <input type="hidden" id="rating_frmuser" value="" name="rating_frmuser" />

                                                <input type="hidden" id="rating_touser" value="" name="rating_touser" />

                                                <input type="hidden" id="rating_gig" value="" name="rating_gig" />

                                                <input type="hidden" id="rating_orderid" value="" name="rating_orderid" />

                                                <div class="row">

                                                    <div class="form-group clearfix">

                                                        

                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-md-6">

                                                        <span id="stars-existing" class="starrr" data-rating='1'></span> 

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

     

     <div id="status-popup" class="modal fade custom-popup" role="dialog">

        <div class="modal-dialog">

            <div class="modal-content">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <div class="modal-header text-center">

                    <h5><?php echo (!empty($user_language[$user_selected]['lg_change_your_status']))?$user_language[$user_selected]['lg_change_your_status']:$default_language['en']['lg_change_your_status']; ?></h5>

                </div>

                <div class="modal-body">

                <form class="form-horizontal" id="change_gigs_status" method="post" enctype="multipart/form-data">

                	<input type="hidden" name="sell_gigs_statusid" id="sell_gigs_statusid" value="" />

                        <div class="form-group">

                            <label class="col-lg-4"><?php echo (!empty($user_language[$user_selected]['lg_order_status']))?$user_language[$user_selected]['lg_order_status']:$default_language['en']['lg_order_status']; ?></label>

                            <div class="col-lg-8">

                                <span class="status-select">

                                    <select class="custom-select" id="seller_status" name="seller_status">

                                        <option value="2"><?php echo (!empty($user_language[$user_selected]['lg_pending']))?$user_language[$user_selected]['lg_pending']:$default_language['en']['lg_pending']; ?></option>



                                        <option value="3"><?php echo (!empty($user_language[$user_selected]['lg_processing']))?$user_language[$user_selected]['lg_processing']:$default_language['en']['lg_processing']; ?></option>



                                        <option value="6"><?php echo (!empty($user_language[$user_selected]['lg_completed']))?$user_language[$user_selected]['lg_completed']:$default_language['en']['lg_completed']; ?></option>



                                        <option value="5" ><?php echo (!empty($user_language[$user_selected]['lg_declined']))?$user_language[$user_selected]['lg_declined']:$default_language['en']['lg_declined']; ?> </option>

                                    </select>

                                </span>

                            </div>

                        </div>

                        <div class="form-group">

                             <div class="col-lg-12"><button class="btn btn-primary btn-border pull-right" onclick="change_product_status();" type="button"><?php echo (!empty($user_language[$user_selected]['lg_update_order_status']))?$user_language[$user_selected]['lg_update_order_status']:$default_language['en']['lg_update_order_status']; ?></button></div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

		</div>

			<div class="modal fade custom-popup center-modal" id="feedbackmodel" role="dialog" >

				<div class="modal-dialog" >

					<div class="modal-content">

						<div class="modal-header text-center">

							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

							<h5 class="modal-title" id="myModalLabel"> <?php echo (!empty($user_language[$user_selected]['lg_no_feedback']))?$user_language[$user_selected]['lg_no_feedback']:$default_language['en']['lg_no_feedback']; ?> </h5>

						</div>

						<div class="modal-body">

							<div class="alert alert-danger alert alert-danger"><?php echo (!empty($user_language[$user_selected]['lg_no_feedback_received']))?$user_language[$user_selected]['lg_no_feedback_received']:$default_language['en']['lg_no_feedback_received']; ?></div>

						</div>

					</div>

				</div>

			</div>

        <div id="reason_model" class="modal fade custom-popup" role="dialog">

        <div class="modal-dialog">

            <div class="modal-content">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <div class="modal-header text-center">

                    <h5><?php echo (!empty($user_language[$user_selected]['lg_buyer_cancel_reason']))?$user_language[$user_selected]['lg_buyer_cancel_reason']:$default_language['en']['lg_buyer_cancel_reason']; ?></h5>

                </div>

                <div class="modal-body">

                

                <form class="form-horizontal"  method="" >

                        <div class="form-group">

                            <div class="col-lg-12">

                                <div id="reason_txt_message" class="custom-box"></div>

                            </div>

                        </div>

                        <div class="form-group" id="accept_div_row">

                        </div>

                    </form>

                </div>

            </div>

        </div>

		</div>