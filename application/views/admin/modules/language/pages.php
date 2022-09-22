<div class="content-page">
    <div class="content">
        <div class="container">
			<div class="row">
				<div class="col-sm-8">
					<h4 class="page-title m-b-20 m-t-0">Page List</h4>
				</div>
                <div class="col-xs-4 text-right m-b-30">
                        <a href="<?php echo $base_url.'language/add-page'; ?>" class="btn btn-primary rounded pull-right"><i class="fa fa-plus"></i> Add Page</a>
                    </div>
			</div>
            <div>
                <div class="panel">
                    <div class="panel-body">
                        <div class="table-responsive">
                          <table class="table custom-table m-b-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Page Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $i = 0;
                                  foreach ($list as $page) {
                                    $i++;
                                    ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                                <td>
                                                    <div class="service-desc">
                                                        <h2><a href="<?php echo base_url().'language/pages/'.$page['page_key']; ?>"><?php echo $page['page_title']; ?></a></h2>
                                                    </div>
                                    </td>
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
</div>


<script type="text/javascript">
    
    function update_multi_lang()
    {
        
        
        $("#form_id").submit();
    }

</script>