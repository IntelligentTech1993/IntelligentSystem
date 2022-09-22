<div class="content-page">
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="page-title m-b-20 m-t-0">Edit Client</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card-box">
						<form id="admin_add_client" action="<?php echo base_url().'admin/client/edit/'.$list['id'] ;?>" method="post"  enctype="multipart/form-data"  >
							<div class="form-group">
								<label for="client_name">Client Url</label>
								<input type="url" value="<?php if(!empty($list['client_name'])){ echo $list['client_name']; } ?>" name="client_name" placeholder="https://www.dreamguys.co.in" value=" " class="form-control only_alphabets" id="client_name">
							</div>
							<div class="form-group">
								<label for="client_image">Client Image</label>

								<div id="avatar-view" class="avatar" style="width: 200px; height: 200px;">							
									<div class="dgt"
									data-status-upload-success="client image updated"
									data-label-loading="File uploading.."
									data-instant-edit="true"
									data-service="<?php echo base_url(); ?>admin/client/upload_image"
									data-push="true"
									data-ratio="1:1"
									data-label="Upload Client Image"
									data-size="170,100"
									data-crop="0,0,170,100"
									data-max-file-size="2"
									data-will-remove="imageRemoved"
									data-did-upload="imageUpload" 

									>
									<img src="<?php echo base_url($list['client_raw_image']);?>" width="200" height="100">
									<input type="file" name="dgt[]"/>
								</div>						
							</div>

							<input type="hidden" value="<?php echo $list['client_raw_image']; ?>" name="imageurl" id="imageurl">
								<span class="help-block"><small>Recommended image size is <b>170px x 100px</b></small></span>
							</div> 
							<div class="form-group">
								<label class="control-label">Status</label>
								<div>
									<div class="radio radio-primary radio-inline">
										<input type="radio" id="blog_status1" value="0" name="status" <?php
										if ($list['status'] == 0) {
											echo 'checked=""';
										}
										?>>
										<label for="blog_status1">Active</label>
									</div>
									<div class="radio radio-danger radio-inline">
										<input type="radio" id="blog_status2" value="1" name="status" <?php
										if ($list['status'] == 1) {
											echo 'checked=""';
										}
										?>>
										<label for="blog_status2">Inactive</label>
									</div>
								</div>
							</div>
							<div class="form-group m-b-0 m-t-30">
								<button class="btn btn-primary" name="form_submit" value="submit" type="submit">Submit</button>
								<a href="<?php echo base_url().'admin/client' ?>" class="btn btn-default m-l-5">Cancel</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
 </div>