<div class="content-page">
    <div class="content">
        <div class="container">            
            <div class="row">
                <div class="panel-body">
                    <?php if($this->session->flashdata('message')) { ?>
                    
                    <?php echo $this->session->userdata('message'); ?>
                    </div>  
                    <?php } ?>  

                            
					<div class="col-md-8 col-md-offset-2">
						<h4 class="page-title m-b-20 m-t-0 text-center">Subscription Management <br><small>(Maximum 4 subscription widget only!)</small></h4>
					</div>
				</div>
            </div>
<?php if($subscriptioncount <=3)
                { ?>
            <div class="row">

                <div class="col-md-8 col-md-offset-2">

                    <div class="card-box">

                        <form class="form-horizontal" id="admin_add_subscription"  action="" method="POST">

                            <div class="tab-pane active">

                                <div class="form-group">

                                    <label class="col-sm-3 control-label">Subscription Name</label>

                                    <div class="col-sm-9">

                                        <input  type="text" id="subscription_name" name="subscription_name" value="" class="form-control " >

                                        <small class="error_msg help-block name_error" style="display: none;">Please enter a plan name</small>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-3 control-label">Subscription Period</label>

                                    <div class="col-sm-6">

                                        <input type="text" id="subscription_period" maxlength="5" name="subscription_period" value="" class="form-control numberonly" >

                                        <small class="error_msg help-block period_error" style="display: none;">Please enter a subscription Period</small>

                                    </div>
                                    <div class="col-sm-3">

                                        <select name="period_type" id="period_type" class="form-control">
                                            <option value="Days">Days</option>
                                            <option value="Month">Month</option>
                                            <option value="Year">Year</option> 
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-3 control-label">No of Gigs</label>

                                    <div class="col-sm-9">

                                        <input  type="text" id="no_of_gigs" name="no_of_gigs" value="" class="form-control numberonly" >

                                        <small class="error_msg help-block gigs_error" style="display: none;">Please enter a no of gigs</small>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-3 control-label">Subscription Rate</label>

                                    <div class="col-sm-9">

                                        <input  type="text" id="subscription_rate" onkeyup="check_sub_rate()" onblur="check_sub_rate()"  maxlength="5" name="subscription_rate" value="" class="form-control numberonly" >

                                         <small class="help-block">** <b>Enter 0 amount for free subscription</b>  **</small>

                                        <small class="error_msg help-block rate_error" style="display: none;">Please enter a subscription rate</small>

                                    </div>

                                </div>
                                

                            </div>

                            <div class="m-t-30 text-center">

                                <button name="form_submit"  type="submit" class="btn btn-primary center-block" value="true">Save</button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>
        <?php } ?>
        <h4 class="page-title m-b-20 m-t-0 text-center">All Subscription</h4>

        <div id="flash_lang_message"></div>

        <div class="panel">



                <div class="panel-body">



                        <div class="table-responsive">



                            <table class="table table-striped table-actions-bar">

                                <thead>

                                    <tr>
                                        <th>#</th>
                                        <th>Subscription Name</th>
                                        <th>Subscription Period</th>
                                        <th>No of Gigs</th>
                                        <th>Subscription Rate</th>
                                        <th>Action</th>
                                        

                                    </tr>

                                </thead>

                                <tbody >

                                    <?php 

                                    

                                    if (!empty($list))

                                    {
                                        $i=1;
                                        foreach ($list as $row)

                                        {     

                                             $new = 'checked';      

                                        $status = 'Active';

                                        if($row['status']==0){

                                            $status = 'Inactive';
                                            $new = '';      



                                        }else{

                                           

                                        }  

                                        ?>

                                                <tr>

                                                    <td> <?php echo $i++?></td>

                                                    <td> <?php echo  $row['subscription_name'] ?></td>

                                                    <td> <?php echo  $row['subscription_period'].' '.$row['period_type'] ?></td>

                                                    <td> <?php echo  $row['no_of_gigs'] ?></td>

                                                    <td> <?php if($row['subscription_rate']=='0')
                                                                        {
                                                                         echo 'Free';
                                                                        } 
                                                                        else
                                                                        { 
                                                                          echo $row['subscription_rate'];
                                                                        } ?></td>

                                                    <td  class="toogle_switch"><input   type="checkbox" <?php echo  $new; ?> <?php echo $status; ?>  class="alert-status switch switch_subscription" id="<?php echo $row['id']; ?>" data-size="normal" name="my-checkbox" data-on-text="on" data-off-text="off"></td>

                                                    <td><a href="#" onclick="delete_subscription(<?php echo $row['id'] ?>)" class="table-action-btn" title="Delete"><i class="mdi mdi-window-close text-danger"></i></a></td>
                                           

                                                </tr>

                                                <?php

                                            }

                                       

                                            }else {

                                        ?>

                                        <tr>

                                            <td colspan="6"><p class="text-danger text-center m-b-0">No Records Found</p></td>

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





<script type="text/javascript">


function check_sub_rate()
{
   var a=$('#subscription_rate').val();
   if(a!='')
   {
     $('#subscription_rate').val(parseInt(a));
   }
   
   
        
        
}
    

// function subscription_validation(){



//     var error =0;

//     var subscription_name = $('#subscription_name').val().trim();

//     if(subscription_name==""){

//         $('.name_error').show();

//         error =1; 

//     }else{

//         $('.name_error').hide();

//     }



//     var subscription_period = $('#subscription_period').val().trim();

//     if(subscription_period==""){

//         $('.period_error').show();

//         error =1; 

//     }else{

//         $('.period_error').hide();

//     }


//     var no_of_gigs = $('#no_of_gigs').val().trim();

//     if(no_of_gigs==""){

//         $('.gigs_error').show();

//         error =1; 

//     }else{

//         $('.gigs_error').hide();

//     }


//     var subscription_rate = $('#subscription_rate').val().trim();

//     if(subscription_rate==""){

//         $('.rate_error').show();

//         error =1; 

//     }else{

//         $('.rate_error').hide();

//     }



// if(error==0){

//       return true;

// }else{

//       return false;

// }



// }



    






</script>

