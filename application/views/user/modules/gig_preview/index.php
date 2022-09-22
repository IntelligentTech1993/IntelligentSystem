    <div class="">

        <?php //$this->load->view('user/includes/search_include'); 

$select_gig =  $gig_id; ?>
<section class="product-header">
<div class="container">
    <?php 
$i = 0;
if($this->session->flashdata('message')) { ?>
<div class="alert alert-success text-center fade in alert-dismissable" id="flash_succ_message"><?php echo $this->session->flashdata('message');?></div>
<?php
 $i = 1;

} ?>

    <?php if($this->session->userdata('message') && $i ==0) { ?>

        <div class="alert alert-success text-center fade in alert-dismissable" id="flash_succ_message"><?php echo $this->session->userdata('message');?></div>

    <?php   $this->session->unset_userdata('message'); } ?>
<?php 
    $item_gig_price = 0 ;
        if(!empty($gig_details['gig_price'])) {
            $item_gig_price =   $gig_details['gig_price'];
        }
?>
 <script type="text/javascript">
    var gigs_amount = <?php echo (!empty($gig_details['gig_price']))?$gig_details['gig_price']:0; ?>; 
   var gigs_super_fast_amount = <?php echo (!empty($gig_details['super_fast_charges']))?$gig_details['super_fast_charges']:0; ?>; </script>
<?php 
if($gig_details['parent']==0){ 
    
    $main_category =  ' <a href="javascript:;" onclick = "category_search(\''.str_replace(' ','-',$gig_details['name']).'\')" >'.$gig_details['name'].'</a>';

    $breadcumbs = '<a href="javascript:;" onclick = "category_search(\''.str_replace(' ','-',$gig_details['name']).'\')" >'.$gig_details['name'].'</a> <i class=" fa fa fa-chevron-right"></i>';	
		$similar_gigs = 	str_replace(' ','-',$gig_details['name']);							

 } else { 
        
        $query = $this->db->query("SELECT CATID , `name` FROM categories WHERE `CATID` = (SELECT `parent` FROM `categories` WHERE `CATID` = ".$gig_details['category_id'].")");     
    	$result = $query->row_array();
		$main_category =  '<a href="javascript:;" onclick = "category_search(\''.str_replace(' ','-',$result['name']).'\')" >'.$result['name'].'</a> <span>></span> <a href="javascript:;"  onclick = "category_search(\''.str_replace(' ','-',$gig_details['name']).'\')" >'.$gig_details['name'].'</a>';

            $breadcumbs = '<a href="javascript:;"  onclick = "category_search(\''.str_replace(' ','-',$result['name']).'\')" >'.$result['name'].'</a> <i class="fa fa fa-chevron-right"></i>
                <a href="javascript:;" onclick = "category_search(\''.str_replace(' ','-',$gig_details['name']).'\')" >'.$gig_details['name'].'</a>';  
        $similar_gigs = 	str_replace(' ','-',$gig_details['name']);	
    }  

?>

<div class="row">
<div class="col-md-12">
<div class="breadcrumbs">
<a href="<?php echo base_url();?>"><?php echo (!empty($user_language[$user_selected]['lg_home']))?$user_language[$user_selected]['lg_home']:$default_language['en']['lg_home']; ?></a> <i class="fa fa fa-chevron-right"></i> 
<?php echo $breadcumbs; ?>
</div>
       <?php   
       $rate = $gig_details['gig_price'];
       $currency_option = (!empty($gig_details['currency_type']))?$gig_details['currency_type']:'USD';
       $rate_symbol = currency_sign($currency_option);
       $rate = $gig_details['gig_price'];
        $extra_gig_price = $extra_gig_price;
