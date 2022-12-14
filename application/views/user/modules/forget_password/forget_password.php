 <section class="search-area">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="search-box">
								<form onsubmit="return form_submit();" action="<?php echo base_url()."search"; ?>" method="post">
                                     <input type="hidden" name="selected_category" id="selected_category" value="">
                                    <span class="search-input"><input class="text" name="common_search" id="common_search" type="text" 
                                    value="<?php if(!empty($searched_value)){ echo $searched_value; } ?>"
                                     placeholder="Search"/></span>
									<span class="search-category">
										<select class="selected_category" id="changecatetext" name="search_category">
                                            <option value=""><?php echo (!empty($user_language[$user_selected]['lg_all_categories']))?$user_language[$user_selected]['lg_all_categories']:$default_language['en']['lg_all_categories']; ?></option>
                                            <?php                                                                                     
                                            foreach($categories_subcategories as $cat)
                                            {?>
                                            <option value="<?php echo $cat['CATID']; ?>"> <?php echo $cat['name']; ?> </option>    
                                            <?php }
                                            ?>
										</select>
									</span>
                                    <span class="search-btn">
										<button type="submit" name="search_submit" value="search" class="btn btn-primary" ><?php echo (!empty($user_language[$user_selected]['lg_search']))?$user_language[$user_selected]['lg_search']:$default_language['en']['lg_search']; ?></button>
									</span>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>


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
					
				</div>
			</section>
			<div class="tab-section">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="tab-list">
								<ul>
									<li class="active"><a href="javascript:;"><?php echo (!empty($user_language[$user_selected]['lg_change_password']))?$user_language[$user_selected]['lg_change_password']:$default_language['en']['lg_change_password']; ?></a></li>
									
								</ul>    
							</div>		
						</div>
					</div>
				</div>
			</div>
			<div class="tab-content">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
                          <form id="password_form" action="" method="POST">
                          <input type="hidden" name="user_name" value="<?php echo $username;?>" />
							<div class="row">
								<div class="col-md-9">
												<div class="form-group">
													<div class="row">
														<div class="col-md-6">
															<label><?php echo (!empty($user_language[$user_selected]['lg_new_password']))?$user_language[$user_selected]['lg_new_password']:$default_language['en']['lg_new_password']; ?></label>
                                                             <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter new password">
														</div>

														<div class="col-md-6">
															<label><?php echo (!empty($user_language[$user_selected]['lg_repeat_password']))?$user_language[$user_selected]['lg_repeat_password']:$default_language['en']['lg_repeat_password']; ?></label>
                                                            <input type="password" name="repeat_password" id="repeat_password" class="form-control" placeholder="Repeat new password">
														</div>
													</div>
												</div>
						                        <div class="text-right">
										<div class="row">
                                            <div class="col-lg-3"><button name="form_submit" class="btn btn-primary btn-block" value="true" type="submit"><?php echo (!empty($user_language[$user_selected]['lg_save']))?$user_language[$user_selected]['lg_save']:$default_language['en']['lg_save']; ?></button></div>
										</div>
									</div>
					                        
								</div>
							</div>
						</form>
						</div>
					</div>
				</div>
			</div>
		 