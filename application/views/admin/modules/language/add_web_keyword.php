<div class="content-page">

	<div class="content">

		<div class="container">

			<div class="row">

				

				<div class="col-sm-12">

					<h4 class="page-title m-b-20 m-t-0">Add Keywords </h4>

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
								<!-- <ul class="nav nav-tabs navtab-bg nav-justified">

									<li class="active tab"><a href="#single_data" data-toggle="tab">Single Keyword</a></li>

									<li class="tab"><a href="#multi_data" data-toggle="tab">Multiple Keywords</a></li>
								</ul>
 -->
								<div class="tab-content">
									<div id="single_data" class="tab-pane active">
										<div class="m-t-30">
											<p class="text-center text-danger"><b><em>Note: *   Please enter words only in English ..........</em></b></p>
										</div>
										<form class="form-horizontal" autocomplete="off" id="" onsubmit="return keyword_validation();" action="" method="POST">

										
											<div class="form-group">
												<label class="col-sm-3 control-label">Field Name :</label>
												<div class="col-sm-9">
													<input name="field_name" id="field_name" class="form-control" type="text">
													<small class="error_msg help-block field_name_error" style="display: none;">Please enter a field</small>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Name :</label>
												<div class="col-sm-9">
													<input name="name" id="name" class="form-control" type="text">
													<small class="error_msg help-block name_error" style="display: none;">Please enter a name</small>
												</div>
											</div>
											
											<div class="m-t-30 text-center">
												<button name="form_submit"  type="submit" class="btn btn-primary center-block" value="true">Save</button>
											</div>
										</form>
									</div>

									<!-- <div id="multi_data" class="tab-pane">
										<div class="m-t-30">
											<p class="text-center text-danger"><b><em>Note: * Please enter Multiple words only in English ..........</em></b></p>
										</div>
										<form class="form-horizontal" id="" onsubmit="return multiple_keyword_validation();" action="" method="POST">
											<div class="form-group">
												<label class="col-sm-3 control-label">Multiple Keyword :</label>
												<div class="col-sm-9">
													<input  type="hidden" id="page_key" name="page_key" value="<?php echo $page_key;?>" class="form-control" >
													<textarea id="multiple" placeholder="Multiple Keyword Seperate comma Eg: Home,chat" name="multiple" value="" class="form-control" ></textarea>
													<small class="error_msg help-block multi_keyword_error" style="display: none;">Please enter Multiple Keywords</small>
												</div>
											</div>
											<div class="m-t-30 text-center">
												<button name="form_submit"  type="submit" class="btn btn-primary center-block" value="true">Save</button>
											</div>
										</form>
									</div> -->
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
		var field_name = $('#field_name').val().trim();
		var name = $('#name').val().trim();


		if(field_name==""){
			$('.field_name_error').show();
			error =1; 
		}else{
			$('.field_name_error').hide();

		}

		if(name==""){
			$('.name_error').show();
			error =1; 
		}else{
			$('.name_error').hide();

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