?>
        <h2><?php echo ucfirst(str_replace("-"," ",$gig_details['title'])); ?></h2>
        <?php 
                                     $time_zone = '';
									$time_zone = ($time_zone)?$time_zone:'Asia/kolkata';	
  								$time = date($gig_details['created_date']);

                                 date_default_timezone_set($time_zone);

                                 $date1= date('Y-m-d H:i:s') ;

                                    $now = new DateTime($date1);

                                    $ref = new DateTime($time);

                                    $diff = $now->diff($ref);

                                    $total_seconds = 0 ;       

                                    $days = $diff->days;

                                    $hours = $diff->h;

                                    $mins = $diff->i;                                                            

                                    if(!empty($days)&&($days>0)) 

                                    {

                                     $days_to_seconds = $diff->days*24*60*60;

                                     $total_seconds = $total_seconds+$days_to_seconds;                                                   

                                    }

                                    if(!empty($hours)&&($hours>0)) 

                                    {

                                     $hours_to_seconds = $diff->h*60*60;

                                     $total_seconds = $total_seconds+$hours_to_seconds;

                                    }

                                    if(!empty($mins)&&($mins>0)) 

                                    {

                                     $min_to_seconds = $mins*60;

                                     $total_seconds = $total_seconds+$min_to_seconds;

                                    }

                                    $intervals      = array (

        'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute'=> 60

    );

   $time_taken = '';

     $just_now = (!empty($this->user_language[$this->user_selected]['lg_just_now']))?$this->user_language[$this->user_selected]['lg_just_now']:$this->default_language['en']['lg_just_now'];

    if ($total_seconds < 60 || $total_seconds==0 )
    {
            $time_taken = $just_now;
        //$time_taken = $total_seconds == 1 ? $total_seconds . ' second ago' : $total_seconds . ' seconds ago';
    }       

    $minutes_ago = (!empty($this->user_language[$this->user_selected]['lg_minutes_ago']))?$this->user_language[$this->user_selected]['lg_minutes_ago']:$this->default_language['en']['lg_minutes_ago'];

    if ($total_seconds >= 60 && $total_seconds < $intervals['hour'])
    {
        $total_seconds = floor($total_seconds/$intervals['minute']);
         $time_taken =  $total_seconds == 1 ? $total_seconds .' '. $minutes_ago : $total_seconds .' '. $minutes_ago;
    }       

    $hours_ago = (!empty($this->user_language[$this->user_selected]['lg_hours_ago']))?$this->user_language[$this->user_selected]['lg_hours_ago']:$this->default_language['en']['lg_hours_ago'];

    if ($total_seconds >= $intervals['hour'] && $total_seconds < $intervals['day'])
    {
        $total_seconds = floor($total_seconds/$intervals['hour']);
         $time_taken =  $total_seconds == 1 ? $total_seconds .' '. $hours_ago : $total_seconds .' '. $hours_ago;
    }   

    $day_ago = (!empty($this->user_language[$this->user_selected]['lg_day_ago']))?$this->user_language[$this->user_selected]['lg_day_ago']:$this->default_language['en']['lg_day_ago'];

    if ($total_seconds >= $intervals['day'] && $total_seconds < $intervals['week'])
    {
        $total_seconds = floor($total_seconds/$intervals['day']);
         $time_taken =  $total_seconds == 1 ? $total_seconds .' '. $day_ago : $total_seconds .' '. $day_ago;
    }   

    $week_ago = (!empty($this->user_language[$this->user_selected]['lg_week_ago']))?$this->user_language[$this->user_selected]['lg_week_ago']:$this->default_language['en']['lg_week_ago'];

    if ($total_seconds >= $intervals['week'] && $total_seconds < $intervals['month'])
    {
        $total_seconds = floor($total_seconds/$intervals['week']);
         $time_taken =  $total_seconds == 1 ? $total_seconds .' '. $week_ago : $total_seconds .' '. $week_ago;
    }   

    $months_ago = (!empty($this->user_language[$this->user_selected]['lg_months_ago']))?$this->user_language[$this->user_selected]['lg_months_ago']:$this->default_language['en']['lg_months_ago'];

    if ($total_seconds >= $intervals['month'] && $total_seconds < $intervals['year'])
    {
        $total_seconds = floor($total_seconds/$intervals['month']);
         $time_taken =  $total_seconds == 1 ? $total_seconds .' '. $months_ago : $total_seconds .' '. $months_ago;
    }   

    $years_ago = (!empty($this->user_language[$this->user_selected]['lg_years_ago']))?$this->user_language[$this->user_selected]['lg_years_ago']:$this->default_language['en']['lg_years_ago'];

    if ($total_seconds >= $intervals['year'])
    {
        $total_seconds = floor($total_seconds/$intervals['year']);
         $time_taken =  $total_seconds == 1 ? $total_seconds .' '. $years_ago : $total_seconds .' '. $years_ago;
    } 

    ?>

                                <p class="gig-detail"><?php echo (!empty($user_language[$user_selected]['lg_created']))?$user_language[$user_selected]['lg_created']:$default_language['en']['lg_created']; ?> <?php echo $time_taken; ?></p>

								<input type="hidden" name="rate_symbol" id="rate_symbol" value="<?php echo $rate_symbol; ?>">

							</div>

						</div>

					</div>	

			</section>

			<div class="gig-info">

				<div class="info-top">

					<div class="container">	

						<div class="row">

							<div class="col-md-12">

								<div class="gig-info-list">

									<?php $days = $gig_details['delivering_time'];

                                    $days = (!empty($user_language[$user_selected]['lg_days']))?$user_language[$user_selected]['lg_days']:$default_language['en']['lg_days'];

                                   $day = (!empty($user_language[$user_selected]['lg_day']))?$user_language[$user_selected]['lg_day']:$default_language['en']['lg_day'];

                                    if($days>1) { $display_days = $gig_details['delivering_time'].' '.$days; } else { $display_days = $gig_details['delivering_time'].' '.$day;  }

                                    ?>

                                    <span class="gig-deliver"><?php echo (!empty($user_language[$user_selected]['lg_will_deliver_in']))?$user_language[$user_selected]['lg_will_deliver_in']:$default_language['en']['lg_will_deliver_in']; ?> <?php echo $display_days; ?><span class="gig-count">  </span></span>

									<div class="gig-share">

                                    <?php 

									 if(!empty($gig_details['gig_details']))

									 {

										 $des=strip_tags($gig_details['gig_details']);

									 }else

									 {

										 $des='';

									 }

									$image_path_one = explode("#",$gig_details['image_path']); 

										$facebook  ='<a href="http://www.facebook.com/share.php?u='.base_url().'gig-preview/'.$gig_details['title'].'&title='.$gig_details['title'].'&picture='.base_url().$image_path_one[0].'&description='.$des.'" target="_blank"></a>';

										$twitter  ='<a href="http://twitter.com/share?text='.$gig_details['title'].'&url='.base_url().'gig-preview/'.$gig_details['title'].'&image-url='.base_url().$image_path_one[0].'" target="_blank"> </a>';

										$linkedin ='<a href="http://www.linkedin.com/shareArticle?mini=true&url='.base_url().'gig-preview/'.$gig_details['title'].'&title='.$gig_details['title'].'&summary='.$des.'" target="_blank"> </a>	';

										$pinterest ='<a href="http://pinterest.com/pin/create/button/?url='.base_url().'gig-preview/'.$gig_details['title'].'&description='.$gig_details['title'].'" target="_blank"> </a>	';

										$google ='<a href="https://plus.google.com/share?url='.base_url().'gig-preview/'.$gig_details['title'].'&title='.$gig_details['title'].'" target="_blank"> </a>	';

									?>

										<ul>	

											<li class="facebook-share"><?php echo $facebook ;?></li>								

											<li class="twitter-share"><?php echo $twitter ;?></li>

											<li class="pinterest-share"><?php echo $pinterest;?></li>

											<li class="google-share"><?php echo $google;?></li>											 

											<li class="linkedin-share"><?php echo $linkedin;?></li>

										</ul>

									</div>

									<span class="gig-save-btn">

                                <?php 

                                if(($this->session->userdata('SESSION_USER_ID')))

                                {

                                $already_marked = '';

                                $user_id = $this->session->userdata('SESSION_USER_ID'); 



                                foreach ($user_favorites as $value) 

                                {                                                                            

                                if(($gig_id==$value['gig_id'])&&($user_id==$value['user_id']))

                                {                                                                             

                                $already_marked = TRUE;

                                break;

                                }

                                else

                                {                                                                                

                                $already_marked = FALSE;

                                }

                                } 

                                if($gig_user_id==$this->session->userdata('SESSION_USER_ID')) 

                                {

                                //  echo  " Your Gig "     ;

                                } else {

                                if($already_marked==TRUE) { ?>

                                <a href="javascript:;"  onclick="remove_favourites('<?php echo $gig_id; ?>','<?php echo $user_id; ?>')" > Saved </a>

                                <?php } else { ?>           

                                <a href="javascript:;" onclick="add_favourites('<?php echo $gig_id; ?>','<?php echo $user_id; ?>')" ><?php echo (!empty($user_language[$user_selected]['lg_save']))?$user_language[$user_selected]['lg_save']:$default_language['en']['lg_save']; ?></a>

                                <?php } } } else { ?>                                                                                

                                <a href="javascript:;" onclick="selected_menu('sell_service')" ><?php echo (!empty($user_language[$user_selected]['lg_save']))?$user_language[$user_selected]['lg_save']:$default_language['en']['lg_save']; ?></a>

                                <?php } ?>

										

									</span>	

								</div>		

							</div>

						</div>	

					</div>

				</div>

		 

			</div>

			<section class="view-gig-area">	
            <div class="container">		

					<div class="row">

						<div class="col-sm-8">

							<div class="view-left">

								<div class="owl-carousel img-carousel">

                        <?php                                                                     

                        $image_path = explode("#",$gig_details['image_path']); 

                        $video_path1 = explode("#",$gig_details['video_path']);

						$video_path   = array_filter($video_path1);

                        foreach($image_path as $img_path) {

                        ?>

                                    <div class="item">

                                        <a href="javascript:;" data-gal="prettyPhoto"><img class="img-responsive" src="<?php echo base_url().$img_path; ?>" alt="" width="680" height="460" /></a>

									</div>

                                    <?php } 

                                    $video_array = array();

                                    if(!empty($video_path)){

                                    foreach($video_path as $vid_path) {

                                     if(!in_array($vid_path,$video_array))

                                     {   

                                        array_push($video_array, $vid_path);

                                    ?>

                                    <div class="item">

                                    <video width="640" height="640" controls>

                                    <source src="<?php echo base_url().$vid_path; ?>" type="video/mp4">

                                    <source src="<?php echo base_url().str_replace(".mp4",".ogg",$vid_path); ?>" type="video/ogg">

                                   <?php echo (!empty($user_language[$user_selected]['lg_your_browser_does_not_support_the_video_tag']))?$user_language[$user_selected]['lg_your_browser_does_not_support_the_video_tag']:$default_language['en']['lg_your_browser_does_not_support_the_video_tag']; ?>.  

                                    </video>

									</div>

									<?php } } }

                                    if(!empty($gig_details['youtube_url']))

                                    { 

							           $link = $gig_details['youtube_url'];

               						   $result = preg_match_all('~https?://(?:[0-9A-Z-]+\.)?(?:youtu\.be/|youtube(?:-nocookie)?\.com\S*[^\w\s-])([\w-]{11})(?=[^\w-]|$)(?![?=&+%\w.-]*(?:[\'"][^<>]*>|</a>))[?=&+%\w.-]*~ix', $link, $matchs);               

     								    if($result>0)

										   {              

											   foreach($matchs as $key => $vals)

												{   				    

												   if (filter_var($vals[0], FILTER_VALIDATE_URL) === false) 

												   {

													   $url = $vals[0] ;

													   break;

												   }                      

											    }

										   }

									?>

                                 		<div class="item">																	

<?php	

		$width = '715';

		$height = '385';

		echo '<iframe width="100%" height="'.$height.'" src="https://www.youtube.com/embed/'.$url.'" frameborder="0" allowfullscreen></iframe>'; 

?>										 

                                        </div>

                                     <?php } 

									  if(!empty($gig_details['vimeo_video_id']))

                                    { 		

									$vimeo_url = 	$gig_details['vimeo_video_id'];				          

									?>

                                 		<div class="item">																	

<?php	

		$width = '715';

		$height = '385';

		echo 	"<iframe src=\"//player.vimeo.com/video/$vimeo_url?portrait=0&color=333\" width=\"715\" height=\"385\" frameborder=\"0\" ></iframe>";

?>										 

                                        </div>

                                     <?php } ?>  

                                </div>

								<div class="gig-information">

					 <h3 class="gig-desc-title"><?php echo (!empty($user_language[$user_selected]['lg_description']))?$user_language[$user_selected]['lg_description']:$default_language['en']['lg_description']; ?></h3>	

								<?php echo ucfirst($gig_details['gig_details']);

								if(!empty($gig_details['requirements']))

								{ ?>

                     <h3 class="gig-desc-title"><?php echo (!empty($user_language[$user_selected]['lg_requirements_from_user']))?$user_language[$user_selected]['lg_requirements_from_user']:$default_language['en']['lg_requirements_from_user']; ?></h3>

								<?php	echo $gig_details['requirements'] ; 

								}

								 ?>

                                                                </div>

        <?php $query = $this->db->query("SELECT * FROM `extra_gigs` WHERE `gigs_id` = ".$gig_details['id']."");

                    $result = $query->result_array();

                    $count = 1;

                    $total = 0 ;

                    $loop_count = '';

	 if($this->session->userdata('SESSION_USER_ID')) {			 

		 if(($this->session->userdata('SESSION_USER_ID'))!=$user_profile['USERID'] )   {  

		 	if((!empty($result))||(strtolower($gig_details['super_fast_delivery'])=='yes')) {

				

		 ?>



            <div class="extras-section">

                        <div class="view-header clearfix">

                            <h3 class="gig-view-title"><?php echo (!empty($user_language[$user_selected]['lg_some_extras']))?$user_language[$user_selected]['lg_some_extras']:$default_language['en']['lg_some_extras']; ?></h3>					 

                        </div>

					<ul class="extras-list extra_gig_list">

						<?php   

                        if(!empty($result)) {                                                                                

                        foreach($result as $extra_gigs) {



                            // $extra_gig_price = $extra_gig_price; // Fixed Price 

                             $extra_gig_price = $extra_gigs['extra_gigs_amount']; // Dynamic Price 



                        ?>

                            <li>

                                <div class="delivery-block clearfix">

                                        <div class=" checkbox-primary checkbox-inline pull-left">

                                            <input type="checkbox" class="check_box" id="<?php echo $count; ?>" value="" >

                                                <label for="check1">&nbsp; </label>

                                        </div>

                                        <span class="extras-cont"><?php echo ucfirst($extra_gigs['extra_gigs']); ?></span>

                                        <input type="hidden" id="extra_gig_desc_<?php echo $count; ?>" value="<?php echo $extra_gigs['extra_gigs']; ?>"  />

                                        <input type="hidden" id="extra_gig_input_<?php echo $count; ?>"  value="" class="form-control">

    <input type="hidden" name="extra_gigs_amount" id="extra_gigs_amount_<?php echo $count; ?>" class="form-control price_list" value="<?php echo $extra_gig_price; ?>"   >

                                 <span class="extra-input pull-right">  <?php echo (!empty($user_language[$user_selected]['lg_for']))?$user_language[$user_selected]['lg_for']:$default_language['en']['lg_for']; ?>  <span class="currency_symbol"><?php echo $rate_symbol.$extra_gig_price ; ?></span>

                                        <input type="hidden" id="default_value_<?php echo $count; ?>" value="<?php echo $extra_gig_price; ?>">

                                        <input type="hidden" id="default_extra_gigs_delivery_<?php echo $count; ?>" value="<?php echo $extra_gigs['extra_gigs_delivery']; ?>"> 

                                        <?php echo (!empty($user_language[$user_selected]['lg_in']))?$user_language[$user_selected]['lg_in']:$default_language['en']['lg_in']; ?> <span class="delivery_days">	<?php echo "" . $extra_gigs['extra_gigs_delivery'] ;

                                        if($extra_gigs['extra_gigs_delivery']==1)            

                                        { 

                                        echo " day"; 

                                        } 

                                        else 

                                        { 

                                        echo " days"; 

                                        }	?> 

                                        </span>

                                        </span>			

                                </div>

                            </li> 

            <?php 

            $count = $count+1;

            $total = $total+$extra_gig_price;

            $loop_count = $count;

            } } if(strtolower($gig_details['super_fast_delivery'])=='yes') {  

                        

                        $extra_gig_price = $gig_details['super_fast_charges'];



                ?>



                        <li>

                                   <div class="delivery-block clearfix">

                                         <div class="checkbox-primary checkbox-inline pull-left">

                                               <input class="check_box" type="checkbox" id="super_fast_delivery"  value="" >

                                                     <label for="check5">&nbsp; </label>

                                         </div>                                         

                                    <span class="super-fast"><?php echo (!empty($user_language[$user_selected]['lg_super_fast']))?$user_language[$user_selected]['lg_super_fast']:$default_language['en']['lg_super_fast']; ?></span> <span id="super_fast_delivery_desc" class="extras-cont">

                                            <?php if($gig_details['super_fast_delivery_desc']) 

                                                    {

                                                        echo $gig_details['super_fast_delivery_desc']; 

														

                                                    } ?>

                                    </span>

                             <input type="hidden" name="super_fast_charges" id="super_fast_delivery_charges" class="form-control price_list" 	value="<?php echo $extra_gig_price; ?>" disabled>

                             <span class="extra-input pull-right">  <?php echo (!empty($user_language[$user_selected]['lg_for']))?$user_language[$user_selected]['lg_for']:$default_language['en']['lg_for']; ?>  <span class="currency_symbol"><?php echo $rate_symbol.$extra_gig_price ; ?></span>

                             <input type="hidden" name="super_fast_delivery_date" id="super_fast_delivery_date" 

                             value="<?php if($gig_details['super_fast_delivery_date']) {  echo $gig_details['super_fast_delivery_date']; } ?> "  />

                        

                                                 

                                                 <?php echo (!empty($user_language[$user_selected]['lg_in']))?$user_language[$user_selected]['lg_in']:$default_language['en']['lg_in']; ?> <span class="delivery_days"> 

                                                 <?php if($gig_details['super_fast_delivery_date']==1){ echo $gig_details['super_fast_delivery_date'] . " day"; } else { 

                                                 echo	$gig_details['super_fast_delivery_date'] . " days"; } ?> 

                                                    </span>

                                                                   <input type="hidden" id="default_value_<?php echo $loop_count; ?>" value="<?php echo $extra_gig_price; ?>">

                                                                         <input type="hidden" id="loop_count" value="<?php echo $loop_count; ?>">

                                                                               <span class="gig-amount pull-right"> 												 

                                                                               </span>		

                                                                               </span>		

                                    </div>

                        </li>

                                                                                <?php

                                                                                $total = $total+$gig_details['super_fast_charges'];

                                                                                } ?>

                                                                                

                                 		<li>

                                            <div class="delivery-block clearfix">                                                                                        

                                                    <span class="extras-cont"><?php echo (!empty($user_language[$user_selected]['lg_extras_total']))?$user_language[$user_selected]['lg_extras_total']:$default_language['en']['lg_extras_total']; ?></span>

                                                    <span class="extra-input pull-right">                                                                                        

                                                        <input type="text" name="total" id="total" class="form-control" value=" " disabled> 

														<span class = "extra_gig_currency"> <?php echo $rate_symbol; ?> </span>

                                                    <input type="hidden" id="default_total_value" value="<?php echo $total; ?>">

                                                    </span>			

                                            </div>

 	                                    </li>                                     

            	    </ul>

                                                                  </div>  <?php  

																  

			} }else { if((!empty($result))||(strtolower($gig_details['super_fast_delivery'])=='yes')) { ?>

              <div class="extras-section">

                <div class="view-header clearfix">

                    <h3 class="gig-view-title"><?php echo (!empty($user_language[$user_selected]['lg_some_extras']))?$user_language[$user_selected]['lg_some_extras']:$default_language['en']['lg_some_extras']; ?></h3>					 

                </div>

                <ul class="extras-list extra_gig_list">

                            <?php 

                             if(!empty($result)) {                                                                               

                            foreach($result as $extra_gigs) {

                                $extra_gig_price = $extra_gigs['extra_gigs_amount'];

                            ?>

                <li>

                    <div class="delivery-block clearfix">

                            <div class=" checkbox-primary checkbox-inline pull-left">

                             

                            </div>

                            <span class="extras-cont"><?php echo ucfirst($extra_gigs['extra_gigs']); ?></span>

                            <input type="hidden" id="extra_gig_desc_<?php echo $count; ?>" value="<?php echo $extra_gigs['extra_gigs']; ?>"  />

                            <input type="hidden" id="extra_gig_input_<?php echo $count; ?>"  value="" class="form-control">

                            <input type="hidden" name="extra_gigs_amount" id="extra_gigs_amount_<?php echo $count; ?>" class="form-control price_list" value="<?php echo $extra_gig_price; ?>"   >

                            <span class="extra-input pull-right">  <?php echo (!empty($user_language[$user_selected]['lg_for']))?$user_language[$user_selected]['lg_for']:$default_language['en']['lg_for']; ?>  <span class="currency_symbol"><?php echo $rate_symbol.$extra_gig_price ; ?></span>

                            <input type="hidden" id="default_value_<?php echo $count; ?>" value="<?php echo $extra_gig_price; ?>">

                            <input type="hidden" id="default_extra_gigs_delivery_<?php echo $count; ?>" value="<?php echo $extra_gigs['extra_gigs_delivery']; ?>">

                            <?php echo (!empty($user_language[$user_selected]['lg_in']))?$user_language[$user_selected]['lg_in']:$default_language['en']['lg_in']; ?> <span class="delivery_days">	<?php echo "" . $extra_gigs['extra_gigs_delivery'] ;

                            if($extra_gigs['extra_gigs_delivery']==1)            

                            { 

                            echo " day"; 

                            } 

                            else 

                            { 

                            echo " days"; 

                            }	?> 

                            </span>

                            </span>			

                    </div>

                </li> 

                            <?php 

                            $count = $count+1;

                            $total = $total+$extra_gig_price;

                            $loop_count = $count;

                            }

              }

              

              if(strtolower($gig_details['super_fast_delivery'])=='yes') {  ?>

                <li>

                    <div class="delivery-block clearfix">

                      <div class="checkbox-primary checkbox-inline pull-left">

                    </div>

                                       <span class="super-fast"><?php echo (!empty($user_language[$user_selected]['lg_super_fast']))?$user_language[$user_selected]['lg_super_fast']:$default_language['en']['lg_super_fast']; ?></span> <span id="super_fast_delivery_desc" class="extras-cont"><?php if($gig_details['super_fast_delivery_desc']) {

                                           echo $gig_details['super_fast_delivery_desc']; 

                                           } ?></span>

                                              

                                                <span class="extra-input pull-right">   <?php echo (!empty($user_language[$user_selected]['lg_for']))?$user_language[$user_selected]['lg_for']:$default_language['en']['lg_for']; ?>  <span class="currency_symbol"><?php echo $rate_symbol.$gig_details['super_fast_charges']; ?></span>

                                        <input type="hidden" name="super_fast_delivery_date" id="super_fast_delivery_date" value="<?php if($gig_details['super_fast_delivery_date']) {  echo $gig_details['super_fast_delivery_date']; } ?> "  />

                

                                         <?php echo (!empty($user_language[$user_selected]['lg_in']))?$user_language[$user_selected]['lg_in']:$default_language['en']['lg_in']; ?> <span class="super-fast-delivery super-del">       

                                         <?php if($gig_details['super_fast_delivery_date']==1){ echo "" . $gig_details['super_fast_delivery_date'] . " day"; } else { 

                                         echo	"" . $gig_details['super_fast_delivery_date'] . " days"; } ?> 

                                            </span>

                                                           <input type="hidden" id="default_value_<?php echo $loop_count; ?>" value="<?php echo $extra_gig_price; ?>">

                                                                 <input type="hidden" id="loop_count" value="<?php echo $loop_count; ?>">

                                                                       <span class="gig-amount pull-right"> 												 

                                                                       </span>	

                                              </span>	

                            </div>

                </li>

                    <?php

                    $total = $total+$gig_details['super_fast_charges'];

                    } ?>                                                                               

                                                                                                

                                                                                                

                 </ul>

              </div>

																  <?php } } } 

																  

																  

																  

																  

																  	else {   if((!empty($result))||(strtolower($gig_details['super_fast_delivery'])=='yes')) {   ?>

								<div class="extras-section">

									<div class="view-header clearfix">

										<h3 class="gig-view-title"><?php echo (!empty($user_language[$user_selected]['lg_some_extras']))?$user_language[$user_selected]['lg_some_extras']:$default_language['en']['lg_some_extras']; ?></h3>					 

									</div>

									<ul class="extras-list extra_gig_list">

			<?php  			

			 if(!empty($result)) {                                                                               

            foreach($result as $extra_gigs) {
                 $extra_gig_price = $extra_gigs['extra_gigs_amount'];

            ?>

<li>

    <div class="delivery-block clearfix">

            <div class=" checkbox-primary checkbox-inline pull-left">

             

            </div>

            <span class="extras-cont"><?php echo ucfirst($extra_gigs['extra_gigs']); ?></span>

            <input type="hidden" id="extra_gig_desc_<?php echo $count; ?>" value="<?php echo $extra_gigs['extra_gigs']; ?>"  />

            <input type="hidden" id="extra_gig_input_<?php echo $count; ?>"  value="" class="form-control">

            <input type="hidden" name="extra_gigs_amount" id="extra_gigs_amount_<?php echo $count; ?>" class="form-control price_list" value="<?php echo $extra_gig_price; ?>"   >

            <span class="extra-input pull-right">  <?php echo (!empty($user_language[$user_selected]['lg_for']))?$user_language[$user_selected]['lg_for']:$default_language['en']['lg_for']; ?>  <span class="currency_symbol"><?php echo $rate_symbol.$extra_gig_price ; ?></span>

            <input type="hidden" id="default_value_<?php echo $count; ?>" value="<?php echo $extra_gig_price; ?>">

            <input type="hidden" id="default_extra_gigs_delivery_<?php echo $count; ?>" value="<?php echo $extra_gigs['extra_gigs_delivery']; ?>">

			<?php echo (!empty($user_language[$user_selected]['lg_in']))?$user_language[$user_selected]['lg_in']:$default_language['en']['lg_in']; ?> <span class="delivery_days">	<?php echo "" . $extra_gigs['extra_gigs_delivery'] ;

			if($extra_gigs['extra_gigs_delivery']==1)            

			{ 

			echo " day"; 

			} 

			else 

			{ 

			echo " days"; 

			}	?> 

            </span>

            </span>			

    </div>

</li> 

            <?php 

            $count = $count+1;

            $total = $total+$extra_gig_price;

            $loop_count = $count;

            }

																  }

			if(strtolower($gig_details['super_fast_delivery'])=='yes') {                                                                                 

                ?>



<li>

           <div class="delivery-block clearfix">

				 <div class="checkbox-primary checkbox-inline pull-left">

                  

			     </div>

					   <span class="super-fast"><?php echo (!empty($user_language[$user_selected]['lg_super_fast']))?$user_language[$user_selected]['lg_super_fast']:$default_language['en']['lg_super_fast']; ?></span> <span id="super_fast_delivery_desc" class="extras-cont"><?php if($gig_details['super_fast_delivery_desc']) {

						   echo $gig_details['super_fast_delivery_desc']; 

						   } ?></span>

							  

                                <span class="extra-input pull-right">  <?php echo (!empty($user_language[$user_selected]['lg_for']))?$user_language[$user_selected]['lg_for']:$default_language['en']['lg_for']; ?>  <span class="currency_symbol"><?php echo $rate_symbol.$gig_details['super_fast_charges']; ?></span>

                        <input type="hidden" name="super_fast_delivery_date" id="super_fast_delivery_date" value="<?php if($gig_details['super_fast_delivery_date']) {  echo $gig_details['super_fast_delivery_date']; } ?> "  />



                         <?php echo (!empty($user_language[$user_selected]['lg_in']))?$user_language[$user_selected]['lg_in']:$default_language['en']['lg_in']; ?> <span class="super-fast-delivery super-del">       

						 <?php if($gig_details['super_fast_delivery_date']==1){ echo "" . $gig_details['super_fast_delivery_date'] . " day"; } else { 

						 echo	"" . $gig_details['super_fast_delivery_date'] . " days"; } ?> 

                         	</span>

                                           <input type="hidden" id="default_value_<?php echo $loop_count; ?>" value="<?php echo $extra_gig_price; ?>">

                                                 <input type="hidden" id="loop_count" value="<?php echo $loop_count; ?>">

                                                       <span class="gig-amount pull-right"> 												 

													   </span>

                                     </span>		

			</div>

</li>

                                                                                <?php

                                                                                $total = $total+$gig_details['super_fast_charges'];

                                                                                } ?>                                             

                                                                            </ul>

                                                                  </div>  <?php }  } ?>

                               <?php if(!empty($feedbacks)) { ?> 

								<div class="feedback-section">

									<div class="view-header clearfix">

										<h3 class="gig-view-title feedback-area"><?php echo (!empty($user_language[$user_selected]['lg_latest_feedbacks']))?$user_language[$user_selected]['lg_latest_feedbacks']:$default_language['en']['lg_latest_feedbacks']; ?>  <span class="starrr" data-rating="<?php echo $user_feedback;?>"> </span> (<?php echo count($feedbacks);?>)</h3>

									</div>

									<ul class="feedback-list">

                                                                            

													<?php foreach($feedbacks as $key=>$feedback) {                                        

                                                        

                                                        if($time_zone!=$feedback['time_zone'])

														{ 

															//                echo "Not same";

                                                        $date = new DateTime($feedback['created_date'], new DateTimeZone($feedback['time_zone']));

                                                        $date->setTimezone(new DateTimeZone($time_zone));                                                        

                                                        $time = $date->format('Y-m-d H:i:s');                                                        

                                                     //   echo "posted time :" .$time ;

                                                        

                                                         date_default_timezone_set($time_zone);

                                                         $date1= date('Y-m-d H:i:s') ;

                                                    //     echo " Current_time ".$date1;

                                                        

                                                         

                                                            $now = new DateTime($date1);

                                                            $ref = new DateTime($time);

                                                            $diff = $now->diff($ref);

                                                            }

                                                            else 

                                                            {                                                            
                                                            $gig_time_zone = !empty($gig_time_zone)?$gig_time_zone:'Asia/Kolkata';	
                                                            date_default_timezone_set($gig_time_zone);

                                                            $now = new DateTime(date('Y-m-d H:i:s'));                                                

                                                            //$now = new DateTime($feedback['created_date']);

                                                            $ref = new DateTime($feedback['created_date']);                                                              

                                                            $diff = $now->diff($ref);                                                                

                                                            }

                                                            $total_seconds = 0 ;       

                                                            $days = $diff->days;

                                                            $hours = $diff->h;

                                                            $mins = $diff->i;                                                            

                                                            if(!empty($days)&&($days>0)) 

                                                            {

                                                             $days_to_seconds = $diff->days*24*60*60;

                                                             $total_seconds = $total_seconds+$days_to_seconds;                                                   

                                                            }

                                                            if(!empty($hours)&&($hours>0)) 

                                                            {

                                                             $hours_to_seconds = $diff->h*60*60;

                                                             $total_seconds = $total_seconds+$hours_to_seconds;

                                                            }

                                                            if(!empty($mins)&&($mins>0)) 

                                                            {

                                                             $min_to_seconds = $mins*60;

                                                             $total_seconds = $total_seconds+$min_to_seconds;

                                                            }

                                                            $intervals      = array (

															'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute'=> 60

														);

														$time_difference = '';

                                                        //now we just find the difference

                                                        $just_now = (!empty($this->user_language[$this->user_selected]['lg_just_now']))?$this->user_language[$this->user_selected]['lg_just_now']:$this->default_language['en']['lg_just_now'];

                                                        if ($total_seconds == 0)

                                                        {

                                                            $time_difference = $just_now;

                                                        }   

                                                    $seconds_ago = (!empty($this->user_language[$this->user_selected]['lg_seconds_ago']))?$this->user_language[$this->user_selected]['lg_seconds_ago']:$this->default_language['en']['lg_seconds_ago'];

                                                        if ($total_seconds < 60)

                                                        {

                                                            $time_difference = $total_seconds == 1 ? $total_seconds .' '. $seconds_ago : $total_seconds .' '. $seconds_ago;

                                                        }       

                                                    $minutes_ago = (!empty($this->user_language[$this->user_selected]['lg_minutes_ago']))?$this->user_language[$this->user_selected]['lg_minutes_ago']:$this->default_language['en']['lg_minutes_ago'];

                                                        if ($total_seconds >= 60 && $total_seconds < $intervals['hour'])

                                                        {

                                                            $total_seconds = floor($total_seconds/$intervals['minute']);

                                                             $time_difference =  $total_seconds == 1 ? $total_seconds .' '. $minutes_ago : $total_seconds .' '. $minutes_ago;

                                                        }       

                                                    $hours_ago = (!empty($this->user_language[$this->user_selected]['lg_hours_ago']))?$this->user_language[$this->user_selected]['lg_hours_ago']:$this->default_language['en']['lg_hours_ago'];

                                                        if ($total_seconds >= $intervals['hour'] && $total_seconds < $intervals['day'])

                                                        {

                                                            $total_seconds = floor($total_seconds/$intervals['hour']);

                                                             $time_difference =  $total_seconds == 1 ? $total_seconds .' '. $hours_ago : $total_seconds .' '. $hours_ago;

                                                        }   

                                                    $days_ago = (!empty($this->user_language[$this->user_selected]['lg_days_ago']))?$this->user_language[$this->user_selected]['lg_days_ago']:$this->default_language['en']['lg_days_ago'];

                                                        if ($total_seconds >= $intervals['day'] && $total_seconds < $intervals['week'])

                                                        {

                                                            $total_seconds = floor($total_seconds/$intervals['day']);

                                                             $time_difference =  $total_seconds == 1 ? $total_seconds .' '. $days_ago : $total_seconds .' '. $days_ago;

                                                        }   

                                                    $weeks_ago = (!empty($this->user_language[$this->user_selected]['lg_weeks_ago']))?$this->user_language[$this->user_selected]['lg_weeks_ago']:$this->default_language['en']['lg_weeks_ago'];

                                                        if ($total_seconds >= $intervals['week'] && $total_seconds < $intervals['month'])

                                                        {

                                                            $total_seconds = floor($total_seconds/$intervals['week']);

                                                             $time_difference =  $total_seconds == 1 ? $total_seconds .' '. $weeks_ago : $total_seconds .' '. $weeks_ago;

                                                        }   

                                                    $months_ago = (!empty($this->user_language[$this->user_selected]['lg_months_ago']))?$this->user_language[$this->user_selected]['lg_months_ago']:$this->default_language['en']['lg_months_ago'];

                                                        if ($total_seconds >= $intervals['month'] && $total_seconds < $intervals['year'])

                                                        {

                                                            $total_seconds = floor($total_seconds/$intervals['month']);

                                                             $time_difference =  $total_seconds == 1 ? $total_seconds . ' '.$months_ago : $total_seconds . ' '.$months_ago;

                                                        }   

                                                    $years_ago = (!empty($this->user_language[$this->user_selected]['lg_years_ago']))?$this->user_language[$this->user_selected]['lg_years_ago']:$this->default_language['en']['lg_years_ago'];

                                                        if ($total_seconds >= $intervals['year'])

                                                        {

                                                            $total_seconds = floor($total_seconds/$intervals['year']);

                                                             $time_difference =  $total_seconds == 1 ? $total_seconds .' '. $years_ago : $total_seconds .' '. $years_ago;

                                                        }                                                                        

                                                                            

                                                        $rat_ing = $feedback['rating']; 

														$u_images=base_url().'assets/images/avatar2.jpg';

														if($feedback['user_thumb_image']!='')

														{

															$u_images=base_url().$feedback['user_thumb_image'];

														}

                                                    ?>    

                                    <li class="media">

                                        <?php // if($gig_user_id!=$feedback['from_user_id']) { ?>

                                            <a href="<?php echo base_url().'user-profile/'.$feedback['username'];?>" class="pull-left"><img width="26" height="26" alt="" src="<?php echo $u_images;?>"></a>

                                            <div class="media-body">

                                                    <div class="feedback-info">

                                                            <div class="feedback-author">

                                                                    <a href="<?php echo base_url().'user-profile/'.$feedback['username'];?>"><?php echo $feedback['fullname']; ?></a>

                                                            </div>

                                                            <span class="feedback-time"><?php echo $time_difference; ?></span>

                                                    </div>

                                                   <div class="feedback-area" ><p><?php echo $feedback['comment']; ?>  <span class="starrr" data-rating="<?php echo $rat_ing;?>"></span></p></div>

                                        <?php



                                            $query = $this->db->query("SELECT feedback.*,members.* FROM `feedback` 

                                                                        LEFT JOIN members ON members.USERID = feedback.`from_user_id`

                                                                        WHERE feedback.`from_user_id` = $gig_user_id AND feedback.`to_user_id` = ". $feedback['from_user_id'] ." AND feedback.`order_id` = ". $feedback['order_id'] ." AND feedback.`status` = 1" );

                                            $result = $query->row_array();

                                        // } else if($gig_user_id==$feedback['from_user_id']) {   

                                            if(!empty($result)) { 

											$u_imagesone=base_url().'assets/images/avatar2.jpg';

											if($result['user_thumb_image']!='')

											{

												$u_imagesone=base_url().$result['user_thumb_image'];

											}                                  

                                            if($time_zone!=$feedback['time_zone'])

                                                            {                                                                     

                                                        $date = new DateTime($feedback['created_date'], new DateTimeZone($feedback['time_zone']));

                                                        $date->setTimezone(new DateTimeZone($time_zone));                                                        

                                                        $time = $date->format('Y-m-d H:i:s');                                                         

                                                     //   echo "posted time :" .$time ;

                                                        

                                                         date_default_timezone_set($time_zone);

                                                         $date1= date('Y-m-d H:i:s') ;

                                                    //     echo " Current_time ".$date1;                                                        

                                                         

                                                            $now = new DateTime($date1);

                                                            $ref = new DateTime($time);

                                                            $diff = $now->diff($ref);

                                                            }

                                                            else 

                                                            {                                                            

                                                            date_default_timezone_set($gig_time_zone);

                                                            $now = new DateTime(date('Y-m-d H:i:s'));                                                

                                                            //$now = new DateTime($feedback['created_date']);

                                                            $ref = new DateTime($feedback['created_date']);                                                              

                                                            $diff = $now->diff($ref);                                                                

                                                            }

                                                            $total_seconds = 0 ;       

                                                            $days = $diff->days;

                                                            $hours = $diff->h;

                                                            $mins = $diff->i;                                                            

                                                            if(!empty($days)&&($days>0)) 

                                                            {

                                                             $days_to_seconds = $diff->days*24*60*60;

                                                             $total_seconds = $total_seconds+$days_to_seconds;                                                   

                                                            }

                                                            if(!empty($hours)&&($hours>0)) 

                                                            {

                                                             $hours_to_seconds = $diff->h*60*60;

                                                             $total_seconds = $total_seconds+$hours_to_seconds;

                                                            }

                                                            if(!empty($mins)&&($mins>0)) 

                                                            {

                                                             $min_to_seconds = $mins*60;

                                                             $total_seconds = $total_seconds+$min_to_seconds;

                                                            }

                                                            $intervals      = array (

																'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute'=> 60

															);

															$time_difference = '';

                                //now we just find the difference
                                $just_now = (!empty($this->user_language[$this->user_selected]['lg_just_now']))?$this->user_language[$this->user_selected]['lg_just_now']:$this->default_language['en']['lg_just_now'];

                                if ($total_seconds == 0)

                                {

                                    $time_difference = $just_now;

                                }   

                            $seconds_ago = (!empty($this->user_language[$this->user_selected]['lg_seconds_ago']))?$this->user_language[$this->user_selected]['lg_seconds_ago']:$this->default_language['en']['lg_seconds_ago'];

                                if ($total_seconds < 60)

                                {

                                    $time_difference = $total_seconds == 1 ? $total_seconds .' '.$seconds_ago : $total_seconds .' '.$seconds_ago;

                                }       

                            $minutes_ago = (!empty($this->user_language[$this->user_selected]['lg_minutes_ago']))?$this->user_language[$this->user_selected]['lg_minutes_ago']:$this->default_language['en']['lg_minutes_ago'];

                                if ($total_seconds >= 60 && $total_seconds < $intervals['hour'])

                                {

                                    $total_seconds = floor($total_seconds/$intervals['minute']);

                                     $time_difference =  $total_seconds == 1 ? $total_seconds .' '.$minutes_ago : $total_seconds .' '.$minutes_ago;

                                }       

                            $hours_ago = (!empty($this->user_language[$this->user_selected]['lg_hours_ago']))?$this->user_language[$this->user_selected]['lg_hours_ago']:$this->default_language['en']['lg_hours_ago'];

                                if ($total_seconds >= $intervals['hour'] && $total_seconds < $intervals['day'])

                                {

                                    $total_seconds = floor($total_seconds/$intervals['hour']);

                                     $time_difference =  $total_seconds == 1 ? $total_seconds .' '.$hours_ago : $total_seconds .' '.$hours_ago;

                                }   

                            $day_ago = (!empty($this->user_language[$this->user_selected]['lg_day_ago']))?$this->user_language[$this->user_selected]['lg_day_ago']:$this->default_language['en']['lg_day_ago'];

                                if ($total_seconds >= $intervals['day'] && $total_seconds < $intervals['week'])

                                {

                                    $total_seconds = floor($total_seconds/$intervals['day']);

                                     $time_difference =  $total_seconds == 1 ? $total_seconds .' '.$day_ago : $total_seconds .' '.$day_ago;

                                }   

                            $week_ago = (!empty($this->user_language[$this->user_selected]['lg_week_ago']))?$this->user_language[$this->user_selected]['lg_week_ago']:$this->default_language['en']['lg_week_ago'];

                                if ($total_seconds >= $intervals['week'] && $total_seconds < $intervals['month'])

                                {

                                    $total_seconds = floor($total_seconds/$intervals['week']);

                                     $time_difference =  $total_seconds == 1 ? $total_seconds .' '.$week_ago : $total_seconds .' '.$week_ago;

                                }   

                            $months_ago = (!empty($this->user_language[$this->user_selected]['lg_months_ago']))?$this->user_language[$this->user_selected]['lg_months_ago']:$this->default_language['en']['lg_months_ago'];

                                if ($total_seconds >= $intervals['month'] && $total_seconds < $intervals['year'])

                                {

                                    $total_seconds = floor($total_seconds/$intervals['month']);

                                     $time_difference =  $total_seconds == 1 ? $total_seconds .' '.$months_ago : $total_seconds .' '.$months_ago;

                                }   

                            $years_ago = (!empty($this->user_language[$this->user_selected]['lg_years_ago']))?$this->user_language[$this->user_selected]['lg_years_ago']:$this->default_language['en']['lg_years_ago'];

                                if ($total_seconds >= $intervals['year'])

                                {

                                    $total_seconds = floor($total_seconds/$intervals['year']);

                                     $time_difference =  $total_seconds == 1 ? $total_seconds .' '.$years_ago : $total_seconds .' '.$years_ago;

                                }
                                                                                            

                                                                                            

                                                           ?>            

												<div class="media">

													<a href="<?php echo base_url().'user-profile/'.$result['username'];?>" class="pull-left"><img width="26" height="26" alt="" src="<?php echo $u_imagesone;?>"></a>

														<div class="media-body">

															<div class="feedback-info">

																<div class="feedback-author">

																	<a href="<?php echo base_url().'user-profile/'.$result['username'];?>"><?php echo $result['fullname']; ?></a>

																</div>

																<span class="feedback-time"><?php echo $time_difference; ?></span>

															</div>

															<p><?php echo $result['comment']; ?></p>

														</div>

												</div>

											

										<?php  }?>

                                        </div>

										</li>

                                        <?php if($key ==1){

											 break;

										}

                                        } ?>

                                        

									</ul>

                                    <?php if(count($feedbacks)>2){?>

									<div class="more-feedback">

                                    <input type="hidden" id="load_more_feedid" name="load_more_feedid" value="2" />

                                    <input type="hidden" id="load_more_gigid" name="load_more_gigid" value="<?php echo $select_gig;?>" />

                                    <input type="hidden" id="load_more_gig_userid" name="load_more_gig_userid" value="<?php echo $gig_user_id;?>" />

										<a href="javascript:;" onclick="load_more_feedbacks();"><?php echo (!empty($user_language[$user_selected]['lg_more_feedbacks']))?$user_language[$user_selected]['lg_more_feedbacks']:$default_language['en']['lg_more_feedbacks']; ?></a>

									</div>

                                    <?php }?>

								</div>

                                <?php } ?>

						

							</div>

						</div>

						<div class="col-sm-4 rightsidebar">

							<div class="view-right">

								<div class="order-btn theiaStickySidebar" >

                                     <?php if(($this->session->userdata('SESSION_USER_ID')))   {  

									     if(($this->session->userdata('SESSION_USER_ID'))!=$user_profile['USERID'] )   { 

										  if($rate_symbol=="$") { // $rate = number_format((float)$rate, 2, '.', '');  

                                        }

                                        $my_gig_rate = $rate;

                                         ?> 

                                                                      

                                    <a href="#" class="btn" onclick="check_extra_gigs()" data-toggle="modal" data-target="#checkout-popup"><?php echo (!empty($user_language[$user_selected]['lg_buy_now']))?$user_language[$user_selected]['lg_buy_now']:$default_language['en']['lg_buy_now']; ?>  <?php echo $rate_symbol ;?><span id="over_all_total"><?php echo $rate; ?></span></a>

                                     <?php } else {  ?>

                                         

                                     <a href="<?php echo base_url()."edit-gig/".$gig_details['title']; ?>" class="btn" > <?php echo (!empty($user_language[$user_selected]['lg_edit_gig']))?$user_language[$user_selected]['lg_edit_gig']:$default_language['en']['lg_edit_gig']; ?> </a>    

                                   <?php   }  } else { $gig_title = $this->uri->segment(2); ?>

                                      <a href="javascript:;" class="btn" onclick="selected_menu('gig-preview/<?php echo $gig_title; ?>')" ><?php echo (!empty($user_language[$user_selected]['lg_buy_now']))?$user_language[$user_selected]['lg_buy_now']:$default_language['en']['lg_buy_now']; ?>  <?php echo $rate_symbol ;?><span id="over_all_total"><?php echo $rate; ?></span></a>

                                     <?php } ?>

									 								<div class="seller-info2">

									<span class="seller-arrow"></span>

									<ul class="gig-stats seller-stats">

										<li class="media seller-det">

												<?php

												      $i_d=$user_profile['USERID'];                                                                                                   

                                                   	  $username = $user_profile['username'];

													  $user_image = base_url().'assets/images/avatar-lg.jpg';

													  if(!empty($user_profile['user_profile_image'])) { $user_image = base_url().$user_profile['user_profile_image'];} 

                                                      if(!empty($user_profile['fullname'])) { $name = $user_profile['fullname'];}

                                                      

                                                      $result_count =  array(); 

                                                      if ($i_d !='') {

                                                        $query_res = $this->db->query("SELECT AVG(feedback.rating) FROM `feedback`

                                                                   left join sell_gigs on sell_gigs.id = feedback.`gig_id`

                                                                    WHERE sell_gigs.user_id = $i_d AND feedback.`to_user_id` = $i_d;");

                                                        $result_count = $query_res->row_array();

                                                      }

													  

														$rat_ing=0;

													   if(!empty($result_count)){

                                                    	if($result_count['AVG(feedback.rating)']!='')

														{

															$rat_ing=round($result_count['AVG(feedback.rating)']);

														}

                                                    }

                                                    $result_countid = array();

                                                        if($i_d!=''){

                                                         $query_resid = $this->db->query("SELECT id FROM `payments` WHERE `seller_id`=$i_d and (`seller_status`=1 OR  `seller_status`=2 OR  `seller_status`=3)");

                                                         $result_countid = $query_resid->result_array();   

                                                        }

														 

                                                ?>

											<a href="<?php echo base_url()."user-profile/".$username; ?>" class=""><img width="50" height="50" alt="" class="seller-img" src="<?php echo $user_image; ?>"></a>

											<div class="media-body">

												<span class="seller-name-section">

													<span class="seller-name">

														<a href="<?php echo base_url()."user-profile/".$username; ?>"><?php echo ucfirst($name); ?></a>

														<span class="seller-position text-ellipsis"><?php if(!empty($user_profile['profession_name'])){ echo $user_profile['profession_name']; } ?></span>

													</span>

												</span>

												<div class="seller-country"> <span class="ppcn country <?php echo $user_country_shortname; ?>"></span> <?php echo  $user_country_name; ?> </div>

												<div class="seller-feedback feedback-area"><span class="starrr" data-rating="<?php echo $rat_ing;?>" ></span></div>

											</div>

										</li>

										<?php if(($this->session->userdata('SESSION_USER_ID'))!=$user_profile['USERID'] )   {  ?> 

                                                                                <li class="seller-contact"><img alt="views" src="<?php echo base_url()."assets/images/contact.png";?>" width="33" height="33">                                                                                    

                                                                              

                                                                                  <?php if(($this->session->userdata('SESSION_USER_ID')))  { 

                                                                                      

                                                                                      ?> 

                                                                                    <a href="javascript:;" data-toggle="modal" data-target="#message-popup"><h5><?php echo (!empty($user_language[$user_selected]['lg_contact_seller']))?$user_language[$user_selected]['lg_contact_seller']:$default_language['en']['lg_contact_seller']; ?></h5></a>

                                                                                  <?php } else { ?>

                                                                                    <a href="javascript:;" onclick="selected_menu('sell-service')" ><h5><?php echo (!empty($user_language[$user_selected]['lg_contact_seller']))?$user_language[$user_selected]['lg_contact_seller']:$default_language['en']['lg_contact_seller']; ?></h5></a>

                                                                                  <?php } ?>

                                                                                </li>

                                                                                   <?php } ?>   

									</ul>

								</div>

								</div>	

								<div class="seller-info">

									<ul class="gig-stats seller-stats">

										<li class="seller-views"><img alt="views" src="<?php echo base_url()."assets/images/view.png"?>" width="34" height="34"> <h5><?php echo $gig_details['total_views']; ?> <?php echo (!empty($user_language[$user_selected]['lg_views']))?$user_language[$user_selected]['lg_views']:$default_language['en']['lg_views']; ?></h5></li>

										<li class="seller-orders"><img alt="views" src="<?php echo base_url()."assets/images/orders.png";?>" width="36" height="36"> <h5><?php echo count($result_countid);?> <?php echo (!empty($user_language[$user_selected]['lg_order_in_queue']))?$user_language[$user_selected]['lg_order_in_queue']:$default_language['en']['lg_order_in_queue']; ?></h5></li>

										<li class="seller-speaks"><img alt="views" src="<?php echo base_url()."assets/images/speaks.png";?>" width="34" height="34"> <h5><?php echo (!empty($user_language[$user_selected]['lg_speaks']))?$user_language[$user_selected]['lg_speaks']:$default_language['en']['lg_speaks']; ?>: <?php echo ucfirst($user_profile['lang_speaks']); ?></h5></li>

                                        <?php 

											if(!empty($gig_tags))

											{ ?>

										<li class="related-topics">

											<div><img alt="views" src="<?php echo base_url()."assets/images/topics.png";?>"> <h5><?php echo (!empty($user_language[$user_selected]['lg_related_topics']))?$user_language[$user_selected]['lg_related_topics']:$default_language['en']['lg_related_topics']; ?></h5></div>

											<p class="tags">

                                            <?php 

											 $tags = explode(',',$gig_tags); 

											foreach($tags as $tag)

											{ ?>

												<a href="javascript:;" onclick="tag_search('<?php echo $tag ; ?>')"><?php echo ucfirst($tag) ; ?></a>												

											<?php	}

											?>



											</p>

										</li>

                                        <?php } ?>

									</ul>

								</div>

                                                            

                                <?php if(!empty($category_based_gigs)) {  

								 ?>

                                                            

								<div class="similiar-gigs"> 

									<h3><?php echo (!empty($user_language[$user_selected]['lg_similar_gigs']))?$user_language[$user_selected]['lg_similar_gigs']:$default_language['en']['lg_similar_gigs']; ?> <span class="similar-gig-all"><a href="<?php echo base_url()."search/category/".$similar_gigs ; ?>"> <?php echo (!empty($user_language[$user_selected]['lg_see_all']))?$user_language[$user_selected]['lg_see_all']:$default_language['en']['lg_see_all']; ?> </a> </span></h3>                                    

                                    

									<div class="similiar-gig-list">

									<?php

                                     foreach($category_based_gigs as $cat) {

                                          $rate =  $cat['gig_price']; // Dynamic price

										 $image = base_url()."assets/images/gig-small.jpg";

												if(!empty($cat['gig_image_tile'])) {

												$image  = base_url().$cat['gig_image_tile']; } 

												$gig_id_sim = $cat['id']; 

												$query_gig = $this->db->query("SELECT AVG(rating) FROM `feedback`  WHERE `gig_id` = $gig_id_sim;");

												$result_gig = $query_gig->row_array();

												$rat_gig=0;

												if($result_gig['AVG(rating)']!='')

												{

													$rat_gig=round($result_gig['AVG(rating)']);

												} 

												   

											?>

											<div class="media">

											<a href="<?php echo base_url().'gig-preview/'.$cat['title']; ?>" class="pull-left media-link">

                                            	<img alt="" width="100" height="68" src="<?php echo $image; ?>" class="media-object">

											</a>

											<div class="media-body">

                                                <h4 class="media-heading"><a href="<?php echo base_url().'gig-preview/'.$cat['title']; ?>"><?php echo ucfirst(str_replace("-"," ",$cat['title'])); ?></a></h4>

												<div class="feed-rating feedback-area"><span class="starrr" data-rating="<?php echo $rat_gig;?>" ></span></div>

												<div class="price"><span><?php echo $rate_symbol.$rate ; ?></span></div>                                                                                        

											</div>

										</div>

                                                                        <?php 

																		

																		} ?>	 

									</div>

								</div>	

                                                            <?php } ?>

                                                            

							</div>

						</div>

					</div>	

				</div>	

			</section>

			<div class="page-section">

                 <?php if(!empty($user_all_gigs)) { ?>           

                <div class="container">

                    <h2 class="other-gigs-title">Other gigs <span>by <a href="<?php echo base_url().'user-profile/'.$username;?>"><?php echo $user_name; ?></a></span></h2>

                    <div class="popular-products">

                        <div class="owl-carousel" id="othergigs-products-carousel">

								<?php 

								$other_gigs_count = 0 ;

                                foreach($user_all_gigs as $gigs) { 

									$other_gigs_count = $other_gigs_count + 1 ;

                                    $image = base_url()."assets/images/2.jpg";

                                    if(!empty($gigs['gig_image'])) {

                                    $image = base_url().$gigs['gig_image']; }                                                           
$currency_option = (!empty($gigs['currency_type']))?$gigs['currency_type']:'USD';
$rate_symbol = currency_sign($currency_option);
                 

										  //$rate = $gig_price; // Fixed  Price 

                                            $rate = $gigs['gig_price']; // Dyanamic Price 

										    $extra_gig_price = $extra_gig_price;

								 
													

                                    

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

									<div class="product">  

										<div class="product-img">

                                        	<a href="<?php echo base_url().'gig-preview/'.$gigs['title']; ?>"><img width="240" height="250" alt="<?php echo $gigs['title']; ?>" src="<?php echo $image; ?>"></a>

										</div>

										<div class="product-detail">

                                           	<div class="product-name"><a href="<?php echo base_url().'gig-preview/'.$gigs['title']; ?>"><?php echo ucfirst(str_replace("-"," ",$gigs['title'])); ?></a></div>

											<div class="author">

												<span class="author-img">

											<a href="<?php echo base_url().'user-profile/'.$gigs['username'];?>"><img src="<?php echo $user_img ;?>" title="<?php echo $gigs['fullname']; ?>" width="50" height="50"></a>

											<a href="<?php echo base_url().'user-profile/'.$gigs['username'];?>"><?php echo $gigs['fullname']; ?></a>

												</span>

												<div class="ratings">

													<span class="stars-block star-<?php echo $gig_rating;?>"></span><span class="ratings-count">(<?php echo $gig_usercount;?>)</span>

												</div>

											</div>

											<div class="price-box2">

												<div class="price-inner">

													<div class="rectangle">

														<h2><?php echo $rate_symbol.$rate ; ?></h2>

													</div>

													<div class="triangle"></div>

												</div>

											</div>

											<div class="product-det">

                                               <div class="user-country text-ellipsis"><?php echo ucfirst($gigs['state_name']);?> <?php if($gigs['state_name']!=''){ echo ', ';}?><?php echo ucfirst($gigs['country']); ?></div>	

											</div>

										</div>

									</div>

                              <?php } ?>

                        </div>

						<input type="hidden" name="hidden_other_gigs" id="hidden_other_gigs" value="<?php echo $other_gigs_count ; ?>"  />

                    </div>

                </div>

                 <?php } ?>

            </div>

            <div id="checkout-popup" class="modal fade custom-popup order-popup" role="dialog">

				<div class="modal-dialog">

					<div class="modal-content">

						<button type="button" class="close" data-dismiss="modal">&times;</button>

						<div class="modal-header text-center">

							<h4 class="sign-title"><?php echo (!empty($user_language[$user_selected]['lg_buy_the_gig']))?$user_language[$user_selected]['lg_buy_the_gig']:$default_language['en']['lg_buy_the_gig']; ?></h4>

						</div>

						<div class="modal-body">

							<div class="row">

								<div class="col-md-6">

									<ul class="quantity-list">

										<li>

											<div class="form-group clearfix">

                                            <?php 

                                             // $rate = $rate;  //Fixed 

                                                $rate = $my_gig_rate; // Dynamic 

                                             ?>

												<label class="label-title"><?php echo (!empty($user_language[$user_selected]['lg_price']))?$user_language[$user_selected]['lg_price']:$default_language['en']['lg_price']; ?></label>

												<input type="text" class="form-control" readonly="" id="last_modifiy_inputid" value="<?php  echo  $rate ;?>">

												<input type="hidden" value="<?php echo $rate;?>" name="default_gigsamount" id="default_gigsamount" />

											</div>

										</li>

										<li><span class="multiple"><i aria-hidden="true" class="fa fa-times"></i></span></li>

										<li>

											<div class="form-group clearfix">

												<label class="label-title"><?php echo (!empty($user_language[$user_selected]['lg_quantity']))?$user_language[$user_selected]['lg_quantity']:$default_language['en']['lg_quantity']; ?></label>

												<span class="quantity-select">1</span>

											</div>

										</li>

									</ul>

								</div>

								<div class="col-md-6">

									<div class="text-right summary">

										<span class="price-tag"> <?php echo $rate_symbol;?><span id="change_ratecount"><?php echo $rate ; ?></span></span>

									</div>

								</div>

							</div>



                            <div id="extra_gig_calculation"></div>

							<form action="<?php echo base_url().'user/buy_service/payment';?>" method="post" id="payment_formid" name="payment_submit">

								<input type="hidden" name="gigs_rate" id="gigs_rate" value="<?php  echo $item_gig_price;?>" />

                                <input type="hidden" name="converted_india_gigs_rate" id="converted_india_gigs_rate" value="500" />

                                <input type="hidden" name="gigs_actual_rate" id="gigs_actual_rate" value="<?php  echo $item_gig_price;?>" />

                                <input type="hidden" name="gigs_id" id="gigs_id" value="<?php  echo $select_gig;?>" />

                                <input type="hidden" name="gig_user_id" id="gig_user_id" value="<?php  echo $gig_user_id;?>" />

                                <input type="hidden" name="extra_gig_row_id" id="extra_gig_row_id" value="" />

                                <input type="hidden" value="" name="currency_type" id="currency_type" />

                                <input type ="hidden" name="hidden_super_fast_delivery" value="" id="hidden_super_fast_delivery"  />

                                <input type ="hidden" name="total_delivery_days" value="" id="total_delivery_days"  />

                                <input type="hidden" id="hidden_super_fast_delivery_charges" name="hidden_super_fast_delivery_charges" value="" />

								<div id="payment-method">

									<h4 class="clearfix"><?php echo (!empty($user_language[$user_selected]['lg_select_your_payment_method']))?$user_language[$user_selected]['lg_select_your_payment_method']:$default_language['en']['lg_select_your_payment_method']; ?></h4>

									<div class="payment-method">

									 <?php if ($paypal_allow == 1) { ?>	

                              

                              <label class="radio-inline bold">

                              <input class="le-radio" type="radio" onchange="check_payment_type(this)" name="group2" value="Direct"  > <img src="<?php echo base_url();?>assets/images/paypal-icon.png" alt="Paypal" width="24" height="22">  <?php echo (!empty($user_language[$user_selected]['lg_paypal']))?$user_language[$user_selected]['lg_paypal']:$default_language['en']['lg_paypal']; ?></label>

                    <?php }  ?> 

                    <?php if ($paytabs_allow == 1) { ?>  

                              

                              <label class="radio-inline bold">

                              <input class="le-radio" type="radio" onchange="check_payment_type(this)" name="group2" value="PayTabs"  > PayTabs</label>

                    <?php }  ?>                    

                    <?php if ($stripe_allow == 1) { ?>  

                            <?php if (!empty($publishable_key)) { ?>

                                <label class="radio-inline bold">

                                <input class="le-radio" type="radio" onchange="check_payment_type(this)" name="group2" value="stripe" ><?php echo (!empty($user_language[$user_selected]['lg_stripe']))?$user_language[$user_selected]['lg_stripe']:$default_language['en']['lg_stripe']; ?></label>

                            <?php } ?>

                     <?php } ?>                   



									</div>

								</div>

								<div>

									<button type="submit" id="payment_btn" style="display: none;" class="btn btn-green buyitnow-btn" value="true" name="submit"><?php echo (!empty($user_language[$user_selected]['lg_buy_it_now']))?$user_language[$user_selected]['lg_buy_it_now']:$default_language['en']['lg_buy_it_now']; ?></button>

								</div>

							</form>

						</div>

						<div class="modal-footer text-left">

							<div class="media secure-money">

								<div class="media-left">

									<img width="46" height="40" src="<?php echo base_url();?>assets/images/secure-money.png" alt="">

								</div>

								<div class="media-body">

									<span><?php echo (!empty($user_language[$user_selected]['lg_your_deposit_will_be_securely_held_in_escrow_until_you_are_happy_to_release_it_to_the_seller_upon_hourlie_completion']))?$user_language[$user_selected]['lg_your_deposit_will_be_securely_held_in_escrow_until_you_are_happy_to_release_it_to_the_seller_upon_hourlie_completion']:$default_language['en']['lg_your_deposit_will_be_securely_held_in_escrow_until_you_are_happy_to_release_it_to_the_seller_upon_hourlie_completion']; ?>.</span>

								</div>

							</div>

						</div>

					</div> 

				</div>

			</div>

            <div id="message-popup" class="modal fade custom-popup" role="dialog">

				<div class="modal-dialog">

					<div class="modal-content">

						<button type="button" class="close" data-dismiss="modal">&times;</button>

						<div class="modal-body">

							<div class="msg-user-details">

								<?php  if(!empty($user_profile['user_thumb_image'])) {

											$user_image = base_url().$user_profile['user_thumb_image'];

										 }else{

											 $user_image = base_url().'assets/images/avatar2.jpg';

										 }

								  $name ='';

									  if(!empty($user_profile['fullname'])) { $name = $user_profile['fullname'];}

								?>

								<div class="pull-left user-img m-r-10">

									<img src="<?php echo $user_image;?>" alt="" class="w-40 img-circle" width="50" height="50"><span class="online"></span>

								</div>

								<div class="user-info pull-left">

									<div class="dropdown">

										<a href="javascript:;"><?php echo $name;?></a>

									</div>

									<p class="text-muted m-0"><?php echo $user_country_name; ?></p>

								</div>

							</div>

							<div class="new-message">

								<div id="_error_" class="text-danger"></div>

								<form id="form_messagecontent_id" method="post" enctype="multipart/form-data" >

									<input type="hidden" name="sell_gigs_userid" id="sell_gigs_userid" value="<?php echo $user_profile['USERID'];?>"/>						

									<div class="form-group">

										<label class="form-label"><?php echo (!empty($user_language[$user_selected]['lg_your_message']))?$user_language[$user_selected]['lg_your_message']:$default_language['en']['lg_your_message']; ?></label>

										<textarea name="chat_message_content" placeholder="Message to <?php echo $name; ?>" required="" id="messageone" class="form-control"></textarea>

									</div>						

								</form>

							</div>

							<button type="submit" name="submit" class="btn btn-primary btn-style" onclick="save_newchat();"><?php echo (!empty($user_language[$user_selected]['lg_send']))?$user_language[$user_selected]['lg_send']:$default_language['en']['lg_send']; ?></button>

						</div>

					</div>

				</div>

			</div>

			<div  id="locloader" class="loader-wrap" style="display: none;">

            <div class="loader">

                 <?php echo (!empty($user_language[$user_selected]['lg_loading']))?$user_language[$user_selected]['lg_loading']:$default_language['en']['lg_loading']; ?>...

            </div>

        </div>

<!-- Stripe Input Form Start  -->



        <form class="form-horizontal"  method="POST" id="payment-form" style="display: none;">

        <input type="hidden" id="stripe_amount" name="amount" data-stripe="amount" class="form-control cpy">

        <!-- Other Datas  -->

        <input type="hidden" name="gigs_rate" id="gigs_rates" > 

        <input type="hidden" name="converted_india_gigs_rate" id="converted_india_gigs_rates" > 

        <input type="hidden" name="gigs_actual_rate" id="gigs_actual_rates" > 

        <input type="hidden" name="gigs_id" id="gigs_ids" > 

        <input type="hidden" name="gig_user_id" id="gig_user_ids" > 

        <input type="hidden" name="extra_gig_row_id" id="extra_gig_row_ids" > 

        <input type="hidden" name="currency_type" id="currency_types" > 

        <input type="hidden" name="hidden_super_fast_delivery" id="hidden_super_fast_deliverys" > 

        <input type="hidden" name="total_delivery_days" id="total_delivery_dayss" > 

        <input type="hidden" name="hidden_super_fast_delivery_charges" id="hidden_super_fast_delivery_chargess" > 

        <input type="hidden" name="access_token" id="access_token" > 

        <input type="hidden"  name="transaction_id" id="transaction_id" />

        <!-- <textarea id="verifydata" name="verifydata" style="display: none;"></textarea> -->

        <?php 



        $userid = $this->session->userdata('SESSION_USER_ID');

        $session_user = $this->db->get_where('members',array('USERID'=>$userid))->row_array(); 

        ?>

        <input type="hidden"  name="email" id="email" value="<?php echo $session_user['email'] ?>" />

        <input type="hidden"  name="name" id="name" value="<?php echo $session_user['username'] ?>" />



        <!-- Other Datas  -->

        <button type="button" onclick="paycancel()" class="pull-right btn btn-danger"><?php echo (!empty($user_language[$user_selected]['lg_cancel']))?$user_language[$user_selected]['lg_cancel']:$default_language['en']['lg_cancel']; ?></button> &nbsp;

        <button type="submit" id="stripe_payment" class="pull-right btn btn-success submit" style="margin-right:5px;"><?php echo (!empty($user_language[$user_selected]['lg_pay_now']))?$user_language[$user_selected]['lg_pay_now']:$default_language['en']['lg_pay_now']; ?></button>

        </form>





<!-- Stripe End here  -->

 

<!-- Dynamic Stripe Key Change -->

<script type="text/javascript">

    var publishable_key = "<?php echo $publishable_key; ?>";

    function check_payment_type(e){

        $('#payment_btn').show();

    }

</script>    





