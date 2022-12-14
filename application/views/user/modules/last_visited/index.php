<?php  $this->load->view('user/includes/search_include'); ?>

<section class="profile-section">

				<div class="container">

					<div class="row">	

						<div class="col-md-12">

							<ol class="breadcrumb menu-breadcrumb">

								<li><a href="<?php echo base_url(); ?>"><?php echo (!empty($user_language[$user_selected]['lg_home']))?$user_language[$user_selected]['lg_home']:$default_language['en']['lg_home']; ?></a> <i class="fa fa fa-chevron-right"></i></li>

								<li class="active"><?php echo (!empty($user_language[$user_selected]['lg_last_visited_gigs']))?$user_language[$user_selected]['lg_last_visited_gigs']:$default_language['en']['lg_last_visited_gigs']; ?></li>        

							</ol>

						</div>

					</div>

					<div class="row">	

						<div class="col-md-12">

							<h3 class="page-title"><?php echo (!empty($user_language[$user_selected]['lg_reminders']))?$user_language[$user_selected]['lg_reminders']:$default_language['en']['lg_reminders']; ?></h3>

						</div>

					</div>

				</div>

			</section>

			<div class="tab-section">

				<div class="container">

					<div class="row">

						<div class="col-md-12">

							<div class="tab-list reminders-tab">

								<ul>

									<li>

										<a href="<?php echo base_url().'reminder'; ?>">

											<span class="visible-xxs"><i class="fa fa-heart" aria-hidden="true"></i></span> 

											<span class="hidden-xxs"><?php echo (!empty($user_language[$user_selected]['lg_favorites']))?$user_language[$user_selected]['lg_favorites']:$default_language['en']['lg_favorites']; ?></span> 

										</a>

									</li>

									<li class="active">

										<a href="<?php echo base_url().'last-visited'; ?>">

											<span class="visible-xxs"><i class="fa fa-eye" aria-hidden="true"></i></span>

											<span class="hidden-xxs"><?php echo (!empty($user_language[$user_selected]['lg_last_visited_gigs']))?$user_language[$user_selected]['lg_last_visited_gigs']:$default_language['en']['lg_last_visited_gigs']; ?></span>

										</a>

									</li>

								</ul>  

							</div>		

						</div>

					</div>

				</div>

			</div>

			<div class="tab-content reminder-section">

				<div class="container">

				<div class="row">

                <?php 

				if(($this->session->userdata('SESSION_USER_ID')))

				{

					$user_id = $this->session->userdata('SESSION_USER_ID'); 

					$favorites_list=array();

					foreach ($user_favorites as $value){

						$favorites_list[]=$value['gig_id'];

					}

					//print_r($favorites_list);

				}?>

                            <div class="col-md-12">

                            <h3 class="inner-title"><?php echo (!empty($user_language[$user_selected]['lg_last_visited_gigs']))?$user_language[$user_selected]['lg_last_visited_gigs']:$default_language['en']['lg_last_visited_gigs']; ?></h3>

                             <?php  if(empty($list)) {   ?>

                             <p> <?php echo (!empty($user_language[$user_selected]['lg_sorry']))?$user_language[$user_selected]['lg_sorry']:$default_language['en']['lg_sorry']; ?> ! <?php echo (!empty($user_language[$user_selected]['lg_no_gigs_found']))?$user_language[$user_selected]['lg_no_gigs_found']:$default_language['en']['lg_no_gigs_found']; ?>  </p>

                             <?php					 }   ?>

                            </div>                          

                                    

                                     <?php 

                                     if(!empty($list))

                                     {

							        $user_id = $this->session->userdata('SESSION_USER_ID');

									$query = $this->db->query(" SELECT `gig_id` FROM `last_visited` WHERE `user_id` = $user_id ORDER BY  `last_visited`.`created_date` DESC");	

									$result = $query->result_array();			 

									

									foreach($result as $order_type)

										{											 

                                     foreach($list as $gigs ) 

                                    { 

									// echo $country_name .  $gigs['currency_type'] . $dollar_rate . $gig_price . $rupee_rate;

										if($order_type['gig_id']==$gigs['id'])	

										{
										$currency_option = (!empty($gigs['currency_type']))?$gigs['currency_type']:'USD';
										$rate_symbol = currency_sign($currency_option);
										                                       

										$rate = $gigs['gig_price'];



											//$rate = number_format((float)$rate, 2, '.', '');

											//$rate = $gig_price;

											 $extra_gig_price =  $extra_gig_price;

											 

											$username = $gigs['username'];

											$name = $gigs['username'];

										   

											$name = $gigs['username'];

											if(!empty($gigs['fullname']))

											{

												$name = $gigs['fullname'];

											}

				 							$image = "assets/images/2.jpg";

											if(!empty($gigs['gig_image'])) {

											$image = base_url().$gigs['gig_image']; }   

											

											  $user_img = base_url()."assets/images/avatar2.jpg";

											if(!empty($gigs['user_thumb_image']))

											{

											$user_img = base_url().$gigs['user_thumb_image'];    

											}

				 							$gig_rating=0;

											$gig_rating1=0;

											if(!empty($gigs['gig_rating']))

											{

											$gig_rating1 = round($gigs['gig_rating']);  

											$gig_rating  = $gig_rating1 *2;  

											}

											$gig_usercount=0;

											if(!empty($gigs['gig_usercount']))

											{

												$gig_usercount  = $gigs['gig_usercount'];  

											}     

                                        ?>

                                    <div class="col-md-3 col-sm-6 product-cols">                                        

										<div class="product">  

										<div class="product-img">

                                            <a href="<?php echo base_url().'gig-preview/'.$gigs['title']; ?>"><img width="240" height="250" alt="<?php echo $gigs['title']; ?>" src="<?php echo $image; ?>"></a>

											<?php if(($this->session->userdata('SESSION_USER_ID'))) {

													$user_id = $this->session->userdata('SESSION_USER_ID'); 

													if($gigs['user_id'] != $user_id) 

													{  

														if (in_array($gigs['id'], $favorites_list)) {?>

															<div id="favourite_area_list"><a href="javascript:;" class="favourite favourited" title="Remove Favourite" onclick="remove_favourites_list('<?php echo $gigs['id']; ?>','<?php echo $user_id; ?>', this)"><i class="fa fa-heart"></i></a></div>

													<?php } else {?>

															<div id="favourite_area_list"><a href="javascript:;" class="favourite" title="Add Favourite" onclick="add_favourites_list('<?php echo $gigs['id']; ?>','<?php echo $user_id; ?>', this)"><i class="fa fa-heart"></i></a></div>

												<?php }  } }?>

                                        </div>

										<div class="product-detail">

                                               <div class="product-name"><a href="<?php echo base_url().'gig-preview/'.$gigs['title']; ?>"><?php echo ucfirst(str_replace("-"," ",$gigs['title'])); ?></a></div>

											<div class="author">

												<span class="author-img">

													<a href="<?php echo base_url()."user-profile/".$username; ?>"><img src="<?php echo $user_img;?>" title="<?php echo $gigs['fullname']; ?>"></a>

													<a class="author-name" href="<?php echo base_url()."user-profile/".$username; ?>"><?php echo ucfirst($name); ?></a>

												</span>

												<div class="ratings">

													<span class="stars-block star-<?php echo $gig_rating;?>"></span><span class="ratings-count">(<?php echo $gig_usercount;?>)</span>

												</div>

											</div>											 

											<div class="price-box2">

												<div class="price-inner">

													<div class="rectangle">

														<h2><?php echo $rate_symbol.$rate; ?></h2>

													</div>

													<div class="triangle"></div>

												</div>

											</div>

											<div class="product-det">

                                                 <div class="user-country text-ellipsis"><?php echo ucfirst($gigs['state_name']);?><?php if($gigs['state_name']!=''){ echo ', ';}?><?php echo ucfirst($gigs['country']); ?></div>	 

												<div class="product-currency">												 

												</div>	

											</div>

										</div>

									</div>	

                                    </div>

                                    

                                     <?php } }

										}

										 }  ?>

                                

                                </div>

                                    

                                    

                                    <div class="row">                                            

                                           

						<div class="col-md-12">

							<div class="bottom-pagination">

								<ul class="pagination pagination-sm">

									 <?php echo $links; ?>

								</ul>

							</div>	

						</div>	

					</div>

                                    

                                    

				</div>

			</div>

            