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

                        <h3 class="page-title"><?php echo (!empty($user_language[$user_selected]['lg_my_subscription']))?$user_language[$user_selected]['lg_my_subscription']:$default_language['en']['lg_my_subscription']; ?></h3>

                    </div>

                </div>

            </div>

        </section>

        <div class="tab-content grey-bg">

            <div class="container">

                <div class="row">

                    <div class="col-md-12">

                                <div class="table-responsive order-table">

                                    <table class="table table-striped releasetable m-b-0">
										<thead>
											<tr>                                                    
												<th>#</th>
												<th><?php echo (!empty($user_language[$user_selected]['lg_subscription_amount']))?$user_language[$user_selected]['lg_subscription_amount']:$default_language['en']['lg_subscription_amount']; ?></th>
												<th><?php echo (!empty($user_language[$user_selected]['lg_subscription_type']))?$user_language[$user_selected]['lg_subscription_type']:$default_language['en']['lg_subscription_type']; ?></th>

												<th><?php echo (!empty($user_language[$user_selected]['lg_subscription_period']))?$user_language[$user_selected]['lg_subscription_period']:$default_language['en']['lg_subscription_period']; ?></th>

												<th><?php echo (!empty($user_language[$user_selected]['lg_number_of_gigs']))?$user_language[$user_selected]['lg_number_of_gigs']:$default_language['en']['lg_number_of_gigs']; ?></th>

												<th><?php echo (!empty($user_language[$user_selected]['lg_valid_till']))?$user_language[$user_selected]['lg_valid_till']:$default_language['en']['lg_valid_till']; ?></th>

												<th><?php echo (!empty($user_language[$user_selected]['lg_pending_days']))?$user_language[$user_selected]['lg_pending_days']:$default_language['en']['lg_pending_days']; ?></th>
											</tr>
										</thead>
										<tbody>
											<?php 

											if (!empty($list)) {
											$i=1;
												foreach ($list as $subs) {

													$currency_option = (!empty($item['currency_type']))?$item['currency_type']:'USD';
													$rate_symbol = currency_sign($currency_option);
													$username = $subs['username'];
													$id = $subs['id'];
													$subscription_gigs = $subs['subscription_gigs'];
													$currency_type = $subs['currency_type'];
													$subscription_period = $subs['subscription_period'];
													$subscription_amount = $subs['subscription_amount'];
													$subscription_name = $subs['subscription_name'];
													$expired_date = $subs['expired_date'];
													$expire_days = $subs['expire_days'];
												
												?>

												<tr>
													<td><?php echo $i++; ?></td>
													<td><?php echo $subscription_amount.' '.$rate_symbol;  ?></td>
													<td><?php echo $subscription_name; ?></td>
													<td><?php echo $subscription_period; ?></td>
													<td><?php echo $subscription_gigs; ?></td>
													<td><?php echo date('d M Y', strtotime(str_replace('-','/', $expired_date))); ?></td>
													<td><?php echo $expire_days; ?></td>
												</tr>
												<?php }}else{
													?>
													<tr>
														<td colspan="8"><p class="text-danger text-center m-b-0"><?php echo (!empty($user_language[$user_selected]['lg_no_records_found']))?$user_language[$user_selected]['lg_no_records_found']:$default_language['en']['lg_no_records_found']; ?></p></td>
													</tr>
													<?php } ?>
												</tbody>
											</table>

                                </div>

                    </div>

                </div>

            </div>

        </div>