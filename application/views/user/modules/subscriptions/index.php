<style type="text/css">
.siterow{margin-top: 20px;}

    .prccontainer{transition:all 300ms linear;}
.prccontainer:hover{ box-shadow:0 0 25px rgba(0,0,0,0.2);}
.prctitle{padding:30px; text-align:center;}
.prctitle.silver{ background:#8c8c8c;}
.prctitle.gold{ background:#e3a22a;}
.prctitle.platinum{ background:#9576dc;border: 5px solid #cdd3e3;border-radius: 10px;}
.prctitle .prcheading{ font-size:24px; line-height:24px; color:#fff; font-weight:600; text-transform:uppercase;}
.prctitle .pricerow{ text-align:center; padding:25px 0; color:#fff;}
.prctitle .price{ font-size:48px; line-height:48px; color:#fff; font-weight:600; display:inline-block;}
.prctitle .pricetype{display:inline-block;}
.prctitle .pricemonth{display:inline-block;}
.prctitle a{ font-weight:700; display:inline-block; padding:15px 50px; text-transform:uppercase; border-radius:8px; background:#fff; transition:all 300ms linear;}
.prctitle.silver a{ color:#8c8c8c;}
.prctitle.gold a{ color:#e3a22a;}
.prctitle.platinum a{ color:#9576dc;}
.prctitle a:hover{ text-decoration:none; background:#000; color:#fff;}
.prctitle .gigscount{ color:#fff; margin-top:15px;}

@media only screen and (max-width:991px){
.prccontainer{ margin:0 auto; max-width:400px;}
.prccontainer:last-child{ margin-bottom:0;}
#pricing .col-md-4{ margin-bottom:40px;}
#pricing .col-md-4:last-child{ margin-bottom:0;}
}
.subscriptions-title
{
    color: #4a4d57;
    font-weight: 600;
    font-size: 24px;
    /*float: left;*/
    margin-bottom: 20px;
    margin-top: 0;
}
</style>
<div class="siterow dark" id="pricing">
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
            <div class="row">

                <div class="col-md-12">

                <h3 class="subscriptions-title">

                    <span><?php echo (!empty($user_language[$user_selected]['lg_subscriptions_plans']))?$user_language[$user_selected]['lg_subscriptions_plans']:$default_language['en']['lg_subscriptions_plans']; ?></span>    

                </h3>
                <hr>

            </div>
                <?php

                $userid = $this->session->userdata('SESSION_USER_ID');

               

                if(!empty($subscriptions))
                {

                    foreach ($subscriptions as $rows) {

                         if($subscriptionmethod=='Renewal')
                            {
                                if($rows['subscription_rate']==0)
                                {
                                    
                                }
                                else
                                {
                       
               ?>
            	 <div class="col-md-3">
                	<div class="prccontainer">
                        <div class="prctitle platinum">
                            <div class="prcheading"><?php echo $rows['subscription_name'];?></div>
                            <div class="pricerow">

                            	<div class="pricetype"><?php echo $default_currency_sign;?></div>
                                <div class="price"><?php echo $rows['subscription_rate'];?></div>
                                <div class="pricemonth">/ <?php echo $rows['subscription_period'].' '.$rows['period_type'];?></div>
                            </div> 
                           
                                   <a href="#" data-toggle="modal" data-target="#checkout-popup" onclick="sub_scriptions('<?php echo $rows['id'];?>','<?php echo $rows['subscription_name'];?>','<?php echo $rows['subscription_rate'];?>','<?php echo $rows['subscription_period'].' '.$rows['period_type'];?>','<?php echo $rows['no_of_gigs'];?>')"><?php echo (!empty($user_language[$user_selected]['lg_activate']))?$user_language[$user_selected]['lg_activate']:$default_language['en']['lg_activate']; ?> </a>

                                              
                            
                            <div class="gigscount"><?php echo (!empty($user_language[$user_selected]['lg_number_of_gigs']))?$user_language[$user_selected]['lg_number_of_gigs']:$default_language['en']['lg_number_of_gigs']; ?>: <?php echo $rows['no_of_gigs'];?></div>.
                        </div>                        
                    </div>
                </div>

            <?php } }
            else{
                ?>

                <div class="col-md-3">
                    <div class="prccontainer">
                        <div class="prctitle platinum">
                            <div class="prcheading"><?php echo $rows['subscription_name'];?></div>
                            <div class="pricerow">

                                <div class="pricetype"><?php echo $default_currency_sign;?></div>
                                <div class="price"><?php echo $rows['subscription_rate'];?></div>
                                <div class="pricemonth">/ <?php echo $rows['subscription_period'].' '.$rows['period_type'];?></div>
                            </div> 
                           
                                   <a href="#" data-toggle="modal" data-target="#checkout-popup" onclick="sub_scriptions('<?php echo $rows['id'];?>','<?php echo $rows['subscription_name'];?>','<?php echo $rows['subscription_rate'];?>','<?php echo $rows['subscription_period'].' '.$rows['period_type'];?>','<?php echo $rows['no_of_gigs'];?>')"><?php echo (!empty($user_language[$user_selected]['lg_activate']))?$user_language[$user_selected]['lg_activate']:$default_language['en']['lg_activate']; ?> </a>

                                              
                            
                            <div class="gigscount"><?php echo (!empty($user_language[$user_selected]['lg_number_of_gigs']))?$user_language[$user_selected]['lg_number_of_gigs']:$default_language['en']['lg_number_of_gigs']; ?>: <?php echo $rows['no_of_gigs'];?></div>.
                        </div>                        
                    </div>
                </div>


            <?php    
            } } }

            else{
                ?>
                <h3 class="header-title"><?php echo (!empty($user_language[$user_selected]['lg_no_subscriptions_found']))?$user_language[$user_selected]['lg_no_subscriptions_found']:$default_language['en']['lg_no_subscriptions_found']; ?></h3>
           <?php } ?>


            </div>
             <hr>
        </div>
    </div>



    <div id="checkout-popup" class="modal fade custom-popup order-popup" role="dialog">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <div class="modal-header text-center">

                            <h4 class="sign-title"><?php echo (!empty($user_language[$user_selected]['lg_subscription']))?$user_language[$user_selected]['lg_subscription']:$default_language['en']['lg_subscription']; ?></h4>

                        </div>

                        <div class="modal-body">

                            
                            <div class="table-responsive">

                        <table class="table table-bordered">

                            <thead>

                                <tr>

                                  <th><?php echo (!empty($user_language[$user_selected]['lg_subscription_name']))?$user_language[$user_selected]['lg_subscription_name']:$default_language['en']['lg_subscription_name']; ?></th>

                                  <th><?php echo (!empty($user_language[$user_selected]['lg_subscription_period']))?$user_language[$user_selected]['lg_subscription_period']:$default_language['en']['lg_subscription_period']; ?></th>

                                  <th><?php echo (!empty($user_language[$user_selected]['lg_no_of_gigs']))?$user_language[$user_selected]['lg_no_of_gigs']:$default_language['en']['lg_no_of_gigs']; ?></th>

                                  <th><?php echo (!empty($user_language[$user_selected]['lg_subscription_amount']))?$user_language[$user_selected]['lg_subscription_amount']:$default_language['en']['lg_subscription_amount']; ?></th>

                                 

                                </tr>

                            </thead>

                            <tbody>

                                <tr>

                                    <td class="subscription_name text-center"></td>

                                    <td class="subscription_period text-center"></td>

                                    <td class="subscription_gigs text-center"></td>

                                    <td class="subscription_amount text-center"></td>

                                </tr>

                             </tbody>

                                </table>

                                </div>

                            <form action="<?php echo base_url().'user/subscriptions/payment';?>" method="post" id="subscriptionpayment_formid" name="payment_submit">

                                <input type="hidden" name="subscription_name" id="subscription_name" value="" />

                                <input type="hidden" name="subscription_period" id="subscription_period" value="" />

                                <input type="hidden" name="subscription_amount" id="subscription_amount" value="" />

                                <input type="hidden" name="subscription_gigs" id="subscription_gigs" value="" />

                                <input type="hidden" name="subscription_id" id="subscription_id" value="" />

                               
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



            <form class="form-horizontal"  method="POST" id="subscription_payment-form" style="display: none;">

        <input type="hidden" id="stripe_amount" name="amount" data-stripe="amount" class="form-control cpy">

        <!-- Other Datas  -->

        <input type="hidden" name="subscription_name" id="subscription_names" > 

        <input type="hidden" name="subscription_period" id="subscription_periods" > 

        <input type="hidden" name="subscription_gigs" id="subscription_gigss" value="" />

        <input type="hidden" name="subscription_amount" id="subscription_amounts" > 

        <input type="hidden" name="subscription_id" id="subscription_ids" > 

         <input type="hidden" name="currency_type" id="currency_types" value="<?php echo $default_currency_sign;?>" > 

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

    <script type="text/javascript">

        function sub_scriptions(subscription_id,subscription_name,subscription_amount,subscription_period,noofgigs)
        {
            if(subscription_amount=='0')
            {
               $('#payment-method').hide(); 
               $('#payment_btn').show();
            }
            else
            {
                $('#payment-method').show();
                 $('#payment_btn').hide();

            }

            $('.subscription_name').text(subscription_name);
            $('.subscription_period').text(subscription_period);
            $('.subscription_gigs').text(noofgigs);
            $('.subscription_amount').text('<?php echo $default_currency_sign;?>'+subscription_amount);

            $('#subscription_name').val(subscription_name);
            $('#subscription_period').val(subscription_period);
            $('#subscription_gigs').val(noofgigs);
            $('#subscription_amount').val(subscription_amount);
            $('#subscription_id').val(subscription_id);
        }

        function check_payment_type(e){

        $('#payment_btn').show();

    }
    </script>