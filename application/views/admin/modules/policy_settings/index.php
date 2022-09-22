<div class="content-page">
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-sm-8">
					<h4 class="page-title m-t-0">Placeholders</h4>
					<p class="m-t-5">Maximum 4 Placeholders only!</p>
				</div>
				<div class="col-sm-4 text-right m-b-20">
				<?php 
					if(count($list)<4) { 
				?>
				<a href="<?php echo base_url().'admin/policy_settings/create'; ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Placeholders</a>
				<?php } ?>
				</div>
			</div>
			<?php if($this->session->userdata('message')) {  ?>
		               <?php echo $this->session->userdata('message');?>
			<?php } ?>
             <div class="row">
				<div class="col-lg-12">
					<div class="card-box">
						<div class="table-responsive">
							<table class="table table-striped releasetable m-b-0">
								<thead>
									<tr>
										<th>#</th>
										<th>Image</th>
										<th>Placeholder Name</th>
										<th>Placeholder Description</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									if(!empty($list)) 
									{
									$i=1;
									foreach($list as $item) { 
										$status = 'Active'; if($item['status']==1){$status = 'Inactive';}                                                      
										?>
									<tr>                                                    
										<td><?php echo $i; ?></td>
										<td><img class="thumbnail m-b-0" src="<?php echo base_url().$item['policy_raw_image']; ?>" height="32"></td>
										<td><?php echo $item['policy_name']; ?></td>                                                   
										<td><?php echo $item['policy_terms']; ?></td>                                                                                                   
										<td class="text-right">
											<a href="<?php echo base_url()."admin/policy_settings/edit/".$item['id']; ?>" class="table-action-btn"><i class="mdi mdi-pencil text-success"></i></a>
											<a href="#" onclick="delete_policy_setting(<?php echo $item['id'] ?>)" class="table-action-btn"><i class="mdi mdi-window-close text-danger"></i></a>
										</td>
									</tr>
									<?php $i = $i+1; } } else { ?>
									<tr>
										<td colspan="5"><p class="text-danger text-center m-b-0">No Records Found</p></td>
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