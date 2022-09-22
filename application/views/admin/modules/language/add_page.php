<div class="content-page">

	<div class="content">

		<div class="container">

			<div class="row">

				

				<div class="col-sm-12">

					<h4 class="page-title m-b-20 m-t-0">Add Page </h4>

				</div>

			</div>

			<div class="panel-body">
				<?php if($this->session->flashdata('message')) { ?>
				<div class="alert alert-success text-center fade in" id="flash_succ_message">
					<?php echo $this->session->userdata('message'); ?>
					<?php } ?>
				</div> 

				<div class="row">

					<div class="col-lg-12">

						<div class="card-box">

							
							<div>
							<!-- 	<ul class="nav nav-tabs navtab-bg nav-justified">

									<li class="active tab"><a href="#single_data" data-toggle="tab">Single Keyword</a></li>

									
								</ul> -->

								<div class="tab-content">
									<div id="single_data" class="tab-pane active">
										
										<form class="form-horizontal" id="" onsubmit="return keyword_validation();" action="" method="POST">

										
											<div class="form-group">
												<label class="col-sm-3 control-label">Page Name :</label>
												<div class="col-sm-9">
													<input  type="text" id="page_name" name="page_name" value="" class="form-control" >
													<small class="error_msg help-block keyword_error" style="display: none;">Please enter a page name</small>
												</div>
											</div>
											<div class="m-t-30 text-center">
												<button name="form_submit"  type="submit" class="btn btn-primary center-block" value="true">Save</button>
											</div>
										</form>
									</div>

									
								</div>
							</div>
						</div>


						
				</div>
			</div>
		</div>
	</div>
</div>




<script type="text/javascript">

	function keyword_validation(){

		var error =0;
		var page_name = $('#page_name').val().trim();


		if(page_name==""){
			$('.keyword_error').show();
			error =1; 
		}else{
			$('.keyword_error').hide();

		}

		if(error==0){
			return true;
		}else{
			return false;
		}
	}

	function multiple_keyword_validation(){

		var error =0;
		var keyword = $('#multiple').val().trim();


		if(keyword==""){
			$('.multi_keyword_error').show();
			error =1; 
		}else{
			$('.multi_keyword_error').hide();

		}

		if(error==0){
			return true;
		}else{
			return false;
		}
	}

	function delete_language(val)
	{
		bootbox.confirm("Are you sure want to Delete ? ", function(result) {
                //alert(result);
                if(result ==true)                {
                	var url        = BASE_URL+'admin/language_management_controller/delete_keyword';
                	var id = val;                               
                	$.ajax({
                		url:url,
                		data:{id:id}, 
                		type:"POST",
                		success:function(res){ 
                			if(res==1)
                			{
                				window.location = BASE_URL+'admin/language_management_controller/add_keyword';
                			}
                		}
                	});  
                }
            }); 
	}
</script>