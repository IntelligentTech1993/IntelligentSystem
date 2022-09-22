                <footer class="footer text-right">
                  Intelligent Technology&copy;BY <?php echo date('Y'); ?> <div class="version">Version1.<?php echo $this->session->userdata('version');?></div>
                </footer>

            </div>
        </div>
    	<script>var resizefunc = []; </script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/detect.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/fastclick.js"></script> 
        <script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-colorpicker.js"></script> 
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-switch.js"></script> 
        <script>
    $(function() {
        $('.colorpicker-component').colorpicker();
    });
</script>
		
		<script>
            var BASE_URL = "<?php echo base_url(); ?>";     
			$(".switch").bootstrapSwitch(); 
      //$(".bootstrap_switch").bootstrapSwitch();      
        </script>
        <script>setTimeout(function(){ $('#flash_succ_message, #flash_error_message').hide(); }, 5000);</script>
        
        <script src="<?php echo base_url(); ?>assets/js/bootstrapValidator.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/admin_validation.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/admin.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/language.js"></script> 
		<!-- REQUIRED FOR FETCHING USER TIME ZONE -->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jstz-1.0.4.min.js"></script>   
		<script type="text/javascript">
			$(document).ready(function() {
				var tz = jstz.determine();
				var timezone = tz.name();
				$.post('<?php echo base_url(); ?>ajax',{timezone:timezone},function(res){
				// console.log(res);
				})      
			});
		</script>
		<script>
 function subitmorefield()
 {
	var labe=$("#field-1").val();
	var fname= $("#field-2").val();
    var html=''; 
	var html = '<div class="form-group">';
      html = html+' <label class="col-sm-3 control-label">'+labe+'</label>';
	  html = html+' <div class="col-sm-9">'; 
	  html = html+'<input type="text" class="form-control"  name="'+fname+'" placeholder="Type here.." value=""'; 
	  html = html+'</div>';
	  html = html+'</div>';
    $('.hrs_detail_addmore').append(html);
  	$('#con-close-modal').modal('hide');
 }
 </script>
