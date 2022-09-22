<div class="content-page">
    <div class="content">
        <div class="container">
			<div class="row">
				<div class="col-xs-8">
					<h4 class="page-title m-b-20 m-t-0">Add Language Keywords</h4>
				</div>
                
                    <div class="col-xs-4 text-right m-b-30">
                        <a href="<?php echo $base_url;?>language/add-web-keyword" class="btn btn-primary rounded pull-right"><i class="fa fa-plus"></i> Add Keyword</a>
                    </div>
			</div>
            <div>
                <div class="panel">
                    <div class="panel-body">
                        <?php if($this->session->flashdata('message')) { ?>
                        <div class="alert alert-success text-center fade in" id="flash_succ_message">
                            <?php echo $this->session->userdata('message'); ?>
                           
                        </div> 
                       <?php } ?>
                        <div class="table-responsive">
                            <form action="<?php echo base_url().'admin/language/update_multi_web_language/';?>" onsubmit="update_multi_lang();" method="post" id="form_id">
                                <input type="hidden" name="page_key" value="<?php echo $this->uri->segment(3);?>">
                            
                            <table class="table" id="language_web_table">
                                <thead>
                                    <tr>
                                        <?php
                                        if (!empty($active_language))
                                        {
                                            foreach ($active_language as $row)
                                            {  
                                                ?>
                                                <th><?php echo ucfirst($row['language'])?></th>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                               
                            </tbody>
                        </table>
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


<script type="text/javascript">
    
    function update_multi_lang()
    {
        
        
        $("#form_id").submit();
    }

</script>