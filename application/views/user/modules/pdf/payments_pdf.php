 

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
        <th align="center" colspan="5"><?php echo (!empty($user_language[$user_selected]['lg_gigs_payments_reports']))?$user_language[$user_selected]['lg_gigs_payments_reports']:$default_language['en']['lg_gigs_payments_reports']; ?></th>
  </tr>
  </thead>
  <tbody>
    <tr>
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

      <th><?php echo (!empty($user_language[$user_selected]['lg_buyer']))?$user_language[$user_selected]['lg_buyer']:$default_language['en']['lg_buyer']; ?></th>

      

      <th><?php echo (!empty($user_language[$user_selected]['lg_order_date']))?$user_language[$user_selected]['lg_order_date']:$default_language['en']['lg_order_date']; ?></th>

      <th><?php echo (!empty($user_language[$user_selected]['lg_payments']))?$user_language[$user_selected]['lg_payments']:$default_language['en']['lg_payments']; ?></th>

       <th><?php echo (!empty($user_language[$user_selected]['lg_amount']))?$user_language[$user_selected]['lg_amount']:$default_language['en']['lg_amount']; ?></th>

    



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




        $country_name = $this->session->userdata('country_name');

                      $rupee_rate  = $this->session->userdata('rupee_rate');

                      $dollar_rate  = $this->session->userdata('dollar_rate');

                      $total_rates=array();

                  

                  foreach($order_data as $item) {  

                     $source = $item['source']; 

                                         $seller_id = $item['seller_id']; 


                $currency_option = (!empty($item['currency_type']))?$item['currency_type']:'USD';
                $rate_symbol = currency_sign($currency_option);

                        

                  $rates = $item['item_amount'];

                  $request_sent =  (!empty($user_language[$user_selected]['lg_request_sent']))?$user_language[$user_selected]['lg_request_sent']:$default_language['en']['lg_request_sent'];


                $payment_received =  (!empty($user_language[$user_selected]['lg_payment_received']))?$user_language[$user_selected]['lg_payment_received']:$default_language['en']['lg_payment_received'];


                $withdraw_amount =  (!empty($user_language[$user_selected]['lg_withdraw_amount']))?$user_language[$user_selected]['lg_withdraw_amount']:$default_language['en']['lg_withdraw_amount'];

                  $commision_rate = (($rates*$item['commision'])/100);

                    $rate = $rates - $commision_rate ;

                  $rate = number_format((float)$rate, 2, '.', '');

                  $total_rates[]=$rate;

                       

                      

                  $f_uid = $item['user_id'];

                  $t_uid = $item['USERID'];

                  $gid   = $item['gigs_id'];

                  $id    = $item['id'];

                  $status = $item['payment_status']; 

                  if($status ==1) {

                    $sts='<b style="color:#c9302c">'.$request_sent.'</b>';//danger

                  }elseif($status ==2){

                    $sts='<b style="color:#5cb85c">'.$payment_received.'</b>';//success

                  }else{

                    $single ="'";

                    $sts='<b style="color:#337ab7">'.$withdraw_amount.'</b>';

                  }

                  

                  $created_on = '-';

                  if (isset($item['created_at'])) {

                    if (!empty($item['created_at']) && $item['created_at'] != "0000-00-00 00:00:00") {

                      $created_on = date('d/m/Y', strtotime($item['created_at']));

                    }

                  }

       

?>



<tr>

  <td><?php echo ucfirst(str_replace("-"," ",$item['title']));?></td>
  <td><?php echo $item['id'];?></td>
  <td><?php echo ucfirst($item['fullname']);?></td>
  <td><?php echo $created_on;?></td>
  <td><?php echo $sts ;?></td>
  <td><?php echo $rate_symbol.$rate ;?></td>

 
</tr>

<?php  } }  ?>



</tbody>
<tfoot>
  <tr>
    <td colspan="5" align="right"><?php echo (!empty($user_language[$user_selected]['lg_total_amount']))?$user_language[$user_selected]['lg_total_amount']:$default_language['en']['lg_total_amount']; ?></td>
    <td><?php echo $rate_symbol.number_format((float)array_sum($total_rates), 2, '.', '');?></td>
  </tr>
</tfoot>

</table>