<script>
function fnc(value, min, max) 
{
    if(parseInt(value) < 0 || isNaN(value)) 
        return 0; 
    else if(parseInt(value) > 50) 
        return 1; 
    else return value;
}
</script>
 <script>
    // jQuery ".Class" SELECTOR.
    $(document).ready(function() {
		
        $('.numberonly').keypress(function (event) {
            return isNumber(event, this)
        });

        // 
    });
    // THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
    function isNumber(evt, element) {

        var charCode = (evt.which) ? evt.which : event.keyCode

        if (
            (charCode != 45 || $(element).val().indexOf('-') != -1) &&      // â€œ-â€? CHECK MINUS, AND ONLY ONE.
            (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // â€œ.â€? CHECK DOT, AND ONLY ONE.
            (charCode < 48 || charCode > 57))
            return false;

        return true;
    }    


</script>

<script type="text/javascript">
        $(function () {
      // $('.only_alphabets').keydown(function (e) {
      //     if (e.shiftKey || e.ctrlKey || e.altKey) {
      //         e.preventDefault();
      //     } else {
      //         var key = e.keyCode;
      //         if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
      //             e.preventDefault();
      //         }
      //     }
      // });

      /*$('.only_numeric').keydown(function (evt) {
     
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
       });*/

      

  });

        
    </script>


    <script type="text/javascript">
        var specialKeys = new Array();
        specialKeys.push(8); //Backspace
        specialKeys.push(9); //Tab
        specialKeys.push(46); //Delete
        specialKeys.push(36); //Home
        specialKeys.push(35); //End
        specialKeys.push(37); //Left
        specialKeys.push(39); //Right
        function IsAlphaNumeric(e) {
            var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
            var ret = ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || (specialKeys.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode));
            //document.getElementById("error").style.display = ret ? "none" : "inline";
            return ret;
        }
    </script>
    <script type="text/javascript">
      $(document).ready(function(){     
    $('.switch_subscription').on('switchChange.bootstrapSwitch', function (e, data) { 
        var status = ''; 
        var sts_str   = '';
        var id = $(this).attr('id');
        if($(this).is(':checked')) { 
           status = '1'; 
           sts_str   = 'Active';
        } else { 
           status = '0';  
           sts_str   = 'InActive';
        }  
        if(status != '') {  
            $.ajax({
                type:'POST',
                url: BASE_URL+'admin/subscription/update_subscription_status',
                data : {id:id,status:status},
                success:function(response)
                                {      
                                  $('#change_staus_'+id).html(sts_str);
                                }                
            });
        } 
  })
    });
    </script>

    <?php 
      if($module=='settings' || $module=='language')
      {
        
      }
      else
      {
    ?>

    <script type="text/javascript">
       $(document).ready(function(){
    $('input[type=text], input[type=number], textarea').keyup(function()
                {
                       var yourInput = $(this).val();
                       re = /[`~!#%^&*()|+\=?;"<>\{\}\[\]\\\\]/gi;
                    var isSplChar = re.test(yourInput);
                       if(isSplChar)
                       {
                           var no_spl_char = yourInput.replace(/[`~!#%^&*()|+\=?;"<>\{\}\[\]\\\\]/gi, '');
                           $(this).val(no_spl_char);
                    }
                 });

         $('input[type=text], input[type=number], textarea').blur(function()
                {
                       var yourInput = $(this).val();
                       re = /[`~!#%^&*()|+\=?;"<>\{\}\[\]\\\\]/gi;
                    var isSplChar = re.test(yourInput);
                       if(isSplChar)
                       {
                           var no_spl_char = yourInput.replace(/[`~!#%^&*()|+\=?;"<>\{\}\[\]\\\\]/gi, '');
                           $(this).val(no_spl_char);
                    }
                 });
  });
    </script>
  <?php } ?>

  <?php 
    if($module=='category')
    {
      ?>
      <script type="text/javascript">
        $(document).ready(function () {

        $( "#multi_deletes_form").submit(function( event ) {
          var multi_Delete=$('#multi_Delete').val();
          if(multi_Delete=='')
          {
            alert('Please choose anyone category');
            return false;
          }
          else
          {
            $( "#multi_deletes_form" ).submit();
          }
        // alert( "Handler for .submit() called." );
        // event.preventDefault();
      });

    $("#ckbCheckAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        var checkboxValues = [];
        $('.checkBoxClass:checked').each(function(index, elem) {
            checkboxValues.push($(elem).val());
        });
        $('#multi_Delete').val(checkboxValues.join(','));
    });
    
    $(".checkBoxClass").change(function(){
        if (!$(this).prop("checked")){
            $("#ckbCheckAll").prop("checked",false);
             
        }

        var checkboxValues = [];
        $('.checkBoxClass:checked').each(function(index, elem) {
            checkboxValues.push($(elem).val());
        });
         $('#multi_Delete').val(checkboxValues.join(','));
    });
});
      </script>
   <?php
    }
    ?>

    <?php 
    if($module=='profession')
    {
      ?>
      <script type="text/javascript">
        $(document).ready(function () {

        $( "#multi_deletes_form").submit(function( event ) {
          var multi_Delete=$('#multi_Delete').val();
          if(multi_Delete=='')
          {
            alert('Please choose anyone profession');
            return false;
          }
          else
          {
            $( "#multi_deletes_form" ).submit();
          }
        // alert( "Handler for .submit() called." );
        // event.preventDefault();
      });

    $("#ckbCheckAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        var checkboxValues = [];
        $('.checkBoxClass:checked').each(function(index, elem) {
            checkboxValues.push($(elem).val());
        });
        $('#multi_Delete').val(checkboxValues.join(','));
    });
    
    $(".checkBoxClass").change(function(){
        if (!$(this).prop("checked")){
            $("#ckbCheckAll").prop("checked",false);
             
        }

        var checkboxValues = [];
        $('.checkBoxClass:checked').each(function(index, elem) {
            checkboxValues.push($(elem).val());
        });
         $('#multi_Delete').val(checkboxValues.join(','));
    });
});
      </script>
   <?php
    }
    ?>

    <?php 
    if($module=='terms')
    {
      ?>
      <script type="text/javascript">
        $(document).ready(function () {

        $( "#multi_deletes_form").submit(function( event ) {
          var multi_Delete=$('#multi_Delete').val();
          if(multi_Delete=='')
          {
            alert('Please choose anyone term');
            return false;
          }
          else
          {
            $( "#multi_deletes_form" ).submit();
          }
        // alert( "Handler for .submit() called." );
        // event.preventDefault();
      });

    $("#ckbCheckAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        var checkboxValues = [];
        $('.checkBoxClass:checked').each(function(index, elem) {
            checkboxValues.push($(elem).val());
        });
        $('#multi_Delete').val(checkboxValues.join(','));
    });
    
    $(".checkBoxClass").change(function(){
        if (!$(this).prop("checked")){
            $("#ckbCheckAll").prop("checked",false);
             
        }

        var checkboxValues = [];
        $('.checkBoxClass:checked').each(function(index, elem) {
            checkboxValues.push($(elem).val());
        });
         $('#multi_Delete').val(checkboxValues.join(','));
    });
});
      </script>
   <?php
    }
    ?>


        <?php
      $page_id = $this->uri->segment(3);
      if($page == 'language_keywords'){ ?>
         <script type="text/javascript">
        $(document).ready(function() {

            language_table = $('#language_table').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "ajax": {
                "url": "<?php echo site_url('language_list')?>",
                "type": "POST",
                "data": function ( data ) {
                  data.page_key = "<?php echo $page_id ?>"
                }
        },
        "columnDefs": [
        {
            "targets": [  ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],

        });
    });
    </script>
    <?php } 

    if($page == 'web_language_keywords'){ ?>
         <script type="text/javascript">
        $(document).ready(function() {

            language_table = $('#language_web_table').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "ajax": {
                "url": "<?php echo site_url('language_web_list')?>",
                "type": "POST",
                "data": function ( data ) {
                  
                }
        },
        "columnDefs": [
        {
            "targets": [  ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],

        });
    });
    </script>
    <?php } ?>

    <?php 
    if($module=='policy_settings' || $module=='client')
    {
      ?>
      <script src="<?php echo base_url(); ?>assets/js/dgt.cropper.min.js"></script>

      <script type="text/javascript">
        function imageUpload(error, data, response) {
          //console.log(response.image_url);
          $('#imageurl').val(response.image_url);
      }

      // function imageRemoved() {
      //     //console.log(response.image_url);
      //     $('#imageurl').val('');
      // }

      </script>

    <?php } ?>
</body>
</html>