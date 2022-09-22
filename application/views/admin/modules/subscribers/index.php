<div class="content-page">
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="page-title m-b-20 m-t-0">Subscribers</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card-box m-b-0">
						<ul class="nav nav-tabs navtab-bg nav-justified">

							<li class="active tab"><a href="#general" data-toggle="tab">Subscribers</a></li>

							<li class="tab"><a href="#expired" data-toggle="tab">Expired Subscribers</a></li>

						</ul>
						<div class="tab-content">
							<div id="general" class="tab-pane active">
								<div class="table-responsive">
									<table class="table table-actions-bar table-striped releasetable m-b-0">
										<thead>
											<tr>                                                    
												<th>#</th>
												<th>Date</th>
												<th>User name</th>
												<th>Subscription Amount</th>
												<th>Subscription Type</th>
												<th>Subscription Period</th>
												<th>Number of gigs</th>
												<th>Valid Till</th>
												<th>Pending Days</th>
											</tr>
										</thead>
										<tbody>
											<?php 

											if (!empty($list)) {
											$i=1;
												foreach ($list as $subs) {
// print_r($subs);exit;
													$date = $subs['created_at'];
													$username = $subs['username'];
													$id = $subs['id'];
													$currency_type = $subs['currency_type'];
													$subscription_period = $subs['subscription_period'];
													$subscription_gigs = $subs['subscription_gigs'];
													$subscription_amount = $subs['subscription_amount'];
													$subscription_name = $subs['subscription_name'];
													$expired_date = $subs['expired_date'];
													$expire_days = $subs['expire_days'];
												
												?>

												<tr>
													<td><?php echo $i++; ?></td>
													<td><?php echo date('d M Y', strtotime($date)); ?></td>
													<td><?php echo ucfirst($username); ?></td>
													<td><?php echo $subscription_amount; ?></td>
													<td><?php echo $subscription_name; ?></td>
													<td><?php echo $subscription_period; ?></td>
													<td><?php echo $subscription_gigs; ?></td>
													<td><?php echo date('d M Y', strtotime(str_replace('-','/', $expired_date))); ?></td>
													<td><?php echo $expire_days; ?></td>
												</tr>
												<?php }}else{
													?>
													<tr>
														<td colspan="8"><p class="text-danger text-center m-b-0">No Records Found</p></td>
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
									<div id="expired" class="tab-pane">
										<div class="table-responsive">
									<table class="table table-actions-bar datatable m-b-0">
										<thead>
											<tr>                                                    
												<th>#</th>
												<th>Date</th>
												<th>User name</th>
												<th>Subscription Amount</th>
												<th>Subscription Type</th>
												<th>Subscription Period</th>
												<th>Number of gigs</th>
												<th>Valid Till</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<?php 

											if (!empty($data)) {
												$j=1;
												foreach ($data as $exp) {
													$username = $exp['username'];
													$date = $exp['created_at'];
													$id = $exp['id'];
													$currency_type = $exp['currency_type'];
													$subscription_period = $exp['subscription_period'];
													$subscription_gigs = $subs['subscription_gigs'];
													$subscription_amount = $exp['subscription_amount'];
													$subscription_name = $exp['subscription_name'];
													$expired_date = $exp['expired_date'];
													$expire_days = "Expired";
												
												?>

												<tr>
													<td><?php echo $j++; ?></td>
													<td><?php echo date('d M Y', strtotime($date)); ?></td>
													<td><?php echo ucfirst($username); ?></td>
													<td><?php echo $subscription_amount; ?></td>
													<td><?php echo $subscription_name; ?></td>
													<td><?php echo $subscription_period; ?></td>
													<td><?php echo $subscription_gigs; ?></td>
													<td><?php echo date('d M Y', strtotime(str_replace('-','/', $expired_date)));?></td>
													<td><?php echo $expire_days; ?></td>
												</tr>
												<?php }}else{
													?>
													<tr>
														<td colspan="8"><p class="text-danger text-center m-b-0">No Records Found</p></td>
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
				</div>
			</div>
		</div>
