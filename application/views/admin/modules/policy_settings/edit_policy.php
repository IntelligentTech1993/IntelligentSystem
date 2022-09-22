<div class="content-page">
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="page-title m-b-20 m-t-0">Edit Placeholder</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card-box">
						<form id="admin_add_ip" action="<?php echo base_url().'admin/policy_settings/edit/'.$list['id']; ?>" enctype= "multipart/form-data" method="post" >
							<div class="form-group">
								<label for="policy_name">Placeholder Name</label>
								<input type="text" name="policy_name" class="form-control only_alphabets" value="<?php echo $list['policy_name']; ?>" id="policy_name" required>
							</div>  
							<div class="form-group">
								<label for="client_image">Placeholder Image</label>

								<div id="avatar-view" class="avatar" style="width: 200px; height: 200px;">							
									<div class="dgt"
									data-status-upload-success="Placeholder image updated"
									data-label-loading="File uploading.."
									data-instant-edit="true"
									data-service="<?php echo base_url(); ?>admin/policy_settings/upload_image"
									data-push="true"
									data-ratio="1:1"
									data-crop="0,0,200,200"
									data-label="Upload Placeholder Image"
									data-size="200,200"
									data-max-file-size="2"
									data-will-remove="imageRemoved"
									data-did-upload="imageUpload" 

									>
									<img src="<?php echo base_url($list['policy_raw_image']);?>" width="200" height="100">
									<input type="file" name="dgt[]"/>
								</div>						
							</div>

							<input type="hidden" value="<?php echo $list['policy_raw_image']; ?>" name="imageurl" id="imageurl">
								<span class="help-block"><small>Recommended image size is <b>200px x 200px</b></small></span>
							</div>
							<div class="form-group">
								<label for="policy_description">Placeholder Description</label>
								<input type="text" name="policy_description" value="<?php echo $list['policy_terms']; ?>" maximumlength="250" class="form-control" id="policy_description" required>
							</div>
					
							<div class="form-group m-b-0 m-t-30">
								<button class="btn btn-primary" name="form_submit" value="submit" type="submit">Submit</button>
								<a href="<?php echo base_url().'admin/policy_settings' ?>" class="btn btn-default m-l-5">Cancel</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>