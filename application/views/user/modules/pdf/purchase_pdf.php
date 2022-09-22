 

<style>
#sales {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#titles {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size: 20px;
}

#sales td, #sales th {
  border: 1px solid #ddd;
  padding: 8px;
}

#sales tr:nth-child(even){background-color: #f2f2f2;}

#sales tr:hover {background-color: #ddd;}

#sales th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #9576dc;
  color: white;
}
</style>


<table id="titles">
  <thead>
    <tr>
        <th align="center" colspan="7"><?php echo (!empty($user_language[$user_selected]['lg_gigs_purchase_reports']))?$user_language[$user_selected]['lg_gigs_purchase_reports']:$default_language['en']['lg_gigs_purchase_reports']; ?></th>
  </tr>
  </thead>
  <tbody>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
  
  
</table>

<table id="sales">


  <thead>

    <tr>



      <th><?php echo (!empty($user_language[$user_selected]['lg_order_title']))?$user_language[$user_selected]['lg_order_title']:$default_language['en']['lg_order_title']; ?></th>



      <th><?php echo (!empty($user_language[$user_selected]['lg_order_id']))?$user_language[$user_selected]['lg_order_id']:$default_language['en']['lg_order_id']; ?></th>

      <th><?php echo (!empty($user_language[$user_selected]['lg_seller']))?$user_language[$user_selected]['lg_seller']:$default_language['en']['lg_seller']; ?></th>

       <th><?php echo (!empty($user_language[$user_selected]['lg_amount']))?$user_language[$user_selected]['lg_amount']:$default_language['en']['lg_amount']; ?></th>

      <th><?php echo (!empty($user_language[$user_selected]['lg_order_date']))?$user_language[$user_selected]['lg_order_date']:$default_language['en']['lg_order_date']; ?></th>

      <th><?php echo (!empty($user_language[$user_selected]['lg_delivery_date']))?$user_language[$user_selected]['lg_delivery_date']:$default_language['en']['lg_delivery_date']; ?></th>


      <th><?php echo (!empty($user_language[$user_selected]['lg_order_status']))?$user_language[$user_selected]['lg_order_status']:$default_language['en']['lg_order_status']; ?></th>



    </tr>

  </thead>



  <tbody>

    <?php

    if(!empty($order_data)) 

    {

      $country_name = $this->session->userdata('country_name');

      $rupee_rate  = $this->session->userdata('rupee_rate');

      $dollar_rate  = $this->session->userdata('dollar_rate');


      $failed = (!empty($user_language[$user_selected]['lg_failed']))?$user_language[$user_selected]['lg_failed']:$default_language['en']['lg_failed'];

      $new = (!empty($user_language[$user_selected]['lg_new']))?$user_language[$user_selected]['lg_new']:$default_language['en']['lg_new'];

      $cancelled = (!empty($user_language[$user_selected]['lg_cancelled']))?$user_language[$user_selected]['lg_cancelled']:$default_language['en']['lg_cancelled'];

      $process = (!empty($user_language[$user_selected]['lg_process']))?$user_language[$user_selected]['lg_process']:$default_language['en']['lg_process'];

      $pending = (!empty($user_language[$user_selected]['lg_pending']))?$user_language[$user_selected]['lg_pending']:$default_language['en']['lg_pending'];

      $refunded = (!empty($user_language[$user_selected]['lg_refunded']))?$user_language[$user_selected]['lg_refunded']:$default_language['en']['lg_refunded'];

      $decline_request = (!empty($user_language[$user_selected]['lg_decline_request']))?$user_language[$user_selected]['lg_decline_request']:$default_language['en']['lg_decline_request'];

      $declined = (!empty($user_language[$user_selected]['lg_declined']))?$user_language[$user_selected]['lg_declined']:$default_language['en']['lg_declined'];

      $completed = (!empty($user_language[$user_selected]['lg_completed']))?$user_language[$user_selected]['lg_completed']:$default_language['en']['lg_completed'];

      $completed_request = (!empty($user_language[$user_selected]['lg_completed_request']))?$user_language[$user_selected]['lg_completed_request']:$default_language['en']['lg_completed_request'];

      $see_feedback = (!empty($user_language[$user_selected]['lg_see_feedback']))?$user_language[$user_selected]['lg_see_feedback']:$default_language['en']['lg_see_feedback'];



      foreach($order_data as $item) { 



        $rate = $item['item_amount'];


        $currency_option = (!empty($item['currency_type']))?$item['currency_type']:'USD';
        $rate_symbol = currency_sign($currency_option);



        $f_uid = $item['user_id'];

        $t_uid = $item['USERID'];

        $gid   = $item['gigs_id'];

        $status = $item['seller_status']; 

        $order_id =$item['id'];

        if($status ==0) {

          $sts=''.$failed.'';

$class='#c9302c';//danger



}elseif($status ==1) {

  $sts=''.$new.'';

$class='#5cb85c';//success

if($item['buyer_status'] ==1) { if($item['cancel_accept'] ==1){

  $sts=''.$cancelled.'';

$class='#c9302c';//danger

if($item['pay_status']=='Payment Processed'){

  $sts=''.$refunded.'';

$class='#5bc0de';//info

}

}

}

}elseif($status ==2){

  $sts=''.$pending.'';

$class='#f0ad4e';//warning

if($item['buyer_status'] ==1) { if($item['cancel_accept'] ==1){

  $sts=''.$cancelled.'';

$class='#c9302c';//danger

if($item['pay_status']=='Payment Processed'){

  $sts=''.$refunded.'';

$class='#5bc0de';//info

}

}

}

}elseif($status ==3){

  $sts=''.$process.'';

$class='#337ab7';//primary

if($item['buyer_status'] ==1) { if($item['cancel_accept'] ==1){

  $sts=''.$cancelled.'';

$class='#c9302c';//danger

if($item['pay_status']=='Payment Processed'){

  $sts=''.$refunded.'';

$class='#5bc0de';//info

}

}

}

}elseif($status ==4){

  $sts=''.$refunded.'';

$class='#c9302c';//danger

}elseif($status ==5){

  if($item['decline_accept'] ==0)

  {

    $sts=''.$decline_request.'';

  }

  else{

    $sts=''.$declined.'';

  }

$class='#c9302c';//danger

}elseif($status ==6){

  $sts=''.$completed.'';

$class='#5cb85c';//success

}elseif($status ==7){

  $sts=''.$completed_request.'';

$class='#5cb85c';//success

}

$fead_stautus=0;

if($status ==6) {



  $query = $this->db->query("SELECT id FROM `feedback` WHERE `from_user_id` = $t_uid and `to_user_id` = $f_uid and `gig_id` = $gid and `order_id` = $order_id;");

  $result = $query->row_array();

  $fead_stautus=1; 

  if($result['id']!=''){

    $b_sts=''.$see_feedback.'';

  }else

  {

    $fead_stautus=2;  

    $b_sts=''.$pending.'';

  }

}

else

{

  $fead_stautus=2; 

  $b_sts=''.$pending.'';

}

$created_on = '-';

if (isset($item['created_at'])) {

  if (!empty($item['created_at']) && $item['created_at'] != "0000-00-00 00:00:00") {

    $created_on = date('d/m/Y', strtotime($item['created_at']));

  }

}

$delivery_date = date('d M Y', strtotime($item['delivery_date']));



?>



<tr>

  <td><?php echo ucfirst(str_replace("-"," ",$item['title']));?></td>
  <td><?php echo $item['id'];?></td>
  <td><?php echo ucfirst($item['fullname']);?></td>
  <td><?php echo $rate_symbol.$rate ;?></td>
  <td><?php echo $created_on;?></td>
  <td><?Php echo $delivery_date; ?></td>
  <td><span style="color:<?php echo $class;?>"><?php echo $sts;?></span></td>
</tr>

<?php  } }  ?>



</tbody>

</table>

