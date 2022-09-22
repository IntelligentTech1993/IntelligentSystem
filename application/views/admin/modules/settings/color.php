<div class="content-page">
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="page-title m-b-20 m-t-0">Color & Background Settings </h4>
				</div>
			</div>

			<?php if($this->session->flashdata('message')) { ?>

			<?php echo $this->session->userdata('message'); ?>

			<?php } ?>
			<div class="row">



					<div class="col-md-8 col-md-offset-2">

						<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">

						<label class="control-label">Top Header</label>

						<div class="card-box m-b-0">

							<div class="form-group">

								<label class="col-sm-3 control-label">Background Color</label>

								<div class="col-sm-9">

									<div id="cp2" class="input-group colorpicker-component">
										<input type="text"  name="header_top_bg_color" id="header_top_bg_color" value="<?php if (isset($header_top_bg_color)) echo $header_top_bg_color;?>" class="form-control" />
										<span class="input-group-addon"><i></i></span>
									</div>	

								</div>

							</div>

							<div class="form-group">

								<label class="col-sm-3 control-label">Font Color</label>

								<div class="col-sm-9">

									<div id="cp2" class="input-group colorpicker-component">
										<input type="text" name="header_top_font_color" id="header_top_font_color" value="<?php if (isset($header_top_font_color)) echo $header_top_font_color;?>" class="form-control" />
										<span class="input-group-addon"><i></i></span>
									</div>	

								</div>

							</div>

							
						</div>

						<label class="control-label">Header</label>

						<div class="card-box m-b-0">

							<div class="form-group">

								<label class="col-sm-3 control-label">Background Color</label>

								<div class="col-sm-9">

									<div id="cp2" class="input-group colorpicker-component">
										<input type="text"  name="header_bg_color" id="header_bg_color" value="<?php if (isset($header_bg_color)) echo $header_bg_color;?>" class="form-control" />
										<span class="input-group-addon"><i></i></span>
									</div>	

								</div>

							</div>

							<div class="form-group">

								<label class="col-sm-3 control-label">Font Color</label>

								<div class="col-sm-9">

									<div id="cp2" class="input-group colorpicker-component">
										<input type="text" name="header_font_color" id="header_font_color" value="<?php if (isset($header_font_color)) echo $header_font_color;?>" class="form-control" />
										<span class="input-group-addon"><i></i></span>
									</div>	

								</div>

							</div>

							<div class="form-group">

								<label class="col-sm-3 control-label">Icon Show</label>

								<div class="col-sm-9 toogle_switch">
									<?php 
									$checked='';
									if(isset($header_icon))
									{
										if($header_icon==1)
										{
											$checked='checked';
										}
									}
										?>
									<input type="checkbox"  class="alert-status switch" <?php echo $checked;?> name="header_icon" value="1"   data-size="normal"  data-on-text="on" data-off-text="off">

								</div>

							</div>

						</div>

						<div class="clearfix"></div>

						<label class="control-label">Footer</label>

						<div class="card-box m-b-0">
							<div class="form-group">

								<label class="col-sm-3 control-label">Background Color</label>

								<div class="col-sm-9">

									<div id="cp2" class="input-group colorpicker-component">
										<input type="text" name="footer_bg_color" id="footer_bg_color" value="<?php if (isset($footer_bg_color)) echo $footer_bg_color;?>" class="form-control" />
										<span class="input-group-addon"><i></i></span>
									</div>

								</div>

							</div>
							<div class="form-group">

								<label class="col-sm-3 control-label">Font Color</label>

								<div class="col-sm-9">

									<div id="cp2"  class="input-group colorpicker-component">
										<input type="text" name="footer_font_color" id="footer_font_color" value="<?php if (isset($footer_font_color)) echo $footer_font_color;?>" class="form-control" />
										<span class="input-group-addon"><i></i></span>
									</div>	

								</div>

							</div>

						</div>

						<label class="control-label">Banner</label>

						<div class="card-box m-b-0">
							<!-- <div class="form-group">

								<label class="col-sm-3 control-label">Background Color</label>

								<div class="col-sm-9">

									<div id="cp2" class="input-group colorpicker-component">
										<input type="text" name="body_bg_color" id="body_bg_color" value="<?php if (isset($body_bg_color)) echo $body_bg_color;?>" class="form-control" />
										<span class="input-group-addon"><i></i></span>
									</div>

								</div>

							</div> -->
							<div class="form-group">

								<label class="col-sm-3 control-label">Banner Image</label>

								<div class="col-sm-9">

									<div class="col-sm-9">

												<div class="media">

													<div class="media-left">

														<?php if (!empty($site_banner)){ ?><img src="<?php echo base_url().$site_banner?>" class="site-logo" /><?php } ?>

													</div>

													<div class="media-body">

														<div class="uploader"><input type="file" id="site_banner" multiple="true"  class="form-control" name="site_banner" placeholder="Select file"></div>

														<!-- <span class="help-block small">Recommended image size is <b>150px x 150px</b></span> -->

													</div>

												</div>

												<div id="img_upload_error" class="text-danger"  style="display:none"><b>Please upload valid image file.</b></div>

											</div>

								</div>

							</div>

						</div>


						<button name="form_submit" type="submit" class="btn btn-primary center-block" value="true">Save Changes</button>

					</form>

				</div>
			</div>

		</div>
	</div>
</div>
</div>
