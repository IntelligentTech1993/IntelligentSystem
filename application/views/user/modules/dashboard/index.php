<div class="content-page">
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="page-title"><?php echo (!empty($user_language[$user_selected]['lg_dashboard']))?$user_language[$user_selected]['lg_dashboard']:$default_language['en']['lg_dashboard']; ?></h4>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					<div class="widget-panel widget-style-2 bg-white">
						<i class="md md-attach-money text-primary"></i>
						<h2 class="m-0 text-dark counter font-600"><?php echo $dashboard_details['total_gigs']; ?></h2>
						<div class="text-muted m-t-5"><?php echo (!empty($user_language[$user_selected]['lg_total_gigs']))?$user_language[$user_selected]['lg_total_gigs']:$default_language['en']['lg_total_gigs']; ?></div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="widget-panel widget-style-2 bg-white">
					  <i class="md md-account-child text-custom"></i>
						<h2 class="m-0 text-dark counter font-600"><?php echo $dashboard_details['total_user']; ?></h2>
						<div class="text-muted m-t-5"><?php echo (!empty($user_language[$user_selected]['lg_total_users']))?$user_language[$user_selected]['lg_total_users']:$default_language['en']['lg_total_users']; ?></div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="widget-panel widget-style-2 bg-white">
						<i class="md md-store-mall-directory text-info"></i>
						<h2 class="m-0 text-dark counter font-600"><?php echo $dashboard_details['total_orders']; ?></h2>
						<div class="text-muted m-t-5"><?php echo (!empty($user_language[$user_selected]['lg_total_orders']))?$user_language[$user_selected]['lg_total_orders']:$default_language['en']['lg_total_orders']; ?></div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="widget-panel widget-style-2 bg-white">
														<i class="md md-add-shopping-cart text-pink"></i>  
						<h2 class="m-0 text-dark counter font-600"><?php echo $dashboard_details['completed_orders']; ?></h2>
						<div class="text-muted m-t-5"><?php echo (!empty($user_language[$user_selected]['lg_completed_orders']))?$user_language[$user_selected]['lg_completed_orders']:$default_language['en']['lg_completed_orders']; ?></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="card-box">
						<a href="#" class="pull-right btn btn-default btn-sm waves-effect waves-light"><?php echo (!empty($user_language[$user_selected]['lg_view_all']))?$user_language[$user_selected]['lg_view_all']:$default_language['en']['lg_view_all']; ?></a>
						<h4 class="text-dark header-title m-t-0"><?php echo (!empty($user_language[$user_selected]['lg_recent_orders']))?$user_language[$user_selected]['lg_recent_orders']:$default_language['en']['lg_recent_orders']; ?></h4>
						<div class="table-responsive">
							<table class="table table-actions-bar">
								<thead>
									<tr>
										<th><?php echo (!empty($user_language[$user_selected]['lg_product']))?$user_language[$user_selected]['lg_product']:$default_language['en']['lg_product']; ?></th>
										<th><?php echo (!empty($user_language[$user_selected]['lg_order_date']))?$user_language[$user_selected]['lg_order_date']:$default_language['en']['lg_order_date']; ?></th>
										<th><?php echo (!empty($user_language[$user_selected]['lg_order_number']))?$user_language[$user_selected]['lg_order_number']:$default_language['en']['lg_order_number']; ?></th>
										<th><?php echo (!empty($user_language[$user_selected]['lg_amount']))?$user_language[$user_selected]['lg_amount']:$default_language['en']['lg_amount']; ?></th>                                                   
									</tr>
								</thead>
								<tbody>
									<?php 
									$rate = "$";
									foreach($recent_orders as $recent) { 
									 $image = base_url().'assets/images/gig-small.jpg';
									 if(!empty($recent['gig_image_thumb']))
									 {
									 $image = base_url().$recent['gig_image_thumb'];
									 }
									 ?>                                        
									<tr>
										<td><img src="<?php echo $image; ?>" class="thumb-sm" alt=""> </td>
										<td><?php echo    date('Y-m-d', strtotime(str_replace('-','/', $recent['created_at'])));  ?></td>
										<td><a href="javascript:;"><?php echo $recent['paypal_uid']; ?></a></td>
										<td><?php echo  $rate.$recent['item_amount']; ?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="card-box">
						<a href="#" class="pull-right btn btn-default btn-sm waves-effect waves-light"><?php echo (!empty($user_language[$user_selected]['lg_view_all']))?$user_language[$user_selected]['lg_view_all']:$default_language['en']['lg_view_all']; ?></a>
						<h4 class="text-dark header-title m-t-0"><?php echo (!empty($user_language[$user_selected]['lg_popular_products']))?$user_language[$user_selected]['lg_popular_products']:$default_language['en']['lg_popular_products']; ?></h4>
						<div class="table-responsive">
							<table class="table table-actions-bar">
								<thead>
									<tr>
										<th><?php echo (!empty($user_language[$user_selected]['lg_product']))?$user_language[$user_selected]['lg_product']:$default_language['en']['lg_product']; ?></th>
										<th><?php echo (!empty($user_language[$user_selected]['lg_added_date']))?$user_language[$user_selected]['lg_added_date']:$default_language['en']['lg_added_date']; ?></th>
										<th><?php echo (!empty($user_language[$user_selected]['lg_orders']))?$user_language[$user_selected]['lg_orders']:$default_language['en']['lg_orders']; ?></th>
										<th><?php echo (!empty($user_language[$user_selected]['lg_amount']))?$user_language[$user_selected]['lg_amount']:$default_language['en']['lg_amount']; ?></th>                                                   
									</tr>
								</thead>
								<tbody>
								<?php foreach($popular_orders as $popular_order) { 
									$image = base_url().'assets/images/gig-small.jpg';
									if(!empty($recent['gig_image_thumb']))
									{
									$image = base_url().$recent['gig_image_thumb'];
									}
								?>         
									<tr>
										<td><img src="<?php echo $image ; ?>" class="thumb-sm" alt=""> </td>
										<td><?php echo date('Y-m-d', strtotime(str_replace('-','/', $popular_order['created_at'])));  ?></td>
										<td><b><?php echo $popular_order['total_views']; ?></b></td>
										<td><?php echo $rate.$popular_order['item_amount']; ?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer class="footer text-right">
	  <?php echo $this->session->userdata('copy_right_year') ; ?>
	</footer>
</div>