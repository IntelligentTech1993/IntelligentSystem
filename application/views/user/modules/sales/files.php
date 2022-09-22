    <?php //$this->load->view('user/includes/search_include'); ?>

        <section class="profile-section">

            <div class="container">

				<?php if ($this->session->flashdata('msg')) {?>

				<div class="row">

					<div class="col-md-12">

						<div class="alert alert-success">

							<?php echo $this->session->flashdata('msg');?>

						</div>

					</div>

				</div>

				<?php } ?>

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

										<span class="visible-xxs"><i class="fa fa-credit-card" aria-hidden="true"></i></span> 

										<span class="hidden-xxs"><?php echo (!empty($user_language[$user_selected]['lg_my_purchases']))?$user_language[$user_selected]['lg_my_purchases']:$default_language['en']['lg_my_purchases']; ?></span>

									</a>

								</li>

                                <li>

									<a href="<?php echo base_url().'sales';?>">

										<span class="visible-xxs"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span> 

										<span class="hidden-xxs"><?php echo (!empty($user_language[$user_selected]['lg_my_sales']))?$user_language[$user_selected]['lg_my_sales']:$default_language['en']['lg_my_sales']; ?></span>

									</a>

								</li>

                                <li>

									<a href="<?php echo base_url().'payments';?>">

										<span class="visible-xxs"><i class="fa fa-money" aria-hidden="true"></i> </span> 

										<span class="hidden-xxs"><?php echo (!empty($user_language[$user_selected]['lg_my_payments']))?$user_language[$user_selected]['lg_my_payments']:$default_language['en']['lg_my_payments']; ?></span>

									</a>

								</li>



								<li  class="active">

									<a href="avascript:;">

										<span class="visible-xxs"><i class="fa fa-file" aria-hidden="true"></i> </span> 

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

                                    <table class="table table-actions-bar">

                                        <thead>

                                            <tr>

                                                 <th><?php echo (!empty($user_language[$user_selected]['lg_order_title']))?$user_language[$user_selected]['lg_order_title']:$default_language['en']['lg_order_title']; ?> </th>



                                                <th><?php echo (!empty($user_language[$user_selected]['lg_order_id']))?$user_language[$user_selected]['lg_order_id']:$default_language['en']['lg_order_id']; ?></th>



                                                <th><?php echo (!empty($user_language[$user_selected]['lg_delivery_date']))?$user_language[$user_selected]['lg_delivery_date']:$default_language['en']['lg_delivery_date']; ?></th>



                                                <th><?php echo (!empty($user_language[$user_selected]['lg_buyer']))?$user_language[$user_selected]['lg_buyer']:$default_language['en']['lg_buyer']; ?></th>



                                                <th><?php echo (!empty($user_language[$user_selected]['lg_amount']))?$user_language[$user_selected]['lg_amount']:$default_language['en']['lg_amount']; ?></th>

                                                

                                               

                                            </tr>

                                        </thead>



                                        <tbody>

										<?php

                                        $see_feedback = (!empty($user_language[$user_selected]['lg_see_feedback']))?$user_language[$user_selected]['lg_see_feedback']:$default_language['en']['lg_see_feedback'];

                                        $pending = (!empty($user_language[$user_selected]['lg_pending']))?$user_language[$user_selected]['lg_pending']:$default_language['en']['lg_pending'];

										 if(!empty($order_data)) 

										 {

											$country_name = $this->session->userdata('country_name');

											$rupee_rate  = $this->session->userdata('rupee_rate');

											$dollar_rate  = $this->session->userdata('dollar_rate');

											 

											foreach($order_data as $item) { 

										                                       
$currency_option = (!empty($item['currency_type']))?$item['currency_type']:'USD';
$rate_symbol = currency_sign($currency_option);

                                            $currency_option = $item['currency_type'];

                                       
                                        

											$rate = $item['item_amount'];

											 

											 

											$f_uid = $item['user_id'];

											$t_uid = $item['USERID'];

											$gid   = $item['gigs_id'];

											$status = $item['seller_status']; 

											$order_id =$item['id'];

											 

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

											$delivery_date='-';

											 if (isset($item['delivery_date'])) {								 

                                                if (!empty($item['delivery_date'])  && $item['delivery_date'] != "0000-00-00 00:00:00" || $item['delivering_time']) {



												$date = strtotime("+".$item['delivering_time']." days", strtotime($item['delivery_date']));

												 $delivery_date = date("d M Y", $date);

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

                                                            <a href="javascript:;" onclick="sales_view_file(<?php echo $item['id'];?>)"><img src="<?php echo $image_url;?>" alt="" width="50" height="34"></a>

                                                        </div>

                                                        <div class="pull-left">

                                                            <h4 class="product-name2"><a href="javascript:;" onclick="sales_view_file(<?php echo $item['id'];?>)"><?php echo ucfirst(str_replace("-"," ",$item['title']));?></a></h4> <span class="order_date"><?php echo $created_on;?></span> 

                                                        </div>

                                                    </div>

                                                </td>

                                                <td><a href="javascript:;" onclick="sales_view_file(<?php echo $item['id'];?>)" ><?php echo $item['id'];?></a></td>

                                                <td>

                                                    <span class="label label-success"><?Php echo $delivery_date; ?></span>

                                                </td>

                                                <td>

                                                    <a href="<?php echo $user_linkone;?>" class="text-dark"><b><?php echo ucfirst($item['fullname']);?></b></a>

                                                </td>

                                                

                                                

                                                <td><?php echo $rate_symbol.$rate ;?></td>

                                                

                                                

                                            </tr>

											 <?php  }

                                                } else { ?>

                                                <tr>

													<td colspan="8"><p class="text-center text-danger m-b-0"><?php echo (!empty($user_language[$user_selected]['lg_no_records_found']))?$user_language[$user_selected]['lg_no_records_found']:$default_language['en']['lg_no_records_found']; ?></p></td>

                                                </tr>

                                                <?php } ?>

                                        </tbody>

                                    </table>

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